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
      $faction_data = faction_info();
      if ($faction_data['faction_info']) {
        $body->set('faction_info', $faction_data['faction_info']);
      }
      if ($faction_data['faction_mods']) {
        $body->set('faction_mods', $faction_data['faction_mods']);
	 $body->set("fac_mods", $fac_mods);
      }
    }
    break;
  case 1: // Edit faction
    check_authorization();
    $body = new Template("templates/faction/faction.edit.tmpl.php");
    $faction_data = faction_info();
    if ($faction_data['faction_info']) {
      $body->set('faction_info', $faction_data['faction_info']);
    }
    $breadcrumbs .= " >> Edit Faction";
    break;
  case 2: // Update faction
    check_authorization();
    update_faction();
    header("Location: index.php?editor=faction&fid=$fid");
    exit;
  case 3:  // Search factions
    check_authorization();
    $body = new Template("templates/faction/faction.searchresults.tmpl.php");
    $results = "";
    if (isset($_POST['faction_id']) && $_POST['faction_id'] != "ID") {
      $results = search_factions_by_id();
    }
    else {
      $results = search_factions_by_name();
    }
    if ($results) {
      $body->set("results", $results);
    }
    break;
  case 4: // Add faction
    check_authorization();
    $body = new Template("templates/faction/faction.add.tmpl.php");
    $body->set('currzone', $z);
    $body->set('suggested_id', suggest_faction_id());
    $breadcrumbs .= " >> Add New Faction";
    break;
  case 5: // Insert faction
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
  case 7: // ToDo: Copy faction
    check_authorization();
    $body = new Template("templates/faction/faction.default.tmpl.php");
    break;
  case 8: // ToDo: Create faction copy
    check_authorization();
    $body = new Template("templates/faction/faction.default.tmpl.php");
    break;
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
  case 20: // Add faction mod
    check_authorization();
    $body = new Template("templates/faction/factionmod.add.tmpl.php");
    $javascript = new Template("templates/faction/js.tmpl.php");
    $body->set('suggested_id', suggest_faction_mod_id());
    $body->set('faction_id', $fid);
    $body->set('races', $races);
    $body->set('classes', $classes);
    $body->set('deities', $deities);
    $breadcrumbs .= " >> Add Faction Mod";
    break;
  case 21: // Insert faction mod
    check_authorization();
    add_faction_mod();
    $fid = $_POST['faction_id'];
    header("Location: index.php?editor=faction&fid=$fid");
    exit;
  case 22: // Edit faction mod
    check_authorization();
    $body = new Template("templates/faction/factionmod.edit.tmpl.php");
    $javascript = new Template("templates/faction/js.tmpl.php");
    $mod_data = get_faction_mod($_GET['fmid']);
    if ($mod_data) {
      $body->set('mod', $mod_data);
      $body->set('category', substr($mod_data['mod_name'],0,1));
      $body->set('cat_index', substr($mod_data['mod_name'],1));
    }
    $body->set('races', $races);
    $body->set('classes', $classes);
    $body->set('deities', $deities);
    $breadcrumbs .= " >> Edit Faction Mod";
    break;
  case 23: // Update faction mod
    check_authorization();
    update_faction_mod();
    header("Location: index.php?editor=faction&fid=$fid");
    exit;
  case 24: // Delete faction mod
    check_authorization();
    delete_faction_mod();
    header("Location: index.php?editor=faction&fid=$fid");
    exit;
}

function faction_info() {
  global $mysql, $fid;
  $faction_array = array();
  $faction_info = array();
  $faction_mods = array();

  $query = "SELECT * FROM faction_list WHERE id=$fid";
  $faction_info = $mysql->query_assoc($query);

  $query = "SELECT * FROM faction_list_mod WHERE faction_id=$fid ORDER BY id";
  $faction_mods = $mysql->query_mult_assoc($query);

  $faction_array['faction_info'] = $faction_info;
  $faction_array['faction_mods'] = $faction_mods;

  return $faction_array;
}

function search_factions_by_name() {
  global $mysql;
  $search = $_POST['faction_name'];

  $query = "SELECT id, `name` FROM faction_list WHERE `name` rlike \"$search\"";
  $results = $mysql->query_mult_assoc($query);
  return $results;
}

function search_factions_by_id() {
  global $mysql;
  $search = $_POST['faction_id'];

  $query = "SELECT id, `name` FROM faction_list WHERE id = \"$search\"";
  $results = $mysql->query_mult_assoc($query);
  return $results;
}

function suggest_faction_id() {
  global $mysql;

  $query = "SELECT MAX(id) AS flid FROM faction_list";
  $result = $mysql->query_assoc($query);

  return ($result['flid'] + 1);
}

function suggest_faction_mod_id() {
  global $mysql;

  $query = "SELECT MAX(id) AS fmid FROM faction_list_mod";
  $result = $mysql->query_assoc($query);

  return ($result['fmid'] + 1);
}

function add_faction() {
  check_authorization();
  global $mysql;
  
  $id = $_POST['id'];
  $name = $_POST['name'];
  $base = $_POST['base'];

  $query = "INSERT INTO faction_list SET id=$id, `name`=\"$name\", base=$base";
  $mysql->query_no_result($query);
}

function update_faction() {
  check_authorization();
  global $mysql, $fid;

  $old_id = $fid;
  $old_name = $_POST['old_name'];
  $old_base = $_POST['old_base'];
  $new_id = $_POST['new_id'];
  $new_name = $_POST['new_name'];
  $new_base = $_POST['new_base'];
  $fields = '';

  $fields .= ($old_id != $new_id) ? "id=$new_id" . ", " : '';
  $fields .= ($old_name != $new_name) ? "`name`=\"$new_name\"" . ", " : '';
  $fields .= ($old_base != $new_base) ? "base=$new_base" . ", " : '';
  $fields = rtrim($fields, ", ");

  if ($fields != '') {
    $query = "UPDATE faction_list SET $fields WHERE id=$old_id";
    $mysql->query_no_result($query);
  }
  if ($old_id != $new_id) {
    $query = "UPDATE faction_list_mod SET faction_id=$new_id WHERE faction_id=$old_id";
    $mysql->query_no_result($query);
    $fid = $new_id;
  }
}

function delete_faction() {
  global $mysql, $fid;

  $query = "DELETE FROM faction_list WHERE id=$fid";
  $mysql->query_no_result($query);

  $query = "DELETE FROM faction_list_mod WHERE faction_id=$fid";
  $mysql->query_no_result($query);
}

function get_faction_mod($fmid) {
  global $mysql, $fid;

  $query = "SELECT * FROM faction_list_mod WHERE id=$fmid AND faction_id=$fid";
  $result = $mysql->query_assoc($query);

  return $result;
}

function add_faction_mod() {
  check_authorization();
  global $mysql, $fid;
  
  $id = $_POST['id'];
  $faction_id = $fid;
  $mod_name = $_POST['mod_name'];
  $mod = $_POST['mod'];

  $query = "INSERT INTO faction_list_mod SET id=$id, faction_id=$faction_id, mod_name=\"$mod_name\", `mod`=$mod";
  $mysql->query_no_result($query);

}

function update_faction_mod() {
  check_authorization();
  global $mysql, $fid;

  $old_id = $_POST['old_id'];
  $old_mod_name = $_POST['old_mod_name'];
  $old_mod = $_POST['old_mod'];
  $new_id = $_POST['new_id'];
  $new_mod_name = $_POST['new_mod_name'];
  $new_mod = $_POST['new_mod'];
  $fields = '';

  $fields .= ($old_id != $new_id) ? "id=$new_id" . ", " : '';
  $fields .= ($old_mod_name != $new_mod_name) ? "mod_name=\"$new_mod_name\"" . ", " : '';
  $fields .= ($old_mod != $new_mod) ? "`mod`=$new_mod" : '';
  $fields = rtrim($fields, ", ");

  if ($fields != '') {
    $query = "UPDATE faction_list_mod SET $fields WHERE id=$old_id AND faction_id=$fid";
    $mysql->query_no_result($query);
  }
}

function delete_faction_mod() {
  global $mysql, $fid;
  $fmid = $_GET['fmid'];

  $query = "DELETE FROM faction_list_mod WHERE id=$fmid AND faction_id=$fid";
  $mysql->query_no_result($query);
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

function add_player_faction() {
  global $mysql;

  $char_id = $_POST['char_id'];
  $faction_id = $_POST['faction_id'];
  $current_value = $_POST['current_value']; 

  $query = "INSERT INTO faction_values SET char_id=\"$char_id\", faction_id=\"$faction_id\", current_value=\"$current_value\"";
  $mysql->query_no_result($query);
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
    $query = "SELECT c.id FROM character_data c, faction_values f WHERE c.id = f.char_id AND c.name LIKE \"%$filter1%\" GROUP BY id";
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

  if ($value == 1) {
    $query = "SELECT nt.id AS npcid, nt.name AS npcname, nfe.npc_value AS factionvalue from npc_types nt
              INNER JOIN npc_faction_entries nfe ON nfe.npc_faction_id = nt.npc_faction_id
              WHERE nfe.faction_id = $fid AND nfe.npc_faction_id in (SELECT npc_faction_id from npc_faction_entries where value > 0 and faction_id = $fid) GROUP by nt.id ORDER by nt.name";
  }
  if ($value == 2) {
    $query = "SELECT nt.id AS npcid, nt.name AS npcname, nfe.npc_value AS factionvalue from npc_types nt
              INNER JOIN npc_faction_entries nfe ON nfe.npc_faction_id = nt.npc_faction_id
              WHERE nfe.faction_id = $fid AND nfe.npc_faction_id in (SELECT npc_faction_id from npc_faction_entries where value < 0 and faction_id = $fid) GROUP by nt.id ORDER by nt.name";
  }
  if ($value == 3) {
    $query = "SELECT nt.id AS npcid, nt.name AS npcname, nfe.npc_value AS factionvalue from npc_types nt
              INNER JOIN npc_faction_entries nfe ON nfe.npc_faction_id = nt.npc_faction_id
              WHERE nfe.faction_id = $fid AND nfe.npc_faction_id in (SELECT npc_faction_id from npc_faction_entries where value = 0 and faction_id = $fid) GROUP by nt.id ORDER by nt.name";
  }
  $results = $mysql->query_mult_assoc($query);

  return $results;
}

function deconstruct_mod($mod_name) {
  global $races, $classes, $deities;
  $category = substr($mod_name, 0, 1);
  $cat_index = substr($mod_name, 1);
  $mod_type = array();

  switch ($category) {
    case 'r':
      $mod_type['category'] = 'Race';
      $mod_type['name'] = $races[$cat_index];
      break;
    case 'c':
      $mod_type['category'] = 'Class';
      $mod_type['name'] = $classes[$cat_index];
      break;
    case 'd':
      $mod_type['category'] = 'Deity';
      $mod_type['name'] = $deities[$cat_index];
      break;
  }

  return $mod_type;
}

?>
