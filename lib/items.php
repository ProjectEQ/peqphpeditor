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
  1   => "Guk",
  2   => "Mir",
  4   => "MMC",
  8   => "Ruj",
  16  => "Tak",
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
    $vars = item_info();
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

  $query = "SELECT name AS itemname FROM items WHERE id=$id";
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
  
  $fields = '';
  $fields .= "slots=\"$slots\", ";
  $fields .= "races=\"$races\", ";
  $fields .= "classes=\"$classes\", ";
  $fields .= "deity=\"$deity\", ";
  $fields .= "augtype=\"$augtype\", ";
  if ($name != $_POST['itemname']) $fields .= "name=\"" . $_POST['itemname'] . "\", ";
  if ($itemtype != $_POST['itemtype']) $fields .= "itemtype=\"" . $_POST['itemtype'] . "\", ";
  if ($lore != $_POST['lore']) $fields .= "lore=\"" . $_POST['lore'] . "\", ";
  if ($itemclass != $_POST['itemclass']) $fields .= "itemclass=\"" . $_POST['itemclass'] . "\", ";
  if ($stackable != $_POST['stackable']) $fields .= "stackable=\"" . $_POST['stackable'] . "\", ";
  if ($stacksize != $_POST['stacksize']) $fields .= "stacksize=\"" . $_POST['stacksize'] . "\", ";
  if ($maxcharges != $_POST['maxcharges']) $fields .= "maxcharges=\"" . $_POST['maxcharges'] . "\", ";
  if ($filename != $_POST['filename']) $fields .= "filename=\"" . $_POST['filename'] . "\", ";
  if ($book != $_POST['book']) $fields .= "book=\"" . $_POST['book'] . "\", ";
  if ($booktype != $_POST['booktype']) $fields .= "booktype=\"" . $_POST['booktype'] . "\", ";
  if ($powersourcecapacity != $_POST['powersourcecapacity']) $fields .= "powersourcecapacity=\"" . $_POST['powersourcecapacity'] . "\", ";
  if ($charmfile != $_POST['charmfile']) $fields .= "charmfile=\"" . $_POST['charmfile'] . "\", ";
  if ($charmfileid != $_POST['charmfileid']) $fields .= "charmfileid=\"" . $_POST['charmfileid'] . "\", ";
  if ($scriptfileid != $_POST['scriptfileid']) $fields .= "scriptfileid=\"" . $_POST['scriptfileid'] . "\", ";
  if ($potionbeltslots != $_POST['potionbeltslots']) $fields .= "potionbeltslots=\"" . $_POST['potionbeltslots'] . "\", ";
  if ($bagsize != $_POST['bagsize']) $fields .= "bagsize=\"" . $_POST['bagsize'] . "\", ";
  if ($bagslots != $_POST['bagslots']) $fields .= "bagslots=\"" . $_POST['bagslots'] . "\", ";
  if ($bagwr != $_POST['bagwr']) $fields .= "bagwr=\"" . $_POST['bagwr'] . "\", ";
  if ($bagtype != $_POST['bagtype']) $fields .= "bagtype=\"" . $_POST['bagtype'] . "\", ";
  if ($nodrop != $_POST['nodrop']) $fields .= "nodrop=\"" . $_POST['nodrop'] . "\", ";
  if ($norent != $_POST['norent']) $fields .= "norent=\"" . $_POST['norent'] . "\", ";
  if ($magic != $_POST['magic']) $fields .= "magic=\"" . $_POST['magic'] . "\", ";
  if ($tradeskills != $_POST['tradeskills']) $fields .= "tradeskills=\"" . $_POST['tradeskills'] . "\", ";
  if ($artifactflag != $_POST['artifactflag']) $fields .= "artifactflag=\"" . $_POST['artifactflag'] . "\", ";
  if ($questitemflag != $_POST['questitemflag']) $fields .= "questitemflag=\"" . $_POST['questitemflag'] . "\", ";
  if ($attuneable != $_POST['attuneable']) $fields .= "attuneable=\"" . $_POST['attuneable'] . "\", ";
  if ($nopet != $_POST['nopet']) $fields .= "nopet=\"" . $_POST['nopet'] . "\", ";
  if ($fvnodrop != $_POST['fvnodrop']) $fields .= "fvnodrop=\"" . $_POST['fvnodrop'] . "\", ";
  if ($notransfer != $_POST['notransfer']) $fields .= "notransfer=\"" . $_POST['notransfer'] . "\", ";
  if ($potionbelt != $_POST['potionbelt']) $fields .= "potionbelt=\"" . $_POST['potionbelt'] . "\", ";
  if ($benefitflag != $_POST['benefitflag']) $fields .= "benefitflag=\"" . $_POST['benefitflag'] . "\", ";
  if ($expendablearrow != $_POST['expendablearrow']) $fields .= "expendablearrow=\"" . $_POST['expendablearrow'] . "\", ";
  if ($loregroup != $_POST['loregroup']) $fields .= "loregroup=\"" . $_POST['loregroup'] . "\", ";
  if ($reqlevel != $_POST['reqlevel']) $fields .= "reqlevel=\"" . $_POST['reqlevel'] . "\", ";
  if ($reclevel != $_POST['reclevel']) $fields .= "reclevel=\"" . $_POST['reclevel'] . "\", ";
  if ($recskill != $_POST['recskill']) $fields .= "recskill=\"" . $_POST['recskill'] . "\", ";
  if ($evolvinglevel != $_POST['evolvinglevel']) $fields .= "evolvinglevel=\"" . $_POST['evolvinglevel'] . "\", ";
  if ($damage != $_POST['damage']) $fields .= "damage=\"" . $_POST['damage'] . "\", ";
  if ($delay != $_POST['delay']) $fields .= "delay=\"" . $_POST['delay'] . "\", ";
  if ($range != $_POST['range']) $fields .= "`range`=\"" . $_POST['range'] . "\", ";
  if ($banedmgamt != $_POST['banedmgamt']) $fields .= "banedmgamt=\"" . $_POST['banedmgamt'] . "\", ";
  if ($banedmgraceamt != $_POST['banedmgraceamt']) $fields .= "banedmgraceamt=\"" . $_POST['banedmgraceamt'] . "\", ";
  if ($banedmgrace != $_POST['banedmgrace']) $fields .= "banedmgrace=\"" . $_POST['banedmgrace'] . "\", ";
  if ($banedmgbody != $_POST['banedmgbody']) $fields .= "banedmgbody=\"" . $_POST['banedmgbody'] . "\", ";
  if ($hp != $_POST['hp']) $fields .= "hp=\"" . $_POST['hp'] . "\", ";
  if ($mana != $_POST['mana']) $fields .= "mana=\"" . $_POST['mana'] . "\", ";
  if ($endur != $_POST['endur']) $fields .= "endur=\"" . $_POST['endur'] . "\", ";
  if ($ac != $_POST['ac']) $fields .= "ac=\"" . $_POST['ac'] . "\", ";
  if ($accuracy != $_POST['accuracy']) $fields .= "accuracy=\"" . $_POST['accuracy'] . "\", ";
  if ($attack != $_POST['attack']) $fields .= "attack=\"" . $_POST['attack'] . "\", ";
  if ($light != $_POST['light']) $fields .= "light=\"" . $_POST['light'] . "\", ";
  if ($regen != $_POST['regen']) $fields .= "regen=\"" . $_POST['regen'] . "\", ";
  if ($manaregen != $_POST['manaregen']) $fields .= "manaregen=\"" . $_POST['manaregen'] . "\", ";
  if ($enduranceregen != $_POST['enduranceregen']) $fields .= "enduranceregen=\"" . $_POST['enduranceregen'] . "\", ";
  if ($haste != $_POST['haste']) $fields .= "haste=\"" . $_POST['haste'] . "\", ";
  if ($avoidance != $_POST['avoidance']) $fields .= "avoidance=\"" . $_POST['avoidance'] . "\", ";
  if ($purity != $_POST['purity']) $fields .= "purity=\"" . $_POST['purity'] . "\", ";
  if ($combateffects != $_POST['combateffects']) $fields .= "combateffects=\"" . $_POST['combateffects'] . "\", ";
  if ($aagi != $_POST['aagi']) $fields .= "aagi=\"" . $_POST['aagi'] . "\", ";
  if ($acha != $_POST['acha']) $fields .= "acha=\"" . $_POST['acha'] . "\", ";
  if ($adex != $_POST['adex']) $fields .= "adex=\"" . $_POST['adex'] . "\", ";
  if ($aint != $_POST['aint']) $fields .= "aint=\"" . $_POST['aint'] . "\", ";
  if ($asta != $_POST['asta']) $fields .= "asta=\"" . $_POST['asta'] . "\", ";
  if ($astr != $_POST['astr']) $fields .= "astr=\"" . $_POST['astr'] . "\", ";
  if ($awis != $_POST['awis']) $fields .= "awis=\"" . $_POST['awis'] . "\", ";
  if ($cr != $_POST['cr']) $fields .= "cr=\"" . $_POST['cr'] . "\", ";
  if ($dr != $_POST['dr']) $fields .= "dr=\"" . $_POST['dr'] . "\", ";
  if ($fr != $_POST['fr']) $fields .= "fr=\"" . $_POST['fr'] . "\", ";
  if ($mr != $_POST['mr']) $fields .= "mr=\"" . $_POST['mr'] . "\", ";
  if ($pr != $_POST['pr']) $fields .= "pr=\"" . $_POST['pr'] . "\", ";
  if ($svcorruption != $_POST['svcorruption']) $fields .= "svcorruption=\"" . $_POST['svcorruption'] . "\", ";
  if ($stunresist != $_POST['stunresist']) $fields .= "stunresist=\"" . $_POST['stunresist'] . "\", ";
  if ($heroic_agi != $_POST['heroic_agi']) $fields .= "heroic_agi=\"" . $_POST['heroic_agi'] . "\", ";
  if ($heroic_cha != $_POST['heroic_cha']) $fields .= "heroic_cha=\"" . $_POST['heroic_cha'] . "\", ";
  if ($heroic_dex != $_POST['heroic_dex']) $fields .= "heroic_dex=\"" . $_POST['heroic_dex'] . "\", ";
  if ($heroic_int != $_POST['heroic_int']) $fields .= "heroic_int=\"" . $_POST['heroic_int'] . "\", ";
  if ($heroic_sta != $_POST['heroic_sta']) $fields .= "heroic_sta=\"" . $_POST['heroic_sta'] . "\", ";
  if ($heroic_str != $_POST['heroic_str']) $fields .= "heroic_str=\"" . $_POST['heroic_str'] . "\", ";
  if ($heroic_wis != $_POST['heroic_wis']) $fields .= "heroic_wis=\"" . $_POST['heroic_wis'] . "\", ";
  if ($heroic_cr != $_POST['heroic_cr']) $fields .= "heroic_cr=\"" . $_POST['heroic_cr'] . "\", ";
  if ($heroic_dr != $_POST['heroic_dr']) $fields .= "heroic_dr=\"" . $_POST['heroic_dr'] . "\", ";
  if ($heroic_fr != $_POST['heroic_fr']) $fields .= "heroic_fr=\"" . $_POST['heroic_fr'] . "\", ";
  if ($heroic_mr != $_POST['heroic_mr']) $fields .= "heroic_mr=\"" . $_POST['heroic_mr'] . "\", ";
  if ($heroic_pr != $_POST['heroic_pr']) $fields .= "heroic_pr=\"" . $_POST['heroic_pr'] . "\", ";
  if ($heroic_svcorrup != $_POST['heroic_svcorrup']) $fields .= "heroic_svcorrup=\"" . $_POST['heroic_svcorrup'] . "\", ";
  if ($damageshield != $_POST['damageshield']) $fields .= "damageshield=\"" . $_POST['damageshield'] . "\", ";
  if ($dotshielding != $_POST['dotshielding']) $fields .= "dotshielding=\"" . $_POST['dotshielding'] . "\", ";
  if ($shielding != $_POST['shielding']) $fields .= "shielding=\"" . $_POST['shielding'] . "\", ";
  if ($spellshield != $_POST['spellshield']) $fields .= "spellshield=\"" . $_POST['spellshield'] . "\", ";
  if ($strikethrough != $_POST['strikethrough']) $fields .= "strikethrough=\"" . $_POST['strikethrough'] . "\", ";
  if ($spelldmg != $_POST['spelldmg']) $fields .= "spelldmg=\"" . $_POST['spelldmg'] . "\", ";
  if ($backstabdmg != $_POST['backstabdmg']) $fields .= "backstabdmg=\"" . $_POST['backstabdmg'] . "\", ";
  if ($extradmgskill != $_POST['extradmgskill']) $fields .= "extradmgskill=\"" . $_POST['extradmgskill'] . "\", ";
  if ($extradmgamt != $_POST['extradmgamt']) $fields .= "extradmgamt=\"" . $_POST['extradmgamt'] . "\", ";
  if ($elemdmgtype != $_POST['elemdmgtype']) $fields .= "elemdmgtype=\"" . $_POST['elemdmgtype'] . "\", ";
  if ($elemdmgamt != $_POST['elemdmgamt']) $fields .= "elemdmgamt=\"" . $_POST['elemdmgamt'] . "\", ";
  if ($dsmitigation != $_POST['dsmitigation']) $fields .= "dsmitigation=\"" . $_POST['dsmitigation'] . "\", ";
  if ($healamt != $_POST['healamt']) $fields .= "healamt=\"" . $_POST['healamt'] . "\", ";
  if ($clairvoyance != $_POST['clairvoyance']) $fields .= "clairvoyance=\"" . $_POST['clairvoyance'] . "\", ";
  if ($skillmodtype != $_POST['skillmodtype']) $fields .= "skillmodtype=\"" . $_POST['skillmodtype'] . "\", ";
  if ($skillmodvalue != $_POST['skillmodvalue']) $fields .= "skillmodvalue=\"" . $_POST['skillmodvalue'] . "\", ";
  if ($bardvalue != $_POST['bardvalue']) $fields .= "bardvalue=\"" . $_POST['bardvalue'] . "\", ";
  if ($price != $_POST['price']) $fields .= "price=\"" . $_POST['price'] . "\", ";
  if ($sellrate != $_POST['sellrate']) $fields .= "sellrate=\"" . $_POST['sellrate'] . "\", ";
  if ($favor != $_POST['favor']) $fields .= "favor=\"" . $_POST['favor'] . "\", ";
  if ($guildfavor != $_POST['guildfavor']) $fields .= "guildfavor=\"" . $_POST['guildfavor'] . "\", ";
  if ($ldonprice != $_POST['ldonprice']) $fields .= "ldonprice=\"" . $_POST['ldonprice'] . "\", ";
  if ($ldonsellbackrate != $_POST['ldonsellbackrate']) $fields .= "ldonsellbackrate=\"" . $_POST['ldonsellbackrate'] . "\", ";
  if ($ldonsold != $_POST['ldonsold']) $fields .= "ldonsold=\"" . $_POST['ldonsold'] . "\", ";
  if ($ldontheme != $_POST['ldontheme']) $fields .= "ldontheme=\"" . $_POST['ldontheme'] . "\", ";
  if ($pointtype != $_POST['pointtype']) $fields .= "pointtype=\"" . $_POST['pointtype'] . "\", ";
  if ($icon != $_POST['icon']) $fields .= "icon=\"" . $_POST['icon'] . "\", ";
  if ($idfile != $_POST['idfile']) $fields .= "idfile=\"" . $_POST['idfile'] . "\", ";
  if ($weight != $_POST['weight']) $fields .= "weight=\"" . $_POST['weight'] . "\", ";
  if ($color != $_POST['color']) $fields .= "color=\"" . $_POST['color'] . "\", ";
  if ($size != $_POST['size']) $fields .= "size=\"" . $_POST['size'] . "\", ";
  if ($material != $_POST['material']) $fields .= "material=\"" . $_POST['material'] . "\", ";
  if ($elitematerial != $_POST['elitematerial']) $fields .= "elitematerial=\"" . $_POST['elitematerial'] . "\", ";
  if ($casttime != $_POST['casttime']) $fields .= "casttime=\"" . $_POST['casttime'] . "\", ";
  if ($casttime_ != $_POST['casttime_']) $fields .= "casttime_=\"" . $_POST['casttime_'] . "\", ";
  if ($recastdelay != $_POST['recastdelay']) $fields .= "recastdelay=\"" . $_POST['recastdelay'] . "\", ";
  if ($recasttype != $_POST['recasttype']) $fields .= "recasttype=\"" . $_POST['recasttype'] . "\", ";
  if ($clicktype != $_POST['clicktype']) $fields .= "clicktype=\"" . $_POST['clicktype'] . "\", ";
  if ($clickeffect != $_POST['clickeffect']) $fields .= "clickeffect=\"" . $_POST['clickeffect'] . "\", ";
  if ($clicklevel != $_POST['clicklevel']) $fields .= "clicklevel=\"" . $_POST['clicklevel'] . "\", ";
  if ($clicklevel2 != $_POST['clicklevel2']) $fields .= "clicklevel2=\"" . $_POST['clicklevel2'] . "\", ";
  if ($clickname != $_POST['clickname']) $fields .= "clickname=\"" . $_POST['clickname'] . "\", ";
  if ($proctype != $_POST['proctype']) $fields .= "proctype=\"" . $_POST['proctype'] . "\", ";
  if ($proceffect != $_POST['proceffect']) $fields .= "proceffect=\"" . $_POST['proceffect'] . "\", ";
  if ($proclevel != $_POST['proclevel']) $fields .= "proclevel=\"" . $_POST['proclevel'] . "\", ";
  if ($proclevel2 != $_POST['proclevel2']) $fields .= "proclevel2=\"" . $_POST['proclevel2'] . "\", ";
  if ($procname != $_POST['procname']) $fields .= "procname=\"" . $_POST['procname'] . "\", ";
  if ($worntype != $_POST['worntype']) $fields .= "worntype=\"" . $_POST['worntype'] . "\", ";
  if ($worneffect != $_POST['worneffect']) $fields .= "worneffect=\"" . $_POST['worneffect'] . "\", ";
  if ($wornlevel != $_POST['wornlevel']) $fields .= "wornlevel=\"" . $_POST['wornlevel'] . "\", ";
  if ($wornlevel2 != $_POST['wornlevel2']) $fields .= "wornlevel2=\"" . $_POST['wornlevel2'] . "\", ";
  if ($wornname != $_POST['wornname']) $fields .= "wornname=\"" . $_POST['wornname'] . "\", ";
  if ($focustype != $_POST['focustype']) $fields .= "focustype=\"" . $_POST['focustype'] . "\", ";
  if ($focuseffect != $_POST['focuseffect']) $fields .= "focuseffect=\"" . $_POST['focuseffect'] . "\", ";
  if ($focuslevel != $_POST['focuslevel']) $fields .= "focuslevel=\"" . $_POST['focuslevel'] . "\", ";
  if ($focuslevel2 != $_POST['focuslevel2']) $fields .= "focuslevel2=\"" . $_POST['focuslevel2'] . "\", ";
  if ($focusname != $_POST['focusname']) $fields .= "focusname=\"" . $_POST['focusname'] . "\", ";
  if ($scrolltype != $_POST['scrolltype']) $fields .= "scrolltype=\"" . $_POST['scrolltype'] . "\", ";
  if ($scrolleffect != $_POST['scrolleffect']) $fields .= "scrolleffect=\"" . $_POST['scrolleffect'] . "\", ";
  if ($scrolllevel != $_POST['scrolllevel']) $fields .= "scrolllevel=\"" . $_POST['scrolllevel'] . "\", ";
  if ($scrolllevel2 != $_POST['scrolllevel2']) $fields .= "scrolllevel2=\"" . $_POST['scrolllevel2'] . "\", ";
  if ($scrollname != $_POST['scrollname']) $fields .= "scrollname=\"" . $_POST['scrollname'] . "\", ";
  if ($bardtype != $_POST['bardtype']) $fields .= "bardtype=\"" . $_POST['bardtype'] . "\", ";
  if ($bardeffect != $_POST['bardeffect']) $fields .= "bardeffect=\"" . $_POST['bardeffect'] . "\", ";
  if ($bardlevel != $_POST['bardlevel']) $fields .= "bardlevel=\"" . $_POST['bardlevel'] . "\", ";
  if ($bardlevel2 != $_POST['bardlevel2']) $fields .= "bardlevel2=\"" . $_POST['bardlevel2'] . "\", ";
  if ($bardname != $_POST['bardname']) $fields .= "bardname=\"" . $_POST['bardname'] . "\", ";
  if ($augslot1visible != $_POST['augslot1visible']) $fields .= "augslot1visible=\"" . $_POST['augslot1visible'] . "\", ";
  if ($augslot2visible != $_POST['augslot2visible']) $fields .= "augslot2visible=\"" . $_POST['augslot2visible'] . "\", ";
  if ($augslot3visible != $_POST['augslot3visible']) $fields .= "augslot3visible=\"" . $_POST['augslot3visible'] . "\", ";
  if ($augslot4visible != $_POST['augslot4visible']) $fields .= "augslot4visible=\"" . $_POST['augslot4visible'] . "\", ";
  if ($augslot5visible != $_POST['augslot5visible']) $fields .= "augslot5visible=\"" . $_POST['augslot5visible'] . "\", ";
  if ($augslot1type != $_POST['augslot1type']) $fields .= "augslot1type=\"" . $_POST['augslot1type'] . "\", ";
  if ($augslot2type != $_POST['augslot2type']) $fields .= "augslot2type=\"" . $_POST['augslot2type'] . "\", ";
  if ($augslot3type != $_POST['augslot3type']) $fields .= "augslot3type=\"" . $_POST['augslot3type'] . "\", ";
  if ($augslot4type != $_POST['augslot4type']) $fields .= "augslot4type=\"" . $_POST['augslot4type'] . "\", ";
  if ($augslot5type != $_POST['augslot5type']) $fields .= "augslot5type=\"" . $_POST['augslot5type'] . "\", ";
  if ($augrestrict != $_POST['augrestrict']) $fields .= "augrestrict=\"" . $_POST['augrestrict'] . "\", ";
  if ($augdistiller != $_POST['augdistiller']) $fields .= "augdistiller=\"" . $_POST['augdistiller'] . "\", ";
  if ($factionmod1 != $_POST['factionmod1']) $fields .= "factionmod1=\"" . $_POST['factionmod1'] . "\", ";
  if ($factionmod2 != $_POST['factionmod2']) $fields .= "factionmod2=\"" . $_POST['factionmod2'] . "\", ";
  if ($factionmod3 != $_POST['factionmod3']) $fields .= "factionmod3=\"" . $_POST['factionmod3'] . "\", ";
  if ($factionmod4 != $_POST['factionmod4']) $fields .= "factionmod4=\"" . $_POST['factionmod4'] . "\", ";
  if ($factionamt1 != $_POST['factionamt1']) $fields .= "factionamt1=\"" . $_POST['factionamt1'] . "\", ";
  if ($factionamt2 != $_POST['factionamt2']) $fields .= "factionamt2=\"" . $_POST['factionamt2'] . "\", ";
  if ($factionamt3 != $_POST['factionamt3']) $fields .= "factionamt3=\"" . $_POST['factionamt3'] . "\", ";
  if ($factionamt4 != $_POST['factionamt4']) $fields .= "factionamt4=\"" . $_POST['factionamt4'] . "\", ";
  if ($created != $_POST['created']) $fields .= "created=\"" . $_POST['created'] . "\", ";
  if ($verified != $_POST['verified']) $fields .= "verified=\"" . $_POST['verified'] . "\", ";
  if ($updated != $_POST['updated']) $fields .= "updated=\"" . $_POST['updated'] . "\", ";
  if ($source != $_POST['source']) $fields .= "source=\"" . $_POST['source'] . "\", ";
  if ($comment != $_POST['comment']) $fields .= "comment=\"" . $_POST['comment'] . "\", ";
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
 
   $query2 = "INSERT INTO items (minstatus, Name, aagi, ac, accuracy, acha, adex, aint, artifactflag, asta, astr, attack, augrestrict, augslot1type, augslot1visible, augslot2type, augslot2visible, augslot3type, augslot3visible, augslot4type, augslot4visible, augslot5type, augslot5visible, augtype, avoidance, awis, bagsize, bagslots, bagtype, bagwr, banedmgamt, banedmgraceamt, banedmgbody, banedmgrace, bardtype, bardvalue, book, casttime, casttime_, charmfile, charmfileid, classes, color, combateffects, extradmgskill, extradmgamt, price, cr, damage, damageshield, deity, delay, augdistiller, dotshielding, dr, clicktype, clicklevel2, elemdmgtype, elemdmgamt, endur, factionamt1, factionamt2, factionamt3, factionamt4, factionmod1, factionmod2, factionmod3, factionmod4, filename, focuseffect, fr, fvnodrop, haste, clicklevel, hp, regen, icon, idfile, itemclass, itemtype, ldonprice, ldontheme, ldonsold, light, lore, loregroup, magic, mana, manaregen, enduranceregen, material, maxcharges, mr, nodrop, norent, pendingloreflag, pr, procrate, races, `range`, reclevel, recskill, reqlevel, sellrate, shielding, size, skillmodtype, skillmodvalue, slots, clickeffect, spellshield, strikethrough, stunresist, summonedflag, tradeskills, favor, weight, UNK012, UNK013, benefitflag, UNK054, UNK059, booktype, recastdelay, recasttype, guildfavor, UNK123, UNK124, attuneable, nopet, updated, comment, UNK127, pointtype, potionbelt, potionbeltslots, stacksize, notransfer, stackable, UNK134, UNK137, proceffect, proctype, proclevel2, proclevel, UNK142, worneffect, worntype, wornlevel2, wornlevel, UNK147, focustype, focuslevel2, focuslevel, UNK152, scrolleffect, scrolltype, scrolllevel2, scrolllevel, UNK157, serialized, verified, serialization, source, UNK033, lorefile, UNK014, svcorruption, UNK038, UNK060, augslot1unk2, augslot2unk2, augslot3unk2, augslot4unk2, augslot5unk2, UNK120, UNK121, questitemflag, UNK132, clickunk5, clickunk6, clickunk7, procunk1, procunk2, procunk3, procunk4, procunk6, procunk7, wornunk1, wornunk2, wornunk3, wornunk4, wornunk5, wornunk6, wornunk7, focusunk1, focusunk2, focusunk3, focusunk4, focusunk5, focusunk6, focusunk7, scrollunk1, scrollunk2, scrollunk3, scrollunk4, scrollunk5, scrollunk6, scrollunk7, UNK193, purity, evolvinglevel, clickname, procname, wornname, focusname, scrollname, dsmitigation, heroic_str, heroic_int, heroic_wis, heroic_agi, heroic_dex, heroic_sta, heroic_cha, heroic_pr, heroic_dr, heroic_fr, heroic_cr, heroic_mr, heroic_svcorrup, healamt, spelldmg, clairvoyance, backstabdmg, created, elitematerial, ldonsellbackrate, scriptfileid, expendablearrow, powersourcecapacity, bardeffect, bardeffecttype, bardlevel2, bardlevel, bardunk1, bardunk2, bardunk3, bardunk4,bardunk5, bardname, bardunk7, UNK214)
	      SELECT minstatus, Name, aagi, ac, accuracy, acha, adex, aint, artifactflag, asta, astr, attack, augrestrict, augslot1type, augslot1visible, augslot2type, augslot2visible, augslot3type, augslot3visible, augslot4type, augslot4visible, augslot5type, augslot5visible, augtype, avoidance, awis, bagsize, bagslots, bagtype, bagwr, banedmgamt, banedmgraceamt, banedmgbody, banedmgrace, bardtype, bardvalue, book, casttime, casttime_, charmfile, charmfileid, classes, color, combateffects, extradmgskill, extradmgamt, price, cr, damage, damageshield, deity, delay, augdistiller, dotshielding, dr, clicktype, clicklevel2, elemdmgtype, elemdmgamt, endur, factionamt1, factionamt2, factionamt3, factionamt4, factionmod1, factionmod2, factionmod3, factionmod4, filename, focuseffect, fr, fvnodrop, haste, clicklevel, hp, regen, icon, idfile, itemclass, itemtype, ldonprice, ldontheme, ldonsold, light, lore, loregroup, magic, mana, manaregen, enduranceregen, material, maxcharges, mr, nodrop, norent, pendingloreflag, pr, procrate, races, `range`, reclevel, recskill, reqlevel, sellrate, shielding, size, skillmodtype, skillmodvalue, slots, clickeffect, spellshield, strikethrough, stunresist, summonedflag, tradeskills, favor, weight, UNK012, UNK013, benefitflag, UNK054, UNK059, booktype, recastdelay, recasttype, guildfavor, UNK123, UNK124, attuneable, nopet, updated, comment, UNK127, pointtype, potionbelt, potionbeltslots, stacksize, notransfer, stackable, UNK134, UNK137, proceffect, proctype, proclevel2, proclevel, UNK142, worneffect, worntype, wornlevel2, wornlevel, UNK147, focustype, focuslevel2, focuslevel, UNK152, scrolleffect, scrolltype, scrolllevel2, scrolllevel, UNK157, serialized, verified, serialization, source, UNK033, lorefile, UNK014, svcorruption, UNK038, UNK060, augslot1unk2, augslot2unk2, augslot3unk2, augslot4unk2, augslot5unk2, UNK120, UNK121, questitemflag, UNK132, clickunk5, clickunk6, clickunk7, procunk1, procunk2, procunk3, procunk4, procunk6, procunk7, wornunk1, wornunk2, wornunk3, wornunk4, wornunk5, wornunk6, wornunk7, focusunk1, focusunk2, focusunk3, focusunk4, focusunk5, focusunk6, focusunk7, scrollunk1, scrollunk2, scrollunk3, scrollunk4, scrollunk5, scrollunk6, scrollunk7, UNK193, purity, evolvinglevel, clickname, procname, wornname, focusname, scrollname, dsmitigation, heroic_str, heroic_int, heroic_wis, heroic_agi, heroic_dex, heroic_sta, heroic_cha, heroic_pr, heroic_dr, heroic_fr, heroic_cr, heroic_mr, heroic_svcorrup, healamt, spelldmg, clairvoyance, backstabdmg, created, elitematerial, ldonsellbackrate, scriptfileid, expendablearrow, powersourcecapacity, bardeffect, bardeffecttype, bardlevel2, bardlevel, bardunk1, bardunk2, bardunk3, bardunk4, bardunk5, bardname, bardunk7, UNK214 FROM items where id=$id";
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
  
  $fields = '';
  $fields .= "slots=\"$slots\", ";
  $fields .= "races=\"$races\", ";
  $fields .= "classes=\"$classes\", ";
  $fields .= "deity=\"$deity\", ";
  $fields .= "augtype=\"$augtype\", ";
  if ($id != $_POST['id']) $fields .= "id=\"" . $_POST['id'] . "\", ";
  if ($name != $_POST['itemname']) $fields .= "name=\"" . $_POST['itemname'] . "\", ";
  if ($itemtype != $_POST['itemtype']) $fields .= "itemtype=\"" . $_POST['itemtype'] . "\", ";
  if ($lore != $_POST['lore']) $fields .= "lore=\"" . $_POST['lore'] . "\", ";
  if ($itemclass != $_POST['itemclass']) $fields .= "itemclass=\"" . $_POST['itemclass'] . "\", ";
  if ($stackable != $_POST['stackable']) $fields .= "stackable=\"" . $_POST['stackable'] . "\", ";
  if ($stacksize != $_POST['stacksize']) $fields .= "stacksize=\"" . $_POST['stacksize'] . "\", ";
  if ($maxcharges != $_POST['maxcharges']) $fields .= "maxcharges=\"" . $_POST['maxcharges'] . "\", ";
  if ($filename != $_POST['filename']) $fields .= "filename=\"" . $_POST['filename'] . "\", ";
  if ($book != $_POST['book']) $fields .= "book=\"" . $_POST['book'] . "\", ";
  if ($booktype != $_POST['booktype']) $fields .= "booktype=\"" . $_POST['booktype'] . "\", ";
  if ($powersourcecapacity != $_POST['powersourcecapacity']) $fields .= "powersourcecapacity=\"" . $_POST['powersourcecapacity'] . "\", ";
  if ($charmfile != $_POST['charmfile']) $fields .= "charmfile=\"" . $_POST['charmfile'] . "\", ";
  if ($charmfileid != $_POST['charmfileid']) $fields .= "charmfileid=\"" . $_POST['charmfileid'] . "\", ";
  if ($scriptfileid != $_POST['scriptfileid']) $fields .= "scriptfileid=\"" . $_POST['scriptfileid'] . "\", ";
  if ($potionbeltslots != $_POST['potionbeltslots']) $fields .= "potionbeltslots=\"" . $_POST['potionbeltslots'] . "\", ";
  if ($bagsize != $_POST['bagsize']) $fields .= "bagsize=\"" . $_POST['bagsize'] . "\", ";
  if ($bagslots != $_POST['bagslots']) $fields .= "bagslots=\"" . $_POST['bagslots'] . "\", ";
  if ($bagwr != $_POST['bagwr']) $fields .= "bagwr=\"" . $_POST['bagwr'] . "\", ";
  if ($bagtype != $_POST['bagtype']) $fields .= "bagtype=\"" . $_POST['bagtype'] . "\", ";
  if ($nodrop != $_POST['nodrop']) $fields .= "nodrop=\"" . $_POST['nodrop'] . "\", ";
  if ($norent != $_POST['norent']) $fields .= "norent=\"" . $_POST['norent'] . "\", ";
  if ($magic != $_POST['magic']) $fields .= "magic=\"" . $_POST['magic'] . "\", ";
  if ($tradeskills != $_POST['tradeskills']) $fields .= "tradeskills=\"" . $_POST['tradeskills'] . "\", ";
  if ($artifactflag != $_POST['artifactflag']) $fields .= "artifactflag=\"" . $_POST['artifactflag'] . "\", ";
  if ($questitemflag != $_POST['questitemflag']) $fields .= "questitemflag=\"" . $_POST['questitemflag'] . "\", ";
  if ($attuneable != $_POST['attuneable']) $fields .= "attuneable=\"" . $_POST['attuneable'] . "\", ";
  if ($nopet != $_POST['nopet']) $fields .= "nopet=\"" . $_POST['nopet'] . "\", ";
  if ($fvnodrop != $_POST['fvnodrop']) $fields .= "fvnodrop=\"" . $_POST['fvnodrop'] . "\", ";
  if ($notransfer != $_POST['notransfer']) $fields .= "notransfer=\"" . $_POST['notransfer'] . "\", ";
  if ($potionbelt != $_POST['potionbelt']) $fields .= "potionbelt=\"" . $_POST['potionbelt'] . "\", ";
  if ($benefitflag != $_POST['benefitflag']) $fields .= "benefitflag=\"" . $_POST['benefitflag'] . "\", ";
  if ($expendablearrow != $_POST['expendablearrow']) $fields .= "expendablearrow=\"" . $_POST['expendablearrow'] . "\", ";
  if ($loregroup != $_POST['loregroup']) $fields .= "loregroup=\"" . $_POST['loregroup'] . "\", ";
  if ($reqlevel != $_POST['reqlevel']) $fields .= "reqlevel=\"" . $_POST['reqlevel'] . "\", ";
  if ($reclevel != $_POST['reclevel']) $fields .= "reclevel=\"" . $_POST['reclevel'] . "\", ";
  if ($recskill != $_POST['recskill']) $fields .= "recskill=\"" . $_POST['recskill'] . "\", ";
  if ($evolvinglevel != $_POST['evolvinglevel']) $fields .= "evolvinglevel=\"" . $_POST['evolvinglevel'] . "\", ";
  if ($damage != $_POST['damage']) $fields .= "damage=\"" . $_POST['damage'] . "\", ";
  if ($delay != $_POST['delay']) $fields .= "delay=\"" . $_POST['delay'] . "\", ";
  if ($range != $_POST['range']) $fields .= "`range`=\"" . $_POST['range'] . "\", ";
  if ($banedmgamt != $_POST['banedmgamt']) $fields .= "banedmgamt=\"" . $_POST['banedmgamt'] . "\", ";
  if ($banedmgraceamt != $_POST['banedmgraceamt']) $fields .= "banedmgraceamt=\"" . $_POST['banedmgraceamt'] . "\", ";
  if ($banedmgrace != $_POST['banedmgrace']) $fields .= "banedmgrace=\"" . $_POST['banedmgrace'] . "\", ";
  if ($banedmgbody != $_POST['banedmgbody']) $fields .= "banedmgbody=\"" . $_POST['banedmgbody'] . "\", ";
  if ($hp != $_POST['hp']) $fields .= "hp=\"" . $_POST['hp'] . "\", ";
  if ($mana != $_POST['mana']) $fields .= "mana=\"" . $_POST['mana'] . "\", ";
  if ($endur != $_POST['endur']) $fields .= "endur=\"" . $_POST['endur'] . "\", ";
  if ($ac != $_POST['ac']) $fields .= "ac=\"" . $_POST['ac'] . "\", ";
  if ($accuracy != $_POST['accuracy']) $fields .= "accuracy=\"" . $_POST['accuracy'] . "\", ";
  if ($attack != $_POST['attack']) $fields .= "attack=\"" . $_POST['attack'] . "\", ";
  if ($light != $_POST['light']) $fields .= "light=\"" . $_POST['light'] . "\", ";
  if ($regen != $_POST['regen']) $fields .= "regen=\"" . $_POST['regen'] . "\", ";
  if ($manaregen != $_POST['manaregen']) $fields .= "manaregen=\"" . $_POST['manaregen'] . "\", ";
  if ($enduranceregen != $_POST['enduranceregen']) $fields .= "enduranceregen=\"" . $_POST['enduranceregen'] . "\", ";
  if ($haste != $_POST['haste']) $fields .= "haste=\"" . $_POST['haste'] . "\", ";
  if ($avoidance != $_POST['avoidance']) $fields .= "avoidance=\"" . $_POST['avoidance'] . "\", ";
  if ($purity != $_POST['purity']) $fields .= "purity=\"" . $_POST['purity'] . "\", ";
  if ($combateffects != $_POST['combateffects']) $fields .= "combateffects=\"" . $_POST['combateffects'] . "\", ";
  if ($aagi != $_POST['aagi']) $fields .= "aagi=\"" . $_POST['aagi'] . "\", ";
  if ($acha != $_POST['acha']) $fields .= "acha=\"" . $_POST['acha'] . "\", ";
  if ($adex != $_POST['adex']) $fields .= "adex=\"" . $_POST['adex'] . "\", ";
  if ($aint != $_POST['aint']) $fields .= "aint=\"" . $_POST['aint'] . "\", ";
  if ($asta != $_POST['asta']) $fields .= "asta=\"" . $_POST['asta'] . "\", ";
  if ($astr != $_POST['astr']) $fields .= "astr=\"" . $_POST['astr'] . "\", ";
  if ($awis != $_POST['awis']) $fields .= "awis=\"" . $_POST['awis'] . "\", ";
  if ($cr != $_POST['cr']) $fields .= "cr=\"" . $_POST['cr'] . "\", ";
  if ($dr != $_POST['dr']) $fields .= "dr=\"" . $_POST['dr'] . "\", ";
  if ($fr != $_POST['fr']) $fields .= "fr=\"" . $_POST['fr'] . "\", ";
  if ($mr != $_POST['mr']) $fields .= "mr=\"" . $_POST['mr'] . "\", ";
  if ($pr != $_POST['pr']) $fields .= "pr=\"" . $_POST['pr'] . "\", ";
  if ($svcorruption != $_POST['svcorruption']) $fields .= "svcorruption=\"" . $_POST['svcorruption'] . "\", ";
  if ($stunresist != $_POST['stunresist']) $fields .= "stunresist=\"" . $_POST['stunresist'] . "\", ";
  if ($heroic_agi != $_POST['heroic_agi']) $fields .= "heroic_agi=\"" . $_POST['heroic_agi'] . "\", ";
  if ($heroic_cha != $_POST['heroic_cha']) $fields .= "heroic_cha=\"" . $_POST['heroic_cha'] . "\", ";
  if ($heroic_dex != $_POST['heroic_dex']) $fields .= "heroic_dex=\"" . $_POST['heroic_dex'] . "\", ";
  if ($heroic_int != $_POST['heroic_int']) $fields .= "heroic_int=\"" . $_POST['heroic_int'] . "\", ";
  if ($heroic_sta != $_POST['heroic_sta']) $fields .= "heroic_sta=\"" . $_POST['heroic_sta'] . "\", ";
  if ($heroic_str != $_POST['heroic_str']) $fields .= "heroic_str=\"" . $_POST['heroic_str'] . "\", ";
  if ($heroic_wis != $_POST['heroic_wis']) $fields .= "heroic_wis=\"" . $_POST['heroic_wis'] . "\", ";
  if ($heroic_cr != $_POST['heroic_cr']) $fields .= "heroic_cr=\"" . $_POST['heroic_cr'] . "\", ";
  if ($heroic_dr != $_POST['heroic_dr']) $fields .= "heroic_dr=\"" . $_POST['heroic_dr'] . "\", ";
  if ($heroic_fr != $_POST['heroic_fr']) $fields .= "heroic_fr=\"" . $_POST['heroic_fr'] . "\", ";
  if ($heroic_mr != $_POST['heroic_mr']) $fields .= "heroic_mr=\"" . $_POST['heroic_mr'] . "\", ";
  if ($heroic_pr != $_POST['heroic_pr']) $fields .= "heroic_pr=\"" . $_POST['heroic_pr'] . "\", ";
  if ($heroic_svcorrup != $_POST['heroic_svcorrup']) $fields .= "heroic_svcorrup=\"" . $_POST['heroic_svcorrup'] . "\", ";
  if ($damageshield != $_POST['damageshield']) $fields .= "damageshield=\"" . $_POST['damageshield'] . "\", ";
  if ($dotshielding != $_POST['dotshielding']) $fields .= "dotshielding=\"" . $_POST['dotshielding'] . "\", ";
  if ($shielding != $_POST['shielding']) $fields .= "shielding=\"" . $_POST['shielding'] . "\", ";
  if ($spellshield != $_POST['spellshield']) $fields .= "spellshield=\"" . $_POST['spellshield'] . "\", ";
  if ($strikethrough != $_POST['strikethrough']) $fields .= "strikethrough=\"" . $_POST['strikethrough'] . "\", ";
  if ($spelldmg != $_POST['spelldmg']) $fields .= "spelldmg=\"" . $_POST['spelldmg'] . "\", ";
  if ($backstabdmg != $_POST['backstabdmg']) $fields .= "backstabdmg=\"" . $_POST['backstabdmg'] . "\", ";
  if ($extradmgskill != $_POST['extradmgskill']) $fields .= "extradmgskill=\"" . $_POST['extradmgskill'] . "\", ";
  if ($extradmgamt != $_POST['extradmgamt']) $fields .= "extradmgamt=\"" . $_POST['extradmgamt'] . "\", ";
  if ($elemdmgtype != $_POST['elemdmgtype']) $fields .= "elemdmgtype=\"" . $_POST['elemdmgtype'] . "\", ";
  if ($elemdmgamt != $_POST['elemdmgamt']) $fields .= "elemdmgamt=\"" . $_POST['elemdmgamt'] . "\", ";
  if ($dsmitigation != $_POST['dsmitigation']) $fields .= "dsmitigation=\"" . $_POST['dsmitigation'] . "\", ";
  if ($healamt != $_POST['healamt']) $fields .= "healamt=\"" . $_POST['healamt'] . "\", ";
  if ($clairvoyance != $_POST['clairvoyance']) $fields .= "clairvoyance=\"" . $_POST['clairvoyance'] . "\", ";
  if ($skillmodtype != $_POST['skillmodtype']) $fields .= "skillmodtype=\"" . $_POST['skillmodtype'] . "\", ";
  if ($skillmodvalue != $_POST['skillmodvalue']) $fields .= "skillmodvalue=\"" . $_POST['skillmodvalue'] . "\", ";
  if ($bardvalue != $_POST['bardvalue']) $fields .= "bardvalue=\"" . $_POST['bardvalue'] . "\", ";
  if ($price != $_POST['price']) $fields .= "price=\"" . $_POST['price'] . "\", ";
  if ($sellrate != $_POST['sellrate']) $fields .= "sellrate=\"" . $_POST['sellrate'] . "\", ";
  if ($favor != $_POST['favor']) $fields .= "favor=\"" . $_POST['favor'] . "\", ";
  if ($guildfavor != $_POST['guildfavor']) $fields .= "guildfavor=\"" . $_POST['guildfavor'] . "\", ";
  if ($ldonprice != $_POST['ldonprice']) $fields .= "ldonprice=\"" . $_POST['ldonprice'] . "\", ";
  if ($ldonsellbackrate != $_POST['ldonsellbackrate']) $fields .= "ldonsellbackrate=\"" . $_POST['ldonsellbackrate'] . "\", ";
  if ($ldonsold != $_POST['ldonsold']) $fields .= "ldonsold=\"" . $_POST['ldonsold'] . "\", ";
  if ($ldontheme != $_POST['ldontheme']) $fields .= "ldontheme=\"" . $_POST['ldontheme'] . "\", ";
  if ($pointtype != $_POST['pointtype']) $fields .= "pointtype=\"" . $_POST['pointtype'] . "\", ";
  if ($icon != $_POST['icon']) $fields .= "icon=\"" . $_POST['icon'] . "\", ";
  if ($idfile != $_POST['idfile']) $fields .= "idfile=\"" . $_POST['idfile'] . "\", ";
  if ($weight != $_POST['weight']) $fields .= "weight=\"" . $_POST['weight'] . "\", ";
  if ($color != $_POST['color']) $fields .= "color=\"" . $_POST['color'] . "\", ";
  if ($size != $_POST['size']) $fields .= "size=\"" . $_POST['size'] . "\", ";
  if ($material != $_POST['material']) $fields .= "material=\"" . $_POST['material'] . "\", ";
  if ($elitematerial != $_POST['elitematerial']) $fields .= "elitematerial=\"" . $_POST['elitematerial'] . "\", ";
  if ($casttime != $_POST['casttime']) $fields .= "casttime=\"" . $_POST['casttime'] . "\", ";
  if ($casttime_ != $_POST['casttime_']) $fields .= "casttime_=\"" . $_POST['casttime_'] . "\", ";
  if ($recastdelay != $_POST['recastdelay']) $fields .= "recastdelay=\"" . $_POST['recastdelay'] . "\", ";
  if ($recasttype != $_POST['recasttype']) $fields .= "recasttype=\"" . $_POST['recasttype'] . "\", ";
  if ($clicktype != $_POST['clicktype']) $fields .= "clicktype=\"" . $_POST['clicktype'] . "\", ";
  if ($clickeffect != $_POST['clickeffect']) $fields .= "clickeffect=\"" . $_POST['clickeffect'] . "\", ";
  if ($clicklevel != $_POST['clicklevel']) $fields .= "clicklevel=\"" . $_POST['clicklevel'] . "\", ";
  if ($clicklevel2 != $_POST['clicklevel2']) $fields .= "clicklevel2=\"" . $_POST['clicklevel2'] . "\", ";
  if ($clickname != $_POST['clickname']) $fields .= "clickname=\"" . $_POST['clickname'] . "\", ";
  if ($proctype != $_POST['proctype']) $fields .= "proctype=\"" . $_POST['proctype'] . "\", ";
  if ($proceffect != $_POST['proceffect']) $fields .= "proceffect=\"" . $_POST['proceffect'] . "\", ";
  if ($proclevel != $_POST['proclevel']) $fields .= "proclevel=\"" . $_POST['proclevel'] . "\", ";
  if ($proclevel2 != $_POST['proclevel2']) $fields .= "proclevel2=\"" . $_POST['proclevel2'] . "\", ";
  if ($procname != $_POST['procname']) $fields .= "procname=\"" . $_POST['procname'] . "\", ";
  if ($worntype != $_POST['worntype']) $fields .= "worntype=\"" . $_POST['worntype'] . "\", ";
  if ($worneffect != $_POST['worneffect']) $fields .= "worneffect=\"" . $_POST['worneffect'] . "\", ";
  if ($wornlevel != $_POST['wornlevel']) $fields .= "wornlevel=\"" . $_POST['wornlevel'] . "\", ";
  if ($wornlevel2 != $_POST['wornlevel2']) $fields .= "wornlevel2=\"" . $_POST['wornlevel2'] . "\", ";
  if ($wornname != $_POST['wornname']) $fields .= "wornname=\"" . $_POST['wornname'] . "\", ";
  if ($focustype != $_POST['focustype']) $fields .= "focustype=\"" . $_POST['focustype'] . "\", ";
  if ($focuseffect != $_POST['focuseffect']) $fields .= "focuseffect=\"" . $_POST['focuseffect'] . "\", ";
  if ($focuslevel != $_POST['focuslevel']) $fields .= "focuslevel=\"" . $_POST['focuslevel'] . "\", ";
  if ($focuslevel2 != $_POST['focuslevel2']) $fields .= "focuslevel2=\"" . $_POST['focuslevel2'] . "\", ";
  if ($focusname != $_POST['focusname']) $fields .= "focusname=\"" . $_POST['focusname'] . "\", ";
  if ($scrolltype != $_POST['scrolltype']) $fields .= "scrolltype=\"" . $_POST['scrolltype'] . "\", ";
  if ($scrolleffect != $_POST['scrolleffect']) $fields .= "scrolleffect=\"" . $_POST['scrolleffect'] . "\", ";
  if ($scrolllevel != $_POST['scrolllevel']) $fields .= "scrolllevel=\"" . $_POST['scrolllevel'] . "\", ";
  if ($scrolllevel2 != $_POST['scrolllevel2']) $fields .= "scrolllevel2=\"" . $_POST['scrolllevel2'] . "\", ";
  if ($scrollname != $_POST['scrollname']) $fields .= "scrollname=\"" . $_POST['scrollname'] . "\", ";
  if ($bardtype != $_POST['bardtype']) $fields .= "bardtype=\"" . $_POST['bardtype'] . "\", ";
  if ($bardeffect != $_POST['bardeffect']) $fields .= "bardeffect=\"" . $_POST['bardeffect'] . "\", ";
  if ($bardlevel != $_POST['bardlevel']) $fields .= "bardlevel=\"" . $_POST['bardlevel'] . "\", ";
  if ($bardlevel2 != $_POST['bardlevel2']) $fields .= "bardlevel2=\"" . $_POST['bardlevel2'] . "\", ";
  if ($bardname != $_POST['bardname']) $fields .= "bardname=\"" . $_POST['bardname'] . "\", ";
  if ($augslot1visible != $_POST['augslot1visible']) $fields .= "augslot1visible=\"" . $_POST['augslot1visible'] . "\", ";
  if ($augslot2visible != $_POST['augslot2visible']) $fields .= "augslot2visible=\"" . $_POST['augslot2visible'] . "\", ";
  if ($augslot3visible != $_POST['augslot3visible']) $fields .= "augslot3visible=\"" . $_POST['augslot3visible'] . "\", ";
  if ($augslot4visible != $_POST['augslot4visible']) $fields .= "augslot4visible=\"" . $_POST['augslot4visible'] . "\", ";
  if ($augslot5visible != $_POST['augslot5visible']) $fields .= "augslot5visible=\"" . $_POST['augslot5visible'] . "\", ";
  if ($augslot1type != $_POST['augslot1type']) $fields .= "augslot1type=\"" . $_POST['augslot1type'] . "\", ";
  if ($augslot2type != $_POST['augslot2type']) $fields .= "augslot2type=\"" . $_POST['augslot2type'] . "\", ";
  if ($augslot3type != $_POST['augslot3type']) $fields .= "augslot3type=\"" . $_POST['augslot3type'] . "\", ";
  if ($augslot4type != $_POST['augslot4type']) $fields .= "augslot4type=\"" . $_POST['augslot4type'] . "\", ";
  if ($augslot5type != $_POST['augslot5type']) $fields .= "augslot5type=\"" . $_POST['augslot5type'] . "\", ";
  if ($augrestrict != $_POST['augrestrict']) $fields .= "augrestrict=\"" . $_POST['augrestrict'] . "\", ";
  if ($augdistiller != $_POST['augdistiller']) $fields .= "augdistiller=\"" . $_POST['augdistiller'] . "\", ";
  if ($factionmod1 != $_POST['factionmod1']) $fields .= "factionmod1=\"" . $_POST['factionmod1'] . "\", ";
  if ($factionmod2 != $_POST['factionmod2']) $fields .= "factionmod2=\"" . $_POST['factionmod2'] . "\", ";
  if ($factionmod3 != $_POST['factionmod3']) $fields .= "factionmod3=\"" . $_POST['factionmod3'] . "\", ";
  if ($factionmod4 != $_POST['factionmod4']) $fields .= "factionmod4=\"" . $_POST['factionmod4'] . "\", ";
  if ($factionamt1 != $_POST['factionamt1']) $fields .= "factionamt1=\"" . $_POST['factionamt1'] . "\", ";
  if ($factionamt2 != $_POST['factionamt2']) $fields .= "factionamt2=\"" . $_POST['factionamt2'] . "\", ";
  if ($factionamt3 != $_POST['factionamt3']) $fields .= "factionamt3=\"" . $_POST['factionamt3'] . "\", ";
  if ($factionamt4 != $_POST['factionamt4']) $fields .= "factionamt4=\"" . $_POST['factionamt4'] . "\", ";
  if ($created != $_POST['created']) $fields .= "created=\"" . $_POST['created'] . "\", ";
  if ($verified != $_POST['verified']) $fields .= "verified=\"" . $_POST['verified'] . "\", ";
  if ($updated != $_POST['updated']) $fields .= "updated=\"" . $_POST['updated'] . "\", ";
  if ($source != $_POST['source']) $fields .= "source=\"" . $_POST['source'] . "\", ";
  if ($comment != $_POST['comment']) $fields .= "comment=\"" . $_POST['comment'] . "\", ";
  $fields =  rtrim($fields, ", ");
  
  if ($fields != '') {
    $query = "INSERT INTO items SET $fields";
    $mysql->query_no_result($query);
  }
}

?>