<?php

$advtype = array(
  1   => "Assassinate",
  2   => "Kill Count",
  3   => "Loot Count",
  4   => "Rescue"
);

$themetype = array(
  1   => "Deepest Guk",
  2   => "Miragul's Menagerie",
  3   => "Mistmoore Catacombs",
  4   => "Rujarkian Hills",
  5   => "Takish-Hiz"
);

$ldontraptype = array(
  1   => "Mechanical",
  2   => "Magical",
  3   => "Cursed"
);

switch ($action) {
  case 0:         
    check_authorization();
    if (!$npcid) {
      $body = new Template("templates/adventures/adventures.searchresults.tmpl.php");
      $results = search_adventure_npc();
      $body->set("results", $results);
    }
    else if ($npcid) {
      $body = new Template("templates/adventures/adventures.tmpl.php");
      $body->set('currzone', $z);
      $body->set('currzoneid', $zoneid);
      $body->set('npcid', $npcid);
    }
    break;
  case 1: // Assassinate Adventures
    check_authorization();
    $body = new Template("templates/adventures/assassinate.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    $body->set('yesno', $yesno);
    $body->set('advtype', $advtype);
    $body->set('themetype', $themetype); 
    $bossassa = get_assassinatelist();
    if ($bossassa) {
      foreach ($bossassa as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
  case 2: // Kill Count Adventures
    check_authorization();
    $body = new Template("templates/adventures/kill.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    $body->set('yesno', $yesno);
    $body->set('advtype', $advtype);
    $body->set('themetype', $themetype); 
    $kill = get_killlist();
    if ($kill) {
      foreach ($kill as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
  case 3: // Loot Count Adventures
    check_authorization();
    $body = new Template("templates/adventures/loot.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    $body->set('yesno', $yesno);
    $body->set('advtype', $advtype);
    $body->set('themetype', $themetype); 
    $loot = get_lootlist();
    if ($loot) {
      foreach ($loot as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
  case 4: // Rescue Adventures
    check_authorization();
    $body = new Template("templates/adventures/rescue.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    $body->set('yesno', $yesno);
    $body->set('advtype', $advtype);
    $body->set('themetype', $themetype); 
    $rescue = get_rescuelist();
    if ($rescue) {
      foreach ($rescue as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
  case 5: // Flavor Text
    check_authorization();
    $body = new Template("templates/adventures/flavor.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    $body->set('aid', get_adventure_id());
    $flavor = get_flavor();
    if ($flavor) {
      foreach ($flavor as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
  case 6: // Flavor Text
    check_authorization();
    update_flavor();
    header("Location: index.php?editor=adventures&z=$z&zoneid=$zoneid&npcid=$npcid");
    exit;
  case 7: // Delete Adventure
    check_authorization();
    delete_adventure();
    header("Location: index.php?editor=adventures&z=$z&zoneid=$zoneid&npcid=$npcid");
    exit;
  case 8: // Edit Adventure
    check_authorization();
    $body = new Template("templates/adventures/adventures.edit.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    $body->set('advtype', $advtype);
    $body->set('themetype', $themetype);
    $adventure = adventure_info();
    if ($adventure) {
      foreach ($adventure as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
  case 9: // Update adventure
    check_authorization();
    update_adventure_template();
    header("Location: index.php?editor=adventures&z=$z&zoneid=$zoneid&npcid=$npcid");
    exit;
  case 10: // Add Adventure
    check_authorization();
    $body = new Template("templates/adventures/adventures.add.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    $body->set('advtype', $advtype);
    $body->set('themetype', $themetype);
    $body->set('suggestaid', suggest_adventure_template_id());
    $body->set('aid', get_adventure_id());
    break;
  case 11: // Add Adventure
    check_authorization();
    add_adventure();
    header("Location: index.php?editor=adventures&z=$z&zoneid=$zoneid&npcid=$npcid");
    exit;
  case 12: // Trap Templates
    check_authorization();
    $body = new Template("templates/adventures/traptemplate.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    $body->set('yesno', $yesno);
    $body->set('ldontraptype', $ldontraptype); 
    $ldontrap = get_traptemplate();
    if ($ldontrap) {
      foreach ($ldontrap as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
   case 13: // Edit Trap Template
    check_authorization();
    $javascript = new Template("templates/iframes/js.tmpl.php");
    $body = new Template("templates/adventures/traptemplate.edit.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    $body->set('yesno', $yesno);
    $body->set('ldontraptype', $ldontraptype); 
    $traptemplate = traptemplate_info();
    if ($traptemplate) {
      foreach ($traptemplate as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
   case 14: // Update Trap Template
    check_authorization();
    update_trap_template();
    header("Location: index.php?editor=adventures&z=$z&zoneid=$zoneid&npcid=$npcid");
    exit;
   case 15: // Delete Trap Template
    check_authorization();
    delete_trap_template();
    header("Location: index.php?editor=adventures&z=$z&zoneid=$zoneid&npcid=$npcid");
    exit;
   case 16: // Add Trap Template
    check_authorization();
    $javascript = new Template("templates/iframes/js.tmpl.php");
    $body = new Template("templates/adventures/traptemplate.add.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    $body->set('yesno', $yesno);
    $body->set('ldontraptype', $ldontraptype);
    $body->set('suggestedid', suggest_trap_template_id());
    $body->set('ttid', get_trap_template());
    break;
   case 17: // Add Trap Template
    check_authorization();
    add_trap_template();
    header("Location: index.php?editor=adventures&z=$z&zoneid=$zoneid&npcid=$npcid");
    exit;
   case 18: // Create instances
    check_authorization();
    copy_adventure_instance();
    header("Location: index.php?editor=adventures&z=$z&zoneid=$zoneid&npcid=$npcid");
    exit;
   case 19: // Copy adventure
    check_authorization();
    copy_adventure_template();
    header("Location: index.php?editor=adventures&z=$z&zoneid=$zoneid&npcid=$npcid");
    exit;
}

function get_assassinatelist() {
  global $mysql, $npcid;

  $aid = get_adventure_id();
  $array = array();

  $array['aid'] = $aid;
  $query = "SELECT at.* 
            FROM adventure_template AS at
            INNER JOIN adventure_template_entry ate ON ate.template_id = at.id
            WHERE at.type = 1 and ate.id = $aid";
  //$mysql->query_no_result($query);
  $results = $mysql->query_mult_assoc($query);
  if ($results) {
    foreach ($results as $result) {
    $array['bossassa'][$result['id']] = array("id"=>$result['id'], "zone"=>$result['zone'], "is_hard"=>$result['is_hard'], "is_raid"=>$result['is_raid'], "min_level"=>$result['min_level'], "max_level"=>$result['max_level'], "type"=>$result['type'], "type_data"=>$result['type_data'], "theme"=>$result['theme'], "zone_in_zone_id"=>$result['zone_in_zone_id'], "graveyard_zone_id"=>$result['graveyard_zone_id'], "graveyard_x"=>$result['graveyard_x'], "graveyard_y"=>$result['graveyard_y'], "graveyard_z"=>$result['graveyard_z'], "graveyard_radius"=>$result['graveyard_radius']);    
    }
  }
  
  return $array;
}

function get_killlist() {
  global $mysql, $npcid;

  $aid = get_adventure_id();
  $array = array();

  $array['aid'] = $aid;
  $query = "SELECT at.* 
            FROM adventure_template AS at
            INNER JOIN adventure_template_entry ate ON ate.template_id = at.id
            WHERE at.type = 2 and ate.id = $aid";
  $results = $mysql->query_mult_assoc($query);
  if ($results) {
    foreach ($results as $result) {
    $array['kill'][$result['id']] = array("id"=>$result['id'], "zone"=>$result['zone'], "is_hard"=>$result['is_hard'], "is_raid"=>$result['is_raid'], "min_level"=>$result['min_level'], "max_level"=>$result['max_level'], "type"=>$result['type'], "type_count"=>$result['type_count'], "theme"=>$result['theme'], "zone_in_zone_id"=>$result['zone_in_zone_id'], "graveyard_zone_id"=>$result['graveyard_zone_id'], "graveyard_x"=>$result['graveyard_x'], "graveyard_y"=>$result['graveyard_y'], "graveyard_z"=>$result['graveyard_z'], "graveyard_radius"=>$result['graveyard_radius']);    
    }
  }
  
  return $array;
}

function get_lootlist() {
  global $mysql, $npcid;

  $aid = get_adventure_id();
  $array = array();

  $array['aid'] = $aid;
  $query = "SELECT at.* 
            FROM adventure_template AS at
            INNER JOIN adventure_template_entry ate ON ate.template_id = at.id
            WHERE at.type = 3 and ate.id = $aid";
  $results = $mysql->query_mult_assoc($query);
  if ($results) {
    foreach ($results as $result) {
    $array['loot'][$result['id']] = array("id"=>$result['id'], "zone"=>$result['zone'], "is_hard"=>$result['is_hard'], "is_raid"=>$result['is_raid'], "min_level"=>$result['min_level'], "max_level"=>$result['max_level'], "type"=>$result['type'], "type_data"=>$result['type_data'], "type_count"=>$result['type_count'], "theme"=>$result['theme'], "zone_in_zone_id"=>$result['zone_in_zone_id'], "graveyard_zone_id"=>$result['graveyard_zone_id'], "graveyard_x"=>$result['graveyard_x'], "graveyard_y"=>$result['graveyard_y'], "graveyard_z"=>$result['graveyard_z'], "graveyard_radius"=>$result['graveyard_radius']);    
    }
  }
  
  return $array;
}

function get_rescuelist() {
  global $mysql, $npcid;

  $aid = get_adventure_id();
  $array = array();

  $array['aid'] = $aid;
  $query = "SELECT at.* 
            FROM adventure_template AS at
            INNER JOIN adventure_template_entry ate ON ate.template_id = at.id
            WHERE at.type = 4 and ate.id = $aid";  
  $results = $mysql->query_mult_assoc($query);
  if ($results) {
    foreach ($results as $result) {
    $array['rescue'][$result['id']] = array("id"=>$result['id'], "zone"=>$result['zone'], "is_hard"=>$result['is_hard'], "is_raid"=>$result['is_raid'], "min_level"=>$result['min_level'], "max_level"=>$result['max_level'], "type"=>$result['type'], "type_data"=>$result['type_data'], "theme"=>$result['theme'], "zone_in_zone_id"=>$result['zone_in_zone_id'], "graveyard_zone_id"=>$result['graveyard_zone_id'], "graveyard_x"=>$result['graveyard_x'], "graveyard_y"=>$result['graveyard_y'], "graveyard_z"=>$result['graveyard_z'], "graveyard_radius"=>$result['graveyard_radius']);    
    }
  }
  
  return $array;
}

function get_traptemplate() {
  global $mysql, $npcid;

  $ttid = get_trap_template();
  $array = array();

  $array['ttid'] = $ttid;
  $query = "SELECT ltt.* 
            FROM ldon_trap_templates AS ltt
            INNER JOIN ldon_trap_entries lte ON lte.trap_id = ltt.id
            WHERE lte.id = $ttid";
  $results = $mysql->query_mult_assoc($query);
  if ($results) {
    foreach ($results as $result) {
    $array['ldontrap'][$result['id']] = array("id"=>$result['id'], "type"=>$result['type'], "spell_id"=>$result['spell_id'], "skill"=>$result['skill'], "locked"=>$result['locked']);    
    }
  }
  
  return $array;
}

function get_flavor() {
  global $mysql, $npcid;

  $aid = get_adventure_id();
  $array = array();

  $array['aid'] = $aid;

  $query = "SELECT nt.adventure_template_id, atef.text
            FROM adventure_template_entry_flavor as atef 
            INNER JOIN npc_types nt ON atef.id = nt.adventure_template_id
            WHERE nt.adventure_template_id=\"$aid\"";
  $result = $mysql->query_assoc($query);
  return $result;
}

function update_flavor() {
  global $mysql;
  
  $id = $_POST['id'];
  $text = $_POST['text'];

  $query = "REPLACE INTO adventure_template_entry_flavor SET text=\"$text\", id=\"$id\"";
  $mysql->query_no_result($query);
}

function delete_adventure() {
  global $mysql;

  $id = $_GET['id'];

  $query = "DELETE from adventure_template WHERE id=\"$id\"";
  $mysql->query_no_result($query);

  $query = "DELETE from adventure_template_entry WHERE template_id=\"$id\"";
  $mysql->query_no_result($query);
}

function delete_trap_template() {
  global $mysql;

  $id = $_GET['id'];

  $query = "DELETE from ldon_trap_templates WHERE id=\"$id\"";
  $mysql->query_no_result($query);

  $query = "DELETE from ldon_trap_entries WHERE trap_id=\"$id\"";
  $mysql->query_no_result($query);
}

function adventure_info() {
  global $mysql;

  $id = $_GET['id'];

  $query = "SELECT * FROM adventure_template WHERE id=\"$id\"";
  $result = $mysql->query_assoc($query);
  
  return $result;
}

function traptemplate_info() {
  global $mysql;

  $id = $_GET['id'];

  $query = "SELECT * FROM ldon_trap_templates WHERE id=\"$id\"";
  $result = $mysql->query_assoc($query);
  
  return $result;
}

function update_adventure_template() {
  global $mysql;

  $id = $_POST['id'];
  $zone = $_POST['zone'];
  $text = $_POST['text'];
  $zone_version = $_POST['zone_version'];
  $is_hard = $_POST['is_hard'];
  $is_raid = $_POST['is_raid'];
  $min_level = $_POST['min_level'];
  $max_level = $_POST['max_level']; 
  $type = $_POST['type'];
  $type_data = $_POST['type_data'];
  $type_count = $_POST['type_count'];
  $assa_x = $_POST['assa_x'];
  $assa_y = $_POST['assa_y'];
  $assa_z = $_POST['assa_z'];
  $assa_h = $_POST['assa_h'];
  $zone_in_zone_id = $_POST['zone_in_zone_id'];
  $dest_x = $_POST['dest_x'];
  $dest_y = $_POST['dest_y'];
  $dest_z = $_POST['dest_z'];
  $dest_h = $_POST['dest_h'];
  $duration = $_POST['duration'];
  $zone_in_time = $_POST['zone_in_time'];
  $win_points = $_POST['win_points'];
  $lose_points = $_POST['lose_points'];
  $theme = $_POST['theme'];
  $zone_in_x = $_POST['zone_in_x'];
  $zone_in_y = $_POST['zone_in_y'];
  $zone_in_object_id = $_POST['zone_in_object_id'];
  $graveyard_zone_id = $_POST['graveyard_zone_id'];
  $graveyard_x = $_POST['graveyard_x'];
  $graveyard_y = $_POST['graveyard_y'];
  $graveyard_z = $_POST['graveyard_z'];
  $graveyard_radius = $_POST['graveyard_radius'];

  $query = "UPDATE adventure_template SET zone=\"$zone\", text=\"$text\", zone_version=\"$zone_version\", is_hard=\"$is_hard\", is_raid=\"$is_raid\", min_level=\"$min_level\", max_level=\"$max_level\", type=\"$type\", type_data=\"$type_data\", type_count=\"$type_count\", assa_x=\"$assa_x\", assa_y=\"$assa_y\", assa_z=\"$assa_z\", assa_h=\"$assa_h\", zone_in_zone_id=\"$zone_in_zone_id\", dest_x=\"$dest_x\", dest_y=\"$dest_y\", dest_z=\"$dest_z\", dest_h=\"$dest_h\", duration=\"$duration\", zone_in_time=\"$zone_in_time\", win_points=\"$win_points\", lose_points=\"$lose_points\", theme=\"$theme\", zone_in_x=\"$zone_in_x\", zone_in_y=\"$zone_in_y\", zone_in_object_id=\"$zone_in_object_id\", graveyard_zone_id=\"$graveyard_zone_id\", graveyard_x=\"$graveyard_x\", graveyard_y=\"$graveyard_y\", graveyard_z=\"$graveyard_z\", graveyard_radius=\"$graveyard_radius\" WHERE id=\"$id\"";
  $mysql->query_no_result($query);
}

function update_trap_template() {
  global $mysql;

  $id = $_POST['id'];
  $type = $_POST['type'];
  $spell_id = $_POST['spell_id'];
  $skill = $_POST['skill'];
  $locked = $_POST['locked'];

  $query = "UPDATE ldon_trap_templates SET type=\"$type\", spell_id=\"$spell_id\", skill=\"$skill\", locked=\"$locked\" WHERE id=\"$id\"";
  $mysql->query_no_result($query);
}

function add_trap_template() {
  global $mysql;

  $id = $_POST['id'];
  $ttid = $_POST['ttid'];
  $type = $_POST['type'];
  $spell_id = $_POST['spell_id'];
  $skill = $_POST['skill'];
  $locked = $_POST['locked'];

  $query = "INSERT INTO ldon_trap_templates SET id=\"$id\", type=\"$type\", spell_id=\"$spell_id\", skill=\"$skill\", locked=\"$locked\"";
  $mysql->query_no_result($query);

  $query = "INSERT INTO ldon_trap_entries SET id=\"$ttid\", trap_id=\"$id\"";
  $mysql->query_no_result($query);
}

function add_adventure() {
  global $mysql;

  $id = $_POST['id'];
  $aid = $_POST['aid'];
  $zone = $_POST['zone'];
  $text = $_POST['text'];
  $zone_version = $_POST['zone_version'];
  $is_hard = $_POST['is_hard'];
  $is_raid = $_POST['is_raid'];
  $min_level = $_POST['min_level'];
  $max_level = $_POST['max_level']; 
  $type = $_POST['type'];
  $type_data = $_POST['type_data'];
  $type_count = $_POST['type_count'];
  $assa_x = $_POST['assa_x'];
  $assa_y = $_POST['assa_y'];
  $assa_z = $_POST['assa_z'];
  $assa_h = $_POST['assa_h'];
  $zone_in_zone_id = $_POST['zone_in_zone_id'];
  $dest_x = $_POST['dest_x'];
  $dest_y = $_POST['dest_y'];
  $dest_z = $_POST['dest_z'];
  $dest_h = $_POST['dest_h'];
  $duration = $_POST['duration'];
  $zone_in_time = $_POST['zone_in_time'];
  $win_points = $_POST['win_points'];
  $lose_points = $_POST['lose_points'];
  $theme = $_POST['theme'];
  $zone_in_x = $_POST['zone_in_x'];
  $zone_in_y = $_POST['zone_in_y'];
  $zone_in_object_id = $_POST['zone_in_object_id'];
  $graveyard_zone_id = $_POST['graveyard_zone_id'];
  $graveyard_x = $_POST['graveyard_x'];
  $graveyard_y = $_POST['graveyard_y'];
  $graveyard_z = $_POST['graveyard_z'];
  $graveyard_radius = $_POST['graveyard_radius'];

  $query = "INSERT INTO adventure_template SET id=\"$id\", zone=\"$zone\", text=\"$text\", zone_version=\"$zone_version\", is_hard=\"$is_hard\", is_raid=\"$is_raid\", min_level=\"$min_level\", max_level=\"$max_level\", type=\"$type\", type_data=\"$type_data\", type_count=\"$type_count\", assa_x=\"$assa_x\", assa_y=\"$assa_y\", assa_z=\"$assa_z\", assa_h=\"$assa_h\", zone_in_zone_id=\"$zone_in_zone_id\", dest_x=\"$dest_x\", dest_y=\"$dest_y\", dest_z=\"$dest_z\", dest_h=\"$dest_h\", duration=\"$duration\", zone_in_time=\"$zone_in_time\", win_points=\"$win_points\", lose_points=\"$lose_points\", theme=\"$theme\", zone_in_x=\"$zone_in_x\", zone_in_y=\"$zone_in_y\", zone_in_object_id=\"$zone_in_object_id\", graveyard_zone_id=\"$graveyard_zone_id\", graveyard_x=\"$graveyard_x\", graveyard_y=\"$graveyard_y\", graveyard_z=\"$graveyard_z\", graveyard_radius=\"$graveyard_radius\"";
  $mysql->query_no_result($query);

  $query = "INSERT INTO adventure_template_entry SET id=\"$aid\", template_id=\"$id\"";
  $mysql->query_no_result($query);
}

function suggest_adventure_template_id() {
  global $mysql;
  $query = "SELECT MAX(id) as template_id FROM adventure_template";
  $result = $mysql->query_assoc($query);
  return ($result['template_id'] + 1);
}

function suggest_adventure_id() {
  global $mysql;
  $query = "SELECT MAX(id) as aid FROM adventure_template_entry";
  $result = $mysql->query_assoc($query);
  return ($result['aid'] + 1);
}

function suggest_trap_template_id() {
  global $mysql;
  $query = "SELECT MAX(id) as ttid FROM ldon_trap_templates";
  $result = $mysql->query_assoc($query);
  return ($result['ttid'] + 1);
}

function search_adventure_npc() {
  global $mysql;
  $query = "SELECT id,name FROM npc_types where adventure_template_id > 0";
  $results = $mysql->query_mult_assoc($query);
  return $results;
}

function copy_adventure_instance() {
  global $mysql;
  $id = $_GET['id'];

  $query = "SELECT * FROM adventure_template WHERE id=$id";
  $result = $mysql->query_assoc($query);

  $query2 = "SELECT id as aid FROM adventure_template_entry where template_id=$id";
  $result2 = $mysql->query_assoc($query2);
  
  $query3 = "SELECT MAX(id) as tid FROM adventure_template";
  $result3 = $mysql->query_assoc($query3);

$zone = $result['zone'];
$text = $result['text'];
$is_hard = $result['is_hard'];
$is_raid = $result['is_raid'];
$type = $result['type'];
$type_count = $result['type_count'];
$assa_x = $result['assa_x'];
$assa_y = $result['assa_y'];
$assa_z = $result['assa_z'];
$assa_h = $result['assa_h'];
$zone_in_zone_id = $result['zone_in_zone_id'];
$dest_x = $result['dest_x'];
$dest_y = $result['dest_y'];
$dest_z = $result['dest_z'];
$dest_h = $result['dest_h'];
$duration = $result['duration'];
$zone_in_time = $result['zone_in_time'];
$theme = $result['theme'];
$zone_in_x = $result['zone_in_x'];
$zone_in_y = $result['zone_in_y'];
$zone_in_object_id = $result['zone_in_object_id'];
$aid = $result2['aid'];
$graveyard_zone_id = $result['graveyard_zone_id'];
$graveyard_x = $result['graveyard_x'];
$graveyard_y = $result['graveyard_y'];
$graveyard_z = $result['graveyard_z'];
$graveyard_radius = $result['graveyard_radius'];

$zone_version1 = $result['zone_version'] + 1;
$zone_version2 = $result['zone_version'] + 2;
$zone_version3 = $result['zone_version'] + 3;
$zone_version4 = $result['zone_version'] + 4;
$zone_version5 = $result['zone_version'] + 5;
$zone_version6 = $result['zone_version'] + 6;
$zone_version7 = $result['zone_version'] + 7;
$zone_version8 = $result['zone_version'] + 8;

$tid1 = $result3['tid'] + 1;
$tid2 = $result3['tid'] + 2;
$tid3 = $result3['tid'] + 3;
$tid4 = $result3['tid'] + 4;
$tid5 = $result3['tid'] + 5;
$tid6 = $result3['tid'] + 6;
$tid7 = $result3['tid'] + 7;
$tid8 = $result3['tid'] + 8;

$min_level1 = $result['min_level'] + 6;
$min_level2 = $result['min_level'] + 12;
$min_level3 = $result['min_level'] + 18;
$min_level4 = $result['min_level'] + 24;
$min_level5 = $result['min_level'] + 30;
$min_level6 = $result['min_level'] + 36;
$min_level7 = $result['min_level'] + 42;
$min_level8 = $result['min_level'] + 48;

$max_level1 = $result['max_level'] + 6;
$max_level2 = $result['max_level'] + 12;
$max_level3 = $result['max_level'] + 18;
$max_level4 = $result['max_level'] + 24;
$max_level5 = $result['max_level'] + 30;
$max_level6 = $result['max_level'] + 36;
$max_level7 = $result['max_level'] + 42;
$max_level8 = $result['max_level'] + 55;

if($type == 1){
$type_data1 = $result['type_data'] + 1;
$type_data2 = $result['type_data'] + 2;
$type_data3 = $result['type_data'] + 3;
$type_data4 = $result['type_data'] + 4;
$type_data5 = $result['type_data'] + 5;
$type_data6 = $result['type_data'] + 6;
$type_data7 = $result['type_data'] + 7;
$type_data8 = $result['type_data'] + 8;
}

if($type > 1){
$type_data1 = $result['type_data'];
$type_data2 = $result['type_data'];
$type_data3 = $result['type_data'];
$type_data4 = $result['type_data'];
$type_data5 = $result['type_data'];
$type_data6 = $result['type_data'];
$type_data7 = $result['type_data'];
$type_data8 = $result['type_data'];
}

if($is_hard == 0){
$win_points1 = $result['win_points'] + 10;
$win_points2 = $result['win_points'] + 20;
$win_points3 = $result['win_points'] + 30;
$win_points4 = $result['win_points'] + 40;
$win_points5 = $result['win_points'] + 50;
$win_points6 = $result['win_points'] + 60;
$win_points7 = $result['win_points'] + 70;
$win_points8 = $result['win_points'] + 80;

$lose_points1 = $result['lose_points'] + 5;
$lose_points2 = $result['lose_points'] + 10;
$lose_points3 = $result['lose_points'] + 15;
$lose_points4 = $result['lose_points'] + 20;
$lose_points5 = $result['lose_points'] + 25;
$lose_points6 = $result['lose_points'] + 30;
$lose_points7 = $result['lose_points'] + 35;
$lose_points8 = $result['lose_points'] + 40;
}

if($is_hard == 1){
$win_points1 = $result['win_points'] + 20;
$win_points2 = $result['win_points'] + 40;
$win_points3 = $result['win_points'] + 60;
$win_points4 = $result['win_points'] + 80;
$win_points5 = $result['win_points'] + 100;
$win_points6 = $result['win_points'] + 120;
$win_points7 = $result['win_points'] + 140;
$win_points8 = $result['win_points'] + 160;

$lose_points1 = $result['lose_points'] + 10;
$lose_points2 = $result['lose_points'] + 20;
$lose_points3 = $result['lose_points'] + 30;
$lose_points4 = $result['lose_points'] + 40;
$lose_points5 = $result['lose_points'] + 50;
$lose_points6 = $result['lose_points'] + 60;
$lose_points7 = $result['lose_points'] + 70;
$lose_points8 = $result['lose_points'] + 80;
}
  
  $query = "INSERT INTO adventure_template SET id=\"$tid1\", zone=\"$zone\", text=\"$text\", zone_version=\"$zone_version1\", is_hard=\"$is_hard\", is_raid=\"$is_raid\", min_level=\"$min_level1\", max_level=\"$max_level1\", type=\"$type\", type_data=\"$type_data1\", type_count=\"$type_count\", assa_x=\"$assa_x\", assa_y=\"$assa_y\", assa_z=\"$assa_z\", assa_h=\"$assa_h\", zone_in_zone_id=\"$zone_in_zone_id\", dest_x=\"$dest_x\", dest_y=\"$dest_y\", dest_z=\"$dest_z\", dest_h=\"$dest_h\", duration=\"$duration\", zone_in_time=\"$zone_in_time\", win_points=\"$win_points1\", lose_points=\"$lose_points1\", theme=\"$theme\", zone_in_x=\"$zone_in_x\", zone_in_y=\"$zone_in_y\", zone_in_object_id=\"$zone_in_object_id\", graveyard_zone_id=\"$graveyard_zone_id\", graveyard_x=\"$graveyard_x\", graveyard_y=\"$graveyard_y\", graveyard_z=\"$graveyard_z\", graveyard_radius=\"$graveyard_radius\"";
  $mysql->query_no_result($query);

  $query = "INSERT INTO adventure_template_entry SET id=\"$aid\", template_id=\"$tid1\"";
  $mysql->query_no_result($query);
  
  $query = "INSERT INTO adventure_template SET id=\"$tid2\", zone=\"$zone\", text=\"$text\", zone_version=\"$zone_version2\", is_hard=\"$is_hard\", is_raid=\"$is_raid\", min_level=\"$min_level2\", max_level=\"$max_level2\", type=\"$type\", type_data=\"$type_data2\", type_count=\"$type_count\", assa_x=\"$assa_x\", assa_y=\"$assa_y\", assa_z=\"$assa_z\", assa_h=\"$assa_h\", zone_in_zone_id=\"$zone_in_zone_id\", dest_x=\"$dest_x\", dest_y=\"$dest_y\", dest_z=\"$dest_z\", dest_h=\"$dest_h\", duration=\"$duration\", zone_in_time=\"$zone_in_time\", win_points=\"$win_points2\", lose_points=\"$lose_points2\", theme=\"$theme\", zone_in_x=\"$zone_in_x\", zone_in_y=\"$zone_in_y\", zone_in_object_id=\"$zone_in_object_id\", graveyard_zone_id=\"$graveyard_zone_id\", graveyard_x=\"$graveyard_x\", graveyard_y=\"$graveyard_y\", graveyard_z=\"$graveyard_z\", graveyard_radius=\"$graveyard_radius\"";
    $mysql->query_no_result($query);
  
    $query = "INSERT INTO adventure_template_entry SET id=\"$aid\", template_id=\"$tid2\"";
  $mysql->query_no_result($query);
  
  $query = "INSERT INTO adventure_template SET id=\"$tid3\", zone=\"$zone\", text=\"$text\", zone_version=\"$zone_version3\", is_hard=\"$is_hard\", is_raid=\"$is_raid\", min_level=\"$min_level3\", max_level=\"$max_level3\", type=\"$type\", type_data=\"$type_data3\", type_count=\"$type_count\", assa_x=\"$assa_x\", assa_y=\"$assa_y\", assa_z=\"$assa_z\", assa_h=\"$assa_h\", zone_in_zone_id=\"$zone_in_zone_id\", dest_x=\"$dest_x\", dest_y=\"$dest_y\", dest_z=\"$dest_z\", dest_h=\"$dest_h\", duration=\"$duration\", zone_in_time=\"$zone_in_time\", win_points=\"$win_points3\", lose_points=\"$lose_points3\", theme=\"$theme\", zone_in_x=\"$zone_in_x\", zone_in_y=\"$zone_in_y\", zone_in_object_id=\"$zone_in_object_id\", graveyard_zone_id=\"$graveyard_zone_id\", graveyard_x=\"$graveyard_x\", graveyard_y=\"$graveyard_y\", graveyard_z=\"$graveyard_z\", graveyard_radius=\"$graveyard_radius\"";
    $mysql->query_no_result($query);
  
    $query = "INSERT INTO adventure_template_entry SET id=\"$aid\", template_id=\"$tid3\"";
  $mysql->query_no_result($query);
  
  $query = "INSERT INTO adventure_template SET id=\"$tid4\", zone=\"$zone\", text=\"$text\", zone_version=\"$zone_version4\", is_hard=\"$is_hard\", is_raid=\"$is_raid\", min_level=\"$min_level4\", max_level=\"$max_level4\", type=\"$type\", type_data=\"$type_data4\", type_count=\"$type_count\", assa_x=\"$assa_x\", assa_y=\"$assa_y\", assa_z=\"$assa_z\", assa_h=\"$assa_h\", zone_in_zone_id=\"$zone_in_zone_id\", dest_x=\"$dest_x\", dest_y=\"$dest_y\", dest_z=\"$dest_z\", dest_h=\"$dest_h\", duration=\"$duration\", zone_in_time=\"$zone_in_time\", win_points=\"$win_points4\", lose_points=\"$lose_points4\", theme=\"$theme\", zone_in_x=\"$zone_in_x\", zone_in_y=\"$zone_in_y\", zone_in_object_id=\"$zone_in_object_id\", graveyard_zone_id=\"$graveyard_zone_id\", graveyard_x=\"$graveyard_x\", graveyard_y=\"$graveyard_y\", graveyard_z=\"$graveyard_z\", graveyard_radius=\"$graveyard_radius\"";
    $mysql->query_no_result($query);
  
    $query = "INSERT INTO adventure_template_entry SET id=\"$aid\", template_id=\"$tid4\"";
  $mysql->query_no_result($query);
  
  $query = "INSERT INTO adventure_template SET id=\"$tid5\", zone=\"$zone\", text=\"$text\", zone_version=\"$zone_version5\", is_hard=\"$is_hard\", is_raid=\"$is_raid\", min_level=\"$min_level5\", max_level=\"$max_level5\", type=\"$type\", type_data=\"$type_data5\", type_count=\"$type_count\", assa_x=\"$assa_x\", assa_y=\"$assa_y\", assa_z=\"$assa_z\", assa_h=\"$assa_h\", zone_in_zone_id=\"$zone_in_zone_id\", dest_x=\"$dest_x\", dest_y=\"$dest_y\", dest_z=\"$dest_z\", dest_h=\"$dest_h\", duration=\"$duration\", zone_in_time=\"$zone_in_time\", win_points=\"$win_points5\", lose_points=\"$lose_points5\", theme=\"$theme\", zone_in_x=\"$zone_in_x\", zone_in_y=\"$zone_in_y\", zone_in_object_id=\"$zone_in_object_id\", graveyard_zone_id=\"$graveyard_zone_id\", graveyard_x=\"$graveyard_x\", graveyard_y=\"$graveyard_y\", graveyard_z=\"$graveyard_z\", graveyard_radius=\"$graveyard_radius\"";
    $mysql->query_no_result($query);
  
    $query = "INSERT INTO adventure_template_entry SET id=\"$aid\", template_id=\"$tid5\"";
  $mysql->query_no_result($query);
  
  $query = "INSERT INTO adventure_template SET id=\"$tid6\", zone=\"$zone\", text=\"$text\", zone_version=\"$zone_version6\", is_hard=\"$is_hard\", is_raid=\"$is_raid\", min_level=\"$min_level6\", max_level=\"$max_level6\", type=\"$type\", type_data=\"$type_data6\", type_count=\"$type_count\", assa_x=\"$assa_x\", assa_y=\"$assa_y\", assa_z=\"$assa_z\", assa_h=\"$assa_h\", zone_in_zone_id=\"$zone_in_zone_id\", dest_x=\"$dest_x\", dest_y=\"$dest_y\", dest_z=\"$dest_z\", dest_h=\"$dest_h\", duration=\"$duration\", zone_in_time=\"$zone_in_time\", win_points=\"$win_points6\", lose_points=\"$lose_points6\", theme=\"$theme\", zone_in_x=\"$zone_in_x\", zone_in_y=\"$zone_in_y\", zone_in_object_id=\"$zone_in_object_id\", graveyard_zone_id=\"$graveyard_zone_id\", graveyard_x=\"$graveyard_x\", graveyard_y=\"$graveyard_y\", graveyard_z=\"$graveyard_z\", graveyard_radius=\"$graveyard_radius\"";
    $mysql->query_no_result($query);
  
    $query = "INSERT INTO adventure_template_entry SET id=\"$aid\", template_id=\"$tid6\"";
  $mysql->query_no_result($query);
  
  $query = "INSERT INTO adventure_template SET id=\"$tid7\", zone=\"$zone\", text=\"$text\", zone_version=\"$zone_version7\", is_hard=\"$is_hard\", is_raid=\"$is_raid\", min_level=\"$min_level7\", max_level=\"$max_level7\", type=\"$type\", type_data=\"$type_data7\", type_count=\"$type_count\", assa_x=\"$assa_x\", assa_y=\"$assa_y\", assa_z=\"$assa_z\", assa_h=\"$assa_h\", zone_in_zone_id=\"$zone_in_zone_id\", dest_x=\"$dest_x\", dest_y=\"$dest_y\", dest_z=\"$dest_z\", dest_h=\"$dest_h\", duration=\"$duration\", zone_in_time=\"$zone_in_time\", win_points=\"$win_points7\", lose_points=\"$lose_points7\", theme=\"$theme\", zone_in_x=\"$zone_in_x\", zone_in_y=\"$zone_in_y\", zone_in_object_id=\"$zone_in_object_id\", graveyard_zone_id=\"$graveyard_zone_id\", graveyard_x=\"$graveyard_x\", graveyard_y=\"$graveyard_y\", graveyard_z=\"$graveyard_z\", graveyard_radius=\"$graveyard_radius\"";
    $mysql->query_no_result($query);
  
    $query = "INSERT INTO adventure_template_entry SET id=\"$aid\", template_id=\"$tid7\"";
  $mysql->query_no_result($query);
  
  $query = "INSERT INTO adventure_template SET id=\"$tid8\", zone=\"$zone\", text=\"$text\", zone_version=\"$zone_version8\", is_hard=\"$is_hard\", is_raid=\"$is_raid\", min_level=\"$min_level8\", max_level=\"$max_level8\", type=\"$type\", type_data=\"$type_data8\", type_count=\"$type_count\", assa_x=\"$assa_x\", assa_y=\"$assa_y\", assa_z=\"$assa_z\", assa_h=\"$assa_h\", zone_in_zone_id=\"$zone_in_zone_id\", dest_x=\"$dest_x\", dest_y=\"$dest_y\", dest_z=\"$dest_z\", dest_h=\"$dest_h\", duration=\"$duration\", zone_in_time=\"$zone_in_time\", win_points=\"$win_points8\", lose_points=\"$lose_points8\", theme=\"$theme\", zone_in_x=\"$zone_in_x\", zone_in_y=\"$zone_in_y\", zone_in_object_id=\"$zone_in_object_id\", graveyard_zone_id=\"$graveyard_zone_id\", graveyard_x=\"$graveyard_x\", graveyard_y=\"$graveyard_y\", graveyard_z=\"$graveyard_z\", graveyard_radius=\"$graveyard_radius\"";
    $mysql->query_no_result($query);
  
    $query = "INSERT INTO adventure_template_entry SET id=\"$aid\", template_id=\"$tid8\"";
  $mysql->query_no_result($query);
}

function copy_adventure_template() {
  global $mysql;
  $id = $_GET['id'];

  $query = "SELECT * FROM adventure_template WHERE id=$id";
  $result = $mysql->query_assoc($query);

  $query2 = "SELECT id as aid FROM adventure_template_entry where template_id=$id";
  $result2 = $mysql->query_assoc($query2);
  
  $query3 = "SELECT MAX(id) as tid FROM adventure_template";
  $result3 = $mysql->query_assoc($query3);

$zone = $result['zone'];
$text = $result['text'];
$is_hard = $result['is_hard'];
$is_raid = $result['is_raid'];
$type = $result['type'];
$type_data = $result['type_data'];
$type_count = $result['type_count'];
$assa_x = $result['assa_x'];
$assa_y = $result['assa_y'];
$assa_z = $result['assa_z'];
$assa_h = $result['assa_h'];
$zone_in_zone_id = $result['zone_in_zone_id'];
$dest_x = $result['dest_x'];
$dest_y = $result['dest_y'];
$dest_z = $result['dest_z'];
$dest_h = $result['dest_h'];
$duration = $result['duration'];
$zone_in_time = $result['zone_in_time'];
$theme = $result['theme'];
$zone_in_x = $result['zone_in_x'];
$zone_in_y = $result['zone_in_y'];
$zone_in_object_id = $result['zone_in_object_id'];
$aid = $result2['aid'];
$zone_version1 = $result['zone_version'];
$tid1 = $result3['tid'] + 1;
$min_level1 = $result['min_level'];
$max_level1 = $result['max_level'];
$win_points1 = $result['win_points'];
$lose_points1 = $result['lose_points'];
$graveyard_zone_id = $result['graveyard_zone_id'];
$graveyard_x = $result['graveyard_x'];
$graveyard_y = $result['graveyard_y'];
$graveyard_z = $result['graveyard_z'];
$graveyard_radius = $result['graveyard_radius'];

 $query = "INSERT INTO adventure_template SET id=\"$tid1\", zone=\"$zone\", text=\"$text\", zone_version=\"$zone_version1\", is_hard=\"$is_hard\", is_raid=\"$is_raid\", min_level=\"$min_level1\", max_level=\"$max_level1\", type=\"$type\", type_data=\"$type_data\", type_count=\"$type_count\", assa_x=\"$assa_x\", assa_y=\"$assa_y\", assa_z=\"$assa_z\", assa_h=\"$assa_h\", zone_in_zone_id=\"$zone_in_zone_id\", dest_x=\"$dest_x\", dest_y=\"$dest_y\", dest_z=\"$dest_z\", dest_h=\"$dest_h\", duration=\"$duration\", zone_in_time=\"$zone_in_time\", win_points=\"$win_points1\", lose_points=\"$lose_points1\", theme=\"$theme\", zone_in_x=\"$zone_in_x\", zone_in_y=\"$zone_in_y\", zone_in_object_id=\"$zone_in_object_id\", graveyard_zone_id=\"$graveyard_zone_id\", graveyard_x=\"$graveyard_x\", graveyard_y=\"$graveyard_y\", graveyard_z=\"$graveyard_z\", graveyard_radius=\"$graveyard_radius\"";
  $mysql->query_no_result($query);

$query = "INSERT INTO adventure_template_entry SET id=\"$aid\", template_id=\"$tid1\"";
  $mysql->query_no_result($query);
}
?>