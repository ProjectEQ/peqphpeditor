<?php

require_once('lib/achievement_http.php');
require_once('lib/achievement_metadata.php');
require_once('classes/achievement_repository.php');

global $mysql_content_db, $mysql, $body, $javascript, $action, $playerid;

$achievementRepository = new AchievementRepository($mysql_content_db);

function achievement_render_template($file, $variables = array(), $withJavascript = false) {
  global $body, $javascript;

  $body = new Template($file);
  $common = array(
    'csrf_token' => achievement_csrf_token(),
    'flash_messages' => achievement_take_flash(),
    'can_edit_achievements' => session::check_authorization(),
    'can_manage_character_achievements' => session::is_admin(),
  );
  foreach (array_merge($common, $variables) as $key => $value) {
    $body->set($key, $value);
  }

  if ($withJavascript) {
    $javascript = new Template('templates/achievements/js.tmpl.php');
    foreach ($variables as $key => $value) {
      $javascript->set($key, $value);
    }
  }
}

function achievement_validation_error_rows($issues) {
  $errors = array();
  if (!is_array($issues)) {
    return $errors;
  }

  foreach ($issues as $key => $issue) {
    if (is_string($issue)) {
      $errors[] = array('path' => is_string($key) ? $key : '', 'message' => $issue, 'severity' => 'error');
      continue;
    }
    if (!is_array($issue)) {
      continue;
    }
    $severity = isset($issue['severity']) ? strtolower((string) $issue['severity']) : 'error';
    if ($severity !== 'warning' && $severity !== 'info') {
      $severity = 'error';
    }
    $errors[] = array(
      'path' => isset($issue['path']) ? (string) $issue['path'] : (is_string($key) ? $key : ''),
      'message' => isset($issue['message']) ? (string) $issue['message'] : 'The submitted value is invalid.',
      'severity' => $severity,
    );
  }

  return $errors;
}

function achievement_has_blocking_errors($issues) {
  foreach (achievement_validation_error_rows($issues) as $issue) {
    if ($issue['severity'] === 'error') {
      return true;
    }
  }
  return false;
}

function achievement_issue_messages($issues) {
  $messages = array();
  foreach (achievement_validation_error_rows($issues) as $issue) {
    $prefix = $issue['path'] !== '' ? $issue['path'] . ': ' : '';
    $messages[] = $prefix . $issue['message'];
  }
  return $messages;
}

function achievement_repository_public_details($exception) {
  $details = method_exists($exception, 'getDetails') ? $exception->getDetails() : array();
  if (!is_array($details)) {
    return array();
  }
  $public = array();
  if (isset($details['validation_errors']) && is_array($details['validation_errors'])) {
    return achievement_issue_messages($details['validation_errors']);
  }
  $safeKeys = array(
    'referencing_achievement_id' => 'Referencing achievement',
    'child_category_id' => 'Child category',
    'associated_achievement_id' => 'Associated achievement',
  );
  foreach ($safeKeys as $key => $label) {
    if (isset($details[$key]) && is_scalar($details[$key])) {
      $public[] = $label . ': ' . (string) $details[$key];
    }
  }
  return $public;
}

function achievement_definition_form_context($repository, $definition, $issues, $isCreate) {
  $categories = $repository->listCategories();
  $persistedRewardSetId = null;
  $persistedComponentKeys = array();
  $persistedRewardIds = array();
  $persistedOptionIds = array();
  if (!$isCreate) {
    // A failed graph contains proposed state, not necessarily the identity
    // currently stored in the content database. Keep those two concepts
    // separate so a newly proposed set ID can still be corrected after a
    // collision while an existing set remains immutable in the browser.
    $persistedDefinition = $repository->loadDefinition(isset($definition['id']) ? $definition['id'] : 0);
    foreach (isset($persistedDefinition['components']) && is_array($persistedDefinition['components'])
        ? $persistedDefinition['components'] : array() as $component) {
      $persistedComponentKeys[] = (string) $component['component_type'] . ':' . (string) $component['component_id'];
    }
    foreach (isset($persistedDefinition['rewards']) && is_array($persistedDefinition['rewards'])
        ? $persistedDefinition['rewards'] : array() as $reward) {
      $persistedRewardIds[] = (string) $reward['reward_id'];
    }
    if (isset($persistedDefinition['reward_set'])
        && is_array($persistedDefinition['reward_set'])
        && isset($persistedDefinition['reward_set']['reward_set_id'])) {
      $persistedRewardSetId = $persistedDefinition['reward_set']['reward_set_id'];
      foreach (isset($persistedDefinition['reward_set']['options'])
          && is_array($persistedDefinition['reward_set']['options'])
          ? $persistedDefinition['reward_set']['options'] : array() as $option) {
        $persistedOptionIds[] = (string) $option['option_id'];
      }
    }
  }
  return array(
    'definition' => $definition,
    'definition_json' => json_encode(
      $definition,
      JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_UNESCAPED_SLASHES
    ),
    'metadata' => achievement_metadata(),
    'metadata_json' => json_encode(
      achievement_metadata(),
      JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_UNESCAPED_SLASHES
    ),
    'categories' => $categories,
    'category_options' => $repository->categoryOptions(),
    'issues' => achievement_validation_error_rows($issues),
    'is_create' => (bool) $isCreate,
    'form_action' => achievement_url($isCreate ? 2 : 4),
    'lookup_url' => achievement_url(60),
    'persisted_reward_set_id' => $persistedRewardSetId,
    'persisted_component_keys' => $persistedComponentKeys,
    'persisted_reward_ids' => $persistedRewardIds,
    'persisted_option_ids' => $persistedOptionIds,
  );
}

function achievement_definition_filters() {
  $allowedRewards = array('', 'any', 'automatic', 'selectable', 'none');
  $allowedSorts = array(
    'id', 'name', 'points', 'definition_version', 'enabled',
    'component_count', 'category_count', 'reward_count'
  );
  $query = isset($_GET['q']) ? trim((string) $_GET['q']) : '';
  if (strlen($query) > 255) {
    $query = substr($query, 0, 255);
  }
  $enabled = isset($_GET['enabled']) ? (string) $_GET['enabled'] : '';
  if (!in_array($enabled, array('', '0', '1'), true)) {
    $enabled = '';
  }
  $eventType = isset($_GET['event_type']) ? (string) $_GET['event_type'] : '';
  if ($eventType !== '' && (!ctype_digit($eventType) || (int) $eventType > 13)) {
    $eventType = '';
  }
  $reward = isset($_GET['reward']) ? (string) $_GET['reward'] : '';
  if (!in_array($reward, $allowedRewards, true)) {
    $reward = '';
  }
  $sort = isset($_GET['sort']) ? (string) $_GET['sort'] : 'name';
  if (!in_array($sort, $allowedSorts, true)) {
    $sort = 'name';
  }

  return array(
    'q' => $query,
    'enabled' => $enabled,
    'category_id' => achievement_query_uint('category_id', 0),
    'event_type' => $eventType,
    'reward' => $reward,
    'sort' => $sort,
    'direction' => isset($_GET['direction']) && strtolower((string) $_GET['direction']) === 'desc' ? 'desc' : 'asc',
    'page' => achievement_query_uint('page', 1, 1, 1000000),
    'per_page' => isset($_GET['per_page']) && in_array((int) $_GET['per_page'], array(25, 50, 100, 200), true)
      ? (int) $_GET['per_page']
      : 50,
  );
}

function achievement_repository_definition_filters($filters) {
  $repositoryFilters = $filters;
  $repositoryFilters['search'] = isset($filters['q']) ? $filters['q'] : '';
  $reward = isset($filters['reward']) ? (string) $filters['reward'] : '';
  $repositoryFilters['reward'] = $reward;
  unset($repositoryFilters['has_rewards']);
  return $repositoryFilters;
}

function achievement_category_from_post() {
  return array(
    'id' => achievement_post_uint('id', 'Category ID', 1),
    'parent_id' => achievement_post_uint('parent_id', 'Parent category ID', 0),
    'sequence' => achievement_post_uint('sequence', 'Category sequence', 0),
    'name' => isset($_POST['name']) ? trim((string) $_POST['name']) : '',
    'description' => isset($_POST['description']) ? (string) $_POST['description'] : '',
    'icon' => isset($_POST['icon']) ? trim((string) $_POST['icon']) : '',
  );
}

function achievement_category_validation_context($rows) {
  $ids = array();
  $parents = array();
  foreach (is_array($rows) ? $rows : array() as $row) {
    if (!is_array($row) || !isset($row['id'])) {
      continue;
    }
    $id = (string) $row['id'];
    $ids[$id] = true;
    $parents[$id] = isset($row['parent_id']) ? (string) $row['parent_id'] : '0';
  }
  return array(
    'category_ids' => $ids,
    'category_parent_map' => $parents,
  );
}

function achievement_schema_page($diagnostics, $characterDiagnostics = null) {
  achievement_render_template('templates/achievements/schema.tmpl.php', array(
    'diagnostics' => $diagnostics,
    'character_diagnostics' => $characterDiagnostics,
  ));
}

try {
  // JSON reference lookup. This exits before the legacy page wrapper renders.
  if ((int) $action === 60) {
    $achievementRepository->assertSchemaReady();
    $type = isset($_GET['type']) ? trim((string) $_GET['type']) : '';
    $search = isset($_GET['q']) ? trim((string) $_GET['q']) : '';
    if (strlen($search) > 100) {
      $search = substr($search, 0, 100);
    }
    $ids = array();
    foreach (explode(',', isset($_GET['ids']) ? (string) $_GET['ids'] : '') as $id) {
      $id = trim($id);
      if ($id !== '' && ctype_digit($id)) {
        $ids[(string) (int) $id] = (int) $id;
      }
      if (count($ids) >= 100) {
        break;
      }
    }
    $lookupTypes = $achievementRepository->lookupTypes();
    $knownLookup = array_key_exists($type, $lookupTypes) || in_array($type, $lookupTypes, true);
    if (!$knownLookup) {
      achievement_json_response(array('error' => 'Unknown lookup type.'), 404);
    }
    achievement_json_response(array(
      'results' => $achievementRepository->lookup($type, $search, array_values($ids), 50)
    ));
  }

  $definitionDiagnostics = $achievementRepository->schemaDiagnostics();
  if (isset($definitionDiagnostics['ready']) && !$definitionDiagnostics['ready']) {
    achievement_schema_page($definitionDiagnostics);
    return;
  }

  switch ((int) $action) {
    case 0: // Definition catalog.
      $filters = achievement_definition_filters();
      $definitions = $achievementRepository->listDefinitions(
        achievement_repository_definition_filters($filters),
        $filters['page'],
        $filters['per_page'],
        $filters['sort'],
        $filters['direction']
      );
      achievement_render_template('templates/achievements/definitions.tmpl.php', array(
        'definitions' => $definitions,
        'filters' => $filters,
        'category_options' => $achievementRepository->categoryOptions(),
        'metadata' => achievement_metadata(),
      ));
      break;

    case 1: // New definition form.
      check_authorization();
      $failed = achievement_take_failed_graph('create');
      $definition = is_array($failed['graph'])
        ? $failed['graph']
        : $achievementRepository->newDefinitionDefaults();
      achievement_render_template(
        'templates/achievements/definition.form.tmpl.php',
        achievement_definition_form_context(
          $achievementRepository,
          $definition,
          $failed['errors'],
          true
        ),
        true
      );
      break;

    case 2: // Create definition graph.
      check_authorization();
      $definition = achievement_decode_graph();
      $issues = achievement_validate_definition($definition, null);
      if (achievement_has_blocking_errors($issues)) {
        achievement_store_failed_graph($definition, $issues, 'create');
        achievement_flash('error', 'The definition was not saved.', achievement_issue_messages($issues));
        achievement_redirect(1);
      }
      $achievementId = $achievementRepository->createDefinition($definition);
      achievement_flash('success', 'Achievement ' . $achievementId . ' was created as one atomic definition graph.');
      if (count($issues) > 0) {
        achievement_flash('warning', 'The definition saved with authoring warnings.', achievement_issue_messages($issues));
      }
      achievement_redirect(3, array('achievement_id' => $achievementId));
      break;

    case 3: // Edit definition graph.
      check_authorization();
      $achievementId = achievement_query_uint('achievement_id', 0, 1);
      $failed = achievement_take_failed_graph('edit:' . $achievementId);
      $definition = is_array($failed['graph'])
        ? $failed['graph']
        : $achievementRepository->loadDefinition($achievementId);
      achievement_render_template(
        'templates/achievements/definition.form.tmpl.php',
        achievement_definition_form_context(
          $achievementRepository,
          $definition,
          $failed['errors'],
          false
        ),
        true
      );
      break;

    case 4: // Update definition graph.
      check_authorization();
      $definition = achievement_decode_graph();
      $achievementId = isset($definition['id'])
        ? achievement_uint($definition['id'], 'Achievement ID', 1)
        : 0;
      $issues = achievement_validate_definition($definition, $achievementId);
      if (achievement_has_blocking_errors($issues)) {
        achievement_store_failed_graph($definition, $issues, 'edit:' . $achievementId);
        achievement_flash('error', 'The definition was not saved.', achievement_issue_messages($issues));
        achievement_redirect(3, array('achievement_id' => $achievementId));
      }
      $achievementRepository->updateDefinition($achievementId, $definition);
      achievement_flash('success', 'Achievement ' . $achievementId . ' was saved atomically.');
      if (count($issues) > 0) {
        achievement_flash('warning', 'The definition saved with authoring warnings.', achievement_issue_messages($issues));
      }
      achievement_redirect(3, array('achievement_id' => $achievementId));
      break;

    case 5: // Safe clone; clones are disabled by the repository.
      check_authorization();
      achievement_verify_csrf();
      $sourceId = achievement_post_uint('achievement_id', 'Achievement ID', 1);
      $newId = isset($_POST['new_achievement_id']) && trim((string) $_POST['new_achievement_id']) !== ''
        ? achievement_post_uint('new_achievement_id', 'New achievement ID', 1)
        : null;
      $newName = isset($_POST['new_name']) ? trim((string) $_POST['new_name']) : null;
      $clonedId = $achievementRepository->cloneDefinition($sourceId, $newId, $newName);
      achievement_flash('success', 'Disabled clone ' . $clonedId . ' was created with new reward identities.');
      achievement_redirect(3, array('achievement_id' => $clonedId));
      break;

    case 6: // Delete definition content, preserving character history.
      check_authorization();
      $achievementId = achievement_post_uint('achievement_id', 'Achievement ID', 1);
      achievement_require_confirmation('DELETE ' . $achievementId);
      $achievementRepository->deleteDefinition($achievementId);
      achievement_flash(
        'warning',
        'Achievement ' . $achievementId . ' content was deleted. Character history and global presentation counts were preserved.'
      );
      achievement_redirect(0);
      break;

    case 20: // Category tree and editor.
      $editingId = achievement_query_uint('category_id', 0);
      $failedCategory = achievement_take_failed_category($editingId);
      $editingCategory = $editingId > 0
        ? $achievementRepository->loadCategory($editingId)
        : null;
      achievement_render_template('templates/achievements/categories.tmpl.php', array(
        'categories' => $achievementRepository->listCategories(),
        'category_tree' => $achievementRepository->categoryTree(),
        'category_options' => $achievementRepository->categoryOptions($editingId ?: null),
        'editing_category' => $editingCategory,
        'category_form_values' => $failedCategory['category'],
        'category_form_is_editing' => $editingId > 0,
        'suggested_ids' => $achievementRepository->suggestedIds(),
        'category_issues' => achievement_validation_error_rows($failedCategory['errors']),
      ));
      break;

    case 22: // Create category.
      check_authorization();
      achievement_verify_csrf();
      $category = achievement_category_from_post();
      $categoryRows = $achievementRepository->listCategories();
      $issues = achievement_validate_category($category, null, array(
        'category_ids' => array_column($categoryRows, 'id'),
        'category_parent_map' => array_column($categoryRows, 'parent_id', 'id')
      ));
      if (achievement_has_blocking_errors($issues)) {
        achievement_store_failed_category($category, $issues, 0);
        achievement_flash('error', 'The category was not saved.', achievement_issue_messages($issues));
        achievement_redirect(20);
      }
      $categoryId = $achievementRepository->createCategory($category);
      achievement_flash('success', 'Category ' . $categoryId . ' was created.');
      achievement_redirect(20, array('category_id' => $categoryId));
      break;

    case 24: // Update category.
      check_authorization();
      achievement_verify_csrf();
      $category = achievement_category_from_post();
      $categoryId = $category['id'];
      $issues = achievement_validate_category(
        $category,
        $categoryId,
        achievement_category_validation_context($achievementRepository->listCategories())
      );
      if (achievement_has_blocking_errors($issues)) {
        achievement_store_failed_category($category, $issues, $categoryId);
        achievement_flash('error', 'The category was not saved.', achievement_issue_messages($issues));
        achievement_redirect(20, array('category_id' => $categoryId));
      }
      $achievementRepository->updateCategory($categoryId, $category);
      achievement_flash('success', 'Category ' . $categoryId . ' was saved.');
      achievement_redirect(20, array('category_id' => $categoryId));
      break;

    case 25: // Delete empty category.
      check_authorization();
      $categoryId = achievement_post_uint('category_id', 'Category ID', 1);
      achievement_require_confirmation('DELETE ' . $categoryId);
      $achievementRepository->deleteCategory($categoryId);
      achievement_flash('warning', 'Category ' . $categoryId . ' was deleted.');
      achievement_redirect(20);
      break;

    case 70: // Embedded authoring guide.
      achievement_render_template('templates/achievements/guide.tmpl.php', array(
        'metadata' => achievement_metadata(),
      ));
      break;

    // Character actions are wired below once the split-database service is loaded.
    case 40:
    case 41:
    case 42:
    case 43:
    case 44:
    case 45:
    case 46:
    case 47:
    case 48:
      require('lib/character_achievements.php');
      break;

    default:
      throw new AchievementHttpException('Unknown achievement editor action.');
  }
}
catch (AchievementRepositoryException $exception) {
  achievement_log_exception('repository operation', $exception);
  if ((int) $action === 60) {
    achievement_json_response(array(
      'error' => 'Achievement lookup data is temporarily unavailable. Reload the editor and try again.'
    ), 503);
  }
  $details = achievement_repository_public_details($exception);
  achievement_flash('error', 'The achievement operation could not be completed.', $details);
  if (isset($_SERVER['REQUEST_METHOD']) && strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') {
    $failedAction = (int) $action;
    if (($failedAction === 2 || $failedAction === 4) && isset($definition) && is_array($definition)) {
      $field = method_exists($exception, 'getField') ? $exception->getField() : 'achievement';
      $repositoryIssues = array(array(
        'path' => (string) $field,
        'message' => $exception->getMessage(),
        'severity' => 'error',
      ));
      achievement_store_failed_graph(
        $definition,
        $repositoryIssues,
        $failedAction === 4 && isset($definition['id']) ? 'edit:' . (int) $definition['id'] : 'create'
      );
      if ($failedAction === 4 && isset($definition['id'])) {
        achievement_redirect(3, array('achievement_id' => (int) $definition['id']));
      }
      achievement_redirect(1);
    }
    if (in_array($failedAction, array(22, 24), true) && isset($category) && is_array($category)) {
      $field = method_exists($exception, 'getField') ? $exception->getField() : 'category';
      $repositoryIssues = array(array(
        'path' => (string) $field,
        'message' => $exception->getMessage(),
        'severity' => 'error',
      ));
      $editingCategoryId = $failedAction === 24 && isset($category['id']) ? (int) $category['id'] : 0;
      achievement_store_failed_category($category, $repositoryIssues, $editingCategoryId);
      achievement_redirect(20, $editingCategoryId > 0 ? array('category_id' => $editingCategoryId) : array());
    }
    if (in_array($failedAction, array(22, 24, 25), true)) {
      achievement_redirect(20);
    }
    achievement_redirect(0);
  }
  achievement_render_template('templates/achievements/error.tmpl.php', array(
    'error_title' => 'Achievement data could not be loaded',
    'error_message' => $exception->getMessage(),
    'error_details' => $details,
  ));
}
catch (AchievementHttpException $exception) {
  if ((int) $action === 60) {
    achievement_json_response(array('error' => $exception->getMessage()), 400);
  }
  achievement_flash('error', $exception->getMessage());
  if (isset($_SERVER['REQUEST_METHOD']) && strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') {
    $failedAction = (int) $action;
    if (in_array($failedAction, array(42, 43, 44, 45, 46, 47, 48), true)) {
      $characterId = isset($_POST['playerid']) && ctype_digit((string) $_POST['playerid'])
        ? (int) $_POST['playerid']
        : 0;
      achievement_redirect($characterId > 0 ? 41 : 40, $characterId > 0 ? array('playerid' => $characterId) : array());
    }
    if (in_array($failedAction, array(22, 24, 25), true)) {
      achievement_redirect(20);
    }
    achievement_redirect(0);
  }
  achievement_render_template('templates/achievements/error.tmpl.php', array(
    'error_title' => 'Invalid achievement editor request',
    'error_message' => $exception->getMessage(),
    'error_details' => array(),
  ));
}
catch (CharacterAchievementServiceException $exception) {
  achievement_log_exception('character achievement operation', $exception);
  achievement_flash('error', $exception->getMessage());
  if (isset($_SERVER['REQUEST_METHOD']) && strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') {
    $characterId = isset($_POST['playerid']) && ctype_digit((string) $_POST['playerid'])
      ? (int) $_POST['playerid']
      : 0;
    achievement_redirect($characterId > 0 ? 41 : 40, $characterId > 0 ? array('playerid' => $characterId) : array());
  }
  achievement_render_template('templates/achievements/error.tmpl.php', array(
    'error_title' => 'Character achievement operation failed',
    'error_message' => $exception->getMessage(),
    'error_details' => array(),
  ));
}
catch (Throwable $exception) {
  achievement_log_exception('unexpected failure', $exception);
  if ((int) $action === 60) {
    achievement_json_response(array(
      'error' => 'The achievement lookup could not be completed. Check the server error log for details.'
    ), 500);
  }
  achievement_flash(
    'error',
    'The editor encountered an unexpected error. No partial graph was intentionally saved.'
  );
  if (isset($_SERVER['REQUEST_METHOD']) && strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') {
    if (in_array((int) $action, array(42, 43, 44, 45, 46, 47, 48), true)) {
      $characterId = isset($_POST['playerid']) && ctype_digit((string) $_POST['playerid'])
        ? (int) $_POST['playerid']
        : 0;
      achievement_redirect($characterId > 0 ? 41 : 40, $characterId > 0 ? array('playerid' => $characterId) : array());
    }
    achievement_redirect(0);
  }
  achievement_render_template('templates/achievements/error.tmpl.php', array(
    'error_title' => 'Achievement editor error',
    'error_message' => 'The request could not be completed. Check the server error log for details.',
    'error_details' => array(),
  ));
}

?>
