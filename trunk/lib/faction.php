<?php
$default_page = 1;
$default_size = 50;
$default_sort = 1;

$columns = array(
  1 => 'char_id',
  2 => 'faction_id'
);

$faction_value = array(
  -1 => 'Aggressive',
  0 => 'Passive',
  1 => 'Assist'
);

switch ($action) {
  case 0:  // View faction info
    check_authorization();
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
    check_authorization();
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
  case 7:  // Get faction values
    check_authorization();
    $body = new Template("templates/faction/faction.getvalues.tmpl.php");
    $body->set('id', $fid);
    break;
  case 8:  // Update faction values
    check_authorization();
    update_faction_values();
    header("Location: index.php?editor=faction&fid=$fid");
    exit;
  case 9: // View Player Factions
    check_authorization();
    $breadcrumbs .= " >> Player Factions";
    $curr_page = (isset($_GET['page'])) ? $_GET['page'] : $default_page;
    $curr_size = (isset($_GET['size'])) ? $_GET['size'] : $default_size;
    $curr_sort = (isset($_GET['sort'])) ? $columns[$_GET['sort']] : $columns[$default_sort];
    if ($_GET['filter'] == 'on') {
      $filter = build_filter();
    }
    $body = new Template("templates/faction/faction.players.view.tmpl.php");
    $page_stats = getPageInfo("faction_values", $curr_page, $curr_size, $_GET['sort'], $filter['sql']);
    if ($filter) {
      $body->set('filter', $filter);
    }
    if ($page_stats['page']) {
      $player_factions = get_player_factions($page_stats['page'], $curr_size, $curr_sort, $filter['sql']);
    }
    if ($player_factions) {
      $body->set('player_factions', $player_factions);
      foreach ($page_stats as $key=>$value) {
        $body->set($key, $value);
      }
    }
    else {
      $body->set('page', 0);
      $body->set('pages', 0);
    }
    break;
  case 10: // Edit Player Faction
    check_authorization();
    $breadcrumbs .= " >> Edit Player Faction";
    $body = new Template("templates/faction/faction.players.edit.tmpl.php");
    $body->set('factions', $factions);
    $player_faction = get_player_faction();
    foreach ($player_faction as $key=>$value) {
      $body->set($key, $value);
    }
    break;
  case 11: // Update Player Faction
    check_authorization();
    update_player_faction();
    header("Location: index.php?editor=faction&action=9");
    exit;
  case 12: // Create Player Faction
    check_authorization();
    $breadcrumbs .= " >> Add Player Faction";
    $body = new Template("templates/faction/faction.players.add.tmpl.php");
    $body->set('factions', $factions);
    break;
  case 13: // Add Player Faction
    check_authorization();
    add_player_faction();
    header("Location: index.php?editor=faction&action=9");
    exit;
  case 14: // Delete Player Faction
    check_authorization();
    delete_player_faction();
    $return_address = $_SERVER['HTTP_REFERER'];
    header("Location: $return_address");
    exit;
  case 15:
    check_authorization(); 
    $body = new Template("templates/faction/npcbyprimary.tmpl.php");
    $body->set('fid', $_GET['fid']);
    $npcpri = npcs_using_primary();
    $body->set("npcpri", $npcpri);
    break;
  case 16:
    check_authorization(); 
    $body = new Template("templates/faction/factionsearch.tmpl.php");
    $body->set('fid', $_GET['fid']);
    break;
  case 17:
    check_authorization(); 
    $body = new Template("templates/faction/npc_search_results.tmpl.php");
    $body->set('fid', $_GET['fid']);
    $body->set("faction_value", $faction_value);
    $npcpri = npcs_using_faction(1);
    $body->set("npcpri", $npcpri);
    break;
  case 18:
    check_authorization(); 
    $body = new Template("templates/faction/npc_search_results.tmpl.php");
    $body->set('fid', $_GET['fid']);
    $body->set("faction_value", $faction_value);
    $npcpri = npcs_using_faction(2);
    $body->set("npcpri", $npcpri);
    break;
  case 19:
    check_authorization(); 
    $body = new Template("templates/faction/npc_search_results.tmpl.php");
    $body->set('fid', $_GET['fid']);
    $body->set("faction_value", $faction_value);
    $npcpri = npcs_using_faction(3);
    $body->set("npcpri", $npcpri);
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
$fields .= "mod_r42=\"" . $_POST['mod_r42'] . "\", ";
$fields .= "mod_r75=\"" . $_POST['mod_r75'] . "\", ";
$fields .= "mod_r108=\"" . $_POST['mod_r108'] . "\", ";
$fields .= "mod_r128=\"" . $_POST['mod_r128'] . "\", ";
$fields .= "mod_r130=\"" . $_POST['mod_r130'] . "\", ";
$fields .= "mod_r161=\"" . $_POST['mod_r161'] . "\", ";
$fields .= "mod_r330=\"" . $_POST['mod_r330'] . "\", ";
$fields .= "mod_r367=\"" . $_POST['mod_r367'] . "\", ";
$fields .= "mod_r522=\"" . $_POST['mod_r522'] . "\", ";

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

function update_faction_values () {
  check_authorization();
  global $mysql, $fid;
  $faction_id = $_POST['faction_id'];
  
$query = "SELECT * FROM faction_list where id = \"$faction_id\"";
$result = $mysql->query_assoc($query);
   
$fields .= "base=\"" . $result['base'] . "\", ";
$fields .= "mod_c1=\"" . $result['mod_c1'] . "\", ";
$fields .= "mod_c2=\"" . $result['mod_c2'] . "\", ";
$fields .= "mod_c3=\"" . $result['mod_c3'] . "\", ";
$fields .= "mod_c4=\"" . $result['mod_c4'] . "\", ";
$fields .= "mod_c5=\"" . $result['mod_c5'] . "\", ";
$fields .= "mod_c6=\"" . $result['mod_c6'] . "\", ";
$fields .= "mod_c7=\"" . $result['mod_c7'] . "\", ";
$fields .= "mod_c8=\"" . $result['mod_c8'] . "\", ";
$fields .= "mod_c9=\"" . $result['mod_c9'] . "\", ";
$fields .= "mod_c10=\"" . $result['mod_c10'] . "\", ";
$fields .= "mod_c11=\"" . $result['mod_c11'] . "\", ";
$fields .= "mod_c12=\"" . $result['mod_c12'] . "\", ";
$fields .= "mod_c13=\"" . $result['mod_c13'] . "\", ";
$fields .= "mod_c14=\"" . $result['mod_c14'] . "\", ";
$fields .= "mod_c15=\"" . $result['mod_c15'] . "\", ";
$fields .= "mod_c16=\"" . $result['mod_c16'] . "\", ";
$fields .= "mod_r1=\"" . $result['mod_r1'] . "\", ";
$fields .= "mod_r2=\"" . $result['mod_r2'] . "\", ";
$fields .= "mod_r3=\"" . $result['mod_r3'] . "\", ";
$fields .= "mod_r4=\"" . $result['mod_r4'] . "\", ";

$fields .= "mod_r5=\"" . $result['mod_r5'] . "\", ";
$fields .= "mod_r6=\"" . $result['mod_r6'] . "\", ";
$fields .= "mod_r8=\"" . $result['mod_r8'] . "\", ";
$fields .= "mod_r9=\"" . $result['mod_r9'] . "\", ";
$fields .= "mod_r10=\"" . $result['mod_r10'] . "\", ";
$fields .= "mod_r11=\"" . $result['mod_r11'] . "\", ";
$fields .= "mod_r12=\"" . $result['mod_r12'] . "\", ";
$fields .= "mod_r14=\"" . $result['mod_r14'] . "\", ";
$fields .= "mod_r42=\"" . $result['mod_r42'] . "\", ";
$fields .= "mod_r75=\"" . $result['mod_r75'] . "\", ";
$fields .= "mod_r108=\"" . $result['mod_r108'] . "\", ";
$fields .= "mod_r128=\"" . $result['mod_r128'] . "\", ";
$fields .= "mod_r130=\"" . $result['mod_r130'] . "\", ";
$fields .= "mod_r161=\"" . $result['mod_r161'] . "\", ";
$fields .= "mod_r330=\"" . $result['mod_r330'] . "\", ";
$fields .= "mod_r367=\"" . $result['mod_r367'] . "\", ";
$fields .= "mod_r522=\"" . $result['mod_r522'] . "\", ";

$fields .= "mod_d201=\"" . $result['mod_d201'] . "\", ";
$fields .= "mod_d202=\"" . $result['mod_d202'] . "\", ";
$fields .= "mod_d203=\"" . $result['mod_d203'] . "\", ";
$fields .= "mod_d204=\"" . $result['mod_d204'] . "\", ";
$fields .= "mod_d205=\"" . $result['mod_d205'] . "\", ";
$fields .= "mod_d206=\"" . $result['mod_d206'] . "\", ";
$fields .= "mod_d207=\"" . $result['mod_d207'] . "\", ";
$fields .= "mod_d208=\"" . $result['mod_d208'] . "\", ";
$fields .= "mod_d209=\"" . $result['mod_d209'] . "\", ";
$fields .= "mod_d210=\"" . $result['mod_d210'] . "\", ";
$fields .= "mod_d211=\"" . $result['mod_d211'] . "\", ";
$fields .= "mod_d212=\"" . $result['mod_d212'] . "\", ";
$fields .= "mod_d213=\"" . $result['mod_d213'] . "\", ";
$fields .= "mod_d214=\"" . $result['mod_d214'] . "\", ";
$fields .= "mod_d215=\"" . $result['mod_d215'] . "\", ";
$fields .= "mod_d216=\"" . $result['mod_d216'] . "\", ";
$fields .= "mod_d140=\"" . $result['mod_d140'] . "\", ";
$fields =  rtrim($fields, ", ");

  if ($fields != '') {
    $query = "UPDATE faction_list SET $fields WHERE id=\"$fid\"";
    $mysql->query_no_result($query);
  }
}

function get_player_factions($page_number, $results_per_page, $sort_by, $where = "") {
  global $mysql;
  $limit = ($page_number - 1) * $results_per_page . "," . $results_per_page;
  
  $query = "SELECT * FROM faction_values";
  if ($where) {
    $query .= " WHERE $where";
  }
  $query .= " ORDER BY $sort_by LIMIT $limit";
  $results = $mysql->query_mult_assoc($query);

  return $results;
}

function get_player_faction() {
  global $mysql;
  $char_id = $_GET['char_id'];
  $faction_id = $_GET['faction_id'];
  
  $query = "SELECT * FROM faction_values WHERE char_id = $char_id AND faction_id = $faction_id";
  $result = $mysql->query_assoc($query);
  
  return $result;
}

function update_player_faction() {
  global $mysql;

  $char_id = $_POST['char_id'];
  $faction_id = $_POST['faction_id'];
  $current_value = $_POST['current_value'];
  $o_cid = $_POST['o_cid'];
  $o_fid = $_POST['o_fid'];

  $query = "UPDATE faction_values SET char_id=\"$char_id\", faction_id=\"$faction_id\", current_value=\"$current_value\" WHERE char_id=\"$o_cid\" AND faction_id=\"$o_fid\"";
  $mysql->query_no_result($query);
}

function add_player_faction() {
  global $mysql;

  $char_id = $_POST['char_id'];
  $faction_id = $_POST['faction_id'];
  $current_value = $_POST['current_value']; 

  $query = "INSERT INTO faction_values SET char_id=\"$char_id\", faction_id=\"$faction_id\", current_value=\"$current_value\"";
  $mysql->query_no_result($query);
}

function delete_player_faction() {
  global $mysql;

  $char_id = $_GET['char_id'];
  $faction_id = $_GET['faction_id'];

  $query = "DELETE FROM faction_values WHERE char_id=\"$char_id\" AND faction_id=\"$faction_id\"";
  $mysql->query_no_result($query);
}

function build_filter() {
  global $mysql;
  $filter1 = $_GET['filter1'];
  $filter2 = $_GET['filter2'];
  $filter_final = array();

  if ($filter1) { // Filter by character
    $query = "SELECT c.id FROM character_ c, faction_values f WHERE c.id = f.char_id AND c.name LIKE \"%$filter1%\" GROUP BY id";
    $results = $mysql->query_mult_assoc($query);
    $filter_charid = "char_id IN (";
    if ($results) {
      foreach ($results as $result) {
        $filter_charid .= $result['id'] . ",";
      }
      $filter_charid = rtrim($filter_charid, ",");
    }
    else {
      $filter_charid .= "NULL";
    }
    $filter_charid .= ")";
    $filter_final['sql'] = $filter_charid;
  }
  if ($filter2) { // Filter by faction id
    $filter_factionid = "faction_id = $filter2";
    if ($filter_final['sql']) {
      $filter_final['sql'] .= " AND ";
    }
    $filter_final['sql'] .= $filter_factionid;
  }

  $filter_final['url'] = "&filter=on&filter1=$filter1&filter2=$filter2";
  $filter_final['status'] = "on";
  $filter_final['filter1'] = $filter1;
  $filter_final['filter2'] = $filter2;

  return $filter_final;
}

function npcs_using_primary() {
 	check_authorization();
	global $mysql, $fid;

	$query = "SELECT nt.id AS npcid, nt.name AS npcname, nf.name AS factionname from npc_types nt
		   INNER JOIN npc_faction nf ON nf.id = nt.npc_faction_id
	          WHERE nf.primaryfaction = $fid GROUP by nt.id ORDER by nt.name";

	$results = $mysql->query_mult_assoc($query);
	return $results;
}

function npcs_using_faction($value) {
	check_authorization();
	global $mysql, $fid;

	if($value == 1){

	$query = "SELECT nt.id AS npcid, nt.name AS npcname, nfe.npc_value AS factionvalue from npc_types nt
                 INNER JOIN npc_faction_entries nfe ON nfe.npc_faction_id = nt.npc_faction_id
                WHERE nfe.faction_id = $fid AND nfe.npc_faction_id in (SELECT npc_faction_id from npc_faction_entries where value > 0 and faction_id = $fid) GROUP by nt.id ORDER by nt.name";

	}

	if($value == 2){

	$query = "SELECT nt.id AS npcid, nt.name AS npcname, nfe.npc_value AS factionvalue from npc_types nt
                 INNER JOIN npc_faction_entries nfe ON nfe.npc_faction_id = nt.npc_faction_id
                WHERE nfe.faction_id = $fid AND nfe.npc_faction_id in (SELECT npc_faction_id from npc_faction_entries where value < 0 and faction_id = $fid) GROUP by nt.id ORDER by nt.name";
	}

	if($value == 3){

	$query = "SELECT nt.id AS npcid, nt.name AS npcname, nfe.npc_value AS factionvalue from npc_types nt
                 INNER JOIN npc_faction_entries nfe ON nfe.npc_faction_id = nt.npc_faction_id
                WHERE nfe.faction_id = $fid AND nfe.npc_faction_id in (SELECT npc_faction_id from npc_faction_entries where value = 0 and faction_id = $fid) GROUP by nt.id ORDER by nt.name";
	}

	$results = $mysql->query_mult_assoc($query);
	return $results;
}

?>
