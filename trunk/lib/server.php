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

function view_bugs() {
  global $mysql;

  $bid = $_GET['bid'];

  $query = "SELECT id AS bid, zone, name, ui, x, y, z, type, flag, target, bug, date, status FROM bugs where id = \"$bid\"";
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

?>