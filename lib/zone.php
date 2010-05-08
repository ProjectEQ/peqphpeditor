<?php

$bindallowed = array(
  0   => "No",
  1   => "Self",
  2   => "Others",
);

$weathertype = array(
  0   => "None",
  1   => "Rain",
  2   => "Snow",
);

$blockedtype = array(
  0   => "Not Blocked",
  1   => "Zone Wide",
  2   => "Coords",
);

switch ($action) {
  case 0:
    if (!$z) {
    }
    else {
        $body = new Template("templates/zone/zone.default.tmpl.php");
        $body->set('currzone', $z);
    }
    break;
  case 1: // View zone data
    check_authorization();
    $body = new Template("templates/zone/zone.tmpl.php");
    $body->set('currzone', $z);
    $body->set("yesno", $yesno);
    $body->set("bindallowed", $bindallowed);
    $body->set("weathertype", $weathertype);
    $zone = get_zone();
    if ($zone) {
      foreach ($zone as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
   case 2: // Edit zone data
    check_authorization();
    $body = new Template("templates/zone/zone.edit.tmpl.php");
    $body->set('currzone', $z);
    $body->set("yesno", $yesno);
    $body->set("bindallowed", $bindallowed);
    $body->set("weathertype", $weathertype);
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
    header("Location: index.php?editor=zone&z=$z&action=1");
    exit;
   case 4: // View graveyard data
    $body = new Template("templates/zone/graveyard.tmpl.php");
    $body->set('currzone', $z);
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
    $body = new Template("templates/zone/graveyard.edit.tmpl.php");
    $body->set('currzone', $z);
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
    header("Location: index.php?editor=zone&z=$z&graveyard_id=$graveyard_id&action=4");
    exit;
   case 7: // Delete graveyard data
    check_authorization();
    delete_graveyard();
    header("Location: index.php?editor=zone&z=$z&action=1");
    exit;
   case 8: // Get graveyard ID
    check_authorization();
    $body = new Template("templates/zone/graveyard.add.tmpl.php");
    $body->set('currzone', $z);
    $body->set('zid', getZoneID($z));
    $body->set('suggestgid', suggest_graveyard_id());
    break;
   case 9: // Add graveyard data
    check_authorization();
    add_graveyard();
    $graveyard_id = $_POST['graveyard_id'];
    header("Location: index.php?editor=zone&z=$z&graveyard_id=$graveyard_id&action=4");
    exit;
   case 10: // View graveyard data
    $body = new Template("templates/zone/graveyard.view.tmpl.php");
    $body->set('currzone', $z);
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
    $body = new Template("templates/zone/zonepoints.tmpl.php");
    $body->set('currzone', $z);
    $zonepoints = zonepoints_info();
    if ($zonepoints) {
      foreach ($zonepoints as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
   case 13: // Edit zone points
    check_authorization();
    $body = new Template("templates/zone/zonepoints.edit.tmpl.php");
    $body->set('currzone', $z);
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
    header("Location: index.php?editor=zone&z=$z&action=12");
    exit;
   case 15: // Delete zone points
    check_authorization();
    delete_zonepoints();
    header("Location: index.php?editor=zone&z=$z&action=12");
    exit;
   case 16: // Get zonepoint ID
    check_authorization();
    $body = new Template("templates/zone/zonepoints.add.tmpl.php");
    $body->set('currzone', $z);
    $body->set('zid', getZoneID($z));
    $body->set('suggestzpid', suggest_zonepoint_id());
    $body->set('suggestnum', suggest_zonepoint_number());
    break;
   case 17: // Add zonepoint
    check_authorization();
    add_zonepoints();
    header("Location: index.php?editor=zone&z=$z&action=12");
    exit;
   case 18: // View blocked spells
    check_authorization();
    $body = new Template("templates/zone/blockedspell.tmpl.php");
    $body->set('currzone', $z);
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
    $javascript = new Template("templates/iframes/js.tmpl.php");
    $body = new Template("templates/zone/blockedspell.edit.tmpl.php");
    $body->set('currzone', $z);
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
    header("Location: index.php?editor=zone&z=$z&action=18");
    exit;
   case 21: // Delete blocked spells
    check_authorization();
    delete_blockedspell();
    header("Location: index.php?editor=zone&z=$z&action=18");
    exit;
   case 22: // Get blocked spell ID
    check_authorization();
    $javascript = new Template("templates/iframes/js.tmpl.php");
    $body = new Template("templates/zone/blockedspell.add.tmpl.php");
    $body->set('currzone', $z);
    $body->set('zid', getZoneID($z));
    $body->set('suggestbsid', suggest_blockedspell_id());
    break;
   case 23: // Add blockspell
    check_authorization();
    add_blockedspell();
    header("Location: index.php?editor=zone&z=$z&action=18");
    exit;
}

function get_zone() {
  global $mysql,$z;

  $zid = getZoneID($z);  

  $query = "SELECT * FROM zone WHERE zoneidnumber=$zid";
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
  global $mysql;

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
  if ($weather != $_POST['weather']) $fields .= "weather=\"" . $_POST['weather'] . "\", ";
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
  if ($hotzone != $_POST['hotzone']) $fields .= "hotzone=\"" . $_POST['hotzone'] . "\", ";
  $fields =  rtrim($fields, ", ");

  if ($fields != '') {
    $query = "UPDATE zone SET $fields WHERE zoneidnumber=$zoneidnumber";
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

  $query = "UPDATE zone_points SET zone=\"$zone\", number=\"$number\", x=\"$x\", y=\"$y\", z=\"$z_coord\", heading=\"$heading\", target_x=\"$target_x\", target_y=\"$target_y\", target_z=\"$target_z\", target_heading=\"$target_heading\", zoneinst=\"$zoneinst\", target_zone_id=\"$target_zone_id\" WHERE id=\"$zpid\"";
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
  $message = $_POST['message']; 
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

  $query = "INSERT INTO zone_points SET id=\"$zpid\", zone=\"$zone\", number=\"$number\", x=\"$x\", y=\"$y\", z=\"$z_coord\", heading=\"$heading\", target_x=\"$target_x\", target_y=\"$target_y\", target_z=\"$target_z\", target_heading=\"$target_heading\", zoneinst=\"$zoneinst\", target_zone_id=\"$target_zone_id\", buffer=0";
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
  $message = $_POST['message']; 
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
  global $mysql, $z;
  $array = array();

  $query = "SELECT * FROM zone_points WHERE zone=\"$z\"";
  $result = $mysql->query_mult_assoc($query);
  if ($result) {
    foreach ($result as $result) {
     $array['zonepoints'][$result['id']] = array("zpid"=>$result['id'], "zone"=>$result['zone'], "number"=>$result['number'], "x_coord"=>$result['x'], "y_coord"=>$result['y'], "z_coord"=>$result['z'], "heading"=>$result['heading'], "target_x"=>$result['target_x'], "target_y"=>$result['target_y'], "target_z"=>$result['target_z'], "target_heading"=>$result['target_heading'], "zoneinst"=>$result['zoneinst'], "target_zone_id"=>$result['target_zone_id']);
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

?>