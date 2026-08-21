<?php

/**
 * Friendly, field-aware persistence error raised by AchievementRepository.
 *
 * The PEQ editor does not have a framework exception/validation layer.  This
 * exception keeps database details out of the UI while still giving a
 * controller enough context to highlight the field or section that failed.
 */
class AchievementRepositoryException extends RuntimeException
{
    private $field;
    private $details;

    public function __construct($message, $field = 'achievement', $details = array(), $previous = null)
    {
        $this->field = (string) $field;
        $this->details = is_array($details) ? $details : array();
        parent::__construct((string) $message, 0, $previous);
    }

    public function getField()
    {
        return $this->field;
    }

    public function getDetails()
    {
        return $this->details;
    }
}

/**
 * Native mysqli repository for achievement content.
 *
 * Content writes use the PEQ content connection. A separate optional character
 * connection is consulted only to prevent reuse of an achievement ID whose
 * durable character history survived content deletion.
 *
 * Every SQL statement is executed through mysqli::prepare(). User input is
 * never interpolated into SQL; the few dynamic identifiers below come only
 * from private allowlists.
 */
class AchievementRepository
{
    const UINT32_MAX = 4294967295;
    const DEFAULT_PAGE_SIZE = 50;
    const MAX_PAGE_SIZE = 200;
    const LOOKUP_LIMIT = 50;
    const AA_RANK_CHAIN_LIMIT = 10000;
    const AA_RANK_CATALOG_LIMIT = 100000;

    private $db;
    private $characterDb;
    private $schemaDiagnosticsCache;
    private $aaRankMapCache = null;
    private $operation = 'achievement operation';

    public function __construct($connection = null, $characterConnection = null)
    {
        if ($connection === null) {
            global $mysql_content_db;
            $connection = isset($mysql_content_db) ? $mysql_content_db : null;
        }

        if (!($connection instanceof mysqli)) {
            throw new AchievementRepositoryException(
                'The achievement content database connection is not available.',
                'database'
            );
        }

        $this->db = $connection;
        if ($characterConnection !== null && !($characterConnection instanceof mysqli)) {
            throw new AchievementRepositoryException(
                'The character database connection is not available for durable achievement-ID checks.',
                'database'
            );
        }
        $this->characterDb = $characterConnection;
        $this->schemaDiagnosticsCache = null;
    }

    /**
     * Inspect all required achievement tables, columns, identities and engine
     * requirements. Lookup source tables are reported separately because a
     * server can author some criterion/reward types without every optional
     * source table being installed.
     */
    public function schemaDiagnostics($refresh = false)
    {
        if (!$refresh && is_array($this->schemaDiagnosticsCache)) {
            return $this->schemaDiagnosticsCache;
        }

        $spec = $this->schemaSpec();
        $tableNames = array_keys($spec);
        $optionalTables = array(
            'npc_types',
            'tasks',
            'zone',
            'items',
            'tradeskill_recipe',
            'alternate_currency',
            'titles',
            'aa_ability',
            'aa_ranks'
        );
        $allTables = array_values(array_unique(array_merge($tableNames, $optionalTables)));
        $database = (string) $this->scalar('SELECT DATABASE() AS database_name');

        $tableRows = $this->fetchAll(
            'SELECT TABLE_NAME, ENGINE FROM information_schema.TABLES '
            . 'WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME IN ('
            . $this->placeholders(count($allTables)) . ')',
            $allTables,
            str_repeat('s', count($allTables))
        );
        $tablesByName = array();
        foreach ($tableRows as $row) {
            $tablesByName[$row['TABLE_NAME']] = $row;
        }

        $columnRows = $this->fetchAll(
            'SELECT TABLE_NAME, COLUMN_NAME, COLUMN_TYPE, IS_NULLABLE, COLUMN_DEFAULT, EXTRA '
            . 'FROM information_schema.COLUMNS '
            . 'WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME IN ('
            . $this->placeholders(count($allTables)) . ') '
            . 'ORDER BY TABLE_NAME, ORDINAL_POSITION',
            $allTables,
            str_repeat('s', count($allTables))
        );
        $columnsByTable = array();
        foreach ($columnRows as $row) {
            $columnsByTable[$row['TABLE_NAME']][$row['COLUMN_NAME']] = $row;
        }

        $indexRows = $this->fetchAll(
            'SELECT TABLE_NAME, INDEX_NAME, NON_UNIQUE, SEQ_IN_INDEX, COLUMN_NAME, SUB_PART '
            . 'FROM information_schema.STATISTICS '
            . 'WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME IN ('
            . $this->placeholders(count($tableNames)) . ') '
            . 'ORDER BY TABLE_NAME, INDEX_NAME, SEQ_IN_INDEX',
            $tableNames,
            str_repeat('s', count($tableNames))
        );
        $indexesByTable = array();
        foreach ($indexRows as $row) {
            $table = $row['TABLE_NAME'];
            $index = $row['INDEX_NAME'];
            if (!isset($indexesByTable[$table][$index])) {
                $indexesByTable[$table][$index] = array(
                    'unique' => ((int) $row['NON_UNIQUE'] === 0),
                    'has_prefix' => false,
                    'columns' => array()
                );
            }
            $indexesByTable[$table][$index]['columns'][] = $row['COLUMN_NAME'];
            if ($row['SUB_PART'] !== null) {
                $indexesByTable[$table][$index]['has_prefix'] = true;
            }
        }

        $errors = array();
        $warnings = array();
        $tableDiagnostics = array();
        foreach ($spec as $table => $requirements) {
            $exists = isset($tablesByName[$table]);
            $engine = $exists ? (string) $tablesByName[$table]['ENGINE'] : null;
            $missingColumns = array();
            $columnMismatches = array();
            $missingIndexes = array();

            if (!$exists) {
                $errors[] = "Required achievement table {$table} is missing.";
            } else {
                if (strcasecmp($engine, 'InnoDB') !== 0) {
                    $errors[] = "Achievement table {$table} must use InnoDB for safe transactions and row locks.";
                }

                foreach ($requirements['columns'] as $column) {
                    if (!isset($columnsByTable[$table][$column])) {
                        $missingColumns[] = $column;
                        $errors[] = "Achievement table {$table} is missing required column {$column}.";
                    }
                }
                foreach ($requirements['unsigned'] as $column) {
                    if (isset($columnsByTable[$table][$column])
                        && stripos($columnsByTable[$table][$column]['COLUMN_TYPE'], 'unsigned') === false) {
                        $columnMismatches[] = "{$column} must be unsigned";
                        $errors[] = "Achievement column {$table}.{$column} must be unsigned.";
                    }
                }
                foreach ($requirements['types'] as $column => $typePattern) {
                    if (!isset($columnsByTable[$table][$column])) {
                        continue;
                    }
                    $actualType = strtolower(trim((string) $columnsByTable[$table][$column]['COLUMN_TYPE']));
                    if (!preg_match($typePattern, $actualType)) {
                        $columnMismatches[] = "{$column} has incompatible type {$actualType}";
                        $errors[] = "Achievement column {$table}.{$column} has incompatible type {$actualType}. Install the current achievement content migration.";
                    }
                }
                foreach ($requirements['not_null'] as $column) {
                    if (isset($columnsByTable[$table][$column])
                        && strtoupper((string) $columnsByTable[$table][$column]['IS_NULLABLE']) !== 'NO') {
                        $columnMismatches[] = "{$column} must be NOT NULL";
                        $errors[] = "Achievement column {$table}.{$column} must be NOT NULL.";
                    }
                }
                foreach ($requirements['auto_increment'] as $column) {
                    if (isset($columnsByTable[$table][$column])
                        && stripos($columnsByTable[$table][$column]['EXTRA'], 'auto_increment') === false) {
                        $columnMismatches[] = "{$column} must auto increment";
                        $errors[] = "Achievement column {$table}.{$column} must be AUTO_INCREMENT.";
                    }
                }

                foreach ($requirements['indexes'] as $requiredIndex) {
                    if (!$this->hasMatchingIndex(
                        isset($indexesByTable[$table]) ? $indexesByTable[$table] : array(),
                        $requiredIndex['columns'],
                        $requiredIndex['unique']
                    )) {
                        $description = ($requiredIndex['unique'] ? 'unique ' : '')
                            . '(' . implode(', ', $requiredIndex['columns']) . ')';
                        $missingIndexes[] = $description;
                        $errors[] = "Achievement table {$table} is missing required {$description} identity/index.";
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

        $lookupSources = array();
        $optionalColumnRequirements = array(
            'aa_ability' => array('id', 'name', 'classes', 'first_rank_id', 'enabled'),
            'aa_ranks' => array('id', 'next_id')
        );
        foreach ($optionalTables as $table) {
            $lookupSources[$table] = isset($tablesByName[$table]);
            if (!$lookupSources[$table]) {
                $warnings[] = "Optional lookup source {$table} is unavailable.";
                continue;
            }
            if (isset($optionalColumnRequirements[$table])) {
                $missingLookupColumns = array();
                foreach ($optionalColumnRequirements[$table] as $column) {
                    if (!isset($columnsByTable[$table][$column])) {
                        $missingLookupColumns[] = $column;
                    }
                }
                if (count($missingLookupColumns) > 0) {
                    $lookupSources[$table] = false;
                    $warnings[] = 'Optional lookup source ' . $table
                        . ' is missing required column(s): '
                        . implode(', ', $missingLookupColumns) . '.';
                }
            }
        }

        $diagnostics = array(
            'ready' => count($errors) === 0,
            'database' => $database,
            'tables' => $tableDiagnostics,
            'lookup_sources' => $lookupSources,
            'errors' => $errors,
            'warnings' => $warnings
        );
        $this->schemaDiagnosticsCache = $diagnostics;

        return $diagnostics;
    }

    public function assertSchemaReady()
    {
        $diagnostics = $this->schemaDiagnostics();
        if (!$diagnostics['ready']) {
            throw new AchievementRepositoryException(
                'The source achievement schema is incomplete. Install or update the achievement content SQL before using this editor.',
                'schema',
                $diagnostics
            );
        }

        return true;
    }

    public function suggestedIds()
    {
        $this->assertSchemaReady();

        return array(
            'achievement_id' => $this->suggestedAchievementId(false),
            'component_id' => $this->suggestedId('achievement_associations', 'component_id'),
            'reward_set_id' => $this->suggestedId('reward_sets', 'reward_set_id'),
            'category_id' => $this->suggestedId('achievement_categories', 'id')
        );
    }

    public function newDefinitionDefaults()
    {
        $ids = $this->suggestedIds();

        return array(
            'id' => $ids['achievement_id'],
            'name' => '',
            'description' => '',
            'icon_id' => 0,
            'points' => 0,
            'has_reward' => 0,
            'client_flag' => 0,
            'version' => 0,
            'reset_on_version_change' => 1,
            'enabled' => 0,
            'associations' => array(),
            'components' => array(),
            'rewards' => array(),
            'reward_set' => null,
            'restrictions' => array(),
            'suggested_achievement_id' => $ids['achievement_id'],
            'suggested_component_id' => $ids['component_id'],
            'suggested_reward_set_id' => $ids['reward_set_id'],
            'is_create' => true
        );
    }

    /**
     * Paginated definition list. Supported filters: search, enabled,
     * category_id, event_type, reward_type, and has_rewards.
     */
    public function listDefinitions($filters = array(), $page = 1, $pageSize = self::DEFAULT_PAGE_SIZE, $sort = 'name', $direction = 'asc')
    {
        $this->assertSchemaReady();
        $page = max(1, (int) $page);
        $pageSize = max(1, min(self::MAX_PAGE_SIZE, (int) $pageSize));
        $sortColumns = array(
            'id' => 'a.id',
            'name' => 'a.name',
            'points' => 'a.points',
            'version' => 'a.version',
            'enabled' => 'a.enabled',
            'component_count' => 'component_count',
            'components' => 'component_count',
            'criterion_count' => 'criterion_count',
            'criteria' => 'criterion_count',
            'category_count' => 'category_count',
            'reward_count' => 'reward_count',
            'rewards' => 'reward_count'
        );
        $sortColumn = isset($sortColumns[$sort]) ? $sortColumns[$sort] : $sortColumns['name'];
        $sortDirection = strtolower((string) $direction) === 'desc' ? 'DESC' : 'ASC';

        $where = array();
        $params = array();
        $types = '';
        $search = isset($filters['search'])
            ? trim((string) $filters['search'])
            : (isset($filters['q']) ? trim((string) $filters['q']) : '');
        if ($search !== '') {
            $like = '%' . $search . '%';
            if (ctype_digit($search)) {
                $where[] = '(a.id = ? OR a.name LIKE ? OR a.description LIKE ?)';
                $params[] = $search;
                $params[] = $like;
                $params[] = $like;
                $types .= 'sss';
            } else {
                $where[] = '(a.name LIKE ? OR a.description LIKE ?)';
                $params[] = $like;
                $params[] = $like;
                $types .= 'ss';
            }
        }
        if (isset($filters['enabled'])
            && in_array((string) $filters['enabled'], array('0', '1'), true)) {
            $where[] = 'a.enabled = ?';
            $params[] = ((int) $filters['enabled'] === 1) ? 1 : 0;
            $types .= 'i';
        }
        if (!empty($filters['category_id'])) {
            $where[] = 'EXISTS (SELECT 1 FROM achievement_category_associations af '
                . 'WHERE af.achievement_id = a.id AND af.category_id = ?)';
            $params[] = (int) $filters['category_id'];
            $types .= 'i';
        }
        if ($this->hasFilterValue($filters, 'event_type')) {
            $where[] = 'EXISTS (SELECT 1 FROM achievement_criteria cf '
                . 'WHERE cf.achievement_id = a.id AND cf.event_type = ?)';
            $params[] = (int) $filters['event_type'];
            $types .= 'i';
        }
        if ($this->hasFilterValue($filters, 'reward_type')) {
            $where[] = '(EXISTS (SELECT 1 FROM reward_source_entries rse '
                . 'INNER JOIN rewards rf ON rf.reward_id = rse.reward_id '
                . 'WHERE rse.source_type = 1 AND rse.source_id = a.id AND rf.reward_type = ?) '
                . 'OR EXISTS (SELECT 1 FROM reward_sources rsf '
                . 'INNER JOIN reward_option_entries roe ON roe.reward_set_id = rsf.reward_set_id '
                . 'INNER JOIN rewards rf2 ON rf2.reward_id = roe.reward_id '
                . 'WHERE rsf.source_type = 1 AND rsf.source_id = a.id AND rf2.reward_type = ?))';
            $params[] = (int) $filters['reward_type'];
            $params[] = (int) $filters['reward_type'];
            $types .= 'ii';
        }
        $rewardMode = isset($filters['reward']) ? (string) $filters['reward'] : '';
        if ($rewardMode === 'any') {
            $where[] = '(EXISTS (SELECT 1 FROM reward_source_entries rse '
                . 'WHERE rse.source_type = 1 AND rse.source_id = a.id) '
                . 'OR EXISTS (SELECT 1 FROM reward_sources rs '
                . 'WHERE rs.source_type = 1 AND rs.source_id = a.id))';
        } elseif ($rewardMode === 'automatic') {
            $where[] = 'EXISTS (SELECT 1 FROM reward_source_entries rse '
                . 'WHERE rse.source_type = 1 AND rse.source_id = a.id)';
        } elseif ($rewardMode === 'selectable') {
            $where[] = 'EXISTS (SELECT 1 FROM reward_sources rs '
                . 'WHERE rs.source_type = 1 AND rs.source_id = a.id)';
        } elseif ($rewardMode === 'none') {
            $where[] = 'NOT EXISTS (SELECT 1 FROM reward_source_entries rse '
                . 'WHERE rse.source_type = 1 AND rse.source_id = a.id) '
                . 'AND NOT EXISTS (SELECT 1 FROM reward_sources rs '
                . 'WHERE rs.source_type = 1 AND rs.source_id = a.id)';
        }
        if (isset($filters['has_rewards'])
            && in_array((string) $filters['has_rewards'], array('0', '1'), true)) {
            $exists = '(EXISTS (SELECT 1 FROM reward_source_entries rse '
                . 'WHERE rse.source_type = 1 AND rse.source_id = a.id) '
                . 'OR EXISTS (SELECT 1 FROM reward_sources rs '
                . 'WHERE rs.source_type = 1 AND rs.source_id = a.id))';
            $where[] = ((int) $filters['has_rewards'] === 1) ? $exists : 'NOT ' . $exists;
        }

        $whereSql = count($where) > 0 ? ' WHERE ' . implode(' AND ', $where) : '';
        $total = (int) $this->scalar(
            'SELECT COUNT(*) AS aggregate_count FROM achievements a' . $whereSql,
            $params,
            $types
        );
        $pages = max(1, (int) ceil($total / $pageSize));
        if ($page > $pages) {
            $page = $pages;
        }
        $offset = ($page - 1) * $pageSize;

        $sql = 'SELECT a.id, a.name, a.description, a.icon_id, a.points, '
            . 'a.has_reward, a.client_flag, a.version, '
            . 'a.reset_on_version_change, a.enabled, '
            . '(SELECT COUNT(*) FROM achievement_components c WHERE c.achievement_id = a.id) AS component_count, '
            . '(SELECT COUNT(*) FROM achievement_criteria cr WHERE cr.achievement_id = a.id) AS criterion_count, '
            . '(SELECT COUNT(*) FROM achievement_category_associations ca WHERE ca.achievement_id = a.id) AS category_count, '
            . '((SELECT COUNT(*) FROM reward_source_entries rse '
            . 'WHERE rse.source_type = 1 AND rse.source_id = a.id) + '
            . '(SELECT COUNT(*) FROM reward_sources rs '
            . 'INNER JOIN reward_option_entries roe ON roe.reward_set_id = rs.reward_set_id '
            . 'WHERE rs.source_type = 1 AND rs.source_id = a.id)) AS reward_count, '
            . '(SELECT COUNT(*) FROM achievement_cast_requirements x WHERE x.achievement_id = a.id) AS restriction_count, '
            . '(SELECT COUNT(*) FROM reward_sources rs '
            . 'WHERE rs.source_type = 1 AND rs.source_id = a.id) AS reward_set_count, '
            . '(SELECT GROUP_CONCAT(cat.name ORDER BY assoc.sequence, assoc.category_id SEPARATOR ", ") '
            . 'FROM achievement_category_associations assoc '
            . 'JOIN achievement_categories cat ON cat.id = assoc.category_id '
            . 'WHERE assoc.achievement_id = a.id) AS category_names '
            . 'FROM achievements a' . $whereSql
            . ' ORDER BY ' . $sortColumn . ' ' . $sortDirection . ', a.id ASC LIMIT ? OFFSET ?';
        $listParams = $params;
        $listParams[] = $pageSize;
        $listParams[] = $offset;
        $rows = $this->fetchAll($sql, $listParams, $types . 'ii');
        foreach ($rows as &$row) {
            $this->castDefinitionRow($row);
            $row['component_count'] = (int) $row['component_count'];
            $row['criterion_count'] = (int) $row['criterion_count'];
            $row['category_count'] = (int) $row['category_count'];
            $row['reward_count'] = (int) $row['reward_count'];
            $row['restriction_count'] = (int) $row['restriction_count'];
            $row['reward_set_count'] = (int) $row['reward_set_count'];
            $row['components_count'] = $row['component_count'];
            $row['criteria_count'] = $row['criterion_count'];
            $row['categories_count'] = $row['category_count'];
            $row['rewards_count'] = $row['reward_count'];
            $row['restrictions_count'] = $row['restriction_count'];
            $row['has_reward_set'] = $row['reward_set_count'] > 0;
            $row['category_names'] = $row['category_names'] === null ? '' : (string) $row['category_names'];
        }
        unset($row);

        return array(
            'rows' => $rows,
            'total' => $total,
            'page' => $page,
            'page_size' => $pageSize,
            'pages' => $total === 0 ? 0 : $pages,
            'sort' => $sort,
            'direction' => strtolower($sortDirection)
        );
    }

    public function loadDefinition($achievementId)
    {
        $this->assertSchemaReady();
        $achievementId = $this->unsigned32($achievementId, 'id', false);
        $definition = $this->fetchOne(
            'SELECT id, name, description, icon_id, points, has_reward, '
            . 'client_flag, version, reset_on_version_change, enabled '
            . 'FROM achievements WHERE id = ?',
            array($achievementId),
            'i'
        );
        if (!$definition) {
            $this->notFound('Achievement', $achievementId);
        }
        $this->castDefinitionRow($definition);

        $associations = $this->getAssociations($achievementId);
        $criteriaRows = $this->fetchAll(
            'SELECT id, component_type, component_sequence, component_id, event_type, '
            . 'progress_mode, behavior, target_id, target_id2, target_value, required_count, enabled '
            . 'FROM achievement_criteria WHERE achievement_id = ? '
            . 'ORDER BY component_type, component_sequence, id',
            array($achievementId),
            'i'
        );
        $criteriaByComponent = array();
        foreach ($criteriaRows as $criterion) {
            $key = $this->componentKey($criterion['component_type'], $criterion['component_id']);
            if (!isset($criteriaByComponent[$key])) {
                $criteriaByComponent[$key] = array();
            }
            $criteriaByComponent[$key][] = array(
                'id' => (string) $criterion['id'],
                'event_type' => (int) $criterion['event_type'],
                'progress_mode' => (int) $criterion['progress_mode'],
                'behavior' => (int) $criterion['behavior'],
                'target_id' => (int) $criterion['target_id'],
                'target_id2' => (int) $criterion['target_id2'],
                'target_value' => (string) $criterion['target_value'],
                'required_count' => (int) $criterion['required_count'],
                'enabled' => (int) $criterion['enabled']
            );
        }

        $componentRows = $this->fetchAll(
            'SELECT c.component_type, c.sequence, c.component_id, c.name, c.description, '
            . 'cc.required_count AS presentation_count '
            . 'FROM achievement_components c '
            . 'LEFT JOIN achievement_associations cc ON cc.component_id = c.component_id '
            . 'WHERE c.achievement_id = ? '
            . 'ORDER BY c.component_type, c.sequence, c.component_id',
            array($achievementId),
            'i'
        );
        $components = array();
        foreach ($componentRows as $component) {
            $key = $this->componentKey($component['component_type'], $component['component_id']);
            $components[] = array(
                'component_type' => (int) $component['component_type'],
                'sequence' => (int) $component['sequence'],
                'component_id' => (int) $component['component_id'],
                'name' => (string) $component['name'],
                'description' => (string) $component['description'],
                'presentation_count' => max(1, (int) $component['presentation_count']),
                'criteria' => isset($criteriaByComponent[$key]) ? $criteriaByComponent[$key] : array()
            );
        }

        $rewardRows = $this->fetchAll(
            '(SELECT r.reward_id, e.sequence, r.reward_type, r.reward_data_id, r.amount, '
            . 'r.description, r.enabled, NULL AS option_id '
            . 'FROM reward_source_entries e '
            . 'INNER JOIN rewards r ON r.reward_id = e.reward_id '
            . 'WHERE e.source_type = 1 AND e.source_id = ?) '
            . 'UNION ALL '
            . '(SELECT r.reward_id, e.sequence, r.reward_type, r.reward_data_id, r.amount, '
            . 'r.description, r.enabled, e.option_id '
            . 'FROM reward_sources source '
            . 'INNER JOIN reward_option_entries e ON e.reward_set_id = source.reward_set_id '
            . 'INNER JOIN rewards r ON r.reward_id = e.reward_id '
            . 'WHERE source.source_type = 1 AND source.source_id = ?) '
            . 'ORDER BY sequence, reward_id',
            array($achievementId, $achievementId),
            'ii'
        );
        $rewards = array();
        foreach ($rewardRows as $reward) {
            $rewards[] = array(
                'reward_id' => (string) $reward['reward_id'],
                'sequence' => (int) $reward['sequence'],
                'reward_type' => (int) $reward['reward_type'],
                'reward_data_id' => (int) $reward['reward_data_id'],
                'amount' => (string) $reward['amount'],
                'description' => (string) $reward['description'],
                'enabled' => (int) $reward['enabled'],
                'option_id' => $reward['option_id'] === null ? null : (int) $reward['option_id']
            );
        }

        $rewardSet = null;
        $rewardSetRow = $this->fetchOne(
            'SELECT reward_set.reward_set_id, reward_set.title, reward_set.enabled, '
            . 'source.enabled AS source_enabled '
            . 'FROM reward_sources source '
            . 'INNER JOIN reward_sets reward_set ON reward_set.reward_set_id = source.reward_set_id '
            . 'WHERE source.source_type = 1 AND source.source_id = ?',
            array($achievementId),
            'i'
        );
        if ($rewardSetRow) {
            $rewardSetId = (int) $rewardSetRow['reward_set_id'];
            $optionRows = $this->fetchAll(
                'SELECT option_id, sequence, label, common_to_all, flags, enabled '
                . 'FROM reward_options WHERE reward_set_id = ? '
                . 'ORDER BY sequence, option_id',
                array($rewardSetId),
                'i'
            );
            $options = array();
            foreach ($optionRows as $option) {
                $options[] = array(
                    'option_id' => (int) $option['option_id'],
                    'sequence' => (int) $option['sequence'],
                    'label' => (string) $option['label'],
                    'common_to_all' => (int) $option['common_to_all'],
                    'flags' => (int) $option['flags'],
                    'enabled' => (int) $option['enabled']
                );
            }
            $rewardSet = array(
                'reward_set_id' => $rewardSetId,
                'title' => (string) $rewardSetRow['title'],
                'enabled' => (int) $rewardSetRow['enabled'],
                'source_enabled' => (int) $rewardSetRow['source_enabled'],
                'options' => $options
            );
        }

        $restrictionRows = $this->fetchAll(
            'SELECT restriction_id, requires_completed FROM achievement_cast_requirements '
            . 'WHERE achievement_id = ? ORDER BY restriction_id',
            array($achievementId),
            'i'
        );
        $restrictions = array();
        foreach ($restrictionRows as $restriction) {
            $restrictions[] = array(
                'restriction_id' => (int) $restriction['restriction_id'],
                'requires_completed' => (int) $restriction['requires_completed']
            );
        }

        $ids = $this->suggestedIds();
        $definition['associations'] = $associations;
        $definition['components'] = $components;
        $definition['rewards'] = $rewards;
        $definition['reward_set'] = $rewardSet;
        $definition['restrictions'] = $restrictions;
        $definition['suggested_achievement_id'] = $ids['achievement_id'];
        $definition['suggested_component_id'] = $ids['component_id'];
        $definition['suggested_reward_set_id'] = $rewardSet === null
            ? $ids['reward_set_id']
            : $rewardSet['reward_set_id'];
        $definition['is_create'] = false;

        return $definition;
    }

    public function createDefinition($definition)
    {
        $this->assertSchemaReady();
        $this->validateDefinitionForWrite($definition, null);

        return $this->transaction('create achievement definition', function () use ($definition) {
            $achievementId = $this->unsigned32($definition['id'], 'id', false);
            $existing = $this->fetchOne(
                'SELECT id FROM achievements WHERE id = ? FOR UPDATE',
                array($achievementId),
                'i'
            );
            if ($existing) {
                $this->fail('id', "Achievement {$achievementId} already exists.");
            }
            $this->assertAchievementIdHasNoDurableState($achievementId);

            $this->assertAggregateReferences($definition, $achievementId);
            $this->insertDefinitionRow($definition, true);
            $this->syncAggregate($achievementId, $definition);

            return $achievementId;
        });
    }

    public function updateDefinition($achievementId, $definition)
    {
        $this->assertSchemaReady();
        $achievementId = $this->unsigned32($achievementId, 'id', false);
        $this->validateDefinitionForWrite($definition, $achievementId);

        return $this->transaction('update achievement definition', function () use ($achievementId, $definition) {
            $existing = $this->fetchOne(
                'SELECT id FROM achievements WHERE id = ? FOR UPDATE',
                array($achievementId),
                'i'
            );
            if (!$existing) {
                $this->notFound('Achievement', $achievementId);
            }
            if ((int) $definition['id'] !== $achievementId) {
                $this->fail('id', 'The stable achievement ID cannot be changed after creation.');
            }

            $currentDefinition = $this->loadDefinition($achievementId);
            $this->assertVersionBumpedForPolicyChange($currentDefinition, $definition);
            $this->assertAggregateReferences($definition, $achievementId);
            $this->insertDefinitionRow($definition, false);
            $this->syncAggregate($achievementId, $definition);

            return $achievementId;
        });
    }

    /**
     * Create a disabled safe copy. Component presentation identities remain
     * global and are intentionally retained; canonical reward and reward-set
     * identities are reallocated, and cast restrictions are not copied.
     */
    public function cloneDefinition($achievementId, $newAchievementId = null, $newName = null)
    {
        $this->assertSchemaReady();
        $achievementId = $this->unsigned32($achievementId, 'id', false);

        return $this->transaction('clone achievement definition', function () use ($achievementId, $newAchievementId, $newName) {
            $source = $this->fetchOne(
                'SELECT id FROM achievements WHERE id = ? FOR UPDATE',
                array($achievementId),
                'i'
            );
            if (!$source) {
                $this->notFound('Achievement', $achievementId);
            }

            $definition = $this->loadDefinition($achievementId);
            if ($newAchievementId === null || $newAchievementId === '') {
                $newId = $this->suggestedAchievementId(true);
            } else {
                $newId = $this->unsigned32($newAchievementId, 'id', false);
                $existing = $this->fetchOne(
                    'SELECT id FROM achievements WHERE id = ? FOR UPDATE',
                    array($newId),
                    'i'
                );
                if ($existing) {
                    $this->fail('id', "Achievement {$newId} already exists.");
                }
            }
            $this->assertAchievementIdHasNoDurableState($newId);
            if ($newId === $achievementId) {
                $this->fail('id', 'A cloned achievement must use a new stable ID.');
            }

            $definition['id'] = $newId;
            $definition['name'] = $newName === null || trim((string) $newName) === ''
                ? $this->truncate((string) $definition['name'], 248) . ' (Copy)'
                : $this->truncate(trim((string) $newName), 255);
            $definition['enabled'] = 0;
            $definition['version'] = 0;
            $definition['restrictions'] = array();
            foreach ($definition['rewards'] as &$reward) {
                $reward['reward_id'] = null;
            }
            unset($reward);
            if (is_array($definition['reward_set'])) {
                $definition['reward_set']['reward_set_id'] = null;
            }

            $this->validateDefinitionForWrite($definition, null);
            $this->assertAggregateReferences($definition, $newId);
            $this->insertDefinitionRow($definition, true);
            $this->syncAggregate($newId, $definition);

            return $newId;
        });
    }

    public function deleteDefinition($achievementId)
    {
        $this->assertSchemaReady();
        $achievementId = $this->unsigned32($achievementId, 'id', false);

        return $this->transaction('delete achievement definition', function () use ($achievementId) {
            $definition = $this->fetchOne(
                'SELECT id FROM achievements WHERE id = ? FOR UPDATE',
                array($achievementId),
                'i'
            );
            if (!$definition) {
                $this->notFound('Achievement', $achievementId);
            }

            $incomingDependency = $this->fetchOne(
                'SELECT achievement_id FROM achievement_criteria '
                . 'WHERE event_type = ? AND target_id = ? AND achievement_id <> ? LIMIT 1 FOR UPDATE',
                array(11, $achievementId, $achievementId),
                'iii'
            );
            if ($incomingDependency) {
                $this->fail(
                    'achievement',
                    'This achievement is referenced by another achievement criterion. Remove that dependency first.',
                    array('referencing_achievement_id' => (int) $incomingDependency['achievement_id'])
                );
            }

            // Only provider mappings belong to this achievement. Shared reward
            // and reward-set catalog rows are intentionally retained because
            // tasks, other achievements, and durable character ledgers may
            // still reference them.
            $this->execute(
                'DELETE FROM reward_source_entries WHERE source_type = 1 AND source_id = ?',
                array($achievementId),
                'i'
            );
            $this->execute(
                'DELETE FROM reward_sources WHERE source_type = 1 AND source_id = ?',
                array($achievementId),
                'i'
            );
            $this->execute('DELETE FROM achievement_cast_requirements WHERE achievement_id = ?', array($achievementId), 'i');
            $this->execute('DELETE FROM achievement_criteria WHERE achievement_id = ?', array($achievementId), 'i');
            $this->execute('DELETE FROM achievement_components WHERE achievement_id = ?', array($achievementId), 'i');
            $this->execute('DELETE FROM achievement_category_associations WHERE achievement_id = ?', array($achievementId), 'i');
            $this->execute('DELETE FROM achievements WHERE id = ?', array($achievementId), 'i');

            // Global component associations, reward catalogs, and character-side history are retained.
            return true;
        });
    }

    public function listCategories()
    {
        $this->assertSchemaReady();
        $rows = $this->fetchAll(
            'SELECT c.id, c.parent_id, c.sequence, c.name, c.description, c.icon, '
            . '(SELECT COUNT(*) FROM achievement_category_associations a WHERE a.category_id = c.id) AS associations_count, '
            . '(SELECT COUNT(*) FROM achievement_categories child WHERE child.parent_id = c.id) AS children_count '
            . 'FROM achievement_categories c ORDER BY c.parent_id, c.sequence, c.id'
        );
        foreach ($rows as &$row) {
            $row['id'] = (int) $row['id'];
            $row['parent_id'] = (int) $row['parent_id'];
            $row['sequence'] = (int) $row['sequence'];
            $row['name'] = (string) $row['name'];
            $row['description'] = (string) $row['description'];
            $row['icon'] = (string) $row['icon'];
            $row['associations_count'] = (int) $row['associations_count'];
            $row['children_count'] = (int) $row['children_count'];
        }
        unset($row);

        $children = array();
        foreach ($rows as $row) {
            if (!isset($children[$row['parent_id']])) {
                $children[$row['parent_id']] = array();
            }
            $children[$row['parent_id']][] = $row;
        }

        $ordered = array();
        $visited = array();
        $walk = function ($parentId, $depth) use (&$walk, &$ordered, &$visited, $children) {
            $branch = isset($children[$parentId]) ? $children[$parentId] : array();
            foreach ($branch as $row) {
                if (isset($visited[$row['id']])) {
                    continue;
                }
                $visited[$row['id']] = true;
                $row['depth'] = (int) $depth;
                $ordered[] = $row;
                $walk($row['id'], $depth + 1);
            }
        };
        $walk(0, 0);

        // Preserve malformed/orphaned rows in the repair UI without allowing
        // a parent cycle to recurse forever.
        foreach ($rows as $row) {
            if (isset($visited[$row['id']])) {
                continue;
            }
            $visited[$row['id']] = true;
            $row['depth'] = 0;
            $ordered[] = $row;
            $walk($row['id'], 1);
        }

        return $ordered;
    }

    public function categoryTree()
    {
        $rows = $this->listCategories();
        $byParent = array();
        $byId = array();
        foreach ($rows as $row) {
            $row['children'] = array();
            $byId[$row['id']] = $row;
            if (!isset($byParent[$row['parent_id']])) {
                $byParent[$row['parent_id']] = array();
            }
            $byParent[$row['parent_id']][] = $row['id'];
        }

        $visited = array();
        $build = function ($id, $path) use (&$build, &$visited, $byParent, $byId) {
            if (!isset($byId[$id]) || isset($path[$id])) {
                return null;
            }
            $path[$id] = true;
            $visited[$id] = true;
            $node = $byId[$id];
            $node['children'] = array();
            $childIds = isset($byParent[$id]) ? $byParent[$id] : array();
            foreach ($childIds as $childId) {
                $child = $build($childId, $path);
                if ($child !== null) {
                    $node['children'][] = $child;
                }
            }
            return $node;
        };

        $tree = array();
        $rootIds = isset($byParent[0]) ? $byParent[0] : array();
        foreach ($rootIds as $id) {
            $node = $build($id, array());
            if ($node !== null) {
                $tree[] = $node;
            }
        }
        foreach ($rows as $row) {
            if (isset($visited[$row['id']])) {
                continue;
            }
            $node = $build($row['id'], array());
            if ($node !== null) {
                $tree[] = $node;
            }
        }

        return $tree;
    }

    public function categoryOptions($excludeCategoryId = null)
    {
        $rows = $this->listCategories();
        $excluded = array();
        if ($excludeCategoryId !== null && $excludeCategoryId !== '') {
            $excludeCategoryId = (int) $excludeCategoryId;
            $excluded[$excludeCategoryId] = true;
            $changed = true;
            while ($changed) {
                $changed = false;
                foreach ($rows as $row) {
                    if (isset($excluded[$row['parent_id']]) && !isset($excluded[$row['id']])) {
                        $excluded[$row['id']] = true;
                        $changed = true;
                    }
                }
            }
        }

        $options = array();
        foreach ($rows as $row) {
            if (isset($excluded[$row['id']])) {
                continue;
            }
            $options[$row['id']] = str_repeat('-- ', (int) $row['depth']) . $row['name'];
        }
        return $options;
    }

    public function loadCategory($categoryId)
    {
        $this->assertSchemaReady();
        $categoryId = $this->unsigned32($categoryId, 'id', false);
        $row = $this->fetchOne(
            'SELECT id, parent_id, sequence, name, description, icon '
            . 'FROM achievement_categories WHERE id = ?',
            array($categoryId),
            'i'
        );
        if (!$row) {
            $this->notFound('Achievement category', $categoryId);
        }
        $row['id'] = (int) $row['id'];
        $row['parent_id'] = (int) $row['parent_id'];
        $row['sequence'] = (int) $row['sequence'];
        $row['name'] = (string) $row['name'];
        $row['description'] = (string) $row['description'];
        $row['icon'] = (string) $row['icon'];
        return $row;
    }

    public function createCategory($category)
    {
        $this->assertSchemaReady();
        $this->validateCategoryForWrite($category, null);

        return $this->transaction('create achievement category', function () use ($category) {
            $categoryId = $this->unsigned32($category['id'], 'id', false);
            $existing = $this->fetchOne(
                'SELECT id FROM achievement_categories WHERE id = ? FOR UPDATE',
                array($categoryId),
                'i'
            );
            if ($existing) {
                $this->fail('id', "Achievement category {$categoryId} already exists.");
            }
            $this->assertCategoryParent($categoryId, (int) $category['parent_id']);
            $this->insertCategoryRow($category, true);
            return $categoryId;
        });
    }

    public function updateCategory($categoryId, $category)
    {
        $this->assertSchemaReady();
        $categoryId = $this->unsigned32($categoryId, 'id', false);
        $this->validateCategoryForWrite($category, $categoryId);

        return $this->transaction('update achievement category', function () use ($categoryId, $category) {
            $existing = $this->fetchOne(
                'SELECT id FROM achievement_categories WHERE id = ? FOR UPDATE',
                array($categoryId),
                'i'
            );
            if (!$existing) {
                $this->notFound('Achievement category', $categoryId);
            }
            if ((int) $category['id'] !== $categoryId) {
                $this->fail('id', 'The stable category ID cannot be changed after creation.');
            }
            $this->assertCategoryParent($categoryId, (int) $category['parent_id']);
            $this->insertCategoryRow($category, false);
            return $categoryId;
        });
    }

    public function deleteCategory($categoryId)
    {
        $this->assertSchemaReady();
        $categoryId = $this->unsigned32($categoryId, 'id', false);

        return $this->transaction('delete achievement category', function () use ($categoryId) {
            $existing = $this->fetchOne(
                'SELECT id FROM achievement_categories WHERE id = ? FOR UPDATE',
                array($categoryId),
                'i'
            );
            if (!$existing) {
                $this->notFound('Achievement category', $categoryId);
            }
            $child = $this->fetchOne(
                'SELECT id FROM achievement_categories WHERE parent_id = ? LIMIT 1 FOR UPDATE',
                array($categoryId),
                'i'
            );
            if ($child) {
                $this->fail('category', 'Move or delete this category\'s children before deleting it.');
            }
            $association = $this->fetchOne(
                'SELECT achievement_id FROM achievement_category_associations '
                . 'WHERE category_id = ? LIMIT 1 FOR UPDATE',
                array($categoryId),
                'i'
            );
            if ($association) {
                $this->fail('category', 'Remove this category\'s achievement associations before deleting it.');
            }
            $this->execute('DELETE FROM achievement_categories WHERE id = ?', array($categoryId), 'i');
            return true;
        });
    }

    public function getAssociations($achievementId)
    {
        $achievementId = $this->unsigned32($achievementId, 'achievement_id', false);
        $rows = $this->fetchAll(
            'SELECT category_id, sequence, display_text '
            . 'FROM achievement_category_associations WHERE achievement_id = ? '
            . 'ORDER BY sequence, category_id',
            array($achievementId),
            'i'
        );
        foreach ($rows as &$row) {
            $row['category_id'] = (int) $row['category_id'];
            $row['sequence'] = (int) $row['sequence'];
            $row['display_text'] = (string) $row['display_text'];
        }
        unset($row);
        return $rows;
    }

    public function replaceAssociations($achievementId, $associations)
    {
        $this->assertSchemaReady();
        $achievementId = $this->unsigned32($achievementId, 'achievement_id', false);
        if (!is_array($associations)) {
            $this->fail('associations', 'Achievement associations must be submitted as a list.');
        }

        return $this->transaction('replace achievement category associations', function () use ($achievementId, $associations) {
            $definition = $this->fetchOne(
                'SELECT id, enabled FROM achievements WHERE id = ? FOR UPDATE',
                array($achievementId),
                'i'
            );
            if (!$definition) {
                $this->notFound('Achievement', $achievementId);
            }
            if ((int) $definition['enabled'] === 1 && count($associations) === 0) {
                $this->fail('associations', 'An enabled achievement must have at least one category association.');
            }
            $this->assertAssociationReferences($associations);
            $this->syncAssociations($achievementId, $associations);
            return true;
        });
    }

    public function lookupTypes()
    {
        return array(
            'achievement' => 'Achievement definitions',
            'category' => 'Achievement categories',
            'npc' => 'NPC types',
            'race' => 'NPC races',
            'task' => 'Tasks',
            'zone' => 'Zones',
            'item' => 'Items',
            'recipe' => 'Tradeskill recipes',
            'currency' => 'Alternate currencies',
            'title-set' => 'Title sets',
            'aa-ability' => 'Alternate Advancement abilities'
        );
    }

    /**
     * Bounded dynamic lookup used by the nested graph editor. Exact ID
     * hydration takes precedence over text search and accepts at most 100 IDs.
     */
    public function lookup($type, $search = '', $ids = array(), $limit = self::LOOKUP_LIMIT)
    {
        $this->assertSchemaReady();
        $type = (string) $type;
        if ($type === 'race') {
            return $this->lookupRaces($search, $ids, $limit);
        }
        if ($type === 'aa-ability') {
            return $this->lookupAlternateAdvancementAbilities($search, $ids, $limit);
        }
        $bases = array(
            'achievement' => 'SELECT id AS lookup_id, name AS lookup_name, NULL AS icon FROM achievements',
            'category' => 'SELECT id AS lookup_id, name AS lookup_name, NULL AS icon FROM achievement_categories',
            'npc' => 'SELECT id AS lookup_id, name AS lookup_name, NULL AS icon FROM npc_types',
            'task' => 'SELECT id AS lookup_id, title AS lookup_name, NULL AS icon FROM tasks',
            'zone' => 'SELECT zoneidnumber AS lookup_id, long_name AS lookup_name, NULL AS icon FROM zone WHERE version = 0',
            'item' => 'SELECT id AS lookup_id, Name AS lookup_name, icon AS icon FROM items',
            'recipe' => 'SELECT id AS lookup_id, name AS lookup_name, NULL AS icon FROM tradeskill_recipe',
            'currency' => 'SELECT c.id AS lookup_id, i.Name AS lookup_name, i.icon AS icon '
                . 'FROM alternate_currency c LEFT JOIN items i ON i.id = c.item_id',
            'title-set' => "SELECT title_set AS lookup_id, "
                . "MAX(CASE WHEN prefix <> '' THEN prefix WHEN suffix <> '' THEN suffix ELSE 'Title set' END) AS lookup_name, "
                . 'NULL AS icon FROM titles WHERE title_set > 0 GROUP BY title_set'
        );
        if (!isset($bases[$type])) {
            $this->fail('lookup', 'Unknown achievement lookup type.');
        }

        if (!is_array($ids)) {
            $ids = array();
        }
        $normalizedIds = array();
        foreach ($ids as $id) {
            if (count($normalizedIds) >= 100) {
                break;
            }
            $idString = trim((string) $id);
            if ($idString === '' || !ctype_digit($idString) || $this->compareDecimal($idString, (string) self::UINT32_MAX) > 0) {
                continue;
            }
            $normalizedIds[(string) ((int) $idString)] = (int) $idString;
        }
        $normalizedIds = array_values($normalizedIds);
        $limit = max(1, min(100, (int) $limit));

        $sql = 'SELECT lookup_id, lookup_name, icon FROM (' . $bases[$type] . ') achievement_lookup';
        $params = array();
        $types = '';
        if (count($normalizedIds) > 0) {
            $sql .= ' WHERE lookup_id IN (' . $this->placeholders(count($normalizedIds)) . ')';
            foreach ($normalizedIds as $id) {
                $params[] = $id;
                $types .= 'i';
            }
        } else {
            $search = trim((string) $search);
            if ($search !== '') {
                $like = '%' . $search . '%';
                if (ctype_digit($search) && $this->compareDecimal($search, (string) self::UINT32_MAX) <= 0) {
                    $sql .= ' WHERE (lookup_id = ? OR lookup_name LIKE ?)';
                    $params[] = (int) $search;
                    $params[] = $like;
                    $types .= 'is';
                } else {
                    $sql .= ' WHERE lookup_name LIKE ?';
                    $params[] = $like;
                    $types .= 's';
                }
            }
        }
        $sql .= ' ORDER BY lookup_id LIMIT ?';
        $params[] = $limit;
        $types .= 'i';

        try {
            $rows = $this->fetchAll($sql, $params, $types);
        } catch (AchievementRepositoryException $exception) {
            if ($type !== 'achievement' && $type !== 'category') {
                throw new AchievementRepositoryException(
                    'That lookup source is unavailable in the configured content database.',
                    'lookup',
                    array('type' => $type),
                    $exception
                );
            }
            throw $exception;
        }

        $results = array();
        foreach ($rows as $row) {
            $id = (int) $row['lookup_id'];
            $name = trim((string) $row['lookup_name']);
            $result = array(
                'id' => $id,
                'name' => $name === '' ? "Record {$id}" : $name
            );
            if ($row['icon'] !== null) {
                $result['icon'] = (int) $row['icon'];
            }
            $results[] = $result;
        }
        return $results;
    }

    /**
     * Search enabled AA abilities and expose the same rank-chain and class
     * information the runtime uses when deciding whether an ability grant is
     * valid and which playable classes may receive it. Exact-ID hydration also
     * returns disabled rows so existing content remains visible for repair.
     */
    private function lookupAlternateAdvancementAbilities($search, $ids, $limit)
    {
        if (!is_array($ids)) {
            $ids = array();
        }
        $normalizedIds = array();
        foreach ($ids as $id) {
            if (count($normalizedIds) >= 100) {
                break;
            }
            $idString = trim((string) $id);
            if ($idString === '' || !ctype_digit($idString)
                || $this->compareDecimal($idString, (string) self::UINT32_MAX) > 0) {
                continue;
            }
            $normalizedIds[(string) ((int) $idString)] = (int) $idString;
        }
        $normalizedIds = array_values($normalizedIds);
        $limit = max(1, min(100, (int) $limit));

        $sql = 'SELECT id AS lookup_id, name AS lookup_name, classes, first_rank_id, enabled '
            . 'FROM aa_ability WHERE ';
        $params = array();
        $types = '';
        if (count($normalizedIds) > 0) {
            $sql .= 'id IN (' . $this->placeholders(count($normalizedIds)) . ')';
            foreach ($normalizedIds as $id) {
                $params[] = $id;
                $types .= 'i';
            }
        } else {
            $sql .= 'enabled = 1';
            $search = trim((string) $search);
            if ($search !== '') {
                $like = '%' . $search . '%';
                if (ctype_digit($search)
                    && $this->compareDecimal($search, (string) self::UINT32_MAX) <= 0) {
                    $sql .= ' AND (id = ? OR name LIKE ?)';
                    $params[] = (int) $search;
                    $params[] = $like;
                    $types .= 'is';
                } else {
                    $sql .= ' AND name LIKE ?';
                    $params[] = $like;
                    $types .= 's';
                }
            }
        }
        $sql .= ' ORDER BY id LIMIT ?';
        $params[] = $limit;
        $types .= 'i';

        try {
            $rows = $this->fetchAll($sql, $params, $types);
            $firstRankIds = array();
            foreach ($rows as $row) {
                $firstRankIds[] = (int) $row['first_rank_id'];
            }
            $rankMap = $this->alternateAdvancementRankMap($firstRankIds);
        } catch (AchievementRepositoryException $exception) {
            throw new AchievementRepositoryException(
                'The AA ability lookup requires compatible aa_ability and aa_ranks tables in the configured content database.',
                'lookup',
                array('type' => 'aa-ability'),
                $exception
            );
        }

        $results = array();
        foreach ($rows as $row) {
            $id = (int) $row['lookup_id'];
            $name = trim((string) $row['lookup_name']);
            $mask = (int) $row['classes'];
            $rankDetails = $this->alternateAdvancementRankDetails(
                (int) $row['first_rank_id'],
                $rankMap
            );
            $results[] = array(
                'id' => $id,
                'name' => $name === '' ? "AA ability {$id}" : $name,
                'class_mask' => $mask,
                'eligible_classes' => $this->alternateAdvancementEligibleClasses($mask),
                'rank_count' => $rankDetails['count'],
                'rank_chain_valid' => $rankDetails['valid'],
                'enabled' => (int) $row['enabled']
            );
        }
        return $results;
    }

    /**
     * Load the bounded rank catalog once per repository/request. Sharing this
     * map across lookup hydration and save validation avoids one database
     * round trip per linked rank while retaining a hard memory/query bound.
     */
    private function alternateAdvancementRankMap($firstRankIds)
    {
        $hasFirstRank = false;
        foreach (is_array($firstRankIds) ? $firstRankIds : array() as $firstRankId) {
            if ((int) $firstRankId > 0) {
                $hasFirstRank = true;
                break;
            }
        }
        if (!$hasFirstRank) {
            return array();
        }
        if ($this->aaRankMapCache !== null) {
            return $this->aaRankMapCache;
        }

        $rowLimit = self::AA_RANK_CATALOG_LIMIT + 1;
        $rows = $this->fetchAll(
            'SELECT id, next_id FROM aa_ranks ORDER BY id LIMIT ?',
            array($rowLimit),
            'i'
        );
        if (count($rows) > self::AA_RANK_CATALOG_LIMIT) {
            throw new AchievementRepositoryException(
                'The AA rank catalog exceeds the editor safety limit of '
                . self::AA_RANK_CATALOG_LIMIT . ' rows.',
                'rewards',
                array('aa_rank_catalog_limit' => self::AA_RANK_CATALOG_LIMIT)
            );
        }

        $map = array();
        foreach ($rows as $row) {
            $map[(int) $row['id']] = (int) $row['next_id'];
        }
        $this->aaRankMapCache = $map;
        return $this->aaRankMapCache;
    }

    private function alternateAdvancementRankDetails($firstRankId, $rankMap)
    {
        $current = (int) $firstRankId;
        $seen = array();
        $count = 0;
        while ($current > 0) {
            if (!isset($rankMap[$current])
                || isset($seen[$current])
                || $count >= self::AA_RANK_CHAIN_LIMIT) {
                return array('count' => $count, 'valid' => false);
            }
            $seen[$current] = true;
            ++$count;
            $current = (int) $rankMap[$current];
        }
        return array('count' => $count, 'valid' => $count > 0);
    }

    /**
     * Inspect only the requested cumulative rank. Runtime delivery stops once
     * that rank is reached, so a malformed tail must not invalidate an earlier
     * reachable grant. The hop limit bounds hostile or corrupt catalogs.
     */
    private function alternateAdvancementDesiredRankDetails($firstRankId, $desiredRank, $rankMap)
    {
        $desiredRank = (int) $desiredRank;
        $current = (int) $firstRankId;
        $seen = array();
        $count = 0;
        if ($desiredRank < 1 || $desiredRank > self::AA_RANK_CHAIN_LIMIT) {
            return array('count' => 0, 'reachable' => false);
        }
        while ($current > 0 && $count < $desiredRank) {
            if (!isset($rankMap[$current]) || isset($seen[$current])) {
                return array('count' => $count, 'reachable' => false);
            }
            $seen[$current] = true;
            ++$count;
            if ($count === $desiredRank) {
                return array('count' => $count, 'reachable' => true);
            }
            $current = (int) $rankMap[$current];
        }
        return array('count' => $count, 'reachable' => false);
    }

    private function alternateAdvancementEligibleClasses($classMask)
    {
        $classes = array();
        $classMask = (int) $classMask;
        for ($classId = 1; $classId <= 16; ++$classId) {
            if (($classMask & (1 << ($classId - 1))) !== 0) {
                $classes[] = $classId;
            }
        }
        return $classes;
    }

    /**
     * Suggest the distinct base races actually used by npc_types in the
     * configured content database. PEQ's legacy race catalog (lib/data.php)
     * supplies friendly labels when it has been loaded, but it is deliberately
     * optional here so direct repository consumers still receive useful
     * numeric labels. Exact numeric hydration is synthetic: achievement data
     * may intentionally target a valid/custom race before an NPC of that race
     * exists in the content database.
     */
    private function lookupRaces($search, $ids, $limit)
    {
        if (!is_array($ids)) {
            $ids = array();
        }
        $normalizedIds = array();
        foreach ($ids as $id) {
            if (count($normalizedIds) >= 100) {
                break;
            }
            $idString = trim((string) $id);
            if ($idString === ''
                || !ctype_digit($idString)
                || $this->compareDecimal($idString, (string) self::UINT32_MAX) > 0) {
                continue;
            }
            $normalizedIds[(string) ((int) $idString)] = (int) $idString;
        }
        $normalizedIds = array_values($normalizedIds);
        sort($normalizedIds, SORT_NUMERIC);
        $limit = max(1, min(100, (int) $limit));
        $names = $this->raceLookupNames();

        // Exact ID hydration must not reject a custom numeric race merely
        // because no npc_types row currently uses it.
        if (count($normalizedIds) > 0) {
            return $this->raceLookupResults(array_slice($normalizedIds, 0, $limit), $names);
        }

        $search = trim((string) $search);
        if ($search !== '') {
            $numericSearch = $search;
            if (preg_match('/^race\s+([0-9]+)$/i', $search, $matches)) {
                $numericSearch = $matches[1];
            }
            if (ctype_digit($numericSearch)
                && $this->compareDecimal($numericSearch, (string) self::UINT32_MAX) <= 0) {
                return $this->raceLookupResults(array((int) $numericSearch), $names);
            }
        }

        $sql = 'SELECT DISTINCT race AS lookup_id FROM npc_types WHERE race >= 0';
        $params = array();
        $types = '';
        if ($search !== '') {
            $matchingIds = array();
            foreach ($names as $id => $name) {
                if (stripos($name, $search) !== false) {
                    $matchingIds[] = (int) $id;
                }
            }
            if (count($matchingIds) === 0) {
                return array();
            }
            $sql .= ' AND race IN (' . $this->placeholders(count($matchingIds)) . ')';
            foreach ($matchingIds as $id) {
                $params[] = $id;
                $types .= 'i';
            }
        }
        $sql .= ' ORDER BY race LIMIT ?';
        $params[] = $limit;
        $types .= 'i';

        try {
            $rows = $this->fetchAll($sql, $params, $types);
        } catch (AchievementRepositoryException $exception) {
            throw new AchievementRepositoryException(
                'The NPC race lookup source is unavailable in the configured content database.',
                'lookup',
                array('type' => 'race'),
                $exception
            );
        }

        $raceIds = array();
        foreach ($rows as $row) {
            $raceIds[] = (int) $row['lookup_id'];
        }
        return $this->raceLookupResults($raceIds, $names);
    }

    /**
     * Return PEQ's optional, process-local race label catalog. The repository
     * does not require lib/data.php because it is also used by CLI tests and
     * other direct consumers.
     */
    private function raceLookupNames()
    {
        global $races;

        $names = array(0 => 'Any race / wildcard');
        if (!isset($races) || !is_array($races)) {
            return $names;
        }
        foreach ($races as $id => $name) {
            $idString = trim((string) $id);
            $name = trim((string) $name);
            if ($idString === ''
                || !ctype_digit($idString)
                || $this->compareDecimal($idString, (string) self::UINT32_MAX) > 0
                || $name === '') {
                continue;
            }
            $normalizedId = (int) $idString;
            if ($normalizedId !== 0) {
                $names[$normalizedId] = $name;
            }
        }
        return $names;
    }

    private function raceLookupResults($ids, $names)
    {
        $results = array();
        foreach ($ids as $id) {
            $id = (int) $id;
            $results[] = array(
                'id' => $id,
                'name' => isset($names[$id]) ? $names[$id] : "Race {$id}"
            );
        }
        return $results;
    }

    private function insertDefinitionRow($definition, $includeId)
    {
        $values = array(
            (string) $definition['name'],
            isset($definition['description']) ? (string) $definition['description'] : '',
            $this->unsigned32($definition['icon_id'], 'icon_id', true),
            $this->unsigned32($definition['points'], 'points', true),
            $this->flag($definition['has_reward']),
            $this->flag($definition['client_flag']),
            $this->unsigned32($definition['version'], 'version', true),
            $this->flag($definition['reset_on_version_change']),
            $this->flag($definition['enabled'])
        );
        if ($includeId) {
            array_unshift($values, $this->unsigned32($definition['id'], 'id', false));
            $this->execute(
                'INSERT INTO achievements '
                . '(id, name, description, icon_id, points, has_reward, client_flag, '
                . 'version, reset_on_version_change, enabled) '
                . 'VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                $values,
                'issiiiiiii'
            );
            return;
        }

        $values[] = $this->unsigned32($definition['id'], 'id', false);
        $this->execute(
            'UPDATE achievements SET name = ?, description = ?, icon_id = ?, points = ?, '
            . 'has_reward = ?, client_flag = ?, version = ?, '
            . 'reset_on_version_change = ?, enabled = ? WHERE id = ?',
            $values,
            'ssiiiiiiii'
        );
    }

    private function insertCategoryRow($category, $includeId)
    {
        $parentId = $this->unsigned32($category['parent_id'], 'parent_id', true);
        $sequence = $this->unsigned32($category['sequence'], 'sequence', true);
        $name = (string) $category['name'];
        $description = isset($category['description']) ? (string) $category['description'] : '';
        $icon = isset($category['icon']) ? (string) $category['icon'] : '';
        if ($includeId) {
            $this->execute(
                'INSERT INTO achievement_categories '
                . '(id, parent_id, sequence, name, description, icon) VALUES (?, ?, ?, ?, ?, ?)',
                array(
                    $this->unsigned32($category['id'], 'id', false),
                    $parentId,
                    $sequence,
                    $name,
                    $description,
                    $icon
                ),
                'iiisss'
            );
            return;
        }

        $this->execute(
            'UPDATE achievement_categories SET parent_id = ?, sequence = ?, name = ?, '
            . 'description = ?, icon = ? WHERE id = ?',
            array(
                $parentId,
                $sequence,
                $name,
                $description,
                $icon,
                $this->unsigned32($category['id'], 'id', false)
            ),
            'iisssi'
        );
    }

    private function syncAggregate($achievementId, $definition)
    {
        $associations = isset($definition['associations']) ? $definition['associations'] : array();
        $components = isset($definition['components']) ? $definition['components'] : array();
        $rewards = isset($definition['rewards']) ? $definition['rewards'] : array();
        $rewardSet = array_key_exists('reward_set', $definition) ? $definition['reward_set'] : null;
        $restrictions = isset($definition['restrictions']) ? $definition['restrictions'] : array();

        $this->syncAssociations($achievementId, $associations);
        $this->syncComponents($achievementId, $components);
        $this->syncRewards($achievementId, $rewards, $rewardSet);
        $this->syncRestrictions($achievementId, $restrictions);
    }

    private function syncAssociations($achievementId, $associations)
    {
        $this->execute(
            'DELETE FROM achievement_category_associations WHERE achievement_id = ?',
            array($achievementId),
            'i'
        );
        foreach ($associations as $index => $association) {
            $this->execute(
                'INSERT INTO achievement_category_associations '
                . '(category_id, sequence, achievement_id, display_text) VALUES (?, ?, ?, ?)',
                array(
                    $this->unsigned32($association['category_id'], "associations.{$index}.category_id", false),
                    $this->unsigned32($association['sequence'], "associations.{$index}.sequence", true),
                    $achievementId,
                    isset($association['display_text']) ? (string) $association['display_text'] : ''
                ),
                'iiis'
            );
        }
    }

    private function syncComponents($achievementId, $components)
    {
        $existingRows = $this->fetchAll(
            'SELECT component_type, component_id FROM achievement_components '
            . 'WHERE achievement_id = ? FOR UPDATE',
            array($achievementId),
            'i'
        );
        $existingComponentKeys = array();
        foreach ($existingRows as $row) {
            $existingComponentKeys[$this->componentKey($row['component_type'], $row['component_id'])] = true;
        }

        $submittedComponentKeys = array();
        foreach ($components as $index => $component) {
            $submittedComponentKeys[$this->componentKey(
                (int) $component['component_type'],
                $this->unsigned32(
                    $component['component_id'],
                    "components.{$index}.component_id",
                    true
                )
            )] = true;
        }
        $this->assertRetainedIdentities(
            $existingComponentKeys,
            $submittedComponentKeys,
            'components',
            'Persisted component',
            'Disable all of its criteria to retire it safely.'
        );

        foreach ($components as $index => $component) {
            $componentId = $this->unsigned32(
                $component['component_id'],
                "components.{$index}.component_id",
                true
            );
            $submittedCount = $this->unsigned32(
                $component['presentation_count'],
                "components.{$index}.presentation_count",
                false
            );
            $shared = $this->fetchOne(
                'SELECT achievement_id FROM achievement_components '
                . 'WHERE component_id = ? AND achievement_id <> ? LIMIT 1 FOR UPDATE',
                array($componentId, $achievementId),
                'ii'
            );
            if (!$shared) {
                continue;
            }
            $storedCount = $this->scalar(
                'SELECT required_count FROM achievement_associations '
                . 'WHERE component_id = ? FOR UPDATE',
                array($componentId),
                'i'
            );
            $effectiveCount = max(1, (int) $storedCount);
            if ($effectiveCount !== $submittedCount) {
                $this->fail(
                    "components.{$index}.presentation_count",
                    "Component ID {$componentId} is shared by another achievement and its global presentation count is {$effectiveCount}."
                );
            }
        }

        $this->execute('DELETE FROM achievement_criteria WHERE achievement_id = ?', array($achievementId), 'i');
        $this->execute('DELETE FROM achievement_components WHERE achievement_id = ?', array($achievementId), 'i');

        foreach ($components as $componentIndex => $component) {
            $componentType = (int) $component['component_type'];
            $sequence = $this->unsigned32(
                $component['sequence'],
                "components.{$componentIndex}.sequence",
                true
            );
            $componentId = $this->unsigned32(
                $component['component_id'],
                "components.{$componentIndex}.component_id",
                true
            );
            $presentationCount = $this->unsigned32(
                $component['presentation_count'],
                "components.{$componentIndex}.presentation_count",
                false
            );
            $this->execute(
                'INSERT INTO achievement_components '
                . '(achievement_id, component_type, sequence, component_id, name, description) '
                . 'VALUES (?, ?, ?, ?, ?, ?)',
                array(
                    $achievementId,
                    $componentType,
                    $sequence,
                    $componentId,
                    isset($component['name']) ? (string) $component['name'] : '',
                    isset($component['description']) ? (string) $component['description'] : ''
                ),
                'iiiiss'
            );
            // component_id is a global presentation identity. Counts are
            // updated, never deleted, so retired definitions remain legible.
            $this->execute(
                'INSERT INTO achievement_associations (component_id, required_count) '
                . 'VALUES (?, ?) ON DUPLICATE KEY UPDATE required_count = VALUES(required_count)',
                array($componentId, $presentationCount),
                'ii'
            );

            $criteria = isset($component['criteria']) && is_array($component['criteria'])
                ? $component['criteria']
                : array();
            foreach ($criteria as $criterionIndex => $criterion) {
                $path = "components.{$componentIndex}.criteria.{$criterionIndex}";
                $targetValue = $this->nonNegativeDecimal($criterion['target_value'], $path . '.target_value');
                $this->execute(
                    'INSERT INTO achievement_criteria '
                    . '(achievement_id, component_type, component_sequence, component_id, event_type, '
                    . 'progress_mode, behavior, target_id, target_id2, target_value, required_count, enabled) '
                    . 'VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                    array(
                        $achievementId,
                        $componentType,
                        $sequence,
                        $componentId,
                        (int) $criterion['event_type'],
                        (int) $criterion['progress_mode'],
                        (int) $criterion['behavior'],
                        $this->unsigned32($criterion['target_id'], $path . '.target_id', true),
                        $this->unsigned32($criterion['target_id2'], $path . '.target_id2', true),
                        $targetValue,
                        $this->unsigned32($criterion['required_count'], $path . '.required_count', false),
                        $this->flag($criterion['enabled'])
                    ),
                    'iiiiiiiiisii'
                );
            }
        }
    }

    private function syncRewards($achievementId, $rewards, $rewardSet)
    {
        // Rewards and reward sets are provider-neutral catalog rows. Scope every
        // relationship read/write to achievement source_type=1, and never delete
        // catalog identities that another achievement, task, or future provider
        // may share.
        $automaticRows = $this->fetchAll(
            'SELECT entry.reward_id FROM reward_source_entries entry '
            . 'WHERE entry.source_type = 1 AND entry.source_id = ? FOR UPDATE',
            array($achievementId),
            'i'
        );
        $existingSet = $this->fetchOne(
            'SELECT source.reward_set_id, source.enabled AS source_enabled, '
            . 'reward_set.title, reward_set.enabled '
            . 'FROM reward_sources source '
            . 'LEFT JOIN reward_sets reward_set ON reward_set.reward_set_id = source.reward_set_id '
            . 'WHERE source.source_type = 1 AND source.source_id = ? FOR UPDATE',
            array($achievementId),
            'i'
        );
        if ($existingSet && $existingSet['title'] === null) {
            $this->fail(
                'reward_set',
                'This achievement references a missing reward-set catalog row. Repair the content schema before saving.'
            );
        }

        $existingOptionRows = array();
        $existingOptionEntryRows = array();
        if ($existingSet) {
            $lockedSetId = (int) $existingSet['reward_set_id'];
            $existingOptionRows = $this->fetchAll(
                'SELECT option_id, sequence, label, common_to_all, flags, enabled '
                . 'FROM reward_options WHERE reward_set_id = ? ORDER BY option_id FOR UPDATE',
                array($lockedSetId),
                'i'
            );
            $existingOptionEntryRows = $this->fetchAll(
                'SELECT option_id, sequence, reward_id FROM reward_option_entries '
                . 'WHERE reward_set_id = ? ORDER BY option_id, reward_id FOR UPDATE',
                array($lockedSetId),
                'i'
            );
        }

        $existingRewardIds = array();
        foreach ($automaticRows as $row) {
            $existingRewardIds[(string) $row['reward_id']] = true;
        }
        foreach ($existingOptionEntryRows as $row) {
            $existingRewardIds[(string) $row['reward_id']] = true;
        }

        $submittedRewardIds = array();
        foreach ($rewards as $index => $reward) {
            $rewardId = isset($reward['reward_id']) ? $reward['reward_id'] : null;
            if ($rewardId === null || $rewardId === '') {
                continue;
            }
            $rewardId = $this->unsigned32Decimal($rewardId, "rewards.{$index}.reward_id", false);
            if (!isset($existingRewardIds[$rewardId])) {
                $this->fail(
                    "rewards.{$index}.reward_id",
                    'Existing reward IDs are immutable and cannot be adopted from another provider source.'
                );
            }
            if (isset($submittedRewardIds[$rewardId])) {
                $this->fail("rewards.{$index}.reward_id", 'A canonical reward ID may appear only once.');
            }
            $submittedRewardIds[$rewardId] = true;
        }
        $this->assertRetainedIdentities(
            $existingRewardIds,
            $submittedRewardIds,
            'rewards',
            'Persisted grant',
            'Keep the mapping and disable the catalog grant only when it is not shared by another source.'
        );

        if ($existingSet && $rewardSet === null) {
            $this->fail(
                'reward_set',
                'Persisted reward set ' . (string) $existingSet['reward_set_id']
                . ' cannot be removed because character selections may reference it. '
                . 'Set its Enabled field to 0 to retire it safely.'
            );
        }
        $rewardSetId = null;
        if ($rewardSet !== null) {
            if (!is_array($rewardSet)) {
                $this->fail('reward_set', 'The reward set must be an object or null.');
            }
            $requestedSetId = isset($rewardSet['reward_set_id']) && $rewardSet['reward_set_id'] !== ''
                ? $rewardSet['reward_set_id']
                : null;
            if ($existingSet) {
                if ($requestedSetId === null || (int) $requestedSetId !== (int) $existingSet['reward_set_id']) {
                    $this->fail(
                        'reward_set.reward_set_id',
                        'The stable reward-set ID cannot be changed after creation.'
                    );
                }
                $rewardSetId = (int) $existingSet['reward_set_id'];
            } elseif ($requestedSetId !== null) {
                $rewardSetId = $this->unsigned32($requestedSetId, 'reward_set.reward_set_id', false);
                $setInUse = $this->fetchOne(
                    'SELECT reward_set_id FROM reward_sets WHERE reward_set_id = ? FOR UPDATE',
                    array($rewardSetId),
                    'i'
                );
                if ($setInUse) {
                    $this->fail('reward_set.reward_set_id', 'That reward-set ID is already in use.');
                }
            } else {
                $rewardSetId = $this->allocateId(
                    'reward_sets',
                    'reward_set_id',
                    'reward_set.reward_set_id'
                );
            }
        }

        $options = $rewardSet !== null
            && isset($rewardSet['options'])
            && is_array($rewardSet['options'])
            ? $rewardSet['options']
            : array();
        $optionIds = array();
        foreach ($options as $index => $option) {
            $optionId = $this->unsigned32(
                $option['option_id'],
                "reward_set.options.{$index}.option_id",
                false
            );
            if (isset($optionIds[$optionId])) {
                $this->fail(
                    "reward_set.options.{$index}.option_id",
                    'Option IDs must be unique within a reward set.'
                );
            }
            $optionIds[$optionId] = true;
        }
        if ($existingSet) {
            $existingOptionIds = array();
            foreach ($existingOptionRows as $row) {
                $existingOptionIds[(string) $row['option_id']] = true;
            }
            $this->assertRetainedIdentities(
                $existingOptionIds,
                $optionIds,
                'reward_set.options',
                'Persisted reward option',
                'Set its Enabled field to 0 to retire it safely.'
            );
        }

        $savedRewards = array();
        foreach ($rewards as $index => $reward) {
            $path = "rewards.{$index}";
            $amount = $this->nonNegativeDecimal(
                $reward['amount'],
                $path . '.amount',
                '18446744073709551615'
            );
            if ($amount === '0') {
                $this->fail($path . '.amount', 'Reward amount must be at least 1.');
            }
            $sequence = $this->unsigned32($reward['sequence'], $path . '.sequence', true);
            $rewardType = (int) $reward['reward_type'];
            $rewardDataId = $this->unsigned32($reward['reward_data_id'], $path . '.reward_data_id', true);
            $description = isset($reward['description']) ? (string) $reward['description'] : '';
            $rewardEnabled = $this->flag($reward['enabled']);
            $submittedId = isset($reward['reward_id']) ? $reward['reward_id'] : null;
            if ($submittedId !== null && $submittedId !== '') {
                $rewardId = $this->unsigned32Decimal($submittedId, $path . '.reward_id', false);
                $catalogRow = $this->fetchOne(
                    'SELECT reward_type, reward_data_id, amount, description, enabled '
                    . 'FROM rewards WHERE reward_id = ? FOR UPDATE',
                    array($rewardId),
                    's'
                );
                if (!$catalogRow) {
                    $this->fail($path . '.reward_id', 'The mapped reward catalog row no longer exists.');
                }

                $otherAutomaticReferences = (int) $this->scalar(
                    'SELECT COUNT(*) AS aggregate_count FROM reward_source_entries '
                    . 'WHERE reward_id = ? AND NOT (source_type = 1 AND source_id = ?)',
                    array($rewardId, $achievementId),
                    'si'
                );
                if ($rewardSetId === null) {
                    $otherOptionReferences = (int) $this->scalar(
                        'SELECT COUNT(*) AS aggregate_count FROM reward_option_entries WHERE reward_id = ?',
                        array($rewardId),
                        's'
                    );
                } else {
                    $otherOptionReferences = (int) $this->scalar(
                        'SELECT COUNT(*) AS aggregate_count FROM reward_option_entries '
                        . 'WHERE reward_id = ? AND reward_set_id <> ?',
                        array($rewardId, $rewardSetId),
                        'si'
                    );
                }
                $otherOptionSourceReferences = (int) $this->scalar(
                    'SELECT COUNT(*) AS aggregate_count FROM reward_option_entries option_entry '
                    . 'INNER JOIN reward_sources shared_source '
                    . 'ON shared_source.reward_set_id = option_entry.reward_set_id '
                    . 'WHERE option_entry.reward_id = ? '
                    . 'AND NOT (shared_source.source_type = 1 AND shared_source.source_id = ?)',
                    array($rewardId, $achievementId),
                    'si'
                );
                $catalogChanged = (int) $catalogRow['reward_type'] !== $rewardType
                    || (int) $catalogRow['reward_data_id'] !== $rewardDataId
                    || (string) $catalogRow['amount'] !== $amount
                    || (string) $catalogRow['description'] !== $description
                    || (int) $catalogRow['enabled'] !== $rewardEnabled;
                if ($catalogChanged && (
                    $otherAutomaticReferences > 0
                    || $otherOptionReferences > 0
                    || $otherOptionSourceReferences > 0
                )) {
                    $this->fail(
                        $path,
                        'This reward catalog row is shared by another provider source or reward set. '
                        . 'Create a new grant instead of changing shared reward ID ' . $rewardId . '.'
                    );
                }
                if ($catalogChanged) {
                    $this->execute(
                        'UPDATE rewards SET reward_type = ?, reward_data_id = ?, amount = ?, '
                        . 'description = ?, enabled = ? WHERE reward_id = ?',
                        array($rewardType, $rewardDataId, $amount, $description, $rewardEnabled, $rewardId),
                        'iissis'
                    );
                }
            } else {
                $rewardId = (string) $this->executeInsert(
                    'INSERT INTO rewards '
                    . '(reward_type, reward_data_id, amount, description, enabled) '
                    . 'VALUES (?, ?, ?, ?, ?)',
                    array($rewardType, $rewardDataId, $amount, $description, $rewardEnabled),
                    'iissi'
                );
                $this->unsigned32Decimal($rewardId, $path . '.reward_id', false);
            }
            $savedRewards[] = array(
                'reward_id' => $rewardId,
                'sequence' => $sequence,
                'option_id' => array_key_exists('option_id', $reward) ? $reward['option_id'] : null
            );
        }

        // Automatic mappings belong to this achievement source and can be
        // safely rebuilt without touching mappings owned by other providers.
        $this->execute(
            'DELETE FROM reward_source_entries WHERE source_type = 1 AND source_id = ?',
            array($achievementId),
            'i'
        );
        foreach ($savedRewards as $index => $reward) {
            if ($reward['option_id'] !== null && $reward['option_id'] !== '') {
                continue;
            }
            $this->execute(
                'INSERT INTO reward_source_entries (source_type, source_id, sequence, reward_id) '
                . 'VALUES (1, ?, ?, ?)',
                array($achievementId, $reward['sequence'], (string) $reward['reward_id']),
                'iis'
            );
        }

        if ($rewardSet === null) {
            foreach ($savedRewards as $index => $reward) {
                if ($reward['option_id'] !== null && $reward['option_id'] !== '') {
                    $this->fail("rewards.{$index}.option_id", 'A reward mapping requires a reward set.');
                }
            }
            return;
        }

        $sourceEnabled = array_key_exists('source_enabled', $rewardSet)
            ? $this->flag($rewardSet['source_enabled'])
            : $this->flag($rewardSet['enabled']);
        $setShared = false;
        if ($existingSet) {
            $setShared = (int) $this->scalar(
                'SELECT COUNT(*) AS aggregate_count FROM reward_sources '
                . 'WHERE reward_set_id = ? AND NOT (source_type = 1 AND source_id = ?)',
                array($rewardSetId, $achievementId),
                'ii'
            ) > 0;
        }

        if ($setShared) {
            $submittedOptionRows = array();
            foreach ($options as $option) {
                $submittedOptionRows[] = array(
                    'option_id' => (string) $option['option_id'],
                    'sequence' => (string) $option['sequence'],
                    'label' => isset($option['label']) ? (string) $option['label'] : '',
                    'common_to_all' => (string) $this->flag($option['common_to_all']),
                    'flags' => (string) ((int) $option['flags']),
                    'enabled' => (string) $this->flag($option['enabled'])
                );
            }
            usort($submittedOptionRows, function ($left, $right) {
                return (int) $left['option_id'] - (int) $right['option_id'];
            });
            $storedOptionRows = array();
            foreach ($existingOptionRows as $option) {
                $storedOptionRows[] = array(
                    'option_id' => (string) $option['option_id'],
                    'sequence' => (string) $option['sequence'],
                    'label' => (string) $option['label'],
                    'common_to_all' => (string) $option['common_to_all'],
                    'flags' => (string) $option['flags'],
                    'enabled' => (string) $option['enabled']
                );
            }
            $submittedEntryRows = array();
            foreach ($savedRewards as $reward) {
                if ($reward['option_id'] === null || $reward['option_id'] === '') {
                    continue;
                }
                if (!isset($submittedRewardIds[(string) $reward['reward_id']])) {
                    $this->fail('reward_set', 'A shared reward set cannot receive a newly allocated grant. Clone the set first.');
                }
                $submittedEntryRows[] = array(
                    'option_id' => (string) $reward['option_id'],
                    'sequence' => (string) $reward['sequence'],
                    'reward_id' => (string) $reward['reward_id']
                );
            }
            usort($submittedEntryRows, function ($left, $right) {
                $optionCompare = (int) $left['option_id'] - (int) $right['option_id'];
                return $optionCompare !== 0 ? $optionCompare : strcmp($left['reward_id'], $right['reward_id']);
            });
            $storedEntryRows = array();
            foreach ($existingOptionEntryRows as $entry) {
                $storedEntryRows[] = array(
                    'option_id' => (string) $entry['option_id'],
                    'sequence' => (string) $entry['sequence'],
                    'reward_id' => (string) $entry['reward_id']
                );
            }
            if ((string) $existingSet['title'] !== (isset($rewardSet['title']) ? (string) $rewardSet['title'] : '')
                || (int) $existingSet['enabled'] !== $this->flag($rewardSet['enabled'])
                || $storedOptionRows !== $submittedOptionRows
                || $storedEntryRows !== $submittedEntryRows) {
                $this->fail(
                    'reward_set',
                    'This reward set is shared by another provider source. Its title, enabled state, options, '
                    . 'and grants are read-only here; only this achievement source mapping may be enabled or disabled.'
                );
            }
        } else {
            $this->execute(
                'INSERT INTO reward_sets (reward_set_id, title, enabled) VALUES (?, ?, ?) '
                . 'ON DUPLICATE KEY UPDATE title = VALUES(title), enabled = VALUES(enabled)',
                array(
                    $rewardSetId,
                    isset($rewardSet['title']) ? (string) $rewardSet['title'] : '',
                    $this->flag($rewardSet['enabled'])
                ),
                'isi'
            );
            $this->execute(
                'DELETE FROM reward_option_entries WHERE reward_set_id = ?',
                array($rewardSetId),
                'i'
            );
            $this->execute(
                'DELETE FROM reward_options WHERE reward_set_id = ?',
                array($rewardSetId),
                'i'
            );

            foreach ($options as $index => $option) {
                $optionId = $this->unsigned32(
                    $option['option_id'],
                    "reward_set.options.{$index}.option_id",
                    false
                );
                $this->execute(
                    'INSERT INTO reward_options '
                    . '(reward_set_id, option_id, sequence, label, common_to_all, flags, enabled) '
                    . 'VALUES (?, ?, ?, ?, ?, ?, ?)',
                    array(
                        $rewardSetId,
                        $optionId,
                        $this->unsigned32($option['sequence'], "reward_set.options.{$index}.sequence", true),
                        isset($option['label']) ? (string) $option['label'] : '',
                        $this->flag($option['common_to_all']),
                        (int) $option['flags'],
                        $this->flag($option['enabled'])
                    ),
                    'iiisiii'
                );
            }

            foreach ($savedRewards as $index => $reward) {
                if ($reward['option_id'] === null || $reward['option_id'] === '') {
                    continue;
                }
                $optionId = (int) $reward['option_id'];
                if (!isset($optionIds[$optionId])) {
                    $this->fail("rewards.{$index}.option_id", 'The mapped reward option does not exist.');
                }
                $this->execute(
                    'INSERT INTO reward_option_entries '
                    . '(reward_set_id, option_id, sequence, reward_id) VALUES (?, ?, ?, ?)',
                    array($rewardSetId, $optionId, $reward['sequence'], (string) $reward['reward_id']),
                    'iiis'
                );
            }
        }

        $this->execute(
            'INSERT INTO reward_sources (source_type, source_id, reward_set_id, enabled) '
            . 'VALUES (1, ?, ?, ?) ON DUPLICATE KEY UPDATE '
            . 'reward_set_id = VALUES(reward_set_id), enabled = VALUES(enabled)',
            array($achievementId, $rewardSetId, $sourceEnabled),
            'iii'
        );
    }

    private function syncRestrictions($achievementId, $restrictions)
    {
        $this->execute(
            'DELETE FROM achievement_cast_requirements WHERE achievement_id = ?',
            array($achievementId),
            'i'
        );
        foreach ($restrictions as $index => $restriction) {
            $this->execute(
                'INSERT INTO achievement_cast_requirements '
                . '(restriction_id, achievement_id, requires_completed) VALUES (?, ?, ?)',
                array(
                    $this->unsigned32(
                        $restriction['restriction_id'],
                        "restrictions.{$index}.restriction_id",
                        false
                    ),
                    $achievementId,
                    $this->flag($restriction['requires_completed'])
                ),
                'iii'
            );
        }
    }

    private function validateDefinitionForWrite($definition, $existingId)
    {
        if (!is_array($definition)) {
            $this->fail('achievement', 'The achievement definition must be submitted as an object.');
        }
        $required = array(
            'id', 'name', 'icon_id', 'points', 'has_reward', 'client_flag',
            'version', 'reset_on_version_change', 'enabled', 'associations',
            'components', 'rewards', 'reward_set', 'restrictions'
        );
        foreach ($required as $key) {
            if (!array_key_exists($key, $definition)) {
                $this->fail($key, "Required achievement field {$key} is missing.");
            }
        }
        foreach (array('associations', 'components', 'rewards', 'restrictions') as $key) {
            if (!is_array($definition[$key])) {
                $this->fail($key, "Achievement field {$key} must be a list.");
            }
        }
        if ($definition['reward_set'] !== null && !is_array($definition['reward_set'])) {
            $this->fail('reward_set', 'The reward set must be an object or null.');
        }

        $this->unsigned32($definition['id'], 'id', false);
        if ($existingId !== null && (int) $definition['id'] !== (int) $existingId) {
            $this->fail('id', 'The stable achievement ID cannot be changed after creation.');
        }
        $name = trim((string) $definition['name']);
        if ($name === '') {
            $this->fail('name', 'Achievement name is required.');
        }
        if ($this->characterLength($name) > 255) {
            $this->fail('name', 'Achievement name may not exceed 255 characters.');
        }
        $this->unsigned32($definition['icon_id'], 'icon_id', true);
        $this->unsigned32($definition['points'], 'points', true);
        $this->flag($definition['has_reward']);
        $this->flag($definition['client_flag']);
        $this->unsigned32($definition['version'], 'version', true);
        $this->flag($definition['reset_on_version_change']);
        $enabledDefinition = $this->flag($definition['enabled']) === 1;

        $associationIds = array();
        foreach ($definition['associations'] as $index => $association) {
            if (!is_array($association)) {
                $this->fail("associations.{$index}", 'Each category association must be an object.');
            }
            foreach (array('category_id', 'sequence') as $key) {
                if (!array_key_exists($key, $association)) {
                    $this->fail("associations.{$index}.{$key}", "Association field {$key} is required.");
                }
            }
            $categoryId = $this->unsigned32(
                $association['category_id'],
                "associations.{$index}.category_id",
                false
            );
            if (isset($associationIds[$categoryId])) {
                $this->fail(
                    "associations.{$index}.category_id",
                    'An achievement may be associated with a category only once.'
                );
            }
            $associationIds[$categoryId] = true;
            $this->unsigned32($association['sequence'], "associations.{$index}.sequence", true);
            if (isset($association['display_text'])
                && $this->characterLength((string) $association['display_text']) > 255) {
                $this->fail(
                    "associations.{$index}.display_text",
                    'Category display text may not exceed 255 characters.'
                );
            }
        }
        if ($enabledDefinition && count($associationIds) === 0) {
            $this->fail('associations', 'An enabled achievement must have at least one category association.');
        }

        $componentKeys = array();
        $presentationCounts = array();
        $requiredClasses = array();
        foreach ($definition['components'] as $componentIndex => $component) {
            if (!is_array($component)) {
                $this->fail("components.{$componentIndex}", 'Each component must be an object.');
            }
            foreach (array('component_type', 'sequence', 'component_id', 'presentation_count', 'criteria') as $key) {
                if (!array_key_exists($key, $component)) {
                    $this->fail("components.{$componentIndex}.{$key}", "Component field {$key} is required.");
                }
            }
            $componentType = (int) $component['component_type'];
            if ($componentType < 0 || $componentType > 3) {
                $this->fail("components.{$componentIndex}.component_type", 'Component type must be 0 through 3.');
            }
            $componentId = $this->unsigned32(
                $component['component_id'],
                "components.{$componentIndex}.component_id",
                true
            );
            $this->unsigned32($component['sequence'], "components.{$componentIndex}.sequence", true);
            $presentationCount = $this->unsigned32(
                $component['presentation_count'],
                "components.{$componentIndex}.presentation_count",
                false
            );
            $componentKey = $this->componentKey($componentType, $componentId);
            if (isset($componentKeys[$componentKey])) {
                $this->fail(
                    "components.{$componentIndex}.component_id",
                    'Component identity must be unique within the achievement.'
                );
            }
            $componentKeys[$componentKey] = true;
            if (isset($presentationCounts[$componentId])
                && $presentationCounts[$componentId] !== $presentationCount) {
                $this->fail(
                    "components.{$componentIndex}.presentation_count",
                    'Components sharing a component ID must share one global presentation count.'
                );
            }
            $presentationCounts[$componentId] = $presentationCount;
            if (!is_array($component['criteria'])) {
                $this->fail("components.{$componentIndex}.criteria", 'Component criteria must be a list.');
            }

            $criterionIdentities = array();
            $enabledPolicy = null;
            foreach ($component['criteria'] as $criterionIndex => $criterion) {
                $path = "components.{$componentIndex}.criteria.{$criterionIndex}";
                if (!is_array($criterion)) {
                    $this->fail($path, 'Each criterion must be an object.');
                }
                foreach (array(
                    'event_type', 'progress_mode', 'behavior', 'target_id', 'target_id2',
                    'target_value', 'required_count', 'enabled'
                ) as $key) {
                    if (!array_key_exists($key, $criterion)) {
                        $this->fail($path . '.' . $key, "Criterion field {$key} is required.");
                    }
                }
                $eventType = (int) $criterion['event_type'];
                $progressMode = (int) $criterion['progress_mode'];
                $behavior = (int) $criterion['behavior'];
                if ($eventType < 0 || $eventType > 13) {
                    $this->fail($path . '.event_type', 'Criterion event type must be 0 through 13.');
                }
                if ($progressMode < 0 || $progressMode > 3) {
                    $this->fail($path . '.progress_mode', 'Criterion progress mode must be 0 through 3.');
                }
                if ($behavior < 0 || $behavior > 5) {
                    $this->fail($path . '.behavior', 'Criterion behavior must be 0 through 5.');
                }
                $targetId = $this->unsigned32($criterion['target_id'], $path . '.target_id', true);
                $targetId2 = $this->unsigned32($criterion['target_id2'], $path . '.target_id2', true);
                $targetValue = $this->nonNegativeDecimal($criterion['target_value'], $path . '.target_value');
                $requiredCount = $this->unsigned32(
                    $criterion['required_count'],
                    $path . '.required_count',
                    false
                );
                $criterionEnabled = $this->flag($criterion['enabled']) === 1;
                $criterionIdentity = $eventType . ':' . $targetId . ':' . $targetId2;
                if (isset($criterionIdentities[$criterionIdentity])) {
                    $this->fail(
                        $path . '.target_id',
                        'Criterion event and target identity must be unique for this component.'
                    );
                }
                $criterionIdentities[$criterionIdentity] = true;
                if (!$criterionEnabled) {
                    continue;
                }
                if ($componentType === 3) {
                    $this->fail(
                        $path . '.enabled',
                        'RoF2 component type 3 is presentation-only and cannot have an enabled criterion.'
                    );
                }

                $policy = $eventType . ':' . $progressMode . ':' . $behavior . ':' . $requiredCount;
                if ($enabledPolicy !== null && $enabledPolicy !== $policy) {
                    $this->fail(
                        $path,
                        'Enabled alternative criteria must agree on event, mode, behavior, and required count.'
                    );
                }
                $enabledPolicy = $policy;

                if ($targetId2 !== 0 && !in_array($eventType, array(7, 12, 13), true)) {
                    $this->fail($path . '.target_id2', 'This event does not support a secondary target.');
                }
                if ($eventType === 12 && $targetId === 0) {
                    $this->fail($path . '.target_id', 'NPC-name kill criteria require a nonzero canonical-name hash.');
                }
                if ($eventType === 4 && $targetId === 0) {
                    $this->fail($path . '.target_id', 'Task-complete criteria require a specific nonzero task ID.');
                }
                if (in_array($eventType, array(1, 10), true) && $targetId !== 0) {
                    $this->fail($path . '.target_id', 'Level and alternate-advancement criteria must use target ID zero.');
                }
                if ($eventType === 7 && $targetId2 !== 0 && ($targetId2 < 1 || $targetId2 > 16)) {
                    $this->fail($path . '.target_id2', 'Own-item class must be zero or a valid EQ class from 1 through 16.');
                }
                if ($eventType === 9 && $targetId !== self::UINT32_MAX && $targetId > 77) {
                    $this->fail($path . '.target_id', 'Skill Value requires skill 0 through 77, or 4294967295 for the wildcard.');
                }
                if ($eventType === 13
                    && ($targetId > 77 || $targetId2 < 1 || $targetId2 > 16
                        || $this->compareDecimal($targetValue, '1') < 0
                        || $this->compareDecimal($targetValue, '255') > 0)) {
                    $this->fail(
                        $path,
                        'Skill Cap requires skill 0 through 77, class 1 through 16, and milestone level 1 through 255.'
                    );
                }

                $incrementDisallowed = in_array($eventType, array(1, 4, 5, 7, 9, 10, 11, 13), true);
                if ($progressMode === 0 && $incrementDisallowed) {
                    $this->fail(
                        $path . '.progress_mode',
                        'Increment mode cannot be used for reconciled absolute or one-time events.'
                    );
                }
                if ($progressMode === 3
                    && in_array($eventType, array(1, 7, 9, 10, 13), true)
                    && $this->compareDecimal($targetValue, '1') < 0) {
                    $this->fail(
                        $path . '.target_value',
                        'Boolean mode requires a positive target value for an absolute event.'
                    );
                }

                $completionPolicy = !in_array($behavior, array(1, 4, 5), true);
                if ($completionPolicy && in_array($eventType, array(7, 13), true)
                    && $targetId2 >= 1 && $targetId2 <= 16) {
                    $requiredClasses[$targetId2] = true;
                }
            }
        }
        if (count($requiredClasses) > 1) {
            $this->fail('components', 'Required, unlock, and visibility class criteria must agree on one EQ class.');
        }

        $this->validateRewardsForWrite(
            $definition['rewards'],
            $definition['reward_set'],
            $enabledDefinition
        );
        $restrictionIds = array();
        foreach ($definition['restrictions'] as $index => $restriction) {
            if (!is_array($restriction)
                || !array_key_exists('restriction_id', $restriction)
                || !array_key_exists('requires_completed', $restriction)) {
                $this->fail("restrictions.{$index}", 'Restriction ID and completion policy are required.');
            }
            $restrictionId = $this->unsigned32(
                $restriction['restriction_id'],
                "restrictions.{$index}.restriction_id",
                false
            );
            if (isset($restrictionIds[$restrictionId])) {
                $this->fail(
                    "restrictions.{$index}.restriction_id",
                    'A restriction ID may be attached to this achievement only once.'
                );
            }
            $restrictionIds[$restrictionId] = true;
            $this->flag($restriction['requires_completed']);
        }

        if (function_exists('achievement_validate_definition')) {
            $context = $this->validationContext($existingId);
            $validation = achievement_validate_definition($definition, $existingId, $context);
            $this->throwMetadataValidationErrors($validation, 'achievement');
        }
    }

    /**
     * Durable policy edits require a strictly newer exact definition version.
     * The prospective policy deliberately ignores top-level publication state,
     * so disable/edit/re-enable cannot bypass this guard. Incomplete selectable
     * catalog contents are ignored only while their source or shared set is
     * disabled and therefore unreachable.
     */
    private function assertVersionBumpedForPolicyChange($current, $submitted)
    {
        if ($this->runtimePolicyFingerprint($current) === $this->runtimePolicyFingerprint($submitted)) {
            return;
        }
        $currentVersion = $this->unsigned32($current['version'], 'version', true);
        $submittedVersion = $this->unsigned32($submitted['version'], 'version', true);
        if ($submittedVersion <= $currentVersion) {
            $this->fail(
                'version',
                'Runtime achievement policy changed. Increase the exact definition version above '
                . $currentVersion . ' before saving so durable character state and pending updates '
                . 'cannot be interpreted under changed policy.'
            );
        }
    }

    private function runtimePolicyFingerprint($definition)
    {
        $policy = array(
            // This flag changes version-mismatch reconciliation, including
            // whether completion/progress/reward/selection ledgers are reset.
            // It is therefore runtime policy even though it is not a criterion.
            'reset_on_version_change' => $this->flag(
                isset($definition['reset_on_version_change'])
                    ? $definition['reset_on_version_change'] : 0
            ),
            'components' => array(),
            'automatic_rewards' => array(),
            'selectable' => null,
            'cast_requirements' => array()
        );

        $components = isset($definition['components']) && is_array($definition['components'])
            ? $definition['components'] : array();
        foreach ($components as $component) {
            if (!is_array($component)) {
                continue;
            }
            $componentPolicy = array(
                'component_type' => isset($component['component_type']) ? (int) $component['component_type'] : 0,
                'sequence' => isset($component['sequence']) ? (string) $component['sequence'] : '0',
                'component_id' => isset($component['component_id']) ? (string) $component['component_id'] : '0',
                'presentation_count' => isset($component['presentation_count'])
                    ? (string) $component['presentation_count'] : '1',
                'criteria' => array()
            );
            $criteria = isset($component['criteria']) && is_array($component['criteria'])
                ? $component['criteria'] : array();
            foreach ($criteria as $criterion) {
                if (!is_array($criterion) || $this->flag(isset($criterion['enabled']) ? $criterion['enabled'] : 0) !== 1) {
                    continue;
                }
                $componentPolicy['criteria'][] = array(
                    'event_type' => isset($criterion['event_type']) ? (int) $criterion['event_type'] : 0,
                    'progress_mode' => isset($criterion['progress_mode']) ? (int) $criterion['progress_mode'] : 0,
                    'behavior' => isset($criterion['behavior']) ? (int) $criterion['behavior'] : 0,
                    'target_id' => isset($criterion['target_id']) ? (string) $criterion['target_id'] : '0',
                    'target_id2' => isset($criterion['target_id2']) ? (string) $criterion['target_id2'] : '0',
                    'target_value' => isset($criterion['target_value']) ? (string) $criterion['target_value'] : '0',
                    'required_count' => isset($criterion['required_count']) ? (string) $criterion['required_count'] : '1'
                );
            }
            usort($componentPolicy['criteria'], array($this, 'comparePolicyRows'));
            $policy['components'][] = $componentPolicy;
        }
        usort($policy['components'], array($this, 'comparePolicyRows'));

        $rewards = isset($definition['rewards']) && is_array($definition['rewards'])
            ? $definition['rewards'] : array();
        foreach ($rewards as $reward) {
            if (!is_array($reward)
                || $this->flag(isset($reward['enabled']) ? $reward['enabled'] : 0) !== 1
                || (isset($reward['option_id']) && $reward['option_id'] !== null && $reward['option_id'] !== '')) {
                continue;
            }
            $policy['automatic_rewards'][] = $this->rewardPolicyRow($reward, null);
        }
        usort($policy['automatic_rewards'], array($this, 'comparePolicyRows'));

        $rewardSet = isset($definition['reward_set']) && is_array($definition['reward_set'])
            ? $definition['reward_set'] : null;
        if ($rewardSet !== null) {
            $sourceEnabled = $this->flag(isset($rewardSet['source_enabled']) ? $rewardSet['source_enabled'] : 0);
            $setEnabled = $this->flag(isset($rewardSet['enabled']) ? $rewardSet['enabled'] : 0);
            $selectable = array(
                'reward_set_id' => isset($rewardSet['reward_set_id']) && $rewardSet['reward_set_id'] !== null
                    ? (string) $rewardSet['reward_set_id'] : '',
                'source_enabled' => $sourceEnabled,
                'set_enabled' => $setEnabled,
                'options' => array(),
                'rewards' => array()
            );
            if ($sourceEnabled === 1 && $setEnabled === 1) {
                $options = isset($rewardSet['options']) && is_array($rewardSet['options'])
                    ? $rewardSet['options'] : array();
                $enabledOptions = array();
                foreach ($options as $option) {
                    if (!is_array($option)
                        || $this->flag(isset($option['enabled']) ? $option['enabled'] : 0) !== 1) {
                        continue;
                    }
                    $optionId = isset($option['option_id']) ? (string) $option['option_id'] : '0';
                    $enabledOptions[$optionId] = true;
                    $selectable['options'][] = array(
                        'option_id' => $optionId,
                        'sequence' => isset($option['sequence']) ? (string) $option['sequence'] : '0',
                        'common_to_all' => $this->flag(isset($option['common_to_all']) ? $option['common_to_all'] : 0),
                        'flags' => isset($option['flags']) ? (int) $option['flags'] : 0
                    );
                }
                foreach ($rewards as $reward) {
                    if (!is_array($reward)
                        || $this->flag(isset($reward['enabled']) ? $reward['enabled'] : 0) !== 1
                        || !isset($reward['option_id'])
                        || $reward['option_id'] === null
                        || $reward['option_id'] === '') {
                        continue;
                    }
                    $optionId = (string) $reward['option_id'];
                    if (isset($enabledOptions[$optionId])) {
                        $selectable['rewards'][] = $this->rewardPolicyRow($reward, $optionId);
                    }
                }
                usort($selectable['options'], array($this, 'comparePolicyRows'));
                usort($selectable['rewards'], array($this, 'comparePolicyRows'));
            }
            $policy['selectable'] = $selectable;
        }

        $restrictions = isset($definition['restrictions']) && is_array($definition['restrictions'])
            ? $definition['restrictions'] : array();
        foreach ($restrictions as $restriction) {
            if (!is_array($restriction)) {
                continue;
            }
            $policy['cast_requirements'][] = array(
                'restriction_id' => isset($restriction['restriction_id'])
                    ? (string) $restriction['restriction_id'] : '0',
                'requires_completed' => $this->flag(
                    isset($restriction['requires_completed']) ? $restriction['requires_completed'] : 0
                )
            );
        }
        usort($policy['cast_requirements'], array($this, 'comparePolicyRows'));

        return hash('sha256', json_encode($policy));
    }

    private function rewardPolicyRow($reward, $optionId)
    {
        return array(
            'reward_id' => isset($reward['reward_id']) && $reward['reward_id'] !== null
                ? (string) $reward['reward_id'] : '',
            'sequence' => isset($reward['sequence']) ? (string) $reward['sequence'] : '0',
            'reward_type' => isset($reward['reward_type']) ? (int) $reward['reward_type'] : 0,
            'reward_data_id' => isset($reward['reward_data_id']) ? (string) $reward['reward_data_id'] : '0',
            'amount' => isset($reward['amount']) ? (string) $reward['amount'] : '1',
            'option_id' => $optionId
        );
    }

    private function comparePolicyRows($left, $right)
    {
        return strcmp(json_encode($left), json_encode($right));
    }

    private function validateRewardsForWrite($rewards, $rewardSet, $definitionEnabled)
    {
        $rewardIds = array();
        $automaticSequences = array();
        $optionIds = array();
        $enabledOptionGrants = array();
        $effectiveAutomaticAaRewards = array();
        if ($rewardSet !== null) {
            foreach (array('reward_set_id', 'title', 'enabled', 'source_enabled', 'options') as $key) {
                if (!array_key_exists($key, $rewardSet)) {
                    $this->fail('reward_set.' . $key, "Reward-set field {$key} is required.");
                }
            }
            if ($rewardSet['reward_set_id'] !== null && $rewardSet['reward_set_id'] !== '') {
                $this->unsigned32($rewardSet['reward_set_id'], 'reward_set.reward_set_id', false);
            }
            if ($this->characterLength((string) $rewardSet['title']) > 255) {
                $this->fail('reward_set.title', 'Reward-set title may not exceed 255 characters.');
            }
            $this->flag($rewardSet['enabled']);
            $this->flag($rewardSet['source_enabled']);
            if (!is_array($rewardSet['options'])) {
                $this->fail('reward_set.options', 'Reward-set options must be a list.');
            }
            foreach ($rewardSet['options'] as $index => $option) {
                if (!is_array($option)) {
                    $this->fail("reward_set.options.{$index}", 'Each reward option must be an object.');
                }
                foreach (array('option_id', 'sequence', 'label', 'common_to_all', 'flags', 'enabled') as $key) {
                    if (!array_key_exists($key, $option)) {
                        $this->fail("reward_set.options.{$index}.{$key}", "Reward option field {$key} is required.");
                    }
                }
                $optionId = $this->unsigned32(
                    $option['option_id'],
                    "reward_set.options.{$index}.option_id",
                    false
                );
                if (isset($optionIds[$optionId])) {
                    $this->fail(
                        "reward_set.options.{$index}.option_id",
                        'Option IDs must be unique within a reward set.'
                    );
                }
                $optionIds[$optionId] = $option;
                $this->unsigned32($option['sequence'], "reward_set.options.{$index}.sequence", true);
                if ($this->characterLength((string) $option['label']) > 255) {
                    $this->fail("reward_set.options.{$index}.label", 'Reward option label may not exceed 255 characters.');
                }
                $this->flag($option['common_to_all']);
                $flags = (int) $option['flags'];
                if ($flags < 0 || $flags > 255) {
                    $this->fail("reward_set.options.{$index}.flags", 'Reward option flags must be 0 through 255.');
                }
                $this->flag($option['enabled']);
            }
        }

        foreach ($rewards as $index => $reward) {
            $path = "rewards.{$index}";
            if (!is_array($reward)) {
                $this->fail($path, 'Each reward grant must be an object.');
            }
            foreach (array('reward_id', 'sequence', 'reward_type', 'reward_data_id', 'amount', 'enabled', 'option_id') as $key) {
                if (!array_key_exists($key, $reward)) {
                    $this->fail($path . '.' . $key, "Reward field {$key} is required.");
                }
            }
            if ($reward['reward_id'] !== null && $reward['reward_id'] !== '') {
                $rewardId = $this->unsigned32Decimal($reward['reward_id'], $path . '.reward_id', false);
                if (isset($rewardIds[$rewardId])) {
                    $this->fail($path . '.reward_id', 'A canonical reward ID may appear only once.');
                }
                $rewardIds[$rewardId] = true;
            }
            $sequence = $this->unsigned32($reward['sequence'], $path . '.sequence', true);
            $rewardType = (int) $reward['reward_type'];
            if ($rewardType < 0 || $rewardType > 7) {
                $this->fail($path . '.reward_type', 'Reward type must be 0 through 7.');
            }
            $dataId = $this->unsigned32($reward['reward_data_id'], $path . '.reward_data_id', true);
            $amount = $this->nonNegativeDecimal(
                $reward['amount'],
                $path . '.amount',
                '18446744073709551615'
            );
            if ($amount === '0') {
                $this->fail($path . '.amount', 'Reward amount must be at least 1.');
            }
            $enabled = $this->flag($reward['enabled']) === 1;
            if (isset($reward['description'])
                && $this->characterLength((string) $reward['description']) > 255) {
                $this->fail($path . '.description', 'Reward description may not exceed 255 characters.');
            }
            $optionId = null;
            if ($reward['option_id'] !== null && $reward['option_id'] !== '') {
                $optionId = (int) $reward['option_id'];
                if ($rewardSet === null || !isset($optionIds[$optionId])) {
                    $this->fail($path . '.option_id', 'A mapped reward must reference an option in this reward set.');
                }
                if ($enabled) {
                    $enabledOptionGrants[$optionId] = true;
                }
            } else {
                if (isset($automaticSequences[$sequence])) {
                    $this->fail(
                        $path . '.sequence',
                        'Automatic reward order must be unique within this achievement source.'
                    );
                }
                $automaticSequences[$sequence] = true;
            }

            $runtimeReachable = $definitionEnabled && $enabled;
            if ($optionId !== null) {
                $runtimeReachable = $runtimeReachable
                    && $rewardSet !== null
                    && $this->flag($rewardSet['source_enabled']) === 1
                    && $this->flag($rewardSet['enabled']) === 1
                    && isset($optionIds[$optionId])
                    && $this->flag($optionIds[$optionId]['enabled']) === 1;
            }
            if ($runtimeReachable) {
                $this->validateRuntimeRewardSemantics(
                    $rewardType,
                    $dataId,
                    $amount,
                    $path
                );
            }
            if ($runtimeReachable && $rewardType === 7 && $optionId !== null) {
                $this->fail(
                    $path . '.option_id',
                    'Class-ineligible AA fallbacks are valid only as direct automatic achievement rewards.'
                );
            }
            if ($runtimeReachable && $optionId === null
                && in_array($rewardType, array(6, 7), true)) {
                $aaKey = (string) $dataId;
                if (!isset($effectiveAutomaticAaRewards[$aaKey])) {
                    $effectiveAutomaticAaRewards[$aaKey] = array(6 => array(), 7 => array());
                }
                $effectiveAutomaticAaRewards[$aaKey][$rewardType][] = $path;
            }
        }

        foreach ($effectiveAutomaticAaRewards as $aaAbilityId => $aaRewards) {
            if (count($aaRewards[7]) === 0) {
                continue;
            }
            if (count($aaRewards[6]) !== 1 || count($aaRewards[7]) !== 1) {
                $this->fail(
                    $aaRewards[7][0] . '.reward_data_id',
                    'Each enabled automatic class-ineligible AA fallback requires exactly one enabled automatic type 6 grant and exactly one type 7 fallback with the same AA ability ID (' . $aaAbilityId . ').'
                );
            }
        }

        if (!$definitionEnabled
            || $rewardSet === null
            || $this->flag($rewardSet['source_enabled']) !== 1
            || $this->flag($rewardSet['enabled']) !== 1) {
            return;
        }
        $hasEnabled = false;
        $hasSelectable = false;
        foreach ($rewardSet['options'] as $index => $option) {
            if ($this->flag($option['enabled']) !== 1) {
                continue;
            }
            $hasEnabled = true;
            $optionId = (int) $option['option_id'];
            if ($this->flag($option['common_to_all']) === 0) {
                $hasSelectable = true;
            }
            if (!isset($enabledOptionGrants[$optionId])) {
                $this->fail(
                    "reward_set.options.{$index}",
                    'Every enabled reward option must contain at least one enabled grant.'
                );
            }
        }
        if (!$hasEnabled || !$hasSelectable) {
            $this->fail(
                'reward_set.options',
                'An enabled reward set requires at least one enabled, non-common selectable option.'
            );
        }
    }

    private function validateRuntimeRewardSemantics($rewardType, $dataId, $amount, $path)
    {
        switch ((int) $rewardType) {
            case 0:
                if ((int) $dataId === 0) {
                    $this->fail($path . '.reward_data_id', 'Runtime item rewards require a nonzero item ID.');
                }
                if ($this->compareDecimal($amount, '32767') > 0) {
                    $this->fail($path . '.amount', 'Runtime item reward quantity must be 1 through 32,767.');
                }
                break;

            case 1:
                if ((int) $dataId !== 0 && (int) $dataId !== 1) {
                    $this->fail($path . '.reward_data_id', 'Experience mode must be 0 (normal handling) or 1 (normal-only raw XP).');
                }
                if ($this->compareDecimal($amount, '4294967295') > 0) {
                    $this->fail($path . '.amount', 'Runtime experience quantity must be 1 through 4,294,967,295.');
                }
                break;

            case 2:
                if ((int) $dataId !== 0) {
                    $this->fail($path . '.reward_data_id', 'Alternate Advancement reward data is reserved and must be 0.');
                }
                if ($this->compareDecimal($amount, '2147483647') > 0) {
                    $this->fail($path . '.amount', 'Runtime AA point quantity must be 1 through 2,147,483,647.');
                }
                break;

            case 3:
                if ((int) $dataId !== 0) {
                    $this->fail($path . '.reward_data_id', 'Copper reward data is reserved and must be 0.');
                }
                if ($this->compareDecimal($amount, '2147483647999') > 0) {
                    $this->fail($path . '.amount', 'Runtime copper quantity must be 1 through 2,147,483,647,999.');
                }
                break;

            case 4:
                if ((int) $dataId === 0) {
                    $this->fail($path . '.reward_data_id', 'Runtime alternate-currency rewards require a nonzero currency ID.');
                }
                if ($this->compareDecimal($amount, '2147483647') > 0) {
                    $this->fail($path . '.amount', 'Runtime alternate-currency quantity must be 1 through 2,147,483,647.');
                }
                break;

            case 5:
                if ((int) $dataId < 1 || (int) $dataId > 2147483647) {
                    $this->fail($path . '.reward_data_id', 'Runtime title-set ID must be 1 through 2,147,483,647.');
                }
                if ($this->compareDecimal($amount, '1') !== 0) {
                    $this->fail($path . '.amount', 'Runtime title rewards are singular; Amount must be exactly 1.');
                }
                break;

            case 6:
                if ((int) $dataId === 0) {
                    $this->fail($path . '.reward_data_id', 'Specific AA ability rewards require a nonzero aa_ability.id.');
                }
                if ($this->compareDecimal($amount, '2147483647') > 0) {
                    $this->fail($path . '.amount', 'The desired cumulative AA rank must be 1 through 2,147,483,647.');
                }
                break;

            case 7:
                if ((int) $dataId === 0) {
                    $this->fail($path . '.reward_data_id', 'Class-ineligible AA fallbacks require a nonzero class-limited aa_ability.id.');
                }
                if ($this->compareDecimal($amount, '2147483647') > 0) {
                    $this->fail($path . '.amount', 'Class-ineligible fallback AA points must be 1 through 2,147,483,647.');
                }
                break;
        }
    }

    private function validateCategoryForWrite($category, $existingId)
    {
        if (!is_array($category)) {
            $this->fail('category', 'The achievement category must be submitted as an object.');
        }
        foreach (array('id', 'parent_id', 'sequence', 'name', 'description', 'icon') as $key) {
            if (!array_key_exists($key, $category)) {
                $this->fail($key, "Required category field {$key} is missing.");
            }
        }
        $id = $this->unsigned32($category['id'], 'id', false);
        if ($existingId !== null && $id !== (int) $existingId) {
            $this->fail('id', 'The stable category ID cannot be changed after creation.');
        }
        $this->unsigned32($category['parent_id'], 'parent_id', true);
        $this->unsigned32($category['sequence'], 'sequence', true);
        if (trim((string) $category['name']) === '') {
            $this->fail('name', 'Category name is required.');
        }
        if ($this->characterLength((string) $category['name']) > 255) {
            $this->fail('name', 'Category name may not exceed 255 characters.');
        }
        if ($this->characterLength((string) $category['icon']) > 255) {
            $this->fail('icon', 'Category icon may not exceed 255 characters.');
        }
        if (function_exists('achievement_validate_category')) {
            $validation = achievement_validate_category(
                $category,
                $existingId,
                $this->validationContext(null)
            );
            $this->throwMetadataValidationErrors($validation, 'category');
        }
    }

    private function throwMetadataValidationErrors($validation, $defaultField)
    {
        if (!is_array($validation)) {
            return;
        }
        $blocking = array();
        foreach ($validation as $error) {
            if (!is_array($error)) {
                continue;
            }
            $severity = isset($error['severity']) ? strtolower((string) $error['severity']) : 'error';
            if ($severity === 'error') {
                $blocking[] = $error;
            }
        }
        if (count($blocking) === 0) {
            return;
        }
        $first = $blocking[0];
        $field = isset($first['path']) && $first['path'] !== '' ? $first['path'] : $defaultField;
        $message = isset($first['message']) ? $first['message'] : 'The submitted achievement data is invalid.';
        $this->fail($field, $message, array('validation_errors' => $blocking));
    }

    private function validationContext($currentAchievementId)
    {
        $categoryRows = $this->fetchAll('SELECT id, parent_id FROM achievement_categories');
        $categoryIds = array();
        $parentMap = array();
        foreach ($categoryRows as $row) {
            $categoryIds[] = (int) $row['id'];
            $parentMap[(int) $row['id']] = (int) $row['parent_id'];
        }
        $achievementRows = $this->fetchAll('SELECT id FROM achievements');
        $achievementIds = array();
        foreach ($achievementRows as $row) {
            $achievementIds[] = (int) $row['id'];
        }
        if ($currentAchievementId === null) {
            // A create request may legitimately reference its own submitted ID
            // only while disabled; repository reference checks decide that.
        }
        $edgeRows = $this->fetchAll(
            'SELECT achievement_id, target_id FROM achievement_criteria '
            . 'WHERE event_type = ? AND enabled = ? AND target_id > 0',
            array(11, 1),
            'ii'
        );
        $edges = array();
        foreach ($edgeRows as $row) {
            $source = (int) $row['achievement_id'];
            if (!isset($edges[$source])) {
                $edges[$source] = array();
            }
            $edges[$source][] = (int) $row['target_id'];
        }
        return array(
            'category_ids' => $categoryIds,
            'achievement_ids' => $achievementIds,
            'dependency_edges' => $edges,
            'category_parent_map' => $parentMap
        );
    }

    private function assertAggregateReferences($definition, $achievementId)
    {
        $associations = isset($definition['associations']) ? $definition['associations'] : array();
        $this->assertAssociationReferences($associations);
        $this->assertAlternateAdvancementRewardReferences($definition);

        $targets = array();
        foreach ($definition['components'] as $component) {
            foreach ($component['criteria'] as $criterion) {
                if ((int) $criterion['event_type'] !== 11 || (int) $criterion['target_id'] === 0) {
                    continue;
                }
                $targetId = (int) $criterion['target_id'];
                if ($targetId === $achievementId && $this->flag($criterion['enabled']) === 1) {
                    $this->fail('components', 'An enabled achievement cannot depend on its own completion.');
                }
                $targets[$targetId] = true;
            }
        }
        if (count($targets) > 0) {
            $targetIds = array_keys($targets);
            $rows = $this->fetchAll(
                'SELECT id FROM achievements WHERE id IN (' . $this->placeholders(count($targetIds)) . ') FOR UPDATE',
                $targetIds,
                str_repeat('i', count($targetIds))
            );
            $found = array();
            foreach ($rows as $row) {
                $found[(int) $row['id']] = true;
            }
            foreach ($targetIds as $targetId) {
                if ($targetId !== $achievementId && !isset($found[$targetId])) {
                    $this->fail(
                        'components',
                        "Achievement-complete criteria reference missing achievement {$targetId}."
                    );
                }
            }
        }
        if ($this->flag($definition['enabled']) === 1) {
            $this->assertNoDependencyCycle($achievementId, $definition);
        }
    }

    /**
     * Validate published AA reward references against the same enabled ability
     * catalog and linked rank order consumed by Zone::LoadAlternateAdvancement.
     * Disabled or otherwise unreachable rows remain safe drafts.
     */
    private function assertAlternateAdvancementRewardReferences($definition)
    {
        if ($this->flag(isset($definition['enabled']) ? $definition['enabled'] : 0) !== 1) {
            return;
        }

        $rewardSet = isset($definition['reward_set']) && is_array($definition['reward_set'])
            ? $definition['reward_set'] : null;
        $selectableActive = $rewardSet !== null
            && $this->flag(isset($rewardSet['enabled']) ? $rewardSet['enabled'] : 0) === 1
            && $this->flag(isset($rewardSet['source_enabled']) ? $rewardSet['source_enabled'] : 0) === 1;
        $enabledOptions = array();
        if ($selectableActive && isset($rewardSet['options']) && is_array($rewardSet['options'])) {
            foreach ($rewardSet['options'] as $option) {
                if (is_array($option)
                    && $this->flag(isset($option['enabled']) ? $option['enabled'] : 0) === 1) {
                    $enabledOptions[(string) $option['option_id']] = true;
                }
            }
        }

        $aaRewards = array();
        $abilityIds = array();
        $rewards = isset($definition['rewards']) && is_array($definition['rewards'])
            ? $definition['rewards'] : array();
        foreach ($rewards as $index => $reward) {
            if (!is_array($reward)
                || $this->flag(isset($reward['enabled']) ? $reward['enabled'] : 0) !== 1) {
                continue;
            }
            $optionId = isset($reward['option_id']) ? $reward['option_id'] : null;
            if ($optionId !== null && $optionId !== ''
                && (!$selectableActive || !isset($enabledOptions[(string) $optionId]))) {
                continue;
            }
            $rewardType = (int) $reward['reward_type'];
            if (!in_array($rewardType, array(6, 7), true)) {
                continue;
            }
            $dataId = (int) $reward['reward_data_id'];
            $aaRewards[] = array(
                'index' => $index,
                'type' => $rewardType,
                'data_id' => $dataId,
                'amount' => (string) $reward['amount']
            );
            $abilityIds[$dataId] = $dataId;
        }
        if (count($aaRewards) === 0) {
            return;
        }
        foreach ($aaRewards as $reward) {
            if ($reward['type'] === 6 && $this->compareDecimal(
                $reward['amount'],
                (string) self::AA_RANK_CHAIN_LIMIT
            ) > 0) {
                $this->fail(
                    'rewards.' . $reward['index'] . '.amount',
                    'Desired AA rank exceeds the editor safety limit of '
                    . number_format(self::AA_RANK_CHAIN_LIMIT) . ' linked ranks.'
                );
            }
        }

        try {
            $abilityRows = $this->fetchAll(
                'SELECT id, name, classes, first_rank_id FROM aa_ability '
                . 'WHERE enabled = 1 AND id IN (' . $this->placeholders(count($abilityIds)) . ')',
                array_values($abilityIds),
                str_repeat('i', count($abilityIds))
            );
            $firstRankIds = array();
            foreach ($abilityRows as $abilityRow) {
                $firstRankIds[] = (int) $abilityRow['first_rank_id'];
            }
            $rankMap = $this->alternateAdvancementRankMap($firstRankIds);
        } catch (AchievementRepositoryException $exception) {
            throw new AchievementRepositoryException(
                'AA reward validation requires compatible aa_ability and aa_ranks tables in the configured content database.',
                'rewards',
                array('lookup_sources' => array('aa_ability', 'aa_ranks')),
                $exception
            );
        }

        $abilities = array();
        foreach ($abilityRows as $row) {
            $abilities[(int) $row['id']] = $row;
        }
        foreach ($aaRewards as $reward) {
            $path = 'rewards.' . $reward['index'];
            if (!isset($abilities[$reward['data_id']])) {
                $this->fail(
                    $path . '.reward_data_id',
                    'The selected AA ability does not exist or is disabled in aa_ability.'
                );
            }
            $ability = $abilities[$reward['data_id']];
            if ($reward['type'] === 7) {
                $playableMask = ((int) $ability['classes']) & 65535;
                if ($playableMask === 0 || $playableMask === 65535) {
                    $this->fail(
                        $path . '.reward_data_id',
                        'A class-ineligible fallback requires an AA ability limited to at least one, but not all, playable classes.'
                    );
                }
                continue;
            }

            $desiredRankDetails = $this->alternateAdvancementDesiredRankDetails(
                (int) $ability['first_rank_id'],
                (int) $reward['amount'],
                $rankMap
            );
            if (!$desiredRankDetails['reachable']) {
                $this->fail(
                    $path . '.amount',
                    'Desired AA rank ' . $reward['amount'] . ' is not reachable before the linked rank chain ends, repeats, or references a missing row; '
                    . $desiredRankDetails['count'] . ' rank(s) were reachable.'
                );
            }
        }
    }

    private function assertAssociationReferences($associations)
    {
        $rows = $this->fetchAll(
            'SELECT id, parent_id FROM achievement_categories FOR UPDATE'
        );
        $parents = array();
        foreach ($rows as $row) {
            $parents[(int) $row['id']] = (int) $row['parent_id'];
        }
        $seen = array();
        foreach ($associations as $index => $association) {
            $categoryId = (int) $association['category_id'];
            if (isset($seen[$categoryId])) {
                $this->fail(
                    "associations.{$index}.category_id",
                    'An achievement may be associated with a category only once.'
                );
            }
            $seen[$categoryId] = true;
            if (!array_key_exists($categoryId, $parents)) {
                $this->fail(
                    "associations.{$index}.category_id",
                    'The selected achievement category does not exist.'
                );
            }
            $this->assertValidCategoryLineage(
                $parents,
                $categoryId,
                "associations.{$index}.category_id"
            );
        }
    }

    private function assertNoDependencyCycle($achievementId, $definition)
    {
        $rows = $this->fetchAll(
            'SELECT c.achievement_id, c.target_id FROM achievement_criteria c '
            . 'JOIN achievements a ON a.id = c.achievement_id '
            . 'WHERE a.enabled = ? AND c.enabled = ? AND c.event_type = ? '
            . 'AND c.target_id > 0 AND c.achievement_id <> ? FOR UPDATE',
            array(1, 1, 11, $achievementId),
            'iiii'
        );
        $edges = array();
        foreach ($rows as $row) {
            $source = (int) $row['achievement_id'];
            if (!isset($edges[$source])) {
                $edges[$source] = array();
            }
            $edges[$source][] = (int) $row['target_id'];
        }
        foreach ($definition['components'] as $component) {
            foreach ($component['criteria'] as $criterion) {
                if ($this->flag($criterion['enabled']) === 1
                    && (int) $criterion['event_type'] === 11
                    && (int) $criterion['target_id'] > 0) {
                    if (!isset($edges[$achievementId])) {
                        $edges[$achievementId] = array();
                    }
                    $edges[$achievementId][] = (int) $criterion['target_id'];
                }
            }
        }

        $visiting = array();
        $visited = array();
        $walk = function ($node) use (&$walk, &$visiting, &$visited, $edges) {
            if (isset($visiting[$node])) {
                return true;
            }
            if (isset($visited[$node])) {
                return false;
            }
            $visiting[$node] = true;
            $targets = isset($edges[$node]) ? $edges[$node] : array();
            foreach ($targets as $target) {
                if ($walk($target)) {
                    return true;
                }
            }
            unset($visiting[$node]);
            $visited[$node] = true;
            return false;
        };
        if ($walk($achievementId)) {
            $this->fail('components', 'Enabled achievement-completion criteria would create a dependency cycle.');
        }
    }

    private function assertCategoryParent($categoryId, $parentId)
    {
        $rows = $this->fetchAll(
            'SELECT id, parent_id FROM achievement_categories FOR UPDATE'
        );
        $parents = array();
        foreach ($rows as $row) {
            $parents[(int) $row['id']] = (int) $row['parent_id'];
        }
        $parents[$categoryId] = $parentId;
        if ($parentId !== 0 && !array_key_exists($parentId, $parents)) {
            $this->fail('parent_id', 'The selected parent category does not exist.');
        }
        $this->assertValidCategoryLineage($parents, $categoryId, 'parent_id');
    }

    private function assertValidCategoryLineage($parents, $categoryId, $field)
    {
        $seen = array();
        $cursor = (int) $categoryId;
        while ($cursor !== 0) {
            if (isset($seen[$cursor])) {
                $this->fail($field, 'Achievement categories cannot contain a parent cycle.');
            }
            $seen[$cursor] = true;
            if (!array_key_exists($cursor, $parents)) {
                $this->fail($field, 'The category hierarchy contains a missing parent.');
            }
            $cursor = (int) $parents[$cursor];
        }
    }

    private function schemaSpec()
    {
        $spec = array(
            'achievement_categories' => array(
                'columns' => array('id', 'parent_id', 'sequence', 'name', 'description', 'icon'),
                'unsigned' => array('id', 'parent_id', 'sequence'),
                'auto_increment' => array(),
                'indexes' => array(array('columns' => array('id'), 'unique' => true))
            ),
            'achievements' => array(
                'columns' => array('id', 'name', 'description', 'icon_id', 'points', 'has_reward', 'client_flag', 'version', 'reset_on_version_change', 'enabled'),
                'unsigned' => array('id', 'icon_id', 'points', 'has_reward', 'client_flag', 'version', 'reset_on_version_change', 'enabled'),
                'auto_increment' => array(),
                'indexes' => array(array('columns' => array('id'), 'unique' => true))
            ),
            'achievement_category_associations' => array(
                'columns' => array('category_id', 'sequence', 'achievement_id', 'display_text'),
                'unsigned' => array('category_id', 'sequence', 'achievement_id'),
                'auto_increment' => array(),
                'indexes' => array(array('columns' => array('category_id', 'achievement_id'), 'unique' => true))
            ),
            'achievement_components' => array(
                'columns' => array('achievement_id', 'component_type', 'sequence', 'component_id', 'name', 'description'),
                'unsigned' => array('achievement_id', 'component_type', 'sequence', 'component_id'),
                'auto_increment' => array(),
                'indexes' => array(array('columns' => array('achievement_id', 'component_type', 'component_id'), 'unique' => true))
            ),
            'achievement_associations' => array(
                'columns' => array('component_id', 'required_count'),
                'unsigned' => array('component_id', 'required_count'),
                'auto_increment' => array(),
                'indexes' => array(array('columns' => array('component_id'), 'unique' => true))
            ),
            'achievement_criteria' => array(
                'columns' => array('id', 'achievement_id', 'component_type', 'component_sequence', 'component_id', 'event_type', 'progress_mode', 'behavior', 'target_id', 'target_id2', 'target_value', 'required_count', 'enabled'),
                'unsigned' => array('id', 'achievement_id', 'component_type', 'component_sequence', 'component_id', 'event_type', 'progress_mode', 'behavior', 'target_id', 'target_id2', 'required_count', 'enabled'),
                'auto_increment' => array('id'),
                'indexes' => array(
                    array('columns' => array('id'), 'unique' => true),
                    array('columns' => array('achievement_id', 'component_type', 'component_id', 'event_type', 'target_id', 'target_id2'), 'unique' => true)
                )
            ),
            'achievement_cast_requirements' => array(
                'columns' => array('restriction_id', 'achievement_id', 'requires_completed'),
                'unsigned' => array('restriction_id', 'achievement_id', 'requires_completed'),
                'auto_increment' => array(),
                'indexes' => array(array('columns' => array('restriction_id', 'achievement_id'), 'unique' => true))
            ),
            'reward_sets' => array(
                'columns' => array('reward_set_id', 'title', 'enabled'),
                'unsigned' => array('reward_set_id', 'enabled'),
                'auto_increment' => array(),
                'indexes' => array(array('columns' => array('reward_set_id'), 'unique' => true))
            ),
            'reward_options' => array(
                'columns' => array('reward_set_id', 'option_id', 'sequence', 'label', 'common_to_all', 'flags', 'enabled'),
                'unsigned' => array('reward_set_id', 'option_id', 'sequence', 'common_to_all', 'flags', 'enabled'),
                'auto_increment' => array(),
                'indexes' => array(array('columns' => array('reward_set_id', 'option_id'), 'unique' => true))
            ),
            'rewards' => array(
                'columns' => array('reward_id', 'reward_type', 'reward_data_id', 'amount', 'description', 'enabled'),
                'unsigned' => array('reward_id', 'reward_type', 'reward_data_id', 'amount', 'enabled'),
                'auto_increment' => array('reward_id'),
                'indexes' => array(array('columns' => array('reward_id'), 'unique' => true))
            ),
            'reward_option_entries' => array(
                'columns' => array('reward_set_id', 'option_id', 'sequence', 'reward_id'),
                'unsigned' => array('reward_set_id', 'option_id', 'sequence', 'reward_id'),
                'auto_increment' => array(),
                'indexes' => array(
                    array('columns' => array('reward_set_id', 'option_id', 'reward_id'), 'unique' => true),
                    array('columns' => array('reward_set_id', 'reward_id'), 'unique' => true)
                )
            ),
            'reward_sources' => array(
                'columns' => array('source_type', 'source_id', 'reward_set_id', 'enabled'),
                'unsigned' => array('source_type', 'source_id', 'reward_set_id', 'enabled'),
                'auto_increment' => array(),
                'indexes' => array(array('columns' => array('source_type', 'source_id'), 'unique' => true))
            ),
            'reward_source_entries' => array(
                'columns' => array('source_type', 'source_id', 'sequence', 'reward_id'),
                'unsigned' => array('source_type', 'source_id', 'sequence', 'reward_id'),
                'auto_increment' => array(),
                'indexes' => array(
                    array('columns' => array('source_type', 'source_id', 'reward_id'), 'unique' => true),
                    array('columns' => array('source_type', 'source_id', 'sequence'), 'unique' => true)
                )
            )
        );

        $u8 = '/^tinyint(?:\(\d+\))? unsigned$/i';
        $u32 = '/^int(?:\(\d+\))? unsigned$/i';
        $u64 = '/^bigint(?:\(\d+\))? unsigned$/i';
        $i64 = '/^bigint(?:\(\d+\))?$/i';
        $varchar255 = '/^varchar\(255\)$/i';
        $text = '/^text$/i';

        $spec['achievement_categories']['types'] = array(
            'id' => $u32, 'parent_id' => $u32, 'sequence' => $u32,
            'name' => $varchar255, 'description' => $text, 'icon' => $varchar255
        );
        $spec['achievements']['types'] = array(
            'id' => $u32, 'name' => $varchar255, 'description' => $text,
            'icon_id' => $u32, 'points' => $u32, 'has_reward' => $u8,
            'client_flag' => $u8, 'version' => $u32,
            'reset_on_version_change' => $u8, 'enabled' => $u8
        );
        $spec['achievement_category_associations']['types'] = array(
            'category_id' => $u32, 'sequence' => $u32,
            'achievement_id' => $u32, 'display_text' => $varchar255
        );
        $spec['achievement_components']['types'] = array(
            'achievement_id' => $u32, 'component_type' => $u8,
            'sequence' => $u32, 'component_id' => $u32,
            'name' => $text, 'description' => $text
        );
        $spec['achievement_associations']['types'] = array(
            'component_id' => $u32, 'required_count' => $u32
        );
        $spec['achievement_criteria']['types'] = array(
            'id' => $u64, 'achievement_id' => $u32, 'component_type' => $u8,
            'component_sequence' => $u32, 'component_id' => $u32,
            'event_type' => $u8, 'progress_mode' => $u8, 'behavior' => $u8,
            'target_id' => $u32, 'target_id2' => $u32, 'target_value' => $i64,
            'required_count' => $u32, 'enabled' => $u8
        );
        $spec['achievement_cast_requirements']['types'] = array(
            'restriction_id' => $u32, 'achievement_id' => $u32,
            'requires_completed' => $u8
        );
        $spec['reward_sets']['types'] = array(
            'reward_set_id' => $u32, 'title' => $varchar255, 'enabled' => $u8
        );
        $spec['reward_options']['types'] = array(
            'reward_set_id' => $u32, 'option_id' => $u32, 'sequence' => $u32,
            'label' => $varchar255, 'common_to_all' => $u8,
            'flags' => $u8, 'enabled' => $u8
        );
        $spec['reward_option_entries']['types'] = array(
            'reward_set_id' => $u32, 'option_id' => $u32, 'sequence' => $u32, 'reward_id' => $u32
        );
        $spec['rewards']['types'] = array(
            'reward_id' => $u32, 'reward_type' => $u8, 'reward_data_id' => $u32,
            'amount' => $u64, 'description' => $varchar255, 'enabled' => $u8
        );
        $spec['reward_sources']['types'] = array(
            'source_type' => $u8, 'source_id' => $u64,
            'reward_set_id' => $u32, 'enabled' => $u8
        );
        $spec['reward_source_entries']['types'] = array(
            'source_type' => $u8, 'source_id' => $u64,
            'sequence' => $u32, 'reward_id' => $u32
        );

        foreach ($spec as &$requirements) {
            $requirements['not_null'] = $requirements['columns'];
            if (!isset($requirements['types'])) {
                $requirements['types'] = array();
            }
        }
        unset($requirements);

        return $spec;
    }

    private function hasMatchingIndex($indexes, $columns, $mustBeUnique)
    {
        foreach ($indexes as $index) {
            if (!empty($index['has_prefix'])) {
                continue;
            }
            if ($mustBeUnique && !$index['unique']) {
                continue;
            }
            if ($index['columns'] === $columns) {
                return true;
            }
        }
        return false;
    }

    private function transaction($operation, $callback)
    {
        $previousOperation = $this->operation;
        $this->operation = (string) $operation;
        if (!$this->db->begin_transaction()) {
            $this->operation = $previousOperation;
            throw $this->databaseFailure(
                $this->db->errno,
                $this->db->error,
                'The achievement transaction could not be started.'
            );
        }

        try {
            $result = call_user_func($callback);
            if (!$this->db->commit()) {
                throw $this->databaseFailure(
                    $this->db->errno,
                    $this->db->error,
                    'The achievement transaction could not be committed.'
                );
            }
            $this->operation = $previousOperation;
            return $result;
        } catch (AchievementRepositoryException $exception) {
            $this->db->rollback();
            $this->operation = $previousOperation;
            throw $exception;
        } catch (Throwable $exception) {
            $this->db->rollback();
            $this->operation = $previousOperation;
            throw new AchievementRepositoryException(
                'The achievement change could not be completed and was rolled back safely.',
                'database',
                array('operation' => $operation),
                $exception
            );
        }
    }

    private function fetchAll($sql, $params = array(), $types = '')
    {
        return $this->fetchAllFrom($this->db, $sql, $params, $types);
    }

    private function fetchAllFrom($database, $sql, $params = array(), $types = '')
    {
        $stmt = $this->preparedStatementFrom($database, $sql, $params, $types);
        $metadata = $stmt->result_metadata();
        if (!$metadata) {
            $error = $this->databaseFailure(
                $stmt->errno,
                $stmt->error,
                'The achievement database did not return the expected result set.'
            );
            $stmt->close();
            throw $error;
        }

        $fields = $metadata->fetch_fields();
        $metadata->free();
        $values = array_fill(0, count($fields), null);
        $bindings = array();
        foreach ($values as $index => $unused) {
            $bindings[$index] =& $values[$index];
        }
        if (!call_user_func_array(array($stmt, 'bind_result'), $bindings)) {
            $error = $this->databaseFailure(
                $stmt->errno,
                $stmt->error,
                'The achievement result columns could not be read.'
            );
            $stmt->close();
            throw $error;
        }

        $rows = array();
        while ($stmt->fetch()) {
            $row = array();
            foreach ($fields as $index => $field) {
                $row[$field->name] = $values[$index];
            }
            $rows[] = $row;
        }
        if ($stmt->errno) {
            $error = $this->databaseFailure(
                $stmt->errno,
                $stmt->error,
                'The achievement result set could not be read completely.'
            );
            $stmt->close();
            throw $error;
        }
        $stmt->close();
        return $rows;
    }

    private function fetchOne($sql, $params = array(), $types = '')
    {
        $rows = $this->fetchAll($sql, $params, $types);
        return count($rows) > 0 ? $rows[0] : null;
    }

    private function fetchOneFrom($database, $sql, $params = array(), $types = '')
    {
        $rows = $this->fetchAllFrom($database, $sql, $params, $types);
        return count($rows) > 0 ? $rows[0] : null;
    }

    private function scalar($sql, $params = array(), $types = '')
    {
        $row = $this->fetchOne($sql, $params, $types);
        if (!$row) {
            return null;
        }
        foreach ($row as $value) {
            return $value;
        }
        return null;
    }

    private function execute($sql, $params = array(), $types = '')
    {
        $stmt = $this->preparedStatement($sql, $params, $types);
        $affected = $stmt->affected_rows;
        $stmt->close();
        return $affected;
    }

    private function executeInsert($sql, $params = array(), $types = '')
    {
        $stmt = $this->preparedStatement($sql, $params, $types);
        $insertId = mysqli_stmt_insert_id($stmt);
        $stmt->close();
        return $insertId;
    }

    private function preparedStatement($sql, $params, $types)
    {
        return $this->preparedStatementFrom($this->db, $sql, $params, $types);
    }

    private function preparedStatementFrom($database, $sql, $params, $types)
    {
        if (!is_array($params)) {
            throw new AchievementRepositoryException('Database parameters must be supplied as a list.', 'database');
        }
        if (count($params) !== strlen((string) $types)) {
            throw new AchievementRepositoryException(
                'The achievement database request has an internal parameter mismatch.',
                'database',
                array('operation' => $this->operation)
            );
        }

        try {
            $stmt = $database->prepare($sql);
        } catch (Throwable $exception) {
            throw $this->databaseFailure(
                $exception->getCode(),
                $exception->getMessage(),
                'The achievement database request could not be prepared.',
                $exception
            );
        }
        if (!$stmt) {
            throw $this->databaseFailure(
                $database->errno,
                $database->error,
                'The achievement database request could not be prepared.'
            );
        }

        if (count($params) > 0) {
            $bind = array((string) $types);
            foreach ($params as $index => $value) {
                $params[$index] = $value;
                $bind[] =& $params[$index];
            }
            if (!call_user_func_array(array($stmt, 'bind_param'), $bind)) {
                $error = $this->databaseFailure(
                    $stmt->errno,
                    $stmt->error,
                    'The achievement database parameters could not be bound.'
                );
                $stmt->close();
                throw $error;
            }
        }

        try {
            $executed = $stmt->execute();
        } catch (Throwable $exception) {
            $errno = $stmt->errno;
            $errorText = $stmt->error;
            $stmt->close();
            throw $this->databaseFailure(
                $errno,
                $errorText,
                'The achievement database request was rejected.',
                $exception
            );
        }
        if (!$executed) {
            $error = $this->databaseFailure(
                $stmt->errno,
                $stmt->error,
                'The achievement database request was rejected.'
            );
            $stmt->close();
            throw $error;
        }
        return $stmt;
    }

    private function databaseFailure($errno, $databaseError, $fallbackMessage, $previous = null)
    {
        $errno = (int) $errno;
        if ($errno === 1062) {
            $message = 'A stable achievement ID, sequence, or mapping is already in use.';
        } elseif ($errno === 1146 || $errno === 1054) {
            $message = 'The source achievement schema is missing or out of date.';
            $this->schemaDiagnosticsCache = null;
        } elseif ($errno === 1451 || $errno === 1452) {
            $message = 'The achievement change conflicts with content that still references this record.';
        } elseif ($errno === 1205 || $errno === 1213) {
            $message = 'The achievement content was busy. No partial change was saved; please try again.';
        } else {
            $message = (string) $fallbackMessage;
        }
        return new AchievementRepositoryException(
            $message,
            'database',
            array(
                'operation' => $this->operation,
                'database_errno' => $errno,
                'database_error' => (string) $databaseError
            ),
            $previous
        );
    }

    private function suggestedId($table, $column)
    {
        $identifier = $this->allowedIdentity($table, $column);
        $row = $this->fetchOne(
            'SELECT ' . $identifier['column'] . ' AS current_id FROM '
            . $identifier['table'] . ' ORDER BY ' . $identifier['column'] . ' DESC LIMIT 1'
        );
        $current = $row ? (string) $row['current_id'] : '0';
        if ($this->compareDecimal($current, (string) self::UINT32_MAX) >= 0) {
            return self::UINT32_MAX;
        }
        return (int) $current + 1;
    }

    private function suggestedAchievementId($forUpdate)
    {
        $sql = 'SELECT id AS current_id FROM achievements ORDER BY id DESC LIMIT 1';
        if ($forUpdate) {
            $sql .= ' FOR UPDATE';
        }
        $row = $this->fetchOne($sql);
        $current = $row ? (string) $row['current_id'] : '0';
        while ($this->compareDecimal($current, (string) self::UINT32_MAX) < 0) {
            $candidate = (int) $current + 1;
            if (!$this->achievementIdHasDurableState($candidate, true)) {
                return $candidate;
            }
            $current = (string) $candidate;
        }
        $this->fail('id', 'No unsigned 32-bit achievement IDs remain after durable character history is reserved.');
    }

    private function assertAchievementIdHasNoDurableState($achievementId)
    {
        if ($this->achievementIdHasDurableState($achievementId, true)) {
            $this->fail(
                'id',
                'Achievement ID ' . $achievementId . ' has preserved character completion, progress, reward, selection, or pending-update history. Choose a fresh ID; deleted definition identities cannot be reused.'
            );
        }
    }

    private function achievementIdHasDurableState($achievementId, $requireConnection)
    {
        if ($this->characterDb === null) {
            if ($requireConnection) {
                throw new AchievementRepositoryException(
                    'The character achievement state schema could not be checked. Configure the character database and install the current achievement state SQL before creating or cloning definitions.',
                    'schema',
                    array('character_schema_ready' => false)
                );
            }
            return false;
        }
        try {
            // A single prepared UNION both reserves every durable state table
            // from ID reuse and probes the exact final table/column vocabulary.
            // Legacy/missing state schemas therefore fail before a content row
            // can be inserted, while version zero remains an ordinary value.
            $row = $this->fetchOneFrom(
                $this->characterDb,
                'SELECT 1 AS present FROM character_achievements WHERE achievement_id = ? '
                . 'UNION ALL SELECT 1 AS present FROM character_achievement_progress WHERE achievement_id = ? '
                . 'UNION ALL SELECT 1 AS present FROM character_achievement_rewards WHERE achievement_id = ? '
                . 'UNION ALL SELECT 1 AS present FROM character_achievement_reward_selections WHERE achievement_id = ? '
                . 'UNION ALL SELECT 1 AS present FROM character_achievement_pending_updates WHERE achievement_id = ? '
                . 'LIMIT 1',
                array($achievementId, $achievementId, $achievementId, $achievementId, $achievementId),
                'iiiii'
            );
        } catch (AchievementRepositoryException $exception) {
            $details = $exception->getDetails();
            $errno = isset($details['database_errno']) ? (int) $details['database_errno'] : 0;
            if ($errno === 1146 || $errno === 1054) {
                throw new AchievementRepositoryException(
                    'The character achievement state schema is missing or out of date. Install the current achievement state SQL before creating or cloning definitions.',
                    'schema',
                    array(
                        'character_schema_ready' => false,
                        'database_errno' => $errno,
                        'database_error' => isset($details['database_error'])
                            ? (string) $details['database_error'] : ''
                    ),
                    $exception
                );
            }
            throw $exception;
        }
        return (bool) $row;
    }

    private function allocateId($table, $column, $field)
    {
        $identifier = $this->allowedIdentity($table, $column);
        $row = $this->fetchOne(
            'SELECT ' . $identifier['column'] . ' AS current_id FROM '
            . $identifier['table'] . ' ORDER BY ' . $identifier['column'] . ' DESC LIMIT 1 FOR UPDATE'
        );
        $current = $row ? (string) $row['current_id'] : '0';
        if ($this->compareDecimal($current, (string) self::UINT32_MAX) >= 0) {
            $this->fail($field, "No unsigned 32-bit IDs remain in {$table}.{$column}.");
        }
        return (int) $current + 1;
    }

    private function allowedIdentity($table, $column)
    {
        $allowed = array(
            'achievements.id' => array('table' => 'achievements', 'column' => 'id'),
            'achievement_categories.id' => array('table' => 'achievement_categories', 'column' => 'id'),
            'achievement_associations.component_id' => array(
                'table' => 'achievement_associations',
                'column' => 'component_id'
            ),
            'reward_sets.reward_set_id' => array(
                'table' => 'reward_sets',
                'column' => 'reward_set_id'
            )
        );
        $key = $table . '.' . $column;
        if (!isset($allowed[$key])) {
            throw new AchievementRepositoryException('Unsupported achievement identity source.', 'database');
        }
        return $allowed[$key];
    }

    private function deleteWhereIn($table, $column, $values)
    {
        if (!is_array($values) || count($values) === 0) {
            return 0;
        }
        $allowed = array(
            'reward_option_entries.reward_id' => 's',
            'reward_option_entries.reward_set_id' => 'i',
            'reward_options.reward_set_id' => 'i'
        );
        $key = $table . '.' . $column;
        if (!isset($allowed[$key])) {
            throw new AchievementRepositoryException('Unsupported achievement cleanup request.', 'database');
        }
        return $this->execute(
            'DELETE FROM ' . $table . ' WHERE ' . $column . ' IN ('
            . $this->placeholders(count($values)) . ')',
            array_values($values),
            str_repeat($allowed[$key], count($values))
        );
    }

    private function placeholders($count)
    {
        $count = (int) $count;
        if ($count < 1) {
            throw new AchievementRepositoryException('A database value list cannot be empty.', 'database');
        }
        return implode(', ', array_fill(0, $count, '?'));
    }

    private function columnValues($rows, $column)
    {
        $values = array();
        foreach ($rows as $row) {
            if (array_key_exists($column, $row)) {
                $values[] = $row[$column];
            }
        }
        return $values;
    }

    private function castDefinitionRow(&$row)
    {
        foreach (array(
            'id', 'icon_id', 'points', 'has_reward', 'client_flag',
            'version', 'reset_on_version_change', 'enabled'
        ) as $column) {
            if (array_key_exists($column, $row)) {
                $row[$column] = (int) $row[$column];
            }
        }
        foreach (array('name', 'description') as $column) {
            if (array_key_exists($column, $row)) {
                $row[$column] = (string) $row[$column];
            }
        }
    }

    private function hasFilterValue($filters, $key)
    {
        return isset($filters[$key]) && $filters[$key] !== '' && $filters[$key] !== null;
    }

    private function componentKey($componentType, $componentId)
    {
        return (int) $componentType . ':' . (int) $componentId;
    }

    private function assertRetainedIdentities(
        $existingIdentities,
        $submittedIdentities,
        $field,
        $identityLabel,
        $retirementInstruction
    ) {
        foreach ($existingIdentities as $identity => $unused) {
            if (isset($submittedIdentities[$identity])) {
                continue;
            }
            $this->fail(
                $field,
                $identityLabel . ' ' . (string) $identity
                . ' cannot be removed or reassigned because durable character state may reference it. '
                . $retirementInstruction
            );
        }
    }

    private function flag($value)
    {
        if ($value === true || $value === 1 || $value === '1' || $value === 'on') {
            return 1;
        }
        if ($value === false || $value === 0 || $value === '0' || $value === null || $value === '') {
            return 0;
        }
        $this->fail('boolean', 'A yes/no achievement value was invalid.');
    }

    private function unsigned32($value, $field, $allowZero)
    {
        $decimal = $this->unsigned32Decimal($value, $field, $allowZero);
        return (int) $decimal;
    }

    private function unsigned32Decimal($value, $field, $allowZero)
    {
        $decimal = trim((string) $value);
        if ($decimal === '' || !ctype_digit($decimal)) {
            $this->fail($field, 'This value must be a whole unsigned number.');
        }
        $decimal = ltrim($decimal, '0');
        if ($decimal === '') {
            $decimal = '0';
        }
        if (!$allowZero && $decimal === '0') {
            $this->fail($field, 'This value must be greater than zero.');
        }
        if ($this->compareDecimal($decimal, (string) self::UINT32_MAX) > 0) {
            $this->fail($field, 'This value must fit the unsigned 32-bit RoF2 field.');
        }
        return $decimal;
    }

    private function nonNegativeDecimal($value, $field, $maximum = '9223372036854775807')
    {
        $decimal = trim((string) $value);
        if ($decimal === '' || !ctype_digit($decimal)) {
            $this->fail($field, 'This value must be a non-negative whole number.');
        }
        $decimal = ltrim($decimal, '0');
        if ($decimal === '') {
            $decimal = '0';
        }
        if ($this->compareDecimal($decimal, $maximum) > 0) {
            $this->fail($field, 'This value is larger than the database field can store safely.');
        }
        return $decimal;
    }

    private function compareDecimal($left, $right)
    {
        $left = ltrim((string) $left, '0');
        $right = ltrim((string) $right, '0');
        $left = $left === '' ? '0' : $left;
        $right = $right === '' ? '0' : $right;
        if (strlen($left) !== strlen($right)) {
            return strlen($left) < strlen($right) ? -1 : 1;
        }
        return strcmp($left, $right);
    }

    private function characterLength($value)
    {
        return function_exists('mb_strlen') ? mb_strlen($value, 'UTF-8') : strlen($value);
    }

    private function truncate($value, $length)
    {
        if (function_exists('mb_substr')) {
            return mb_substr($value, 0, $length, 'UTF-8');
        }
        return substr($value, 0, $length);
    }

    private function fail($field, $message, $details = array())
    {
        throw new AchievementRepositoryException($message, $field, $details);
    }

    private function notFound($recordType, $id)
    {
        throw new AchievementRepositoryException(
            "{$recordType} {$id} was not found.",
            'id',
            array('id' => $id, 'record_type' => $recordType)
        );
    }
}

?>
