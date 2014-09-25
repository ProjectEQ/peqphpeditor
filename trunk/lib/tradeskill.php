<?php

$default_page = 1;
$default_size = 50;
$default_sort = 1;

$columns = array(
  1 => 'char_id',
  2 => 'recipe_id'
);

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
      $body->set("quest", $quest);
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
      if ($_GET['ts'] > 0) {
        $body->set("ts", $_GET['ts']);
        $body->set("tradeskills", $tradeskills);
      }
    }
    break;
  case 1:  //Edit recipe
    check_authorization();
    $javascript = new Template("templates/tradeskill/js.tmpl.php");
    $body = new Template("templates/tradeskill/recipe.edit.tmpl.php");
    $body->set("tradeskills", $tradeskills);
    $body->set("ts", $ts);
    $body->set("rec", $rec);
    $body->set("quest", $quest);
    $vars = recipe_info();
    if ($vars) {
      foreach ($vars as $key=>$value) {
        $body->set($key, $value);
      }
    }
    $learn_flags = extract_learn_flags($vars['must_learn']);
    if ($learn_flags) {
      foreach ($learn_flags as $key=>$value) {
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
    $body = new Template("templates/tradeskill/tradeskill.searchresults.tmpl.php");
    if (isset($_GET['itemid']) && $_GET['itemid'] != "Item ID") {
      $results = search_recipes_by_item();
    }
    else $results = search_recipes();
    $body->set("results", $results);
    break;
  case 10:  // Add recipe
    check_authorization();
    $javascript = new Template("templates/tradeskill/js.tmpl.php");
    $body = new Template("templates/tradeskill/recipe.add.tmpl.php");
    $body->set("tradeskills", $tradeskills);
    if ($_GET['ts'] > 0)
      $body->set('ts', $_GET['ts']);
    break;
  case 11:  // Add component
    check_authorization();
    $id = add_recipe();
    header("Location: index.php?editor=tradeskill&rec=$id");
    exit;
  case 12:  // Copy tradeskill
    check_authorization();
    copy_tradeskill();
    $nrec = get_new_id();
    header("Location: index.php?editor=tradeskill&ts=$ts&rec=$nrec");
    exit;
  case 13:  // View Learned Recipes
    check_authorization();
    $breadcrumbs .= " >> Learned Recipes";
    $curr_page = (isset($_GET['page'])) ? $_GET['page'] : $default_page;
    $curr_size = (isset($_GET['size'])) ? $_GET['size'] : $default_size;
    $curr_sort = (isset($_GET['sort'])) ? $columns[$_GET['sort']] : $columns[$default_sort];
    $body = new Template("templates/tradeskill/learned.tmpl.php");
    $page_stats = getPageInfo("char_recipe_list", $curr_page, $curr_size, $_GET['sort']);
    if ($page_stats['page']) {
      $recipes = getLearnedRecipes($page_stats['page'], $curr_size, $curr_sort);
    }
    if ($recipes) {
      $body->set('recipes', $recipes);
      foreach ($page_stats as $key=>$value) {
        $body->set($key, $value);
      }
    }
    else {
      $body->set('page', 0);
      $body->set('pages', 0);
    }
    break;
  case 14:  // Delete Learned Recipe
    check_authorization();
    delete_LearnedRecipe();
    $return_address = $_SERVER['HTTP_REFERER'];
    header("Location: $return_address");
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
  $must_learn = $_POST['must_learn'];
  $quest = $_POST['quest'];
  $enabled = $_POST['enabled'];
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
  if($old['must_learn'] != $must_learn) $fields .= "must_learn=\"$must_learn\", ";
  if($old['quest'] != $quest) $fields .= "quest=\"$quest\", ";
  if($old['enabled'] != $enabled) $fields .= "enabled=\"$enabled\", ";

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

  $query = "DELETE FROM char_recipe_list WHERE recipe_id=$rec";
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
  $salvagecount = $_POST['salvagecount'];
  
  $old = component_info();
  $fields = '';

  if($old['recipe_id'] != $recipe_id) $fields .= "recipe_id=$recipe_id, ";
  if($old['item_id'] != $item_id) $fields .= "item_id=$item_id, ";
  if($old['successcount'] != $successcount) $fields .= "successcount=$successcount, ";
  if($old['failcount'] != $failcount) $fields .= "failcount=$failcount, ";
  if($old['componentcount'] != $componentcount) $fields .= "componentcount=$componentcount, ";
  if($old['iscontainer'] != $iscontainer) $fields .= "iscontainer=$iscontainer, ";
  if($old['salvagecount'] != $salvagecount) $fields .= "salvagecount=$salvagecount, ";

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
  if(isset($_POST['salvagecount'])) $fields .= "salvagecount={$_POST['salvagecount']}, ";

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

  $query = "SELECT id, name FROM tradeskill_recipe WHERE name RLIKE \"$search\" ORDER BY name, id";
  $results = $mysql->query_mult_assoc($query);
  return $results;
}

function search_recipes_by_item() {
  global $mysql;
  $itemid = $_GET['itemid'];

  $query = "SELECT recipe_id AS id, tradeskill_recipe.name AS name FROM tradeskill_recipe_entries LEFT JOIN tradeskill_recipe ON tradeskill_recipe.id=tradeskill_recipe_entries.recipe_id WHERE item_id=$itemid ORDER BY name, id";
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
  if(isset($_POST['must_learn'])) $fields .= "must_learn=\"{$_POST['must_learn']}\", ";
  if(isset($_POST['quest'])) $fields .= "quest=\"{$_POST['quest']}\", ";
  if(isset($_POST['enabled'])) $fields .= "enabled=\"{$_POST['enabled']}\", ";

  $fields =  rtrim($fields, ", ");

  $query = "INSERT INTO tradeskill_recipe SET $fields";
  $mysql->query_no_result($query);
  
  return $id;
}

function copy_tradeskill() {
  check_authorization();
  global $mysql;
  $rec = $_GET['rec'];

  $query = "DELETE FROM tradeskill_recipe WHERE id=0";
  $mysql->query_no_result($query);

  $query = "DELETE FROM tradeskill_recipe_entries WHERE recipe_id=0";
  $mysql->query_no_result($query);

  $query = "INSERT INTO tradeskill_recipe (name,tradeskill,skillneeded,trivial,nofail,replace_container,notes,must_learn,quest,enabled) 
            SELECT CONCAT(name,' - Copy'),tradeskill,skillneeded,trivial,nofail,replace_container,notes,must_learn,quest,enabled FROM tradeskill_recipe where id=$rec";
  $mysql->query_no_result($query);

  $query = "INSERT INTO tradeskill_recipe_entries (item_id,successcount,failcount,componentcount,iscontainer,salvagecount) 
            SELECT item_id,successcount,failcount,componentcount,iscontainer,salvagecount FROM tradeskill_recipe_entries where recipe_id=$rec";
  $mysql->query_no_result($query);

  $query = "SELECT MAX(id) as tid FROM tradeskill_recipe";
  $result = $mysql->query_assoc($query);
  $nrec = $result['tid'];

  $query = "UPDATE tradeskill_recipe_entries set recipe_id=$nrec where recipe_id=0";
  $mysql->query_no_result($query);
}

function get_new_id() {
  check_authorization();
  global $mysql;

  $query = "SELECT MAX(id) as tid FROM tradeskill_recipe";
  $result = $mysql->query_assoc($query);
  $nrec = $result['tid'];
  return $nrec;
}

function getLearnedRecipes($page_number, $results_per_page, $sort_by) {
  global $mysql;
  $limit = ($page_number - 1) * $results_per_page . "," . $results_per_page;

  $query = "SELECT * FROM char_recipe_list ORDER BY $sort_by LIMIT $limit";
  $results = $mysql->query_mult_assoc($query);

  return $results;
}

function delete_LearnedRecipe () {
  global $mysql;
  $char_id = $_GET['char_id'];
  $recipe_id = $_GET['recipe_id'];
  
  $query = "DELETE FROM char_recipe_list WHERE char_id=$char_id AND recipe_id=$recipe_id";
  $mysql->query_no_result($query);
}

function export_recipe_sql() {
  global $mysql;
  $recipe_id = $_GET['rec'];
  $table_string = "";
  $value_string = "";
  $export_string = "";

  // Get Recipe Properties
  $export_string .= "DELETE FROM tradeskill_recipe WHERE id = $recipe_id;\n";

  $query = "SELECT * FROM tradeskill_recipe WHERE id = $recipe_id";
  $results = $mysql->query_assoc($query);
  foreach ($results as $key=>$value) {
    if($table_string) {
      $table_string .= ", " . $key;
      $value_string .= ", \"" . $value . "\"";
    }
    else {
      $table_string = $key;
      $value_string = "\"" . $value . "\"";
    }
  }
  $export_string .= "INSERT INTO tradeskill_recipe ($table_string) VALUES ($value_string);\n";
  $table_string = "";
  $value_string = "";

  // Get Recipe Entries
  $export_string .= "DELETE FROM tradeskill_recipe_entries WHERE recipe_id = $recipe_id;\n";

  $query = "SELECT * FROM tradeskill_recipe_entries WHERE recipe_id = $recipe_id";
  $results = $mysql->query_mult_assoc($query);
  if ($results) {
    foreach ($results as $result) {
      foreach ($result as $key=>$value) {
        if($table_string) {
          $table_string .= ", " . $key;
          $value_string .= ", \"" . $value . "\"";
        }
        else {
          $table_string = $key;
          $value_string = "\"" . $value . "\"";
        }
      }
      $export_string .= "INSERT INTO tradeskill_recipe_entries ($table_string) VALUES ($value_string);\n";
      $table_string = "";
      $value_string = "";
    }
  }

  return $export_string;
}

function extract_learn_flags($learn_value) {
  $learn_flags = array();
  $l_method = 0;
  $l_message = 0;
  $l_search = 0;

  if ($learn_value >= 32) {
    $l_search = 32;
    $learn_value -= 32;
  }
  if ($learn_value >= 16) {
    $l_message = 16;
    $learn_value -= 16;
  }
  $l_method = $learn_value;
  $learn_flags = array("l_method" => $l_method, "l_message" => $l_message, "l_search" => $l_search);

  return $learn_flags;
}
?>