<?

function logSQL ($query) {
  global $log_file, $logging;
  $user = $_SESSION['login'];

  if ($logging == 1) {
    $time = date("(j-M-y  G:i:s)");
    if (!is_writable($log_file)) {
      echo "The log file ($log_file) is not writable!<br><br>Make sure the files exists and is not read-only.";
      exit;
    }
    if (!$handle = fopen($log_file, 'a')) {
      echo "Unable to open the log file ($log_file)!";
      exit;
    }
    if (!fwrite($handle, "$query; -- $user $time\r\n")) {
      echo "Could not write to the log file ($log_file)!";
      exit;
    }
    fclose($handle);
  }
}

?>