<?php

/** Read-only view of the saved expeditions offered by DZManager. */
class PlayerDzHistory {
  private $db;

  public function __construct($db) {
    $this->db = $db;
  }

  protected function rows($sql) {
    $result = $this->db->query($sql);
    if (!$result) {
      throw new RuntimeException('Unable to read saved expedition data.');
    }
    $rows = array();
    while ($row = $result->fetch_assoc()) {
      $rows[] = $row;
    }
    $result->free();
    return $rows;
  }

  public function schemaDiagnostics() {
    $required = array('dynamic_zone_resume', 'dynamic_zone_resume_history',
      'character_dynamic_zone_resume', 'dynamic_zones', 'dynamic_zone_members',
      'instance_list', 'instance_list_player', 'character_expedition_lockouts', 'dynamic_zone_lockouts');
    $tables = $this->rows("SELECT table_name, engine FROM information_schema.tables
      WHERE table_schema = DATABASE() AND table_name IN ('" . implode("','", $required) . "')");
    $found = array();
    $transactional = true;
    foreach ($tables as $table) {
      $found[] = $table['table_name'];
      if (strcasecmp($table['engine'], 'InnoDB') !== 0) {
        $transactional = false;
      }
    }
    return array('missing' => array_values(array_diff($required, $found)), 'transactional' => $transactional);
  }

  private function rules() {
    // World loads default first, then the ruleset named by variables.RuleSet.
    // Runtime rule overrides are not available to this database-only view.
    $settings = array('Expedition:EnableDzResume' => 'false', 'Seasons:EnableSeasonalCharacters' => '0');
    $rows = $this->rows("SELECT s.name, v.rule_name, v.rule_value FROM rule_sets s
      JOIN rule_values v ON v.ruleset_id = s.ruleset_id
      WHERE (s.name = 'default' OR s.name = (SELECT value FROM variables WHERE varname = 'RuleSet' LIMIT 1))
      AND v.rule_name IN ('Expedition:EnableDzResume', 'Seasons:EnableSeasonalCharacters')
      ORDER BY (s.name = 'default') DESC");
    foreach ($rows as $row) {
      if ($row['rule_value'] !== '') {
        $settings[$row['rule_name']] = $row['rule_value'];
      }
    }
    return array(
      'enabled' => self::ruleBool($settings['Expedition:EnableDzResume']),
      'active_season' => max(0, self::ruleInt($settings['Seasons:EnableSeasonalCharacters']))
    );
  }

  private static function ruleInt($value) {
    // Strings::ToInt rejects whitespace, nonnumeric text and int32 overflow.
    return preg_match('/^-?[0-9]+$/D', $value) && (float) $value >= -2147483648 && (float) $value <= 2147483647
      ? (int) $value : 0;
  }

  private static function ruleBool($value) {
    // Match the server's case-sensitive Strings::ToBool tokens.
    foreach (array('true', 'y', 'on', 'enable') as $token) {
      if (strpos($value, $token) !== false) {
        return true;
      }
    }
    return self::ruleInt($value) !== 0;
  }

  public function load($playerId) {
    if (!is_scalar($playerId) || !ctype_digit((string) $playerId) || (float) $playerId < 1 || (float) $playerId > 4294967295) {
      throw new InvalidArgumentException('A valid player ID is required.');
    }
    $playerId = (int) $playerId;
    $view = array('player_id' => $playerId, 'player_name' => '', 'entries' => array(),
      'error' => '', 'missing' => array(), 'enabled' => false, 'transactional' => false,
      'character_season' => 0, 'current_dz' => 0, 'checked_at' => 0);
    $characters = $this->rows("SELECT id, name FROM character_data WHERE id = $playerId");
    if (!$characters) {
      $view['error'] = 'Player not found.';
      return $view;
    }
    $view['player_name'] = $characters[0]['name'];
    $schema = $this->schemaDiagnostics();
    $view['missing'] = $schema['missing'];
    $view['transactional'] = $schema['transactional'];
    if ($view['missing']) {
      return $view;
    }
    $rules = $this->rules();
    $view['enabled'] = $rules['enabled'];
    if ($rules['active_season'] > 0) {
      $bucket = $this->rows("SELECT value FROM data_buckets WHERE character_id = $playerId
        AND `key` = 'SeasonalCharacter' AND (expires = 0 OR expires > UNIX_TIMESTAMP()) ORDER BY id DESC LIMIT 1");
      if ($bucket && self::ruleInt($bucket[0]['value']) === $rules['active_season']) {
        $view['character_season'] = $rules['active_season'];
      }
    }
    $memberships = $this->rows("SELECT d.id FROM dynamic_zone_members m
      JOIN dynamic_zones d ON d.id = m.dynamic_zone_id
      WHERE m.character_id = $playerId AND d.type = 1 ORDER BY d.id LIMIT 1");
    if ($memberships) {
      $view['current_dz'] = (int) $memberships[0]['id'];
    }
    $now = $this->rows('SELECT UNIX_TIMESTAMP() AS checked_at');
    $view['checked_at'] = (int) $now[0]['checked_at'];

    // Keep these identity and latest-copy joins aligned with
    // world/dynamic_zone_manager.cpp HandleDzResumeRequest. History alone is
    // insufficient: latest-copy records survive the newer instance's deletion.
    $entries = $this->rows("SELECT d.id AS dz_id, d.uuid, d.instance_id, d.name, d.leader_id,
      d.max_players, d.is_locked, i.zone AS zone_id, i.version AS zone_version,
      (i.start_time + i.duration) AS expires, r.season_id, r.owner_id,
      COALESCE(c.name, '') AS leader_name,
      (SELECT COUNT(*) FROM dynamic_zone_members m WHERE m.dynamic_zone_id = d.id) AS members,
      EXISTS(SELECT 1 FROM character_expedition_lockouts cl
        WHERE cl.character_id = $playerId AND cl.expedition_name = d.name AND cl.expire_time > NOW()
        AND ((BINARY cl.event_name = 'Replay Timer' AND BINARY COALESCE(cl.from_expedition_uuid, '') <> BINARY d.uuid)
          OR (BINARY cl.event_name <> 'Replay Timer' AND NOT EXISTS
            (SELECT 1 FROM dynamic_zone_lockouts dl WHERE dl.dynamic_zone_id = d.id AND dl.event_name = cl.event_name)))) AS lockout_conflict
      FROM dynamic_zone_resume r
      JOIN dynamic_zone_resume_history h ON h.dz_id = r.dz_id AND h.uuid = r.uuid
      JOIN dynamic_zones d ON d.id = r.dz_id AND d.uuid = r.uuid AND d.instance_id = r.instance_id
      JOIN instance_list i ON i.id = r.instance_id
      JOIN character_dynamic_zone_resume l ON l.character_id = h.character_id
        AND l.dz_id = r.dz_id AND l.uuid = r.uuid AND l.season_id = r.season_id
        AND l.zone_id = i.zone AND l.zone_version = i.version AND l.expedition_name = d.name
      LEFT JOIN character_data c ON c.id = d.leader_id
      WHERE r.revoked = 0 AND h.can_resume = 1 AND h.character_id = $playerId AND d.type = 1
        AND i.never_expires = 0 AND i.start_time + i.duration > UNIX_TIMESTAMP()
      ORDER BY (i.start_time + i.duration), d.id LIMIT 16");
    foreach ($entries as $entry) {
      $entry['status'] = self::status($entry, $view);
      $view['entries'][] = $entry;
    }
    return $view;
  }

  public static function status(array $entry, array $view) {
    if (!$view['enabled']) {
      return 'Saved rejoin disabled';
    }
    if (!$view['transactional']) {
      return 'Rejoin unavailable: storage requires InnoDB';
    }
    if ((int) $entry['expires'] <= $view['checked_at']) {
      return 'Expired';
    }
    if ($view['current_dz']) {
      return $view['current_dz'] === (int) $entry['dz_id'] ? 'Already a member' : 'Leave current expedition first';
    }
    if ($entry['is_locked']) {
      return 'Expedition locked';
    }
    if ((int) $entry['members'] >= (int) $entry['max_players']) {
      return 'Expedition full';
    }
    if ((int) $entry['season_id'] !== $view['character_season']) {
      return 'Season mismatch';
    }
    if ($entry['lockout_conflict']) {
      return 'Conflicting lockout';
    }
    return 'Eligible (pending live checks)';
  }
}
