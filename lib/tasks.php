<?php

$rewardmethods = array(
  0 => "Single ID",
  1 => "Goallist",
  2 => "Perl"
);

$activitytypes = array(
  1   => "Deliver",
  2   => "Kill",
  3   => "Loot",
  4   => "Speak",
  5   => "Explore",
  6   => "Tradeskill",
  7   => "Fish",
  8   => "Forage",
  9   => "Use",
  10  => "Use",
  11  => "Touch",
  100 => "GiveCash",
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
      $vars = tasks_info();
      $activity = get_activities();
      if ($vars) {
        foreach ($vars as $key=>$value) {
          $body->set($key, $value);
        }
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
  case 4: // Get task ID
    check_authorization();
    $body = new Template("templates/tasks/tasks.add.tmpl.php");
    $body->set('rewardmethods', $rewardmethods);
    $body->set('zoneids', $zoneids);
    $body->set('suggestid', suggest_tasks_id());
    break;
  case 5: // Add task
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
  case 7: // Update activities
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
  case 9: // Get activity ID
    check_authorization();
    $body = new Template("templates/tasks/activity.add.tmpl.php");
    $body->set('tskid', $_GET['tskid']);
    $body->set('rewardmethods', $rewardmethods);
    $body->set('activitytypes', $activitytypes);
    $body->set('zoneids', $zoneids);
    $body->set('suggestid', suggest_activity_id());
    $body->set('suggeststep', suggest_step());
    break;
  case 10: // Add activity
    check_authorization();
    add_activity();
    $tskid = $_POST['taskid'];
    header("Location: index.php?editor=tasks&tskid=$tskid");
    exit;
  case 11:  // View goallist info
    $body = new Template("templates/tasks/goallist.tmpl.php");
    $body->set('tskid', $_GET['tskid']);
    $body->set('lid', $_GET['lid']);
    $body->set('atype', $_GET['atype']);
    $vars = get_goallist();
    if ($vars) {
      foreach ($vars as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
  case 12: // Get goallist ID
    check_authorization();
    $javascript = new Template("templates/iframes/js.tmpl.php");
    $body = new Template("templates/tasks/goallist.add.tmpl.php");
    $body->set('tskid', $_GET['tskid']);
    $body->set('suggestid', suggest_list_id());
    break;
  case 13: // Add goallist
    check_authorization();
    add_goallist();
    $tskid = $_POST['taskid'];
    $lid = $_POST['listid'];
    header("Location: index.php?editor=tasks&tskid=$tskid&lid=$lid&action=11");
    exit;
  case 14: // Delete Goallist
    check_authorization();
    delete_goallist();
    $tskid = $_GET['tskid'];
    $lid = $_GET['lid'];
    header("Location: index.php?editor=tasks&tskid=$tskid&lid=$lid&action=11");
    exit;
  case 15: // Add goallist ID
    check_authorization();
    $javascript = new Template("templates/iframes/js.tmpl.php");
    $body = new Template("templates/tasks/goallist.addid.tmpl.php");
    $body->set('tskid', $_GET['tskid']);
    $body->set('lid', $_GET['lid']);
    break;
  case 16: // Delete Goallists
    check_authorization();
    delete_goallists();
    $tskid = $_GET['tskid'];
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
  case 23: // Get goallist ID
    check_authorization();
    $javascript = new Template("templates/iframes/js.tmpl.php");
    $body = new Template("templates/tasks/goallistact.add.tmpl.php");
    $body->set('tskid', $_GET['tskid']);
    $body->set('aid', $_GET['aid']);
    $body->set('atype', $_GET['atype']);
    $body->set('suggestid', suggest_list_id());
    break;
  case 24: // Add goallist
    check_authorization();
    add_goallist_act();
    $tskid = $_POST['taskid'];
    $lid = $_POST['listid'];
    $aid = $_POST['aid'];
    $atype = $_POST['atype'];
    header("Location: index.php?editor=tasks&tskid=$tskid&lid=$lid&aid=$aid&atype=$atype&action=26");
    exit;
  case 25: // Delete Goallists
    check_authorization();
    delete_goallists_act();
    $tskid = $_GET['tskid'];
    header("Location: index.php?editor=tasks&tskid=$tskid");
    exit;
  case 26:  // View goallist info
    $body = new Template("templates/tasks/goallistact.tmpl.php");
    $body->set('tskid', $_GET['tskid']);
    $body->set('lid', $_GET['lid']);
    $body->set('aid', $_GET['aid']);
    $body->set('atype', $_GET['atype']);
    $vars = get_goallist();
    if ($vars) {
      foreach ($vars as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
  case 27: // Add goallist ID
    check_authorization();
    $javascript = new Template("templates/iframes/js.tmpl.php");
    $body = new Template("templates/tasks/goallistact.addid.tmpl.php");
    $body->set('tskid', $_GET['tskid']);
    $body->set('lid', $_GET['lid']);
    $body->set('aid', $_GET['aid']);
    $body->set('atype', $_GET['atype']);
    break;
  case 28: // Delete Goallist
    check_authorization();
    delete_goallist();
    $tskid = $_GET['tskid'];
    $lid = $_GET['lid'];
    $aid = $_GET['aid'];
    $atype = $_GET['atype'];
    header("Location: index.php?editor=tasks&tskid=$tskid&lid=$lid&aid=$aid&atype=$atype&action=26");
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
    $body = new Template("templates/tasks/tasks.activetasks.tmpl.php");
    $page_stats = getPageInfo("character_tasks", $curr_page, $curr_size, $_GET['sort']);
    if ($page_stats['page']) {
      $active_tasks = getActiveTasks($page_stats['page'], $curr_size, $curr_sort);
    }
    if ($active_tasks) {
      $body->set('active_tasks', $active_tasks);
      foreach ($page_stats as $key=>$value) {
        $body->set($key, $value);
      }
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
    $body = new Template("templates/tasks/tasks.completedtasks.tmpl.php");
    $page_stats = getPageInfo("completed_tasks", $curr_page, $curr_size, $_GET['sort']);
    if ($page_stats['page']) {
      $completed_tasks = getCompletedTasks($page_stats['page'], $curr_size, $curr_sort);
    }
    if ($completed_tasks) {
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
  global $mysql, $tskid;
  
  $query = "SELECT * FROM tasks WHERE id=$tskid";
  $result = $mysql->query_assoc($query);
  
  return $result;
}

function activity_info() {
  global $mysql, $tskid;
  
  $activityid = $_GET['activityid'];

  $query = "SELECT * FROM activities WHERE taskid=$tskid AND activityid=\"$activityid\"";
  $result = $mysql->query_assoc($query);
  
  return $result;
}

function goallist_info() {
  global $mysql;
  
  $listid = $_GET['listid'];

  $query = "SELECT * FROM goallists WHERE listid=$listid";
  $result = $mysql->query_assoc($query);
  
  return $result;
}

function taskset_info() {
  global $mysql;
  
  $id = $_GET['tsksetid'];
  $taskid = $_GET['tskid'];

  $query = "SELECT * FROM tasksets WHERE id=$id and taskid=$taskid";
  $result = $mysql->query_assoc($query);
  
  return $result;
}

function tasksets_id() {
  global $mysql, $tskid;
  
  $query = "SELECT id AS tsksetid FROM tasksets WHERE taskid=$tskid";
  $result = $mysql->query_assoc($query);
  
  if ($result) {
    return ($result['tsksetid']);
  }
  else {
    return null;
  }
}

function get_activities() {
  global $mysql, $tskid;
  $array = array();
  
  $query = "SELECT * FROM activities WHERE taskid=\"$tskid\"";
  $result = $mysql->query_mult_assoc($query);
  if ($result) {
    foreach ($result as $result) {
      $array['activity'][$result['activityid']] = array("taskid"=>$result['taskid'], "activityid"=>$result['activityid'], "step"=>$result['step'], "activitytype"=>$result['activitytype'], "text1"=>$result['text1'], "text2"=>$result['text2'], "text3"=>$result['text3'], "goalid"=>$result['goalid'], "goalmethod"=>$result['goalmethod'], "goalcount"=>$result['goalcount'], "delivertonpc"=>$result['delivertonpc'], "zoneid"=>$result['zoneid'], "optional"=>$result['optional']);
    }
  }
  return $array;
}

function get_goallist() {
  global $mysql;
  $array = array();
  
  $listid = $_GET['lid'];

  $query = "SELECT * FROM goallists WHERE listid=\"$listid\"";
  $result = $mysql->query_mult_assoc($query);
  if ($result) {
    foreach ($result as $result) {
      $array['goallist'][$result['entry']] = array("listid"=>$result['listid'], "entry"=>$result['entry']);
    }
  }
  return $array;
}

function proximity_info() {
  global $mysql;
  
  $exploreid = $_GET['eid'];

  $query = "SELECT * FROM proximities WHERE exploreid=\"$exploreid\"";
  $result = $mysql->query_assoc($query);
  
  return $result;
}

function get_proximity() {
  global $mysql;
  $array = array();
  
  $exploreid = $_GET['eid'];

  $query = "SELECT * FROM proximities WHERE exploreid=\"$exploreid\"";
  $result = $mysql->query_mult_assoc($query);
  if ($result) {
    foreach ($result as $result) {
      $array['proximity'][$result['maxx']] = array("exploreid"=>$result['exploreid'], "zoneid"=>$result['zoneid'], "minx"=>$result['minx'], "miny"=>$result['miny'], "minz"=>$result['minz'], "maxx"=>$result['maxx'], "maxy"=>$result['maxy'], "maxz"=>$result['maxz']);
    }
  }
  return $array;
}

function get_taskset() {
  global $mysql;
  $array = array();
  
  $id = $_GET['tsksetid'];

  $query = "SELECT * FROM tasksets WHERE id=\"$id\"";
  $result = $mysql->query_mult_assoc($query);
  if ($result) {
    foreach ($result as $result) {
      $array['tasksets'][$result['taskid']] = array("id"=>$result['id'], "taskid"=>$result['taskid']);
    }
  }
  return $array;
}

function update_tasks() {
  global $mysql, $mysql_class;

  $id = $_POST['id'];
  $duration = $_POST['duration'];
  if ($mysql_class == "mysqli") {
    $title = mysqli_real_escape_string($mysql, $_POST['title']);
    $description = mysqli_real_escape_string($mysql, $_POST['description']); 
    $reward = mysqli_real_escape_string($mysql, $_POST['reward']);
  }
  else {
    $title = mysql_real_escape_string($_POST['title']);
    $description = mysql_real_escape_string($_POST['description']); 
    $reward = mysql_real_escape_string($_POST['reward']);
  }
  $rewardid = $_POST['rewardid'];
  $cashreward = $_POST['cashreward'];
  $xpreward = $_POST['xpreward'];
  $rewardmethod = $_POST['rewardmethod']; 
  $startzone = $_POST['startzone'];
  $minlevel = $_POST['minlevel'];
  $maxlevel = $_POST['maxlevel'];
  $repeatable = $_POST['repeatable'];

  $query = "UPDATE tasks SET title=\"$title\", duration=\"$duration\", description=\"$description\", reward=\"$reward\", rewardid=\"$rewardid\", cashreward=\"$cashreward\", xpreward=\"$xpreward\", rewardmethod=\"$rewardmethod\", startzone=\"$startzone\", minlevel=\"$minlevel\", maxlevel=\"$maxlevel\", repeatable=\"$repeatable\" WHERE id=\"$id\"";
  $mysql->query_no_result($query);
}

function update_activity() {
  global $mysql, $mysql_class;

  $taskid = $_POST['taskid'];
  $activityid = $_POST['activityid'];
  $newactivityid = $_POST['newactivityid'];
  $step = $_POST['step'];
  $activitytype = $_POST['activitytype']; 
  if ($mysql_class == "mysqli") {
    $text1 = mysqli_real_escape_string($mysql, $_POST['text1']);
    $text2 = mysqli_real_escape_string($mysql, $_POST['text2']);
    $text3 = mysqli_real_escape_string($mysql, $_POST['text3']);
  }
  else {
    $text1 = mysql_real_escape_string($_POST['text1']);
    $text2 = mysql_real_escape_string($_POST['text2']);
    $text3 = mysql_real_escape_string($_POST['text3']);
  }
  $goalid = $_POST['goalid'];
  $goalmethod = $_POST['goalmethod']; 
  $goalcount = $_POST['goalcount'];
  $delivertonpc = $_POST['delivertonpc'];
  $zoneid = $_POST['zoneid'];
  $optional = $_POST['optional'];

  $query = "DELETE FROM activities WHERE taskid=\"$taskid\" AND activityid=\"$activityid\"";
  $mysql->query_no_result($query);

  $query = "INSERT INTO activities SET taskid=\"$taskid\", step=\"$step\", activityid=\"$newactivityid\", activitytype=\"$activitytype\", text1=\"$text1\", text2=\"$text2\", text3=\"$text3\", goalid=\"$goalid\", goalmethod=\"$goalmethod\", goalcount=\"$goalcount\", delivertonpc=\"$delivertonpc\", zoneid=\"$zoneid\", optional=\"$optional\"";
  $mysql->query_no_result($query);
}

function update_proximity() {
  global $mysql;

  $exploreid = $_POST['exploreid'];
  $zoneid = $_POST['zoneid'];
  $minx = $_POST['minx']; 
  $miny = $_POST['miny'];
  $minz = $_POST['minz'];
  $maxx = $_POST['maxx'];
  $maxy = $_POST['maxy'];
  $maxz = $_POST['maxz']; 

  $query = "UPDATE proximities SET zoneid=\"$zoneid\", minx=\"$minx\", miny=\"$miny\", minz=\"$minz\", maxx=\"$maxx\", maxy=\"$maxy\", maxz=\"$maxz\" WHERE exploreid=\"$exploreid\"";
  $mysql->query_no_result($query);
}

function delete_tasks() {
  global $mysql, $tskid;

  $query = "DELETE FROM tasks WHERE id=\"$tskid\"";
  $mysql->query_no_result($query);

  $query = "DELETE FROM activities WHERE taskid=\"$tskid\"";
  $mysql->query_no_result($query);
}

function delete_goallist() {
  global $mysql;
  
  $listid = $_GET['lid'];
  $entry = $_GET['entry'];

  $query = "DELETE FROM goallists WHERE listid=\"$listid\" AND entry=\"$entry\"";
  $mysql->query_no_result($query);

}

function delete_taskentry() {
  global $mysql;
  
  $taskid = $_GET['entry'];
  $id = $_GET['tsksetid'];

  $query = "DELETE FROM tasksets WHERE id=\"$id\" AND taskid=\"$taskid\"";
  $mysql->query_no_result($query);

}

function delete_taskset() {
  global $mysql;
  
  $id = $_GET['tsksetid'];

  $query = "DELETE FROM tasksets WHERE id=\"$id\"";
  $mysql->query_no_result($query);

}

function delete_goallists() {
  global $mysql;
  
  $listid = $_GET['lid'];
  $tskid = $_GET['tskid'];

  $query = "DELETE FROM goallists WHERE listid=\"$listid\"";
  $mysql->query_no_result($query);

  $query = "UPDATE tasks set rewardid=0 WHERE id=\"$tskid\"";
  $mysql->query_no_result($query);

}

function delete_goallists_act() {
  global $mysql;
  
  $listid = $_GET['lid'];
  $aid = $_GET['aid'];
  $tskid = $_GET['tskid'];

  $query = "DELETE FROM goallists WHERE listid=\"$listid\"";
  $mysql->query_no_result($query);

  $query = "UPDATE activities set goalid=0 WHERE taskid=\"$tskid\" AND activityid=\"$aid\"";
  $mysql->query_no_result($query);

}

function delete_proximity() {
  global $mysql;
  
  $eid = $_GET['eid'];
  $tskid = $_GET['tskid'];
  $aid = $_GET['aid'];

  $query = "DELETE FROM proximities WHERE exploreid=\"$eid\"";
  $mysql->query_no_result($query);

  $query = "UPDATE activities set goalid=0 WHERE taskid=\"$tskid\" AND activityid=\"$aid\"";
  $mysql->query_no_result($query);

}

function delete_activity() {
  global $mysql, $tskid;

  $activityid = $_GET['activityid'];

  $query = "DELETE FROM activities WHERE taskid=\"$tskid\" and activityid=\"$activityid\"";
  $mysql->query_no_result($query);
}

function suggest_tasks_id() {
  global $mysql;

  $query = "SELECT MAX(id) AS tskid FROM tasks";
  $result = $mysql->query_assoc($query);
  
  return ($result['tskid'] + 1);
}

function suggest_activity_id() {
  global $mysql, $tskid;

  $query = "SELECT MAX(activityid) as aid FROM activities WHERE taskid=\"$tskid\"";
  $result = $mysql->query_assoc($query);
  
  return ($result['aid'] + 1);
}

function suggest_list_id() {
  global $mysql;

  $query = "SELECT MAX(listid) as lid FROM goallists";
  $result = $mysql->query_assoc($query);
  
  return ($result['lid'] + 1);
}

function suggest_explore_id() {
  global $mysql;

  $query = "SELECT MAX(exploreid) as eid FROM proximities";
  $result = $mysql->query_assoc($query);
  
  return ($result['eid'] + 1);
}

function suggest_taskset_id() {
  global $mysql;
  $query = "SELECT MAX(id) AS tasksetid FROM tasksets";
  $result = $mysql->query_assoc($query);
  return ($result['tasksetid'] + 1);
}

function suggest_step() {
  global $mysql, $tskid;

  $query = "SELECT MAX(step) as stp FROM activities WHERE taskid=\"$tskid\"";
  $result = $mysql->query_assoc($query);
  
  return ($result['stp'] + 1);
}

function add_tasks() {
  global $mysql, $mysql_class;

  $id = $_POST['id'];
  $duration = $_POST['duration'];
  if ($mysql_class == "mysqli") {
    $title = mysqli_real_escape_string($mysql, $_POST['title']);
    $description = mysqli_real_escape_string($mysql, $_POST['description']); 
    $reward = mysqli_real_escape_string($mysql, $_POST['reward']);
  }
  else {
    $title = mysql_real_escape_string($_POST['title']);
    $description = mysql_real_escape_string($_POST['description']); 
    $reward = mysql_real_escape_string($_POST['reward']);
  }
  $rewardid = $_POST['rewardid'];
  $cashreward = $_POST['cashreward'];
  $xpreward = $_POST['xpreward'];
  $rewardmethod = $_POST['rewardmethod']; 
  $startzone = $_POST['startzone'];
  $minlevel = $_POST['minlevel'];
  $maxlevel = $_POST['maxlevel'];
  $repeatable = $_POST['repeatable'];

  $query = "INSERT INTO tasks SET id=\"$id\", title=\"$title\", duration=\"$duration\", description=\"$description\", reward=\"$reward\", rewardid=\"$rewardid\", cashreward=\"$cashreward\", xpreward=\"$xpreward\", rewardmethod=\"$rewardmethod\", startzone=\"$startzone\", minlevel=\"$minlevel\", maxlevel=\"$maxlevel\", repeatable=\"$repeatable\"";
  $mysql->query_no_result($query);
}

function add_activity() {
  global $mysql, $mysql_class;

  $taskid = $_POST['taskid'];
  $activityid = $_POST['activityid'];
  $step = $_POST['step'];
  $activitytype = $_POST['activitytype']; 
  if ($mysql_class == "mysqli") {
    $text1 = mysqli_real_escape_string($mysql, $_POST['text1']);
    $text2 = mysqli_real_escape_string($mysql, $_POST['text2']);
    $text3 = mysqli_real_escape_string($mysql, $_POST['text3']);
  }
  else {
    $text1 = mysql_real_escape_string($_POST['text1']);
    $text2 = mysql_real_escape_string($_POST['text2']);
    $text3 = mysql_real_escape_string($_POST['text3']);
  }
  $goalid = $_POST['goalid'];
  $goalmethod = $_POST['goalmethod']; 
  $goalcount = $_POST['goalcount'];
  $delivertonpc = $_POST['delivertonpc'];
  $zoneid = $_POST['zoneid'];
  $optional = $_POST['optional'];

  $query = "INSERT INTO activities SET taskid=\"$taskid\", step=\"$step\", activityid=\"$activityid\", activitytype=\"$activitytype\", text1=\"$text1\", text2=\"$text2\", text3=\"$text3\", goalid=\"$goalid\", goalmethod=\"$goalmethod\", goalcount=\"$goalcount\", delivertonpc=\"$delivertonpc\", zoneid=\"$zoneid\", optional=\"$optional\"";
  $mysql->query_no_result($query);
}

function add_goallist() {
  global $mysql;

  $taskid = $_POST['taskid'];
  $listid = $_POST['listid'];
  $entry = $_POST['entry'];

  $query = "INSERT INTO goallists SET listid=\"$listid\", entry=\"$entry\"";
  $mysql->query_no_result($query);
  
  $query = "UPDATE tasks SET rewardid=\"$listid\" WHERE id=\"$taskid\"";
  $mysql->query_no_result($query);
}

function add_goallist_act() {
  global $mysql;

  $taskid = $_POST['taskid'];
  $listid = $_POST['listid'];
  $entry = $_POST['entry'];
  $aid = $_POST['aid'];

  $query = "INSERT INTO goallists SET listid=\"$listid\", entry=\"$entry\"";
  $mysql->query_no_result($query);
  
  $query = "UPDATE activities SET goalid=\"$listid\" WHERE taskid=\"$taskid\" AND activityid=\"$aid\"";
  $mysql->query_no_result($query);
}

function add_proximity() {
  global $mysql;

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
  $mysql->query_no_result($query);

  $query = "UPDATE activities SET goalid=\"$exploreid\" WHERE taskid=\"$tskid\" AND activityid=\"$aid\"";
  $mysql->query_no_result($query);
}

function add_taskset() {
  check_authorization();
  global $mysql;
  $id = $_POST['id'];
  $taskid = $_POST['taskid'];

  $query = "INSERT INTO tasksets values ($id,$taskid)";
  $mysql->query_no_result($query);
}

function search_tasks() {
  global $mysql;
  $search = $_GET['search'];

  $query = "SELECT id, title FROM tasks WHERE title rlike \"$search\"";
  $results = $mysql->query_mult_assoc($query);
  return $results;
}

function getActiveTasks($page_number, $results_per_page, $sort_by) {
  global $mysql;
  $limit = ($page_number - 1) * $results_per_page . "," . $results_per_page;

  $query = "SELECT * FROM character_tasks ORDER BY $sort_by LIMIT $limit";
  $results = $mysql->query_mult_assoc($query);

  return $results;
}

function getCompletedTasks($page_number, $results_per_page, $sort_by) {
  global $mysql;
  $limit = ($page_number - 1) * $results_per_page . "," . $results_per_page;

  $query = "SELECT * FROM completed_tasks ORDER BY $sort_by LIMIT $limit";
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
?>