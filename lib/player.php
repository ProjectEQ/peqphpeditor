<?php

$default_page = 1;
$default_size = 200;
$default_sort = 1;

$columns = array(
  1 => 'id',
  2 => 'name',
  3 => 'account_id',
  4 => 'class',
  5 => 'level'
);

$bind_slots = array(
  0 => 'Primary',
  1 => 'Secondary',
  2 => 'Tertiary',
  3 => 'Quaternary',
  4 => 'Home'
);

switch ($action) {
  case 0:  // View Player Profile
    check_admin_authorization();
    if ($playerid) {
      $body = new Template("templates/player/player.tmpl.php");
      $body->set('playerid', $playerid);
      $body->set('classes', $classes);
      $body->set('genders', $genders);
      $body->set('bodytypes', $bodytypes);
      $body->set('races', $races);
      $body->set('yesno', $yesno);
      $body->set('skilltypes', $skilltypes);
      $body->set('langtypes', $langtypes);
      $body->set('player_name', getPlayerName($playerid));
      $body->set('deities', $deities);
      $body->set('anonymity', $anonymity);
      $body->set('bind_slots', $bind_slots);
      $vars = player_info();
      if ($vars) {
        foreach ($vars as $key=>$value) {
          $body->set($key, $value);
        }
      }
    }
    else {
      $curr_page = (isset($_GET['page'])) ? $_GET['page'] : $default_page;
      $curr_size = (isset($_GET['size'])) ? $_GET['size'] : $default_size;
      $curr_sort = (isset($_GET['sort'])) ? $columns[$_GET['sort']] : $columns[$default_sort];
      $body = new Template("templates/player/player.default.tmpl.php");
      $page_stats = getPageInfo("character_data", FALSE, $curr_page, $curr_size, ((isset($_GET['sort'])) ? $_GET['sort'] : null));
      if ($page_stats['page']) {
        $players = get_players($page_stats['page'], $curr_size, $curr_sort);
      }
      if (isset($players)) {
        $body->set('players', $players);
        $body->set('classes', $classes);
        foreach ($page_stats as $key=>$value) {
          $body->set($key, $value);
        }
      }
      else {
        $body->set('page', 0);
        $body->set('pages', 0);
      }
    }
    break;
  case 1: // Edit Player Profile
    check_admin_authorization();
    $body = new Template("templates/player/player.edit.tmpl.php");
    $body->set('playerid', $playerid);
    $body->set('classes', $classes);
    $body->set('genders', $genders);
    $body->set('bodytypes', $bodytypes);
    $body->set('races', $races);
    $body->set('yesno', $yesno);
    $body->set('skilltypes', $skilltypes);
    $body->set('player_name', getPlayerName($playerid));
    $vars = player_info();
    if ($vars) {
      foreach ($vars as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
  case 2:  // Search Players
    check_admin_authorization();
    $body = new Template("templates/player/player.searchresults.tmpl.php");
    if (isset($_POST['playerid']) && $_POST['playerid'] != "Player ID") {
      $results = search_players_by_id();
    }
    else {
      $results = search_players_by_name();
    }
    $body->set("results", $results);
    break;
  case 3: // Update Player
    check_admin_authorization();
    update_player();
    header("Location: index.php?editor=player&playerid=$playerid");
    exit;
  case 4: // Delete Player
    check_admin_authorization();
    delete_player($playerid);
    if (isset($_GET['acctid'])) {
      header("Location: index.php?editor=account&acctid=$acctid");
    }
    else {
      header("Location: index.php?editor=player");
    }
    exit;
  case 5: // Edit Player Location
    check_admin_authorization();
    $cur_loc = get_player_location();
    $zonelist = get_zones();
    $body = new Template("templates/player/player.move.tmpl.php");
    $javascript = new Template("templates/player/js.tmpl.php");
    $body->set('playerid', $playerid);
    $body->set('cur_loc', $cur_loc);
    $body->set('zonelist', $zonelist['zones']);
    $javascript->set('zoneVersions', $zonelist['versions']);
    break;
  case 6: // Update Player Location
    check_admin_authorization();
    update_player_location();
    header("Location: index.php?editor=player&playerid=$playerid");
    exit;
  case 7: // Undelete Player
    check_admin_authorization();
    $playerid = $_GET['playerid'];
    undelete_player($playerid);
    header("Location: index.php?editor=player&playerid=$playerid");
    exit;
  case 8: // Add Exp Modifier
    check_admin_authorization();
    $zonelist = get_zones();
    $body = new Template("templates/player/exp.mod.add.tmpl.php");
    $javascript = new Template("templates/player/js.exp.mod.add.tmpl.php");
    $body->set('playerid', $playerid);
    $body->set('zonelist', $zonelist['zones']);
    $javascript->set('zoneVersions', $zonelist['versions']);
    break;
  case 9: // Edit Exp Modifier
    check_admin_authorization();
    $zonelist = get_zones();
    $exp_mods = get_exp_modifiers($_GET['playerid'], $_GET['zoneid'], $_GET['instance_version']);
    $body = new Template("templates/player/exp.mod.edit.tmpl.php");
    $javascript = new Template("templates/player/js.exp.mod.edit.tmpl.php");
    $body->set('playerid', $playerid);
    $body->set('zonelist', $zonelist['zones']);
    $body->set('exp_mods', $exp_mods);
    $javascript->set('zoneVersions', $zonelist['versions']);
    $javascript->set('exp_mods', $exp_mods);
    break;
  case 10: // Modify Exp Modifier
    check_admin_authorization();
    modify_exp_modifier();
    header("Location: index.php?editor=player&playerid=$playerid");
    exit;
  case 11: // Delete Exp Modifier
    check_admin_authorization();
    $playerid = $_GET['playerid'];
    $zoneid = $_GET['zoneid'];
    $instance_version = $_GET['instance_version'];
    delete_exp_modifier($playerid, $zoneid, $instance_version);
    header("Location: index.php?editor=player&playerid=$playerid");
    exit;
  case 12: // Toggle Character Exp Enabled
    check_admin_authorization();
    $playerid = $_GET['playerid'];
    toggle_exp_enabled($_GET['playerid']);
    header("Location: index.php?editor=player&playerid=$playerid");
    exit;
  case 13: // Character Stats Record
    check_admin_authorization();
    $breadcrumbs .= " >> Stats Record";
    $body = new Template("templates/player/player.stats.record.tmpl.php");
    $body->set('playerid', $playerid);
    $body->set('classes', $classes);
    $body->set('genders', $genders);
    $body->set('bodytypes', $bodytypes);
    $body->set('races', $races);
    $body->set('yesno', $yesno);
    $body->set('skilltypes', $skilltypes);
    $body->set('langtypes', $langtypes);
    $body->set('player_name', getPlayerName($playerid));
    $body->set('deities', $deities);
    $body->set('anonymity', $anonymity);
    $body->set('bind_slots', $bind_slots);
    $stats = character_stats_record();
    if ($stats) {
      foreach ($stats as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
  case 14: // Character Evolving Items
    check_admin_authorization();
    $breadcrumbs .= " >> Evolving Items";
    $body = new Template("templates/player/player.evolving.items.tmpl.php");
    $evolving = get_evolving_items($_GET['playerid']);
    $body->set('playerid', $_GET['playerid']);
    $body->set('yesno', $yesno);
    if ($evolving) {
      $body->set('evolving', $evolving);
    }
    break;
  case 15: // Edit Custom Pet Name
    check_admin_authorization();
    $body = new Template("templates/player/player.pet.name.tmpl.php");
    $breadcrumbs .= " >> Custom Pet Name";
    $body->set('playerid', $_GET['playerid']);
    $body->set('name', get_pet_name($_GET['playerid']));
    break;
  case 16: // Update Custom Pet Name
    check_admin_authorization();
    update_pet_name();
    $playerid = $_POST['playerid'];
    header("Location: index.php?editor=player&playerid=$playerid");
    exit();
  case 17: // Delete Custom Pet Name
    check_admin_authorization();
    $playerid = $_GET['playerid'];
    delete_pet_name($playerid);
    header("Location: index.php?editor=player&playerid=$playerid");
    exit();
  case 18: // Toggle Character PVP
    check_admin_authorization();
    $playerid = $_GET['playerid'];
    toggle_pvp_status($_GET['playerid']);
    header("Location: index.php?editor=player&playerid=$playerid");
    exit;
}

function get_players($page_number, $results_per_page, $sort_by) {
  global $mysql;
  $limit = ($page_number - 1) * $results_per_page . "," . $results_per_page;

  $query = "SELECT id, account_id, name, level, class FROM character_data ORDER BY $sort_by LIMIT $limit";
  $results = $mysql->query_mult_assoc($query);

  return $results;
}

function player_info() {
  global $mysql, $playerid;
  $player_array = array();
  $skills = array();
  $languages = array();

  //Load from character_data
  $query = "SELECT * FROM character_data WHERE id=$playerid";
  $player_array = $mysql->query_assoc($query);

  //Load from character_skills
  $query = "SELECT * FROM character_skills WHERE id = $playerid";
  $results = $mysql->query_mult_assoc($query);
  if ($results) {
    foreach ($results as $result) {
      $skill_id = $result['skill_id'];
      $value = $result['value'];
      $skills[$skill_id] = $value;
    }
  }
  $player_array['skills'] = $skills;

  //Load from character_languages
  $query = "SELECT * FROM character_languages WHERE id = $playerid";
  $results = $mysql->query_mult_assoc($query);
  if ($results) {
    foreach ($results as $result) {
      $lang_id = $result['lang_id'];
      $value = $result['value'];
      $languages[$lang_id] = $value;
    }
  }
  $player_array['languages'] = $languages;

  //Load from character_bind
  $query = "SELECT * FROM character_bind WHERE id = $playerid";
  $result = $mysql->query_mult_assoc($query);
  $player_array['binds'] = $result;

  //Load from character_alternate_abilities
  $query = "SELECT * FROM character_alternate_abilities WHERE id = $playerid";
  $result = $mysql->query_mult_assoc($query);
  $player_array['alternate_abilities'] = $result;

  //Load from character_auras
  $query = "SELECT * FROM character_auras WHERE id = $playerid";
  $result = $mysql->query_mult_assoc($query);
  $player_array['auras'] = $result;

  //Load from character_currency
  $query = "SELECT * FROM character_currency WHERE id = $playerid";
  $result = $mysql->query_assoc($query);
  $player_array['currency'] = $result;

  //Load from character_spells
  $query = "SELECT * FROM character_spells WHERE id = $playerid";
  $result = $mysql->query_mult_assoc($query);
  $player_array['spells'] = $result;

  //Load from character_memmed_spells
  $query = "SELECT * FROM character_memmed_spells WHERE id = $playerid";
  $result = $mysql->query_mult_assoc($query);
  $player_array['memmed_spells'] = $result;

  //Load from character_disciplines
  $query = "SELECT * FROM character_disciplines WHERE id = $playerid";
  $result = $mysql->query_mult_assoc($query);
  $player_array['disciplines'] = $result;

  //Load from character_material
  $query = "SELECT * FROM character_material WHERE id = $playerid";
  $result = $mysql->query_mult_assoc($query);
  $player_array['material'] = $result;

  //Load from character_tribute
  $query = "SELECT * FROM character_tribute WHERE character_id = $playerid";
  $result = $mysql->query_mult_assoc($query);
  $player_array['tribute'] = $result;

  //Load from character_bandolier
  $query = "SELECT * FROM character_bandolier WHERE id = $playerid ORDER BY bandolier_id, bandolier_slot";
  $result = $mysql->query_mult_assoc($query);
  $player_array['bandolier'] = $result;

  //Load from character_inspect_messages
  $query = "SELECT * FROM character_inspect_messages WHERE id = $playerid";
  $result = $mysql->query_assoc($query);
  if ($result) {
    $player_array['inspect_message'] = $result['inspect_message'];
  }

  //Load from character_leadership_abilities
  $query = "SELECT * FROM character_leadership_abilities WHERE id = $playerid";
  $result = $mysql->query_mult_assoc($query);
  $player_array['leadership_abilities'] = $result;

  //Load account details
  $accountid = $player_array['account_id'];
  $query = "SELECT name, lsaccount_id, status, sharedplat FROM account WHERE id = $accountid";
  $result = $mysql->query_assoc($query);
  $player_array['lsname'] = $result['name'];
  $player_array['lsaccount'] = $result['lsaccount_id'];
  $player_array['status'] = $result['status'];
  $player_array['sharedplat'] = $result['sharedplat'];

  //Load guild details
  $query = "SELECT guild_id, `rank`, banker FROM guild_members WHERE char_id = $playerid";
  $result = $mysql->query_assoc($query);
  if ($result) {
    $player_array['guild_id'] = $result['guild_id'];
    $player_array['guild_rank'] = $result['rank'];
    $player_array['guild_banker'] = $result['banker'];
  }

  //Load from character_exp_modifiers
  $query = "SELECT * FROM character_exp_modifiers WHERE character_id = $playerid ORDER BY zone_id, instance_version";
  $results = $mysql->query_mult_assoc($query);
  if ($results) {
    $player_array['exp_mods'] = $results;
  }

  //Load custom pet name
  $player_array['pet_name'] = get_pet_name($playerid);

  return $player_array;
}

function update_player() {
  global $mysql, $playerid;

  $oldstats = player_info();
  extract($oldstats);

  $fields = '';
  //Set fields here
  $fields =  rtrim($fields, ", ");

  if ($fields != '') {
    $query = "UPDATE character_data SET $fields WHERE id=$playerid";
    $mysql->query_no_result($query);
  }
}

function get_player_location() {
  global $mysql, $playerid;

  $query = "SELECT zone_id, zone_instance, x, y, z FROM character_data WHERE id=$playerid";
  $result = $mysql->query_assoc($query);

  return $result;
}

function update_player_location() {
  global $mysql, $mysql_content_db;
  $playerid = $_POST['playerid'];
  $zoneid_token = strtok($_POST['zoneid'], ".");
  $zoneid = $zoneid_token;
  $zoneversion_token = strtok(".");
  $version = $zoneversion_token;
  $safe = $_POST['safe'];
  $new_x = $_POST['x'];
  $new_y = $_POST['y'];
  $new_z = $_POST['z'];

  if ($safe) {
    $query = "SELECT safe_x, safe_y, safe_z FROM zone WHERE zoneidnumber=$zoneid AND version=$version";
    $result = $mysql_content_db->query_assoc($query);
    $new_x = $result['safe_x'];
    $new_y = $result['safe_y'];
    $new_z = $result['safe_z'];
  }

  $query = "UPDATE character_data SET zone_id=$zoneid, zone_instance=$version, x=$new_x, y=$new_y, z=$new_z WHERE id=$playerid";
  $mysql->query_no_result($query);
}

function get_zones() {
  global $mysql_content_db;

  $query = "
    SELECT id, zoneidnumber, short_name, version, expansion 
    FROM zone z 
    JOIN (
      SELECT short_name as min_short_name, min(version) as min_v 
      FROM zone 
      GROUP BY min_short_name
    ) zone_min ON z.short_name = zone_min.min_short_name AND z.version = zone_min.min_v 
    ORDER BY z.short_name, z.version ASC
  ";
  $results = $mysql_content_db->query_mult_assoc($query);

  $versionQuery = "SELECT id, zoneidnumber, short_name, version FROM zone ORDER BY short_name ASC, version ASC";
  $versions = $mysql_content_db->query_mult_assoc($versionQuery);

  $zoneVersions = [];
  foreach ($versions as $version) {
    $zoneVersions[$version['zoneidnumber']][] = $version['version'];
  }

  return [
    'zones' => $results, 
    'versions' => $zoneVersions
  ];
}

function undelete_player($playerid) {
  global $mysql;
  $deleted_name = getPlayerName($playerid);
  $restored_name = substr($deleted_name, 0, stripos($deleted_name, "-deleted"));

  $query = "UPDATE character_data SET name=\"$restored_name\", deleted_at=NULL WHERE id=$playerid";
  $mysql->query_no_result($query);
}

function get_exp_modifiers($character_id, $zone_id, $instance_version) {
  global $mysql;

  $query = "SELECT * FROM character_exp_modifiers WHERE character_id=$character_id AND zone_id=$zone_id AND instance_version=$instance_version";
  $result = $mysql->query_assoc($query);

  if ($result) {
    return $result;
  }
  else {
    return null;
  }
}

function modify_exp_modifier() {
  global $mysql;

  $character_id = $_POST['character_id'];
  $zone_id = $_POST['zone_id'];
  $instance_version = $_POST['instance_version'];
  $exp_modifier = $_POST['exp_modifier'];
  $aa_modifier = $_POST['aa_modifier'];

  $query = "REPLACE INTO character_exp_modifiers SET character_id=$character_id, zone_id=$zone_id, instance_version=$instance_version, exp_modifier=$exp_modifier, aa_modifier=$aa_modifier";
  $mysql->query_no_result($query);
}

function delete_exp_modifier($character_id, $zone_id, $instance_version) {
  global $mysql;

  $query = "DELETE FROM character_exp_modifiers WHERE character_id=$character_id AND zone_id=$zone_id AND instance_version=$instance_version";
  $mysql->query_no_result($query);
}

function toggle_exp_enabled($playerid) {
  global $mysql;
  $enabled = 0;

  $query = "SELECT exp_enabled FROM character_data WHERE id=$playerid";
  $result = $mysql->query_assoc($query);

  if ($result['exp_enabled'] == 0) {
    $enabled = 1;
  }

  $query = "UPDATE character_data SET exp_enabled=$enabled WHERE id=$playerid";
  $mysql->query_no_result($query);
}

function character_stats_record() {
  global $mysql, $playerid;

  $query = "SELECT * FROM character_stats_record WHERE character_id=$playerid";
  $result = $mysql->query_assoc($query);

  if ($result) {
    return $result;
  }
  else {
    return null;
  }
}

function get_evolving_items($playerid) {
  global $mysql;
  $evolving_items = array();

  $query1 = "SELECT * FROM character_evolving_items WHERE character_id = $playerid AND deleted_at IS NULL";
  $results1 = $mysql->query_mult_assoc($query1);

  if ($results1) {
    $evolving_items['current'] = $results1;
  }

  $query2 = "SELECT * FROM character_evolving_items WHERE character_id = $playerid AND deleted_at IS NOT NULL";
  $results2 = $mysql->query_mult_assoc($query2);

  if ($results2) {
    $evolving_items['history'] = $results2;
  }

  if ($results1 || $results2) {
    return $evolving_items;
  }
  else {
    return null;
  }
}

function get_pet_name($character_id) {
  global $mysql;

  $query = "SELECT `name` FROM character_pet_name WHERE character_id=$character_id";
  $result = $mysql->query_assoc($query);

  if ($result) {
    return $result['name'];
  }
  else {
    return "N/A";
  }
}

function update_pet_name() {
  global $mysql;

  $playerid = $_POST['playerid'];
  $name = $_POST['name'];

  $query = "REPLACE INTO character_pet_name SET character_id=$playerid, `name`='$name'";
  $mysql->query_no_result($query);
}

function delete_pet_name($character_id) {
  global $mysql;

  $query = "DELETE FROM character_pet_name WHERE character_id=$character_id";
  $mysql->query_no_result($query);
}

function toggle_pvp_status($playerid) {
  global $mysql;
  $enabled = 0;

  $query = "SELECT pvp_status FROM character_data WHERE id=$playerid";
  $result = $mysql->query_assoc($query);

  if ($result['pvp_status'] == 0) {
    $enabled = 1;
  }

  $query = "UPDATE character_data SET pvp_status=$enabled WHERE id=$playerid";
  $mysql->query_no_result($query);
}
?>
