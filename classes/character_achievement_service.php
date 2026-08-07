<?php

/**
 * Split-database character achievement administration.
 *
 * Character and runtime state is always read from and written to the primary
 * EQEmu database. Achievement definitions are always read from the content
 * database. These may be the same mysqli connection, but this service never
 * relies on cross-database joins.
 *
 * This file intentionally uses PHP 7.1-compatible syntax and has no framework
 * dependencies.
 */

class CharacterAchievementServiceException extends RuntimeException
{
}

class CharacterAchievementValidationException extends CharacterAchievementServiceException
{
}

class CharacterAchievementBusyException extends CharacterAchievementServiceException
{
}

class CharacterAchievementDatabaseException extends CharacterAchievementServiceException
{
}

class CharacterAchievementService
{
  const UINT32_MAX = 4294967295;

  const REWARD_STATUS_IN_FLIGHT = 0;
  const REWARD_STATUS_GRANTED = 1;
  const REWARD_STATUS_RETRYABLE_FAILURE = 2;

  const SELECTION_STATUS_PENDING = 0;
  const SELECTION_STATUS_GRANTED = 1;
  const SELECTION_STATUS_RETRYABLE_FAILURE = 2;
  const SELECTION_STATUS_AMBIGUOUS = 3;

  const MUTATION_STATUS_PENDING = 0;
  const MUTATION_STATUS_BLOCKED = 1;
  const MUTATION_STATUS_PROCESSING = 2;

  const COMPONENT_TYPE_MIN = 0;
  const COMPONENT_TYPE_MAX_STATE_BEARING = 2;

  const MAX_DETAIL_ACHIEVEMENT_IDS = 1000;

  private $characterDatabase;
  private $contentDatabase;
  private $schemaDiagnosticsCache;

  /**
   * @param object $characterDatabase Primary/player mysqli connection ($mysql)
   * @param object $contentDatabase Content mysqli connection ($mysql_content_db)
   */
  public function __construct($characterDatabase, $contentDatabase)
  {
    $this->assertDatabaseConnection($characterDatabase, 'character');
    $this->assertDatabaseConnection($contentDatabase, 'content');

    $this->characterDatabase = $characterDatabase;
    $this->contentDatabase = $contentDatabase;
    $this->schemaDiagnosticsCache = null;
  }

  /**
   * Inspect every table, column, engine, identity, and lookup index required
   * by character achievement administration. No schema is created or altered.
   *
   * The legacy character_missing/content_missing keys remain available for
   * callers that only need a concise migration hint. Detailed diagnostics are
   * returned alongside them so unsafe partial schemas never look ready.
   */
  public function schemaDiagnostics($refresh = false)
  {
    if (!$refresh && is_array($this->schemaDiagnosticsCache)) {
      return $this->schemaDiagnosticsCache;
    }

    $character = $this->inspectSchema(
      $this->characterDatabase,
      $this->characterSchemaSpec(),
      'Character achievement',
      'character achievement state schema check'
    );
    $content = $this->inspectSchema(
      $this->contentDatabase,
      $this->contentSchemaSpec(),
      'Achievement content',
      'achievement content schema check'
    );

    $diagnostics = array(
      'ready' => $character['ready'] && $content['ready'],
      'character_database' => $character['database'],
      'content_database' => $content['database'],
      'character_missing' => $character['missing'],
      'content_missing' => $content['missing'],
      'character_errors' => $character['errors'],
      'content_errors' => $content['errors'],
      'errors' => array_merge($character['errors'], $content['errors']),
      'character_tables' => $character['tables'],
      'content_tables' => $content['tables']
    );
    $this->schemaDiagnosticsCache = $diagnostics;

    return $diagnostics;
  }

  /**
   * Search and paginate characters with achievement aggregate counts.
   *
   * @return array{items: array, total: int, page: int, per_page: int, pages: int}
   */
  public function listCharacters($search = '', $page = 1, $perPage = 50)
  {
    $search = trim((string) $search);
    if (strlen($search) > 255) {
      throw new CharacterAchievementValidationException('Character search is limited to 255 characters.');
    }

    $page = $this->normalizePositiveInteger($page, 'Page');
    $perPage = $this->normalizePositiveInteger($perPage, 'Page size');
    if ($perPage > 200) {
      throw new CharacterAchievementValidationException('Page size cannot exceed 200 rows.');
    }

    $where = " WHERE cd.deleted_at IS NULL";
    $types = '';
    $params = array();

    if ($search !== '') {
      if (ctype_digit($search)) {
        $where .= " AND (cd.id = ? OR cd.name LIKE ?)";
        $types .= 'is';
        $params[] = $this->normalizeUnsignedInteger($search, 'Character ID', self::UINT32_MAX);
        $params[] = '%' . $search . '%';
      }
      else {
        $where .= " AND cd.name LIKE ?";
        $types .= 's';
        $params[] = '%' . $search . '%';
      }
    }

    $countRow = $this->fetchOne(
      $this->characterDatabase,
      "SELECT COUNT(*) AS total FROM character_data cd" . $where,
      $types,
      $params,
      'character achievement character count'
    );
    $total = $countRow ? (int) $countRow['total'] : 0;
    $pages = max(1, (int) ceil($total / $perPage));
    if ($page > $pages) {
      $page = $pages;
    }
    $offset = ($page - 1) * $perPage;

    $rows = $this->fetchAll(
      $this->characterDatabase,
      "SELECT cd.id, cd.account_id, cd.name, cd.level, cd.class, cd.ingame, cd.last_login,
        (SELECT COUNT(*) FROM character_achievements completion_count
          WHERE completion_count.character_id = cd.id) AS achievement_completion_count,
        (SELECT COUNT(*) FROM character_achievement_progress active_progress
          WHERE active_progress.character_id = cd.id AND active_progress.current_count > 0) AS achievement_progress_count,
        (SELECT COUNT(*) FROM character_achievement_progress progress_rows
          WHERE progress_rows.character_id = cd.id) AS achievement_progress_row_count,
        (SELECT COALESCE(SUM(progress_total.current_count), 0)
          FROM character_achievement_progress progress_total
          WHERE progress_total.character_id = cd.id) AS achievement_progress_total
       FROM character_data cd" . $where . "
       ORDER BY cd.name ASC, cd.id ASC
       LIMIT ? OFFSET ?",
      $types . 'ii',
      array_merge($params, array($perPage, $offset)),
      'character achievement character list'
    );

    foreach ($rows as &$row) {
      $row['id'] = (int) $row['id'];
      $row['account_id'] = (int) $row['account_id'];
      $row['level'] = (int) $row['level'];
      $row['class'] = (int) $row['class'];
      $row['ingame'] = (int) $row['ingame'];
      $row['achievement_completion_count'] = (int) $row['achievement_completion_count'];
      $row['achievement_progress_count'] = (int) $row['achievement_progress_count'];
      $row['achievement_progress_row_count'] = (int) $row['achievement_progress_row_count'];
      // Keep achievement_progress_total as a decimal string. It is a SUM of
      // unsigned values and can exceed the platform integer range.
      $row['achievement_progress_total'] = (string) $row['achievement_progress_total'];
    }
    unset($row);

    return array(
      'items' => $rows,
      'total' => $total,
      'page' => $page,
      'per_page' => $perPage,
      'pages' => $total === 0 ? 0 : $pages
    );
  }

  /**
   * Load the content definition rows and character-owned state needed by a
   * character achievement detail page. All content and state queries remain
   * separate so remote content databases are supported.
   *
   * By default an empty achievement ID list loads the full catalog for legacy
   * callers. Pass false as the third argument when an empty list means an
   * explicitly empty page; this avoids accidentally hydrating every graph.
   * A non-empty list is capped at 1000 IDs.
   */
  public function characterStateInputs(
    $characterId,
    array $achievementIds = array(),
    $loadFullCatalogWhenEmpty = true
  )
  {
    $characterId = $this->normalizeUnsignedInteger($characterId, 'Character ID', self::UINT32_MAX, false);
    $achievementIds = $this->normalizeAchievementIds($achievementIds);

    $character = $this->fetchOne(
      $this->characterDatabase,
      "SELECT id, account_id, name, level, class, ingame, last_login, deleted_at
       FROM character_data WHERE id = ? LIMIT 1",
      'i',
      array($characterId),
      'character achievement character detail'
    );
    if (!$character) {
      throw new CharacterAchievementValidationException('Character not found.');
    }
    if (empty($achievementIds) && !$loadFullCatalogWhenEmpty) {
      return array(
        'character' => $character,
        'definitions' => array(),
        'associations' => array(),
        'components' => array(),
        'criteria' => array(),
        'rewards' => array(),
        'reward_sets' => array(),
        'reward_options' => array(),
        'reward_option_entries' => array(),
        'completions' => array(),
        'progress' => array(),
        'reward_ledgers' => array(),
        'reward_selections' => array(),
        'pending_mutations' => array()
      );
    }

    $contentFilter = $this->buildInFilter('a.id', $achievementIds);
    $definitions = $this->fetchAll(
      $this->contentDatabase,
      "SELECT a.id, a.name, a.description, a.icon_id, a.points,
        a.reward_display, a.world_display_flag, a.definition_version,
        a.reset_on_version_change, a.enabled
       FROM achievements a" . $contentFilter['sql'] . "
       ORDER BY a.enabled DESC, a.name ASC, a.id ASC",
      $contentFilter['types'],
      $contentFilter['params'],
      'character achievement definition inputs'
    );

    $associationFilter = $this->buildInFilter('association.achievement_id', $achievementIds);
    $associations = $this->fetchAll(
      $this->contentDatabase,
      "SELECT association.achievement_id, association.category_id,
        association.sequence, association.display_text,
        category.parent_id, category.name AS category_name,
        category.description AS category_description,
        category.icon AS category_icon
       FROM achievement_category_associations association
       INNER JOIN achievement_categories category ON category.id = association.category_id" .
        $associationFilter['sql'] . "
       ORDER BY association.achievement_id, association.sequence, association.category_id",
      $associationFilter['types'],
      $associationFilter['params'],
      'character achievement category inputs'
    );

    $componentFilter = $this->buildInFilter('component.achievement_id', $achievementIds);
    $components = $this->fetchAll(
      $this->contentDatabase,
      "SELECT component.achievement_id, component.component_type,
        component.sequence, component.component_id, component.description,
        component.description_2,
        COALESCE(component_count.required_count, 1) AS presentation_count
       FROM achievement_components component
       LEFT JOIN achievement_component_counts component_count
         ON component_count.component_id = component.component_id" .
        $componentFilter['sql'] . "
       ORDER BY component.achievement_id, component.component_type,
        component.sequence, component.component_id",
      $componentFilter['types'],
      $componentFilter['params'],
      'character achievement component inputs'
    );

    $criterionFilter = $this->buildInFilter('criterion.achievement_id', $achievementIds);
    $criteria = $this->fetchAll(
      $this->contentDatabase,
      "SELECT criterion.id, criterion.achievement_id,
        criterion.component_type, criterion.component_sequence,
        criterion.component_id, criterion.event_type,
        criterion.progress_mode, criterion.behavior, criterion.target_id,
        criterion.target_id2, criterion.target_value,
        criterion.required_count, criterion.enabled
       FROM achievement_criteria criterion" . $criterionFilter['sql'] . "
       ORDER BY criterion.achievement_id, criterion.component_type,
        criterion.component_sequence, criterion.component_id, criterion.id",
      $criterionFilter['types'],
      $criterionFilter['params'],
      'character achievement criterion inputs'
    );

    $rewardFilter = $this->buildInFilter('reward.achievement_id', $achievementIds);
    $rewards = $this->fetchAll(
      $this->contentDatabase,
      "SELECT reward.reward_id, reward.achievement_id, reward.sequence,
        reward.reward_type, reward.reward_data_id, reward.amount,
        reward.description, reward.enabled
       FROM achievement_rewards reward" . $rewardFilter['sql'] . "
       ORDER BY reward.achievement_id, reward.sequence, reward.reward_id",
      $rewardFilter['types'],
      $rewardFilter['params'],
      'character achievement reward inputs'
    );

    $rewardSetFilter = $this->buildInFilter('reward_set.achievement_id', $achievementIds);
    $rewardSets = $this->fetchAll(
      $this->contentDatabase,
      "SELECT reward_set.reward_set_id, reward_set.achievement_id,
        reward_set.title, reward_set.enabled
       FROM achievement_reward_sets reward_set" . $rewardSetFilter['sql'] . "
       ORDER BY reward_set.achievement_id, reward_set.reward_set_id",
      $rewardSetFilter['types'],
      $rewardSetFilter['params'],
      'character achievement reward set inputs'
    );

    $optionFilter = $this->buildInFilter('reward_set.achievement_id', $achievementIds);
    $rewardOptions = $this->fetchAll(
      $this->contentDatabase,
      "SELECT option_row.reward_set_id, reward_set.achievement_id,
        option_row.option_id, option_row.sequence, option_row.label,
        option_row.common_to_all, option_row.flags, option_row.enabled
       FROM achievement_reward_options option_row
       INNER JOIN achievement_reward_sets reward_set
         ON reward_set.reward_set_id = option_row.reward_set_id" .
        $optionFilter['sql'] . "
       ORDER BY reward_set.achievement_id, option_row.reward_set_id,
        option_row.sequence, option_row.option_id",
      $optionFilter['types'],
      $optionFilter['params'],
      'character achievement reward option inputs'
    );

    $entryFilter = $this->buildInFilter('reward_set.achievement_id', $achievementIds);
    $rewardOptionEntries = $this->fetchAll(
      $this->contentDatabase,
      "SELECT option_entry.reward_set_id, reward_set.achievement_id,
        option_entry.option_id, option_entry.reward_id
       FROM achievement_reward_option_entries option_entry
       INNER JOIN achievement_reward_sets reward_set
         ON reward_set.reward_set_id = option_entry.reward_set_id" .
        $entryFilter['sql'] . "
       ORDER BY reward_set.achievement_id, option_entry.reward_set_id,
        option_entry.option_id, option_entry.reward_id",
      $entryFilter['types'],
      $entryFilter['params'],
      'character achievement reward mapping inputs'
    );

    $stateFilter = $this->buildInFilter('achievement_id', $achievementIds, ' AND ');
    $stateParams = array_merge(array($characterId), $stateFilter['params']);
    $stateTypes = 'i' . $stateFilter['types'];

    $completions = $this->fetchAll(
      $this->characterDatabase,
      "SELECT character_id, achievement_id, definition_version, completed_at
       FROM character_achievements
       WHERE character_id = ?" . $stateFilter['sql'] . "
       ORDER BY achievement_id",
      $stateTypes,
      $stateParams,
      'character achievement completion inputs'
    );
    $progress = $this->fetchAll(
      $this->characterDatabase,
      "SELECT character_id, achievement_id, component_type,
        component_sequence, component_id, current_count, completed,
        definition_version, updated_at
       FROM character_achievement_progress
       WHERE character_id = ?" . $stateFilter['sql'] . "
       ORDER BY achievement_id, component_type, component_sequence, component_id",
      $stateTypes,
      $stateParams,
      'character achievement progress inputs'
    );
    $rewardLedgers = $this->fetchAll(
      $this->characterDatabase,
      "SELECT character_id, achievement_id, reward_id, status,
        attempt_count, granted_at, last_attempt_at, last_error
       FROM character_achievement_rewards
       WHERE character_id = ?" . $stateFilter['sql'] . "
       ORDER BY achievement_id, reward_id",
      $stateTypes,
      $stateParams,
      'character achievement reward ledger inputs'
    );
    $rewardSelections = $this->fetchAll(
      $this->characterDatabase,
      "SELECT character_id, achievement_id, reward_set_id,
        selected_option_id, status, attempt_count, claimed_at,
        last_attempt_at, last_error
       FROM character_achievement_reward_selections
       WHERE character_id = ?" . $stateFilter['sql'] . "
       ORDER BY achievement_id, reward_set_id",
      $stateTypes,
      $stateParams,
      'character achievement reward selection inputs'
    );
    $pendingMutations = $this->fetchAll(
      $this->characterDatabase,
      "SELECT mutation_id, character_id, source_target_type,
        source_target_id, operation, achievement_id, component_type,
        component_id, requested_value, definition_version, status,
        attempt_count, created_at, last_attempt_at, last_error
       FROM character_achievement_pending_mutations
       WHERE character_id = ?" . $stateFilter['sql'] . "
       ORDER BY achievement_id, mutation_id",
      $stateTypes,
      $stateParams,
      'character achievement pending mutation inputs'
    );

    return array(
      'character' => $character,
      'definitions' => $definitions,
      'associations' => $associations,
      'components' => $components,
      'criteria' => $criteria,
      'rewards' => $rewards,
      'reward_sets' => $rewardSets,
      'reward_options' => $rewardOptions,
      'reward_option_entries' => $rewardOptionEntries,
      'completions' => $completions,
      'progress' => $progress,
      'reward_ledgers' => $rewardLedgers,
      'reward_selections' => $rewardSelections,
      'pending_mutations' => $pendingMutations
    );
  }

  /**
   * Return durable character state whose achievement definition no longer
   * exists in the content database. The split-database comparison is done in
   * two small ID phases and never hydrates the full definition graph.
   */
  public function characterOrphanState($characterId)
  {
    $characterId = $this->normalizeUnsignedInteger(
      $characterId,
      'Character ID',
      self::UINT32_MAX,
      false
    );
    $character = $this->fetchOne(
      $this->characterDatabase,
      "SELECT id, account_id, name, level, class, ingame, last_login, deleted_at
       FROM character_data WHERE id = ? LIMIT 1",
      'i',
      array($characterId),
      'orphan character achievement character detail'
    );
    if (!$character) {
      throw new CharacterAchievementValidationException('Character not found.');
    }

    $stateIdRows = $this->fetchAll(
      $this->characterDatabase,
      "SELECT achievement_id FROM character_achievements WHERE character_id = ?
       UNION
       SELECT achievement_id FROM character_achievement_progress WHERE character_id = ?
       UNION
       SELECT achievement_id FROM character_achievement_rewards WHERE character_id = ?
       UNION
       SELECT achievement_id FROM character_achievement_reward_selections WHERE character_id = ?
       UNION
       SELECT achievement_id FROM character_achievement_pending_mutations WHERE character_id = ?
       ORDER BY achievement_id",
      'iiiii',
      array($characterId, $characterId, $characterId, $characterId, $characterId),
      'orphan character achievement state identities'
    );
    $stateIds = array();
    foreach ($stateIdRows as $row) {
      $id = (int) $row['achievement_id'];
      if ($id > 0) {
        $stateIds[(string) $id] = $id;
      }
    }

    $definedIds = array();
    foreach (array_chunk(array_values($stateIds), self::MAX_DETAIL_ACHIEVEMENT_IDS) as $idChunk) {
      if (empty($idChunk)) {
        continue;
      }
      $definitionRows = $this->fetchAll(
        $this->contentDatabase,
        "SELECT id FROM achievements WHERE id IN (" .
          $this->placeholders(count($idChunk)) . ")",
        str_repeat('i', count($idChunk)),
        $idChunk,
        'orphan character achievement definition identities'
      );
      foreach ($definitionRows as $row) {
        $definedIds[(string) ((int) $row['id'])] = true;
      }
    }

    $orphanIds = array();
    foreach ($stateIds as $id) {
      if (!isset($definedIds[(string) $id])) {
        $orphanIds[] = $id;
      }
    }

    return array(
      'character' => $character,
      'achievement_ids' => $orphanIds,
      'completions' => $this->characterStateRowsForIds(
        'completions',
        $characterId,
        $orphanIds
      ),
      'progress' => $this->characterStateRowsForIds(
        'progress',
        $characterId,
        $orphanIds
      ),
      'reward_ledgers' => $this->characterStateRowsForIds(
        'reward_ledgers',
        $characterId,
        $orphanIds
      ),
      'reward_selections' => $this->characterStateRowsForIds(
        'reward_selections',
        $characterId,
        $orphanIds
      ),
      'pending_mutations' => $this->characterStateRowsForIds(
        'pending_mutations',
        $characterId,
        $orphanIds
      )
    );
  }

  /**
   * Set one component to an exact, clamped count. This does not directly
   * create durable achievement completion; the server reconciles completion.
   */
  public function setExactProgress(
    $characterId,
    $achievementId,
    $componentType,
    $componentId,
    $requestedCount
  ) {
    $characterId = $this->normalizeUnsignedInteger($characterId, 'Character ID', self::UINT32_MAX, false);
    $achievementId = $this->normalizeUnsignedInteger($achievementId, 'Achievement ID', self::UINT32_MAX, false);
    $componentType = $this->normalizeUnsignedInteger($componentType, 'Component type', 255);
    $componentId = $this->normalizeUnsignedInteger($componentId, 'Component ID', self::UINT32_MAX);
    $requestedCount = $this->normalizeUnsignedInteger($requestedCount, 'Current count', self::UINT32_MAX);

    if (
      $componentType < self::COMPONENT_TYPE_MIN ||
      $componentType > self::COMPONENT_TYPE_MAX_STATE_BEARING
    ) {
      throw new CharacterAchievementValidationException(
        'Only state-bearing component types 0 through 2 can store progress.'
      );
    }

    return $this->withCharacterMutation($characterId, function () use (
      $characterId,
      $achievementId,
      $componentType,
      $componentId,
      $requestedCount
    ) {
      $this->lockCharacter(
        $characterId,
        true,
        'Exact achievement progress edits are offline-only because the zone server caches character progress. Log the character out before continuing.'
      );
      $definition = $this->loadDefinition($achievementId, true, true);
      $policy = $this->loadComponentPolicy($achievementId, $componentType, $componentId);

      $completion = $this->fetchOne(
        $this->characterDatabase,
        "SELECT definition_version FROM character_achievements
         WHERE character_id = ? AND achievement_id = ? FOR UPDATE",
        'ii',
        array($characterId, $achievementId),
        'lock completed character achievement'
      );
      if ($completion) {
        throw new CharacterAchievementValidationException(
          'Completed achievements cannot receive component progress. Reset it first.'
        );
      }

      $progress = $this->fetchOne(
        $this->characterDatabase,
        "SELECT definition_version FROM character_achievement_progress
         WHERE character_id = ? AND achievement_id = ?
           AND component_type = ? AND component_id = ? FOR UPDATE",
        'iiii',
        array($characterId, $achievementId, $componentType, $componentId),
        'lock character achievement progress'
      );
      if (
        $progress &&
        (int) $progress['definition_version'] !== (int) $definition['definition_version']
      ) {
        throw new CharacterAchievementValidationException(
          'The stored progress belongs to a different definition version. Reset the achievement before editing this component.'
        );
      }

      $requiredCount = $policy['required_count'];
      $currentCount = min($requestedCount, $requiredCount);
      $completed = $currentCount >= $requiredCount ? 1 : 0;
      $now = time();

      if ($progress) {
        $this->execute(
          $this->characterDatabase,
          "UPDATE character_achievement_progress
           SET component_sequence = ?, current_count = ?, completed = ?,
             definition_version = ?, updated_at = ?
           WHERE character_id = ? AND achievement_id = ?
             AND component_type = ? AND component_id = ?",
          'iiiiiiiii',
          array(
            $policy['sequence'],
            $currentCount,
            $completed,
            (int) $definition['definition_version'],
            $now,
            $characterId,
            $achievementId,
            $componentType,
            $componentId
          ),
          'update exact character achievement progress'
        );
      }
      else {
        $this->execute(
          $this->characterDatabase,
          "INSERT INTO character_achievement_progress
            (character_id, achievement_id, component_type,
             component_sequence, component_id, current_count, completed,
             definition_version, updated_at)
           VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)",
          'iiiiiiiii',
          array(
            $characterId,
            $achievementId,
            $componentType,
            $policy['sequence'],
            $componentId,
            $currentCount,
            $completed,
            (int) $definition['definition_version'],
            $now
          ),
          'insert exact character achievement progress'
        );
      }

      return array(
        'requested_count' => $requestedCount,
        'current_count' => $currentCount,
        'required_count' => $requiredCount,
        'completed' => (bool) $completed,
        'definition_version' => (int) $definition['definition_version']
      );
    });
  }

  /**
   * Write durable completion for an offline character. Reward delivery,
   * dependency processing, and earned notification remain server-owned.
   */
  public function forceCompleteOffline($characterId, $achievementId, $confirmed)
  {
    $this->requireConfirmation(
      $confirmed,
      'You must acknowledge the offline-completion warning.'
    );
    $characterId = $this->normalizeUnsignedInteger($characterId, 'Character ID', self::UINT32_MAX, false);
    $achievementId = $this->normalizeUnsignedInteger($achievementId, 'Achievement ID', self::UINT32_MAX, false);

    return $this->withCharacterMutation($characterId, function () use ($characterId, $achievementId) {
      $this->lockCharacter(
        $characterId,
        true,
        'Force-completion is offline-only. Log the character out before continuing.'
      );
      $definition = $this->loadDefinition($achievementId, true, true);
      $completion = $this->fetchOne(
        $this->characterDatabase,
        "SELECT definition_version FROM character_achievements
         WHERE character_id = ? AND achievement_id = ? FOR UPDATE",
        'ii',
        array($characterId, $achievementId),
        'lock forced character achievement completion'
      );
      if ($completion) {
        throw new CharacterAchievementValidationException(
          'This character has already completed the achievement.'
        );
      }

      $completedAt = time();
      $this->execute(
        $this->characterDatabase,
        "INSERT INTO character_achievements
          (character_id, achievement_id, definition_version, completed_at)
         VALUES (?, ?, ?, ?)",
        'iiii',
        array(
          $characterId,
          $achievementId,
          (int) $definition['definition_version'],
          $completedAt
        ),
        'force offline character achievement completion'
      );

      return array(
        'definition_version' => (int) $definition['definition_version'],
        'completed_at' => $completedAt
      );
    });
  }

  /**
   * Reset progress and completion. Reward ledgers are preserved unless both
   * resetRewardLedgers and confirmRewardLedgerReset are explicitly true.
   */
  public function reset(
    $characterId,
    $achievementId,
    $confirmed,
    $resetRewardLedgers = false,
    $confirmRewardLedgerReset = false
  ) {
    $this->requireConfirmation(
      $confirmed,
      'You must explicitly confirm the achievement-state reset.'
    );
    if ($resetRewardLedgers) {
      $this->requireConfirmation(
        $confirmRewardLedgerReset,
        'Reward-ledger reset requires a separate acknowledgement that recompletion can grant rewards again.'
      );
    }

    $characterId = $this->normalizeUnsignedInteger($characterId, 'Character ID', self::UINT32_MAX, false);
    $achievementId = $this->normalizeUnsignedInteger($achievementId, 'Achievement ID', self::UINT32_MAX, false);
    $resetRewardLedgers = (bool) $resetRewardLedgers;

    return $this->withCharacterMutation($characterId, function () use (
      $characterId,
      $achievementId,
      $resetRewardLedgers
    ) {
      $this->lockCharacter(
        $characterId,
        true,
        'Achievement reset is offline-only because the zone server caches character progress and reward state. Log the character out before continuing.'
      );
      if (!$this->achievementDefinitionOrStateExists($characterId, $achievementId)) {
        throw new CharacterAchievementValidationException(
          'No achievement definition or durable character state exists for this achievement ID.'
        );
      }

      $deleted = array(
        'pending_mutations' => $this->deleteCharacterAchievementRows(
          'character_achievement_pending_mutations',
          $characterId,
          $achievementId
        ),
        'progress' => $this->deleteCharacterAchievementRows(
          'character_achievement_progress',
          $characterId,
          $achievementId
        ),
        'reward_selections' => 0,
        'rewards' => 0,
        'completion' => 0
      );

      if ($resetRewardLedgers) {
        $deleted['reward_selections'] = $this->deleteCharacterAchievementRows(
          'character_achievement_reward_selections',
          $characterId,
          $achievementId
        );
        $deleted['rewards'] = $this->deleteCharacterAchievementRows(
          'character_achievement_rewards',
          $characterId,
          $achievementId
        );
      }

      // Completion is deliberately deleted last. An interrupted reset remains
      // discoverable and can be reconciled by the server on the next login.
      $deleted['completion'] = $this->deleteCharacterAchievementRows(
        'character_achievements',
        $characterId,
        $achievementId
      );

      return $deleted;
    });
  }

  /**
   * Mark one non-granted reward ledger retryable after explicit acceptance of
   * duplicate-delivery risk.
   */
  public function markRewardRetryable(
    $characterId,
    $achievementId,
    $rewardId,
    $acceptDuplicateRisk
  ) {
    $this->requireConfirmation(
      $acceptDuplicateRisk,
      'You must explicitly accept the duplicate-delivery risk before retrying this reward.'
    );
    $characterId = $this->normalizeUnsignedInteger($characterId, 'Character ID', self::UINT32_MAX, false);
    $achievementId = $this->normalizeUnsignedInteger($achievementId, 'Achievement ID', self::UINT32_MAX, false);
    $rewardId = $this->normalizePositiveInteger($rewardId, 'Reward ID');

    return $this->withCharacterMutation($characterId, function () use (
      $characterId,
      $achievementId,
      $rewardId
    ) {
      $this->lockCharacter(
        $characterId,
        true,
        'Reward retry changes are offline-only to prevent a cached live delivery from racing this repair. Log the character out before continuing.'
      );
      $this->loadDefinition($achievementId, false, true);
      if (!$this->contentRecordBelongsToAchievement(
        'achievement_rewards',
        'reward_id',
        $rewardId,
        $achievementId
      )) {
        throw new CharacterAchievementValidationException(
          'The requested reward does not belong to this achievement.'
        );
      }

      $ledger = $this->fetchOne(
        $this->characterDatabase,
        "SELECT status FROM character_achievement_rewards
         WHERE character_id = ? AND achievement_id = ? AND reward_id = ?
         FOR UPDATE",
        'iii',
        array($characterId, $achievementId, $rewardId),
        'lock character achievement reward ledger'
      );
      if (!$ledger) {
        throw new CharacterAchievementValidationException(
          'The character does not own this reward ledger.'
        );
      }

      $status = (int) $ledger['status'];
      if ($status === self::REWARD_STATUS_GRANTED) {
        throw new CharacterAchievementValidationException(
          'A granted reward cannot be marked retryable. Use an explicit reward-ledger reset if re-granting is intended.'
        );
      }
      if (!in_array($status, array(
        self::REWARD_STATUS_IN_FLIGHT,
        self::REWARD_STATUS_RETRYABLE_FAILURE
      ), true)) {
        throw new CharacterAchievementValidationException(
          'Only an in-flight or explicitly failed reward can be marked retryable.'
        );
      }

      $this->execute(
        $this->characterDatabase,
        "UPDATE character_achievement_rewards
         SET status = ?, last_error = ?
         WHERE character_id = ? AND achievement_id = ? AND reward_id = ?",
        'isiii',
        array(
          self::REWARD_STATUS_RETRYABLE_FAILURE,
          'manually marked retryable; duplicate-delivery risk explicitly accepted',
          $characterId,
          $achievementId,
          $rewardId
        ),
        'mark character achievement reward retryable'
      );

      return true;
    });
  }

  /**
   * Mark one selected reward bundle retryable after explicit duplicate-risk
   * acceptance. An unselected pending choice is already retryable and is not
   * altered.
   */
  public function markSelectionRetryable(
    $characterId,
    $achievementId,
    $rewardSetId,
    $acceptDuplicateRisk
  ) {
    $this->requireConfirmation(
      $acceptDuplicateRisk,
      'You must explicitly accept the duplicate-delivery risk before retrying this reward selection.'
    );
    $characterId = $this->normalizeUnsignedInteger($characterId, 'Character ID', self::UINT32_MAX, false);
    $achievementId = $this->normalizeUnsignedInteger($achievementId, 'Achievement ID', self::UINT32_MAX, false);
    $rewardSetId = $this->normalizeUnsignedInteger($rewardSetId, 'Reward set ID', self::UINT32_MAX, false);

    return $this->withCharacterMutation($characterId, function () use (
      $characterId,
      $achievementId,
      $rewardSetId
    ) {
      $this->lockCharacter(
        $characterId,
        true,
        'Reward-selection retry changes are offline-only to prevent a cached live delivery from racing this repair. Log the character out before continuing.'
      );
      $this->loadDefinition($achievementId, false, true);
      if (!$this->contentRecordBelongsToAchievement(
        'achievement_reward_sets',
        'reward_set_id',
        $rewardSetId,
        $achievementId
      )) {
        throw new CharacterAchievementValidationException(
          'The requested reward set does not belong to this achievement.'
        );
      }

      $selection = $this->fetchOne(
        $this->characterDatabase,
        "SELECT selected_option_id, status
         FROM character_achievement_reward_selections
         WHERE character_id = ? AND achievement_id = ? AND reward_set_id = ?
         FOR UPDATE",
        'iii',
        array($characterId, $achievementId, $rewardSetId),
        'lock character achievement reward selection'
      );
      if (!$selection) {
        throw new CharacterAchievementValidationException(
          'The character does not own this reward-selection ledger.'
        );
      }

      $status = (int) $selection['status'];
      $selectedOptionId = (int) $selection['selected_option_id'];
      if ($status === self::SELECTION_STATUS_GRANTED) {
        throw new CharacterAchievementValidationException(
          'A fully granted selection cannot be marked retryable. Use an explicit reward-ledger reset if re-granting is intended.'
        );
      }
      if ($status === self::SELECTION_STATUS_PENDING && $selectedOptionId === 0) {
        throw new CharacterAchievementValidationException(
          'An unselected reward is already pending and does not need a retry override.'
        );
      }
      if (!in_array($status, array(
        self::SELECTION_STATUS_PENDING,
        self::SELECTION_STATUS_RETRYABLE_FAILURE,
        self::SELECTION_STATUS_AMBIGUOUS
      ), true)) {
        throw new CharacterAchievementValidationException(
          'Only an in-flight, failed, or ambiguous selection can be marked retryable.'
        );
      }

      $this->execute(
        $this->characterDatabase,
        "UPDATE character_achievement_reward_selections
         SET status = ?, last_error = ?
         WHERE character_id = ? AND achievement_id = ? AND reward_set_id = ?",
        'isiii',
        array(
          self::SELECTION_STATUS_RETRYABLE_FAILURE,
          'manually marked retryable; duplicate-delivery risk explicitly accepted',
          $characterId,
          $achievementId,
          $rewardSetId
        ),
        'mark character achievement reward selection retryable'
      );

      return true;
    });
  }

  /**
   * Return a blocked queued mutation to pending without changing its stored
   * definition version. Version mismatches remain blocked by design.
   */
  public function retryBlockedMutation($characterId, $achievementId, $mutationId)
  {
    $characterId = $this->normalizeUnsignedInteger($characterId, 'Character ID', self::UINT32_MAX, false);
    $achievementId = $this->normalizeUnsignedInteger($achievementId, 'Achievement ID', self::UINT32_MAX, false);
    $mutationId = $this->normalizePositiveInteger($mutationId, 'Mutation ID');

    return $this->withCharacterMutation($characterId, function () use (
      $characterId,
      $achievementId,
      $mutationId
    ) {
      $this->lockCharacter($characterId, false);
      $definition = $this->loadDefinition($achievementId, true, true);
      $mutation = $this->fetchOne(
        $this->characterDatabase,
        "SELECT definition_version, status
         FROM character_achievement_pending_mutations
         WHERE mutation_id = ? AND character_id = ? AND achievement_id = ?
         FOR UPDATE",
        'iii',
        array($mutationId, $characterId, $achievementId),
        'lock character achievement pending mutation'
      );
      if (!$mutation) {
        throw new CharacterAchievementValidationException(
          'The queued mutation does not belong to this character and achievement.'
        );
      }
      if ((int) $mutation['status'] !== self::MUTATION_STATUS_BLOCKED) {
        throw new CharacterAchievementValidationException(
          'Only a blocked mutation can be manually retried.'
        );
      }

      $mutationVersion = (int) $mutation['definition_version'];
      $currentVersion = (int) $definition['definition_version'];
      if ($mutationVersion !== 0 && $mutationVersion !== $currentVersion) {
        throw new CharacterAchievementValidationException(
          'The queued mutation targets definition version ' . $mutationVersion .
          ', but the current definition is version ' . $currentVersion .
          '. The mutation remains blocked.'
        );
      }

      $this->execute(
        $this->characterDatabase,
        "UPDATE character_achievement_pending_mutations
         SET status = ?, last_attempt_at = 0, last_error = ''
         WHERE mutation_id = ? AND character_id = ? AND achievement_id = ?",
        'iiii',
        array(self::MUTATION_STATUS_PENDING, $mutationId, $characterId, $achievementId),
        'retry blocked character achievement mutation'
      );

      return true;
    });
  }

  /**
   * Permanently discard a queued mutation after explicit confirmation.
   */
  public function discardMutation(
    $characterId,
    $achievementId,
    $mutationId,
    $confirmed
  ) {
    $this->requireConfirmation(
      $confirmed,
      'You must explicitly confirm that this queued mutation should be discarded.'
    );
    $characterId = $this->normalizeUnsignedInteger($characterId, 'Character ID', self::UINT32_MAX, false);
    $achievementId = $this->normalizeUnsignedInteger($achievementId, 'Achievement ID', self::UINT32_MAX, false);
    $mutationId = $this->normalizePositiveInteger($mutationId, 'Mutation ID');

    return $this->withCharacterMutation($characterId, function () use (
      $characterId,
      $achievementId,
      $mutationId
    ) {
      $this->lockCharacter($characterId, false);
      $mutation = $this->fetchOne(
        $this->characterDatabase,
        "SELECT mutation_id, status FROM character_achievement_pending_mutations
         WHERE mutation_id = ? AND character_id = ? AND achievement_id = ?
         FOR UPDATE",
        'iii',
        array($mutationId, $characterId, $achievementId),
        'lock discarded character achievement mutation'
      );
      if (!$mutation) {
        throw new CharacterAchievementValidationException(
          'The queued mutation does not belong to this character and achievement.'
        );
      }
      $status = (int) $mutation['status'];
      if (!in_array($status, array(
        self::MUTATION_STATUS_PENDING,
        self::MUTATION_STATUS_BLOCKED
      ), true)) {
        throw new CharacterAchievementValidationException(
          'A mutation marked as processing cannot be discarded. Let the zone server finish or return it to a stable pending/blocked state first.'
        );
      }

      $this->execute(
        $this->characterDatabase,
        "DELETE FROM character_achievement_pending_mutations
         WHERE mutation_id = ? AND character_id = ? AND achievement_id = ?
           AND status IN (?, ?)",
        'iiiii',
        array(
          $mutationId,
          $characterId,
          $achievementId,
          self::MUTATION_STATUS_PENDING,
          self::MUTATION_STATUS_BLOCKED
        ),
        'discard character achievement mutation'
      );

      return true;
    });
  }

  private function assertDatabaseConnection($database, $label)
  {
    if (
      !is_object($database) ||
      !method_exists($database, 'prepare') ||
      !method_exists($database, 'begin_transaction')
    ) {
      throw new InvalidArgumentException(
        'The ' . $label . ' achievement database must be a mysqli-compatible connection.'
      );
    }
  }

  private function inspectSchema($database, array $spec, $label, $operation)
  {
    $tableNames = array_keys($spec);
    $databaseRow = $this->fetchOne(
      $database,
      "SELECT DATABASE() AS database_name",
      '',
      array(),
      $operation . ' database name'
    );
    $databaseName = $databaseRow && isset($databaseRow['database_name'])
      ? (string) $databaseRow['database_name']
      : '';

    $tableRows = $this->fetchAll(
      $database,
      "SELECT TABLE_NAME, ENGINE
       FROM information_schema.TABLES
       WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME IN (" .
        $this->placeholders(count($tableNames)) . ")",
      str_repeat('s', count($tableNames)),
      $tableNames,
      $operation . ' tables'
    );
    $tablesByName = array();
    foreach ($tableRows as $row) {
      $tablesByName[$row['TABLE_NAME']] = $row;
    }

    $columnRows = $this->fetchAll(
      $database,
      "SELECT TABLE_NAME, COLUMN_NAME, DATA_TYPE, COLUMN_TYPE, IS_NULLABLE,
        CHARACTER_MAXIMUM_LENGTH, EXTRA
       FROM information_schema.COLUMNS
       WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME IN (" .
        $this->placeholders(count($tableNames)) . ")
       ORDER BY TABLE_NAME, ORDINAL_POSITION",
      str_repeat('s', count($tableNames)),
      $tableNames,
      $operation . ' columns'
    );
    $columnsByTable = array();
    foreach ($columnRows as $row) {
      $columnsByTable[$row['TABLE_NAME']][$row['COLUMN_NAME']] = $row;
    }

    $indexRows = $this->fetchAll(
      $database,
      "SELECT TABLE_NAME, INDEX_NAME, NON_UNIQUE, SEQ_IN_INDEX, COLUMN_NAME, SUB_PART
       FROM information_schema.STATISTICS
       WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME IN (" .
        $this->placeholders(count($tableNames)) . ")
       ORDER BY TABLE_NAME, INDEX_NAME, SEQ_IN_INDEX",
      str_repeat('s', count($tableNames)),
      $tableNames,
      $operation . ' indexes'
    );
    $indexesByTable = array();
    foreach ($indexRows as $row) {
      $table = $row['TABLE_NAME'];
      $index = $row['INDEX_NAME'];
      if (!isset($indexesByTable[$table][$index])) {
        $indexesByTable[$table][$index] = array(
          'unique' => ((int) $row['NON_UNIQUE'] === 0),
          'columns' => array(),
          'full_columns' => true
        );
      }
      $indexesByTable[$table][$index]['columns'][] = $row['COLUMN_NAME'];
      if ($row['COLUMN_NAME'] === null || $row['SUB_PART'] !== null) {
        $indexesByTable[$table][$index]['full_columns'] = false;
      }
    }

    $columnShapeSpec = $this->schemaColumnShapeSpec();
    $errors = array();
    $missing = array();
    $tableDiagnostics = array();
    foreach ($spec as $table => $requirements) {
      $exists = isset($tablesByName[$table]);
      $engine = $exists ? (string) $tablesByName[$table]['ENGINE'] : null;
      $missingColumns = array();
      $columnMismatches = array();
      $missingIndexes = array();

      if (!$exists) {
        $missing[] = $table;
        $errors[] = $label . ' table ' . $table . ' is missing.';
      }
      else {
        if (strcasecmp($engine, 'InnoDB') !== 0) {
          $errors[] = $label . ' table ' . $table .
            ' must use InnoDB for safe transactions and row locks.';
        }

        foreach ($requirements['columns'] as $column) {
          if (!isset($columnsByTable[$table][$column])) {
            $missingColumns[] = $column;
            $errors[] = $label . ' table ' . $table .
              ' is missing required column ' . $column . '.';
            continue;
          }

          $shape = $this->columnShapeRequirement($columnShapeSpec, $table, $column);
          if ($shape !== null) {
            $actualDataType = strtolower((string) $columnsByTable[$table][$column]['DATA_TYPE']);
            if (!in_array($actualDataType, $shape['types'], true)) {
              $expectedTypes = strtoupper(implode(' or ', $shape['types']));
              $columnMismatches[] = $column . ' must use ' . $expectedTypes;
              $errors[] = $label . ' column ' . $table . '.' . $column .
                ' must use ' . $expectedTypes . '; found ' .
                (string) $columnsByTable[$table][$column]['COLUMN_TYPE'] . '.';
            }
            if (
              empty($shape['nullable']) &&
              strtoupper((string) $columnsByTable[$table][$column]['IS_NULLABLE']) !== 'NO'
            ) {
              $columnMismatches[] = $column . ' must be NOT NULL';
              $errors[] = $label . ' column ' . $table . '.' . $column .
                ' must be NOT NULL.';
            }
            if (
              isset($shape['minimum_length']) &&
              (int) $columnsByTable[$table][$column]['CHARACTER_MAXIMUM_LENGTH'] <
                (int) $shape['minimum_length']
            ) {
              $columnMismatches[] = $column . ' must allow at least ' .
                (int) $shape['minimum_length'] . ' characters';
              $errors[] = $label . ' column ' . $table . '.' . $column .
                ' must allow at least ' . (int) $shape['minimum_length'] .
                ' characters.';
            }
            if (
              !empty($shape['signed']) &&
              stripos($columnsByTable[$table][$column]['COLUMN_TYPE'], 'unsigned') !== false
            ) {
              $columnMismatches[] = $column . ' must support signed values';
              $errors[] = $label . ' column ' . $table . '.' . $column .
                ' must be signed so negative values remain representable.';
            }
          }
        }
        foreach ($requirements['unsigned'] as $column) {
          if (
            isset($columnsByTable[$table][$column]) &&
            stripos($columnsByTable[$table][$column]['COLUMN_TYPE'], 'unsigned') === false
          ) {
            $columnMismatches[] = $column . ' must be unsigned';
            $errors[] = $label . ' column ' . $table . '.' . $column .
              ' must be unsigned.';
          }
        }
        foreach ($requirements['auto_increment'] as $column) {
          if (
            isset($columnsByTable[$table][$column]) &&
            stripos($columnsByTable[$table][$column]['EXTRA'], 'auto_increment') === false
          ) {
            $columnMismatches[] = $column . ' must auto increment';
            $errors[] = $label . ' column ' . $table . '.' . $column .
              ' must be AUTO_INCREMENT.';
          }
        }
        foreach ($requirements['indexes'] as $requiredIndex) {
          if (!$this->hasMatchingIndex(
            isset($indexesByTable[$table]) ? $indexesByTable[$table] : array(),
            $requiredIndex['columns'],
            $requiredIndex['unique']
          )) {
            $description = ($requiredIndex['unique'] ? 'unique ' : '') .
              '(' . implode(', ', $requiredIndex['columns']) . ')';
            $missingIndexes[] = $description;
            $errors[] = $label . ' table ' . $table .
              ' is missing required ' . $description . ' identity/index.';
          }
        }
      }

      $tableDiagnostics[$table] = array(
        'exists' => $exists,
        'engine' => $engine,
        'engine_ok' => $exists && strcasecmp($engine, 'InnoDB') === 0,
        'missing_columns' => $missingColumns,
        'column_mismatches' => $columnMismatches,
        'missing_indexes' => $missingIndexes
      );
    }

    return array(
      'ready' => empty($errors),
      'database' => $databaseName,
      'missing' => $missing,
      'errors' => $errors,
      'tables' => $tableDiagnostics
    );
  }

  private function characterSchemaSpec()
  {
    return array(
      'character_data' => array(
        'columns' => array(
          'id', 'account_id', 'name', 'level', 'class', 'ingame',
          'last_login', 'deleted_at'
        ),
        'unsigned' => array('id'),
        'auto_increment' => array(),
        'indexes' => array(
          array('columns' => array('id'), 'unique' => true)
        )
      ),
      'character_achievements' => array(
        'columns' => array(
          'character_id', 'achievement_id', 'definition_version', 'completed_at'
        ),
        'unsigned' => array(
          'character_id', 'achievement_id', 'definition_version', 'completed_at'
        ),
        'auto_increment' => array(),
        'indexes' => array(
          array('columns' => array('character_id', 'achievement_id'), 'unique' => true),
          array('columns' => array('achievement_id', 'character_id'), 'unique' => false)
        )
      ),
      'character_achievement_progress' => array(
        'columns' => array(
          'character_id', 'achievement_id', 'component_type',
          'component_sequence', 'component_id', 'current_count', 'completed',
          'definition_version', 'updated_at'
        ),
        'unsigned' => array(
          'character_id', 'achievement_id', 'component_type',
          'component_sequence', 'component_id', 'current_count', 'completed',
          'definition_version', 'updated_at'
        ),
        'auto_increment' => array(),
        'indexes' => array(
          array(
            'columns' => array(
              'character_id', 'achievement_id', 'component_type', 'component_id'
            ),
            'unique' => true
          ),
          array(
            'columns' => array(
              'achievement_id', 'component_type', 'component_sequence', 'component_id'
            ),
            'unique' => false
          )
        )
      ),
      'character_achievement_rewards' => array(
        'columns' => array(
          'character_id', 'achievement_id', 'reward_id', 'status',
          'attempt_count', 'granted_at', 'last_attempt_at', 'last_error'
        ),
        'unsigned' => array(
          'character_id', 'achievement_id', 'reward_id', 'status',
          'attempt_count', 'granted_at', 'last_attempt_at'
        ),
        'auto_increment' => array(),
        'indexes' => array(
          array(
            'columns' => array('character_id', 'achievement_id', 'reward_id'),
            'unique' => true
          ),
          array('columns' => array('status', 'character_id'), 'unique' => false)
        )
      ),
      'character_achievement_reward_selections' => array(
        'columns' => array(
          'character_id', 'achievement_id', 'reward_set_id',
          'selected_option_id', 'status', 'attempt_count', 'claimed_at',
          'last_attempt_at', 'last_error'
        ),
        'unsigned' => array(
          'character_id', 'achievement_id', 'reward_set_id',
          'selected_option_id', 'status', 'attempt_count', 'claimed_at',
          'last_attempt_at'
        ),
        'auto_increment' => array(),
        'indexes' => array(
          array(
            'columns' => array('character_id', 'achievement_id', 'reward_set_id'),
            'unique' => true
          ),
          array('columns' => array('status', 'character_id'), 'unique' => false)
        )
      ),
      'character_achievement_pending_mutations' => array(
        'columns' => array(
          'mutation_id', 'character_id', 'source_target_type',
          'source_target_id', 'operation', 'achievement_id', 'component_type',
          'component_id', 'requested_value', 'definition_version', 'status',
          'attempt_count', 'created_at', 'last_attempt_at', 'last_error'
        ),
        'unsigned' => array(
          'mutation_id', 'character_id', 'source_target_type',
          'source_target_id', 'operation', 'achievement_id', 'component_type',
          'component_id', 'requested_value', 'definition_version', 'status',
          'attempt_count', 'created_at', 'last_attempt_at'
        ),
        'auto_increment' => array('mutation_id'),
        'indexes' => array(
          array('columns' => array('mutation_id'), 'unique' => true),
          array(
            'columns' => array('character_id', 'status', 'mutation_id'),
            'unique' => false
          ),
          array('columns' => array('status', 'character_id'), 'unique' => false)
        )
      )
    );
  }

  private function contentSchemaSpec()
  {
    return array(
      'achievement_categories' => array(
        'columns' => array('id', 'parent_id', 'sequence', 'name', 'description', 'icon'),
        'unsigned' => array('id', 'parent_id', 'sequence'),
        'auto_increment' => array(),
        'indexes' => array(
          array('columns' => array('id'), 'unique' => true)
        )
      ),
      'achievements' => array(
        'columns' => array(
          'id', 'name', 'description', 'icon_id', 'points', 'reward_display',
          'world_display_flag', 'definition_version', 'reset_on_version_change',
          'enabled'
        ),
        'unsigned' => array(
          'id', 'icon_id', 'points', 'reward_display', 'world_display_flag',
          'definition_version', 'reset_on_version_change', 'enabled'
        ),
        'auto_increment' => array(),
        'indexes' => array(
          array('columns' => array('id'), 'unique' => true)
        )
      ),
      'achievement_category_associations' => array(
        'columns' => array('category_id', 'sequence', 'achievement_id', 'display_text'),
        'unsigned' => array('category_id', 'sequence', 'achievement_id'),
        'auto_increment' => array(),
        'indexes' => array(
          array('columns' => array('category_id', 'achievement_id'), 'unique' => true),
          array('columns' => array('achievement_id', 'category_id'), 'unique' => false)
        )
      ),
      'achievement_components' => array(
        'columns' => array(
          'achievement_id', 'component_type', 'sequence', 'component_id',
          'description', 'description_2'
        ),
        'unsigned' => array('achievement_id', 'component_type', 'sequence', 'component_id'),
        'auto_increment' => array(),
        'indexes' => array(
          array(
            'columns' => array('achievement_id', 'component_type', 'component_id'),
            'unique' => true
          ),
          array('columns' => array('component_id'), 'unique' => false)
        )
      ),
      'achievement_component_counts' => array(
        'columns' => array('component_id', 'required_count'),
        'unsigned' => array('component_id', 'required_count'),
        'auto_increment' => array(),
        'indexes' => array(
          array('columns' => array('component_id'), 'unique' => true)
        )
      ),
      'achievement_criteria' => array(
        'columns' => array(
          'id', 'achievement_id', 'component_type', 'component_sequence',
          'component_id', 'event_type', 'progress_mode', 'behavior',
          'target_id', 'target_id2', 'target_value', 'required_count', 'enabled'
        ),
        'unsigned' => array(
          'id', 'achievement_id', 'component_type', 'component_sequence',
          'component_id', 'event_type', 'progress_mode', 'behavior',
          'target_id', 'target_id2', 'required_count', 'enabled'
        ),
        'auto_increment' => array('id'),
        'indexes' => array(
          array('columns' => array('id'), 'unique' => true),
          array(
            'columns' => array(
              'achievement_id', 'component_type', 'component_id',
              'event_type', 'target_id', 'target_id2'
            ),
            'unique' => true
          )
        )
      ),
      'achievement_rewards' => array(
        'columns' => array(
          'reward_id', 'achievement_id', 'sequence', 'reward_type',
          'reward_data_id', 'amount', 'description', 'enabled'
        ),
        'unsigned' => array(
          'reward_id', 'achievement_id', 'sequence', 'reward_type',
          'reward_data_id', 'amount', 'enabled'
        ),
        'auto_increment' => array('reward_id'),
        'indexes' => array(
          array('columns' => array('reward_id'), 'unique' => true),
          array('columns' => array('achievement_id', 'sequence'), 'unique' => true)
        )
      ),
      'achievement_reward_sets' => array(
        'columns' => array('reward_set_id', 'achievement_id', 'title', 'enabled'),
        'unsigned' => array('reward_set_id', 'achievement_id', 'enabled'),
        'auto_increment' => array(),
        'indexes' => array(
          array('columns' => array('reward_set_id'), 'unique' => true),
          array('columns' => array('achievement_id'), 'unique' => true)
        )
      ),
      'achievement_reward_options' => array(
        'columns' => array(
          'reward_set_id', 'option_id', 'sequence', 'label',
          'common_to_all', 'flags', 'enabled'
        ),
        'unsigned' => array(
          'reward_set_id', 'option_id', 'sequence', 'common_to_all', 'flags', 'enabled'
        ),
        'auto_increment' => array(),
        'indexes' => array(
          array('columns' => array('reward_set_id', 'option_id'), 'unique' => true)
        )
      ),
      'achievement_reward_option_entries' => array(
        'columns' => array('reward_set_id', 'option_id', 'reward_id'),
        'unsigned' => array('reward_set_id', 'option_id', 'reward_id'),
        'auto_increment' => array(),
        'indexes' => array(
          array(
            'columns' => array('reward_set_id', 'option_id', 'reward_id'),
            'unique' => true
          ),
          array('columns' => array('reward_id'), 'unique' => true)
        )
      ),
      'achievement_cast_restrictions' => array(
        'columns' => array('restriction_id', 'achievement_id', 'requires_completed'),
        'unsigned' => array('restriction_id', 'achievement_id', 'requires_completed'),
        'auto_increment' => array(),
        'indexes' => array(
          array('columns' => array('restriction_id', 'achievement_id'), 'unique' => true),
          array('columns' => array('achievement_id', 'restriction_id'), 'unique' => false)
        )
      )
    );
  }

  /**
   * Base types and capacities are taken from the source achievement content
   * and state migrations. All listed columns are required to be NOT NULL.
   * Wider VARCHAR columns are accepted; undersized columns are not.
   *
   * character_data is not owned by those migrations, so only the two fields
   * used for row identity/offline locking receive exact type checks here.
   */
  private function schemaColumnShapeSpec()
  {
    return array(
      'character_data' => array(
        'int' => array('id'),
        'tinyint' => array('ingame')
      ),
      'character_achievements' => array(
        'int' => array(
          'character_id', 'achievement_id', 'definition_version', 'completed_at'
        )
      ),
      'character_achievement_progress' => array(
        'int' => array(
          'character_id', 'achievement_id', 'component_sequence', 'component_id',
          'definition_version', 'updated_at'
        ),
        'tinyint' => array('component_type', 'completed'),
        'bigint' => array('current_count')
      ),
      'character_achievement_rewards' => array(
        'int' => array(
          'character_id', 'achievement_id', 'attempt_count', 'granted_at',
          'last_attempt_at'
        ),
        'tinyint' => array('status'),
        'bigint' => array('reward_id'),
        'varchar' => array('last_error' => 255)
      ),
      'character_achievement_reward_selections' => array(
        'int' => array(
          'character_id', 'achievement_id', 'reward_set_id', 'selected_option_id',
          'attempt_count', 'claimed_at', 'last_attempt_at'
        ),
        'tinyint' => array('status'),
        'varchar' => array('last_error' => 255)
      ),
      'character_achievement_pending_mutations' => array(
        'int' => array(
          'character_id', 'achievement_id', 'component_id', 'requested_value',
          'definition_version', 'attempt_count', 'created_at', 'last_attempt_at'
        ),
        'tinyint' => array(
          'source_target_type', 'operation', 'component_type', 'status'
        ),
        'bigint' => array('mutation_id', 'source_target_id'),
        'varchar' => array('last_error' => 255)
      ),
      'achievement_categories' => array(
        'int' => array('id', 'parent_id', 'sequence'),
        'varchar' => array('name' => 255, 'icon' => 255),
        'text' => array('description')
      ),
      'achievements' => array(
        'int' => array(
          'id', 'icon_id', 'points', 'reward_display', 'definition_version'
        ),
        'tinyint' => array('world_display_flag', 'reset_on_version_change', 'enabled'),
        'varchar' => array('name' => 255),
        'text' => array('description')
      ),
      'achievement_category_associations' => array(
        'int' => array('category_id', 'sequence', 'achievement_id'),
        'varchar' => array('display_text' => 255)
      ),
      'achievement_components' => array(
        'int' => array('achievement_id', 'sequence', 'component_id'),
        'tinyint' => array('component_type'),
        'text' => array('description', 'description_2')
      ),
      'achievement_component_counts' => array(
        'int' => array('component_id', 'required_count')
      ),
      'achievement_criteria' => array(
        'int' => array(
          'achievement_id', 'component_sequence', 'component_id', 'target_id',
          'target_id2', 'required_count'
        ),
        'tinyint' => array(
          'component_type', 'event_type', 'progress_mode', 'behavior', 'enabled'
        ),
        'bigint' => array('id', 'target_value'),
        'signed' => array('target_value')
      ),
      'achievement_rewards' => array(
        'int' => array('achievement_id', 'sequence', 'reward_data_id'),
        'tinyint' => array('reward_type', 'enabled'),
        'bigint' => array('reward_id', 'amount'),
        'varchar' => array('description' => 255)
      ),
      'achievement_reward_sets' => array(
        'int' => array('reward_set_id', 'achievement_id'),
        'tinyint' => array('enabled'),
        'varchar' => array('title' => 255)
      ),
      'achievement_reward_options' => array(
        'int' => array('reward_set_id', 'option_id', 'sequence'),
        'tinyint' => array('common_to_all', 'flags', 'enabled'),
        'varchar' => array('label' => 255)
      ),
      'achievement_reward_option_entries' => array(
        'int' => array('reward_set_id', 'option_id'),
        'bigint' => array('reward_id')
      ),
      'achievement_cast_restrictions' => array(
        'int' => array('restriction_id', 'achievement_id'),
        'tinyint' => array('requires_completed')
      )
    );
  }

  private function columnShapeRequirement(array $shapeSpec, $table, $column)
  {
    if (!isset($shapeSpec[$table])) {
      return null;
    }

    foreach (array('tinyint', 'int', 'bigint', 'text') as $dataType) {
      if (
        isset($shapeSpec[$table][$dataType]) &&
        in_array($column, $shapeSpec[$table][$dataType], true)
      ) {
        return array(
          'types' => array($dataType),
          'nullable' => false,
          'signed' => isset($shapeSpec[$table]['signed']) &&
            in_array($column, $shapeSpec[$table]['signed'], true)
        );
      }
    }

    if (
      isset($shapeSpec[$table]['varchar']) &&
      array_key_exists($column, $shapeSpec[$table]['varchar'])
    ) {
      return array(
        'types' => array('varchar'),
        'nullable' => false,
        'minimum_length' => (int) $shapeSpec[$table]['varchar'][$column]
      );
    }

    return null;
  }

  private function hasMatchingIndex($indexes, $columns, $mustBeUnique)
  {
    foreach ($indexes as $index) {
      if ($mustBeUnique && !$index['unique']) {
        continue;
      }
      if (empty($index['full_columns'])) {
        continue;
      }
      if ($index['columns'] === $columns) {
        return true;
      }
    }

    return false;
  }

  private function placeholders($count)
  {
    return implode(',', array_fill(0, $count, '?'));
  }

  private function characterStateRowsForIds($kind, $characterId, array $achievementIds)
  {
    $queries = array(
      'completions' => array(
        'select' => 'character_id, achievement_id, definition_version, completed_at',
        'table' => 'character_achievements',
        'order' => 'achievement_id'
      ),
      'progress' => array(
        'select' => 'character_id, achievement_id, component_type, component_sequence, '
          . 'component_id, current_count, completed, definition_version, updated_at',
        'table' => 'character_achievement_progress',
        'order' => 'achievement_id, component_type, component_sequence, component_id'
      ),
      'reward_ledgers' => array(
        'select' => 'character_id, achievement_id, reward_id, status, attempt_count, '
          . 'granted_at, last_attempt_at, last_error',
        'table' => 'character_achievement_rewards',
        'order' => 'achievement_id, reward_id'
      ),
      'reward_selections' => array(
        'select' => 'character_id, achievement_id, reward_set_id, selected_option_id, '
          . 'status, attempt_count, claimed_at, last_attempt_at, last_error',
        'table' => 'character_achievement_reward_selections',
        'order' => 'achievement_id, reward_set_id'
      ),
      'pending_mutations' => array(
        'select' => 'mutation_id, character_id, source_target_type, source_target_id, '
          . 'operation, achievement_id, component_type, component_id, requested_value, '
          . 'definition_version, status, attempt_count, created_at, last_attempt_at, last_error',
        'table' => 'character_achievement_pending_mutations',
        'order' => 'achievement_id, mutation_id'
      )
    );
    if (!isset($queries[$kind])) {
      throw new LogicException('Unsafe character achievement state query kind.');
    }
    if (empty($achievementIds)) {
      return array();
    }

    $query = $queries[$kind];
    $rows = array();
    foreach (array_chunk($achievementIds, self::MAX_DETAIL_ACHIEVEMENT_IDS) as $idChunk) {
      $filter = $this->buildInFilter('achievement_id', $idChunk, ' AND ');
      $chunkRows = $this->fetchAll(
        $this->characterDatabase,
        'SELECT ' . $query['select'] . ' FROM ' . $query['table'] .
          ' WHERE character_id = ?' . $filter['sql'] .
          ' ORDER BY ' . $query['order'],
        'i' . $filter['types'],
        array_merge(array($characterId), $filter['params']),
        'orphan character achievement ' . $kind
      );
      foreach ($chunkRows as $row) {
        $rows[] = $row;
      }
    }

    return $rows;
  }

  private function normalizeAchievementIds(array $achievementIds)
  {
    $normalized = array();
    foreach ($achievementIds as $achievementId) {
      $id = $this->normalizeUnsignedInteger(
        $achievementId,
        'Achievement ID',
        self::UINT32_MAX,
        false
      );
      $normalized[(string) $id] = $id;
      if (count($normalized) > self::MAX_DETAIL_ACHIEVEMENT_IDS) {
        throw new CharacterAchievementValidationException(
          'Character detail hydration is limited to ' . self::MAX_DETAIL_ACHIEVEMENT_IDS . ' achievement IDs.'
        );
      }
    }

    return array_values($normalized);
  }

  private function buildInFilter($column, array $ids, $prefix = ' WHERE ')
  {
    if (empty($ids)) {
      return array('sql' => '', 'types' => '', 'params' => array());
    }

    return array(
      'sql' => $prefix . $column . ' IN (' . implode(',', array_fill(0, count($ids), '?')) . ')',
      'types' => str_repeat('i', count($ids)),
      'params' => $ids
    );
  }

  private function loadDefinition($achievementId, $enabledOnly, $lockWhenShared)
  {
    $sql = "SELECT id, definition_version, enabled
            FROM achievements WHERE id = ?";
    if ($enabledOnly) {
      $sql .= " AND enabled = 1";
    }
    if ($lockWhenShared && $this->contentDatabase === $this->characterDatabase) {
      $sql .= " FOR UPDATE";
    }

    $definition = $this->fetchOne(
      $this->contentDatabase,
      $sql,
      'i',
      array($achievementId),
      'load current achievement definition'
    );
    if (!$definition) {
      throw new CharacterAchievementValidationException(
        $enabledOnly
          ? 'The achievement definition is disabled or unavailable to the runtime.'
          : 'The achievement definition no longer exists.'
      );
    }
    if ((int) $definition['definition_version'] < 1) {
      throw new CharacterAchievementValidationException(
        'The achievement definition has an invalid zero definition version.'
      );
    }

    return $definition;
  }

  private function loadComponentPolicy($achievementId, $componentType, $componentId)
  {
    $component = $this->fetchOne(
      $this->contentDatabase,
      "SELECT component.sequence,
        COALESCE(component_count.required_count, 1) AS presentation_count
       FROM achievement_components component
       LEFT JOIN achievement_component_counts component_count
         ON component_count.component_id = component.component_id
       WHERE component.achievement_id = ? AND component.component_type = ?
         AND component.component_id = ? LIMIT 1",
      'iii',
      array($achievementId, $componentType, $componentId),
      'load achievement component policy'
    );
    if (!$component) {
      throw new CharacterAchievementValidationException(
        'The requested component does not belong to this achievement.'
      );
    }

    $criteria = $this->fetchAll(
      $this->contentDatabase,
      "SELECT required_count FROM achievement_criteria
       WHERE achievement_id = ? AND component_type = ? AND component_id = ?
         AND enabled = 1",
      'iii',
      array($achievementId, $componentType, $componentId),
      'load achievement component criteria'
    );
    $criterionCounts = array();
    foreach ($criteria as $criterion) {
      $count = (int) $criterion['required_count'];
      if ($count < 1) {
        throw new CharacterAchievementValidationException(
          'The enabled criterion has an invalid zero required count.'
        );
      }
      $criterionCounts[(string) $count] = $count;
    }
    if (count($criterionCounts) > 1) {
      throw new CharacterAchievementValidationException(
        'The component has conflicting enabled criterion required counts.'
      );
    }

    if (count($criterionCounts) === 1) {
      $requiredCount = reset($criterionCounts);
    }
    else {
      $requiredCount = max(1, (int) $component['presentation_count']);
    }
    $requiredCount = min($requiredCount, self::UINT32_MAX);

    return array(
      'sequence' => (int) $component['sequence'],
      'required_count' => $requiredCount
    );
  }

  private function contentRecordBelongsToAchievement(
    $table,
    $identityColumn,
    $identity,
    $achievementId
  ) {
    $allowed = array(
      'achievement_rewards' => 'reward_id',
      'achievement_reward_sets' => 'reward_set_id'
    );
    if (!isset($allowed[$table]) || $allowed[$table] !== $identityColumn) {
      throw new LogicException('Unsafe achievement content ownership query.');
    }

    $row = $this->fetchOne(
      $this->contentDatabase,
      "SELECT 1 AS present FROM " . $table .
        " WHERE " . $identityColumn . " = ? AND achievement_id = ? LIMIT 1",
      'ii',
      array($identity, $achievementId),
      'validate achievement content ownership'
    );

    return (bool) $row;
  }

  private function achievementDefinitionOrStateExists($characterId, $achievementId)
  {
    $definition = $this->fetchOne(
      $this->contentDatabase,
      "SELECT 1 AS present FROM achievements WHERE id = ? LIMIT 1",
      'i',
      array($achievementId),
      'validate reset achievement definition'
    );
    if ($definition) {
      return true;
    }

    $state = $this->fetchOne(
      $this->characterDatabase,
      "SELECT 1 AS present FROM character_achievements
         WHERE character_id = ? AND achievement_id = ?
       UNION ALL
       SELECT 1 AS present FROM character_achievement_progress
         WHERE character_id = ? AND achievement_id = ?
       UNION ALL
       SELECT 1 AS present FROM character_achievement_rewards
         WHERE character_id = ? AND achievement_id = ?
       UNION ALL
       SELECT 1 AS present FROM character_achievement_reward_selections
         WHERE character_id = ? AND achievement_id = ?
       UNION ALL
       SELECT 1 AS present FROM character_achievement_pending_mutations
         WHERE character_id = ? AND achievement_id = ?
       LIMIT 1",
      'iiiiiiiiii',
      array(
        $characterId, $achievementId,
        $characterId, $achievementId,
        $characterId, $achievementId,
        $characterId, $achievementId,
        $characterId, $achievementId
      ),
      'validate orphan character achievement state'
    );

    return (bool) $state;
  }

  private function lockCharacter($characterId, $requireOffline, $offlineMessage = null)
  {
    $character = $this->fetchOne(
      $this->characterDatabase,
      "SELECT id, ingame FROM character_data WHERE id = ? FOR UPDATE",
      'i',
      array($characterId),
      'lock character for achievement mutation'
    );
    if (!$character) {
      throw new CharacterAchievementValidationException('Character not found.');
    }
    if ($requireOffline && (int) $character['ingame'] !== 0) {
      throw new CharacterAchievementValidationException(
        $offlineMessage !== null
          ? $offlineMessage
          : 'Direct achievement-state repairs are offline-only. Log the character out before continuing.'
      );
    }

    return $character;
  }

  private function assertSchemaReadyForMutation()
  {
    $diagnostics = $this->schemaDiagnostics();
    if ($diagnostics['ready']) {
      return true;
    }

    $errors = array_slice($diagnostics['errors'], 0, 3);
    $message = 'Achievement state cannot be changed because the configured database schema is incomplete or unsafe.';
    if (!empty($errors)) {
      $message .= ' ' . implode(' ', $errors);
      if (count($diagnostics['errors']) > count($errors)) {
        $message .= ' Review the schema diagnostics page for the remaining requirements.';
      }
    }

    throw new CharacterAchievementValidationException($message);
  }

  private function deleteCharacterAchievementRows($table, $characterId, $achievementId)
  {
    $allowed = array(
      'character_achievement_pending_mutations',
      'character_achievement_progress',
      'character_achievement_reward_selections',
      'character_achievement_rewards',
      'character_achievements'
    );
    if (!in_array($table, $allowed, true)) {
      throw new LogicException('Unsafe character achievement delete table.');
    }

    return $this->execute(
      $this->characterDatabase,
      "DELETE FROM " . $table . " WHERE character_id = ? AND achievement_id = ?",
      'ii',
      array($characterId, $achievementId),
      'reset character achievement rows'
    );
  }

  private function withCharacterMutation($characterId, $mutation)
  {
    $this->assertSchemaReadyForMutation();

    $lockName = 'eqemu_achievement_mutation_' . $characterId;
    $lockAcquired = false;
    $transactionActive = false;

    try {
      $lock = $this->fetchOne(
        $this->characterDatabase,
        "SELECT GET_LOCK(?, 0) AS acquired",
        's',
        array($lockName),
        'acquire character achievement advisory lock'
      );
      $lockAcquired = $lock && (int) $lock['acquired'] === 1;
      if (!$lockAcquired) {
        throw new CharacterAchievementBusyException(
          'Achievement state is busy for this character. Try again after the active zone mutation finishes.'
        );
      }

      try {
        if (!$this->characterDatabase->begin_transaction()) {
          throw new CharacterAchievementDatabaseException(
            'The character achievement transaction could not be started.'
          );
        }
        $transactionActive = true;
      }
      catch (Throwable $exception) {
        if ($exception instanceof CharacterAchievementServiceException) {
          throw $exception;
        }
        throw $this->databaseException('start character achievement transaction', $exception);
      }

      try {
        $result = call_user_func($mutation);
        try {
          if (!$this->characterDatabase->commit()) {
            throw new CharacterAchievementDatabaseException(
              'The character achievement transaction could not be committed.'
            );
          }
        }
        catch (Throwable $commitException) {
          if ($commitException instanceof CharacterAchievementServiceException) {
            throw $commitException;
          }
          throw $this->databaseException(
            'commit character achievement transaction',
            $commitException
          );
        }
        $transactionActive = false;

        return $result;
      }
      catch (Throwable $exception) {
        if ($transactionActive) {
          try {
            $this->characterDatabase->rollback();
          }
          catch (Throwable $rollbackException) {
            error_log(
              '[PEQ Character Achievements] rollback failed: ' .
              $rollbackException->getMessage()
            );
          }
          $transactionActive = false;
        }
        throw $exception;
      }
    }
    finally {
      if ($transactionActive) {
        try {
          $this->characterDatabase->rollback();
        }
        catch (Throwable $rollbackException) {
          error_log(
            '[PEQ Character Achievements] final rollback failed: ' .
            $rollbackException->getMessage()
          );
        }
      }

      if ($lockAcquired) {
        try {
          $this->fetchOne(
            $this->characterDatabase,
            "SELECT RELEASE_LOCK(?) AS released",
            's',
            array($lockName),
            'release character achievement advisory lock'
          );
        }
        catch (Throwable $releaseException) {
          // The lock is connection-scoped and will also be released when the
          // connection closes. A release diagnostic must not hide the result
          // of an already committed mutation.
          error_log(
            '[PEQ Character Achievements] advisory lock release failed: ' .
            $releaseException->getMessage()
          );
        }
      }
    }
  }

  private function requireConfirmation($value, $message)
  {
    if (!filter_var($value, FILTER_VALIDATE_BOOLEAN)) {
      throw new CharacterAchievementValidationException($message);
    }
  }

  private function normalizePositiveInteger($value, $label)
  {
    return $this->normalizeUnsignedInteger($value, $label, PHP_INT_MAX, false);
  }

  private function normalizeUnsignedInteger($value, $label, $maximum, $allowZero = true)
  {
    if (is_int($value)) {
      $normalized = $value;
    }
    elseif (is_string($value) && $value !== '' && ctype_digit($value)) {
      if (strlen($value) > strlen((string) PHP_INT_MAX)) {
        throw new CharacterAchievementValidationException($label . ' is too large.');
      }
      $normalized = (int) $value;
      if ((string) $normalized !== ltrim($value, '0') && !preg_match('/^0+$/', $value)) {
        throw new CharacterAchievementValidationException($label . ' is too large.');
      }
    }
    else {
      throw new CharacterAchievementValidationException($label . ' must be a whole number.');
    }

    $minimum = $allowZero ? 0 : 1;
    if ($normalized < $minimum || $normalized > $maximum) {
      throw new CharacterAchievementValidationException(
        $label . ' must be between ' . $minimum . ' and ' . $maximum . '.'
      );
    }

    return $normalized;
  }

  private function fetchOne($database, $sql, $types, array $params, $operation)
  {
    $rows = $this->fetchAll($database, $sql, $types, $params, $operation);

    return isset($rows[0]) ? $rows[0] : null;
  }

  private function fetchAll($database, $sql, $types, array $params, $operation)
  {
    $statement = null;
    try {
      $statement = $this->prepareAndExecute($database, $sql, $types, $params, $operation);
      $metadata = $statement->result_metadata();
      if (!$metadata) {
        return array();
      }

      $row = array();
      $bindings = array();
      $fields = $metadata->fetch_fields();
      foreach ($fields as $field) {
        $row[$field->name] = null;
        $bindings[] =& $row[$field->name];
      }
      call_user_func_array(array($statement, 'bind_result'), $bindings);

      $rows = array();
      while ($statement->fetch()) {
        $copy = array();
        foreach ($row as $name => $value) {
          $copy[$name] = $value;
        }
        $rows[] = $copy;
      }

      return $rows;
    }
    catch (Throwable $exception) {
      if ($exception instanceof CharacterAchievementServiceException) {
        throw $exception;
      }
      throw $this->databaseException($operation, $exception);
    }
    finally {
      if ($statement) {
        $statement->close();
      }
    }
  }

  private function execute($database, $sql, $types, array $params, $operation)
  {
    $statement = null;
    try {
      $statement = $this->prepareAndExecute($database, $sql, $types, $params, $operation);

      return (int) $statement->affected_rows;
    }
    catch (Throwable $exception) {
      if ($exception instanceof CharacterAchievementServiceException) {
        throw $exception;
      }
      throw $this->databaseException($operation, $exception);
    }
    finally {
      if ($statement) {
        $statement->close();
      }
    }
  }

  private function prepareAndExecute($database, $sql, $types, array $params, $operation)
  {
    if (strlen($types) !== count($params)) {
      throw new LogicException('Achievement prepared statement type count mismatch.');
    }

    try {
      $statement = $database->prepare($sql);
    }
    catch (Throwable $exception) {
      throw $this->databaseException($operation, $exception);
    }
    if (!$statement) {
      throw $this->databaseException($operation, null, $database->error);
    }

    try {
      if ($types !== '') {
        $arguments = array($types);
        foreach ($params as $index => $value) {
          $params[$index] = $value;
          $arguments[] =& $params[$index];
        }
        if (!call_user_func_array(array($statement, 'bind_param'), $arguments)) {
          throw $this->databaseException($operation, null, $statement->error);
        }
      }

      if (!$statement->execute()) {
        throw $this->databaseException($operation, null, $statement->error);
      }

      return $statement;
    }
    catch (Throwable $exception) {
      if ($exception instanceof CharacterAchievementServiceException) {
        $statement->close();
        throw $exception;
      }
      $statement->close();
      throw $this->databaseException($operation, $exception);
    }
  }

  private function databaseException($operation, $previous = null, $detail = '')
  {
    $diagnostic = $detail;
    if ($previous) {
      $diagnostic = $previous->getMessage();
    }
    error_log(
      '[PEQ Character Achievements] ' . $operation . ' failed' .
      ($diagnostic !== '' ? ': ' . $diagnostic : '')
    );

    return new CharacterAchievementDatabaseException(
      'The character achievement database operation failed. No partial change was kept.',
      0,
      $previous
    );
  }
}

?>
