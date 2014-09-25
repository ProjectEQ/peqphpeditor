<?php

//require ("player_profile.php");

$default_page = 1;
$default_size = 200;
$default_sort = 1;

$columns = array(
  1 => 'id',
  2 => 'name',
  3 => 'account_id',
  4 => 'class',
  5 => 'level'
);

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
      $curr_page = (isset($_GET['page'])) ? $_GET['page'] : $default_page;
      $curr_size = (isset($_GET['size'])) ? $_GET['size'] : $default_size;
      $curr_sort = (isset($_GET['sort'])) ? $columns[$_GET['sort']] : $columns[$default_sort];
      $body = new Template("templates/player/player.default.tmpl.php");
      $page_stats = getPageInfo("character_", $curr_page, $curr_size, $_GET['sort']);
      if ($page_stats['page']) {
        $players = get_players($page_stats['page'], $curr_size, $curr_sort);
      }
      if ($players) {
        $body->set('players', $players);
        $body->set('classes', $classes);
        foreach ($page_stats as $key=>$value) {
          $body->set($key, $value);
        }
      }
      else {
        $body->set('page', 0);
        $body->set('pages', 0);
      }
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
    if (isset($_POST['playerid']) && $_POST['playerid'] != "Player ID") {
      $results = search_players_by_id();
    }
    else {
      $results = search_players_by_name();
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
  case 5: // View Raw Profile
    check_admin_authorization();
    $breadcrumbs .= " >> Raw Profile";
    $profile = get_rawprofile();
    $body = new Template("templates/player/player.rawprofile.tmpl.php");
    $body->set('profile', $profile);
    $body->set('playerid', $playerid);
    break;
}

function get_players($page_number, $results_per_page, $sort_by) {
  global $mysql;
  $limit = ($page_number - 1) * $results_per_page . "," . $results_per_page;

  $query = "SELECT id, account_id, name, level, class FROM character_data ORDER BY $sort_by LIMIT $limit";
  $results = $mysql->query_mult_assoc($query);

  return $results;
}

function player_info () {
  global $mysql, $playerid;
  $player_array = array();

  //Load from character_
  $query = "SELECT id, account_id, timelaston, zonename, groupid, lfp, lfg, inspectmessage FROM character_data WHERE id=$playerid";
  $player_array = $mysql->query_assoc($query);

  //Load account details
  $accountid = $player_array['account_id'];
  $query = "SELECT name, lsaccount_id, status FROM account WHERE id = $accountid";
  $result = $mysql->query_assoc($query);
  $player_array['lsname'] = $result['name'];
  $player_array['lsaccount'] = $result['lsaccount_id'];
  $player_array['status'] = $result['status'];

  //Set player profile variables
  //$rawprofile = get_rawprofile();
  //$player_array += $rawprofile;

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
    $query = "UPDATE character_data SET $fields WHERE id=$playerid";
    $mysql->query_no_result($query);
  }
}
/*
function get_rawprofile () {
  global $mysql, $playerid;

  $query = "SELECT profile FROM character_ WHERE id=$playerid";
  $result = $mysql->query_assoc($query);

  $rawprofile = unpack(getPPFormat(), $result['profile']);

  return $rawprofile;
}
*/
?>