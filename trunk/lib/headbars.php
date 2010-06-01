<?php

// If user is logged in, build Editor tabs

//  if ($_SESSION['logged_in'] == "TRUE") {

$headbar = build_tabs();

switch ($editor) {
  case '':
    break;
  case 'npc':
    $zones = $zones;
    $npcs = npcs();
    $searchbar = new Template("templates/searchbar/searchbar.bynpcid.tmpl.php");
    $searchbar->set('curreditor', $editor);
    $searchbar->set('zones', $zones);
    $searchbar->set('currzone', $z);
    $searchbar->set('npcs', $npcs);
    $searchbar->set('currnpc', $npcid);
    break;
  case 'loot':
    $zones = $zones;
    $npcs = npcs();
    $searchbar = new Template("templates/searchbar/searchbar.loot.tmpl.php");
    $searchbar->set('curreditor', $editor);
    $searchbar->set('zones', $zones);
    $searchbar->set('currzone', $z);
    $searchbar->set('npcs', $npcs);
    $searchbar->set('currnpc', $npcid);
    break;
  case 'merchant':
    $zones = $zones;
    $npcs = npcs_by_merchantid();
    $searchbar = new Template("templates/searchbar/searchbar.bymerchantid.tmpl.php");
    $searchbar->set('curreditor', $editor);
    $searchbar->set('zones', $zones);
    $searchbar->set('currzone', $z);
    $searchbar->set('npcs', $npcs);
    $searchbar->set('currnpc', $npcid);
    break;
  case 'faction':
    $factions = factions();
    $searchbar = new Template("templates/searchbar/searchbar.faction.tmpl.php");
    $searchbar->set('curreditor', $editor);
    $searchbar->set('currfaction', $fid);
    $searchbar->set('factions', $factions);
    break;
  case 'spawn':
    $zones = $zones;
    $npcs = npcs();
    $searchbar = new Template("templates/searchbar/searchbar.byspawn.tmpl.php");
    $searchbar->set('curreditor', $editor);
    $searchbar->set('zones', $zones);
    $searchbar->set('currzone', $z);
    $searchbar->set('npcs', $npcs);
    $searchbar->set('currnpc', $npcid);
    break;
  case 'tradeskill':
    $searchbar = new Template("templates/searchbar/searchbar.tradeskill.tmpl.php");
    $searchbar->set('tradeskills', $tradeskills);
    $searchbar->set('currts', $ts);
    $searchbar->set('recipes', recipes());
    $searchbar->set('currrec', $rec);
    break;
  case 'spellset':
    $zones = $zones;
    $npcs = npcs_by_spellid();
    $searchbar = new Template("templates/searchbar/searchbar.spells.tmpl.php");
    $searchbar->set('curreditor', $editor);
    $searchbar->set('currspellset', $spellset);
    $searchbar->set('zones', $zones);
    $searchbar->set('spellsets', spellsets());
    $searchbar->set('currzone', $z);
    $searchbar->set('npcs', $npcs);
    $searchbar->set('currnpc', $npcid);
    break;
  case 'zone':
    $zones = $zones;
    $searchbar = new Template("templates/searchbar/searchbar.zone.tmpl.php");
    $searchbar->set('curreditor', $editor);
    $searchbar->set('zones', $zones);
    $searchbar->set('currzone', $z);
    break;
  case 'misc':
    $zones = $zones;
    $searchbar = new Template("templates/searchbar/searchbar.misc.tmpl.php");
    $searchbar->set('curreditor', $editor);
    $searchbar->set('zones', $zones);
    $searchbar->set('currzone', $z);
    break;
  case 'server':
    $zones = $zones;
    break;
  case 'adventures':
    $zones = $zones;
    break;
  case 'tasks':
    $tasks = tasks();
    $searchbar = new Template("templates/searchbar/searchbar.tasks.tmpl.php");
    $searchbar->set('curreditor', $editor);
    $searchbar->set('currtask', $tskid);
    $searchbar->set('tasks', $tasks);
    break;
  case 'items':
    $zones = $zones;
    $npcs = npcs();
    $searchbar = new Template("templates/searchbar/searchbar.items.tmpl.php");
    $searchbar->set('curreditor', $editor);
    break;
  case 'player':
    $players = players();
    $searchbar = new Template("templates/searchbar/searchbar.byplayerid.tmpl.php");
    $searchbar->set('curreditor', $editor);
    $searchbar->set('players', $players);
    $searchbar->set('currplayer', $playerid);
}

function build_tabs () {
  global $editor, $z, $npcid, $playerid;

  $tabstatus1 = "off";
  $tabstatus2 = "off";
  $tabstatus3 = "off";
  $tabstatus4 = "off";
  $tabstatus5 = "off";
  $tabstatus6 = "off";
  $tabstatus7 = "off";
  $tabstatus8 = "off";
  $tabstatus9 = "off";
  $tabstatus10 = "off";
  $tabstatus11 = "off";
  $tabstatus12 = "off";
  $tabstatus13 = "off";
  $tabstatus14 = "off";

  $zoneurl = "";
  $npcurl = "";
  if ($z) $zoneurl = "&z=$z";
  if ($npcid) $npcurl = "&npcid=$npcid";

  switch ($editor) {
    case '':
      break;
    case 'npc':
      $tabstatus1 = "on";
      break;
    case 'loot':
      $tabstatus2 = "on";
      break;
    case 'spawn':
      $tabstatus3 = "on";
      break;
    case 'merchant':
      $tabstatus4 = "on";
      break;
    case 'spellset':
      $tabstatus5 = "on";
      break;
    case 'faction':
      $tabstatus6 = "on";
      break;
    case 'tradeskill':
      $tabstatus7 = "on";
      break;
    case 'zone':
      $tabstatus8 = "on";
      break;
    case 'misc':
      $tabstatus9 = "on";
      break;
    case 'server':
      $tabstatus10 = "on";
      break;
    case 'adventures':
      $tabstatus11 = "on";
      break;
    case 'tasks':
      $tabstatus12 = "on";
      break;
    case 'items':
      $tabstatus13 = "on";
      break;
    case 'player':
      $tabstatus14 = "on";
      break;
  }

  $admin = '';
  if (session::is_admin()) {
    $admin = "<a href=\"index.php?admin\">Admin</a> | ";
  }

  ob_start();

  echo "
      <div id=\"menubar\">
        <div class=\"$tabstatus1\"><a href=\"index.php?editor=npc$zoneurl$npcurl\">NPCs</a></div>
        <div class=\"$tabstatus2\"><a href=\"index.php?editor=loot$zoneurl$npcurl\">Loot</a></div>
        <div class=\"$tabstatus3\"><a href=\"index.php?editor=spawn$zoneurl$npcurl\">Spawns</a></div>
        <div class=\"$tabstatus4\"><a href=\"index.php?editor=merchant$zoneurl$npcurl\">Merchants</a></div>
        <div class=\"$tabstatus5\"><a href=\"index.php?editor=spellset$zoneurl$npcurl\">Spells</a></div>
        <div class=\"$tabstatus6\"><a href=\"index.php?editor=faction\">Factions</a></div>
        <div class=\"$tabstatus7\"><a href=\"index.php?editor=tradeskill\">Tradeskills</a></div>
        <div class=\"$tabstatus8\"><a href=\"index.php?editor=zone$zoneurl\">Zone</a></div>
        <div class=\"$tabstatus9\"><a href=\"index.php?editor=misc$zoneurl\">Misc</a></div>
        <div class=\"$tabstatus10\"><a href=\"index.php?editor=server\">Server</a></div>
        <div class=\"$tabstatus11\"><a href=\"index.php?editor=adventures\">Adventures</a></div><br>
        <div style=\"float: right;\">$admin<a href=\"index.php?logout\">Logout</a></div><br>
        <div class=\"$tabstatus12\"><a href=\"index.php?editor=tasks\">Tasks</a></div>
        <div class=\"$tabstatus13\"><a href=\"index.php?editor=items\">Items</a></div>
        <div class=\"$tabstatus14\"><a href=\"index.php?editor=player\">Players</a></div><br>
      </div>
 ";

  $headbar = ob_get_contents();
  ob_end_clean();

  return $headbar;

}

function zones () {
  global $mysql;

  $query = "SELECT short_name, long_name, zoneidnumber FROM zone ORDER BY short_name ASC";
  $results = $mysql->query_mult_assoc($query);

  return $results;
}

function npcs() {
  global $mysql, $z;

  $zid = getZoneID($z) . "___";

  $query = "SELECT id, name FROM npc_types WHERE id like \"$zid\" GROUP BY id ORDER BY name ASC";

//  $query = "SELECT npc_types.id AS id, npc_types.name AS name FROM npc_types,spawnentry,spawn2 WHERE (spawn2.spawngroupid=spawnentry.spawngroupid AND npc_types.id=spawnentry.npcid) AND spawn2.zone = '$z' GROUP BY npc_types.id ORDER BY npc_types.name ASC";
  $results = $mysql->query_mult_assoc($query);

  return $results;
}

function npcs_by_merchantid() {
  global $mysql, $z;

  $zid = getZoneId($z) . "___";
  $query = "SELECT id, name FROM npc_types WHERE id LIKE \"$zid\" AND merchant_id != 0 GROUP BY id ORDER BY name ASC";
  $results = $mysql->query_mult_assoc($query);

  return $results;
}

function factions() {
  global $mysql;

  $query = "SELECT id, name FROM faction_list ORDER BY name";
  $results = $mysql->query_mult_assoc($query);

  return $results;
}

function recipes() {
  global $mysql, $ts;

  $results = array();
  if ($ts != '') {
    $query = "SELECT id, name FROM tradeskill_recipe WHERE tradeskill=$ts ORDER BY name";
    $results = $mysql->query_mult_assoc($query);
  }

  return $results;
}

function tasks() {
  global $mysql;

    $query = "SELECT id, title FROM tasks ORDER BY title";
    $results = $mysql->query_mult_assoc($query);

  return $results;
}

function npcs_by_spellid() {
  global $mysql, $z;

  $zid = getZoneId($z) . "___";
  $query = "SELECT id, name FROM npc_types WHERE id LIKE \"$zid\" AND npc_spells_id != 0 GROUP BY id ORDER BY name ASC";
  $results = $mysql->query_mult_assoc($query);

  return $results;
}

function spellsets () {
  global $mysql;

  $query = "SELECT id, name FROM npc_spells";
  $results = $mysql->query_mult_assoc($query);

  return $results;
}

function players() {
  global $mysql;

  $query = "SELECT id, name FROM character_ ORDER BY name ASC";
  $results = $mysql->query_mult_assoc($query);

  return $results;
}
?>