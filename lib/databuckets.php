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
    $databucket = view_databucket($_GET['id'], $_GET['key'], $_GET['value'], $_GET['expires']);
    if ($databucket) {
      $breadcrumbs .= " >> Edit Databucket";
      $body = new Template("templates/databuckets/databucket.edit.tmpl.php");
      foreach ($databucket as $key=>$value) {
        $body->set($key, $value);
      }
      break;
    }
    else {
      header("Location: index.php?editor=databuckets");
      exit;
    }
  case 5: //Update Databucket
    check_authorization();
    update_databucket();
    $return_address = $_POST['referer'];
    header("Location: $return_address");
    exit;
  case 6: //Delete Databucket
    check_authorization();
    delete_databucket();
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

function view_databucket($id, $key, $value, $expires) {
  global $mysql;

  $query = "SELECT * FROM data_buckets WHERE id=\"$id\" AND `key`=\"$key\" AND value=\"$value\" AND expires=\"$expires\"";
  $result = $mysql->query_assoc($query);
  
  return $result;
}

function insert_databucket() {
  global $mysql;
  $fields = '';

  $fields .= "id=\"" . $_POST['id'] . "\", ";
  $fields .= "`key`=\"" . $_POST['key'] . "\", ";
  $fields .= "value=\"" . $_POST['value'] . "\", ";
  $fields .= "expires=\"" . $_POST['expires'] . "\"";

  $query = "INSERT INTO data_buckets SET $fields";
  $mysql->query_no_result($query);
}

function update_databucket() {
  global $mysql;
  $old_id = $_POST['old_id'];
  $old_key = $_POST['old_key'];
  $old_value = $_POST['old_value'];
  $old_expires = $_POST['old_expires'];
  $new_id = $_POST['id'];
  $new_key = $_POST['key'];
  $new_value = $_POST['value'];
  $new_expires = $_POST['expires'];
  $databucket = view_databucket($old_id, $old_key, $old_value, $old_expires);
  $fields = '';
  extract($databucket);

  if ($id != $new_id) $fields .= "id=\"" . $new_id . "\", ";
  if ($key != $new_key) $fields .= "`key`=\"" . $new_key . "\", ";
  if ($value != $new_value) $fields .= "value=\"" . $new_value . "\", ";
  if ($expires != $new_expires) $fields .= "expires=\"" . $new_expires . "\"";

  $fields =  rtrim($fields, ", ");
  if ($fields != '') {
    $query = "UPDATE data_buckets SET $fields WHERE id=\"$old_id\" AND `key`=\"$old_key\" AND value=\"$old_value\" AND expires=\"$old_expires\"";
    $mysql->query_no_result($query);
  }
}

function delete_databucket() {
  global $mysql;
  $id = $_GET['id'];
  $key = $_GET['key'];
  $value = $_GET['value'];
  $expires = $_GET['expires'];

  $query = "DELETE FROM data_buckets WHERE id=\"$id\" AND `key`=\"$key\" AND value=\"$value\" AND expires=\"$expires\"";
  $mysql->query_no_result($query);
}

function suggest_id() {
  global $mysql;

  $query = "SELECT MAX(id) AS id FROM data_buckets";
  $result = $mysql->query_assoc($query);

  return $result['id'] + 1;
}

function build_filter() {
  $filter1 = $_GET['filter1'];
  $filter2 = $_GET['filter2'];
  $filter_final = array();

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

  $filter_final['url'] = "&filter=on&filter1=$filter1&filter2=$filter2";
  $filter_final['status'] = "on";
  $filter_final['filter1'] = $filter1;
  $filter_final['filter2'] = $filter2;

  return $filter_final;
}
?>