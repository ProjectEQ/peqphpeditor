<?php

$default_datetime = 60 * 60 * 24 * 365; //seconds, minutes, hours, days - Currently set to 1 year
$default_count = 400; //Recipe activity default

switch ($action) {
  case 0:
    check_authorization();
    $body = new Template("templates/util/util.default.tmpl.php");
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
    $characters = get_old_characters($datetime);
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
    $accounts = get_empty_accounts();
    if ($accounts) {
      $body->set('accounts', $accounts);
    }
    break;
  case 4: // Purge Empty Accounts
    check_admin_authorization();
    purge_accounts();
    header("Location: index.php?editor=util&action=3");
    exit;
  case 5: // View Cash on Accounts
    check_admin_authorization();
    $breadcrumbs .= " >> Cash by Account";
    $body = new Template("templates/util/util.acctcash.tmpl.php");
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

function get_old_characters($datetime) {
  global $mysql;

  $query = "SELECT id, account_id, last_login FROM character_data WHERE last_login < (UNIX_TIMESTAMP() - $datetime) ORDER BY last_login, id LIMIT 500";
  $results = $mysql->query_mult_assoc($query);

  return $results;
}

function purge_characters() {
  $characters = $_POST['id'];

  foreach ($characters as $character=>$id) {
    delete_player($id);
  }
}

function get_empty_accounts() {
  global $mysql;

  $query = "SELECT id FROM account WHERE id NOT IN (SELECT account_id FROM character_data GROUP BY account_id) ORDER BY id LIMIT 500";
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
?>