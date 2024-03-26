<?php
$factions = faction_list();

$faction_values = array(
 -1 => "Aggressive",
  0 => "Passive",
  1 => "Assist"
);

$npctier = array(
  1 => "Normal",
  2 => "Dungeon",
  3 => "Velious High",
  4 => "Luclin High",
  5 => "PoP Tier 1",
  6 => "PoP Tier 2",
  7 => "PoP Tier 3",
  8 => "PoP Elem",
  9 => "PoP Time"
);

$npctype = array(
  1 => "Normal",
  2 => "Named",
  3 => "Boss",
  4 => "Raid Boss"
);

$npcchange = array(
  1 => "Current",
  2 => "Same Name",
  3 => "Same Race",
  4 => "Same Class",
  5 => "Same Level",
  6 => "Custom"
);

$npcclass = array(
  1   => "Tank",
  2   => "Knight",
  3   => "Hybrid",
  4   => "Caster"
);

$npcstatchange = array(
  1   => "AC",
  2   => "Resists",
  3   => "All"
);

$pet_naming = array(
  0 => "`s pet",
  1 => "`s familiar",
  2 => "`s Warder",
  3 => "Random pet name",
  4 => "Keep DB name",
  5 => "`s ward"
);

$pet_control = array(
  0 => "Familiar",
  1 => "Animation",
  2 => "Normal",
  3 => "Charmed",
  4 => "NPC Follow",
  5 => "Hate List"
);

$tmpfaction = array(
  0 => "Permanent",
  1 => "Temp No Msg",
  2 => "Perm No Msg",
  3 => "Temporary"
);

$tmpfacshort = array(
  0 => "Perm",
  1 => "Temp/NoMsg",
  2 => "Perm/NoMsg",
  3 => "Temp"
);

$eventtype = array(
  0 => "LEAVECOMBAT",
  1 => "ENTERCOMBAT",
  2 => "ONDEATH",
  3 => "AFTERDEATH",
  4 => "HAILED",
  5 => "KILLEDPC",
  6 => "KILLEDNPC",
  7 => "ONSPAWN",
  8 => "ONDESPAWN"
);

$emotetype = array(
  0 => "Say",
  1 => "Emote",
  2 => "Shout",
  3 => "Message"
);

$flymodetype = array(
 -1 => "None",
  0 => "Ground",
  1 => "Flying",
  2 => "Levitate",
  3 => "Water",
  4 => "Floating"
);

$default_page = 1;
$default_size = 50;
$default_sort = 1;

$columns = array(
  1 => 'emoteid',
  2 => 'type',
  3 => 'event_',
  4 => 'text'
);

$special_abilities_max = count($specialattacks);

$stuck = array(
  0 => 'Run to Target',
  1 => 'Warp to Target',
  2 => 'Take No Action',
  3 => 'Evade Combat'
);

$npc_scaling_types = array(
  0 => 'Trash',
  1 => 'Named',
  2 => 'Raid'
);

switch ($action) {
  case 0:
    if ($npcid) {  // View NPC
      $body = new Template("templates/npc/npc.tmpl.php");
      $body->set('currzone', $z);
      $body->set('currzoneid', $zoneid);
      $body->set('npcid', $npcid);
      $body->set('classes', $classes);
      $body->set('genders', $genders);
      $body->set('bodytypes', $bodytypes);
      $body->set('races', $races);
      $body->set('yesno', $yesno);
      $body->set('skilltypes', $skilltypes);
      $body->set('suggestedid', (isset($_POST['selected_id']) && $_POST['selected_id'] > 0) ? $_POST['selected_id'] : suggest_npcid());
      $body->set('npc_name', getNPCName($npcid));
      $body->set('factions', $factions);
      $body->set('faction_values', $faction_values);
      $body->set('tmpfacshort', $tmpfacshort);
      $body->set('pet', get_ispet());
      $body->set('special_abilities_max', $special_abilities_max);
      $body->set('flymodetype', $flymodetype);
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
      $body->set('currzoneid', $zoneid);
    }
    else {
      $body = new Template("templates/npc/npc.default.tmpl.php");
    }
    break;
  case 1: // Edit NPC
    check_authorization();
    $javascript = new Template("templates/npc/js.tmpl.php");
    $body = new Template("templates/npc/npc.edit.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    $body->set('npc_name', getNPCName($npcid));
    $body->set('genders', $genders);
    $body->set('factions', $factions);
    $body->set('yesno', $yesno);
    $body->set('skilltypes', $skilltypes);
    $body->set('bodytypes', $bodytypes);
    $body->set('races', $races);
    $body->set('classes', $classes);
    $body->set('specialattacks', $specialattacks);
    $body->set('faction_values', $faction_values);
    $body->set('pet', get_ispet());
    $body->set('special_abilities_max', $special_abilities_max);
    $body->set('stuck', $stuck);
    $body->set('flymodetype', $flymodetype);
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
    if (isset($_POST['pet']) && $_POST['pet'] == 1) {
      update_pet();
    }
    else {
      delete_pet();
    }
    header("Location: index.php?editor=npc&z=$z&zoneid=$zoneid&npcid=$npcid");
    exit;
  case 3: // Change npc_faction_id
    check_authorization();
    $body = new Template("templates/npc/factionid.change.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    $body->set('npc_faction_id', get_npc_faction_id());
    break;
  case 4: // Change npc_faction_id by ID
    check_authorization();
    $body = new Template("templates/npc/factionid.changebyid.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    $body->set('npc_faction_id', get_npc_faction_id());
    break;
  case 5:  // Update npc_faction_id
    check_authorization();
    update_npc_faction_id($_REQUEST['npc_faction_id']);
    header("Location: index.php?editor=npc&z=$z&zoneid=$zoneid&npcid=$npcid");
    exit;
  case 6: // Search npc_faction_ids
    check_authorization();
    $body = new Template("templates/npc/factionid.search.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    $body->set('npc_faction_id', get_npc_faction_id());
    break;
  case 7: // Search results for npc_faction_ids
    check_authorization();
    $body = new Template("templates/npc/factionid.searchresults.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    $body->set('results', search_npc_faction_ids($_POST['search']));
    $body->set('npc_faction_id', get_npc_faction_id());
    break;
  case 8: // Create new npc_faction_id
    check_authorization();
    $body = new Template("templates/npc/factionid.add.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    $body->set('id', suggest_npc_faction_id());
    $body->set('npc_name', getNPCName($npcid));
    break;
  case 9: // Create npc_faction_id
    check_authorization();
    create_npc_faction_id();
    update_npc_faction_id($_POST['id']);
    header("Location: index.php?editor=npc&z=$z&zoneid=$zoneid&npcid=$npcid");
    exit;
  case 10: // Create new npc_faction_id
    check_authorization();
    $body = new Template("templates/npc/factionid.edit.name.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    $vars = get_npc_faction_id_name();
    if ($vars) {
      foreach ($vars as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
  case 11: // Update npc_faction_id name
    check_authorization();
    update_npc_faction_id_name();
    header("Location: index.php?editor=npc&z=$z&zoneid=$zoneid&npcid=$npcid");
    exit;
  case 12: // Search for primary faction
    check_authorization();
    $body = new Template("templates/npc/primaryfaction.search.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    break;
  case 13: // Primary faction search results
    check_authorization();
    $body = new Template("templates/npc/primaryfaction.searchresults.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    $body->set('results', search_factions($_POST['search']));
    break;
  case 14: // Update primary faction
    check_authorization();
    update_primary_faction();
    header("Location: index.php?editor=npc&z=$z&zoneid=$zoneid&npcid=$npcid");
    exit;
  case 15: // Add faction hit search
    check_authorization();
    $body = new Template("templates/npc/factionhit.search.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    break;
  case 16: // Faction hit search results
    check_authorization();
    $body = new Template("templates/npc/factionhit.searchresults.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    $body->set('results', search_factions($_POST['search']));
    break;
  case 17: // Add faction hit
    check_authorization();
    $body = new Template("templates/npc/factionhit.add.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    $body->set('fid', $_GET['fid']);
    $body->set('name', get_faction_name($_GET['fid']));
    $body->set('tmpfaction', $tmpfaction);
    break;
  case 18: // Insert faction hit
    check_authorization();
    add_faction_hit();
    header("Location: index.php?editor=npc&z=$z&zoneid=$zoneid&npcid=$npcid");
    exit;
  case 19: // Edit faction hit
    check_authorization();
    $body = new Template("templates/npc/factionhit.edit.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    $body->set('tmpfaction', $tmpfaction);
    $vars = get_factionhit_info();
    if ($vars) {
      foreach ($vars as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
  case 20: // Update faction hit
    check_authorization();
    update_factionhit();
    header("Location: index.php?editor=npc&z=$z&zoneid=$zoneid&npcid=$npcid");
    exit;
  case 21: // Delete faction hit
    check_authorization();
    delete_factionhit();
    header("Location: index.php?editor=npc&z=$z&zoneid=$zoneid&npcid=$npcid");
    exit;
  case 22: // Edit merchant id
    check_authorization();
    $body = new Template("templates/npc/merchantid.edit.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    $body->set('merchant_id', get_merchant_id());
    $body->set('suggested_id', suggest_merchant_id());
    break;
  case 23: // Update merchant id
    check_authorization();
    update_merchant_id();
    header("Location: index.php?editor=npc&z=$z&zoneid=$zoneid&npcid=$npcid");
    exit;
  case 24: // Delete npc
    check_authorization();
    delete_npc();
    header("Location: index.php?editor=npc&z=$z&zoneid=$zoneid");
    exit;
  case 25: // Add npc
    check_authorization();
    $javascript = new Template("templates/npc/js.tmpl.php");
    $body = new Template("templates/npc/npc.add.tmpl.php"); 
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('suggestedid', suggest_npcid());
    $body->set('genders', $genders);
    $body->set('factions', $factions);
    $body->set('yesno', $yesno);
    $body->set('skilltypes', $skilltypes);
    $body->set('bodytypes', $bodytypes);
    $body->set('races', $races);
    $body->set('classes', $classes);
    $body->set('specialattacks', $specialattacks);
    $body->set('special_abilities_max', $special_abilities_max);
    $body->set('stuck', $stuck);
    $body->set('flymodetype', $flymodetype);
    $body->set('version', intval(getZoneVersion($zoneid)));
    $vars = get_stats();
    if ($vars) {
      foreach ($vars as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
  case 26: // Insert npc
    check_authorization();
    add_npc();
    if (isset($_POST['pet']) && $_POST['pet'] == 1) {
      add_pet();
    }
    $npcid = $_POST['id'];
    header("Location: index.php?editor=npc&z=$z&zoneid=$zoneid&npcid=$npcid");
    exit;
  case 27: // Search npcs
    $body = new Template("templates/npc/npc.searchresults.tmpl.php");
    if (isset($_GET['npc_id']) && $_GET['npc_id'] != "ID") {
      $results = search_npc_by_id();
    }
    else {
      $results = search_npcs();
    }
    $body->set("results", $results);
    break;
  case 28: // Copy npc
    check_authorization();
    copy_npc();
    $npcid = $_POST['id'];
    header("Location: index.php?editor=npc&z=$z&zoneid=$zoneid&npcid=$npcid");
    exit;
  case 29: // Edit Adventure id
    check_authorization();
    $body = new Template("templates/npc/adventureid.edit.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    $body->set('adventure_id', get_adventure_id());
    $body->set('suggested_id', suggest_adventure_id());
    break;
  case 30: // Update adventure id
    check_authorization();
    update_adventure_id();
    header("Location: index.php?editor=npc&z=$z&zoneid=$zoneid&npcid=$npcid");
    exit;
  case 31: // Edit Trap id
    check_authorization();
    $body = new Template("templates/npc/traptemplate.edit.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    $body->set('trap_id', get_trap_template());
    $body->set('suggested_id', suggest_trap_template());
    break;
  case 32: // Update trap id
    check_authorization();
    update_trap_template();
    header("Location: index.php?editor=npc&z=$z&zoneid=$zoneid&npcid=$npcid");
    exit;
  case 33: // Edit Tint id
    check_authorization();
    $body = new Template("templates/npc/dyetemplate.edit.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    $tint = tint_info();
    if ($tint) {
      foreach ($tint as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
  case 34: // Update Tint id
    check_authorization();
    update_tint();
    header("Location: index.php?editor=npc&z=$z&zoneid=$zoneid&npcid=$npcid");
    exit;
  case 35: // Add Tint id
    check_authorization();
    $body = new Template("templates/npc/dyetemplate.add.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    $body->set('suggested_id', suggest_dye_template());
    break;
  case 36: // Update Tint id
    check_authorization();
    add_dye_template();
    header("Location: index.php?editor=npc&z=$z&zoneid=$zoneid&npcid=$npcid");
    exit;
  case 37: // Delete Tint
    check_authorization();
    delete_tint();
    header("Location: index.php?editor=npc&z=$z&zoneid=$zoneid&npcid=$npcid");
    exit;
  case 38: // Search npc_faction_ids
    check_authorization();
    $body = new Template("templates/npc/factionprimary.search.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    $body->set('npc_faction_id', get_npc_faction_id());
    break;
  case 39: // Search results for npc_faction_ids
    check_authorization();
    $body = new Template("templates/npc/factionprimary.searchresults.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    $body->set('results', search_npc_faction_ids_primary($_POST['search']));
    $body->set('npc_faction_id', get_npc_faction_id());
    break;
  case 40: // Get next ID
    check_authorization();
    $body = new Template("templates/npc/nextid.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    $body->set('zoneids', $zoneids);
    $body->set('zoneid', getZoneID($z));
    break;
  case 41: // Get next ID
    check_authorization();
    $body = new Template("templates/npc/nextid.result.tmpl.php");
    $body->set('next_npcid', next_npcid());
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    break;
   case 42: // Add npc by level
    check_authorization();
    $body = new Template("templates/npc/npc.addbylevel.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    break;
  case 43: // Change NPC level
    check_authorization();
    $body = new Template("templates/npc/npc.changelevel.tmpl.php");
    $body->set('npcid', $npcid);
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    break;
  case 44: // Edit NPC Level
    check_authorization();
    $javascript = new Template("templates/npc/js.tmpl.php");
    $body = new Template("templates/npc/npc.edit.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    $body->set('npc_name', getNPCName($npcid));
    $body->set('genders', $genders);
    $body->set('factions', $factions);
    $body->set('yesno', $yesno);
    $body->set('skilltypes', $skilltypes);
    $body->set('bodytypes', $bodytypes);
    $body->set('races', $races);
    $body->set('classes', $classes);
    $body->set('specialattacks', $specialattacks);
    $body->set('faction_values', $faction_values);
    $body->set('pet', get_ispet());
    $body->set('special_abilities_max', $special_abilities_max);
    $body->set('stuck', $stuck);
    $body->set('flymodetype', $flymodetype);
    $body->set('version', intval(getZoneVersion($zoneid)));
    $vars = npc_info();
    if ($vars) {
      foreach ($vars as $key=>$value) {
        $body->set($key, $value);
      }
    }
    $vars_ = get_stats();
    if ($vars_) {
      foreach ($vars_ as $key=>$value) {
        $body->set($key, $value);
      }
      $body->set('maxlevel', 0);
      $body->set('STR', $vars_['stats']);
      $body->set('STA', $vars_['stats']);
      $body->set('DEX', $vars_['stats']);
      $body->set('AGI', $vars_['stats']);
      $body->set('_INT', $vars_['stats']);
      $body->set('WIS', $vars_['stats']);
      $body->set('CHA', $vars_['stats']);
      $body->set('MR', $vars_['resists']);
      $body->set('CR', $vars_['resists']);
      $body->set('FR', $vars_['resists']);
      $body->set('PR', $vars_['resists']);
      $body->set('DR', $vars_['resists']);
      $body->set('changed_level', TRUE);
    }
    break;
 case 45: // Change NPC level
    check_authorization();
    $body = new Template("templates/npc/npc.changelevelver.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    break;
  case 46: // Change NPC level
    check_authorization();
    change_npc_level_ver();
    header("Location: index.php?editor=npc&z=$z&zoneid=$zoneid");
    exit;
  case 47: // Mass change faction 
    check_authorization();
    $body = new Template("templates/npc/npc.factionchange.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    $body->set('npcfid', $_GET['npcfid']);
    break;
  case 48:
    check_authorization();
    $body = new Template("templates/npc/factionid.changebyname.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    $body->set('npcfid', $_GET['npcfid']);
    break;
  case 49:
    check_authorization();
    $body = new Template("templates/npc/factionid.changebyrace.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    $body->set('races', $races);
    $body->set('npcfid', $_GET['npcfid']);
    break;
  case 50: // Change faction by NPC Name
    check_authorization();
    change_faction_byname();
    header("Location: index.php?editor=npc&z=$z&zoneid=$zoneid&npcid=$npcid");
    exit;
  case 51: // Change faction by NPC Race
    check_authorization();
    change_faction_byrace();
    header("Location: index.php?editor=npc&z=$z&zoneid=$zoneid&npcid=$npcid");
    exit;
  case 52:
    check_authorization();
    $body = new Template("templates/npc/npc.changestats.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    $body->set('races', $races);
    $body->set('classes', $classes);
    $body->set('npctier', $npctier);
    $body->set('npctype', $npctype);
    $body->set('npcclass', $npcclass);
    $body->set('npcchange', $npcchange);
    $body->set('npcstatchange', $npcstatchange);
    break;
  case 53: // Change NPC by tier
    check_authorization();
    update_npc_bytier();
    header("Location: index.php?editor=npc&z=$z&zoneid=$zoneid&npcid=$npcid");
    exit;
  case 54: // Add a new pet
    check_authorization();
    $body = new Template("templates/npc/npc.add.pet.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    $body->set('pet_naming', $pet_naming);
    $body->set('pet_control', $pet_control);
    break;
  case 55: // Add new pet
    check_authorization();
    add_new_pet();
    header("Location: index.php?editor=npc&z=$z&zoneid=$zoneid&npcid=$npcid");
    exit;
  case 56: // Get pet data
     $body = new Template("templates/npc/npc.pet.tmpl.php");
     $body->set('currzone', $z);
     $body->set('currzoneid', $zoneid);
     $body->set('npcid', $npcid);
     $body->set('pet_naming', $pet_naming);
     $body->set('pet_control', $pet_control);
     $body->set('yesno', $yesno);
     $pet = get_pet();
     $equipment = get_pets_equipmentset_entries();
     if ($pet) {
        foreach ($pet as $key=>$value) {
          $body->set($key, $value);
        }
      }
      if ($equipment) {
        foreach ($equipment as $key=>$value) {
          $body->set($key, $value);
        }
      }
     break;
   case 57: // Delete pet
    check_authorization();
    delete_pet();
    header("Location: index.php?editor=npc&z=$z&zoneid=$zoneid&npcid=$npcid");
    exit;
  case 58: // Edit pet data
     check_authorization();
     $body = new Template("templates/npc/npc.edit.pet.tmpl.php");
     $body->set('currzone', $z);
     $body->set('currzoneid', $zoneid);
     $body->set('npcid', $npcid);
     $body->set('pet_naming', $pet_naming);
     $body->set('pet_control', $pet_control);
     $body->set('yesno', $yesno);
     $pet = get_pet_entry();
     if ($pet) {
        foreach ($pet as $key=>$value) {
          $body->set($key, $value);
        }
     }
     break;
  case 59: // Update Pet
    check_authorization();
    edit_pet();
    header("Location: index.php?editor=npc&z=$z&zoneid=$zoneid&npcid=$npcid&action=56");
    exit;
  case 60: // Add equipmentset
     check_authorization();
     $body = new Template("templates/npc/npc.add.equipmentset.tmpl.php");
     $body->set('currzone', $z);
     $body->set('currzoneid', $zoneid);
     $body->set('npcid', $npcid);
     $body->set('suggested_id', suggest_equipmentset_id());
     break;
  case 61: // Add equipmentset
    check_authorization();
    add_equipmentset();
    header("Location: index.php?editor=npc&z=$z&zoneid=$zoneid&npcid=$npcid&action=56");
    exit;
  case 62: // Delete equipmentset
    check_authorization();
    delete_equipmentset();
    header("Location: index.php?editor=npc&z=$z&zoneid=$zoneid&npcid=$npcid&action=56");
    exit;
  case 63: // Remove equipmentset
    check_authorization();
    remove_equipmentset();
    header("Location: index.php?editor=npc&z=$z&zoneid=$zoneid&npcid=$npcid&action=56");
    exit;
  case 64: // Edit equipmentset
     check_authorization();
     $body = new Template("templates/npc/npc.edit.equipmentset.tmpl.php");
     $body->set('currzone', $z);
     $body->set('currzoneid', $zoneid);
     $body->set('npcid', $npcid);
     $equipmentset = get_equipmentset();
     if ($equipmentset) {
        foreach ($equipmentset as $key=>$value) {
          $body->set($key, $value);
        }
      }
     break;
  case 65: // Edit equipmentset
    check_authorization();
    edit_equipmentset();
    header("Location: index.php?editor=npc&z=$z&zoneid=$zoneid&npcid=$npcid&action=56");
    exit;
  case 66: // Add equipmentset entry
     check_authorization();
     $body = new Template("templates/npc/npc.add.equipmentset_entry.tmpl.php");
     $javascript = new Template("templates/iframes/js.tmpl.php");
     $body->set('currzone', $z);
     $body->set('currzoneid', $zoneid);
     $body->set('npcid', $npcid);
     $body->set('suggested_id', suggest_equipmentset_slot_id());
     $body->set('set_id', $set_id = $_GET['set_id']);
     break;
  case 67: // Add equipmentset entry
    check_authorization();
    add_equipmentset_entry();
    header("Location: index.php?editor=npc&z=$z&zoneid=$zoneid&npcid=$npcid&action=56");
    exit;
  case 68: // Remove equipmentset entry
    check_authorization();
    delete_equipmentset_entry();
    header("Location: index.php?editor=npc&z=$z&zoneid=$zoneid&npcid=$npcid&action=56");
    exit;
  case 69: // Edit equipmentset entry
     check_authorization();
     $body = new Template("templates/npc/npc.edit.equipmentset_entry.tmpl.php");
     $javascript = new Template("templates/iframes/js.tmpl.php");
     $body->set('currzone', $z);
     $body->set('currzoneid', $zoneid);
     $body->set('npcid', $npcid);
     $equipmentset = get_equipmentset_entry();
     if ($equipmentset) {
        foreach ($equipmentset as $key=>$value) {
          $body->set($key, $value);
        }
      }
     break;
  case 70: // Edit equipmentset entry
    check_authorization();
    edit_equipmentset_entry();
    header("Location: index.php?editor=npc&z=$z&zoneid=$zoneid&npcid=$npcid&action=56");
    exit;
  case 71: // Quest redirect
    check_authorization();
    header("Location: index.php?editor=quest&z=$z&zoneid=$zoneid&npcid=$npcid");
    exit;
  case 72: // View emote set
    $breadcrumbs .= " >> Emote Set (" . $_GET['emoteid'] . ")";
    $body = new Template("templates/npc/emotes.set.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    $body->set('eventtype', $eventtype);
    $body->set('emotetype', $emotetype);
    $body->set('emoteid', $_GET['emoteid']);
    $emotes = get_emotes();
    if ($emotes) {
      foreach ($emotes as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
  case 73: // Delete emote
    check_authorization();
    $count = delete_emote();
    $emoteid = $_GET['emoteid']; 
    if($count > 0) {
      header("Location: index.php?editor=npc&z=$z&zoneid=$zoneid&npcid=$npcid&emoteid=$count&action=72");
    }
    else {
      header("Location: index.php?editor=npc&z=$z&zoneid=$zoneid&npcid=$npcid&action=78");
    } 
    exit;
  case 74: // Edit emote
    check_authorization();
    $breadcrumbs .= " >> <a href='index.php?editor=npc&action=78'>Emotes</a>" . " >> Edit Emote (" . $_GET['id'] . ")";
    $body = new Template("templates/npc/emotes.edit.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    $body->set('eventtype', $eventtype);
    $body->set('emotetype', $emotetype);
    $emote_info = emote_info();
    if ($emote_info) {
      foreach ($emote_info as $key=>$value) {
        $body->set($key, $value);
      }
    }
    $body->set('existing', getExistingEmoteEvents($_GET['emoteid']));
    break;
  case 75: // Update emote
    check_authorization();
    $emoteid = update_emote();
    $nnpcid = get_npcid_from_emote($emoteid);
    if($nnpcid == 0){
      $nnpcid = $npcid;
    }
    header("Location: index.php?editor=npc&z=$z&zoneid=$zoneid&npcid=$nnpcid&emoteid=$emoteid&action=72");
    exit;
  case 76: // Add emote
    check_authorization();
    $breadcrumbs .= " >> <a href='index.php?editor=npc&action=78'>Emotes</a>" . " >> Add Emote";
    if ($npcid) {
      $body = new Template("templates/npc/emotes.add.tmpl.php");
    }
    else {
      $body = new Template("templates/npc/emotes.addentry.tmpl.php");
    }
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    $body->set('eventtype', $eventtype);
    $body->set('emotetype', $emotetype);
    $emoteid = 0;
    if(isset($_GET['emoteid']) && $_GET['emoteid'] != 0) {
      $emoteid = $_GET['emoteid'];
    }
    else {
      $emoteid = suggest_emoteid();
    }
    $body->set('emoteid', $emoteid);
    $body->set('existing', getExistingEmoteEvents($emoteid));
    break;
  case 77: // Insert emote
    check_authorization();
    add_emote();
    $emoteid = $_POST['emoteid']; 
    header("Location: index.php?editor=npc&z=$z&zoneid=$zoneid&npcid=$npcid&emoteid=$emoteid&action=72");
    exit;
  case 78: // View emote list
    $breadcrumbs .= " >> <a href='index.php?editor=npc&action=78'>Emotes</a>";
    $curr_page = (isset($_GET['page'])) ? $_GET['page'] : $default_page;
    $curr_size = (isset($_GET['size'])) ? $_GET['size'] : $default_size;
    $curr_sort = (isset($_GET['sort'])) ? $columns[$_GET['sort']] : $columns[$default_sort];
    if (isset($_GET['filter']) && $_GET['filter'] == 'on') {
      $filter = build_filter();
    }
    $body = new Template("templates/npc/emotes.list.tmpl.php");
    $page_stats = getPageInfo("npc_emotes", TRUE, $curr_page, $curr_size, ((isset($_GET['sort'])) ? $_GET['sort'] : null), ((isset($filter)) ? $filter['sql'] : null));
    if (isset($filter)) {
      $body->set('filter', $filter);
    }
    if ($page_stats['page']) {
      $emotes = list_emotes($page_stats['page'], $curr_size, $curr_sort, ((isset($filter)) ? $filter['sql'] : null));
    }
    if ($emotes) {
      $body->set('emotes', $emotes);
      foreach ($page_stats as $key=>$value) {
        $body->set($key, $value);
      }
    }
    else {
      $body->set('page', 0);
      $body->set('pages', 0);
    }
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    $body->set('eventtype', $eventtype);
    $body->set('emotetype', $emotetype);
    break;
  case 79: //View NPCs using emote set
    $breadcrumbs .= " >> <a href='index.php?editor=npc&action=78'>Emotes</a>" . " >> NPC List";
    $body = new Template("templates/npc/emotes.npcsbyemote.tmpl.php");
    $body->set('emoteid', $_GET['emoteid']);
    $npclist = getNPCsByEmote();
    if ($npclist) {
      $body->set('npclist', $npclist);
    }
    break;
  case 80: // Add emote method
    check_authorization();
    if ($_POST['method'] == 1) {
      header("Location: index.php?editor=npc&z=$z&zoneid=$zoneid&npcid=$npcid&emoteid=0&action=81");
    }
    if ($_POST['method'] == 2) {
      $emoteid = $_POST['emoteid'];
      setExistingEmote($npcid, $emoteid);
      header("Location: index.php?editor=npc&z=$z&zoneid=$zoneid&npcid=$npcid&emoteid=$emoteid&action=72");
    }
    exit;
  case 81: // Create new emote
    check_authorization();
    $breadcrumbs .= " >> <a href='index.php?editor=npc&action=78'>Emotes</a>" . " >> Add Emote";
    $body = new Template("templates/npc/emotes.addentry.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    $body->set('eventtype', $eventtype);
    $body->set('emotetype', $emotetype);
    $emoteid = 0;
    if($_GET['emoteid'] != 0) {
      $emoteid = $_GET['emoteid'];
    }
    else {
      $emoteid = suggest_emoteid();
    }
    $body->set('emoteid', $emoteid);
    $body->set('existing', getExistingEmoteEvents($emoteid));
    break;
  case 82: // Drop emote set from NPC
    check_authorization();
    setExistingEmote($npcid, 0);
    header("Location: index.php?editor=npc&z=$z&zoneid=$zoneid&npcid=$npcid");
    exit;
  case 83: // View all pets
    $breadcrumbs .= " >> View Pets";
    $body = new Template("templates/npc/npc.pets.view.tmpl.php");
    $pets = get_pets();
    if ($pets) {
      $body->set('pets', $pets);
    }
    break;
  case 84: // View Beastlord Pets
    $breadcrumbs .= " >> View Beastlord Pets";
    $body = new Template("templates/npc/npc.beastlord.pets.view.tmpl.php");
    $beastlord_pets = get_beastlord_pets();
    if ($beastlord_pets) {
      $body->set('beastlord_pets', $beastlord_pets);
    }
    $body->set('races', $races);
    $body->set('genders', $genders);
    break;
  case 85: // Add Beastlord Pet
    check_authorization();
    $breadcrumbs .= " >> <a href='index.php?editor=npc&action=84'>View Beastlord Pets</a> >> Add Beastlord Pet";
    $body = new Template("templates/npc/npc.add.beastlord.pet.tmpl.php");
    $body->set('races', $races);
    $body->set('genders', $genders);
    break;
  case 86: // Edit Beastlord Pet
    check_authorization();
    $breadcrumbs .= " >> <a href='index.php?editor=npc&action=84'>View Beastlord Pets</a> >> Edit Beastlord Pet";
    $body = new Template("templates/npc/npc.edit.beastlord.pet.tmpl.php");
    $beastlord_pet = get_beastlord_pet($_GET['player_race']);
    if ($beastlord_pet) {
      $body->set('beastlord_pet', $beastlord_pet);
    }
    $body->set('races', $races);
    $body->set('genders', $genders);
    break;
  case 87: // Insert Beastlord Pet
    check_authorization();
    insert_beastlord_pet();
    header("Location: index.php?editor=npc&action=84");
    exit;
  case 88: // Delete Beastlord Pet
    check_authorization();
    delete_beastlord_pet($_GET['player_race']);
    header("Location: index.php?editor=npc&action=84");
    exit;
  case 89: // View NPC Scaling
    $breadcrumbs .= " >> NPC Scaling";
    $body = new Template("templates/npc/npc.scaling.view.tmpl.php");
    $scaling = get_npc_scaling();
    if ($scaling) {
      $body->set('scaling', $scaling);
      $body->set('npc_scaling_types', $npc_scaling_types);
    }
    break;
  case 90: // Add NPC Scale
    check_authorization();
    $javascript = new Template("templates/npc/js.tmpl.php");
    $breadcrumbs .= " >> <a href='index.php?editor=npc&action=89'>NPC Scaling</a> >> Add Scale";
    $body = new Template("templates/npc/npc.scale.add.tmpl.php");
    $body->set('npc_scaling_types', $npc_scaling_types);
    $body->set('zoneids', $zoneids);
    break;
  case 91: // Insert NPC Scale
    check_authorization();
    insert_npc_scale();
    header("Location: index.php?editor=npc&action=89");
    exit;
  case 92: // Edit NPC Scale
    check_authorization();
    $javascript = new Template("templates/npc/js.tmpl.php");
    $breadcrumbs .= " >> <a href='index.php?editor=npc&action=89'>NPC Scaling</a> >> Edit Scale";
    $body = new Template("templates/npc/npc.scale.edit.tmpl.php");
    $scale = get_npc_scale($_GET['type'], $_GET['level'], $_GET['zone_id_list'], $_GET['instance_version_list']);
    if ($scale) {
      $body->set('scale', $scale);
      $body->set('npc_scaling_types', $npc_scaling_types);
      $body->set('zoneids', $zoneids);
      $body->set('special_abilities_max', $special_abilities_max);
      $body->set('specialattacks', $specialattacks);
    }
    break;
  case 93: // Update NPC Scale
    check_authorization();
    update_npc_scale();
    header("Location: index.php?editor=npc&action=89");
    exit;
  case 94: // Delete NPC Scale
    check_authorization();
    delete_npc_scale($_GET['type'], $_GET['level'], $_GET['zone_id_list'], $_GET['instance_version_list']);
    header("Location: index.php?editor=npc&action=89");
    exit;
}

function npc_info() {
  global $mysql_content_db, $npcid, $zoneid;

  $query = "SELECT * FROM npc_types WHERE id=$npcid";
  $result = $mysql_content_db->query_assoc($query);
  $factionid = $result['npc_faction_id'];

  $result['factionname'] = '';
  $result['primaryfaction'] = '';
  $result['primaryfactionname'] = '';
  $result['faction_hits'] = '';


  if ($factionid != 0) {
    $query = "SELECT * FROM npc_faction WHERE id=$factionid";
    $result2 = $mysql_content_db->query_assoc($query);

    $result['factionname'] = $result2['name'];
    $result['primaryfaction'] = $result2['primaryfaction'];
    $result['primaryfactionname'] = get_faction_name($result2['primaryfaction']);

    $query = "SELECT * FROM npc_faction_entries WHERE npc_faction_id=$factionid";
    $result3 = $mysql_content_db->query_mult_assoc($query);

    $result['faction_hits'] = $result3;
  }

  return $result;
}

function get_ispet() {
  global $mysql_content_db, $npcid;

  $query = "SELECT count(*) AS count FROM pets WHERE npcID=$npcid";
  $result = $mysql_content_db->query_assoc($query);

  return $result['count'];
}

function get_pet() {
  global $mysql_content_db, $npcid;

  $query = "SELECT * FROM pets WHERE npcID=$npcid";
  $result = $mysql_content_db->query_assoc($query);

  $equipmentset = $result['equipmentset'];

  $query = "SELECT * FROM pets_equipmentset WHERE set_id=$equipmentset";
  $result2 = $mysql_content_db->query_assoc($query);

  if ($result2) {
    $result['set_id'] = $result2['set_id'];
    $result['setname'] = $result2['setname'];
    $result['nested_set'] = $result2['nested_set'];
  }

  return $result;
}

function get_pets() {
  global $mysql_content_db;

  $query = "SELECT type, petpower, npcID FROM pets";
  $results = $mysql_content_db->query_mult_assoc($query);

  if ($results) {
    return $results;
  }
  else {
    return null;
  }
}

function get_pets_equipmentset_entries(){
  global $mysql_content_db, $npcid;
  $array = array();

  $query = "SELECT equipmentset FROM pets WHERE npcID=$npcid";
  $result = $mysql_content_db->query_assoc($query);

  $equipmentset = $result['equipmentset'];

  $query = "SELECT * FROM pets_equipmentset_entries WHERE set_id=$equipmentset";
  $result = $mysql_content_db->query_mult_assoc($query);

  if ($result) {
    foreach ($result as $result) {
     $array['equipment'][$result['slot']] = array("slot"=>$result['slot'], "item_id"=>$result['item_id']);
         }
       }
  return $array;
}

function get_equipmentset() {
  global $mysql_content_db, $npcid;

  $query = "SELECT equipmentset FROM pets WHERE npcID=$npcid";
  $result = $mysql_content_db->query_assoc($query);

  $equipmentset = $result['equipmentset'];

  $query = "SELECT * FROM pets_equipmentset WHERE set_id=$equipmentset";
  $result = $mysql_content_db->query_assoc($query);

  return $result;
}

function get_equipmentset_entry() {
  global $mysql_content_db;

  $set_id = $_GET['set_id'];
  $slot = $_GET['slot'];

  $query = "SELECT * FROM pets_equipmentset_entries WHERE set_id=$set_id AND slot=$slot";
  $result = $mysql_content_db->query_assoc($query);

  return $result;
}

function get_pet_entry() {
  global $mysql_content_db, $npcid;

  $query = "SELECT * FROM pets WHERE npcID=$npcid";
  $result = $mysql_content_db->query_assoc($query);

  return $result;
}

function update_pet() {
  check_authorization();
  global $mysql_content_db, $npcid;

  $name = $_POST['name'];

  $query = "SELECT count(*) FROM pets WHERE npcID=$npcid";
  $result = $mysql_content_db->query_assoc($query);

  $count = $result['count(*)'];

  if($count == 0)
  {
  	$query = "REPLACE INTO pets SET npcID=$npcid, type=\"$name\"";
  	$mysql_content_db->query_no_result($query);
  }
}

function add_pet() {
  check_authorization();
  global $mysql_content_db;

  $name = $_POST['name'];
  $npcid = $_POST['id'];

  $query = "INSERT INTO pets SET npcID=$npcid, type=\"$name\", petcontrol=2, petnaming=3";
  $mysql_content_db->query_no_result($query);
}

function add_new_pet() {
  check_authorization();
  global $mysql_content_db;

  $type = $_POST['type'];
  $npcid = $_POST['id'];
  $petpower = $_POST['petpower'];
  $petcontrol = $_POST['petcontrol'];
  $petnaming = $_POST['petnaming'];
  $equipmentset = $_POST['equipmentset'];
  $monsterflag = $_POST['monsterflag'];
  $temp = $_POST['temp'];

  $query = "INSERT INTO pets SET npcID=$npcid, type=\"$type\", petcontrol=$petcontrol, petnaming=$petnaming, petpower=$petpower, equipmentset=$equipmentset, monsterflag=$monsterflag, temp=$temp";
  $mysql_content_db->query_no_result($query);
}

function edit_pet() {
  check_authorization();
  global $mysql_content_db, $npcid;

  $type = $_POST['type'];
  $petpower = $_POST['petpower'];
  $petcontrol = $_POST['petcontrol'];
  $petnaming = $_POST['petnaming'];
  $equipmentset = $_POST['equipmentset'];
  $monsterflag = $_POST['monsterflag'];
  $temp = $_POST['temp'];

  $query = "UPDATE pets SET type=\"$type\", petcontrol=$petcontrol, petnaming=$petnaming, petpower=$petpower, equipmentset=$equipmentset, monsterflag=$monsterflag, temp=$temp WHERE npcID=$npcid";
  $mysql_content_db->query_no_result($query);
}

function delete_pet() {
  check_authorization();
  global $mysql_content_db, $npcid;

  $query = "DELETE FROM pets WHERE npcID=$npcid";
  $mysql_content_db->query_no_result($query);
}

function add_equipmentset() {
  check_authorization();
  global $mysql_content_db, $npcid;

  $set_id = $_POST['set_id'];
  $setname = $_POST['setname'];
  $nested_set = $_POST['nested_set'];

  $query = "INSERT INTO pets_equipmentset SET set_id=$set_id, setname=\"$setname\", nested_set=$nested_set";
  $mysql_content_db->query_no_result($query);

  $query = "UPDATE pets SET equipmentset = $set_id WHERE npcID=$npcid";
  $mysql_content_db->query_no_result($query);
}

function add_equipmentset_entry() {
  check_authorization();
  global $mysql_content_db;

  $set_id = $_POST['set_id'];
  $slot = $_POST['slot'];
  $item_id = $_POST['item_id'];

  $query = "INSERT INTO pets_equipmentset_entries SET set_id=$set_id, slot=$slot, item_id=$item_id";
  $mysql_content_db->query_no_result($query);
}

function edit_equipmentset() {
  check_authorization();
  global $mysql_content_db, $npcid;

  $set_id = $_POST['set_id'];
  $setname = $_POST['setname'];
  $nested_set = $_POST['nested_set'];

  $query = "UPDATE pets_equipmentset SET set_id = $set_id, setname = \"$setname\", nested_set = $nested_set";
  $mysql_content_db->query_no_result($query);

  $query = "UPDATE pets SET equipmentset = $set_id WHERE npcID=$npcid";
  $mysql_content_db->query_no_result($query);
}

function edit_equipmentset_entry() {
  check_authorization();
  global $mysql_content_db;

  $set_id = $_POST['set_id'];
  $slot = $_POST['slot'];
  $item_id = $_POST['item_id'];

  $query = "UPDATE pets_equipmentset_entries SET slot=$slot, item_id=$item_id WHERE set_id=$set_id";
  $mysql_content_db->query_no_result($query);
}

function suggest_equipmentset_id() {
  global $mysql_content_db;
  $query = "SELECT MAX(set_id) as id FROM pets_equipmentset";
  $result = $mysql_content_db->query_assoc($query);
  return ($result['id'] + 1);
}

function suggest_equipmentset_slot_id(){
 global $mysql_content_db;

  $set_id = $_GET['set_id'];

  $query = "SELECT MAX(slot) as id FROM pets_equipmentset_entries WHERE set_id=$set_id";
  $result = $mysql_content_db->query_assoc($query);
  return ($result['id'] + 1);
}

function delete_equipmentset() {
  check_authorization();
  global $mysql_content_db, $npcid;

  $set_id = $_GET['set_id'];

  $query = "DELETE from pets_equipmentset WHERE set_id=$set_id";
  $mysql_content_db->query_no_result($query);

  $query = "DELETE from pets_equipmentset_entries WHERE set_id=$set_id";
  $mysql_content_db->query_no_result($query);

  $query = "UPDATE pets SET equipmentset = 0 WHERE npcID=$npcid";
  $mysql_content_db->query_no_result($query);
}

function delete_equipmentset_entry() {
  check_authorization();
  global $mysql_content_db;

  $set_id = $_GET['set_id'];
  $slot = $_GET['slot'];

  $query = "DELETE from pets_equipmentset_entries WHERE set_id=$set_id AND slot=$slot";
  $mysql_content_db->query_no_result($query);
}

function remove_equipmentset() {
  check_authorization();
  global $mysql_content_db, $npcid;

  $query = "UPDATE pets SET equipmentset = 0 WHERE npcID=$npcid";
  $mysql_content_db->query_no_result($query);
}

function update_npc() {
  check_authorization();
  global $mysql_content_db, $npcid, $specialattacks;

  $oldstats = npc_info();
  extract($oldstats);

  // Define checkbox fields:
  if (!isset($_POST['qglobal'])) $_POST['qglobal'] = 0;
  if (!isset($_POST['npc_aggro'])) $_POST['npc_aggro'] = 0;
  if (!isset($_POST['findable'])) $_POST['findable'] = 0;
  if (!isset($_POST['trackable'])) $_POST['trackable'] = 0;
  if (!isset($_POST['pet'])) $_POST['pet'] = 0;
  if (!isset($_POST['private_corpse'])) $_POST['private_corpse'] = 0;
  if (!isset($_POST['unique_spawn_by_name'])) $_POST['unique_spawn_by_name'] = 0;
  if (!isset($_POST['underwater'])) $_POST['underwater'] = 0;
  if (!isset($_POST['isquest'])) $_POST['isquest'] = 0;
  if (!isset($_POST['ignore_despawn'])) $_POST['ignore_despawn'] = 0;
  if (!isset($_POST['skip_global_loot'])) $_POST['skip_global_loot'] = 0;
  if (!isset($_POST['rare_spawn'])) $_POST['rare_spawn'] = 0;

  // Check for special attacks change
  $new_specialattks = '';
  $flag = 0;
  foreach ($specialattacks as $k=>$v) {
    if (isset($_POST["$k"])) {
      if(SUBSTR($_POST["$k"], -1) != '^' && $_POST["$k"] != ''){$_POST["$k"].= '^';}
      $new_specialattks .= $_POST["$k"];
    }
  }
  if ($special_abilities != $new_specialattks) {
    $flag = 1;
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
  if ($mana != $_POST['mana']) $fields .= "mana=\"" . $_POST['mana'] . "\", ";
  if ($gender != $_POST['gender']) $fields .= "gender=\"" . $_POST['gender'] . "\", ";
  if ($texture != $_POST['texture']) $fields .= "texture=\"" . $_POST['texture'] . "\", ";
  if ($helmtexture != $_POST['helmtexture']) $fields .= "helmtexture=\"" . $_POST['helmtexture'] . "\", ";
  if ($herosforgemodel != $_POST['herosforgemodel']) $fields .= "herosforgemodel=\"" . $_POST['herosforgemodel'] . "\", ";
  if ($size != $_POST['size']) $fields .= "size=\"" . $_POST['size'] . "\", ";
  if ($hp_regen_rate != $_POST['hp_regen_rate']) $fields .= "hp_regen_rate=\"" . $_POST['hp_regen_rate'] . "\", ";
  if ($hp_regen_per_second != $_POST['hp_regen_per_second']) $fields .= "hp_regen_per_second=\"" . $_POST['hp_regen_per_second'] . "\", ";
  if ($mana_regen_rate != $_POST['mana_regen_rate']) $fields .= "mana_regen_rate=\"" . $_POST['mana_regen_rate'] . "\", ";
  if ($loottable_id != $_POST['loottable_id']) $fields .= "loottable_id=\"" . $_POST['loottable_id'] . "\", ";
  //merchant_id
  //alt_currency_id
  if ($npc_spells_id != $_POST['npc_spells_id']) $fields .= "npc_spells_id=\"" . $_POST['npc_spells_id'] . "\", ";
  //npc_spells_effects_id
  //npc_faction_id
  //adventure_template_id
  if ($trap_template != $_POST['trap_template']) $fields .= "trap_template=\"" . $_POST['trap_template'] . "\", ";
  if ($mindmg != $_POST['mindmg']) $fields .= "mindmg=\"" . $_POST['mindmg'] . "\", ";
  if ($maxdmg != $_POST['maxdmg']) $fields .= "maxdmg=\"" . $_POST['maxdmg'] . "\", ";
  if ($attack_count != $_POST['attack_count']) $fields .= "attack_count=\"" . $_POST['attack_count'] . "\", ";
  //npcspecialattks
  if ($flag == 1) $fields .= "special_abilities=\"$new_specialattks\", ";
  if ($aggroradius != $_POST['aggroradius']) $fields .= "aggroradius=\"" . $_POST['aggroradius'] . "\", ";
  if ($assistradius != $_POST['assistradius']) $fields .= "assistradius=\"" . $_POST['assistradius'] . "\", ";
  if ($face != $_POST['face']) $fields .= "face=\"" . $_POST['face'] . "\", ";
  if ($luclin_hairstyle != $_POST['luclin_hairstyle']) $fields .= "luclin_hairstyle=\"" . $_POST['luclin_hairstyle'] . "\", ";
  if ($luclin_haircolor != $_POST['luclin_haircolor']) $fields .= "luclin_haircolor=\"" . $_POST['luclin_haircolor'] . "\", ";
  if ($luclin_eyecolor != $_POST['luclin_eyecolor']) $fields .= "luclin_eyecolor=\"" . $_POST['luclin_eyecolor'] . "\", ";
  if ($luclin_eyecolor2 != $_POST['luclin_eyecolor2']) $fields .= "luclin_eyecolor2=\"" . $_POST['luclin_eyecolor2'] . "\", ";
  if ($luclin_beardcolor != $_POST['luclin_beardcolor']) $fields .= "luclin_beardcolor=\"" . $_POST['luclin_beardcolor'] . "\", ";
  if ($luclin_beard != $_POST['luclin_beard']) $fields .= "luclin_beard=\"" . $_POST['luclin_beard'] . "\", ";
  if ($drakkin_heritage != $_POST['drakkin_heritage']) $fields .= "drakkin_heritage=\"" . $_POST['drakkin_heritage'] . "\", ";
  if ($drakkin_tattoo != $_POST['drakkin_tattoo']) $fields .= "drakkin_tattoo=\"" . $_POST['drakkin_tattoo'] . "\", ";
  if ($drakkin_details != $_POST['drakkin_details']) $fields .= "drakkin_details=\"" . $_POST['drakkin_details'] . "\", ";
  //armortint_id
  if ($armortint_red != $_POST['armortint_red']) $fields .= "armortint_red=\"" . $_POST['armortint_red'] . "\", ";
  if ($armortint_green != $_POST['armortint_green']) $fields .= "armortint_green=\"" . $_POST['armortint_green'] . "\", ";
  if ($armortint_blue != $_POST['armortint_blue']) $fields .= "armortint_blue=\"" . $_POST['armortint_blue'] . "\", ";
  if ($d_melee_texture1 != $_POST['d_melee_texture1']) $fields .= "d_melee_texture1=\"" . $_POST['d_melee_texture1'] . "\", ";
  if ($d_melee_texture2 != $_POST['d_melee_texture2']) $fields .= "d_melee_texture2=\"" . $_POST['d_melee_texture2'] . "\", ";
  //ammo_idfile
  if ($prim_melee_type != $_POST['prim_melee_type']) $fields .= "prim_melee_type=\"" . $_POST['prim_melee_type'] . "\", ";
  if ($sec_melee_type != $_POST['sec_melee_type']) $fields .= "sec_melee_type=\"" . $_POST['sec_melee_type'] . "\", ";
  //ranged_type
  if ($runspeed != $_POST['runspeed']) $fields .= "runspeed=\"" . $_POST['runspeed'] . "\", ";
  if ($MR != $_POST['MR']) $fields .= "MR=\"" . $_POST['MR'] . "\", ";
  if ($CR != $_POST['CR']) $fields .= "CR=\"" . $_POST['CR'] . "\", ";
  if ($DR != $_POST['DR']) $fields .= "DR=\"" . $_POST['DR'] . "\", ";
  if ($FR != $_POST['FR']) $fields .= "FR=\"" . $_POST['FR'] . "\", ";
  if ($PR != $_POST['PR']) $fields .= "PR=\"" . $_POST['PR'] . "\", ";
  if ($Corrup != $_POST['Corrup']) $fields .= "Corrup=\"" . $_POST['Corrup'] . "\", ";
  if ($PhR != $_POST['PhR']) $fields .= "PhR=\"" . $_POST['PhR'] . "\", ";
  if ($see_invis != $_POST['see_invis']) $fields .= "see_invis=\"" . $_POST['see_invis'] . "\", ";
  if ($see_invis_undead != $_POST['see_invis_undead']) $fields .= "see_invis_undead=\"" . $_POST['see_invis_undead'] . "\", ";
  if ($qglobal != $_POST['qglobal']) $fields .= "qglobal=\"" . $_POST['qglobal'] . "\", ";
  if ($AC != $_POST['AC']) $fields .= "AC=\"" . $_POST['AC'] . "\", ";
  if ($npc_aggro != $_POST['npc_aggro']) $fields .= "npc_aggro=\"" . $_POST['npc_aggro'] . "\", ";
  if ($spawn_limit != $_POST['spawn_limit']) $fields .= "spawn_limit=\"" . $_POST['spawn_limit'] . "\", ";
  //attack_speed
  if ($attack_delay != $_POST['attack_delay']) $fields .= "attack_delay=\"" . $_POST['attack_delay'] . "\", ";
  if ($findable != $_POST['findable']) $fields .= "findable=\"" . $_POST['findable'] . "\", ";
  if ($STR != $_POST['STR']) $fields .= "STR=\"" . $_POST['STR'] . "\", ";
  if ($STA != $_POST['STA']) $fields .= "STA=\"" . $_POST['STA'] . "\", ";
  if ($DEX != $_POST['DEX']) $fields .= "DEX=\"" . $_POST['DEX'] . "\", ";
  if ($AGI != $_POST['AGI']) $fields .= "AGI=\"" . $_POST['AGI'] . "\", ";
  if ($_INT != $_POST['_INT']) $fields .= "_INT=\"" . $_POST['_INT'] . "\", ";
  if ($WIS != $_POST['WIS']) $fields .= "WIS=\"" . $_POST['WIS'] . "\", ";
  if ($CHA != $_POST['CHA']) $fields .= "CHA=\"" . $_POST['CHA'] . "\", ";
  if ($see_hide != $_POST['see_hide']) $fields .= "see_hide=\"" . $_POST['see_hide'] . "\", ";
  if ($see_improved_hide != $_POST['see_improved_hide']) $fields .= "see_improved_hide=\"" . $_POST['see_improved_hide'] . "\", ";
  if ($trackable != $_POST['trackable']) $fields .= "trackable=\"" . $_POST['trackable'] . "\", ";
  //isbot
  //exclude
  if ($ATK != $_POST['ATK']) $fields .= "ATK=\"" . $_POST['ATK'] . "\", ";
  if ($Accuracy != $_POST['Accuracy']) $fields .= "Accuracy=\"" . $_POST['Accuracy'] . "\", ";
  if ($Avoidance != $_POST['Avoidance']) $fields .= "Avoidance=\"" . $_POST['Avoidance'] . "\", ";
  if ($slow_mitigation != $_POST['slow_mitigation']) $fields .= "slow_mitigation=\"" . $_POST['slow_mitigation'] . "\", ";
  if ($version != $_POST['version']) $fields .= "version=\"" . $_POST['version'] . "\", ";
  if ($maxlevel != $_POST['maxlevel']) $fields .= "maxlevel=\"" . $_POST['maxlevel'] . "\", ";
  if ($scalerate != $_POST['scalerate']) $fields .= "scalerate=\"" . $_POST['scalerate'] . "\", ";
  if ($private_corpse != $_POST['private_corpse']) $fields .= "private_corpse=\"" . $_POST['private_corpse'] . "\", ";
  if ($unique_spawn_by_name != $_POST['unique_spawn_by_name']) $fields .= "unique_spawn_by_name=\"" . $_POST['unique_spawn_by_name'] . "\", ";
  if ($underwater != $_POST['underwater']) $fields .= "underwater=\"" . $_POST['underwater'] . "\", ";
  if ($isquest != $_POST['isquest']) $fields .= "isquest=\"" . $_POST['isquest'] . "\", ";
  if ($emoteid != $_POST['emoteid']) $fields .= "emoteid=\"" . $_POST['emoteid'] . "\", ";
  if ($spellscale != $_POST['spellscale']) $fields .= "spellscale=\"" . $_POST['spellscale'] . "\", ";
  if ($healscale != $_POST['healscale']) $fields .= "healscale=\"" . $_POST['healscale'] . "\", ";
  if ($no_target_hotkey != $_POST['no_target_hotkey']) $fields .= "no_target_hotkey=\"" . $_POST['no_target_hotkey'] . "\", ";
  if ($raid_target != $_POST['raid_target']) $fields .= "raid_target=\"" . $_POST['raid_target'] . "\", ";
  //armtexture
  //bracertexture
  //handtexture
  //legtexture
  //feettexture
  if ($light != $_POST['light']) $fields .= "light=\"" . $_POST['light'] . "\", ";
  //walkspeed
  //peqid
  //unique_
  //fixed
  if ($ignore_despawn != $_POST['ignore_despawn']) $fields .= "ignore_despawn=\"" . $_POST['ignore_despawn'] . "\", ";
  if ($show_name != $_POST['show_name']) $fields .= "show_name=\"" . $_POST['show_name'] . "\", ";
  //untargetable
  if ($charm_ac != $_POST['charm_ac']) $fields .= "charm_ac=\"" . $_POST['charm_ac'] . "\", ";
  if ($charm_min_dmg != $_POST['charm_min_dmg']) $fields .= "charm_min_dmg=\"" . $_POST['charm_min_dmg'] . "\", ";
  if ($charm_max_dmg != $_POST['charm_max_dmg']) $fields .= "charm_max_dmg=\"" . $_POST['charm_max_dmg'] . "\", ";
  if ($charm_attack_delay != $_POST['charm_attack_delay']) $fields .= "charm_attack_delay=\"" . $_POST['charm_attack_delay'] . "\", ";
  if ($charm_accuracy_rating != $_POST['charm_accuracy_rating']) $fields .= "charm_accuracy_rating=\"" . $_POST['charm_accuracy_rating'] . "\", ";
  if ($charm_avoidance_rating != $_POST['charm_avoidance_rating']) $fields .= "charm_avoidance_rating=\"" . $_POST['charm_avoidance_rating'] . "\", ";
  if ($charm_atk != $_POST['charm_atk']) $fields .= "charm_atk=\"" . $_POST['charm_atk'] . "\", ";
  if ($skip_global_loot != $_POST['skip_global_loot']) $fields .= "skip_global_loot=\"" . $_POST['skip_global_loot'] . "\", ";
  if ($rare_spawn != $_POST['rare_spawn']) $fields .= "rare_spawn=\"" . $_POST['rare_spawn'] . "\", ";
  if ($stuck_behavior != $_POST['stuck_behavior']) $fields .= "stuck_behavior=\"" . $_POST['stuck_behavior'] . "\", ";
  if ($model != $_POST['model']) $fields .= "model=\"" . $_POST['model'] . "\", ";
  if ($flymode != $_POST['flymode']) $fields .= "flymode=\"" . $_POST['flymode'] . "\", ";
  if ($always_aggro != $_POST['always_aggro']) $fields .= "always_aggro=\"" . $_POST['always_aggro'] . "\", ";
  if ($exp_mod != $_POST['exp_mod']) $fields .= "exp_mod=\"" . $_POST['exp_mod'] . "\", ";
  if ($heroic_strikethrough != $_POST['heroic_strikethrough']) $fields .= "heroic_strikethrough=\"" . $_POST['heroic_strikethrough'] . "\", ";
  if ($faction_amount != $_POST['faction_amount']) $fields .= "faction_amount=\"" . $_POST['faction_amount'] . "\", ";
  if ($keeps_sold_items != $_POST['keeps_sold_items']) $fields .= "keeps_sold_items=\"" . $_POST['keeps_sold_items'] . "\", ";

  $fields =  rtrim($fields, ", ");

  if ($fields != '') {
    $query = "UPDATE npc_types SET $fields WHERE id=$npcid";
    $query2 = "UPDATE npc_types SET special_abilities = TRIM(TRAILING '^' FROM special_abilities)";
    $mysql_content_db->query_no_result($query);
    $mysql_content_db->query_no_result($query2);
  }
}

function add_npc() {
  check_authorization();
  global $mysql_content_db, $specialattacks;

  // Define checkbox fields:
  if ($_POST['qglobal'] != 1) $_POST['qglobal'] = 0;
  if ($_POST['npc_aggro'] != 1) $_POST['npc_aggro'] = 0;
  if ($_POST['findable'] != 1) $_POST['findable'] = 0;
  if ($_POST['trackable'] != 1) $_POST['trackable'] = 0;
  if ($_POST['private_corpse'] != 1) $_POST['private_corpse'] = 0;
  if ($_POST['unique_spawn_by_name'] != 1) $_POST['unique_spawn_by_name'] = 0;
  if ($_POST['underwater'] != 1) $_POST['underwater'] = 0;
  if ($_POST['isquest'] != 1) $_POST['isquest'] = 0;
  if ($_POST['ignore_despawn'] != 1) $_POST['ignore_despawn'] = 0;
  if ($_POST['skip_global_loot'] != 1) $_POST['skip_global_loot'] = 0;
  if ($_POST['rare_spawn'] != 1) $_POST['rare_spawn'] = 0;

  foreach ($specialattacks as $k => $v) {
    if (isset($_POST["$k"])) {
    if(SUBSTR($_POST["$k"], -1) != '^' && $_POST["$k"] != ''){$_POST["$k"].= '^';}
      $special_abilities .= $_POST["$k"];
    }
  }

  $fields = "id=\"" . $_POST['id']. "\", ";
  $fields .= "name=\"" . $_POST['name'] . "\", ";
  $fields .= "lastname=\"" . $_POST['lastname'] . "\", ";
  $fields .= "level=\"" . $_POST['level'] . "\", ";
  $fields .= "race=\"" . $_POST['race'] . "\", ";
  $fields .= "class=\"" . $_POST['class'] . "\", ";
  $fields .= "bodytype=\"" . $_POST['bodytype'] . "\", ";
  $fields .= "hp=\"" . $_POST['hp'] . "\", ";
  $fields .= "mana=\"" . $_POST['mana'] . "\", ";
  $fields .= "gender=\"" . $_POST['gender'] . "\", ";
  $fields .= "texture=\"" . $_POST['texture'] . "\", ";
  $fields .= "helmtexture=\"" . $_POST['helmtexture'] . "\", ";
  $fields .= "herosforgemodel=\"" . $_POST['herosforgemodel'] . "\", ";
  $fields .= "size=\"" . $_POST['size'] . "\", ";
  $fields .= "hp_regen_rate=\"" . $_POST['hp_regen_rate'] . "\", ";
  $fields .= "hp_regen_per_second=\"" . $_POST['hp_regen_per_second'] . "\", ";
  $fields .= "mana_regen_rate=\"" . $_POST['mana_regen_rate'] . "\", ";
  $fields .= "loottable_id=\"" . $_POST['loottable_id'] . "\", ";
  //merchant_id
  //alt_currency_id
  $fields .= "npc_spells_id=\"" . $_POST['npc_spells_id'] . "\", ";
  //npc_spells_effects_id
  //npc_faction_id
  //adventure_template_id
  $fields .= "trap_template=\"" . $_POST['trap_template'] . "\", ";
  $fields .= "mindmg=\"" . $_POST['mindmg'] . "\", ";
  $fields .= "maxdmg=\"" . $_POST['maxdmg'] . "\", ";
  $fields .= "attack_count=\"" . $_POST['attack_count'] . "\", ";
  //npcspecialattks
  $fields .= "special_abilities=\"$special_abilities\", ";
  $fields .= "aggroradius=\"" . $_POST['aggroradius'] . "\", ";
  $fields .= "assistradius=\"" . $_POST['assistradius'] . "\", ";
  $fields .= "face=\"" . $_POST['face'] . "\", ";
  $fields .= "luclin_hairstyle=\"" . $_POST['luclin_hairstyle'] . "\", ";
  $fields .= "luclin_haircolor=\"" . $_POST['luclin_haircolor'] . "\", ";
  $fields .= "luclin_eyecolor=\"" . $_POST['luclin_eyecolor'] . "\", ";
  $fields .= "luclin_eyecolor2=\"" . $_POST['luclin_eyecolor2'] . "\", ";
  $fields .= "luclin_beardcolor=\"" . $_POST['luclin_beardcolor'] . "\", ";
  $fields .= "luclin_beard=\"" . $_POST['luclin_beard'] . "\", ";
  $fields .= "drakkin_heritage=\"" . $_POST['drakkin_heritage'] . "\", ";
  $fields .= "drakkin_tattoo=\"" . $_POST['drakkin_tattoo'] . "\", ";
  $fields .= "drakkin_details=\"" . $_POST['drakkin_details'] . "\", ";
  //armortint_id
  $fields .= "armortint_red=\"" . $_POST['armortint_red'] . "\", ";
  $fields .= "armortint_green=\"" . $_POST['armortint_green'] . "\", ";
  $fields .= "armortint_blue=\"" . $_POST['armortint_blue'] . "\", ";
  $fields .= "d_melee_texture1=\"" . $_POST['d_melee_texture1'] . "\", ";
  $fields .= "d_melee_texture2=\"" . $_POST['d_melee_texture2'] . "\", ";
  //ammo_idfile
  $fields .= "prim_melee_type=\"" . $_POST['prim_melee_type'] . "\", ";
  $fields .= "sec_melee_type=\"" . $_POST['sec_melee_type'] . "\", ";
  //ranged_type
  $fields .= "runspeed=\"" . $_POST['runspeed'] . "\", ";
  $fields .= "MR=\"" . $_POST['MR'] . "\", ";
  $fields .= "CR=\"" . $_POST['CR'] . "\", ";
  $fields .= "DR=\"" . $_POST['DR'] . "\", ";
  $fields .= "FR=\"" . $_POST['FR'] . "\", ";
  $fields .= "PR=\"" . $_POST['PR'] . "\", ";
  $fields .= "Corrup=\"" . $_POST['Corrup'] . "\", ";
  $fields .= "PhR=\"" . $_POST['PhR'] . "\", ";
  $fields .= "see_invis=\"" . $_POST['see_invis'] . "\", ";
  $fields .= "see_invis_undead=\"" . $_POST['see_invis_undead'] . "\", ";
  $fields .= "qglobal=\"" . $_POST['qglobal'] . "\", ";
  $fields .= "AC=\"" . $_POST['AC'] . "\", ";
  $fields .= "npc_aggro=\"" . $_POST['npc_aggro'] . "\", ";
  $fields .= "spawn_limit=\"" . $_POST['spawn_limit'] . "\", ";
  //attack_speed
  $fields .= "attack_delay=\"" . $_POST['attack_delay'] . "\", ";
  $fields .= "findable=\"" . $_POST['findable'] . "\", ";
  $fields .= "STR=\"" . $_POST['STR'] . "\", ";
  $fields .= "STA=\"" . $_POST['STA'] . "\", ";
  $fields .= "DEX=\"" . $_POST['DEX'] . "\", ";
  $fields .= "AGI=\"" . $_POST['AGI'] . "\", ";
  $fields .= "_INT=\"" . $_POST['_INT'] . "\", ";
  $fields .= "WIS=\"" . $_POST['WIS'] . "\", ";
  $fields .= "CHA=\"" . $_POST['CHA'] . "\", ";
  $fields .= "see_hide=\"" . $_POST['see_hide'] . "\", ";
  $fields .= "see_improved_hide=\"" . $_POST['see_improved_hide'] . "\", ";
  $fields .= "trackable=\"" . $_POST['trackable'] . "\", ";
  //isbot
  //exclude
  $fields .= "ATK=\"" . $_POST['ATK'] . "\", ";
  $fields .= "Accuracy=\"" . $_POST['Accuracy'] . "\", ";
  $fields .= "Avoidance=\"" . $_POST['Avoidance'] . "\", ";
  $fields .= "slow_mitigation=\"" . $_POST['slow_mitigation'] . "\", ";
  $fields .= "version=\"" . $_POST['version'] . "\", ";
  $fields .= "maxlevel=\"" . $_POST['maxlevel'] . "\", ";
  $fields .= "scalerate=\"" . $_POST['scalerate'] . "\", ";
  $fields .= "private_corpse=\"" . $_POST['private_corpse'] . "\", ";
  $fields .= "unique_spawn_by_name=\"" . $_POST['unique_spawn_by_name'] . "\", ";
  $fields .= "underwater=\"" . $_POST['underwater'] . "\", ";
  $fields .= "isquest=\"" . $_POST['isquest'] . "\", ";
  $fields .= "emoteid=\"" . $_POST['emoteid'] . "\", ";
  $fields .= "spellscale=\"" . $_POST['spellscale'] . "\", ";
  $fields .= "healscale=\"" . $_POST['healscale'] . "\", ";
  $fields .= "no_target_hotkey=\"" . $_POST['no_target_hotkey'] . "\", ";
  $fields .= "raid_target=\"" . $_POST['raid_target'] . "\", ";
  //armtexture
  //bracertexture
  //handtexture
  //legtexture
  //feettexture
  $fields .= "light=\"" . $_POST['light'] . "\", ";
  //walkspeed
  //peqid
  //unique_
  //fixed
  $fields .= "ignore_despawn=\"" . $_POST['ignore_despawn'] . "\", ";
  $fields .= "show_name=\"" . $_POST['show_name'] . "\", ";
  //untargetable
  $fields .= "charm_ac=\"" . $_POST['charm_ac'] . "\", ";
  $fields .= "charm_min_dmg=\"" . $_POST['charm_min_dmg'] . "\", ";
  $fields .= "charm_max_dmg=\"" . $_POST['charm_max_dmg'] . "\", ";
  $fields .= "charm_attack_delay=\"" . $_POST['charm_attack_delay'] . "\", ";
  $fields .= "charm_accuracy_rating=\"" . $_POST['charm_accuracy_rating'] . "\", ";
  $fields .= "charm_avoidance_rating=\"" . $_POST['charm_avoidance_rating'] . "\", ";
  $fields .= "charm_atk=\"" . $_POST['charm_atk'] . "\", ";
  $fields .= "skip_global_loot=\"" . $_POST['skip_global_loot'] . "\", ";
  $fields .= "rare_spawn=\"" .$_POST['rare_spawn'] . "\", ";
  $fields .= "stuck_behavior=\"" .$_POST['stuck_behavior'] . "\", ";
  $fields .= "model=\"" .$_POST['model'] . "\", ";
  $fields .= "flymode=\"" .$_POST['flymode'] . "\", ";
  $fields .= "always_aggro=\"" .$_POST['always_aggro'] . "\", ";
  $fields .= "exp_mod=\"" .$_POST['exp_mod'] . "\", ";
  $fields .= "heroic_strikethrough=\"" .$_POST['heroic_strikethrough'] . "\", ";
  $fields .= "faction_amount=\"" .$_POST['faction_amount'] . "\", ";
  $fields .= "keeps_sold_items=\"" .$_POST['keeps_sold_items'] . "\"";

  if ($fields != '') {
    $query = "INSERT INTO npc_types SET $fields";
    $query2 = "UPDATE npc_types SET special_abilities = TRIM(TRAILING '^' FROM special_abilities)";
    $mysql_content_db->query_no_result($query);
    $mysql_content_db->query_no_result($query2);
  }
}

function copy_npc() {
  check_authorization();
  global $mysql_content_db;

  $fields = '';
  $fields .= "id=\"" . $_POST['id']. "\", ";
  $fields .= "name=\"" . $_POST['name'] . " - Copy\", ";
  $fields .= "lastname=\"" . $_POST['lastname'] . "\", ";
  $fields .= "level=\"" . $_POST['level'] . "\", ";
  $fields .= "race=\"" . $_POST['race'] . "\", ";
  $fields .= "class=\"" . $_POST['class'] . "\", ";
  $fields .= "bodytype=\"" . $_POST['bodytype'] . "\", ";
  $fields .= "hp=\"" . $_POST['hp'] . "\", ";
  $fields .= "mana=\"" . $_POST['mana'] . "\", ";
  $fields .= "gender=\"" . $_POST['gender'] . "\", ";
  $fields .= "texture=\"" . $_POST['texture'] . "\", ";
  $fields .= "helmtexture=\"" . $_POST['helmtexture'] . "\", ";
  $fields .= "herosforgemodel=\"" . $_POST['herosforgemodel'] . "\", ";
  $fields .= "size=\"" . $_POST['size'] . "\", ";
  $fields .= "hp_regen_rate=\"" . $_POST['hp_regen_rate'] . "\", ";
  $fields .= "hp_regen_per_second=\"" . $_POST['hp_regen_per_second'] . "\", ";
  $fields .= "mana_regen_rate=\"" . $_POST['mana_regen_rate'] . "\", ";
  $fields .= "loottable_id=\"" . $_POST['loottable_id'] . "\", ";
  $fields .= "merchant_id=\"" . $_POST['merchant_id'] . "\", ";
  $fields .= "alt_currency_id=\"" . $_POST['alt_currency_id'] . "\", ";
  $fields .= "npc_spells_id=\"" . $_POST['npc_spells_id'] . "\", ";
  //npc_spells_effects_id
  $fields .= "npc_faction_id=\"" . $_POST['npc_faction_id'] . "\", ";
  $fields .= "adventure_template_id=\"" . $_POST['adventure_template_id'] . "\", ";
  $fields .= "trap_template=\"" . $_POST['trap_template'] . "\", ";
  $fields .= "mindmg=\"" . $_POST['mindmg'] . "\", ";
  $fields .= "maxdmg=\"" . $_POST['maxdmg'] . "\", ";
  $fields .= "attack_count=\"" . $_POST['attack_count'] . "\", ";
  //npcspecialattks
  $fields .= "special_abilities=\"" . $_POST['special_abilities'] . "\", ";
  $fields .= "aggroradius=\"" . $_POST['aggroradius'] . "\", ";
  $fields .= "assistradius=\"" . $_POST['assistradius'] . "\", ";
  $fields .= "face=\"" . $_POST['face'] . "\", ";
  $fields .= "luclin_hairstyle=\"" . $_POST['luclin_hairstyle'] . "\", ";
  $fields .= "luclin_haircolor=\"" . $_POST['luclin_haircolor'] . "\", ";
  $fields .= "luclin_eyecolor=\"" . $_POST['luclin_eyecolor'] . "\", ";
  $fields .= "luclin_eyecolor2=\"" . $_POST['luclin_eyecolor2'] . "\", ";
  $fields .= "luclin_beardcolor=\"" . $_POST['luclin_beardcolor'] . "\", ";
  $fields .= "luclin_beard=\"" . $_POST['luclin_beard'] . "\", ";
  $fields .= "drakkin_heritage=\"" . $_POST['drakkin_heritage'] . "\", ";
  $fields .= "drakkin_tattoo=\"" . $_POST['drakkin_tattoo'] . "\", ";
  $fields .= "drakkin_details=\"" . $_POST['drakkin_details'] . "\", ";
  $fields .= "armortint_id=\"" . $_POST['armortint_id'] . "\", ";
  $fields .= "armortint_red=\"" . $_POST['armortint_red'] . "\", ";
  $fields .= "armortint_green=\"" . $_POST['armortint_green'] . "\", ";
  $fields .= "armortint_blue=\"" . $_POST['armortint_blue'] . "\", ";
  $fields .= "d_melee_texture1=\"" . $_POST['d_melee_texture1'] . "\", ";
  $fields .= "d_melee_texture2=\"" . $_POST['d_melee_texture2'] . "\", ";
  //ammo_idfile
  $fields .= "prim_melee_type=\"" . $_POST['prim_melee_type'] . "\", ";
  $fields .= "sec_melee_type=\"" . $_POST['sec_melee_type'] . "\", ";
  //ranged_type
  $fields .= "runspeed=\"" . $_POST['runspeed'] . "\", ";
  $fields .= "MR=\"" . $_POST['MR'] . "\", ";
  $fields .= "CR=\"" . $_POST['CR'] . "\", ";
  $fields .= "DR=\"" . $_POST['DR'] . "\", ";
  $fields .= "FR=\"" . $_POST['FR'] . "\", ";
  $fields .= "PR=\"" . $_POST['PR'] . "\", ";
  $fields .= "Corrup=\"" . $_POST['Corrup'] . "\", ";
  $fields .= "PhR=\"" . $_POST['PhR'] . "\", ";
  $fields .= "see_invis=\"" . $_POST['see_invis'] . "\", ";
  $fields .= "see_invis_undead=\"" . $_POST['see_invis_undead'] . "\", ";
  $fields .= "qglobal=\"" . $_POST['qglobal'] . "\", ";
  $fields .= "AC=\"" . $_POST['AC'] . "\", ";
  $fields .= "npc_aggro=\"" . $_POST['npc_aggro'] . "\", ";
  $fields .= "spawn_limit=\"" . $_POST['spawn_limit'] . "\", ";
  //attack_speed
  $fields .= "attack_delay=\"" . $_POST['attack_delay'] . "\", ";
  $fields .= "findable=\"" . $_POST['findable'] . "\", ";
  $fields .= "STR=\"" . $_POST['STR'] . "\", ";
  $fields .= "STA=\"" . $_POST['STA'] . "\", ";
  $fields .= "DEX=\"" . $_POST['DEX'] . "\", ";
  $fields .= "AGI=\"" . $_POST['AGI'] . "\", ";
  $fields .= "_INT=\"" . $_POST['_INT'] . "\", ";
  $fields .= "WIS=\"" . $_POST['WIS'] . "\", ";
  $fields .= "CHA=\"" . $_POST['CHA'] . "\", ";
  $fields .= "see_hide=\"" . $_POST['see_hide'] . "\", ";
  $fields .= "see_improved_hide=\"" . $_POST['see_improved_hide'] . "\", ";
  $fields .= "trackable=\"" . $_POST['trackable'] . "\", ";
  //isbot
  //exclude
  $fields .= "ATK=\"" . $_POST['ATK'] . "\", ";
  $fields .= "Accuracy=\"" . $_POST['Accuracy'] . "\", ";
  $fields .= "Avoidance=\"" . $_POST['Avoidance'] . "\", ";
  $fields .= "slow_mitigation=\"" . $_POST['slow_mitigation'] . "\", ";
  $fields .= "version=\"" . $_POST['version'] . "\", ";
  $fields .= "maxlevel=\"" . $_POST['maxlevel'] . "\", ";
  $fields .= "scalerate=\"" . $_POST['scalerate'] . "\", ";
  $fields .= "private_corpse=\"" . $_POST['private_corpse'] . "\", ";
  $fields .= "unique_spawn_by_name=\"" . $_POST['unique_spawn_by_name'] . "\", ";
  $fields .= "underwater=\"" . $_POST['underwater'] . "\", ";
  $fields .= "isquest=\"" . $_POST['isquest'] . "\", ";
  $fields .= "emoteid=\"" . $_POST['emoteid'] . "\", ";
  $fields .= "spellscale=\"" . $_POST['spellscale'] . "\", ";
  $fields .= "healscale=\"" . $_POST['healscale'] . "\", ";
  $fields .= "no_target_hotkey=\"" . $_POST['no_target_hotkey'] . "\", ";
  $fields .= "raid_target=\"" . $_POST['raid_target'] . "\", ";
  //armtexture
  //bracertexture
  //handtexture
  //legtexture
  //feettexture
  $fields .= "light=\"" . $_POST['light'] . "\", ";
  //walkspeed
  //peqid
  //unique_
  //fixed
  $fields .= "ignore_despawn=\"" . $_POST['ignore_despawn'] . "\", ";
  $fields .= "show_name=\"" . $_POST['show_name'] . "\", ";
  //untargetable
  $fields .= "charm_ac=\"" . $_POST['charm_ac'] . "\", ";
  $fields .= "charm_min_dmg=\"" . $_POST['charm_min_dmg'] . "\", ";
  $fields .= "charm_max_dmg=\"" . $_POST['charm_max_dmg'] . "\", ";
  $fields .= "charm_attack_delay=\"" . $_POST['charm_attack_delay'] . "\", ";
  $fields .= "charm_accuracy_rating=\"" . $_POST['charm_accuracy_rating'] . "\", ";
  $fields .= "charm_avoidance_rating=\"" . $_POST['charm_avoidance_rating'] . "\", ";
  $fields .= "charm_atk=\"" . $_POST['charm_atk'] . "\", ";
  $fields .= "skip_global_loot=\"" . $_POST['skip_global_loot'] . "\", ";
  $fields .= "rare_spawn=\"" . $_POST['rare_spawn'] . "\", ";
  $fields .= "stuck_behavior=\"" . $_POST['stuck_behavior'] . "\", ";
  $fields .= "model=\"" . $_POST['model'] . "\", ";
  $fields .= "flymode=\"" . $_POST['flymode'] . "\", ";
  $fields .= "always_aggro=\"" . $_POST['always_aggro'] . "\", ";
  $fields .= "exp_mod=\"" . $_POST['exp_mod'] . "\", ";
  $fields .= "heroic_strikethrough=\"" . $_POST['heroic_strikethrough'] . "\", ";
  $fields .= "faction_amount=\"" . $_POST['faction_amount'] . "\", ";
  $fields .= "keeps_sold_items=\"" . $_POST['keeps_sold_items'] . "\"";

  if ($fields != '') {
    $query = "INSERT INTO npc_types SET $fields";
    $query2 = "UPDATE npc_types SET special_abilities = TRIM(TRAILING '^' FROM special_abilities)";
    $mysql_content_db->query_no_result($query);
    $mysql_content_db->query_no_result($query2);
  }
}

function update_npc_bytier() {
  global $mysql_content_db, $z, $npcid;

  $zid = getZoneID($z);
  $min_id = $zid*1000-1;
  $max_id = $zid*1000+1000;
  $class = $_POST['class_selected'];
  $race = $_POST['race_selected'];
  $type = $_POST['npcchange_selected'];
  $name = $_POST['npcname'];
  $level = $_POST['npclevel'];
  $stat = $_POST['npcstatchange_selected'];
 
  if ($race == 0) { $nrace = "race"; }
  if ($race > 0) { $nrace = $race; }
  if ($class == 0) { $nclass = "class"; }
  if ($class > 0) { $nclass = $class; }
  if ($name == '') { $nname = "name"; }
  if ($name != '') { $nname = $name; }
  if ($level == '' || $level == 0) { $nlevel = "level"; }
  if ($level > 0) { $nlevel = $level; }

  $npctype = 0;
  if ($_POST['npctype_selected'] == 1) $npctype = 1.0;
  if ($_POST['npctype_selected'] == 2) $npctype = 1.1;
  if ($_POST['npctype_selected'] == 3) $npctype = 1.2;
  if ($_POST['npctype_selected'] == 4) $npctype = 1.35;

  $npcclass = 0;
  if ($_POST['npcclass_selected'] == 1) $npcclass = 1.0;
  if ($_POST['npcclass_selected'] == 2) $npcclass = 1.1;
  if ($_POST['npcclass_selected'] == 3) $npcclass = 1.2;
  if ($_POST['npcclass_selected'] == 4) $npcclass = 1.35;

  $npctier = 0;
  if ($_POST['npctier_selected'] == 1) $npctier = 1.0;
  if ($_POST['npctier_selected'] == 2) $npctier = 1.25;
  if ($_POST['npctier_selected'] == 3) $npctier = 1.75;
  if ($_POST['npctier_selected'] == 4) $npctier = 1.9;
  if ($_POST['npctier_selected'] == 5) $npctier = 2.0;
  if ($_POST['npctier_selected'] == 6) $npctier = 2.5;
  if ($_POST['npctier_selected'] == 7) $npctier = 2.75;
  if ($_POST['npctier_selected'] == 8) $npctier = 3.0;
  if ($_POST['npctier_selected'] == 9) $npctier = 3.15;

  if ($stat == 1) {
    $ac_ = "((((level - 1) / 10.0) * 65.0) + 25.0) * ($npctier * $npctype)";
    $mresist = "MR";
    $cresist = "CR";
    $dresist = "DR";
    $presist = "PR";
    $fresist = "FR";
    $coresist = "Corrup";
  }

  if ($stat == 2) {
    $resist = "(80*0.4) * ($npctier * $npctype * $npcclass)";
    $mresist = $resist;
    $cresist = $resist;
    $dresist = $resist;
    $presist = $resist;
    $fresist = $resist;
    $coresist = $resist;
    $ac_ = "AC";
  }
  
  if ($stat == 3) {
    $ac_ = "((((level - 1) / 10.0) * 65.0) + 25.0) * ($npctier * $npctype)";
    $resist = "(80*0.4) * ($npctier * $npctype * $npcclass)";
    $mresist = $resist;
    $cresist = $resist;
    $dresist = $resist;
    $presist = $resist;
    $fresist = $resist;
    $coresist = $resist;
  }

  if ($type == 1) {
    $query = "UPDATE npc_types SET ac=$ac_, mr=$mresist, cr=$cresist, dr=$dresist, pr=$presist, fr=$fresist, Corrup=$coresist WHERE id=$npcid";
    $mysql_content_db->query_no_result($query);
  }

  if ($type == 2) {
    $query = "SELECT name FROM npc_types WHERE id=$npcid";
    $result = $mysql_content_db->query_assoc($query);
    $nname = $result['name'];

    $query = "UPDATE npc_types SET ac=$ac_, mr=$mresist, cr=$cresist, dr=$dresist, pr=$presist, fr=$fresist, Corrup=$coresist WHERE name=\"$nname\" AND id > $min_id AND id < $max_id";
    $mysql_content_db->query_no_result($query);
  }

  if ($type == 3) {
    $query = "SELECT race FROM npc_types WHERE id=$npcid";
    $result = $mysql_content_db->query_assoc($query);
    $nrace = $result['race'];

    $query = "UPDATE npc_types SET ac=$ac_, mr=$mresist, cr=$cresist, dr=$dresist, pr=$presist, fr=$fresist, Corrup=$coresist WHERE race=$nrace AND id > $min_id AND id < $max_id";
    $mysql_content_db->query_no_result($query);
  }

  if ($type == 4) {
    $query = "SELECT class FROM npc_types WHERE id=$npcid";
    $result = $mysql_content_db->query_assoc($query);
    $nclass = $result['class'];

    $query = "UPDATE npc_types SET ac=$ac_, mr=$mresist, cr=$cresist, dr=$dresist, pr=$presist, fr=$fresist, Corrup=$coresist WHERE class=$nclass AND id > $min_id AND id < $max_id";
    $mysql_content_db->query_no_result($query);
  }

  if ($type == 5) {
    $query = "SELECT level FROM npc_types WHERE id=$npcid";
    $result = $mysql_content_db->query_assoc($query);
    $nlevel = $result['level'];

    $query = "UPDATE npc_types SET ac=$ac_, mr=$mresist, cr=$cresist, dr=$dresist, pr=$presist, fr=$fresist, Corrup=$coresist WHERE level=$nlevel AND id > $min_id AND id < $max_id";
    $mysql_content_db->query_no_result($query);
  }

  if ($type == 6) {
    if ($name == '' && $class == 0 && $race == 0 && ($level == '' || $level == 0)) {
      $query = "UPDATE npc_types SET ac=$ac_, mr=$mresist, cr=$cresist, dr=$dresist, pr=$presist, fr=$fresist, Corrup=$coresist WHERE id=$npcid";
      $mysql_content_db->query_no_result($query);
    }
    if ($name == '' && ($class > 0 || $race > 0 || $level > 0)) {
      $query = "UPDATE npc_types SET ac=$ac_, mr=$mresist, cr=$cresist, dr=$dresist, pr=$presist, fr=$fresist, Corrup=$coresist WHERE name=$nname AND level=$nlevel AND class=$nclass AND race=$nrace AND id > $min_id AND id < $max_id";
      $mysql_content_db->query_no_result($query);
    }
    else {
      $query = "UPDATE npc_types SET ac=$ac_, mr=$mresist, cr=$cresist, dr=$dresist, pr=$presist, fr=$fresist, Corrup=$coresist WHERE name LIKE \"$nname\" AND level=$nlevel AND class=$nclass AND race=$nrace AND id > $min_id AND id < $max_id";
      $mysql_content_db->query_no_result($query);
    }
  }
}

function get_faction_name($id) {
  global $mysql_content_db;

  $query = "SELECT name FROM faction_list WHERE id=$id";
  $result = $mysql_content_db->query_assoc($query);

  return $result['name'];
}

function faction_list() {
  global $mysql_content_db;

  $query = "SELECT id, name FROM faction_list";
  $results = $mysql_content_db->query_mult_assoc($query);

  foreach ($results as $result) {
    $array[$result['id']] = $result['name'];
  }

  return $array;
}

function get_npc_faction_id() {
  global $mysql_content_db, $npcid;

  $query = "SELECT npc_faction_id FROM npc_types WHERE id=$npcid";
  $result = $mysql_content_db->query_assoc($query);

  return $result['npc_faction_id'];
}

function update_npc_faction_id($fid) {
  check_authorization();
  global $mysql_content_db, $npcid;

  $query = "UPDATE npc_types SET npc_faction_id=$fid WHERE id=$npcid";
  $mysql_content_db->query_no_result($query);
}

function change_faction_byname() {
  check_authorization();
  global $mysql_content_db, $npcid, $z;
  $zid = getZoneID($z);
  $min_id = $zid*1000-1;
  $max_id = $zid*1000+1000;
  $npcfid = $_GET['npcfid'];
  $npcname = $_POST['npcname'];
  $updateall = $_POST['updateall'];
 
  if ($updateall == 0) {
    $query = "UPDATE npc_types SET npc_faction_id=$npcfid WHERE name LIKE \"%$npcname%\" AND id > $min_id AND id < $max_id AND npc_faction_id = 0";
    $mysql_content_db->query_no_result($query);
  }

  if ($updateall == 1) {
    $query = "UPDATE npc_types SET npc_faction_id=$npcfid WHERE name LIKE \"%$npcname%\" AND id > $min_id AND id < $max_id";
    $mysql_content_db->query_no_result($query);
  }
}

function change_faction_byrace() {
  check_authorization();
  global $mysql_content_db, $npcid, $z;
  $zid = getZoneID($z);
  $min_id = $zid*1000-1;
  $max_id = $zid*1000+1000;
  $npcfid = $_GET['npcfid'];
  $npcrace = $_POST['npcrace'];
  $updateall = $_POST['updateall'];
 
  if ($updateall == 0) {
    $query = "UPDATE npc_types SET npc_faction_id=$npcfid WHERE race=$npcrace AND id > $min_id AND id < $max_id AND npc_faction_id=0";
    $mysql_content_db->query_no_result($query);
  }

  if ($updateall == 1) {
    $query = "UPDATE npc_types SET npc_faction_id=$npcfid WHERE race=$npcrace AND id > $min_id AND id < $max_id";
    $mysql_content_db->query_no_result($query);
  }
}

function create_npc_faction_id() {
  check_authorization();
  global $mysql_content_db;
  $id = $_POST['id'];
  $name = $_POST['name'];
  $ipa = $_POST['ipa'];

  $query = "INSERT INTO npc_faction SET id=$id, name=\"$name\", ignore_primary_assist=\"$ipa\"";
  $mysql_content_db->query_no_result($query);
}

function search_npc_faction_ids($search) {
  global $mysql_content_db;
  $query = "SELECT id, name FROM npc_faction WHERE name RLIKE \"$search\"";
  $results = $mysql_content_db->query_mult_assoc($query);
  return $results;
}

function search_npc_faction_ids_primary($search) {
  global $mysql_content_db;
  $query = "SELECT nf.id, nf.name, fl.name AS primaryfaction FROM npc_faction nf 
            INNER JOIN faction_list fl ON fl.id=nf.primaryfaction
            WHERE fl.name RLIKE \"$search\";";
  $results = $mysql_content_db->query_mult_assoc($query);
  return $results;
}

function suggest_npc_faction_id() {
  global $mysql_content_db;
  $query = "SELECT MAX(id) AS id FROM npc_faction";
  $result = $mysql_content_db->query_assoc($query);
  return ($result['id'] + 1);
}

function get_npc_faction_id_name() {
  global $mysql_content_db, $npcid;
  $id = get_npc_faction_id($npcid);
  $query = "SELECT * FROM npc_faction WHERE id=$id";
  $result = $mysql_content_db->query_assoc($query);
  return $result;
}

function update_npc_faction_id_name() {
  check_authorization();
  global $mysql_content_db, $npcid;

  $name = $_POST['name'];
  $ipa = $_POST['ipa'];
  $id = get_npc_faction_id($npcid);
  $query = "UPDATE npc_faction SET name=\"$name\", ignore_primary_assist=\"$ipa\" WHERE id=$id";
  $mysql_content_db->query_no_result($query);
}

function search_factions($search) {
  global $mysql_content_db;
  $query = "SELECT id, name FROM faction_list WHERE name RLIKE \"$search\"";
  $results = $mysql_content_db->query_mult_assoc($query);
  return $results;
}

function update_primary_faction() {
  check_authorization();
  global $mysql_content_db, $npcid;
  $id = get_npc_faction_id($npcid);
  $fid = $_GET['fid'];
  $query = "UPDATE npc_faction SET primaryfaction=$fid WHERE id=$id";
  $mysql_content_db->query_no_result($query);
}

function add_faction_hit() {
  check_authorization();
  global $mysql_content_db, $npcid;

  $npc_faction_id = get_npc_faction_id($npcid);
  $fid = $_GET['fid'];
  $value = $_POST['value'];
  $npc_value = $_POST['npc_value'];
  $temp = $_POST['temp'];
  $query = "INSERT INTO npc_faction_entries SET npc_faction_id=$npc_faction_id, faction_id=$fid, value=$value, npc_value=$npc_value, temp=$temp";
  $mysql_content_db->query_no_result($query);
}

function get_factionhit_info() {
  global $mysql_content_db, $npcid;

  $npc_faction_id = $_GET['npc_faction_id'];
  $fid = $_GET['faction_id'];
  $query = "SELECT * FROM npc_faction_entries WHERE npc_faction_id=$npc_faction_id AND faction_id=$fid";
  $result = $mysql_content_db->query_assoc($query);
  $result['name'] = get_faction_name($fid);
  return $result;
}

function update_factionhit() {
  check_authorization();
  global $mysql_content_db;

  $npc_faction_id = $_GET['npc_faction_id'];
  $fid = $_GET['faction_id'];
  $value = $_POST['value'];
  $npc_value = $_POST['npc_value'];
  $temp = $_POST['temp'];
  $query = "UPDATE npc_faction_entries SET value=$value, npc_value=$npc_value, temp=$temp WHERE npc_faction_id=$npc_faction_id AND faction_id=$fid";
  $mysql_content_db->query_no_result($query);
}

function delete_factionhit() {
  check_authorization();
  global $mysql_content_db;

  $npc_faction_id = $_GET['npc_faction_id'];
  $fid = $_GET['faction_id'];

  $query = "DELETE FROM npc_faction_entries WHERE npc_faction_id=$npc_faction_id AND faction_id=$fid";
  $mysql_content_db->query_no_result($query);
}

function suggest_merchant_id() {
  global $mysql_content_db;
  $query = "SELECT MAX(merchantid) AS id FROM merchantlist";
  $result = $mysql_content_db->query_assoc($query);
  
  $query2 = "SELECT MAX(merchant_id) AS npc_mid FROM npc_types";
  $result2 = $mysql_content_db->query_assoc($query2);

  if($result['id'] > $result2['npc_mid']){
    $result = $result['id'] + 1;
  }
  else {
    $result = $result2['npc_mid'] + 1;
  }

  return $result;
}

function suggest_adventure_id() {
  global $mysql_content_db;
  $query = "SELECT MAX(adventure_template_id) AS id FROM npc_types";
  $result = $mysql_content_db->query_assoc($query);
  return ($result['id'] + 1);
}

function suggest_trap_template() {
  global $mysql_content_db;
  $query = "SELECT MAX(trap_template) AS id FROM npc_types";
  $result = $mysql_content_db->query_assoc($query);
  return ($result['id'] + 1);
}

function suggest_dye_template() {
  global $mysql_content_db;
  $query = "SELECT MAX(armortint_id) AS id FROM npc_types";
  $result = $mysql_content_db->query_assoc($query);
  return ($result['id'] + 1);
}

function update_merchant_id() {
  check_authorization();
  global $mysql_content_db, $npcid;
  $merchant_id = $_REQUEST['merchant_id'];
  $query = "UPDATE npc_types SET merchant_id=$merchant_id WHERE id=$npcid";
  $mysql_content_db->query_no_result($query);
}

function update_adventure_id() {
  check_authorization();
  global $mysql_content_db, $npcid;
  $adventure_template_id = $_REQUEST['adventure_template_id'];
  $query = "UPDATE npc_types SET adventure_template_id=$adventure_template_id WHERE id=$npcid";
  $mysql_content_db->query_no_result($query);
}

function update_trap_template() {
  check_authorization();
  global $mysql_content_db, $npcid;
  $trap_template = $_REQUEST['trap_template'];
  $query = "UPDATE npc_types SET trap_template=$trap_template WHERE id=$npcid";
  $mysql_content_db->query_no_result($query);
}

function update_tint() {
  global $mysql_content_db;

  $id = $_POST['id'];
  $red1h = $_POST['red1h'];
  $grn1h = $_POST['grn1h'];
  $blu1h = $_POST['blu1h'];
  $red2c = $_POST['red2c'];
  $grn2c = $_POST['grn2c'];
  $blu2c = $_POST['blu2c'];
  $red3a = $_POST['red3a'];
  $grn3a = $_POST['grn3a'];
  $blu3a = $_POST['blu3a'];
  $red4b = $_POST['red4b'];
  $grn4b = $_POST['grn4b'];
  $blu4b = $_POST['blu4b'];
  $red5g = $_POST['red5g'];
  $grn5g = $_POST['grn5g'];
  $blu5g = $_POST['blu5g'];
  $red6l = $_POST['red6l'];
  $grn6l = $_POST['grn6l'];
  $blu6l = $_POST['blu6l'];
  $red7f = $_POST['red7f'];
  $grn7f = $_POST['grn7f'];
  $blu7f = $_POST['blu7f'];
  $red8x = $_POST['red8x'];
  $grn8x = $_POST['grn8x'];
  $blu8x = $_POST['blu8x'];
  $red9x = $_POST['red9x'];
  $grn9x = $_POST['grn9x'];
  $blu9x = $_POST['blu9x'];

  $query = "UPDATE npc_types_tint SET red1h=\"$red1h\", grn1h=\"$grn1h\", blu1h=\"$blu1h\", red2c=\"$red2c\", grn2c=\"$grn2c\", blu2c=\"$blu2c\", red3a=\"$red3a\", grn3a=\"$grn3a\", blu3a=\"$blu3a\", red4b=\"$red4b\", grn4b=\"$grn4b\", blu4b=\"$blu4b\", red5g=\"$red5g\", grn5g=\"$grn5g\", blu5g=\"$blu5g\", red6l=\"$red6l\", grn6l=\"$grn6l\", blu6l=\"$blu6l\", red7f=\"$red7f\", grn7f=\"$grn7f\", blu7f=\"$blu7f\", red8x=\"$red8x\", grn8x=\"$grn8x\", blu8x=\"$blu8x\", red9x=\"$red9x\", grn9x=\"$grn9x\", blu9x=\"$blu9x\" WHERE id=\"$id\"";
  $mysql_content_db->query_no_result($query);
}

function add_dye_template() {
  check_authorization();
  global $mysql_content_db, $npcid;
  $armortint_id = $_REQUEST['armortint_id'];
  $query = "UPDATE npc_types SET armortint_id=$armortint_id WHERE id=$npcid";
  $mysql_content_db->query_no_result($query);
  
  $query = "INSERT INTO npc_types_tint (id) values ($armortint_id)";
  $mysql_content_db->query_no_result($query);

  $query = "UPDATE npc_types SET armortint_red=0, armortint_green=0, armortint_blue=0 WHERE id=$npcid";
  $mysql_content_db->query_no_result($query);
}

function delete_tint() {
  check_authorization();
  global $mysql_content_db, $npcid;
  
  $id = $_GET['tint_id']; 
  $query = "DELETE FROM npc_types_tint WHERE id=$id";
  $mysql_content_db->query_no_result($query);

  $query = "UPDATE npc_types SET armortint_id=0 WHERE id=$npcid";
  $mysql_content_db->query_no_result($query);
}

function delete_npc() {
  check_authorization();
  global $mysql_content_db, $npcid;

  $query = "DELETE FROM npc_types WHERE id=$npcid";
  $mysql_content_db->query_no_result($query);

  $query = "DELETE FROM spawnentry WHERE npcID=$npcid";
  $mysql_content_db->query_no_result($query);
}

function suggest_npcid() {
  global $mysql_content_db, $z;

  $query = "SELECT zoneidnumber FROM zone WHERE short_name=\"$z\"";
  $result = $mysql_content_db->query_assoc($query);

  if ($result) { // Associated with a zone
    $npczoneid = $result['zoneidnumber'];

    $query = "SELECT id FROM npc_types WHERE id = $npczoneid * 1000";
    $result = $mysql_content_db->query_assoc($query);

    if (!$result) { // Very first id is available
      return $npczoneid * 1000;
    }

    // Find next available id
    $query = "SELECT MIN(n1.id + 1) AS npcid FROM npc_types n1 LEFT JOIN npc_types n2 ON n1.id + 1 = n2.id WHERE n1.id >= $npczoneid * 1000 AND n1.id < $npczoneid * 1000 + 1000 AND n2.id IS NULL";
    $result = $mysql_content_db->query_assoc($query);

    if ($result['npcid'] > 0) {
      return $result['npcid'];
    }
    else {
      return "";
    }
  }
  else { // Not associated with a zone (pet, trigger, chest, etc.)

    $query = "SELECT id FROM npc_types WHERE id = 1";
    $result = $mysql_content_db->query_assoc($query);

    if (!$result) { // Very first id is available
      return 1;
    }

    // Find next available id
    $query = "SELECT MIN(n1.id + 1) AS npcid FROM npc_types n1 LEFT JOIN npc_types n2 ON n1.id + 1 = n2.id WHERE n1.id >= 0 AND n1.id < 1000 AND n2.id IS NULL";
    $result = $mysql_content_db->query_assoc($query);

    if ($result['npcid'] > 0) {
      return $result['npcid'];
    }
    else {
      return "";
    }
  }

}

function tint_info() {
  global $mysql_content_db;

  $tint_id = $_GET['tint_id'];

  $query = "SELECT * FROM npc_types_tint WHERE id=\"$tint_id\"";
  $result = $mysql_content_db->query_assoc($query);
  
  return $result;
}

function next_npcid() {
  global $mysql_content_db, $z;

  $npczoneid = $_POST['npczoneid'];

  $query = "SELECT id FROM npc_types WHERE id = $npczoneid * 1000";
  $result = $mysql_content_db->query_assoc($query);

  if (!$result) { // Very first id is available
    return $npczoneid * 1000;
  }

  // Find next available id
  $query = "SELECT MIN(n1.id + 1) AS npcid FROM npc_types n1 LEFT JOIN npc_types n2 ON n1.id + 1 = n2.id WHERE n1.id >= $npczoneid * 1000 AND n1.id < $npczoneid * 1000 + 1000 AND n2.id IS NULL";
  $result = $mysql_content_db->query_assoc($query);

  if ($result['npcid'] > 0) {
    return $result['npcid'];
  }
  else {
    return "";
  }
}

function get_stats() {
  global $mysql_content_db;
 
  $npc_level = $_POST['npc_level'];
 
  if ($npc_level < 11) {
    $query = "SELECT level, AVG(hp) AS hp, AVG(mana) AS mana, AVG(ac) AS AC, AVG(str) AS stats, AVG(mr) AS resists, AVG(mindmg) AS mindmg, AVG(maxdmg) AS maxdmg, AVG(attack_speed) AS attack_speed, AVG(attack_delay) AS attack_delay FROM npc_types WHERE level=\"$npc_level\" AND name NOT LIKE '#%' AND bodytype < 35 AND bodytype NOT IN (10, 11, 17, 18, 33) AND hp < 1000 AND race != 240 AND str < 300 AND id < 200000 GROUP BY level";
    $results = $mysql_content_db->query_assoc($query);
    return $results;
  }
  if ($npc_level > 10 && $npc_level < 31) {
    $query = "SELECT level, AVG(hp) AS hp, AVG(mana) AS mana, AVG(ac) AS AC, AVG(str) AS stats, AVG(mr) AS resists, AVG(mindmg) AS mindmg, AVG(maxdmg) AS maxdmg, AVG(attack_speed) AS attack_speed, AVG(attack_delay) AS attack_delay FROM npc_types WHERE level=\"$npc_level\" AND name NOT LIKE '#%' AND bodytype < 35 AND bodytype NOT IN (10, 11, 17, 18, 33) AND hp < 2500 AND race != 240 AND str < 300 AND id < 200000 GROUP BY level";
    $results = $mysql_content_db->query_assoc($query);
    return $results;
  }
  if ($npc_level > 30 && $npc_level < 51) {
    $query = "SELECT level, AVG(hp) AS hp, AVG(mana) AS mana, AVG(ac) AS AC, AVG(str) AS stats, AVG(mr) AS resists, AVG(mindmg) AS mindmg, AVG(maxdmg) AS maxdmg, AVG(attack_speed) AS attack_speed, AVG(attack_delay) AS attack_delay FROM npc_types WHERE level=\"$npc_level\" AND name NOT LIKE '#%' AND bodytype < 35 AND bodytype NOT IN (10, 11, 17, 18, 33) AND hp < 5000 AND race != 240 AND str < 300 AND id < 200000 GROUP BY level";
    $results = $mysql_content_db->query_assoc($query);
    return $results;
  }
  if ($npc_level > 50 && $npc_level < 61) {
    $query = "SELECT level, AVG(hp) AS hp, AVG(mana) AS mana, AVG(ac) AS AC, AVG(str) AS stats, AVG(mr) AS resists, AVG(mindmg) AS mindmg, AVG(maxdmg) AS maxdmg, AVG(attack_speed) AS attack_speed, AVG(attack_delay) AS attack_delay FROM npc_types WHERE level=\"$npc_level\" AND name NOT LIKE '#%' AND bodytype < 35 AND bodytype NOT IN (10, 11, 17, 18, 33) AND hp < 7000 AND race != 240 AND str < 300 GROUP BY level";
    $results = $mysql_content_db->query_assoc($query);
    return $results;
  }
  if ($npc_level > 60 && $npc_level < 66) {
    $query = "SELECT level, AVG(hp) AS hp, AVG(mana) AS mana, AVG(ac) AS AC, AVG(str) AS stats, AVG(mr) AS resists, AVG(mindmg) AS mindmg, AVG(maxdmg) AS maxdmg, AVG(attack_speed) AS attack_speed, AVG(attack_delay) AS attack_delay FROM npc_types WHERE level=\"$npc_level\" AND name NOT LIKE '#%' AND bodytype < 35 AND bodytype NOT IN (10, 11, 17, 18, 33) AND hp < 7500 AND race != 240 GROUP BY level";
    $results = $mysql_content_db->query_assoc($query);
    return $results;
  }
  else {
    $query = "SELECT level, AVG(hp) AS hp, AVG(mana) AS mana, AVG(ac) AS AC, AVG(str) AS stats, AVG(mr) AS resists, AVG(mindmg) AS mindmg, AVG(maxdmg) AS maxdmg, AVG(attack_speed) AS attack_speed, AVG(attack_delay) AS attack_delay FROM npc_types WHERE level=\"$npc_level\" AND name NOT LIKE '#%' AND bodytype < 35 AND bodytype NOT IN (10, 11, 17, 18, 33) AND hp < 50000 AND race != 240 GROUP BY level";
    $results = $mysql_content_db->query_assoc($query);
    return $results;
  }
}

function change_npc_level_ver() {
  global $mysql_content_db, $z;
 
  $zid = getZoneID($z);
  $npc_version = $_POST['npc_version'];
  $npc_level = $_POST['npc_level'];
  $minlevel = $zid*1000-1;
  $maxlevel = $zid*1000+1000;
  if($npc_level > -1) {
  $leveldiff = "+$npc_level";
  }
  if($npc_level < 0) {
  $leveldiff = $npc_level;
  }
  $finaldiff = "(level)$leveldiff";
  $finalmaxdiff = "(maxlevel)$leveldiff";
 
  $query = "UPDATE npc_types SET level=$finaldiff WHERE version=$npc_version AND id > $minlevel AND id < $maxlevel AND level > 1";
  $mysql_content_db->query_no_result($query);

  $query = "UPDATE npc_types SET maxlevel=$finalmaxdiff WHERE maxlevel > 0 AND version=$npc_version AND id > $minlevel AND id < $maxlevel";
  $mysql_content_db->query_no_result($query);

  $query = "UPDATE npc_types SET level=1 WHERE version=$npc_version AND level IN (0, 255) AND id > $minlevel AND id < $maxlevel";
  $mysql_content_db->query_no_result($query);

  $query = "UPDATE npc_types SET maxlevel=1 WHERE version=$npc_version AND maxlevel=255 AND id > $minlevel AND id < $maxlevel";
  $mysql_content_db->query_no_result($query);

  $query = "UPDATE npc_types SET maxlevel=1 WHERE version=$npc_version AND maxlevel < 0 AND id > $minlevel AND id < $maxlevel";
  $mysql_content_db->query_no_result($query);
}

function export_sql() {
  global $mysql_content_db, $npcid;
  $export_array = array();

  $query = "SELECT * FROM npc_types WHERE id=$npcid";
  $results = $mysql_content_db->query_assoc($query);

  foreach ($results as $key=>$value) {
    if (isset($table_string)) {
      $table_string .= ", " . $key;
      $value_string .= ", \"" . $value . "\"";
    }
    else {
      $table_string = $key;
      $value_string = "\"" . $value . "\"";
    }
  }
  $export_array['insert'] = "INSERT INTO npc_types ($table_string) VALUES ($value_string);";

  foreach ($results as $key=>$value) {
    if (isset($update_string)) {
      $update_string .= ", " . $key . "=\"" . $value . "\"";
    }
    else {
      $update_string = $key . "=\"" . $value . "\"";
    }
  }
  $export_array['update'] = "UPDATE npc_types SET $update_string WHERE id=\"$npcid\";";

  return($export_array);
}

function get_emotes() {
  global $mysql_content_db, $npcid;
  $emoteid = $_GET['emoteid'];

  $query = "SELECT id, emoteid, event_, type, text FROM npc_emotes WHERE emoteid=$emoteid ORDER BY emoteid, event_";
  $result = $mysql_content_db->query_mult_assoc($query);
  if ($result) {
    foreach ($result as $result) {
     $array['emotes'][$result['id']] = array("id"=>$result['id'], "emoteid"=>$result['emoteid'], "event_"=>$result['event_'], "type"=>$result['type'], "text"=>$result['text']);
    }
  }
  return $array;
}

function delete_emote() {
  check_authorization();
  global $mysql_content_db, $npcid;
  $id = $_GET['id']; 
  $emoteid = $_GET['emoteid']; 

  $query = "DELETE FROM npc_emotes WHERE id=$id";
  $mysql_content_db->query_no_result($query);

  $query = "SELECT COUNT(*) AS emotecount FROM npc_emotes WHERE emoteid=$emoteid";
  $result = $mysql_content_db->query_assoc($query);
  $count = $result['emotecount'];

  if ($count == 0) {
    $query = "UPDATE npc_types SET emoteid=0 WHERE emoteid=$emoteid";
    $mysql_content_db->query_no_result($query);
  }
    
  if ($count != 0) {
    return $emoteid;
  }
  else {
    return 0;
  }
}

function emote_info() {
  global $mysql_content_db;

  $id = $_GET['id'];

  $query = "SELECT id, emoteid, event_, type, text FROM npc_emotes WHERE id=$id";
  $result = $mysql_content_db->query_assoc($query);
  
  return $result;
}

function update_emote() {
  global $mysql_content_db, $npcid;

  $id = $_POST['id'];
  $emoteid = $_POST['emoteid'];
  $oldemote = $_POST['oldemote'];
  $event_ = $_POST['event_']; 
  $type = $_POST['type'];
  $text = $_POST['text'];

  $query = "UPDATE npc_emotes SET emoteid=$emoteid, event_=$event_, type=$type, text=\"$text\" WHERE id=$id";
  $mysql_content_db->query_no_result($query);

  if ($npcid) {
    $query = "UPDATE npc_types SET emoteid=$emoteid WHERE id=$npcid";
    $mysql_content_db->query_no_result($query);
  }

  $query = "SELECT COUNT(*) AS emotecount FROM npc_emotes WHERE emoteid=$oldemote";
  $result = $mysql_content_db->query_assoc($query);
  $count = $result['emotecount'];

  if ($count == 0) {
    $query = "UPDATE npc_types SET emoteid=0 WHERE emoteid=$oldemote";
    $mysql_content_db->query_no_result($query);
  }

  return $emoteid;
}

function add_emote() {
  global $mysql_content_db, $npcid;

  $emoteid = $_POST['emoteid'];
  $event_ = $_POST['event_']; 
  $type = $_POST['type'];
  $text = $_POST['text'];

  $query = "INSERT INTO npc_emotes SET emoteid=$emoteid, event_=$event_, type=$type, text=\"$text\"";
  $mysql_content_db->query_no_result($query);

  if ($npcid) {
    $query = "UPDATE npc_types SET emoteid=$emoteid WHERE id=$npcid";
    $mysql_content_db->query_no_result($query);
  }
}

function suggest_emoteid() {
  global $mysql_content_db, $npcid;

  $query = "SELECT MAX(emoteid)+1 AS maxeid FROM npc_emotes";
  $result = $mysql_content_db->query_assoc($query);
  $maxeid = $result['maxeid'];

  return $maxeid;
}

function get_npcid_from_emote($emoteid) {
  global $mysql_content_db;

  $query = "SELECT id FROM npc_types WHERE emoteid=$emoteid LIMIT 1";
  $result = $mysql_content_db->query_assoc($query);
  $npcid = $result['id'];
  
  return $npcid;
}

function getNPCsByEmote() {
  global $mysql_content_db;
  $emoteid = $_GET['emoteid'];

  $query = "SELECT id, name FROM npc_types WHERE emoteid=$emoteid ORDER BY id";
  $result = $mysql_content_db->query_mult_assoc($query);

  if ($result) {
    return $result;
  }
  else {
    return null;
  }
}

function getExistingEmoteEvents($emoteid) {
  global $mysql_content_db;
  $events = array();

  $query = "SELECT event_ FROM npc_emotes WHERE emoteid=$emoteid";
  $result = $mysql_content_db->query_mult_assoc($query);

  if ($result) {
    foreach ($result as $result) {
      array_push($events, $result['event_']);
    }
  }

  return $events;
}

function setExistingEmote($npcid, $emoteid) {
  global $mysql_content_db;

  $query = "UPDATE npc_types SET emoteid=$emoteid WHERE id=$npcid";
  $mysql_content_db->query_no_result($query);
}

function list_emotes($page_number, $results_per_page, $sort_by, $where = "") {
  global $mysql_content_db;
  $limit = ($page_number - 1) * $results_per_page . "," . $results_per_page;

  $query = "SELECT * FROM npc_emotes";
  if ($where) {
    $query .= " WHERE $where";
  }
  $query .= " ORDER BY $sort_by LIMIT $limit";
  $results = $mysql_content_db->query_mult_assoc($query);

  return $results;
}

function build_filter() {
  global $npcid, $z;
  $zid = getZoneID($z);
  $filter1 = $_GET['filter1'];
  $filter2 = $_GET['filter2'];
  $filter3 = $_GET['filter3'];
  $filter4 = $_GET['filter4'];
  $filter_final = array();

  if ($filter1) { // Filter by emoteid
    $filter_emoteid = "emoteid = '" . $filter1 . "'";
    $filter_final['sql'] = $filter_emoteid;
  }
  if ($filter2 != '') { // Filter by type
    $filter_type = "type = '" . $filter2 . "'";
    if ($filter_final['sql']) {
      $filter_final['sql'] .= " AND ";
    }
    $filter_final['sql'] .= $filter_type;
  }
  if ($filter3 != '') { // Filter by event
    $filter_event = "event_ = '" . $filter3 . "'";
    if ($filter_final['sql']) {
      $filter_final['sql'] .= " AND ";
    }
    $filter_final['sql'] .= $filter_event;
  }
  if ($filter4) { // Filter by text
    $filter_text = "text LIKE '%" . $filter4 . "%'";

    if ($filter_final['sql']) {
      $filter_final['sql'] .= " AND ";
    }
    $filter_final['sql'] .= $filter_text;
  }

  $filter_final['url'] = "&filter=on&filter1=$filter1&filter2=$filter2&filter3=$filter3&filter4=$filter4";
  $filter_final['status'] = "on";
  $filter_final['filter1'] = $filter1;
  $filter_final['filter2'] = $filter2;
  $filter_final['filter3'] = $filter3;
  $filter_final['filter4'] = $filter4;

  return $filter_final;
}

function get_beastlord_pets() {
  global $mysql_content_db;

  $query = "SELECT * FROM pets_beastlord_data";
  $results = $mysql_content_db->query_mult_assoc($query);

  if ($results) {
    return $results;
  }
  else {
    return null;
  }
}

function get_beastlord_pet($player_race) {
  global $mysql_content_db;

  $query = "SELECT * FROM pets_beastlord_data WHERE player_race=$player_race";
  $result = $mysql_content_db->query_assoc($query);

  if ($result) {
    return $result;
  }
  else {
    return null;
  }  
}

function insert_beastlord_pet() {
  global $mysql_content_db;

  $player_race = $_POST['player_race'];
  $pet_race = $_POST['pet_race'];
  $texture = $_POST['texture'];
  $helm_texture = $_POST['helm_texture'];
  $gender = $_POST['gender'];
  $size_modifier = $_POST['size_modifier'];
  $face = $_POST['face'];

  $query = "REPLACE INTO pets_beastlord_data SET player_race=$player_race, pet_race=$pet_race, texture=$texture, helm_texture=$helm_texture, gender=$gender, size_modifier=$size_modifier, face=$face";
  $mysql_content_db->query_no_result($query);
}

function delete_beastlord_pet($player_race) {
  global $mysql_content_db;

  $query = "DELETE FROM pets_beastlord_data WHERE player_race=$player_race";
  $mysql_content_db->query_no_result($query);
}

function get_npc_scaling() {
  global $mysql_content_db;

  $query = "SELECT * FROM npc_scale_global_base ORDER BY type, level, zone_id_list, instance_version_list";
  $results = $mysql_content_db->query_mult_assoc($query);

  if ($results) {
    return $results;
  }
  else {
    return null;
  }
}

function get_npc_scale($type, $level, $zone_id_list, $instance_version_list) {
  global $mysql_content_db;

  $query = "SELECT * FROM npc_scale_global_base WHERE type=$type AND level=$level AND zone_id_list=\"$zone_id_list\" AND instance_version_list=\"$instance_version_list\"";
  $result = $mysql_content_db->query_assoc($query);

  if ($result) {
    return $result;
  }
  else {
    return null;
  }
}

function insert_npc_scale() {
  global $mysql_content_db, $specialattacks;

  $special = "";
  foreach ($specialattacks as $k => $v) {
    if (isset($_POST["$k"])) {
      if (SUBSTR($_POST["$k"], -1) != '^' && $_POST["$k"] != '') {
        $_POST["$k"].= '^';
      }
      $special .= $_POST["$k"];
    }
  }
  rtrim($special, '^');

  $type = $_POST['type'];
  $level = $_POST['level'];
  $zone_id_list = $_POST['zone_id_list'];
  $instance_version_list = $_POST['instance_version_list'];
  $ac = $_POST['ac'];
  $hp = $_POST['hp'];
  $accuracy = $_POST['accuracy'];
  $slow_mitigation = $_POST['slow_mitigation'];
  $attack = $_POST['attack'];
  $strength = $_POST['strength'];
  $stamina = $_POST['stamina'];
  $dexterity = $_POST['dexterity'];
  $agility = $_POST['agility'];
  $intelligence = $_POST['intelligence'];
  $wisdom = $_POST['wisdom'];
  $charisma = $_POST['charisma'];
  $magic_resist = $_POST['magic_resist'];
  $cold_resist = $_POST['cold_resist'];
  $fire_resist = $_POST['fire_resist'];
  $poison_resist = $_POST['poison_resist'];
  $disease_resist = $_POST['disease_resist'];
  $corruption_resist = $_POST['corruption_resist'];
  $physical_resist = $_POST['physical_resist'];
  $min_dmg = $_POST['min_dmg'];
  $max_dmg = $_POST['max_dmg'];
  $hp_regen_rate = $_POST['hp_regen_rate'];
  $hp_regen_per_second = $_POST['hp_regen_per_second'];
  $attack_delay = $_POST['attack_delay'];
  $spell_scale = $_POST['spell_scale'];
  $heal_scale = $_POST['heal_scale'];
  $avoidance = $_POST['avoidance'];
  $heroic_strikethrough = $_POST['heroic_strikethrough'];
  $special_abilities = $special;

  $query = "INSERT INTO npc_scale_global_base SET type=$type, level=$level, zone_id_list=\"$zone_id_list\", instance_version_list=\"$instance_version_list\", ac=$ac, hp=$hp, accuracy=$accuracy, slow_mitigation=$slow_mitigation, attack=$attack, strength=$strength, stamina=$stamina, dexterity=$dexterity, agility=$agility, intelligence=$intelligence, wisdom=$wisdom, charisma=$charisma, magic_resist=$magic_resist, cold_resist=$cold_resist, fire_resist=$fire_resist, poison_resist=$poison_resist, disease_resist=$disease_resist, corruption_resist=$corruption_resist, physical_resist=$physical_resist, min_dmg=$min_dmg, max_dmg=$max_dmg, hp_regen_rate=$hp_regen_rate, hp_regen_per_second=$hp_regen_per_second, attack_delay=$attack_delay, spell_scale=$spell_scale, heal_scale=$heal_scale, avoidance=$avoidance, heroic_strikethrough=$heroic_strikethrough, special_abilities=\"$special_abilities\"";
  $mysql_content_db->query_no_result($query);
}

function update_npc_scale() {
  global $mysql_content_db, $specialattacks;

  $special = "";
  foreach ($specialattacks as $k=>$v) {
    if (isset($_POST["$k"])) {
      if (SUBSTR($_POST["$k"], -1) != '^' && $_POST["$k"] != '') {
        $_POST["$k"].= '^';
      }
      $special .= $_POST["$k"];
    }
  }
  rtrim($special, '^');

  $old_type = $_POST['old_type'];
  $old_level = $_POST['old_level'];
  $old_zone_id_list = $_POST['old_zone_id_list'];
  $old_instance_version_list = $_POST['old_instance_version_list'];
  $type = $_POST['type'];
  $level = $_POST['level'];
  $zone_id_list = $_POST['zone_id_list'];
  $instance_version_list = $_POST['instance_version_list'];
  $ac = $_POST['ac'];
  $hp = $_POST['hp'];
  $accuracy = $_POST['accuracy'];
  $slow_mitigation = $_POST['slow_mitigation'];
  $attack = $_POST['attack'];
  $strength = $_POST['strength'];
  $stamina = $_POST['stamina'];
  $dexterity = $_POST['dexterity'];
  $agility = $_POST['agility'];
  $intelligence = $_POST['intelligence'];
  $wisdom = $_POST['wisdom'];
  $charisma = $_POST['charisma'];
  $magic_resist = $_POST['magic_resist'];
  $cold_resist = $_POST['cold_resist'];
  $fire_resist = $_POST['fire_resist'];
  $poison_resist = $_POST['poison_resist'];
  $disease_resist = $_POST['disease_resist'];
  $corruption_resist = $_POST['corruption_resist'];
  $physical_resist = $_POST['physical_resist'];
  $min_dmg = $_POST['min_dmg'];
  $max_dmg = $_POST['max_dmg'];
  $hp_regen_rate = $_POST['hp_regen_rate'];
  $hp_regen_per_second = $_POST['hp_regen_per_second'];
  $attack_delay = $_POST['attack_delay'];
  $spell_scale = $_POST['spell_scale'];
  $heal_scale = $_POST['heal_scale'];
  $avoidance = $_POST['avoidance'];
  $heroic_strikethrough = $_POST['heroic_strikethrough'];
  $special_abilities = $special;

  $query = "UPDATE npc_scale_global_base SET type=$type, level=$level, zone_id_list=\"$zone_id_list\", instance_version_list=\"$instance_version_list\", ac=$ac, hp=$hp, accuracy=$accuracy, slow_mitigation=$slow_mitigation, attack=$attack, strength=$strength, stamina=$stamina, dexterity=$dexterity, agility=$agility, intelligence=$intelligence, wisdom=$wisdom, charisma=$charisma, magic_resist=$magic_resist, cold_resist=$cold_resist, fire_resist=$fire_resist, poison_resist=$poison_resist, disease_resist=$disease_resist, corruption_resist=$corruption_resist, physical_resist=$physical_resist, min_dmg=$min_dmg, max_dmg=$max_dmg, hp_regen_rate=$hp_regen_rate, hp_regen_per_second=$hp_regen_per_second, attack_delay=$attack_delay, spell_scale=$spell_scale, heal_scale=$heal_scale, avoidance=$avoidance, heroic_strikethrough=$heroic_strikethrough, special_abilities=\"$special_abilities\" WHERE type=$old_type AND level=$old_level AND zone_id_list=$old_zone_id_list AND instance_version_list=$old_instance_version_list";
  $mysql_content_db->query_no_result($query);
}

function delete_npc_scale($type, $level, $zone_id_list, $instance_version_list) {
  global $mysql_content_db;

  $query = "DELETE FROM npc_scale_global_base WHERE type=$type AND level=$level AND zone_id_list=$zone_id_list AND instance_version_list=$instance_version_list";
  $mysql_content_db->query_no_result($query);
}
?>