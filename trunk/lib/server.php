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

  $query = "SELECT id, account, name, hacked, zone, date FROM hackers limit 500";
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

function update_bugs() {
  global $mysql;

  $bid = $_POST['bid'];
  $status = $_POST['status'];

  $query = "UPDATE bugs SET status=\"$status\" WHERE id=\"$bid\"";
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
?>