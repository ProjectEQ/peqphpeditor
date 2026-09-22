<?php

require_once(dirname(__DIR__) . '/classes/achievement_repository.php');

$assertions = 0;
function aa_reward_assert($condition, $message)
{
    global $assertions;
    ++$assertions;
    if (!$condition) {
        fwrite(STDERR, 'FAIL: ' . $message . PHP_EOL);
        exit(1);
    }
}

class AaRewardFakeMetadata
{
    private $fields;
    public function __construct($fields) { $this->fields = $fields; }
    public function fetch_fields()
    {
        $result = array();
        foreach ($this->fields as $name) {
            $result[] = (object) array('name' => $name);
        }
        return $result;
    }
    public function free() {}
}

class AaRewardFakeStatement
{
    public $errno = 0;
    public $error = '';
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
        $values = array();
        foreach ($this->parameters as $parameter) {
            $values[] = $parameter;
        }
        $result = $this->database->result($this->sql, $values);
        $this->fields = $result['fields'];
        $this->rows = $result['rows'];
        return true;
    }

    public function result_metadata() { return new AaRewardFakeMetadata($this->fields); }
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
        foreach ($this->fields as $index => $field) {
            $this->bindings[$index] = isset($row[$field]) ? $row[$field] : null;
        }
        return true;
    }
    public function close() { return true; }
}

class AaRewardFakeDatabase
{
    public $errno = 0;
    public $error = '';
    public $queries = array();
    public $executions = array();
    private $abilities;
    private $ranks;

    public function __construct()
    {
        $this->abilities = array(
            30300 => array('id' => 30300, 'name' => 'Class Blade', 'classes' => 5, 'first_rank_id' => 500, 'enabled' => 1),
            30301 => array('id' => 30301, 'name' => 'All Class Gift', 'classes' => 65535, 'first_rank_id' => 600, 'enabled' => 1),
            30302 => array('id' => 30302, 'name' => 'Disabled Ability', 'classes' => 1, 'first_rank_id' => 610, 'enabled' => 0),
            30303 => array('id' => 30303, 'name' => 'Cyclic Ability', 'classes' => 1, 'first_rank_id' => 700, 'enabled' => 1),
            30304 => array('id' => 30304, 'name' => 'Missing Tail Ability', 'classes' => 1, 'first_rank_id' => 800, 'enabled' => 1),
        );
        $this->ranks = array(500 => 501, 501 => 502, 502 => -1, 600 => -1, 610 => -1, 700 => 701, 701 => 700, 800 => 801);
    }

    public function prepare($sql)
    {
        $this->queries[] = $sql;
        return new AaRewardFakeStatement($this, $sql);
    }

    public function result($sql, $parameters)
    {
        $this->executions[] = array('sql' => $sql, 'parameters' => $parameters);
        if (stripos($sql, 'SELECT id, next_id FROM aa_ranks') !== false) {
            $rows = array();
            $limit = isset($parameters[0]) ? (int) $parameters[0] : count($this->ranks);
            foreach ($this->ranks as $id => $nextId) {
                if (count($rows) >= $limit) {
                    break;
                }
                $rows[] = array('id' => $id, 'next_id' => $nextId);
            }
            return array('fields' => array('id', 'next_id'), 'rows' => $rows);
        }

        $lookup = stripos($sql, 'AS lookup_id') !== false;
        $exact = stripos($sql, 'id IN') !== false;
        $enabledOnly = stripos($sql, 'enabled = 1') !== false;
        $ids = array();
        if ($exact) {
            foreach ($parameters as $parameter) {
                $value = (int) $parameter;
                if (isset($this->abilities[$value])) {
                    $ids[$value] = true;
                }
            }
        }
        $rows = array();
        foreach ($this->abilities as $id => $ability) {
            if ($enabledOnly && (int) $ability['enabled'] !== 1) {
                continue;
            }
            if ($exact && !isset($ids[$id])) {
                continue;
            }
            if ($lookup) {
                $rows[] = array(
                    'lookup_id' => $id,
                    'lookup_name' => $ability['name'],
                    'classes' => $ability['classes'],
                    'first_rank_id' => $ability['first_rank_id'],
                    'enabled' => $ability['enabled'],
                );
            } else {
                $rows[] = $ability;
            }
        }
        return array(
            'fields' => $lookup
                ? array('lookup_id', 'lookup_name', 'classes', 'first_rank_id', 'enabled')
                : array('id', 'name', 'classes', 'first_rank_id'),
            'rows' => $rows,
        );
    }
}

function aa_reward_repository($database)
{
    $reflection = new ReflectionClass('AchievementRepository');
    $repository = $reflection->newInstanceWithoutConstructor();
    $db = $reflection->getProperty('db');
    $db->setAccessible(true);
    $db->setValue($repository, $database);
    $schema = $reflection->getProperty('schemaDiagnosticsCache');
    $schema->setAccessible(true);
    $schema->setValue($repository, array('ready' => true));
    return $repository;
}

function aa_reward_definition($rewards, $enabled = 1)
{
    return array('enabled' => $enabled, 'reward_set' => null, 'rewards' => $rewards);
}

function aa_reward_row($type, $dataId, $amount, $sequence)
{
    return array(
        'reward_id' => null, 'sequence' => $sequence, 'reward_type' => $type,
        'reward_data_id' => $dataId, 'amount' => $amount,
        'description' => '', 'enabled' => 1, 'option_id' => null,
    );
}

function aa_reward_reference_error($validator, $repository, $definition)
{
    try {
        $validator->invoke($repository, $definition);
    } catch (AchievementRepositoryException $exception) {
        return $exception;
    }
    return null;
}

$database = new AaRewardFakeDatabase();
$repository = aa_reward_repository($database);
aa_reward_assert(isset($repository->lookupTypes()['aa-ability']), 'AA abilities are advertised as a lookup type');
aa_reward_assert(AchievementRepository::AA_RANK_CHAIN_LIMIT === 10000, 'in-memory AA traversal has the required 10,000-hop safety bound');
aa_reward_assert(AchievementRepository::AA_RANK_CATALOG_LIMIT === 100000, 'AA catalog read has the required 100,000-row safety bound');

$search = $repository->lookup('aa-ability', 'Ability', array(), 20);
aa_reward_assert(count($search) === 4, 'interactive AA search returns only enabled abilities');
aa_reward_assert($search[0]['rank_count'] === 3, 'AA lookup exposes the reachable cumulative rank count');
aa_reward_assert($search[0]['eligible_classes'] === array(1, 3), 'AA lookup decodes the raw playable-class bit mask');
aa_reward_assert($search[2]['rank_chain_valid'] === false, 'AA lookup identifies a cyclic rank chain');
aa_reward_assert($search[3]['rank_chain_valid'] === false, 'AA lookup identifies a missing linked rank row');
aa_reward_assert(
    count(array_filter($database->queries, function ($sql) {
        return stripos($sql, 'SELECT id, next_id FROM aa_ranks ORDER BY id LIMIT ?') !== false;
    })) === 1,
    'AA lookup loads the bounded rank catalog in one query'
);
$rankExecutions = array_values(array_filter($database->executions, function ($execution) {
    return stripos($execution['sql'], 'SELECT id, next_id FROM aa_ranks ORDER BY id LIMIT ?') !== false;
}));
aa_reward_assert(isset($rankExecutions[0]['parameters'][0])
    && (int) $rankExecutions[0]['parameters'][0] === 100001,
    'bounded AA catalog query requests one sentinel row beyond the 100,000-row limit');

$disabled = $repository->lookup('aa-ability', '', array(30302), 20);
aa_reward_assert(count($disabled) === 1 && $disabled[0]['enabled'] === 0, 'exact-ID hydration keeps disabled AA rows visible for repair');

$reflection = new ReflectionClass('AchievementRepository');
$rankDetails = $reflection->getMethod('alternateAdvancementRankDetails');
$rankDetails->setAccessible(true);
$dangling = $rankDetails->invoke($repository, 800, array(800 => 801));
aa_reward_assert($dangling['valid'] === false, 'a missing linked rank fails closed after the bounded catalog load');
$validator = $reflection->getMethod('assertAlternateAdvancementRewardReferences');
$validator->setAccessible(true);
$valid = aa_reward_definition(array(
    aa_reward_row(6, 30300, 3, 1),
    aa_reward_row(7, 30300, 5, 2),
));
aa_reward_assert(aa_reward_reference_error($validator, $repository, $valid) === null, 'reachable rank and class-limited fallback references validate');

$missingRank = aa_reward_definition(array(aa_reward_row(6, 30300, 4, 1)));
$error = aa_reward_reference_error($validator, $repository, $missingRank);
aa_reward_assert($error instanceof AchievementRepositoryException && $error->getField() === 'rewards.0.amount', 'desired rank beyond the linked chain is rejected on Amount');

$missingAbility = aa_reward_definition(array(aa_reward_row(6, 39999, 1, 1)));
$error = aa_reward_reference_error($validator, $repository, $missingAbility);
aa_reward_assert($error instanceof AchievementRepositoryException && $error->getField() === 'rewards.0.reward_data_id', 'missing AA ability is rejected on Referenced data');

$disabledAbility = aa_reward_definition(array(aa_reward_row(6, 30302, 1, 1)));
$error = aa_reward_reference_error($validator, $repository, $disabledAbility);
aa_reward_assert($error instanceof AchievementRepositoryException && stripos($error->getMessage(), 'disabled') !== false, 'disabled AA ability cannot be published');

$allClassFallback = aa_reward_definition(array(
    aa_reward_row(6, 30301, 1, 1),
    aa_reward_row(7, 30301, 5, 2),
));
$error = aa_reward_reference_error($validator, $repository, $allClassFallback);
aa_reward_assert($error instanceof AchievementRepositoryException && $error->getField() === 'rewards.1.reward_data_id', 'fallback requires a genuinely class-limited ability');

$cyclicReachable = aa_reward_definition(array(aa_reward_row(6, 30303, 2, 1)));
aa_reward_assert(aa_reward_reference_error($validator, $repository, $cyclicReachable) === null, 'requested rank succeeds before a cyclic tail is revisited');

$cyclic = aa_reward_definition(array(aa_reward_row(6, 30303, 3, 1)));
$error = aa_reward_reference_error($validator, $repository, $cyclic);
aa_reward_assert($error instanceof AchievementRepositoryException && $error->getField() === 'rewards.0.amount', 'requested rank beyond a cyclic tail fails closed on Amount');

$missingTailReachable = aa_reward_definition(array(aa_reward_row(6, 30304, 1, 1)));
aa_reward_assert(aa_reward_reference_error($validator, $repository, $missingTailReachable) === null, 'requested rank succeeds before a missing linked rank row');

$missingTail = aa_reward_definition(array(aa_reward_row(6, 30304, 2, 1)));
$error = aa_reward_reference_error($validator, $repository, $missingTail);
aa_reward_assert($error instanceof AchievementRepositoryException && $error->getField() === 'rewards.0.amount', 'requested rank beyond a missing linked row fails closed on Amount');

$excessiveRank = aa_reward_definition(array(aa_reward_row(6, 30300, 10001, 1)));
$error = aa_reward_reference_error($validator, $repository, $excessiveRank);
aa_reward_assert($error instanceof AchievementRepositoryException && $error->getField() === 'rewards.0.amount'
    && stripos($error->getMessage(), '10,000') !== false, 'desired rank above the in-memory hop limit receives a clear Amount error');

$staged = aa_reward_definition(array(aa_reward_row(6, 39999, 99, 1)), 0);
aa_reward_assert(aa_reward_reference_error($validator, $repository, $staged) === null, 'disabled definitions may retain unresolved AA references as inert drafts');
aa_reward_assert(
    count(array_filter($database->queries, function ($sql) {
        return stripos($sql, 'SELECT id, next_id FROM aa_ranks ORDER BY id LIMIT ?') !== false;
    })) === 1,
    'AA rank catalog is shared across lookup hydration and save validation in one request'
);

echo 'achievement_aa_reward_test: passed (' . $assertions . ' assertions)' . PHP_EOL;

?>
