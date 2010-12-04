<?php

function getNPCName($npcid) {
  global $mysql;
  
  $query = "SELECT name FROM npc_types WHERE id=$npcid";
  $result = $mysql->query_assoc($query);
  return $result['name'];
}

function getZoneLongName($short_name) {
  global $mysql;

  $query = "SELECT long_name FROM zone WHERE short_name=\"$short_name\"";
  $result = $mysql->query_assoc($query);
  return $result['long_name'];
}

function getZoneID($short_name) {
  global $mysql;

  $query = "SELECT zoneidnumber AS id FROM zone WHERE short_name=\"$short_name\"";
  $result = $mysql->query_assoc($query);
  return $result['id'];
}

function getZoneIDByName($short_name) {
  global $mysql;

  $query = "SELECT id FROM zone WHERE short_name=\"$short_name\"";
  $result = $mysql->query_assoc($query);
  return $result['id'];
}

function getZoneName($zoneidnumber) {
  global $mysql;

  $query = "SELECT short_name FROM zone WHERE zoneidnumber=\"$zoneidnumber\"";
  $result = $mysql->query_assoc($query);
  return $result['short_name'];
}

function searchItems($search) {
  global $mysql;
  
  $query = "SELECT id, name, lore FROM items WHERE name rlike \"$search\"";
  $results = $mysql->query_mult_assoc($query);
  return $results;
}

function get_merchant_id() {
  global $mysql, $npcid;
  $query = "SELECT merchant_id FROM npc_types WHERE id=$npcid";
  $result = $mysql->query_assoc($query);
  return $result['merchant_id'];
}

function get_adventure_id() {
  global $mysql, $npcid;
  $query = "SELECT adventure_template_id as id FROM npc_types WHERE id=$npcid";
  $result = $mysql->query_assoc($query);
  return $result['id'];
}

function get_trap_template() {
  global $mysql, $npcid;
  $query = "SELECT trap_template as id FROM npc_types WHERE id=$npcid";
  $result = $mysql->query_assoc($query);
  return $result['id'];
}

function get_item_name($id) {
  global $mysql;
  $query = "SELECT name FROM items WHERE id=$id";
  $result = $mysql->query_assoc($query);
  return $result['name'];
}

function getFactionName($fid) {
  global $mysql;
  $query = "SELECT name FROM faction_list WHERE id=$fid";
  $result = $mysql->query_assoc($query);
  return $result['name'];
}

function getTaskTitle($tskid) {
  global $mysql;
  $query = "SELECT title FROM tasks WHERE id=$tskid";
  $result = $mysql->query_assoc($query);
  return $result['title'];
}

function getRecipeName($id) {
  global $mysql;
  $query = "SELECT name FROM tradeskill_recipe WHERE id=$id";
  $result = $mysql->query_assoc($query);
  return $result['name'];
}

function getSpellName($id) {
  global $mysql;
  $query = "SELECT name FROM spells_new WHERE id=$id";
  $result = $mysql->query_assoc($query);
  return $result['name'];
}

function getSpellsetName($id) {
  global $mysql;
  $query = "SELECT name FROM npc_spells WHERE id=$id";
  $result = $mysql->query_assoc($query);
  return $result['name'];
}

function check_authorization() {
  global $tmpl;
  
  if(!session::check_authorization()) {
    $body = "<center><br><br><br><br><br><h2>Sorry, guests do not have access to this function.<br><br><a href=\"javascript:history.back();\">Go Back</a></h2>";
    $tmpl->set('body', $body);
    echo $tmpl->fetch('templates/index.tmpl.php');
    exit;
  }
}

function check_admin_authorization() {
  global $tmpl;
  
  if(!session::is_admin()) {
    $body = "<center><br><br><br><br><br><h2>Sorry, only admins have access to this function.<br><br><a href=\"javascript:history.back();\">Go Back</a></h2>";
    $tmpl->set('body', $body);
    echo $tmpl->fetch('templates/index.tmpl.php');
    exit;
  }
}

function search_npc_by_id() {
  global $mysql;
  $npcid = $_GET['npcid'];

  $query = "SELECT id,name FROM npc_types WHERE id=\"$npcid\"";
  $results = $mysql->query_mult_assoc($query);
  return $results;
}

function search_npcs() {
  global $mysql;
  $search = $_GET['search'];

  $query = "SELECT id,name FROM npc_types WHERE name rlike \"$search\"";
  $results = $mysql->query_mult_assoc($query);
  return $results;
}

function search_item_by_id() {
  global $mysql;
  $id = $_GET['id'];

  $query = "SELECT id, name FROM items WHERE id=\"$id\"";
  $results = $mysql->query_mult_assoc($query);
  return $results;
}

function search_items() {
  global $mysql;
  $search = $_GET['search'];

  $query = "SELECT id, name FROM items WHERE name rlike \"$search\"";
  $results = $mysql->query_mult_assoc($query);
  return $results;
}

function get_zone_by_npcid($npcid) {
  global $mysql;
  $npczone = substr($npcid, 0, -3);

  $query = "SELECT short_name FROM zone WHERE zoneidnumber=\"$npczone\"";
  $result = $mysql->query_assoc($query);
  return $result['short_name'];
}

function get_zoneid_by_npcid($npcid) {
  global $mysql;
  $npczone = substr($npcid, 0, -3);

  $query = "SELECT id FROM zone WHERE zoneidnumber=\"$npczone\"";
  $result = $mysql->query_assoc($query);
  return $result['id'];
}

function getPlayerName($playerid) {
  global $mysql;
  
  $query = "SELECT name FROM character_ WHERE id=$playerid";
  $result = $mysql->query_assoc($query);
  return $result['name'];
}

function getPlayerID($playername) {
  global $mysql;
  
  $query = "SELECT id FROM character_ WHERE name=\"$playername\"";
  $result = $mysql->query_assoc($query);
  return $result['id'];
}

function search_players() {
  global $mysql;
  $search = $_GET['search'];

  $query = "SELECT id, name FROM character_ WHERE name rlike \"$search\"";
  $results = $mysql->query_mult_assoc($query);
  return $results;
}

function search_players_by_id() {
  global $mysql;
  $playerid = $_GET['playerid'];

  $query = "SELECT id, name FROM character_ WHERE id=\"$playerid\"";
  $results = $mysql->query_mult_assoc($query);
  return $results;
}

function getGuildName($guildid) {
  global $mysql;

  $query = "SELECT name FROM guilds WHERE id = $guildid";
  $result = $mysql->query_assoc($query);
  return $result['name'];
}

function suggest_version() {
  global $mysql, $zoneid;

  $query = "SELECT version from zone where id=$zoneid";
  $result = $mysql->query_assoc($query);
  
  return $result['version'];
}

function search_spell_by_id() {
  global $mysql;
  $id = $_GET['id'];

  $query = "SELECT id, name FROM spells_new WHERE id = \"$id\"";
  $results = $mysql->query_mult_assoc($query);
  return $results;
}

function search_spells_by_name() {
  global $mysql;
  $search = $_GET['search'];

  $query = "SELECT id, name FROM spells_new WHERE name rlike \"$search\"";
  $results = $mysql->query_mult_assoc($query);
  return $results;
}

function getAccountName($acctid) {
  global $mysql;
  
  $query = "SELECT name FROM account WHERE id=$acctid";
  $result = $mysql->query_assoc($query);
  return $result['name'];
}

function search_accounts() {
  global $mysql;
  $search = $_GET['search'];

  $query = "SELECT id, name FROM account WHERE name rlike \"$search\"";
  $results = $mysql->query_mult_assoc($query);
  return $results;
}

function search_accounts_by_id() {
  global $mysql;
  $acctid = $_GET['acctid'];

  $query = "SELECT id, name FROM account WHERE id=\"$acctid\"";
  $results = $mysql->query_mult_assoc($query);
  return $results;
}

function get_real_time($unix_time) {
  global $mysql;

  $query = "SELECT FROM_UNIXTIME($unix_time) AS real_time";
  $result = $mysql->query_assoc($query);

  return($result['real_time']);
}
function search_guilds() {
  global $mysql;
  $search = $_GET['search'];

  $query = "SELECT id, name FROM guilds WHERE name rlike \"$search\"";
  $results = $mysql->query_mult_assoc($query);
  return $results;
}

function search_guilds_by_id() {
  global $mysql;
  $guild_id = $_GET['guild_id'];

  $query = "SELECT id, name FROM guilds WHERE id=\"$guild_id\"";
  $results = $mysql->query_mult_assoc($query);
  return $results;
}

function search_guilds_by_charid() {
  global $mysql;
  $charid = $_GET['charid'];

  $query = "SELECT char_id, guild_id FROM guild_members WHERE char_id=\"$charid\"";
  $results = $mysql->query_mult_assoc($query);
  return $results;
}

function search_guilds_by_charname() {
  global $mysql;
  $charname = $_GET['charname'];

  $query = "SELECT char_id, guild_id FROM guild_members WHERE char_id IN (SELECT id FROM character_ WHERE name RLIKE \"$charname\")";
  $results = $mysql->query_mult_assoc($query);
  return $results;
}
?>