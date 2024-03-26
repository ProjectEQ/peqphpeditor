<?php

$comparison = array(
 0 => "==",
 1 => "!=",
 2 => ">=",
 3 => "<=",
 4 => ">",
 5 => "<",
 6 => "is any of",
 7 => "is not any of",
 8 => "is between",
 9 => "is not between"
);

switch ($action) {
  case 0:  // View Merchantlist
    if ($npcid) {
      $body = new Template("templates/merchant/merchant.tmpl.php");
      $body->set('currzone', $z);
      $body->set('currzoneid', $zoneid);
      $body->set('npcid', $npcid);
      $vars = get_merchantlist();
      if ($vars) {
        foreach ($vars as $key=>$value) {
          $body->set($key, $value);
        }
      }
    }
    else {
       $body = new Template("templates/merchant/merchant.default.tmpl.php");
    }
    break;
  case 1: // Edit merchant item
    check_authorization();
    $body = new Template("templates/merchant/item.edit.tmpl.php");
    $javascript .= file_get_contents("templates/merchant/js.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    $vars = get_ware();
    if ($vars) {
      foreach ($vars as $key=>$value) {
        $body->set($key, $value);
      }
    }
    $body->set('comparison', $comparison);
    break;
  case 2: // Update merchant item
    check_authorization();
    update_merchant_item();
    header("Location: index.php?editor=merchant&z=$z&zoneid=$zoneid&npcid=$npcid");
    exit;
  case 3:  // Delete merchant item
    check_authorization();
    delete_ware();
    header("Location: index.php?editor=merchant&z=$z&zoneid=$zoneid&npcid=$npcid");
    exit;
  case 4: // Add item to Merchant
    check_authorization();
    $javascript .= file_get_contents("templates/iframes/js.tmpl.php");
    $javascript .= file_get_contents("templates/merchant/js.tmpl.php");
    $body = new Template("templates/merchant/item.add.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    $body->set('mid', $_GET['mid']);
    $slot = next_slot($_GET['mid']);
    if ($slot) {
      $body->set('slot', $slot);
    }
    $body->set('comparison', $comparison);
    break;
  case 5: // Add item
    check_authorization();
    add_merchant_item();
    header("Location: index.php?editor=merchant&z=$z&zoneid=$zoneid&npcid=$npcid");
    exit;
  case 6: // Delete Merchantlist
    check_authorization();
    delete_merchantlist();
    header("Location: index.php?editor=merchant&z=$z&zoneid=$zoneid&npcid=$npcid");
    exit;
  case 7:  // Search merchant by item
    check_authorization();
    $body = new Template("templates/merchant/merchant.searchresults.tmpl.php");
    if (isset($_GET['npcid']) && $_GET['npcid'] != "ID") {
      $results = search_npc_by_id();
    }
    if (isset($_GET['search1']) && $_GET['search1'] != "Item ID") {
      $results = search_temp_merchant();
    }
    if (isset($_GET['search']) && $_GET['search'] != "Enter Item ID") {
      $results = search_merchant_by_item();
    }
    if (isset($results)) {
      $body->set("results", $results);
    }
    break;
  case 8:  // View Temp Merchantlist
    if ($npcid) {
      $body = new Template("templates/merchant/merchant_temp.tmpl.php");
      $body->set('currzone', $z);
      $body->set('currzoneid', $zoneid);
      $body->set('npcid', $npcid);
      $body->set('zoneids', $zoneids);
      $vars = get_merchantlist_temp();
      if ($vars) {
        foreach ($vars as $key=>$value) {
          $body->set($key, $value);
        }
      }
    }
    break;
  case 9: // Edit Temp Merchantlist
    check_authorization();
    $body = new Template("templates/merchant/merchant_temp.edit.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    $body->set('zoneids', $zoneids);
    $vars = get_merchantlist_temp();
    if ($vars) {
      foreach ($vars as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
  case 10:
    check_authorization();
    update_merchantlist_temp();
    header("Location: index.php?editor=merchant&z=$z&zoneid=$zoneid&npcid=$npcid&action=8");
    exit;
  case 11:  // Delete temp item from merchant
    check_authorization();
    delete_temp_ware();
    header("Location: index.php?editor=merchant&z=$z&zoneid=$zoneid&npcid=$npcid&action=8");
    exit;
  case 12: // Add temp item to Merchant
    check_authorization();
    $javascript .= file_get_contents("templates/iframes/js.tmpl.php");
    $body = new Template("templates/merchant/item_temp.add.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    $body->set('zoneids', $zoneids);
    break;
  case 13: // Add item
    check_authorization();
    add_merchant_item_temp();
    header("Location: index.php?editor=merchant&z=$z&zoneid=$zoneid&npcid=$npcid&action=8");
    exit;
  case 14: // Delete Temp Merchantlist
    check_authorization();
    delete_merchantlist_temp();
    header("Location: index.php?editor=merchant&z=$z&zoneid=$zoneid&npcid=$npcid");
    exit;
  case 15: // Wipe Temp Merchantlists
    check_authorization();
    wipe_merchantlist_temp();
    header("Location: index.php?editor=merchant");
    exit;
  case 16: // NPCs using merchantlist
    check_authorization();
    $body = new Template("templates/merchant/npcsbymerchant.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $_GET['npcid']);
    $body->set('merid', $_GET['merid']);
    $merlist = npcs_using_merchantlist();
    $body->set("merlist", $merlist);
    break;
  case 17: // Drop Merchantlist
    check_authorization();
    drop_merchantlist();
    header("Location: index.php?editor=merchant&z=$z&zoneid=$zoneid&npcid=$npcid");
    exit;
  case 18: // Copy Merchantlist
    check_authorization();
    copy_merchantlist();
    header("Location: index.php?editor=merchant&z=$z&zoneid=$zoneid&npcid=$npcid");
    exit;
  case 19: // Sort Merchantlist
    check_authorization();
    sort_merchantlist();
    header("Location: index.php?editor=merchant&z=$z&zoneid=$zoneid&npcid=$npcid");
    exit;
  case 20: // Change Merchantlist to match NPCID
    check_authorization();
    merchantlist_npcid();
    header("Location: index.php?editor=merchant&z=$z&zoneid=$zoneid&npcid=$npcid");
    exit;
}

function get_merchantlist() {
  global $mysql_content_db;
  $mid = get_merchant_id();
  $array = array();

  $array['id'] = $mid;
  $query = "SELECT * FROM merchantlist WHERE merchantid=$mid";
  $results = $mysql_content_db->query_mult_assoc($query);
  if ($results) {
    foreach ($results as $result) {
      $result['item_name'] = 'Item not in DB';
      $array['slots'][$result['slot']] = array("item"=>$result['item'], "item_name"=>$result['item_name'], "faction_required"=>$result['faction_required'], "level_required"=>$result['level_required'], "min_status"=>$result['min_status'], "max_status"=>$result['max_status'], "alt_currency_cost"=>$result['alt_currency_cost'], "classes_required"=>$result['classes_required'], "probability"=>$result['probability'], "bucket_name"=>$result['bucket_name'], "bucket_value"=>$result['bucket_value'], "bucket_comparison"=>$result['bucket_comparison'], "min_expansion"=>$result['min_expansion'], "max_expansion"=>$result['max_expansion'], "content_flags"=>$result['content_flags'], "content_flags_disabled"=>$result['content_flags_disabled']);
    }
  }

  $query = "SELECT m.merchantid, m.slot, m.item, i.price, i.sellrate, m.faction_required, m.level_required, m.min_status, m.max_status, m.alt_currency_cost, m.classes_required, m.probability, m.bucket_name, m.bucket_value, m.bucket_comparison, m.min_expansion, m.max_expansion, m.content_flags, m.content_flags_disabled FROM merchantlist AS m, items AS i WHERE i.id=m.item AND merchantid=$mid";
  $results = $mysql_content_db->query_mult_assoc($query);
  if ($results) {
      foreach ($results as $result) {
          $result['item_name'] = get_item_name($result['item']);
          $array['slots'][$result['slot']] = array("item"=>$result['item'], "item_name"=>$result['item_name'], "price"=>$result['price'], "sellrate"=>$result['sellrate'], "faction_required"=>$result['faction_required'], "level_required"=>$result['level_required'], "min_status"=>$result['min_status'], "max_status"=>$result['max_status'], "alt_currency_cost"=>$result['alt_currency_cost'], "classes_required"=>$result['classes_required'], "probability"=>$result['probability'], "bucket_name"=>$result['bucket_name'], "bucket_value"=>$result['bucket_value'], "bucket_comparison"=>$result['bucket_comparison'], "min_expansion"=>$result['min_expansion'], "max_expansion"=>$result['max_expansion'], "content_flags"=>$result['content_flags'], "content_flags_disabled"=>$result['content_flags_disabled']);
        }
  }

  return $array;
}

function get_merchantlist_temp() {
  global $mysql, $mysql_content_db;

  $array = array();
  $npcid = $_GET['npcid'];

  $query = "SELECT slot, zone_id, instance_id, itemid, charges FROM merchantlist_temp WHERE npcid=$npcid";
  $m_results = $mysql->query_mult_assoc($query);
  if ($m_results) {
    foreach ($m_results as $m_result) {
      $query = "SELECT Name, price, sellrate FROM items WHERE id=" . $m_result['itemid'];
      $i_result = $mysql_content_db->query_assoc($query);
      if ($i_result) {
        $array['slots'][$m_result['slot']] = array("zone_id"=>$m_result['zone_id'], "instance_id"=>$m_result['instance_id'], "itemid"=>$m_result['itemid'], "charges"=>$m_result['charges'], "item_name"=>$i_result['Name'], "price"=>$i_result['price'], "sellrate"=>$i_result['sellrate']);
      }
      else {
        $array['slots'][$m_result['slot']] = array("zone_id"=>$m_result['zone_id'], "instance_id"=>$m_result['instance_id'], "itemid"=>$m_result['itemid'], "charges"=>$m_result['charges'], "item_name"=>"Item not in DB", "price"=>0, "sellrate"=>0);
      }
    }
  }

  return $array;
}

function update_merchant_item() {
  check_authorization();
  global $mysql_content_db, $npcid;

  $merchantid = $_POST['merchantid'];
  $slot = $_POST['slot'];
  $item = $_POST['item'];
  $faction_required = $_POST['faction_required'];
  $level_required = $_POST['level_required'];
  $min_status = $_POST['min_status'];
  $max_status = $_POST['max_status'];
  $alt_currency_cost = $_POST['alt_currency_cost'];
  $classes_required = $_POST['classes_required'];
  $probability = $_POST['probability'];
  $bucket_name = $_POST['bucket_name'];
  $bucket_value = $_POST['bucket_value'];
  $bucket_comparison = $_POST['bucket_comparison'];
  $min_expansion = $_POST['min_expansion'];
  $max_expansion = $_POST['max_expansion'];
  $content_flags = $_POST['content_flags'];
  $content_flags_disabled = $_POST['content_flags_disabled'];
  $new_slot = $_POST['new_slot'];

  $classes_value = 0;
  foreach ($classes_required as $v) {
    $classes_value = $classes_value ^ $v;
  }

  $query = "UPDATE merchantlist SET slot=$new_slot, item=$item, faction_required=$faction_required, level_required=$level_required, min_status=$min_status, max_status=$max_status, alt_currency_cost=$alt_currency_cost, classes_required=$classes_value, probability=$probability, bucket_name=\"$bucket_name\", bucket_value=\"$bucket_value\", bucket_comparison=$bucket_comparison, min_expansion=$min_expansion, max_expansion=$max_expansion, content_flags=NULL, content_flags_disabled=NULL WHERE merchantid=$merchantid AND slot=$slot";
  $mysql_content_db->query_no_result($query);

  if ($content_flags != "") {
    $query = "UPDATE merchantlist SET content_flags=\"$content_flags\" WHERE merchantid=$merchantid AND slot=$slot";
    $mysql_content_db->query_no_result($query);
  }

  if ($content_flags_disabled != "") {
    $query = "UPDATE merchantlist SET content_flags_disabled=\"$content_flags_disabled\" WHERE merchantid=$merchantid AND slot=$slot";
    $mysql_content_db->query_no_result($query);
  }
}

function update_merchantlist_temp() {
  check_authorization();
  global $mysql, $npcid;

  $count = $_POST['count'];
  $oldstats = get_merchantlist_temp();
  $i = 0;

  foreach ($oldstats['slots'] as $slot=>$values) {
    $i++;
    if (($slot != $_POST["newslot{$i}"]) || ($values['zone_id'] != $_POST["zone_id{$i}"]) || ($values['instance_id'] != $_POST["instance_id{$i}"]) || ($values['itemid'] != $_POST["itemid{$i}"]) || ($values['charges'] != $_POST["charges{$i}"])) {
      $query = "UPDATE merchantlist_temp SET slot=\"" . $_POST["newslot{$i}"] . "\", zone_id=\"" . $_POST["zone_id{$i}"] . "\", instance_id=\"" . $_POST["instance_id{$i}"] . "\", itemid=\"" . $_POST["itemid{$i}"] . "\", charges=\"" . $_POST["charges{$i}"] . "\" WHERE npcid=$npcid AND slot=" . $_POST["slot{$i}"];
      $mysql->query_no_result($query);
    }
  }
}

function get_ware() {
  global $mysql_content_db;
  $id = $_GET['id'];
  $slot = $_GET['slot'];
  $mid = $_GET['mid'];

  $query = "SELECT * FROM merchantlist WHERE merchantid=$mid AND slot=$slot AND item=$id";
  $result = $mysql_content_db->query_assoc($query);

  if ($result) {
    return $result;
  }
  else {
    return null;
  }
}

function delete_ware() {
  check_authorization();
  global $mysql_content_db;
  $id = $_GET['id'];
  $slot = $_GET['slot'];
  $mid = $_GET['mid'];

  $query = "DELETE FROM merchantlist WHERE merchantid=$mid AND slot=$slot AND item=$id";
  $mysql_content_db->query_no_result($query);
}

function delete_temp_ware() {
  check_authorization();
  global $mysql, $npcid;

  $zone_id = $_GET['zone_id'];
  $instance_id = $_GET['instance_id'];
  $itemid = $_GET['itemid'];
  $slot = $_GET['slot'];

  $query = "DELETE FROM merchantlist_temp WHERE npcid=$npcid AND slot=$slot AND zone_id=$zone_id AND instance_id=$instance_id AND itemid=$itemid";
  $mysql->query_no_result($query);
}

function add_merchant_item() {
  check_authorization();
  global $mysql_content_db;

  $mid = $_POST['mid'];
  $slot = $_POST['slot'];
  $item = $_POST['itemid'];
  $faction_required = $_POST['faction_required'];
  $level_required = $_POST['level_required'];
  $min_status = $_POST['min_status'];
  $max_status = $_POST['max_status'];
  $alt_currency_cost = $_POST['alt_currency_cost'];
  $classes_required = $_POST['classes_required'];
  $probability = $_POST['probability'];
  $bucket_name = $_POST['bucket_name'];
  $bucket_value = $_POST['bucket_value'];
  $bucket_comparison = $_POST['bucket_comparison'];
  $min_expansion = $_POST['min_expansion'];
  $max_expansion = $_POST['max_expansion'];
  $content_flags = $_POST['content_flags'];
  $content_flags_disabled = $_POST['content_flags_disabled'];

  $classes_value = 0;
  foreach ($classes_required as $v) {
    $classes_value = $classes_value ^ $v;
  }

  $query = "INSERT INTO merchantlist SET merchantid=$mid, slot=$slot, item=$item, faction_required=$faction_required, level_required=$level_required, min_status=$min_status, max_status=$max_status, alt_currency_cost=$alt_currency_cost, classes_required=$classes_value, probability=$probability, bucket_name=\"$bucket_name\", bucket_value=\"$bucket_value\", bucket_comparison=$bucket_comparison, min_expansion=$min_expansion, max_expansion=$max_expansion, content_flags=NULL, content_flags_disabled=NULL";
  $mysql_content_db->query_no_result($query);

  if ($content_flags != "") {
    $query = "UPDATE merchantlist SET content_flags=\"$content_flags\" WHERE merchantid=$mid AND slot=$slot";
    $mysql_content_db->query_no_result($query);
  }

  if ($content_flags_disabled != "") {
    $query = "UPDATE merchantlist SET content_flags_disabled=\"$content_flags_disabled\" WHERE merchantid=$mid AND slot=$slot";
    $mysql_content_db->query_no_result($query);
  }
}

function add_merchant_item_temp() {
  check_authorization();
  global $mysql, $mysql_content_db, $npcid;

  $zone_id = $_POST['zone_id'];
  $instance_id = $_POST['instance_id'];
  $itemid = $_POST['itemid'];
  $charges = $_POST['charges'];

  $query = "SELECT merchant_id AS mid FROM npc_types WHERE id=$npcid";
  $result = $mysql_content_db->query_assoc($query);
  $mid = $result['mid'];

  $query = "SELECT MAX(slot) AS mslot FROM merchantlist WHERE merchantid=$mid";
  $result = $mysql_content_db->query_assoc($query);
  $mslot = $result['mslot'] + 1;

  $query = "SELECT MAX(slot) AS tslot FROM merchantlist_temp WHERE npcid=$npcid";
  $result = $mysql->query_assoc($query);
  $tslot = $result['tslot'] + 1;

  if ($tslot < $mslot) {
    $query = "INSERT INTO merchantlist_temp SET npcid=$npcid, slot=$mslot, zone_id=$zone_id, instance_id=$instance_id, itemid=$itemid, charges=$charges";
    $mysql->query_no_result($query);
  }
  if ($tslot > $mslot) {
    $query = "INSERT INTO merchantlist_temp SET npcid=$npcid, slot=$tslot, zone_id=$zone_id, instance_id=$instance_id, itemid=$itemid, charges=$charges";
    $mysql->query_no_result($query);
  }
}

function next_slot($merchantid) {
  global $mysql_content_db;
  $query = "SELECT MAX(slot) AS slot FROM merchantlist WHERE merchantid=$merchantid";
  $result = $mysql_content_db->query_assoc($query);

  return $result['slot'] + 1;
}

function delete_merchantlist() {
  check_authorization();
  global $mysql_content_db, $npcid;
  $mid = $_GET['mid'];

  $query = "DELETE FROM merchantlist WHERE merchantid=$mid";
  $mysql_content_db->query_no_result($query);

  $query = "UPDATE npc_types SET merchant_id=0 WHERE id=$npcid";
  $mysql_content_db->query_no_result($query);
}

function delete_merchantlist_temp() {
  check_authorization();
  global $mysql, $npcid;

  $query = "DELETE FROM merchantlist_temp WHERE npcid=$npcid";
  $mysql->query_no_result($query);
}

function wipe_merchantlist_temp() {
  check_authorization();
  global $mysql;

  $query = "DELETE FROM merchantlist_temp";
  $mysql->query_no_result($query);
}

function search_merchant_by_item() {
  global $mysql_content_db;
  $search = $_GET['search'];

  $query = "SELECT npc_types.id, npc_types.name FROM merchantlist
            INNER JOIN npc_types ON npc_types.merchant_id=merchantlist.merchantid
            WHERE merchantlist.item=\"$search\"";
  $results = $mysql_content_db->query_mult_assoc($query);
  return $results;
}

function search_temp_merchant() {
  global $mysql;
  $search = $_GET['search1'];

  $query = "SELECT npc_types.id, npc_types.name FROM merchantlist_temp INNER JOIN npc_types ON npc_types.id=merchantlist_temp.npcid WHERE merchantlist_temp.slot < 81 and merchantlist_temp.itemid=\"$search\"";
  $results = $mysql->query_mult_assoc($query);
  return $results;
}

function npcs_using_merchantlist() {
  global $mysql_content_db;
  $array = array();
  $merid = $_GET['merid'];

  $query = "SELECT id AS npcid, name FROM npc_types WHERE merchant_id=$merid";
  $results = $mysql_content_db->query_mult_assoc($query);
  return $results;
  }

function drop_merchantlist() {
  check_authorization();
  global $mysql_content_db, $npcid;

  $query = "UPDATE npc_types SET merchant_id=0 WHERE id=$npcid";
  $mysql_content_db->query_no_result($query);
}

function copy_merchantlist() {
  check_authorization();
  global $mysql_content_db, $npcid;
  $mid = $_POST['mid'];

  $query = "SELECT MAX(merchantid) AS merid FROM merchantlist";
  $result = $mysql_content_db->query_assoc($query);
  $nmid = $result['merid'] + 1;

  $query = "DELETE FROM merchantlist WHERE merchantid=0";
  $mysql_content_db->query_no_result($query);

  $query = "INSERT INTO merchantlist (slot, item, faction_required, level_required, min_status, max_status, alt_currency_cost, classes_required, probability, bucket_name, bucket_value, bucket_comparison, min_expansion, max_expansion, content_flags, content_flags_disabled) SELECT slot, item, faction_required, level_required, min_status, max_status, alt_currency_cost, classes_required, probability, bucket_name, bucket_value, bucket_comparison, min_expansion, max_expansion, content_flags, content_flags_disabled FROM merchantlist WHERE merchantid=$mid";
  $mysql_content_db->query_no_result($query);

  $query = "UPDATE merchantlist SET merchantid=$nmid WHERE merchantid=0";
  $mysql_content_db->query_no_result($query);

  $query = "UPDATE npc_types SET merchant_id=$nmid WHERE id=$npcid";
  $mysql_content_db->query_no_result($query);
}

function sort_merchantlist() {
  check_authorization();
  global $mysql_content_db;
  $merchantid = get_merchant_id();
  $item_id = array();

  $query = "SELECT COUNT(slot) AS item_count FROM merchantlist WHERE merchantid=$merchantid";
  $result = $mysql_content_db->query_assoc($query);
  $item_count = $result['item_count'];

  $query = "SELECT MAX(slot) AS max_slot FROM merchantlist WHERE merchantid=$merchantid";
  $result = $mysql_content_db->query_assoc($query);
  $max_slot = $result['max_slot'];

  $query = "SELECT item FROM merchantlist WHERE merchantid=$merchantid";
  $results = $mysql_content_db->query_mult_assoc($query);

  foreach ($results as $result) {
    $item_id[] = $result['item'];
  }

  for ($i=0; $i<$item_count; $i++) {
    $query = "UPDATE merchantlist SET slot=$max_slot+$i+1 WHERE merchantid=$merchantid AND item=$item_id[$i]";
    $mysql_content_db->query_no_result($query);
  }

  for ($i=0; $i<$item_count; $i++) {
    $query = "UPDATE merchantlist SET slot=$i+1 WHERE merchantid=$merchantid AND item=$item_id[$i]";
    $mysql_content_db->query_no_result($query);
  }
}

function merchantlist_npcid() {
  check_authorization();
  global $mysql_content_db, $npcid;
  $mid = $_GET['mid'];

  $query = "SELECT COUNT(*) AS npc_count FROM npc_types WHERE merchant_id=$mid AND id != $npcid";
  $result = $mysql_content_db->query_assoc($query);
  $count = $result['npc_count'];

  if ($count == 0) {
    $query = "UPDATE npc_types set merchant_id=$npcid WHERE id=$npcid";
    $mysql_content_db->query_no_result($query);

    $query = "UPDATE merchantlist set merchantid=$npcid WHERE merchantid=$mid";
    $mysql_content_db->query_no_result($query);
  }
}
?>
