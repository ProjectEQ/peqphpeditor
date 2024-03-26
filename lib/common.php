<?php

function getNPCName($npcid) {
  global $mysql_content_db;
  
  $query = "SELECT name FROM npc_types WHERE id=$npcid";
  $result = $mysql_content_db->query_assoc($query);

  if ($result) {
    return $result['name'];
  }
  else {
    return "N/A";
  }
}

function getZoneLongName($short_name, $version=0) {
  global $mysql_content_db;

  $query = "SELECT long_name FROM zone WHERE short_name=\"$short_name\" AND version=$version";
  $result = $mysql_content_db->query_assoc($query);

  if ($result) {
    return $result['long_name'];
  }
  else {
    return "N/A";
  }
}

function getZoneID($short_name) {
  global $mysql_content_db;

  $query = "SELECT zoneidnumber AS id FROM zone WHERE short_name=\"$short_name\"";
  $result = $mysql_content_db->query_assoc($query);

  if ($result) {
    return $result['id'];
  }
  else {
    return null;
  }
}

function getZoneIDByName($short_name) {
  global $mysql_content_db;

  $query = "SELECT id FROM zone WHERE short_name=\"$short_name\"";
  $result = $mysql_content_db->query_assoc($query);

  if ($result) {
    return $result['id'];
  }
  else {
    return 0;
  }
}

function getZoneName($zoneidnumber) {
  global $mysql_content_db;

  $query = "SELECT short_name FROM zone WHERE zoneidnumber=\"$zoneidnumber\"";
  $result = $mysql_content_db->query_assoc($query);

  if ($result) {
    return $result['short_name'];
  }
  else {
    return "N/A";
  }
}

function getZoneVersion($zoneid) {
  global $mysql_content_db;

  $query = "SELECT version FROM zone WHERE id = \"$zoneid\"";
  $result = $mysql_content_db->query_assoc($query);

  if ($result) {
    return $result['version'];
  }
  else {
    return 0;
  }
}

function searchItems($search) {
  global $mysql_content_db;
  
  $query = "SELECT id, name, lore FROM items WHERE name RLIKE \"$search\"";
  $results = $mysql_content_db->query_mult_assoc($query);
  return $results;
}

function get_merchant_id() {
  global $mysql_content_db, $npcid;
  $query = "SELECT merchant_id FROM npc_types WHERE id=$npcid";
  $result = $mysql_content_db->query_assoc($query);
  return $result['merchant_id'];
}

function get_adventure_id() {
  global $mysql_content_db, $npcid;
  $query = "SELECT adventure_template_id AS id FROM npc_types WHERE id=$npcid";
  $result = $mysql_content_db->query_assoc($query);
  return $result['id'];
}

function get_trap_template() {
  global $mysql_content_db, $npcid;
  $query = "SELECT trap_template AS id FROM npc_types WHERE id=$npcid";
  $result = $mysql_content_db->query_assoc($query);
  return $result['id'];
}

function get_item_name($id) {
  global $mysql_content_db;
  $query = "SELECT name FROM items WHERE id=$id";
  $result = $mysql_content_db->query_assoc($query);
  if ($result) {
    return $result['name'];
  }
  else {
    return "Item not in DB";
  }
}

function getFactionName($fid) {
  global $mysql_content_db;
  $query = "SELECT name FROM faction_list WHERE id=$fid";
  $result = $mysql_content_db->query_assoc($query);
  return $result['name'];
}

function get_faction_standing($value) {
  switch ($value){
    case $value >= 1100:
      return "Ally";
    case $value >= 750:
      return "Warmly";
    case $value >= 500:
      return "Kindly";
    case $value >= 100:
      return "Amiable";
    case $value >= 0:
      return "Indifferent";
    case $value >= -100:
      return "Apprehensive";
    case $value >= -500:
      return "Dubious";
    case $value >= -750:
      return "Threatening";
    case $value < -750:
      return "Scowls";
    default:
      return "UNK";
  }
}

function getTaskTitle($tskid) {
  global $mysql_content_db;

  $query = "SELECT title FROM tasks WHERE id=$tskid";
  $result = $mysql_content_db->query_assoc($query);

  if ($result) {
    return $result['title'];
  }
  else {
    return "UNK";
  }
}

function getRecipeName($id) {
  global $mysql_content_db;
  $query = "SELECT name FROM tradeskill_recipe WHERE id=$id";
  $result = $mysql_content_db->query_assoc($query);
  if ($result) {
    return $result['name'];
  }
  else {
    return "Not Found";
  }
}

function getSpellName($id) {
  global $mysql_content_db;
  $query = "SELECT name FROM spells_new WHERE id=$id";
  $result = $mysql_content_db->query_assoc($query);
  if($result)
    return $result['name'];
  else
    return "Not Found";
}

function getSpellsetName($id) {
  global $mysql_content_db;
  $query = "SELECT name FROM npc_spells WHERE id=$id";
  $result = $mysql_content_db->query_assoc($query);
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
  global $mysql_content_db;
  $npcid = $_GET['npc_id'];

  $query = "SELECT id, name FROM npc_types WHERE id=\"$npcid\"";
  $results = $mysql_content_db->query_mult_assoc($query);
  return $results;
}

function search_npcs() {
  global $mysql_content_db;
  $search = $_GET['search'];

  $query = "SELECT id, name FROM npc_types WHERE name RLIKE \"$search\"";
  $results = $mysql_content_db->query_mult_assoc($query);
  return $results;
}

function search_item_by_id() {
  global $mysql_content_db;
  $id = $_GET['id'];

  $query = "SELECT id, name FROM items WHERE id=\"$id\"";
  $results = $mysql_content_db->query_mult_assoc($query);
  return $results;
}

function search_items() {
  global $mysql_content_db;
  $search = $_GET['search'];

  $query = "SELECT id, name FROM items WHERE name RLIKE \"$search\"";
  $results = $mysql_content_db->query_mult_assoc($query);
  return $results;
}

function get_zone_by_npcid($npcid) {
  global $mysql_content_db;
  $npczone = substr($npcid, 0, -3);

  $query = "SELECT short_name FROM zone WHERE zoneidnumber=\"$npczone\"";
  $result = $mysql_content_db->query_assoc($query);

  if ($result) {
    return $result['short_name'];
  }
  else {
    return null;
  }
}

function get_zoneid_by_npcid($npcid) {
  global $mysql_content_db;
  $npczone = substr($npcid, 0, -3);

  $query = "SELECT id FROM zone WHERE zoneidnumber=\"$npczone\"";
  $result = $mysql_content_db->query_assoc($query);

  if ($result) {
    return $result['id'];
  }
  else {
    return null;
  }
}

function get_npcid_by_emoteid($emoteid) {
  global $mysql_content_db;

  $query = "SELECT id FROM npc_types WHERE emoteid=\"$emoteid\" LIMIT 1";
  $result = $mysql_content_db->query_assoc($query);
  return $result['id'];
}

function getPlayerName($playerid) {
  global $mysql;
  
  if ($playerid > 0) {
    $query = "SELECT name FROM character_data WHERE id=$playerid";
    $result = $mysql->query_assoc($query);
    if ($result) {
      return $result['name'];
    }
    else {
      return "N/A";
    }
  }
  else {
    return "N/A";
  }
}

function getPlayerID($playername) {
  global $mysql;
  
  $query = "SELECT id FROM character_data WHERE name=\"$playername\"";
  $result = $mysql->query_assoc($query);

  if ($result) {
    return $result['id'];
  }
  else {
    return null;
  }
}

function search_players_by_name() {
  global $mysql;
  $playername = $_POST['playername'];

  $query = "SELECT id, name FROM character_data WHERE name RLIKE \"$playername\"";
  $results = $mysql->query_mult_assoc($query);
  return $results;
}

function search_players_by_id() {
  global $mysql;
  $playerid = $_POST['playerid'];

  $query = "SELECT id, name FROM character_data WHERE id RLIKE \"$playerid\"";
  $results = $mysql->query_mult_assoc($query);
  return $results;
}

function getGuildName($guildid) {
  global $mysql;

  $query = "SELECT name FROM guilds WHERE id=$guildid";
  $result = $mysql->query_assoc($query);
  return $result['name'];
}

function suggest_version() {
  global $mysql_content_db, $zoneid;

  $query = "SELECT version FROM zone WHERE id=$zoneid";
  $result = $mysql_content_db->query_assoc($query);
  
  return $result['version'];
}

function search_spell_by_id() {
  global $mysql_content_db;
  $id = $_GET['id'];

  $query = "SELECT id, name FROM spells_new WHERE id=\"$id\"";
  $results = $mysql_content_db->query_mult_assoc($query);
  return $results;
}

function search_spells_by_name() {
  global $mysql_content_db;
  $search = $_GET['search'];

  $query = "SELECT id, name FROM spells_new WHERE name RLIKE \"$search\"";
  $results = $mysql_content_db->query_mult_assoc($query);
  return $results;
}

function getAccountName($acctid) {
  global $mysql;
  
  $query = "SELECT name FROM account WHERE id=$acctid";
  $result = $mysql->query_assoc($query);

  if ($result) {
    return $result['name'];
  }
  else {
    return null;
  }
}

function getAccountID($lsname) {
  global $mysql;

  $query = "SELECT id FROM account WHERE name=\"$lsname\"";
  $result = $mysql->query_assoc($query);

  if ($result) {
    return $result['id'];
  }
  else {
    return null;
  }
}

function search_accounts_by_name() {
  global $mysql;
  $search = $_POST['lsaccount_name'];

  $query = "SELECT id, name, lsaccount_id FROM account WHERE name RLIKE \"$search\"";
  $results = $mysql->query_mult_assoc($query);
  return $results;
}

function search_accounts_by_id() {
  global $mysql;
  $lsacctid = $_POST['lsaccount_id'];

  $query = "SELECT id, name, lsaccount_id FROM account WHERE lsaccount_id RLIKE \"$lsacctid\"";
  $results = $mysql->query_mult_assoc($query);
  return $results;
}

function get_real_time($unix_time) {
  global $mysql;

  $query = "SELECT FROM_UNIXTIME($unix_time) AS real_time";
  $result = $mysql->query_assoc($query);

  return($result['real_time']);
}

function get_current_time() {
  global $mysql;

  $query = "SELECT NOW() AS timestamp";
  $result = $mysql->query_assoc($query);

  return($result['timestamp']);
}

function search_guilds() {
  global $mysql;
  $search = $_GET['search'];

  $query = "SELECT id, name FROM guilds WHERE name RLIKE \"$search\"";
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

  $query = "SELECT char_id, guild_id FROM guild_members WHERE char_id IN (SELECT id FROM character_data WHERE name RLIKE \"$charname\")";
  $results = $mysql->query_mult_assoc($query);
  return $results;
}

function search_aas_by_name() {
  global $mysql_content_db;
  $search = $_GET['search'];

  $query = "SELECT id, name, classes, deities FROM aa_ability WHERE name RLIKE \"$search\" ORDER BY name, id, classes, deities";
  $results = $mysql_content_db->query_mult_assoc($query);
  return $results;
}

function search_aas_by_id() {
  global $mysql_content_db;
  $aaid = $_GET['aaid'];

  $query = "SELECT id, name, classes, deities FROM aa_ability WHERE id RLIKE \"$aaid\"";
  $results = $mysql_content_db->query_mult_assoc($query);
  return $results;
}

function getAAName($aaid) {
  global $mysql_content_db;

  $query = "SELECT name FROM aa_ability WHERE id=\"$aaid\"";
  $result = $mysql_content_db->query_assoc($query);
  if ($result)
    return $result['name'];
  else
    return "Not Found";
}

function getPageInfo($table, $is_content_table, $page, $size, $sort, $where = "") {
  global $mysql, $mysql_content_db;
  $stats = array();
  $count = null;

  $query = "SELECT COUNT(*) AS total FROM $table";
  if ($where) {
    $query .= " WHERE $where";
  }
  if ($is_content_table) {
    $count = $mysql_content_db->query_assoc($query);
  }
  else {
    $count = $mysql->query_assoc($query);
  }
  $pages = ceil($count['total'] / $size);
  if ($page > $pages) {
    $page = $pages;
  }
  $stats['count'] = $count['total'];
  $stats['pages'] = $pages;
  $stats['page'] = $page;
  $stats['sort'] = $sort;

  return $stats;
}

function delete_player($playerid) {
  global $mysql;

  $query = "DELETE FROM adventure_members WHERE charid=$playerid";
  $mysql->query_no_result($query);
  $query = "DELETE FROM adventure_stats WHERE player_id=$playerid";
  $mysql->query_no_result($query);
  $query = "DELETE FROM buyer WHERE charid=$playerid";
  $mysql->query_no_result($query);
  $query = "DELETE FROM char_recipe_list WHERE char_id=$playerid";
  $mysql->query_no_result($query);
  $query = "DELETE FROM character_activities WHERE charid=$playerid";
  $mysql->query_no_result($query);
  $query = "DELETE FROM character_alt_currency WHERE char_id=$playerid";
  $mysql->query_no_result($query);
  $query = "DELETE FROM character_alternate_abilities WHERE id=$playerid";
  $mysql->query_no_result($query);
  $query = "DELETE FROM character_auras WHERE id=$playerid";
  $mysql->query_no_result($query);
  $query = "DELETE FROM character_bandolier WHERE id=$playerid";
  $mysql->query_no_result($query);
  $query = "DELETE FROM character_bind WHERE id=$playerid";
  $mysql->query_no_result($query);
  $query = "DELETE FROM character_buffs WHERE character_id=$playerid";
  $mysql->query_no_result($query);
  $query = "DELETE FROM character_corpses WHERE charid=$playerid";
  $mysql->query_no_result($query);
  $query = "DELETE FROM character_currency WHERE id=$playerid";
  $mysql->query_no_result($query);
  $query = "DELETE FROM character_data WHERE id=$playerid";
  $mysql->query_no_result($query);
  //character_disciplines?
  $query = "DELETE FROM character_enabledtasks WHERE charid=$playerid";
  $mysql->query_no_result($query);
  $query = "DELETE FROM character_expedition_lockouts WHERE character_id=$playerid";
  $mysql->query_no_result($query);
  $query = "DELETE FROM character_exp_modifiers WHERE character_id=$playerid";
  $mysql->query_no_result($query);
  $query = "DELETE FROM character_inspect_messages WHERE id=$playerid";
  $mysql->query_no_result($query);
  $query = "DELETE FROM character_instance_safereturns WHERE character_id=$playerid";
  $mysql->query_no_result($query);
  //character_item_recast?
  $query = "DELETE FROM character_languages WHERE id=$playerid";
  $mysql->query_no_result($query);
  $query = "DELETE FROM character_leadership_abilities WHERE id=$playerid";
  $mysql->query_no_result($query);
  //character_material?
  $query = "DELETE FROM character_memmed_spells WHERE id=$playerid";
  $mysql->query_no_result($query);
  $query = "DELETE FROM character_pet_buffs WHERE char_id=$playerid";
  $mysql->query_no_result($query);
  $query = "DELETE FROM character_pet_info WHERE char_id=$playerid";
  $mysql->query_no_result($query);
  $query = "DELETE FROM character_pet_inventory WHERE char_id=$playerid";
  $mysql->query_no_result($query);
  $query = "DELETE FROM character_potionbelt WHERE id=$playerid";
  $mysql->query_no_result($query);
  $query = "DELETE FROM character_skills WHERE id=$playerid";
  $mysql->query_no_result($query);
  $query = "DELETE FROM character_spells WHERE id=$playerid";
  $mysql->query_no_result($query);
  $query = "DELETE FROM character_task_timers WHERE character_id=$playerid";
  $mysql->query_no_result($query);
  $query = "DELETE FROM character_tasks WHERE charid=$playerid";
  $mysql->query_no_result($query);
  $query = "DELETE FROM character_tribute WHERE id=$playerid";
  $mysql->query_no_result($query);
  $query = "DELETE FROM completed_tasks WHERE charid=$playerid";
  $mysql->query_no_result($query);
  //data_buckets?
  $query = "DELETE FROM discovered_items WHERE char_name=\"(SELECT name FROM character_data WHERE id=$playerid)\"";
  $mysql->query_no_result($query);
  $query = "DELETE FROM faction_values WHERE char_id=$playerid";
  $mysql->query_no_result($query);
  $query = "DELETE FROM friends WHERE charid=$playerid";
  $mysql->query_no_result($query);
  $query = "DELETE FROM group_id WHERE character_id=$playerid";
  $mysql->query_no_result($query);
  $query = "DELETE FROM guild_members WHERE char_id=$playerid";
  $mysql->query_no_result($query);
  $query = "DELETE FROM instance_list_player WHERE charid=$playerid";
  $mysql->query_no_result($query);
  $query = "DELETE FROM inventory WHERE charid=$playerid";
  $mysql->query_no_result($query);
  $query = "DELETE FROM inventory_snapshots WHERE charid=$playerid";
  $mysql->query_no_result($query);
  $query = "DELETE FROM keyring WHERE char_id=$playerid";
  $mysql->query_no_result($query);
  $query = "DELETE FROM mail WHERE charid=$playerid";
  $mysql->query_no_result($query);
  //mercs?
  //petitions?
  $query = "DELETE FROM player_titlesets WHERE char_id=$playerid";
  $mysql->query_no_result($query);
  $query = "DELETE FROM quest_globals WHERE charid=$playerid";
  $mysql->query_no_result($query);
  $query = "DELETE FROM raid_members WHERE charid=$playerid";
  $mysql->query_no_result($query);
  //reports?
  $query = "DELETE FROM timers WHERE char_id=$playerid";
  $mysql->query_no_result($query);
  $query = "DELETE FROM titles WHERE char_id=$playerid";
  $mysql->query_no_result($query);
  $query = "DELETE FROM trader WHERE char_id=$playerid";
  $mysql->query_no_result($query);
  //trader_audit?
  $query = "DELETE FROM zone_flags WHERE charID=$playerid";
  $mysql->query_no_result($query);
}

function delete_account($acctid) {
  global $mysql;

  $query = "DELETE FROM account WHERE id=$acctid";
  $mysql->query_no_result($query);
  $query = "DELETE FROM account_ip WHERE accid=$acctid";
  $mysql->query_no_result($query);
  $query = "DELETE FROM account_rewards WHERE account_id=$acctid";
  $mysql->query_no_result($query);
  $query = "DELETE FROM gm_ips WHERE account_id=$acctid";
  $mysql->query_no_result($query);
  $query = "DELETE FROM sharedbank WHERE acctid=$acctid";
  $mysql->query_no_result($query);
}

function get_currency_name($curr_id) {
  global $mysql_content_db;

  $query = "SELECT a.item_id AS id, i.name AS `name` FROM alternate_currency a, items i WHERE a.item_id=i.id AND a.id=$curr_id LIMIT 1";
  $result = $mysql_content_db->query_assoc($query);

  if ($result) {
    return $result['name'];
  }
  else {
    return "Item not in DB";
  }
}

function factions_array() {
  global $mysql_content_db;

  $query = "SELECT id, name FROM faction_list ORDER BY name";
  $results = $mysql_content_db->query_mult_assoc($query);

  $arr[] = array("id"=>0, "name"=>"None");
  $array = $arr+$results;

  return $array;
}

function html_replace($text) {
  $rtext = str_replace("<", "&lt;", $text);

  return $rtext;
}

function item_isNoRent($item_id) {
  global $mysql_content_db;

  $query = "SELECT norent FROM items WHERE id=$item_id";
  $result = $mysql_content_db->query_assoc($query);

  if ($result['norent'] == 0) {
    return true;
  }
  else {
    return false;
  }
}

function getClasses($classes) {
  if ($classes == 0) {
    return "None";
  }
  elseif ($classes == 65535) 
    return "ALL";
  else {
    $result = '';
    if ($classes & 32768) $result .= "BER ";
    if ($classes &   128) $result .= "BRD ";
    if ($classes & 16384) $result .= "BST ";
    if ($classes &     2) $result .= "CLR ";
    if ($classes &    32) $result .= "DRU ";
    if ($classes &  8192) $result .= "ENC ";
    if ($classes &  4096) $result .= "MAG ";
    if ($classes &    64) $result .= "MNK ";
    if ($classes &  1024) $result .= "NEC ";
    if ($classes &     4) $result .= "PAL ";
    if ($classes &     8) $result .= "RNG ";
    if ($classes &   256) $result .= "ROG ";
    if ($classes &    16) $result .= "SHD ";
    if ($classes &   512) $result .= "SHM ";
    if ($classes &     1) $result .= "WAR ";
    if ($classes &  2048) $result .= "WIZ ";
    $result = rtrim($result, " ");
    return $result;
  }
}

function getRaces($races) {
  if ($races == 0) {
    return "None";
  }
  elseif ($races == 65535) 
    return "ALL";
  else {
    $result = '';
    if ($races &     2) $result .= "BAR ";
    if ($races &    32) $result .= "DEF ";
    if ($races & 32768) $result .= "DRK ";
    if ($races &   128) $result .= "DWF ";
    if ($races &     8) $result .= "ELF ";
    if ($races &     4) $result .= "ERU ";
    if ($races &  4096) $result .= "FRG ";
    if ($races &  2048) $result .= "GNM ";
    if ($races &    64) $result .= "HEF ";
    if ($races &  1024) $result .= "HFL ";
    if ($races &    16) $result .= "HIE ";
    if ($races &     1) $result .= "HUM ";
    if ($races &  8192) $result .= "IKS ";
    if ($races &   512) $result .= "OGR ";
    if ($races &   256) $result .= "TRL ";
    if ($races & 16384) $result .= "VAH ";
    $result = rtrim($result, " ");
    return $result;
  }
}

function getDeities($deities) {
  if ($deities == 0) {
    return "None";
  }
  elseif ($deities == 131071) 
    return "ALL";
  else {
    $result = '';
    if ($deities & 65536) $result .= "Agnostic ";
    if ($deities &     1) $result .= "Bertoxxulous ";
    if ($deities &     2) $result .= "Brell Serilis ";
    if ($deities &    16) $result .= "Bristlebane ";
    if ($deities &     4) $result .= "Cazic-Thule ";
    if ($deities &     8) $result .= "Erollisi Marr ";
    if ($deities &    32) $result .= "Innoruuk ";
    if ($deities &    64) $result .= "Karana ";
    if ($deities &   128) $result .= "Mithaniel Marr ";
    if ($deities &   256) $result .= "Prexus ";
    if ($deities &   512) $result .= "Quellious ";
    if ($deities &  1024) $result .= "Rallos Zek ";
    if ($deities &  2048) $result .= "Rodcet Nife ";
    if ($deities &  4096) $result .= "Solusek Ro ";
    if ($deities &  8192) $result .= "The Tribunal ";
    if ($deities & 16384) $result .= "Tunare ";
    if ($deities & 32768) $result .= "Veeshan ";
    $result = rtrim($result, " ");
    return $result;
  }
}

function isGlobalLoot($loottable_id) {
  global $mysql_content_db;

  $query = "SELECT id FROM global_loot WHERE loottable_id=$loottable_id LIMIT 1";
  $result = $mysql_content_db->query_assoc($query);

  if ($result && $result['id'] > 0) {
    return true;
  }
  else {
    return false;
  }
}

function isValidLoot($loottable_id) {
  global $mysql_content_db;

  $query = "SELECT id FROM loottable WHERE id=$loottable_id LIMIT 1";
  $result = $mysql_content_db->query_assoc($query);

  if ($result && $result['id'] > 0) {
    return true;
  }
  else {
    return false;
  }
}

function get_tribute_name($id) {
  global $mysql_content_db;

  $query = "SELECT `name` FROM tributes WHERE id=$id";
  $result = $mysql_content_db->query_assoc($query);

  if ($result) {
    return $result['name'];
  }
  else {
    return null;
  }
}

function get_tribute_cost_by_tier($id, $tier) {
  global $mysql_content_db;

  $query = "SELECT cost FROM tribute_levels WHERE tribute_id=$id ORDER BY level, cost";
  $result = $mysql_content_db->query_mult_assoc($query);

  if ($result) {
    return $result[$tier]['cost'];
  }
  else {
    return null;
  }
}

?>
