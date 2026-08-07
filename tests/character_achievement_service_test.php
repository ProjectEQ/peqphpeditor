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
  public $queries = array();
  public $mutationStatus = null;
  public $deletedMutations = 0;

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
      stripos($sql, 'SELECT mutation_id, status FROM character_achievement_pending_mutations') !== false
    ) {
      return array(
        'fields' => array('mutation_id', 'status'),
        'rows' => $this->mutationStatus === null
          ? array()
          : array(array('mutation_id' => 1, 'status' => $this->mutationStatus))
      );
    }

    if (stripos($sql, 'DELETE FROM character_achievement_pending_mutations') !== false) {
      ++$this->deletedMutations;
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

$characterDatabase->schema['character_achievement_rewards']['engine'] = 'MyISAM';
$characterDatabase->schema['character_achievements']['columns']['achievement_id']['data_type'] = 'smallint';
$characterDatabase->schema['character_achievements']['columns']['achievement_id']['type'] = 'smallint unsigned';
$characterDatabase->schema['character_achievement_rewards']['columns']['last_error']['maximum_length'] = 64;
$characterDatabase->schema['character_achievement_progress']['columns']['updated_at']['nullable'] = true;
$contentDatabase->schema['achievement_criteria']['columns']['required_count']['type'] = 'int(10)';
$contentDatabase->schema['achievement_criteria']['columns']['target_value']['type'] = 'bigint unsigned';
unset($contentDatabase->schema['achievement_rewards']['columns']['description']);
$contentDatabase->schema['achievement_reward_option_entries']['indexes']['fixture_0']['prefix'] = true;
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
$schemaGateMethod = $reflection->getMethod('assertSchemaReadyForMutation');
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
  'direct service mutations cannot bypass failed schema readiness'
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
  'reward_selections', 'pending_mutations'
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
$characterDatabase->mutationStatus = CharacterAchievementService::MUTATION_STATUS_PROCESSING;
$processingRejected = false;
try {
  $service->discardMutation(1, 200, 1, true);
}
catch (CharacterAchievementValidationException $exception) {
  $processingRejected = stripos($exception->getMessage(), 'processing cannot be discarded') !== false;
}
character_achievement_service_assert(
  $processingRejected && $characterDatabase->deletedMutations === 0,
  'processing mutations cannot be discarded while server ownership is ambiguous'
);
$characterDatabase->mutationStatus = CharacterAchievementService::MUTATION_STATUS_PENDING;
character_achievement_service_assert(
  $service->discardMutation(1, 200, 1, true) === true &&
    $characterDatabase->deletedMutations === 1,
  'stable pending mutations remain explicitly discardable'
);

echo 'character_achievement_service_test: ' .
  $character_achievement_service_assertions .
  ' assertions passed' . PHP_EOL;
