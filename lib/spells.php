<?php

switch ($action) {
  case 0: // Default -- Spell menu
    $body = new Template("templates/spells/spells.default.tmpl.php");
    break;
  case 1: // Search spells
    check_authorization();
    $body = new Template("templates/spells/spells.searchresults.tmpl.php");
    if (isset($_GET['id']) && $_GET['id'] != "ID") {
      $results = search_spell_by_id();
    }
    else $results = search_spells_by_name();
    $body->set("results", $results);
    break;
  case 2: // Edit spell
    check_authorization();
    $javascript = new Template("templates/iframes/js.tmpl.php");
    $body = new Template("templates/spells/spells.edit.tmpl.php");
    $body->set("formulas", $sp_formulas);
    $body->set("buffformulas", $sp_buffformulas);
    $body->set("zonetypes", $sp_zonetypes);
    $body->set("envtypes", $sp_envtypes);
    $body->set("classnums", $sp_classnums);
    $body->set("deities", $sp_deities);
    $body->set("targets", $sp_targets);
    $body->set("npccats", $sp_npccats);
    $body->set("spellgroups", $sp_spellgroups);
    $body->set("skills", $sp_skills);
    $body->set("spelltypes", $sp_spelltypes);
    $body->set("effecttypes", $sp_goodeffect);
    $body->set("resisttypes", $sp_resisttype);
    $body->set("effects", $sp_effects);
    $body->set("lighttypes", $sp_lighttypes);
    $body->set("acttypes", $sp_acttypes);
    $body->set("daytimes", $sp_daytimes);
    $body->set("traveltypes", $sp_traveltypes);
    $body->set("spellcats", $sp_categories);

    $vars = spell_info();
    if ($vars) {
      foreach ($vars as $key=>$value) {
        $body->set($key, $value);
      }
    }

    $vars = getdate();
    if ($vars) {
     foreach ($vars as $key=>$value) {
       $body->set($key, $value);
     }
    }

    break;
  case 5: // Delete spell
     check_authorization();
     delete_spell();
     header("Location: index.php?editor=spells");
     exit;
  case 6: // Update spell
     check_authorization();
     $id = $_GET['id'];
     update_spell();
     header("Location: index.php?editor=spells&id=$id&action=2");
     exit;
  case 7: // Copy spell
     check_authorization();
     $id = copy_spell();
     header("Location: index.php?editor=spells&id=$id&action=2");
     exit;
//Spells are complicated enough that one is probably wise to copy from a template anyway, at least for now.
//  case 8: // Add spell
//     check_authorization();
//     $javascript = new Template("templates/iframes/js.tmpl.php");
//     $body = new Template("templates/spells/spells.add.tmpl.php");
//     break;
//  case 9: //Add spell
//     check_authorization();
//     add_spell();
//     $id = $_POST['id'];
//     header("Location: index.php?editor=spells&id=$id&action=2");
//     exit;
   case 10: // Dump spells
     check_authorization();
     $body = new Template("templates/spells/genspells.php");
     break;
}

function spell_info () {
  global $mysql;

  $id = $_GET['id'];

  $query = "SELECT name AS spellname FROM spells_new WHERE id=$id";
  $result = $mysql->query_assoc($query);

  $query = "SELECT * FROM spells_new WHERE id=$id";
  $result2 = $mysql->query_assoc($query);

  $result = $result+$result2;
  return $result;
}

function delete_spell () {
  global $mysql;

  $id = $_GET['id'];

  $query = "DELETE FROM spells_new WHERE id=$id";
  $mysql->query_no_result($query);
}

function update_spell () {
  global $mysql;

  $id = $_POST['id'];
  $vars = spell_info();

  //Checkbox list
  $cbs = array(
    "dot_stacking_exempt",
    "deleteable",
    "uninterruptable",
    "nodispell",
    "can_mgb",
    "short_buff_box",
    "deities0",
    "deities1", 
    "deities2",
    "deities3",
    "deities4",
    "deities5",
    "deities6",
    "deities7",
    "deities8",
    "deities9",
    "deities10",
    "deities11",
    "deities12",
    "deities13",
    "deities14",
    "deities15",
    "deities16"
    );

  //Sanitize checkboxes
  foreach($cbs as $cb)
  {
   if($_POST[$cb] == 'on') { $_POST[$cb] = 1; }
   else { $_POST[$cb] = 0; }
  }

  //Fix the 'use text field' elements
  if($_POST[spell_category] == -100) { $_POST[spell_category] = $_POST[spcat]; }
  for($x = 1; $x <= 12; $x++)
  {
   if($_POST['formula'.$x] == 1) { $_POST['formula'.$x] = $_POST['fmm'.$x]; }
  }

  $fields = '';
  foreach(array_keys($vars) as $f)
  {
   //Put field name in backticks to avoid conflicts with columns named for sql functions (like range)
   if($vars[$f] != stripslashes($_POST[$f]) and isset($_POST[$f])) { $fields .= "`$f` = \"$_POST[$f]\", "; }
  }

  $fields =  rtrim($fields, ", ");

  if ($fields != '') {
    $query = "UPDATE spells_new SET $fields WHERE id=$id";
    $mysql->query_no_result($query);
  }
}

function copy_spell () {
  global $mysql, $sp_fields;

  $id = $_GET['id'];

  $query1 = "SELECT max(id) AS iid FROM spells_new";
  $result = $mysql->query_assoc($query1);
  $newid = $result['iid'] + 1;

  $fields = implode(", ", $sp_fields);
  
  $query2 = "INSERT INTO spells_new ($fields, id) SELECT $fields, $newid AS id FROM spells_new WHERE id = '$id'";
  $mysql->query_no_result($query2);

  $query3 = "UPDATE spells_new SET name = concat(name, ' - Copy') WHERE id = $newid";
  $mysql->query_no_result($query3);

  return $newid;
}

function get_max_id () {
  global $mysql;

  $query = "SELECT max(id) AS iid FROM spells_new";
  $result = $mysql->query_assoc($query);
  $newid = $result['iid'] + 1;

  return $newid;
}

function add_spell () {
  global $mysql;
}

?>
