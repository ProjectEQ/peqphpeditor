<?php

require_once(dirname(__DIR__) . '/classes/achievement_repository.php');

$assertions = 0;
function identity_retention_assert($condition, $message)
{
    global $assertions;
    $assertions++;
    if (!$condition) {
        fwrite(STDERR, 'FAIL: ' . $message . PHP_EOL);
        exit(1);
    }
}

function identity_retention_reward_error($validator, $repository, $rewards, $rewardSet, $definitionEnabled)
{
    try {
        $validator->invoke($repository, $rewards, $rewardSet, $definitionEnabled);
    } catch (AchievementRepositoryException $exception) {
        return $exception;
    }
    return null;
}

class IdentityRetentionMetadata
{
    private $fields;
    public function __construct($fields) { $this->fields = $fields; }
    public function fetch_fields()
    {
        $result = array();
        foreach ($this->fields as $name) {
            $field = new stdClass();
            $field->name = $name;
            $result[] = $field;
        }
        return $result;
    }
    public function free() {}
}

class IdentityRetentionStatement
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
    public function __construct($database, $sql) { $this->database = $database; $this->sql = $sql; }
    public function bind_param($types, &...$parameters)
    {
        foreach ($parameters as $index => &$parameter) { $this->parameters[$index] =& $parameter; }
        return true;
    }
    public function execute()
    {
        $values = array();
        foreach ($this->parameters as $parameter) { $values[] = $parameter; }
        $result = $this->database->result($this->sql, $values);
        $this->fields = $result['fields'];
        $this->rows = $result['rows'];
        return true;
    }
    public function result_metadata() { return new IdentityRetentionMetadata($this->fields); }
    public function bind_result(&...$bindings)
    {
        foreach ($bindings as $index => &$binding) { $this->bindings[$index] =& $binding; }
        return true;
    }
    public function fetch()
    {
        if (!isset($this->rows[$this->cursor])) { return false; }
        $row = $this->rows[$this->cursor++];
        foreach ($this->fields as $index => $field) {
            $this->bindings[$index] = isset($row[$field]) ? $row[$field] : null;
        }
        return true;
    }
    public function close() { return true; }
}

class IdentityRetentionDatabase
{
    public $errno = 0;
    public $error = '';
    public $currentContentId = 0;
    public $reservedIds = array();
    public $prepareError = 0;
    public $queries = array();
    public function prepare($sql)
    {
        if ($this->prepareError > 0 && stripos($sql, 'character_achievements') !== false) {
            $this->errno = $this->prepareError;
            $this->error = 'simulated legacy character achievement schema';
            return false;
        }
        return new IdentityRetentionStatement($this, $sql);
    }
    public function result($sql, $parameters)
    {
        $this->queries[] = $sql;
        if (stripos($sql, 'FROM achievements ORDER BY id DESC') !== false) {
            return array(
                'fields' => array('current_id'),
                'rows' => $this->currentContentId > 0
                    ? array(array('current_id' => $this->currentContentId)) : array()
            );
        }
        $id = isset($parameters[0]) ? (int) $parameters[0] : 0;
        return array(
            'fields' => array('present'),
            'rows' => in_array($id, $this->reservedIds, true)
                ? array(array('present' => 1)) : array()
        );
    }
}

$reflection = new ReflectionClass('AchievementRepository');
$repository = $reflection->newInstanceWithoutConstructor();
$guard = $reflection->getMethod('assertRetainedIdentities');
$guard->setAccessible(true);
$fingerprint = $reflection->getMethod('runtimePolicyFingerprint');
$fingerprint->setAccessible(true);
$versionGuard = $reflection->getMethod('assertVersionBumpedForPolicyChange');
$versionGuard->setAccessible(true);
$rewardWriteValidator = $reflection->getMethod('validateRewardsForWrite');
$rewardWriteValidator->setAccessible(true);
$durableState = $reflection->getMethod('achievementIdHasDurableState');
$durableState->setAccessible(true);
$suggestAchievementId = $reflection->getMethod('suggestedAchievementId');
$suggestAchievementId->setAccessible(true);
$contentDatabaseProperty = $reflection->getProperty('db');
$contentDatabaseProperty->setAccessible(true);
$characterDatabaseProperty = $reflection->getProperty('characterDb');
$characterDatabaseProperty->setAccessible(true);

$guard->invoke(
    $repository,
    array('1:152250' => true, '1:153350' => true),
    array('1:152250' => true, '1:153350' => true, '1:154450' => true),
    'components',
    'Persisted component',
    'Disable all of its criteria to retire it safely.'
);
identity_retention_assert(true, 'retaining every persisted identity and adding a new identity is accepted');

try {
    $guard->invoke(
        $repository,
        array('1:152250' => true),
        array(),
        'components',
        'Persisted component',
        'Disable all of its criteria to retire it safely.'
    );
    identity_retention_assert(false, 'omitting a persisted component must fail');
} catch (ReflectionException $exception) {
    identity_retention_assert(false, 'reflection invocation failed unexpectedly');
} catch (AchievementRepositoryException $exception) {
    identity_retention_assert($exception->getField() === 'components', 'component omission identifies the graph section');
    identity_retention_assert(strpos($exception->getMessage(), '1:152250') !== false, 'component omission identifies the durable key');
    identity_retention_assert(strpos($exception->getMessage(), 'retire it safely') !== false, 'component omission explains the safe alternative');
}

try {
    $guard->invoke(
        $repository,
        array('9900601' => true),
        array(),
        'rewards',
        'Persisted grant',
        'Set its Enabled field to 0 to retire it safely.'
    );
    identity_retention_assert(false, 'omitting a persisted grant must fail');
} catch (AchievementRepositoryException $exception) {
    identity_retention_assert($exception->getField() === 'rewards', 'grant omission identifies the graph section');
    identity_retention_assert(strpos($exception->getMessage(), '9900601') !== false, 'grant omission identifies the durable reward ID');
}

$rewardBoundaryCases = array(
    array(0, '1001', '32767', 'item'),
    array(1, '1', '4294967295', 'experience'),
    array(2, '0', '2147483647', 'AA'),
    array(3, '0', '2147483647999', 'copper'),
    array(4, '7', '2147483647', 'alternate currency'),
    array(5, '2147483647', '1', 'title'),
    array(6, '30300', '2147483647', 'specific AA ability'),
);
foreach ($rewardBoundaryCases as $boundary) {
    $reward = array(
        'reward_id' => null,
        'sequence' => 1,
        'reward_type' => $boundary[0],
        'reward_data_id' => $boundary[1],
        'amount' => $boundary[2],
        'description' => 'Runtime boundary grant',
        'enabled' => 1,
        'option_id' => null,
    );
    identity_retention_assert(
        identity_retention_reward_error($rewardWriteValidator, $repository, array($reward), null, true) === null,
        'repository accepts the exact ' . $boundary[3] . ' runtime delivery boundary'
    );
}

$pairedAaRewards = array(
    array(
        'reward_id' => null, 'sequence' => 1, 'reward_type' => 6,
        'reward_data_id' => '30300', 'amount' => '3',
        'description' => 'Desired AA rank', 'enabled' => 1, 'option_id' => null,
    ),
    array(
        'reward_id' => null, 'sequence' => 2, 'reward_type' => 7,
        'reward_data_id' => '30300', 'amount' => '2147483647',
        'description' => 'Ineligible-class points', 'enabled' => 1, 'option_id' => null,
    ),
);
identity_retention_assert(
    identity_retention_reward_error($rewardWriteValidator, $repository, $pairedAaRewards, null, true) === null,
    'repository accepts a one-to-one automatic specific-AA and class-ineligible fallback pair'
);

$rewardFailureCases = array(
    array(0, '1001', '32768', 'amount', 'item quantity above signed-short maximum'),
    array(1, '2', '1', 'reward_data_id', 'unsupported experience mode'),
    array(1, '0', '4294967296', 'amount', 'experience above unsigned 32-bit maximum'),
    array(2, '1', '1', 'reward_data_id', 'nonzero reserved AA data'),
    array(2, '0', '2147483648', 'amount', 'AA above signed-int maximum'),
    array(3, '1', '1', 'reward_data_id', 'nonzero reserved copper data'),
    array(3, '0', '2147483648000', 'amount', 'copper above its runtime conversion ceiling'),
    array(4, '0', '1', 'reward_data_id', 'zero alternate-currency ID'),
    array(4, '1', '2147483648', 'amount', 'alternate currency above signed-int maximum'),
    array(5, '2147483648', '1', 'reward_data_id', 'title-set ID above signed-int maximum'),
    array(5, '1', '2', 'amount', 'nonsingular title amount'),
    array(6, '0', '1', 'reward_data_id', 'zero specific-AA ability ID'),
    array(6, '30300', '2147483648', 'amount', 'specific-AA desired rank above signed-int maximum'),
    array(7, '0', '1', 'reward_data_id', 'zero fallback ability ID'),
    array(7, '30300', '2147483648', 'amount', 'fallback AA points above signed-int maximum'),
);
foreach ($rewardFailureCases as $failure) {
    $reward = array(
        'reward_id' => null,
        'sequence' => 1,
        'reward_type' => $failure[0],
        'reward_data_id' => $failure[1],
        'amount' => $failure[2],
        'description' => 'Invalid active grant',
        'enabled' => 1,
        'option_id' => null,
    );
    $failureException = identity_retention_reward_error(
        $rewardWriteValidator,
        $repository,
        array($reward),
        null,
        true
    );
    identity_retention_assert(
        $failureException instanceof AchievementRepositoryException &&
            $failureException->getField() === 'rewards.0.' . $failure[3],
        'repository rejects reachable ' . $failure[4] . ' on its exact write field'
    );
}

$unpairedAaError = identity_retention_reward_error(
    $rewardWriteValidator,
    $repository,
    array($pairedAaRewards[1]),
    null,
    true
);
identity_retention_assert(
    $unpairedAaError instanceof AchievementRepositoryException
        && $unpairedAaError->getField() === 'rewards.0.reward_data_id',
    'repository rejects an enabled automatic fallback without exactly one primary'
);
$selectableAaFallback = $pairedAaRewards[1];
$selectableAaFallback['option_id'] = 10;
$activeAaSet = array(
    'reward_set_id' => null,
    'title' => 'Active set',
    'enabled' => 1,
    'source_enabled' => 1,
    'options' => array(array(
        'option_id' => 10, 'sequence' => 1, 'label' => 'Choice',
        'common_to_all' => 0, 'flags' => 0, 'enabled' => 1,
    )),
);
$selectableAaError = identity_retention_reward_error(
    $rewardWriteValidator,
    $repository,
    array($selectableAaFallback),
    $activeAaSet,
    true
);
identity_retention_assert(
    $selectableAaError instanceof AchievementRepositoryException
        && $selectableAaError->getField() === 'rewards.0.option_id',
    'repository rejects a reachable selectable class-ineligible fallback'
);

$stagedReward = array(
    'reward_id' => null,
    'sequence' => 1,
    'reward_type' => 0,
    'reward_data_id' => '1001',
    'amount' => '32768',
    'description' => 'Staged invalid grant',
    'enabled' => 0,
    'option_id' => null,
);
identity_retention_assert(
    identity_retention_reward_error($rewardWriteValidator, $repository, array($stagedReward), null, true) === null,
    'repository permits a disabled grant to stage runtime-incompatible content'
);
$stagedReward['enabled'] = 1;
identity_retention_assert(
    identity_retention_reward_error($rewardWriteValidator, $repository, array($stagedReward), null, false) === null,
    'repository permits an unreachable disabled definition to stage runtime-incompatible content'
);
$stagedReward['option_id'] = 10;
$stagedRewardSet = array(
    'reward_set_id' => null,
    'title' => 'Staged set',
    'enabled' => 1,
    'source_enabled' => 0,
    'options' => array(array(
        'option_id' => 10,
        'sequence' => 1,
        'label' => 'Staged option',
        'common_to_all' => 0,
        'flags' => 0,
        'enabled' => 1,
    )),
);
identity_retention_assert(
    identity_retention_reward_error($rewardWriteValidator, $repository, array($stagedReward), $stagedRewardSet, true) === null,
    'repository permits a disabled achievement source to stage runtime-incompatible selectable grants'
);
$stagedRewardSet['source_enabled'] = 1;
$publishedStageError = identity_retention_reward_error(
    $rewardWriteValidator,
    $repository,
    array($stagedReward),
    $stagedRewardSet,
    true
);
identity_retention_assert(
    $publishedStageError instanceof AchievementRepositoryException &&
        $publishedStageError->getField() === 'rewards.0.amount',
    'repository applies runtime delivery bounds when a staged selectable source becomes reachable'
);

$source = file_get_contents(dirname(__DIR__) . '/classes/achievement_repository.php');
identity_retention_assert(
    substr_count($source, 'assertRetainedIdentities(') >= 4,
    'component, grant, and option synchronization all call the server-side guard'
);
identity_retention_assert(
    strpos($source, 'Persisted reward set ') !== false,
    'reward-set removal has an explicit server-side guard'
);
identity_retention_assert(
    strpos($source, 'DELETE FROM rewards') === false &&
        strpos($source, 'DELETE FROM reward_sets') === false,
    'save and delete never remove provider-neutral reward or reward-set catalog rows'
);
identity_retention_assert(
    strpos($source, 'DELETE FROM reward_source_entries WHERE source_type = 1 AND source_id = ?') !== false &&
        strpos($source, 'DELETE FROM reward_sources WHERE source_type = 1 AND source_id = ?') !== false,
    'achievement unlink operations are explicitly scoped to source_type 1'
);
identity_retention_assert(
    strpos($source, 'another achievement, task, or future provider') !== false &&
        strpos($source, 'This reward set is shared by another provider source') !== false &&
        strpos($source, 'INNER JOIN reward_sources shared_source') !== false,
    'shared reward and set edits are guarded across provider types'
);
identity_retention_assert(
    strpos($source, "\$reward['reward_id'] = null;") !== false &&
        strpos($source, "\$definition['reward_set']['reward_set_id'] = null;") !== false,
    'definition cloning clears catalog identities so fresh reward and set IDs are allocated'
);

$contentIdentityDatabase = new IdentityRetentionDatabase();
$contentIdentityDatabase->currentContentId = 10;
$characterIdentityDatabase = new IdentityRetentionDatabase();
$characterIdentityDatabase->reservedIds = array(11, 12);
$contentDatabaseProperty->setValue($repository, $contentIdentityDatabase);
$characterDatabaseProperty->setValue($repository, $characterIdentityDatabase);
identity_retention_assert(
    $durableState->invoke($repository, 11, true) &&
        !$durableState->invoke($repository, 13, true),
    'durable character-state lookup distinguishes reserved and unused definition IDs'
);
identity_retention_assert(
    $suggestAchievementId->invoke($repository, false) === 13,
    'automatic achievement-ID suggestion skips IDs preserved only in character state'
);
$reservationSql = implode("\n", $characterIdentityDatabase->queries);
foreach (array(
    'character_achievements', 'character_achievement_progress',
    'character_achievement_rewards', 'character_achievement_reward_selections',
    'character_achievement_pending_updates'
) as $durableTable) {
    identity_retention_assert(
        strpos($reservationSql, $durableTable) !== false,
        'achievement-ID reservation checks ' . $durableTable
    );
}

$policy = array(
    'version' => 0,
    'reset_on_version_change' => 0,
    'enabled' => 1,
    'components' => array(array(
        'component_type' => 1,
        'sequence' => 1,
        'component_id' => 10,
        'presentation_count' => 1,
        'criteria' => array(array(
            'event_type' => 1,
            'progress_mode' => 3,
            'behavior' => 0,
            'target_id' => 0,
            'target_id2' => 0,
            'target_value' => 50,
            'required_count' => 1,
            'enabled' => 1
        ))
    )),
    'rewards' => array(),
    'reward_set' => array(
        'reward_set_id' => 500,
        'enabled' => 1,
        'source_enabled' => 0,
        'options' => array(array(
            'option_id' => 100,
            'sequence' => 1,
            'common_to_all' => 0,
            'flags' => 0,
            'enabled' => 1
        ))
    ),
    'restrictions' => array()
);
$disabledDefinition = $policy;
$disabledDefinition['enabled'] = 0;
identity_retention_assert(
    $fingerprint->invoke($repository, $policy) === $fingerprint->invoke($repository, $disabledDefinition),
    'runtime policy fingerprint is independent of top-level publication state'
);
$stagedContentEdit = $policy;
$stagedContentEdit['reward_set']['options'][0]['flags'] = 7;
identity_retention_assert(
    $fingerprint->invoke($repository, $policy) === $fingerprint->invoke($repository, $stagedContentEdit),
    'disabled reward sources may stage incomplete or changing selectable content without projecting it as deployed policy'
);
$activeSelectable = $stagedContentEdit;
$activeSelectable['reward_set']['source_enabled'] = 1;
identity_retention_assert(
    $fingerprint->invoke($repository, $policy) !== $fingerprint->invoke($repository, $activeSelectable),
    'source enablement and reachable selectable contents are part of projected runtime policy'
);
$changedPolicy = $policy;
$changedPolicy['components'][0]['criteria'][0]['target_value'] = 60;
$sameVersionRejected = false;
try {
    $versionGuard->invoke($repository, $policy, $changedPolicy);
} catch (AchievementRepositoryException $exception) {
    $sameVersionRejected = $exception->getField() === 'version';
}
identity_retention_assert(
    $sameVersionRejected,
    'a semantic policy edit at exact version zero requires a version bump'
);
$resetPolicy = $policy;
$resetPolicy['reset_on_version_change'] = 1;
$resetChangeRejected = false;
try {
    $versionGuard->invoke($repository, $policy, $resetPolicy);
} catch (AchievementRepositoryException $exception) {
    $resetChangeRejected = $exception->getField() === 'version';
}
identity_retention_assert(
    $resetChangeRejected,
    'changing reset-on-version-change at exact version zero requires a version bump'
);
$changedPolicy['version'] = 1;
$versionGuard->invoke($repository, $policy, $changedPolicy);
identity_retention_assert(true, 'a semantic policy edit with a strictly newer version is accepted');

$legacyCharacterDatabase = new IdentityRetentionDatabase();
$legacyCharacterDatabase->prepareError = 1146;
$characterDatabaseProperty->setValue($repository, $legacyCharacterDatabase);
$legacyStateRejected = false;
try {
    $durableState->invoke($repository, 77, true);
} catch (AchievementRepositoryException $exception) {
    $legacyStateRejected = $exception->getField() === 'schema'
        && strpos($exception->getMessage(), 'character achievement state schema') !== false
        && isset($exception->getDetails()['database_errno'])
        && (int) $exception->getDetails()['database_errno'] === 1146;
}
identity_retention_assert(
    $legacyStateRejected,
    'legacy character schemas fail closed with an actionable state-schema diagnostic'
);

echo 'achievement_identity_retention_test: passed (' . $assertions . ' assertions)' . PHP_EOL;

?>
