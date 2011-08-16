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
    delete_player($playerid);
    if (isset($_GET['acctid'])) {
      header("Location: index.php?editor=account&acctid=$acctid");
    }
    else {
      header("Location: index.php?editor=player");
    }
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

?>