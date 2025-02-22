<?php

$list_limit = 500;

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
      $shared_inventory = shared_inventory($_GET['playerid']);
    }
    $body = new Template("templates/inventory/inventory.player.tmpl.php");
    $body->set("playerid", $_GET['playerid']);
    if ($inventory)
      $body->set("inventory", $inventory);
    if ($shared_inventory)
      $body->set("shared_inventory", $shared_inventory);
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
    $playerid = $_POST['character_id'];
    insert_inv_item();
    header("Location: index.php?editor=inv&playerid=$playerid&action=1");
    exit;
  case 6: //Edit item in inventory
    check_admin_authorization();
    $inv_item = inv_slot_details($_GET['playerid'], $_GET['slot_id']);
    $body = new Template("templates/inventory/inventory.edit.tmpl.php");
    $body->set("inv_item", $inv_item);
    break;
  case 7: //Update item in inventory
    check_admin_authorization();
    $playerid = $_POST['character_id'];
    update_inv_item();
    header("Location: index.php?editor=inv&playerid=$playerid&action=1");
    exit;
  case 8: //Delete item from inventory
    check_admin_authorization();
    $playerid = $_GET['playerid'];
    delete_inv_item($playerid, $_GET['slot_id']);
    header("Location: index.php?editor=inv&playerid=$playerid&action=1");
    exit;
}

function player_inventory($player_id) {
  global $mysql;

  $query = "SELECT character_id, slot_id, item_id FROM inventory WHERE character_id=$player_id ORDER BY slot_id";
  $results = $mysql->query_mult_assoc($query);

  return $results;
}

function shared_inventory($player_id) {
  global $mysql;

  $query = "SELECT account_id FROM character_data WHERE id=$player_id";
  $result = $mysql->query_assoc($query);
  $account_id = $result['account_id'];

  $query = "SELECT account_id, slot_id, item_id FROM sharedbank WHERE account_id=$account_id ORDER BY slot_id";
  $results = $mysql->query_mult_assoc($query);

  return $results;
}

function inv_slot_details($player_id, $slot_id) {
  global $mysql;

  $query = "SELECT * FROM inventory WHERE character_id=$player_id AND slot_id=$slot_id";
  $results = $mysql->query_assoc($query);

  return $results;
}

function search_by_playerid($player_id) {
  global $mysql;

  $query = "SELECT DISTINCT(character_id) AS character_id FROM inventory WHERE character_id=$player_id";
  $results = $mysql->query_mult_assoc($query);

  return $results;
}

function search_by_playername($player_name, $list_limit) {
  global $mysql;

  $query = "SELECT id AS character_id FROM character_data WHERE `name` RLIKE \"$player_name\" LIMIT $list_limit";
  $results = $mysql->query_mult_assoc($query);

  return $results;
}

function search_by_itemid($item_id, $list_limit) {
  global $mysql;

  $query = "SELECT DISTINCT(character_id) AS character_id FROM inventory WHERE item_id=$item_id LIMIT $list_limit";
  $results = $mysql->query_mult_assoc($query);

  return $results;
}

function delete_inv_item($player_id, $slot_id) {
  global $mysql;

  $query = "DELETE FROM inventory WHERE character_id=$player_id AND slot_id=$slot_id";
  $mysql->query_no_result($query);
}

function update_inv_item() {
  global $mysql;

  $character_id = $_POST['character_id'];
  $slot_id = $_POST['slot_id'];
  $item_id = $_POST['item_id'];
  $charges = $_POST['charges'];
  $color = $_POST['color'];
  $augment_one = $_POST['augment_one'];
  $augment_two = $_POST['augment_two'];
  $augment_three = $_POST['augment_three'];
  $augment_four = $_POST['augment_four'];
  $augment_five = $_POST['augment_five'];
  $augment_six = $_POST['augment_six'];
  $instnodrop = ($_POST['instnodrop'] == 'on') ? 1 : 0;
  $custom_data = $_POST['custom_data'];
  $ornament_icon = $_POST['ornament_icon'];
  $ornament_idfile = $_POST['ornament_idfile'];
  $ornament_hero_model = $_POST['ornament_hero_model'];

  $query = "UPDATE inventory SET item_id=$item_id, charges=$charges, color=$color, augment_one=$augment_one, augment_two=$augment_two, augment_three=$augment_three, augment_four=$augment_four, augment_five=$augment_five, augment_six=$augment_six, instnodrop=$instnodrop, custom_data=\"$custom_data\", ornament_icon=$ornament_icon, ornament_idfile=$ornament_idfile, ornament_hero_model=$ornament_hero_model WHERE character_id=$character_id AND slot_id=$slot_id";
  $mysql->query_no_result($query);
}

function insert_inv_item() {
  global $mysql;

  $character_id = $_POST['character_id'];
  $slot_id = $_POST['slot_id'];
  $item_id = $_POST['item_id'];
  $charges = $_POST['charges'];
  $color = $_POST['color'];
  $augment_one = $_POST['augment_one'];
  $augment_two = $_POST['augment_two'];
  $augment_three = $_POST['augment_three'];
  $augment_four = $_POST['augment_four'];
  $augment_five = $_POST['augment_five'];
  $augment_six = $_POST['augment_six'];
  $instnodrop = ($_POST['instnodrop'] == 'on') ? 1 : 0;
  $custom_data = $_POST['custom_data'];
  $ornament_icon = $_POST['ornament_icon'];
  $ornament_idfile = $_POST['ornament_idfile'];
  $ornament_hero_model = $_POST['ornament_hero_model'];

  $query = "INSERT INTO inventory SET character_id=$character_id, slot_id=$slot_id, item_id=$item_id, charges=$charges, color=$color, augment_one=$augment_one, augment_two=$augment_two, augment_three=$augment_three, augment_four=$augment_four, augment_five=$augment_five, augment_six=$augment_six, instnodrop=$instnodrop, custom_data=\"$custom_data\", ornament_icon=$ornament_icon, ornament_idfile=$ornament_idfile, ornament_hero_model=$ornament_hero_model";
  $mysql->query_no_result($query);
}

function get_slot_name($slot) {
  switch($slot) {
    case 0:
      return "Charm";
    case 1:
      return "Left Ear";
    case 2:
      return "Head";
    case 3:
      return "Face";
    case 4:
      return "Right Ear";
    case 5:
      return "Neck";
    case 6:
      return "Shoulders";
    case 7:
      return "Arms";
    case 8:
      return "Back";
    case 9:
      return "Left Wrist";
    case 10:
      return "Right Wrist";
    case 11:
      return "Range";
    case 12:
      return "Hands";
    case 13:
      return "Primary";
    case 14:
      return "Secondary";
    case 15:
      return "Left Finger";
    case 16:
      return "Right Finger";
    case 17:
      return "Chest";
    case 18:
      return "Legs";
    case 19:
      return "Feet";
    case 20:
      return "Waist";
    case 21:
      return "Power Source";
    case 22:
      return "Ammo";
    case ($slot >= 23 && $slot <= 32):                                      // Top-Level Inventory Slots
      return "Main" . str_pad($slot - 22, 2, "0", STR_PAD_LEFT);
    case 33:                                                                // Cursor Inventory Slot
      return "Cursor";
    case ($slot >= 2000 && $slot <= 2023):                                  // Bank Inventory Slots
      return "Bank" . str_pad($slot - 1999, 2, "0", STR_PAD_LEFT);
    case 2500:                                                              // Shared Bank 1 Inventory Slot
      return "SharedBank01";
    case 2501:                                                              // Shared Bank 2 Inventory Slot
      return "SharedBank02";
    case ($slot >= 4010 && $slot <= 4209):                                  // Bag 1 Inventory Slots
      return "Main01-" . str_pad($slot - 4009, 3, "0", STR_PAD_LEFT);
    case ($slot >= 4210 && $slot <= 4409):                                  // Bag 2 Inventory Slots
      return "Main02-" . str_pad($slot - 4209, 3, "0", STR_PAD_LEFT);
    case ($slot >= 4410 && $slot <= 4609):                                  // Bag 3 Inventory Slots
      return "Main03-" . str_pad($slot - 4409, 3, "0", STR_PAD_LEFT);
    case ($slot >= 4610 && $slot <= 4809):                                  // Bag 4 Inventory Slots
      return "Main04-" . str_pad($slot - 4609, 3, "0", STR_PAD_LEFT);
    case ($slot >= 4810 && $slot <= 5009):                                  // Bag 5 Inventory Slots
      return "Main05-" . str_pad($slot - 4809, 3, "0", STR_PAD_LEFT);
    case ($slot >= 5010 && $slot <= 5209):                                  // Bag 6 Inventory Slots
      return "Main06-" . str_pad($slot - 5009, 3, "0", STR_PAD_LEFT);
    case ($slot >= 5210 && $slot <= 5409):                                  // Bag 7 Inventory Slots
      return "Main07-" . str_pad($slot - 5209, 3, "0", STR_PAD_LEFT);
    case ($slot >= 5410 && $slot <= 5609):                                  // Bag 8 Inventory Slots
      return "Main08-" . str_pad($slot - 5409, 3, "0", STR_PAD_LEFT);
    case ($slot >= 5610 && $slot <= 5809):                                  // Bag 9 Inventory Slots
      return "Main09-" . str_pad($slot - 5609, 3, "0", STR_PAD_LEFT);
    case ($slot >= 5810 && $slot <= 6009):                                  // Bag 10 Inventory Slots
      return "Main10-" . str_pad($slot - 5809, 3, "0", STR_PAD_LEFT);
    case ($slot >= 6010 && $slot <= 6209):                                  // Cursor Bag Inventory Slots
      return "CursorBag-" . str_pad($slot - 6009, 3, "0", STR_PAD_LEFT);
    case ($slot >= 6210 && $slot <= 6409):                                  // Bank Bag 1 Inventory Slots
      return "Bank01-" . str_pad($slot - 6209, 3, "0", STR_PAD_LEFT);
    case ($slot >= 6410 && $slot <= 6609):                                  // Bank Bag 2 Inventory Slots
      return "Bank02-" . str_pad($slot - 6409, 3, "0", STR_PAD_LEFT);
    case ($slot >= 6610 && $slot <= 6809):                                  // Bank Bag 3 Inventory Slots
      return "Bank03-" . str_pad($slot - 6609, 3, "0", STR_PAD_LEFT);
    case ($slot >= 6810 && $slot <= 7009):                                  // Bank Bag 4 Inventory Slots
      return "Bank04-" . str_pad($slot - 6809, 3, "0", STR_PAD_LEFT);
    case ($slot >= 7010 && $slot <= 7209):                                  // Bank Bag 5 Inventory Slots
      return "Bank05-" . str_pad($slot - 7009, 3, "0", STR_PAD_LEFT);
    case ($slot >= 7210 && $slot <= 7409):                                  // Bank Bag 6 Inventory Slots
      return "Bank06-" . str_pad($slot - 7209, 3, "0", STR_PAD_LEFT);
    case ($slot >= 7410 && $slot <= 7609):                                  // Bank Bag 7 Inventory Slots
      return "Bank07-" . str_pad($slot - 7409, 3, "0", STR_PAD_LEFT);
    case ($slot >= 7610 && $slot <= 7809):                                  // Bank Bag 8 Inventory Slots
      return "Bank08-" . str_pad($slot - 7609, 3, "0", STR_PAD_LEFT);
    case ($slot >= 7810 && $slot <= 8009):                                  // Bank Bag 9 Inventory Slots
      return "Bank09-" . str_pad($slot - 7809, 3, "0", STR_PAD_LEFT);
    case ($slot >= 8010 && $slot <= 8209):                                  // Bank Bag 10 Inventory Slots
      return "Bank10-" . str_pad($slot - 8009, 3, "0", STR_PAD_LEFT);
    case ($slot >= 8210 && $slot <= 8409):                                  // Bank Bag 11 Inventory Slots
      return "Bank11-" . str_pad($slot - 8209, 3, "0", STR_PAD_LEFT);
    case ($slot >= 8410 && $slot <= 8609):                                  // Bank Bag 12 Inventory Slots
      return "Bank12-" . str_pad($slot - 8409, 3, "0", STR_PAD_LEFT);
    case ($slot >= 8610 && $slot <= 8809):                                  // Bank Bag 13 Inventory Slots
      return "Bank13-" . str_pad($slot - 8609, 3, "0", STR_PAD_LEFT);
    case ($slot >= 8810 && $slot <= 9009):                                  // Bank Bag 14 Inventory Slots
      return "Bank14-" . str_pad($slot - 8809, 3, "0", STR_PAD_LEFT);
    case ($slot >= 9010 && $slot <= 9209):                                  // Bank Bag 15 Inventory Slots
      return "Bank15-" . str_pad($slot - 9009, 3, "0", STR_PAD_LEFT);
    case ($slot >= 9210 && $slot <= 9409):                                  // Bank Bag 16 Inventory Slots
      return "Bank16-" . str_pad($slot - 9209, 3, "0", STR_PAD_LEFT);
    case ($slot >= 9410 && $slot <= 9609):                                  // Bank Bag 17 Inventory Slots
      return "Bank17-" . str_pad($slot - 9409, 3, "0", STR_PAD_LEFT);
    case ($slot >= 9610 && $slot <= 9809):                                  // Bank Bag 18 Inventory Slots
      return "Bank18-" . str_pad($slot - 9609, 3, "0", STR_PAD_LEFT);
    case ($slot >= 9810 && $slot <= 10009):                                 // Bank Bag 19 Inventory Slots
      return "Bank19-" . str_pad($slot - 9809, 3, "0", STR_PAD_LEFT);
    case ($slot >= 10010 && $slot <= 10209):                                // Bank Bag 20 Inventory Slots
      return "Bank20-" . str_pad($slot - 10009, 3, "0", STR_PAD_LEFT);
    case ($slot >= 10210 && $slot <= 10409):                                // Bank Bag 21 Inventory Slots
      return "Bank21-" . str_pad($slot - 10209, 3, "0", STR_PAD_LEFT);
    case ($slot >= 10410 && $slot <= 10609):                                // Bank Bag 22 Inventory Slots
      return "Bank22-" . str_pad($slot - 10409, 3, "0", STR_PAD_LEFT);
    case ($slot >= 10610 && $slot <= 10809):                                // Bank Bag 23 Inventory Slots
      return "Bank23-" . str_pad($slot - 10609, 3, "0", STR_PAD_LEFT);
    case ($slot >= 10810 && $slot <= 11009):                                // Bank Bag 24 Inventory Slots
      return "Bank24-" . str_pad($slot - 10809, 3, "0", STR_PAD_LEFT);
    case ($slot >= 11010 && $slot <= 11209):                                // Shared Bank Bag 1 Inventory Slots
      return "SharedBank01-" . str_pad($slot - 11009, 3, "0", STR_PAD_LEFT);
    case ($slot >= 11210 && $slot <= 11409):                                // Shared Bank Bag 2 Inventory Slots
      return "SharedBank02-" . str_pad($slot - 11209, 3, "0", STR_PAD_LEFT);
    default:
      return "UNK-" . $slot;
  }
}
?>