<?php

switch ($action) {
  case 0:
    $body = new Template("templates/altcur/altcur.default.tmpl.php");
    break;
  case 1: // View Items
    $breadcrumbs .= " >> Items";
    $body = new Template("templates/altcur/altcur.items.tmpl.php");
    $altcur_items = get_altcur_items();
    if ($altcur_items) {
      $body->set('altcur_items', $altcur_items);
    }
    break;
  case 2: // Add Item
    check_authorization();
    $breadcrumbs .= " >> <a href='index.php?editor=altcur&action=1'>Items</a> >> Add Item";
    $body = new Template("templates/altcur/item.add.tmpl.php");
    $new_id = get_next_currid();
    $body->set('new_id', $new_id);
    break;
  case 3: // Insert Item
    check_authorization();
    insert_altcur_item();
    header("Location: index.php?editor=altcur&action=1");
    exit;
  case 4: // Edit Item
    check_authorization();
    $breadcrumbs .= " >> <a href='index.php?editor=altcur&action=1'>Items</a> >> Edit Item";
    $body = new Template("templates/altcur/item.edit.tmpl.php");
    $altcur_item = view_altcur_item();
    $body->set('altcur_item', $altcur_item);
    break;
  case 5: // Update Item
    check_authorization();
    update_altcur_item();
    header("Location: index.php?editor=altcur&action=1");
    exit;
  case 6: // Delete Item
    check_authorization();
    delete_altcur_item();
    header("Location: index.php?editor=altcur&action=1");
    exit;
  case 7: // View NPCs
    $breadcrumbs .= " >> NPCs";
    $body = new Template("templates/altcur/altcur.npcs.tmpl.php");
    $altcur_npcs = get_altcur_npcs();
    if ($altcur_npcs) {
      $body->set('altcur_npcs', $altcur_npcs);
    }
    break;
  case 8: // Add NPC
    check_authorization();
    $breadcrumbs .= " >> <a href='index.php?editor=altcur&action=7'>NPCs</a> >> Add NPC";
    $body = new Template("templates/altcur/npc.add.tmpl.php");
    $currencies = get_altcur_items();
    if ($currencies) {
      $body->set('currencies', $currencies);
    }
    if ($_GET['npcid']) {
      $body->set('npcid', $_GET['npcid']);
    }
    break;
  case 9: // Insert NPC
    check_authorization();
    update_altcur_npc();
    header("Location: index.php?editor=altcur&action=7");
    exit;
  case 10: // Edit NPC
    check_authorization();
    $breadcrumbs .= " >> <a href='index.php?editor=altcur&action=7'>NPCs</a> >> Edit NPC";
    $body = new Template("templates/altcur/npc.edit.tmpl.php");
    $curr_id = view_altcur_npc();
    $currencies = get_altcur_items();
    if ($currencies) {
      $body->set('currencies', $currencies);
    }
    $body->set('curr_id', $curr_id);
    $body->set('npcid', $_GET['npcid']);
    break;
  case 11: // Update NPC
    check_authorization();
    update_altcur_npc();
    header("Location: index.php?editor=altcur&action=7");
    exit;
  case 12: // Delete NPC
    check_authorization();
    delete_altcur_npc();
    header("Location: index.php?editor=altcur&action=7");
    exit;
  case 13: // View Characters
    check_authorization();
    $breadcrumbs .= " >> Characters";
    $body = new Template("templates/altcur/altcur.characters.tmpl.php");
    $altcur_characters = get_altcur_characters();
    if ($altcur_characters) {
      $body->set('altcur_characters', $altcur_characters);
    }
    break;
  case 14: // Add Character
    check_authorization();
    $breadcrumbs .= " >> <a href='index.php?editor=altcur&action=13'>Characters</a> >> Add Character";
    $body = new Template("templates/altcur/character.add.tmpl.php");
    $currencies = get_altcur_items();
    if ($currencies) {
      $body->set('currencies', $currencies);
    }
    break;
  case 15: // Insert Character
    check_authorization();
    insert_altcur_character();
    header("Location: index.php?editor=altcur&action=13");
    exit;
  case 16: // Edit Character
    check_authorization();
    $breadcrumbs .= " >> <a href='index.php?editor=altcur&action=13'>Characters</a> >> Edit Character";
    $body = new Template("templates/altcur/character.edit.tmpl.php");
    $altcur_char = view_altcur_character();
    if ($altcur_char) {
      $body->set('altcur_char', $altcur_char);
    }
    $currencies = get_altcur_items();
    if ($currencies) {
      $body->set('currencies', $currencies);
    }
    break;
  case 17: // Update Character
    check_authorization();
    update_altcur_character();
    header("Location: index.php?editor=altcur&action=13");
    exit;
  case 18: // Delete Character
    check_authorization();
    delete_altcur_character();
    header("Location: index.php?editor=altcur&action=13");
    exit;
}

function get_altcur_items() {
  global $mysql_content_db;

  $query = "SELECT * FROM alternate_currency";
  $results = $mysql_content_db->query_mult_assoc($query);

  return $results;
}

function view_altcur_item() {
  global $mysql_content_db;
  $id = $_GET['id'];

  $query = "SELECT * FROM alternate_currency WHERE id=$id";
  $result = $mysql_content_db->query_assoc($query);

  return $result;
}

function insert_altcur_item() {
  global $mysql_content_db;
  $id = $_POST['id'];
  $item_id = $_POST['item_id'];

  $query = "INSERT INTO alternate_currency SET id=$id, item_id=$item_id";
  $mysql_content_db->query_no_result($query);
}

function update_altcur_item() {
  global $mysql_content_db;
  $old_id = $_POST['old_id'];
  $new_id = $_POST['new_id'];
  $item_id = $_POST['item_id'];

  $query = "UPDATE alternate_currency SET id=$new_id, item_id=$item_id WHERE id=$old_id";
  $mysql_content_db->query_no_result($query);
}

function delete_altcur_item() {
  global $mysql_content_db;
  $id = $_GET['id'];

  $query = "DELETE FROM alternate_currency WHERE id=$id";
  $mysql_content_db->query_no_result($query);
}

function get_altcur_npcs() {
  global $mysql_content_db;

  $query = "SELECT id, alt_currency_id FROM npc_types WHERE alt_currency_id > 0";
  $results = $mysql_content_db->query_mult_assoc($query);

  return $results;
}

function view_altcur_npc() {
  global $mysql_content_db;
  $npcid = $_GET['npcid'];

  $query = "SELECT alt_currency_id FROM npc_types WHERE id=$npcid";
  $result = $mysql_content_db->query_assoc($query);

  return $result['alt_currency_id'];
}

function update_altcur_npc() {
  global $mysql_content_db;
  $npcid = $_POST['npcid'];
  $curr_id = $_POST['curr_id'];

  $query = "UPDATE npc_types SET alt_currency_id=$curr_id WHERE id=$npcid";
  $mysql_content_db->query_no_result($query);
}

function delete_altcur_npc() {
  global $mysql_content_db;
  $npcid = $_GET['npcid'];

  $query = "UPDATE npc_types SET alt_currency_id=0 WHERE id=$npcid";
  $mysql_content_db->query_no_result($query);
}

function get_altcur_characters() {
  global $mysql;

  $query = "SELECT * FROM character_alt_currency";
  $results = $mysql->query_mult_assoc($query);

  return $results;
}

function view_altcur_character() {
  global $mysql;
  $charid = $_GET['charid'];
  $currid = $_GET['currencyid'];

  $query = "SELECT * FROM character_alt_currency WHERE char_id=$charid AND currency_id=$currid";
  $result = $mysql->query_assoc($query);

  return $result;
}

function insert_altcur_character() {
  global $mysql;
  $char_id = $_POST['char_id'];
  $currency_id = $_POST['currency_id'];
  $amount = $_POST['amount'];

  $query = "INSERT INTO character_alt_currency (char_id, currency_id, amount) VALUES ($char_id, $currency_id, $amount)";
  $mysql->query_no_result($query);
}

function update_altcur_character() {
  global $mysql;
  $char_id = $_POST['char_id'];
  $currency_id = $_POST['currency_id'];
  $amount = $_POST['amount'];
  $oldcurr = $_POST['oldcurr'];

  $query = "UPDATE character_alt_currency SET currency_id=$currency_id, amount=$amount WHERE char_id=$char_id AND currency_id=$oldcurr";
  $mysql->query_no_result($query);
}

function delete_altcur_character() {
  global $mysql;
  $char_id = $_GET['charid'];
  $currency_id = $_GET['currencyid'];

  $query = "DELETE FROM character_alt_currency WHERE char_id=$char_id AND currency_id=$currency_id";
  $mysql->query_no_result($query);
}

function get_next_currid() {
  global $mysql_content_db;

  $query = "SELECT MAX(id) AS maxid FROM alternate_currency";
  $result = $mysql_content_db->query_assoc($query);

  return $result['maxid'] + 1;
}
?>