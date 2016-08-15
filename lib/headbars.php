<?php

// Build editor tabs
$headbar = build_tabs();

switch ($editor) {
  case '':
    break;
  case 'npc':
    $npcs = npcs();
    $zonelist = zones();
    $searchbar = new Template("templates/searchbar/searchbar.bynpcid.tmpl.php");
    $searchbar->set('curreditor', $editor);
    $searchbar->set('currzone', $z);
    $searchbar->set('currzoneid', $zoneid);
    $searchbar->set('zonelist', $zonelist);
    $searchbar->set('expansion_limit', $expansion_limit);
    $searchbar->set('npcs', $npcs);
    $searchbar->set('currnpc', $npcid);
    break;
  case 'loot':
    $zonelist = zones();
    $npcs = npcs();
    $searchbar = new Template("templates/searchbar/searchbar.loot.tmpl.php");
    $searchbar->set('curreditor', $editor);
    $searchbar->set('currzone', $z);
    $searchbar->set('currzoneid', $zoneid);
    $searchbar->set('zonelist', $zonelist);
    $searchbar->set('expansion_limit', $expansion_limit);
    $searchbar->set('npcs', $npcs);
    $searchbar->set('currnpc', $npcid);
    break;
  case 'merchant':
    $zonelist = zones();
    $npcs = npcs_by_merchantid();
    $searchbar = new Template("templates/searchbar/searchbar.bymerchantid.tmpl.php");
    $searchbar->set('curreditor', $editor);
    $searchbar->set('currzone', $z);
    $searchbar->set('currzoneid', $zoneid);
    $searchbar->set('zonelist', $zonelist);
    $searchbar->set('expansion_limit', $expansion_limit);
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
    $zonelist = zones();
    $npcs = npcs();
    $searchbar = new Template("templates/searchbar/searchbar.byspawn.tmpl.php");
    $searchbar->set('curreditor', $editor);
    $searchbar->set('currzone', $z);
    $searchbar->set('currzoneid', $zoneid);
    $searchbar->set('zonelist', $zonelist);
    $searchbar->set('expansion_limit', $expansion_limit);
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
  case 'spellops':
    break;
  case 'spellset':
    $zonelist = zones();
    $npcs = npcs_by_spellid();
    $searchbar = new Template("templates/searchbar/searchbar.spells.tmpl.php");
    $searchbar->set('curreditor', $editor);
    $searchbar->set('currspellset', $spellset);
    $searchbar->set('spellsets', spellsets());
    $searchbar->set('currzone', $z);
    $searchbar->set('currzoneid', $zoneid);
    $searchbar->set('zonelist', $zonelist);
    $searchbar->set('expansion_limit', $expansion_limit);
    $searchbar->set('npcs', $npcs);
    $searchbar->set('currnpc', $npcid);
    break;
  case 'spells':
    $zones = zones();
    $searchbar = new Template("templates/searchbar/searchbar.spellsed.tmpl.php");
    $searchbar->set('curreditor', $editor);
    break;
  case 'zone':
    $zonelist = zones();
    $zonelist2 = zones2();
    $searchbar = new Template("templates/searchbar/searchbar.zone.tmpl.php");
    $searchbar->set('curreditor', $editor);
    $searchbar->set('currzone', $z);
    $searchbar->set('currzoneid', $zoneid);
    $searchbar->set('zonelist', $zonelist);
    $searchbar->set('zonelist2', $zonelist2);
    $searchbar->set('expansion_limit', $expansion_limit);
    break;
  case 'misc':
    $zonelist = zones();
    $searchbar = new Template("templates/searchbar/searchbar.misc.tmpl.php");
    $searchbar->set('curreditor', $editor);
    $searchbar->set('currzone', $z);
    $searchbar->set('currzoneid', $zoneid);
    $searchbar->set('zonelist', $zonelist);
    $searchbar->set('expansion_limit', $expansion_limit);
    break;
  case 'server':
    break;
  case 'adventures':
    break;
  case 'tasks':
    $tasks = tasks();
    $searchbar = new Template("templates/searchbar/searchbar.tasks.tmpl.php");
    $searchbar->set('curreditor', $editor);
    $searchbar->set('currtask', $tskid);
    $searchbar->set('tasks', $tasks);
    break;
  case 'items':
    $npcs = npcs();
    $searchbar = new Template("templates/searchbar/searchbar.items.tmpl.php");
    $searchbar->set('curreditor', $editor);
    break;
  case 'player':
    $searchbar = new Template("templates/searchbar/searchbar.players.tmpl.php");
    $searchbar->set('curreditor', $editor);
    break;
  case 'account':
    $searchbar = new Template("templates/searchbar/searchbar.bylsacct.tmpl.php");
    $searchbar->set('curreditor', $editor);
    break;
  case 'guild':
    $guilds = guilds();
    $searchbar = new Template("templates/searchbar/searchbar.guild.tmpl.php");
    $searchbar->set('curreditor', $editor);
    $searchbar->set('guilds', $guilds);
    $searchbar->set('currguild', $guildid);
    break;
  case 'mail':
    break;
  case 'aa':
    $aas = aas();
    $searchbar = new Template("templates/searchbar/searchbar.byaaid.tmpl.php");
    $searchbar->set('curreditor', $editor);
    $searchbar->set('aas', $aas);
    $searchbar->set('curraa', $aaid);
    $searchbar->set('eqexpansions', $eqexpansions);
    break;
  case 'qglobal':
    break;
  case 'util':
    break;
  case 'altcur':
    break;
  case 'quest':
    $npcs = npcs();
    $zonelist = zones();
    $searchbar = new Template("templates/searchbar/searchbar.bynpcid.tmpl.php");
    $searchbar->set('curreditor', $editor);
    $searchbar->set('currzone', $z);
    $searchbar->set('currzoneid', $zoneid);
    $searchbar->set('zonelist', $zonelist);
    $searchbar->set('expansion_limit', $expansion_limit);
    $searchbar->set('npcs', $npcs);
    $searchbar->set('currnpc', $npcid);
    break;
  case 'inv':
    $searchbar = new Template("templates/searchbar/searchbar.inventory.tmpl.php");
    break;
  case 'keys':
    $searchbar = new Template("templates/searchbar/searchbar.keys.tmpl.php");
    break;
}

function build_tabs () {
  global $editor, $z, $zoneid, $npcid, $playerid, $acctid, $guildid;

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
  $tabstatus15 = "off";
  $tabstatus16 = "off";
  $tabstatus17 = "off";
  $tabstatus18 = "off";
  $tabstatus19 = "off";
  $tabstatus20 = "off";
  $tabstatus21 = "off";
  $tabstatus22 = "off";
  $tabstatus23 = "off";
  $tabstatus24 = "off";

  $zoneurl = "";
  $npcurl = "";
  if ($z) $zoneurl = "&z=$z&zoneid=$zoneid";
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
    case 'spells':
      $tabstatus5 = "on";
      break;
    case 'spellops':
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
    case 'account':
      $tabstatus15 = "on";
      break;
    case 'guild':
      $tabstatus16 = "on";
      break;
    case 'mail':
      $tabstatus17 = "on";
      break;
    case 'aa':
      $tabstatus18 = "on";
      break;
    case 'qglobal':
      $tabstatus19 = "on";
      break;
    case 'util':
      $tabstatus20 = "on";
      break;
    case 'altcur':
      $tabstatus21 = "on";
      break;
    case 'inv':
      $tabstatus22 = "on";
      break;
    case 'keys':
      $tabstatus23 = "on";
      break;
    case 'quest':
      $tabstatus24 = "on";
      break;
  }

  $admin = '';
  if (session::is_admin()) {
    $admin = "<a href=\"index.php?admin\">Admin</a> | ";
  }

  ob_start();

  echo "      <div id=\"menubar\">
        <div class=\"$tabstatus1\"><a href=\"index.php?editor=npc$zoneurl$npcurl\">NPCs</a></div>
        <div class=\"$tabstatus2\"><a href=\"index.php?editor=loot$zoneurl$npcurl\">Loot</a></div>
        <div class=\"$tabstatus3\"><a href=\"index.php?editor=spawn$zoneurl$npcurl\">Spawns</a></div>
        <div class=\"$tabstatus4\"><a href=\"index.php?editor=merchant$zoneurl$npcurl\">Merchants</a></div>
        <div class=\"$tabstatus5\"><a href=\"index.php?editor=spellops$zoneurl$npcurl\">Spells</a></div>
        <div class=\"$tabstatus6\"><a href=\"index.php?editor=faction\">Factions</a></div>
        <div class=\"$tabstatus7\"><a href=\"index.php?editor=tradeskill\">Tradeskills</a></div>
        <div class=\"$tabstatus8\"><a href=\"index.php?editor=zone$zoneurl\">Zones</a></div>
        <div class=\"$tabstatus9\"><a href=\"index.php?editor=misc$zoneurl\">Misc</a></div>
        <div class=\"$tabstatus10\"><a href=\"index.php?editor=server\">Server</a></div>
        <div class=\"$tabstatus11\"><a href=\"index.php?editor=adventures$zoneurl$npcurl\">Adventures</a></div><br/><br/>
        <div class=\"$tabstatus12\"><a href=\"index.php?editor=tasks\">Tasks</a></div>
        <div class=\"$tabstatus13\"><a href=\"index.php?editor=items\">Items</a></div>
        <div class=\"$tabstatus14\"><a href=\"index.php?editor=player\">Players</a></div>
        <div class=\"$tabstatus15\"><a href=\"index.php?editor=account\">Accounts</a></div>
        <div class=\"$tabstatus16\"><a href=\"index.php?editor=guild\">Guilds</a></div>
        <div class=\"$tabstatus17\"><a href=\"index.php?editor=mail\">Mail</a></div>
        <div class=\"$tabstatus18\"><a href=\"index.php?editor=aa\">AAs</a></div>
        <div class=\"$tabstatus19\"><a href=\"index.php?editor=qglobal\">QGlobals</a></div>
        <div class=\"$tabstatus20\"><a href=\"index.php?editor=util\">Utilities</a></div>
        <div class=\"$tabstatus21\"><a href=\"index.php?editor=altcur\">Alt Curr</a></div>
        <div class=\"$tabstatus22\"><a href=\"index.php?editor=inv\">Inventory</a></div>
        <div class=\"$tabstatus23\"><a href=\"index.php?editor=keys\">Keys</a></div><br/><br/>
        <div class=\"$tabstatus24\"><a href=\"index.php?editor=quest\">Quests</a></div>
        <div style=\"float: right;\">$admin<a href=\"index.php?logout\">Logout</a></div><br/><br/>
      </div>
";

  $headbar = ob_get_contents();
  ob_end_clean();

  return $headbar;
}

function zones() {
  global $mysql;

  $query = "SELECT id, short_name, version, expansion FROM zone ORDER BY short_name ASC";
  $results = $mysql->query_mult_assoc($query);

  return $results;
}

function zones2() {
  global $mysql;

  $query = "SELECT id, short_name, long_name, version, expansion FROM zone ORDER BY long_name ASC";
  $results = $mysql->query_mult_assoc($query);

  return $results;
}

function npcs() {
  global $mysql, $z, $zoneid, $npc_list;
  $version = 0;
  $zid = "___";
  $results = array();

  if($npc_list == '')
    $npc_list = 1;

  if($z) {
    $zid = getZoneID($z) . "___";
    $query = "SELECT version FROM zone WHERE id = \"$zoneid\"";
    $result = $mysql->query_assoc($query);
    $version = $result['version'];
  }

  if($npc_list == 1) {
    if ($version > 0) {
      $query = "SELECT id, name FROM npc_types WHERE id like \"$zid\" AND version = $version GROUP BY id ORDER BY name ASC";
      $results = $mysql->query_mult_assoc($query);
    }
    if ($version < 1) {
      $query = "SELECT id, name FROM npc_types WHERE id like \"$zid\" GROUP BY id ORDER BY name ASC";
      $results = $mysql->query_mult_assoc($query);
    }
  }
  if($npc_list == 2) {
    if ($version > 0) {
      $query = "SELECT npc_types.id AS id, npc_types.name AS name FROM npc_types,spawnentry,spawn2 WHERE (spawn2.spawngroupid=spawnentry.spawngroupid AND npc_types.id=spawnentry.npcid) AND spawn2.zone = '$z' AND spawn2.version = $version GROUP BY npc_types.id ORDER BY npc_types.name ASC";
      $results = $mysql->query_mult_assoc($query);
    }
    if ($version < 1){
      $query = "SELECT npc_types.id AS id, npc_types.name AS name FROM npc_types,spawnentry,spawn2 WHERE (spawn2.spawngroupid=spawnentry.spawngroupid AND npc_types.id=spawnentry.npcid) AND spawn2.zone = '$z' GROUP BY npc_types.id ORDER BY npc_types.name ASC";
      $results = $mysql->query_mult_assoc($query);
    }
  }
  return $results;
}

function npcs_by_merchantid() {
  global $mysql, $z, $zoneid;
  $version = 0;
  $zid = "___";
  $results = array();

  if($z) {
    $zid = getZoneID($z) . "___";
    $query = "SELECT version FROM zone WHERE id = \"$zoneid\"";
    $result = $mysql->query_assoc($query);
    $version = $result['version'];

    if ($version > 0) {
      $query = "SELECT id, name FROM npc_types WHERE id like \"$zid\" AND version = $version AND merchant_id != 0 GROUP BY id ORDER BY name ASC";
      $results = $mysql->query_mult_assoc($query);
    }
    if ($version == 0) {
      $query = "SELECT id, name FROM npc_types WHERE id like \"$zid\" AND merchant_id != 0 GROUP BY id ORDER BY name ASC";
      $results = $mysql->query_mult_assoc($query);
    }
  }
  else {
    $query = "SELECT id, name FROM npc_types WHERE id like \"$zid\" AND merchant_id != 0 GROUP BY id ORDER BY name ASC";
    $results = $mysql->query_mult_assoc($query);
  }
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
  global $mysql, $z, $zoneid;
  $version = 0;
  $zid = "___";
  $results = array();

  if($z) {
    $zid = getZoneID($z) . "___";
    $query = "SELECT version FROM zone WHERE id = $zoneid";
    $result = $mysql->query_assoc($query);
    $version = $result['version'];

    if ($version > 0) {
      $query = "SELECT id, name FROM npc_types WHERE id like \"$zid\" AND version = $version AND npc_spells_id != 0 GROUP BY id ORDER BY name ASC";
      $results = $mysql->query_mult_assoc($query);
    }
    if ($version == 0) {
      $query = "SELECT id, name FROM npc_types WHERE id like \"$zid\" AND npc_spells_id != 0 GROUP BY id ORDER BY name ASC";
      $results = $mysql->query_mult_assoc($query);
    }
  }
  else {
    $query = "SELECT id, name FROM npc_types WHERE id like \"$zid\" AND npc_spells_id != 0 GROUP BY id ORDER BY name ASC";
    $results = $mysql->query_mult_assoc($query);
  }
  return $results;
}

function spellsets() {
  global $mysql;

  $query = "SELECT id, name FROM npc_spells";
  $results = $mysql->query_mult_assoc($query);

  return $results;
}

function guilds() {
  global $mysql;

  $query = "SELECT id, name FROM guilds ORDER BY name ASC";
  $results = $mysql->query_mult_assoc($query);

  return $results;
}

function aas() {
  global $mysql;

  $query = "SELECT id, name FROM aa_ability ORDER BY name, id";
  $results = $mysql->query_mult_assoc($query);

  return $results;
}
?>