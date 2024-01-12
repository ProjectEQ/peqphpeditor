<?php

$task_types = array(
  0 => "Task",
  1 => "Shared",
  2 => "Quest"
  //3 => "E" Expedition?
);

$duration_codes = array(
  0 => "None",
  1 => "Short",
  2 => "Medium",
  3 => "Long"
);

$rewardmethods = array(
  0 => "Single ID",
  1 => "Goallist",
  2 => "Script"
);

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

$default_page = 1;
$default_size = 50;
$default_sort = 1;

$columns = array(
  1 => 'charid',
  2 => 'taskid'
);

switch ($action) {
  case 0:  // View task info
    if (!$tskid) {
      $body = new Template("templates/tasks/tasks.default.tmpl.php");
    }
    else {
      $body = new Template("templates/tasks/tasks.tmpl.php");
      $body->set('rewardmethods', $rewardmethods);
      $body->set('yesno', $yesno);
      $body->set('activitytypes', $activitytypes);
      $body->set('tsksetsid', tasksets_id());
      $body->set('task_types', $task_types);
      $body->set('duration_codes', $duration_codes);
      $vars = tasks_info();
      $activity = get_activities();
      if ($vars) {
        foreach ($vars as $key=>$value) {
          $body->set($key, $value);
        }
        $body->set('reward_point_types', get_reward_point_types());
      }
      if ($activity) {
        foreach ($activity as $key=>$value) {
          $body->set($key, $value);
        }
      }	
    }
    break;
  case 1:  // Edit task info
    check_authorization();
    $body = new Template("templates/tasks/tasks.edit.tmpl.php");
    $body->set('rewardmethods', $rewardmethods);
    $body->set('yesno', $yesno);
    $body->set('zoneids', $zoneids);
    $body->set('task_types', $task_types);
    $body->set('duration_codes', $duration_codes);
    $body->set('reward_point_types', get_reward_point_types());
    $vars = tasks_info();
    if ($vars) {
      foreach ($vars as $key=>$value) {
        $body->set($key, $value);
      }
    }	
    break;
  case 2: // Update tasks
    check_authorization();
    update_tasks();
    $tskid = $_POST['id'];
    header("Location: index.php?editor=tasks&tskid=$tskid");
    exit;
  case 3: // Delete tasks
    check_authorization();
    delete_tasks();
    header("Location: index.php?editor=tasks");
    exit;
  case 4: // Add task
    check_authorization();
    $body = new Template("templates/tasks/tasks.add.tmpl.php");
    $body->set('rewardmethods', $rewardmethods);
    $body->set('zoneids', $zoneids);
    $body->set('suggestid', suggest_tasks_id());
    $body->set('task_types', $task_types);
    $body->set('duration_codes', $duration_codes);
    $body->set('reward_point_types', get_reward_point_types());
    break;
  case 5: // Insert task
    check_authorization();
    add_tasks();
    $tskid = $_POST['id'];
    header("Location: index.php?editor=tasks&tskid=$tskid");
    exit;
  case 6:  // Edit activity info
    check_authorization();
    $body = new Template("templates/tasks/activity.edit.tmpl.php");
    $body->set('rewardmethods', $rewardmethods);
    $body->set('activitytypes', $activitytypes);
    $body->set('yesno', $yesno);
    $body->set('zoneids', $zoneids);
    $vars = activity_info();
    if ($vars) {
      foreach ($vars as $key=>$value) {
        $body->set($key, $value);
      }
    }	
    break;
  case 7: // Update activity
    check_authorization();
    update_activity();
    $tskid = $_POST['taskid'];
    header("Location: index.php?editor=tasks&tskid=$tskid");
    exit;
  case 8: // Delete activity
    check_authorization();
    delete_activity();
    $tskid = $_GET['tskid'];
    header("Location: index.php?editor=tasks&tskid=$tskid");
    exit;
  case 9: // Add activity
    check_authorization();
    $body = new Template("templates/tasks/activity.add.tmpl.php");
    $body->set('tskid', $_GET['tskid']);
    $body->set('rewardmethods', $rewardmethods);
    $body->set('activitytypes', $activitytypes);
    $body->set('zoneids', $zoneids);
    $body->set('suggestid', suggest_activity_id());
    $body->set('suggeststep', suggest_step());
    break;
  case 10: // Insert activity
    check_authorization();
    add_activity();
    $tskid = $_POST['taskid'];
    header("Location: index.php?editor=tasks&tskid=$tskid");
    exit;
  case 17:  // View proximity info
    $body = new Template("templates/tasks/proximity.tmpl.php");
    $body->set('tskid', $_GET['tskid']);
    $body->set('eid', $_GET['eid']);
    $body->set('aid', $_GET['aid']);
    $vars = get_proximity();
    if ($vars) {
      foreach ($vars as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
  case 18:  // Edit proximity info
    check_authorization();
    $body = new Template("templates/tasks/proximity.edit.tmpl.php");
    $body->set('zoneids', $zoneids);
    $body->set('tskid', $_GET['tskid']);
    $vars = proximity_info();
    if ($vars) {
      foreach ($vars as $key=>$value) {
        $body->set($key, $value);
      }
    }	
    break;
  case 19: // Update proximity
    check_authorization();
    update_proximity();
    $tskid = $_POST['tskid'];
    $exploreid = $_POST['exploreid'];
    header("Location: index.php?editor=tasks&tskid=$tskid&eid=$exploreid&action=17");
    exit;
  case 20: // Delete proximity
    check_authorization();
    delete_proximity();
    $tskid = $_GET['tskid'];
    header("Location: index.php?editor=tasks&tskid=$tskid");
    exit;
  case 21: // Get proximity ID
    check_authorization();
    $body = new Template("templates/tasks/proximity.add.tmpl.php");
    $body->set('zoneids', $zoneids);
    $body->set('tskid', $_GET['tskid']);
    $body->set('aid', $_GET['aid']);
    $body->set('atype', $_GET['atype']);
    $body->set('suggestid', suggest_explore_id());
    break;
  case 22: // Add proximity
    check_authorization();
    add_proximity();
    $tskid = $_POST['tskid'];
    $eid = $_POST['exploreid'];
    header("Location: index.php?editor=tasks&tskid=$tskid&eid=$eid&action=17");
    exit;
  case 29:  // View Task Set info
    $body = new Template("templates/tasks/tasksets.tmpl.php");
    $body->set('tskid', $_GET['tskid']);
    $body->set('tsksetsid', tasksets_id());
    $vars = get_taskset();
    if ($vars) {
      foreach ($vars as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
  case 30: // Add Task Set
    check_authorization();
    $body = new Template("templates/tasks/taskset.add.tmpl.php");
    $body->set('suggested_id', suggest_taskset_id());
    $body->set('tsksetsid', tasksets_id());
    $body->set('tskid', $_GET['tskid']);
    $tsksetid = $_GET['tsksetid'];
    if (isset($_GET['tsksetid']) && $_GET['tsksetid'] != ""){
      $vars = taskset_info();
      if ($vars) {
        foreach ($vars as $key=>$value) {
          $body->set($key, $value);
        }
      } 
    } 	
    break;
  case 31:  // Update Task Set
    check_authorization();
    add_taskset();
    $tskid = $_POST['taskid'];
    $tsksetid = $_POST['id'];
    header("Location: index.php?editor=tasks&tskid=$tskid&tsksetid=$tsksetid&action=29");
    exit;
  case 32: // Delete Task Entry
    check_authorization();
    delete_taskentry();
    $tskid = $_GET['tskid'];
    $tsksetid = $_GET['tsksetid'];
    header("Location: index.php?editor=tasks&tskid=$tskid&tsksetid=$tsksetid&action=29");
    exit;
  case 33: // Delete Task Set
    check_authorization();
    delete_taskset();
    $tskid = $_GET['tskid'];
    header("Location: index.php?editor=tasks&tskid=$tskid");
    exit;
  case 34: // Search tasks
    check_authorization();
    $body = new Template("templates/tasks/tasks.searchresults.tmpl.php");
    $results = search_tasks();
    $body->set("results", $results);
    break;
  case 35: // View Active Tasks
    check_authorization();
    $breadcrumbs .= " >> Active Tasks";
    $curr_page = (isset($_GET['page'])) ? $_GET['page'] : $default_page;
    $curr_size = (isset($_GET['size'])) ? $_GET['size'] : $default_size;
    $curr_sort = (isset($_GET['sort'])) ? $columns[$_GET['sort']] : $columns[$default_sort];
    if (isset($_GET['filter']) && $_GET['filter'] == 'on') {
      $filter = build_filter();
    }
    $body = new Template("templates/tasks/tasks.activetasks.tmpl.php");
    $page_stats = getPageInfo("character_tasks", FALSE, $curr_page, $curr_size, ((isset($_GET['sort'])) ? $_GET['sort'] : null), ((isset($filter)) ? $filter['sql'] : null));
    if (isset($filter)) {
      $body->set('filter', $filter);
    }
    if ($page_stats['page']) {
      $active_tasks = getActiveTasks($page_stats['page'], $curr_size, $curr_sort, ((isset($filter)) ? $filter['sql'] : null));
    }
    if (isset($active_tasks)) {
      $body->set('active_tasks', $active_tasks);
      foreach ($page_stats as $key=>$value) {
        $body->set($key, $value);
      }
      $body->set('yesno', $yesno);
    }
    else {
      $body->set('page', 0);
      $body->set('pages', 0);
    }
    break;
  case 36: // View Completed Tasks
    check_authorization();
    $breadcrumbs .= " >> Completed Tasks";
    $curr_page = (isset($_GET['page'])) ? $_GET['page'] : $default_page;
    $curr_size = (isset($_GET['size'])) ? $_GET['size'] : $default_size;
    $curr_sort = (isset($_GET['sort'])) ? $columns[$_GET['sort']] : $columns[$default_sort];
    if (isset($_GET['filter']) && $_GET['filter'] == 'on') {
      $filter = build_filter();
    }
    $body = new Template("templates/tasks/tasks.completedtasks.tmpl.php");
    $page_stats = getPageInfo("completed_tasks", FALSE, $curr_page, $curr_size, ((isset($_GET['sort'])) ? $_GET['sort'] : null), ((isset($filter)) ? $filter['sql'] : null));
    if (isset($filter)) {
      $body->set('filter', $filter);
    }
    if ($page_stats['page']) {
      $completed_tasks = getCompletedTasks($page_stats['page'], $curr_size, $curr_sort, ((isset($filter)) ? $filter['sql'] : null));
    }
    if (isset($completed_tasks)) {
      $body->set('completed_tasks', $completed_tasks);
      foreach ($page_stats as $key=>$value) {
        $body->set($key, $value);
      }
    }
    else {
      $body->set('page', 0);
      $body->set('pages', 0);
    }
    break;
  case 37: // Delete Active Task
    check_authorization();
    delete_active_task();
    $return_address = $_SERVER['HTTP_REFERER'];
    header("Location: $return_address");
    exit;
  case 38: // Delete Completed Task
    check_authorization();
    delete_completed_task();
    $return_address = $_SERVER['HTTP_REFERER'];
    header("Location: $return_address");
    exit;
}

function tasks_info() {
  global $mysql_content_db, $tskid;
  
  $query = "SELECT * FROM tasks WHERE id=$tskid";
  $result = $mysql_content_db->query_assoc($query);
  
  return $result;
}

function activity_info() {
  global $mysql_content_db, $tskid;
  
  $activityid = $_GET['activityid'];

  $query = "SELECT * FROM task_activities WHERE taskid=$tskid AND activityid=\"$activityid\"";
  $result = $mysql_content_db->query_assoc($query);
  
  return $result;
}

function taskset_info() {
  global $mysql_content_db;
  
  $id = $_GET['tsksetid'];
  $taskid = $_GET['tskid'];

  $query = "SELECT * FROM tasksets WHERE id=$id and taskid=$taskid";
  $result = $mysql_content_db->query_assoc($query);
  
  return $result;
}

function tasksets_id() {
  global $mysql_content_db, $tskid;
  
  $query = "SELECT id AS tsksetid FROM tasksets WHERE taskid=$tskid";
  $result = $mysql_content_db->query_assoc($query);
  
  if ($result) {
    return ($result['tsksetid']);
  }
  else {
    return null;
  }
}

function get_activities() {
  global $mysql_content_db, $tskid;
  $array = array();
  
  $query = "SELECT * FROM task_activities WHERE taskid=\"$tskid\"";
  $result = $mysql_content_db->query_mult_assoc($query);
  if ($result) {
    foreach ($result as $result) {
      $array['activity'][$result['activityid']] = array("taskid"=>$result['taskid'], "activityid"=>$result['activityid'], "req_activity_id"=>$result['req_activity_id'], "step"=>$result['step'], "activitytype"=>$result['activitytype'], "target_name"=>$result['target_name'], "goalmethod"=>$result['goalmethod'], "goalcount"=>$result['goalcount'], "description_override"=>$result['description_override'], "npc_match_list"=>$result['npc_match_list'], "item_id_list"=>$result['item_id_list'], "item_list"=>$result['item_list'], "dz_switch_id"=>$result['dz_switch_id'], "min_x"=>$result['min_x'], "min_y"=>$result['min_y'], "min_z"=>$result['min_z'], "max_x"=>$result['max_x'], "max_y"=>$result['max_y'], "max_z"=>$result['max_z'], "skill_list"=>$result['skill_list'], "spell_list"=>$result['spell_list'], "zones"=>$result['zones'], "zone_version"=>$result['zone_version'], "optional"=>$result['optional']);
    }
  }
  return $array;
}

function proximity_info() {
  global $mysql_content_db;
  
  $exploreid = $_GET['eid'];

  $query = "SELECT * FROM proximities WHERE exploreid=\"$exploreid\"";
  $result = $mysql_content_db->query_assoc($query);
  
  return $result;
}

function get_proximity() {
  global $mysql_content_db;
  $array = array();
  
  $exploreid = $_GET['eid'];

  $query = "SELECT * FROM proximities WHERE exploreid=\"$exploreid\"";
  $result = $mysql_content_db->query_mult_assoc($query);
  if ($result) {
    foreach ($result as $result) {
      $array['proximity'][$result['maxx']] = array("exploreid"=>$result['exploreid'], "zoneid"=>$result['zoneid'], "minx"=>$result['minx'], "miny"=>$result['miny'], "minz"=>$result['minz'], "maxx"=>$result['maxx'], "maxy"=>$result['maxy'], "maxz"=>$result['maxz']);
    }
  }
  return $array;
}

function get_taskset() {
  global $mysql_content_db;
  $array = array();
  
  $id = $_GET['tsksetid'];

  $query = "SELECT * FROM tasksets WHERE id=\"$id\"";
  $result = $mysql_content_db->query_mult_assoc($query);
  if ($result) {
    foreach ($result as $result) {
      $array['tasksets'][$result['taskid']] = array("id"=>$result['id'], "taskid"=>$result['taskid']);
    }
  }
  return $array;
}

function update_tasks() {
  global $mysql_content_db;

  $id = $_POST['id'];
  $type = $_POST['type'];
  $duration = $_POST['duration'];
  $duration_code = $_POST['duration_code'];
  $title = mysqli_real_escape_string($mysql_content_db, $_POST['title']);
  $description = mysqli_real_escape_string($mysql_content_db, $_POST['description']); 
  $reward_text = mysqli_real_escape_string($mysql_content_db, $_POST['reward_text']);
  $completion_emote = mysqli_real_escape_string($mysql_content_db, $_POST['completion_emote']);
  $replay_timer_group = $_POST['replay_timer_group'];
  $replay_timer_seconds = $_POST['replay_timer_seconds'];
  $request_timer_group = $_POST['request_timer_group'];
  $request_timer_seconds = $_POST['request_timer_seconds'];
  $dz_template_id = $_POST['dz_template_id'];
  $lock_activity_id = $_POST['lock_activity_id'];
  $reward_id_list = $_POST['reward_id_list'];
  $cash_reward = $_POST['cash_reward'];
  $exp_reward = $_POST['exp_reward'];
  $reward_method = $_POST['reward_method'];
  $reward_points = $_POST['reward_points'];
  $reward_point_type = $_POST['reward_point_type'];
  $min_level = $_POST['min_level'];
  $max_level = $_POST['max_level'];
  $level_spread = $_POST['level_spread'];
  $min_players = $_POST['min_players'];
  $max_players = $_POST['max_players'];
  $repeatable = $_POST['repeatable'];
  $faction_reward = $_POST['faction_reward'];
  $faction_amount = $_POST['faction_amount'];
  $enabled = $_POST['enabled'];

  $query = "UPDATE tasks SET type=\"$type\", duration=\"$duration\", duration_code=\"$duration_code\", title=\"$title\", description=\"$description\", reward_text=\"$reward_text\", reward_id_list=\"$reward_id_list\", cash_reward=\"$cash_reward\", exp_reward=\"$exp_reward\", reward_method=\"$reward_method\", reward_points=\"$reward_points\", reward_point_type=\"$reward_point_type\", min_level=\"$min_level\", max_level=\"$max_level\", level_spread=\"$level_spread\", min_players=\"$min_players\", max_players=\"$max_players\", repeatable=\"$repeatable\", faction_reward=\"$faction_reward\", completion_emote=\"$completion_emote\", replay_timer_group=\"$replay_timer_group\", replay_timer_seconds=\"$replay_timer_seconds\", request_timer_group=\"$request_timer_group\", request_timer_seconds=\"$request_timer_seconds\", dz_template_id=\"$dz_template_id\", lock_activity_id=\"$lock_activity_id\", faction_amount=\"$faction_amount\", enabled=\"$enabled\" WHERE id=\"$id\"";
  $mysql_content_db->query_no_result($query);
}

function update_activity() {
  global $mysql_content_db;

  $taskid = $_POST['taskid'];
  $activityid = $_POST['activityid'];
  $newactivityid = $_POST['newactivityid'];
  $req_activity_id = $_POST['req_activity_id'];
  $step = $_POST['step'];
  $activitytype = $_POST['activitytype']; 
  $target_name = mysqli_real_escape_string($mysql_content_db, $_POST['target_name']);
  $goalmethod = $_POST['goalmethod']; 
  $goalcount = $_POST['goalcount'];
  $description_override = mysqli_real_escape_string($mysql_content_db, $_POST['description_override']);
  $npc_match_list = mysqli_real_escape_string($mysql_content_db, $_POST['npc_match_list']);
  $item_id_list = mysqli_real_escape_string($mysql_content_db, $_POST['item_id_list']);
  $item_list = mysqli_real_escape_string($mysql_content_db, $_POST['item_list']);
  $dz_switch_id = $_POST['dz_switch_id'];
  $min_x = $_POST['min_x'];
  $min_y = $_POST['min_y'];
  $min_z = $_POST['min_z'];
  $max_x = $_POST['max_x'];
  $max_y = $_POST['max_y'];
  $max_z = $_POST['max_z'];
  $skill_list = mysqli_real_escape_string($mysql_content_db, $_POST['skill_list']);
  $spell_list = mysqli_real_escape_string($mysql_content_db, $_POST['spell_list']);
  $zones = mysqli_real_escape_string($mysql_content_db, $_POST['zones']);
  $zone_version = $_POST['zone_version'];
  $optional = $_POST['optional'];
  $list_group = $_POST['list_group'];

  $query = "DELETE FROM task_activities WHERE taskid=\"$taskid\" AND activityid=\"$activityid\"";
  $mysql_content_db->query_no_result($query);

  $query = "INSERT INTO task_activities SET taskid=\"$taskid\", activityid=\"$newactivityid\", req_activity_id=\"$req_activity_id\", step=\"$step\", activitytype=\"$activitytype\", target_name=\"$target_name\", goalmethod=\"$goalmethod\", goalcount=\"$goalcount\", description_override=\"$description_override\", npc_match_list=\"$npc_match_list\", item_id_list=\"$item_id_list\", item_list=\"$item_list\", dz_switch_id=\"$dz_switch_id\", min_x=\"$min_x\", min_y=\"$min_y\", min_z=\"$min_z\", max_x=\"$max_x\", max_y=\"$max_y\", max_z=\"$max_z\", skill_list=\"$skill_list\", spell_list=\"$spell_list\", zones=\"$zones\", zone_version=\"$zone_version\", optional=\"$optional\", list_group=\"$list_group\"";
  $mysql_content_db->query_no_result($query);
}

function update_proximity() {
  global $mysql_content_db;

  $exploreid = $_POST['exploreid'];
  $zoneid = $_POST['zoneid'];
  $minx = $_POST['minx']; 
  $miny = $_POST['miny'];
  $minz = $_POST['minz'];
  $maxx = $_POST['maxx'];
  $maxy = $_POST['maxy'];
  $maxz = $_POST['maxz']; 

  $query = "UPDATE proximities SET zoneid=\"$zoneid\", minx=\"$minx\", miny=\"$miny\", minz=\"$minz\", maxx=\"$maxx\", maxy=\"$maxy\", maxz=\"$maxz\" WHERE exploreid=\"$exploreid\"";
  $mysql_content_db->query_no_result($query);
}

function delete_tasks() {
  global $mysql_content_db, $tskid;

  $query = "DELETE FROM tasks WHERE id=\"$tskid\"";
  $mysql_content_db->query_no_result($query);

  $query = "DELETE FROM task_activities WHERE taskid=\"$tskid\"";
  $mysql_content_db->query_no_result($query);
}

function delete_taskentry() {
  global $mysql_content_db;
  
  $taskid = $_GET['entry'];
  $id = $_GET['tsksetid'];

  $query = "DELETE FROM tasksets WHERE id=\"$id\" AND taskid=\"$taskid\"";
  $mysql_content_db->query_no_result($query);
}

function delete_taskset() {
  global $mysql_content_db;
  
  $id = $_GET['tsksetid'];

  $query = "DELETE FROM tasksets WHERE id=\"$id\"";
  $mysql_content_db->query_no_result($query);
}

function delete_proximity() {
  global $mysql_content_db;
  
  $eid = $_GET['eid'];
  $tskid = $_GET['tskid'];
  $aid = $_GET['aid'];

  $query = "DELETE FROM proximities WHERE exploreid=\"$eid\"";
  $mysql_content_db->query_no_result($query);

  $query = "UPDATE task_activities SET goalid=0 WHERE taskid=\"$tskid\" AND activityid=\"$aid\"";
  $mysql_content_db->query_no_result($query);
}

function delete_activity() {
  global $mysql_content_db, $tskid;

  $activityid = $_GET['activityid'];

  $query = "DELETE FROM task_activities WHERE taskid=\"$tskid\" AND activityid=\"$activityid\"";
  $mysql_content_db->query_no_result($query);
}

function suggest_tasks_id() {
  global $mysql_content_db;

  $query = "SELECT MAX(id) AS tskid FROM tasks";
  $result = $mysql_content_db->query_assoc($query);
  
  return ($result['tskid'] + 1);
}

function suggest_activity_id() {
  global $mysql_content_db, $tskid;

  $query = "SELECT MAX(activityid) AS aid FROM task_activities WHERE taskid=\"$tskid\"";
  $result = $mysql_content_db->query_assoc($query);

  if ($result['aid'] == NULL) {
    return 0;
  }
  else {
    return $result['aid'] + 1;
  }
}

function suggest_explore_id() {
  global $mysql_content_db;

  $query = "SELECT MAX(exploreid) AS eid FROM proximities";
  $result = $mysql_content_db->query_assoc($query);
  
  return ($result['eid'] + 1);
}

function suggest_taskset_id() {
  global $mysql_content_db;
  $query = "SELECT MAX(id) AS tasksetid FROM tasksets";
  $result = $mysql_content_db->query_assoc($query);
  return ($result['tasksetid'] + 1);
}

function suggest_step() {
  global $mysql_content_db, $tskid;

  $query = "SELECT MAX(step) AS step FROM task_activities WHERE taskid=\"$tskid\"";
  $result = $mysql_content_db->query_assoc($query);
  
  if ($result['step'] == NULL) {
    return 1;
  }
  else {
    return $result['step'] + 1;
  }
}

function add_tasks() {
  global $mysql_content_db;

  $id = $_POST['id'];
  $type = $_POST['type'];
  $duration = $_POST['duration'];
  $duration_code = $_POST['duration_code'];
  $title = mysqli_real_escape_string($mysql_content_db, $_POST['title']);
  $description = mysqli_real_escape_string($mysql_content_db, $_POST['description']); 
  $reward_text = mysqli_real_escape_string($mysql_content_db, $_POST['reward_text']);
  $completion_emote = mysqli_real_escape_string($mysql_content_db, $_POST['completion_emote']);
  $replay_timer_group = $_POST['replay_timer_group'];
  $replay_timer_seconds = $_POST['replay_timer_seconds'];
  $request_timer_group = $_POST['request_timer_group'];
  $request_timer_seconds = $_POST['request_timer_seconds'];
  $dz_template_id = $_POST['dz_template_id'];
  $lock_activity_id = $_POST['lock_activity_id'];
  $reward_id_list = $_POST['reward_id_list'];
  $cash_reward = $_POST['cash_reward'];
  $exp_reward = $_POST['exp_reward'];
  $reward_method = $_POST['reward_method'];
  $reward_points = $_POST['reward_points'];
  $reward_point_type = $_POST['reward_point_type'];
  $min_level = $_POST['min_level'];
  $max_level = $_POST['max_level'];
  $level_spread = $_POST['level_spread'];
  $min_players = $_POST['min_players'];
  $max_players = $_POST['max_players'];
  $repeatable = $_POST['repeatable'];
  $faction_reward = $_POST['faction_reward'];
  $faction_amount = $_POST['faction_amount'];
  $enabled = $_POST['enabled'];

  $query = "INSERT INTO tasks SET id=\"$id\", type=\"$type\", duration=\"$duration\", duration_code=\"$duration_code\", title=\"$title\", description=\"$description\", reward_text=\"$reward_text\", reward_id_list=\"$reward_id_list\", cash_reward=\"$cash_reward\", exp_reward=\"$exp_reward\", reward_method=\"$reward_method\", reward_points=\"$reward_points\", reward_point_type=\"$reward_point_type\", min_level=\"$min_level\", max_level=\"$max_level\", level_spread=\"$level_spread\", min_players=\"$min_players\", max_players=\"$max_players\", repeatable=\"$repeatable\", faction_reward=\"$faction_reward\", completion_emote=\"$completion_emote\", replay_timer_group=\"$replay_timer_group\", replay_timer_seconds=\"$replay_timer_seconds\", request_timer_group=\"$request_timer_group\", request_timer_seconds=\"$request_timer_seconds\", dz_template_id=\"$dz_template_id\", lock_activity_id=\"$lock_activity_id\", faction_amount=\"$faction_amount\", enabled=\"$enabled\"";
  $mysql_content_db->query_no_result($query);
}

function add_activity() {
  global $mysql_content_db;

  $taskid = $_POST['taskid'];
  $activityid = $_POST['activityid'];
  $req_activity_id = $_POST['req_activity_id'];
  $step = $_POST['step'];
  $activitytype = $_POST['activitytype']; 
  $target_name = mysqli_real_escape_string($mysql_content_db, $_POST['target_name']);
  $goalmethod = $_POST['goalmethod']; 
  $goalcount = $_POST['goalcount'];
  $description_override = mysqli_real_escape_string($mysql_content_db, $_POST['description_override']);
  $npc_match_list = mysqli_real_escape_string($mysql_content_db, $_POST['npc_match_list']);
  $item_id_list = mysqli_real_escape_string($mysql_content_db, $_POST['item_id_list']);
  $item_list = mysqli_real_escape_string($mysql_content_db, $_POST['item_list']);
  $dz_switch_id = $_POST['dz_switch_id'];
  $min_x = $_POST['min_x'];
  $min_y = $_POST['min_y'];
  $min_z = $_POST['min_z'];
  $max_x = $_POST['max_x'];
  $max_y = $_POST['max_y'];
  $max_z = $_POST['max_z'];
  $skill_list = mysqli_real_escape_string($mysql_content_db, $_POST['skill_list']);
  $spell_list = mysqli_real_escape_string($mysql_content_db, $_POST['spell_list']);
  $zones = mysqli_real_escape_string($mysql_content_db, $_POST['zones']);
  $zone_version = $_POST['zone_version'];
  $zoneid = $_POST['zoneid'];
  $optional = $_POST['optional'];
  $list_group = $_POST['list_group'];

  $query = "INSERT INTO task_activities SET taskid=\"$taskid\", activityid=\"$activityid\", req_activity_id=\"$req_activity_id\", step=\"$step\", activitytype=\"$activitytype\", target_name=\"$target_name\", goalmethod=\"$goalmethod\", goalcount=\"$goalcount\", description_override=\"$description_override\", npc_match_list=\"$npc_match_list\", item_id_list=\"$item_id_list\", item_list=\"$item_list\", dz_switch_id=\"$dz_switch_id\", min_x=\"$min_x\", min_y=\"$min_y\", min_z=\"$min_z\", max_x=\"$max_x\", max_y=\"$max_y\", max_z=\"$max_z\", skill_list=\"$skill_list\", spell_list=\"$spell_list\", zones=\"$zones\", zone_version=\"$zone_version\", optional=\"$optional\", list_group=\"$list_group\"";
  $mysql_content_db->query_no_result($query);
}

function add_proximity() {
  global $mysql_content_db;

  $tskid = $_POST['tskid'];
  $aid = $_POST['aid'];
  $exploreid = $_POST['exploreid'];
  $zoneid = $_POST['zoneid'];
  $minx = $_POST['minx']; 
  $miny = $_POST['miny'];
  $minz = $_POST['minz'];
  $maxx = $_POST['maxx'];
  $maxy = $_POST['maxy'];
  $maxz = $_POST['maxz']; 

  $query = "INSERT INTO proximities SET exploreid=\"$exploreid\", zoneid=\"$zoneid\", minx=\"$minx\", miny=\"$miny\", minz=\"$minz\", maxx=\"$maxx\", maxy=\"$maxy\", maxz=\"$maxz\"";
  $mysql_content_db->query_no_result($query);

  $query = "UPDATE task_activities SET goalid=\"$exploreid\" WHERE taskid=\"$tskid\" AND activityid=\"$aid\"";
  $mysql_content_db->query_no_result($query);
}

function add_taskset() {
  check_authorization();
  global $mysql_content_db;
  $id = $_POST['id'];
  $taskid = $_POST['taskid'];

  $query = "INSERT INTO tasksets VALUES ($id, $taskid)";
  $mysql_content_db->query_no_result($query);
}

function search_tasks() {
  global $mysql_content_db;
  $search = $_GET['search'];

  $query = "SELECT id, title FROM tasks WHERE title RLIKE \"$search\"";
  $results = $mysql_content_db->query_mult_assoc($query);
  return $results;
}

function getActiveTasks($page_number, $results_per_page, $sort_by, $where = "") {
  global $mysql;
  $limit = ($page_number - 1) * $results_per_page . "," . $results_per_page;

  $query = "SELECT * FROM character_tasks";
  if ($where) {
    $query .= " WHERE $where";
  }
  $query .= " ORDER BY $sort_by LIMIT $limit";
  $results = $mysql->query_mult_assoc($query);

  return $results;
}

function getCompletedTasks($page_number, $results_per_page, $sort_by, $where = "") {
  global $mysql;
  $limit = ($page_number - 1) * $results_per_page . "," . $results_per_page;

  $query = "SELECT * FROM completed_tasks";
  if ($where) {
    $query .= " WHERE $where";
  }
  $query .= " ORDER BY $sort_by LIMIT $limit";
  $results = $mysql->query_mult_assoc($query);

  return $results;
}

function delete_active_task() {
  global $mysql;
  $taskid = $_GET['tskid'];
  $charid = $_GET['charid'];

  $query = "DELETE FROM character_tasks WHERE taskid=\"$taskid\" AND charid=\"$charid\"";
  $mysql->query_no_result($query);
}

function delete_completed_task() {
  global $mysql;
  $taskid = $_GET['tskid'];
  $charid = $_GET['charid'];

  $query = "DELETE FROM completed_tasks WHERE taskid=\"$taskid\" AND charid=\"$charid\"";
  $mysql->query_no_result($query);
}

function build_filter() {
  global $mysql, $mysql_content_db;
  $filter1 = $_GET['filter1'];
  $filter2 = $_GET['filter2'];
  $filter_final = array('sql'=>'');

  if ($filter1) { // Filter by task title
    $query = "SELECT id FROM tasks WHERE title LIKE \"%$filter1%\"";
    $results = $mysql_content_db->query_mult_assoc($query);
    $filter_title = "taskid IN(";
    if ($results) {
      foreach ($results as $result) {
        $filter_title .= $result['id'] . ",";
      }
      $filter_title = rtrim($filter_title, ",");
    }
    else {
      $filter_title .= "NULL";
    }
    $filter_title .= ")";
    $filter_final['sql'] = $filter_title;
  }
  if ($filter2) { // Filter by character
    $query = "SELECT id FROM character_data WHERE name LIKE \"%$filter2%\"";
    $results = $mysql->query_mult_assoc($query);
    $filter_charid = "charid IN (";
    if ($results) {
      foreach ($results as $result) {
        $filter_charid .= $result['id'] . ",";
      }
      $filter_charid = rtrim($filter_charid, ",");
    }
    else {
      $filter_charid .= "NULL";
    }
    $filter_charid .= ")";
    if ($filter_final['sql']) {
      $filter_final['sql'] .= " AND ";
    }
    $filter_final['sql'] .= $filter_charid;
  }

  $filter_final['url'] = "&filter=on&filter1=$filter1&filter2=$filter2";
  $filter_final['status'] = "on";
  $filter_final['filter1'] = $filter1;
  $filter_final['filter2'] = $filter2;

  return $filter_final;
}

function get_reward_point_types() {
  global $mysql_content_db;

  $query = "SELECT ac.id AS id, i.name AS name FROM alternate_currency ac LEFT JOIN items i ON ac.item_id = i.id";
  $results = $mysql_content_db->query_mult_assoc($query);

  if ($results) {
    $results_array = array(0=>"N/A");
    foreach ($results as $result) {
      $results_array[$result['id']] = $result['name'];
    }
    return $results_array;
  }
  else {
    return null;
  }
}
?>