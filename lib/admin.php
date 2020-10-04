<?php
switch ($action) {
  case 0: // Default View
    if (session::is_admin()) {
      $body = new Template("templates/admin/admin.tmpl.php");
      $users = list_users();
      if ($users) {
        $body->set('users', $users);
      }
      $ips = get_ips();
      if ($ips) {
        $body->set('ips', $ips);
      }
    }
    else {
      header('Location: index.php');
      exit;
    }
    break;
  case 1: // Edit User
    if (session::is_admin()) {
      $body = new Template("templates/admin/admin.user.edit.tmpl.php");
      $user = user_info();
      $body->set('user', $user);
    }
    else {
      header('Location: index.php');
      exit;
    }
    break;
  case 2: // Update User
    if (session::is_admin()) {
      update_user();
      header('Location: index.php?admin');
    }
    else {
      header('Location: index.php');
      exit;
    }
    exit;
  case 3: // Delete User
    if (session::is_admin()) {
      delete_user();
      header('Location: index.php?admin');
    }
    else {
      header('Location: index.php');
      exit;
    }
    exit;
  case 4: // Add User
    if (session::is_admin()) {
      $body = new Template("templates/admin/admin.user.add.tmpl.php");
    }
    else {
      header('Location: index.php');
      exit;
    }
    break;
  case 5: // Insert User
    if (session::is_admin()) {
      insert_user();
      header('Location: index.php?admin');
    }
    else {
      header('Location: index.php');
      exit;
    }
    exit;
  case 6: // Add IP
    if (session::is_admin()) {
      $body = new Template("templates/admin/admin.ip.add.tmpl.php");
      $javascript = new Template("templates/admin/js.tmpl.php");
    }
    else {
      header('Location: index.php');
      exit;
    }
    break;
  case 7: // Insert IP
    if (session::is_admin()) {
      insert_ip();
      header('Location: index.php?admin');
    }
    else {
      header('Location: index.php');
      exit;
    }
    exit;
  case 8: // Edit IP
    if (session::is_admin()) {
      $body = new Template("templates/admin/admin.ip.edit.tmpl.php");
      $javascript = new Template("templates/admin/js.tmpl.php");
      $ip = ip_info();
      if ($ip) {
        $body->set('ip', $ip);
      }
    }
    else {
      header('Location: index.php');
      exit;
    }
    break;
  case 9: // Update IP
    if (session::is_admin()) {
      update_ip();
      header('Location: index.php?admin');
    }
    else {
      header('Location: index.php');
      exit;
    }
    exit;
  case 10: // Delete IP
    if (session::is_admin()) {
      delete_ip();
      header('Location: index.php?admin');
    }
    else {
      header('Location: index.php');
      exit;
    }
    exit;
}

$tmpl->set('body', $body);
$tmpl->set('javascript', $javascript);
$tmpl->set('headbar', $headbar);

echo $tmpl->fetch('templates/index.tmpl.php');
exit;

function list_users() {
  global $mysql;
  
  $query = "SELECT * FROM peq_admin";
  $results = $mysql->query_mult_assoc($query);

  if ($results) {
    return $results;
  }
  else {
    return null;
  }
}

function user_info() {
  global $mysql;
  $id = $_GET['id'];
  
  $query = "SELECT * FROM peq_admin WHERE id=$id";
  $result = $mysql->query_assoc($query);
  
  return $result;
}

function insert_user() {
  global $mysql;
  $login = $_POST['login'];
  $password = md5($_POST['password']);
  $administrator = $_POST['administrator'];
  
  $query = "INSERT INTO peq_admin SET login=\"$login\", password=\"$password\", administrator=$administrator";
  $mysql->query_no_result($query);
}

function update_user() {
  global $mysql;
  $id = $_POST['id'];
  $login = $_POST['login'];
  $administrator = $_POST['administrator'];
  
  if ($_POST['password'] != '') {
    $password = md5($_POST['password']);
    $query = "UPDATE peq_admin SET login=\"$login\", password=\"$password\", administrator=$administrator WHERE id=$id";
  }
  else {
    $query = "UPDATE peq_admin SET login=\"$login\", administrator=$administrator WHERE id=$id";
  }
  $mysql->query_no_result($query);
}

function delete_user() {
  global $mysql;
  $id = $_GET['id'];
  
  $query = "DELETE FROM peq_admin WHERE id=$id";
  $mysql->query_no_result($query);
}

function get_ips() {
  global $mysql;

  $query = "SELECT * FROM gm_ips";
  $results = $mysql->query_mult_assoc($query);

  if ($results) {
    return $results;
  }
  else {
    return null;
  }
}

function ip_info() {
  global $mysql;

  $account_id = $_GET['account_id'];
  $ip_address = $_GET['ip_address'];

  $query = "SELECT * FROM gm_ips WHERE account_id=$account_id AND ip_address=\"$ip_address\"";
  $result = $mysql->query_assoc($query);

  if ($result) {
    return $result;
  }
  else {
    return null;
  }
}

function insert_ip() {
  global $mysql;

  $name = $_POST['name'];
  $account_id = getAccountID($_POST['account_id']);
  $ip_address = $_POST['ip_address'];

  $query = "INSERT INTO gm_ips SET name=\"$name\", account_id=$account_id, ip_address=\"$ip_address\"";
  $mysql->query_no_result($query);
}

function update_ip() {
  global $mysql;

  $name = $_POST['name'];
  $account_id = getAccountID($_POST['account_id']);
  $ip_address = $_POST['ip_address'];
  $old_account = $_POST['old_account'];
  $old_ip = $_POST['old_ip'];

  $query = "UPDATE gm_ips SET name=\"$name\", account_id=$account_id, ip_address=\"$ip_address\" WHERE account_id=$old_account AND ip_address=\"$old_ip\"";
  $mysql->query_no_result($query);
}

function delete_ip() {
  global $mysql;

  $account_id = $_GET['account_id'];
  $ip_address = $_GET['ip_address'];

  $query = "DELETE FROM gm_ips WHERE account_id=$account_id AND ip_address=\"$ip_address\"";
  $mysql->query_no_result($query);
}
?>