<?php

if (!class_exists('CharacterAchievementService', false)) {
  require_once dirname(__DIR__) . '/classes/character_achievement_service.php';
}

$character_achievement_service_assertions = 0;

function character_achievement_service_assert($condition, $message)
{
  global $character_achievement_service_assertions;
  ++$character_achievement_service_assertions;
  if (!$condition) {
    fwrite(STDERR, 'FAIL: ' . $message . PHP_EOL);
    exit(1);
  }
}

function character_achievement_service_contains(array $values, $needle)
{
  foreach ($values as $value) {
    if (stripos((string) $value, (string) $needle) !== false) {
      return true;
    }
  }

  return false;
}

class CharacterAchievementServiceTestMetadata
{
  private $fields;

  public function __construct(array $fields)
  {
    $this->fields = $fields;
  }

  public function fetch_fields()
  {
    $result = array();
    foreach ($this->fields as $fieldName) {
      $field = new stdClass();
      $field->name = $fieldName;
      $result[] = $field;
    }

    return $result;
  }
}

class CharacterAchievementServiceTestStatement
{
  public $error = '';
  public $affected_rows = 0;

  private $database;
  private $sql;
  private $parameters = array();
  private $fields = array();
  private $rows = array();
  private $bindings = array();
  private $cursor = 0;

  public function __construct($database, $sql)
  {
    $this->database = $database;
    $this->sql = $sql;
  }

  public function bind_param($types, &...$parameters)
  {
    foreach ($parameters as $index => &$parameter) {
      $this->parameters[$index] =& $parameter;
    }

    return true;
  }

  public function execute()
  {
    $parameters = array();
    foreach ($this->parameters as $parameter) {
      $parameters[] = $parameter;
    }
    $result = $this->database->executeQuery($this->sql, $parameters);
    $this->fields = $result['fields'];
    $this->rows = $result['rows'];
    $this->affected_rows = isset($result['affected_rows'])
      ? (int) $result['affected_rows']
      : 0;
    $this->cursor = 0;

    return true;
  }

  public function result_metadata()
  {
    return empty($this->fields)
      ? false
      : new CharacterAchievementServiceTestMetadata($this->fields);
  }

  public function bind_result(&...$bindings)
  {
    foreach ($bindings as $index => &$binding) {
      $this->bindings[$index] =& $binding;
    }

    return true;
  }

  public function fetch()
  {
    if (!isset($this->rows[$this->cursor])) {
      return false;
    }

    $row = $this->rows[$this->cursor++];
    foreach ($this->fields as $index => $fieldName) {
      $this->bindings[$index] = array_key_exists($fieldName, $row)
        ? $row[$fieldName]
        : null;
    }

    return true;
  }

  public function close()
  {
    return true;
  }
}

class CharacterAchievementServiceTestDatabase
{
  public $error = '';
  public $schema = array();
  public $online = false;
  public $stateAchievementIds = array();
  public $definedAchievementIds = array();
  public $definitionVersions = array();
  public $queries = array();
  public $updateStatus = null;
  public $updateVersion = 0;
  public $deletedUpdates = 0;
  public $retriedUpdates = 0;
  public $selectionStatus = null;
  public $selectedOptionId = 0;
  public $sourceEnabled = 1;
  public $setEnabled = 1;
  public $rewardOptions = array();
  public $rewardMappings = array();
  public $retryableRewardLedgerUpdates = 0;
  public $retryableSelectionUpdates = 0;
  public $completionVersion = null;
  public $progressVersions = array();
  public $forcedCompletions = 0;

  private $name;

  public function __construct($name)
  {
    $this->name = $name;
  }

  public function prepare($sql)
  {
    return new CharacterAchievementServiceTestStatement($this, $sql);
  }

  public function begin_transaction()
  {
    return true;
  }

  public function commit()
  {
    return true;
  }

  public function rollback()
  {
    return true;
  }

  public function executeQuery($sql, array $parameters)
  {
    $this->queries[] = $sql;

    if (stripos($sql, 'SELECT DATABASE() AS database_name') !== false) {
      return array(
        'fields' => array('database_name'),
        'rows' => array(array('database_name' => $this->name))
      );
    }

    if (stripos($sql, 'SELECT GET_LOCK(') !== false) {
      return array('fields' => array('acquired'), 'rows' => array(array('acquired' => 1)));
    }

    if (stripos($sql, 'SELECT RELEASE_LOCK(') !== false) {
      return array('fields' => array('released'), 'rows' => array(array('released' => 1)));
    }

    if (stripos($sql, 'information_schema.TABLES') !== false) {
      $rows = array();
      foreach ($parameters as $tableName) {
        if (isset($this->schema[$tableName])) {
          $rows[] = array(
            'TABLE_NAME' => $tableName,
            'ENGINE' => $this->schema[$tableName]['engine']
          );
        }
      }
      return array('fields' => array('TABLE_NAME', 'ENGINE'), 'rows' => $rows);
    }

    if (stripos($sql, 'information_schema.COLUMNS') !== false) {
      $rows = array();
      foreach ($parameters as $tableName) {
        if (!isset($this->schema[$tableName])) {
          continue;
        }
        foreach ($this->schema[$tableName]['columns'] as $columnName => $column) {
          $rows[] = array(
            'TABLE_NAME' => $tableName,
            'COLUMN_NAME' => $columnName,
            'DATA_TYPE' => $column['data_type'],
            'COLUMN_TYPE' => $column['type'],
            'IS_NULLABLE' => $column['nullable'] ? 'YES' : 'NO',
            'CHARACTER_MAXIMUM_LENGTH' => $column['maximum_length'],
            'EXTRA' => $column['extra']
          );
        }
      }
      return array(
        'fields' => array(
          'TABLE_NAME', 'COLUMN_NAME', 'DATA_TYPE', 'COLUMN_TYPE',
          'IS_NULLABLE', 'CHARACTER_MAXIMUM_LENGTH', 'EXTRA'
        ),
        'rows' => $rows
      );
    }

    if (stripos($sql, 'information_schema.STATISTICS') !== false) {
      $rows = array();
      foreach ($parameters as $tableName) {
        if (!isset($this->schema[$tableName])) {
          continue;
        }
        foreach ($this->schema[$tableName]['indexes'] as $indexName => $index) {
          foreach ($index['columns'] as $sequence => $columnName) {
            $rows[] = array(
              'TABLE_NAME' => $tableName,
              'INDEX_NAME' => $indexName,
              'NON_UNIQUE' => $index['unique'] ? 0 : 1,
              'SEQ_IN_INDEX' => $sequence + 1,
              'COLUMN_NAME' => $columnName,
              'SUB_PART' => !empty($index['prefix']) ? 8 : null
            );
          }
        }
      }
      return array(
        'fields' => array(
          'TABLE_NAME', 'INDEX_NAME', 'NON_UNIQUE',
          'SEQ_IN_INDEX', 'COLUMN_NAME', 'SUB_PART'
        ),
        'rows' => $rows
      );
    }

    if (
      stripos($sql, 'SELECT achievement_id FROM character_achievements') !== false &&
      stripos($sql, 'UNION') !== false
    ) {
      $rows = array();
      foreach ($this->stateAchievementIds as $achievementId) {
        $rows[] = array('achievement_id' => $achievementId);
      }
      return array('fields' => array('achievement_id'), 'rows' => $rows);
    }

    if (stripos($sql, 'SELECT id FROM achievements WHERE id IN') !== false) {
      $rows = array();
      foreach ($parameters as $achievementId) {
        if (in_array((int) $achievementId, $this->definedAchievementIds, true)) {
          $rows[] = array('id' => $achievementId);
        }
      }
      return array('fields' => array('id'), 'rows' => $rows);
    }

    if (stripos($sql, 'SELECT 1 AS present FROM achievements WHERE id = ?') !== false) {
      $exists = isset($parameters[0]) && in_array(
        (int) $parameters[0],
        $this->definedAchievementIds,
        true
      );
      return array(
        'fields' => array('present'),
        'rows' => $exists ? array(array('present' => 1)) : array()
      );
    }

    if (stripos($sql, 'SELECT id, version, enabled') !== false && stripos($sql, 'FROM achievements WHERE id = ?') !== false) {
      $achievementId = isset($parameters[0]) ? (int) $parameters[0] : 0;
      $exists = in_array($achievementId, $this->definedAchievementIds, true);
      return array(
        'fields' => array('id', 'version', 'enabled'),
        'rows' => $exists ? array(array(
          'id' => $achievementId,
          'version' => isset($this->definitionVersions[$achievementId])
            ? $this->definitionVersions[$achievementId]
            : 0,
          'enabled' => 1
        )) : array()
      );
    }

    if (
      stripos($sql, 'SELECT version FROM character_achievements') !== false &&
      stripos($sql, 'WHERE character_id = ? AND achievement_id = ? FOR UPDATE') !== false
    ) {
      return array(
        'fields' => array('version'),
        'rows' => $this->completionVersion === null
          ? array()
          : array(array('version' => $this->completionVersion))
      );
    }

    if (
      stripos($sql, 'SELECT version FROM character_achievement_progress') !== false &&
      stripos($sql, 'WHERE character_id = ? AND achievement_id = ? FOR UPDATE') !== false
    ) {
      $rows = array();
      foreach ($this->progressVersions as $version) {
        $rows[] = array('version' => $version);
      }
      return array('fields' => array('version'), 'rows' => $rows);
    }

    if (stripos($sql, 'INSERT INTO character_achievements') !== false) {
      ++$this->forcedCompletions;
      return array('fields' => array(), 'rows' => array(), 'affected_rows' => 1);
    }

    if (
      stripos($sql, 'SELECT 1 AS present') !== false &&
      stripos($sql, 'FROM reward_sources') !== false
    ) {
      return array('fields' => array('present'), 'rows' => array(array('present' => 1)));
    }

    if (stripos($sql, 'SELECT source.enabled AS source_enabled, reward_set.enabled AS set_enabled') !== false) {
      return array(
        'fields' => array('source_enabled', 'set_enabled'),
        'rows' => array(array(
          'source_enabled' => $this->sourceEnabled,
          'set_enabled' => $this->setEnabled
        ))
      );
    }

    if (stripos($sql, 'SELECT option_id, common_to_all, enabled') !== false && stripos($sql, 'FROM reward_options') !== false) {
      return array(
        'fields' => array('option_id', 'common_to_all', 'enabled'),
        'rows' => $this->rewardOptions
      );
    }

    if (stripos($sql, 'SELECT mapping.option_id, mapping.reward_id') !== false) {
      return array(
        'fields' => array('option_id', 'reward_id', 'catalog_reward_id', 'reward_enabled'),
        'rows' => $this->rewardMappings
      );
    }

    if (
      stripos($sql, 'SELECT 1 AS present FROM character_achievements') !== false &&
      stripos($sql, 'UNION ALL') !== false
    ) {
      $achievementId = isset($parameters[1]) ? (int) $parameters[1] : 0;
      $exists = in_array($achievementId, $this->stateAchievementIds, true);
      return array(
        'fields' => array('present'),
        'rows' => $exists ? array(array('present' => 1)) : array()
      );
    }

    if (
      stripos($sql, 'WHERE character_id = ? AND achievement_id IN') !== false &&
      preg_match('/FROM\s+character_achievement[a-z_]+/i', $sql)
    ) {
      $rows = array();
      foreach (array_slice($parameters, 1) as $achievementId) {
        if (in_array((int) $achievementId, $this->stateAchievementIds, true)) {
          $rows[] = array('achievement_id' => $achievementId);
        }
      }
      return array('fields' => array('achievement_id'), 'rows' => $rows);
    }

    if (
      stripos($sql, 'SELECT update_id, status FROM character_achievement_pending_updates') !== false
    ) {
      return array(
        'fields' => array('update_id', 'status'),
        'rows' => $this->updateStatus === null
          ? array()
          : array(array('update_id' => 1, 'status' => $this->updateStatus))
      );
    }

    if (stripos($sql, 'SELECT version, status') !== false && stripos($sql, 'FROM character_achievement_pending_updates') !== false) {
      return array(
        'fields' => array('version', 'status'),
        'rows' => $this->updateStatus === null
          ? array()
          : array(array('version' => $this->updateVersion, 'status' => $this->updateStatus))
      );
    }

    if (stripos($sql, 'UPDATE character_achievement_pending_updates') !== false) {
      ++$this->retriedUpdates;
      return array('fields' => array(), 'rows' => array(), 'affected_rows' => 1);
    }

    if (stripos($sql, 'SELECT selected_option_id, status') !== false && stripos($sql, 'FROM character_achievement_reward_selections') !== false) {
      return array(
        'fields' => array('selected_option_id', 'status'),
        'rows' => $this->selectionStatus === null
          ? array()
          : array(array(
            'selected_option_id' => $this->selectedOptionId,
            'status' => $this->selectionStatus
          ))
      );
    }

    if (stripos($sql, 'UPDATE character_achievement_rewards') !== false && stripos($sql, 'status = 0') !== false) {
      ++$this->retryableRewardLedgerUpdates;
      return array('fields' => array(), 'rows' => array(), 'affected_rows' => 1);
    }

    if (stripos($sql, 'UPDATE character_achievement_reward_selections') !== false) {
      ++$this->retryableSelectionUpdates;
      return array('fields' => array(), 'rows' => array(), 'affected_rows' => 1);
    }

    if (stripos($sql, 'DELETE FROM character_achievement_pending_updates') !== false) {
      ++$this->deletedUpdates;
      return array('fields' => array(), 'rows' => array(), 'affected_rows' => 1);
    }

    if (stripos($sql, 'FROM character_data') !== false) {
      return array(
        'fields' => array('id', 'ingame'),
        'rows' => array(array('id' => 1, 'ingame' => $this->online ? 1 : 0))
      );
    }

    throw new RuntimeException('Unexpected test SQL: ' . $sql);
  }
}

function character_achievement_service_column_type(array $shapeSpec, $tableName, $columnName)
{
  if (isset($shapeSpec[$tableName])) {
    foreach (array('tinyint', 'int', 'bigint', 'text') as $dataType) {
      if (
        isset($shapeSpec[$tableName][$dataType]) &&
        in_array($columnName, $shapeSpec[$tableName][$dataType], true)
      ) {
        return array($dataType, null);
      }
    }
    if (
      isset($shapeSpec[$tableName]['varchar']) &&
      array_key_exists($columnName, $shapeSpec[$tableName]['varchar'])
    ) {
      return array('varchar', (int) $shapeSpec[$tableName]['varchar'][$columnName]);
    }
  }

  return array('varchar', 255);
}

function character_achievement_service_schema_fixture(array $spec, array $shapeSpec)
{
  $schema = array();
  foreach ($spec as $tableName => $requirements) {
    $columns = array();
    foreach ($requirements['columns'] as $columnName) {
      list($dataType, $maximumLength) = character_achievement_service_column_type(
        $shapeSpec,
        $tableName,
        $columnName
      );
      $columns[$columnName] = array(
        'data_type' => $dataType,
        'type' => $dataType .
          ($dataType === 'varchar' ? '(' . $maximumLength . ')' : '') .
          (in_array($columnName, $requirements['unsigned'], true) ? ' unsigned' : ''),
        'nullable' => false,
        'maximum_length' => $maximumLength,
        'extra' => in_array($columnName, $requirements['auto_increment'], true)
          ? 'auto_increment'
          : ''
      );
    }
    $indexes = array();
    foreach ($requirements['indexes'] as $index => $requiredIndex) {
      $indexes['fixture_' . $index] = array(
        'unique' => $requiredIndex['unique'],
        'columns' => $requiredIndex['columns'],
        'prefix' => false
      );
    }
    $schema[$tableName] = array(
      'engine' => 'InnoDB',
      'columns' => $columns,
      'indexes' => $indexes
    );
  }

  return $schema;
}

$characterDatabase = new CharacterAchievementServiceTestDatabase('peq_character');
$contentDatabase = new CharacterAchievementServiceTestDatabase('peq_content');
$service = new CharacterAchievementService($characterDatabase, $contentDatabase);
$reflection = new ReflectionClass($service);
$characterSpecMethod = $reflection->getMethod('characterSchemaSpec');
$characterSpecMethod->setAccessible(true);
$contentSpecMethod = $reflection->getMethod('contentSchemaSpec');
$contentSpecMethod->setAccessible(true);
$shapeSpecMethod = $reflection->getMethod('schemaColumnShapeSpec');
$shapeSpecMethod->setAccessible(true);
$characterSpec = $characterSpecMethod->invoke($service);
$contentSpec = $contentSpecMethod->invoke($service);
$shapeSpec = $shapeSpecMethod->invoke($service);
$shapeRequirementMethod = $reflection->getMethod('columnShapeRequirement');
$shapeRequirementMethod->setAccessible(true);
foreach (array_merge($characterSpec, $contentSpec) as $tableName => $requirements) {
  foreach ($requirements['columns'] as $columnName) {
    if (
      $tableName === 'character_data' &&
      !in_array($columnName, array('id', 'ingame'), true)
    ) {
      continue;
    }
    character_achievement_service_assert(
      $shapeRequirementMethod->invoke($service, $shapeSpec, $tableName, $columnName) !== null,
      $tableName . '.' . $columnName . ' has an authoritative base type/nullability rule'
    );
  }
}
$characterDatabase->schema = character_achievement_service_schema_fixture($characterSpec, $shapeSpec);
$contentDatabase->schema = character_achievement_service_schema_fixture($contentSpec, $shapeSpec);

$ready = $service->schemaDiagnostics(true);
character_achievement_service_assert($ready['ready'], 'a complete InnoDB schema is ready');
character_achievement_service_assert(
  $ready['character_database'] === 'peq_character' && $ready['content_database'] === 'peq_content',
  'split database names remain visible in diagnostics'
);
character_achievement_service_assert(
  empty($ready['character_missing']) && empty($ready['content_missing']),
  'complete schema reports no missing tables'
);

$finalContentSchema = $contentDatabase->schema;
unset($contentDatabase->schema['reward_sources']);
unset($contentDatabase->schema['reward_source_entries']);
$oldSchemaBlocked = $service->schemaDiagnostics(true);
character_achievement_service_assert(
  !$oldSchemaBlocked['ready'] &&
    character_achievement_service_contains($oldSchemaBlocked['content_errors'], 'reward_sources') &&
    character_achievement_service_contains($oldSchemaBlocked['content_errors'], 'reward_source_entries'),
  'the superseded achievement-owned reward schema fails closed without provider source tables'
);
$contentDatabase->schema = $finalContentSchema;
$service->schemaDiagnostics(true);

$characterDatabase->schema['character_achievement_rewards']['engine'] = 'MyISAM';
$characterDatabase->schema['character_achievements']['columns']['achievement_id']['data_type'] = 'smallint';
$characterDatabase->schema['character_achievements']['columns']['achievement_id']['type'] = 'smallint unsigned';
$characterDatabase->schema['character_achievement_rewards']['columns']['last_error']['maximum_length'] = 64;
$characterDatabase->schema['character_achievement_progress']['columns']['updated_at']['nullable'] = true;
$contentDatabase->schema['achievement_criteria']['columns']['required_count']['type'] = 'int(10)';
$contentDatabase->schema['achievement_criteria']['columns']['target_value']['type'] = 'bigint unsigned';
unset($contentDatabase->schema['rewards']['columns']['description']);
$contentDatabase->schema['reward_option_entries']['indexes']['fixture_0']['prefix'] = true;
$blocked = $service->schemaDiagnostics(true);
character_achievement_service_assert(!$blocked['ready'], 'unsafe schema is blocked');
character_achievement_service_assert(
  character_achievement_service_contains($blocked['character_errors'], 'must use InnoDB'),
  'non-transactional character state is diagnosed'
);
character_achievement_service_assert(
  character_achievement_service_contains($blocked['character_errors'], 'achievement_id must use INT'),
  'undersized integer identities are diagnosed'
);
character_achievement_service_assert(
  character_achievement_service_contains($blocked['character_errors'], 'last_error must allow at least 255'),
  'undersized diagnostic storage is diagnosed'
);
character_achievement_service_assert(
  character_achievement_service_contains($blocked['character_errors'], 'updated_at must be NOT NULL'),
  'nullable runtime state columns are diagnosed'
);
character_achievement_service_assert(
  character_achievement_service_contains($blocked['content_errors'], 'required_count must be unsigned'),
  'signed numeric content column is diagnosed'
);
character_achievement_service_assert(
  character_achievement_service_contains($blocked['content_errors'], 'target_value must be signed'),
  'unsigned criterion values that cannot represent negatives are diagnosed'
);
character_achievement_service_assert(
  character_achievement_service_contains($blocked['content_errors'], 'missing required column description'),
  'missing content column is diagnosed'
);
character_achievement_service_assert(
  character_achievement_service_contains($blocked['content_errors'], 'reward_set_id, option_id, reward_id'),
  'prefix indexes cannot satisfy an exact idempotency identity'
);
$schemaGateMethod = $reflection->getMethod('assertSchemaReadyForWrite');
$schemaGateMethod->setAccessible(true);
$schemaGateRejected = false;
try {
  $schemaGateMethod->invoke($service);
}
catch (CharacterAchievementValidationException $exception) {
  $schemaGateRejected = stripos($exception->getMessage(), 'schema is incomplete or unsafe') !== false;
}
character_achievement_service_assert(
  $schemaGateRejected,
  'direct service writes cannot bypass failed schema readiness'
);

$characterDatabase->online = true;
$lockMethod = $reflection->getMethod('lockCharacter');
$lockMethod->setAccessible(true);
$offlineRejected = false;
try {
  $lockMethod->invoke($service, 1, true, 'Test repair is offline-only.');
}
catch (CharacterAchievementValidationException $exception) {
  $offlineRejected = $exception->getMessage() === 'Test repair is offline-only.';
}
character_achievement_service_assert(
  $offlineRejected,
  'operation-specific offline safety errors are returned for live characters'
);

$matchingIndexMethod = $reflection->getMethod('hasMatchingIndex');
$matchingIndexMethod->setAccessible(true);
$prefixMatch = $matchingIndexMethod->invoke(
  $service,
  array(array('unique' => true, 'columns' => array('id'), 'full_columns' => false)),
  array('id'),
  true
);
character_achievement_service_assert(!$prefixMatch, 'prefix indexes never satisfy exact identity checks');

$characterDatabase->stateAchievementIds = array(100, 200);
$contentDatabase->definedAchievementIds = array(100);
$characterDatabase->queries = array();
$contentDatabase->queries = array();
$orphans = $service->characterOrphanState(1);
character_achievement_service_assert(
  $orphans['achievement_ids'] === array(200),
  'split-database orphan comparison retains only IDs missing from content'
);
foreach (array(
  'completions', 'progress', 'reward_ledgers',
  'reward_selections', 'pending_updates'
) as $stateKind) {
  character_achievement_service_assert(
    count($orphans[$stateKind]) === 1 && (int) $orphans[$stateKind][0]['achievement_id'] === 200,
    'orphan API hydrates only orphan ' . $stateKind
  );
}
$orphanSql = implode("\n", array_merge($characterDatabase->queries, $contentDatabase->queries));
character_achievement_service_assert(
  stripos($orphanSql, 'achievement_components') === false &&
    stripos($orphanSql, 'achievement_criteria') === false,
  'orphan detection does not load definition graphs'
);

$characterDatabase->queries = array();
$contentDatabase->queries = array();
$emptySubset = $service->characterStateInputs(1, array(), false);
character_achievement_service_assert(
  empty($emptySubset['definitions']) && empty($emptySubset['progress']),
  'an explicit empty subset returns an empty catalog and state payload'
);
character_achievement_service_assert(
  count($contentDatabase->queries) === 0,
  'an explicit empty subset performs no content graph queries'
);

$definitionOrStateMethod = $reflection->getMethod('achievementDefinitionOrStateExists');
$definitionOrStateMethod->setAccessible(true);
character_achievement_service_assert(
  $definitionOrStateMethod->invoke($service, 1, 200),
  'reset eligibility retains deleted definitions when durable state exists'
);
character_achievement_service_assert(
  !$definitionOrStateMethod->invoke($service, 1, 300),
  'reset eligibility rejects IDs with neither a definition nor durable state'
);

$characterDatabase->schema = character_achievement_service_schema_fixture($characterSpec, $shapeSpec);
$contentDatabase->schema = character_achievement_service_schema_fixture($contentSpec, $shapeSpec);
$service->schemaDiagnostics(true);
$offlineOperations = array(
  'Exact achievement progress' => function () use ($service) {
    $service->setExactProgress(1, 100, 0, 1, 1);
  },
  'Achievement reset' => function () use ($service) {
    $service->reset(1, 100, true);
  },
  'Reward retry' => function () use ($service) {
    $service->markRewardRetryable(1, 100, 1, true);
  },
  'Reward-selection retry' => function () use ($service) {
    $service->markSelectionRetryable(1, 100, 1, true);
  }
);
foreach ($offlineOperations as $messageFragment => $operation) {
  $operationRejected = false;
  try {
    $operation();
  }
  catch (CharacterAchievementValidationException $exception) {
    $operationRejected = stripos($exception->getMessage(), $messageFragment) !== false &&
      stripos($exception->getMessage(), 'offline-only') !== false;
  }
  character_achievement_service_assert(
    $operationRejected,
    $messageFragment . ' rejects a live character before direct state writes'
  );
}
$characterDatabase->updateStatus = CharacterAchievementService::UPDATE_STATUS_PROCESSING;
$processingRejected = false;
try {
  $service->discardUpdate(1, 200, 1, true);
}
catch (CharacterAchievementValidationException $exception) {
  $processingRejected = stripos($exception->getMessage(), 'processing cannot be discarded') !== false;
}
character_achievement_service_assert(
  $processingRejected && $characterDatabase->deletedUpdates === 0,
  'processing updates cannot be discarded while server ownership is ambiguous'
);
$characterDatabase->updateStatus = CharacterAchievementService::UPDATE_STATUS_PENDING;
character_achievement_service_assert(
  $service->discardUpdate(1, 200, 1, true) === true &&
    $characterDatabase->deletedUpdates === 1,
  'stable pending updates remain explicitly discardable'
);

$contentDatabase->definedAchievementIds = array(100, 200);
$contentDatabase->definitionVersions[200] = 0;
$characterDatabase->updateStatus = CharacterAchievementService::UPDATE_STATUS_BLOCKED;
$characterDatabase->updateVersion = 0;
$characterDatabase->retriedUpdates = 0;
character_achievement_service_assert(
  $service->retryBlockedUpdate(1, 200, 1) === true &&
    $characterDatabase->retriedUpdates === 1,
  'pending-update version zero retries against current definition version zero'
);
$characterDatabase->updateVersion = 1;
$mismatchedZeroRejected = false;
try {
  $service->retryBlockedUpdate(1, 200, 1);
}
catch (CharacterAchievementValidationException $exception) {
  $mismatchedZeroRejected = stripos($exception->getMessage(), 'current definition is version 0') !== false;
}
character_achievement_service_assert(
  $mismatchedZeroRejected && $characterDatabase->retriedUpdates === 1,
  'version zero is compared exactly and never treated as a wildcard sentinel'
);

$characterDatabase->online = false;
$contentDatabase->definitionVersions[100] = 0;
$characterDatabase->completionVersion = null;
$characterDatabase->progressVersions = array(1);
$characterDatabase->forcedCompletions = 0;
$forceMismatchRejected = false;
try {
  $service->forceCompleteOffline(1, 100, true);
}
catch (CharacterAchievementValidationException $exception) {
  $forceMismatchRejected = stripos($exception->getMessage(), 'different exact definition version') !== false;
}
character_achievement_service_assert(
  $forceMismatchRejected && $characterDatabase->forcedCompletions === 0,
  'force completion rejects progress from any other exact version when the current definition is version zero'
);
$characterDatabase->progressVersions = array(0);
$forceVersionZeroResult = $service->forceCompleteOffline(1, 100, true);
character_achievement_service_assert(
  (int) $forceVersionZeroResult['version'] === 0 && $characterDatabase->forcedCompletions === 1,
  'force completion accepts existing progress only when version zero matches exactly'
);
$characterDatabase->progressVersions = array();
$characterDatabase->selectionStatus = CharacterAchievementService::SELECTION_STATUS_AMBIGUOUS;
$characterDatabase->selectedOptionId = 100;
$contentDatabase->sourceEnabled = 1;
$contentDatabase->setEnabled = 1;
$contentDatabase->rewardOptions = array(
  array('option_id' => 1, 'common_to_all' => 1, 'enabled' => 1),
  array('option_id' => 100, 'common_to_all' => 0, 'enabled' => 1)
);
$contentDatabase->rewardMappings = array(
  array('option_id' => 1, 'reward_id' => 7001, 'catalog_reward_id' => 7001, 'reward_enabled' => 1),
  array('option_id' => 100, 'reward_id' => 7002, 'catalog_reward_id' => 7002, 'reward_enabled' => 1)
);
$characterDatabase->queries = array();
$characterDatabase->retryableRewardLedgerUpdates = 0;
$characterDatabase->retryableSelectionUpdates = 0;
character_achievement_service_assert(
  $service->markSelectionRetryable(1, 100, 500, true) === true,
  'an enabled source/set with valid selected and common grants is retryable'
);
$retryQueryText = implode("\n", $characterDatabase->queries);
$rewardRetryPosition = stripos($retryQueryText, 'UPDATE character_achievement_rewards');
$selectionRetryPosition = stripos($retryQueryText, 'UPDATE character_achievement_reward_selections');
character_achievement_service_assert(
  $characterDatabase->retryableRewardLedgerUpdates === 1 &&
    $characterDatabase->retryableSelectionUpdates === 1 &&
    $rewardRetryPosition !== false && $selectionRetryPosition !== false &&
    $rewardRetryPosition < $selectionRetryPosition,
  'selection retry atomically makes selected/common status-0 grant ledgers retryable before the selection ledger'
);

$contentDatabase->sourceEnabled = 0;
$characterDatabase->retryableRewardLedgerUpdates = 0;
$characterDatabase->retryableSelectionUpdates = 0;
$disabledSourceRejected = false;
try {
  $service->markSelectionRetryable(1, 100, 500, true);
}
catch (CharacterAchievementValidationException $exception) {
  $disabledSourceRejected = stripos($exception->getMessage(), 'source') !== false &&
    stripos($exception->getMessage(), 'disabled') !== false;
}
character_achievement_service_assert(
  $disabledSourceRejected &&
    $characterDatabase->retryableRewardLedgerUpdates === 0 &&
    $characterDatabase->retryableSelectionUpdates === 0,
  'selection retry fails closed when the achievement source mapping is disabled'
);

$selectableIndividualRejected = false;
try {
  $service->markRewardRetryable(1, 100, 7002, true);
}
catch (CharacterAchievementValidationException $exception) {
  $selectableIndividualRejected = stripos($exception->getMessage(), 'selectable option') !== false;
}
character_achievement_service_assert(
  $selectableIndividualRejected,
  'selectable grants cannot bypass their owning selection bundle through individual retry'
);

echo 'character_achievement_service_test: ' .
  $character_achievement_service_assertions .
  ' assertions passed' . PHP_EOL;
