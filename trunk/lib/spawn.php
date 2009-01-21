<?

switch ($action) {
  case 0:  // View Spawngroups
    if ($npcid) {
      $body = new Template("templates/spawn/spawn.tmpl.php");
      $body->set('currzone', $z);
      $body->set('npcid', $npcid);
      $spawngroups = get_spawngroups();
      $body->set('spawngroups', $spawngroups);
    }
    else {
      if ($z) {
        $body = new Template("templates/spawn/spawn.default.tmpl.php");
        $body->set('currzone', $z);
      }
    }
    break;
  case 1: // Edit Spawngroup Member
    check_authorization();
    $body = new Template("templates/spawn/spawn.member.edit.tmpl.php");
    $body->set('currzone', $z);
    $body->set('npcid', $npcid);
    $body->set('sgnpcid', $_GET['sgnpcid']);
    $body->set('npcname', getNPCName($_GET['sgnpcid']));
    $vars = get_spawngroup_member_info();
    if ($vars) {
      foreach ($vars as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
  case 2:  // Update Spawngroup member
    check_authorization();
    update_spawngroup_member();
    header("Location: index.php?editor=spawn&z=$z&npcid=$npcid");
    exit;
  case 3:  // Balance spawngroup spawns
    check_authorization();
    balance_spawns();
    header("Location: index.php?editor=spawn&z=$z&npcid=$npcid");
    exit;
  case 4: // Edit Spawngroup name
    check_authorization();
    $body = new Template("templates/spawn/spawngroup.name.edit.tmpl.php");
    $body->set('currzone', $z);
    $body->set('npcid', $npcid);
    $body->set('sid', $_GET['sid']);
    $vars = get_spawngroup_info();
    if ($vars) {
      foreach ($vars as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
  case 5:  // Update spawngroup name
    check_authorization();
    update_spawngroup_name();
    header("Location: index.php?editor=spawn&z=$z&npcid=$npcid");
    exit;
  case 6:  // Delete spawngroup
    check_authorization();
    delete_spawngroup();
    header("Location: index.php?editor=spawn&z=$z&npcid=$npcid");
    exit;
  case 7:  // Delete spawngroup member
    check_authorization();
    delete_spawngroup_member();
    header("Location: index.php?editor=spawn&z=$z&npcid=$npcid");
    exit;
  case 8: // Add spawngroup member
    check_authorization();
    $body = new Template("templates/spawn/spawngroup.member.add.tmpl.php");
    $body->set('currzone', $z);
    $body->set('npcid', $npcid);
    $body->set('sid', $_GET['sid']);
    $vars = get_spawngroup_info();
    if ($vars) {
      foreach ($vars as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
  case 9: // Process add npc form
    check_authorization();
    if (isset($_POST['search']) && ($_POST['search'] != '')) {
      $body = new Template("templates/spawn/spawngroup.member.searchresults.tmpl.php");
      $body->set('currzone', $z);
      $body->set('npcid', $npcid);
      $body->set('sid', $_GET['sid']);
      $results = search_npc_types($_POST['search']);
      $body->set('results', $results);
    }
    else {
      add_spawngroup_member($_REQUEST['npc']);
      header("Location: index.php?editor=spawn&z=$z&npcid=$npcid");
      exit;
    }
    break;
  case 10:  // View Spawnpoints
check_authorization();
  if ($npcid) {
      $body = new Template("templates/spawn/spawnpoint.tmpl.php");
      $body->set('currzone', $z);
      $body->set('npcid', $npcid);
      $sid = $_GET['sid'];
      $body->set('sid', $sid);
      $spawnpoints = get_spawnpoints();
      $body->set('spawnpoints', $spawnpoints);
    }
    break;
  case 11:  // Edit Spawnpoint
    check_authorization();
    $body = new Template("templates/spawn/spawnpoint.edit.tmpl.php");
    $body->set('currzone', $z);
    $body->set('npcid', $npcid);
    $spawnpoint = spawnpoint_info();
    if ($spawnpoint) {
      foreach ($spawnpoint as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
  case 12:  // Update spawnpoint
    check_authorization();
    update_spawnpoint();
    $sid = $_POST['spawngroupID'];
    header("Location: index.php?editor=spawn&z=$z&npcid=$npcid&sid=$sid&action=10");
    exit;
  case 13: // Delete spawnpoint
    check_authorization();
    delete_spawnpoint();
    $sid = $_GET['sid'];
    header("Location: index.php?editor=spawn&z=$z&npcid=$npcid&sid=$sid&action=10");
    exit;
  case 14: // Add spawnpoint
    check_authorization();
    $body = new Template("templates/spawn/spawnpoint.add.tmpl.php");
    $body->set('currzone', $z);
    $body->set('zone', $z);
    $body->set('npcid', $npcid);
    $sid = $_GET['sid'];
    $body->set('spawngroupID', $sid);
    $body->set('suggestedid', suggest_spawnpoint_id());
    break;
  case 15:  // Add Spawnpoint
    check_authorization();
    add_spawnpoint();
    $sid = $_POST['spawngroupID'];
    header("Location: index.php?editor=spawn&z=$z&npcid=$npcid&sid=$sid&action=10");
    exit;
  case 16: // Add Spawngroup
    check_authorization();
    $body = new Template("templates/spawn/spawngroup.add.tmpl.php");
    $body->set('currzone', $z);
    $body->set('suggestedid', suggest_spawngroup_id());
    break;
  case 17:  // Add Spawngroup
    check_authorization();
    add_spawngroup();
    $npcid = $_POST['npcID'];
    header("Location: index.php?editor=spawn&z=$z&npcid=$npcid");
    exit;
}

function get_spawngroups() {
  global $mysql, $npcid;

  $query = "SELECT * FROM spawnentry WHERE npcID=$npcid ORDER BY spawngroupID";
  $results = $mysql->query_mult_assoc($query);

  if (!$results) return;

  for($x=0; $x<count($results); $x++) {
    $id = $results[$x]['spawngroupID'];

    $query = "SELECT name, spawn_limit, dist, max_x, min_x, max_y, min_y, delay FROM spawngroup WHERE id=$id";
    $result = $mysql->query_assoc($query);
    $results[$x]['name'] = $result['name'];
    $results[$x]['spawn_limit'] = $result['spawn_limit'];
    $results[$x]['dist'] = $result['dist'];
    $results[$x]['max_x'] = $result['max_x'];
    $results[$x]['min_x'] = $result['min_x'];
    $results[$x]['max_y'] = $result['max_y'];
    $results[$x]['min_y'] = $result['min_y'];
    $results[$x]['delay'] = $result['delay'];

    $query = "SELECT * FROM spawnentry WHERE spawngroupID=$id";
    $results2 = $mysql->query_mult_assoc($query);
    foreach ($results2 as $r2) {
      $r2['name'] = getNPCName($r2['npcID']);
      $results[$x]['npcs'][] = $r2;
    }
  }
  return $results;
}

function get_spawngroup_member_info() {
  global $mysql;

  $sid = $_GET['sid'];
  $npc = $_GET['sgnpcid'];

  $query = "SELECT * FROM spawnentry WHERE spawngroupID=$sid AND npcID=$npc";
  $result = $mysql->query_assoc($query);

  return $result;
}

function add_spawngroup_member() {
  check_authorization();
  global $mysql;

  $sid = $_REQUEST['sid'];
  $npc = $_REQUEST['npc'];

  $query = "INSERT INTO spawnentry SET spawngroupID=$sid, npcID=$npc";
  $mysql->query_no_result($query);
}

function update_spawngroup_member() {
  check_authorization();
  global $mysql;

  $spawngroupID = $_POST['spawngroupID'];
  $chance = $_POST['chance'];
  $npc = $_POST['sgnpcid'];

  $query = "UPDATE spawnentry SET chance=$chance WHERE spawngroupID=$spawngroupID AND npcID=$npc";
  $mysql->query_no_result($query);
}

function delete_spawngroup_member() {
  check_authorization();
  global $mysql;
  $sid = $_GET['sid'];
  $npc = $_GET['sgnpcid'];

  $query = "DELETE FROM spawnentry WHERE spawngroupID=$sid AND npcID=$npc";
  $mysql->query_no_result($query);
}

function balance_spawns () {
  check_authorization();
  global $mysql;
  $sid = $_GET['sid'];

  $query = "SELECT count(npcID) AS count FROM spawnentry WHERE spawngroupID=$sid";
  $result = $mysql->query_assoc($query);

  $count = $result['count'];

  $remainder = 100 % $count;
  $base = floor(100 / $count);
  $x = $count - $remainder;

  $query = "SELECT * FROM spawnentry WHERE spawngroupID=$sid";
  $results = $mysql->query_mult_assoc($query);

  foreach ($results as $result) {
    $npc = $result['npcID'];
    if ($x > 0) {
      $chance = $base;
      $x--;
    }
    else $chance = $base + 1;
    $query = "UPDATE spawnentry SET chance=$chance WHERE spawngroupID=$sid AND npcID=$npc";
    $mysql->query_no_result($query);
  }
}

function get_spawngroup_info() {
  global $mysql;
  $sid = $_GET['sid'];

  $query = "SELECT name, spawn_limit, dist, max_x, min_x, max_y, min_y, delay FROM spawngroup WHERE id=$sid";
  $result = $mysql->query_assoc($query);

  return $result;
}

function update_spawngroup_name() {
  check_authorization();
  global $mysql;
  $sid = $_GET['sid'];
  $name = $_POST['name'];
  $spawn_limit = $_POST['spawn_limit'];
  $dist = $_POST['dist'];
  $max_x = $_POST['max_x'];
  $min_x = $_POST['min_x'];
  $max_y = $_POST['max_y'];
  $min_y = $_POST['min_y'];
  $delay = $_POST['delay'];

  $query = "UPDATE spawngroup SET name=\"$name\", spawn_limit=\"$spawn_limit\", dist=\"$dist\", max_x=\"$max_x\", min_x=\"$min_x\", max_y=\"$max_y\", min_y=\"$min_y\", delay=\"$delay\" WHERE id=$sid";
  $mysql->query_no_result($query);
}

function delete_spawngroup() {
  check_authorization();
  global $mysql;
  $sid = $_GET['sid'];

  $query = "DELETE FROM spawngroup WHERE id=$sid";
  $mysql->query_no_result($query);

  $query = "DELETE FROM spawnentry WHERE spawngroupID=$sid";
  $mysql->query_no_result($query);

  $query = "DELETE FROM spawn2 WHERE spawngroupID=$sid";
  $mysql->query_no_result($query);
}

function search_npc_types ($search) {
  global $mysql;

  $query = "SELECT id, name, level FROM npc_types WHERE name rlike \"$search\"";
  $results = $mysql->query_mult_assoc($query);

  return $results;
}

function get_spawnpoints () {
  global $mysql;
  $sid = $_GET['sid'];

  $query = "SELECT * FROM spawn2 WHERE spawngroupID=$sid ORDER BY id";
  $results = $mysql->query_mult_assoc($query);

  return $results;
}

function spawnpoint_info () {
  global $mysql;
  $id = $_REQUEST['id'];

  $query = "SELECT * FROM spawn2 WHERE id=$id";
  $result = $mysql->query_assoc($query);

  return $result;
}

function update_spawnpoint() {
  check_authorization();
  global $mysql;
  $id = $_POST['id'];

  $old = spawnpoint_info();

  $fields = '';
  foreach ($old as $k => $v) {
    if ($v != $_POST["$k"]) {
      $fields .= "$k=\"" . $_POST["$k"] . "\", ";
    }
  }

  $fields =  rtrim($fields, ", ");

  if ($fields != '') {
    $query = "UPDATE spawn2 SET $fields WHERE id=$id";
    $mysql->query_no_result($query);
  }
}

function delete_spawnpoint() {
  check_authorization();
  global $mysql;
  $id = $_GET['id'];

  $query = "DELETE FROM spawn2 WHERE id=$id";
  $mysql->query_no_result($query);
}

function suggest_spawngroup_id() {
  global $mysql, $z;

  $zid = getZoneID($z) . "___";

  $query = "SELECT max(id) AS id FROM spawngroup";
  $result = $mysql->query_assoc($query);
  $id1 = $result['id'];

  $query = "SELECT MAX(spawngroupID) AS id FROM spawnentry WHERE spawngroupID LIKE \"$zid\"";
  $result = $mysql->query_assoc($query);
  $id2 = $result['id'];

  $query = "SELECT MAX(spawngroupID) AS id FROM spawn2 WHERE spawngroupID LIKE \"$zid\"";
  $result = $mysql->query_assoc($query);
  $id3 = $result['id'];

  $id = max($id1, $id2, $id3);

  return ($id + 1);
}

function suggest_spawnpoint_id() {
  global $mysql;

  $query = "SELECT MAX(id) AS id FROM spawn2";
  $result = $mysql->query_assoc($query);

  return ($result['id'] + 1);
}

function add_spawnpoint() {
  check_authorization();
  global $mysql;
  $id = $_POST['id'];
  $spawngroupID = $_POST['spawngroupID'];
  $zone = $_POST['zone'];
  $x = $_POST['x'];
  $y = $_POST['y'];
  $z = $_POST['z'];
  $heading = $_POST['heading'];
  $respawntime = $_POST['respawntime'];
  $variance = $_POST['variance'];
  $pathgrid = $_POST['pathgrid'];
  $condition = $_POST['_condition'];
  $cond_value = $_POST['cond_value'];

  $query = "INSERT INTO spawn2 SET id=$id, spawngroupID=$spawngroupID, zone=\"$zone\", x=$x, y=$y, z=$z, heading=$heading, respawntime=$respawntime, variance=$variance, pathgrid=$pathgrid, _condition=$condition, cond_value=$cond_value";
  $mysql->query_no_result($query);
}

function add_spawngroup() {
  check_authorization();
  global $mysql;

  $id = $_POST['id'];
  $name = $_POST['name'];
  $npcID = $_POST['npcID'];
  $spawn_limit = intval($_POST['spawn_limit']);
  $dist = intval($_POST['dist']);
  $max_x = intval($_POST['max_x']);
  $min_x = intval($_POST['min_x']);
  $max_y = intval($_POST['max_y']);
  $min_y = intval($_POST['min_y']);
  $delay = intval($_POST['delay']);
  $query = "INSERT INTO spawngroup VALUES($id, \"$name\", \"$spawn_limit\", \"$dist\", \"$max_x\", \"$min_x\", \"$max_y\", \"$min_y\", \"$delay\")";
  $mysql->query_no_result($query);

  $query = "INSERT INTO spawnentry SET spawngroupID=$id, npcID=$npcID, chance=100";
  $mysql->query_no_result($query);
}

?>
