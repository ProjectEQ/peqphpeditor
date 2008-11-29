<?php

class session {

  function start() {
    session_start();
  }
  
  function login ($login, $pw) {
    global $mysql;
    
    $query = "SELECT password FROM peq_admin WHERE login=\"$login\"";
    $result = $mysql->query_assoc($query);
    if ($result == '') {
      $_SESSION['error'] = 1;
      return;
    }
    extract($result);
    
    if ($password == md5($pw)) {
      $_SESSION['login'] = $login;
      $_SESSION['password'] = md5($pw);
    }
    else {
      $_SESSION['error'] = 1;
    }
  }
  
  function logged_in() {
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

  function check_authorization() {
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

  function is_admin() {
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

  function stop() {
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
  if ($_GET['login'] == "guest") {
    $_SESSION['guest'] = 1;
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
  $body->set('error', $error);
  $body->set('login', $login);
  $body->set('password', $password);
  $tmpl->set('body', $body);
  echo $tmpl->fetch('templates/index.tmpl.php');
  unset($_SESSION['error']);
  exit;
}


?>
