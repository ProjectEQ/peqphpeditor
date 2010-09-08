<?php

require ("player_profile.php");

switch ($action) {
  case 0:  // View Player Profile
    check_admin_authorization();
    if ($playerid) {
      $body = new Template("templates/player/player.tmpl.php");
      $body->set('playerid', $playerid);
      $body->set('classes', $classes);
      $body->set('genders', $genders);
      $body->set('bodytypes', $bodytypes);
      $body->set('races', $races);
      $body->set('yesno', $yesno);
      $body->set('skilltypes', $skilltypes);
      $body->set('player_name', getPlayerName($playerid));
      $body->set('deities', $deities);
      $body->set('anonymity', $anonymity);
      $vars = player_info();
      if ($vars) {
        foreach ($vars as $key=>$value) {
          $body->set($key, $value);
        }
      }
    }
    else {
      $body = new Template("templates/player/player.default.tmpl.php");
    }
    break;
  case 1: // Edit Player Profile
    check_admin_authorization();
    $body = new Template("templates/player/player.edit.tmpl.php");
    $body->set('playerid', $playerid);
    $body->set('classes', $classes);
    $body->set('genders', $genders);
    $body->set('bodytypes', $bodytypes);
    $body->set('races', $races);
    $body->set('yesno', $yesno);
    $body->set('skilltypes', $skilltypes);
    $body->set('player_name', getPlayerName($playerid));
    $vars = player_info();
    if ($vars) {
      foreach ($vars as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
  case 2:  // Search Players
    check_admin_authorization();
    $body = new Template("templates/player/player.searchresults.tmpl.php");
    if (isset($_GET['playerid']) && $_GET['playerid'] != "ID") {
      $results = search_players_by_id();
    }
    else {
      $results = search_players();
    }
    $body->set("results", $results);
    break;
  case 3: // Update Player Profile
    check_admin_authorization();
    update_player();
    header("Location: index.php?editor=player&playerid=$playerid");
    exit;
  case 4: // Delete Player
    check_admin_authorization();
    delete_player();
    header("Location: index.php?editor=player");
    exit;
}

function player_info () {
  global $mysql, $playerid;
  $player_array = array();

  //Load from character_
  $query = "SELECT id,account_id,timelaston,zonename,groupid,lfp,lfg FROM character_ WHERE id=$playerid";
  $player_array = $mysql->query_assoc($query);
  $query = "SELECT profile FROM character_ WHERE id=$playerid";
  $result = $mysql->query_assoc($query);
  $profblob = $result['profile'];

  //Load account details
  $accountid = $player_array['account_id'];
  $query = "SELECT name, lsaccount_id, status FROM account WHERE id = $accountid";
  $result = $mysql->query_assoc($query);
  $player_array['lsname'] = $result['name'];
  $player_array['lsaccount'] = $result['lsaccount_id'];
  $player_array['status'] = $result['status'];

  //Set player profile variables
  $rawprofile = unpack(getPPFormat(), $profblob);
  $player_array += $rawprofile;

  return $player_array;
}

function update_player () {
  global $mysql, $playerid;

  $oldstats = player_info();
  extract($oldstats);

  $fields = '';
//Set fields here
  $fields =  rtrim($fields, ", ");

  if ($fields != '') {
    $query = "UPDATE character_ SET $fields WHERE id=$playerid";
    $mysql->query_no_result($query);
  }
}

function delete_player () {
  global $mysql, $playerid;

  $query = "DELETE FROM adventure_members WHERE charid=$playerid";
  $mysql->query_no_result($query);
  $query = "DELETE FROM adventure_stats WHERE player_id=$playerid";
  $mysql->query_no_result($query);
  $query = "DELETE FROM buyer WHERE charid=$playerid";
  $mysql->query_no_result($query);
  $query = "DELETE FROM character_ WHERE id=$playerid";
  $mysql->query_no_result($query);
  $query = "DELETE FROM character_activities WHERE charid=$playerid";
  $mysql->query_no_result($query);
  $query = "DELETE FROM character_backup WHERE charid=$playerid";
  $mysql->query_no_result($query);
  $query = "DELETE FROM character_enabledtasks WHERE charid=$playerid";
  $mysql->query_no_result($query);
  $query = "DELETE FROM character_tasks WHERE charid=$playerid";
  $mysql->query_no_result($query);
  $query = "DELETE FROM char_recipe_list WHERE char_id=$playerid";
  $mysql->query_no_result($query);
  $query = "DELETE FROM completed_tasks WHERE charid=$playerid";
  $mysql->query_no_result($query);
  $query = "DELETE FROM faction_values WHERE char_id=$playerid";
  $mysql->query_no_result($query);
  $query = "DELETE FROM friends WHERE charid=$playerid";
  $mysql->query_no_result($query);
  $query = "DELETE FROM group_id WHERE charid=$playerid";
  $mysql->query_no_result($query);
  $query = "DELETE FROM guild_members WHERE char_id=$playerid";
  $mysql->query_no_result($query);
  $query = "DELETE FROM instance_lockout_player WHERE charid=$playerid";
  $mysql->query_no_result($query);
  $query = "DELETE FROM inventory WHERE charid=$playerid";
  $mysql->query_no_result($query);
  $query = "DELETE FROM keyring WHERE char_id=$playerid";
  $mysql->query_no_result($query);
  $query = "DELETE FROM mail WHERE charid=$playerid";
  $mysql->query_no_result($query);
  //petitions?
  $query = "DELETE FROM player_corpses WHERE charid=$playerid";
  $mysql->query_no_result($query);
  $query = "DELETE FROM player_corpses_backup WHERE charid=$playerid";
  $mysql->query_no_result($query);
  $query = "DELETE FROM player_titlesets WHERE char_id=$playerid";
  $mysql->query_no_result($query);
  $query = "DELETE FROM quest_globals WHERE charid=$playerid";
  $mysql->query_no_result($query);
  $query = "DELETE FROM raid_members WHERE charid=$playerid";
  $mysql->query_no_result($query);
  //reports?
  $query = "DELETE FROM timers WHERE char_id=$playerid";
  $mysql->query_no_result($query);
  $query = "DELETE FROM trader WHERE char_id=$playerid";
  $mysql->query_no_result($query);
  $query = "DELETE FROM zone_flags WHERE charid=$playerid";
  $mysql->query_no_result($query);
}
?>