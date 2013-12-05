<?php

class session {

  public static function start() {
    session_start();
  }
  
  public static function login($login, $pw) {
    global $mysql;
    
    $query = "SELECT password FROM peq_admin WHERE login=\"$login\"";
    $result = $mysql->query_assoc($query);
    if ($result == '') {
      $_SESSION['error'] = 1;
      logSQL("Invalid login attempt. Bad username from IP: '" . getIP() . "'. Username: '$login' Password: '$pw'.");
      return;
    }
    extract($result);
    
    if ($password == md5($pw)) {
      $_SESSION['login'] = $login;
      $_SESSION['password'] = md5($pw);
    }
    else {
      $_SESSION['error'] = 1;
      logSQL("Invalid login attempt. Bad password from IP: '" . getIP() . "'. Username: '$login' Password: '$pw'.");
    }
  }
  
  public static function logged_in() {
    global $mysql;

    if (isset($_SESSION['guest']) && $_SESSION['guest'] == 1) return true;

    if (!isset($_SESSION['login']) || !isset($_SESSION['password'])) return false;

    $login = $_SESSION['login'];
    $pw = $_SESSION['password'];
    $query = "SELECT password FROM peq_admin WHERE login=\"$login\"";
    $result = $mysql->query_assoc($query);

    if ($result == '') {
      return false;
    }

    extract($result);
    
    if ($password == $pw) {
      return true;
    }
    else return false;
  }

  public static function check_authorization() {
    global $mysql;
    
    if (isset($_SESSION['guest']) && $_SESSION['guest'] == 1) return false;

    if (!isset($_SESSION['login']) || !isset($_SESSION['password'])) return false;

    $login = $_SESSION['login'];
    $pw = $_SESSION['password'];
    $query = "SELECT password FROM peq_admin WHERE login=\"$login\"";
    $result = $mysql->query_assoc($query);

    if ($result == '') {
      return false;
    }

    extract($result);
    
    if ($password == $pw) {
      return true;
    }
    else return false;
  }

  public static function is_admin() {
    global $mysql;
    
    if (isset($_SESSION['guest']) && $_SESSION['guest'] == 1) return false;

    if (!isset($_SESSION['login']) || !isset($_SESSION['password'])) return false;

    $login = $_SESSION['login'];
    $pw = $_SESSION['password'];
    $query = "SELECT administrator FROM peq_admin WHERE login=\"$login\"";
    $result = $mysql->query_assoc($query);
    extract($result);
    
    if ($administrator == 1) {
      return true;
    }
    else return false;
  }

  public static function stop() {
    session_unset();
    session_destroy();
  }
}

session::start();

// Handle logouts
if (isset($_GET['logout'])) {
  session::stop();
  header('Location: index.php');
  exit;
}

// Handle logins
if (isset($_GET['login'])) {
  if ($_GET['login'] == "guest" && $enable_guest_mode == 1) {
    $_SESSION['guest'] = 1;
  }
  if ($_GET['login'] == "guest" && $enable_guest_mode != 1) {
    $_SESSION['guest'] = 0;
  }
  if ($enable_user_login != 1) {
  $login = $_POST['login'];
  $password = $_POST['password'];
   logSQL("POSSIBLE HACK ATTEMPT. Person was from IP: '" . getIP() . "'. and used Username: '$login' Password: '$password'.");
   $_SESSION['error'] = 1;
  }
  else {
    session::login($_POST['login'], $_POST['password']);
  }
  header('Location: index.php');
  exit;
}

// Verify user is logged in
if (session::logged_in() != TRUE) {
  $body = new Template("templates/login.tmpl.php");
  $error = isset($_SESSION['error']) ? 1 : 0;
  $body->set('enable_guest_mode', $enable_guest_mode);
  $body->set('enable_user_login', $enable_user_login);
  $body->set('error', $error);
  $body->set('login', $login);
  $body->set('password', $password);
  $tmpl->set('body', $body);
  echo $tmpl->fetch('templates/index.tmpl.php');
  unset($_SESSION['error']);
  exit;
}

// Get IP address
function getIP() {
  if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
  }
  elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
  }
  else {
    $ip = $_SERVER['REMOTE_ADDR'];
  }

  return $ip;
}
?>
