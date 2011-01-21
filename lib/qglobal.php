<?php
$default_page = 1;
$default_size = 20;
$default_sort = 1;

$columns = array(
  1 => 'id',
  2 => 'name',
  3 => 'charid',
  4 => 'npcid',
  5 => 'zoneid'
);

switch ($action) {
  case 0: // View QGlobals
    check_authorization();
    $curr_page = (isset($_GET['page'])) ? $_GET['page'] : $default_page;
    $curr_size = (isset($_GET['size'])) ? $_GET['size'] : $default_size;
    $curr_sort = (isset($_GET['sort'])) ? $columns[$_GET['sort']] : $columns[$default_sort];
    $body = new Template("templates/qglobal/qglobal.tmpl.php");
    $qglobals = get_qglobals($curr_page, $curr_size, $curr_sort);
    $page_stats = getPageInfo("quest_globals", $curr_page, $curr_size, $_GET['sort']);
    if ($qglobals) {
      $body->set('qglobals', $qglobals);
      foreach ($page_stats as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
  case 1: // Search QGlobals
    check_authorization();
    //TODO: Add search function
    break;
  case 2: //Create QGlobal
    check_authorization();
    $breadcrumbs .= " >> Create Quest Global";
    $body = new Template("templates/qglobal/qglobal.add.tmpl.php");
    $nextid = get_next_qglobalid();
    $body->set('nextid', $nextid);
    break;
  case 3: //Insert QGlobal
    check_authorization();
    insert_qglobal();
    header("Location: index.php?editor=qglobal");
    exit;
  case 4: //Edit QGlobal
    check_authorization();
    $breadcrumbs .= " >> Edit Quest Global";
    $body = new Template("templates/qglobal/qglobal.edit.tmpl.php");
    $qglobal = view_qglobal($_GET['qglobalid']);
    if ($qglobal) {
      foreach ($qglobal as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
  case 5: //Update QGlobal
    check_authorization();
    update_qglobal();
    header("Location: index.php?editor=qglobal");
    exit;
  case 6: //Delete QGlobal
    check_authorization();
    delete_qglobal();
    header("Location: index.php?editor=qglobal");
    exit;
}

function get_qglobals($page_number, $results_per_page, $sort_by) {
  global $mysql;
  $limit = ($page_number - 1) * $results_per_page . "," . $results_per_page;

  $query = "SELECT * FROM quest_globals ORDER BY $sort_by LIMIT $limit";
  $results = $mysql->query_mult_assoc($query);

  return $results;
}

function view_qglobal($qglobalid) {
  global $mysql;

  $query = "SELECT * FROM quest_globals WHERE id = \"$qglobalid\"";
  $result = $mysql->query_assoc($query);
  
  return $result;
}

function insert_qglobal() {
  global $mysql;
  $fields = '';

  $fields = "id=\"" . $_POST['id'] . "\", ";
  $fields .= "name=\"" . $_POST['name'] . "\", ";
  $fields .= "value=\"" . $_POST['value'] . "\", ";
  $fields .= "charid=\"" . $_POST['charid'] . "\", ";
  $fields .= "npcid=\"" . $_POST['npcid'] . "\", ";
  $fields .= "zoneid=\"" . $_POST['zoneid'] . "\", ";
  $fields .= ($_POST['expdate'] == "") ? "expdate=NULL" : "expdate=\"" . $_POST['expdate'] . "\"";

  $query = "INSERT INTO quest_globals SET $fields";
  $mysql->query_no_result($query);
}

function update_qglobal() {
  global $mysql;
  $qglobal = view_qglobal($_POST['originalid']);
  $fields = '';
  extract($qglobal);

  if ($id != $_POST['id']) $fields .= "id=\"" . $_POST['id'] . "\", ";
  if ($name != $_POST['name']) $fields .= "name=\"" . $_POST['name'] . "\", ";
  if ($value != $_POST['value']) $fields .= "value=\"" . $_POST['value'] . "\", ";
  if ($charid != $_POST['charid']) $fields .= "charid=\"" . $_POST['charid'] . "\", ";
  if ($npcid != $_POST['npcid']) $fields .= "npcid=\"" . $_POST['npcid'] . "\", ";
  if ($zoneid != $_POST['zoneid']) $fields .= "zoneid=\"" . $_POST['zoneid'] . "\", ";
  if ($expdate != $_POST['expdate']) $fields .= ($_POST['expdate'] == "") ? "expdate=NULL" : "expdate=\"" . $_POST['expdate'] . "\"";

  $fields =  rtrim($fields, ", ");
  if ($fields != '') {
    $query = "UPDATE quest_globals SET $fields WHERE id=\"$id\"";
    $mysql->query_no_result($query);
  }
}

function delete_qglobal() {
  global $mysql;
  $qglobalid = $_GET['qglobalid'];

  $query = "DELETE FROM quest_globals WHERE id = \"$qglobalid\"";
  $mysql->query_no_result($query);
}

function get_next_qglobalid() {
  global $mysql;

  $query = "SELECT MAX(id) AS lastid FROM quest_globals";
  $result = $mysql->query_assoc($query);

  return ($result['lastid'] + 1);
}
?>