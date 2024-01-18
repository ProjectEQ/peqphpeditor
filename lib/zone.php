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
   case 16: // Add zonepoint
    check_authorization();
    $breadcrumbs .= " >> Add Zonepoint";
    $body = new Template("templates/zone/zonepoints.add.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('id', getZoneID($z));
    $body->set('suggestzpid', suggest_zonepoint_id());
    $body->set('suggestnum', suggest_zonepoint_number());
    $body->set('suggestver', suggest_version());
    break;
   case 17: // Insert zonepoint
    check_authorization();
    add_zonepoints();
    header("Location: index.php?editor=zone&z=$z&zoneid=$zoneid&action=12");
    exit;
   case 18: // View blocked spells
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
   case 22: // Add blockspell
    check_authorization();
    $breadcrumbs .= " >> Add Blocked Spell";
    $javascript = new Template("templates/iframes/js.tmpl.php");
    $body = new Template("templates/zone/blockedspell.add.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('zid', getZoneID($z));
    $body->set('suggestbsid', suggest_blockedspell_id());
    break;
   case 23: // Insert blockspell
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
  global $mysql_content_db, $zoneid;

  $query = "SELECT * FROM zone WHERE id=$zoneid";
  $result = $mysql_content_db->query_assoc($query);

  return $result;
}

function get_graveyard() {
  global $mysql_content_db; 

  $graveyard_id = $_GET['graveyard_id'];
 
  $query = "SELECT * FROM graveyard WHERE id=$graveyard_id";
  $result = $mysql_content_db->query_assoc($query);

  return $result;
}

function get_zonepoints() {
  global $mysql_content_db;

  $zpid = $_GET['zpid'];

  $query = "SELECT * FROM zone_points WHERE id=$zpid";
  $result = $mysql_content_db->query_assoc($query);

  return $result;
}

function get_blockedspell() {
  global $mysql_content_db;

  $bsid = $_GET['bsid'];

  $query = "SELECT id AS bsid, spellid, type, zoneid AS bszoneid, x AS x_coord, y AS y_coord, z AS z_coord, x_diff, y_diff, z_diff, message, description, min_expansion, max_expansion, content_flags, content_flags_disabled FROM blocked_spells WHERE id=\"$bsid\"";
  $result = $mysql_content_db->query_assoc($query);

  return $result;
}

function update_zone() {
  global $mysql_content_db, $zoneid;

  $oldstats = get_zone();
  extract($oldstats);

  $fields = '';
  if ($short_name != $_POST['short_name']) $fields .= "short_name=\"" . $_POST['short_name'] . "\", ";
  if ($file_name != $_POST['file_name']) $fields .= "file_name=\"" . $_POST['file_name'] . "\", ";
  if ($long_name != $_POST['long_name']) $fields .= "long_name=\"" . $_POST['long_name'] . "\", ";
  if ($map_file_name != $_POST['map_file_name']) $fields .= "map_file_name=\"" . $_POST['map_file_name'] . "\", ";
  if ($safe_x != $_POST['safe_x']) $fields .= "safe_x=\"" . $_POST['safe_x'] . "\", ";
  if ($safe_y != $_POST['safe_y']) $fields .= "safe_y=\"" . $_POST['safe_y'] . "\", ";
  if ($safe_z != $_POST['safe_z']) $fields .= "safe_z=\"" . $_POST['safe_z'] . "\", ";
  if ($safe_heading != $_POST['safe_heading']) $fields .= "safe_heading=\"" . $_POST['safe_heading'] . "\", ";
  if ($graveyard_id != $_POST['graveyard_id']) $fields .= "graveyard_id=\"" . $_POST['graveyard_id'] . "\", ";
  if ($min_level != $_POST['min_level']) $fields .= "min_level=\"" . $_POST['min_level'] . "\", ";
  if ($max_level != $_POST['max_level']) $fields .= "max_level=\"" . $_POST['max_level'] . "\", ";
  if ($min_status != $_POST['min_status']) $fields .= "min_status=\"" . $_POST['min_status'] . "\", ";
  if ($zoneidnumber != $_POST['zoneidnumber']) $fields .= "zoneidnumber=\"" . $_POST['zoneidnumber']. "\", ";
  if ($version != $_POST['version']) $fields .= "version=\"" . $_POST['version'] . "\", ";
  if ($timezone != $_POST['timezone']) $fields .= "timezone=\"" . $_POST['timezone'] . "\", ";
  if ($maxclients != $_POST['maxclients']) $fields .= "maxclients=\"" . $_POST['maxclients'] . "\", ";
  if ($ruleset != $_POST['ruleset']) $fields .= "ruleset=\"" . $_POST['ruleset'] . "\", ";
  if ($note != $_POST['note']) $fields .= "note=\"" . $_POST['note'] . "\", ";
  if ($underworld != $_POST['underworld']) $fields .= "underworld=\"" . $_POST['underworld'] . "\", ";
  if ($minclip != $_POST['minclip']) $fields .= "minclip=\"" . $_POST['minclip'] . "\", ";
  if ($maxclip != $_POST['maxclip']) $fields .= "maxclip=\"" . $_POST['maxclip'] . "\", ";
  if ($fog_minclip != $_POST['fog_minclip']) $fields .= "fog_minclip=\"" . $_POST['fog_minclip'] . "\", ";
  if ($fog_maxclip != $_POST['fog_maxclip']) $fields .= "fog_maxclip=\"" . $_POST['fog_maxclip'] . "\", ";
  if ($fog_blue != $_POST['fog_blue']) $fields .= "fog_blue=\"" . $_POST['fog_blue'] . "\", ";
  if ($fog_red != $_POST['fog_red']) $fields .= "fog_red=\"" . $_POST['fog_red'] . "\", ";
  if ($fog_green != $_POST['fog_green']) $fields .= "fog_green=\"" . $_POST['fog_green'] . "\", ";
  if ($sky != $_POST['sky']) $fields .= "sky=\"" . $_POST['sky'] . "\", ";
  if ($ztype != $_POST['ztype']) $fields .= "ztype=\"" . $_POST['ztype'] . "\", ";
  if ($zone_exp_multiplier != $_POST['zone_exp_multiplier']) $fields .= "zone_exp_multiplier=\"" . $_POST['zone_exp_multiplier'] . "\", ";
  if ($walkspeed != $_POST['walkspeed']) $fields .= "walkspeed=\"" . $_POST['walkspeed'] . "\", ";
  if ($time_type != $_POST['time_type']) $fields .= "time_type=\"" . $_POST['time_type'] . "\", ";
  if ($fog_red1 != $_POST['fog_red1']) $fields .= "fog_red1=\"" . $_POST['fog_red1'] . "\", ";
  if ($fog_green1 != $_POST['fog_green1']) $fields .= "fog_green1=\"" . $_POST['fog_green1'] . "\", ";
  if ($fog_blue1 != $_POST['fog_blue1']) $fields .= "fog_blue1=\"" . $_POST['fog_blue1'] . "\", ";
  if ($fog_minclip1 != $_POST['fog_minclip1']) $fields .= "fog_minclip1=\"" . $_POST['fog_minclip1'] . "\", ";
  if ($fog_maxclip1 != $_POST['fog_maxclip1']) $fields .= "fog_maxclip1=\"" . $_POST['fog_maxclip1'] . "\", ";
  if ($fog_red2 != $_POST['fog_red2']) $fields .= "fog_red2=\"" . $_POST['fog_red2'] . "\", ";
  if ($fog_green2 != $_POST['fog_green2']) $fields .= "fog_green2=\"" . $_POST['fog_green2'] . "\", ";
  if ($fog_blue2 != $_POST['fog_blue2']) $fields .= "fog_blue2=\"" . $_POST['fog_blue2'] . "\", ";
  if ($fog_minclip2 != $_POST['fog_minclip2']) $fields .= "fog_minclip2=\"" . $_POST['fog_minclip2'] . "\", ";
  if ($fog_maxclip2 != $_POST['fog_maxclip2']) $fields .= "fog_maxclip2=\"" . $_POST['fog_maxclip2'] . "\", ";
  if ($fog_red3 != $_POST['fog_red3']) $fields .= "fog_red3=\"" . $_POST['fog_red3'] . "\", ";
  if ($fog_green3 != $_POST['fog_green3']) $fields .= "fog_green3=\"" . $_POST['fog_green3'] . "\", ";
  if ($fog_blue3 != $_POST['fog_blue3']) $fields .= "fog_blue3=\"" . $_POST['fog_blue3'] . "\", ";
  if ($fog_minclip3 != $_POST['fog_minclip3']) $fields .= "fog_minclip3=\"" . $_POST['fog_minclip3'] . "\", ";
  if ($fog_maxclip3 != $_POST['fog_maxclip3']) $fields .= "fog_maxclip3=\"" . $_POST['fog_maxclip3'] . "\", ";
  if ($fog_red4 != $_POST['fog_red4']) $fields .= "fog_red4=\"" . $_POST['fog_red4'] . "\", ";
  if ($fog_green4 != $_POST['fog_green4']) $fields .= "fog_green4=\"" . $_POST['fog_green4'] . "\", ";
  if ($fog_blue4 != $_POST['fog_blue4']) $fields .= "fog_blue4=\"" . $_POST['fog_blue4'] . "\", ";
  if ($fog_minclip4 != $_POST['fog_minclip4']) $fields .= "fog_minclip4=\"" . $_POST['fog_minclip4'] . "\", ";
  if ($fog_maxclip4 != $_POST['fog_maxclip4']) $fields .= "fog_maxclip4=\"" . $_POST['fog_maxclip4'] . "\", ";
  if ($fog_density != $_POST['fog_density']) $fields .= "fog_density=\"" . $_POST['fog_density'] . "\", ";
  if ($flag_needed != $_POST['flag_needed']) $fields .= "flag_needed=\"" . $_POST['flag_needed'] . "\", ";
  if ($canbind != $_POST['canbind']) $fields .= "canbind=\"" . $_POST['canbind'] . "\", ";
  if ($cancombat != $_POST['cancombat']) $fields .= "cancombat=\"" . $_POST['cancombat'] . "\", ";
  if ($canlevitate != $_POST['canlevitate']) $fields .= "canlevitate=\"" . $_POST['canlevitate'] . "\", ";
  if ($castoutdoor != $_POST['castoutdoor']) $fields .= "castoutdoor=\"" . $_POST['castoutdoor'] . "\", ";
  if ($hotzone != $_POST['hotzone']) $fields .= "hotzone=\"" . $_POST['hotzone'] . "\", ";
  if ($insttype != $_POST['insttype']) $fields .= "insttype=\"" . $_POST['insttype'] . "\", ";
  if ($shutdowndelay != $_POST['shutdowndelay']) $fields .= "shutdowndelay=\"" . $_POST['shutdowndelay'] . "\", ";
  if ($peqzone != $_POST['peqzone']) $fields .= "peqzone=\"" . $_POST['peqzone'] . "\", ";
  if ($expansion != $_POST['expansion']) $fields .= "expansion=\"" . $_POST['expansion'] . "\", ";
  if ($bypass_expansion_check != $_POST['bypass_expansion_check']) $fields .= "bypass_expansion_check=\"" . $_POST['bypass_expansion_check'] . "\", ";
  if ($suspendbuffs!= $_POST['suspendbuffs']) $fields .= "suspendbuffs=\"" . $_POST['suspendbuffs'] . "\", ";
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
  if ($gravity != $_POST['gravity']) $fields .= "gravity=\"" . $_POST['gravity'] . "\", ";
  if ($type != $_POST['type']) $fields .= "type=\"" . $_POST['type'] . "\", ";
  if ($skylock != $_POST['skylock']) $fields .= "skylock=\"" . $_POST['skylock'] . "\", ";
  if ($fast_regen_hp != $_POST['fast_regen_hp']) $fields .= "fast_regen_hp=\"" . $_POST['fast_regen_hp'] . "\", ";
  if ($fast_regen_mana != $_POST['fast_regen_mana']) $fields .= "fast_regen_mana=\"" . $_POST['fast_regen_mana'] . "\", ";
  if ($fast_regen_endurance != $_POST['fast_regen_endurance']) $fields .= "fast_regen_endurance=\"" . $_POST['fast_regen_endurance'] . "\", ";
  if ($npc_max_aggro_dist != $_POST['npc_max_aggro_dist']) $fields .= "npc_max_aggro_dist=\"" . $_POST['npc_max_aggro_dist'] . "\", ";
  if ($max_movement_update_range != $_POST['max_movement_update_range']) $fields .= "max_movement_update_range=\"" . $_POST['max_movement_update_range'] . "\", ";
  if ($min_expansion != $_POST['min_expansion']) $fields .= "min_expansion=\"" . $_POST['min_expansion'] . "\", ";
  if ($max_expansion != $_POST['max_expansion']) $fields .= "max_expansion=\"" . $_POST['max_expansion'] . "\", ";
  if ($underworld_teleport_index != $_POST['underworld_teleport_index']) $fields .= "underworld_teleport_index=\"" . $_POST['underworld_teleport_index'] . "\", ";
  if ($lava_damage != $_POST['lava_damage']) $fields .= "lava_damage=\"" . $_POST['lava_damage'] . "\", ";
  if ($min_lava_damage != $_POST['min_lava_damage']) $fields .= "min_lava_damage=\"" . $_POST['min_lava_damage'] . "\", ";
  if ($idle_when_empty != $_POST['idle_when_empty']) $fields .= "idle_when_empty=\"" . $_POST['idle_when_empty'] . "\", ";
  if ($seconds_before_idle != $_POST['seconds_before_idle']) $fields .= "seconds_before_idle=\"" . $_POST['seconds_before_idle'] . "\", ";

  if ($content_flags != $_POST['content_flags']) {
    if ($_POST['content_flags'] == "") {
       $fields .= "content_flags=NULL,";
    }
    else {
       $fields .= "content_flags=\"" . $_POST['content_flags'] . "\", ";
    }
  }

  if ($content_flags_disabled != $_POST['content_flags_disabled']) {
    if ($_POST['content_flags_disabled'] == "") {
       $fields .= "content_flags_disabled=NULL,";
    }
    else {
       $fields .= "content_flags_disabled=\"" . $_POST['content_flags_disabled'] . "\", ";
    }
  }

  $fields =  rtrim($fields, ", ");

  if ($fields != '') {
    $query = "UPDATE zone SET $fields WHERE id=$zoneid";
    $mysql_content_db->query_no_result($query);
  }
}

function update_graveyard() {
  global $mysql_content_db;

  $zone_id = $_POST['zone_id'];
  $graveyard_id = $_POST['graveyard_id'];
  $zone_id = $_POST['zone_id']; 
  $x = $_POST['x']; 
  $y = $_POST['y'];
  $z_coord = $_POST['z_coord'];
  $heading = $_POST['heading'];

  $query = "UPDATE graveyard SET zone_id=\"$zone_id\", x=\"$x\", y=\"$y\", z=\"$z_coord\", heading=\"$heading\" WHERE id=\"$graveyard_id\"";
  $mysql_content_db->query_no_result($query);
}

function update_zonepoints() {
  global $mysql_content_db;

  $id = $_POST['id'];
  $zone = $_POST['zone']; 
  $number = $_POST['number'];
  $x = $_POST['x']; 
  $y = $_POST['y'];
  $z = $_POST['z'];
  $heading = $_POST['heading'];
  $target_x = $_POST['target_x']; 
  $target_y = $_POST['target_y'];
  $target_z = $_POST['target_z']; 
  $target_heading = $_POST['target_heading'];
  $target_zone_id = $_POST['target_zone_id'];
  $version = $_POST['version'];
  $target_instance = $_POST['target_instance'];
  $client_version_mask = $_POST['client_version_mask'];
  $min_expansion = $_POST['min_expansion'];
  $max_expansion = $_POST['max_expansion'];
  $content_flags = $_POST['content_flags'];
  $content_flags_disabled = $_POST['content_flags_disabled'];
  $is_virtual = $_POST['is_virtual'];
  $height = $_POST['height'];
  $width = $_POST['width'];

  $query = "UPDATE zone_points SET number=\"$number\", x=\"$x\", y=\"$y\", z=\"$z\", heading=\"$heading\", target_x=\"$target_x\", target_y=\"$target_y\", target_z=\"$target_z\", target_heading=\"$target_heading\", target_zone_id=\"$target_zone_id\", version=\"$version\", target_instance=\"$target_instance\", client_version_mask=\"$client_version_mask\", min_expansion=$min_expansion, max_expansion=$max_expansion, content_flags=NULL, content_flags_disabled=NULL, is_virtual=$is_virtual, height=$height, width=$width WHERE id=\"$id\"";
  $mysql_content_db->query_no_result($query);

  if ($content_flags != "") {
    $query = "UPDATE zone_points SET content_flags=\"$content_flags\" WHERE id=$id";
    $mysql_content_db->query_no_result($query);
  }

  if ($content_flags_disabled != "") {
    $query = "UPDATE zone_points SET content_flags_disabled=\"$content_flags_disabled\" WHERE id=$id";
    $mysql_content_db->query_no_result($query);
  }
}

function update_blockedspell() {
  global $mysql_content_db;

  $bsid = $_POST['bsid'];
  $spellid = $_POST['spellid']; 
  $type = $_POST['type'];
  $x_coord = $_POST['x_coord']; 
  $y_coord = $_POST['y_coord'];
  $z_coord = $_POST['z_coord'];
  $x_diff = $_POST['x_diff'];
  $y_diff = $_POST['y_diff']; 
  $z_diff = $_POST['z_diff'];
  $message = $mysql_content_db->real_escape_string($_POST['message']); 
  $description = $_POST['description'];
  $min_expansion = $_POST['min_expansion'];
  $max_expansion = $_POST['max_expansion'];
  $content_flags = $_POST['content_flags'];
  $content_flags_disabled = $_POST['content_flags_disabled'];

  $query = "UPDATE blocked_spells SET spellid=\"$spellid\", type=\"$type\", x=\"$x_coord\", y=\"$y_coord\", z=\"$z_coord\", x_diff=\"$x_diff\", y_diff=\"$y_diff\", z_diff=\"$z_diff\", message=\"$message\", description=\"$description\", min_expansion=\"$min_expansion\", max_expansion=\"$max_expansion\", content_flags=NULL, content_flags_disabled=NULL WHERE id=\"$bsid\"";
  $mysql_content_db->query_no_result($query);

  if ($content_flags != "") {
    $query = "UPDATE blocked_spells SET content_flags=\"$content_flags\" WHERE id=\"$bsid\"";
    $mysql_content_db->query_no_result($query);
  }

  if ($content_flags_disabled != "") {
    $query = "UPDATE blocked_spells SET content_flags_disabled=\"$content_flags_disabled\" WHERE id=\"$bsid\"";
    $mysql_content_db->query_no_result($query);
  }
}

function delete_graveyard() {
  global $mysql_content_db;
  
  $graveyard_id = $_GET['graveyard_id'];

  $query = "DELETE FROM graveyard WHERE id=\"$graveyard_id\"";
  $mysql_content_db->query_no_result($query);

  $query = "UPDATE zone SET graveyard_id=0 WHERE graveyard_id=\"$graveyard_id\"";
  $mysql_content_db->query_no_result($query);
}

function delete_zonepoints() {
  global $mysql_content_db;
  
  $zpid = $_GET['zpid'];

  $query = "DELETE FROM zone_points WHERE id=\"$zpid\"";
  $mysql_content_db->query_no_result($query);
}

function delete_blockedspell() {
  global $mysql_content_db;
  
  $bsid = $_GET['bsid'];

  $query = "DELETE FROM blocked_spells WHERE id=\"$bsid\"";
  $mysql_content_db->query_no_result($query);
}

function suggest_graveyard_id() {
  global $mysql_content_db;

  $query = "SELECT MAX(id) AS graveyard_id FROM graveyard";
  $result = $mysql_content_db->query_assoc($query);
  
  return ($result['graveyard_id'] + 1);
}

function suggest_zonepoint_id() {
  global $mysql_content_db;

  $query = "SELECT MAX(id) AS id FROM zone_points";
  $result = $mysql_content_db->query_assoc($query);
  
  return ($result['id'] + 1);
}

function suggest_zonepoint_number() {
  global $mysql_content_db, $z;

  $query = "SELECT MAX(number) AS num FROM zone_points WHERE zone=\"$z\"";
  $result = $mysql_content_db->query_assoc($query);
  
  return ($result['num'] + 1);
}

function suggest_blockedspell_id() {
  global $mysql_content_db;

  $query = "SELECT MAX(id) AS bsid FROM blocked_spells";
  $result = $mysql_content_db->query_assoc($query);
  
  return ($result['bsid'] + 1);
}

function add_graveyard() {
  global $mysql_content_db, $z;
  
  $zid = getZoneID($z);
  $graveyard_id = $_POST['graveyard_id'];
  $zone_id = $_POST['zone_id']; 
  $x = $_POST['x']; 
  $y = $_POST['y'];
  $z_coord = $_POST['z_coord'];
  $heading = $_POST['heading'];

  $query = "INSERT INTO graveyard SET id=\"$graveyard_id\", zone_id=\"$zone_id\", x=\"$x\", y=\"$y\", z=\"$z_coord\", heading=\"$heading\"";
  $mysql_content_db->query_no_result($query);

  $query = "UPDATE zone SET graveyard_id=\"$graveyard_id\" WHERE zoneidnumber=\"$zid\"";
  $mysql_content_db->query_no_result($query);
}

function add_zonepoints() {
  global $mysql_content_db;
  
  $id = $_POST['id'];
  $zone = $_POST['zone']; 
  $number = $_POST['number'];
  $x = $_POST['x']; 
  $y = $_POST['y'];
  $z = $_POST['z'];
  $heading = $_POST['heading'];
  $target_x = $_POST['target_x'];
  $target_y = $_POST['target_y']; 
  $target_z = $_POST['target_z']; 
  $target_heading = $_POST['target_heading'];
  $target_zone_id = $_POST['target_zone_id'];
  $version = $_POST['version'];
  $target_instance = $_POST['target_instance'];
  $client_version_mask = $_POST['client_version_mask'];
  $min_expansion = $_POST['min_expansion'];
  $max_expansion = $_POST['max_expansion'];
  $content_flags = $_POST['content_flags'];
  $content_flags_disabled = $_POST['content_flags_disabled'];
  $is_virtual = $_POST['is_virtual'];
  $height = $_POST['height'];
  $width = $_POST['width'];

  $query = "INSERT INTO zone_points SET id=\"$id\", zone=\"$zone\", number=\"$number\", x=\"$x\", y=\"$y\", z=\"$z\", heading=\"$heading\", target_x=\"$target_x\", target_y=\"$target_y\", target_z=\"$target_z\", target_heading=\"$target_heading\", target_zone_id=\"$target_zone_id\", buffer=0, version=\"$version\", target_instance=\"$target_instance\", client_version_mask=\"$client_version_mask\", min_expansion=$min_expansion, max_expansion=$max_expansion, content_flags=NULL, content_flags_disabled=NULL, is_virtual=$is_virtual, height=$height, width=$width";
  $mysql_content_db->query_no_result($query);

  if ($content_flags != "") {
    $query = "UPDATE zone_points SET content_flags=\"$content_flags\" WHERE id=$id";
    $mysql_content_db->query_no_result($query);
  }

  if ($content_flags_disabled != "") {
    $query = "UPDATE zone_points SET content_flags_disabled=\"$content_flags_disabled\" WHERE id=$id";
    $mysql_content_db->query_no_result($query);
  }
}

function add_blockedspell() {
  global $mysql_content_db;

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
  $message = $mysql_content_db->real_escape_string($_POST['message']); 
  $description = $_POST['description'];
  $min_expansion = $_POST['min_expansion'];
  $max_expansion = $_POST['max_expansion'];
  $content_flags = $_POST['content_flags'];
  $content_flags_disabled = $_POST['content_flags_disabled'];

  $query = "INSERT INTO blocked_spells SET id=\"$bsid\", zoneid=\"$zoneid\", spellid=\"$spellid\", type=\"$type\", x=\"$x_coord\", y=\"$y_coord\", z=\"$z_coord\", x_diff=\"$x_diff\", y_diff=\"$y_diff\", z_diff=\"$z_diff\", message=\"$message\", description=\"$description\", min_expansion=\"$min_expansion\", max_expansion=\"$max_expansion\", content_flags=NULL, content_flags_disabled=NULL";
  $mysql_content_db->query_no_result($query);

  if ($content_flags != "") {
    $query = "UPDATE blocked_spells SET content_flags=\"$content_flags\" WHERE id=\"$bsid\"";
    $mysql_content_db->query_no_result($query);
  }

  if ($content_flags_disabled != "") {
    $query = "UPDATE blocked_spells SET content_flags_disabled=\"$content_flags_disabled\" WHERE id=\"$bsid\"";
    $mysql_content_db->query_no_result($query);
  }
}

function graveyard_info() {
  global $mysql_content_db;
  $array = array();
  
  $query = "SELECT * FROM graveyard";
  $result = $mysql_content_db->query_mult_assoc($query);

  if ($result) {
    foreach ($result as $result) {
      $array['graveyard'][$result['id']] = array("graveyard_id"=>$result['id'], "zone_id"=>$result['zone_id'], "x"=>$result['x'], "y"=>$result['y'], "z_coord"=>$result['z'], "heading"=>$result['heading']);
    }
  }

  return $array;
}

function zonepoints_info() {
  global $mysql_content_db, $z, $zoneid;
  $array = array();

  $query = "SELECT version AS zversion FROM zone WHERE id=$zoneid";
  $result = $mysql_content_db->query_assoc($query);
  $zversion = $result['zversion'];

  $query = "SELECT * FROM zone_points WHERE zone=\"$z\" AND version=$zversion";
  $results = $mysql_content_db->query_mult_assoc($query);
  if ($results) {
    foreach ($results as $result) {
      $array['zonepoints'][$result['id']] = array("id"=>$result['id'], "zone"=>$result['zone'], "number"=>$result['number'], "x"=>$result['x'], "y"=>$result['y'], "z"=>$result['z'], "heading"=>$result['heading'], "target_x"=>$result['target_x'], "target_y"=>$result['target_y'], "target_z"=>$result['target_z'], "target_heading"=>$result['target_heading'], "target_zone_id"=>$result['target_zone_id'], "version"=>$result['version'], "target_instance"=>$result['target_instance'], "client_version_mask"=>$result['client_version_mask'], "min_expansion"=>$result['min_expansion'], "max_expansion"=>$result['max_expansion'], "content_flags"=>$result['content_flags'], "content_flags_disabled"=>$result['content_flags_disabled'], "is_virtual"=>$result['is_virtual'], "height"=>$result['height'], "width"=>$result['width']);
    }
  }
  return $array;
}

function blockedspell_info() {
  global $mysql_content_db, $z;
  $zid = getZoneID($z);
  $array = array();

  $query = "SELECT * FROM blocked_spells WHERE zoneid=\"$zid\"";
  $result = $mysql_content_db->query_mult_assoc($query);
  if ($result) {
    foreach ($result as $result) {
      $array['blockedspell'][$result['id']] = array("bsid"=>$result['id'], "spellid"=>$result['spellid'], "type"=>$result['type'], "zoneid"=>$result['zoneid'], "x_coord"=>$result['x'], "y_coord"=>$result['y'], "z_coord"=>$result['z'], "x_diff"=>$result['x_diff'], "y_diff"=>$result['y_diff'], "z_diff"=>$result['z_diff'], "message"=>$result['message'], "description"=>$result['description'], "min_expansion"=>$result['min_expansion'], "max_expansion"=>$result['max_expansion'], "content_flags"=>$result['content_flags'], "content_flags_disabled"=>$result['content_flags_disabled']);
    }
  }
  return $array;
}

function get_graveyard_zone() {
  global $mysql_content_db;

  $graveyard_id = $_GET['graveyard_id'];

  $query = "SELECT short_name FROM zone WHERE graveyard_id=\"$graveyard_id\" LIMIT 1";
  $result = $mysql_content_db->query_assoc($query);

  return $result['short_name'];
}

function copy_zone() {
  global $mysql_content_db, $zoneid, $z;

  $query = "INSERT INTO zone (`short_name`, `file_name`, `long_name`, `map_file_name`, `safe_x`, `safe_y`, `safe_z`, `graveyard_id`, `min_level`, `max_level`, `min_status`, `zoneidnumber`, `version`, `timezone`, `maxclients`, `ruleset`, `note`, `underworld`, `minclip`, `maxclip`, `fog_minclip`, `fog_maxclip`, `fog_blue`, `fog_red`, `fog_green`, `sky`, `ztype`, `zone_exp_multiplier`, `walkspeed`, `time_type`, `fog_red1`, `fog_green1`, `fog_blue1`, `fog_minclip1`, `fog_maxclip1`, `fog_red2`, `fog_green2`, `fog_blue2`, `fog_minclip2`, `fog_maxclip2`, `fog_red3`, `fog_green3`, `fog_blue3`, `fog_minclip3`, `fog_maxclip3`, `fog_red4`, `fog_green4`, `fog_blue4`, `fog_minclip4`, `fog_maxclip4`, `fog_density`, `flag_needed`, `canbind`, `cancombat`, `canlevitate`, `castoutdoor`, `hotzone`, `insttype`, `shutdowndelay`, `peqzone`, `expansion`, `bypass_expansion_check`, `suspendbuffs`, `rain_chance1`, `rain_chance2`, `rain_chance3`, `rain_chance4`, `rain_duration1`, `rain_duration2`, `rain_duration3`, `rain_duration4`, `snow_chance1`, `snow_chance2`, `snow_chance3`, `snow_chance4`, `snow_duration1`, `snow_duration2`, `snow_duration3`, `snow_duration4`, `gravity`, `type`, `skylock`, `fast_regen_hp`, `fast_regen_mana`, `fast_regen_endurance`, `npc_max_aggro_dist`, `max_movement_update_range`, min_expansion, max_expansion, content_flags, content_flags_disabled, underworld_teleport_index, lava_damage, min_lava_damage, idle_when_empty, seconds_before_idle)
            SELECT `short_name`, `file_name`, `long_name`, `map_file_name`, `safe_x`, `safe_y`, `safe_z`, `graveyard_id`, `min_level`, `max_level`, `min_status`, `zoneidnumber`, `version`, `timezone`, `maxclients`, `ruleset`, `note`, `underworld`, `minclip`, `maxclip`, `fog_minclip`, `fog_maxclip`, `fog_blue`, `fog_red`, `fog_green`, `sky`, `ztype`, `zone_exp_multiplier`, `walkspeed`, `time_type`, `fog_red1`, `fog_green1`, `fog_blue1`, `fog_minclip1`, `fog_maxclip1`, `fog_red2`, `fog_green2`, `fog_blue2`, `fog_minclip2`, `fog_maxclip2`, `fog_red3`, `fog_green3`, `fog_blue3`, `fog_minclip3`, `fog_maxclip3`, `fog_red4`, `fog_green4`, `fog_blue4`, `fog_minclip4`, `fog_maxclip4`, `fog_density`, `flag_needed`, `canbind`, `cancombat`, `canlevitate`, `castoutdoor`, `hotzone`, `insttype`, `shutdowndelay`, `peqzone`, `expansion`, `bypass_expansion_check`, `suspendbuffs`, `rain_chance1`, `rain_chance2`, `rain_chance3`, `rain_chance4`, `rain_duration1`, `rain_duration2`, `rain_duration3`, `rain_duration4`, `snow_chance1`, `snow_chance2`, `snow_chance3`, `snow_chance4`, `snow_duration1`, `snow_duration2`, `snow_duration3`, `snow_duration4`, `gravity`, `type`, `skylock`, `fast_regen_hp`, `fast_regen_mana`, `fast_regen_endurance`, `npc_max_aggro_dist`, `max_movement_update_range`, min_expansion, max_expansion, content_flags, content_flags_disabled, underworld_teleport_index, lava_damage, min_lava_damage, idle_when_empty, seconds_before_idle FROM zone WHERE id=$zoneid";
  $mysql_content_db->query_no_result($query);

  $query = "SELECT MAX(id) AS zid FROM zone";
  $result = $mysql_content_db->query_assoc($query);
  $nzone = $result['zid'];

  $query2 = "SELECT MAX(version+1) AS zver FROM zone WHERE short_name=\"$z\"";
  $result2 = $mysql_content_db->query_assoc($query2);
  $nver = $result2['zver'];

  $query = "UPDATE zone SET version=$nver WHERE id=$nzone";
  $mysql_content_db->query_no_result($query);
   
  return $nzone;
}

function delete_zone() {
  global $mysql_content_db, $zoneid;

  $query = "DELETE FROM zone WHERE id=$zoneid";
  $mysql_content_db->query_no_result($query);
}
   
function get_isglobal() {
  global $mysql, $mysql_content_db, $z, $zoneid;

  $zid = getZoneID($z);

  $query1 = "SELECT version AS zversion FROM zone WHERE id=$zoneid";
  $result1 = $mysql_content_db->query_assoc($query1);
  $zversion = $result1['zversion'];

  $query = "SELECT COUNT(*) FROM instance_list WHERE zone=$zid AND version=$zversion";
  $result = $mysql->query_assoc($query);

  return $result['COUNT(*)'];
}

function update_global() {
  global $mysql, $mysql_content_db, $z, $zoneid;

  $zid = getZoneID($z);

  $query1 = "SELECT version AS zversion FROM zone WHERE id=$zoneid";
  $result1 = $mysql_content_db->query_assoc($query1);
  $zversion = $result1['zversion'];

  $query2 = "SELECT id AS currid FROM instance_list WHERE zone=$zid AND version=$zversion AND id < 30";
  $result2 = $mysql->query_assoc($query2);
  $currid = $result2['currid'];

  $query = "REPLACE INTO instance_list SET id=$currid, zone=$zid, version=$zversion, is_global=1, never_expires=1, notes=\"\"";
  $mysql->query_no_result($query);
}

function delete_global() {
  global $mysql, $mysql_content_db, $z, $zoneid;

  $zid = getZoneID($z);

  $query1 = "SELECT version AS zversion FROM zone WHERE id=$zoneid";
  $result1 = $mysql_content_db->query_assoc($query1);
  $zversion = $result1['zversion'];

  $query = "DELETE FROM instance_list WHERE zone=$zid AND version=$zversion AND id < 30";
  $mysql->query_no_result($query);
}
?>
