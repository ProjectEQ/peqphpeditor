<?php

$bindallowed = array(
  0   => "No",
  1   => "Self",
  2   => "Others"
);

$blockedtype = array(
  0   => "Not Blocked",
  1   => "Zone Wide",
  2   => "Coords"
);

$zonetype = array(
  0   => "Unknown",
  1   => "Regular",
  2   => "Instanced",
  3   => "Hybrid",
  4   => "Raid",
  5   => "City"
);

switch ($action) {
  case 0:
    if (!$z) {
    }
    else {
        $body = new Template("templates/zone/zone.default.tmpl.php");
        $body->set('currzone', $z);
        $body->set('currzoneid', $zoneid);
    }
    break;
  case 1: // View zone data
    check_authorization();
    $breadcrumbs .= " >> Zone Data";
    $body = new Template("templates/zone/zone.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set("yesno", $yesno);
    $body->set("eqexpansions", $eqexpansions);
    $body->set("bindallowed", $bindallowed);
    $body->set("zonetype", $zonetype);
    $body->set('global', get_isglobal());
    $zone = get_zone();
    if ($zone) {
      foreach ($zone as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
   case 2: // Edit zone data
    check_authorization();
    $breadcrumbs .= " >> Edit Zone Data";
    $body = new Template("templates/zone/zone.edit.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set("yesno", $yesno);
    $body->set("eqexpansions", $eqexpansions);
    $body->set("bindallowed", $bindallowed);
    $body->set("zonetype", $zonetype);
    $body->set('global', get_isglobal());
    $zone = get_zone();
    if ($zone) {
      foreach ($zone as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
   case 3: // Update zone data
    check_authorization();
    update_zone();
    if (isset($_POST['global']) && $_POST['global'] == 1){
      update_global();
    }
    else delete_global();
      header("Location: index.php?editor=zone&z=$z&zoneid=$zoneid&action=1");
    exit;
   case 4: // View graveyard data
    $breadcrumbs .= " >> Graveyard Data";
    $body = new Template("templates/zone/graveyard.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('gravezone', get_graveyard_zone());
    $graveyard = get_graveyard();
    if ($graveyard) {
      foreach ($graveyard as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
   case 5: // Edit graveyard data
    check_authorization();
    $breadcrumbs .= " >> Graveyard Editor";
    $body = new Template("templates/zone/graveyard.edit.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $graveyard = get_graveyard();
    if ($graveyard) {
      foreach ($graveyard as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
   case 6: // Update graveyard data
    check_authorization();
    update_graveyard();
    $graveyard_id = $_POST['graveyard_id'];
    header("Location: index.php?editor=zone&z=$z&zoneid=$zoneid&graveyard_id=$graveyard_id&action=4");
    exit;
   case 7: // Delete graveyard data
    check_authorization();
    delete_graveyard();
    header("Location: index.php?editor=zone&z=$z&action=1");
    exit;
   case 8: // Add graveyard data
    check_authorization();
    $breadcrumbs .= " >> Add Graveyard";
    $body = new Template("templates/zone/graveyard.add.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('zid', getZoneID($z));
    $body->set('suggestgid', suggest_graveyard_id());
    break;
   case 9: // Insert graveyard data
    check_authorization();
    add_graveyard();
    $graveyard_id = $_POST['graveyard_id'];
    header("Location: index.php?editor=zone&z=$z&zoneid=$zoneid&graveyard_id=$graveyard_id&action=10");
    exit;
   case 10: // View graveyard data
    $breadcrumbs .= " >> Graveyard Data";
    $body = new Template("templates/zone/graveyard.view.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $graveyard = graveyard_info();
    if ($graveyard) {
      foreach ($graveyard as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
   case 11: // Delete graveyard data
    check_authorization();
    delete_graveyard();
    header("Location: index.php?editor=zone&z=$z&action=10");
    exit;
   case 12: // View zone points
    check_authorization();
    $breadcrumbs .= " >> Zone Points";
    $body = new Template("templates/zone/zonepoints.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $zonepoints = zonepoints_info();
    if ($zonepoints) {
      foreach ($zonepoints as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
   case 13: // Edit zone points
    check_authorization();
    $breadcrumbs .= " >> Zone Point Editor";
    $body = new Template("templates/zone/zonepoints.edit.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $zonepoints = get_zonepoints();
    if ($zonepoints) {
      foreach ($zonepoints as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
   case 14: // Update zone points
    check_authorization();
    update_zonepoints();
    header("Location: index.php?editor=zone&z=$z&zoneid=$zoneid&action=12");
    exit;
   case 15: // Delete zone points
    check_authorization();
    delete_zonepoints();
    header("Location: index.php?editor=zone&z=$z&zoneid=$zoneid&action=12");
    exit;
   case 16: // Get zonepoint ID
    check_authorization();
    $breadcrumbs .= " >> Add Zonepoint";
    $body = new Template("templates/zone/zonepoints.add.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('zid', getZoneID($z));
    $body->set('suggestzpid', suggest_zonepoint_id());
    $body->set('suggestnum', suggest_zonepoint_number());
    $body->set('suggestver', suggest_version());
    break;
   case 17: // Add zonepoint
    check_authorization();
    add_zonepoints();
    header("Location: index.php?editor=zone&z=$z&zoneid=$zoneid&action=12");
    exit;
   case 18: // View blocked spells
    check_authorization();
    $breadcrumbs .= " >> Blocked Spells";
    $body = new Template("templates/zone/blockedspell.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set("blockedtype", $blockedtype);
    $blockedspell = blockedspell_info();
    if ($blockedspell) {
      foreach ($blockedspell as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
   case 19: // Edit blocked spells
    check_authorization();
    $breadcrumbs .= " >> Blocked Spell Editor";
    $javascript = new Template("templates/iframes/js.tmpl.php");
    $body = new Template("templates/zone/blockedspell.edit.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set("blockedtype", $blockedtype);
    $blockedspell = get_blockedspell();
    if ($blockedspell) {
      foreach ($blockedspell as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
   case 20: // Update blocked spells
    check_authorization();
    update_blockedspell();
    header("Location: index.php?editor=zone&z=$z&zoneid=$zoneid&action=18");
    exit;
   case 21: // Delete blocked spells
    check_authorization();
    delete_blockedspell();
    header("Location: index.php?editor=zone&z=$z&zoneid=$zoneid&action=18");
    exit;
   case 22: // Get blocked spell ID
    check_authorization();
    $breadcrumbs .= " >> Add Blocked Spell";
    $javascript = new Template("templates/iframes/js.tmpl.php");
    $body = new Template("templates/zone/blockedspell.add.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('zid', getZoneID($z));
    $body->set('suggestbsid', suggest_blockedspell_id());
    break;
   case 23: // Add blockspell
    check_authorization();
    add_blockedspell();
    header("Location: index.php?editor=zone&z=$z&zoneid=$zoneid&action=18");
    exit;
   case 24:  // Copy zone
    check_authorization();
    $nzone = copy_zone();
     header("Location: index.php?editor=zone&z=$z&zoneid=$nzone&action=1");
    exit;
   case 25:  // Delete zone
    check_authorization();
    delete_zone();
    header("Location: index.php?editor=zone");
    exit;
}

function get_zone() {
  global $mysql, $zoneid;

  $query = "SELECT * FROM zone WHERE id=$zoneid";
  $result = $mysql->query_assoc($query);

  return $result;
}

function get_graveyard() {
  global $mysql; 

  $graveyard_id = $_GET['graveyard_id'];
 
  $query = "SELECT * FROM graveyard WHERE id=$graveyard_id";
  $result = $mysql->query_assoc($query);

  return $result;
}

function get_zonepoints() {
  global $mysql;

  $zpid = $_GET['zpid'];

  $query = "SELECT * FROM zone_points WHERE id=$zpid";
  $result = $mysql->query_assoc($query);

  return $result;
}

function get_blockedspell() {
  global $mysql;

  $bsid = $_GET['bsid'];

  $query = "SELECT id AS bsid,spellid,type,zoneid AS bszoneid, x AS x_coord,y AS y_coord,z AS z_coord,x_diff,y_diff,z_diff,message,description FROM blocked_spells WHERE id=\"$bsid\"";
  $result = $mysql->query_assoc($query);

  return $result;
}

function update_zone () {
  check_authorization();
  global $mysql, $zoneid;

  $oldstats = get_zone();
  extract($oldstats);

  $fields = '';
  if ($zoneidnumber != $_POST['zoneidnumber']) $fields .= "zoneidnumber=\"" . $_POST['zoneidnumber']. "\", ";
  if ($short_name != $_POST['short_name']) $fields .= "short_name=\"" . $_POST['short_name'] . "\", ";
  if ($file_name != $_POST['file_name']) $fields .= "file_name=\"" . $_POST['file_name'] . "\", ";
  if ($long_name != $_POST['long_name']) $fields .= "long_name=\"" . $_POST['long_name'] . "\", ";
  if ($safe_x != $_POST['safe_x']) $fields .= "safe_x=\"" . $_POST['safe_x'] . "\", ";
  if ($safe_y != $_POST['safe_y']) $fields .= "safe_y=\"" . $_POST['safe_y'] . "\", ";
  if ($safe_z != $_POST['safe_z']) $fields .= "safe_z=\"" . $_POST['safe_z'] . "\", ";
  if ($underworld != $_POST['underworld']) $fields .= "underworld=\"" . $_POST['underworld'] . "\", ";
  if ($timezone != $_POST['timezone']) $fields .= "timezone=\"" . $_POST['timezone'] . "\", ";
  if ($time_type != $_POST['time_type']) $fields .= "time_type=\"" . $_POST['time_type'] . "\", ";
  if ($note != $_POST['note']) $fields .= "note=\"" . $_POST['note'] . "\", ";
  if ($shutdowndelay != $_POST['shutdowndelay']) $fields .= "shutdowndelay=\"" . $_POST['shutdowndelay'] . "\", ";
  if ($graveyard_id != $_POST['graveyard_id']) $fields .= "graveyard_id=\"" . $_POST['graveyard_id'] . "\", ";
  if ($ztype != $_POST['ztype']) $fields .= "ztype=\"" . $_POST['ztype'] . "\", ";
  if ($zone_exp_multiplier != $_POST['zone_exp_multiplier']) $fields .= "zone_exp_multiplier=\"" . $_POST['zone_exp_multiplier'] . "\", ";
  if ($walkspeed != $_POST['walkspeed']) $fields .= "walkspeed=\"" . $_POST['walkspeed'] . "\", ";
  if ($min_level != $_POST['min_level']) $fields .= "min_level=\"" . $_POST['min_level'] . "\", ";
  if ($min_status != $_POST['min_status']) $fields .= "min_status=\"" . $_POST['min_status'] . "\", ";
  if ($maxclients != $_POST['maxclients']) $fields .= "maxclients=\"" . $_POST['maxclients'] . "\", ";
  if ($flag_needed != $_POST['flag_needed']) $fields .= "flag_needed=\"" . $_POST['flag_needed'] . "\", ";
  if ($canlevitate != $_POST['canlevitate']) $fields .= "canlevitate=\"" . $_POST['canlevitate'] . "\", ";
  if ($castoutdoor != $_POST['castoutdoor']) $fields .= "castoutdoor=\"" . $_POST['castoutdoor'] . "\", ";
  if ($cancombat != $_POST['cancombat']) $fields .= "cancombat=\"" . $_POST['cancombat'] . "\", ";
  if ($peqzone != $_POST['peqzone']) $fields .= "peqzone=\"" . $_POST['peqzone'] . "\", ";
  if ($canbind != $_POST['canbind']) $fields .= "canbind=\"" . $_POST['canbind'] . "\", ";
  if ($sky != $_POST['sky']) $fields .= "sky=\"" . $_POST['sky'] . "\", ";
  if ($minclip != $_POST['minclip']) $fields .= "minclip=\"" . $_POST['minclip'] . "\", ";
  if ($maxclip != $_POST['maxclip']) $fields .= "maxclip=\"" . $_POST['maxclip'] . "\", ";
  if ($fog_minclip != $_POST['fog_minclip']) $fields .= "fog_minclip=\"" . $_POST['fog_minclip'] . "\", ";
  if ($fog_maxclip != $_POST['fog_maxclip']) $fields .= "fog_maxclip=\"" . $_POST['fog_maxclip'] . "\", ";
  if ($fog_blue != $_POST['fog_blue']) $fields .= "fog_blue=\"" . $_POST['fog_blue'] . "\", ";
  if ($fog_red != $_POST['fog_red']) $fields .= "fog_red=\"" . $_POST['fog_red'] . "\", ";
  if ($fog_green != $_POST['fog_green']) $fields .= "fog_green=\"" . $_POST['fog_green'] . "\", ";
  if ($fog_minclip1 != $_POST['fog_minclip1']) $fields .= "fog_minclip1=\"" . $_POST['fog_minclip1'] . "\", ";
  if ($fog_maxclip1 != $_POST['fog_maxclip1']) $fields .= "fog_maxclip1=\"" . $_POST['fog_maxclip1'] . "\", ";
  if ($fog_blue1 != $_POST['fog_blue1']) $fields .= "fog_blue1=\"" . $_POST['fog_blue1'] . "\", ";
  if ($fog_red1 != $_POST['fog_red1']) $fields .= "fog_red1=\"" . $_POST['fog_red1'] . "\", ";
  if ($fog_green1 != $_POST['fog_green1']) $fields .= "fog_green1=\"" . $_POST['fog_green1'] . "\", ";
  if ($fog_minclip2 != $_POST['fog_minclip2']) $fields .= "fog_minclip2=\"" . $_POST['fog_minclip2'] . "\", ";
  if ($fog_maxclip2 != $_POST['fog_maxclip2']) $fields .= "fog_maxclip2=\"" . $_POST['fog_maxclip2'] . "\", ";
  if ($fog_blue2 != $_POST['fog_blue2']) $fields .= "fog_blue2=\"" . $_POST['fog_blue2'] . "\", ";
  if ($fog_red2 != $_POST['fog_red2']) $fields .= "fog_red2=\"" . $_POST['fog_red2'] . "\", ";
  if ($fog_green2 != $_POST['fog_green2']) $fields .= "fog_green2=\"" . $_POST['fog_green2'] . "\", ";
  if ($fog_minclip3 != $_POST['fog_minclip3']) $fields .= "fog_minclip3=\"" . $_POST['fog_minclip3'] . "\", ";
  if ($fog_maxclip3 != $_POST['fog_maxclip3']) $fields .= "fog_maxclip3=\"" . $_POST['fog_maxclip3'] . "\", ";
  if ($fog_blue3 != $_POST['fog_blue3']) $fields .= "fog_blue3=\"" . $_POST['fog_blue3'] . "\", ";
  if ($fog_red3 != $_POST['fog_red3']) $fields .= "fog_red3=\"" . $_POST['fog_red3'] . "\", ";
  if ($fog_green3 != $_POST['fog_green3']) $fields .= "fog_green3=\"" . $_POST['fog_green3'] . "\", ";
  if ($fog_minclip4 != $_POST['fog_minclip4']) $fields .= "fog_minclip4=\"" . $_POST['fog_minclip4'] . "\", ";
  if ($fog_maxclip4 != $_POST['fog_maxclip4']) $fields .= "fog_maxclip4=\"" . $_POST['fog_maxclip4'] . "\", ";
  if ($fog_blue4 != $_POST['fog_blue4']) $fields .= "fog_blue4=\"" . $_POST['fog_blue4'] . "\", ";
  if ($fog_red4 != $_POST['fog_red4']) $fields .= "fog_red4=\"" . $_POST['fog_red4'] . "\", ";
  if ($fog_green4 != $_POST['fog_green4']) $fields .= "fog_green4=\"" . $_POST['fog_green4'] . "\", ";
  if ($ruleset != $_POST['ruleset']) $fields .= "ruleset=\"" . $_POST['ruleset'] . "\", ";
  if ($version != $_POST['version']) $fields .= "version=\"" . $_POST['version'] . "\", ";
  if ($map_file_name != $_POST['map_file_name']) $fields .= "map_file_name=\"" . $_POST['map_file_name'] . "\", ";
  if ($fog_density != $_POST['fog_density']) $fields .= "fog_density=\"" . $_POST['fog_density'] . "\", ";
  if ($expansion != $_POST['expansion']) $fields .= "expansion=\"" . $_POST['expansion'] . "\", ";
  if ($suspendbuffs!= $_POST['suspendbuffs']) $fields .= "suspendbuffs=\"" . $_POST['suspendbuffs'] . "\", ";
  if ($type != $_POST['type']) $fields .= "type=\"" . $_POST['type'] . "\", ";
  if ($rain_chance1 != $_POST['rain_chance1']) $fields .= "rain_chance1=\"" . $_POST['rain_chance1'] . "\", ";
  if ($rain_chance2 != $_POST['rain_chance2']) $fields .= "rain_chance2=\"" . $_POST['rain_chance2'] . "\", ";
  if ($rain_chance3 != $_POST['rain_chance3']) $fields .= "rain_chance3=\"" . $_POST['rain_chance3'] . "\", ";
  if ($rain_chance4 != $_POST['rain_chance4']) $fields .= "rain_chance4=\"" . $_POST['rain_chance4'] . "\", ";     
  if ($rain_duration1 != $_POST['rain_duration1']) $fields .= "rain_duration1=\"" . $_POST['rain_duration1'] . "\", ";
  if ($rain_duration2 != $_POST['rain_duration2']) $fields .= "rain_duration2=\"" . $_POST['rain_duration2'] . "\", ";
  if ($rain_duration3 != $_POST['rain_duration3']) $fields .= "rain_duration3=\"" . $_POST['rain_duration3'] . "\", ";
  if ($rain_duration4 != $_POST['rain_duration4']) $fields .= "rain_duration4=\"" . $_POST['rain_duration4'] . "\", ";
  if ($snow_chance1 != $_POST['snow_chance1']) $fields .= "snow_chance1=\"" . $_POST['snow_chance1'] . "\", ";
  if ($snow_chance2 != $_POST['snow_chance2']) $fields .= "snow_chance2=\"" . $_POST['snow_chance2'] . "\", ";
  if ($snow_chance3 != $_POST['snow_chance3']) $fields .= "snow_chance3=\"" . $_POST['snow_chance3'] . "\", ";
  if ($snow_chance4 != $_POST['snow_chance4']) $fields .= "snow_chance4=\"" . $_POST['snow_chance4'] . "\", ";
  if ($snow_duration1 != $_POST['snow_duration1']) $fields .= "snow_duration1=\"" . $_POST['snow_duration1'] . "\", ";
  if ($snow_duration2 != $_POST['snow_duration2']) $fields .= "snow_duration2=\"" . $_POST['snow_duration2'] . "\", ";
  if ($snow_duration3 != $_POST['snow_duration3']) $fields .= "snow_duration3=\"" . $_POST['snow_duration3'] . "\", ";
  if ($snow_duration4 != $_POST['snow_duration4']) $fields .= "snow_duration4=\"" . $_POST['snow_duration4'] . "\", ";
  $fields =  rtrim($fields, ", ");

  if ($fields != '') {
    $query = "UPDATE zone SET $fields WHERE id=$zoneid";
    $mysql->query_no_result($query);
  }
}

function update_graveyard() {
  global $mysql;

  $zone_id = $_POST['zone_id'];
  $graveyard_id = $_POST['graveyard_id'];
  $zone_id = $_POST['zone_id']; 
  $x = $_POST['x']; 
  $y = $_POST['y'];
  $z_coord = $_POST['z_coord'];
  $heading = $_POST['heading'];

  $query = "UPDATE graveyard SET zone_id=\"$zone_id\", x=\"$x\", y=\"$y\", z=\"$z_coord\", heading=\"$heading\" WHERE id=\"$graveyard_id\"";
  $mysql->query_no_result($query);
}

function update_zonepoints() {
  global $mysql;

  $zpid = $_POST['zpid'];
  $zone = $_POST['zone']; 
  $number = $_POST['number'];
  $x = $_POST['x']; 
  $y = $_POST['y'];
  $z_coord = $_POST['z_coord'];
  $heading = $_POST['heading'];
  $target_x = $_POST['target_x']; 
  $target_y = $_POST['target_y'];
  $target_z = $_POST['target_z']; 
  $target_heading = $_POST['target_heading'];
  $zoneinst = $_POST['zoneinst'];
  $target_zone_id = $_POST['target_zone_id'];
  $version = $_POST['version'];
  $target_instance = $_POST['target_instance'];
  $client_version_mask = $_POST['client_version_mask'];

  $query = "UPDATE zone_points SET zone=\"$zone\", number=\"$number\", x=\"$x\", y=\"$y\", z=\"$z_coord\", heading=\"$heading\", target_x=\"$target_x\", target_y=\"$target_y\", target_z=\"$target_z\", target_heading=\"$target_heading\", zoneinst=\"$zoneinst\", target_zone_id=\"$target_zone_id\", version=\"$version\", target_instance=\"$target_instance\", client_version_mask=\"$client_version_mask\" WHERE id=\"$zpid\"";
  $mysql->query_no_result($query);
}

function update_blockedspell() {
  global $mysql;

  $bsid = $_POST['bsid'];
  $spellid = $_POST['spellid']; 
  $type = $_POST['type'];
  $x_coord = $_POST['x_coord']; 
  $y_coord = $_POST['y_coord'];
  $z_coord = $_POST['z_coord'];
  $x_diff = $_POST['x_diff'];
  $y_diff = $_POST['y_diff']; 
  $z_diff = $_POST['z_diff'];
  $message = $mysql->real_escape_string($_POST['message']); 
  $description = $_POST['description'];

  $query = "UPDATE blocked_spells SET spellid=\"$spellid\", type=\"$type\", x=\"$x_coord\", y=\"$y_coord\", z=\"$z_coord\", x_diff=\"$x_diff\", y_diff=\"$y_diff\", z_diff=\"$z_diff\", message=\"$message\", description=\"$description\" WHERE id=\"$bsid\"";
  $mysql->query_no_result($query);
}

function delete_graveyard() {
  global $mysql;
  
  $graveyard_id = $_GET['graveyard_id'];

  $query = "DELETE FROM graveyard WHERE id=\"$graveyard_id\"";
  $mysql->query_no_result($query);

  $query = "UPDATE zone SET graveyard_id=0 WHERE graveyard_id=\"$graveyard_id\"";
  $mysql->query_no_result($query);
}

function delete_zonepoints() {
  global $mysql;
  
  $zpid = $_GET['zpid'];

  $query = "DELETE FROM zone_points WHERE id=\"$zpid\"";
  $mysql->query_no_result($query);
}

function delete_blockedspell() {
  global $mysql;
  
  $bsid = $_GET['bsid'];

  $query = "DELETE FROM blocked_spells WHERE id=\"$bsid\"";
  $mysql->query_no_result($query);
}

function suggest_graveyard_id() {
  global $mysql;

  $query = "SELECT MAX(id) AS graveyard_id FROM graveyard";
  $result = $mysql->query_assoc($query);
  
  return ($result['graveyard_id'] + 1);
}

function suggest_zonepoint_id() {
  global $mysql;

  $query = "SELECT MAX(id) AS zpid FROM zone_points";
  $result = $mysql->query_assoc($query);
  
  return ($result['zpid'] + 1);
}

function suggest_zonepoint_number() {
  global $mysql, $z;

  $query = "SELECT MAX(number) AS num FROM zone_points WHERE zone=\"$z\"";
  $result = $mysql->query_assoc($query);
  
  return ($result['num'] + 1);
}

function suggest_blockedspell_id() {
  global $mysql;

  $query = "SELECT MAX(id) AS bsid FROM blocked_spells";
  $result = $mysql->query_assoc($query);
  
  return ($result['bsid'] + 1);
}

function add_graveyard() {
  global $mysql, $z;
  
  $zid = getZoneID($z);
  $graveyard_id = $_POST['graveyard_id'];
  $zone_id = $_POST['zone_id']; 
  $x = $_POST['x']; 
  $y = $_POST['y'];
  $z_coord = $_POST['z_coord'];
  $heading = $_POST['heading'];

  $query = "INSERT INTO graveyard SET id=\"$graveyard_id\", zone_id=\"$zone_id\", x=\"$x\", y=\"$y\", z=\"$z_coord\", heading=\"$heading\"";
  $mysql->query_no_result($query);

  $query = "UPDATE zone SET graveyard_id=\"$graveyard_id\" WHERE zoneidnumber=\"$zid\"";
  $mysql->query_no_result($query);
}

function add_zonepoints() {
  global $mysql;
  
  $zpid = $_POST['zpid'];
  $zone = $_POST['zone']; 
  $number = $_POST['number'];
  $x = $_POST['x']; 
  $y = $_POST['y'];
  $z_coord = $_POST['z_coord'];
  $heading = $_POST['heading'];
  $target_x = $_POST['target_x'];
  $target_y = $_POST['target_y']; 
  $target_z = $_POST['target_z']; 
  $target_heading = $_POST['target_heading'];
  $zoneinst = $_POST['zoneinst'];
  $target_zone_id = $_POST['target_zone_id'];
  $version = $_POST['version'];
  $target_instance = $_POST['target_instance'];
  $client_version_mask = $_POST['client_version_mask'];

  $query = "INSERT INTO zone_points SET id=\"$zpid\", zone=\"$zone\", number=\"$number\", x=\"$x\", y=\"$y\", z=\"$z_coord\", heading=\"$heading\", target_x=\"$target_x\", target_y=\"$target_y\", target_z=\"$target_z\", target_heading=\"$target_heading\", zoneinst=\"$zoneinst\", target_zone_id=\"$target_zone_id\", buffer=0, version=\"$version\", target_instance=\"$target_instance\", client_version_mask=\"$client_version_mask\"";
  $mysql->query_no_result($query);
}

function add_blockedspell() {
  global $mysql;

  $bsid = $_POST['bsid'];
  $zoneid = $_POST['zoneid'];
  $spellid = $_POST['spellid']; 
  $type = $_POST['type'];
  $x_coord = $_POST['x_coord']; 
  $y_coord = $_POST['y_coord'];
  $z_coord = $_POST['z_coord'];
  $x_diff = $_POST['x_diff'];
  $y_diff = $_POST['y_diff']; 
  $z_diff = $_POST['z_diff'];
  $message = $mysql->real_escape_string($_POST['message']); 
  $description = $_POST['description'];

  $query = "INSERT INTO blocked_spells SET id=\"$bsid\", zoneid=\"$zoneid\", spellid=\"$spellid\", type=\"$type\", x=\"$x_coord\", y=\"$y_coord\", z=\"$z_coord\", x_diff=\"$x_diff\", y_diff=\"$y_diff\", z_diff=\"$z_diff\", message=\"$message\", description=\"$description\"";
  $mysql->query_no_result($query);
}

function graveyard_info() {
  global $mysql;
  $array = array();
  
  $query = "SELECT * FROM graveyard";
  $result = $mysql->query_mult_assoc($query);
  if ($result) {
    foreach ($result as $result) {
     $array['graveyard'][$result['id']] = array("graveyard_id"=>$result['id'], "zone_id"=>$result['zone_id'], "x"=>$result['x'], "y"=>$result['y'], "z_coord"=>$result['z'], "heading"=>$result['heading']);
         }
       }
  return $array;
  }

function zonepoints_info() {
  global $mysql, $z, $zoneid;
  $array = array();

  $query = "SELECT version AS zversion FROM zone where id=$zoneid";
  $result = $mysql->query_assoc($query);
  $zversion = $result['zversion'];

  $query = "SELECT * FROM zone_points WHERE zone=\"$z\" AND version=$zversion";
  $result = $mysql->query_mult_assoc($query);
  if ($result) {
    foreach ($result as $result) {
    $array['zonepoints'][$result['id']] = array("zpid"=>$result['id'], "zone"=>$result['zone'], "number"=>$result['number'], "x_coord"=>$result['x'], "y_coord"=>$result['y'], "z_coord"=>$result['z'], "heading"=>$result['heading'], "target_x"=>$result['target_x'], "target_y"=>$result['target_y'], "target_z"=>$result['target_z'], "target_heading"=>$result['target_heading'], "zoneinst"=>$result['zoneinst'], "target_zone_id"=>$result['target_zone_id'], "version"=>$result['version'], "target_instance"=>$result['target_instance'], "client_version_mask"=>$result['client_version_mask']);
         }
       }
  return $array;
  }

function blockedspell_info() {
  global $mysql, $z;
  $zid = getZoneID($z);
  $array = array();

  $query = "SELECT * FROM blocked_spells WHERE zoneid=\"$zid\"";
  $result = $mysql->query_mult_assoc($query);
  if ($result) {
    foreach ($result as $result) {
     $array['blockedspell'][$result['id']] = array("bsid"=>$result['id'], "spellid"=>$result['spellid'], "type"=>$result['type'], "zoneid"=>$result['zoneid'], "x_coord"=>$result['x'], "y_coord"=>$result['y'], "z_coord"=>$result['z'], "x_diff"=>$result['x_diff'], "y_diff"=>$result['y_diff'], "z_diff"=>$result['z_diff'], "message"=>$result['message'], "description"=>$result['description']);
         }
       }
  return $array;
  }

function get_graveyard_zone() {
   global $mysql;

   $graveyard_id = $_GET['graveyard_id'];

   $query = "SELECT short_name FROM zone WHERE graveyard_id=\"$graveyard_id\" limit 1";
   $result = $mysql->query_assoc($query);

  return $result['short_name'];
}

function copy_zone() {
  check_authorization();
  global $mysql, $zoneid, $z;

  $query = "DELETE FROM zone WHERE id=0";
  $mysql->query_no_result($query);

  $query = "INSERT INTO zone (`short_name`, `file_name`, `long_name`, `map_file_name`, `safe_x`, `safe_y`, `safe_z`, `graveyard_id`, `min_level`, `min_status`, `zoneidnumber`, `version`, `timezone`, `maxclients`, `ruleset`, `note`, `underworld`, `minclip`, `maxclip`, `fog_minclip`, `fog_maxclip`, `fog_blue`, `fog_red`, `fog_green`, `sky`, `ztype`, `zone_exp_multiplier`, `walkspeed`, `time_type`, `fog_red1`, `fog_green1`, `fog_blue1`, `fog_minclip1`, `fog_maxclip1`, `fog_red2`, `fog_green2`, `fog_blue2`, `fog_minclip2`, `fog_maxclip2`, `fog_red3`, `fog_green3`, `fog_blue3`, `fog_minclip3`, `fog_maxclip3`, `fog_red4`, `fog_green4`, `fog_blue4`, `fog_minclip4`, `fog_maxclip4`, `fog_density`, `flag_needed`, `canbind`, `cancombat`, `canlevitate`, `castoutdoor`, `hotzone`, `insttype`, `shutdowndelay`, `peqzone`, `expansion`, `suspendbuffs`, `type`, `weather_rate`, `rain_chance1`, `rain_chance2`, `rain_chance3`, `rain_chance4`, `rain_duration1`, `rain_duration2`, `rain_duration3`, `rain_duration4`, `snow_chance1`, `snow_chance2`, `snow_chance3`, `snow_chance4`, `snow_duration1`, `snow_duration2`, `snow_duration3`, `snow_duration4`)
            SELECT `short_name`, `file_name`, `long_name`, `map_file_name`, `safe_x`, `safe_y`, `safe_z`, `graveyard_id`, `min_level`, `min_status`, `zoneidnumber`, `version`, `timezone`, `maxclients`, `ruleset`, `note`, `underworld`, `minclip`, `maxclip`, `fog_minclip`, `fog_maxclip`, `fog_blue`, `fog_red`, `fog_green`, `sky`, `ztype`, `zone_exp_multiplier`, `walkspeed`, `time_type`, `fog_red1`, `fog_green1`, `fog_blue1`, `fog_minclip1`, `fog_maxclip1`, `fog_red2`, `fog_green2`, `fog_blue2`, `fog_minclip2`, `fog_maxclip2`, `fog_red3`, `fog_green3`, `fog_blue3`, `fog_minclip3`, `fog_maxclip3`, `fog_red4`, `fog_green4`, `fog_blue4`, `fog_minclip4`, `fog_maxclip4`, `fog_density`, `flag_needed`, `canbind`, `cancombat`, `canlevitate`, `castoutdoor`, `hotzone`, `insttype`, `shutdowndelay`, `peqzone`, `expansion`, `suspendbuffs`, `type`, `weather_rate`, `rain_chance1`, `rain_chance2`, `rain_chance3`, `rain_chance4`, `rain_duration1`, `rain_duration2`, `rain_duration3`, `rain_duration4`, `snow_chance1`, `snow_chance2`, `snow_chance3`, `snow_chance4`, `snow_duration1`, `snow_duration2`, `snow_duration3`, `snow_duration4` FROM zone where id=$zoneid";
  $mysql->query_no_result($query);

  $query = "SELECT MAX(id) as zid FROM zone";
  $result = $mysql->query_assoc($query);
  $nzone = $result['zid'];

  $query2 = "SELECT MAX(version+1) as zver FROM zone WHERE short_name=\"$z\"";
  $result2 = $mysql->query_assoc($query2);
  $nver = $result2['zver'];

  $query = "UPDATE zone set version=$nver where id=$nzone";
  $mysql->query_no_result($query);
   
  return $nzone;
}

function delete_zone() {
  check_authorization();
  global $mysql, $zoneid;

  $query = "DELETE FROM zone WHERE id=$zoneid";
  $mysql->query_no_result($query);
}
   
function get_isglobal () {
  global $mysql, $z, $zoneid;

  $zid = getZoneID($z);

  $query1 = "SELECT version AS zversion FROM zone where id=$zoneid";
  $result1 = $mysql->query_assoc($query1);
  $zversion = $result1['zversion'];

  $query = "SELECT count(*) FROM instance_list WHERE zone=$zid AND version=$zversion";
  $result = $mysql->query_assoc($query);

  return $result['count(*)'];
}

function update_global () {
  global $mysql, $z, $zoneid;

  $zid = getZoneID($z);

  $query1 = "SELECT version AS zversion FROM zone where id=$zoneid";
  $result1 = $mysql->query_assoc($query1);
  $zversion = $result1['zversion'];

  $query2 = "SELECT id AS currid from instance_list WHERE zone=$zid AND version=$zversion AND id < 30";
  $result2 = $mysql->query_assoc($query2);
  $currid = $result2['currid'];

  $query = "REPLACE INTO instance_list SET id=$currid, zone=$zid, version=$zversion, is_global=1, never_expires=1";
  $mysql->query_no_result($query);
  }

function delete_global () {
  global $mysql, $z, $zoneid;

  $zid = getZoneID($z);

  $query1 = "SELECT version AS zversion FROM zone where id=$zoneid";
  $result1 = $mysql->query_assoc($query1);
  $zversion = $result1['zversion'];

  $query = "DELETE FROM instance_list WHERE zone=$zid AND version=$zversion AND id < 30";
  $mysql->query_no_result($query);
}
?>