<?php

/**
 * Optional read-only integration smoke test.
 *
 * It never calls a mutation API. Supply the same DB_HOST/DB_NAME/DB_USER/
 * DB_PASSWORD environment used by PEQ. Split content variables are honored
 * when present. The script exits with a skip message when credentials are not
 * available, so the dependency-free unit suite remains portable.
 */

$root = getenv('ACHIEVEMENT_TEST_ROOT');
if (!$root) {
  $root = dirname(__DIR__);
}

require_once($root . '/lib/achievement_metadata.php');
require_once($root . '/classes/achievement_repository.php');
require_once($root . '/classes/character_achievement_service.php');

function achievement_integration_env($name, $fallback = null) {
  $value = getenv($name);
  return $value === false || $value === '' ? $fallback : $value;
}

function achievement_integration_fail($message) {
  fwrite(STDERR, 'FAIL: ' . $message . PHP_EOL);
  exit(1);
}

$host = achievement_integration_env('DB_HOST');
$database = achievement_integration_env('DB_NAME');
$user = achievement_integration_env('DB_USER');
$password = achievement_integration_env('DB_PASSWORD');
$port = (int) achievement_integration_env('DB_PORT', 3306);

if (!$host || !$database || !$user) {
  echo 'achievement_readonly_integration: skipped (database environment unavailable)' . PHP_EOL;
  exit(0);
}

$characterDb = new mysqli($host, $user, (string) $password, $database, $port);
if ($characterDb->connect_errno) {
  achievement_integration_fail('character database connection failed');
}

$contentHost = achievement_integration_env('CONTENT_DB_HOST', $host);
$contentDatabase = achievement_integration_env('CONTENT_DB_NAME', $database);
$contentUser = achievement_integration_env('CONTENT_DB_USER', $user);
$contentPassword = achievement_integration_env('CONTENT_DB_PASSWORD', $password);
$contentPort = (int) achievement_integration_env('CONTENT_DB_PORT', $port);
$sameConnection = $contentHost === $host
  && $contentDatabase === $database
  && $contentUser === $user
  && $contentPort === $port;
$contentDb = $sameConnection
  ? $characterDb
  : new mysqli($contentHost, $contentUser, (string) $contentPassword, $contentDatabase, $contentPort);
if ($contentDb->connect_errno) {
  achievement_integration_fail('content database connection failed');
}

try {
  $repository = new AchievementRepository($contentDb);
  $definitionDiagnostics = $repository->schemaDiagnostics(true);
  if (!$definitionDiagnostics['ready']) {
    achievement_integration_fail('definition schema is not ready: ' . implode('; ', $definitionDiagnostics['errors']));
  }

  $definitionPage = $repository->listDefinitions(array(), 1, 2, 'name', 'asc');
  if (!isset($definitionPage['rows'], $definitionPage['total'], $definitionPage['pages'])) {
    achievement_integration_fail('definition pagination shape is incomplete');
  }
  if (count($definitionPage['rows']) > 0) {
    $loadedDefinition = $repository->loadDefinition((int) $definitionPage['rows'][0]['id']);
    foreach (array('associations', 'components', 'rewards', 'reward_set', 'restrictions') as $graphKey) {
      if (!array_key_exists($graphKey, $loadedDefinition)) {
        achievement_integration_fail('loaded definition graph is missing ' . $graphKey);
      }
    }
  }

  // Hydration must retain the canonical option mapping that distinguishes
  // common grants from each selectable choice.
  $selectablePage = $repository->listDefinitions(array('reward' => 'selectable'), 1, 10, 'name', 'asc');
  $mappedRewardVerified = false;
  $mappedAchievementIds = array();
  $mappingStatement = $contentDb->prepare(
    'SELECT DISTINCT reward.achievement_id '
    . 'FROM achievement_reward_option_entries mapping '
    . 'INNER JOIN achievement_rewards reward ON reward.reward_id = mapping.reward_id '
    . 'ORDER BY reward.achievement_id LIMIT 10'
  );
  if (!$mappingStatement || !$mappingStatement->execute()) {
    achievement_integration_fail('could not inspect canonical reward mappings');
  }
  $mappingStatement->bind_result($mappedAchievementId);
  while ($mappingStatement->fetch()) {
    $mappedAchievementIds[] = (int) $mappedAchievementId;
  }
  $mappingStatement->close();
  if (!$mappedAchievementIds) {
    foreach ($selectablePage['rows'] as $selectableRow) {
      $mappedAchievementIds[] = (int) $selectableRow['id'];
    }
  }
  foreach ($mappedAchievementIds as $mappedAchievementId) {
    $selectable = $repository->loadDefinition($mappedAchievementId);
    if (!is_array($selectable['reward_set'])) {
      continue;
    }
    $optionIds = array();
    foreach ($selectable['reward_set']['options'] as $option) {
      $optionIds[(string) $option['option_id']] = true;
    }
    foreach ($selectable['rewards'] as $reward) {
      if ($reward['option_id'] === null) {
        continue;
      }
      if (!isset($optionIds[(string) $reward['option_id']])) {
        achievement_integration_fail('reward option mapping was hydrated without its canonical option');
      }
      $mappedRewardVerified = true;
    }
    if ($mappedRewardVerified) {
      break;
    }
  }
  if (!empty($definitionDiagnostics['lookup_sources']['zone'])) {
    $repository->lookup('zone', '407', array(), 5);
  }

  $characters = new CharacterAchievementService($characterDb, $contentDb);
  $characterDiagnostics = $characters->schemaDiagnostics();
  if (!$characterDiagnostics['ready']) {
    achievement_integration_fail(
      'character schema is not ready: ' . implode('; ', $characterDiagnostics['errors'])
    );
  }
  foreach (array(
    'character_database', 'content_database', 'character_errors',
    'content_errors', 'character_tables', 'content_tables'
  ) as $diagnosticKey) {
    if (!array_key_exists($diagnosticKey, $characterDiagnostics)) {
      achievement_integration_fail('character diagnostics are missing ' . $diagnosticKey);
    }
  }

  $characterPage = $characters->listCharacters('', 1, 1);
  if (!isset($characterPage['items'], $characterPage['total'], $characterPage['pages'])) {
    achievement_integration_fail('character pagination shape is incomplete');
  }

  $hydrated = false;
  $orphanHydrated = false;
  if (count($characterPage['items']) > 0) {
    $characterId = (int) $characterPage['items'][0]['id'];
    $emptySubset = $characters->characterStateInputs($characterId, array(), false);
    if (!empty($emptySubset['definitions']) || !empty($emptySubset['progress'])) {
      achievement_integration_fail('explicit empty character subset hydrated unexpected rows');
    }
    $orphanState = $characters->characterOrphanState($characterId);
    foreach (array(
      'achievement_ids', 'completions', 'progress', 'reward_ledgers',
      'reward_selections', 'pending_mutations'
    ) as $orphanKey) {
      if (!array_key_exists($orphanKey, $orphanState)) {
        achievement_integration_fail('orphan character state is missing ' . $orphanKey);
      }
    }
    $orphanHydrated = true;
  }
  if (count($characterPage['items']) > 0 && count($definitionPage['rows']) > 0) {
    $characterId = (int) $characterPage['items'][0]['id'];
    $achievementId = (int) $definitionPage['rows'][0]['id'];
    $inputs = $characters->characterStateInputs($characterId, array($achievementId));
    if (!isset($inputs['character'], $inputs['definitions'], $inputs['progress'], $inputs['reward_ledgers'])) {
      achievement_integration_fail('split-aware character detail hydration shape is incomplete');
    }
    $hydrated = true;
  }

  echo 'achievement_readonly_integration: passed; definitions=' . (int) $definitionPage['total']
    . '; characters=' . (int) $characterPage['total']
    . '; detail_hydrated=' . ($hydrated ? 'yes' : 'no')
    . '; orphan_hydrated=' . ($orphanHydrated ? 'yes' : 'no')
    . '; reward_mapping_verified=' . ($mappedRewardVerified ? 'yes' : 'not-present') . PHP_EOL;
}
catch (Throwable $exception) {
  achievement_integration_fail(get_class($exception) . ': ' . $exception->getMessage());
}
finally {
  if (!$sameConnection) {
    $contentDb->close();
  }
  $characterDb->close();
}

?>
