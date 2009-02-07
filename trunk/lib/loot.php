<?

switch ($action) {
  case 0:  // View Loottable
    if ($npcid) {
      $body = new Template("templates/loot/loottable.tmpl.php");
      $body->set('currzone', $z);
      $body->set('npcid', $npcid);
      $body->set('npc_name', getNPCName($npcid));
      $vars = loottable_info();
      $usage = mobs_using_loottable();
      if ($vars) {
        foreach ($vars as $key=>$value) {
          $body->set($key, $value);
        }
      }
      $body->set('usage', $usage);
    }
    break;
  case 1:  //Edit loottable
    check_authorization();
    $body = new Template("templates/loot/loottable.edit.tmpl.php");
    $body->set('currzone', $z);
    $body->set('npcid', $npcid);
    $body->set('npc_name', getNPCName($npcid));
    $vars = loottable_info();
    foreach ($vars as $key=>$value) {
      $body->set($key, $value);
    }
    break;
  case 2:  //Update loottable info
    check_authorization();
    update_loottable();
    header("Location: index.php?editor=loot&z=$z&npcid=$npcid");
    exit;
  case 3:  //Edit Lootdrop name
    check_authorization();
    $body = new Template("templates/loot/lootdrop.edit.name.tmpl.php");
    $body->set('currzone', $z);
    $body->set('npcid', $npcid);
    $body->set('ldid', $_GET['ldid']);
    $body->set('ldname', getLootdropName($_GET['ldid']));
    $vars = loottable_info();
    foreach ($vars as $key=>$value) {
      $body->set($key, $value);
    }
    break;
  case 4:  //Update Lootdrop Name
    check_authorization();
    update_lootdrop_name();
    header("Location: index.php?editor=loot&z=$z&npcid=$npcid");
    exit;
  case 5:  //Edit Lootdrop Item page
    check_authorization();
    $body = new Template("templates/loot/lootdrop.edit.item.tmpl.php");
    $body->set('currzone', $z);
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
    header("Location: index.php?editor=loot&z=$z&npcid=$npcid");
    exit;
  case 7:  // Edit loottable entry
    check_authorization();
    $body = new Template("templates/loot/lootdrop.edit.tmpl.php");
    $body->set('currzone', $z);
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
    header("Location: index.php?editor=loot&z=$z&npcid=$npcid");
    exit;
  case 9:  // Add new loottable
    check_authorization();
    $body = new Template("templates/loot/loottable.add.tmpl.php");
    $body->set('currzone', $z);
    $body->set('npcid', $npcid);
    $vars = suggest_new_loottable();
    foreach ($vars as $key=>$value) {
      $body->set($key, $value);
    }
    break;
  case 10: // Insert new loottable
    check_authorization();
    add_loottable();
    header("Location: index.php?editor=loot&z=$z&npcid=$npcid");
    exit;
  case 11: // Change loottable
    check_authorization();
    $body = new Template("templates/loot/loottable.change.tmpl.php");
    $body->set('currzone', $z);
    $body->set('npcid', $npcid);
    break;
  case 12:
    check_authorization();
    $body = new Template("templates/loot/loottable.changebyid.tmpl.php");
    $body->set('currzone', $z);
    $body->set('npcid', $npcid);
    break;
  case 13:
    check_authorization();
    change_npc_loottable();
    header("Location: index.php?editor=loot&z=$z&npcid=$npcid");
    exit;
  case 14:
    check_authorization();
    $body = new Template("templates/loot/loottable.search.tmpl.php");
    $body->set('currzone', $z);
    $body->set('npcid', $npcid);
    break;
  case 15:
    check_authorization();
    $body = new Template("templates/loot/loottable.searchresults.tmpl.php");
    $body->set('currzone', $z);
    $body->set('npcid', $npcid);
    $vars = search_loottable_names($_POST['search']);
    $body->set('results', $vars);
    break;
  case 16:
    check_authorization();
    delete_loottable($_GET['ltid']);
    header("Location: index.php?editor=loot&z=$z&npcid=$npcid");
    exit;
  case 17:
    check_authorization();
    delete_lootdrop_item();
    header("Location: index.php?editor=loot&z=$z&npcid=$npcid");
    exit;
  case 18:
    check_authorization();
    balance_drops();
    header("Location: index.php?editor=loot&z=$z&npcid=$npcid");
    exit;
  case 19:
    check_authorization();
    remove_lootdrop_from_loottable();
    header("Location: index.php?editor=loot&z=$z&npcid=$npcid");
    exit;
  case 20:  // Add lootdrop item
    check_authorization();
    $javascript .= file_get_contents("templates/iframes/js.tmpl.php");
    $body = new Template("templates/loot/lootdrop.item.add.tmpl.php");
    $body->set('currzone', $z);
    $body->set('npcid', $npcid);
    $body->set('ldid', $_GET['ldid']);
    break;
  case 21: // Add lootdrop item
    check_authorization();
    add_lootdrop_item($_REQUEST['itemid']);
    header("Location: index.php?editor=loot&z=$z&npcid=$npcid");
    exit;
  case 22:  // Change lootdrop
    check_authorization();
    $body = new Template("templates/loot/lootdrop.change.tmpl.php");
    $body->set('currzone', $z);
    $body->set('npcid', $npcid);
    $body->set('ltid', $_GET['ltid']);
    break;
  case 23:  // Add lootdrop by id
    check_authorization();
    $body = new Template("templates/loot/lootdrop.changebyid.tmpl.php");
    $body->set('currzone', $z);
    $body->set('npcid', $npcid);
    $body->set('ltid', $_GET['ltid']);
    break;
  case 24:
    check_authorization();
    assign_lootdrop();
    header("Location: index.php?editor=loot&z=$z&npcid=$npcid");
    exit;
  case 25:
    check_authorization();
    $body = new Template("templates/loot/lootdrop.search.tmpl.php");
    $body->set('currzone', $z);
    $body->set('npcid', $npcid);
    $body->set('ltid', $_GET['ltid']);
    break;
  case 26:
    check_authorization();
    delete_lootdrop();
    header("Location: index.php?editor=loot&z=$z&npcid=$npcid");
    exit;
  case 27:
    check_authorization();
    search_lootdrops();
    header("Location: index.php?editor=loot&z=$z&npcid=$npcid");
    exit;
  case 28:
    check_authorization();
    $body = new Template("templates/loot/lootdrop.searchresults.tmpl.php");
    $body->set('currzone', $z);
    $body->set('npcid', $npcid);
    $body->set('ltid', $_GET['ltid']);
    $vars = search_lootdrops($_POST['search']);
    $body->set('results', $vars);
    break;
  case 29:  // Add lootdrop by id
    check_authorization();
    $body = new Template("templates/loot/lootdrop.changebysearch.tmpl.php");
    $body->set('currzone', $z);
    $body->set('npcid', $npcid);
    $body->set('ltid', $_GET['ltid']);
    $body->set('ldid', $_GET['ldid']);
    break;
  case 30:  // Add new loottable
    check_authorization();
    $body = new Template("templates/loot/lootdrop.add.tmpl.php");
    $body->set('currzone', $z);
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
    header("Location: index.php?editor=loot&z=$z&npcid=$npcid");
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
    $body->set('npcid', $_GET['npcid']);
    $body->set('ldid', $_GET['ldid']);
    $ldrop = loottables_using_lootdrop();
    $body->set("ldrop", $ldrop);
    break;
}

function loottable_info () {
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
      $query3 = "SELECT lootdrop_entries.*, items.name AS name
                 FROM lootdrop_entries, items
                 WHERE lootdrop_entries.lootdrop_id='$lootdrop'
                 AND lootdrop_entries.item_id=items.id";
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

function mobs_using_loottable () {
  global $mysql, $npcid;

  $query = "SELECT loottable_id
            FROM npc_types
            WHERE id=$npcid";
  $result = $mysql->query_assoc($query);
  $ltid = $result['loottable_id'];

  $query = "SELECT id, name FROM npc_types WHERE loottable_id=$ltid";
  $results = $mysql->query_mult_assoc($query);
  $count = count($results);
  return array("count"=>$count, "mobs"=>$results);
}

function loottables_using_lootdrop () {
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

function change_npc_loottable () {
  check_authorization();
  global $mysql, $npcid;
  $id = $_REQUEST['id'];
  $query = "UPDATE npc_types SET loottable_id=$id WHERE id=$npcid";
  $mysql->query_no_result($query);
}

function suggest_new_loottable () {
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
  $query = "UPDATE lootdrop_entries SET equip_item=$equip, item_charges=$charges, chance=$chance WHERE lootdrop_id=$ldid AND item_id=$itemid";
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

function update_lootdrop_name () {
  check_authorization();
  global $mysql;
  $ldname = $_POST['ldname'];
  $ldid = $_GET['ldid'];
  $query = "UPDATE lootdrop SET name=\"$ldname\" WHERE id=$ldid";
  $mysql->query_no_result($query);
}

function loottable_entries_info () {
  global $mysql;
  $ltid = $_GET['ltid'];
  $ldid = $_GET['ldid'];
  $query = "SELECT * FROM loottable_entries WHERE loottable_id=$ltid AND lootdrop_id=$ldid";
  $result = $mysql->query_assoc($query);
  return $result;
}

function update_loottable_entries () {
  check_authorization();
  global $mysql;
  $prob = $_POST['prob'];
  $mult = $_POST['mult'];
  $ltid = $_GET['ltid'];
  $ldid = $_GET['ldid'];
  $query = "UPDATE loottable_entries SET probability=$prob, multiplier=$mult WHERE loottable_id=$ltid AND lootdrop_id=$ldid";
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

function balance_drops () {
  check_authorization();
  global $mysql;
  $ldid = $_GET['ldid'];
  
  $query = "SELECT count(item_id) AS count FROM lootdrop_entries WHERE lootdrop_id=$ldid";
  $result = $mysql->query_assoc($query);
  
  $count = $result['count'];
  
  $remainder = 100 % $count;
  $base = floor(100 / $count);
  $x = $count - $remainder;
  
  $query = "SELECT * FROM lootdrop_entries WHERE lootdrop_id=$ldid";
  $results = $mysql->query_mult_assoc($query);
  
  foreach ($results as $result) {
    $itemid = $result['item_id'];
    if ($x > 0) {
      $chance = $base;
      $x--;
    }
    else $chance = $base + 1;
    $query = "UPDATE lootdrop_entries SET chance=$chance WHERE lootdrop_id=$ldid AND item_id=$itemid";
    $mysql->query_no_result($query);
  }
}

function remove_lootdrop_from_loottable() {
  check_authorization();
  global $mysql;
  $ltid = $_GET['ltid'];
  $ldid = $_GET['ldid'];
  
  $query = "DELETE FROM loottable_entries WHERE lootdrop_id='$ldid' AND loottable_id='$ltid'";
  $mysql->query_no_result($query);
}

function add_lootdrop_item ($itemid) {
  check_authorization();
  global $mysql;
  $ldid = $_GET['ldid'];
  
  $query = "INSERT INTO lootdrop_entries SET lootdrop_id=$ldid, item_id=$itemid";
  $mysql->query_no_result($query);
}

function assign_lootdrop () {
  check_authorization();
  global $mysql;
  
  $ltid = $_POST['ltid'];
  $ldid = $_POST['ldid'];
  $prob = $_POST['prob'];
  $mult = $_POST['mult'];
  
  $query = "INSERT INTO loottable_entries SET loottable_id='$ltid', lootdrop_id='$ldid', multiplier='$mult', probability='$prob'";
  $mysql->query_no_result($query);
}

function delete_lootdrop () {
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

function suggest_new_lootdrop () {
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
?>