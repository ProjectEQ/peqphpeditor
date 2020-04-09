<?
$aura_type = array (
  0 => "On All Friendlies",
  1 => "On All Group Members",
  2 => "On Group Members Pets",
  3 => "Totem",
  4 => "Enter Trap",
  5 => "Exit Trap",
  6 => "Fully Scripted",
  7 => "Max"
);

$aura_spawn = array (
  0 => "Group Members",
  1 => "Everyone",
  2 => "No One",
  3 => "Max"
);

$aura_movement = array (
  0 => "Follow",
  1 => "Stationary",
  2 => "Pathing",
  3 => "Max"
);

switch($action) {
  case 0: //Default
    $body = new Template("templates/auras/auras.default.tmpl.php");
    break;
  case 1: //List Auras
    $body = new Template("templates/auras/auras.list.tmpl.php");
    $breadcrumbs .= " >> View Auras";
    $auras = getAuras();
    if ($auras) {
      $body->set("auras", $auras);
    }
    break;
  case 2: //View Aura
    $body = new Template("templates/auras/aura.view.tmpl.php");
    $breadcrumbs .= " >> View Aura";
    $body->set("aura_type", $aura_type);
    $body->set("aura_spawn", $aura_spawn);
    $body->set("aura_movement", $aura_movement);
    $aura = getAura();
    if ($aura) {
      $body->set("aura", $aura);
    }
    break;
  case 3: //Add Aura
    check_authorization();
    $body = new Template("templates/auras/aura.add.tmpl.php");
    $breadcrumbs .= " >> Add Aura";
    $javascript = new Template("templates/auras/js.tmpl.php");
    $body->set("aura_type", $aura_type);
    $body->set("aura_spawn", $aura_spawn);
    $body->set("aura_movement", $aura_movement);
    break;
  case 4: //Insert Aura
    check_authorization();
    auraInsert();
    $type = $_POST['type'];
    header("Location: index.php?editor=auras&type=$type&action=2");
    exit;
  case 5: //Edit Aura
    check_authorization();
    $body = new Template("templates/auras/aura.edit.tmpl.php");
    $breadcrumbs .= " >> Edit Aura";
    $javascript = new Template("templates/auras/js.tmpl.php");
    $body->set("aura_type", $aura_type);
    $body->set("aura_spawn", $aura_spawn);
    $body->set("aura_movement", $aura_movement);
    $aura = getAura();
    $body->set("aura", $aura);
    break;
  case 6: //Update Aura
    check_authorization();
    auraUpdate();
    $type = $_POST['type'];
    header("Location: index.php?editor=auras&type=$type&action=2");
    exit;
  case 7: //Delete Aura
    check_authorization();
    auraDelete();
    header("Location: index.php?editor=auras&action=1");
    exit;
  case 8: //Search Auras
    $body = new Template("templates/auras/auras.searchresults.tmpl.php");
    $breadcrumbs .= " >> Search Results";
    if (isset($_GET['name']) && $_GET['name'] != "Name") {
      $results = searchByName();
    }
    elseif (isset($_GET['npc']) && intval($_GET['npc']) && $_GET['npc'] != "NPC ID") {
      $results = searchByNPC();
    }
    elseif (isset($_GET['spell']) && intval($_GET['spell']) && $_GET['spell'] != "Spell ID") {
      $results = searchBySpell();
    }
    if ($results) {
      $body->set("results", $results);
    }
    break;
  case 9: //Character Auras
    check_admin_authorization();
    $body = new Template("templates/auras/auras.character.tmpl.php");
    $breadcrumbs .= " >> Character Auras";
    $char_auras = getCharacterAuras();
    if ($char_auras) {
      $body->set("char_auras", $char_auras);
    }
    break;
  case 10: //Add Character Aura
    check_admin_authorization();
    break;
  case 11: //Insert Character Aura
    check_admin_authorization();
    header("Location: index.php?editor=auras&action=9");
    exit;
  case 12: //Edit Character Aura
    check_admin_authorization();
    break;
  case 13: //Update Character Aura
    check_admin_authorization();
    header("Location: index.php?editor=auras&action=9");
    exit;
  case 14: //Delete Character Aura
    check_admin_authorization();
    deleteCharacterAura();
    header("Location: index.php?editor=auras&action=9");
    exit;
}

function getAuras() {
  global $mysql_content_db;

  $query = "SELECT type, npc_type, name FROM auras";
  $results = $mysql_content_db->query_mult_assoc($query);

  if ($results) {
    return $results;
  }
  else {
    return null;
  }
}

function getAura() {
  global $mysql_content_db;
  $type = $_GET['type'];

  $query = "SELECT * FROM auras WHERE type=$type";
  $result = $mysql_content_db->query_assoc($query);

  if ($result) {
    return $result;
  }
  else {
    return null;
  }
}

function auraInsert() {
  global $mysql_content_db;
  $type = $_POST['type'];
  $npc_type = $_POST['npc_type'];
  $name = $_POST['name'];
  $spell_id = $_POST['spell_id'];
  $distance = $_POST['distance'];
  $aura_type = $_POST['aura_type'];
  $spawn_type = $_POST['spawn_type'];
  $movement = $_POST['movement'];
  $duration = $_POST['duration'];
  $icon = $_POST['icon'];
  $cast_time = $_POST['cast_time'];

  $query = "INSERT INTO auras (type, npc_type, name, spell_id, distance, aura_type, spawn_type, movement, duration, icon, cast_time) VALUES ($type, $npc_type, \"$name\", $spell_id, $distance, $aura_type, $spawn_type, $movement, $duration, $icon, $cast_time)";
  $mysql_content_db->query_no_result($query);
}

function auraUpdate() {
  global $mysql_content_db;
  $old_type = $_POST['old_type'];
  $type = $_POST['type'];
  $npc_type = $_POST['npc_type'];
  $name = $_POST['name'];
  $spell_id = $_POST['spell_id'];
  $distance = $_POST['distance'];
  $aura_type = $_POST['aura_type'];
  $spawn_type = $_POST['spawn_type'];
  $movement = $_POST['movement'];
  $duration = $_POST['duration'];
  $icon = $_POST['icon'];
  $cast_time = $_POST['cast_time'];

  $query = "UPDATE auras SET type=$type, npc_type=$npc_type, name=\"$name\", spell_id=$spell_id, distance=$distance, aura_type=$aura_type, spawn_type=$spawn_type, movement=$movement, duration=$duration, icon=$icon, cast_time=$cast_time WHERE type=$old_type";
  $mysql_content_db->query_no_result($query);
}

function auraDelete() {
  global $mysql_content_db;
  $type = $_GET['type'];

  $query = "DELETE FROM auras WHERE type=$type";
  $mysql_content_db->query_no_result($query);
}

function searchByName() {
  global $mysql_content_db;
  $search = $_GET['name'];

  $query = "SELECT type, name FROM auras WHERE name RLIKE \"$search\" ORDER BY type";
  $results = $mysql_content_db->query_mult_assoc($query);

  if ($results) {
    return $results;
  }
  else {
    return null;
  }
}

function searchByNPC() {
  global $mysql_content_db;
  $search = $_GET['npc'];

  $query = "SELECT type, name FROM auras WHERE npc_type=$search ORDER BY type";
  $results = $mysql_content_db->query_mult_assoc($query);

  if ($results) {
    return $results;
  }
  else {
    return null;
  }
}

function searchBySpell() {
  global $mysql_content_db;
  $search = $_GET['spell'];

  $query = "SELECT type, name FROM auras WHERE spell_id=$search ORDER BY type";
  $results = $mysql_content_db->query_mult_assoc($query);

  if ($results) {
    return $results;
  }
  else {
    return null;
  }
}

function getCharacterAuras() {
  global $mysql;

  $query = "SELECT * FROM character_auras ORDER BY id LIMIT 500";
  $results = $mysql->query_mult_assoc($query);

  if ($results) {
    return $results;
  }
  else {
    return null;
  }
}

function updateCharacterAura() {
  global $mysql;
  $id = $_POST['id'];
  $old_id = $_POST['old_id'];
  $slot = $_POST['slot'];
  $spell_id = $_POST['spell_id'];

  $query = "UPDATE character_auras SET id=$id, slot=$slot, spell_id=$spell_id WHERE id=$old_id";
  $mysql->query_no_result($query);
}

function deleteCharacterAura() {
  global $mysql;
  $id = $_GET['id'];
  $slot = $_GET['slot'];

  $query = "DELETE FROM character_auras WHERE id=$id and slot=$slot";
  $mysql->query_no_result($query);
}

?>