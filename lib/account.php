<?php
$default_page = 1;
$default_size = 200;
$default_sort = 1;

$columns = array(
  1 => 'id',
  2 => 'lsaccount_id',
  3 => 'name',
  4 => 'status'
);

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
      $curr_page = (isset($_GET['page'])) ? $_GET['page'] : $default_page;
      $curr_size = (isset($_GET['size'])) ? $_GET['size'] : $default_size;
      $curr_sort = (isset($_GET['sort'])) ? $columns[$_GET['sort']] : $columns[$default_sort];
      $body = new Template("templates/account/account.default.tmpl.php");
      $page_stats = getPageInfo("account", FALSE, $curr_page, $curr_size, ((isset($_GET['sort'])) ? $_GET['sort'] : null));
      if ($page_stats['page']) {
        $accounts = get_accounts($page_stats['page'], $curr_size, $curr_sort);
      }
      if (isset($accounts)) {
        $body->set('accounts', $accounts);
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
    if (isset($_POST['lsaccount_id']) && $_POST['lsaccount_id'] != "LS Acct ID") {
      $results = search_accounts_by_id();
    }
    else {
      $results = search_accounts_by_name();
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
    $body = new Template("templates/account/account.chartransfer.tmpl.php");
    $javascript = new Template("templates/account/js.tmpl.php");
    $body->set('acctid', $acctid);
    $body->set('acctname', getAccountName($acctid));
    $body->set('target_accounts', $target_accounts);
    break;
  case 6: // Transfer Character
    check_admin_authorization();
    char_transfer();
    header("Location: index.php?editor=account&acctid=$acctid");
    exit;
  case 7: // Edit Account Status
    check_admin_authorization();
    $cur_acct_status = get_account_status();
    $body = new Template("templates/account/account.status.tmpl.php");
    $body->set('acctid', $acctid);
    $body->set('cur_acct_status', $cur_acct_status);
    break;
  case 8: // Update Account Status
    check_admin_authorization();
    update_account_status();
    header("Location: index.php?editor=account&acctid=$acctid");
    exit;
  case 9: // Search Accounts by IP Address
    check_admin_authorization();
    $accounts = get_accounts_by_ip();
    $body = new Template("templates/account/accounts.by.ip.tmpl.php");
    $body->set('ip', $_GET['ip']);
    if ($accounts) {
      $body->set('accounts', $accounts);
    }
    break;
}

function get_accounts($page_number, $results_per_page, $sort_by) {
  global $mysql;
  $limit = ($page_number - 1) * $results_per_page . "," . $results_per_page;

  $query = "SELECT id, name, lsaccount_id, status FROM account ORDER BY $sort_by LIMIT $limit";
  $results = $mysql->query_mult_assoc($query);

  return $results;
}

function account_info() {
  global $mysql, $acctid;
  $account_array = array();
  $character_array = array();
  $ip_array = array();
  $char_count = 0;

  //Load from account
  $query = "SELECT * FROM account WHERE id=$acctid";
  $account_array = $mysql->query_assoc($query);

  //Load character names
  $query = "SELECT id, name FROM character_data WHERE account_id = $acctid";
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

function update_account() {
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
  $target_acct = getAccountID($_POST['tacct']);
  $char_id = $_GET['playerid'];

  $query = "UPDATE character_data SET account_id=$target_acct WHERE id=$char_id";
  $mysql->query_no_result($query);
}

function get_account_status() {
  global $mysql, $acctid;

  $query = "SELECT status FROM account WHERE id=$acctid";
  $result = $mysql->query_assoc($query);

  return $result['status'];
}

function update_account_status() {
  global $mysql, $acctid;
  $new_status = $_POST['new_acct_status'];

  $query = "UPDATE account SET status=$new_status WHERE id=$acctid";
  $mysql->query_no_result($query);
}

function get_accounts_by_ip() {
  global $mysql;
  $ip = $_GET['ip'];

  $query = "SELECT accid, count, lastused, name FROM account_ip LEFT JOIN account ON account_ip.accid = account.id WHERE ip = \"$ip\"";
  $results = $mysql->query_mult_assoc($query);

  if ($results) {
    return $results;
  }
  else {
    return null;
  }
}
?>