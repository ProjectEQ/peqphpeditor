<?php

require_once(dirname(__DIR__) . '/classes/achievement_repository.php');

$assertions = 0;
function race_lookup_assert($condition, $message)
{
    global $assertions;
    $assertions++;
    if (!$condition) {
        fwrite(STDERR, 'FAIL: ' . $message . PHP_EOL);
        exit(1);
    }
}

class RaceLookupFakeMetadata
{
    public function fetch_fields()
    {
        return array((object) array('name' => 'lookup_id'));
    }

    public function free()
    {
    }
}

class RaceLookupFakeStatement
{
    public $errno = 0;
    public $error = '';
    public $affected_rows = 0;
    private $rows;
    private $resultBindings = array();
    private $cursor = 0;

    public function __construct($rows)
    {
        $this->rows = $rows;
    }

    public function bind_param($types, &...$values)
    {
        return true;
    }

    public function execute()
    {
        return true;
    }

    public function result_metadata()
    {
        return new RaceLookupFakeMetadata();
    }

    public function bind_result(&...$values)
    {
        foreach ($values as $index => &$value) {
            $this->resultBindings[$index] =& $value;
        }
        return true;
    }

    public function fetch()
    {
        if (!isset($this->rows[$this->cursor])) {
            return false;
        }
        $row = $this->rows[$this->cursor++];
        $this->resultBindings[0] = $row[0];
        return true;
    }

    public function close()
    {
        return true;
    }
}

class RaceLookupFakeDatabase
{
    public $errno = 0;
    public $error = '';
    public $lastSql = '';

    public function prepare($sql)
    {
        $this->lastSql = $sql;
        return new RaceLookupFakeStatement(array(array(1), array(999)));
    }
}

function race_lookup_repository($database)
{
    $reflection = new ReflectionClass('AchievementRepository');
    $repository = $reflection->newInstanceWithoutConstructor();

    $dbProperty = $reflection->getProperty('db');
    $dbProperty->setAccessible(true);
    $dbProperty->setValue($repository, $database);

    $schemaProperty = $reflection->getProperty('schemaDiagnosticsCache');
    $schemaProperty->setAccessible(true);
    $schemaProperty->setValue($repository, array('ready' => true));
    return $repository;
}

$database = new RaceLookupFakeDatabase();
$repository = race_lookup_repository($database);
$GLOBALS['races'] = array(1 => 'Human', 407 => 'Custom Highpass Race');

race_lookup_assert(isset($repository->lookupTypes()['race']), 'race is advertised as a lookup type');

$hydrated = $repository->lookup('race', '', array('0001', '407', '999', '-1', '4294967296'), 10);
race_lookup_assert(count($hydrated) === 3, 'exact hydration accepts valid unique uint32 race IDs only');
race_lookup_assert($hydrated[0]['id'] === 1 && $hydrated[0]['name'] === 'Human', 'known race gets PEQ label');
race_lookup_assert($hydrated[1]['id'] === 407, 'custom numeric race is retained');
race_lookup_assert($hydrated[2]['id'] === 999 && $hydrated[2]['name'] === 'Race 999', 'unknown race gets safe numeric label');
race_lookup_assert($database->lastSql === '', 'exact numeric hydration does not require a matching NPC row');

unset($GLOBALS['races']);
$fallback = $repository->lookup('race', 'Race 407', array(), 10);
race_lookup_assert($fallback[0]['id'] === 407 && $fallback[0]['name'] === 'Race 407', 'missing optional name catalog falls back safely');

$GLOBALS['races'] = array(1 => 'Human');
$suggestions = $repository->lookup('race', '', array(), 10);
race_lookup_assert(strpos($database->lastSql, 'SELECT DISTINCT race AS lookup_id FROM npc_types') !== false, 'suggestions use npc_types.race in the content database');
race_lookup_assert(count($suggestions) === 2, 'database race suggestions are returned');
race_lookup_assert($suggestions[0]['name'] === 'Human', 'database suggestion is decorated with known label');
race_lookup_assert($suggestions[1]['name'] === 'Race 999', 'database suggestion without a name remains usable');

echo 'achievement_race_lookup_test: passed (' . $assertions . ' assertions)' . PHP_EOL;

?>
