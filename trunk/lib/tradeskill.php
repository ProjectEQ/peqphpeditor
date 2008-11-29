<?

if ($ts == '' && intval($rec) != '0') {
  $ts = getRecipeTradeskill();
  header("Location: index.php?editor=tradeskill&ts=$ts&rec=$rec");
  exit;
}

switch ($action) {
  case 0:  // View Tradeskill
    if ($rec != '0') {
      $body = new Template("templates/tradeskill/tradeskill.tmpl.php");
      $body->set("tradeskills", $tradeskills);
      $body->set("yesno", $yesno);
      $body->set("ts", $ts);
      $body->set("rec", $rec);
      $vars = recipe_info();
      if ($vars) {
        foreach ($vars as $key=>$value) {
          $body->set($key, $value);
        }
      }

      $errors = array();
      if (isset($vars['containers'])) {
        foreach ($vars['containers'] as $container) {
          $flag = 0;
          $itemid = $container['item_id'];
          $bagtype = getItemBagtype($itemid);
          if (isset($BagtypeToTradeskill[$bagtype]) && $BagtypeToTradeskill[$bagtype] != $vars['tradeskill']) {
            if (isset($worldObjectsToTradeskills[$itemid])) {
              if ($worldObjectsToTradeskills[$itemid] != $vars['tradeskill']) {
                $flag = 1;
              }
            }
            else {
              $flag = 1;
            }
          }
          if ($flag == 1) {
            $name = $container['name'];
            $neededTradeskill = $tradeskills[$BagtypeToTradeskill[$bagtype]];
            $errors[] = "Container \"$name\" (itemid $itemid) can only be used with the tradeskill \"$neededTradeskill\".";
          }
        }
      }
      $body->set("errors", $errors);
    }
    else {
      $body = new Template("templates/tradeskill/tradeskill.default.tmpl.php");
    }
    break;
  case 1:  //Edit recipe
    check_authorization();
    $body = new Template("templates/tradeskill/recipe.edit.tmpl.php");
    $body->set("tradeskills", $tradeskills);
    $body->set("ts", $ts);
    $body->set("rec", $rec);
    $vars = recipe_info();
    if ($vars) {
      foreach ($vars as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
  case 2:  //Update recipe
    check_authorization();
    update_recipe();
    header("Location: index.php?editor=tradeskill&ts=$ts&rec=$rec");
    exit;
  case 3:  //Delete recipe
    check_authorization();
    delete_recipe();
    header("Location: index.php?editor=tradeskill&ts=$ts");
    exit;
  case 4:  //Delete component
    check_authorization();
    delete_component();
    header("Location: index.php?editor=tradeskill&ts=$ts&rec=$rec");
    exit;
  case 5: // Edit component
    check_authorization();
    $javascript = new Template("templates/tradeskill/js.tmpl.php");
    $body = new Template("templates/tradeskill/component.edit.tmpl.php");
    $body->set("tradeskills", $tradeskills);
    $body->set("ts", $ts);
    $body->set("rec", $rec);
    $vars = component_info();
    if ($vars) {
      foreach ($vars as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
  case 6:  // Update component
    check_authorization();
    update_component();
    header("Location: index.php?editor=tradeskill&ts=$ts&rec=$rec");
    exit;
  case 7: // Add component
    check_authorization();
    $javascript = new Template("templates/tradeskill/js.tmpl.php");
    $body = new Template("templates/tradeskill/component.add.tmpl.php");
    $body->set("tradeskills", $tradeskills);
    $body->set("ts", $ts);
    $body->set("rec", $rec);
    break;
  case 8:  // Add component
    check_authorization();
    add_component();
    header("Location: index.php?editor=tradeskill&ts=$ts&rec=$rec");
    exit;
  case 9:  // Search recipes
   // check_authorization();
    $body = new Template("templates/tradeskill/tradeskill.searchresults.tmpl.php");
    if (isset($_GET['itemid']) && $_GET['itemid'] != "Item ID") {
      $results = search_recipes_by_item();
    }
    else $results = search_recipes();
    $body->set("results", $results);
    break;
  case 10:  // Add recipe
    check_authorization();
    $body = new Template("templates/tradeskill/recipe.add.tmpl.php");
    $body->set("tradeskills", $tradeskills);
    break;
  case 11:  // Add component
    check_authorization();
    $id = add_recipe();
    header("Location: index.php?editor=tradeskill&rec=$id");
    exit;
}




function getRecipeTradeskill () {
  global $mysql, $rec;
  
  $query = "SELECT tradeskill FROM tradeskill_recipe WHERE id=$rec";
  $result = $mysql->query_assoc($query);
  return $result['tradeskill'];
}

function recipe_info () {
  global $mysql, $rec, $world_containers;

  $array = array();
  $array['containers'] = '';
  $array['components'] = '';
  $array['products'] = '';
    
  $query = "SELECT * FROM tradeskill_recipe WHERE id=$rec";
  $result = $mysql->query_assoc($query);
  
  $array = $result;

  $query = "SELECT * FROM tradeskill_recipe_entries WHERE recipe_id=$rec";
  $results = $mysql->query_mult_assoc($query);
  
  if ($results != '') {
    foreach($results as $r) {
      if (isset($world_containers[$r['item_id']])) $r['name'] = $world_containers[$r['item_id']];
      else $r['name'] = get_item_name($r['item_id']);
      if ($r['iscontainer'] == 1) $array['containers'][] = $r;
      elseif ($r['successcount'] > 0) $array['products'][] = $r;
      else $array['components'][] = $r;
    }
  }
  return $array;
}

function update_recipe () {
  check_authorization();
  global $mysql;
  
  $id = $_POST['id'];
  $name = $_POST['name'];
  $tradeskill = $_POST['tradeskill'];
  $skillneeded = $_POST['skillneeded'];
  $trivial = $_POST['trivial'];
  $nofail = $_POST['nofail'];
  $replace_container = $_POST['replace_container'];
  $notes = $_POST['notes'];
  
  $old = recipe_info();
  $fields = '';

  if($old['id'] != $id) $fields .= "id=$id, ";
  if($old['name'] != $name) $fields .= "name=\"$name\", ";
  if($old['tradeskill'] != $tradeskill) $fields .= "tradeskill=$tradeskill, ";
  if($old['skillneeded'] != $skillneeded) $fields .= "skillneeded=$skillneeded, ";
  if($old['trivial'] != $trivial) $fields .= "trivial=$trivial, ";
  if($old['nofail'] != $nofail) $fields .= "nofail=$nofail, ";
  if($old['replace_container'] != $replace_container) $fields .= "replace_container=$replace_container, ";
  if($old['notes'] != $notes) $fields .= "notes=\"$notes\", ";

  $fields =  rtrim($fields, ", ");

  if ($fields != '') {
    $query = "UPDATE tradeskill_recipe SET $fields WHERE id=$id";
    $mysql->query_no_result($query);
  }
}

function delete_recipe () {
  check_authorization();
  global $mysql, $rec;
  
  $query = "DELETE FROM tradeskill_recipe WHERE id=$rec";
  $mysql->query_no_result($query);

  $query = "DELETE FROM tradeskill_recipe_entries WHERE recipe_id=$rec";
  $mysql->query_no_result($query);
}

function getItemBagtype($item) {
  global $mysql;
  
  $query = "SELECT bagtype FROM items WHERE id=$item";
  $result = $mysql->query_assoc($query);
  return $result['bagtype'];
}

function component_info() {
  global $mysql, $rec;
  $id = $_GET['id'];

  $query = "SELECT * FROM tradeskill_recipe_entries WHERE id=$id";
  $result = $mysql->query_assoc($query);
  return $result;
}

function update_component() {
  check_authorization();
  global $mysql;
  
  $id = $_POST['id'];
  $recipe_id = $_POST['recipe_id'];
  $item_id = $_POST['item_id'];
  $successcount = $_POST['successcount'];
  $failcount = $_POST['failcount'];
  $componentcount = $_POST['componentcount'];
  $iscontainer = $_POST['iscontainer'];
  
  $old = component_info();
  $fields = '';

  if($old['recipe_id'] != $recipe_id) $fields .= "recipe_id=$recipe_id, ";
  if($old['item_id'] != $item_id) $fields .= "item_id=$item_id, ";
  if($old['successcount'] != $successcount) $fields .= "successcount=$successcount, ";
  if($old['failcount'] != $failcount) $fields .= "failcount=$failcount, ";
  if($old['componentcount'] != $componentcount) $fields .= "componentcount=$componentcount, ";
  if($old['iscontainer'] != $iscontainer) $fields .= "iscontainer=$iscontainer, ";

  $fields =  rtrim($fields, ", ");

  if ($fields != '') {
    $query = "UPDATE tradeskill_recipe_entries SET $fields WHERE id=$id";
    $mysql->query_no_result($query);
  }
}

function add_component() {
  check_authorization();
  global $mysql;
  
  $fields = '';
  
  if(isset($_POST['recipe_id'])) $fields .= "recipe_id={$_POST['recipe_id']}, ";
  if(isset($_POST['item_id'])) $fields .= "item_id={$_POST['item_id']}, ";
  if(isset($_POST['successcount'])) $fields .= "successcount={$_POST['successcount']}, ";
  if(isset($_POST['failcount'])) $fields .= "failcount={$_POST['failcount']}, ";
  if(isset($_POST['componentcount'])) $fields .= "componentcount={$_POST['componentcount']}, ";
  if(isset($_POST['iscontainer'])) $fields .= "iscontainer={$_POST['iscontainer']}, ";

  $fields =  rtrim($fields, ", ");

  $query = "INSERT INTO tradeskill_recipe_entries SET $fields";
  $mysql->query_no_result($query);
}

function delete_component () {
  check_authorization();
  global $mysql, $rec;
  $id = $_GET['id'];
  
  $query = "DELETE FROM tradeskill_recipe_entries WHERE id=$id";
  $mysql->query_no_result($query);
}

function search_recipes() {
  global $mysql;
  $search = $_GET['search'];

  $query = "SELECT id, name FROM tradeskill_recipe WHERE name rlike \"$search\"";
  $results = $mysql->query_mult_assoc($query);
  return $results;
}

function search_recipes_by_item() {
  global $mysql;
  $itemid = $_GET['itemid'];

  $query = "SELECT recipe_id AS id, tradeskill_recipe.name AS name FROM tradeskill_recipe_entries LEFT JOIN tradeskill_recipe ON tradeskill_recipe.id=tradeskill_recipe_entries.recipe_id WHERE item_id=$itemid";
  $results = $mysql->query_mult_assoc($query);
  return $results;
}

function add_recipe() {
  check_authorization();
  global $mysql;

  $query = "SELECT MAX(id) AS id FROM tradeskill_recipe";
  $result = $mysql->query_assoc($query);
  
  $id = $result['id'] + 1;
  
  $fields = "id=$id, ";
  
  if(isset($_POST['name'])) $fields .= "name=\"{$_POST['name']}\", ";
  if(isset($_POST['tradeskill'])) $fields .= "tradeskill={$_POST['tradeskill']}, ";
  if(isset($_POST['skillneeded'])) $fields .= "skillneeded={$_POST['skillneeded']}, ";
  if(isset($_POST['trivial'])) $fields .= "trivial={$_POST['trivial']}, ";
  if(isset($_POST['nofail'])) $fields .= "nofail={$_POST['nofail']}, ";
  if(isset($_POST['replace_container'])) $fields .= "replace_container={$_POST['replace_container']}, ";
  if(isset($_POST['notes'])) $fields .= "notes=\"{$_POST['notes']}\", ";

  $fields =  rtrim($fields, ", ");

  $query = "INSERT INTO tradeskill_recipe SET $fields";
  $mysql->query_no_result($query);
  
  return $id;
}

?>
