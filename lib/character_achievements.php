<?php

require_once('classes/character_achievement_service.php');

check_admin_authorization();

$characterAchievementService = new CharacterAchievementService($mysql, $mysql_content_db);
$characterDiagnostics = $characterAchievementService->schemaDiagnostics();
if (!$characterDiagnostics['ready']) {
  achievement_schema_page($achievementRepository->schemaDiagnostics(), $characterDiagnostics);
  return;
}

function achievement_group_rows_by($rows, $field) {
  $groups = array();
  foreach (is_array($rows) ? $rows : array() as $row) {
    if (!is_array($row) || !array_key_exists($field, $row)) {
      continue;
    }
    $key = (string) $row[$field];
    if (!isset($groups[$key])) {
      $groups[$key] = array();
    }
    $groups[$key][] = $row;
  }
  return $groups;
}

function achievement_first_by($rows, $field) {
  $indexed = array();
  foreach (is_array($rows) ? $rows : array() as $row) {
    if (is_array($row) && array_key_exists($field, $row)) {
      $indexed[(string) $row[$field]] = $row;
    }
  }
  return $indexed;
}

function achievement_component_key($type, $componentId) {
  return (int) $type . ':' . (string) $componentId;
}

function achievement_reward_option_key($setId, $optionId) {
  return (string) $setId . ':' . (string) $optionId;
}

function achievement_empty_character_inputs($character) {
  return array(
    'character' => is_array($character) ? $character : array(),
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
    'pending_mutations' => array(),
  );
}

function achievement_add_orphan_definitions(array $inputs, array $orphanState) {
  $existingDefinitions = array();
  foreach (isset($inputs['definitions']) && is_array($inputs['definitions']) ? $inputs['definitions'] : array() as $definition) {
    if (isset($definition['id'])) {
      $existingDefinitions[(string) ((int) $definition['id'])] = true;
    }
  }
  $versions = array();
  foreach (array('completions', 'progress', 'pending_mutations') as $stateKey) {
    foreach (isset($orphanState[$stateKey]) && is_array($orphanState[$stateKey]) ? $orphanState[$stateKey] : array() as $row) {
      if (!isset($row['achievement_id'])) {
        continue;
      }
      $achievementId = (string) $row['achievement_id'];
      if (!isset($versions[$achievementId]) && isset($row['definition_version'])) {
        $versions[$achievementId] = (int) $row['definition_version'];
      }
    }
  }
  foreach (isset($orphanState['achievement_ids']) && is_array($orphanState['achievement_ids']) ? $orphanState['achievement_ids'] : array() as $achievementId) {
    $achievementId = (int) $achievementId;
    if ($achievementId <= 0) {
      continue;
    }
    if (isset($existingDefinitions[(string) $achievementId])) {
      continue;
    }
    $existingDefinitions[(string) $achievementId] = true;
    $inputs['definitions'][] = array(
      'id' => $achievementId,
      'name' => 'Deleted definition #' . $achievementId,
      'description' => 'Durable character state remains, but the authored content definition is no longer present.',
      'icon_id' => 0,
      'points' => 0,
      'reward_display' => 0,
      'world_display_flag' => 0,
      'definition_version' => isset($versions[(string) $achievementId]) ? $versions[(string) $achievementId] : 0,
      'reset_on_version_change' => 0,
      'enabled' => 0,
      'definition_missing' => 1,
    );
  }
  return $inputs;
}

function achievement_orphan_only_inputs(array $orphanState) {
  $inputs = achievement_empty_character_inputs(
    isset($orphanState['character']) ? $orphanState['character'] : array()
  );
  foreach (array('completions', 'progress', 'reward_ledgers', 'reward_selections', 'pending_mutations') as $stateKey) {
    $inputs[$stateKey] = isset($orphanState[$stateKey]) && is_array($orphanState[$stateKey])
      ? $orphanState[$stateKey]
      : array();
  }
  return achievement_add_orphan_definitions($inputs, $orphanState);
}

function achievement_character_catalog(array $inputs, array $filters) {
  $associationsByAchievement = achievement_group_rows_by($inputs['associations'], 'achievement_id');
  $componentsByAchievement = achievement_group_rows_by($inputs['components'], 'achievement_id');
  $criteriaByAchievement = achievement_group_rows_by($inputs['criteria'], 'achievement_id');
  $rewardsByAchievement = achievement_group_rows_by($inputs['rewards'], 'achievement_id');
  $setsByAchievement = achievement_group_rows_by($inputs['reward_sets'], 'achievement_id');
  $optionsByAchievement = achievement_group_rows_by($inputs['reward_options'], 'achievement_id');
  $entriesByAchievement = achievement_group_rows_by($inputs['reward_option_entries'], 'achievement_id');
  $completionByAchievement = achievement_first_by($inputs['completions'], 'achievement_id');
  $progressByAchievement = achievement_group_rows_by($inputs['progress'], 'achievement_id');
  $ledgersByAchievement = achievement_group_rows_by($inputs['reward_ledgers'], 'achievement_id');
  $selectionsByAchievement = achievement_group_rows_by($inputs['reward_selections'], 'achievement_id');
  $mutationsByAchievement = achievement_group_rows_by($inputs['pending_mutations'], 'achievement_id');

  $catalog = array();
  foreach ($inputs['definitions'] as $definition) {
    $achievementId = (string) $definition['id'];
    $associations = isset($associationsByAchievement[$achievementId])
      ? $associationsByAchievement[$achievementId]
      : array();
    $criteria = isset($criteriaByAchievement[$achievementId])
      ? $criteriaByAchievement[$achievementId]
      : array();
    $progress = isset($progressByAchievement[$achievementId])
      ? $progressByAchievement[$achievementId]
      : array();
    $rewardLedgers = isset($ledgersByAchievement[$achievementId])
      ? $ledgersByAchievement[$achievementId]
      : array();
    $selections = isset($selectionsByAchievement[$achievementId])
      ? $selectionsByAchievement[$achievementId]
      : array();
    $mutations = isset($mutationsByAchievement[$achievementId])
      ? $mutationsByAchievement[$achievementId]
      : array();
    $completion = isset($completionByAchievement[$achievementId])
      ? $completionByAchievement[$achievementId]
      : null;

    $criteriaByComponent = array();
    foreach ($criteria as $criterion) {
      $key = achievement_component_key($criterion['component_type'], $criterion['component_id']);
      if (!isset($criteriaByComponent[$key])) {
        $criteriaByComponent[$key] = array();
      }
      $criteriaByComponent[$key][] = $criterion;
    }
    $progressByComponent = array();
    foreach ($progress as $progressRow) {
      $progressByComponent[achievement_component_key(
        $progressRow['component_type'],
        $progressRow['component_id']
      )] = $progressRow;
    }

    $components = array();
    foreach (isset($componentsByAchievement[$achievementId]) ? $componentsByAchievement[$achievementId] : array() as $component) {
      $componentKey = achievement_component_key($component['component_type'], $component['component_id']);
      $componentCriteria = isset($criteriaByComponent[$componentKey])
        ? $criteriaByComponent[$componentKey]
        : array();
      $counts = array();
      foreach ($componentCriteria as $criterion) {
        if ((int) $criterion['enabled'] === 1) {
          $counts[(string) $criterion['required_count']] = (int) $criterion['required_count'];
        }
      }
      $presentationCount = max(1, (int) $component['presentation_count']);
      $component['criteria'] = $componentCriteria;
      $component['progress'] = isset($progressByComponent[$componentKey])
        ? $progressByComponent[$componentKey]
        : null;
      $component['state_bearing'] = (int) $component['component_type'] >= 0
        && (int) $component['component_type'] <= 2;
      $component['effective_count_conflict'] = count($counts) > 1 || isset($counts['0']);
      $component['effective_required_count'] = count($counts) === 1
        ? max(1, (int) reset($counts))
        : $presentationCount;
      $components[] = $component;
    }

    $mappingByReward = array();
    $entriesByOption = array();
    foreach (isset($entriesByAchievement[$achievementId]) ? $entriesByAchievement[$achievementId] : array() as $entry) {
      $mappingByReward[(string) $entry['reward_id']] = $entry;
      $optionKey = achievement_reward_option_key($entry['reward_set_id'], $entry['option_id']);
      if (!isset($entriesByOption[$optionKey])) {
        $entriesByOption[$optionKey] = array();
      }
      $entriesByOption[$optionKey][] = $entry;
    }
    $ledgerByReward = achievement_first_by($rewardLedgers, 'reward_id');
    $rewardById = array();
    $rewards = array();
    foreach (isset($rewardsByAchievement[$achievementId]) ? $rewardsByAchievement[$achievementId] : array() as $reward) {
      $rewardId = (string) $reward['reward_id'];
      $reward['mapping'] = isset($mappingByReward[$rewardId]) ? $mappingByReward[$rewardId] : null;
      $reward['ledger'] = isset($ledgerByReward[$rewardId]) ? $ledgerByReward[$rewardId] : null;
      $rewardById[$rewardId] = $reward;
      $rewards[] = $reward;
    }

    $selectionBySet = achievement_first_by($selections, 'reward_set_id');
    $optionsBySet = achievement_group_rows_by(
      isset($optionsByAchievement[$achievementId]) ? $optionsByAchievement[$achievementId] : array(),
      'reward_set_id'
    );
    $sets = array();
    foreach (isset($setsByAchievement[$achievementId]) ? $setsByAchievement[$achievementId] : array() as $set) {
      $setId = (string) $set['reward_set_id'];
      $options = array();
      foreach (isset($optionsBySet[$setId]) ? $optionsBySet[$setId] : array() as $option) {
        $optionKey = achievement_reward_option_key($setId, $option['option_id']);
        $option['entries'] = array();
        foreach (isset($entriesByOption[$optionKey]) ? $entriesByOption[$optionKey] : array() as $entry) {
          $entry['reward'] = isset($rewardById[(string) $entry['reward_id']])
            ? $rewardById[(string) $entry['reward_id']]
            : null;
          $option['entries'][] = $entry;
        }
        $options[] = $option;
      }
      $set['options'] = $options;
      $set['selection'] = isset($selectionBySet[$setId]) ? $selectionBySet[$setId] : null;
      $sets[] = $set;
    }

    $orphanRewardLedgers = array();
    foreach ($rewardLedgers as $ledger) {
      if (!isset($rewardById[(string) $ledger['reward_id']])) {
        $orphanRewardLedgers[] = $ledger;
      }
    }
    $knownSetIds = array();
    foreach ($sets as $set) {
      $knownSetIds[(string) $set['reward_set_id']] = true;
    }
    $orphanSelections = array();
    foreach ($selections as $selection) {
      if (!isset($knownSetIds[(string) $selection['reward_set_id']])) {
        $orphanSelections[] = $selection;
      }
    }

    $hasProgress = false;
    $hasVersionMismatch = false;
    foreach ($progress as $progressRow) {
      $hasProgress = $hasProgress || (float) $progressRow['current_count'] > 0;
      $hasVersionMismatch = $hasVersionMismatch
        || (int) $progressRow['definition_version'] !== (int) $definition['definition_version'];
    }
    if ($completion) {
      $hasVersionMismatch = $hasVersionMismatch
        || (int) $completion['definition_version'] !== (int) $definition['definition_version'];
    }
    $rewardAttention = false;
    foreach ($rewardLedgers as $ledger) {
      $rewardAttention = $rewardAttention || in_array((int) $ledger['status'], array(0, 2), true);
    }
    foreach ($selections as $selection) {
      $status = (int) $selection['status'];
      $rewardAttention = $rewardAttention
        || in_array($status, array(2, 3), true)
        || ($status === 0 && (int) $selection['selected_option_id'] !== 0);
    }

    $definition['categories'] = $associations;
    $definition['components'] = $components;
    $definition['criteria'] = $criteria;
    $definition['completion'] = $completion;
    $definition['progress'] = $progress;
    $definition['rewards'] = $rewards;
    $definition['reward_sets'] = $sets;
    $definition['reward_ledgers'] = $rewardLedgers;
    $definition['reward_selections'] = $selections;
    $definition['pending_mutations'] = $mutations;
    $definition['orphan_reward_ledgers'] = $orphanRewardLedgers;
    $definition['orphan_reward_selections'] = $orphanSelections;
    $definition['durable_state'] = $completion ? 'completed' : ($hasProgress ? 'in_progress' : 'not_started');
    $definition['has_version_mismatch'] = $hasVersionMismatch;
    $definition['reward_needs_attention'] = $rewardAttention;
    $definition['definition_missing'] = !empty($definition['definition_missing']);
    $catalog[] = $definition;
  }

  $query = strtolower(trim(isset($filters['q']) ? (string) $filters['q'] : ''));
  $categoryId = isset($filters['category']) ? (int) $filters['category'] : 0;
  $state = isset($filters['state']) ? (string) $filters['state'] : 'all';
  $filtered = array();
  foreach ($catalog as $definition) {
    if ($query !== '') {
      $haystack = strtolower((string) $definition['id'] . ' ' . $definition['name'] . ' ' . $definition['description']);
      if (strpos($haystack, $query) === false) {
        continue;
      }
    }
    if ($categoryId > 0) {
      $matched = false;
      foreach ($definition['categories'] as $association) {
        if ((int) $association['category_id'] === $categoryId) {
          $matched = true;
          break;
        }
      }
      if (!$matched) {
        continue;
      }
    }
    $stateMatches = $state === 'all'
      || ($state === 'completed' && $definition['completion'])
      || ($state === 'not_completed' && !$definition['completion'])
      || ($state === 'in_progress' && $definition['durable_state'] === 'in_progress')
      || ($state === 'not_started' && $definition['durable_state'] === 'not_started')
      || ($state === 'version_mismatch' && $definition['has_version_mismatch'])
      || ($state === 'reward_attention' && $definition['reward_needs_attention'])
      || ($state === 'pending_mutation' && count($definition['pending_mutations']) > 0)
      || ($state === 'orphaned' && $definition['definition_missing']);
    if ($stateMatches) {
      $filtered[] = $definition;
    }
  }

  $perPage = isset($filters['per_page']) ? (int) $filters['per_page'] : 25;
  $page = max(1, isset($filters['page']) ? (int) $filters['page'] : 1);
  $total = count($filtered);
  $pages = $total ? (int) ceil($total / $perPage) : 0;
  if ($pages && $page > $pages) {
    $page = $pages;
  }

  return array(
    'rows' => array_slice($filtered, ($page - 1) * $perPage, $perPage),
    'total' => $total,
    'page' => $page,
    'per_page' => $perPage,
    'pages' => $pages,
  );
}

function achievement_character_filters() {
  $states = array('all', 'completed', 'not_completed', 'in_progress', 'not_started', 'version_mismatch', 'reward_attention', 'pending_mutation', 'orphaned');
  $state = isset($_GET['state']) ? (string) $_GET['state'] : 'all';
  if (!in_array($state, $states, true)) {
    $state = 'all';
  }
  $q = isset($_GET['q']) ? trim((string) $_GET['q']) : '';
  if (strlen($q) > 255) {
    $q = substr($q, 0, 255);
  }
  return array(
    'q' => $q,
    'category' => achievement_query_uint('category', 0),
    'state' => $state,
    'page' => achievement_query_uint('page', 1, 1, 1000000),
    'per_page' => isset($_GET['per_page']) && in_array((int) $_GET['per_page'], array(10, 25, 50, 100), true)
      ? (int) $_GET['per_page']
      : 25,
  );
}

switch ((int) $action) {
  case 40:
    $search = isset($_GET['q']) ? trim((string) $_GET['q']) : '';
    if (strlen($search) > 255) {
      $search = substr($search, 0, 255);
    }
    $page = achievement_query_uint('page', 1, 1, 1000000);
    $characters = $characterAchievementService->listCharacters($search, $page, 50);
    achievement_render_template('templates/achievements/characters.tmpl.php', array(
      'characters' => $characters,
      'search' => $search,
      'classes' => isset($GLOBALS['classes']) ? $GLOBALS['classes'] : array(),
    ));
    break;

  case 41:
    $characterId = achievement_query_uint('playerid', 0, 1);
    $filters = achievement_character_filters();
    $orphanState = $characterAchievementService->characterOrphanState($characterId);
    if ($filters['state'] === 'all') {
      // Text/category-only browsing can page in the content database first,
      // then hydrate just those character rows across the split connection.
      $definitionPage = $achievementRepository->listDefinitions(
        array(
          'search' => $filters['q'],
          'category_id' => $filters['category'],
          'enabled' => '',
          'event_type' => '',
          'reward' => '',
        ),
        $filters['page'],
        $filters['per_page'],
        'name',
        'asc'
      );
      $definitionIds = array();
      foreach ($definitionPage['rows'] as $definitionRow) {
        $definitionIds[] = (int) $definitionRow['id'];
      }
      $inputs = $characterAchievementService->characterStateInputs($characterId, $definitionIds, false);
      $pageFilters = $filters;
      $pageFilters['page'] = 1;
      $pageFilters['per_page'] = max(1, count($definitionIds));
      // The content repository already applied its DB collation-aware text and
      // category filters. Reapplying them with PHP byte comparisons can drop
      // accent/case matches and under-fill an otherwise valid page.
      $pageFilters['q'] = '';
      $pageFilters['category'] = 0;
      $catalog = achievement_character_catalog($inputs, $pageFilters);
      $catalog['total'] = $definitionPage['total'];
      $catalog['page'] = $definitionPage['page'];
      $catalog['per_page'] = $definitionPage['page_size'];
      $catalog['pages'] = $definitionPage['pages'];
    }
    else if ($filters['state'] === 'orphaned') {
      $inputs = achievement_orphan_only_inputs($orphanState);
      $catalog = achievement_character_catalog($inputs, $filters);
    }
    else {
      // Durable-state predicates span the player database, so obtain the
      // split inputs independently and filter/merge them in PHP.
      $inputs = $characterAchievementService->characterStateInputs($characterId);
      $inputs = achievement_add_orphan_definitions($inputs, $orphanState);
      $catalog = achievement_character_catalog($inputs, $filters);
    }
    $catalog['orphan_total'] = isset($orphanState['achievement_ids']) && is_array($orphanState['achievement_ids'])
      ? count($orphanState['achievement_ids'])
      : 0;
    achievement_render_template('templates/achievements/character.tmpl.php', array(
      'character' => $inputs['character'],
      'catalog' => $catalog,
      'filters' => $filters,
      'category_options' => $achievementRepository->categoryOptions(),
      'metadata' => achievement_metadata(),
      'classes' => isset($GLOBALS['classes']) ? $GLOBALS['classes'] : array(),
      'orphan_state' => $orphanState,
    ));
    break;

  case 42:
    achievement_verify_csrf();
    $characterId = achievement_post_uint('playerid', 'Character ID', 1);
    $achievementId = achievement_post_uint('achievement_id', 'Achievement ID', 1);
    $result = $characterAchievementService->setExactProgress(
      $characterId,
      $achievementId,
      achievement_post_uint('component_type', 'Component type', 0, 2),
      achievement_post_uint('component_id', 'Component ID', 0),
      achievement_post_uint('current_count', 'Current count', 0)
    );
    achievement_flash('success', 'Progress saved at ' . $result['current_count'] . ' / ' . $result['required_count'] . '.');
    achievement_redirect(41, array('playerid' => $characterId, 'q' => $achievementId));
    break;

  case 43:
    $characterId = achievement_post_uint('playerid', 'Character ID', 1);
    $achievementId = achievement_post_uint('achievement_id', 'Achievement ID', 1);
    achievement_require_confirmation('FORCE COMPLETE ' . $achievementId);
    $characterAchievementService->forceCompleteOffline($characterId, $achievementId, true);
    achievement_flash('warning', 'Offline completion was written. Rewards and dependencies reconcile on the next character load.');
    achievement_redirect(41, array('playerid' => $characterId, 'q' => $achievementId));
    break;

  case 44:
    $characterId = achievement_post_uint('playerid', 'Character ID', 1);
    $achievementId = achievement_post_uint('achievement_id', 'Achievement ID', 1);
    achievement_require_confirmation('RESET ' . $achievementId);
    $resetRewards = achievement_post_bool('reset_rewards');
    $confirmRewards = false;
    if ($resetRewards) {
      $confirmRewards = isset($_POST['reward_confirmation'])
        && hash_equals('RESET REWARDS ' . $achievementId, trim((string) $_POST['reward_confirmation']));
      if (!$confirmRewards) {
        throw new AchievementHttpException('Reward-ledger reset confirmation did not match. Nothing was reset.');
      }
    }
    $deleted = $characterAchievementService->reset(
      $characterId,
      $achievementId,
      true,
      $resetRewards,
      $confirmRewards
    );
    achievement_flash(
      $resetRewards ? 'warning' : 'success',
      $resetRewards
        ? 'Completion, progress, pending mutations, and reward ledgers were reset. Recompletion can grant rewards again.'
        : 'Completion, progress, and pending mutations were reset. Reward ledgers were preserved.',
      array('Deleted rows: ' . json_encode($deleted))
    );
    $remainingOrphans = $characterAchievementService->characterOrphanState($characterId);
    $redirectParameters = array('playerid' => $characterId, 'q' => $achievementId);
    if (in_array($achievementId, $remainingOrphans['achievement_ids'], true)) {
      $redirectParameters['state'] = 'orphaned';
    }
    achievement_redirect(41, $redirectParameters);
    break;

  case 45:
    $characterId = achievement_post_uint('playerid', 'Character ID', 1);
    $achievementId = achievement_post_uint('achievement_id', 'Achievement ID', 1);
    $rewardId = achievement_post_uint('reward_id', 'Reward ID', 1);
    achievement_require_confirmation('RETRY ' . $rewardId);
    if (!achievement_post_bool('accept_duplicate_risk')) {
      throw new AchievementHttpException('You must explicitly accept the duplicate-delivery risk.');
    }
    $characterAchievementService->markRewardRetryable($characterId, $achievementId, $rewardId, true);
    achievement_flash('warning', 'Reward ' . $rewardId . ' was marked retryable with duplicate-delivery risk acknowledged.');
    achievement_redirect(41, array('playerid' => $characterId, 'q' => $achievementId));
    break;

  case 46:
    $characterId = achievement_post_uint('playerid', 'Character ID', 1);
    $achievementId = achievement_post_uint('achievement_id', 'Achievement ID', 1);
    $rewardSetId = achievement_post_uint('reward_set_id', 'Reward set ID', 1);
    achievement_require_confirmation('RETRY SET ' . $rewardSetId);
    if (!achievement_post_bool('accept_duplicate_risk')) {
      throw new AchievementHttpException('You must explicitly accept the duplicate-delivery risk.');
    }
    $characterAchievementService->markSelectionRetryable($characterId, $achievementId, $rewardSetId, true);
    achievement_flash('warning', 'Reward selection ' . $rewardSetId . ' was marked retryable.');
    achievement_redirect(41, array('playerid' => $characterId, 'q' => $achievementId));
    break;

  case 47:
    achievement_verify_csrf();
    $characterId = achievement_post_uint('playerid', 'Character ID', 1);
    $achievementId = achievement_post_uint('achievement_id', 'Achievement ID', 1);
    $mutationId = achievement_post_positive_platform_int('mutation_id', 'Mutation ID');
    $characterAchievementService->retryBlockedMutation($characterId, $achievementId, $mutationId);
    achievement_flash('success', 'Blocked mutation ' . $mutationId . ' was returned to pending.');
    achievement_redirect(41, array('playerid' => $characterId, 'q' => $achievementId));
    break;

  case 48:
    $characterId = achievement_post_uint('playerid', 'Character ID', 1);
    $achievementId = achievement_post_uint('achievement_id', 'Achievement ID', 1);
    $mutationId = achievement_post_positive_platform_int('mutation_id', 'Mutation ID');
    achievement_require_confirmation('DISCARD ' . $mutationId);
    $characterAchievementService->discardMutation($characterId, $achievementId, $mutationId, true);
    achievement_flash('warning', 'Pending mutation ' . $mutationId . ' was permanently discarded.');
    achievement_redirect(41, array('playerid' => $characterId, 'q' => $achievementId));
    break;
}

?>
