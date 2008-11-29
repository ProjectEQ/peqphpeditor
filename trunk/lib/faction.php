<?

switch ($action) {
  case 0:  // View faction info
    if ($fid) {
      $body = new Template("templates/faction/faction.tmpl.php");
      $vars = faction_info();
      if ($vars) {
        foreach ($vars as $key=>$value) {
          $body->set($key, $value);
        }
      }
    }
    break;
  case 1: // Edit faction
    check_authorization();
    $body = new Template("templates/faction/faction.edit.tmpl.php");
    $body->set('currzone', $z);
    $vars = faction_info();
    if ($vars) {
      foreach ($vars as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
  case 2:
    check_authorization();
    update_faction();
    header("Location: index.php?editor=faction&fid=$fid");
    exit;
  case 3:  // Search factions
    $body = new Template("templates/faction/faction.searchresults.tmpl.php");
    $results = search_factions();
    $body->set("results", $results);
    break;
}

function faction_info() {
  global $mysql, $fid;
  
  $query = "SELECT * FROM faction_list WHERE id=$fid";
  $result = $mysql->query_assoc($query);
  
  return $result;
}

function update_faction() {
  check_authorization();
  global $mysql, $fid;
  
  $oldstats = faction_info();
  
  $fields = '';
  foreach ($oldstats as $k => $v) {
    if ($v != $_POST["$k"]) {
      $fields .= "$k=\"" . $_POST["$k"] . "\", ";
    }
  }

  $fields =  rtrim($fields, ", ");

  if ($fields != '') {
    $query = "UPDATE faction_list SET $fields WHERE id=$fid";
    $mysql->query_no_result($query);
  }
}

function search_factions() {
  global $mysql;
  $search = $_GET['search'];

  $query = "SELECT id, name FROM faction_list WHERE name rlike \"$search\"";
  $results = $mysql->query_mult_assoc($query);
  return $results;
}

?>
