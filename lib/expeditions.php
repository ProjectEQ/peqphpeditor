<?
$dynamic_zone_type = array(
  0 => "None",
  1 => "Expedition",
  2 => "Tutorial",
  3 => "Task",
  4 => "Mission",
  5 => "Quest"
);

$default_page = 1;
$default_size = 50;
$default_sort = 1;

$columns = array(
  1 => 'id',
  2 => 'character_id',
  3 => 'expedition_name',
  4 => 'event_name',
  5 => 'expire_time'
);

switch ($action) {
  case 0: // Default View
    $body = new Template("templates/expeditions/expeditions.default.tmpl.php");
    break;
  case 1: // View Expeditions
    $body = new Template("templates/expeditions/expeditions.view.tmpl.php");
    $breadcrumbs .= " >> View Expeditions";
    $body->set('yesno', $yesno);
    $expeditions = get_expeditions();
    if ($expeditions) {
      $body->set('expeditions', $expeditions);
    }
    break;
  case 2: // Add Expedition
    check_authorization();
    $body = new Template("templates/expeditions/expeditions.add.tmpl.php");
    $breadcrumbs .= " >> <a href=\"index.php?editor=expeditions&action=1\">View Expeditions</a>" . " >> Add Expedition";
    $body->set('suggest_id', suggest_expedition_id());
    break;
  case 3: // Insert Expedition
    check_authorization();
    insert_expedition();
    $id = $_POST['id'];
    header("Location: index.php?editor=expeditions&action=1");
    exit;
  case 4: // Edit Expedition
    $body = new Template("templates/expeditions/expeditions.edit.tmpl.php");
    $breadcrumbs .= " >> <a href=\"index.php?editor=expeditions&action=1\">View Expeditions</a>" . " >> Edit Expedition";
    $body->set('yesno', $yesno);
    $body->set('dynamic_zone_type', $dynamic_zone_type);
    $body->set('zoneids', $zoneids);
    $expedition = get_expedition($_GET['id']);
    if ($expedition) {
      $body->set('expedition', $expedition);
    }
    $expedition_lockout = get_expedition_lockout_by_expedition($_GET['id']);
    if ($expedition_lockout) {
      $body->set('expedition_lockout', $expedition_lockout);
    }
    $dynamic_zone_members = get_dynamic_zone_members($_GET['id']);
    if ($dynamic_zone_members) {
      $body->set('dynamic_zone_members', $dynamic_zone_members);
    }
    $dynamic_zone = get_dynamic_zone($expedition['dynamic_zone_id']);
    if ($dynamic_zone) {
      $body->set('dynamic_zone', $dynamic_zone);
    }
    break;
  case 5: // Update Expedition
    check_authorization();
    update_expedition();
    $id = $_POST['id'];
    header("Location: index.php?editor=expeditions&action=1");
    exit;
  case 6: // Delete Expedition
    check_authorization();
    delete_expedition($_GET['id']);
    header("Location: index.php?editor=expeditions&action=1");
    exit;
  case 7: // View Expedition Lockouts
    $body = new Template("templates/expeditions/expedition.lockouts.view.tmpl.php");
    $breadcrumbs .= " >> View Expedition Lockouts";
    $expedition_lockouts = get_expedition_lockouts();
    if ($expedition_lockouts) {
      $body->set('expedition_lockouts', $expedition_lockouts);
    }
    break;
  case 8: // Add Expedition Lockout
    check_authorization();
    $body = new Template("templates/expeditions/expedition.lockout.add.tmpl.php");
    $breadcrumbs .= " >> <a href=\"index.php?editor=expeditions&action=7\">View Expedition Lockouts</a>" . " >> Add Expedition Lockout";
    $body->set('suggest_id', suggest_expedition_lockout_id());
    break;
  case 9: // Insert Expedition Lockout
    check_authorization();
    insert_expedition_lockout();
    $id = $_POST['id'];
    header("Location: index.php?editor=expeditions&action=7");
    exit;
  case 10: // Edit Expedition Lockout
    $body = new Template("templates/expeditions/expedition.lockout.edit.tmpl.php");
    $breadcrumbs .= " >> <a href=\"index.php?editor=expeditions&action=7\">View Expedition Lockouts</a>" . " >> Edit Expedition Lockout";
    $expedition_lockout = get_expedition_lockout($_GET['id']);
    if ($expedition_lockout) {
      $body->set('expedition_lockout', $expedition_lockout);
    }
    break;
  case 11: // Update Expedition Lockout
    check_authorization();
    update_expedition_lockout();
    $id = $_POST['id'];
    header("Location: index.php?editor=expeditions&action=7");
    exit;
  case 12: // Delete Expedition Lockout
    check_authorization();
    delete_expedition_lockout($_GET['id']);
    header("Location: index.php?editor=expeditions&action=7");
    exit;
  case 13: // View Dynamic Zones
    $body = new Template("templates/expeditions/dynamic.zones.view.tmpl.php");
    $breadcrumbs .= " >> View Dynamic Zones";
    $body->set('dynamic_zone_type', $dynamic_zone_type);
    $dynamic_zones = get_dynamic_zones();
    if ($dynamic_zones) {
      $body->set('dynamic_zones', $dynamic_zones);
    }
    break;
  case 14: // Add Dynamic Zone
    check_authorization();
    $body = new Template("templates/expeditions/dynamic.zone.add.tmpl.php");
    $breadcrumbs .= " >> <a href=\"index.php?editor=expeditions&action=13\">View Dynamic Zones</a>" . " >> Add Dynamic Zone";
    $body->set('dynamic_zone_type', $dynamic_zone_type);
    $body->set('zoneids', $zoneids);
    $body->set('suggest_id', suggest_dynamic_zone_id());
    break;
  case 15: // Insert Dynamic Zone
    check_authorization();
    insert_dynamic_zone();
    $id = $_POST['id'];
    header("Location: index.php?editor=expeditions&action=13");
    exit;
  case 16: // Edit Dynamic Zone
    $body = new Template("templates/expeditions/dynamic.zone.edit.tmpl.php");
    $breadcrumbs .= " >> <a href=\"index.php?editor=expeditions&action=13\">View Dynamic Zones</a>" . " >> Edit Dynamic Zone";
    $body->set('dynamic_zone_type', $dynamic_zone_type);
    $body->set('zoneids', $zoneids);
    $dynamic_zone = get_dynamic_zone($_GET['id']);
    if ($dynamic_zone) {
      $body->set('dynamic_zone', $dynamic_zone);
    }
    break;
  case 17: // Update Dynamic Zone
    check_authorization();
    update_dynamic_zone();
    $id = $_POST['id'];
    header("Location: index.php?editor=expeditions&action=13");
    exit;
  case 18: // Delete Dynamic Zone
    check_authorization();
    delete_dynamic_zone($_GET['id']);
    header("Location: index.php?editor=expeditions&action=13");
    exit;
  case 19: // View Dynamic Zone Members
    $body = new Template("templates/expeditions/dynamic.zone.members.view.tmpl.php");
    $breadcrumbs .= " >> View Dynamic Zone Members";
    $body->set('yesno', $yesno);
    $dynamic_zone_members = get_dynamic_zone_members();
    if ($dynamic_zone_members) {
      $body->set('dynamic_zone_members', $dynamic_zone_members);
    }
    break;
  case 20: // Add Dynamic Zone Member
    check_authorization();
    $body = new Template("templates/expeditions/dynamic.zone.member.add.tmpl.php");
    $breadcrumbs .= " >> <a href=\"index.php?editor=expeditions&action=19\">View Dynamic Zone Members</a>" . " >> Add Dynamic Zone Member";
    $body->set('suggest_id', suggest_dynamic_zone_member_id());
    break;
  case 21: // Insert Dynamic Zone Member
    check_authorization();
    insert_dynamic_zone_member();
    $id = $_POST['id'];
    header("Location: index.php?editor=expeditions&action=19");
    exit;
  case 22: // Edit Dynamic Zone Member
    $body = new Template("templates/expeditions/dynamic.zone.member.edit.tmpl.php");
    $breadcrumbs .= " >> <a href=\"index.php?editor=expeditions&action=19\">View Dynamic Zone Members</a>" . " >> Edit Dynamic Zone Member";
    $dynamic_zone_member = get_dynamic_zone_member($_GET['id']);
    if ($dynamic_zone_member) {
      $body->set('dynamic_zone_member', $dynamic_zone_member);
    }
    break;
  case 23: // Update Dynamic Zone Member
    check_authorization();
    update_dynamic_zone_member();
    $id = $_POST['id'];
    header("Location: index.php?editor=expeditions&action=19");
    exit;
  case 24: // Delete Dynamic Zone Member
    check_authorization();
    delete_dynamic_zone_member($_GET['id']);
    if ($_GET['return'] == 1) {
      $return_address = $_SERVER['HTTP_REFERER'];
      header("Location: $return_address");
    }
    else {
      header("Location: index.php?editor=expeditions&action=19");
    }
    exit;
  case 25: // View Character Lockouts
    $curr_page = (isset($_GET['page'])) ? $_GET['page'] : $default_page;
    $curr_size = (isset($_GET['size'])) ? $_GET['size'] : $default_size;
    $curr_sort = (isset($_GET['sort'])) ? $columns[$_GET['sort']] : $columns[$default_sort];
    if (isset($_GET['filter']) && $_GET['filter'] == 'on') {
      $filter = build_filter();
    }
    $body = new Template("templates/expeditions/character.lockouts.view.tmpl.php");
    $breadcrumbs .= " >> View Character Lockouts";
    $page_stats = getPageInfo("character_expedition_lockouts", FALSE, $curr_page, $curr_size, ((isset($_GET['sort'])) ? $_GET['sort'] : null), ((isset($filter)) ? $filter['sql'] : null));
    if (isset($filter)) {
      $body->set('filter', $filter);
    }
    if ($page_stats['page']) {
      $character_lockouts = get_character_lockouts($page_stats['page'], $curr_size, $curr_sort, $filter['sql']);
    }
    if (isset($character_lockouts)) {
      $body->set('character_lockouts', $character_lockouts);
      foreach ($page_stats as $key=>$value) {
        $body->set($key, $value);
      }
    }
    else {
      $body->set('page', 0);
      $body->set('pages', 0);
    }
    break;
  case 26: // Add Character Lockout
    check_authorization();
    $body = new Template("templates/expeditions/character.lockout.add.tmpl.php");
    $breadcrumbs .=  " >> <a href=\"index.php?editor=expeditions&action=25\">View Character Lockouts</a>" . " >> Add Character Lockout";
    $body->set('suggest_id', suggest_character_lockout_id());
    break;
  case 27: // Insert Character Lockout
    check_authorization();
    insert_character_lockout();
    $id = $_POST['id'];
    header("Location: index.php?editor=expeditions&action=25");
    exit;
  case 28: // Edit Character Lockout
    $body = new Template("templates/expeditions/character.lockout.edit.tmpl.php");
    $breadcrumbs .= " >> <a href=\"index.php?editor=expeditions&action=25\">View Character Lockouts</a>" . " >> Edit Character Lockout";
    $character_lockout = get_character_lockout($_GET['id']);
    if ($character_lockout) {
      $body->set('character_lockout', $character_lockout);
    }
    break;
  case 29: // Update Character Lockout
    check_authorization();
    update_character_lockout();
    $id = $_POST['id'];
    header("Location: index.php?editor=expeditions&action=25");
    exit;
  case 30: // Delete Character Lockout
    check_authorization();
    delete_character_lockout($_GET['id']);
    header("Location: index.php?editor=expeditions&action=25");
    exit;
  case 31: // View Dynamic Zone Templates
    $body = new Template("templates/expeditions/dynamic.zone.templates.tmpl.php");
    $breadcrumbs .= " >> Dynamic Zone Templates";
    $dynamic_zone_templates = get_dynamic_zone_templates();
    $body->set('zoneids', $zoneids);
    if ($dynamic_zone_templates) {
      $body->set('dynamic_zone_templates', $dynamic_zone_templates);
    }
    break;
  case 32: // Add Dynamic Zone Templates
    $body = new Template("templates/expeditions/dynamic.zone.template.add.tmpl.php");
    $breadcrumbs .=  " >> <a href=\"index.php?editor=expeditions&action=31\">Dynamic Zone Templates</a>" . " >> Add Template";
    $body->set('suggest_id', suggest_dynamic_zone_template_id());
    $body->set('zoneids', $zoneids);
    break;
  case 33: // Insert Dynamic Zone Templates
    check_authorization();
    insert_dynamic_zone_template();
    header("Location: index.php?editor=expeditions&action=31");
    exit;
  case 34: // Edit Dynamic Zone Templates
    $body = new Template("templates/expeditions/dynamic.zone.template.edit.tmpl.php");
    $breadcrumbs .=  " >> <a href=\"index.php?editor=expeditions&action=31\">Dynamic Zone Templates</a>" . " >> Edit Template";
    $dynamic_zone_template = get_dynamic_zone_template($_GET['id']);
    $body->set('zoneids', $zoneids);
    if ($dynamic_zone_template) {
      $body->set('dynamic_zone_template', $dynamic_zone_template);
    }
    break;
  case 35: // Update Dynamic Zone Templates
    check_authorization();
    update_dynamic_zone_template();
    header("Location: index.php?editor=expeditions&action=31");
    exit;
  case 36: // Delete Dynamic Zone Templates
    check_authorization();
    delete_dynamic_zone_template($_GET['id']);
    header("Location: index.php?editor=expeditions&action=31");
    exit;
}

function get_expeditions() {
  global $mysql;

  $query = "SELECT * FROM expeditions";
  $results = $mysql->query_mult_assoc($query);

  if ($results) {
    return $results;
  }
  else {
    return null;
  }
}

function get_expedition($id) {
  global $mysql;

  $query = "SELECT * FROM expeditions WHERE id=$id";
  $result = $mysql->query_assoc($query);

  if ($result) {
    return $result;
  }
  else {
    return null;
  }
}

function insert_expedition() {
  global $mysql;

  $id = $_POST['id'];
  $dynamic_zone_id = $_POST['dynamic_zone_id'];
  $add_replay_on_join = $_POST['add_replay_on_join'];
  $is_locked = $_POST['is_locked'];

  $query = "INSERT INTO expeditions SET id=$id, dynamic_zone_id=$dynamic_zone_id, add_replay_on_join=$add_replay_on_join, is_locked=$is_locked";
  $mysql->query_no_result($query);
}

function update_expedition() {
  global $mysql;

  $id = $_POST['id'];
  $dynamic_zone_id = $_POST['dynamic_zone_id'];
  $add_replay_on_join = $_POST['add_replay_on_join'];
  $is_locked = $_POST['is_locked'];

  $query = "UPDATE expeditions SET dynamic_zone_id=$dynamic_zone_id, add_replay_on_join=$add_replay_on_join, is_locked=$is_locked WHERE id=$id";
  $mysql->query_no_result($query);
}

function delete_expedition($id) {
  global $mysql;

  $query = "DELETE FROM expeditions WHERE id=$id";
  $mysql->query_no_result($query);
}

function suggest_expedition_id() {
  global $mysql;

  $query = "SELECT MAX(id) AS id FROM expeditions";
  $result = $mysql->query_assoc($query);

  return $result['id'] + 1;
}

function get_expedition_lockouts() {
  global $mysql;

  $query = "SELECT * FROM expedition_lockouts";
  $results = $mysql->query_mult_assoc($query);

  if ($results) {
    return $results;
  }
  else {
    return null;
  }
}

function get_expedition_lockout($id) {
  global $mysql;

  $query = "SELECT * FROM expedition_lockouts WHERE id=$id";
  $result = $mysql->query_assoc($query);

  if ($result) {
    return $result;
  }
  else {
    return null;
  }
}

function insert_expedition_lockout() {
  global $mysql;

  $id = $_POST['id'];
  $expedition_id = $_POST['expedition_id'];
  $event_name = $_POST['event_name'];
  $expire_time = $_POST['expire_time'];
  $duration = $_POST['duration'];
  $from_expedition_uuid = $_POST['from_expedition_uuid'];

  $query = "INSERT INTO expedition_lockouts SET id=$id, expedition_id=$expedition_id, event_name=\"$event_name\", expire_time=\"$expire_time\", duration=$duration, from_expedition_uuid=\"$from_expedition_uuid\"";
  $mysql->query_no_result($query);
}

function update_expedition_lockout() {
  global $mysql;

  $id = $_POST['id'];
  $expedition_id = $_POST['expedition_id'];
  $event_name = $_POST['event_name'];
  $expire_time = $_POST['expire_time'];
  $duration = $_POST['duration'];
  $from_expedition_uuid = $_POST['from_expedition_uuid'];

  $query = "UPDATE expedition_lockouts SET expedition_id=$expedition_id, event_name=\"$event_name\", expire_time=\"$expire_time\", duration=$duration, from_expedition_uuid=\"$from_expedition_uuid\" WHERE id=$id";
  $mysql->query_no_result($query);
}

function delete_expedition_lockout($id) {
  global $mysql;

  $query = "DELETE FROM expedition_lockouts WHERE id=$id";
  $mysql->query_no_result($query);
}

function suggest_expedition_lockout_id() {
  global $mysql;

  $query = "SELECT MAX(id) AS id FROM expedition_lockouts";
  $result = $mysql->query_assoc($query);

  return $result['id'] + 1;
}

function get_dynamic_zones() {
  global $mysql;

  $query = "SELECT * FROM dynamic_zones";
  $results = $mysql->query_mult_assoc($query);

  if ($results) {
    return $results;
  }
  else {
    return null;
  }
}

function get_dynamic_zone($id) {
  global $mysql;

  $query = "SELECT * FROM dynamic_zones WHERE id=$id";
  $result = $mysql->query_assoc($query);

  if ($result) {
    return $result;
  }
  else {
    return null;
  }
}

function insert_dynamic_zone() {
  global $mysql;

  $id = $_POST['id'];
  $instance_id = $_POST['instance_id'];
  $type = $_POST['type'];
  $uuid = $_POST['uuid'];
  $name = $_POST['name'];
  $leader_id = $_POST['leader_id'];
  $min_players = $_POST['min_players'];
  $max_players = $_POST['max_players'];
  $dz_switch_id = $_POST['dz_switch_id'];
  $compass_zone_id = $_POST['compass_zone_id'];
  $compass_x = $_POST['compass_x'];
  $compass_y = $_POST['compass_y'];
  $compass_z= $_POST['compass_z'];
  $safe_return_zone_id = $_POST['safe_return_zone_id'];
  $safe_return_x = $_POST['safe_return_x'];
  $safe_return_y = $_POST['safe_return_y'];
  $safe_return_z = $_POST['safe_return_z'];
  $safe_return_heading = $_POST['safe_return_heading'];
  $zone_in_x = $_POST['zone_in_x'];
  $zone_in_y = $_POST['zone_in_y'];
  $zone_in_z = $_POST['zone_in_z'];
  $zone_in_heading = $_POST['zone_in_heading'];
  $has_zone_in = $_POST['has_zone_in'];

  $query = "INSERT INTO dynamic_zones SET id=$id, instance_id=$instance_id, `type`=$type, uuid=\"$uuid\", name=\"$name\", leader_id=$leader_id, min_players=$min_players, max_players=$max_players, dz_switch_id=$dz_switch_id, compass_zone_id=$compass_zone_id, compass_x=$compass_x, compass_y=$compass_y, compass_z=$compass_z, safe_return_zone_id=$safe_return_zone_id, safe_return_x=$safe_return_x, safe_return_y=$safe_return_y, safe_return_z=$safe_return_z, safe_return_heading=$safe_return_heading, zone_in_x=$zone_in_x, zone_in_y=$zone_in_y, zone_in_z=$zone_in_z, zone_in_heading=$zone_in_heading, has_zone_in=$has_zone_in";
  $mysql->query_no_result($query);
}

function update_dynamic_zone() {
  global $mysql;

  $id = $_POST['id'];
  $instance_id = $_POST['instance_id'];
  $type = $_POST['type'];
  $type = $_POST['type'];
  $uuid = $_POST['uuid'];
  $name = $_POST['name'];
  $leader_id = $_POST['leader_id'];
  $min_players = $_POST['min_players'];
  $max_players = $_POST['max_players'];
  $dz_switch_id = $_POST['dz_switch_id'];
  $compass_zone_id = $_POST['compass_zone_id'];
  $compass_x = $_POST['compass_x'];
  $compass_y = $_POST['compass_y'];
  $compass_z= $_POST['compass_z'];
  $safe_return_zone_id = $_POST['safe_return_zone_id'];
  $safe_return_x = $_POST['safe_return_x'];
  $safe_return_y = $_POST['safe_return_y'];
  $safe_return_z = $_POST['safe_return_z'];
  $safe_return_heading = $_POST['safe_return_heading'];
  $zone_in_x = $_POST['zone_in_x'];
  $zone_in_y = $_POST['zone_in_y'];
  $zone_in_z = $_POST['zone_in_z'];
  $zone_in_heading = $_POST['zone_in_heading'];
  $has_zone_in = $_POST['has_zone_in'];

  $query = "UPDATE dynamic_zones SET instance_id=$instance_id, `type`=$type, uuid=\"$uuid\", name=\"$name\", leader_id=$leader_id, min_players=$min_players, max_players=$max_players, dz_switch_id=$dz_switch_id, compass_zone_id=$compass_zone_id, compass_x=$compass_x, compass_y=$compass_y, compass_z=$compass_z, safe_return_zone_id=$safe_return_zone_id, safe_return_x=$safe_return_x, safe_return_y=$safe_return_y, safe_return_z=$safe_return_z, safe_return_heading=$safe_return_heading, zone_in_x=$zone_in_x, zone_in_y=$zone_in_y, zone_in_z=$zone_in_z, zone_in_heading=$zone_in_heading, has_zone_in=$has_zone_in WHERE id=$id";
  $mysql->query_no_result($query);
}

function delete_dynamic_zone($id) {
  global $mysql;

  $query = "DELETE FROM dynamic_zones WHERE id=$id";
  $mysql->query_no_result($query);
}

function suggest_dynamic_zone_id() {
  global $mysql;

  $query = "SELECT MAX(id) AS id FROM dynamic_zones";
  $result = $mysql->query_assoc($query);

  return $result['id'] + 1;
}

function get_dynamic_zone_members($dynamic_zone_id = null) {
  global $mysql;
  $query = "";

  if ($dynamic_zone_id) {
    $query = "SELECT * FROM dynamic_zone_members WHERE dynamic_zone_id=$dynamic_zone_id";
  }
  else {
    $query = "SELECT * FROM dynamic_zone_members";
  }
  $results = $mysql->query_mult_assoc($query);

  if ($results) {
    return $results;
  }
  else {
    return null;
  }
}

function get_dynamic_zone_member($id) {
  global $mysql;

  $query = "SELECT * FROM dynamic_zone_members WHERE id=$id";
  $result = $mysql->query_assoc($query);

  if ($result) {
    return $result;
  }
  else {
    return null;
  }
}

function insert_dynamic_zone_member() {
  global $mysql;

  $id = $_POST['id'];
  $dynamic_zone_id = $_POST['dynamic_zone_id'];
  $character_id = $_POST['character_id'];

  $query = "INSERT INTO dynamic_zone_members SET id=$id, dynamic_zone_id=$dynamic_zone_id, character_id=$character_id";
  $mysql->query_no_result($query);
}

function update_dynamic_zone_member() {
  global $mysql;

  $id = $_POST['id'];
  $dynamic_zone_id = $_POST['dynamic_zone_id'];
  $character_id = $_POST['character_id'];

  $query = "UPDATE dynamic_zone_members SET dynamic_zone_id=$dynamic_zone_id, character_id=$character_id WHERE id=$id";
  $mysql->query_no_result($query);
}

function delete_dynamic_zone_member($id) {
  global $mysql;

  $query = "DELETE FROM dynamic_zone_members WHERE id=$id";
  $mysql->query_no_result($query);
}

function suggest_dynamic_zone_member_id() {
  global $mysql;

  $query = "SELECT MAX(id) AS id FROM dynamic_zone_members";
  $result = $mysql->query_assoc($query);

  return $result['id'] + 1;
}

function get_dynamic_zone_templates() {
  global $mysql_content_db;

  $query = "SELECT * FROM dynamic_zone_templates";
  $results = $mysql_content_db->query_mult_assoc($query);

  if ($results) {
    return $results;
  }
  else {
    return null;
  }
}

function get_dynamic_zone_template($id) {
  global $mysql_content_db;

  $query = "SELECT * FROM dynamic_zone_templates WHERE id=$id";
  $result = $mysql_content_db->query_assoc($query);

  if ($result) {
    return $result;
  }
  else {
    return null;
  }
}

function insert_dynamic_zone_template() {
  global $mysql_content_db;

  $id = $_POST['id'];
  $zone_id = $_POST['zone_id'];
  $zone_version = $_POST['zone_version'];
  $name = $_POST['name'];
  $min_players = $_POST['min_players'];
  $max_players = $_POST['max_players'];
  $duration_seconds = $_POST['duration_seconds'];
  $dz_switch_id = $_POST['dz_switch_id'];
  $compass_zone_id = $_POST['compass_zone_id'];
  $compass_x = $_POST['compass_x'];
  $compass_y = $_POST['compass_y'];
  $compass_z = $_POST['compass_z'];
  $return_zone_id = $_POST['return_zone_id'];
  $return_x = $_POST['return_x'];
  $return_y = $_POST['return_y'];
  $return_z = $_POST['return_z'];
  $return_h = $_POST['return_h'];
  $override_zone_in = $_POST['override_zone_in'];
  $zone_in_x = $_POST['zone_in_x'];
  $zone_in_y = $_POST['zone_in_y'];
  $zone_in_z = $_POST['zone_in_z'];
  $zone_in_h = $_POST['zone_in_h'];

  $query = "INSERT INTO dynamic_zone_templates SET id=$id, zone_id=$zone_id, zone_version=$zone_version, name=\"$name\", min_players=$min_players, max_players=$max_players, duration_seconds=$duration_seconds, dz_switch_id=$dz_switch_id, compass_zone_id=$compass_zone_id, compass_x=$compass_x, compass_y=$compass_y, compass_z=$compass_z, return_zone_id=$return_zone_id, return_x=$return_x, return_y=$return_y, return_z=$return_z, return_h=$return_h, override_zone_in=$override_zone_in, zone_in_x=$zone_in_x, zone_in_y=$zone_in_y, zone_in_z=$zone_in_z, zone_in_h=$zone_in_h";
  $mysql_content_db->query_no_result($query);
}

function update_dynamic_zone_template() {
  global $mysql_content_db;

  $id = $_POST['id'];
  $zone_id = $_POST['zone_id'];
  $zone_version = $_POST['zone_version'];
  $name = $_POST['name'];
  $min_players = $_POST['min_players'];
  $max_players = $_POST['max_players'];
  $duration_seconds = $_POST['duration_seconds'];
  $dz_switch_id = $_POST['dz_switch_id'];
  $compass_zone_id = $_POST['compass_zone_id'];
  $compass_x = $_POST['compass_x'];
  $compass_y = $_POST['compass_y'];
  $compass_z = $_POST['compass_z'];
  $return_zone_id = $_POST['return_zone_id'];
  $return_x = $_POST['return_x'];
  $return_y = $_POST['return_y'];
  $return_z = $_POST['return_z'];
  $return_h = $_POST['return_h'];
  $override_zone_in = $_POST['override_zone_in'];
  $zone_in_x = $_POST['zone_in_x'];
  $zone_in_y = $_POST['zone_in_y'];
  $zone_in_z = $_POST['zone_in_z'];
  $zone_in_h = $_POST['zone_in_h'];

  $query = "UPDATE dynamic_zone_templates SET zone_id=$zone_id, zone_version=$zone_version, name=\"$name\", min_players=$min_players, max_players=$max_players, duration_seconds=$duration_seconds, dz_switch_id=$dz_switch_id, compass_zone_id=$compass_zone_id, compass_x=$compass_x, compass_y=$compass_y, compass_z=$compass_z, return_zone_id=$return_zone_id, return_x=$return_x, return_y=$return_y, return_z=$return_z, return_h=$return_h, override_zone_in=$override_zone_in, zone_in_x=$zone_in_x, zone_in_y=$zone_in_y, zone_in_z=$zone_in_z, zone_in_h=$zone_in_h WHERE id=$id";
  $mysql_content_db->query_no_result($query);
}

function delete_dynamic_zone_template($id) {
  global $mysql_content_db;

  $query = "DELETE FROM dynamic_zone_templates WHERE id=$id";
  $mysql_content_db->query_no_result($query);
}

function suggest_dynamic_zone_template_id() {
  global $mysql_content_db;

  $query = "SELECT MAX(id) AS id FROM dynamic_zone_templates";
  $result = $mysql_content_db->query_assoc($query);

  return $result['id'] + 1;
}

function get_character_lockouts($page_number, $results_per_page, $sort_by, $where = "") {
  global $mysql;
  $limit = ($page_number - 1) * $results_per_page . "," . $results_per_page;

  $query = "SELECT * FROM character_expedition_lockouts";
  if ($where) {
    $query .= " WHERE $where";
  }
  $query .= " ORDER BY $sort_by LIMIT $limit";
  $results = $mysql->query_mult_assoc($query);

  if ($results) {
    return $results;
  }
  else {
    return null;
  }
}

function get_character_lockout($id) {
  global $mysql;

  $query = "SELECT * FROM character_expedition_lockouts WHERE id=$id";
  $result = $mysql->query_assoc($query);

  if ($result) {
    return $result;
  }
  else {
    return null;
  }
}

function insert_character_lockout() {
  global $mysql;

  $id = $_POST['id'];
  $character_id = $_POST['character_id'];
  $expedition_name = $_POST['expedition_name'];
  $event_name = $_POST['event_name'];
  $expire_time = $_POST['expire_time'];
  $duration = $_POST['duration'];
  $from_expedition_uuid = $_POST['from_expedition_uuid'];

  $query = "INSERT INTO character_expedition_lockouts SET id=$id, character_id=$character_id, expedition_name=\"$expedition_name\", event_name=\"$event_name\", expire_time=\"$expire_time\", duration=$duration, from_expedition_uuid=\"$from_expedition_uuid\"";
  $mysql->query_no_result($query);
}

function update_character_lockout() {
  global $mysql;

  $id = $_POST['id'];
  $character_id = $_POST['character_id'];
  $expedition_name = $_POST['expedition_name'];
  $event_name = $_POST['event_name'];
  $expire_time = $_POST['expire_time'];
  $duration = $_POST['duration'];
  $from_expedition_uuid = $_POST['from_expedition_uuid'];

  $query = "UPDATE character_expedition_lockouts SET character_id=$character_id, expedition_name=\"$expedition_name\", event_name=\"$event_name\", expire_time=\"$expire_time\", duration=$duration, from_expedition_uuid=\"$from_expedition_uuid\" WHERE id=$id";
  $mysql->query_no_result($query);
}

function delete_character_lockout($id) {
  global $mysql;

  $query = "DELETE FROM character_expedition_lockouts WHERE id=$id";
  $mysql->query_no_result($query);
}

function suggest_character_lockout_id() {
  global $mysql;

  $query = "SELECT MAX(id) AS id FROM character_expedition_lockouts";
  $result = $mysql->query_assoc($query);

  return $result['id'] + 1;
}

function get_expedition_lockout_by_expedition($expedition_id) {
  global $mysql;

  $query = "SELECT * FROM expedition_lockouts WHERE expedition_id=$expedition_id";
  $result = $mysql->query_assoc($query);

  if ($result) {
    return $result;
  }
  else {
    return null;
  }
}

function build_filter() {
  global $mysql;
  $filter1 = $_GET['filter1'];
  $filter2 = $_GET['filter2'];
  $filter3 = $_GET['filter3'];
  $filter_final = array();

  if ($filter1) { // Filter by character
    $query = "SELECT id FROM character_data WHERE name LIKE '%$filter1%'";
    $results = $mysql->query_mult_assoc($query);
    $filter_character_id = "character_id IN (";
    if ($results) {
      foreach ($results as $result) {
        $filter_character_id .= $result['id'] . ",";
      }
      $filter_character_id = rtrim($filter_character_id, ",");
    }
    else {
      $filter_character_id .= "NULL";
    }
    $filter_character_id .= ")";
    if ($filter_final['sql']) {
      $filter_final['sql'] .= " AND ";
    }
    $filter_final['sql'] .= $filter_character_id;
  }
  if ($filter2) { // Filter by expedition
    if ($filter_final['sql']) {
      $filter_final['sql'] .= " AND ";
    }
    $filter_expedition = "`expedition_name` LIKE '%" . $filter2 . "%'";
    $filter_final['sql'] .= $filter_expedition;
  }
  if ($filter3) { // Filter by event
    $filter_event = "`event_name` LIKE '%" . $filter3 . "%'";
    $filter_final['sql'] = $filter_event;
  }

  $filter_final['url'] = "&filter=on&filter1=$filter1&filter2=$filter2&filter3=$filter3";
  $filter_final['status'] = "on";
  $filter_final['filter1'] = $filter1;
  $filter_final['filter2'] = $filter2;
  $filter_final['filter3'] = $filter3;

  return $filter_final;
}
?>