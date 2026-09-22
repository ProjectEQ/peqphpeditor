<?php

// No connection or writes to a real database: exercise the actual item handlers.
error_reporting(E_ALL);
set_error_handler(function ($severity, $message, $file, $line) {
  throw new ErrorException($message, 0, $severity, $file, $line);
});

require_once dirname(__DIR__) . '/classes/template.php';

$assertions = 0;
function kinbound_assert($condition, $message) {
  global $assertions;
  ++$assertions;
  if (!$condition) {
    throw new RuntimeException($message);
  }
}

class KinboundFakeDatabase {
  public $supported;
  public $reads = array();
  public $writes = array();
  public $item = array();
  public $results = array();
  public function __construct($supported) { $this->supported = $supported; }
  public function query_assoc($query) {
    $this->reads[] = $query;
    if ($query === "SHOW COLUMNS FROM items LIKE 'kinbound'") {
      return $this->supported ? array('Field' => 'kinbound') : '';
    }
    if (strpos($query, 'SELECT MAX(id)') === 0) { return array('iid' => 100); }
    return $this->item;
  }
  public function query_mult_assoc($query) {
    $this->reads[] = $query;
    return $this->results;
  }
  public function query_no_result($query) { $this->writes[] = $query; return true; }
  public function real_escape_string($value) { return addslashes($value); }
}

$mysql_content_db = new KinboundFakeDatabase(true);
for ($i = 1; $i <= 501; ++$i) {
  $mysql_content_db->results[] = array('id' => $i, 'name' => 'Filtered item ' . $i, 'kinbound' => '0');
}
$_GET = array('kinbound' => '0');
$action = 1;
require_once dirname(__DIR__) . '/lib/items.php';
kinbound_assert(count($body->vars['results']) === 500, 'filtered route trims the sentinel row');
kinbound_assert($body->vars['results'][499]['id'] === 500, 'filtered route retains the first 500 matches');
kinbound_assert(!empty($body->vars['results_truncated']), 'filtered route flags truncation');
$html = $body->fetch(dirname(__DIR__) . '/templates/items/items.searchresults.tmpl.php');
kinbound_assert(strpos($html, 'Showing the first 500 matches. Narrow your search by item name or ID') !== false, 'filtered route explains how to narrow search');
kinbound_assert(strpos($html, 'Filtered item 501') === false, 'sentinel row is not rendered');
$unfiltered = search_editor_items($mysql_content_db, array('search' => 'Filtered'));
kinbound_assert(count($unfiltered) === 501 && strpos(end($mysql_content_db->reads), 'LIMIT') === false, 'unfiltered searches preserve their existing behavior');

// Supply neutral values for the large legacy form; explicit test values below
// determine the expected SQL, including whether unrelated fields are untouched.
$source = file_get_contents(dirname(__DIR__) . '/lib/items.php');
preg_match_all('/\$_POST\[\'([^\']+)\'\]/', $source, $post_keys);
preg_match_all('/\$item\[\'([^\']+)\'\]/', $source, $item_keys);
$post = array_fill_keys($post_keys[1], '0');
foreach (array_keys($post) as $key) {
  if (preg_match('/^(slot_|race_|class_|deity_|augtype_)/', $key)) { unset($post[$key]); }
}
$item = array_fill_keys($item_keys[1], '0');
$item['id'] = $post['id'] = '42';
$item['Name'] = $post['itemname'] = 'Kinbound Test Item';
$post['updated'] = '2026-09-21 12:00:00';

$mysql_content_db = new KinboundFakeDatabase(true);
$mysql_content_db->item = $item;
kinbound_assert(items_have_kinbound($mysql_content_db), 'custom column is detected');
kinbound_assert(items_have_kinbound($mysql_content_db), 'custom column detection is cached');
kinbound_assert(count($mysql_content_db->reads) === 1, 'schema checked once per connection');

foreach (array('0', '1', '2') as $policy) {
  $_POST = $post;
  $_POST['kinbound'] = $policy;
  $mysql_content_db->item['kinbound'] = $policy === '0' ? '2' : '0';
  $mysql_content_db->writes = array();
  update_item();
  kinbound_assert($mysql_content_db->writes === array('UPDATE items SET kinbound="' . $policy . '", updated="2026-09-21 12:00:00" WHERE id=42'), 'update changes only policy and timestamp for ' . $policy);
  $mysql_content_db->item['kinbound'] = $policy;
  $mysql_content_db->writes = array();
  update_item();
  kinbound_assert($mysql_content_db->writes === array(), 'unchanged policy does not write for ' . $policy);
  $mysql_content_db->writes = array();
  add_item();
  kinbound_assert(count($mysql_content_db->writes) === 1 && strpos($mysql_content_db->writes[0], 'INSERT INTO items SET kinbound="' . $policy . '", ') === 0, 'create saves policy ' . $policy);
}

$_POST = $post;
unset($_POST['kinbound']);
$mysql_content_db->item['kinbound'] = '2';
$mysql_content_db->writes = array();
update_item();
kinbound_assert($mysql_content_db->writes === array(), 'legacy form preserves existing policy when field absent');
add_item();
kinbound_assert(strpos($mysql_content_db->writes[0], 'kinbound=') === false, 'legacy create lets DB supply default');

foreach (array('-1', '3', '1.0', '01', '1 OR 1=1', '', null, array('1')) as $invalid) {
  $_POST = $post;
  $_POST['kinbound'] = $invalid;
  foreach (array('update_item', 'add_item') as $handler) {
    $mysql_content_db->writes = array();
    $rejected = false;
    try { $handler(); } catch (InvalidArgumentException $e) { $rejected = true; }
    kinbound_assert($rejected && $mysql_content_db->writes === array(), $handler . ' rejects invalid policy before writing');
  }
}

foreach (array(true, false) as $supported) {
  $mysql_content_db = new KinboundFakeDatabase($supported);
  $mysql_content_db->item = $item;
  if (!$supported) { unset($mysql_content_db->item['kinbound']); }
  $_GET = array('id' => '42');
  $new_id = copy_item();
  $copy_sql = $mysql_content_db->writes[1];
  kinbound_assert($new_id === 101, 'copy still assigns the next item ID');
  kinbound_assert(substr_count($copy_sql, ', kinbound') === ($supported ? 2 : 0), 'copy preserves policy only on supported schemas');
  if (!$supported) {
    $_POST = $post;
    $_POST['kinbound'] = '1';
    $mysql_content_db->writes = array();
    update_item();
    kinbound_assert($mysql_content_db->writes === array(), 'stock update ignores the unsupported flag');
    add_item();
    kinbound_assert(strpos($mysql_content_db->writes[0], 'kinbound') === false, 'stock insert never names the missing column');
  }

  $mysql_content_db->reads = array();
  search_editor_items($mysql_content_db, array('search' => 'Blade'));
  kinbound_assert(end($mysql_content_db->reads) === 'SELECT id, name' . ($supported ? ', kinbound' : '') . ' FROM items WHERE name RLIKE "Blade" ORDER BY id', 'name search remains compatible with schema');
  $mysql_content_db->reads = array();
  search_editor_items($mysql_content_db, array('id' => '42'));
  kinbound_assert(strpos(end($mysql_content_db->reads), 'WHERE id="42" ORDER BY id') !== false, 'ID search is preserved');
  foreach (array('0', '1', '2') as $policy) {
    $mysql_content_db->reads = array();
    search_editor_items($mysql_content_db, array('id' => 'ID', 'search' => 'Enter an Item', 'kinbound' => $policy));
    kinbound_assert($supported ? end($mysql_content_db->reads) === 'SELECT id, name, kinbound FROM items WHERE kinbound=' . $policy . ' ORDER BY id LIMIT 501' : $mysql_content_db->reads === array(), 'policy-only search handles ' . $policy);
  }

  $item_kinbound_available = $supported;
  $kinbound = '2';
  ob_start();
  include dirname(__DIR__) . '/templates/items/items.kinbound.tmpl.php';
  $html = ob_get_clean();
  kinbound_assert($supported ? strpos($html, '<option value="2" selected>2: Never Kinbound</option>') !== false : strpos($html, '<select') === false, 'form selects existing policy or explains absent schema');
  kinbound_assert($supported ? strpos($html, 'Unlisted does not enable Kinbound') !== false : strpos($html, 'items.kinbound column') !== false, 'form explains policy semantics or missing column');
}

$mysql_content_db = new KinboundFakeDatabase(true);
search_editor_items($mysql_content_db, array('search' => 'Sword "Rare"', 'kinbound' => '1'));
kinbound_assert(end($mysql_content_db->reads) === 'SELECT id, name, kinbound FROM items WHERE name RLIKE "Sword \\"Rare\\"" AND kinbound=1 ORDER BY id LIMIT 501', 'search combines escaped name with policy');
$rejected = false;
try { search_editor_items($mysql_content_db, array('kinbound' => '3')); } catch (InvalidArgumentException $e) { $rejected = true; }
kinbound_assert($rejected, 'invalid search policy is rejected');
foreach (array('id', 'search') as $parameter) {
  foreach (array(array('42'), new stdClass()) as $invalid) {
    $rejected = false;
    $mysql_content_db->reads = array();
    try { search_editor_items($mysql_content_db, array($parameter => $invalid, 'kinbound' => '0')); } catch (InvalidArgumentException $e) { $rejected = true; }
    kinbound_assert($rejected && $mysql_content_db->reads === array(), 'non-scalar ' . $parameter . ' is rejected before querying');
  }
}

$results = array(array('id' => '42', 'name' => '<Test>', 'kinbound' => '1'));
ob_start();
include dirname(__DIR__) . '/templates/items/items.searchresults.tmpl.php';
$html = ob_get_clean();
kinbound_assert(strpos($html, '[Always Kinbound]') !== false && strpos($html, '&lt;Test&gt;') !== false, 'results display stored policy and escape item names');

echo 'PASS: ' . $assertions . ' Kinbound item assertions' . PHP_EOL;
