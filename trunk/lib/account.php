<?php

switch ($action) {
  case 0:  // View Account Details
    check_admin_authorization();
    if ($acctid) {
      $body = new Template("templates/account/account.tmpl.php");
      $body->set('acctid', $acctid);
      $body->set('yesno', $yesno);
      $body->set('acctname', getAccountName($acctid));
      $vars = account_info();
      if ($vars) {
        foreach ($vars as $key=>$value) {
          $body->set($key, $value);
        }
      }
    }
    else {
      $body = new Template("templates/account/account.default.tmpl.php");
    }
    break;
  case 1: // Edit Account Details
    check_admin_authorization();
    $body = new Template("templates/account/account.edit.tmpl.php");
    $body->set('acctid', $acctid);
    $body->set('yesno', $yesno);
    $body->set('acctname', getPlayerName($acctid));
    $vars = account_info();
    if ($vars) {
      foreach ($vars as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
  case 2:  // Search Accounts
    check_admin_authorization();
    $body = new Template("templates/account/account.searchresults.tmpl.php");
    if (isset($_GET['acctid']) && $_GET['acctid'] != "ID") {
      $results = search_accounts_by_id();
    }
    else {
      $results = search_accounts();
    }
    $body->set("results", $results);
    break;
  case 3: // Update Account Details
    check_admin_authorization();
    update_account();
    header("Location: index.php?editor=account&acctid=$acctid");
    exit;
  case 4: // Delete Account
    check_admin_authorization();
    delete_account($acctid);
    header("Location: index.php?editor=account");
    exit;
  case 5: // Character Transfer Selection
    check_admin_authorization();
    $target_accounts = accounts();
    $body = new Template("templates/account/account.chartransfer.tmpl.php");
    $body->set('acctid', $acctid);
    $body->set('acctname', getAccountName($acctid));
    $body->set('target_accounts', $target_accounts);
    break;
  case 6: // Transfer Character
    check_admin_authorization();
    char_transfer();
    header("Location: index.php?editor=account&acctid=$acctid");
    exit;
}

function account_info () {
  global $mysql, $acctid;
  $account_array = array();
  $character_array = array();
  $ip_array = array();
  $char_count = 0;

  //Load from account
  $query = "SELECT * FROM account WHERE id=$acctid";
  $account_array = $mysql->query_assoc($query);

  //Load character names
  $query = "SELECT id, name FROM character_ WHERE account_id = $acctid";
  $character_array = $mysql->query_mult_assoc($query);
  if ($character_array) {
    $account_array['characters'] = $character_array;
  }

  //Load ip info
  $query = "SELECT * FROM account_ip WHERE accid = $acctid";
  $ip_array = $mysql->query_mult_assoc($query);
  if ($ip_array) {
    $account_array['ips'] = $ip_array;
  }

  return $account_array;
}

function update_account () {
  global $mysql, $acctid;

  $oldstats = account_info();
  extract($oldstats);

  $fields = '';
//Set fields here
  $fields =  rtrim($fields, ", ");

  if ($fields != '') {
    $query = "UPDATE account SET $fields WHERE account_id=$acctid";
    $mysql->query_no_result($query);
  }
}

function char_transfer() {
  global $mysql, $acctid;
  $target_acct = $_GET['tacct'];
  $char_id = $_GET['playerid'];

  $query = "UPDATE character_ SET account_id=$target_acct WHERE id=$char_id";
  $mysql->query_no_result($query);
}
?>