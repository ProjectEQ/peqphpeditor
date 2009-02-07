<?

switch ($action) {
  case 0:  // View faction info
    if (!$fid) {
      $body = new Template("templates/faction/faction.default.tmpl.php");
    }
    else {
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
  case 4: // Add faction
    check_authorization();
    $body = new Template("templates/faction/faction.add.tmpl.php");
    $body->set('currzone', $z);
    $body->set('suggestflid', suggest_faction_id());
    break;
  case 5: // Add faction
    check_authorization();
    add_faction();
    $fid = $_POST['id'];
    header("Location: index.php?editor=faction&fid=$fid");
    exit;
  case 6: // Delete faction
    check_authorization();
    delete_faction();
    header("Location: index.php?editor=faction");
    exit;
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

function suggest_faction_id() {
  global $mysql;

  $query = "SELECT MAX(id) AS flid FROM faction_list";
  $result = $mysql->query_assoc($query);
  
  return ($result['flid'] + 1);
}

function search_factions() {
  global $mysql;
  $search = $_GET['search'];

  $query = "SELECT id, name FROM faction_list WHERE name rlike \"$search\"";
  $results = $mysql->query_mult_assoc($query);
  return $results;
}

function delete_faction() {
  global $mysql, $fid;
  
  $query = "DELETE FROM faction_list WHERE id=$fid";
  $mysql->query_no_result($query);
  
  return $result;
}

function add_faction () {
  check_authorization();
  global $mysql;
  
$fields .= "id=\"" . $_POST['id']. "\", ";
$fields .= "name=\"" . $_POST['name'] . "\", ";
$fields .= "base=\"" . $_POST['base'] . "\", ";
$fields .= "mod_c1=\"" . $_POST['mod_c1'] . "\", ";
$fields .= "mod_c2=\"" . $_POST['mod_c2'] . "\", ";
$fields .= "mod_c3=\"" . $_POST['mod_c3'] . "\", ";
$fields .= "mod_c4=\"" . $_POST['mod_c4'] . "\", ";
$fields .= "mod_c5=\"" . $_POST['mod_c5'] . "\", ";
$fields .= "mod_c6=\"" . $_POST['mod_c6'] . "\", ";
$fields .= "mod_c7=\"" . $_POST['mod_c7'] . "\", ";
$fields .= "mod_c8=\"" . $_POST['mod_c8'] . "\", ";
$fields .= "mod_c9=\"" . $_POST['mod_c9'] . "\", ";
$fields .= "mod_c10=\"" . $_POST['mod_c10'] . "\", ";
$fields .= "mod_c11=\"" . $_POST['mod_c11'] . "\", ";
$fields .= "mod_c12=\"" . $_POST['mod_c12'] . "\", ";
$fields .= "mod_c13=\"" . $_POST['mod_c13'] . "\", ";
$fields .= "mod_c14=\"" . $_POST['mod_c14'] . "\", ";
$fields .= "mod_c15=\"" . $_POST['mod_c15'] . "\", ";
$fields .= "mod_c16=\"" . $_POST['mod_c16'] . "\", ";
$fields .= "mod_r1=\"" . $_POST['mod_r1'] . "\", ";
$fields .= "mod_r2=\"" . $_POST['mod_r2'] . "\", ";
$fields .= "mod_r3=\"" . $_POST['mod_r3'] . "\", ";
$fields .= "mod_r4=\"" . $_POST['mod_r4'] . "\", ";
$fields .= "mod_r5=\"" . $_POST['mod_r5'] . "\", ";
$fields .= "mod_r6=\"" . $_POST['mod_r6'] . "\", ";
$fields .= "mod_r8=\"" . $_POST['mod_r8'] . "\", ";
$fields .= "mod_r9=\"" . $_POST['mod_r9'] . "\", ";
$fields .= "mod_r10=\"" . $_POST['mod_r10'] . "\", ";
$fields .= "mod_r11=\"" . $_POST['mod_r11'] . "\", ";
$fields .= "mod_r12=\"" . $_POST['mod_r12'] . "\", ";
$fields .= "mod_r14=\"" . $_POST['mod_r14'] . "\", ";
$fields .= "mod_r60=\"" . $_POST['mod_r60'] . "\", ";
$fields .= "mod_r75=\"" . $_POST['mod_r75'] . "\", ";
$fields .= "mod_r108=\"" . $_POST['mod_r108'] . "\", ";
$fields .= "mod_r120=\"" . $_POST['mod_r120'] . "\", ";
$fields .= "mod_r128=\"" . $_POST['mod_r128'] . "\", ";
$fields .= "mod_r130=\"" . $_POST['mod_r130'] . "\", ";
$fields .= "mod_r161=\"" . $_POST['mod_r161'] . "\", ";
$fields .= "mod_r330=\"" . $_POST['mod_r330'] . "\", ";
$fields .= "mod_d201=\"" . $_POST['mod_d201'] . "\", ";
$fields .= "mod_d202=\"" . $_POST['mod_d202'] . "\", ";
$fields .= "mod_d203=\"" . $_POST['mod_d203'] . "\", ";
$fields .= "mod_d204=\"" . $_POST['mod_d204'] . "\", ";
$fields .= "mod_d205=\"" . $_POST['mod_d205'] . "\", ";
$fields .= "mod_d206=\"" . $_POST['mod_d206'] . "\", ";
$fields .= "mod_d207=\"" . $_POST['mod_d207'] . "\", ";
$fields .= "mod_d208=\"" . $_POST['mod_d208'] . "\", ";
$fields .= "mod_d209=\"" . $_POST['mod_d209'] . "\", ";
$fields .= "mod_d210=\"" . $_POST['mod_d210'] . "\", ";
$fields .= "mod_d211=\"" . $_POST['mod_d211'] . "\", ";
$fields .= "mod_d212=\"" . $_POST['mod_d212'] . "\", ";
$fields .= "mod_d213=\"" . $_POST['mod_d213'] . "\", ";
$fields .= "mod_d214=\"" . $_POST['mod_d214'] . "\", ";
$fields .= "mod_d215=\"" . $_POST['mod_d215'] . "\", ";
$fields .= "mod_d216=\"" . $_POST['mod_d216'] . "\", ";
$fields .= "mod_d140=\"" . $_POST['mod_d140'] . "\", ";
$fields =  rtrim($fields, ", ");

  if ($fields != '') {
    $query = "INSERT INTO faction_list SET $fields";
    $mysql->query_no_result($query);
  }
}

?>
