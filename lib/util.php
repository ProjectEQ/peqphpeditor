<?php

$default_datetime = 60 * 60 * 24 * 365; //seconds, minutes, hours, days - Currently set to 1 year
$default_count = 400; //Recipe activity default
$default_player_count = 20; //Economy player count default
$default_account_count = 20; //Economy account count default
$default_purge_count = 100; //Purge count default

switch ($action) {
  case 0:
    check_authorization();
    $body = new Template("templates/util/util.default.tmpl.php");
    $accounts = get_total_accounts();
    $body->set('accounts', $accounts);
    break;
  case 1: // View Old Characters
    check_admin_authorization();
    $breadcrumbs .= " >> Character Purge";
    $javascript = new Template("templates/util/js.tmpl.php");
    $body = new Template("templates/util/util.charpurge.tmpl.php");
    $datetime = $default_datetime;
    if (isset($_GET['datetime'])) {
      $datetime = $_GET['datetime'];
    }
    $body->set('datetime', $datetime);
    $purge_count = $default_purge_count;
    $body->set('purge_count', $purge_count);
    $characters = get_old_characters($datetime, $purge_count);
    if ($characters) {
      $body->set('characters', $characters);
    }
    break;
  case 2: // Purge Old Characters
    check_admin_authorization();
    purge_characters();
    header("Location: index.php?editor=util&action=1");
    exit;
  case 3: // View Empty Accounts
    check_admin_authorization();
    $breadcrumbs .= " >> Account Purge";
    $javascript = new Template("templates/util/js.tmpl.php");
    $body = new Template("templates/util/util.acctpurge.tmpl.php");
    $purge_count = $default_purge_count;
    $body->set('purge_count', $purge_count);
    $accounts = get_empty_accounts($purge_count);
    if ($accounts) {
      $body->set('accounts', $accounts);
    }
    break;
  case 4: // Purge Empty Accounts
    check_admin_authorization();
    purge_accounts();
    header("Location: index.php?editor=util&action=3");
    exit;
  case 5: // View Server Economy
    check_admin_authorization();
    $breadcrumbs .= " >> Server Economy";
    $javascript = new Template("templates/util/js.tmpl.php");
    $body = new Template("templates/util/util.economy.tmpl.php");

    $cash = get_cash_totals();
    if ($cash) {
      $body->set('cash', $cash);
    }

    $player_count = $default_player_count;
    if ($_GET['player_count'] > 0) {
      $player_count = $_GET['player_count'];
    }
    $body->set('player_count', $player_count);

    $account_count = $default_account_count;
    if ($_GET['account_count'] > 0) {
      $account_count = $_GET['account_count'];
    }
    $body->set('account_count', $account_count);

    $richest = get_richest_players($player_count, $account_count);
    if ($richest) {
      $body->set('richest', $richest);
    }

    break;
  case 6: // View Recipe Activity
    check_authorization();
    $breadcrumbs .= " >> Recipe Activity";
    $javascript = new Template("templates/util/js.tmpl.php");
    $body = new Template("templates/util/util.recipes.tmpl.php");
    $count = $default_count;
    if ($_GET['count'] > 0) {
      $count = $_GET['count'];
    }
    $body->set('count', $count);
    $recipes = get_recipe_activity($count);
    if ($recipes) {
      $body->set('recipes', $recipes);
    }
    break;
}

function get_old_characters($datetime, $purge_count) {
  global $mysql;

  $query = "SELECT id, account_id, last_login FROM character_data WHERE last_login < (UNIX_TIMESTAMP() - $datetime) ORDER BY last_login, id LIMIT $purge_count";
  $results = $mysql->query_mult_assoc($query);

  return $results;
}

function purge_characters() {
  $characters = $_POST['id'];

  foreach ($characters as $character=>$id) {
    delete_player($id);
  }
}

function get_empty_accounts($purge_count) {
  global $mysql;

  $query = "SELECT id FROM account WHERE id NOT IN (SELECT account_id FROM character_data GROUP BY account_id) ORDER BY id LIMIT $purge_count";
  $results = $mysql->query_mult_assoc($query);

  return $results;
}

function purge_accounts() {
  $accounts = $_POST['id'];

  foreach ($accounts as $account=>$id) {
    delete_account($id);
  }
}

function get_recipe_activity($count) {
  global $mysql;

  $query = "SELECT * FROM char_recipe_list WHERE madecount >= $count ORDER BY madecount DESC, recipe_id, char_id";
  $results = $mysql->query_mult_assoc($query);

  return $results;
}

function get_cash_totals() {
  global $mysql;

  $query = "SELECT SUM(copper + copper_bank +copper_cursor) AS copper FROM character_currency";
  $result = $mysql->query_assoc($query);
  $copper = $result['copper'];

  $query = "SELECT SUM(silver + silver_bank + silver_cursor) AS silver FROM character_currency";
  $result = $mysql->query_assoc($query);
  $silver = $result['silver'];

  $query = "SELECT SUM(gold + gold_bank + gold_cursor) AS gold FROM character_currency";
  $result = $mysql->query_assoc($query);
  $gold = $result['gold'];

  $query = "SELECT SUM(platinum + platinum_bank + platinum_cursor) AS platinum FROM character_currency";
  $result = $mysql->query_assoc($query);
  $platinum = $result['platinum'];

  $query = "SELECT SUM(sharedplat) AS sharedplat FROM account";
  $result = $mysql->query_assoc($query);
  $sharedplat = $result['sharedplat'];

  $cash = array("copper" => $copper, "silver" => $silver, "gold" => $gold, "platinum" => $platinum, "sharedplat" => $sharedplat);

  return $cash;
}

function get_richest_players($player_count, $account_count) {
  global $mysql;

  $query = "SELECT d.id AS id, SUM(platinum + platinum_bank + platinum_cursor) AS platinum, d.account_id as account_id, sharedplat FROM character_currency AS c JOIN character_data AS d ON c.id = d.id JOIN account AS a ON d.account_id = a.id GROUP BY d.id ORDER BY platinum DESC LIMIT $player_count";
  $players = $mysql->query_mult_assoc($query);

  $query = "SELECT a.id AS id, sharedplat, SUM(platinum + platinum_bank + platinum_cursor) AS platinum FROM character_currency AS c JOIN character_data AS d ON c.id = d.id JOIN account AS a ON d.account_id = a.id GROUP BY a.id ORDER BY sharedplat DESC LIMIT $account_count";
  $accounts = $mysql->query_mult_assoc($query);

  $richest = array("players" => $players, "accounts" => $accounts);

  return $richest;
}

function get_total_accounts() {
  global $mysql;

  $query = "SELECT COUNT(id) AS total FROM account";
  $result = $mysql->query_assoc($query);

  return $result['total'];
}

?>