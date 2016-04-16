<?php

$itemsize= array(
  0   => "Tiny",
  1   => "Small",
  2   => "Medium",
  3   => "Large",
  4   => "Giant",
  5   => "Giant - No Container"
);

$itembagsize= array(
  0   => "Non-Bag",
  1   => "Small",
  2   => "Medium",
  3   => "Large",
  4   => "Giant",
  5   => "Giant - Assembly Kit"
);

$itemldontheme= array(
  0   => "None",
  1   => "GUK",
  2   => "MIR",
  4   => "MMC",
  8   => "RUJ",
  16  => "TAK",
  31  => "ALL"
);

$itembardtype= array(
  0   => "None",
  23  => "Wind",
  24  => "String",
  25  => "Brass",
  26  => "Percussion",
  50  => "Singing",
  51  => "ALL"
);

$itempointtype= array(
  0   => "None",
  1   => "LDoN",
  2   => "Discord Merchant",
  4   => "Norrath Keeper",
  5   => "Dark Reign"
);

$itemcasttype= array(
0 => "None",
1 => "Click from inventory w/Lvl",
3 => "Expendable",
4 => "Must equip to click",
5 => "Click from inventory w/Lvl/Class/Race"
);

$proccasttype= array(
0   => "None/Proc"
);

$worncasttype= array(
0   => "None",
2   => "Worn"
);

$focuscasttype= array(
0   => "None",
6   => "Focus"
);

$scrollcasttype= array(
0   => "None",
7   => "Scroll"
);

switch ($action) {
  case 0: //Default
    check_authorization();
    $body = new Template("templates/items/items.default.tmpl.php");
    break;
  case 1:   // Search items
    check_authorization();
    $body = new Template("templates/items/items.searchresults.tmpl.php");
    if (isset($_GET['id']) && $_GET['id'] != "ID") {
      $results = search_item_by_id();
    }
   else $results = search_items();
    $body->set("results", $results);
    break;
  case 2: // Edit Item
    check_authorization();
    $javascript = new Template("templates/iframes/js.tmpl.php");
    $body = new Template("templates/items/items.edit.tmpl.php");
    $body->set("itemsize", $itemsize);
    $body->set("itemmaterial", $itemmaterial);
    $body->set("itemtypes", $itemtypes);
    $body->set("itemldontheme", $itemldontheme);
    $body->set("skilltypes", $skilltypes);
    $body->set("bodytypes", $bodytypes);
    $body->set("itemraces", $races);
    $body->set("itemsaugrestrict", $itemsaugrestrict);
    $body->set("itembagsize", $itembagsize);
    $body->set("world_containers", $world_containers);
    $body->set("itembardtype", $itembardtype);
    $body->set("itempointtype", $itempointtype);
    $body->set("itemcasttype", $itemcasttype);
    $body->set("proccasttype", $proccasttype);
    $body->set("worncasttype", $worncasttype);
    $body->set("focuscasttype", $focuscasttype);
    $body->set("scrollcasttype", $scrollcasttype);
    $body->set("equipslots", $equipslots); 
    $body->set("factions", factions_array());
    $vars = item_info();
    if ($vars) {
      foreach ($vars as $key=>$value) {
        $body->set($key, $value);
      }
    }
    $date_vars = getdate();
    if ($date_vars) {
      foreach ($date_vars as $key=>$value) {
        $body->set($key, $value);
      }
    }
    $errors = array();
    if (($vars['stackable'] == 0) && ($vars['stacksize'] > 1)) {
      $errors[] = "<u>Stacking Error</u><br>Item is not stackable but stack size is " . $vars['stacksize'];
    }
    if (($vars['stackable'] == 1) && ($vars['stacksize'] <= 1)) {
      $errors[] = "<u>Stacking Error</u><br>Item is stackable but stack size is " . $vars['stacksize'];
    }
    if (($vars['book'] > 0) && ($vars['filename'] == "")) {
      $errors[] = "<u>Missing Text Error</u><br>Item is marked as a book/message but not assigned any text";
    }
    if ($errors) {
      $body->set("errors", $errors);
    }
    break;
  case 3: // Book Text
     check_authorization();
     $body = new Template("templates/items/items.book.tmpl.php");
     $body->set('id', $_GET['id']);
     $body->set('name', $_GET['name']);
     $vars = book_info();
     if ($vars) {
      foreach ($vars as $key=>$value) {
        $body->set($key, $value);
      }
     }
     break;
  case 4: //Update Book Text
     check_authorization();
     $id = $_POST['id'];
     update_book();
     header("Location: index.php?editor=items&id=$id&action=2");
     exit;
  case 5: // Delete Item
     check_authorization();
     delete_item();
     header("Location: index.php?editor=items");
     exit;
  case 6: // Update Item
     check_authorization();
     $id = $_GET['id'];
     update_item();
     header("Location: index.php?editor=items&id=$id&action=2");
     exit;
  case 7: // Copy Item
     check_authorization();
     $id = copy_item();
     header("Location: index.php?editor=items&id=$id&action=2");
     exit;
  case 8: // Add Item
     check_authorization();
     $javascript = new Template("templates/iframes/js.tmpl.php");
     $body = new Template("templates/items/items.add.tmpl.php");
     $body->set("itemsize", $itemsize);
     $body->set("itemmaterial", $itemmaterial);
     $body->set("itemtypes", $itemtypes);
     $body->set("itemldontheme", $itemldontheme);
     $body->set("skilltypes", $skilltypes);
     $body->set("bodytypes", $bodytypes);
     $body->set("itemraces", $races);
     $body->set("itemsaugrestrict", $itemsaugrestrict);
     $body->set("itembagsize", $itembagsize);
     $body->set("world_containers", $world_containers);
     $body->set("itembardtype", $itembardtype);
     $body->set("itempointtype", $itempointtype);
     $body->set("itemcasttype", $itemcasttype);
     $body->set("proccasttype", $proccasttype);
     $body->set("worncasttype", $worncasttype);
     $body->set("focuscasttype", $focuscasttype);
     $body->set("scrollcasttype", $scrollcasttype);
     $body->set("yesno", $yesno);
     $body->set('newid', get_max_id());
     $body->set("factions", factions_array());
     $vars = getdate();
     if ($vars) {
      foreach ($vars as $key=>$value) {
        $body->set($key, $value);
      }
     }
     break;
  case 9: //Add Item 
     check_authorization();
     add_item();
     $id = $_POST['id'];
     header("Location: index.php?editor=items&id=$id&action=2");
     exit;
}

function item_info () {
  global $mysql;

  $id = $_GET['id'];

  $query = "SELECT Name AS itemname FROM items WHERE id=$id";
  $result = $mysql->query_assoc($query);

  $query = "SELECT * FROM items WHERE id=$id";
  $result2 = $mysql->query_assoc($query);

  $result = $result+$result2;
  return $result;
}

function book_info () {
  global $mysql;

  $name = $_GET['name'];

  $query = "SELECT * FROM books WHERE name=\"$name\"";
  $result = $mysql->query_assoc($query);

  return $result;
}

function update_book () {
  global $mysql;

  $name = $_POST['name'];
  $txtfile = $_POST['txtfile'];

  $query = "REPLACE INTO books SET txtfile=\"$txtfile\", name=\"$name\"";
  $mysql->query_no_result($query);
}

function delete_item () {
  global $mysql;

  $id = $_GET['id'];

  $query = "DELETE FROM items WHERE id=$id";
  $mysql->query_no_result($query);
}

function update_item () {
  global $mysql;

  $id = $_POST['id'];

  $query = "SELECT * FROM items WHERE id=$id";
  $item = $mysql->query_assoc($query);

  // Define checkbox fields:
  $slots = 0;
  if (isset($_POST['slot_Charm'])) $slots = $slots+1;
  if (isset($_POST['slot_Ear01'])) $slots = $slots+2;
  if (isset($_POST['slot_Head'])) $slots = $slots+4;
  if (isset($_POST['slot_Face'])) $slots = $slots+8;
  if (isset($_POST['slot_Ear02'])) $slots = $slots+16;
  if (isset($_POST['slot_Neck'])) $slots = $slots+32;
  if (isset($_POST['slot_Shoulder'])) $slots = $slots+64;
  if (isset($_POST['slot_Arms'])) $slots = $slots+128;
  if (isset($_POST['slot_Back'])) $slots = $slots+256;
  if (isset($_POST['slot_Bracer01'])) $slots = $slots+512;
  if (isset($_POST['slot_Bracer02'])) $slots = $slots+1024;
  if (isset($_POST['slot_Range'])) $slots = $slots+2048;
  if (isset($_POST['slot_Hands'])) $slots = $slots+4096;
  if (isset($_POST['slot_Primary'])) $slots = $slots+8192;
  if (isset($_POST['slot_Secondary'])) $slots = $slots+16384;
  if (isset($_POST['slot_Ring01'])) $slots = $slots+32768;
  if (isset($_POST['slot_Ring02'])) $slots = $slots+65536;
  if (isset($_POST['slot_Chest'])) $slots = $slots+131072;
  if (isset($_POST['slot_Legs'])) $slots = $slots+262144;
  if (isset($_POST['slot_Feet'])) $slots = $slots+524288;
  if (isset($_POST['slot_Waist'])) $slots = $slots+1048576;
  if (isset($_POST['slot_Ammo'])) $slots = $slots+2097152;
  if (isset($_POST['slot_Powersource'])) $slots = $slots+4194304;

  $races = 0;
  if (isset($_POST['race_Human'])) $races = $races+1;
  if (isset($_POST['race_Barbarian'])) $races = $races+2;
  if (isset($_POST['race_Erudite'])) $races = $races+4;
  if (isset($_POST['race_Wood_Elf'])) $races = $races+8;
  if (isset($_POST['race_High_Elf'])) $races = $races+16;
  if (isset($_POST['race_Dark_Elf'])) $races = $races+32;
  if (isset($_POST['race_Half_Elf'])) $races = $races+64;
  if (isset($_POST['race_Dwarf'])) $races = $races+128;
  if (isset($_POST['race_Troll'])) $races = $races+256;
  if (isset($_POST['race_Ogre'])) $races = $races+512;
  if (isset($_POST['race_Halfling'])) $races = $races+1024;
  if (isset($_POST['race_Gnome'])) $races = $races+2048;
  if (isset($_POST['race_Iksar'])) $races = $races+4096;
  if (isset($_POST['race_Vah_Shir'])) $races = $races+8192;
  if (isset($_POST['race_Froglok'])) $races = $races+16384;
  if (isset($_POST['race_Drakkin'])) $races = $races+32768;
  if (isset($_POST['race_Shroud'])) $races = $races+65536;

  $classes = 0;
  if (isset($_POST['class_Warrior'])) $classes = $classes+1;
  if (isset($_POST['class_Cleric'])) $classes = $classes+2;
  if (isset($_POST['class_Paladin'])) $classes = $classes+4;
  if (isset($_POST['class_Ranger'])) $classes = $classes+8;
  if (isset($_POST['class_Shadowknight'])) $classes = $classes+16;
  if (isset($_POST['class_Druid'])) $classes = $classes+32;
  if (isset($_POST['class_Monk'])) $classes = $classes+64;
  if (isset($_POST['class_Bard'])) $classes = $classes+128;
  if (isset($_POST['class_Rogue'])) $classes = $classes+256;
  if (isset($_POST['class_Shaman'])) $classes = $classes+512;
  if (isset($_POST['class_Necromancer'])) $classes = $classes+1024;
  if (isset($_POST['class_Wizard'])) $classes = $classes+2048;
  if (isset($_POST['class_Magician'])) $classes = $classes+4096;
  if (isset($_POST['class_Enchanter'])) $classes = $classes+8192;
  if (isset($_POST['class_Beastlord'])) $classes = $classes+16384;
  if (isset($_POST['class_Berserker'])) $classes = $classes+32768;

  $deity = 0;
  if (isset($_POST['deity_Agnostic'])) $deity = $deity+1;
  if (isset($_POST['deity_Bertox'])) $deity = $deity+2;
  if (isset($_POST['deity_Brell'])) $deity = $deity+4;
  if (isset($_POST['deity_Cazic'])) $deity = $deity+8;
  if (isset($_POST['deity_Erollsi'])) $deity = $deity+16;
  if (isset($_POST['deity_Bristlebane'])) $deity = $deity+32;
  if (isset($_POST['deity_Innoruuk'])) $deity = $deity+64;
  if (isset($_POST['deity_Karana'])) $deity = $deity+128;
  if (isset($_POST['deity_Mithaniel_Marr'])) $deity = $deity+256;
  if (isset($_POST['deity_Prexus'])) $deity = $deity+512;
  if (isset($_POST['deity_Quellious'])) $deity = $deity+1024;
  if (isset($_POST['deity_Rallos_Zek'])) $deity = $deity+2048;
  if (isset($_POST['deity_Rodcet_Nife'])) $deity = $deity+4096;
  if (isset($_POST['deity_Solusek_Ro'])) $deity = $deity+8192;
  if (isset($_POST['deity_The_Tribunal'])) $deity = $deity+16384;
  if (isset($_POST['deity_Tunare'])) $deity = $deity+32768;
  if (isset($_POST['deity_Veeshan'])) $deity = $deity+65536;

  $augtype = 0;
  if (isset($_POST['augtype_Type_1'])) $augtype = $augtype+1;
  if (isset($_POST['augtype_Type_2'])) $augtype = $augtype+2;
  if (isset($_POST['augtype_Type_3'])) $augtype = $augtype+4;
  if (isset($_POST['augtype_Type_4'])) $augtype = $augtype+8;
  if (isset($_POST['augtype_Type_5'])) $augtype = $augtype+16;
  if (isset($_POST['augtype_Type_6'])) $augtype = $augtype+32;
  if (isset($_POST['augtype_Type_7'])) $augtype = $augtype+64;
  if (isset($_POST['augtype_Type_8'])) $augtype = $augtype+128;
  if (isset($_POST['augtype_Type_9'])) $augtype = $augtype+256;
  if (isset($_POST['augtype_Type_10'])) $augtype = $augtype+512;
  if (isset($_POST['augtype_Type_11'])) $augtype = $augtype+1024;
  if (isset($_POST['augtype_Type_12'])) $augtype = $augtype+2048;
  if (isset($_POST['augtype_Type_13'])) $augtype = $augtype+4096;
  if (isset($_POST['augtype_Type_14'])) $augtype = $augtype+8192;
  if (isset($_POST['augtype_Type_15'])) $augtype = $augtype+16384;
  if (isset($_POST['augtype_Type_16'])) $augtype = $augtype+32768;
  if (isset($_POST['augtype_Type_17'])) $augtype = $augtype+65536;
  if (isset($_POST['augtype_Type_18'])) $augtype = $augtype+131072;
  if (isset($_POST['augtype_Type_19'])) $augtype = $augtype+262144;
  if (isset($_POST['augtype_Type_20'])) $augtype = $augtype+524288;
  if (isset($_POST['augtype_Type_21'])) $augtype = $augtype+1048576;
  if (isset($_POST['augtype_Type_22'])) $augtype = $augtype+2097152;
  if (isset($_POST['augtype_Type_23'])) $augtype = $augtype+4194304;
  if (isset($_POST['augtype_Type_24'])) $augtype = $augtype+8388608;
  if (isset($_POST['augtype_Type_25'])) $augtype = $augtype+16777216;
  if (isset($_POST['augtype_Type_26'])) $augtype = $augtype+33554432;
  if (isset($_POST['augtype_Type_27'])) $augtype = $augtype+67108864;
  if (isset($_POST['augtype_Type_28'])) $augtype = $augtype+134217728;
  if (isset($_POST['augtype_Type_29'])) $augtype = $augtype+268435456;
  if (isset($_POST['augtype_Type_30'])) $augtype = $augtype+536870912;

  $fields = '';
  if ($item['slots'] != $slots) $fields .= "slots=\"$slots\", ";
  if ($item['races'] != $races) $fields .= "races=\"$races\", ";
  if ($item['classes'] != $classes) $fields .= "classes=\"$classes\", ";
  if ($item['deity'] != $deity) $fields .= "deity=\"$deity\", ";
  if ($item['augtype'] != $augtype) $fields .= "augtype=\"$augtype\", ";
  if ($item['Name'] != $_POST['itemname']) $fields .= "Name=\"" . $_POST['itemname'] . "\", ";
  if ($item['itemtype'] != $_POST['itemtype']) $fields .= "itemtype=\"" . $_POST['itemtype'] . "\", ";
  if ($item['lore'] != $_POST['lore']) $fields .= "lore=\"" . $_POST['lore'] . "\", ";
  if ($item['itemclass'] != $_POST['itemclass']) $fields .= "itemclass=\"" . $_POST['itemclass'] . "\", ";
  if ($item['stackable'] != $_POST['stackable']) $fields .= "stackable=\"" . $_POST['stackable'] . "\", ";
  if ($item['stacksize'] != $_POST['stacksize']) $fields .= "stacksize=\"" . $_POST['stacksize'] . "\", ";
  if ($item['maxcharges'] != $_POST['maxcharges']) $fields .= "maxcharges=\"" . $_POST['maxcharges'] . "\", ";
  if ($item['filename'] != $_POST['filename']) $fields .= "filename=\"" . $_POST['filename'] . "\", ";
  if ($item['book'] != $_POST['book']) $fields .= "book=\"" . $_POST['book'] . "\", ";
  if ($item['booktype'] != $_POST['booktype']) $fields .= "booktype=\"" . $_POST['booktype'] . "\", ";
  if ($item['powersourcecapacity'] != $_POST['powersourcecapacity']) $fields .= "powersourcecapacity=\"" . $_POST['powersourcecapacity'] . "\", ";
  if ($item['charmfile'] != $_POST['charmfile']) $fields .= "charmfile=\"" . $_POST['charmfile'] . "\", ";
  if ($item['charmfileid'] != $_POST['charmfileid']) $fields .= "charmfileid=\"" . $_POST['charmfileid'] . "\", ";
  if ($item['scriptfileid'] != $_POST['scriptfileid']) $fields .= "scriptfileid=\"" . $_POST['scriptfileid'] . "\", ";
  if ($item['potionbeltslots'] != $_POST['potionbeltslots']) $fields .= "potionbeltslots=\"" . $_POST['potionbeltslots'] . "\", ";
  if ($item['bagsize'] != $_POST['bagsize']) $fields .= "bagsize=\"" . $_POST['bagsize'] . "\", ";
  if ($item['bagslots'] != $_POST['bagslots']) $fields .= "bagslots=\"" . $_POST['bagslots'] . "\", ";
  if ($item['bagwr'] != $_POST['bagwr']) $fields .= "bagwr=\"" . $_POST['bagwr'] . "\", ";
  if ($item['bagtype'] != $_POST['bagtype']) $fields .= "bagtype=\"" . $_POST['bagtype'] . "\", ";
  if ($item['nodrop'] != $_POST['nodrop']) $fields .= "nodrop=\"" . $_POST['nodrop'] . "\", ";
  if ($item['norent'] != $_POST['norent']) $fields .= "norent=\"" . $_POST['norent'] . "\", ";
  if ($item['magic'] != $_POST['magic']) $fields .= "magic=\"" . $_POST['magic'] . "\", ";
  if ($item['tradeskills'] != $_POST['tradeskills']) $fields .= "tradeskills=\"" . $_POST['tradeskills'] . "\", ";
  if ($item['artifactflag'] != $_POST['artifactflag']) $fields .= "artifactflag=\"" . $_POST['artifactflag'] . "\", ";
  if ($item['questitemflag'] != $_POST['questitemflag']) $fields .= "questitemflag=\"" . $_POST['questitemflag'] . "\", ";
  if ($item['attuneable'] != $_POST['attuneable']) $fields .= "attuneable=\"" . $_POST['attuneable'] . "\", ";
  if ($item['nopet'] != $_POST['nopet']) $fields .= "nopet=\"" . $_POST['nopet'] . "\", ";
  if ($item['fvnodrop'] != $_POST['fvnodrop']) $fields .= "fvnodrop=\"" . $_POST['fvnodrop'] . "\", ";
  if ($item['notransfer'] != $_POST['notransfer']) $fields .= "notransfer=\"" . $_POST['notransfer'] . "\", ";
  if ($item['potionbelt'] != $_POST['potionbelt']) $fields .= "potionbelt=\"" . $_POST['potionbelt'] . "\", ";
  if ($item['benefitflag'] != $_POST['benefitflag']) $fields .= "benefitflag=\"" . $_POST['benefitflag'] . "\", ";
  if ($item['expendablearrow'] != $_POST['expendablearrow']) $fields .= "expendablearrow=\"" . $_POST['expendablearrow'] . "\", ";
  if ($item['loregroup'] != $_POST['loregroup']) $fields .= "loregroup=\"" . $_POST['loregroup'] . "\", ";
  if ($item['reqlevel'] != $_POST['reqlevel']) $fields .= "reqlevel=\"" . $_POST['reqlevel'] . "\", ";
  if ($item['reclevel'] != $_POST['reclevel']) $fields .= "reclevel=\"" . $_POST['reclevel'] . "\", ";
  if ($item['recskill'] != $_POST['recskill']) $fields .= "recskill=\"" . $_POST['recskill'] . "\", ";
  if ($item['evolvinglevel'] != $_POST['evolvinglevel']) $fields .= "evolvinglevel=\"" . $_POST['evolvinglevel'] . "\", ";
  if ($item['damage'] != $_POST['damage']) $fields .= "damage=\"" . $_POST['damage'] . "\", ";
  if ($item['delay'] != $_POST['delay']) $fields .= "delay=\"" . $_POST['delay'] . "\", ";
  if ($item['range'] != $_POST['range']) $fields .= "`range`=\"" . $_POST['range'] . "\", ";
  if ($item['banedmgamt'] != $_POST['banedmgamt']) $fields .= "banedmgamt=\"" . $_POST['banedmgamt'] . "\", ";
  if ($item['banedmgraceamt'] != $_POST['banedmgraceamt']) $fields .= "banedmgraceamt=\"" . $_POST['banedmgraceamt'] . "\", ";
  if ($item['banedmgrace'] != $_POST['banedmgrace']) $fields .= "banedmgrace=\"" . $_POST['banedmgrace'] . "\", ";
  if ($item['banedmgbody'] != $_POST['banedmgbody']) $fields .= "banedmgbody=\"" . $_POST['banedmgbody'] . "\", ";
  if ($item['hp'] != $_POST['hp']) $fields .= "hp=\"" . $_POST['hp'] . "\", ";
  if ($item['mana'] != $_POST['mana']) $fields .= "mana=\"" . $_POST['mana'] . "\", ";
  if ($item['endur'] != $_POST['endur']) $fields .= "endur=\"" . $_POST['endur'] . "\", ";
  if ($item['ac'] != $_POST['ac']) $fields .= "ac=\"" . $_POST['ac'] . "\", ";
  if ($item['accuracy'] != $_POST['accuracy']) $fields .= "accuracy=\"" . $_POST['accuracy'] . "\", ";
  if ($item['attack'] != $_POST['attack']) $fields .= "attack=\"" . $_POST['attack'] . "\", ";
  if ($item['light'] != $_POST['light']) $fields .= "light=\"" . $_POST['light'] . "\", ";
  if ($item['regen'] != $_POST['regen']) $fields .= "regen=\"" . $_POST['regen'] . "\", ";
  if ($item['manaregen'] != $_POST['manaregen']) $fields .= "manaregen=\"" . $_POST['manaregen'] . "\", ";
  if ($item['enduranceregen'] != $_POST['enduranceregen']) $fields .= "enduranceregen=\"" . $_POST['enduranceregen'] . "\", ";
  if ($item['haste'] != $_POST['haste']) $fields .= "haste=\"" . $_POST['haste'] . "\", ";
  if ($item['avoidance'] != $_POST['avoidance']) $fields .= "avoidance=\"" . $_POST['avoidance'] . "\", ";
  if ($item['purity'] != $_POST['purity']) $fields .= "purity=\"" . $_POST['purity'] . "\", ";
  if ($item['combateffects'] != $_POST['combateffects']) $fields .= "combateffects=\"" . $_POST['combateffects'] . "\", ";
  if ($item['aagi'] != $_POST['aagi']) $fields .= "aagi=\"" . $_POST['aagi'] . "\", ";
  if ($item['acha'] != $_POST['acha']) $fields .= "acha=\"" . $_POST['acha'] . "\", ";
  if ($item['adex'] != $_POST['adex']) $fields .= "adex=\"" . $_POST['adex'] . "\", ";
  if ($item['aint'] != $_POST['aint']) $fields .= "aint=\"" . $_POST['aint'] . "\", ";
  if ($item['asta'] != $_POST['asta']) $fields .= "asta=\"" . $_POST['asta'] . "\", ";
  if ($item['astr'] != $_POST['astr']) $fields .= "astr=\"" . $_POST['astr'] . "\", ";
  if ($item['awis'] != $_POST['awis']) $fields .= "awis=\"" . $_POST['awis'] . "\", ";
  if ($item['cr'] != $_POST['cr']) $fields .= "cr=\"" . $_POST['cr'] . "\", ";
  if ($item['dr'] != $_POST['dr']) $fields .= "dr=\"" . $_POST['dr'] . "\", ";
  if ($item['fr'] != $_POST['fr']) $fields .= "fr=\"" . $_POST['fr'] . "\", ";
  if ($item['mr'] != $_POST['mr']) $fields .= "mr=\"" . $_POST['mr'] . "\", ";
  if ($item['pr'] != $_POST['pr']) $fields .= "pr=\"" . $_POST['pr'] . "\", ";
  if ($item['svcorruption'] != $_POST['svcorruption']) $fields .= "svcorruption=\"" . $_POST['svcorruption'] . "\", ";
  if ($item['stunresist'] != $_POST['stunresist']) $fields .= "stunresist=\"" . $_POST['stunresist'] . "\", ";
  if ($item['heroic_agi'] != $_POST['heroic_agi']) $fields .= "heroic_agi=\"" . $_POST['heroic_agi'] . "\", ";
  if ($item['heroic_cha'] != $_POST['heroic_cha']) $fields .= "heroic_cha=\"" . $_POST['heroic_cha'] . "\", ";
  if ($item['heroic_dex'] != $_POST['heroic_dex']) $fields .= "heroic_dex=\"" . $_POST['heroic_dex'] . "\", ";
  if ($item['heroic_int'] != $_POST['heroic_int']) $fields .= "heroic_int=\"" . $_POST['heroic_int'] . "\", ";
  if ($item['heroic_sta'] != $_POST['heroic_sta']) $fields .= "heroic_sta=\"" . $_POST['heroic_sta'] . "\", ";
  if ($item['heroic_str'] != $_POST['heroic_str']) $fields .= "heroic_str=\"" . $_POST['heroic_str'] . "\", ";
  if ($item['heroic_wis'] != $_POST['heroic_wis']) $fields .= "heroic_wis=\"" . $_POST['heroic_wis'] . "\", ";
  if ($item['heroic_cr'] != $_POST['heroic_cr']) $fields .= "heroic_cr=\"" . $_POST['heroic_cr'] . "\", ";
  if ($item['heroic_dr'] != $_POST['heroic_dr']) $fields .= "heroic_dr=\"" . $_POST['heroic_dr'] . "\", ";
  if ($item['heroic_fr'] != $_POST['heroic_fr']) $fields .= "heroic_fr=\"" . $_POST['heroic_fr'] . "\", ";
  if ($item['heroic_mr'] != $_POST['heroic_mr']) $fields .= "heroic_mr=\"" . $_POST['heroic_mr'] . "\", ";
  if ($item['heroic_pr'] != $_POST['heroic_pr']) $fields .= "heroic_pr=\"" . $_POST['heroic_pr'] . "\", ";
  if ($item['heroic_svcorrup'] != $_POST['heroic_svcorrup']) $fields .= "heroic_svcorrup=\"" . $_POST['heroic_svcorrup'] . "\", ";
  if ($item['damageshield'] != $_POST['damageshield']) $fields .= "damageshield=\"" . $_POST['damageshield'] . "\", ";
  if ($item['dotshielding'] != $_POST['dotshielding']) $fields .= "dotshielding=\"" . $_POST['dotshielding'] . "\", ";
  if ($item['shielding'] != $_POST['shielding']) $fields .= "shielding=\"" . $_POST['shielding'] . "\", ";
  if ($item['spellshield'] != $_POST['spellshield']) $fields .= "spellshield=\"" . $_POST['spellshield'] . "\", ";
  if ($item['strikethrough'] != $_POST['strikethrough']) $fields .= "strikethrough=\"" . $_POST['strikethrough'] . "\", ";
  if ($item['spelldmg'] != $_POST['spelldmg']) $fields .= "spelldmg=\"" . $_POST['spelldmg'] . "\", ";
  if ($item['backstabdmg'] != $_POST['backstabdmg']) $fields .= "backstabdmg=\"" . $_POST['backstabdmg'] . "\", ";
  if ($item['extradmgskill'] != $_POST['extradmgskill']) $fields .= "extradmgskill=\"" . $_POST['extradmgskill'] . "\", ";
  if ($item['extradmgamt'] != $_POST['extradmgamt']) $fields .= "extradmgamt=\"" . $_POST['extradmgamt'] . "\", ";
  if ($item['elemdmgtype'] != $_POST['elemdmgtype']) $fields .= "elemdmgtype=\"" . $_POST['elemdmgtype'] . "\", ";
  if ($item['elemdmgamt'] != $_POST['elemdmgamt']) $fields .= "elemdmgamt=\"" . $_POST['elemdmgamt'] . "\", ";
  if ($item['dsmitigation'] != $_POST['dsmitigation']) $fields .= "dsmitigation=\"" . $_POST['dsmitigation'] . "\", ";
  if ($item['healamt'] != $_POST['healamt']) $fields .= "healamt=\"" . $_POST['healamt'] . "\", ";
  if ($item['clairvoyance'] != $_POST['clairvoyance']) $fields .= "clairvoyance=\"" . $_POST['clairvoyance'] . "\", ";
  if ($item['skillmodtype'] != $_POST['skillmodtype']) $fields .= "skillmodtype=\"" . $_POST['skillmodtype'] . "\", ";
  if ($item['skillmodvalue'] != $_POST['skillmodvalue']) $fields .= "skillmodvalue=\"" . $_POST['skillmodvalue'] . "\", ";
  if ($item['skillmodmax'] != $_POST['skillmodmax']) $fields .= "skillmodmax=\"" . $_POST['skillmodmax'] . "\", ";
  if ($item['bardvalue'] != $_POST['bardvalue']) $fields .= "bardvalue=\"" . $_POST['bardvalue'] . "\", ";
  if ($item['price'] != $_POST['price']) $fields .= "price=\"" . $_POST['price'] . "\", ";
  if ($item['sellrate'] != $_POST['sellrate']) $fields .= "sellrate=\"" . $_POST['sellrate'] . "\", ";
  if ($item['favor'] != $_POST['favor']) $fields .= "favor=\"" . $_POST['favor'] . "\", ";
  if ($item['guildfavor'] != $_POST['guildfavor']) $fields .= "guildfavor=\"" . $_POST['guildfavor'] . "\", ";
  if ($item['ldonprice'] != $_POST['ldonprice']) $fields .= "ldonprice=\"" . $_POST['ldonprice'] . "\", ";
  if ($item['ldonsellbackrate'] != $_POST['ldonsellbackrate']) $fields .= "ldonsellbackrate=\"" . $_POST['ldonsellbackrate'] . "\", ";
  if ($item['ldonsold'] != $_POST['ldonsold']) $fields .= "ldonsold=\"" . $_POST['ldonsold'] . "\", ";
  if ($item['ldontheme'] != $_POST['ldontheme']) $fields .= "ldontheme=\"" . $_POST['ldontheme'] . "\", ";
  if ($item['pointtype'] != $_POST['pointtype']) $fields .= "pointtype=\"" . $_POST['pointtype'] . "\", ";
  if ($item['icon'] != $_POST['icon']) $fields .= "icon=\"" . $_POST['icon'] . "\", ";
  if ($item['idfile'] != $_POST['idfile']) $fields .= "idfile=\"" . $_POST['idfile'] . "\", ";
  if ($item['weight'] != $_POST['weight']) $fields .= "weight=\"" . $_POST['weight'] . "\", ";
  if ($item['color'] != $_POST['color']) $fields .= "color=\"" . $_POST['color'] . "\", ";
  if ($item['size'] != $_POST['size']) $fields .= "size=\"" . $_POST['size'] . "\", ";
  if ($item['material'] != $_POST['material']) $fields .= "material=\"" . $_POST['material'] . "\", ";
  if ($item['elitematerial'] != $_POST['elitematerial']) $fields .= "elitematerial=\"" . $_POST['elitematerial'] . "\", ";
  if ($item['casttime'] != $_POST['casttime']) $fields .= "casttime=\"" . $_POST['casttime'] . "\", ";
  if ($item['casttime_'] != $_POST['casttime_']) $fields .= "casttime_=\"" . $_POST['casttime_'] . "\", ";
  if ($item['recastdelay'] != $_POST['recastdelay']) $fields .= "recastdelay=\"" . $_POST['recastdelay'] . "\", ";
  if ($item['recasttype'] != $_POST['recasttype']) $fields .= "recasttype=\"" . $_POST['recasttype'] . "\", ";
  if ($item['clicktype'] != $_POST['clicktype']) $fields .= "clicktype=\"" . $_POST['clicktype'] . "\", ";
  if ($item['clickeffect'] != $_POST['clickeffect']) $fields .= "clickeffect=\"" . $_POST['clickeffect'] . "\", ";
  if ($item['clicklevel'] != $_POST['clicklevel']) $fields .= "clicklevel=\"" . $_POST['clicklevel'] . "\", ";
  if ($item['clicklevel2'] != $_POST['clicklevel2']) $fields .= "clicklevel2=\"" . $_POST['clicklevel2'] . "\", ";
  if ($item['clickname'] != $_POST['clickname']) $fields .= "clickname=\"" . $_POST['clickname'] . "\", ";
  if ($item['proctype'] != $_POST['proctype']) $fields .= "proctype=\"" . $_POST['proctype'] . "\", ";
  if ($item['proceffect'] != $_POST['proceffect']) $fields .= "proceffect=\"" . $_POST['proceffect'] . "\", ";
  if ($item['proclevel'] != $_POST['proclevel']) $fields .= "proclevel=\"" . $_POST['proclevel'] . "\", ";
  if ($item['proclevel2'] != $_POST['proclevel2']) $fields .= "proclevel2=\"" . $_POST['proclevel2'] . "\", ";
  if ($item['procrate'] != $_POST['procrate']) $fields .= "procrate=\"" . $_POST['procrate'] . "\", ";
  if ($item['procname'] != $_POST['procname']) $fields .= "procname=\"" . $_POST['procname'] . "\", ";
  if ($item['worntype'] != $_POST['worntype']) $fields .= "worntype=\"" . $_POST['worntype'] . "\", ";
  if ($item['worneffect'] != $_POST['worneffect']) $fields .= "worneffect=\"" . $_POST['worneffect'] . "\", ";
  if ($item['wornlevel'] != $_POST['wornlevel']) $fields .= "wornlevel=\"" . $_POST['wornlevel'] . "\", ";
  if ($item['wornlevel2'] != $_POST['wornlevel2']) $fields .= "wornlevel2=\"" . $_POST['wornlevel2'] . "\", ";
  if ($item['wornname'] != $_POST['wornname']) $fields .= "wornname=\"" . $_POST['wornname'] . "\", ";
  if ($item['focustype'] != $_POST['focustype']) $fields .= "focustype=\"" . $_POST['focustype'] . "\", ";
  if ($item['focuseffect'] != $_POST['focuseffect']) $fields .= "focuseffect=\"" . $_POST['focuseffect'] . "\", ";
  if ($item['focuslevel'] != $_POST['focuslevel']) $fields .= "focuslevel=\"" . $_POST['focuslevel'] . "\", ";
  if ($item['focuslevel2'] != $_POST['focuslevel2']) $fields .= "focuslevel2=\"" . $_POST['focuslevel2'] . "\", ";
  if ($item['focusname'] != $_POST['focusname']) $fields .= "focusname=\"" . $_POST['focusname'] . "\", ";
  if ($item['scrolltype'] != $_POST['scrolltype']) $fields .= "scrolltype=\"" . $_POST['scrolltype'] . "\", ";
  if ($item['scrolleffect'] != $_POST['scrolleffect']) $fields .= "scrolleffect=\"" . $_POST['scrolleffect'] . "\", ";
  if ($item['scrolllevel'] != $_POST['scrolllevel']) $fields .= "scrolllevel=\"" . $_POST['scrolllevel'] . "\", ";
  if ($item['scrolllevel2'] != $_POST['scrolllevel2']) $fields .= "scrolllevel2=\"" . $_POST['scrolllevel2'] . "\", ";
  if ($item['scrollname'] != $_POST['scrollname']) $fields .= "scrollname=\"" . $_POST['scrollname'] . "\", ";
  if ($item['bardtype'] != $_POST['bardtype']) $fields .= "bardtype=\"" . $_POST['bardtype'] . "\", ";
  if ($item['bardeffect'] != $_POST['bardeffect']) $fields .= "bardeffect=\"" . $_POST['bardeffect'] . "\", ";
  if ($item['bardlevel'] != $_POST['bardlevel']) $fields .= "bardlevel=\"" . $_POST['bardlevel'] . "\", ";
  if ($item['bardlevel2'] != $_POST['bardlevel2']) $fields .= "bardlevel2=\"" . $_POST['bardlevel2'] . "\", ";
  if ($item['bardname'] != $_POST['bardname']) $fields .= "bardname=\"" . $_POST['bardname'] . "\", ";
  if ($item['augslot1visible'] != $_POST['augslot1visible']) $fields .= "augslot1visible=\"" . $_POST['augslot1visible'] . "\", ";
  if ($item['augslot2visible'] != $_POST['augslot2visible']) $fields .= "augslot2visible=\"" . $_POST['augslot2visible'] . "\", ";
  if ($item['augslot3visible'] != $_POST['augslot3visible']) $fields .= "augslot3visible=\"" . $_POST['augslot3visible'] . "\", ";
  if ($item['augslot4visible'] != $_POST['augslot4visible']) $fields .= "augslot4visible=\"" . $_POST['augslot4visible'] . "\", ";
  if ($item['augslot5visible'] != $_POST['augslot5visible']) $fields .= "augslot5visible=\"" . $_POST['augslot5visible'] . "\", ";
  if ($item['augslot1type'] != $_POST['augslot1type']) $fields .= "augslot1type=\"" . $_POST['augslot1type'] . "\", ";
  if ($item['augslot2type'] != $_POST['augslot2type']) $fields .= "augslot2type=\"" . $_POST['augslot2type'] . "\", ";
  if ($item['augslot3type'] != $_POST['augslot3type']) $fields .= "augslot3type=\"" . $_POST['augslot3type'] . "\", ";
  if ($item['augslot4type'] != $_POST['augslot4type']) $fields .= "augslot4type=\"" . $_POST['augslot4type'] . "\", ";
  if ($item['augslot5type'] != $_POST['augslot5type']) $fields .= "augslot5type=\"" . $_POST['augslot5type'] . "\", ";
  if ($item['augrestrict'] != $_POST['augrestrict']) $fields .= "augrestrict=\"" . $_POST['augrestrict'] . "\", ";
  if ($item['augdistiller'] != $_POST['augdistiller']) $fields .= "augdistiller=\"" . $_POST['augdistiller'] . "\", ";
  if ($item['factionmod1'] != $_POST['factionmod1']) $fields .= "factionmod1=\"" . $_POST['factionmod1'] . "\", ";
  if ($item['factionmod2'] != $_POST['factionmod2']) $fields .= "factionmod2=\"" . $_POST['factionmod2'] . "\", ";
  if ($item['factionmod3'] != $_POST['factionmod3']) $fields .= "factionmod3=\"" . $_POST['factionmod3'] . "\", ";
  if ($item['factionmod4'] != $_POST['factionmod4']) $fields .= "factionmod4=\"" . $_POST['factionmod4'] . "\", ";
  if ($item['factionamt1'] != $_POST['factionamt1']) $fields .= "factionamt1=\"" . $_POST['factionamt1'] . "\", ";
  if ($item['factionamt2'] != $_POST['factionamt2']) $fields .= "factionamt2=\"" . $_POST['factionamt2'] . "\", ";
  if ($item['factionamt3'] != $_POST['factionamt3']) $fields .= "factionamt3=\"" . $_POST['factionamt3'] . "\", ";
  if ($item['factionamt4'] != $_POST['factionamt4']) $fields .= "factionamt4=\"" . $_POST['factionamt4'] . "\", ";
  if ($item['created'] != $_POST['created']) $fields .= "created=\"" . $_POST['created'] . "\", ";
  if ($item['verified'] != $_POST['verified']) $fields .= "verified=\"" . $_POST['verified'] . "\", ";
  if ($item['source'] != $_POST['source']) $fields .= "source=\"" . $_POST['source'] . "\", ";
  if ($item['comment'] != $_POST['comment']) $fields .= "comment=\"" . $_POST['comment'] . "\", ";
  if ($fields != '') $fields .= "updated=\"" . $_POST['updated'] . "\", ";
  $fields =  rtrim($fields, ", ");

  if ($fields != '') {
    $query = "UPDATE items SET $fields WHERE id=$id";
    $mysql->query_no_result($query);
  }
}

function copy_item () {
  global $mysql;

   $id = $_GET['id'];
   
   $query = "DELETE FROM items where id=0";
   $mysql->query_no_result($query);

   $query2 = "INSERT INTO items (minstatus, Name, aagi, ac, accuracy, acha, adex, aint, artifactflag, asta, astr, attack, augrestrict, augslot1type, augslot1visible, augslot2type, augslot2visible, augslot3type, augslot3visible, augslot4type, augslot4visible, augslot5type, augslot5visible, augtype, avoidance, awis, bagsize, bagslots, bagtype, bagwr, banedmgamt, banedmgraceamt, banedmgbody, banedmgrace, bardtype, bardvalue, book, casttime, casttime_, charmfile, charmfileid, classes, color, combateffects, extradmgskill, extradmgamt, price, cr, damage, damageshield, deity, delay, augdistiller, dotshielding, dr, clicktype, clicklevel2, elemdmgtype, elemdmgamt, endur, factionamt1, factionamt2, factionamt3, factionamt4, factionmod1, factionmod2, factionmod3, factionmod4, filename, focuseffect, fr, fvnodrop, haste, clicklevel, hp, regen, icon, idfile, itemclass, itemtype, ldonprice, ldontheme, ldonsold, light, lore, loregroup, magic, mana, manaregen, enduranceregen, material, maxcharges, mr, nodrop, norent, pendingloreflag, pr, procrate, races, `range`, reclevel, recskill, reqlevel, sellrate, shielding, size, skillmodtype, skillmodvalue, skillmodmax, slots, clickeffect, spellshield, strikethrough, stunresist, summonedflag, tradeskills, favor, weight, UNK012, UNK013, benefitflag, UNK054, UNK059, booktype, recastdelay, recasttype, guildfavor, UNK123, UNK124, attuneable, nopet, updated, comment, UNK127, pointtype, potionbelt, potionbeltslots, stacksize, notransfer, stackable, UNK134, UNK137, proceffect, proctype, proclevel2, proclevel, UNK142, worneffect, worntype, wornlevel2, wornlevel, UNK147, focustype, focuslevel2, focuslevel, UNK152, scrolleffect, scrolltype, scrolllevel2, scrolllevel, UNK157, serialized, verified, serialization, source, UNK033, lorefile, UNK014, svcorruption, UNK060, augslot1unk2, augslot2unk2, augslot3unk2, augslot4unk2, augslot5unk2, UNK120, UNK121, questitemflag, UNK132, clickunk5, clickunk6, clickunk7, procunk1, procunk2, procunk3, procunk4, procunk6, procunk7, wornunk1, wornunk2, wornunk3, wornunk4, wornunk5, wornunk6, wornunk7, focusunk1, focusunk2, focusunk3, focusunk4, focusunk5, focusunk6, focusunk7, scrollunk1, scrollunk2, scrollunk3, scrollunk4, scrollunk5, scrollunk6, scrollunk7, UNK193, purity, evolvinglevel, clickname, procname, wornname, focusname, scrollname, dsmitigation, heroic_str, heroic_int, heroic_wis, heroic_agi, heroic_dex, heroic_sta, heroic_cha, heroic_pr, heroic_dr, heroic_fr, heroic_cr, heroic_mr, heroic_svcorrup, healamt, spelldmg, clairvoyance, backstabdmg, created, elitematerial, ldonsellbackrate, scriptfileid, expendablearrow, powersourcecapacity, bardeffect, bardeffecttype, bardlevel2, bardlevel, bardunk1, bardunk2, bardunk3, bardunk4,bardunk5, bardname, bardunk7, UNK214)
              SELECT minstatus, concat(Name, ' - Copy'), aagi, ac, accuracy, acha, adex, aint, artifactflag, asta, astr, attack, augrestrict, augslot1type, augslot1visible, augslot2type, augslot2visible, augslot3type, augslot3visible, augslot4type, augslot4visible, augslot5type, augslot5visible, augtype, avoidance, awis, bagsize, bagslots, bagtype, bagwr, banedmgamt, banedmgraceamt, banedmgbody, banedmgrace, bardtype, bardvalue, book, casttime, casttime_, charmfile, charmfileid, classes, color, combateffects, extradmgskill, extradmgamt, price, cr, damage, damageshield, deity, delay, augdistiller, dotshielding, dr, clicktype, clicklevel2, elemdmgtype, elemdmgamt, endur, factionamt1, factionamt2, factionamt3, factionamt4, factionmod1, factionmod2, factionmod3, factionmod4, filename, focuseffect, fr, fvnodrop, haste, clicklevel, hp, regen, icon, idfile, itemclass, itemtype, ldonprice, ldontheme, ldonsold, light, lore, loregroup, magic, mana, manaregen, enduranceregen, material, maxcharges, mr, nodrop, norent, pendingloreflag, pr, procrate, races, `range`, reclevel, recskill, reqlevel, sellrate, shielding, size, skillmodtype, skillmodvalue, skillmodmax, slots, clickeffect, spellshield, strikethrough, stunresist, summonedflag, tradeskills, favor, weight, UNK012, UNK013, benefitflag, UNK054, UNK059, booktype, recastdelay, recasttype, guildfavor, UNK123, UNK124, attuneable, nopet, updated, comment, UNK127, pointtype, potionbelt, potionbeltslots, stacksize, notransfer, stackable, UNK134, UNK137, proceffect, proctype, proclevel2, proclevel, UNK142, worneffect, worntype, wornlevel2, wornlevel, UNK147, focustype, focuslevel2, focuslevel, UNK152, scrolleffect, scrolltype, scrolllevel2, scrolllevel, UNK157, serialized, verified, serialization, source, UNK033, lorefile, UNK014, svcorruption, UNK060, augslot1unk2, augslot2unk2, augslot3unk2, augslot4unk2, augslot5unk2, UNK120, UNK121, questitemflag, UNK132, clickunk5, clickunk6, clickunk7, procunk1, procunk2, procunk3, procunk4, procunk6, procunk7, wornunk1, wornunk2, wornunk3, wornunk4, wornunk5, wornunk6, wornunk7, focusunk1, focusunk2, focusunk3, focusunk4, focusunk5, focusunk6, focusunk7, scrollunk1, scrollunk2, scrollunk3, scrollunk4, scrollunk5, scrollunk6, scrollunk7, UNK193, purity, evolvinglevel, clickname, procname, wornname, focusname, scrollname, dsmitigation, heroic_str, heroic_int, heroic_wis, heroic_agi, heroic_dex, heroic_sta, heroic_cha, heroic_pr, heroic_dr, heroic_fr, heroic_cr, heroic_mr, heroic_svcorrup, healamt, spelldmg, clairvoyance, backstabdmg, created, elitematerial, ldonsellbackrate, scriptfileid, expendablearrow, powersourcecapacity, bardeffect, bardeffecttype, bardlevel2, bardlevel, bardunk1, bardunk2, bardunk3, bardunk4, bardunk5, bardname, bardunk7, UNK214 FROM items where id=$id";
   $mysql->query_no_result($query2);

   $query3 = "SELECT max(id) AS iid FROM items"; 
   $result = $mysql->query_assoc($query3);
   $newid = $result['iid'] + 1;

   $query4 = "UPDATE items set id=$newid WHERE id=0";
   $mysql->query_no_result($query4);

   return $newid;
}

function get_max_id () {
  global $mysql;

  $query = "SELECT max(id) AS iid FROM items"; 
  $result = $mysql->query_assoc($query);
  $newid = $result['iid'] + 1;

  return $newid;
}

function add_item () {
  global $mysql;

  // Define checkbox fields:
  $slots = 0;
  if (isset($_POST['slot_Charm'])) $slots = $slots+1;
  if (isset($_POST['slot_Ear01'])) $slots = $slots+2;
  if (isset($_POST['slot_Head'])) $slots = $slots+4;
  if (isset($_POST['slot_Face'])) $slots = $slots+8;
  if (isset($_POST['slot_Ear02'])) $slots = $slots+16;
  if (isset($_POST['slot_Neck'])) $slots = $slots+32;
  if (isset($_POST['slot_Shoulder'])) $slots = $slots+64;
  if (isset($_POST['slot_Arms'])) $slots = $slots+128;
  if (isset($_POST['slot_Back'])) $slots = $slots+256;
  if (isset($_POST['slot_Bracer01'])) $slots = $slots+512;
  if (isset($_POST['slot_Bracer02'])) $slots = $slots+1024;
  if (isset($_POST['slot_Range'])) $slots = $slots+2048;
  if (isset($_POST['slot_Hands'])) $slots = $slots+4096;
  if (isset($_POST['slot_Primary'])) $slots = $slots+8192;
  if (isset($_POST['slot_Secondary'])) $slots = $slots+16384;
  if (isset($_POST['slot_Ring01'])) $slots = $slots+32768;
  if (isset($_POST['slot_Ring02'])) $slots = $slots+65536;
  if (isset($_POST['slot_Chest'])) $slots = $slots+131072;
  if (isset($_POST['slot_Legs'])) $slots = $slots+262144;
  if (isset($_POST['slot_Feet'])) $slots = $slots+524288;
  if (isset($_POST['slot_Waist'])) $slots = $slots+1048576;
  if (isset($_POST['slot_Ammo'])) $slots = $slots+2097152;
  if (isset($_POST['slot_Powersource'])) $slots = $slots+4194304;

  $races = 0;
  if (isset($_POST['race_Human'])) $races = $races+1;
  if (isset($_POST['race_Barbarian'])) $races = $races+2;
  if (isset($_POST['race_Erudite'])) $races = $races+4;
  if (isset($_POST['race_Wood_Elf'])) $races = $races+8;
  if (isset($_POST['race_High_Elf'])) $races = $races+16;
  if (isset($_POST['race_Dark_Elf'])) $races = $races+32;
  if (isset($_POST['race_Half_Elf'])) $races = $races+64;
  if (isset($_POST['race_Dwarf'])) $races = $races+128;
  if (isset($_POST['race_Troll'])) $races = $races+256;
  if (isset($_POST['race_Ogre'])) $races = $races+512;
  if (isset($_POST['race_Halfling'])) $races = $races+1024;
  if (isset($_POST['race_Gnome'])) $races = $races+2048;
  if (isset($_POST['race_Iksar'])) $races = $races+4096;
  if (isset($_POST['race_Vah_Shir'])) $races = $races+8192;
  if (isset($_POST['race_Froglok'])) $races = $races+16384;
  if (isset($_POST['race_Drakkin'])) $races = $races+32768;
  if (isset($_POST['race_Shroud'])) $races = $races+65536;
  
  $classes = 0;
  if (isset($_POST['class_Warrior'])) $classes = $classes+1;
  if (isset($_POST['class_Cleric'])) $classes = $classes+2;
  if (isset($_POST['class_Paladin'])) $classes = $classes+4;
  if (isset($_POST['class_Ranger'])) $classes = $classes+8;
  if (isset($_POST['class_Shadowknight'])) $classes = $classes+16;
  if (isset($_POST['class_Druid'])) $classes = $classes+32;
  if (isset($_POST['class_Monk'])) $classes = $classes+64;
  if (isset($_POST['class_Bard'])) $classes = $classes+128;
  if (isset($_POST['class_Rogue'])) $classes = $classes+256;
  if (isset($_POST['class_Shaman'])) $classes = $classes+512;
  if (isset($_POST['class_Necromancer'])) $classes = $classes+1024;
  if (isset($_POST['class_Wizard'])) $classes = $classes+2048;
  if (isset($_POST['class_Magician'])) $classes = $classes+4096;
  if (isset($_POST['class_Enchanter'])) $classes = $classes+8192;
  if (isset($_POST['class_Beastlord'])) $classes = $classes+16384;
  if (isset($_POST['class_Berserker'])) $classes = $classes+32768;
  
  $deity = 0;
  if (isset($_POST['deity_Agnostic'])) $deity = $deity+1;
  if (isset($_POST['deity_Bertox'])) $deity = $deity+2;
  if (isset($_POST['deity_Brell'])) $deity = $deity+4;
  if (isset($_POST['deity_Cazic'])) $deity = $deity+8;
  if (isset($_POST['deity_Erollsi'])) $deity = $deity+16;
  if (isset($_POST['deity_Bristlebane'])) $deity = $deity+32;
  if (isset($_POST['deity_Innoruuk'])) $deity = $deity+64;
  if (isset($_POST['deity_Karana'])) $deity = $deity+128;
  if (isset($_POST['deity_Mithaniel_Marr'])) $deity = $deity+256;
  if (isset($_POST['deity_Prexus'])) $deity = $deity+512;
  if (isset($_POST['deity_Quellious'])) $deity = $deity+1024;
  if (isset($_POST['deity_Rallos_Zek'])) $deity = $deity+2048;
  if (isset($_POST['deity_Rodcet_Nife'])) $deity = $deity+4096;
  if (isset($_POST['deity_Solusek_Ro'])) $deity = $deity+8192;
  if (isset($_POST['deity_The_Tribunal'])) $deity = $deity+16384;
  if (isset($_POST['deity_Tunare'])) $deity = $deity+32768;
  if (isset($_POST['deity_Veeshan'])) $deity = $deity+65536;

  $augtype = 0;
  if (isset($_POST['augtype_Type_1'])) $augtype = $augtype+1;
  if (isset($_POST['augtype_Type_2'])) $augtype = $augtype+2;
  if (isset($_POST['augtype_Type_3'])) $augtype = $augtype+4;
  if (isset($_POST['augtype_Type_4'])) $augtype = $augtype+8;
  if (isset($_POST['augtype_Type_5'])) $augtype = $augtype+16;
  if (isset($_POST['augtype_Type_6'])) $augtype = $augtype+32;
  if (isset($_POST['augtype_Type_7'])) $augtype = $augtype+64;
  if (isset($_POST['augtype_Type_8'])) $augtype = $augtype+128;
  if (isset($_POST['augtype_Type_9'])) $augtype = $augtype+256;
  if (isset($_POST['augtype_Type_10'])) $augtype = $augtype+512;
  if (isset($_POST['augtype_Type_11'])) $augtype = $augtype+1024;
  if (isset($_POST['augtype_Type_12'])) $augtype = $augtype+2048;
  if (isset($_POST['augtype_Type_13'])) $augtype = $augtype+4096;
  if (isset($_POST['augtype_Type_14'])) $augtype = $augtype+8192;
  if (isset($_POST['augtype_Type_15'])) $augtype = $augtype+16384;
  if (isset($_POST['augtype_Type_16'])) $augtype = $augtype+32768;
  if (isset($_POST['augtype_Type_17'])) $augtype = $augtype+65536;
  if (isset($_POST['augtype_Type_18'])) $augtype = $augtype+131072;
  if (isset($_POST['augtype_Type_19'])) $augtype = $augtype+262144;
  if (isset($_POST['augtype_Type_20'])) $augtype = $augtype+524288;
  if (isset($_POST['augtype_Type_21'])) $augtype = $augtype+1048576;
  if (isset($_POST['augtype_Type_22'])) $augtype = $augtype+2097152;
  if (isset($_POST['augtype_Type_23'])) $augtype = $augtype+4194304;
  if (isset($_POST['augtype_Type_24'])) $augtype = $augtype+8388608;
  if (isset($_POST['augtype_Type_25'])) $augtype = $augtype+16777216;
  if (isset($_POST['augtype_Type_26'])) $augtype = $augtype+33554432;
  if (isset($_POST['augtype_Type_27'])) $augtype = $augtype+67108864;
  if (isset($_POST['augtype_Type_28'])) $augtype = $augtype+134217728;
  if (isset($_POST['augtype_Type_29'])) $augtype = $augtype+268435456;
  if (isset($_POST['augtype_Type_30'])) $augtype = $augtype+536870912;

  $fields = '';
  $fields .= "slots=\"$slots\", ";
  $fields .= "races=\"$races\", ";
  $fields .= "classes=\"$classes\", ";
  $fields .= "deity=\"$deity\", ";
  $fields .= "augtype=\"$augtype\", ";
  $fields .= "id=\"" . $_POST['id'] . "\", ";
  $fields .= "name=\"" . $_POST['itemname'] . "\", ";
  $fields .= "itemtype=\"" . $_POST['itemtype'] . "\", ";
  $fields .= "lore=\"" . $_POST['lore'] . "\", ";
  $fields .= "itemclass=\"" . $_POST['itemclass'] . "\", ";
  $fields .= "stackable=\"" . $_POST['stackable'] . "\", ";
  $fields .= "stacksize=\"" . $_POST['stacksize'] . "\", ";
  $fields .= "maxcharges=\"" . $_POST['maxcharges'] . "\", ";
  $fields .= "filename=\"" . $_POST['filename'] . "\", ";
  $fields .= "book=\"" . $_POST['book'] . "\", ";
  $fields .= "booktype=\"" . $_POST['booktype'] . "\", ";
  $fields .= "powersourcecapacity=\"" . $_POST['powersourcecapacity'] . "\", ";
  $fields .= "charmfile=\"" . $_POST['charmfile'] . "\", ";
  $fields .= "charmfileid=\"" . $_POST['charmfileid'] . "\", ";
  $fields .= "scriptfileid=\"" . $_POST['scriptfileid'] . "\", ";
  $fields .= "potionbeltslots=\"" . $_POST['potionbeltslots'] . "\", ";
  $fields .= "bagsize=\"" . $_POST['bagsize'] . "\", ";
  $fields .= "bagslots=\"" . $_POST['bagslots'] . "\", ";
  $fields .= "bagwr=\"" . $_POST['bagwr'] . "\", ";
  $fields .= "bagtype=\"" . $_POST['bagtype'] . "\", ";
  $fields .= "nodrop=\"" . $_POST['nodrop'] . "\", ";
  $fields .= "norent=\"" . $_POST['norent'] . "\", ";
  $fields .= "magic=\"" . $_POST['magic'] . "\", ";
  $fields .= "tradeskills=\"" . $_POST['tradeskills'] . "\", ";
  $fields .= "artifactflag=\"" . $_POST['artifactflag'] . "\", ";
  $fields .= "questitemflag=\"" . $_POST['questitemflag'] . "\", ";
  $fields .= "attuneable=\"" . $_POST['attuneable'] . "\", ";
  $fields .= "nopet=\"" . $_POST['nopet'] . "\", ";
  $fields .= "fvnodrop=\"" . $_POST['fvnodrop'] . "\", ";
  $fields .= "notransfer=\"" . $_POST['notransfer'] . "\", ";
  $fields .= "potionbelt=\"" . $_POST['potionbelt'] . "\", ";
  $fields .= "benefitflag=\"" . $_POST['benefitflag'] . "\", ";
  $fields .= "expendablearrow=\"" . $_POST['expendablearrow'] . "\", ";
  $fields .= "loregroup=\"" . $_POST['loregroup'] . "\", ";
  $fields .= "reqlevel=\"" . $_POST['reqlevel'] . "\", ";
  $fields .= "reclevel=\"" . $_POST['reclevel'] . "\", ";
  $fields .= "recskill=\"" . $_POST['recskill'] . "\", ";
  $fields .= "evolvinglevel=\"" . $_POST['evolvinglevel'] . "\", ";
  $fields .= "damage=\"" . $_POST['damage'] . "\", ";
  $fields .= "delay=\"" . $_POST['delay'] . "\", ";
  $fields .= "`range`=\"" . $_POST['range'] . "\", ";
  $fields .= "banedmgamt=\"" . $_POST['banedmgamt'] . "\", ";
  $fields .= "banedmgraceamt=\"" . $_POST['banedmgraceamt'] . "\", ";
  $fields .= "banedmgrace=\"" . $_POST['banedmgrace'] . "\", ";
  $fields .= "banedmgbody=\"" . $_POST['banedmgbody'] . "\", ";
  $fields .= "hp=\"" . $_POST['hp'] . "\", ";
  $fields .= "mana=\"" . $_POST['mana'] . "\", ";
  $fields .= "endur=\"" . $_POST['endur'] . "\", ";
  $fields .= "ac=\"" . $_POST['ac'] . "\", ";
  $fields .= "accuracy=\"" . $_POST['accuracy'] . "\", ";
  $fields .= "attack=\"" . $_POST['attack'] . "\", ";
  $fields .= "light=\"" . $_POST['light'] . "\", ";
  $fields .= "regen=\"" . $_POST['regen'] . "\", ";
  $fields .= "manaregen=\"" . $_POST['manaregen'] . "\", ";
  $fields .= "enduranceregen=\"" . $_POST['enduranceregen'] . "\", ";
  $fields .= "haste=\"" . $_POST['haste'] . "\", ";
  $fields .= "avoidance=\"" . $_POST['avoidance'] . "\", ";
  $fields .= "purity=\"" . $_POST['purity'] . "\", ";
  $fields .= "combateffects=\"" . $_POST['combateffects'] . "\", ";
  $fields .= "aagi=\"" . $_POST['aagi'] . "\", ";
  $fields .= "acha=\"" . $_POST['acha'] . "\", ";
  $fields .= "adex=\"" . $_POST['adex'] . "\", ";
  $fields .= "aint=\"" . $_POST['aint'] . "\", ";
  $fields .= "asta=\"" . $_POST['asta'] . "\", ";
  $fields .= "astr=\"" . $_POST['astr'] . "\", ";
  $fields .= "awis=\"" . $_POST['awis'] . "\", ";
  $fields .= "cr=\"" . $_POST['cr'] . "\", ";
  $fields .= "dr=\"" . $_POST['dr'] . "\", ";
  $fields .= "fr=\"" . $_POST['fr'] . "\", ";
  $fields .= "mr=\"" . $_POST['mr'] . "\", ";
  $fields .= "pr=\"" . $_POST['pr'] . "\", ";
  $fields .= "svcorruption=\"" . $_POST['svcorruption'] . "\", ";
  $fields .= "stunresist=\"" . $_POST['stunresist'] . "\", ";
  $fields .= "heroic_agi=\"" . $_POST['heroic_agi'] . "\", ";
  $fields .= "heroic_cha=\"" . $_POST['heroic_cha'] . "\", ";
  $fields .= "heroic_dex=\"" . $_POST['heroic_dex'] . "\", ";
  $fields .= "heroic_int=\"" . $_POST['heroic_int'] . "\", ";
  $fields .= "heroic_sta=\"" . $_POST['heroic_sta'] . "\", ";
  $fields .= "heroic_str=\"" . $_POST['heroic_str'] . "\", ";
  $fields .= "heroic_wis=\"" . $_POST['heroic_wis'] . "\", ";
  $fields .= "heroic_cr=\"" . $_POST['heroic_cr'] . "\", ";
  $fields .= "heroic_dr=\"" . $_POST['heroic_dr'] . "\", ";
  $fields .= "heroic_fr=\"" . $_POST['heroic_fr'] . "\", ";
  $fields .= "heroic_mr=\"" . $_POST['heroic_mr'] . "\", ";
  $fields .= "heroic_pr=\"" . $_POST['heroic_pr'] . "\", ";
  $fields .= "heroic_svcorrup=\"" . $_POST['heroic_svcorrup'] . "\", ";
  $fields .= "damageshield=\"" . $_POST['damageshield'] . "\", ";
  $fields .= "dotshielding=\"" . $_POST['dotshielding'] . "\", ";
  $fields .= "shielding=\"" . $_POST['shielding'] . "\", ";
  $fields .= "spellshield=\"" . $_POST['spellshield'] . "\", ";
  $fields .= "strikethrough=\"" . $_POST['strikethrough'] . "\", ";
  $fields .= "spelldmg=\"" . $_POST['spelldmg'] . "\", ";
  $fields .= "backstabdmg=\"" . $_POST['backstabdmg'] . "\", ";
  $fields .= "extradmgskill=\"" . $_POST['extradmgskill'] . "\", ";
  $fields .= "extradmgamt=\"" . $_POST['extradmgamt'] . "\", ";
  $fields .= "elemdmgtype=\"" . $_POST['elemdmgtype'] . "\", ";
  $fields .= "elemdmgamt=\"" . $_POST['elemdmgamt'] . "\", ";
  $fields .= "dsmitigation=\"" . $_POST['dsmitigation'] . "\", ";
  $fields .= "healamt=\"" . $_POST['healamt'] . "\", ";
  $fields .= "clairvoyance=\"" . $_POST['clairvoyance'] . "\", ";
  $fields .= "skillmodtype=\"" . $_POST['skillmodtype'] . "\", ";
  $fields .= "skillmodvalue=\"" . $_POST['skillmodvalue'] . "\", ";
  $fields .= "skillmodmax=\"" . $_POST['skillmodmax'] . "\", ";
  $fields .= "bardvalue=\"" . $_POST['bardvalue'] . "\", ";
  $fields .= "price=\"" . $_POST['price'] . "\", ";
  $fields .= "sellrate=\"" . $_POST['sellrate'] . "\", ";
  $fields .= "favor=\"" . $_POST['favor'] . "\", ";
  $fields .= "guildfavor=\"" . $_POST['guildfavor'] . "\", ";
  $fields .= "ldonprice=\"" . $_POST['ldonprice'] . "\", ";
  $fields .= "ldonsellbackrate=\"" . $_POST['ldonsellbackrate'] . "\", ";
  $fields .= "ldonsold=\"" . $_POST['ldonsold'] . "\", ";
  $fields .= "ldontheme=\"" . $_POST['ldontheme'] . "\", ";
  $fields .= "pointtype=\"" . $_POST['pointtype'] . "\", ";
  $fields .= "icon=\"" . $_POST['icon'] . "\", ";
  $fields .= "idfile=\"" . $_POST['idfile'] . "\", ";
  $fields .= "weight=\"" . $_POST['weight'] . "\", ";
  $fields .= "color=\"" . $_POST['color'] . "\", ";
  $fields .= "size=\"" . $_POST['size'] . "\", ";
  $fields .= "material=\"" . $_POST['material'] . "\", ";
  $fields .= "elitematerial=\"" . $_POST['elitematerial'] . "\", ";
  $fields .= "casttime=\"" . $_POST['casttime'] . "\", ";
  $fields .= "casttime_=\"" . $_POST['casttime_'] . "\", ";
  $fields .= "recastdelay=\"" . $_POST['recastdelay'] . "\", ";
  $fields .= "recasttype=\"" . $_POST['recasttype'] . "\", ";
  $fields .= "clicktype=\"" . $_POST['clicktype'] . "\", ";
  $fields .= "clickeffect=\"" . $_POST['clickeffect'] . "\", ";
  $fields .= "clicklevel=\"" . $_POST['clicklevel'] . "\", ";
  $fields .= "clicklevel2=\"" . $_POST['clicklevel2'] . "\", ";
  $fields .= "clickname=\"" . $_POST['clickname'] . "\", ";
  $fields .= "proctype=\"" . $_POST['proctype'] . "\", ";
  $fields .= "proceffect=\"" . $_POST['proceffect'] . "\", ";
  $fields .= "proclevel=\"" . $_POST['proclevel'] . "\", ";
  $fields .= "proclevel2=\"" . $_POST['proclevel2'] . "\", ";
  $fields .= "procrate=\"" . $_POST['procrate'] . "\", ";
  $fields .= "procname=\"" . $_POST['procname'] . "\", ";
  $fields .= "worntype=\"" . $_POST['worntype'] . "\", ";
  $fields .= "worneffect=\"" . $_POST['worneffect'] . "\", ";
  $fields .= "wornlevel=\"" . $_POST['wornlevel'] . "\", ";
  $fields .= "wornlevel2=\"" . $_POST['wornlevel2'] . "\", ";
  $fields .= "wornname=\"" . $_POST['wornname'] . "\", ";
  $fields .= "focustype=\"" . $_POST['focustype'] . "\", ";
  $fields .= "focuseffect=\"" . $_POST['focuseffect'] . "\", ";
  $fields .= "focuslevel=\"" . $_POST['focuslevel'] . "\", ";
  $fields .= "focuslevel2=\"" . $_POST['focuslevel2'] . "\", ";
  $fields .= "focusname=\"" . $_POST['focusname'] . "\", ";
  $fields .= "scrolltype=\"" . $_POST['scrolltype'] . "\", ";
  $fields .= "scrolleffect=\"" . $_POST['scrolleffect'] . "\", ";
  $fields .= "scrolllevel=\"" . $_POST['scrolllevel'] . "\", ";
  $fields .= "scrolllevel2=\"" . $_POST['scrolllevel2'] . "\", ";
  $fields .= "scrollname=\"" . $_POST['scrollname'] . "\", ";
  $fields .= "bardtype=\"" . $_POST['bardtype'] . "\", ";
  $fields .= "bardeffect=\"" . $_POST['bardeffect'] . "\", ";
  $fields .= "bardlevel=\"" . $_POST['bardlevel'] . "\", ";
  $fields .= "bardlevel2=\"" . $_POST['bardlevel2'] . "\", ";
  $fields .= "bardname=\"" . $_POST['bardname'] . "\", ";
  $fields .= "augslot1visible=\"" . $_POST['augslot1visible'] . "\", ";
  $fields .= "augslot2visible=\"" . $_POST['augslot2visible'] . "\", ";
  $fields .= "augslot3visible=\"" . $_POST['augslot3visible'] . "\", ";
  $fields .= "augslot4visible=\"" . $_POST['augslot4visible'] . "\", ";
  $fields .= "augslot5visible=\"" . $_POST['augslot5visible'] . "\", ";
  $fields .= "augslot1type=\"" . $_POST['augslot1type'] . "\", ";
  $fields .= "augslot2type=\"" . $_POST['augslot2type'] . "\", ";
  $fields .= "augslot3type=\"" . $_POST['augslot3type'] . "\", ";
  $fields .= "augslot4type=\"" . $_POST['augslot4type'] . "\", ";
  $fields .= "augslot5type=\"" . $_POST['augslot5type'] . "\", ";
  $fields .= "augrestrict=\"" . $_POST['augrestrict'] . "\", ";
  $fields .= "augdistiller=\"" . $_POST['augdistiller'] . "\", ";
  $fields .= "factionmod1=\"" . $_POST['factionmod1'] . "\", ";
  $fields .= "factionmod2=\"" . $_POST['factionmod2'] . "\", ";
  $fields .= "factionmod3=\"" . $_POST['factionmod3'] . "\", ";
  $fields .= "factionmod4=\"" . $_POST['factionmod4'] . "\", ";
  $fields .= "factionamt1=\"" . $_POST['factionamt1'] . "\", ";
  $fields .= "factionamt2=\"" . $_POST['factionamt2'] . "\", ";
  $fields .= "factionamt3=\"" . $_POST['factionamt3'] . "\", ";
  $fields .= "factionamt4=\"" . $_POST['factionamt4'] . "\", ";
  $fields .= "created=\"" . $_POST['created'] . "\", ";
  $fields .= "verified=\"" . $_POST['verified'] . "\", ";
  $fields .= "updated=\"" . $_POST['updated'] . "\", ";
  $fields .= "source=\"" . $_POST['source'] . "\", ";
  $fields .= "comment=\"" . $_POST['comment'] . "\"";

  $query = "INSERT INTO items SET $fields";
  $mysql->query_no_result($query);
}

?>
