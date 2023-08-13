<?php
$default_page = 1;
$default_size = 50;
$default_sort = 1;

$columns = array(
  1 => 'id',
  2 => '`key`',
  3 => 'value',
  4 => 'expires'
);

switch ($action) {
  case 0: // View Databuckets
    check_authorization();
    $curr_page = (isset($_GET['page'])) ? $_GET['page'] : $default_page;
    $curr_size = (isset($_GET['size'])) ? $_GET['size'] : $default_size;
    $curr_sort = (isset($_GET['sort'])) ? $columns[$_GET['sort']] : $columns[$default_sort];
    if (isset($_GET['filter']) && $_GET['filter'] == 'on') {
      $filter = build_filter();
    }
    $body = new Template("templates/databuckets/databuckets.tmpl.php");
    $page_stats = getPageInfo("data_buckets", FALSE, $curr_page, $curr_size, ((isset($_GET['sort'])) ? $_GET['sort'] : null), ((isset($filter)) ? $filter['sql'] : null));
    if (isset($filter)) {
      $body->set('filter', $filter);
    }
    if ($page_stats['page']) {
      $databuckets = get_databuckets($page_stats['page'], $curr_size, $curr_sort, ((isset($filter)) ? $filter['sql'] : null));
    }
    if (isset($databuckets)) {
      $body->set('databuckets', $databuckets);
      foreach ($page_stats as $key=>$value) {
        $body->set($key, $value);
      }
    }
    else {
      $body->set('page', 0);
      $body->set('pages', 0);
    }
    break;
  case 1: // Search Databuckets
    check_authorization();
    //TODO: Add search function
    break;
  case 2: //Create Databucket
    check_authorization();
    $breadcrumbs .= " >> Create Databucket";
    $body = new Template("templates/databuckets/databucket.add.tmpl.php");
    $javascript = new Template("templates/databuckets/js.tmpl.php");
    $suggest_id = suggest_id();
    $body->set('suggest_id', $suggest_id);
    break;
  case 3: //Insert Databucket
    check_authorization();
    insert_databucket();
    header("Location: index.php?editor=databuckets");
    exit;
  case 4: //Edit Databucket
    check_authorization();
    $breadcrumbs .= " >> Edit Databucket";
    $body = new Template("templates/databuckets/databucket.edit.tmpl.php");
    $javascript = new Template("templates/databuckets/js.tmpl.php");
    $databucket = view_databucket($_GET['id']);
    if ($databucket) {
      foreach ($databucket as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
  case 5: //Update Databucket
    check_authorization();
    update_databucket();
    $return_address = $_POST['referer'];
    header("Location: $return_address");
    exit;
  case 6: //Delete Databucket
    check_authorization();
    delete_databucket($_GET['id']);
    $return_address = $_SERVER['HTTP_REFERER'];
    header("Location: $return_address");
    exit;
}

function get_databuckets($page_number, $results_per_page, $sort_by, $where = "") {
  global $mysql;
  $limit = ($page_number - 1) * $results_per_page . "," . $results_per_page;

  $query = "SELECT * FROM data_buckets";
  if ($where) {
    $query .= " WHERE $where";
  }
  $query .= " ORDER BY $sort_by LIMIT $limit";
  $results = $mysql->query_mult_assoc($query);

  return $results;
}

function view_databucket($id) {
  global $mysql;

  $query = "SELECT * FROM data_buckets WHERE id=\"$id\"";
  $result = $mysql->query_assoc($query);
  
  return $result;
}

function insert_databucket() {
  global $mysql;
  $fields = '';

  $fields .= "id=\"" . $_POST['id'] . "\", ";
  $fields .= "`key`=\"" . $_POST['key'] . "\", ";
  $fields .= "value=\"" . $_POST['value'] . "\", ";
  $fields .= "expires=\"" . $_POST['expires'] . "\", ";
  $fields .= "character_id=\"" . $_POST['character_id'] . "\", ";
  $fields .= "npc_id=\"" . $_POST['npc_id'] . "\", ";
  $fields .= "bot_id=\"" . $_POST['bot_id'] . "\"";

  $query = "INSERT INTO data_buckets SET $fields";
  $mysql->query_no_result($query);
}

function update_databucket() {
  global $mysql;
  $id = $_POST['id'];
  $old_key = $_POST['old_key'];
  $old_value = $_POST['old_value'];
  $old_expires = $_POST['old_expires'];
  $old_character_id = $_POST['old_character_id'];
  $old_npc_id = $_POST['old_npc_id'];
  $old_bot_id = $_POST['old_bot_id'];
  $new_key = $_POST['key'];
  $new_value = $_POST['value'];
  $new_expires = $_POST['expires'];
  $new_character_id = $_POST['character_id'];
  $new_npc_id = $_POST['npc_id'];
  $new_bot_id = $_POST['bot_id'];
  $databucket = view_databucket($id);
  $fields = '';
  extract($databucket);

  if ($key != $new_key) $fields .= "`key`=\"" . $new_key . "\", ";
  if ($value != $new_value) $fields .= "value=\"" . $new_value . "\", ";
  if ($expires != $new_expires) $fields .= "expires=\"" . $new_expires . "\", ";
  if ($character_id != $new_character_id) $fields .= "character_id=\"" . $new_character_id . "\", ";
  if ($npc_id != $new_npc_id) $fields .= "npc_id=\"" . $new_npc_id . "\", ";
  if ($bot_id != $new_bot_id) $fields .= "bot_id=\"" . $new_bot_id . "\"";

  $fields =  rtrim($fields, ", ");
  if ($fields != '') {
    $query = "UPDATE data_buckets SET $fields WHERE id=\"$id\"";
    $mysql->query_no_result($query);
  }
}

function delete_databucket($id) {
  global $mysql;

  $query = "DELETE FROM data_buckets WHERE id=\"$id\"";
  $mysql->query_no_result($query);
}

function suggest_id() {
  global $mysql;

  $query = "SELECT MAX(id) AS id FROM data_buckets";
  $result = $mysql->query_assoc($query);

  return $result['id'] + 1;
}

function build_filter() {
  global $mysql, $mysql_content_db;

  $filter1 = $_GET['filter1'];
  $filter2 = $_GET['filter2'];
  $filter3 = $_GET['filter3'];
  $filter4 = $_GET['filter4'];
  $filter5 = $_GET['filter5'];
  $filter_final = array('sql'=>'');

  if ($filter1) { // Filter by key
    $filter_key = "`key` LIKE '%" . $filter1 . "%'";
    $filter_final['sql'] = $filter_key;
  }
  if ($filter2) { // Filter by value
    if ($filter_final['sql']) {
      $filter_final['sql'] .= " AND ";
    }
    $filter_value = "`value` LIKE '%" . $filter2 . "%'";
    $filter_final['sql'] .= $filter_value;
  }
  if ($filter3) { // Filter by character
    $query = "SELECT id FROM character_data WHERE name LIKE \"%$filter3%\"";
    $results = $mysql->query_mult_assoc($query);
    $filter_character_id = "character_id IN (";
    if ($results) {
      foreach ($results as $result) {
        $filter_character_id .= $result['id'] . ",";
      }
      $filter_character_id = rtrim($filter_character_id, ",");
    }
    else {
      $filter_character_id .= "NULL";
    }
    $filter_character_id .= ")";
    if ($filter_final['sql']) {
      $filter_final['sql'] .= " AND ";
    }
    $filter_final['sql'] .= $filter_character_id;
  }
  if ($filter4) { // Filter by npc
    $query = "SELECT id FROM npc_types WHERE name LIKE \"%$filter4%\"";
    $results = $mysql_content_db->query_mult_assoc($query);
    $filter_npc_id = "npc_id IN (";
    if ($results) {
      foreach ($results as $result) {
        $filter_npc_id .= $result['id'] . ",";
      }
      $filter_npc_id = rtrim($filter_npc_id, ",");
    }
    else {
      $filter_npc_id .= "NULL";
    }
    $filter_npc_id .= ")";
    if ($filter_final['sql']) {
      $filter_final['sql'] .= " AND ";
    }
    $filter_final['sql'] .= $filter_npc_id;
  }
  if ($filter5) { // Filter by bot_id
    if ($filter_final['sql']) {
      $filter_final['sql'] .= " AND ";
    }
    $filter_value = "`bot_id` LIKE '%" . $filter5 . "%'";
    $filter_final['sql'] .= $filter_value;
  }

  $filter_final['url'] = "&filter=on&filter1=$filter1&filter2=$filter2&filter3=$filter3&filter4=$filter4&filter5=$filter5";
  $filter_final['status'] = "on";
  $filter_final['filter1'] = $filter1;
  $filter_final['filter2'] = $filter2;
  $filter_final['filter3'] = $filter3;
  $filter_final['filter4'] = $filter4;
  $filter_final['filter5'] = $filter5;

  return $filter_final;
}
?>