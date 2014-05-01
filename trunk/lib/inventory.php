<?php

$list_limit = 500;

$slots = array(
  0 => "Charm",
  1 => "Left Ear",
  2 => "Head",
  3 => "Face",
  4 => "Right Ear",
  5 => "Neck",
  6 => "Shoulders",
  7 => "Arms",
  8 => "Back",
  9 => "Left Wrist",
 10 => "Right Wrist",
 11 => "Range",
 12 => "Hands",
 13 => "Primary",
 14 => "Secondary",
 15 => "Left Finger",
 16 => "Right Finger",
 17 => "Chest",
 18 => "Legs",
 19 => "Feet",
 20 => "Waist",
 21 => "Ammo",
 22 => "Bag01",
 23 => "Bag02",
 24 => "Bag03",
 25 => "Bag04",
 26 => "Bag05",
 27 => "Bag06",
 28 => "Bag07",
 29 => "Bag08"
);

switch ($action) {
  case 0:
    check_admin_authorization();
    if (isset($_GET['playerid']) && ($_GET['playerid'] > 0)) {
      $playerid = $_GET['playerid'];
      header("Location: index.php?editor=inv&playerid=$playerid&action=1");
      exit;
    }
    else {
      $body = new Template("templates/inventory/inventory.default.tmpl.php");
    }
    break;
  case 1:  //View Player Inventory
    check_admin_authorization();
    if (isset($_GET['playerid']) && ($_GET['playerid'] > 0)) {
      $inventory = player_inventory($_GET['playerid']);
    }
    $body = new Template("templates/inventory/inventory.player.tmpl.php");
    if ($inventory) {
      $body->set("inventory", $inventory);
      $body->set("playerid", $_GET['playerid']);
      $body->set("slots", $slots);
    }
    break;
  case 2: //Search by Player ID or Player Name
    check_admin_authorization();
    $search_results = "";
    if (isset($_GET['playerid']) && ($_GET['playerid'] != "") && ($_GET['playerid'] != "Player ID")) {
      $search_results = search_by_playerid($_GET['playerid']);
    }
    elseif (isset($_GET['player_name']) && ($_GET['player_name'] != "") && ($_GET['player_name'] != "Player Name")) {
      $search_results = search_by_playername($_GET['player_name'], $list_limit);
    }
    $body = new Template("templates/inventory/inventory.searchresults.tmpl.php");
    $body->set('search_results', $search_results);
    $body->set("list_limit", $list_limit);
    break;
  case 3: //Search by Item ID
    check_admin_authorization();
    $search_results = "";
    if (isset($_GET['item_id']) && ($_GET['item_id'] != "") && ($_GET['item_id'] != "Item ID")) {
      $search_results = search_by_itemid($_GET['item_id'], $list_limit);
    }
    $body = new Template("templates/inventory/inventory.searchresults.tmpl.php");
    $body->set("search_results", $search_results);
    $body->set("item_id", $_GET['item_id']);
    $body->set("list_limit", $list_limit);
    break;
  case 4: //Add item to inventory
    check_admin_authorization();
    $playerid = $_GET['playerid'];
    $body = new Template("templates/inventory/inventory.add.tmpl.php");
    $body->set("playerid", $playerid);
    break;
  case 5: //Insert item into inventory
    check_admin_authorization();
    $playerid = $_POST['charid'];
    insert_inv_item();
    header("Location: index.php?editor=inv&playerid=$playerid&action=1");
    exit;
  case 6: //Edit item in inventory
    check_admin_authorization();
    $inv_item = inv_slot_details($_GET['playerid'], $_GET['slotid']);
    $body = new Template("templates/inventory/inventory.edit.tmpl.php");
    $body->set("inv_item", $inv_item);
    $body->set("slots", $slots);
    break;
  case 7: //Update item in inventory
    check_admin_authorization();
    $playerid = $_POST['charid'];
    update_inv_item();
    header("Location: index.php?editor=inv&playerid=$playerid&action=1");
    exit;
  case 8: //Delete item from inventory
    check_admin_authorization();
    $playerid = $_GET['playerid'];
    delete_inv_item($playerid, $_GET['slotid']);
    header("Location: index.php?editor=inv&playerid=$playerid&action=1");
    exit;
}

function player_inventory($player_id) {
  global $mysql;

  $query = "SELECT charid, slotid, itemid FROM inventory WHERE charid=$player_id";
  $results = $mysql->query_mult_assoc($query);

  return $results;
}

function inv_slot_details($player_id, $slot_id) {
  global $mysql;

  $query = "SELECT * FROM inventory WHERE charid=$player_id AND slotid=$slot_id";
  $results = $mysql->query_assoc($query);

  return $results;
}

function search_by_playerid($player_id) {
  global $mysql;

  $query = "SELECT DISTINCT(charid) AS charid FROM INVENTORY WHERE charid=$player_id";
  $results = $mysql->query_mult_assoc($query);

  return $results;
}

function search_by_playername($player_name, $list_limit) {
  global $mysql;

  $query = "SELECT id AS charid FROM character_ WHERE `name` RLIKE \"$player_name\" LIMIT $list_limit";
  $results = $mysql->query_mult_assoc($query);

  return $results;
}

function search_by_itemid($item_id, $list_limit) {
  global $mysql;

  $query = "SELECT DISTINCT(charid) AS charid FROM inventory WHERE itemid=$item_id LIMIT $list_limit";
  $results = $mysql->query_mult_assoc($query);

  return $results;
}

function delete_inv_item($player_id, $slot_id) {
  global $mysql;

  $query = "DELETE FROM inventory WHERE charid=$player_id AND slotid=$slot_id";
  $mysql->query_no_result($query);
}

function update_inv_item() {
  global $mysql;

  $charid = $_POST['charid'];
  $slotid = $_POST['slotid'];
  $itemid = $_POST['itemid'];
  $charges = $_POST['charges'];
  $color = $_POST['color'];
  $augslot1 = $_POST['augslot1'];
  $augslot2 = $_POST['augslot2'];
  $augslot3 = $_POST['augslot3'];
  $augslot4 = $_POST['augslot4'];
  $augslot5 = $_POST['augslot5'];
  $instnodrop = ($_POST['instnodrop'] == 'on') ? 1 : 0;
  $custom_data = $_POST['custom_data'];

  $query = "UPDATE inventory SET itemid=$itemid, charges=$charges, color=$color, augslot1=$augslot1, augslot2=$augslot2, augslot3=$augslot3, augslot4=$augslot4, augslot5=$augslot5, instnodrop=$instnodrop, custom_data=\"$custom_data\" WHERE charid=$charid AND slotid=$slotid";
  $mysql->query_no_result($query);
}

function insert_inv_item() {
  global $mysql;

  $charid = $_POST['charid'];
  $slotid = $_POST['slotid'];
  $itemid = $_POST['itemid'];
  $charges = $_POST['charges'];
  $color = $_POST['color'];
  $augslot1 = $_POST['augslot1'];
  $augslot2 = $_POST['augslot2'];
  $augslot3 = $_POST['augslot3'];
  $augslot4 = $_POST['augslot4'];
  $augslot5 = $_POST['augslot5'];
  $instnodrop = ($_POST['instnodrop'] == 'on') ? 1 : 0;
  $custom_data = $_POST['custom_data'];

  $query = "INSERT INTO inventory SET charid=$charid, slotid=$slotid, itemid=$itemid, charges=$charges, color=$color, augslot1=$augslot1, augslot2=$augslot2, augslot3=$augslot3, augslot4=$augslot4, augslot5=$augslot5, instnodrop=$instnodrop, custom_data=\"$custom_data\"";
  $mysql->query_no_result($query);
}
?>