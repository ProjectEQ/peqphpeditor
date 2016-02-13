<?php

$bugstatus = array(
  0   => "Open",
  1   => "Corrected",
  2   => "Invalid",
  3   => "Moved"
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
  15  => "Duplicate/Crash/Target/Flags"
);

$default_page = 1;
$default_size = 50;
$default_sort = 1;

$columns = array(
  1 => 'id',
  2 => 'zone',
  3 => 'name',
  4 => 'type',
  5 => 'target',
  6 => 'date',
  7 => 'status'
);

$columns1 = array(
  1 => 'id',
  2 => 'account',
  3 => 'name',
  4 => 'zone',
  5 => 'date',
  6 => 'hacked'
);

switch ($action) {
  case 0:
    check_authorization();
    $body = new Template("templates/server/server.default.tmpl.php");
    break;
  case 1: // View Open Bugs
    check_authorization();
    $breadcrumbs .= " >> Open Bugs";
    $curr_page = (isset($_GET['page'])) ? $_GET['page'] : $default_page;
    $curr_size = (isset($_GET['size'])) ? $_GET['size'] : $default_size;
    $curr_sort = (isset($_GET['sort'])) ? $columns[$_GET['sort']] : $columns[$default_sort];
    $body = new Template("templates/server/bugs.tmpl.php");
    $body->set("bugstatus", $bugstatus);
    $bugs = get_open_bugs($curr_page, $curr_size, $curr_sort);
    $page_stats = getPageInfo("bugs", $curr_page, $curr_size, $_GET['sort'], "status = 0");
    if ($bugs) {
      foreach ($bugs as $key=>$value) {
        $body->set($key, $value);
      }
      foreach ($page_stats as $key=>$value) {
        $body->set($key, $value);
      }
    }
    else {
      $body->set('page', 0);
      $body->set('pages', 0);
    }
    break;
  case 2: // View Bug
    check_authorization();
    $breadcrumbs .= " >> Bug Details";
    $javascript = new Template("templates/server/js.tmpl.php");
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
   case 3: // Update Bug
    check_authorization();
    update_bugs();
    if ($_POST['notify']) {
      notify_status($bugstatus[$_POST['status']]);
    }
    header("Location: index.php?editor=server&action=1");
    exit;
   case 4: // View Resolved Bugs
    check_authorization();
    $breadcrumbs .= " >> Resolved Bugs";
    $curr_page = (isset($_GET['page'])) ? $_GET['page'] : $default_page;
    $curr_size = (isset($_GET['size'])) ? $_GET['size'] : $default_size;
    $curr_sort = (isset($_GET['sort'])) ? $columns[$_GET['sort']] : $columns[$default_sort];
    $body = new Template("templates/server/bugs.resolved.tmpl.php");
    $body->set("bugstatus", $bugstatus);
    $bugs = get_resolved_bugs($curr_page, $curr_size, $curr_sort);
    $page_stats = getPageInfo("bugs", $curr_page, $curr_size, $_GET['sort'], "status != 0");
    if ($bugs) {
      foreach ($bugs as $key=>$value) {
        $body->set($key, $value);
      }
      foreach ($page_stats as $key=>$value) {
        $body->set($key, $value);
      }
    }
    else {
      $body->set('page', 0);
      $body->set('pages', 0);
    }
    break;
   case 5: // Delete Bug
    check_authorization();
    delete_bugs();
    header("Location: index.php?editor=server&action=4");
    exit;
   case 6: // Preview Hackers
    check_admin_authorization();
    $breadcrumbs .= " >> Hackers";
    $javascript = new Template("templates/server/js.tmpl.php");
    $curr_page = (isset($_GET['page'])) ? $_GET['page'] : $default_page;
    $curr_size = (isset($_GET['size'])) ? $_GET['size'] : $default_size;
    $curr_sort = (isset($_GET['sort'])) ? $columns1[$_GET['sort']] : $columns1[$default_sort];
    if ($_GET['filter'] == 'on') {
      $filter = build_filter();
    }
    $body = new Template("templates/server/hackers.tmpl.php");
    $page_stats = getPageInfo("hackers", $curr_page, $curr_size, $_GET['sort'], $filter['sql']);
    if ($filter) {
      $body->set('filter', $filter);
    }
    if ($page_stats['page']) {
      $hackers = get_hackers($page_stats['page'], $curr_size, $curr_sort, $filter['sql']);
    }
    if ($hackers) {
      foreach ($hackers as $key=>$value) {
        $body->set($key, $value);
      }
      foreach ($page_stats as $key=>$value) {
        $body->set($key, $value);
      }
    }
    else {
      $body->set('page', 0);
      $body->set('pages', 0);
    }
    break;
   case 7: // Delete Hacker
    check_admin_authorization();
    delete_hacker();
    $return_address = $_SERVER['HTTP_REFERER'];
    header("Location: $return_address");
    exit;
   case 8: // View Hacker
    check_admin_authorization();
    $breadcrumbs .= " >> " . "<a href='index.php?editor=server&action=6'>" . "Hackers</a> >> Hacker Details";
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
    $breadcrumbs .= " >> Reports";
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
    $breadcrumbs .= " >> " . "<a href='index.php?editor=server&action=9'>" . "Reports</a> >> Report Details";
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
    $breadcrumbs .= " >> Petitions";
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
    $breadcrumbs .= " >> " . "<a href='index.php?editor=server&action=12'>" . "Petitions</a> >> Petition Details";
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
    $breadcrumbs .= " >> Rules";
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
    $breadcrumbs .= " >> " . "<a href='index.php?editor=server&action=16'>" . "Rules</a> >> Rule Editor";
    $body = new Template("templates/server/rules.edit.tmpl.php");
    $body->set('ruleset_id', $_GET['ruleset_id']);
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
    $ruleset_id = $_POST['ruleset_id1'];
    header("Location: index.php?editor=server&ruleset_id=$ruleset_id&action=28");
    exit;
  case 19: // Add Rule
    check_admin_authorization();
    $breadcrumbs .= " >> " . "<a href='index.php?editor=server&action=16'>" . "Rules</a> >> Add Rule";
    $body = new Template("templates/server/rules.add.tmpl.php");
    $body->set('suggestruleset', $_GET['ruleset_id']);
    break;
  case 20: // Add Rule
    check_admin_authorization();
    add_rule();
    $ruleset_id = $_POST['ruleset_id'];
    header("Location: index.php?editor=server&ruleset_id=$ruleset_id&action=28");
    exit; 
  case 21: // Delete Rule
    check_admin_authorization();
    delete_rule();
    $ruleset_id = $_GET['ruleset_id'];
    header("Location: index.php?editor=server&ruleset_id=$ruleset_id&action=28");
    exit;
  case 22: // Edit Ruleset
    check_admin_authorization();
    $breadcrumbs .= " >> " . "<a href='index.php?editor=server&action=16'>" . "Rules</a> >> Ruleset Editor";
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
    header("Location: index.php?editor=server&action=27");
    exit;
  case 24: // Delete Rule Set
    check_admin_authorization();
    delete_ruleset();
    header("Location: index.php?editor=server&action=27");
    exit;
  case 25: // Copy Ruleset
    check_admin_authorization();
    $breadcrumbs .= " >> " . "<a href='index.php?editor=server&action=16'>" . "Rules</a> >> Copy Ruleset";
    $body = new Template("templates/server/ruleset.copy.tmpl.php");
    $body->set('suggestruleid', suggest_ruleset_id());
    $body->set('name', $_GET['name']);
    break;
  case 26: // Copy Rule Set
    check_admin_authorization();
    copy_ruleset();
    header("Location: index.php?editor=server&action=27");
    exit;
  case 27: // Switch Ruleset
    check_admin_authorization();
    $breadcrumbs .= " >> " . "<a href='index.php?editor=server&action=16'>" . "Rules</a> >> Switch Ruleset";
    $body = new Template("templates/server/ruleset.switch.tmpl.php");
    $ruleset = view_rulesets();
    if ($ruleset) {
      foreach ($ruleset as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
  case 28: // View Rules from ruleset
    check_admin_authorization();
    $breadcrumbs .= " >> " . "<a href='index.php?editor=server&action=16'>" . "Rules</a> >> Ruleset Rules";
    $body = new Template("templates/server/rules.tmpl.php");
    $body->set('ruleset_id', $_GET['ruleset_id']);
    $rules = get_rules_from_ruleset();
    if ($rules) {
      foreach ($rules as $key=>$value) {
        $body->set($key, $value);
       }
     }
    break;
  case 29: // Delete Rule Set
    check_admin_authorization();
    delete_ruleset_rules();
    header("Location: index.php?editor=server&action=27");
    exit;
  case 30: // Add Ruleset
    check_admin_authorization();
    $breadcrumbs .= " >> " . "<a href='index.php?editor=server&action=16'>" . "Rules</a> >> Add Ruleset";
    $body = new Template("templates/server/ruleset.add.tmpl.php");
    $body->set('suggestruleid', suggest_ruleset_id());
    break;
  case 31: // Add Ruleset
    check_admin_authorization();
    add_ruleset();
    header("Location: index.php?editor=server&action=27");
    exit;
  case 32: // View Zones
    check_admin_authorization();
    $breadcrumbs .= " >> Zone Launcher Setup";
    $body = new Template("templates/server/zones.tmpl.php");
    $zones = get_zones();
    if ($zones) {
      foreach ($zones as $key=>$value) {
        $body->set($key, $value);
       }
     }
    $launchers = get_launchers();
    if ($launchers) {
      foreach ($launchers as $key=>$value) {
        $body->set($key, $value);
       }
     }
    break;
  case 33: // Edit Zone
    check_admin_authorization();
    $breadcrumbs .= " >> " . "<a href='index.php?editor=server&action=32'>" . "Zone Launcher Setup</a> >> Zone Launcher Editor";
    $body = new Template("templates/server/zones.edit.tmpl.php");
    $body->set('zoneids', $zoneids);
    $zones = view_zone();
    if ($zones) {
      foreach ($zones as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
  case 34: // Update Zone
    check_admin_authorization();
    update_zone();
    header("Location: index.php?editor=server&action=32");
    exit;
  case 35: // Delete Zone
    check_admin_authorization();
    delete_zone();
    header("Location: index.php?editor=server&action=32");
    exit;
  case 36: // Add Zone
    check_admin_authorization();
    $breadcrumbs .= " >> " . "<a href='index.php?editor=server&action=32'>" . "Zone Launcher Setup</a> >> Add Zone";
    $body = new Template("templates/server/zones.add.tmpl.php");
    $body->set('suggestlauncher', suggest_launcher());
    break;
  case 37: // Add Zone
    check_admin_authorization();
    add_zone();
    header("Location: index.php?editor=server&action=32");
    exit;
  case 38: // Edit launcher
    check_admin_authorization();
    $breadcrumbs .= " >> " . "<a href='index.php?editor=server&action=32'>" . "Zone Launcher Setup</a> >> Launcher Editor";
    $body = new Template("templates/server/launcher.edit.tmpl.php");
    $launchers = view_launcher();
    if ($launchers) {
      foreach ($launchers as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
  case 39: // Update launcher
    check_admin_authorization();
    update_launcher();
    header("Location: index.php?editor=server&action=32");
    exit;
  case 40: // Delete launcher
    check_admin_authorization();
    delete_launcher();
    header("Location: index.php?editor=server&action=32");
    exit;
  case 41: // Add launcher
    check_admin_authorization();
    $breadcrumbs .= " >> " . "<a href='index.php?editor=server&action=32'>" . "Zone Launcher Setup</a> >> Add Launcher";
    $body = new Template("templates/server/launcher.add.tmpl.php");
    break;
  case 42: // Add launcher
    check_admin_authorization();
    add_launcher();
    header("Location: index.php?editor=server&action=32");
    exit;
  case 43: // View Variables
    check_admin_authorization();
    $breadcrumbs .= " >> Variables";
    $body = new Template("templates/server/variables.tmpl.php");
    $variables = get_variables();
    if ($variables) {
      foreach ($variables as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
  case 44: // Edit Variable
    check_admin_authorization();
    $breadcrumbs .= " >> " . "<a href='index.php?editor=server&action=43'>" . "Variables</a> >> Variable Editor";
    $body = new Template("templates/server/variables.edit.tmpl.php");
    $body->set('varname', $_GET['varname']);
    $variables = view_variable();
    if ($variables) {
      foreach ($variables as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
  case 45: // Update Variable
    check_admin_authorization();
    update_variable();
    header("Location: index.php?editor=server&action=43");
    exit;    
  case 46: // Create Variable
    check_admin_authorization();
    $breadcrumbs .= " >> " . "<a href='index.php?editor=server&action=43'>" . "Variables</a> >> Create Variable";
    $body = new Template("templates/server/variables.add.tmpl.php");
    break;
  case 47: // Add Variable
    check_admin_authorization();
    add_variable();
    header("Location: index.php?editor=server&action=43");
    exit;
  case 48: // Delete Variable
    check_admin_authorization();
    delete_variable();
    $varname = $_GET['varname'];
    header("Location: index.php?editor=server&action=43");
    exit;
  case 49: // Delete Multiple Hacks
    check_admin_authorization();
    delete_multiple_hacks();
    $return_address = $_SERVER['HTTP_REFERER'];
    header("Location: $return_address");
    exit;
  case 50: // View Banned_IPs
    check_admin_authorization();
    $breadcrumbs .= " >> BannedIPs";
    $body = new Template("templates/server/bannedips.tmpl.php");
    $banned = get_bannedips();
    if ($banned) {
      foreach ($banned as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
  case 51: // Add Banned IPs
    check_admin_authorization();
    $breadcrumbs .= " >> BannedIPs";
    $body = new Template("templates/server/bannedips.add.tmpl.php");
    break;
  case 52: // Add Banned IP
    check_admin_authorization();
    add_bannedip();
    header("Location: index.php?editor=server&action=50");
    exit;
  case 53: // Edit Banned IP note
    check_admin_authorization();
    $breadcrumbs .= " >> BannedIPs";
    $body = new Template("templates/server/bannedips.edit.tmpl.php");
    $banned = view_bannedips();
    if ($banned) {
      foreach ($banned as $key=>$value) {
        $body->set($key, $value);
       }
     }
    break;
  case 54: //Delete Banned IP
    check_admin_authorization();
    delete_bannedip();
    header("Location: index.php?editor=server&action=50");
    exit;
  case 55: // Update Banned IP
    check_admin_authorization();
    update_bannedip();
    header("Location: index.php?editor=server&action=50");
    exit;
  case 56: // View Character Creation Combos
    check_admin_authorization();
    $breadcrumbs .= " >> Character Creation Combos";
    $body = new Template("templates/server/charcreatecombos.tmpl.php");
    $charcreatecombolist = getCharCreateComboList();
    if ($charcreatecombolist) {
      $body->set('charcreatecombolist', $charcreatecombolist);
      $body->set('races', $races);
      $body->set('classes', $classes);
      $body->set('deities', $deities);
      $body->set('zoneids', $zoneids);
      $body->set('expansions', $expansions);
    }
    break;
}

function get_open_bugs($page_number, $results_per_page, $sort_by) {
  global $mysql;
  $limit = ($page_number - 1) * $results_per_page . "," . $results_per_page;

  $query = "SELECT id, zone, name, ui, x, y, z, type, flag, target, bug, date, status FROM bugs WHERE status = 0 ORDER BY $sort_by LIMIT $limit";
  $result = $mysql->query_mult_assoc($query);
  if ($result) {
    foreach ($result as $result) {
      $array['bugs'][$result['id']] = array("bid"=>$result['id'], "zone"=>$result['zone'], "name"=>$result['name'], "ui"=>$result['ui'], "x"=>$result['x'], "y"=>$result['y'], "z"=>$result['z'], "type"=>$result['type'], "flag"=>$result['flag'], "target"=>$result['target'], "bug"=>$result['bug'], "date"=>$result['date'], "status"=>$result['status']);
    }
  }
  return $array;
}

function get_resolved_bugs($page_number, $results_per_page, $sort_by) {
  global $mysql;
  $limit = ($page_number - 1) * $results_per_page . "," . $results_per_page;

  $query = "SELECT id, zone, name, ui, x, y, z, type, flag, target, bug, date, status FROM bugs WHERE status != 0 ORDER BY $sort_by LIMIT $limit";
  $result = $mysql->query_mult_assoc($query);
  if ($result) {
    foreach ($result as $result) {
      $array['bugs'][$result['id']] = array("bid"=>$result['id'], "zone"=>$result['zone'], "name"=>$result['name'], "ui"=>$result['ui'], "x"=>$result['x'], "y"=>$result['y'], "z"=>$result['z'], "type"=>$result['type'], "flag"=>$result['flag'], "target"=>$result['target'], "bug"=>$result['bug'], "date"=>$result['date'], "status"=>$result['status']);
    }
  }
  return $array;
}

function get_hackers($page_number, $results_per_page, $sort_by, $where = "") {
  global $mysql;
  $limit = ($page_number - 1) * $results_per_page . "," . $results_per_page;

  $query = "SELECT id, account, name, hacked, zone, date FROM hackers";
  if ($where) {
    $query .= " WHERE $where";
  }
  $query .= " ORDER BY $sort_by LIMIT $limit";
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

  $query = "SELECT dib, petid, accountname, charname, zone, senttime FROM petitions order by senttime";
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

  $query = "SELECT rv.ruleset_id, rv.rule_name, rv.rule_value, rv.notes FROM rule_values rv 
            INNER JOIN rule_sets rs ON rs.ruleset_id = rv.ruleset_id
            WHERE rs.name=\"default\" order by rv.rule_name";
  $result = $mysql->query_mult_assoc($query);
  if ($result) {
    foreach ($result as $result) {
      $array['rules'][$result['rule_name']] = array("ruleset_id"=>$result['ruleset_id'], "rule_value"=>$result['rule_value'], "rule_name"=>$result['rule_name'], "notes"=>$result['notes']);
    }
  }
  return $array;
}

function get_rules_from_ruleset() {
  global $mysql;
  $ruleset_id = $_GET['ruleset_id'];

  $query = "SELECT ruleset_id, rule_name, rule_value, notes FROM rule_values WHERE ruleset_id=\"$ruleset_id\" order by rule_name";
  $result = $mysql->query_mult_assoc($query);
  if ($result) {
    foreach ($result as $result) {
      $array['rules'][$result['rule_name']] = array("ruleset_id"=>$result['ruleset_id'], "rule_value"=>$result['rule_value'], "rule_name"=>$result['rule_name'], "notes"=>$result['notes']);
    }
  }
  return $array;
}

function get_zones() {
  global $mysql;

  $query = "SELECT launcher, zone, port FROM launcher_zones order by zone";
  $result = $mysql->query_mult_assoc($query);
  if ($result) {
    foreach ($result as $result) {
      $array['zones'][$result['zone']] = array("launcher"=>$result['launcher'], "zone"=>$result['zone'], "port"=>$result['port']);
    }
  }
  return $array;
}

function get_launchers() {
  global $mysql;

  $query = "SELECT name, dynamics FROM launcher";
  $result = $mysql->query_mult_assoc($query);
  if ($result) {
    foreach ($result as $result) {
      $array['launchers'][$result['name']] = array("name"=>$result['name'], "dynamics"=>$result['dynamics']);
    }
  }
  return $array;
}

function get_variables() {
  global $mysql;

  $query = "SELECT varname, value FROM variables";
  $results = $mysql->query_mult_assoc($query);

  if ($results) {
    foreach ($results as $result) {
      $array['variables'][$result['varname']] = array("varname"=>$result['varname'], "value"=>$result['value']);
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
  $ruleset_id = $_GET['ruleset_id'];

  $query = "SELECT * FROM rule_values where rule_name = \"$rule_name\" AND ruleset_id=\"$ruleset_id\"";
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

function view_rulesets() {
  global $mysql;

  $query = "SELECT ruleset_id, name FROM rule_sets order by ruleset_id";
  $result = $mysql->query_mult_assoc($query);
  if ($result) {
    foreach ($result as $result) {
     $array['ruleset'][$result['ruleset_id']] = array("ruleset_id"=>$result['ruleset_id'], "name"=>$result['name']);
         }
       }
  return $array;
}

function view_zone() {
  global $mysql;

  $zone = $_GET['zone'];
  $launcher = $_GET['launcher'];

  $query = "SELECT * FROM launcher_zones where launcher = \"$launcher\" and zone = \"$zone\"";
  $result = $mysql->query_assoc($query);
  
  return $result;
}

function view_launcher() {
  global $mysql;

  $name = $_GET['name'];

  $query = "SELECT * FROM launcher where name = \"$name\"";
  $result = $mysql->query_assoc($query);
  
  return $result;
}

function view_variable() {
  global $mysql;

  $varname = $_GET['varname'];

  $query = "SELECT * FROM variables where varname = \"$varname\"";
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
  $ruleset_id1 = $_POST['ruleset_id1'];
  $rule_value = $_POST['rule_value'];
  $notes = $_POST['notes'];

  $query = "UPDATE rule_values SET rule_name=\"$rule_name1\", rule_value=\"$rule_value\", ruleset_id=\"$ruleset_id1\", notes=\"$notes\" WHERE rule_name=\"$rule_name\" AND ruleset_id=\"$ruleset_id\"";
  $mysql->query_no_result($query);
}

function update_ruleset() {
  global $mysql;

  $ruleset_id = $_POST['ruleset_id'];
  $ruleset_id1 = $_POST['ruleset_id1'];
  $name = $_POST['name'];

  $query = "UPDATE rule_sets SET name=\"$name\", ruleset_id=\"$ruleset_id1\" WHERE ruleset_id=\"$ruleset_id\"";
  $mysql->query_no_result($query);
}

function update_zone() {
  global $mysql;

  $launcher1 = $_POST['launcher1'];
  $launcher = $_POST['launcher'];
  $zone1 = $_POST['zone1'];
  $zone = $_POST['zone'];
  $port = $_POST['port'];

  $query = "UPDATE launcher_zones SET launcher=\"$launcher1\", zone=\"$zone1\", port=\"$port\" WHERE launcher=\"$launcher\" and zone=\"$zone\"";
  $mysql->query_no_result($query);
}

function update_launcher() {
  global $mysql;

  $name1 = $_POST['name1'];
  $name = $_POST['name'];
  $dynamics = $_POST['dynamics'];

  $query = "UPDATE launcher SET name=\"$name1\", dynamics=\"$dynamics\" WHERE name=\"$name\"";
  $mysql->query_no_result($query);
}

function update_variable() {
  global $mysql;

  $varname = $_POST['varname'];
  $value = $mysql->real_escape_string($_POST['value']); 
  $information = $_POST['information'];
  $ts = $_POST['ts'];

  $query = "UPDATE variables SET varname=\"$varname\", value=\"$value\", information=\"$information\", ts=\"$ts\" WHERE varname=\"$varname\"";
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
  $ruleset_id = $_GET['ruleset_id'];

  $query = "DELETE FROM rule_values WHERE rule_name=\"$rule_name\" AND ruleset_id=\"$ruleset_id\"";
  $mysql->query_no_result($query);
}

function delete_ruleset() {
  global $mysql;

  $ruleset_id = $_GET['ruleset_id'];

  $query = "DELETE FROM rule_sets WHERE ruleset_id=\"$ruleset_id\"";
  $mysql->query_no_result($query);
}

function delete_ruleset_rules() {
  global $mysql;

  $ruleset_id = $_GET['ruleset_id'];

  $query = "DELETE FROM rule_sets WHERE ruleset_id=\"$ruleset_id\"";
  $mysql->query_no_result($query);

  $query = "DELETE FROM rule_values WHERE ruleset_id=\"$ruleset_id\"";
  $mysql->query_no_result($query);
}

function delete_zone() {
  global $mysql;

  $launcher = $_GET['launcher'];
  $zone = $_GET['zone'];

  $query = "DELETE FROM launcher_zones WHERE launcher=\"$launcher\" and zone=\"$zone\"";
  $mysql->query_no_result($query);
}

function delete_launcher() {
  global $mysql;

  $name = $_GET['name'];

  $query = "DELETE FROM launcher WHERE name=\"$name\"";
  $mysql->query_no_result($query);
}

function delete_variable() {
  global $mysql;

  $varname = $_GET['varname'];

  $query = "DELETE FROM variables WHERE varname=\"$varname\"";
  $mysql->query_no_result($query);
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

function add_ruleset() {
  global $mysql;

  $ruleset_id = $_POST['ruleset_id'];
  $name = $_POST['name']; 

  $query = "INSERT INTO rule_sets SET ruleset_id=\"$ruleset_id\", name=\"$name\"";
  $mysql->query_no_result($query);
}

function add_zone() {
  global $mysql;

  $launcher = $_POST['launcher'];
  $zone = $_POST['zone']; 
  $port = $_POST['port']; 

  $query = "INSERT INTO launcher_zones SET launcher=\"$launcher\", zone=\"$zone\", port=\"$port\"";
  $mysql->query_no_result($query);
}

function add_launcher() {
  global $mysql;

  $name = $_POST['name'];
  $dynamics = $_POST['dynamics']; 

  $query = "INSERT INTO launcher SET name=\"$name\", dynamics=\"$dynamics\"";
  $mysql->query_no_result($query);
}

function add_variable() {
  global $mysql;

  $varname = $_POST['varname'];
  $value = $mysql->real_escape_string($_POST['value']); 
  $information = $_POST['information'];
  $ts = $_POST['ts'];

  $query = "INSERT INTO variables SET varname=\"$varname\", value=\"$value\", information=\"$information\", ts=\"$ts\"";
  $mysql->query_no_result($query);
}

function copy_ruleset() {
  global $mysql;

  $ruleset_id = $_POST['ruleset_id'];
  $name = $_POST['name'];
  $name1 = $_POST['name1'];

  $query = "REPLACE INTO rule_sets SET name=\"$name1\", ruleset_id=\"$ruleset_id\"";
  $mysql->query_no_result($query);

  $query = "UPDATE rule_values rv
            INNER JOIN rule_sets rs ON rv.ruleset_id = rs.ruleset_id
            SET rv.ruleset_id=\"$ruleset_id\"
            WHERE rs.name=\"$name\"";
  $mysql->query_no_result($query);

  $query = "DELETE FROM rule_values WHERE ruleset_id=0";
  $mysql->query_no_result($query);

  $query = "INSERT INTO rule_values (rule_name,rule_value,notes) 
            SELECT rule_name,rule_value,notes FROM rule_values where ruleset_id=\"$ruleset_id\"";
  $mysql->query_no_result($query);
  
  $query = "SELECT ruleset_id FROM rule_sets where name=\"$name\"";
  $result = $mysql->query_assoc($query);
  $defaultid = $result['ruleset_id'];

  $query = "UPDATE rule_values set ruleset_id=$defaultid where ruleset_id=0";
  $mysql->query_no_result($query);
}

function suggest_ruleset_id() {
  global $mysql;

  $query = "SELECT MAX(ruleset_id) AS rsid FROM rule_sets";
  $result = $mysql->query_assoc($query);
  
  return ($result['rsid'] + 1);
}

function suggest_launcher() {
  global $mysql;

  $query = "SELECT name FROM launcher limit 1";
  $result = $mysql->query_assoc($query);
  
  return $result['name'];
}

function notify_status($new_status) {
  global $mysql;

  $bid = $_POST['bid'];
  $bug_date = $_POST['bug_date'];
  $bug = $_POST['bug'];
  $from = "SYSTEM";
  $to = $_POST['name'];
  $charid = getPlayerID($_POST['name']);
  $subject = "Bug Report Status Update";
  $note = $_POST['optional_note'];
  $body = "This is a system generated message to notify you that the status of your bug report has changed.\nDo not reply to this message.\n\nBug ID: " . $bid . "\nNew Status: " . $new_status . "\nBug Date: " . $bug_date . "\nBug: " . $bug;
  if ($note) {
    $body .= "\nAdmin Note: " . $note;
  }

  $query = "INSERT INTO mail (`charid`,`timestamp`,`from`,`subject`,`body`,`to`,`status`) VALUES ($charid,UNIX_TIMESTAMP(NOW()),\"$from\",\"$subject\",\"$body\",\"$to\",1)";
  $mysql->query_no_result($query);
}

function build_filter() {
  global $mysql;
  $filter1 = $_GET['filter1'];
  $filter2 = $_GET['filter2'];
  $filter3 = $_GET['filter3'];
  $filter4 = $_GET['filter4'];
  $filter_final = array();

  if ($filter1) { // Filter by account
    $filter_account = "account LIKE '%" . $filter1 . "%'";
    $filter_final['sql'] = $filter_account;
  }
  if ($filter2) { // Filter by name
    $filter_name = "name LIKE '%" . $filter2 . "%'";
    if ($filter_final['sql']) {
      $filter_final['sql'] .= " AND ";
    }
    $filter_final['sql'] .= $filter_name;
  }
  if ($filter3) { // Filter by zone
    $filter_zone = "zone LIKE '%" . $filter3 . "%'";
    if ($filter_final['sql']) {
      $filter_final['sql'] .= " AND ";
    }
    $filter_final['sql'] .= $filter_zone;
  }
  if ($filter4) { // Filter by hack
    $filter_hack = "hacked LIKE '%" . $filter4 . "%'";
    if ($filter_final['sql']) {
      $filter_final['sql'] .= " AND ";
    }
    $filter_final['sql'] .= $filter_hack;
  }

  $filter_final['url'] = "&filter=on&filter1=$filter1&filter2=$filter2&filter3=$filter3&filter4=$filter4";
  $filter_final['status'] = "on";
  $filter_final['filter1'] = $filter1;
  $filter_final['filter2'] = $filter2;
  $filter_final['filter3'] = $filter3;
  $filter_final['filter4'] = $filter4;

  return $filter_final;
}

function delete_multiple_hacks() {
  global $mysql;
  $hacks = $_POST['cb_delete'];

  foreach ($hacks as $hack) {
    $query = "DELETE FROM hackers WHERE id=$hack";
    $mysql->query_no_result($query);
  }
}

function get_bannedips() {
  global $mysql;

  $query = "SELECT ip_address, notes FROM Banned_IPs";
  $result = $mysql->query_mult_assoc($query);
  if ($result) {
    foreach ($result as $result) {
      $array['banned'][$result['ip_address']] = array("ip_address"=>$result['ip_address'], "notes"=>$result['notes']);
    }
  }
  return $array;
}

function add_bannedip() {
  global $mysql;

  $ip_address = $_POST['ip_address'];
  $notes = $_POST['notes']; 

  $query = "INSERT INTO Banned_IPs SET ip_address=\"$ip_address\", notes=\"$notes\"";
  $mysql->query_no_result($query);
}

function view_bannedips() {
  global $mysql;

  $ip_address = $_GET['ip'];

  $query = "SELECT ip_address,notes FROM Banned_IPs where ip_address = \"$ip_address\"";
  $result = $mysql->query_assoc($query);
  
  return $result;
}

function delete_bannedip() {
  global $mysql;

  $ip_address = $_GET['ip'];

  $query = "DELETE FROM Banned_IPs where ip_address = \"$ip_address\"";
  $mysql->query_no_result($query);
}

function update_bannedip() {
  global $mysql;

  $ip_address = $_POST['ip_address'];
  $notes = $_POST['notes']; 

  $query = "UPDATE Banned_IPs SET notes=\"$notes\" WHERE ip_address = \"$ip_address\"";
  $mysql->query_no_result($query);
}

function getCharCreateComboList() {
  global $mysql;

  $query = "SELECT * FROM char_create_combinations ORDER BY race, class, deity, start_zone";
  $results = $mysql->query_mult_assoc($query);

  return $results;
}
?>