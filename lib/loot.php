<?php

$normalize_amount = 10;

switch ($action) {
  case 0:  // View Loottable
    if ($npcid) {
      $body = new Template("templates/loot/loottable.tmpl.php");
      $body->set('currzone', $z);
      $body->set('currzoneid', $zoneid);
      $body->set('npcid', $npcid);
      $body->set('npc_name', getNPCName($npcid));
      $body->set('normalize_amount', $normalize_amount);
      $vars = loottable_info();
      if ($vars) {
        foreach ($vars as $key=>$value) {
          $body->set($key, $value);
        }
      }
      $usage = mobs_using_loottable();
      $body->set('usage', $usage);
    }
    break;
  case 1:  // Edit loottable
    check_authorization();
    $body = new Template("templates/loot/loottable.edit.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    $body->set('npc_name', getNPCName($npcid));
    $vars = loottable_info();
    foreach ($vars as $key=>$value) {
      $body->set($key, $value);
    }
    break;
  case 2:  // Update loottable info
    check_authorization();
    update_loottable();
    header("Location: index.php?editor=loot&z=$z&zoneid=$zoneid&npcid=$npcid");
    exit;
  case 3:  // Edit Lootdrop name
    check_authorization();
    $body = new Template("templates/loot/lootdrop.edit.name.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    $body->set('ldid', $_GET['ldid']);
    $body->set('ldname', getLootdropName($_GET['ldid']));
    $vars = loottable_info();
    foreach ($vars as $key=>$value) {
      $body->set($key, $value);
    }
    break;
  case 4:  // Update Lootdrop Name
    check_authorization();
    update_lootdrop_name();
    header("Location: index.php?editor=loot&z=$z&zoneid=$zoneid&npcid=$npcid");
    exit;
  case 5:  // Edit Lootdrop Item page
    check_authorization();
    $body = new Template("templates/loot/lootdrop.edit.item.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    $body->set('ldid', $_GET['ldid']);
    $body->set('itemid', $_GET['itemid']);
    $body->set('ldname', getLootdropName($_GET['ldid']));
    $vars = lootdrop_info();
    foreach ($vars as $key=>$value) {
      $body->set($key, $value);
    }
    break;
  case 6:  // Update lootdrop item
    check_authorization();
    update_lootdrop_item();
    header("Location: index.php?editor=loot&z=$z&zoneid=$zoneid&npcid=$npcid");
    exit;
  case 7:  // Edit loottable entry
    check_authorization();
    $body = new Template("templates/loot/lootdrop.edit.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    $body->set('ltid', $_GET['ltid']);
    $body->set('ldid', $_GET['ldid']);
    $body->set('ltname', getLootdropName($_GET['ldid']));
    $vars = loottable_entries_info();
    foreach ($vars as $key=>$value) {
      $body->set($key, $value);
    }
    break;
  case 8:  // Update loottable entry
    check_authorization();
    update_loottable_entries();
    header("Location: index.php?editor=loot&z=$z&zoneid=$zoneid&npcid=$npcid");
    exit;
  case 9:  // Add new loottable
    check_authorization();
    $body = new Template("templates/loot/loottable.add.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    $vars = suggest_new_loottable();
    foreach ($vars as $key=>$value) {
      $body->set($key, $value);
    }
    break;
  case 10: // Insert new loottable
    check_authorization();
    add_loottable();
    header("Location: index.php?editor=loot&z=$z&zoneid=$zoneid&npcid=$npcid");
    exit;
  case 11: // Change loottable
    check_authorization();
    $body = new Template("templates/loot/loottable.change.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    break;
  case 12: // Change by ID
    check_authorization();
    $body = new Template("templates/loot/loottable.changebyid.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    break;
  case 13:
    check_authorization();
    change_npc_loottable();
    header("Location: index.php?editor=loot&z=$z&zoneid=$zoneid&npcid=$npcid");
    exit;
  case 14: // Search Loottables
    check_authorization();
    $body = new Template("templates/loot/loottable.search.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    break;
  case 15: // Display Search Results
    check_authorization();
    $body = new Template("templates/loot/loottable.searchresults.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    $vars = search_loottable_names($_POST['search']);
    $body->set('results', $vars);
    break;
  case 16: // Delete Loottable
    check_authorization();
    delete_loottable($_GET['ltid']);
    header("Location: index.php?editor=loot&z=$z&zoneid=$zoneid&npcid=$npcid");
    exit;
  case 17: // Delete Lootdrop Item
    check_authorization();
    delete_lootdrop_item();
    header("Location: index.php?editor=loot&z=$z&zoneid=$zoneid&npcid=$npcid");
    exit;
  case 18: // Normalize Drops
    check_authorization();
    normalize_drops();
    header("Location: index.php?editor=loot&z=$z&zoneid=$zoneid&npcid=$npcid");
    exit;
  case 19: // Remove Lootdrop
    check_authorization();
    remove_lootdrop_from_loottable();
    header("Location: index.php?editor=loot&z=$z&zoneid=$zoneid&npcid=$npcid");
    exit;
  case 20:  // Add lootdrop item
    check_authorization();
    $javascript .= file_get_contents("templates/iframes/js.tmpl.php");
    $body = new Template("templates/loot/lootdrop.item.add.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    $body->set('ldid', $_GET['ldid']);
    break;
  case 21: // Add lootdrop item
    check_authorization();
    add_lootdrop_item($_REQUEST['itemid']);
    header("Location: index.php?editor=loot&z=$z&zoneid=$zoneid&npcid=$npcid");
    exit;
  case 22:  // Change lootdrop
    check_authorization();
    $body = new Template("templates/loot/lootdrop.change.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    $body->set('ltid', $_GET['ltid']);
    break;
  case 23:  // Add lootdrop by id
    check_authorization();
    $body = new Template("templates/loot/lootdrop.changebyid.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    $body->set('ltid', $_GET['ltid']);
    break;
  case 24: // Assign Lootdrop
    check_authorization();
    assign_lootdrop();
    header("Location: index.php?editor=loot&z=$z&zoneid=$zoneid&npcid=$npcid");
    exit;
  case 25: // Search Loot Item
    check_authorization();
    $body = new Template("templates/loot/lootdrop.search.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    $body->set('ltid', $_GET['ltid']);
    break;
  case 26: // Delete Lootdrop
    check_authorization();
    delete_lootdrop();
    header("Location: index.php?editor=loot&z=$z&zoneid=$zoneid&npcid=$npcid");
    exit;
  case 27:
    check_authorization();
    //search_lootdrops(); <- Incorrect function call?
    header("Location: index.php?editor=loot&z=$z&zoneid=$zoneid&npcid=$npcid");
    exit;
  case 28: // Display Search Results
    check_authorization();
    $body = new Template("templates/loot/lootdrop.searchresults.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    $body->set('ltid', $_GET['ltid']);
    $vars = search_lootdrops($_POST['search']);
    $body->set('results', $vars);
    break;
  case 29:  // Add lootdrop by id
    check_authorization();
    $body = new Template("templates/loot/lootdrop.changebysearch.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    $body->set('ltid', $_GET['ltid']);
    $body->set('ldid', $_GET['ldid']);
    break;
  case 30:  // Add new loottable
    check_authorization();
    $body = new Template("templates/loot/lootdrop.add.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    $body->set('ltid', $_GET['ltid']);
    $vars = suggest_new_lootdrop();
    foreach ($vars as $key=>$value) {
      $body->set($key, $value);
    }
    break;
  case 31: 
    check_authorization();
    create_lootdrop();
    assign_lootdrop();
    header("Location: index.php?editor=loot&z=$z&zoneid=$zoneid&npcid=$npcid");
    exit;
  case 32:  // Search npc by item
    check_authorization();
    $body = new Template("templates/loot/loot.searchresults.tmpl.php");
    $results = search_loot_by_item();
    $body->set("results", $results);
    break;
  case 33:
    check_authorization(); 
    $body = new Template("templates/loot/loottablebylootdrop.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $_GET['npcid']);
    $body->set('ldid', $_GET['ldid']);
    $ldrop = loottables_using_lootdrop();
    $body->set("ldrop", $ldrop);
    break;
  case 34:  // Drop loottable
    check_authorization();
    drop_loottable();
    header("Location: index.php?editor=loot&z=$z&zoneid=$zoneid&npcid=$npcid");
    exit;
  case 35:  // Copy lootdrop
    check_authorization();
    copy_lootdrop();
    header("Location: index.php?editor=loot&z=$z&zoneid=$zoneid&npcid=$npcid");
    exit;
  case 36:  // Mass change loottable 
    check_authorization();
    $body = new Template("templates/loot/loottable.masschange.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    $body->set('ltid', $_GET['ltid']);
    break;
  case 37:  // Change Loottable by Name
    check_authorization();
    $body = new Template("templates/loot/loottable.changebyname.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    $body->set('ltid', $_GET['ltid']);
    break;
  case 38:  // Change Loottable by Race
    check_authorization();
    $body = new Template("templates/loot/loottable.changebyrace.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    $body->set('races', $races);
    $body->set('ltid', $_GET['ltid']);
    break;
  case 39:  // Change loottable by NPC Name
    check_authorization();
    change_loottable_byname();
    header("Location: index.php?editor=loot&z=$z&zoneid=$zoneid&npcid=$npcid");
    exit;
  case 40:  // Change loottable by NPC Race
    check_authorization();
    change_loottable_byrace();
    header("Location: index.php?editor=loot&z=$z&zoneid=$zoneid&npcid=$npcid");
    exit;
  case 41:  // Merge LootDrop
    check_authorization();
    $body = new Template("templates/loot/lootdrop.merge.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    $body->set('ldid', $_GET['ldid']);
    break;
  case 42:  // Merge
    check_authorization();
    merge_lootdrop();
    header("Location: index.php?editor=loot&z=$z&zoneid=$zoneid&npcid=$npcid");
    exit;
  case 43:  // Move multiplier to items
    check_authorization();
    move_multiplier();
    header("Location: index.php?editor=loot&z=$z&zoneid=$zoneid&npcid=$npcid");
    exit;
  case 44:  // Disable Lootdrop Item
    check_authorization();
    disable_lootdrop_item();
    header("Location: index.php?editor=loot&z=$z&zoneid=$zoneid&npcid=$npcid");
    exit;
  case 45:  // Enable Lootdrop Item
    check_authorization();
    enable_lootdrop_item();
    header("Location: index.php?editor=loot&z=$z&zoneid=$zoneid&npcid=$npcid");
    exit;
  case 46:  // Magelo import
    check_authorization();
    magelo_import();
    header("Location: index.php?editor=loot&z=$z&zoneid=$zoneid&npcid=$npcid");
    exit;
  case 47:  //Move Lootdrop Item page
    check_authorization();
    $body = new Template("templates/loot/lootdrop.move.item.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    $body->set('ldid', $_GET['ldid']);
    $body->set('itemid', $_GET['itemid']);
    $body->set('ldname', getLootdropName($_GET['ldid']));
    $vars = lootdrop_info();
    foreach ($vars as $key=>$value) {
      $body->set($key, $value);
    }
    break;
  case 48:  // Move lootdrop item
    check_authorization();
    move_copy_lootdrop_item();
    header("Location: index.php?editor=loot&z=$z&zoneid=$zoneid&npcid=$npcid");
    exit;
}

function loottable_info() {
  global $mysql, $npcid;
  
  $count = 0;

  $query = "SELECT loottable_id
            FROM npc_types
            WHERE id=$npcid";
  $result = $mysql->query_assoc($query);
  
  if ($result['loottable_id'] == 0) return false;
  else {
    $query = "SELECT npc_types.id AS npcid, npc_types.name AS npc_name,
              npc_types.loottable_id, loottable.name AS loottable_name,
              loottable.mincash, loottable.maxcash, loottable.avgcoin
              FROM npc_types LEFT JOIN loottable
              ON loottable.id=npc_types.loottable_id
              WHERE npc_types.id=$npcid";
    $result = $mysql->query_assoc($query);
    $loottable = $result['loottable_id'];
    $array = $result;

    $query2 = "SELECT *
               FROM loottable_entries, lootdrop
               WHERE loottable_entries.loottable_id='$loottable'
               AND loottable_entries.lootdrop_id=lootdrop.id";
    $result2 = $mysql->query_mult_assoc($query2);
    if (!$result2) {
      $array['lootdrop_count'] = 0;
      $array['lootdrops'] = '';
      return $array;
    }
    foreach ($result2 as $row2) {
      $count++;
      $lootdrop = $row2['lootdrop_id'];
      $query3 = "SELECT * FROM lootdrop_entries WHERE lootdrop_id='$lootdrop'";
      $result3 = $mysql->query_mult_assoc($query3);
      if ($result3) {
        foreach ($result3 as $row3) {
          $row2['items'][] = $row3;
        }
      }
      $array2[] = $row2;
    }

    $array['lootdrop_count'] = $count;
    $array['lootdrops'] = $array2;

    return $array;
  }
}

function mobs_using_loottable() {
  global $mysql, $npcid;

  $query = "SELECT loottable_id
            FROM npc_types
            WHERE id=$npcid";
  $result = $mysql->query_assoc($query);
  $ltid = $result['loottable_id'];

  if($ltid > 0){
  $query = "SELECT id, name FROM npc_types WHERE loottable_id=$ltid";
  $results = $mysql->query_mult_assoc($query);
  $count = count($results);
  return array("count"=>$count, "mobs"=>$results);
  }
}

function loottables_using_lootdrop() {
  global $mysql;
  $array = array();
  $ldid = $_GET['ldid'];

  $query = "SELECT loottable_entries.loottable_id AS loottid, loottable.name AS loottname, npc_types.id AS npcid
            FROM loottable_entries
            INNER JOIN loottable ON loottable.id = loottable_entries.loottable_id
            INNER JOIN npc_types ON npc_types.loottable_id = loottable.id 
            WHERE loottable_entries.lootdrop_id=$ldid";
  $results = $mysql->query_mult_assoc($query);
  return $results;
  }

function update_loottable() {
  check_authorization();
  global $mysql;
  $id = $_POST['loottable_id'];
  $name = $_POST['name'];
  $mincash = $_POST['mincash'];
  $maxcash = $_POST['maxcash'];
  $avgcoin = $_POST['avgcoin'];
  
  $query = "UPDATE loottable SET name=\"$name\", mincash=\"$mincash\", maxcash=\"$maxcash\", avgcoin=\"$avgcoin\" WHERE id=$id";
  $mysql->query_no_result($query);
}

function add_loottable() {
  check_authorization();
  global $mysql, $npcid;
  $id = $_POST['id'];
  $name = $_POST['name'];
  $mincash = $_POST['mincash'];
  $maxcash = $_POST['maxcash'];
  $avgcoin = $_POST['avgcoin'];

  $query = "INSERT INTO loottable SET id=$id, name=\"$name\", mincash=\"$mincash\", maxcash=\"$maxcash\", avgcoin=\"$avgcoin\"";
  $mysql->query_no_result($query);
  
  change_npc_loottable();
}

function change_npc_loottable() {
  check_authorization();
  global $mysql, $npcid;
  $id = $_REQUEST['id'];
  $query = "UPDATE npc_types SET loottable_id=$id WHERE id=$npcid";
  $mysql->query_no_result($query);
}

function change_loottable_byname() {
  check_authorization();
  global $mysql, $npcid, $z;
  $zid = getZoneID($z);
  $min_id = $zid*1000-1;
  $max_id = $zid*1000+1000;
  $ltid = $_GET['ltid'];
  $npcname = $_POST['npcname'];
  $updateall = $_POST['updateall'];
 
  if($updateall == 0){
  $query = "UPDATE npc_types SET loottable_id=$ltid WHERE name like \"%$npcname%\" AND id > $min_id AND id < $max_id AND loottable_id = 0";
  $mysql->query_no_result($query);
  }

  if($updateall == 1){
  $query = "UPDATE npc_types SET loottable_id=$ltid WHERE name like \"%$npcname%\" AND id > $min_id AND id < $max_id";
  $mysql->query_no_result($query);
  }
}

function change_loottable_byrace() {
  check_authorization();
  global $mysql, $npcid, $z;
  $zid = getZoneID($z);
  $min_id = $zid*1000-1;
  $max_id = $zid*1000+1000;
  $ltid = $_GET['ltid'];
  $npcrace = $_POST['npcrace'];
  $updateall = $_POST['updateall'];
 
  if($updateall == 0){
  $query = "UPDATE npc_types SET loottable_id=$ltid WHERE race = $npcrace AND id > $min_id AND id < $max_id AND loottable_id = 0";
  $mysql->query_no_result($query);
  }

  if($updateall == 1){
  $query = "UPDATE npc_types SET loottable_id=$ltid WHERE race = $npcrace AND id > $min_id AND id < $max_id";
  $mysql->query_no_result($query);
  }
}

function suggest_new_loottable() {
  global $mysql, $npcid;
  $query = "SELECT MAX(id) AS id FROM loottable";
  $result = $mysql->query_assoc($query);
  $id = $result['id'] + 1;
  
  $name = getNPCName($npcid);
  return array("id"=>$id, "name"=>$name);
}

function lootdrop_info() {
  global $mysql;
  $ldid = $_GET['ldid'];
  $itemid = $_GET['itemid'];
  $query = "SELECT * FROM lootdrop_entries WHERE lootdrop_id=$ldid AND item_id=$itemid";
  $result = $mysql->query_assoc($query);
  return $result;
}

function update_lootdrop_item() {
  check_authorization();
  global $mysql;
  $ldid = $_GET['ldid'];
  $itemid = $_GET['itemid'];
  $equip = $_POST['equip_item'];
  $charges = $_POST['charges'];
  $chance = $_POST['chance'];
  $minlevel = $_POST['minlevel'];
  $maxlevel = $_POST['maxlevel'];
  $multiplier = $_POST['multiplier'];
  $query = "UPDATE lootdrop_entries SET equip_item=$equip, item_charges=$charges, chance=$chance, minlevel=$minlevel, maxlevel=$maxlevel, multiplier=$multiplier WHERE lootdrop_id=$ldid AND item_id=$itemid";
  $mysql->query_no_result($query);

}

function getLootdropName($id) {
  global $mysql;
  $query = "SELECT name FROM lootdrop WHERE id=$id";
  $result = $mysql->query_assoc($query);
  return $result['name'];
}

function getLoottableName($id) {
  global $mysql;
  $query = "SELECT name FROM loottable WHERE id=$id";
  $result = $mysql->query_assoc($query);
  return $result['name'];
}

function update_lootdrop_name() {
  check_authorization();
  global $mysql;
  $ldname = $_POST['ldname'];
  $ldid = $_GET['ldid'];
  $query = "UPDATE lootdrop SET name=\"$ldname\" WHERE id=$ldid";
  $mysql->query_no_result($query);
}

function loottable_entries_info() {
  global $mysql;
  $ltid = $_GET['ltid'];
  $ldid = $_GET['ldid'];
  $query = "SELECT * FROM loottable_entries WHERE loottable_id=$ltid AND lootdrop_id=$ldid";
  $result = $mysql->query_assoc($query);
  return $result;
}

function update_loottable_entries() {
  check_authorization();
  global $mysql;
  $droplimit = $_POST['droplimit'];
  $mindrop = $_POST['mindrop'];
  $multiplier = $_POST['multiplier'];
  $ltid = $_GET['ltid'];
  $ldid = $_GET['ldid'];
  $probability = $_POST['probability'];
  $query = "UPDATE loottable_entries SET droplimit=$droplimit, mindrop=$mindrop, multiplier=$multiplier, probability=$probability WHERE loottable_id=$ltid AND lootdrop_id=$ldid";
  $mysql->query_no_result($query);
}

function search_loottable_names($search) {
  global $mysql;
  $query = "SELECT * FROM loottable WHERE name rlike \"$search\"";
  $results = $mysql->query_mult_assoc($query);
  return $results;
}

function delete_loottable($id) {
  check_authorization();
  global $mysql, $npcid;

  $query = "DELETE FROM loottable WHERE id='$id'";
  $mysql->query_no_result($query);

  $query = "DELETE FROM loottable_entries WHERE loottable_id='$id'";
  $mysql->query_no_result($query);

  $query = "UPDATE npc_types SET loottable_id=0 WHERE id=$npcid";
  $mysql->query_no_result($query);

}

function delete_lootdrop_item() {
  check_authorization();
  global $mysql;
  $ldid = $_GET['ldid'];
  $itemid = $_GET['itemid'];
  
  $query = "DELETE FROM lootdrop_entries WHERE lootdrop_id='$ldid' AND item_id='$itemid'";
  $mysql->query_no_result($query);

}

function disable_lootdrop_item() {
  check_authorization();
  global $mysql;
  $ldid = $_GET['ldid'];
  $itemid = $_GET['itemid'];
  $chance = $_GET['chance'];
  
  $query = "UPDATE lootdrop_entries SET disabled_chance = $chance, chance = 0 WHERE lootdrop_id='$ldid' AND item_id='$itemid'";
  $mysql->query_no_result($query);

}

function enable_lootdrop_item() {
  check_authorization();
  global $mysql;
  $ldid = $_GET['ldid'];
  $itemid = $_GET['itemid'];
  $dchance = $_GET['dchance'];
  
  $query = "UPDATE lootdrop_entries SET disabled_chance = 0, chance = $dchance WHERE lootdrop_id='$ldid' AND item_id='$itemid'";
  $mysql->query_no_result($query);

}
function normalize_drops() {
  check_authorization();
  global $mysql, $normalize_amount;
  $ldid = $_GET['ldid'];
  
  $query = "UPDATE lootdrop_entries SET chance=$normalize_amount WHERE lootdrop_id=$ldid";
  $mysql->query_no_result($query);

}

function remove_lootdrop_from_loottable() {
  check_authorization();
  global $mysql;
  $ltid = $_GET['ltid'];
  $ldid = $_GET['ldid'];
  
  $query = "DELETE FROM loottable_entries WHERE lootdrop_id='$ldid' AND loottable_id='$ltid'";
  $mysql->query_no_result($query);
}

function add_lootdrop_item($itemid) {
  check_authorization();
  global $mysql;
  $ldid = $_GET['ldid'];
  $item_charges = $_POST['item_charges'];
  $multiplier = $_POST['multiplier'];
  $chance= $_POST['chance'];
  $eitem = 0;

  $query = "SELECT slots, augtype FROM items WHERE id=$itemid";
  $result = $mysql->query_assoc($query);

  $slots = $result['slots'];
  $augment = $result['augtype'];

  if ($slots && !$augment) {
    $eitem = 1;
  }

  $query = "INSERT INTO lootdrop_entries SET lootdrop_id=$ldid, item_id=$itemid, equip_item=$eitem, item_charges=$item_charges, multiplier=$multiplier, chance=$chance";
  $mysql->query_no_result($query);
  
}

function assign_lootdrop() {
  check_authorization();
  global $mysql;
  
  $ltid = $_POST['ltid'];
  $ldid = $_POST['ldid'];
  $droplimit = $_POST['droplimit'];
  $mindrop = $_POST['mindrop'];
  $multiplier = $_POST['multiplier'];
  $probability = $_POST['probability'];
  
  $query = "INSERT INTO loottable_entries SET loottable_id='$ltid', lootdrop_id='$ldid', droplimit='$droplimit', mindrop='$mindrop', multiplier='$multiplier', probability='$probability'";
  $mysql->query_no_result($query);
}

function delete_lootdrop() {
  check_authorization();
  global $mysql;
  $ldid = $_GET['ldid'];
  
  $query = "DELETE FROM loottable_entries WHERE lootdrop_id='$ldid'";
  $mysql->query_no_result($query);

  $query2 = "DELETE FROM lootdrop_entries WHERE lootdrop_id='$ldid'";
  $mysql->query_no_result($query2);

  $query3 = "DELETE FROM lootdrop WHERE id='$ldid'";
  $mysql->query_no_result($query3);
}

function search_lootdrops($search) {
  global $mysql;
  $query = "SELECT * FROM lootdrop WHERE name rlike \"$search\"";
  $results = $mysql->query_mult_assoc($query);
  return $results;
}

function suggest_new_lootdrop() {
  global $mysql, $npcid;
  $ltid = $_GET['ltid'];

  $query = "SELECT MAX(id) AS id FROM lootdrop";
  $result = $mysql->query_assoc($query);
  $id = $result['id'] + 1;

  $name = getNPCName($npcid);
  $name = $ltid . "_" . $name . "_";
  return array("id"=>$id, "name"=>$name);
}

function create_lootdrop() {
  check_authorization();
  global $mysql;
  $ldid = $_POST['ldid'];
  $name = $_POST['name'];

  $query = "INSERT INTO lootdrop SET id=$ldid, name=\"$name\"";
  $mysql->query_no_result($query);
}

function search_loot_by_item() {
  global $mysql;
  $search = $_GET['search'];


  $query = "SELECT npc_types.id,npc_types.name FROM lootdrop_entries
            INNER JOIN loottable_entries on lootdrop_entries.lootdrop_id = loottable_entries.lootdrop_id
            INNER JOIN npc_types on npc_types.loottable_id = loottable_entries.loottable_id
            INNER JOIN items on items.id = lootdrop_entries.item_id
            WHERE items.id = \"$search\"";
            // WHERE items.name rlike \"$search\" limit 50";
  $results = $mysql->query_mult_assoc($query);
  return $results;
}

function drop_loottable() {
  check_authorization();
  global $mysql, $npcid;

  $query = "UPDATE npc_types SET loottable_id=0 WHERE id=$npcid";
  $mysql->query_no_result($query);

}

function copy_lootdrop() {
  check_authorization();
  global $mysql;
  $ldid = $_GET['ldid'];
  $name = $_GET['name'];

  $query = "SELECT MAX(id) as lid FROM lootdrop";
  $result = $mysql->query_assoc($query);
  $nlid = $result['lid'] + 1;
  
  $query = "DELETE FROM loottable_entries WHERE lootdrop_id=0";
  $mysql->query_no_result($query);

  $query = "DELETE FROM lootdrop_entries WHERE lootdrop_id=0";
  $mysql->query_no_result($query);

  $newname = $name . '_' . $nlid;
  $query = "INSERT INTO lootdrop SET id=\"$nlid\", name=\"$newname\"";
  $mysql->query_no_result($query);

  $query = "INSERT INTO loottable_entries (loottable_id,droplimit,mindrop,multiplier,probability) 
            SELECT loottable_id,droplimit,mindrop,multiplier,probability FROM loottable_entries where lootdrop_id=$ldid";
  $mysql->query_no_result($query);

  $query = "INSERT INTO lootdrop_entries (item_id,item_charges,equip_item,chance,minlevel,maxlevel,multiplier) 
            SELECT item_id,item_charges,equip_item,chance,minlevel,maxlevel,multiplier FROM lootdrop_entries where lootdrop_id=$ldid";
  $mysql->query_no_result($query);

  $query = "UPDATE loottable_entries set lootdrop_id=$nlid where lootdrop_id=0";
  $mysql->query_no_result($query);

  $query = "UPDATE lootdrop_entries set lootdrop_id=$nlid where lootdrop_id=0";
  $mysql->query_no_result($query);
}

function merge_lootdrop() {
  check_authorization();
  global $mysql;

  $ldid = $_GET['ldid'];
  $lootdropid = $_POST['lootdropid'];

  $query = "UPDATE lootdrop_entries set lootdrop_id = $lootdropid WHERE lootdrop_id = $ldid";
  $mysql->query_no_result($query);

  $query = "DELETE FROM lootdrop WHERE id = $ldid";
  $mysql->query_no_result($query);

  $query = "DELETE FROM loottable_entries WHERE lootdrop_id = $ldid";
  $mysql->query_no_result($query);

  $query = "UPDATE loottable_entries SET droplimit = droplimit+1 WHERE lootdrop_id = $lootdropid";
  $mysql->query_no_result($query);

}

function move_multiplier() {
  check_authorization();
  global $mysql;

  $ldid = $_GET['ldid'];
  $multiplier = $_GET['multiplier'];

  $query = "UPDATE lootdrop_entries set multiplier = $multiplier WHERE lootdrop_id = $ldid";
  $mysql->query_no_result($query);

  $query = "UPDATE loottable_entries set multiplier = 1 WHERE lootdrop_id = $ldid";
  $mysql->query_no_result($query);
}

function magelo_import() {
  check_authorization();
  global $mysql, $npcid, $perl_path;

  $output = array();
  $output = exec("perl $perl_path/Loot.pl $npcid 2>&1");
  if (preg_match("(BEGIN failed)", $output)) {
    $error_msg = "Script failed to run.";
    if (preg_match("(line 6)", $output)) {
      $error_msg .= " HINT: Is DBI installed?";
    }
    if (preg_match("(line 7)", $output)) {
      $error_msg .= " HINT: Is DBD-mysql installed?";
    }
    logPerl($error_msg);
    logPerl("Error: " . $output);
  }
  else {
    logPerl($output);
  }
}

function move_copy_lootdrop_item() {
  check_authorization();
  global $mysql;
  $ldid = $_GET['ldid'];
  $itemid = $_GET['itemid'];
  $equip = $_POST['equip_item'];
  $charges = $_POST['charges'];
  $chance = $_POST['chance'];
  $minlevel = $_POST['minlevel'];
  $maxlevel = $_POST['maxlevel'];
  $multiplier = $_POST['multiplier'];
  $new_ldid = $_POST['movetolootdrop'];
  $move_copy_item = $_POST['move_copy_item'];
  if ($move_copy_item == 0) {
    $query1 = "DELETE FROM lootdrop_entries WHERE lootdrop_id='$ldid' AND item_id='$itemid'";
    $mysql->query_no_result($query1);
    
    $query2 = "INSERT INTO lootdrop_entries SET lootdrop_id=$new_ldid, item_id=$itemid, equip_item=$equip, item_charges=$charges, chance=$chance, minlevel=$minlevel, maxlevel=$maxlevel, multiplier=$multiplier";
    $mysql->query_no_result($query2);
  }
  if ($move_copy_item == 1) {
    $query = "INSERT INTO lootdrop_entries SET lootdrop_id=$new_ldid, item_id=$itemid, equip_item=$equip, item_charges=$charges, chance=$chance, minlevel=$minlevel, maxlevel=$maxlevel, multiplier=$multiplier";
    $mysql->query_no_result($query);
  }
}

?>