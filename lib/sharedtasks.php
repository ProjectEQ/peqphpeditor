<?

$activitytypes = array(
  0   => "None",
  1   => "Deliver",
  2   => "Kill",
  3   => "Loot",
  4   => "Speak With",
  5   => "Explore",
  6   => "Tradeskill",
  7   => "Fish",
  8   => "Forage",
  9   => "Cast On",
  10  => "Use Skill On",
  11  => "Touch",
  13  => "Collect",
  14  => "Trigger Phrase",
  100 => "Give Cash",
  255 => "Custom"
);

switch ($action) {
  case 0: // Default View
    $body = new Template("templates/sharedtasks/sharedtasks.default.tmpl.php");
    break;
  case 1: // View Active Tasks
    $body = new Template("templates/sharedtasks/sharedtasks.view.tmpl.php");
    $breadcrumbs .= " >> Active Shared Tasks";
    $body->set('yesno', $yesno);
    $sharedtasks = get_sharedtasks();
    if ($sharedtasks) {
      $body->set('sharedtasks', $sharedtasks);
    }
    break;
  case 2: // View Task Data
    $body = new Template("templates/sharedtasks/sharedtask.view.tmpl.php");
    $breadcrumbs .= " >> View Shared Task";
    $body->set('yesno', $yesno);
    $body->set('activitytypes', $activitytypes);
    $task_data = get_sharedtask($_GET['id']);
    if ($task_data) {
      $body->set('task_data', $task_data);
    }
    break;
  case 3: // View Completed Tasks
    $body = new Template("templates/sharedtasks/sharedtasks.view.tmpl.php");
    $breadcrumbs .= " >> Completed Shared Tasks";
    $body->set('yesno', $yesno);
    $sharedtasks = get_completed_sharedtasks();
    if ($sharedtasks) {
      $body->set('sharedtasks', $sharedtasks);
    }
    break;
  case 4: // View Completed Task Data
    $body = new Template("templates/sharedtasks/sharedtask.view.tmpl.php");
    $breadcrumbs .= " >> View Shared Task";
    $body->set('yesno', $yesno);
    $body->set('activitytypes', $activitytypes);
    $task_data = get_completed_sharedtask($_GET['id']);
    if ($task_data) {
      $body->set('task_data', $task_data);
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
  global $mysql, $mysql_content_db;
  $task_data = array();

  $query = "SELECT * FROM shared_tasks WHERE id=$id";
  $task_data['task'] = $mysql->query_assoc($query);

  $query = "SELECT * FROM shared_task_members WHERE shared_task_id=$id";
  $task_data['members'] = $mysql->query_mult_assoc($query);

  $query = "SELECT * FROM shared_task_dynamic_zones WHERE shared_task_id=$id LIMIT 1";
  $task_data['dynamic_zone'] = $mysql->query_assoc($query);

  $query = "SELECT * FROM shared_task_activity_state WHERE shared_task_id=$id";
  $task_data['activities'] = $mysql->query_mult_assoc($query);

  foreach ($task_data['activities'] as $activity) {
    $query = "SELECT taskid, activitytype, goalcount FROM task_activities WHERE taskid=" . $task_data['task']['task_id'] . " ORDER BY step";
    $results = $mysql_content_db->query_mult_assoc($query);
  }
  if ($results) {
    $task_data['activity_types'] = $results;
  }

  if ($task_data) {
    return $task_data;
  }
  else {
    return null;
  }
}

function get_completed_sharedtasks() {
  global $mysql;

  $query = "SELECT * FROM completed_shared_tasks";
  $results = $mysql->query_mult_assoc($query);

  if ($results) {
    return $results;
  }
  else {
    return null;
  }
}

function get_completed_sharedtask($id) {
  global $mysql, $mysql_content_db;
  $task_data = array();

  $query = "SELECT * FROM completed_shared_tasks WHERE id=$id";
  $task_data['task'] = $mysql->query_assoc($query);

  $query = "SELECT * FROM completed_shared_task_members WHERE shared_task_id=$id";
  $task_data['members'] = $mysql->query_mult_assoc($query);

  $query = "SELECT * FROM completed_shared_task_activity_state WHERE shared_task_id=$id";
  $task_data['activities'] = $mysql->query_mult_assoc($query);

  foreach ($task_data['activities'] as $activity) {
    $query = "SELECT taskid, activitytype, goalcount FROM task_activities WHERE taskid=" . $task_data['task']['task_id'] . " ORDER BY step";
    $results = $mysql_content_db->query_mult_assoc($query);
  }
  if ($results) {
    $task_data['activity_types'] = $results;
  }

  if ($task_data) {
    return $task_data;
  }
  else {
    return null;
  }
}

?>