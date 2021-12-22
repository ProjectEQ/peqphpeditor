<?php

class mysql extends mysqli {

  public function __construct($host, $username, $password, $database, $port) {
    parent::__construct("$host", "$username", "$password", "$database", $port);
    if (mysqli_connect_error()) {
      die('Could not connect: ' . mysqli_connect_error());
    }
  }

  function add_query_signature($query) {
    global $_SESSION;

    return sprintf("%s /* peq-editor user: %s */", $query, ((isset($_SESSION['login'])) ? $_SESSION['login'] : "N/A"));
  }

  function query_no_result($query) {
    global $log_error;
    $query = mysql::add_query_signature($query);

    $user = $_SESSION['login'];
    if (mysqli_query($this, quote_smart($query))) {
      logSQL($query);
      return true;
    }
    else {
      if ($log_error == 1) {
        logSQL($query . " - Error: " . mysqli_error($this));
      }
      die ($query . " - " . mysqli_error($this));
      return false;
    }
  }

  function query_assoc($query) {
    global $log_all, $log_error;
    $query = mysql::add_query_signature($query);
    if ($result = mysqli_query($this, quote_smart($query))) {
      $row = $result->fetch_assoc();
      if ($log_all == 1) {
        logSQL($query);
      }
      return (isset($row) ? $row : '');
    }
    if ($log_error == 1) {
      logSQL($query . " - Error: " . mysqli_error($this));
    }
    else
      die ($query . " - " . mysqli_error($this));
  }

  // Used to return multi-dimensional arrays
  function query_mult_assoc($query) {
    global $log_all, $log_error;
    $query = mysql::add_query_signature($query);
    if ($result = mysqli_query($this, quote_smart($query))) {
      while ($row = $result->fetch_assoc()) {
        $array[] = $row;
      }
      if ($log_all == 1) {
        logSQL($query);
      }
      return (isset($array) ? $array : '');
    }
    if ($log_error == 1) {
      logSQL($query . " - Error: " . mysqli_error($this));
    }
    else
      die ($query . " - " . mysqli_error($this));
  }

  function generate_insert_query($query) {
    $query = mysql::add_query_signature($query);
    preg_match("/FROM (.*?) /i", $query, $matches);
    $table = $matches[1];

    preg_match("/WHERE (.*) LIMIT/i", $query, $matches);
    $where = $matches[1];

    $query2 = "SELECT * FROM " . $table . " WHERE " . $where;

    $row = mysql::query_assoc($query2);

    foreach ($row as $key=>$value) {
      $values[] = "$key=\"$value\"";
    }
    $values2 = implode(", ", $values);

    $insert = "INSERT INTO " . $table . " VALUES (" . $values2 . ")";

    $insert2 = addslashes($insert);

    $query3 = "INSERT INTO undo set query=\"$insert2\"";
//    mysql::query_no_result($query3);
    echo "insert query: <br>$insert";

    exit;
  }

  function error($error) {
    echo "Query failed:<br> $error<br><br>";
  }

}

$mysql = new mysql($dbhost, $dbuser, $dbpass, $db, $dbport);

// Establish content database connection (if any)
$mysql_content_db = null;
if ($use_content_db) {
  $mysql_content_db = new mysql($content_dbhost, $content_dbuser, $content_dbpass, $content_db, $content_dbport);
}
else {
  $mysql_content_db = $mysql;
}

// Quote variable to make safe
function quote_smart($value) {

  // Deter UNION SQL Injection
  if (stripos($value, 'union all') || stripos($value, 'union select')) {
    logSQL("Possible attempt at SQL injection monitored by user at IP: '" . getIP() . "' using the query: '" . $value . "'.");
    header("Location: index.php");
    exit;
  }

  return $value;
}

?>
