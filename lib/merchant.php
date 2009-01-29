<? 

switch ($action) {
  case 0:  // View Merchanlist
    if ($npcid) {
      $body = new Template("templates/merchant/merchant.tmpl.php");
      $body->set('currzone', $z);
      $body->set('npcid', $npcid);
      $vars = get_merchantlist();
      if ($vars) {
        foreach ($vars as $key=>$value) {
          $body->set($key, $value);
        }
      }
    }
    break;
  case 1: // Edit Merchantlist
    check_authorization();
    $body = new Template("templates/merchant/merchant.edit.tmpl.php");
    $body->set('currzone', $z);
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
    header("Location: index.php?editor=merchant&z=$z&npcid=$npcid");
    exit;
  case 3:  // Delete item from merchant
    check_authorization();
    delete_ware();
    header("Location: index.php?editor=merchant&z=$z&npcid=$npcid");
    exit;
  case 4: // Add item to Merchant
    check_authorization();
    $javascript .= file_get_contents("templates/tradeskill/js.tmpl.php");
    $body = new Template("templates/merchant/item.add.tmpl.php");
    $body->set('currzone', $z);
    $body->set('npcid', $npcid);
    $body->set('mid', $_GET['mid']);
    break;
  case 5: // Add item
    check_authorization();
    add_merchant_item();
    header("Location: index.php?editor=merchant&z=$z&npcid=$npcid");
    exit;
  case 6: // Delete Merchantlist
    check_authorization();
    delete_merchantlist();
    header("Location: index.php?editor=merchant&z=$z&npcid=$npcid");
    exit;
  case 7:  // Search merchant by item
    check_authorization();
    $body = new Template("templates/merchant/merchant.searchresults.tmpl.php");
    if (isset($_GET['npcid']) && $_GET['npcid'] != "Name") {
      $results = search_npc_by_id();
    }
   else $results = search_merchant_by_item();
    $body->set("results", $results);
    break;
}

function get_merchantlist() {
  global $mysql;
  $mid = get_merchant_id();
  $array = array();

  $array['id'] = $mid;
  $query = "SELECT * FROM merchantlist WHERE merchantid=$mid";
  $results = $mysql->query_mult_assoc($query);
  if ($results) {
    foreach ($results as $result) {
      $result['item_name'] = get_item_name($result['item']);
      $array['slots'][$result['slot']] = array("item"=>$result['item'], "item_name"=>$result['item_name']);
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
    if ($_POST["item{$i}"] != $oldstats['slots'][$i]['item']) {
      $query = "UPDATE merchantlist SET item=\"" . $_POST["item{$i}"] . "\" WHERE merchantid=$mid AND slot=" . $_POST["slot{$i}"];
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

function add_merchant_item() {
  check_authorization();
  global $mysql;
  $mid = $_REQUEST['mid'];
  $item = $_REQUEST['itemid'];
  
  $query = "SELECT MAX(slot) AS slot FROM merchantlist WHERE merchantid=$mid";
  $result = $mysql->query_assoc($query);
  $slot = $result['slot'] + 1;
  
  $query = "INSERT INTO merchantlist SET merchantid=$mid, slot=$slot, item=$item";
  $mysql->query_no_result($query);
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

function search_merchant_by_item() {
  global $mysql;
  $search = $_GET['search'];


  $query = "SELECT npc_types.id,npc_types.name FROM merchantlist
            INNER JOIN npc_types ON npc_types.merchant_id = merchantlist.merchantid
            WHERE merchantlist.item = \"$search\"";
  $results = $mysql->query_mult_assoc($query);
  return $results;
}

?>