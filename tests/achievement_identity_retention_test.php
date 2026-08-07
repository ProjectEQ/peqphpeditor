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

$reflection = new ReflectionClass('AchievementRepository');
$repository = $reflection->newInstanceWithoutConstructor();
$guard = $reflection->getMethod('assertRetainedIdentities');
$guard->setAccessible(true);

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

$source = file_get_contents(dirname(__DIR__) . '/classes/achievement_repository.php');
identity_retention_assert(
    substr_count($source, 'assertRetainedIdentities(') >= 4,
    'component, grant, and option synchronization all call the server-side guard'
);
identity_retention_assert(
    strpos($source, 'Persisted reward set ') !== false,
    'reward-set removal has an explicit server-side guard'
);

echo 'achievement_identity_retention_test: passed (' . $assertions . ' assertions)' . PHP_EOL;

?>
