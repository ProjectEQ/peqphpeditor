<?php

function logSQL ($query) {
  global $log_file, $logging, $logs_dir;
  $user = $_SESSION['login'];

  if (isset($_SESSION['guest']) && ($_SESSION['guest'] == 1)) {
    $user = 'Guest';
  }
  if ($user == '') {
    $user = 'N/A';
  }

  if ($logging == 1) {
    checkLogDir();
    $time = date("(j-M-y  G:i:s)");
    if (!is_writable($log_file)) {
      $handle = fopen($log_file, 'w') or die("Could not create $log_file! Make sure the logs directory is writeable by your webserver.");
    }
    if (!$handle = fopen($log_file, 'a')) {
      echo "Unable to open the log file ($log_file)! Make sure the file is readable by your webserver.";
      exit;
    }
    if (!fwrite($handle, "$query; -- $user $time\r\n")) {
      echo "Could not write to the log file ($log_file)! Make sure the file is writeable by your webserver.";
      exit;
    }
    fclose($handle);
  }
}

function logPerl ($query) {
  global $perl_log_file, $logging, $logs_dir;
  $user = $_SESSION['login'];

  if (isset($_SESSION['guest']) && ($_SESSION['guest'] == 1)) {
    $user = 'Guest';
  }
  if ($user == '') {
    $user = 'N/A';
  }

  if ($logging == 1) {
    checkLogDir();
    $time = date("j-M-y  G:i:s");
    if (!is_writable($perl_log_file)) {
      $handle = fopen($perl_log_file, 'w') or die("Could not create $perl_log_file! Make sure the logs directory is writeable by your webserver.");
    }
    if (!$handle = fopen($perl_log_file, 'a')) {
      echo "Unable to open the log file ($perl_log_file)! Make sure the file is readable by your webserver.";
      exit;
    }
    if (!fwrite($handle, "$query ($user $time)\r\n")) {
      echo "Could not write to the log file ($perl_log_file)! Make sure the file is writeable by your webserver.";
      exit;
    }
    fclose($handle);
  }
}

function checkLogDir () {
  global $logs_dir;

  if (!file_exists($logs_dir)) {
    mkdir($logs_dir, 0755, true);
  }
}

?>