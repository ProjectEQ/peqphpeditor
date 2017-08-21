<?
$default_size = 300;

switch($action) {
  case 0: //Default
    $body = new Template("templates/pvp/pvp.default.tmpl.php");
    break;
  case 1: //Leaderboard
    $body = new Template("templates/pvp/pvp.leaderboard.tmpl.php");
    $breadcrumbs .= " >> Leaderboard";
    $curr_size = (isset($_GET['size'])) ? $_GET['size'] : $default_size;
    $pvp_stats = getPVPStats($curr_size);
    if ($pvp_stats) {
      $body->set("pvp_stats", $pvp_stats);
    }
    break;
  case 2: //Player PVP
    $body = new Template("templates/pvp/pvp.player.tmpl.php");
    $breadcrumbs .= " >> Player PVP";
    $playerPVP = getPlayerPVP($_GET['playerid']);
    if ($playerPVP) {
      $body->set("playerPVP", $playerPVP);
    }
    break;
  case 3: //Edit PVP Points
    check_authorization();
    $body = new Template("templates/pvp/pvp.edit.tmpl.php");
    $breadcrumbs .= " >> Edit Points";
    $points = getPVP();
    $body->set("points", $points);
    $body->set("player", $_GET['playerid']);
    break;
  case 4: //Update PVP Points
    check_authorization();
    updatePVP();
    $id = $_POST['playerid'];
    header("Location: index.php?editor=pvp&playerid=$playerid&action=2");
    exit;
  case 5: //Search for Character
    $body = new Template("templates/pvp/pvp.searchresults.tmpl.php");
    $breadcrumbs .= " >> Search Results";
    if (isset($_GET['name']) && $_GET['name'] != "Player Name") {
      $results = searchByName();
    }
    elseif (isset($_GET['playerid']) && $_GET['playerid'] != "Player ID") {
      $results = searchByID();
    }
    if ($results) {
      $body->set("results", $results);
    }
    break;
}

function getPVPStats($size) {
  global $mysql;

  $query = "SELECT id, pvp_kills, pvp_deaths, pvp_current_points, pvp_career_points, pvp_best_kill_streak, pvp_worst_death_streak, pvp_current_kill_streak FROM character_data ORDER BY pvp_current_points DESC LIMIT $size";
  $results = $mysql->query_mult_assoc($query);

  if ($results) {
    return $results;
  }
  else {
    return null;
  }
}

function getPlayerPVP($id) {
  global $mysql;

  $query = "SELECT id, pvp_kills, pvp_deaths, pvp_current_points, pvp_career_points, pvp_best_kill_streak, pvp_worst_death_streak, pvp_current_kill_streak FROM character_data WHERE id=$id";
  $results = $mysql->query_assoc($query);

  if ($results) {
    return $results;
  }
  else {
    return null;
  }
}

function getPVP() {
  global $mysql;
  $player = $_GET['playerid'];

  $query = "SELECT pvp_current_points FROM character_data WHERE id=$player";
  $result = $mysql->query_assoc($query);

  return $result['pvp_current_points'];
}

function updatePVP() {
  global $mysql;
  $player = $_POST['playerid'];
  $points = $_POST['points'];

  $query = "UPDATE character_data SET pvp_current_points=$points WHERE id=$player";
  $mysql->query_no_result($query);
}

function searchByName() {
  global $mysql;
  $search = $_GET['name'];

  $query = "SELECT id, name FROM character_data WHERE name RLIKE \"$search\" ORDER BY name";
  $results = $mysql->query_mult_assoc($query);

  if ($results) {
    return $results;
  }
  else {
    return null;
  }
}

function searchByID() {
  global $mysql;
  $search = $_GET['playerid'];

  $query = "SELECT id, name FROM character_data WHERE id=$search";
  $results = $mysql->query_mult_assoc($query);

  if ($results) {
    return $results;
  }
  else {
    return null;
  }
}

?>