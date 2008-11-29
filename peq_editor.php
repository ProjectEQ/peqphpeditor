<?php

  global $page,$races,$classes,$zone,$var,$var2,$guest,$npc,$fid,$filter,$number,$number2,$number3,$loot,$action,$action2,$user,$logging,$log_dir,$database;
  
  session_start();
  
  require_once("peq_lib/data.php");  // Specifies all races and classes in $races and $classes
  include("config.ini");  // Load user settings
  require_once("peq_lib/database.php");
  include("peq_lib/login.php");  // Load login-related functions

  if ($logging == 1) {
    require_once("peq_lib/logging.php");
  }
    
  $database = new database();

  login();
  
  $page = $_REQUEST['page'];
  $var = $_REQUEST['var'];
  $var2 = $_REQUEST['var2'];
  $npc = $_REQUEST['npc'];
  $fid = $_REQUEST['fid'];
  $filter = $_REQUEST['f'];
  $number = $_REQUEST['n'];
  $number2 = $_REQUEST['n2'];
  $number3 = $_REQUEST['n3'];
  $loot = $_REQUEST['l'];
  $action = $_REQUEST['action'];
  $action2 = $_REQUEST['action2'];
  $user = $_SESSION['user'];
  $zone = $_REQUEST['z'];
  
  if (!isset($page)) {
    $page = 1;
  }

  if (!$action) {
	if ($_SESSION['logged_in'] != "TRUE") {
		$action=30;
	}
	else {
	  $action=17;
	}
  }

  if ($action) {
	switch ( $action ) {
	case 1: // Change NPC
		require_once("peq_lib/npc.php");
		npc_edit();
		break;
	case 2: // Change NPC Spawngroup
		require_once("peq_lib/spawn.php");
		change_spawn_group();
		break;
	case 3: // Change NPC MerchantID
		require_once("peq_lib/npc.php");
		change_merchant_id();
		break;
	case 4: // Change NPC Respawn Timer
		require_once("peq_lib/spawn.php");
		change_npc_respawn();
		break;
	case 5: // Change LootTable Entry (Probability and Multiplier)
		require_once("peq_lib/loot.php");
		change_loottable_numbers();
		break;
	case 6: // Change LootDrop Entry (ItemID, Equipped and Chance)
		require_once("peq_lib/loot.php");
		change_lootdrop_entry();
		break;
	case 7: // Drop Lootdrop Table
		require_once("peq_lib/loot.php");
		delete_lootdrop_table();
		break;
	case 8: // Drop an Item from LootDrop
		require_once("peq_lib/loot.php");
		delete_loot_drop();
		break;
	case 9: // UPDATE NPC_FACTION_IDS
		require_once("peq_lib/faction.php");
		change_npc_faction();
		break;
	case 10: // UPDATE PRIMARYFACTIONS
		require_once("peq_lib/faction.php");
		change_npc_primary_faction();
		break;
	case 11: // DELETE NPC COMPLETELY!
		require_once("peq_lib/npc.php");
		delete_npc();
		break;
	case 12: // UPDATE ALL RESPAWN TIMERS
		require_once("peq_lib/spawn.php");
		update_all_respawn_timers();
		break;
	case 13: // ADD AN ITEM TO LOOTTABLE
		require_once("peq_lib/loot.php");
		add_lootdrop_entry();
		break;
	case 14: // ADD A LOOTDROP TABLE
		require_once("peq_lib/loot.php");
		add_loot_table();
		break;
	case 15: // BALANCE CHANCE CALCULATIONS (Spawn and Loot)
		require_once("peq_lib/loot.php");
		balance_table_chances();
		break;
	case 16: // CREATE LOOTDROP TABLE
		require_once("peq_lib/loot.php");
		create_loot_drop();
		break;
	case 17: // Display Main Page
		main_page();
		break;
	case 18: // LOOTEDITOR
		require_once("peq_lib/loot.php");
		loot_editor();
		break;
	case 19: // GUEST ONLY! Looteditor
		require_once("peq_lib/loot.php");
		loot_editor();
		break;
	case 20: // NPCEDITOR
		require_once("peq_lib/npc.php");
		npc_editor();
		break;
	case 21: // GUEST ONLY NPCEDITOR
		require_once("peq_lib/npc.php");
		npc_editor();	
		break;
	case 22: // Spawneditor
		require_once("peq_lib/spawn.php");
		spawn_editor();
		break;
	case 23: // Guest Only Spawneditor
		require_once("peq_lib/spawn.php");
		spawn_editor();
		break;
	case 24: // Merchanteditor
		require_once("peq_lib/merchant.php");
		merchant_editor();
		break;
	case 25: // GUEST ONLY Merchanteditor
		require_once("peq_lib/merchant.php");
		merchant_editor();
		break;
	case 26: // FACTION EDITOR
		require_once("peq_lib/faction.php");
		faction_editor();
		break;
	case 27: // GUEST-ONLY FACTION EDITOR
		require_once("peq_lib/faction.php");
		faction_editor();
		break;
	case 28: // EDIT FACTIONS
		require_once("peq_lib/faction.php");
		edit_factions();
		break;
	case 29: // UPDATE A FACTION'S PRIMARYFACTION
		require_once("peq_lib/npc.php");
		change_faction_primary_faction();
		break;	
	case 30: // LOGIN PAGE
		login_page();
		break;
	case 31: // CHANGE LOOTTABLE
		require_once("peq_lib/loot.php");
		change_npc_loottable();
		break;
	case 32: // CREATE LOOTTABLE
		require_once("peq_lib/loot.php");
		create_loot_table();
		break;
	case 33: // Change SpawnEntry (Chance)
		require_once("peq_lib/spawn.php");
		change_spawn_chance();
		break;
	case 34: // DROP NPC FROM SPAWNGROUP
		require_once("peq_lib/spawn.php");
		remove_spawn_npc();
		break;
	case 35: // ADD AN NPC TO SPAWNGROUP
		require_once("peq_lib/spawn.php");
		add_spawn_npc();
		break;
	case 36: // Remove NPC Spawngroup
		require_once("peq_lib/spawn.php");
		remove_spawn_group();
		break;
	case 37: // Transfer NPC loot to Merchant Stock
		require_once("peq_lib/merchant.php");
		transfer_merchant_loot();
		break;
	case 38: // Merge Spawngroups
		require_once("peq_lib/spawn.php");
		merge_spawn_groups();
		break;
	case 39: // View NPC spell sets
		require_once("peq_lib/spell.php");
		spells_editor();
		break;
	case 40: // Create a new spell set for an NPC
		require_once("peq_lib/spell.php");
		create_spells_table();
		break;
	case 41: // Delete a spell set, NOT WRITTEN
		require_once("peq_lib/spell.php");
		delete_spells_table();
		break;
	case 42: // Duplicate a spell set
		require_once("peq_lib/spell.php");
		duplicate_spells_table();
		break;
	case 43: // Add a spell entry
		require_once("peq_lib/spell.php");
		add_spell_entry();
		break;
	case 44: // Delete a spell entry
		require_once("peq_lib/spell.php");
		delete_spell_entry();
		break;
	case 45: // edit a spell entry
		require_once("peq_lib/spell.php");
		edit_spell_entry();
		break;
	case 46: // edit a spell list
		require_once("peq_lib/spell.php");
		edit_spell_list();
		break;
	case 47: // change an npc's spell set
		require_once("peq_lib/spell.php");
		change_npc_spells();
		break;
	case 48: // View NPC spell sets
		require_once("peq_lib/spell.php");
		guest_spells_editor();
		break;
	case 49: // Recipes Editor
		require_once("peq_lib/tradeskill.php");
		tradeskill_editor();
		break;
	case 50: // Guest Recipes Editor
		require_once("peq_lib/tradeskill.php");
		guest_tradeskill_editor();
		break;
	case 51: // Create a new recipe
		require_once("peq_lib/tradeskill.php");
		create_recipe();
		break;
	case 52: // View A specific recipe
		require_once("peq_lib/tradeskill.php");
		view_recipe();
		break;
	case 53: // Add recipe entry
		require_once("peq_lib/tradeskill.php");
		add_recipe_entry();
		break;
	case 54: // Delete recipe entry
		require_once("peq_lib/tradeskill.php");
		delete_recipe_entry();
		break;
	case 55: // Edit recipe entry
		require_once("peq_lib/tradeskill.php");
		edit_recipe_entry();
		break;
	case 56: // Edit Recipe
		require_once("peq_lib/tradeskill.php");
		edit_recipe();
		break;
	case 57: // Remove a LootDrop from its LootTable
		require_once("peq_lib/loot.php");
		remove_lootdrop_from_loottable();
		break;
	case 58: // Edit a Loottable
		require_once("peq_lib/loot.php");
		edit_loottable();
		break;
	case 59: // Delete a LootTable
		require_once("peq_lib/loot.php");
		delete_loottable();
		break;
	case 60: // Add a new NPC
		require_once("peq_lib/npc.php");
		add_npc();
		break;
	case 61: // Change Lootdrop Name
		require_once("peq_lib/loot.php");
		change_lootdrop_name();
		break;
	case 62: // Change npc_faction_id
		require_once("peq_lib/npc.php");
		change_npc_faction_id();
		break;
	case 63: // Change npc_faction_id
		require_once("peq_lib/npc.php");
		change_npc_faction_name();
		break;
	case 64: // Delete a Tradeskill Recipe
		require_once("peq_lib/tradeskill.php");
		delete_recipe();
		break;
	case 65: // Add Spawngroup
		require_once("peq_lib/spawn.php");
		add_spawngroup();
		break;
	case 66: // Add Spawn Location
		require_once("peq_lib/spawn.php");
		add_spawn_location();
		break;
	case 67: // Delete Spawn Location
		require_once("peq_lib/spawn.php");
		delete_spawn_location();
		break;
	case 68: // Delete Spawngroup
		require_once("peq_lib/spawn.php");
		delete_spawngroup();
		break;
	case 70: // EDIT A FACTION HIT
		require_once("peq_lib/npc.php");
		change_faction_hit();
		break;
	case 71: // ADD A FACTION HIT
		require_once("peq_lib/npc.php");
		add_faction_hit();
		break;
	case 72: // DELETE A FACTION HIT
		require_once("peq_lib/faction.php");
		delete_faction_hit();
		break;
	case 73: // EDIT A MERCHANT
	    require_once("peq_lib/merchant.php");
		edit_merchant();
		break;
	case 74: // EDIT A SPAWNGROUP LOCATION
	    require_once("peq_lib/spawn.php");
		spawn_edit();
		break;
	case 90:
		require_once("peq_lib/searches.php");
		do_merchant_search();
		break;
	case 91:
		require_once("peq_lib/searches.php");
		do_loot_search();
		break;
	case 92:
		require_once("peq_lib/searches.php");
		do_mob_search();
		break;
	case 420: // LOG-OUT
		$_SESSION['logged_in'] = "FALSE";
		header("Location: peq_editor.php?action=30");
	break;
	}
	
	echo "<br></div></div></body></html>";
  }

  if ($filter==1) {
	
  }
  elseif ($filter==2) {
	$query = "SELECT npc_types.id AS id,npc_types.name AS name,npc_types.merchant_id AS merchant,spawn2.respawntime AS respawn, spawnentry.spawngroupID AS spawngroup FROM npc_types,spawnentry,spawn2,spawngroup WHERE (spawn2.spawngroupid=spawnentry.spawngroupid AND (spawngroup.id=spawnentry.spawngroupID) AND npc_types.id=spawnentry.npcid) AND spawn2.zone = '$zone' GROUP BY spawnentry.spawngroupID ORDER BY spawnentry.spawngroupID ASC";
  }
  elseif ($filter==3) {
	$query = "SELECT npc_types.id AS id,npc_types.name AS name,npc_types.merchant_id AS merchant,spawn2.respawntime AS respawn, spawnentry.spawngroupID AS spawngroup FROM npc_types,spawnentry,spawn2,spawngroup WHERE (spawn2.spawngroupid=spawnentry.spawngroupid AND (spawngroup.id=spawnentry.spawngroupID) AND npc_types.id=spawnentry.npcid) AND spawn2.zone = '$zone' ORDER BY spawnentry.spawngroupID ASC";
  }
  elseif ($filter==4) {
	$query = "SELECT npc_types.id AS id,npc_types.npc_faction_id AS faction, npc_faction.primaryfaction AS faction2,npc_types.name AS name,npc_types.merchant_id AS merchant,spawn2.respawntime AS respawn, spawnentry.spawngroupID AS spawngroup FROM npc_types,spawnentry,spawn2,spawngroup,npc_faction WHERE (spawn2.spawngroupid=spawnentry.spawngroupid AND (spawngroup.id=spawnentry.spawngroupID) AND npc_types.id=spawnentry.npcid AND npc_types.npc_faction_id=npc_faction.id) AND spawn2.zone = '$zone' ORDER BY npc_types.npc_faction_id ASC";
  }
  else {
	$query = "SELECT npc_types.id AS id,npc_types.name AS name,npc_types.merchant_id AS merchant,spawn2.respawntime AS respawn, spawnentry.spawngroupID AS spawngroup FROM npc_types,spawnentry,spawn2 WHERE (spawn2.spawngroupid=spawnentry.spawngroupid AND npc_types.id=spawnentry.npcid) AND spawn2.zone = '$zone' GROUP BY npc_types.id ORDER BY npc_types.name ASC";
  }


function main_page() {

  global $page,$races,$classes,$zone,$var,$var2,$guest,$npc,$fid,$filter,$number,$number2,$number3,$loot,$action,$action2,$user,$logging,$log_dir,$database;

  include('header2.php');
  
  echo "<div id=\"content\">";
  
  echo "<div class=\"page_title\"><span><br>Project Everquest Online Editing Interface</span></div>
		  <b>Why was this created?</b><br>
		  <blockquote>
		  Current editors in the EQEmu community tend to suffer from a number of problems: first, they (generally) only 
		  allow editing of one part of the database (loot, npcs, etc); they have to be compiled seperately for 
		  Windows and Linux; and the casual user isn't able to edit the source and make contributions.<br><br>
		  
		  This editor solves all those problems: it has many editors, both Windows and Linux users can make use of it, 
		  and PHP is more widely known than C++.
		  </blockquote><br>
		  
		  <b>Who made this?</b><br>
		  <blockquote>
		  Sotoninx first started this editor and put all the original functionality in place.  FatherNitwit later 
		  added the tradeskill and spells editors.  Then I came along and cleaned up the code, improved the user 
		  interface, and added a lot of functionality to the editors.
		  </blockquote><br>
		  
		  <b>What's yet to come?</b><br>
		  <blockquote>
		  The editor is still in its beta phase.  Expect frequent updates in the near future.  The plan is to add a few 
		  more editors at some point: a spawn condition and event editor, an item editor, and maybe a door editor. 
		  Also, I intend to continue cleaning up the code and improving the layout of the editor as a whole.
		  </blockquote><br>
		  
		  <b>How can you help?</b><br>
		  <blockquote>
		  Report any bugs you find and submit any suggestions or feature requests you have.  Feel free to improve upon 
		  the editor's code and submit to me to be put in.
		  </blockquote><br>
		  
		  -mystic414</div>";

}

function login_page() {

  global $page,$races,$classes,$zone,$var,$var2,$guest,$npc,$fid,$filter,$number,$number2,$number3,$loot,$action,$action2,$user,$logging,$log_dir,$database, $login_name, $login_pw;

  include('header2.php');

  echo "<div id=\"content\">";
  
  echo "<div class=\"page_title\"><span><br>Project Everquest Database Editing Interface</span></div><br><br>
	  <form action=\"peq_editor.php\" method=\"post\">
	  <input type=\"hidden\" name=\"login_page\" value=\"login\">
	  <input type=\"hidden\" name=\"z\" value=\"$zone\">
	  <input type=\"hidden\" name=\"action\" value=\"$action\">
	  <input type=\"hidden\" name=\"action2\" value=\"$action2\">
	  <table width=\"250\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" align=\"center\">
		<tr>
	 	  <td align=\"left\"><font size=\"2\">Login:</font></td>
		  <td align=\"right\"><input type=\"text\" name=\"login\"  size=\"15\" value=\"$login_name\"></td>
		</tr>
		<tr>
		  <td align=\"left\"><font size=\"2\">Password:</font></td>
		  <td align=\"right\"><input type=\"password\" name=\"password\" size=\"15\" value=\"$login_pw\"/></td>
		</tr>
		<tr>
		  <td colspan=\"2\" align=\"center\"><br><br><input type=\"submit\" name=\"submit\" value=\"Log-in\"></td>
		</tr>
		<tr>
		  <td colspan=\"2\" align=\"center\"><br><div class=\"table\"><a href=\"peq_editor.php?guest=login\">Click here to login as a guest</a></div></td>
		</tr>
	  </table>
	  </p></div></div>";
}

?>
