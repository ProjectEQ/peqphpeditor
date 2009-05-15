<? 

$factions = faction_list();
$faction_values = array(-1=>"Aggressive", 0=>"Passive", 1=>"Assist");

switch ($action) {
  case 0:  // View Loottable
    if ($npcid) {
      $body = new Template("templates/npc/npc.tmpl.php");
      $body->set('currzone', $z);
      $body->set('npcid', $npcid);
      $body->set('classes', $classes);
      $body->set('genders', $genders);
      $body->set('bodytypes', $bodytypes);
      $body->set('races', $races);
      $body->set('yesno', $yesno);
      $body->set('suggestedid', suggest_npcid());
      $body->set('npc_name', getNPCName($npcid));
      $body->set('factions', $factions);
      $body->set('faction_values', $faction_values);
      $body->set('pet', get_ispet());
      $vars = npc_info();
      if ($vars) {
        foreach ($vars as $key=>$value) {
          $body->set($key, $value);
        }
      }
    }
    else if ($z) {
        $body = new Template("templates/npc/npc.zdefault.tmpl.php");
        $body->set('currzone', $z);
      }
    else {
        $body = new Template("templates/npc/npc.default.tmpl.php");
    }
    break;
  case 1: // Edit NPC
    check_authorization();
    $body = new Template("templates/npc/npc.edit.tmpl.php");
    $body->set('currzone', $z);
    $body->set('npcid', $npcid);
    $body->set('npc_name', getNPCName($npcid));
    $body->set('genders', $genders);
    $body->set('factions', $factions);
    $body->set('yesno', $yesno);
    $body->set('bodytypes', $bodytypes);
    $body->set('races', $races);
    $body->set('classes', $classes);
    $body->set('specialattacks', $specialattacks);
    $body->set('faction_values', $faction_values);
    $body->set('pet', get_ispet());
    $vars = npc_info();
    if ($vars) {
      foreach ($vars as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
  case 2:
    check_authorization();
    update_npc();
    if (isset($_POST['pet']) && $_POST['pet'] == 1){
    update_pet();
    }
    else delete_pet();
    header("Location: index.php?editor=npc&z=$z&npcid=$npcid");
    exit;
  case 3: // Change npc_faction_id
    check_authorization();
    $body = new Template("templates/npc/factionid.change.tmpl.php");
    $body->set('currzone', $z);
    $body->set('npcid', $npcid);
    $body->set('npc_faction_id', get_npc_faction_id());
    break;
  case 4: // Change npc_faction_id by ID
    check_authorization();
    $body = new Template("templates/npc/factionid.changebyid.tmpl.php");
    $body->set('currzone', $z);
    $body->set('npcid', $npcid);
    $body->set('npc_faction_id', get_npc_faction_id());
    break;
  case 5:  // Update npc_faction_id
    check_authorization();
    update_npc_faction_id($_REQUEST['npc_faction_id']);
    header("Location: index.php?editor=npc&z=$z&npcid=$npcid");
    exit;
  case 6: // Search npc_faction_ids
    check_authorization();
    $body = new Template("templates/npc/factionid.search.tmpl.php");
    $body->set('currzone', $z);
    $body->set('npcid', $npcid);
    $body->set('npc_faction_id', get_npc_faction_id());
    break;
  case 7: // Search results for npc_faction_ids
    check_authorization();
    $body = new Template("templates/npc/factionid.searchresults.tmpl.php");
    $body->set('currzone', $z);
    $body->set('npcid', $npcid);
    $body->set('results', search_npc_faction_ids($_POST['search']));
    $body->set('npc_faction_id', get_npc_faction_id());
    break;
  case 8: // Create new npc_faction_id
    check_authorization();
    $body = new Template("templates/npc/factionid.add.tmpl.php");
    $body->set('currzone', $z);
    $body->set('npcid', $npcid);
    $body->set('id', suggest_npc_faction_id());
    $body->set('npc_name', getNPCName($npcid));
    break;
  case 9:  // Create npc_faction_id
    check_authorization();
    create_npc_faction_id();
    update_npc_faction_id($_POST['id']);
    header("Location: index.php?editor=npc&z=$z&npcid=$npcid");
    exit;
  case 10: // Create new npc_faction_id
    check_authorization();
    $body = new Template("templates/npc/factionid.edit.name.tmpl.php");
    $body->set('currzone', $z);
    $body->set('npcid', $npcid);
    $vars = get_npc_faction_id_name();
    if ($vars) {
      foreach ($vars as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
  case 11:  // Update npc_faction_id name
    check_authorization();
    update_npc_faction_id_name();
    header("Location: index.php?editor=npc&z=$z&npcid=$npcid");
    exit;
  case 12: // Search for primary faction
    check_authorization();
    $body = new Template("templates/npc/primaryfaction.search.tmpl.php");
    $body->set('currzone', $z);
    $body->set('npcid', $npcid);
    break;
  case 13: // Primary faction search results
    check_authorization();
    $body = new Template("templates/npc/primaryfaction.searchresults.tmpl.php");
    $body->set('currzone', $z);
    $body->set('npcid', $npcid);
    $body->set('results', search_factions($_POST['search']));
    break;
  case 14:  // Update primary faction
    check_authorization();
    update_primary_faction();
    header("Location: index.php?editor=npc&z=$z&npcid=$npcid");
    exit;
  case 15: // Add faction hit search
    check_authorization();
    $body = new Template("templates/npc/factionhit.search.tmpl.php");
    $body->set('currzone', $z);
    $body->set('npcid', $npcid);
    break;
  case 16: // Faction hit search results
    check_authorization();
    $body = new Template("templates/npc/factionhit.searchresults.tmpl.php");
    $body->set('currzone', $z);
    $body->set('npcid', $npcid);
    $body->set('results', search_factions($_POST['search']));
    break;
  case 17: // Add faction hit
    check_authorization();
    $body = new Template("templates/npc/factionhit.add.tmpl.php");
    $body->set('currzone', $z);
    $body->set('npcid', $npcid);
    $body->set('fid', $_GET['fid']);
    $body->set('name', get_faction_name($_GET['fid']));
    break;
  case 18:  // Insert faction hit
    check_authorization();
    add_faction_hit();
    header("Location: index.php?editor=npc&z=$z&npcid=$npcid");
    exit;
  case 19: // Edit faction hit
    check_authorization();
    $body = new Template("templates/npc/factionhit.edit.tmpl.php");
    $body->set('currzone', $z);
    $body->set('npcid', $npcid);
    $vars = get_factionhit_info();
    if ($vars) {
      foreach ($vars as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
  case 20:  // Update faction hit
    check_authorization();
    update_factionhit();
    header("Location: index.php?editor=npc&z=$z&npcid=$npcid");
    exit;
  case 21:  // Delete faction hit
    check_authorization();
    delete_factionhit();
    header("Location: index.php?editor=npc&z=$z&npcid=$npcid");
    exit;
  case 22: // Edit merchant id
    check_authorization();
    $body = new Template("templates/npc/merchantid.edit.tmpl.php");
    $body->set('currzone', $z);
    $body->set('npcid', $npcid);
    $body->set('merchant_id', get_merchant_id());
    $body->set('suggested_id', suggest_merchant_id());
    break;
  case 23:  // Update merchant id
    check_authorization();
    update_merchant_id();
    header("Location: index.php?editor=npc&z=$z&npcid=$npcid");
    exit;
  case 24:  // Delete npc
    check_authorization();
    delete_npc();
    header("Location: index.php?editor=npc&z=$z");
    exit;
  case 25: // Add npc
    check_authorization();
    $body = new Template("templates/npc/npc.add.tmpl.php");
    $body->set('currzone', $z);
    $body->set('suggestedid', suggest_npcid());
    $body->set('genders', $genders);
    $body->set('factions', $factions);
    $body->set('yesno', $yesno);
    $body->set('bodytypes', $bodytypes);
    $body->set('races', $races);
    $body->set('classes', $classes);
    $body->set('specialattacks', $specialattacks);
    break;
  case 26:  // Insert npc
    check_authorization();
    add_npc();
    if (isset($_POST['pet']) && $_POST['pet'] == 1){
    add_pet();
    }
    $npcid = $_POST['id'];
    header("Location: index.php?editor=npc&z=$z&npcid=$npcid");
    exit;
  case 27:  // Search npcs
    //check_authorization();
    $body = new Template("templates/npc/npc.searchresults.tmpl.php");
    if (isset($_GET['npcid']) && $_GET['npcid'] != "ID") {
      $results = search_npc_by_id();
    }
   else $results = search_npcs();
    $body->set("results", $results);
    break;
  case 28:  // Copy npc
    check_authorization();
    copy_npc();
    $npcid = $_POST['id'];
    header("Location: index.php?editor=npc&z=$z&npcid=$npcid");
    exit;
}

function npc_info () {
  global $mysql, $npcid;
  
  $query = "SELECT * FROM npc_types WHERE id=$npcid";
  $result = $mysql->query_assoc($query);
  $factionid = $result['npc_faction_id'];

  $result['factionname'] = '';
  $result['primaryfaction'] = '';
  $result['primaryfactionname'] = '';
  $result['faction_hits'] = '';
  
  
  if ($factionid != 0) {
    $query = "SELECT * FROM npc_faction WHERE id=$factionid";
    $result2 = $mysql->query_assoc($query);

    $result['factionname'] = $result2['name'];
    $result['primaryfaction'] = $result2['primaryfaction'];
    $result['primaryfactionname'] = get_faction_name($result2['primaryfaction']);

    $query = "SELECT * FROM npc_faction_entries WHERE npc_faction_id=$factionid";
    $result3 = $mysql->query_mult_assoc($query);

    $result['faction_hits'] = $result3;
  }

  return $result;
}

function get_ispet () {
  global $mysql, $npcid;

  $query = "SELECT count(*) FROM pets WHERE npcID=$npcid";
  $result = $mysql->query_assoc($query);

  return $result['count(*)'];
}

function update_pet () {
  global $mysql, $npcid;

  $name = $_POST['name'];

  $query = "REPLACE INTO pets SET npcID=$npcid, type=\"$name\"";
  $mysql->query_no_result($query);
}

function add_pet () {
  global $mysql;

  $name = $_POST['name'];
  $npcid = $_POST['id'];

  $query = "INSERT INTO pets SET npcID=$npcid, type=\"$name\"";
  $mysql->query_no_result($query);
}

function delete_pet () {
  global $mysql, $npcid;

  $query = "DELETE FROM pets WHERE npcID=$npcid";
  $mysql->query_no_result($query);
}

function update_npc () {
  check_authorization();
  global $mysql, $npcid, $specialattacks;

  $oldstats = npc_info();
  extract($oldstats);

  // Define checkbox fields:
  if (!isset($_POST['qglobal'])) $_POST['qglobal'] = 0;
  if (!isset($_POST['npc_aggro'])) $_POST['npc_aggro'] = 0;
  if (!isset($_POST['findable'])) $_POST['findable'] = 0;
  if (!isset($_POST['trackable'])) $_POST['trackable'] = 0;

  $new_specialattks = '';
  foreach ($specialattacks as $k => $v) {
    if (isset($_POST["$k"])) $new_specialattks .= $_POST["$k"];
  }

  $flag = 0;
  if ($npcspecialattks != $new_specialattks) {
    if (($npcspecialattks == '') || ($new_specialattks == '') || (strlen($new_specialattks) != strlen($npcspecialattks))) {
      $flag = 1;
    }
    else {
      for ($x=0; $x<strlen($new_specialattks); $x++) {
        $poo = strpos($npcspecialattks, $new_specialattks[$x]);
        if ($poo === false) {
          $flag = 1;
        }
      }
    }
  }

  $fields = '';
  if ($id != $_POST['id']) $fields .= "id=\"" . $_POST['id']. "\", ";
  if ($name != $_POST['name']) $fields .= "name=\"" . $_POST['name'] . "\", ";
  if ($lastname != $_POST['lastname']) $fields .= "lastname=\"" . $_POST['lastname'] . "\", ";
  if ($level != $_POST['level']) $fields .= "level=\"" . $_POST['level'] . "\", ";
  if ($race != $_POST['race']) $fields .= "race=\"" . $_POST['race'] . "\", ";
  if ($class != $_POST['class']) $fields .= "class=\"" . $_POST['class'] . "\", ";
  if ($bodytype != $_POST['bodytype']) $fields .= "bodytype=\"" . $_POST['bodytype'] . "\", ";
  if ($hp != $_POST['hp']) $fields .= "hp=\"" . $_POST['hp'] . "\", ";
  if ($gender != $_POST['gender']) $fields .= "gender=\"" . $_POST['gender'] . "\", ";
  if ($texture != $_POST['texture']) $fields .= "texture=\"" . $_POST['texture'] . "\", ";
  if ($helmtexture != $_POST['helmtexture']) $fields .= "helmtexture=\"" . $_POST['helmtexture'] . "\", ";
  if ($size != $_POST['size']) $fields .= "size=\"" . $_POST['size'] . "\", ";
  if ($hp_regen_rate != $_POST['hp_regen_rate']) $fields .= "hp_regen_rate=\"" . $_POST['hp_regen_rate'] . "\", ";
  if ($mana_regen_rate != $_POST['mana_regen_rate']) $fields .= "mana_regen_rate=\"" . $_POST['mana_regen_rate'] . "\", ";
  if ($loottable_id != $_POST['loottable_id']) $fields .= "loottable_id=\"" . $_POST['loottable_id'] . "\", ";
//  if ($merchant_id != $_POST['merchant_id']) $fields .= "merchant_id=\"" . $_POST['merchant_id'] . "\", ";
  if ($npc_spells_id != $_POST['npc_spells_id']) $fields .= "npc_spells_id=\"" . $_POST['npc_spells_id'] . "\", ";
//  if ($npc_faction_id != $_POST['npc_faction_id']) $fields .= "npc_faction_id=\"" . $_POST['npc_faction_id'] . "\", ";
  if ($mindmg != $_POST['mindmg']) $fields .= "mindmg=\"" . $_POST['mindmg'] . "\", ";
  if ($maxdmg != $_POST['maxdmg']) $fields .= "maxdmg=\"" . $_POST['maxdmg'] . "\", ";
  if ($flag == 1) $fields .= "npcspecialattks=\"$new_specialattks\", ";
  if ($aggroradius != $_POST['aggroradius']) $fields .= "aggroradius=\"" . $_POST['aggroradius'] . "\", ";
  if ($face != $_POST['face']) $fields .= "face=\"" . $_POST['face'] . "\", ";
  if ($luclin_hairstyle != $_POST['luclin_hairstyle']) $fields .= "luclin_hairstyle=\"" . $_POST['luclin_hairstyle'] . "\", ";
  if ($luclin_haircolor != $_POST['luclin_haircolor']) $fields .= "luclin_haircolor=\"" . $_POST['luclin_haircolor'] . "\", ";
  if ($luclin_eyecolor != $_POST['luclin_eyecolor']) $fields .= "luclin_eyecolor=\"" . $_POST['luclin_eyecolor'] . "\", ";
  if ($luclin_eyecolor2 != $_POST['luclin_eyecolor2']) $fields .= "luclin_eyecolor2=\"" . $_POST['luclin_eyecolor2'] . "\", ";
  if ($luclin_beardcolor != $_POST['luclin_beardcolor']) $fields .= "luclin_beardcolor=\"" . $_POST['luclin_beardcolor'] . "\", ";
  if ($luclin_beard != $_POST['luclin_beard']) $fields .= "luclin_beard=\"" . $_POST['luclin_beard'] . "\", ";
  if ($d_meele_texture1 != $_POST['d_meele_texture1']) $fields .= "d_meele_texture1=\"" . $_POST['d_meele_texture1'] . "\", ";
  if ($d_meele_texture2 != $_POST['d_meele_texture2']) $fields .= "d_meele_texture2=\"" . $_POST['d_meele_texture2'] . "\", ";
  if ($runspeed != $_POST['runspeed']) $fields .= "runspeed=\"" . $_POST['runspeed'] . "\", ";
  if ($MR != $_POST['MR']) $fields .= "MR=\"" . $_POST['MR'] . "\", ";
  if ($CR != $_POST['CR']) $fields .= "CR=\"" . $_POST['CR'] . "\", ";
  if ($DR != $_POST['DR']) $fields .= "DR=\"" . $_POST['DR'] . "\", ";
  if ($FR != $_POST['FR']) $fields .= "FR=\"" . $_POST['FR'] . "\", ";
  if ($PR != $_POST['PR']) $fields .= "PR=\"" . $_POST['PR'] . "\", ";
  if ($see_invis != $_POST['see_invis']) $fields .= "see_invis=\"" . $_POST['see_invis'] . "\", ";
  if ($see_invis_undead != $_POST['see_invis_undead']) $fields .= "see_invis_undead=\"" . $_POST['see_invis_undead'] . "\", ";
  if ($see_hide != $_POST['see_hide']) $fields .= "see_hide=\"" . $_POST['see_hide'] . "\", ";
  if ($see_improved_hide != $_POST['see_improved_hide']) $fields .= "see_improved_hide=\"" . $_POST['see_improved_hide'] . "\", ";
  if ($qglobal != $_POST['qglobal']) $fields .= "qglobal=\"" . $_POST['qglobal'] . "\", ";
  if ($AC != $_POST['AC']) $fields .= "AC=\"" . $_POST['AC'] . "\", ";
  if ($npc_aggro != $_POST['npc_aggro']) $fields .= "npc_aggro=\"" . $_POST['npc_aggro'] . "\", ";
  if ($spawn_limit != $_POST['spawn_limit']) $fields .= "spawn_limit=\"" . $_POST['spawn_limit'] . "\", ";
  if ($attack_speed != $_POST['attack_speed']) $fields .= "attack_speed=\"" . $_POST['attack_speed'] . "\", ";
  if ($findable != $_POST['findable']) $fields .= "findable=\"" . $_POST['findable'] . "\", ";
  if ($trackable != $_POST['trackable']) $fields .= "trackable=\"" . $_POST['trackable'] . "\", ";
  if ($ATK != $_POST['ATK']) $fields .= "ATK=\"" . $_POST['ATK'] . "\", ";
  if ($Accuracy != $_POST['Accuracy']) $fields .= "Accuracy=\"" . $_POST['Accuracy'] . "\", ";
  if ($STR != $_POST['STR']) $fields .= "STR=\"" . $_POST['STR'] . "\", ";
  if ($STA != $_POST['STA']) $fields .= "STA=\"" . $_POST['STA'] . "\", ";
  if ($DEX != $_POST['DEX']) $fields .= "DEX=\"" . $_POST['DEX'] . "\", ";
  if ($AGI != $_POST['AGI']) $fields .= "AGI=\"" . $_POST['AGI'] . "\", ";
  if ($_INT != $_POST['_INT']) $fields .= "_INT=\"" . $_POST['_INT'] . "\", ";
  if ($WIS != $_POST['WIS']) $fields .= "WIS=\"" . $_POST['WIS'] . "\", ";
  if ($CHA != $_POST['CHA']) $fields .= "CHA=\"" . $_POST['CHA'] . "\", ";
  if ($version != $_POST['version']) $fields .= "version=\"" . $_POST['version'] . "\", ";
  $fields =  rtrim($fields, ", ");

  if ($fields != '') {
    $query = "UPDATE npc_types SET $fields WHERE id=$npcid";
    $mysql->query_no_result($query);
  }
}

function add_npc () {
  check_authorization();
  global $mysql, $specialattacks;

  // Define checkbox fields:
  if (!isset($_POST['qglobal'])) $_POST['qglobal'] = 0;
  if (!isset($_POST['npc_aggro'])) $_POST['npc_aggro'] = 0;
  if (!isset($_POST['findable'])) $_POST['findable'] = 0;
  if (!isset($_POST['trackable'])) $_POST['trackable'] = 0;

  foreach ($specialattacks as $k => $v) {
    if (isset($_POST["$k"])) $npcspecialattks .= $_POST["$k"];
  }

  $fields = '';
  if ($_POST['id'] != '') $fields .= "id=\"" . $_POST['id']. "\", ";
  if ($_POST['name'] != '') $fields .= "name=\"" . $_POST['name'] . "\", ";
  if ($_POST['lastname'] != '') $fields .= "lastname=\"" . $_POST['lastname'] . "\", ";
  if ($_POST['level'] != '') $fields .= "level=\"" . $_POST['level'] . "\", ";
  if ($_POST['race'] != '') $fields .= "race=\"" . $_POST['race'] . "\", ";
  if ($_POST['class'] != '') $fields .= "class=\"" . $_POST['class'] . "\", ";
  if ($_POST['bodytype'] != '') $fields .= "bodytype=\"" . $_POST['bodytype'] . "\", ";
  if ($_POST['hp'] != '') $fields .= "hp=\"" . $_POST['hp'] . "\", ";
  if ($_POST['gender'] != '') $fields .= "gender=\"" . $_POST['gender'] . "\", ";
  if ($_POST['texture'] != '') $fields .= "texture=\"" . $_POST['texture'] . "\", ";
  if ($_POST['helmtexture'] != '') $fields .= "helmtexture=\"" . $_POST['helmtexture'] . "\", ";
  if ($_POST['size'] != '') $fields .= "size=\"" . $_POST['size'] . "\", ";
  if ($_POST['hp_regen_rate'] != '') $fields .= "hp_regen_rate=\"" . $_POST['hp_regen_rate'] . "\", ";
  if ($_POST['mana_regen_rate'] != '') $fields .= "mana_regen_rate=\"" . $_POST['mana_regen_rate'] . "\", ";
  if ($_POST['npc_spells_id'] != '') $fields .= "npc_spells_id=\"" . $_POST['npc_spells_id'] . "\", ";
  if ($_POST['loottable_id'] != '') $fields .= "loottable_id=\"" . $_POST['loottable_id'] . "\", ";
//  if ($npc_faction_id != $_POST['npc_faction_id']) $fields .= "npc_faction_id=\"" . $_POST['npc_faction_id'] . "\", ";
  if ($_POST['mindmg'] != '') $fields .= "mindmg=\"" . $_POST['mindmg'] . "\", ";
  if ($_POST['maxdmg'] != '') $fields .= "maxdmg=\"" . $_POST['maxdmg'] . "\", ";
  if ($npcspecialattks != '') $fields .= "npcspecialattks=\"$npcspecialattks\", ";
  if ($_POST['aggroradius'] != '') $fields .= "aggroradius=\"" . $_POST['aggroradius'] . "\", ";
  if ($_POST['face'] != '') $fields .= "face=\"" . $_POST['face'] . "\", ";
  if ($_POST['luclin_hairstyle'] != '') $fields .= "luclin_hairstyle=\"" . $_POST['luclin_hairstyle'] . "\", ";
  if ($_POST['luclin_haircolor'] != '') $fields .= "luclin_haircolor=\"" . $_POST['luclin_haircolor'] . "\", ";
  if ($_POST['luclin_eyecolor'] != '') $fields .= "luclin_eyecolor=\"" . $_POST['luclin_eyecolor'] . "\", ";
  if ($_POST['luclin_eyecolor2'] != '') $fields .= "luclin_eyecolor2=\"" . $_POST['luclin_eyecolor2'] . "\", ";
  if ($_POST['luclin_beardcolor'] != '') $fields .= "luclin_beardcolor=\"" . $_POST['luclin_beardcolor'] . "\", ";
  if ($_POST['luclin_beard'] != '') $fields .= "luclin_beard=\"" . $_POST['luclin_beard'] . "\", ";
  if ($_POST['d_meele_texture1'] != '') $fields .= "d_meele_texture1=\"" . $_POST['d_meele_texture1'] . "\", ";
  if ($_POST['d_meele_texture2'] != '') $fields .= "d_meele_texture2=\"" . $_POST['d_meele_texture2'] . "\", ";
  if ($_POST['runspeed'] != '') $fields .= "runspeed=\"" . $_POST['runspeed'] . "\", ";
  if ($_POST['MR'] != '') $fields .= "MR=\"" . $_POST['MR'] . "\", ";
  if ($_POST['CR'] != '') $fields .= "CR=\"" . $_POST['CR'] . "\", ";
  if ($_POST['DR'] != '') $fields .= "DR=\"" . $_POST['DR'] . "\", ";
  if ($_POST['FR'] != '') $fields .= "FR=\"" . $_POST['FR'] . "\", ";
  if ($_POST['PR'] != '') $fields .= "PR=\"" . $_POST['PR'] . "\", ";
  if ($_POST['see_invis'] != '') $fields .= "see_invis=\"" . $_POST['see_invis'] . "\", ";
  if ($_POST['see_invis_undead'] != '') $fields .= "see_invis_undead=\"" . $_POST['see_invis_undead'] . "\", ";
  if ($_POST['see_hide'] != '') $fields .= "see_hide=\"" . $_POST['see_hide'] . "\", ";
  if ($_POST['see_improved_hide'] != '') $fields .= "see_improved_hide=\"" . $_POST['see_improved_hide'] . "\", ";
  if ($_POST['qglobal'] != '') $fields .= "qglobal=\"" . $_POST['qglobal'] . "\", ";
  if ($_POST['AC'] != '') $fields .= "AC=\"" . $_POST['AC'] . "\", ";
  if ($_POST['npc_aggro'] != '') $fields .= "npc_aggro=\"" . $_POST['npc_aggro'] . "\", ";
  if ($_POST['spawn_limit'] != '') $fields .= "spawn_limit=\"" . $_POST['spawn_limit'] . "\", ";
  if ($_POST['attack_speed'] != '') $fields .= "attack_speed=\"" . $_POST['attack_speed'] . "\", ";
  if ($_POST['findable'] != '') $fields .= "findable=\"" . $_POST['findable'] . "\", ";
  if ($_POST['trackable'] != '') $fields .= "trackable=\"" . $_POST['trackable'] . "\", ";
  if ($_POST['ATK'] != '') $fields .= "ATK=\"" . $_POST['ATK'] . "\", ";
  if ($_POST['Accuracy'] != '') $fields .= "Accuracy=\"" . $_POST['Accuracy'] . "\", ";
  if ($_POST['STR'] != '') $fields .= "STR=\"" . $_POST['STR'] . "\", ";
  if ($_POST['STA'] != '') $fields .= "STA=\"" . $_POST['STA'] . "\", ";
  if ($_POST['DEX'] != '') $fields .= "DEX=\"" . $_POST['DEX'] . "\", ";
  if ($_POST['AGI'] != '') $fields .= "AGI=\"" . $_POST['AGI'] . "\", ";
  if ($_POST['_INT'] != '') $fields .= "_INT=\"" . $_POST['_INT'] . "\", ";
  if ($_POST['WIS'] != '') $fields .= "WIS=\"" . $_POST['WIS'] . "\", ";
  if ($_POST['CHA'] != '') $fields .= "CHA=\"" . $_POST['CHA'] . "\", ";
  if ($_POST['version'] != '') $fields .= "version=\"" . $_POST['version'] . "\", ";
  $fields =  rtrim($fields, ", ");

  if ($fields != '') {
    $query = "INSERT INTO npc_types SET $fields";
    $mysql->query_no_result($query);
  }
}

function copy_npc () {
  check_authorization();
  global $mysql;

$fields = '';
$fields .= "id=\"" . $_POST['id']. "\", ";
$fields .= "name=\"" . $_POST['name'] . "\", ";
$fields .= "lastname=\"" . $_POST['lastname'] . "\", ";
$fields .= "level=\"" . $_POST['level'] . "\", ";
$fields .= "race=\"" . $_POST['race'] . "\", ";
$fields .= "class=\"" . $_POST['class'] . "\", ";
$fields .= "bodytype=\"" . $_POST['bodytype'] . "\", ";
$fields .= "hp=\"" . $_POST['hp'] . "\", ";
$fields .= "gender=\"" . $_POST['gender'] . "\", ";
$fields .= "texture=\"" . $_POST['texture'] . "\", ";
$fields .= "helmtexture=\"" . $_POST['helmtexture'] . "\", ";
$fields .= "size=\"" . $_POST['size'] . "\", ";
$fields .= "hp_regen_rate=\"" . $_POST['hp_regen_rate'] . "\", ";
$fields .= "mana_regen_rate=\"" . $_POST['mana_regen_rate'] . "\", ";
$fields .= "loottable_id=\"" . $_POST['loottable_id'] . "\", ";
$fields .= "merchant_id=\"" . $_POST['merchant_id'] . "\", ";
$fields .= "npc_spells_id=\"" . $_POST['npc_spells_id'] . "\", ";
$fields .= "npc_faction_id=\"" . $_POST['npc_faction_id'] . "\", ";
$fields .= "mindmg=\"" . $_POST['mindmg'] . "\", ";
$fields .= "maxdmg=\"" . $_POST['maxdmg'] . "\", ";
$fields .= "npcspecialattks=\"" . $_POST['npcspecialattks'] . "\", ";
$fields .= "aggroradius=\"" . $_POST['aggroradius'] . "\", ";
$fields .= "face=\"" . $_POST['face'] . "\", ";
$fields .= "luclin_hairstyle=\"" . $_POST['luclin_hairstyle'] . "\", ";
$fields .= "luclin_haircolor=\"" . $_POST['luclin_haircolor'] . "\", ";
$fields .= "luclin_eyecolor=\"" . $_POST['luclin_eyecolor'] . "\", ";
$fields .= "luclin_eyecolor2=\"" . $_POST['luclin_eyecolor2'] . "\", ";
$fields .= "luclin_beardcolor=\"" . $_POST['luclin_beardcolor'] . "\", ";
$fields .= "luclin_beard=\"" . $_POST['luclin_beard'] . "\", ";
$fields .= "d_meele_texture1=\"" . $_POST['d_meele_texture1'] . "\", ";
$fields .= "d_meele_texture2=\"" . $_POST['d_meele_texture2'] . "\", ";
$fields .= "runspeed=\"" . $_POST['runspeed'] . "\", ";
$fields .= "MR=\"" . $_POST['MR'] . "\", ";
$fields .= "CR=\"" . $_POST['CR'] . "\", ";
$fields .= "DR=\"" . $_POST['DR'] . "\", ";
$fields .= "FR=\"" . $_POST['FR'] . "\", ";
$fields .= "PR=\"" . $_POST['PR'] . "\", ";
$fields .= "see_invis=\"" . $_POST['see_invis'] . "\", ";
$fields .= "see_invis_undead=\"" . $_POST['see_invis_undead'] . "\", ";
$fields .= "see_hide=\"" . $_POST['see_hide'] . "\", ";
$fields .= "see_improved_hide=\"" . $_POST['see_improved_hide'] . "\", ";
$fields .= "qglobal=\"" . $_POST['qglobal'] . "\", ";
$fields .= "AC=\"" . $_POST['AC'] . "\", ";
$fields .= "npc_aggro=\"" . $_POST['npc_aggro'] . "\", ";
$fields .= "spawn_limit=\"" . $_POST['spawn_limit'] . "\", ";
$fields .= "attack_speed=\"" . $_POST['attack_speed'] . "\", ";
$fields .= "findable=\"" . $_POST['findable'] . "\", ";
$fields .= "trackable=\"" . $_POST['trackable'] . "\", ";
$fields .= "ATK=\"" . $_POST['ATK'] . "\", ";
$fields .= "Accuracy=\"" . $_POST['Accuracy'] . "\", ";
$fields .= "STR=\"" . $_POST['STR'] . "\", ";
$fields .= "STA=\"" . $_POST['STA'] . "\", ";
$fields .= "DEX=\"" . $_POST['DEX'] . "\", ";
$fields .= "AGI=\"" . $_POST['AGI'] . "\", ";
$fields .= "_INT=\"" . $_POST['_INT'] . "\", ";
$fields .= "WIS=\"" . $_POST['WIS'] . "\", ";
$fields .= "CHA=\"" . $_POST['CHA'] . "\", ";
$fields .= "version=\"" . $_POST['version'] . "\", ";
  $fields =  rtrim($fields, ", ");

  if ($fields != '') {
    $query = "INSERT INTO npc_types SET $fields";
    $mysql->query_no_result($query);
  }
}

function get_faction_name ($id) {
  global $mysql;
  
  $query = "SELECT name FROM faction_list WHERE id=$id";
  $result = $mysql->query_assoc($query);
  
  return $result['name'];
}

function faction_list() {
  global $mysql;
  
  $query = "SELECT id, name FROM faction_list";
  $results = $mysql->query_mult_assoc($query);
  
  foreach ($results as $result) {
    $array[$result['id']] = $result['name'];
  }

  return $array;
}

function get_npc_faction_id () {
  global $mysql, $npcid;

  $query = "SELECT npc_faction_id FROM npc_types WHERE id=$npcid";
  $result = $mysql->query_assoc($query);

  return $result['npc_faction_id'];
}

function update_npc_faction_id ($fid) {
  check_authorization();
  global $mysql, $npcid;

  $query = "UPDATE npc_types SET npc_faction_id=$fid WHERE id=$npcid";
  $mysql->query_no_result($query);
}

function create_npc_faction_id () {
  check_authorization();
  global $mysql;
  $id = $_POST['id'];
  $name = $_POST['name'];
  $ipa = $_POST['ipa'];

  $query = "INSERT INTO npc_faction SET id=$id, name=\"$name\", ignore_primary_assist=\"$ipa\"";
  $mysql->query_no_result($query);
}

function search_npc_faction_ids($search) {
  global $mysql;
  $query = "SELECT id, name FROM npc_faction WHERE name rlike \"$search\"";
  $results = $mysql->query_mult_assoc($query);
  return $results;
}

function suggest_npc_faction_id() {
  global $mysql;
  $query = "SELECT MAX(id) as id FROM npc_faction";
  $result = $mysql->query_assoc($query);
  return ($result['id'] + 1);
}

function get_npc_faction_id_name() {
  global $mysql, $npcid;
  $id = get_npc_faction_id($npcid);
  $query = "SELECT * FROM npc_faction WHERE id=$id";
  $result = $mysql->query_assoc($query);
  return $result;
}

function update_npc_faction_id_name () {
  check_authorization();
  global $mysql, $npcid;

  $name = $_POST['name'];
  $ipa = $_POST['ipa'];
  $id = get_npc_faction_id($npcid);
  $query = "UPDATE npc_faction SET name=\"$name\", ignore_primary_assist=\"$ipa\" WHERE id=$id";
  $mysql->query_no_result($query);
}

function search_factions($search) {
  global $mysql;
  $query = "SELECT id, name FROM faction_list WHERE name rlike \"$search\"";
  $results = $mysql->query_mult_assoc($query);
  return $results;
}

function update_primary_faction () {
  check_authorization();
  global $mysql, $npcid;
  $id = get_npc_faction_id($npcid);
  $fid = $_GET['fid'];
  $query = "UPDATE npc_faction SET primaryfaction=$fid WHERE id=$id";
  $mysql->query_no_result($query);
}

function add_faction_hit () {
  check_authorization();
  global $mysql, $npcid;

  $npc_faction_id = get_npc_faction_id($npcid);
  $fid = $_GET['fid'];
  $value = $_POST['value'];
  $npc_value = $_POST['npc_value'];
  $query = "INSERT INTO npc_faction_entries SET npc_faction_id=$npc_faction_id, faction_id=$fid, value=$value, npc_value=$npc_value";
  $mysql->query_no_result($query);
}

function get_factionhit_info () {
  global $mysql, $npcid;

  $npc_faction_id = $_GET['npc_faction_id'];
  $fid = $_GET['faction_id'];
  $query = "SELECT * FROM npc_faction_entries WHERE npc_faction_id=$npc_faction_id AND faction_id=$fid";
  $result = $mysql->query_assoc($query);
  $result['name'] = get_faction_name($fid);
  return $result;
}

function update_factionhit () {
  check_authorization();
  global $mysql;

  $npc_faction_id = $_GET['npc_faction_id'];
  $fid = $_GET['faction_id'];
  $value = $_POST['value'];
  $npc_value = $_POST['npc_value'];
  $query = "UPDATE npc_faction_entries SET value=$value, npc_value=$npc_value WHERE npc_faction_id=$npc_faction_id AND faction_id=$fid";
  $mysql->query_no_result($query);
}

function delete_factionhit () {
  check_authorization();
  global $mysql;

  $npc_faction_id = $_GET['npc_faction_id'];
  $fid = $_GET['faction_id'];

  $query = "DELETE FROM npc_faction_entries WHERE npc_faction_id=$npc_faction_id AND faction_id=$fid";
  $mysql->query_no_result($query);
}

function suggest_merchant_id() {
  global $mysql;
  $query = "SELECT MAX(merchant_id) as id FROM npc_types";
  $result = $mysql->query_assoc($query);
  return ($result['id'] + 1);
}

function update_merchant_id() {
  check_authorization();
  global $mysql, $npcid;
  $merchant_id = $_REQUEST['merchant_id'];
  $query = "UPDATE npc_types SET merchant_id=$merchant_id WHERE id=$npcid";
  $mysql->query_no_result($query);
}

function delete_npc() {
  check_authorization();
  global $mysql, $npcid;

  $query = "DELETE FROM npc_types WHERE id=$npcid";
  $mysql->query_no_result($query);
}

function suggest_npcid() {
  global $mysql, $z;

  $query = "SELECT zoneidnumber FROM zone WHERE short_name=\"$z\"";
  $result = $mysql->query_assoc($query);
  $zid = $result['zoneidnumber'] . "___";

  $query = "SELECT MAX(id) as id FROM npc_types WHERE id like \"$zid\"";
  $result = $mysql->query_assoc($query);
  
  return (($result['id'] == 0) ? "" : $result['id'] + 1);
}

?>