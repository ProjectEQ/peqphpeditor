<?php

class mysql {

  function mysql($username, $password, $database, $host) {
    mysql_connect("$host", "$username", "$password")
      or die('Could not connect: ' . mysql_error());
    mysql_select_db("$database")
      or die('Could not select database');
  }

  function query_no_result($query) {
    global $log_error;
    if (mysql_query($query)) {
      logSQL($query);
      return true;
    }
    else {
      if ($log_error == 1) {
        logSQL($query . " - Error: " . mysql_error());
      }
      mysql::error($query . " - " . mysql_error());
      return false;
    }
  }

  function query_assoc($query) {
    global $log_all, $log_error;
    if ($result = mysql_query(quote_smart($query))) {
      $row = mysql_fetch_assoc($result);
      if ($log_all == 1) {
        logSQL($query);
      }
      return (isset($row) ? $row : '');
    }
    if ($log_error == 1) {
      logSQL($query . " - Error: " . mysql_error());
    }
    else
      mysql::error($query . " - " . mysql_error());
  }

  // Used to return multi-dimensional arrays
  function query_mult_assoc($query) {
    global $log_all, $log_error;
    if ($result = mysql_query(quote_smart($query))) {
      while ($row = mysql_fetch_assoc($result)) {
        $array[] = $row;
      }
      if ($log_all == 1) {
        logSQL($query);
      }
      return (isset($array) ? $array : '');
    }
    if ($log_error == 1) {
      logSQL($query . " - Error: " . mysql_error());
    }
    else
      mysql::error($query . " - " . mysql_error());
  }

  function generate_insert_query($query) {
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

  function real_escape_string($query) {
    $result = mysql_real_escape_string($query);
    return $result;
  }

}

$mysql = new mysql($dbuser, $dbpass, $db, $dbhost);

// Quote variable to make safe
function quote_smart($value) {

  // Stripslashes
  if (get_magic_quotes_gpc()) {
    //$value = stripslashes($value);
  }

  // Quote if not integer
  if (!is_numeric($value)) {
    //$value = "'" . mysql_real_escape_string($value) . "'";
  }

  // Deter UNION SQL Injection
  if (function_exists("stripos")) { //PHP5+ installed
    if (stripos($value, 'union all') || stripos($value, 'union select')) {
      logSQL("SQL injection monitored by user at IP: '" . getIP() . "' using the query: '" . $value . "'.");
      header("Location: index.php");
      exit;
    }
  }
  else { //PHP<5 installed
    if (strpos(strtolower($value), 'union all') || strpos(strtolower($value), 'union select')) {
      logSQL("SQL injection monitored by user at IP: '" . getIP() . "' using the query: '" . $value . "'.");
      header("Location: index.php");
      exit;
    }
  }

  return $value;
}

?>
