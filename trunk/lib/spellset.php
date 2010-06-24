<?php

$spelltypes = array(
  1   => "Nuke",
  2   => "Heal",
  4   => "Root",
  8   => "Buff",
  16  => "Escape",
  32  => "Pet",
  64  => "Lifetap",
  128 => "Snare",
  256 => "DOT",
  512 => "Dispel",
  1024 => "In-Combat Buff",
  2048 => "Mez",
  4096 => "Charm"
);

switch($action) {
  case 0: // View NPC Spells
    if ($npcid || $spellset) {
      $body = new Template("templates/spellset/spell.tmpl.php");
      $body->set('currzone', $z);
      $body->set('currzoneid', $zoneid);
      $body->set('npcid', $npcid);
      $body->set('spellset', $spellset);
      $body->set('spelltypes', $spelltypes);
      $vars = spells_info();
      if ($vars) {
        foreach ($vars as $key=>$value) {
          $body->set($key, $value);
        }
      }
    }
    break;
  case 1: // Edit Spellset
    check_authorization();
    $javascript = new Template("templates/iframes/js.tmpl.php");
    $body = new Template("templates/spellset/spellset.edit.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('spellset', $spellset);
    $body->set('npcid', $npcid);
    $vars = spells_info();
    if ($vars) {
      foreach ($vars as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
  case 2:
    check_authorization();
    update_spellset();
    header("Location: index.php?editor=spellset&z=$z&zoneid=$zoneid&npcid=$npcid&spellset=$spellset");
    exit;
  case 3: // Add Spell
    check_authorization();
    $javascript = new Template("templates/iframes/js.tmpl.php");
    $body = new Template("templates/spellset/spell.add.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('spellset', $spellset);
    $body->set('npcid', $npcid);
    $body->set('spelltypes', $spelltypes);
    $body->set('npc_spells_id', $_GET['id']);
    break;
  case 4:
    check_authorization();
    add_spell();
    header("Location: index.php?editor=spellset&z=$z&zoneid=$zoneid&npcid=$npcid&spellset=$spellset");
    exit;
  case 5: // Delete spell
    check_authorization();
    delete_spell();
    header("Location: index.php?editor=spellset&z=$z&zoneid=$zoneid&npcid=$npcid&spellset=$spellset");
    exit;
  case 6: // Edit spell
    check_authorization();
    $javascript = new Template("templates/iframes/js.tmpl.php");
    $body = new Template("templates/spellset/spell.edit.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('spellset', $spellset);
    $body->set('npcid', $npcid);
    $body->set('spelltypes', $spelltypes);
    $vars = spell_info();
    if ($vars) {
      foreach ($vars as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
  case 7:
    check_authorization();
    delete_spellset();
    header("Location: index.php?editor=spellset&z=$z&zoneid=$zoneid&npcid=$npcid");
    exit;
  case 8:
    check_authorization();
    update_spell();
    header("Location: index.php?editor=spellset&z=$z&zoneid=$zoneid&npcid=$npcid&spellset=$spellset");
    exit;
  case 9: // Change Spellset
    check_authorization();
    $body = new Template("templates/spellset/spellset.change.tmpl.php");
    $body->set('spellset', $spellset);
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    break;
  case 10: // Add new Spellset
    check_authorization();
    $javascript = new Template("templates/iframes/js.tmpl.php");
    $body = new Template("templates/spellset/spellset.add.tmpl.php");
    $body->set('spellset', $spellset);
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    $body->set('name', getNPCName($npcid));
    $body->set('id', suggest_spellset_id());
    break;
  case 11:
    check_authorization();
    add_spellset();
    update_npc_spellset();
    header("Location: index.php?editor=spellset&z=$z&zoneid=$zoneid&npcid=$npcid");
    exit;
  case 12: // Change Spellset by id
    check_authorization();
    $javascript = new Template("templates/iframes/js.tmpl.php");
    $body = new Template("templates/spellset/spellset.changebyid.tmpl.php");
    $body->set('spellset', $spellset);
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    break;
  case 13:
    check_authorization();
    update_npc_spellset();
    header("Location: index.php?editor=spellset&z=$z&zoneid=$zoneid&npcid=$npcid");
    exit;
  case 14:
    check_authorization();
    remove_spellset();
    header("Location: index.php?editor=spellset&z=$z&zoneid=$zoneid&npcid=$npcid");
    exit;
  case 15:  // Search spells
    $body = new Template("templates/spellset/spell.searchresults.tmpl.php");
    $results = search_spells();
    $body->set("results", $results);
    break;
  case 16:  // Copy spellset
    check_authorization();
    copy_spellset();
    $nss = get_new_id();
    header("Location: index.php?editor=spellset&z=$z&zoneid=$zoneid&npcid=$npcid");
    exit;
  case 17: // Mass change spellset 
    check_authorization();
    $body = new Template("templates/spellset/spellset.masschange.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    $body->set('id', $_GET['id']);
    break;
  case 18:
    check_authorization();
    $body = new Template("templates/spellset/spellset.changebyname.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    $body->set('id', $_GET['id']);
    break;
  case 19:
    check_authorization();
    $body = new Template("templates/spellset/spellset.changebyclass.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    $body->set('classes', $classes);
    $body->set('id', $_GET['id']);
    break;
  case 20: // Change spellset by NPC Name
    check_authorization();
    change_spellset_byname();
    header("Location: index.php?editor=spellset&z=$z&zoneid=$zoneid&npcid=$npcid");
    exit;
  case 21: // Change spellset by NPC Race
    check_authorization();
    change_spellset_byclass();
    header("Location: index.php?editor=spellset&z=$z&zoneid=$zoneid&npcid=$npcid");
    exit;
}

function spells_info () {
  global $mysql, $npcid, $spellset;

  $array = array();

  if (!$spellset) {
    $query = "SELECT npc_spells_id FROM npc_types WHERE id=$npcid";
    $result = $mysql->query_assoc($query);
    $npc_spells_id = $result['npc_spells_id'];
  }
  else $npc_spells_id = $spellset;

  if ($npc_spells_id == 0) return array("npc_spells_id" => 0);

  $query = "SELECT * FROM npc_spells WHERE id=$npc_spells_id";
  $result = $mysql->query_assoc($query);
  $array = $result;

  $array['proc_name'] = getSpellName($array['attack_proc']);

  $query = "SELECT * FROM npc_spells_entries WHERE npc_spells_id=$npc_spells_id ORDER BY minlevel";
  $results = $mysql->query_mult_assoc($query);
  if ($results != '') {
    foreach ($results as $result) {
      $result['name'] = getSpellName($result['spellid']);
      $array['spells'][] = $result;
    }
  }
  else $array['spells'] = '';

  if (isset($array['parent_list']) && ($array['parent_list'] != 0)) {
    $query = "SELECT * FROM npc_spells WHERE id={$array['parent_list']}";
    $result = $mysql->query_assoc($query);
    $array['parent']['name'] = $result['name'];
    $array['parent']['id'] = $result['id'];

    $query = "SELECT * FROM npc_spells_entries WHERE npc_spells_id={$array['parent_list']} ORDER BY minlevel";
    $results = $mysql->query_mult_assoc($query);
    if ($results) {
      foreach ($results as $result) {
        $result['name'] = getSpellName($result['spellid']);
        $array['parent']['spells'][] = $result;
      }
    }
  }

  return $array;
}

function update_spellset() {
  check_authorization();
  global $mysql;

  $attack_proc = $_POST['attack_proc'];
  $proc_chance = $_POST['proc_chance'];
  $parent_list = $_POST['parent_list'];
  $id = $_POST['id'];
  $name = $_POST['name'];

  $query = "UPDATE npc_spells SET name=\"$name\", attack_proc=$attack_proc, proc_chance=$proc_chance, parent_list=$parent_list WHERE id=$id";
  $mysql->query_no_result($query);
}

function add_spell() {
  check_authorization();
  global $mysql;

  $npc_spells_id = $_POST['npc_spells_id'];
  $spellid = $_POST['spellid'];
  $type = $_POST['type'];
  $minlevel = $_POST['minlevel'];
  $maxlevel = $_POST['maxlevel'];
  $manacost = $_POST['manacost'];
  $recast_delay = $_POST['recast_delay'];
  $priority = $_POST['priority'];

  $query = "INSERT INTO npc_spells_entries SET npc_spells_id=$npc_spells_id, spellid=$spellid, type=$type, minlevel=$minlevel, maxlevel=$maxlevel, manacost=$manacost, recast_delay=$recast_delay, priority=$priority";
  $mysql->query_no_result($query);
}

function delete_spell() {
  check_authorization();
  global $mysql;

  $id = $_GET['id'];

  $query = "DELETE FROM npc_spells_entries WHERE id=$id";
  $mysql->query_no_result($query);
}

function spell_info() {
  global $mysql;

  $id = $_GET['id'];

  $query = "SELECT * FROM npc_spells_entries WHERE id=$id";
  $result = $mysql->query_assoc($query);

  return $result;
}

function delete_spellset() {
  check_authorization();
  global $mysql, $npcid;

  $id = $_GET['id'];

  $query = "DELETE FROM npc_spells WHERE id=$id";
  $mysql->query_no_result($query);

  $query = "DELETE FROM npc_spells_entries WHERE npc_spells_id=$id";
  $mysql->query_no_result($query);

  $query = "UPDATE npc_types SET npc_spells_id=0 WHERE id=$npcid";
  $mysql->query_no_result($query);
}

function update_spell() {
  check_authorization();
  global $mysql;

  $id = $_POST['id'];
  $spellid = $_POST['spellid'];
  $type = $_POST['type'];
  $minlevel = $_POST['minlevel'];
  $maxlevel = $_POST['maxlevel'];
  $manacost = $_POST['manacost'];
  $recast_delay = $_POST['recast_delay'];
  $priority = $_POST['priority'];

  $query = "UPDATE npc_spells_entries SET spellid=$spellid, type=$type, minlevel=$minlevel, maxlevel=$maxlevel, manacost=$manacost, recast_delay=$recast_delay, priority=$priority WHERE id=$id";
  $mysql->query_no_result($query);
}

function suggest_spellset_id() {
  global $mysql;

  $query = "SELECT MAX(id) AS id FROM npc_spells";
  $result = $mysql->query_assoc($query);
  $id1 = $result['id'];

  $query = "SELECT MAX(npc_spells_id) AS id FROM npc_spells_entries";
  $result = $mysql->query_assoc($query);
  $id2 = $result['id'];

  return (max($id1, $id2) + 1);
}

function add_spellset() {
  check_authorization();
  global $mysql;

  $id = $_POST['id'];
  $name = $_POST['name'];
  $parent_list = $_POST['parent_list'];
  $attack_proc = $_POST['attack_proc'];
  $proc_chance = $_POST['proc_chance'];

  $query = "INSERT INTO npc_spells SET id=$id, name=\"$name\", parent_list=$parent_list, attack_proc=$attack_proc, proc_chance=$proc_chance";
  $mysql->query_no_result($query);
}

function update_npc_spellset() {
  check_authorization();
  global $mysql, $npcid;

  $id = $_POST['id'];

  $query = "UPDATE npc_types SET npc_spells_id=$id WHERE id=$npcid";
  $mysql->query_no_result($query);
}

function remove_spellset() {
  check_authorization();
  global $mysql, $npcid;

  $query = "UPDATE npc_types SET npc_spells_id=0 WHERE id=$npcid";
  $mysql->query_no_result($query);
}

function search_spells() {
  global $mysql;
  $search = $_GET['search'];

  $query = "SELECT npc_spells_entries.npc_spells_id, spells_new.name AS spellname 
  FROM npc_spells_entries
  INNER JOIN spells_new ON spells_new.id = npc_spells_entries.spellid
  WHERE spells_new.name rlike \"$search\"";
  $results = $mysql->query_mult_assoc($query);
  return $results;
}

function copy_spellset() {
  check_authorization();
  global $mysql;
  $spellsetid = $_GET['spellsetid'];
  $npcid = $_GET['npcid'];

  $query = "DELETE FROM npc_spells WHERE id=0";
  $mysql->query_no_result($query);

  $query = "DELETE FROM npc_spells_entries WHERE npc_spells_id=0";
  $mysql->query_no_result($query);

  $query = "INSERT INTO npc_spells (name,parent_list,attack_proc,proc_chance) 
            SELECT name,parent_list,attack_proc,proc_chance FROM npc_spells where id=$spellsetid";
  $mysql->query_no_result($query);

  $query = "INSERT INTO npc_spells_entries (spellid,type,minlevel,maxlevel,manacost,recast_delay,priority) 
            SELECT spellid,type,minlevel,maxlevel,manacost,recast_delay,priority FROM npc_spells_entries where npc_spells_id=$spellsetid";
  $mysql->query_no_result($query);

  $query = "SELECT MAX(id) as sid FROM npc_spells";
  $result = $mysql->query_assoc($query);
  $nss = $result['sid'];

  $query = "UPDATE npc_spells_entries set npc_spells_id=$nss where npc_spells_id=0";
  $mysql->query_no_result($query);

  $query = "SELECT name FROM npc_types WHERE id=$npcid";
  $result = $mysql->query_assoc($query);
  $name = $result['name'];

  $query = "UPDATE npc_types set npc_spells_id=$nss where id=$npcid";
  $mysql->query_no_result($query);  

  $query = "UPDATE npc_spells set name=\"$name\" where id=$nss";
  $mysql->query_no_result($query);
}

function get_new_id() {
  check_authorization();
  global $mysql;

  $query = "SELECT MAX(id) as sid FROM npc_spells";
  $result = $mysql->query_assoc($query);
  $nss = $result['sid'];
  return $nss;
}

function change_spellset_byname () {
  check_authorization();
  global $mysql, $npcid, $z;
  $zid = getZoneID($z);
  $min_id = $zid*1000-1;
  $max_id = $zid*1000+1000;
  $id = $_GET['id'];
  $npcname = $_POST['npcname'];
  $updateall = $_POST['updateall'];
 
  if($updateall == 0){
  $query = "UPDATE npc_types SET npc_spells_id=$id WHERE name like \"%$npcname%\" AND id > $min_id AND id < $max_id AND npc_spells_id = 0";
  $mysql->query_no_result($query);
  }

  if($updateall == 1){
  $query = "UPDATE npc_types SET npc_spells_id=$id WHERE name like \"%$npcname%\" AND id > $min_id AND id < $max_id";
  $mysql->query_no_result($query);
  }
}

function change_spellset_byclass () {
  check_authorization();
  global $mysql, $npcid, $z;
  $zid = getZoneID($z);
  $min_id = $zid*1000-1;
  $max_id = $zid*1000+1000;
  $id = $_GET['id'];
  $npcclass = $_POST['npcclass'];
  $updateall = $_POST['updateall'];
 
  if($updateall == 0){
  $query = "UPDATE npc_types SET npc_spells_id=$id WHERE class = $npcclass AND id > $min_id AND id < $max_id AND npc_spells_id = 0";
  $mysql->query_no_result($query);
  }

  if($updateall == 1){
  $query = "UPDATE npc_types SET npc_spells_id=$id WHERE class = $npcclass AND id > $min_id AND id < $max_id";
  $mysql->query_no_result($query);
  }
}
?>
