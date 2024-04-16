<?

$normalize_amount = 10;

switch ($action) {
  case 0:  // View Loottable
    if ($npcid || (isset($_GET['npc_id']) && $_GET['npc_id'] > 0)) {
      $body = new Template("templates/loot/loottable.tmpl.php");
      if (!$npcid) {
        $npcid = $_GET['npc_id'];
      }
      $z = get_zone_by_npcid($npcid);
      if ($z) {
        $zoneid = getZoneIDByName($z);
      }
      $body->set('z', $z);
      $body->set('zoneid', $zoneid);
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
      $usage = mobs_using_loottable();
      $body->set('usage', $usage);
      }
    }
    else {
      $body = new Template("templates/loot/loot.default.tmpl.php");
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
  case 5:  // Edit Lootdrop Item
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
  case 7:  // Edit loottable entry and lootdrop
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
    $body = new Template("templates/loot/loottable.search.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    break;
  case 15: // Display Search Results
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
    $javascript = new Template("templates/iframes/js.tmpl.php");
    $body = new Template("templates/loot/lootdrop.add.item.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    $body->set('ldid', $_GET['ldid']);
    break;
  case 21: // Insert lootdrop item
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
  case 30:  // Add new lootdrop
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
  case 47:  // Move Lootdrop Item
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
  case 49:  // View Global Loot
    $body = new Template("templates/loot/global.loot.view.tmpl.php");
    $breadcrumbs .= " >> Global Loot";
    $global_loot = global_loot_info();
    $body->set('yesno', $yesno);
    if ($global_loot) {
      $body->set('global_loot', $global_loot);
    }
    break;
  case 50:  // Add Global Loot
    check_authorization();
    $body = new Template("templates/loot/global.loot.add.tmpl.php");
    $breadcrumbs .= " >> <a href='index.php?editor=loot&action=49'>Global Loot</a> >> Add Global Loot";
    $loot_ids = suggest_next_global_loot();
    $body->set('new_id', $loot_ids['new_id']);
    $body->set('new_table_id', $loot_ids['new_table_id']);
    $body->set('races', $races);
    $body->set('classes', $classes);
    $body->set('bodytypes', $bodytypes);
    $body->set('zoneids', $zoneids);
    break;
  case 51:  // Insert Global Loot
    check_authorization();
    insert_global_loot();
    $id = $_POST['id'];
    header("Location: index.php?editor=loot&id=$id&action=55");
    exit;
  case 52:  // Edit Global Loot
    check_authorization();
    $body = new Template("templates/loot/global.loot.edit.tmpl.php");
    $breadcrumbs .= " >> <a href='index.php?editor=loot&action=49'>Global Loot</a> >> Edit Global Loot";
    $body->set('races', $races);
    $body->set('classes', $classes);
    $body->set('bodytypes', $bodytypes);
    $body->set('zoneids', $zoneids);
    $global_loot = getGlobalLoot($_GET['id']);
    if ($global_loot) {
      foreach ($global_loot as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
  case 53:  // Update Global Loot
    check_authorization();
    update_global_loot();
    $id = $_POST['id'];
    header("Location: index.php?editor=loot&id=$id&action=55");
    exit;
  case 54:  // Delete Global Loot
    check_authorization();
    delete_global_loot();
    header("Location: index.php?editor=loot&action=49");
    exit;
  case 55:  // View Global Loottable
    $body = new Template("templates/loot/global.loottable.view.tmpl.php");
    $breadcrumbs .= " >> <a href='index.php?editor=loot&action=49'>Global Loot</a> >> View Global Loottable";
    $body->set('yesno', $yesno);
    $body->set('normalize_amount', $normalize_amount);
    $global_loot = getGlobalLoot($_GET['id']);
    $body->set('global_loot', $global_loot);
    $global_loottable = global_loottable_info($_GET['id']);
    if ($global_loottable) {
      foreach ($global_loottable as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
  case 56: // Edit Global Loottable
    check_authorization();
    $breadcrumbs .= " >> <a href='index.php?editor=loot&action=49'>Global Loot</a> >> Edit Global Loottable";
    $body = new Template("templates/loot/global.loottable.edit.tmpl.php");
    $body->set('global_loot', $_GET['id']);
    $vars = global_loottable_info($_GET['id']);
    foreach ($vars as $key=>$value) {
      $body->set($key, $value);
    }
    break;
  case 57: // Update Global Loottable
    check_authorization();
    update_global_loottable();
    $id = $_POST['global_loot'];
    header("Location: index.php?editor=loot&id=$id&action=55");
    exit;
  case 58: // Delete Global Loottable
    check_authorization();
    $id = $_GET['id'];
    delete_global_loottable($id);
    header("Location: index.php?editor=loot&id=$id&action=55");
    exit;
  case 59: // Create Empty Global Loottable
    check_authorization();
    $id = $_GET['id'];
    create_empty_loottable($id);
    header("Location: index.php?editor=loot&id=$id&action=55");
    exit;
  case 60:  // Add Global Lootdrop
    check_authorization();
    $body = new Template("templates/loot/global.lootdrop.add.tmpl.php");
    $breadcrumbs .= " >> <a href='index.php?editor=loot&action=49'>Global Loot</a> >> Add Global Lootdrop";
    $body->set('global_loot', $_GET['id']);
    $body->set('loottable_id', $_GET['ltid']);
    $lootdrop_id = suggest_next_global_lootdrop();
    $body->set('lootdrop_id', $lootdrop_id);
    break;
  case 61: // Insert Global Lootdrop
    check_authorization();
    insert_global_lootdrop();
    $id = $_POST['global_loot'];
    header("Location: index.php?editor=loot&id=$id&action=55");
    exit;
  case 62: // Edit Global Lootdrop
    check_authorization();
    $breadcrumbs .= " >> <a href='index.php?editor=loot&action=49'>Global Loot</a> >> Edit Global Lootdrop";
    $body = new Template("templates/loot/global.lootdrop.edit.tmpl.php");
    $body->set('global_loot', $_GET['id']);
    $lootdrop = global_lootdrop_info();
    foreach ($lootdrop as $key=>$value) {
      $body->set($key, $value);
    }
    break;
  case 63: // Update Global Lootdrop
    check_authorization();
    update_global_lootdrop();
    $id = $_POST['global_loot'];
    header("Location: index.php?editor=loot&id=$id&action=55");
    exit;
  case 64: // Delete Global Lootdrop
    check_authorization();
    delete_global_lootdrop();
    $id = $_GET['id'];
    header("Location: index.php?editor=loot&id=$id&action=55");
    exit;
  case 65:  // Add Global Lootdrop Item
    check_authorization();
    $breadcrumbs .= " >> <a href='index.php?editor=loot&action=49'>Global Loot</a> >> Add Global Lootdrop Item";
    $body = new Template("templates/loot/global.lootdrop.add.item.tmpl.php");
    $javascript = new Template("templates/iframes/js.tmpl.php");
    $body->set('global_loot', $_GET['id']);
    $body->set('ldid', $_GET['ldid']);
    break;
  case 66: // Insert Global Lootdrop Item
    check_authorization();
    insert_global_lootdrop_item();
    $id = $_POST['global_loot'];
    header("Location: index.php?editor=loot&id=$id&action=55");
    exit;
  case 67: // Edit Global Lootdrop Item
    check_authorization();
    $body = new Template("templates/loot/global.lootdrop.edit.item.tmpl.php");
    $body->set('global_loot', $_GET['id']);
    $body->set('ldid', $_GET['ldid']);
    $body->set('itemid', $_GET['itemid']);
    $body->set('ldname', getLootdropName($_GET['ldid']));
    $vars = lootdrop_info();
    foreach ($vars as $key=>$value) {
      $body->set($key, $value);
    }
    break;
  case 68: // Update Global Lootdrop Item
    check_authorization();
    update_lootdrop_item();
    $id = $_POST['global_loot'];
    header("Location: index.php?editor=loot&id=$id&action=55");
    exit;
  case 69: // Delete Global Lootdrop Item
    check_authorization();
    delete_lootdrop_item();
    $id = $_GET['id'];
    header("Location: index.php?editor=loot&id=$id&action=55");
    exit;
  case 70:  // Disable Global Lootdrop Item
    check_authorization();
    disable_lootdrop_item();
    $id = $_GET['id'];
    header("Location: index.php?editor=loot&id=$id&action=55");
    exit;
  case 71:  // Enable Global Lootdrop Item
    check_authorization();
    enable_lootdrop_item();
    $id = $_GET['id'];
    header("Location: index.php?editor=loot&id=$id&action=55");
    exit;
  case 72: // Normalize Global Lootdrops
    check_authorization();
    normalize_drops();
    $id = $_GET['id'];
    header("Location: index.php?editor=loot&id=$id&action=55");
    exit;
}

function loottable_info() {
  global $mysql_content_db, $npcid;
  $count = 0;

  $query = "SELECT loottable_id FROM npc_types WHERE id=$npcid";
  $result = $mysql_content_db->query_assoc($query);
  
  if (!$result || $result['loottable_id'] == 0) {
    return false;
  }
  else {
    $query = "SELECT npc_types.id AS npcid, npc_types.name AS npc_name,
              npc_types.loottable_id, loottable.name AS loottable_name,
              loottable.mincash, loottable.maxcash, loottable.avgcoin,
              loottable.min_expansion, loottable.max_expansion,
              loottable.content_flags, loottable.content_flags_disabled
              FROM npc_types LEFT JOIN loottable
              ON loottable.id=npc_types.loottable_id
              WHERE npc_types.id=$npcid";
    $result = $mysql_content_db->query_assoc($query);
    $loottable = $result['loottable_id'];
    $array = $result;

    $query2 = "SELECT *
               FROM loottable_entries, lootdrop
               WHERE loottable_entries.loottable_id='$loottable'
               AND loottable_entries.lootdrop_id=lootdrop.id";
    $result2 = $mysql_content_db->query_mult_assoc($query2);
    if (!$result2) {
      $array['lootdrop_count'] = 0;
      $array['lootdrops'] = '';
      return $array;
    }
    foreach ($result2 as $row2) {
      $count++;
      $lootdrop = $row2['lootdrop_id'];
      $query3 = "SELECT * FROM lootdrop_entries WHERE lootdrop_id='$lootdrop'";
      $result3 = $mysql_content_db->query_mult_assoc($query3);
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
  global $mysql_content_db, $npcid;

  $query = "SELECT loottable_id FROM npc_types WHERE id=$npcid";
  $result = $mysql_content_db->query_assoc($query);
  $ltid = $result['loottable_id'];

  if($ltid > 0) {
    $query = "SELECT id, name FROM npc_types WHERE loottable_id=$ltid";
    $results = $mysql_content_db->query_mult_assoc($query);
    $count = count($results);
    return array("count"=>$count, "mobs"=>$results);
  }
  else {
    return null;
  }
}

function loottables_using_lootdrop() {
  global $mysql_content_db;
  $ldid = $_GET['ldid'];

  $query = "SELECT loottable_entries.loottable_id AS loottid, loottable.name AS loottname, npc_types.id AS npcid
            FROM loottable_entries
            INNER JOIN loottable ON loottable.id=loottable_entries.loottable_id
            INNER JOIN npc_types ON npc_types.loottable_id=loottable.id 
            WHERE loottable_entries.lootdrop_id=$ldid";
  $results = $mysql_content_db->query_mult_assoc($query);

  return $results;
}

function update_loottable() {
  global $mysql_content_db;
  $id = $_POST['loottable_id'];
  $name = $_POST['name'];
  $mincash = $_POST['mincash'];
  $maxcash = $_POST['maxcash'];
  $avgcoin = $_POST['avgcoin'];
  //$done = $_POST['done'];
  $min_expansion = $_POST['min_expansion'];
  $max_expansion = $_POST['max_expansion'];
  $content_flags = $_POST['content_flags'];
  $content_flags_disabled = $_POST['content_flags_disabled'];
  
  $query = "UPDATE loottable SET name=\"$name\", mincash=\"$mincash\", maxcash=\"$maxcash\", avgcoin=\"$avgcoin\", min_expansion=$min_expansion, max_expansion=$max_expansion WHERE id=$id";
  $mysql_content_db->query_no_result($query);

  if ($content_flags == "") {
    $query = "UPDATE loottable SET content_flags=NULL WHERE id=$id";
    $mysql_content_db->query_no_result($query);
  }
  else {
    $query = "UPDATE loottable SET content_flags=\"$content_flags\" WHERE id=$id";
    $mysql_content_db->query_no_result($query);
  }

  if ($content_flags_disabled == "") {
    $query = "UPDATE loottable SET content_flags_disabled=NULL WHERE id=$id";
    $mysql_content_db->query_no_result($query);
  }
  else {
    $query = "UPDATE loottable SET content_flags_disabled=\"$content_flags_disabled\" WHERE id=$id";
    $mysql_content_db->query_no_result($query);
  }
}

function add_loottable() {
  global $mysql_content_db, $npcid;
  $id = $_POST['id'];
  $name = $_POST['name'];
  $mincash = $_POST['mincash'];
  $maxcash = $_POST['maxcash'];
  $avgcoin = $_POST['avgcoin'];
  //$done = $_POST['done'];
  $min_expansion = $_POST['min_expansion'];
  $max_expansion = $_POST['max_expansion'];
  $content_flags = $_POST['content_flags'];
  $content_flags_disabled = $_POST['content_flags_disabled'];

  $query = "INSERT INTO loottable SET id=$id, name=\"$name\", mincash=\"$mincash\", maxcash=\"$maxcash\", avgcoin=\"$avgcoin\", min_expansion=$min_expansion, max_expansion=$max_expansion, content_flags=NULL, content_flags_disabled=NULL";
  $mysql_content_db->query_no_result($query);

  if ($content_flags != "") {
    $query = "UPDATE loottable SET content_flags=\"$content_flags\" WHERE id=$id";
    $mysql_content_db->query_no_result($query);
  }
  
  if ($content_flags_disabled != "") {
    $query = "UPDATE loottable SET content_flags_disabled=\"$content_flags_disabled\" WHERE id=$id";
    $mysql_content_db->query_no_result($query);
  }

  change_npc_loottable();
}

function change_npc_loottable() {
  global $mysql_content_db, $npcid;
  $id = $_REQUEST['id'];

  $query = "UPDATE npc_types SET loottable_id=$id WHERE id=$npcid";
  $mysql_content_db->query_no_result($query);
}

function change_loottable_byname() {
  global $mysql_content_db, $npcid, $z;
  $zid = getZoneID($z);
  $min_id = $zid*1000-1;
  $max_id = $zid*1000+1000;
  $ltid = $_GET['ltid'];
  $npcname = $_POST['npcname'];
  $updateall = $_POST['updateall'];
 
  if ($updateall == 0) {
    $query = "UPDATE npc_types SET loottable_id=$ltid WHERE name LIKE \"%$npcname%\" AND id > $min_id AND id < $max_id AND loottable_id=0";
    $mysql_content_db->query_no_result($query);
  }

  if ($updateall == 1) {
    $query = "UPDATE npc_types SET loottable_id=$ltid WHERE name LIKE \"%$npcname%\" AND id > $min_id AND id < $max_id";
    $mysql_content_db->query_no_result($query);
  }
}

function change_loottable_byrace() {
  global $mysql_content_db, $npcid, $z;
  $zid = getZoneID($z);
  $min_id = $zid*1000-1;
  $max_id = $zid*1000+1000;
  $ltid = $_GET['ltid'];
  $npcrace = $_POST['npcrace'];
  $updateall = $_POST['updateall'];
 
  if ($updateall == 0) {
    $query = "UPDATE npc_types SET loottable_id=$ltid WHERE race=$npcrace AND id > $min_id AND id < $max_id AND loottable_id=0";
    $mysql_content_db->query_no_result($query);
  }

  if ($updateall == 1) {
    $query = "UPDATE npc_types SET loottable_id=$ltid WHERE race=$npcrace AND id > $min_id AND id < $max_id";
    $mysql_content_db->query_no_result($query);
  }
}

function suggest_new_loottable() {
  global $mysql_content_db, $npcid;

  $query = "SELECT MAX(id) AS id FROM loottable";
  $result = $mysql_content_db->query_assoc($query);
  $id = $result['id'] + 1;
  $name = getNPCName($npcid);

  return array("id"=>$id, "name"=>$name);
}

function lootdrop_info() {
  global $mysql_content_db;
  $ldid = $_GET['ldid'];
  $itemid = $_GET['itemid'];

  $query = "SELECT * FROM lootdrop_entries WHERE lootdrop_id=$ldid AND item_id=$itemid";
  $result = $mysql_content_db->query_assoc($query);

  return $result;
}

function update_lootdrop_item() {
  global $mysql_content_db;

  $ldid = $_POST['ldid'];
  $itemid = $_POST['itemid'];
  $equip_item = $_POST['equip_item'];
  $item_charges = (isset($_POST['item_charges']) ? $_POST['item_charges'] : "1");
  $chance = $_POST['chance'];
  $disabled_chance = $_POST['disabled_chance'];
  $trivial_min_level = $_POST['trivial_min_level'];
  $trivial_max_level = $_POST['trivial_max_level'];
  $multiplier = $_POST['multiplier'];
  $npc_min_level = $_POST['npc_min_level'];
  $npc_max_level = $_POST['npc_max_level'];
  $min_expansion = $_POST['min_expansion'];
  $max_expansion = $_POST['max_expansion'];
  $content_flags = $_POST['content_flags'];
  $content_flags_disabled = $_POST['content_flags_disabled'];

  if (isset($_POST['max_charges'])) {
    $query = "SELECT maxcharges FROM items WHERE id=$itemid";
    $result = $mysql_content_db->query_assoc($query);

    if ($result && $result['maxcharges'] >= 0) {
      $item_charges = $result['maxcharges'];
    }
  }

  $query = "UPDATE lootdrop_entries SET equip_item=$equip_item, item_charges=$item_charges, chance=$chance, disabled_chance=$disabled_chance, trivial_min_level=$trivial_min_level, trivial_max_level=$trivial_max_level, multiplier=$multiplier, npc_min_level=$npc_min_level, npc_max_level=$npc_max_level, min_expansion=$min_expansion, max_expansion=$max_expansion, content_flags=NULL, content_flags_disabled=NULL WHERE lootdrop_id=$ldid AND item_id=$itemid";
  $mysql_content_db->query_no_result($query);

  if ($content_flags != "") {
    $query = "UPDATE lootdrop_entries SET content_flags=\"$content_flags\" WHERE lootdrop_id=$ldid AND item_id=$itemid";
    $mysql_content_db->query_no_result($query);
  }

  if ($content_flags_disabled != "") {
    $query = "UPDATE lootdrop_entries SET content_flags_disabled=\"$content_flags_disabled\" WHERE lootdrop_id=$ldid AND item_id=$itemid";
    $mysql_content_db->query_no_result($query);
  }
}

function getLootdropName($id) {
  global $mysql_content_db;

  $query = "SELECT name FROM lootdrop WHERE id=$id";
  $result = $mysql_content_db->query_assoc($query);

  return $result['name'];
}

function getLoottableName($id) {
  global $mysql_content_db;

  $query = "SELECT name FROM loottable WHERE id=$id";
  $result = $mysql_content_db->query_assoc($query);

  return $result['name'];
}

function update_lootdrop_name() {
  global $mysql_content_db;
  $ldname = $_POST['ldname'];
  $ldid = $_GET['ldid'];

  $query = "UPDATE lootdrop SET name=\"$ldname\" WHERE id=$ldid";
  $mysql_content_db->query_no_result($query);
}

function loottable_entries_info() {
  global $mysql_content_db;
  $ltid = $_GET['ltid'];
  $ldid = $_GET['ldid'];

  $query = "SELECT * FROM loottable_entries WHERE loottable_id=$ltid AND lootdrop_id=$ldid";
  $result = $mysql_content_db->query_assoc($query);

  $query2 = "SELECT * FROM lootdrop WHERE id=$ldid";
  $result2 = $mysql_content_db->query_assoc($query2);

  return array("loottable_entries" => $result, "lootdrop" => $result2);
}

function update_loottable_entries() {
  global $mysql_content_db;
  $droplimit = $_POST['droplimit'];
  $mindrop = $_POST['mindrop'];
  $multiplier = $_POST['multiplier'];
  $ltid = $_GET['ltid'];
  $ldid = $_GET['ldid'];
  $probability = $_POST['probability'];
  $name = $_POST['name'];
  $min_expansion = $_POST['min_expansion'];
  $max_expansion = $_POST['max_expansion'];
  $content_flags = $_POST['content_flags'];
  $content_flags_disabled = $_POST['content_flags_disabled'];

  $query = "UPDATE loottable_entries SET droplimit=$droplimit, mindrop=$mindrop, multiplier=$multiplier, probability=$probability WHERE loottable_id=$ltid AND lootdrop_id=$ldid";
  $mysql_content_db->query_no_result($query);

  $query2 = "UPDATE lootdrop SET name=\"$name\", min_expansion=$min_expansion, max_expansion=$max_expansion WHERE id=$ldid";
  $mysql_content_db->query_no_result($query2);

  if ($content_flags == "") {
    $query3 = "UPDATE lootdrop SET content_flags=NULL WHERE id=$ldid";
    $mysql_content_db->query_no_result($query3);
  }
  else {
    $query3 = "UPDATE lootdrop SET content_flags=\"$content_flags\" WHERE id=$ldid";
    $mysql_content_db->query_no_result($query3);
  }

  if ($content_flags_disabled == "") {
    $query4 = "UPDATE lootdrop SET content_flags_disabled=NULL WHERE id=$ldid";
    $mysql_content_db->query_no_result($query4);
  }
  else {
    $query4 = "UPDATE lootdrop SET content_flags_disabled=\"$content_flags_disabled\" WHERE id=$ldid";
    $mysql_content_db->query_no_result($query4);
  }
}

function search_loottable_names($search) {
  global $mysql_content_db;

  $query = "SELECT * FROM loottable WHERE name RLIKE \"$search\"";
  $results = $mysql_content_db->query_mult_assoc($query);

  return $results;
}

function delete_loottable($id) {
  global $mysql_content_db, $npcid;

  $query = "DELETE FROM loottable WHERE id=$id";
  $mysql_content_db->query_no_result($query);

  $query = "DELETE FROM loottable_entries WHERE loottable_id=$id";
  $mysql_content_db->query_no_result($query);

  $query = "UPDATE npc_types SET loottable_id=0 WHERE id=$npcid";
  $mysql_content_db->query_no_result($query);
}

function delete_lootdrop_item() {
  global $mysql_content_db;
  $ldid = $_GET['ldid'];
  $itemid = $_GET['itemid'];
  
  $query = "DELETE FROM lootdrop_entries WHERE lootdrop_id=$ldid AND item_id=$itemid";
  $mysql_content_db->query_no_result($query);
}

function disable_lootdrop_item() {
  global $mysql_content_db;
  $ldid = $_GET['ldid'];
  $itemid = $_GET['itemid'];
  $chance = $_GET['chance'];
  
  $query = "UPDATE lootdrop_entries SET disabled_chance=$chance, chance=0 WHERE lootdrop_id=$ldid AND item_id=$itemid";
  $mysql_content_db->query_no_result($query);
}

function enable_lootdrop_item() {
  global $mysql_content_db;
  $ldid = $_GET['ldid'];
  $itemid = $_GET['itemid'];
  $dchance = $_GET['dchance'];
  
  $query = "UPDATE lootdrop_entries SET disabled_chance=0, chance=$dchance WHERE lootdrop_id=$ldid AND item_id=$itemid";
  $mysql_content_db->query_no_result($query);
}

function normalize_drops() {
  global $mysql_content_db, $normalize_amount;
  $ldid = $_GET['ldid'];
  
  $query = "UPDATE lootdrop_entries SET chance=$normalize_amount WHERE lootdrop_id=$ldid";
  $mysql_content_db->query_no_result($query);
}

function remove_lootdrop_from_loottable() {
  global $mysql_content_db;
  $ltid = $_GET['ltid'];
  $ldid = $_GET['ldid'];
  
  $query = "DELETE FROM loottable_entries WHERE lootdrop_id=$ldid AND loottable_id=$ltid";
  $mysql_content_db->query_no_result($query);
}

function add_lootdrop_item($itemid) {
  global $mysql_content_db;

  $ldid = $_GET['ldid'];
  $item_charges = (isset($_POST['item_charges']) ? $_POST['item_charges'] : "1");
  $multiplier = $_POST['multiplier'];
  $chance= $_POST['chance'];
  $equip_item = $_POST['equip_item'];
  $trivial_min_level = $_POST['trivial_min_level'];
  $trivial_max_level = $_POST['trivial_max_level'];
  $npc_min_level = $_POST['npc_min_level'];
  $npc_max_level = $_POST['npc_max_level'];
  $min_expansion = $_POST['min_expansion'];
  $max_expansion = $_POST['max_expansion'];
  $content_flags = $_POST['content_flags'];
  $content_flags_disabled = $_POST['content_flags_disabled'];

  if (isset($_POST['max_charges'])) {
    $query = "SELECT maxcharges FROM items WHERE id=$itemid";
    $result = $mysql_content_db->query_assoc($query);

    if ($result && $result['maxcharges'] >= 0) {
      $item_charges = $result['maxcharges'];
    }
  }

  $query = "INSERT INTO lootdrop_entries SET lootdrop_id=$ldid, item_id=$itemid, equip_item=$equip_item, item_charges=$item_charges, multiplier=$multiplier, chance=$chance, trivial_min_level=$trivial_min_level, trivial_max_level=$trivial_max_level, npc_min_level=$npc_min_level, npc_max_level=$npc_max_level, min_expansion=$min_expansion, max_expansion=$max_expansion, content_flags=NULL, content_flags_disabled=NULL";
  $mysql_content_db->query_no_result($query);

  if ($content_flags != "") {
    $query = "UPDATE lootdrop_entries SET content_flags=\"$content_flags\" WHERE lootdrop_id=$ldid AND item_id=$itemid";
    $mysql_content_db->query_no_result($query);
  }

  if ($content_flags_disabled != "") {
    $query = "UPDATE lootdrop_entries SET content_flags_disabled=\"$content_flags_disabled\" WHERE lootdrop_id=$ldid AND item_id=$itemid";
    $mysql_content_db->query_no_result($query);
  }
}

function assign_lootdrop() {
  global $mysql_content_db;
  $ltid = $_POST['ltid'];
  $ldid = $_POST['ldid'];
  $droplimit = $_POST['droplimit'];
  $mindrop = $_POST['mindrop'];
  $multiplier = $_POST['multiplier'];
  $probability = $_POST['probability'];
  
  $query = "INSERT INTO loottable_entries SET loottable_id=$ltid, lootdrop_id=$ldid, droplimit=$droplimit, mindrop=$mindrop, multiplier=$multiplier, probability=$probability";
  $mysql_content_db->query_no_result($query);
}

function delete_lootdrop() {
  global $mysql_content_db;
  $ldid = $_GET['ldid'];
  
  $query = "DELETE FROM loottable_entries WHERE lootdrop_id=$ldid";
  $mysql_content_db->query_no_result($query);

  $query2 = "DELETE FROM lootdrop_entries WHERE lootdrop_id=$ldid";
  $mysql_content_db->query_no_result($query2);

  $query3 = "DELETE FROM lootdrop WHERE id=$ldid";
  $mysql_content_db->query_no_result($query3);
}

function search_lootdrops($search) {
  global $mysql_content_db;

  $query = "SELECT * FROM lootdrop WHERE name RLIKE \"$search\"";
  $results = $mysql_content_db->query_mult_assoc($query);

  return $results;
}

function suggest_new_lootdrop() {
  global $mysql_content_db, $npcid;
  $ltid = $_GET['ltid'];

  $query = "SELECT MAX(id) AS id FROM lootdrop";
  $result = $mysql_content_db->query_assoc($query);
  $id = $result['id'] + 1;

  $name = getNPCName($npcid);
  $name = $ltid . "_" . $name . "_";

  return array("id"=>$id, "name"=>$name);
}

function create_lootdrop() {
  global $mysql_content_db;
  $ldid = $_POST['ldid'];
  $name = $_POST['name'];
  $min_expansion = $_POST['min_expansion'];
  $max_expansion = $_POST['max_expansion'];
  $content_flags = $_POST['content_flags'];
  $content_flags_disabled = $_POST['content_flags_disabled'];

  $query = "INSERT INTO lootdrop SET id=$ldid, name=\"$name\", min_expansion=$min_expansion, max_expansion=$max_expansion, content_flags=NULL, content_flags_disabled=NULL";
  $mysql_content_db->query_no_result($query);

  if ($content_flags != "") {
    $query = "UPDATE lootdrop SET content_flags=\"$content_flags\" WHERE id=$ldid";
    $mysql_content_db->query_no_result($query);
  }

  if ($content_flags_disabled != "") {
    $query = "UPDATE lootdrop SET content_flags_disabled=\"$content_flags_disabled\" WHERE id=$ldid";
    $mysql_content_db->query_no_result($query);
  }
}

function search_loot_by_item() {
  global $mysql_content_db;
  $search = $_GET['search'];

  $query = "SELECT npc_types.id,npc_types.name FROM lootdrop_entries
            INNER JOIN loottable_entries ON lootdrop_entries.lootdrop_id=loottable_entries.lootdrop_id
            INNER JOIN npc_types ON npc_types.loottable_id=loottable_entries.loottable_id
            INNER JOIN items ON items.id=lootdrop_entries.item_id
            WHERE items.id=\"$search\"";
            // WHERE items.name RLIKE \"$search\" LIMIT 50";
  $results = $mysql_content_db->query_mult_assoc($query);

  return $results;
}

function drop_loottable() {
  global $mysql_content_db, $npcid;

  $query = "UPDATE npc_types SET loottable_id=0 WHERE id=$npcid";
  $mysql_content_db->query_no_result($query);
}

function copy_lootdrop() {
  global $mysql_content_db;
  $ldid = $_GET['ldid'];
  $name = $_GET['name'];

  $query = "SELECT MAX(id) AS lid FROM lootdrop";
  $result = $mysql_content_db->query_assoc($query);
  $nlid = $result['lid'] + 1;
  
  $query = "DELETE FROM loottable_entries WHERE lootdrop_id=0";
  $mysql_content_db->query_no_result($query);

  $query = "DELETE FROM lootdrop_entries WHERE lootdrop_id=0";
  $mysql_content_db->query_no_result($query);

  $newname = $name . '_' . $nlid;
  $query = "INSERT INTO lootdrop SET id=\"$nlid\", name=\"$newname\"";
  $mysql_content_db->query_no_result($query);

  $query = "INSERT INTO loottable_entries (loottable_id, droplimit, mindrop, multiplier, probability) 
            SELECT loottable_id, droplimit, mindrop, multiplier, probability FROM loottable_entries WHERE lootdrop_id=$ldid";
  $mysql_content_db->query_no_result($query);

  $query = "INSERT INTO lootdrop_entries (item_id, item_charges, equip_item, chance, trivial_min_level, trivial_max_level, multiplier, npc_min_level, npc_max_level, min_expansion, max_expansion, content_flags, content_flags_disabled) 
            SELECT item_id, item_charges, equip_item, chance, trivial_min_level, trivial_max_level, multiplier, npc_min_level, npc_max_level, min_expansion, max_expansion, content_flags, content_flags_disabled FROM lootdrop_entries WHERE lootdrop_id=$ldid";
  $mysql_content_db->query_no_result($query);

  $query = "UPDATE loottable_entries SET lootdrop_id=$nlid WHERE lootdrop_id=0";
  $mysql_content_db->query_no_result($query);

  $query = "UPDATE lootdrop_entries SET lootdrop_id=$nlid WHERE lootdrop_id=0";
  $mysql_content_db->query_no_result($query);
}

function merge_lootdrop() {
  global $mysql_content_db;

  $ldid = $_GET['ldid'];
  $lootdropid = $_POST['lootdropid'];

  $query = "UPDATE lootdrop_entries SET lootdrop_id = $lootdropid WHERE lootdrop_id=$ldid";
  $mysql_content_db->query_no_result($query);

  $query = "DELETE FROM lootdrop WHERE id=$ldid";
  $mysql_content_db->query_no_result($query);

  $query = "DELETE FROM loottable_entries WHERE lootdrop_id=$ldid";
  $mysql_content_db->query_no_result($query);

  $query = "UPDATE loottable_entries SET droplimit=droplimit+1 WHERE lootdrop_id=$lootdropid";
  $mysql_content_db->query_no_result($query);
}

function move_multiplier() {
  global $mysql_content_db;

  $ldid = $_GET['ldid'];
  $multiplier = $_GET['multiplier'];

  $query = "UPDATE lootdrop_entries SET multiplier=$multiplier WHERE lootdrop_id=$ldid";
  $mysql_content_db->query_no_result($query);

  $query = "UPDATE loottable_entries SET multiplier=1 WHERE lootdrop_id=$ldid";
  $mysql_content_db->query_no_result($query);
}

function magelo_import() {
  global $mysql_content_db, $npcid, $perl_path;

  $output = array();
  $output = exec("perl $perl_path/Loot.pl $npcid 2>&1");

  if (preg_match("(line 37)", $output)) {
    logPerl("Script failed to run. HINT: Did you add your username, password, and database to Loot.pl?");
    logPerl("Error: " . $output);
  }
  elseif (preg_match("(BEGIN failed)", $output)) {
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
  elseif (preg_match("(0 item drops added)", $output)) {
    $query = "SHOW TABLES LIKE '%magelo_npc_loot_parse%'";
    $table_test = $mysql_content_db->query_assoc($query);
    if (!$table_test) {
      logPerl("Error: Database is missing magelo_npc_loot_parse table.");
    }
    logPerl($output);
  }
  else {
    logPerl($output);
  }
}

function move_copy_lootdrop_item() {
  global $mysql_content_db;

  $ldid = $_GET['ldid'];
  $itemid = $_GET['itemid'];
  $equip_item = $_POST['equip_item'];
  $item_charges = (isset($_POST['item_charges']) ? $_POST['item_charges'] : "1");
  $chance = $_POST['chance'];
  $trivial_min_level = $_POST['trivial_min_level'];
  $trivial_max_level = $_POST['trivial_max_level'];
  $multiplier = $_POST['multiplier'];
  $npc_min_level = $_POST['npc_min_level'];
  $npc_max_level = $_POST['npc_max_level'];
  $min_expansion = $_POST['min_expansion'];
  $max_expansion = $_POST['max_expansion'];
  $content_flags = $_POST['content_flags'];
  $content_flags_disabled = $_POST['content_flags_disabled'];
  $new_ldid = $_POST['new_ldid'];
  $move_copy_item = $_POST['move_copy_item'];

  if (isset($_POST['max_charges'])) {
    $query = "SELECT maxcharges FROM items WHERE id=$itemid";
    $result = $mysql_content_db->query_assoc($query);

    if ($result && $result['maxcharges'] >= 0) {
      $item_charges = $result['maxcharges'];
    }
  }

  $query = "INSERT INTO lootdrop_entries SET lootdrop_id=$new_ldid, item_id=$itemid, equip_item=$equip_item, item_charges=$item_charges, chance=$chance, trivial_min_level=$trivial_min_level, trivial_max_level=$trivial_max_level, multiplier=$multiplier, npc_min_level=$npc_min_level, npc_max_level=$npc_max_level, min_expansion=$min_expansion, max_expansion=$max_expansion, content_flags=NULL, content_flags_disabled=NULL";
  $mysql_content_db->query_no_result($query);

  if ($content_flags != "") {
    $query = "UPDATE lootdrop_entries SET content_flags=\"$content_flags\" WHERE lootdrop_id=$new_ldid AND item_id=$itemid";
    $mysql_content_db->query_no_result($query);
  }

  if ($content_flags_disabled != "") {
    $query = "UPDATE lootdrop_entries SET content_flags_disabled=\"$content_flags_disabled\" WHERE lootdrop_id=$new_ldid AND item_id=$itemid";
    $mysql_content_db->query_no_result($query);
  }

  if ($move_copy_item == 0) {
    $query = "DELETE FROM lootdrop_entries WHERE lootdrop_id=$ldid AND item_id=$itemid";
    $mysql_content_db->query_no_result($query);
  }
}

function global_loot_info() {
  global $mysql_content_db;

  $query = "SELECT * FROM global_loot";
  $results = $mysql_content_db->query_mult_assoc($query);

  if ($results) {
    return $results;
  }
  else {
    return null;
  }
}

function insert_global_loot() {
  global $mysql_content_db;

  $id = $_POST['id'];
  $description = $_POST['description'];
  $loottable_id = $_POST['loottable_id'];
  $enabled = $_POST['enabled'];
  $min_level = $_POST['min_level'];
  $max_level = $_POST['max_level'];
  $rare = $_POST['rare'];
  $raid = $_POST['raid'];
  $race = $_POST['race'];
  $class = $_POST['class'];
  $bodytype = $_POST['bodytype'];
  $zone = $_POST['zone'];
  $hot_zone = $_POST['hot_zone'];
  $min_expansion = $_POST['min_expansion'];
  $max_expansion = $_POST['max_expansion'];
  $content_flags = $_POST['content_flags'];
  $content_flags_disabled = $_POST['content_flags_disabled'];

  $query = "INSERT INTO global_loot SET id=$id, description=\"$description\", loottable_id=$loottable_id, enabled=$enabled, min_level=$min_level, max_level=$max_level, rare=NULL, raid=NULL, race=NULL, class=NULL, bodytype=NULL, zone=NULL, hot_zone=NULL, min_expansion=$min_expansion, max_expansion=$max_expansion, content_flags=NULL, content_flags_disabled=NULL";
  $mysql_content_db->query_no_result($query);

  if ($rare != "") {
    $query = "UPDATE global_loot SET rare=$rare WHERE id=$id";
    $mysql_content_db->query_no_result($query);
  }

  if ($raid != "") {
    $query = "UPDATE global_loot SET raid=$raid WHERE id=$id";
    $mysql_content_db->query_no_result($query);
  }

  if ($race != "") {
    $query = "UPDATE global_loot SET race=\"$race\" WHERE id=$id";
    $mysql_content_db->query_no_result($query);
  }

  if ($class != "") {
    $query = "UPDATE global_loot SET class=\"$class\" WHERE id=$id";
    $mysql_content_db->query_no_result($query);
  }

  if ($bodytype != "") {
    $query = "UPDATE global_loot SET bodytype=\"$bodytype\" WHERE id=$id";
    $mysql_content_db->query_no_result($query);
  }

  if ($zone != "") {
    $query = "UPDATE global_loot SET zone=\"$zone\" WHERE id=$id";
    $mysql_content_db->query_no_result($query);
  }

  if ($hot_zone != -1) {
    $query = "UPDATE global_loot SET hot_zone=$hot_zone WHERE id=$id";
    $mysql_content_db->query_no_result($query);
  }

  if ($content_flags != "") {
    $query = "UPDATE global_loot SET content_flags=\"$content_flags\" WHERE id=$id";
    $mysql_content_db->query_no_result($query);
  }

  if ($content_flags_disabled != "") {
    $query = "UPDATE global_loot SET content_flags_disabled=\"$content_flags_disabled\" WHERE id=$id";
    $mysql_content_db->query_no_result($query);
  }

  create_empty_loottable($id);
}

function update_global_loot() {
  global $mysql_content_db;

  $id = $_POST['id'];
  $description = $_POST['description'];
  $loottable_id = $_POST['loottable_id'];
  $enabled = $_POST['enabled'];
  $min_level = $_POST['min_level'];
  $max_level = $_POST['max_level'];
  $rare = $_POST['rare'];
  $raid = $_POST['raid'];
  $race = $_POST['race'];
  $class = $_POST['class'];
  $bodytype = $_POST['bodytype'];
  $zone = $_POST['zone'];
  $hot_zone = $_POST['hot_zone'];
  $min_expansion = $_POST['min_expansion'];
  $max_expansion = $_POST['max_expansion'];
  $content_flags = $_POST['content_flags'];
  $content_flags_disabled = $_POST['content_flags_disabled'];

  $query = "UPDATE global_loot SET description=\"$description\", loottable_id=$loottable_id, enabled=$enabled, min_level=$min_level, max_level=$max_level, rare=NULL, raid=NULL, race=NULL, class=NULL, bodytype=NULL, zone=NULL, hot_zone=NULL, min_expansion=$min_expansion, max_expansion=$max_expansion, content_flags=NULL, content_flags_disabled=NULL WHERE id=$id";
  $mysql_content_db->query_no_result($query);

  $query = "UPDATE loottable SET min_expansion=$min_expansion, max_expansion=$max_expansion, content_flags=NULL, content_flags_disabled=NULL WHERE id=$loottable_id";
  $mysql_content_db->query_no_result($query);

  if ($rare != "") {
    $query = "UPDATE global_loot SET rare=$rare WHERE id=$id";
    $mysql_content_db->query_no_result($query);
  }

  if ($raid != "") {
    $query = "UPDATE global_loot SET raid=$raid WHERE id=$id";
    $mysql_content_db->query_no_result($query);
  }

  if ($race != "") {
    $query = "UPDATE global_loot SET race=\"$race\" WHERE id=$id";
    $mysql_content_db->query_no_result($query);
  }

  if ($class != "") {
    $query = "UPDATE global_loot SET class=\"$class\" WHERE id=$id";
    $mysql_content_db->query_no_result($query);
  }

  if ($bodytype != "") {
    $query = "UPDATE global_loot SET bodytype=\"$bodytype\" WHERE id=$id";
    $mysql_content_db->query_no_result($query);
  }

  if ($zone != "") {
    $query = "UPDATE global_loot SET zone=\"$zone\" WHERE id=$id";
    $mysql_content_db->query_no_result($query);
  }

  if ($hot_zone != -1) {
    $query = "UPDATE global_loot SET hot_zone=$hot_zone WHERE id=$id";
    $mysql_content_db->query_no_result($query);
  }

  if ($content_flags != "") {
    $query = "UPDATE global_loot SET content_flags=\"$content_flags\" WHERE id=$id";
    $mysql_content_db->query_no_result($query);

    $query = "UPDATE loottable SET content_flags=\"$content_flags\" WHERE id=$loottable_id";
    $mysql_content_db->query_no_result($query);
  }

  if ($content_flags_disabled != "") {
    $query = "UPDATE global_loot SET content_flags_disabled=\"$content_flags_disabled\" WHERE id=$id";
    $mysql_content_db->query_no_result($query);

    $query = "UPDATE loottable SET content_flags_disabled=\"$content_flags_disabled\" WHERE id=$loottable_id";
    $mysql_content_db->query_no_result($query);
  }
}

function delete_global_loot() {
  global $mysql_content_db;
  $id = $_GET['id'];

  $query = "DELETE FROM global_loot WHERE id=$id";
  $mysql_content_db->query_no_result($query);
}

function suggest_next_global_loot() {
  global $mysql_content_db;

  $query = "SELECT MAX(id) AS id FROM global_loot";
  $result = $mysql_content_db->query_assoc($query);
  $loot_ids['new_id'] = $result['id'] + 1;

  $query = "SELECT MAX(id) AS id FROM loottable";
  $result = $mysql_content_db->query_assoc($query);
  $loot_ids['new_table_id'] = $result['id'] + 1;

  return $loot_ids;
}

function suggest_next_global_lootdrop() {
  global $mysql_content_db;

  $query = "SELECT MAX(id) AS id FROM lootdrop";
  $result = $mysql_content_db->query_assoc($query);

  return $result['id'] + 1;
}

function getGlobalLoot($id) {
  global $mysql_content_db;

  $query = "SELECT * FROM global_loot WHERE id=$id";
  $result = $mysql_content_db->query_assoc($query);

  if ($result) {
    return $result;
  }
  else {
    return null;
  }
}

function getGlobalLoottableID($id) {
  global $mysql_content_db;

  $query = "SELECT loottable_id FROM global_loot WHERE id=$id";
  $result = $mysql_content_db->query_assoc($query);

  if ($result) {
    return $result['loottable_id'];
  }
  else {
    return null;
  }
}

function global_loottable_info($id) {
  global $mysql_content_db;
  $array = array();
  $count = 0;

  $loottable_id = getGlobalLoottableID($id);

  if (!$loottable_id) {
    return null;
  }

  $query = "SELECT * FROM loottable WHERE id=$loottable_id";
  $result = $mysql_content_db->query_assoc($query);

  if ($result) {
    $array = $result;
  }
  else {
    $array['id'] = $loottable_id;
    $array['lootdrop_count'] = 0;
    $array['lootdrops'] = '';
    return $array;
  }

  $query2 = "SELECT * FROM loottable_entries, lootdrop WHERE loottable_entries.loottable_id=$loottable_id AND loottable_entries.lootdrop_id=lootdrop.id";
  $result2 = $mysql_content_db->query_mult_assoc($query2);
  if (!$result2) {
    $array['lootdrop_count'] = 0;
    $array['lootdrops'] = '';
    return $array;
  }

  foreach ($result2 as $row2) {
    $count++;
    $lootdrop = $row2['lootdrop_id'];

    $query3 = "SELECT * FROM lootdrop_entries WHERE lootdrop_id=$lootdrop";
    $result3 = $mysql_content_db->query_mult_assoc($query3);

    if ($result3) {
      foreach ($result3 as $row3) {
        $row2['items'][] = $row3;
      }
    }
    $array2[] = $row2;
  }

  $array['lootdrop_count'] = $count;
  $array['lootdrops'] = $array2;

  $query4 = "SELECT min_expansion, max_expansion, content_flags, content_flags_disabled FROM global_loot WHERE id=$id";
  $result4 = $mysql_content_db->query_assoc($query4);

  if ($result4) {
    $array['min_expansion'] = $result4['min_expansion'];
    $array['max_expansion'] = $result4['max_expansion'];
    $array['content_flags'] = $result4['content_flags'];
    $array['content_flags_disabled'] = $result4['content_flags_disabled'];
  }

  return $array;
}

function update_global_loottable() {
  global $mysql_content_db;

  $id = $_POST['id'];
  $name = $_POST['name'];
  $mincash = $_POST['mincash'];
  $maxcash = $_POST['maxcash'];
  $avgcoin = $_POST['avgcoin'];
  //$done = $_POST['done'];
  $min_expansion = $_POST['min_expansion'];
  $max_expansion = $_POST['max_expansion'];
  $content_flags = $_POST['content_flags'];
  $content_flags_disabled = $_POST['content_flags_disabled'];

  $query = "UPDATE loottable SET name=\"$name\", mincash=$mincash, maxcash=$maxcash, avgcoin=$avgcoin, min_expansion=$min_expansion, max_expansion=$max_expansion, content_flags=NULL, content_flags_disabled=NULL WHERE id=$id";
  $mysql_content_db->query_no_result($query);

  if ($content_flags != "") {
    $query = "UPDATE loottable SET content_flags=\"$content_flags\" WHERE id=$id";
    $mysql_content_db->query_no_result($query);
  }

  if ($content_flags_disabled != "") {
    $query = "UPDATE loottable SET content_flags_disabled=\"$content_flags_disabled\" WHERE id=$id";
    $mysql_content_db->query_no_result($query);
  }
}

function create_empty_loottable($id) {
  global $mysql_content_db;
  $loottable_id = getGlobalLoottableID($id);
  $min_expansion = 0;
  $max_expansion = 0;
  $content_flags = "";
  $content_flags_disabled = "";

  $query = "SELECT min_expansion, max_expansion, content_flags, content_flags_disabled FROM global_loot WHERE id=$id";
  $result = $mysql_content_db->query_assoc($query);

  if ($result) {
    $min_expansion = $result['min_expansion'];
    $max_expansion = $result['max_expansion'];
    $content_flags = $result['content_flags'];
    $content_flags_disabled = $result['content_flags_disabled'];
  }


  if ($loottable_id) {
    $query = "INSERT INTO loottable SET id=$loottable_id, name='', mincash=0, maxcash=0, avgcoin=0, min_expansion=$min_expansion, max_expansion=$max_expansion, content_flags=NULL, content_flags_disabled=NULL";
    $mysql_content_db->query_no_result($query);
  }
  else {
    $suggest = suggest_next_global_loot();
    $loottable_id = $suggest['new_table_id'];

    $query = "INSERT INTO loottable SET id=$loottable_id, name='', mincash=0, maxcash=0, avgcoin=0, min_expansion=$min_expansion, max_expansion=$max_expansion, content_flags=NULL, content_flags_disabled=NULL";
    $mysql_content_db->query_no_result($query);

    $query = "UPDATE global_loot SET loottable_id=$loottable_id WHERE id=$id";
    $mysql_content_db->query_no_result($query);
  }

  if ($content_flags != "") {
    $query = "UPDATE loottable SET content_flags=\"$content_flags\" WHERE id=$loottable_id";
    $mysql_content_db->query_no_result($query);
  }

  if ($content_flags_disabled != "") {
    $query = "UPDATE loottable SET content_flags_disabled=\"$content_flags_disabled\" WHERE id=$loottable_id";
    $mysql_content_db->query_no_result($query);
  }

}

function delete_global_loottable($id) {
  global $mysql_content_db;
  $loottable_id = getGlobalLoottableID($id);

  if ($loottable_id) {
    $query = "UPDATE global_loot SET loottable_id=0 WHERE id=$id";
    $mysql_content_db->query_no_result($query);

    $query = "DELETE FROM loottable WHERE id=$loottable_id";
    $mysql_content_db->query_no_result($query);
  }
}

function global_lootdrop_info() {
  global $mysql_content_db;
  $loottable_id = $_GET['ltid'];
  $lootdrop_id = $_GET['ldid'];

  $query = "SELECT * FROM loottable_entries INNER JOIN lootdrop WHERE loottable_entries.lootdrop_id=lootdrop.id AND loottable_entries.loottable_id=$loottable_id AND lootdrop.id=$lootdrop_id";
  $result = $mysql_content_db->query_assoc($query);

  return $result;
}

function insert_global_lootdrop() {
  global $mysql_content_db;
  $loottable_id = $_POST['loottable_id'];
  $lootdrop_id = $_POST['id'];
  $name = $_POST['name'];
  $multiplier = $_POST['multiplier'];
  $droplimit = $_POST['droplimit'];
  $mindrop = $_POST['mindrop'];
  $probability = $_POST['probability'];

  $query = "INSERT INTO lootdrop SET id=$lootdrop_id, name=\"$name\"";
  $mysql_content_db->query_no_result($query);

  $query = "INSERT INTO loottable_entries SET loottable_id=$loottable_id, lootdrop_id=$lootdrop_id, multiplier=$multiplier, droplimit=$droplimit, mindrop=$mindrop, probability=$probability";
  $mysql_content_db->query_no_result($query);
}

function update_global_lootdrop() {
  global $mysql_content_db;
  $loottable_id = $_POST['loottable_id'];
  $lootdrop_id = $_POST['id'];
  $name = $_POST['name'];
  $multiplier = $_POST['multiplier'];
  $droplimit = $_POST['droplimit'];
  $mindrop = $_POST['mindrop'];
  $probability = $_POST['probability'];

  $query = "UPDATE lootdrop SET name=\"$name\" WHERE id=$lootdrop_id";
  $mysql_content_db->query_no_result($query);

  $query = "UPDATE loottable_entries SET multiplier=$multiplier, droplimit=$droplimit, mindrop=$mindrop, probability=$probability WHERE loottable_id=$loottable_id AND lootdrop_id=$lootdrop_id";
  $mysql_content_db->query_no_result($query);
}

function delete_global_lootdrop() {
  global $mysql_content_db;
  $loottable_id = $_GET['ltid'];
  $lootdrop_id = $_GET['ldid'];

  $query = "DELETE FROM lootdrop_entries WHERE lootdrop_id=$lootdrop_id";
  $mysql_content_db->query_no_result($query);

  $query = "DELETE FROM lootdrop WHERE id=$lootdrop_id";
  $mysql_content_db->query_no_result($query);

  $query = "DELETE FROM loottable_entries WHERE loottable_id=$loottable_id AND lootdrop_id=$lootdrop_id";
  $mysql_content_db->query_no_result($query);
}

function insert_global_lootdrop_item() {
  global $mysql_content_db;

  $ldid = $_POST['ldid'];
  $itemid = $_POST['itemid'];
  $item_charges = (isset($_POST['item_charges']) ? $_POST['item_charges'] : "1");
  $multiplier = $_POST['multiplier'];
  $chance = $_POST['chance'];
  $equip_item = $_POST['equip_item'];
  $trivial_min_level = $_POST['trivial_min_level'];
  $trivial_max_level = $_POST['trivial_max_level'];
  $npc_min_level = $_POST['npc_min_level'];
  $npc_max_level = $_POST['npc_max_level'];

  if (isset($_POST['max_charges'])) {
    $query = "SELECT maxcharges FROM items WHERE id=$itemid";
    $result = $mysql_content_db->query_assoc($query);

    if ($result && $result['maxcharges'] >= 0) {
      $item_charges = $result['maxcharges'];
    }
  }

  $query = "INSERT INTO lootdrop_entries SET lootdrop_id=$ldid, item_id=$itemid, equip_item=$equip_item, item_charges=$item_charges, multiplier=$multiplier, chance=$chance, trivial_min_level=$trivial_min_level, trivial_max_level=$trivial_max_level, npc_min_level=$npc_min_level, npc_max_level=$npc_max_level";
  $mysql_content_db->query_no_result($query);
}

?>
