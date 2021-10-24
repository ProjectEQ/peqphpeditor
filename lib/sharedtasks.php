<?

switch ($action) {
  case 0: // Default View
    $body = new Template("templates/sharedtasks/sharedtasks.default.tmpl.php");
    break;
  case 1: // View Shared Tasks
    $body = new Template("templates/sharedtasks/sharedtasks.view.tmpl.php");
    $breadcrumbs .= " >> View Shared Tasks";
    $body->set('yesno', $yesno);
    $sharedtasks = get_sharedtasks();
    if ($sharedtasks) {
      $body->set('sharedtasks', $sharedtasks);
    }
    break;
}

function get_sharedtasks() {
  global $mysql;

  $query = "SELECT * FROM shared_tasks";
  $results = $mysql->query_mult_assoc($query);

  if ($results) {
    return $results;
  }
  else {
    return null;
  }
}

function get_sharedtask($id) {
  global $mysql;

  $query = "SELECT * FROM shared_tasks WHERE id=$id";
  $result = $mysql->query_assoc($query);

  if ($result) {
    return $result;
  }
  else {
    return null;
  }
}

?>