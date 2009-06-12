<? 

$advtype = array(
  1   => "Assassinate",
  2   => "Kill Count",
  3   => "Loot Count",
  4   => "Rescue",
);

$themetype = array(
  1   => "Deepest Guk",
  2   => "Miragul's Menagerie",
  3   => "Mistmoore Catacombs",
  4   => "Rujarkian Hills",
  5   => "Takish-Hiz",
);

$ldontraptype = array(
  1   => "Mechanical",
  2   => "Magical",
  3   => "Cursed",
);

switch ($action) {
  case 0:         
    if ($npcid) {
      $body = new Template("templates/adventures/adventures.tmpl.php");
      $body->set('currzone', $z);
      $body->set('npcid', $npcid);
    }
    break;
  case 1: // Assassinate Adventures
      $body = new Template("templates/adventures/assassinate.tmpl.php");
      $body->set('currzone', $z);
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
      $body = new Template("templates/adventures/kill.tmpl.php");
      $body->set('currzone', $z);
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
      $body = new Template("templates/adventures/loot.tmpl.php");
      $body->set('currzone', $z);
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
      $body = new Template("templates/adventures/rescue.tmpl.php");
      $body->set('currzone', $z);
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
    header("Location: index.php?editor=adventures&z=$z&npcid=$npcid");
    exit;
  case 7: // Delete Adventure
    check_authorization();
    delete_adventure();
    header("Location: index.php?editor=adventures&z=$z&npcid=$npcid");
    exit;
  case 8: // Edit Adventure
    check_authorization();
    $body = new Template("templates/adventures/adventures.edit.tmpl.php");
    $body->set('currzone', $z);
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
    header("Location: index.php?editor=adventures&z=$z&npcid=$npcid");
    exit;
  case 10: // Add Adventure
    check_authorization();
    $body = new Template("templates/adventures/adventures.add.tmpl.php");
    $body->set('currzone', $z);
    $body->set('npcid', $npcid);
    $body->set('advtype', $advtype);
    $body->set('themetype', $themetype);
    $body->set('suggestaid', suggest_adventure_template_id());
    $body->set('aid', get_adventure_id());
    break;
  case 11: // Add Adventure
    check_authorization();
    add_adventure();
    header("Location: index.php?editor=adventures&z=$z&npcid=$npcid");
    exit;
  case 12: // Trap Templates
      $body = new Template("templates/adventures/traptemplate.tmpl.php");
      $body->set('currzone', $z);
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
    header("Location: index.php?editor=adventures&z=$z&npcid=$npcid");
    exit;
   case 15: // Delete Trap Template
    check_authorization();
    delete_trap_template();
    header("Location: index.php?editor=adventures&z=$z&npcid=$npcid");
    exit;
   case 16: // Add Trap Template
    check_authorization();
    $javascript = new Template("templates/iframes/js.tmpl.php");
    $body = new Template("templates/adventures/traptemplate.add.tmpl.php");
    $body->set('currzone', $z);
    $body->set('npcid', $npcid);
    $body->set('yesno', $yesno);
    $body->set('ldontraptype', $ldontraptype);
    $body->set('suggestedid', suggest_trap_template_id());
    $body->set('ttid', get_trap_template());
    break;
   case 17: // Add Trap Template
    check_authorization();
    add_trap_template();
    header("Location: index.php?editor=adventures&z=$z&npcid=$npcid");
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
    $array['bossassa'][$result['id']] = array("id"=>$result['id'], "zone"=>$result['zone'], "is_hard"=>$result['is_hard'], "is_raid"=>$result['is_raid'], "min_level"=>$result['min_level'], "max_level"=>$result['max_level'], "type"=>$result['type'], "type_data"=>$result['type_data'], "theme"=>$result['theme'], "zone_in_zone_id"=>$result['zone_in_zone_id']);    
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
    $array['kill'][$result['id']] = array("id"=>$result['id'], "zone"=>$result['zone'], "is_hard"=>$result['is_hard'], "is_raid"=>$result['is_raid'], "min_level"=>$result['min_level'], "max_level"=>$result['max_level'], "type"=>$result['type'], "type_count"=>$result['type_count'], "theme"=>$result['theme'], "zone_in_zone_id"=>$result['zone_in_zone_id']);    
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
    $array['loot'][$result['id']] = array("id"=>$result['id'], "zone"=>$result['zone'], "is_hard"=>$result['is_hard'], "is_raid"=>$result['is_raid'], "min_level"=>$result['min_level'], "max_level"=>$result['max_level'], "type"=>$result['type'], "type_data"=>$result['type_data'], "type_count"=>$result['type_count'], "theme"=>$result['theme'], "zone_in_zone_id"=>$result['zone_in_zone_id']);    
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
    $array['rescue'][$result['id']] = array("id"=>$result['id'], "zone"=>$result['zone'], "is_hard"=>$result['is_hard'], "is_raid"=>$result['is_raid'], "min_level"=>$result['min_level'], "max_level"=>$result['max_level'], "type"=>$result['type'], "type_data"=>$result['type_data'], "theme"=>$result['theme'], "zone_in_zone_id"=>$result['zone_in_zone_id']);    
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

  $query = "UPDATE adventure_template SET zone=\"$zone\", text=\"$text\", zone_version=\"$zone_version\", is_hard=\"$is_hard\", is_raid=\"$is_raid\", min_level=\"$min_level\", max_level=\"$max_level\", type=\"$type\", type_data=\"$type_data\", type_count=\"$type_count\", assa_x=\"$assa_x\", assa_y=\"$assa_y\", assa_z=\"$assa_z\", assa_h=\"$assa_h\", zone_in_zone_id=\"$zone_in_zone_id\", dest_x=\"$dest_x\", dest_y=\"$dest_y\", dest_z=\"$dest_z\", dest_h=\"$dest_h\", duration=\"$duration\", zone_in_time=\"$zone_in_time\", win_points=\"$win_points\", lose_points=\"$lose_points\", theme=\"$theme\", zone_in_x=\"$zone_in_x\", zone_in_y=\"$zone_in_y\", zone_in_object_id=\"$zone_in_object_id\" WHERE id=\"$id\"";
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

  $query = "INSERT INTO adventure_template SET id=\"$id\", zone=\"$zone\", text=\"$text\", zone_version=\"$zone_version\", is_hard=\"$is_hard\", is_raid=\"$is_raid\", min_level=\"$min_level\", max_level=\"$max_level\", type=\"$type\", type_data=\"$type_data\", type_count=\"$type_count\", assa_x=\"$assa_x\", assa_y=\"$assa_y\", assa_z=\"$assa_z\", assa_h=\"$assa_h\", zone_in_zone_id=\"$zone_in_zone_id\", dest_x=\"$dest_x\", dest_y=\"$dest_y\", dest_z=\"$dest_z\", dest_h=\"$dest_h\", duration=\"$duration\", zone_in_time=\"$zone_in_time\", win_points=\"$win_points\", lose_points=\"$lose_points\", theme=\"$theme\", zone_in_x=\"$zone_in_x\", zone_in_y=\"$zone_in_y\", zone_in_object_id=\"$zone_in_object_id\"";
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

?>