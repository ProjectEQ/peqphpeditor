<?
switch($action) {
  case 0: //View Content Flags
    $body = new Template("templates/content/content.flags.tmpl.php");
    $content_flags = get_content_flags();
    $body->set ('yesno', $yesno);
    if ($content_flags) {
      $body->set('content_flags', $content_flags);
    }
    break;
  case 1: //Add Content Flag
    check_authorization();
    $body = new Template("templates/content/content.flag.add.tmpl.php");
    $breadcrumbs .= " >> Add Content Flag";
    $next_id = next_content_flag();
    $body->set('next_id', $next_id);
    break;
  case 2: //Insert Content Flag
    check_authorization();
    add_content_flag();
    header("Location: index.php?editor=content");
    exit;
  case 3: //Edit Content Flag
    check_authorization();
    $body = new Template("templates/content/content.flag.edit.tmpl.php");
    $breadcrumbs .= " >> Edit Content Flag";
    $id = $_GET['id'];
    $content_flag = get_content_flag($id);
    if ($content_flag) {
      $body->set('content_flag', $content_flag);
    }
    break;
  case 4: //Update Content Flag
    check_authorization();
    update_content_flag();
    header("Location: index.php?editor=content");
    exit;
  case 5: //Delete Content Flag
    check_authorization();
    $id = $_GET['id'];
    delete_content_flag($id);
    header("Location: index.php?editor=content");
    exit;
}

function get_content_flags() {
  global $mysql_content_db;

  $query = "SELECT * FROM content_flags";
  $results = $mysql_content_db->query_mult_assoc($query);

  if ($results) {
    return $results;
  }
  else {
    return null;
  }
}

function get_content_flag($id) {
  global $mysql_content_db;

  $query = "SELECT * FROM content_flags WHERE id=$id";
  $result = $mysql_content_db->query_assoc($query);

  if ($result) {
    return $result;
  }
  else {
    return null;
  }
}

function add_content_flag() {
  global $mysql_content_db;

  $id = $_POST['id'];
  $flag_name = $_POST['flag_name'];
  $enabled = $_POST['enabled'];
  $notes = $_POST['notes'];

  $query = "INSERT INTO content_flags SET id=$id, flag_name=\"$flag_name\", enabled=$enabled, notes=\"$notes\"";
  $mysql_content_db->query_no_result($query);
}

function update_content_flag() {
  global $mysql_content_db;

  $id = $_POST['id'];
  $flag_name = $_POST['flag_name'];
  $enabled = $_POST['enabled'];
  $notes = $_POST['notes'];

  $query = "UPDATE content_flags SET flag_name=\"$flag_name\", enabled=$enabled, notes=\"$notes\" WHERE id=$id";
  $mysql_content_db->query_no_result($query);
}

function delete_content_flag($id) {
  global $mysql_content_db;

  $query = "DELETE FROM content_flags WHERE id=$id";
  $mysql_content_db->query_no_result($query);
}

function next_content_flag() {
  global $mysql_content_db;

  $query = "SELECT MAX(id) AS id FROM content_flags";
  $result = $mysql_content_db->query_assoc($query);

  return $result['id'] + 1;
}
?>