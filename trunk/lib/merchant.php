<?php

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
  case 1: // Edit Merchantlist
    check_authorization();
    $body = new Template("templates/merchant/merchant.edit.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    $vars = get_merchantlist();
    if ($vars) {
      foreach ($vars as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
  case 2:
    check_authorization();
    update_merchantlist();
    header("Location: index.php?editor=merchant&z=$z&zoneid=$zoneid&npcid=$npcid");
    exit;
  case 3:  // Delete item from merchant
    check_authorization();
    delete_ware();
    header("Location: index.php?editor=merchant&z=$z&zoneid=$zoneid&npcid=$npcid");
    exit;
  case 4: // Add item to Merchant
    check_authorization();
    $javascript .= file_get_contents("templates/iframes/js.tmpl.php");
    $body = new Template("templates/merchant/item.add.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    $body->set('mid', $_GET['mid']);
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
    $body->set("results", $results);
    break;
  case 8:  // View Temp Merchanlist
    if ($npcid) {
      $body = new Template("templates/merchant/merchant_temp.tmpl.php");
      $body->set('currzone', $z);
      $body->set('currzoneid', $zoneid);
      $body->set('npcid', $npcid);
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
  global $mysql;
  $mid = get_merchant_id();
  $array = array();

  $array['id'] = $mid;
  $query = "SELECT merchantid,slot,item,faction_required,level_required,alt_currency_cost,classes_required FROM merchantlist WHERE merchantid=$mid";
  $results = $mysql->query_mult_assoc($query);
  if ($results) {
      	foreach ($results as $result) {
  		$result['item_name'] = 'Item not in DB';
        	$array['slots'][$result['slot']] = array("item"=>$result['item'], "item_name"=>$result['item_name'], "faction_required"=>$result['faction_required'], "level_required"=>$result['level_required'], "alt_currency_cost"=>$result['alt_currency_cost'], "classes_required"=>$result['classes_required']);
      	}
  }
  $query = "SELECT m.merchantid,m.slot,m.item,i.price,i.sellrate,m.faction_required,m.level_required,m.alt_currency_cost,classes_required 
            FROM merchantlist AS m, items AS i 
            WHERE i.id = m.item AND merchantid=$mid";
  $results = $mysql->query_mult_assoc($query);
  if ($results) {
    	foreach ($results as $result) {
      		$result['item_name'] = get_item_name($result['item']);
      		$array['slots'][$result['slot']] = array("item"=>$result['item'], "item_name"=>$result['item_name'], "price"=>$result['price'], "sellrate"=>$result['sellrate'], "faction_required"=>$result['faction_required'], "level_required"=>$result['level_required'], "alt_currency_cost"=>$result['alt_currency_cost'], "classes_required"=>$result['classes_required']);
      	}
  }

  return $array;
}

function get_merchantlist_temp() {
  global $mysql;
  $array = array();

  $npcid = $_GET['npcid'];
  $query = "SELECT npcid,slot,itemid,charges FROM merchantlist_temp WHERE npcid=$npcid";
  $results = $mysql->query_mult_assoc($query);
  if ($results) {
      	foreach ($results as $result) {
  		$result['item_name'] = 'Item not in DB';
        	$array['slots'][$result['slot']] = array("itemid"=>$result['itemid'], "charges"=>$result['charges'], "item_name"=>$result['item_name']);
      	}
  }
  $query = "SELECT m.npcid,m.slot,m.itemid,m.charges,i.price,i.sellrate 
            FROM merchantlist_temp AS m, items AS i 
            WHERE i.id = m.itemid and npcid=$npcid";
  $results = $mysql->query_mult_assoc($query);
  if ($results) {
    	foreach ($results as $result) {
		$result['item_name'] = get_item_name($result['itemid']);
      		$array['slots'][$result['slot']] = array("itemid"=>$result['itemid'], "charges"=>$result['charges'], "item_name"=>$result['item_name'], "price"=>$result['price'], "sellrate"=>$result['sellrate']);
    	}
  }
  
  return $array;
}

function update_merchantlist() {
  check_authorization();
  global $mysql, $npcid;

  $mid = $_POST['mid'];
  $count = $_POST['count'];
  $oldstats = get_merchantlist();

	for ($i=1; $i<=$count; $i++){
		$slot = $_POST["slot{$i}"];
		if (($slot != $_POST["newslot{$i}"]) || ($values['item'] != $_POST["item{$i}"]) || ($values['faction_required'] != $_POST["faction_required{$i}"]) || 
        	($values['level_required'] != $_POST["level_required{$i}"]) || ($values['alt_currency_cost'] != $_POST["alt_currency_cost{$i}"]) || ($values['classes_required'] != $_POST["classes_required{$i}"])) {
			if($_POST["newslot{$i}"] > -1){
				$query = "UPDATE merchantlist SET item=\"" . $_POST["item{$i}"] . "\", slot=\"" . $_POST["newslot{$i}"] . "\", faction_required=\"" . $_POST["faction_required{$i}"] . "\", level_required=\"" . $_POST["level_required{$i}"] . "\", alt_currency_cost=\"" . $_POST["alt_currency_cost{$i}"] . "\", classes_required=\"" . $_POST["classes_required{$i}"] . "\" WHERE merchantid=$mid AND slot=$slot";
				$mysql->query_no_result($query);
			}
		}
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
    if (($slot != $_POST["newslot{$i}"]) || ($values['itemid'] != $_POST["itemid{$i}"]) || ($values['charges'] != $_POST["charges{$i}"])) {
      $query = "UPDATE merchantlist_temp SET itemid=\"" . $_POST["itemid{$i}"] . "\", slot=\"" . $_POST["newslot{$i}"] . "\", charges=\"" . $_POST["charges{$i}"] . "\" WHERE npcid=$npcid AND slot=" . $_POST["slot{$i}"];
      $mysql->query_no_result($query);
    }
  }
}

function delete_ware() {
  check_authorization();
  global $mysql;
  $id = $_GET['id'];
  $slot = $_GET['slot'];
  $mid = $_GET['mid'];

  $query = "DELETE FROM merchantlist WHERE merchantid=$mid AND slot=$slot AND item=$id";
  $mysql->query_no_result($query);
}

function delete_temp_ware() {
  check_authorization();
  global $mysql, $npcid;
  $itemid = $_GET['itemid'];
  $slot = $_GET['slot'];

  $query = "DELETE FROM merchantlist_temp WHERE npcid=$npcid AND slot=$slot AND itemid=$itemid";
  $mysql->query_no_result($query);
}

function add_merchant_item() {
  check_authorization();
  global $mysql;
  $mid = $_POST['mid'];
  $item = $_POST['itemid'];
  $faction_required = $_POST['faction_required'];
  $level_required = $_POST['level_required'];
  $alt_currency_cost = $_POST['alt_currency_cost'];
  $classes_required = $_POST['classes_required'];
  
  $query = "SELECT MAX(slot) AS slot FROM merchantlist WHERE merchantid=$mid";
  $result = $mysql->query_assoc($query);
  $slot = $result['slot'] + 1;
  
  $query = "INSERT INTO merchantlist SET merchantid=$mid, slot=$slot, item=$item, faction_required=$faction_required, level_required=$level_required, alt_currency_cost=$alt_currency_cost, classes_required=$classes_required";
  $mysql->query_no_result($query);
}

function add_merchant_item_temp() {
  check_authorization();
  global $mysql, $npcid;
  $charges = $_POST['charges'];
  $itemid = $_POST['itemid'];
  
  $query = "SELECT merchant_id AS mid FROM npc_types where id=$npcid";
  $result = $mysql->query_assoc($query);
  $mid = $result['mid'];

  $query = "SELECT MAX(slot) AS mslot FROM merchantlist WHERE merchantid=$mid";
  $result = $mysql->query_assoc($query);
  $mslot = $result['mslot'] + 1;

  $query = "SELECT MAX(slot) AS tslot FROM merchantlist_temp WHERE npcid=$npcid";
  $result = $mysql->query_assoc($query);
  $tslot = $result['tslot'] + 1;
  
  if ($tslot < $mslot) {
    $query = "INSERT INTO merchantlist_temp SET npcid=$npcid, slot=$mslot, itemid=$itemid, charges=$charges";
    $mysql->query_no_result($query);
  }
  if ($tslot > $mslot) {
    $query = "INSERT INTO merchantlist_temp SET npcid=$npcid, slot=$tslot, itemid=$itemid, charges=$charges";
    $mysql->query_no_result($query);
  }
}

function delete_merchantlist() {
  check_authorization();
  global $mysql, $npcid;
  $mid = $_GET['mid'];

  $query = "DELETE FROM merchantlist WHERE merchantid=$mid";
  $mysql->query_no_result($query);

  $query = "UPDATE npc_types SET merchant_id=0 WHERE id=$npcid";
  $mysql->query_no_result($query);
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
  global $mysql;
  $search = $_GET['search'];

  $query = "SELECT npc_types.id,npc_types.name FROM merchantlist
            INNER JOIN npc_types ON npc_types.merchant_id = merchantlist.merchantid
            WHERE merchantlist.item = \"$search\"";
  $results = $mysql->query_mult_assoc($query);
  return $results;
}

function search_temp_merchant() {
  global $mysql;
  $search = $_GET['search1'];

  $query = "SELECT npc_types.id,npc_types.name FROM merchantlist_temp
            INNER JOIN npc_types ON npc_types.id = merchantlist_temp.npcid
            WHERE merchantlist_temp.slot < 81 and merchantlist_temp.itemid = \"$search\"";
  $results = $mysql->query_mult_assoc($query);
  return $results;
}

function npcs_using_merchantlist () {
  global $mysql;
  $array = array();
  $merid = $_GET['merid'];

  $query = "SELECT id AS npcid, name from npc_types where merchant_id=$merid";
  $results = $mysql->query_mult_assoc($query);
  return $results;
  }

function drop_merchantlist() {
  check_authorization();
  global $mysql, $npcid;

  $query = "UPDATE npc_types SET merchant_id=0 WHERE id=$npcid";
  $mysql->query_no_result($query);
}

function copy_merchantlist() {
  check_authorization();
  global $mysql, $npcid;
  $mid = $_POST['mid'];
  
  $query = "SELECT MAX(merchantid) as merid FROM merchantlist";
  $result = $mysql->query_assoc($query);
  $nmid = $result['merid'] + 1;
  
  $query = "DELETE FROM merchantlist WHERE merchantid = 0";
  $mysql->query_no_result($query);

  $query = "INSERT INTO merchantlist (slot,item,faction_required,level_required,alt_currency_cost,classes_required) 
            SELECT slot,item,faction_required,level_required,alt_currency_cost,classes_required FROM merchantlist where merchantid=$mid";
  $mysql->query_no_result($query);

  $query = "UPDATE merchantlist set merchantid=$nmid where merchantid=0";
  $mysql->query_no_result($query);

  $query = "UPDATE npc_types set merchant_id=$nmid where id=$npcid";
  $mysql->query_no_result($query);
}

function sort_merchantlist() {
  check_authorization();
  global $mysql;
  $merchantid = get_merchant_id();
  $item_id = array();
 
  $query = "SELECT COUNT(slot) AS item_count FROM merchantlist WHERE merchantid=$merchantid";
  $result = $mysql->query_assoc($query);
  $item_count = $result['item_count'];

  $query = "SELECT MAX(slot) AS max_slot FROM merchantlist WHERE merchantid=$merchantid";
  $result = $mysql->query_assoc($query);
  $max_slot = $result['max_slot'];
 
  $query = "SELECT item FROM merchantlist WHERE merchantid=$merchantid";
  $results = $mysql->query_mult_assoc($query);

  foreach ($results as $result) {
    $item_id[] = $result['item'];
  }
 
  for ($i=0; $i<$item_count; $i++) {
    $query = "UPDATE merchantlist SET slot=$max_slot+$i+1 WHERE merchantid=$merchantid AND item=$item_id[$i]";
    $mysql->query_no_result($query);
  }

  for ($i=0; $i<$item_count; $i++) {
    $query = "UPDATE merchantlist SET slot=$i+1 WHERE merchantid=$merchantid AND item=$item_id[$i]";
    $mysql->query_no_result($query);
  }   
}
 
function merchantlist_npcid() {
   check_authorization();
   global $mysql, $npcid;
   $mid = $_GET['mid'];

   $query = "SELECT COUNT(*) AS npc_count FROM npc_types WHERE merchant_id=$mid AND id != $npcid";
   $result = $mysql->query_assoc($query);  
   $count = $result['npc_count'];

   if($count == 0){
    $query = "UPDATE npc_types set merchant_id=$npcid WHERE id=$npcid";
    $mysql->query_no_result($query);

    $query = "UPDATE merchantlist set merchantid=$npcid WHERE merchantid=$mid";
    $mysql->query_no_result($query);
   }	 
}
?>