<?php
/**
 * SQL regressions against connection-local TEMPORARY tables only.
 * Supply DB_HOST/DB_USER/DB_PASSWORD/DB_NAME, or DZ_HISTORY_TEST_CONFIG pointing
 * to a PEQ config.php. No persistent table is created or changed.
 */
require_once dirname(__DIR__) . '/classes/player_dz_history.php';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
if (getenv('DZ_HISTORY_TEST_CONFIG')) {
  require getenv('DZ_HISTORY_TEST_CONFIG');
}
else {
  $dbhost = getenv('DB_HOST');
  $dbuser = getenv('DB_USER');
  $dbpass = getenv('DB_PASSWORD');
  $db = getenv('DB_NAME');
  $dbport = getenv('DB_PORT') ?: 3306;
}
if (!$dbhost || !$dbuser || !$db) {
  echo "player_dz_history_test: skipped (database environment unavailable)\n";
  exit(0);
}
$connection = new mysqli($dbhost, $dbuser, $dbpass, $db, $dbport);
$connection->set_charset('utf8mb4');

// Temporary tables are intentionally invisible to information_schema.tables.
// Only the schema probe is replaced; every data/rule/eligibility query is real SQL.
class FixtureDzHistory extends PlayerDzHistory {
  public $fixtureSchema = array('missing' => array(), 'transactional' => true);
  public function schemaDiagnostics() { return $this->fixtureSchema; }
}
$history = new FixtureDzHistory($connection);
$assertions = 0;
function dz_assert($condition, $message) {
  global $assertions;
  ++$assertions;
  if (!$condition) { throw new RuntimeException($message); }
}
function dz_sql($sql) { global $connection; return $connection->query($sql); }
function dz_entries() { global $history; return $history->load(100)['entries']; }
function dz_status() {
  $entries = dz_entries();
  dz_assert(count($entries) === 1, 'Expected one saved expedition');
  return $entries[0]['status'];
}

$definitions = array(
  'character_data' => 'id INT PRIMARY KEY, name VARCHAR(64)',
  'dynamic_zones' => 'id INT PRIMARY KEY, uuid VARCHAR(36), instance_id INT, name VARCHAR(128), leader_id INT, max_players INT, is_locked INT, type INT',
  'instance_list' => 'id INT PRIMARY KEY, zone INT, version INT, start_time BIGINT, duration INT, never_expires INT',
  'dynamic_zone_resume' => 'dz_id INT PRIMARY KEY, uuid VARCHAR(36), instance_id INT, owner_id INT, season_id INT, revoked INT',
  'dynamic_zone_resume_history' => 'dz_id INT, uuid VARCHAR(36), character_id INT, can_resume INT, PRIMARY KEY(dz_id,character_id)',
  'character_dynamic_zone_resume' => 'character_id INT, zone_id INT, zone_version INT, expedition_name VARCHAR(128), season_id INT, dz_id INT, uuid VARCHAR(36), PRIMARY KEY(character_id,zone_id,zone_version,expedition_name,season_id)',
  'dynamic_zone_members' => 'dynamic_zone_id INT, character_id INT, PRIMARY KEY(dynamic_zone_id,character_id)',
  'instance_list_player' => 'id INT, charid INT',
  'character_expedition_lockouts' => 'id INT PRIMARY KEY, character_id INT, expedition_name VARCHAR(128), event_name VARCHAR(128), from_expedition_uuid VARCHAR(36), expire_time DATETIME',
  'dynamic_zone_lockouts' => 'id INT PRIMARY KEY, dynamic_zone_id INT, event_name VARCHAR(128), expire_time DATETIME',
  'rule_sets' => 'ruleset_id INT PRIMARY KEY, name VARCHAR(64)',
  'rule_values' => 'ruleset_id INT, rule_name VARCHAR(128), rule_value VARCHAR(64)',
  'variables' => 'varname VARCHAR(64), value VARCHAR(128)',
  'data_buckets' => 'id INT PRIMARY KEY, character_id INT, `key` VARCHAR(128), value VARCHAR(128), expires BIGINT'
);
foreach ($definitions as $table => $columns) {
  dz_sql("CREATE TEMPORARY TABLE `$table` ($columns) ENGINE=InnoDB");
}
function dz_reset() {
  global $definitions, $history;
  foreach ($definitions as $table => $columns) { dz_sql("DELETE FROM `$table`"); }
  $history->fixtureSchema = array('missing' => array(), 'transactional' => true);
  dz_sql("INSERT INTO character_data VALUES (100, 'Saved Owner'), (200, 'Leader')");
  dz_sql("INSERT INTO dynamic_zones VALUES (10, 'aaaaaaaa-aaaa-aaaa-aaaa-aaaaaaaaaaaa', 50, 'Test Expedition', 200, 6, 0, 1)");
  dz_sql("INSERT INTO instance_list VALUES (50, 42, 1, UNIX_TIMESTAMP() - 60, 7200, 0)");
  dz_sql("INSERT INTO dynamic_zone_resume VALUES (10, 'aaaaaaaa-aaaa-aaaa-aaaa-aaaaaaaaaaaa', 50, 100, 0, 0)");
  dz_sql("INSERT INTO dynamic_zone_resume_history VALUES (10, 'aaaaaaaa-aaaa-aaaa-aaaa-aaaaaaaaaaaa', 100, 1)");
  dz_sql("INSERT INTO character_dynamic_zone_resume VALUES (100, 42, 1, 'Test Expedition', 0, 10, 'aaaaaaaa-aaaa-aaaa-aaaa-aaaaaaaaaaaa')");
  dz_sql("INSERT INTO rule_sets VALUES (7, 'default'), (20, 'custom')");
  dz_sql("INSERT INTO rule_values VALUES (7, 'Expedition:EnableDzResume', 'true')");
}

dz_reset();
dz_assert(dz_status() === 'Eligible (pending live checks)', 'Empty saved expedition stays eligible');
$view = $history->load('100');
dz_assert($view['player_name'] === 'Saved Owner' && $view['entries'][0]['leader_name'] === 'Leader', 'Names resolve');
dz_assert((int) $view['entries'][0]['members'] === 0, 'No roster membership is needed for a saved return right');
dz_sql('INSERT INTO dynamic_zone_members VALUES (10,100)');
dz_assert(dz_status() === 'Already a member', 'Current member is identified');
dz_sql('DELETE FROM dynamic_zone_members WHERE character_id=100');
dz_assert(dz_status() === 'Eligible (pending live checks)', 'Kicking retains the saved return right');

$exclusions = array(
  'ordinary member without self-return' => 'UPDATE dynamic_zone_resume_history SET can_resume=0',
  'another character' => 'UPDATE dynamic_zone_resume_history SET character_id=200',
  'revoked' => 'UPDATE dynamic_zone_resume SET revoked=1',
  'expired' => 'UPDATE instance_list SET duration=1',
  'permanent' => 'UPDATE instance_list SET never_expires=1',
  'non expedition' => 'UPDATE dynamic_zones SET type=3',
  'missing instance' => 'DELETE FROM instance_list',
  'missing DZ' => 'DELETE FROM dynamic_zones',
  'reused numeric instance' => 'UPDATE dynamic_zones SET instance_id=51',
  'changed UUID' => "UPDATE dynamic_zones SET uuid='bbbbbbbb-bbbb-bbbb-bbbb-bbbbbbbbbbbb'",
  'history UUID mismatch' => "UPDATE dynamic_zone_resume_history SET uuid='bbbbbbbb-bbbb-bbbb-bbbb-bbbbbbbbbbbb'",
  'missing latest watermark' => 'DELETE FROM character_dynamic_zone_resume',
  'newer copy deleted or never registered' => 'UPDATE character_dynamic_zone_resume SET dz_id=11',
  'latest UUID mismatch' => "UPDATE character_dynamic_zone_resume SET uuid='bbbbbbbb-bbbb-bbbb-bbbb-bbbbbbbbbbbb'",
  'latest season mismatch' => 'UPDATE character_dynamic_zone_resume SET season_id=2',
  'latest zone mismatch' => 'UPDATE character_dynamic_zone_resume SET zone_id=43',
  'latest version mismatch' => 'UPDATE character_dynamic_zone_resume SET zone_version=2',
  'latest name mismatch' => "UPDATE character_dynamic_zone_resume SET expedition_name='Other Expedition'"
);
foreach ($exclusions as $label => $sql) {
  dz_reset(); dz_sql($sql);
  dz_assert(count(dz_entries()) === 0, 'Excluded: ' . $label);
}

dz_reset();
dz_sql('UPDATE dynamic_zones SET is_locked=1, max_players=0');
dz_assert(dz_status() === 'Expedition locked', 'Lock wins over capacity');
dz_sql('INSERT INTO dynamic_zone_members VALUES (10,100)');
dz_assert(dz_status() === 'Already a member', 'Membership wins over lock and capacity');
dz_sql('UPDATE dynamic_zone_members SET dynamic_zone_id=20');
dz_sql("INSERT INTO dynamic_zones VALUES (20,'bbbbbbbb-bbbb-bbbb-bbbb-bbbbbbbbbbbb',51,'Other',200,6,0,1)");
dz_assert(dz_status() === 'Leave current expedition first', 'Other roster blocks even before stale cleanup');
dz_reset(); dz_sql('UPDATE dynamic_zones SET max_players=0');
dz_assert(dz_status() === 'Expedition full', 'Capacity is checked');

dz_reset();
dz_sql("INSERT INTO character_expedition_lockouts VALUES (1,100,'Test Expedition','Replay Timer','aaaaaaaa-aaaa-aaaa-aaaa-aaaaaaaaaaaa',NOW()+INTERVAL 1 HOUR)");
dz_assert(dz_status() === 'Eligible (pending live checks)', 'Same UUID replay is allowed without target replay row');
dz_sql("UPDATE character_expedition_lockouts SET from_expedition_uuid='bbbbbbbb-bbbb-bbbb-bbbb-bbbbbbbbbbbb'");
dz_assert(dz_status() === 'Conflicting lockout', 'Foreign replay is blocked');
dz_sql('UPDATE character_expedition_lockouts SET expire_time=NOW()-INTERVAL 1 SECOND');
dz_assert(dz_status() === 'Eligible (pending live checks)', 'Expired foreign replay is ignored');
dz_sql("UPDATE character_expedition_lockouts SET event_name='Boss', expire_time=NOW()+INTERVAL 1 HOUR");
dz_assert(dz_status() === 'Conflicting lockout', 'Missing target event conflicts');
dz_sql("INSERT INTO dynamic_zone_lockouts VALUES (1,10,'Boss',NOW()-INTERVAL 1 HOUR)");
dz_assert(dz_status() === 'Eligible (pending live checks)', 'Existing target event allows return even if target event timer expired');
dz_sql("UPDATE character_expedition_lockouts SET expedition_name='Unrelated'");
dz_sql('DELETE FROM dynamic_zone_lockouts');
dz_assert(dz_status() === 'Eligible (pending live checks)', 'Unrelated expedition lockout is ignored');

dz_reset();
dz_sql("INSERT INTO variables VALUES ('RuleSet','custom')");
dz_assert(dz_status() === 'Eligible (pending live checks)', 'Selected ruleset inherits default');
dz_sql("INSERT INTO rule_values VALUES (20,'Expedition:EnableDzResume','false')");
dz_assert(dz_status() === 'Saved rejoin disabled', 'Selected ruleset override wins without assuming ID1');
foreach (array('enabled' => true, 'y' => true, '2' => true, 'TRUE' => false, '' => true) as $value => $enabled) {
  dz_sql("UPDATE rule_values SET rule_value='$value' WHERE ruleset_id=20");
  dz_assert((dz_status() === 'Eligible (pending live checks)') === $enabled, 'Server boolean/empty-override parsing: ' . $value);
}
dz_sql('DELETE FROM rule_values');
dz_assert(dz_status() === 'Saved rejoin disabled', 'Missing enable rule uses compiled false');
dz_reset();
$history->fixtureSchema['transactional'] = false;
dz_assert(dz_status() === 'Rejoin unavailable: storage requires InnoDB', 'Nontransactional storage fails eligibility');
$history->fixtureSchema['missing'] = array('character_dynamic_zone_resume');
$view = $history->load(100);
dz_assert(count($view['entries']) === 0 && count($view['missing']) === 1, 'Partial schema produces explanatory state');

dz_reset();
dz_sql("INSERT INTO rule_values VALUES (7,'Seasons:EnableSeasonalCharacters','3')");
dz_sql('UPDATE dynamic_zone_resume SET season_id=3');
dz_sql('UPDATE character_dynamic_zone_resume SET season_id=3');
dz_assert(dz_status() === 'Season mismatch', 'Nonseasonal player cannot restore seasonal instance');
dz_sql("INSERT INTO data_buckets VALUES (1,100,'SeasonalCharacter','3',0)");
dz_assert(dz_status() === 'Eligible (pending live checks)', 'Active matching season grants eligibility');
dz_sql("UPDATE data_buckets SET value='3junk'");
dz_assert(dz_status() === 'Season mismatch', 'Malformed season bucket is not a valid number');
dz_sql("UPDATE data_buckets SET value='3'");
dz_sql("INSERT INTO data_buckets VALUES (2,100,'SeasonalCharacter','2',0)");
dz_assert(dz_status() === 'Season mismatch', 'Newest bucket is authoritative');
dz_sql('UPDATE data_buckets SET expires=UNIX_TIMESTAMP()-1 WHERE id=2');
dz_assert(dz_status() === 'Eligible (pending live checks)', 'Expired bucket is ignored');
dz_sql("UPDATE rule_values SET rule_value='0' WHERE rule_name='Seasons:EnableSeasonalCharacters'");
dz_assert(dz_status() === 'Season mismatch', 'Disabled season resolves to zero');

dz_reset();
dz_assert($history->load(999)['error'] === 'Player not found.', 'Missing player is distinguished from empty history');
foreach (array('100 OR 1=1', 0, -1, '4294967296', array(100)) as $invalid) {
  $rejected = false;
  try { $history->load($invalid); } catch (InvalidArgumentException $e) { $rejected = true; }
  dz_assert($rejected, 'Reject invalid character ID');
}
echo 'player_dz_history_test: ' . $assertions . " assertions passed (temporary tables only)\n";
