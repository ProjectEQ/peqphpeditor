<?

$bugstatus = array(
  0   => "Open",
  1   => "Corrected",
  2   => "Invalid",
  3   => "Moved",
);

$flags = array(
  0   => "None",
  1   => "Duplicate",
  2   => "Crash",
  3   => "Duplicate/Crash",
  4   => "Target",
  5   => "Duplicate/Target",
  6   => "Crash/Target",
  7   => "Duplicate/Crash/Target",
  8   => "Flags",
  9   => "Duplicate/Flags",
  10  => "Crash/Flags",
  11  => "Duplicate/Crash/Flags",
  12  => "Target/Flags",
  13  => "Duplicate/Target/Flags",
  14  => "Crash/Target/Flags",
  15  => "Duplicate/Crash/Target/Flags",
);

switch ($action) {
  case 0: 
    $body = new Template("templates/server/server.default.tmpl.php");
    break;
  case 1: // Preview Bugs
    check_authorization();
    $body = new Template("templates/server/bugs.tmpl.php");
    $body->set("bugstatus", $bugstatus);
    $bugs = get_bugs();
    if ($bugs) {
      foreach ($bugs as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
  case 2: // View Bugs
    check_authorization();
    $body = new Template("templates/server/bugs.view.tmpl.php");
    $body->set("bugstatus", $bugstatus);
    $body->set("flags", $flags);
    $bugs = view_bugs();
    if ($bugs) {
      foreach ($bugs as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
   case 3: // Update Bugs
    check_authorization();
    update_bugs();
    header("Location: index.php?editor=server&action=1");
    exit;
   case 4: // View Resolved Bugs
    $body = new Template("templates/server/bugs.resolved.tmpl.php");
    $body->set("bugstatus", $bugstatus);
    $bugs = get_bugs();
    if ($bugs) {
      foreach ($bugs as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
   case 5: // Delete Bugs
    check_authorization();
    delete_bugs();
    header("Location: index.php?editor=server&action=1");
    exit;
   case 6: // Preview Hackers
    check_admin_authorization();
    $body = new Template("templates/server/hackers.tmpl.php");
    $hackers = get_hackers();
    if ($hackers) {
      foreach ($hackers as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
   case 7: // Delete Hacker
    check_admin_authorization();
    delete_hacker();
    header("Location: index.php?editor=server&action=6");
    exit;
   case 8: // View Hacker
    check_admin_authorization();
    $body = new Template("templates/server/hackers.view.tmpl.php");
    $hackers = view_hackers();
    if ($hackers) {
      foreach ($hackers as $key=>$value) {
        $body->set($key, $value);
       }
     }
    break;
   case 9: // Preview Reports
    check_admin_authorization();
    $body = new Template("templates/server/reports.tmpl.php");
    $reports = get_reports();
    if ($reports) {
      foreach ($reports as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
   case 10: // Delete Report
    check_admin_authorization();
    delete_report();
    header("Location: index.php?editor=server&action=9");
    exit;
   case 11: // View Report
    check_admin_authorization();
    $body = new Template("templates/server/reports.view.tmpl.php");
    $reports = view_reports();
    if ($reports) {
      foreach ($reports as $key=>$value) {
        $body->set($key, $value);
       }
     }
    break;
  case 12: // View Petitions
    check_admin_authorization();
    $body = new Template("templates/server/petition.tmpl.php");
    $petitions = get_petitions();
    if ($petitions) {
      foreach ($petitions as $key=>$value) {
        $body->set($key, $value);
       }
     }
    break;
  case 13: // View Petition
    check_admin_authorization();
    $body = new Template("templates/server/petition.view.tmpl.php");
    $body->set('yesno', $yesno);
    $body->set('classes', $classes);
    $body->set('races', $races);
    $petition = view_petition();
    if ($petition) {
      foreach ($petition as $key=>$value) {
        $body->set($key, $value);
       }
     }
    break;
  case 14: // Update Petition
    check_admin_authorization();
    update_petition();
    header("Location: index.php?editor=server&action=12");
    exit;
  case 15: // Delete Petition
    check_admin_authorization();
    delete_petition();
    header("Location: index.php?editor=server&action=12");
    exit;
  case 16: // View Rules
    check_admin_authorization();
    $body = new Template("templates/server/rules.tmpl.php");
    $rules = get_rules();
    if ($rules) {
      foreach ($rules as $key=>$value) {
        $body->set($key, $value);
       }
     }
    break;
  case 17: // Edit Rules
    check_admin_authorization();
    $body = new Template("templates/server/rules.edit.tmpl.php");
    $rules = view_rule();
    if ($rules) {
      foreach ($rules as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
  case 18: // Update Rule
    check_admin_authorization();
    update_rule();
    header("Location: index.php?editor=server&action=16");
    exit;
  case 19: // Add Rule
    check_admin_authorization();
    $body = new Template("templates/server/rules.add.tmpl.php");
    $body->set('suggestruleset', suggest_ruleset());
    break;
  case 20: // Add Rule
    check_admin_authorization();
    add_rule();
    header("Location: index.php?editor=server&action=16");
    exit; 
  case 21: // Delete Rule
    check_admin_authorization();
    delete_rule();
    header("Location: index.php?editor=server&action=16");
    exit;
  case 22: // Edit Ruleset
    check_admin_authorization();
    $body = new Template("templates/server/ruleset.edit.tmpl.php");
    $body->set('ruleset_id', $_GET['ruleset_id']);
    $ruleset = view_ruleset();
    if ($ruleset) {
      foreach ($ruleset as $key=>$value) {
        $body->set($key, $value);
       }
     }
    break;
  case 23: // Update Rule Set
    check_admin_authorization();
    update_ruleset();
    header("Location: index.php?editor=server&action=16");
    exit;
  case 24: // Delete Rule Set
    check_admin_authorization();
    delete_ruleset();
    header("Location: index.php?editor=server&action=16");
    exit;
}

function get_bugs() {
  global $mysql;

  $query = "SELECT id, zone, name, ui, x, y, z, type, flag, target, bug, date, status FROM bugs";
  $result = $mysql->query_mult_assoc($query);
  if ($result) {
    foreach ($result as $result) {
     $array['bugs'][$result['id']] = array("bid"=>$result['id'], "zone"=>$result['zone'], "name"=>$result['name'], "ui"=>$result['ui'], "x"=>$result['x'], "y"=>$result['y'], "z"=>$result['z'], "type"=>$result['type'], "flag"=>$result['flag'], "target"=>$result['target'], "bug"=>$result['bug'], "date"=>$result['date'], "status"=>$result['status']);
         }
       }
  return $array;
  }

function get_hackers() {
  global $mysql;

  $query = "SELECT id, account, name, hacked, zone, date FROM hackers orser by id desc limit 500";
  $result = $mysql->query_mult_assoc($query);
  if ($result) {
    foreach ($result as $result) {
     $array['hackers'][$result['id']] = array("hid"=>$result['id'], "account"=>$result['account'], "name"=>$result['name'], "hacked"=>$result['hacked'], "date"=>$result['date'], "zone"=>$result['zone']);
         }
       }
  return $array;
  }

function get_reports() {
  global $mysql;

  $query = "SELECT id, name, reported, reported_text FROM reports";
  $result = $mysql->query_mult_assoc($query);
  if ($result) {
    foreach ($result as $result) {
     $array['reports'][$result['id']] = array("rid"=>$result['id'], "name"=>$result['name'], "reported"=>$result['reported'], "reported_text"=>$result['reported_text']);
         }
       }
  return $array;
  }

function get_petitions() {
  global $mysql;

  $query = "SELECT dib, petid, accountname, charname, zone, senttime FROM petitions";
  $result = $mysql->query_mult_assoc($query);
  if ($result) {
    foreach ($result as $result) {
     $array['petitions'][$result['dib']] = array("dib"=>$result['dib'], "petid"=>$result['petid'], "accountname"=>$result['accountname'], "charname"=>$result['charname'], "senttime"=>$result['senttime'], "zone"=>$result['zone']);
         }
       }
  return $array;
  }

function get_rules() {
  global $mysql;

  $query = "SELECT ruleset_id, rule_name, rule_value, notes FROM rule_values order by rule_name";
  $result = $mysql->query_mult_assoc($query);
  if ($result) {
    foreach ($result as $result) {
     $array['rules'][$result['rule_name']] = array("ruleset_id"=>$result['ruleset_id'], "rule_value"=>$result['rule_value'], "rule_name"=>$result['rule_name'], "notes"=>$result['notes']);
         }
       }
  return $array;
  }

function view_bugs() {
  global $mysql;

  $bid = $_GET['bid'];

  $query = "SELECT id AS bid, zone, name, ui, x, y, z, type, flag, target, bug, date, status FROM bugs where id = \"$bid\"";
  $result = $mysql->query_assoc($query);
  
  return $result;
  }

function view_hackers() {
  global $mysql;

  $hid = $_GET['hid'];

  $query = "SELECT id AS hid, account, name, hacked, zone, date FROM hackers where id = \"$hid\"";
  $result = $mysql->query_assoc($query);
  
  return $result;
  }

function view_reports() {
  global $mysql;

  $rid = $_GET['rid'];

  $query = "SELECT id AS rid, name, reported, reported_text FROM reports where id = \"$rid\"";
  $result = $mysql->query_assoc($query);
  
  return $result;
  }

function view_petition() {
  global $mysql;

  $dib = $_GET['dib'];

  $query = "SELECT * FROM petitions where dib = \"$dib\"";
  $result = $mysql->query_assoc($query);
  
  return $result;
  }

function view_rule() {
  global $mysql;

  $rule_name = $_GET['rule_name'];

  $query = "SELECT * FROM rule_values where rule_name = \"$rule_name\"";
  $result = $mysql->query_assoc($query);
  
  return $result;
  }

function view_ruleset() {
  global $mysql;

  $ruleset_id = $_GET['ruleset_id'];

  $query = "SELECT * FROM rule_sets where ruleset_id = \"$ruleset_id\"";
  $result = $mysql->query_assoc($query);
  
  return $result;
  }

function update_bugs() {
  global $mysql;

  $bid = $_POST['bid'];
  $status = $_POST['status'];

  $query = "UPDATE bugs SET status=\"$status\" WHERE id=\"$bid\"";
  $mysql->query_no_result($query);
}

function update_petition() {
  global $mysql;

  $dib = $_POST['dib'];
  $ischeckedout = $_POST['ischeckedout'];
  $lastgm = $_POST['lastgm'];
  $gmtext = $_POST['gmtext'];

  $query = "UPDATE petitions SET ischeckedout=\"$ischeckedout\", lastgm=\"$lastgm\", gmtext=\"$gmtext\" WHERE dib=\"$dib\"";
  $mysql->query_no_result($query);
}

function update_rule() {
  global $mysql;

  $rule_name = $_POST['rule_name'];
  $rule_name1 = $_POST['rule_name1'];
  $ruleset_id = $_POST['ruleset_id'];
  $rule_value = $_POST['rule_value'];
  $notes = $_POST['notes'];

  $query = "UPDATE rule_values SET rule_name=\"$rule_name1\", rule_value=\"$rule_value\", ruleset_id=\"$ruleset_id\", notes=\"$notes\" WHERE rule_name=\"$rule_name\"";
  $mysql->query_no_result($query);
}

function update_ruleset() {
  global $mysql;

  $ruleset_id = $_POST['ruleset_id'];
  $ruleset_id = $_POST['ruleset_id1'];
  $name = $_POST['name'];

  $query = "REPLACE INTO rule_sets SET name=\"$name\", ruleset_id=\"$ruleset_id\"";
  $mysql->query_no_result($query);
}

function delete_bugs() {
  global $mysql;

  $bid = $_GET['bid'];

  $query = "DELETE FROM bugs WHERE id=\"$bid\"";
  $mysql->query_no_result($query);
}

function delete_hacker() {
  global $mysql;

  $hid = $_GET['hid'];

  $query = "DELETE FROM hackers WHERE id=\"$hid\"";
  $mysql->query_no_result($query);
}

function delete_report() {
  global $mysql;

  $rid = $_GET['rid'];

  $query = "DELETE FROM reports WHERE id=\"$rid\"";
  $mysql->query_no_result($query);
}

function delete_petition() {
  global $mysql;

  $dib = $_GET['dib'];

  $query = "DELETE FROM petitions WHERE dib=\"$dib\"";
  $mysql->query_no_result($query);
}

function delete_rule() {
  global $mysql;

  $rule_name = $_GET['rule_name'];

  $query = "DELETE FROM rule_values WHERE rule_name=\"$rule_name\"";
  $mysql->query_no_result($query);
}

function delete_ruleset() {
  global $mysql;

  $ruleset_id = $_GET['ruleset_id'];

  $query = "DELETE FROM rule_sets WHERE ruleset_id=\"$ruleset_id\"";
  $mysql->query_no_result($query);
}

function suggest_ruleset() {
  global $mysql;

  $query = "SELECT ruleset_id FROM rule_sets where name=\"default\"";
  $result = $mysql->query_assoc($query);
  
  return ($result['ruleset_id']);
}

function add_rule() {
  global $mysql;

  $ruleset_id = $_POST['ruleset_id'];
  $rule_value = $_POST['rule_value'];
  $rule_name = $_POST['rule_name']; 
  $notes = $_POST['notes'];

  $query = "INSERT INTO rule_values SET ruleset_id=\"$ruleset_id\", rule_name=\"$rule_name\", rule_value=\"$rule_value\", notes=\"$notes\"";
  $mysql->query_no_result($query);
}
?>