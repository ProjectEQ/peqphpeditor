<?
$stances = array(
  0 => "Unknown",
  1 => "Passive",
  2 => "Balanced",
  3 => "Efficient",
  4 => "Reactive",
  5 => "Aggressive",
  6 => "Assist",
  7 => "Burn",
  8 => "Efficient2",
  9 => "Burn AE"
);

$spell_stances = array(
  0 => "ALL",
  1 => "ONLY Passive",
  2 => "ONLY Balanced",
  3 => "ONLY Efficient",
  4 => "ONLY Reactive",
  5 => "ONLY Aggressive",
  6 => "ONLY Assist",
  7 => "ONLY Burn",
  8 => "ONLY Efficient2",
  9 => "ONLY Burn AE",
  -1 => "ALL BUT Passive",
  -2 => "ALL BUT Balanced",
  -3 => "ALL BUT Efficient",
  -4 => "ALL BUT Reactive",
  -5 => "ALL BUT Aggressive",
  -6 => "ALL BUT Assist",
  -7 => "ALL BUT Burn",
  -8 => "ALL BUT Efficient2",
  -9 => "ALL BUT Burn AE"
);

$special_abilities_max = count($specialattacks);

switch ($action) {
  case 0: // Default Merc Options
    $body = new Template("templates/mercs/mercs.default.tmpl.php");
    break;
  case 1: // View Mercs
    $breadcrumbs .= " >> Mercs";
    $body = new Template("templates/mercs/mercs.view.tmpl.php");
    $mercs = array();
    if (isset($_GET['OwnerCharacterID'])) { // View Mercs by Owner
      $breadcrumbs .= " >> Owner: " . get_player_name($_GET['OwnerCharacterID']);
      $mercs = get_player_mercs($_GET['OwnerCharacterID']);
    }
    else {
      $mercs = get_mercs();
    }
    if ($mercs) { // View all Mercs
      $body->set('mercs', $mercs);
    }
    break;
  case 2: // Add Merc
    check_authorization();
    $breadcrumbs .= " >> <a href='index.php?editor=mercs&action=1'>Mercs</a> >> Add Merc";
    $javascript = new Template("templates/mercs/js.tmpl.php");
    $body = new Template("templates/mercs/merc.add.tmpl.php");
    $body->set('suggest_id', suggest_merc_id());
    $body->set('stances', $stances);
    break;
  case 3: // Insert Merc
    check_authorization();
    insert_merc();
    header("Location: index.php?editor=mercs&action=1");
    exit;
  case 4: // Edit Merc
    check_authorization();
    $breadcrumbs .= " >> <a href='index.php?editor=mercs&action=1'>Mercs</a> >> Edit Merc";
    $javascript = new Template("templates/mercs/js.tmpl.php");
    $body = new Template("templates/mercs/merc.edit.tmpl.php");
    $merc = get_merc($_GET['MercID']);
    if ($merc) {
      $body->set('merc', $merc);
      $body->set('stances', $stances);
    }
    break;
  case 5: // Update Merc
    check_authorization();
    update_merc();
    header("Location: index.php?editor=mercs&action=1");
    exit;
  case 6: // Delete Merc
    check_authorization();
    delete_merc($_GET['MercID']);
    header("Location: index.php?editor=mercs&action=1");
    exit;
  case 7: // View Merc NPC Types
    $breadcrumbs .= " >> NPC Types";
    $body = new Template("templates/mercs/merc.npc.types.view.tmpl.php");
    $merc_npc_types = get_merc_npc_types();
    if ($merc_npc_types) {
      $body->set('types', $merc_npc_types);
      $body->set('classes', $classes);
    }
    break;
  case 8: // Add Merc NPC Type
    check_authorization();
    $breadcrumbs .= " >> <a href='index.php?editor=mercs&action=7'>NPC Types</a> >> Add NPC Type";
    $body = new Template("templates/mercs/merc.npc.type.add.tmpl.php");
    $body->set('suggest_id', suggest_merc_npc_type_id());
    $body->set('classes', $classes);
    break;
  case 9: // Insert Merc NPC Type
    check_authorization();
    insert_merc_npc_type();
    header("Location: index.php?editor=mercs&action=7");
    exit;
  case 10: // Edit Merc NPC Type
    check_authorization();
    $breadcrumbs .= ">> <a href='index.php?editor=mercs&action=7'>NPC Types</a> >> Edit NPC Type";
    $body = new Template("templates/mercs/merc.npc.type.edit.tmpl.php");
    $merc_npc_type = get_merc_npc_type($_GET['merc_npc_type_id']);
    if ($merc_npc_type) {
      $body->set('type', $merc_npc_type);
      $body->set('classes', $classes);
    }
    break;
  case 11: // Update Merc NPC Type
    check_authorization();
    update_merc_npc_type();
    header("Location: index.php?editor=mercs&action=7");
    exit;
  case 12: // Delete Merc NPC Type
    check_authorization();
    delete_merc_npc_type($_GET['merc_npc_type_id']);
    header("Location: index.php?editor=mercs&action=7");
    exit;
  case 13: // View Merc Types
    $breadcrumbs .= " >> Types";
    $body = new Template("templates/mercs/merc.types.view.tmpl.php");
    $merc_types = get_merc_types();
    if ($merc_types) {
      $body->set('types', $merc_types);
      $body->set('races', $races);
      $body->set('clients', $clients);
    }
    break;
  case 14: // Add Merc Type
    check_authorization();
    $breadcrumbs .= " >> <a href='index.php?editor=mercs&action=13'>Types</a> >> Add Type";
    $body = new Template("templates/mercs/merc.type.add.tmpl.php");
    $body->set('suggest_id', suggest_merc_type_id());
    $body->set('races', $races);
      $body->set('clients', $clients);
    break;
  case 15: // Insert Merc Type
    check_authorization();
    insert_merc_type();
    header("Location: index.php?editor=mercs&action=13");
    exit;
  case 16: // Edit Merc Type
    check_authorization();
    $breadcrumbs .= " >> <a href='index.php?editor=mercs&action=13'>Types</a> >> Edit Type";
    $body = new Template("templates/mercs/merc.type.edit.tmpl.php");
    $merc_type = get_merc_type($_GET['merc_type_id']);
    if ($merc_type) {
      $body->set('type', $merc_type);
      $body->set('races', $races);
      $body->set('clients', $clients);
    }
    break;
  case 17: // Update Merc Type
    check_authorization();
    update_merc_type();
    header("Location: index.php?editor=mercs&action=13");
    exit;
  case 18: // Delete Merc Type
    check_authorization();
    delete_merc_type($_GET['merc_type_id']);
    header("Location: index.php?editor=mercs&action=13");
    exit;
  case 19: // View Merc Subtypes
    $breadcrumbs .= " >> Subtypes";
    $body = new Template("templates/mercs/merc.subtypes.view.tmpl.php");
    $merc_subtypes = get_merc_subtypes();
    if ($merc_subtypes) {
      $body->set('subtypes', $merc_subtypes);
      $body->set('classes', $classes);
    }
    break;
  case 20: // Add Merc Subtype
    check_authorization();
    $breadcrumbs .= " >> <a href='index.php?editor=mercs&action=19'>Subtypes</a> >> Add Subtype";
    $body = new Template("templates/mercs/merc.subtype.add.tmpl.php");
    $body->set('suggest_id', suggest_merc_subtype_id());
    $body->set('classes', $classes);
    break;
  case 21: // Insert Merc Subtype
    check_authorization();
    insert_merc_subtype();
    header("Location: index.php?editor=mercs&action=19");
    exit;
  case 22: // Edit Merc Subtype
    check_authorization();
    $breadcrumbs .= " >> <a href='index.php?editor=mercs&action=19'>Subtypes</a> >> Edit Subtype";
    $body = new Template("templates/mercs/merc.subtype.edit.tmpl.php");
    $merc_subtype = get_merc_subtype($_GET['merc_subtype_id']);
    if ($merc_subtype) {
      $body->set('subtype', $merc_subtype);
      $body->set('classes', $classes);
    }
    break;
  case 23: // Update Merc Subtype
    check_authorization();
    update_merc_subtype();
    header("Location: index.php?editor=mercs&action=19");
    exit;
  case 24: // Delete Merc Subtype
    check_authorization();
    delete_merc_subtype($_GET['merc_subtype_id']);
    header("Location: index.php?editor=mercs&action=19");
    exit;
  case 25: // View Merc Name Types
    $breadcrumbs .= " >> Name Types";
    $body = new Template("templates/mercs/merc.name.types.view.tmpl.php");
    $merc_name_types = get_merc_name_types();
    if ($merc_name_types) {
      $body->set('types', $merc_name_types);
      $body->set('classes', $classes);
    }
    break;
  case 26: // Add Merc Name Type
    check_authorization();
    $breadcrumbs .= " >> <a href='index.php?editor=mercs&action=25'>Name Types</a> >> Add Name Type";
    $body = new Template("templates/mercs/merc.name.type.add.tmpl.php");
    $body->set('suggest_id', suggest_merc_name_type_id());
    $body->set('classes', $classes);
    break;
  case 27: // Insert Merc Name Type
    check_authorization();
    insert_merc_name_type();
    header("Location: index.php?editor=mercs&action=25");
    exit;
  case 28: // Edit Merc Name Type
    check_authorization();
    $breadcrumbs .= " >> <a href='index.php?editor=mercs&action=25'>Name Types</a> >> Edit Name Type";
    $body = new Template("templates/mercs/merc.name.type.edit.tmpl.php");
    $merc_name_type = get_merc_name_type($_GET['name_type_id'], $_GET['class_id']);
    if ($merc_name_type) {
      $body->set('type', $merc_name_type);
      $body->set('classes', $classes);
    }
    break;
  case 29: // Update Merc Name Type
    check_authorization();
    update_merc_name_type();
    header("Location: index.php?editor=mercs&action=25");
    exit;
  case 30: // Delete Merc Name Type
    check_authorization();
    delete_merc_name_type($_GET['name_type_id'], $_GET['class_id']);
    header("Location: index.php?editor=mercs&action=25");
    exit;
  case 31: // View Merc Templates
    $breadcrumbs .= " >> Templates";
    $body = new Template("templates/mercs/merc.templates.view.tmpl.php");
    $merc_templates = get_merc_templates();
    if ($merc_templates) {
      $body->set('templates', $merc_templates);
      $body->set('clients', $clients);
    }
    break;
  case 32: // Add Merc Templates
    check_authorization();
    $breadcrumbs .= " >> <a href='index.php?editor=mercs&action=31'>Templates</a> >> Add Template";
    $body = new Template("templates/mercs/merc.template.add.tmpl.php");
    $body->set('suggest_id', suggest_merc_template_id());
    $body->set('clients', $clients);
    break;
  case 33: // Insert Merc Templates
    check_authorization();
    insert_merc_template();
    header("Location: index.php?editor=mercs&action=31");
    exit;
  case 34: // Edit Merc Templates
    check_authorization();
    $breadcrumbs .= " >> <a href='index.php?editor=mercs&action=31'>Templates</a> >> Edit Template";
    $body = new Template("templates/mercs/merc.template.edit.tmpl.php");
    $merc_template = get_merc_template($_GET['merc_template_id'], $_GET['merc_type_id'], $_GET['merc_subtype_id']);
    if ($merc_template) {
      $body->set('template', $merc_template);
      $body->set('clients', $clients);
    }
    break;
  case 35: // Update Merc Templates
    check_authorization();
    update_merc_template();
    header("Location: index.php?editor=mercs&action=31");
    exit;
  case 36: // Delete Merc Templates
    check_authorization();
    delete_merc_template($_GET['merc_template_id'], $_GET['merc_type_id'], $_GET['merc_subtype_id']);
    header("Location: index.php?editor=mercs&action=31");
    exit;
  case 37: // View Merc Spell Lists
    $breadcrumbs .= " >> Spell Lists";
    $body = new Template("templates/mercs/merc.spell.lists.view.tmpl.php");
    $merc_spell_lists = get_merc_spell_lists();
    if ($merc_spell_lists) {
      $body->set('lists', $merc_spell_lists);
      $body->set('classes', $classes);
    }
    break;
  case 38: // Add Merc Spell List
    check_authorization();
    $breadcrumbs .= " >> <a href='index.php?editor=mercs&action=37'>Spell Lists</a> >> Add Spell List";
    $body = new Template("templates/mercs/merc.spell.list.add.tmpl.php");
    $body->set('suggest_id', suggest_merc_spell_list_id());
    $body->set('classes', $classes);
    break;
  case 39: // Insert Merc Spell List
    check_authorization();
    insert_merc_spell_list();
    header("Location: index.php?editor=mercs&action=37");
    exit;
  case 40: // View Merc Spell List
    $breadcrumbs .= " >> <a href='index.php?editor=mercs&action=37'>Spell Lists</a> >> Spell List";
    $body = new Template("templates/mercs/merc.spell.list.view.tmpl.php");
    $merc_spell_list = get_merc_spell_list($_GET['merc_spell_list_id']);
    if ($merc_spell_list) {
      $body->set('list', $merc_spell_list);
      $body->set('classes', $classes);
      $body->set('spelltypes', $spelltypes);
    }
    $merc_spells = get_merc_spell_list_entries($_GET['merc_spell_list_id']);
    if ($merc_spells) {
      $body->set('spells', $merc_spells);
    }
    break;
  case 41: // Edit Merc Spell List
    check_authorization();
    $merc_spell_list_id = $_GET['merc_spell_list_id'];
    $breadcrumbs .= " >> <a href='index.php?editor=mercs&action=37'>Spell Lists</a> >> <a href='index.php?editor=mercs&merc_spell_list_id=" . $merc_spell_list_id . "&action=40'>Spell List</a> >> Edit Spell List";
    $body = new Template("templates/mercs/merc.spell.list.edit.tmpl.php");
    $merc_spell_list = get_merc_spell_list($merc_spell_list_id);
    if ($merc_spell_list) {
      $body->set('list', $merc_spell_list);
      $body->set('classes', $classes);
    }
    break;
  case 42: // Update Merc Spell List
    check_authorization();
    update_merc_spell_list();
    header("Location: index.php?editor=mercs&action=37");
    exit;
  case 43: // Delete Merc Spell List
    check_authorization();
    delete_merc_spell_list($_GET['merc_spell_list_id']);
    header("Location: index.php?editor=mercs&action=37");
    exit;
  case 44: // Add Merc Spell
    check_authorization();
    $breadcrumbs .= " >> <a href='index.php?editor=mercs&action=37'>Spell List</a> >> Add Spell";
    $javascript = new Template("templates/iframes/js.tmpl.php");
    $body = new Template("templates/mercs/merc.spell.add.tmpl.php");
    $body->set('merc_spell_list_id', $_GET['merc_spell_list_id']);
    $body->set('suggest_id', suggest_merc_spell_list_entry_id());
    $body->set('spelltypes', $spelltypes);
    $body->set('stances', $spell_stances);
    break;
  case 45: // Insert Merc Spell
    check_authorization();
    $id = $_POST['merc_spell_list_id'];
    insert_merc_spell_list_entry();
    header("Location: index.php?editor=mercs&merc_spell_list_id=$id&action=40");
    exit;
  case 46: // Edit Merc Spell
    check_authorization();
    $breadcrumbs .= " >> <a href='index.php?editor=mercs&action=37'>Spell List</a> >> Edit Spell";
    $javascript = new Template("templates/iframes/js.tmpl.php");
    $body = new Template("templates/mercs/merc.spell.edit.tmpl.php");
    $merc_spell = get_merc_spell_list_entry($_GET['merc_spell_list_entry_id']);
    if ($merc_spell) {
      $body->set('spell', $merc_spell);
      $body->set('spelltypes', $spelltypes);
      $body->set('stances', $spell_stances);
    }
    break;
  case 47: // Update Merc Spell
    check_authorization();
    $id = $_POST['merc_spell_list_id'];
    update_merc_spell_list_entry();
    header("Location: index.php?editor=mercs&merc_spell_list_id=$id&action=40");
    exit;
  case 48: // Delete Merc Spell
    check_authorization();
    $id = $_GET['merc_spell_list_id'];
    delete_merc_spell_list_entry($_GET['merc_spell_list_entry_id']);
    header("Location: index.php?editor=mercs&merc_spell_list_id=$id&action=40");
    exit;
  case 49: // View Merc Stances
    $breadcrumbs .= " >> Stances";
    $body = new Template("templates/mercs/merc.stances.view.tmpl.php");
    $merc_stances = get_merc_stances();
    if ($merc_stances) {
      $body->set('stance_entries', $merc_stances);
      $body->set('stances', $stances);
      $body->set('classes', $classes);
      $body->set('yesno', $yesno);
    }
    break;
  case 50: // Add Merc Stance
    check_authorization();
    $breadcrumbs .= " >> Stances >> Add Stance";
    $body = new Template("templates/mercs/merc.stance.add.tmpl.php");
    $body->set('suggest_id', suggest_merc_stance_entry_id());
    $body->set('stances', $stances);
    $body->set('classes', $classes);
    break;
  case 51: // Insert Merc Stance
    check_authorization();
    insert_merc_stance();
    header("Location: index.php?editor=mercs&action=49");
    exit;
  case 52: // Edit Merc Stance
    check_authorization();
    $breadcrumbs .= " >> Stances >> Edit Stance";
    $body = new Template("templates/mercs/merc.stance.edit.tmpl.php");
    $merc_stance = get_merc_stance($_GET['merc_stance_entry_id']);
    if ($merc_stance) {
      $body->set('stance', $merc_stance);
      $body->set('stances', $stances);
      $body->set('classes', $classes);
    }
    break;
  case 53: // Update Merc Stance
    check_authorization();
    update_merc_stance();
    header("Location: index.php?editor=mercs&action=49");
    exit;
  case 54: // Delete Merc Stance
    check_authorization();
    delete_merc_stance($_GET['merc_stance_entry_id']);
    header("Location: index.php?editor=mercs&action=49");
    exit;
  case 55: // View Merc Stats
    $breadcrumbs .= " >> <a href='index.php?editor=mercs&action=7'>NPC Types</a> >> Stats";
    $body = new Template("templates/mercs/merc.stats.view.tmpl.php");
    $merc_stats = get_merc_stats($_GET['merc_npc_type_id']);
    if ($merc_stats) {
      $body->set('stats', $merc_stats);
    }
    break;
  case 56: // Add Merc Stat
    check_authorization();
    $breadcrumbs .= " >> <a href='index.php?editor=mercs&action=7'>NPC Types</a> >> Add Stat";
    $body = new Template("templates/mercs/merc.stat.add.tmpl.php");
    $body->set('merc_npc_type_id', $_GET['merc_npc_type_id']);
    $body->set('suggest_level', suggest_merc_stat_clientlevel($_GET['merc_npc_type_id']));
    break;
  case 57: // Insert Merc Stat
    check_authorization();
    $merc_npc_type_id = $_POST['merc_npc_type_id'];
    insert_merc_stat();
    header("Location: index.php?editor=mercs&merc_npc_type_id=$merc_npc_type_id&action=55");
    exit;
  case 58: // Edit Merc Stat
    check_authorization();
    $breadcrumbs .= " >> <a href='index.php?editor=mercs&action=7'>NPC Types</a> >> Edit Stat";
    $body = new Template("templates/mercs/merc.stat.edit.tmpl.php");
    $merc_stat = get_merc_stat($_GET['merc_npc_type_id'], $_GET['clientlevel']);
    if ($merc_stat) {
      $body->set('stat', $merc_stat);
      $body->set('special_abilities_max', $special_abilities_max);
      $body->set('specialattacks', $specialattacks);
    }
    break;
  case 59: // Update Merc Stat
    check_authorization();
    $merc_npc_type_id = $_POST['merc_npc_type_id'];
    update_merc_stat();
    header("Location: index.php?editor=mercs&merc_npc_type_id=$merc_npc_type_id&action=55");
    exit;
  case 60: // Delete Merc Stat
    check_authorization();
    $merc_npc_type_id = $_GET['merc_npc_type_id'];
    $clientlevel = $_GET['clientlevel'];
    delete_merc_stat($merc_npc_type_id, $clientlevel);
    header("Location: index.php?editor=mercs&merc_npc_type_id=$merc_npc_type_id&action=55");
    exit;
  case 61: // View Merc Armor
    $breadcrumbs .= " >> <a href='index.php?editor=mercs&action=7'>NPC Types</a> >> Armor";
    $body = new Template("templates/mercs/merc.armor.view.tmpl.php");
    $merc_armor = get_merc_armor($_GET['merc_npc_type_id']);
    if ($merc_armor) {
      $body->set('armor', $merc_armor);
    }
    break;
  case 62: // Add Merc Armor
    check_authorization();
    $breadcrumbs .= " >> <a href='index.php?editor=mercs&action=7'>NPC Types</a> >> Add Armor";
    $body = new Template("templates/mercs/merc.armor.add.tmpl.php");
    $body->set('merc_npc_type_id', $_GET['merc_npc_type_id']);
    $body->set('suggest_id', suggest_merc_armor_id());
    break;
  case 63: // Insert Merc Armor
    check_authorization();
    $merc_npc_type_id = $_POST['merc_npc_type_id'];
    insert_merc_armor();
    header("Location: index.php?editor=mercs&merc_npc_type_id=$merc_npc_type_id&action=61");
    exit;
  case 64: // Edit Merc Armor
    check_authorization();
    $breadcrumbs .= " >> <a href='index.php?editor=mercs&action=7'>NPC Types</a> >> Edit Armor";
    $body = new Template("templates/mercs/merc.armor.edit.tmpl.php");
    $merc_armor = get_merc_armor_info($_GET['id']);
    if ($merc_armor) {
      $body->set('armor', $merc_armor);
    }
    break;
  case 65: // Update Merc Armor
    check_authorization();
    $merc_npc_type_id = $_POST['merc_npc_type_id'];
    update_merc_armor();
    header("Location: index.php?editor=mercs&merc_npc_type_id=$merc_npc_type_id&action=61");
    exit;
  case 66: // Delete Merc Armor
    check_authorization();
    $merc_npc_type_id = $_GET['merc_npc_type_id'];
    $id = $_GET['id'];
    delete_merc_armor($id);
    header("Location: index.php?editor=mercs&merc_npc_type_id=$merc_npc_type_id&action=61");
    exit;
  case 67: // View Merc Weapons
    $breadcrumbs .= " >> <a href='index.php?editor=mercs&action=7'>NPC Types</a> >> Weapons";
    $body = new Template("templates/mercs/merc.weapons.view.tmpl.php");
    $merc_weapons = get_merc_weapons($_GET['merc_npc_type_id']);
    if ($merc_weapons) {
      $body->set('weapons', $merc_weapons);
    }
    break;
  case 68: // Add Merc Weapon
    check_authorization();
    $breadcrumbs .= " >> <a href='index.php?editor=mercs&action=7'>NPC Types</a> >> Add Weapon";
    $body = new Template("templates/mercs/merc.weapon.add.tmpl.php");
    $body->set('merc_npc_type_id', $_GET['merc_npc_type_id']);
    $body->set('suggest_id', suggest_merc_weapon_id());
    $body->set('skilltypes', $skilltypes);
    break;
  case 69: // Insert Merc Weapon
    check_authorization();
    $merc_npc_type_id = $_POST['merc_npc_type_id'];
    insert_merc_weapon();
    header("Location: index.php?editor=mercs&merc_npc_type_id=$merc_npc_type_id&action=67");
    exit;
  case 70: // Edit Merc Weapon
    check_authorization();
    $breadcrumbs .= " >> <a href='index.php?editor=mercs&action=7'>NPC Types</a> >> Edit Weapon";
    $body = new Template("templates/mercs/merc.weapon.edit.tmpl.php");
    $merc_weapon = get_merc_weapon_info($_GET['id']);
    if ($merc_weapon) {
      $body->set('weapon', $merc_weapon);
      $body->set('skilltypes', $skilltypes);
    }
    break;
  case 71: // Update Merc Weapon
    check_authorization();
    $merc_npc_type_id = $_POST['merc_npc_type_id'];
    update_merc_weapon();
    header("Location: index.php?editor=mercs&merc_npc_type_id=$merc_npc_type_id&action=67");
    exit;
  case 72: // Delete Merc Weapon
    check_authorization();
    $merc_npc_type_id = $_GET['merc_npc_type_id'];
    $id = $_GET['id'];
    delete_merc_weapon($id);
    header("Location: index.php?editor=mercs&merc_npc_type_id=$merc_npc_type_id&action=67");
    exit;
  case 73: // View Merc Inventory
    $breadcrumbs .= " >> <a href='index.php?editor=mercs&action=19'>Subtypes</a> >> Inventory";
    $body = new Template("templates/mercs/merc.inventory.view.tmpl.php");
    $merc_items = get_merc_inventory($_GET['merc_subtype_id']);
    if ($merc_items) {
      $body->set('items', $merc_items);
    }
    break;
  case 74: // Add Merc Item
    check_authorization();
    $breadcrumbs .= " >> <a href='index.php?editor=mercs&action=19'>Subtypes</a> >> Add Item";
    $javascript = new Template("templates/iframes/js.tmpl.php");
    $body = new Template("templates/mercs/merc.item.add.tmpl.php");
    $body->set('merc_subtype_id', $_GET['merc_subtype_id']);
    $body->set('suggest_id', suggest_merc_inventory_id());
    break;
  case 75: // Insert Merc Item
    check_authorization();
    $merc_subtype_id = $_POST['merc_subtype_id'];
    insert_merc_item();
    header("Location: index.php?editor=mercs&merc_subtype_id=$merc_subtype_id&action=73");
    exit;
  case 76: // Edit Merc Item
    check_authorization();
    $breadcrumbs .= " >> <a href='index.php?editor=mercs&action=19'>Subtypes</a> >> Edit Item";
    $javascript = new Template("templates/iframes/js.tmpl.php");
    $body = new Template("templates/mercs/merc.item.edit.tmpl.php");
    $merc_item = get_merc_item($_GET['merc_inventory_id']);
    if ($merc_item) {
      $body->set('item', $merc_item);
    }
    break;
  case 77: // Update Merc Item
    check_authorization();
    $merc_subtype_id = $_POST['merc_subtype_id'];
    update_merc_item();
    header("Location: index.php?editor=mercs&merc_subtype_id=$merc_subtype_id&action=73");
    exit;
  case 78: // Delete Merc Item
    check_authorization();
    $merc_subtype_id = $_GET['merc_subtype_id'];
    $merc_inventory_id = $_GET['merc_inventory_id'];
    delete_merc_item($merc_inventory_id);
    header("Location: index.php?editor=mercs&merc_subtype_id=$merc_subtype_id&action=73");
    exit;
  case 79: // View Merc Buffs
    $breadcrumbs .= " >> <a href='index.php?editor=mercs&action=1'>Mercs</a> >> Buffs";
    $body = new Template("templates/mercs/merc.buffs.view.tmpl.php");
    $merc_buffs = get_merc_buffs($_GET['MercId']);
    if ($merc_buffs) {
      $body->set('buffs', $merc_buffs);
    }
    break;
  case 80: // Add Merc Buff
    check_authorization();
    $breadcrumbs .= " >> <a href='index.php?editor=mercs&action=1'>Mercs</a> >> Buffs >> Add Buff";
    $javascript = new Template("templates/iframes/js.tmpl.php");
    $body = new Template("templates/mercs/merc.buff.add.tmpl.php");
    $body->set('MercId', $_GET['MercId']);
    $body->set('suggest_id', suggest_merc_buff_id());
    break;
  case 81: // Insert Merc Buff
    check_authorization();
    $MercId = $_POST['MercId'];
    insert_merc_buff();
    header("Location: index.php?editor=mercs&MercId=$MercId&action=79");
    exit;
  case 82: // Edit Merc Buff
    check_authorization();
    $breadcrumbs .= " >> <a href='index.php?editor=mercs&action=1'>Mercs</a> >> Buffs >> Edit Buff";
    $javascript = new Template("templates/iframes/js.tmpl.php");
    $body = new Template("templates/mercs/merc.buff.edit.tmpl.php");
    $merc_buff = get_merc_buff($_GET['MercBuffId']);
    if ($merc_buff) {
      $body->set('buff', $merc_buff);
    }
    break;
  case 83: // Update Merc Buff
    check_authorization();
    $MercId = $_POST['MercId'];
    update_merc_buff();
    header("Location: index.php?editor=mercs&MercId=$MercId&action=79");
    exit;
  case 84: // Delete Merc Buff
    check_authorization();
    $MercId = $_GET['MercId'];
    $MercBuffId = $_GET['MercBuffId'];
    delete_merc_buff($MercBuffId);
    header("Location: index.php?editor=mercs&MercId=$MercId&action=79");
    exit;
  case 85: // View Merc Merchant Templates
    $breadcrumbs .= " >> Merchant Templates";
    $body = new Template("templates/mercs/merc.merchant.templates.view.tmpl.php");
    $merc_merchant_templates = get_merc_merchant_templates();
    if ($merc_merchant_templates) {
      $body->set('templates', $merc_merchant_templates);
    }
    break;
  case 86: // Add Merc Merchant Template
    check_authorization();
    $breadcrumbs .= " >> <a href='index.php?editor=mercs&action=85'>Merchant Templates</a> >> Add Merchant Template";
    $body = new Template("templates/mercs/merc.merchant.template.add.tmpl.php");
    $body->set('suggest_id', suggest_merc_merchant_template_id());
    break;
  case 87: // Insert Merc Merchant Template
    check_authorization();
    insert_merc_merchant_template();
    $merc_merchant_template_id = $_POST['merc_merchant_template_id'];
    header("Location: index.php?editor=mercs&merc_merchant_template_id=$merc_merchant_template_id&action=91");
    exit;
  case 88: // Edit Merc Merchant Template
    check_authorization();
    $breadcrumbs .= " >> <a href='index.php?editor=mercs&action=85'>Merchant Templates</a> >> Edit Merchant Template";
    $body = new Template("templates/mercs/merc.merchant.template.edit.tmpl.php");
    $merc_merchant_template = get_merc_merchant_template($_GET['merc_merchant_template_id']);
    if ($merc_merchant_template) {
      $body->set('template', $merc_merchant_template);
    }
    break;
  case 89: // Update Merc Merchant Template
    check_authorization();
    update_merc_merchant_template();
    $merc_merchant_template_id = $_POST['merc_merchant_template_id'];
    header("Location: index.php?editor=mercs&merc_merchant_template_id=$merc_merchant_template_id&action=91");
    exit;
  case 90: // Delete Merc Merchant Template
    check_authorization();
    $merc_merchant_template_id = $_GET['merc_merchant_template_id'];
    delete_merc_merchant_template($merc_merchant_template_id);
    header("Location: index.php?editor=mercs&action=85");
    exit;
  case 91: // View Merc Merchant
    $breadcrumbs .= " >> <a href='index.php?editor=mercs&action=85'>Merchant Templates</a> >> Merchants";
    $body = new Template("templates/mercs/merc.merchant.view.tmpl.php");
    $merc_merchant_template = get_merc_merchant_template($_GET['merc_merchant_template_id']);
    if ($merc_merchant_template) {
      $body->set('template', $merc_merchant_template);
    }
    $merc_merchant_template_entries = get_merc_merchant_template_entries($_GET['merc_merchant_template_id']);
    if ($merc_merchant_template_entries) {
      $body->set('t_entries', $merc_merchant_template_entries);
    }
    $merc_merchant_entries = get_merc_merchant_entries($_GET['merc_merchant_template_id']);
    if ($merc_merchant_entries) {
      $body->set('m_entries', $merc_merchant_entries);
    }
    break;
  case 92: // Add Merc Merchant Template Entry
    check_authorization();
    $breadcrumbs .= " >> <a href='index.php?editor=mercs&action=85'>Merchant Templates</a> >> Merchant Template >> Add Merchant Template Entry";
    $body = new Template("templates/mercs/merc.merchant.template.entry.add.tmpl.php");
    $body->set('suggest_id', suggest_merc_merchant_template_entry_id());
    $body->set('merc_merchant_template_id', $_GET['merc_merchant_template_id']);
    break;
  case 93: // Insert Merc Merchant Template Entry
    check_authorization();
    insert_merc_merchant_template_entry();
    $merc_merchant_template_id = $_POST['merc_merchant_template_id'];
    header("Location: index.php?editor=mercs&merc_merchant_template_id=$merc_merchant_template_id&action=91");
    exit;
  case 94: // Edit Merc Merchant Template Entry
    check_authorization();
    $breadcrumbs .= " >> <a href='index.php?editor=mercs&action=85'>Merchant Templates</a> >> Merchant Template >> Edit Merchant Template Entry";
    $body = new Template("templates/mercs/merc.merchant.template.entry.edit.tmpl.php");
    $merc_merchant_template_entry = get_merc_merchant_template_entry($_GET['merc_merchant_template_entry_id']);
    if ($merc_merchant_template_entry) {
      $body->set('entry', $merc_merchant_template_entry);
    }
    break;
  case 95: // Update Merc Merchant Template Entry
    check_authorization();
    update_merc_merchant_template_entry();
    $merc_merchant_template_id = $_POST['merc_merchant_template_id'];
    header("Location: index.php?editor=mercs&merc_merchant_template_id=$merc_merchant_template_id&action=91");
    exit;
  case 96: // Delete Merc Merchant Template Entry
    check_authorization();
    delete_merc_merchant_template_entry($_GET['merc_merchant_template_entry_id']);
    $merc_merchant_template_id = $_GET['merc_merchant_template_id'];
    header("Location: index.php?editor=mercs&merc_merchant_template_id=$merc_merchant_template_id&action=91");
    exit;
  case 97: // Add Merc Merchant Entry
    check_authorization();
    $breadcrumbs .= " >> <a href='index.php?editor=mercs&action=85'>Merchant Templates</a> >> Merchant Template >> Add Merchant Entry";
    $body = new Template("templates/mercs/merc.merchant.entry.add.tmpl.php");
    $body->set('suggest_id', suggest_merc_merchant_entry_id());
    $body->set('merc_merchant_template_id', $_GET['merc_merchant_template_id']);
    break;
  case 98: // Insert Merc Merchant Entry
    check_authorization();
    insert_merc_merchant_entry();
    $merc_merchant_template_id = $_POST['merc_merchant_template_id'];
    header("Location: index.php?editor=mercs&merc_merchant_template_id=$merc_merchant_template_id&action=91");
    exit;
  case 99: // Edit Merc Merchant Entry
    check_authorization();
    $breadcrumbs .= " >> <a href='index.php?editor=mercs&action=85'>Merchant Templates</a> >> Merchant Template >> Edit Merchant Entry";
    $body = new Template("templates/mercs/merc.merchant.entry.edit.tmpl.php");
    $merc_merchant_entry = get_merc_merchant_entry($_GET['merc_merchant_entry_id']);
    if ($merc_merchant_entry) {
      $body->set('entry', $merc_merchant_entry);
    }
    break;
  case 100: // Update Merc Merchant Entry
    check_authorization();
    update_merc_merchant_entry();
    $merc_merchant_template_id = $_POST['merc_merchant_template_id'];
    header("Location: index.php?editor=mercs&merc_merchant_template_id=$merc_merchant_template_id&action=91");
    exit;
  case 101: // Delete Merc Merchant Entry
    check_authorization();
    delete_merc_merchant_entry($_GET['merc_merchant_entry_id']);
    $merc_merchant_template_id = $_GET['merc_merchant_template_id'];
    header("Location: index.php?editor=mercs&merc_merchant_template_id=$merc_merchant_template_id&action=91");
    exit;
}

function get_mercs() {
  global $mysql;

  $query = "SELECT * FROM mercs";
  $results = $mysql->query_mult_assoc($query);

  if ($results) {
    return $results;
  }
  else {
    return null;
  }
}

function get_player_mercs($OwnerCharacterID) {
  global $mysql;

  $query = "SELECT * FROM mercs WHERE OwnerCharacterID=$OwnerCharacterID";
  $results = $mysql->query_mult_assoc($query);

  if ($results) {
    return $results;
  }
  else {
    return null;
  }
}

function get_merc($MercID) {
  global $mysql;

  $query = "SELECT * FROM mercs WHERE MercID=$MercID";
  $result = $mysql->query_assoc($query);

  if ($result) {
    return $result;
  }
  else {
    return null;
  }
}

function insert_merc() {
  global $mysql;

  $MercID = $_POST['MercID'];
  $OwnerCharacterID = $_POST['OwnerCharacterID'];
  $Slot = $_POST['Slot'];
  $Name = $_POST['Name'];
  $TemplateID = $_POST['TemplateID'];
  $SuspendedTime = $_POST['SuspendedTime'];
  $IsSuspended = $_POST['IsSuspended'];
  $TimerRemaining = $_POST['TimerRemaining'];
  $Gender = $_POST['Gender'];
  $MercSize = $_POST['MercSize'];
  $StanceID = $_POST['StanceID'];
  $HP = $_POST['HP'];
  $Mana = $_POST['Mana'];
  $Endurance = $_POST['Endurance'];
  $Face = $_POST['Face'];
  $LuclinHairStyle = $_POST['LuclinHairStyle'];
  $LuclinHairColor = $_POST['LuclinHairColor'];
  $LuclinEyeColor = $_POST['LuclinEyeColor'];
  $LuclinEyeColor2 = $_POST['LuclinEyeColor2'];
  $LuclinBeardColor = $_POST['LuclinBeardColor'];
  $LuclinBeard = $_POST['LuclinBeard'];
  $DrakkinHeritage = $_POST['DrakkinHeritage'];
  $DrakkinTattoo = $_POST['DrakkinTattoo'];
  $DrakkinDetails = $_POST['DrakkinDetails'];

  $query = "INSERT INTO mercs SET MercID=$MercID, OwnerCharacterID=$OwnerCharacterID, Slot=$Slot, Name=\"$Name\", TemplateID=$TemplateID, SuspendedTime=$SuspendedTime, IsSuspended=$IsSuspended, TimerRemaining=$TimerRemaining, Gender=$Gender, MercSize=$MercSize, StanceID=$StanceID, HP=$HP, Mana=$Mana, Endurance=$Endurance, Face=$Face, LuclinHairStyle=$LuclinHairStyle, LuclinHairColor=$LuclinHairColor, LuclinEyeColor=$LuclinEyeColor, LuclinEyeColor2=$LuclinEyeColor2, LuclinBeardColor=$LuclinBeardColor, LuclinBeard=$LuclinBeard, DrakkinHeritage=$DrakkinHeritage, DrakkinTattoo=$DrakkinTattoo, DrakkinDetails=$DrakkinDetails";
  $mysql->query_no_result($query);
}

function update_merc() {
  global $mysql;

  $MercID = $_POST['MercID'];
  $OwnerCharacterID = $_POST['OwnerCharacterID'];
  $Slot = $_POST['Slot'];
  $Name = $_POST['Name'];
  $TemplateID = $_POST['TemplateID'];
  $SuspendedTime = $_POST['SuspendedTime'];
  $IsSuspended = $_POST['IsSuspended'];
  $TimerRemaining = $_POST['TimerRemaining'];
  $Gender = $_POST['Gender'];
  $MercSize = $_POST['MercSize'];
  $StanceID = $_POST['StanceID'];
  $HP = $_POST['HP'];
  $Mana = $_POST['Mana'];
  $Endurance = $_POST['Endurance'];
  $Face = $_POST['Face'];
  $LuclinHairStyle = $_POST['LuclinHairStyle'];
  $LuclinHairColor = $_POST['LuclinHairColor'];
  $LuclinEyeColor = $_POST['LuclinEyeColor'];
  $LuclinEyeColor2 = $_POST['LuclinEyeColor2'];
  $LuclinBeardColor = $_POST['LuclinBeardColor'];
  $LuclinBeard = $_POST['LuclinBeard'];
  $DrakkinHeritage = $_POST['DrakkinHeritage'];
  $DrakkinTattoo = $_POST['DrakkinTattoo'];
  $DrakkinDetails = $_POST['DrakkinDetails'];

  $query = "UPDATE mercs SET OwnerCharacterID=$OwnerCharacterID, Slot=$Slot, Name=\"$Name\", TemplateID=$TemplateID, SuspendedTime=$SuspendedTime, IsSuspended=$IsSuspended, TimerRemaining=$TimerRemaining, Gender=$Gender, MercSize=$MercSize, StanceID=$StanceID, HP=$HP, Mana=$Mana, Endurance=$Endurance, Face=$Face, LuclinHairStyle=$LuclinHairStyle, LuclinHairColor=$LuclinHairColor, LuclinEyeColor=$LuclinEyeColor, LuclinEyeColor2=$LuclinEyeColor2, LuclinBeardColor=$LuclinBeardColor, LuclinBeard=$LuclinBeard, DrakkinHeritage=$DrakkinHeritage, DrakkinTattoo=$DrakkinTattoo, DrakkinDetails=$DrakkinDetails WHERE MercID=$MercID";
  $mysql->query_no_result($query);
}

function delete_merc($MercID) {
  global $mysql;

  $query = "DELETE FROM merc_buffs WHERE MercId=$MercID";
  $mysql->query_no_result($query);

  $query = "DELETE FROM mercs WHERE MercID=$MercID";
  $mysql->query_no_result($query);
}

function get_merc_weapons($merc_npc_type_id) {
  global $mysql;

  $query = "SELECT * FROM merc_weaponinfo WHERE merc_npc_type_id=$merc_npc_type_id";
  $results = $mysql->query_mult_assoc($query);

  if ($results) {
    return $results;
  }
  else {
    return null;
  }
}

function get_merc_weapon_info($id) {
  global $mysql;

  $query = "SELECT * FROM merc_weaponinfo WHERE id=$id";
  $result = $mysql->query_assoc($query);

  if ($result) {
    return $result;
  }
  else {
    return null;
  }
}

function insert_merc_weapon() {
  global $mysql;

  $id = $_POST['id'];
  $merc_npc_type_id = $_POST['merc_npc_type_id'];
  $minlevel = $_POST['minlevel'];
  $maxlevel = $_POST['maxlevel'];
  $d_melee_texture1 = $_POST['d_melee_texture1'];
  $d_melee_texture2 = $_POST['d_melee_texture2'];
  $prim_melee_type = $_POST['prim_melee_type'];
  $sec_melee_type = $_POST['sec_melee_type'];

  $query = "INSERT INTO merc_weaponinfo SET id=$id, merc_npc_type_id=$merc_npc_type_id, minlevel=$minlevel, maxlevel=$maxlevel, d_melee_texture1=$d_melee_texture1, d_melee_texture2=$d_melee_texture2, prim_melee_type=$prim_melee_type, sec_melee_type=sec_melee_type";
  $mysql->query_no_result($query);
}

function update_merc_weapon() {
  global $mysql;

  $id = $_POST['id'];
  $merc_npc_type_id = $_POST['merc_npc_type_id'];
  $minlevel = $_POST['minlevel'];
  $maxlevel = $_POST['maxlevel'];
  $d_melee_texture1 = $_POST['d_melee_texture1'];
  $d_melee_texture2 = $_POST['d_melee_texture2'];
  $prim_melee_type = $_POST['prim_melee_type'];
  $sec_melee_type = $_POST['sec_melee_type'];

  $query = "UPDATE merc_weaponinfo SET merc_npc_type_id=$merc_npc_type_id, minlevel=$minlevel, maxlevel=$maxlevel, d_melee_texture1=$d_melee_texture1, d_melee_texture2=$d_melee_texture2, prim_melee_type=$prim_melee_type, sec_melee_type=sec_melee_type WHERE id=$id";
  $mysql->query_no_result($query);
}

function delete_merc_weapon($id) {
  global $mysql;

  $query = "DELETE FROM merc_weaponinfo WHERE id=$id";
  $mysql->query_no_result($query);
}

function get_merc_types() {
  global $mysql;

  $query = "SELECT * FROM merc_types";
  $results = $mysql->query_mult_assoc($query);

  if ($results) {
    return $results;
  }
  else {
    return null;
  }
}

function get_merc_type($merc_type_id) {
  global $mysql;

  $query = "SELECT * FROM merc_types WHERE merc_type_id=$merc_type_id";
  $result = $mysql->query_assoc($query);

  if ($result) {
    return $result;
  }
  else {
    return null;
  }
}

function insert_merc_type() {
  global $mysql;

  $merc_type_id = $_POST['merc_type_id'];
  $race_id = $_POST['race_id'];
  $proficiency_id = $_POST['proficiency_id'];
  $dbstring = $_POST['dbstring'];
  $clientversion = $_POST['clientversion'];

  $query = "INSERT INTO merc_types SET merc_type_id=$merc_type_id, race_id=$race_id, proficiency_id=$proficiency_id, dbstring=\"$dbstring\", clientversion=$clientversion";
  $mysql->query_no_result($query);
}

function update_merc_type() {
  global $mysql;

  $merc_type_id = $_POST['merc_type_id'];
  $race_id = $_POST['race_id'];
  $proficiency_id = $_POST['proficiency_id'];
  $dbstring = $_POST['dbstring'];
  $clientversion = $_POST['clientversion'];

  $query = "UPDATE merc_types SET race_id=$race_id, proficiency_id=$proficiency_id, dbstring=\"$dbstring\", clientversion=$clientversion WHERE merc_type_id=$merc_type_id";
  $mysql->query_no_result($query);
}

function delete_merc_type($merc_type_id) {
  global $mysql;

  $query = "DELETE FROM merc_types WHERE merc_type_id=$merc_type_id";
  $mysql->query_no_result($query);
}

function get_merc_templates() {
  global $mysql;

  $query = "SELECT * FROM merc_templates";
  $results = $mysql->query_mult_assoc($query);

  if ($results) {
    return $results;
  }
  else {
    return null;
  }
}

function get_merc_template($merc_template_id) {
  global $mysql;

  $query = "SELECT * FROM merc_templates WHERE merc_template_id=$merc_template_id";
  $result = $mysql->query_assoc($query);

  if ($result) {
    return $result;
  }
  else {
    return null;
  }
}

function insert_merc_template() {
  global $mysql;

  $merc_template_id = $_POST['merc_template_id'];
  $merc_type_id = $_POST['merc_type_id'];
  $merc_subtype_id = $_POST['merc_subtype_id'];
  $merc_npc_type_id = $_POST['merc_npc_type_id'];
  $dbstring = $_POST['dbstring'];
  $name_type_id = $_POST['name_type_id'];
  $clientversion = $_POST['clientversion'];

  $query = "INSERT INTO merc_templates SET merc_template_id=$merc_template_id, merc_type_id=$merc_type_id, merc_subtype_id=$merc_subtype_id, merc_npc_type_id=$merc_npc_type_id, dbstring=\"$dbstring\", name_type_id=$name_type_id, clientversion=$clientversion";
  $mysql->query_no_result($query);
}

function update_merc_template() {
  global $mysql;

  $merc_template_id = $_POST['merc_template_id'];
  $merc_type_id = $_POST['merc_type_id'];
  $merc_subtype_id = $_POST['merc_subtype_id'];
  $merc_npc_type_id = $_POST['merc_npc_type_id'];
  $dbstring = $_POST['dbstring'];
  $name_type_id = $_POST['name_type_id'];
  $clientversion = $_POST['clientversion'];

  $query = "UPDATE merc_templates SET merc_type_id=$merc_type_id, merc_subtype_id=$merc_subtype_id, merc_npc_type_id=$merc_npc_type_id, dbstring=\"$dbstring\", name_type_id=$name_type_id, clientversion=$clientversion WHERE merc_template_id=$merc_template_id";
  $mysql->query_no_result($query);
}

function delete_merc_template($merc_template_id) {
  global $mysql;

  $query = "DELETE FROM merc_templates WHERE merc_template_id=$merc_template_id";
  $mysql->query_no_result($query);
}

function get_merc_subtypes() {
  global $mysql;

  $query = "SELECT * FROM merc_subtypes";
  $results = $mysql->query_mult_assoc($query);

  if ($results) {
    return $results;
  }
  else {
    return null;
  }
}

function get_merc_subtype($merc_subtype_id) {
  global $mysql;

  $query = "SELECT * FROM merc_subtypes WHERE merc_subtype_id=$merc_subtype_id";
  $result = $mysql->query_assoc($query);

  if ($result) {
    return $result;
  }
  else {
    return null;
  }
}

function insert_merc_subtype() {
  global $mysql;

  $merc_subtype_id = $_POST['merc_subtype_id'];
  $class_id = $_POST['class_id'];
  $tier_id = $_POST['tier_id'];
  $confidence_id = $_POST['confidence_id'];

  $query = "INSERT INTO merc_subtypes SET merc_subtype_id=$merc_subtype_id, class_id=$class_id, tier_id=$tier_id, confidence_id=$confidence_id";
  $mysql->query_no_result($query);
}

function update_merc_subtype() {
  global $mysql;

  $merc_subtype_id = $_POST['merc_subtype_id'];
  $class_id = $_POST['class_id'];
  $tier_id = $_POST['tier_id'];
  $confidence_id = $_POST['confidence_id'];

  $query = "UPDATE merc_subtypes SET class_id=$class_id, tier_id=$tier_id, confidence_id=$confidence_id WHERE merc_subtype_id=$merc_subtype_id";
  $mysql->query_no_result($query);
}

function delete_merc_subtype($merc_subtype_id) {
  global $mysql;

  $query = "DELETE FROM merc_inventory WHERE merc_subtype_id=$merc_subtype_id";
  $mysql->query_no_result($query);

  $query = "DELETE FROM merc_subtypes WHERE merc_subtype_id=$merc_subtype_id";
  $mysql->query_no_result($query);
}

function get_merc_stats($merc_npc_type_id) {
  global $mysql;

  $query = "SELECT * FROM merc_stats WHERE merc_npc_type_id=$merc_npc_type_id ORDER BY clientlevel";
  $results = $mysql->query_mult_assoc($query);

  if ($results) {
    return $results;
  }
  else {
    return null;
  }
}

function get_merc_stat($merc_npc_type_id, $clientlevel) {
  global $mysql;

  $query = "SELECT * FROM merc_stats WHERE merc_npc_type_id=$merc_npc_type_id AND clientlevel=$clientlevel";
  $result = $mysql->query_assoc($query);

  if ($result) {
    return $result;
  }
  else {
    return null;
  }
}

function insert_merc_stat() {
  global $mysql, $specialattacks;

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

  $merc_npc_type_id = $_POST['merc_npc_type_id'];
  $clientlevel = $_POST['clientlevel'];
  $level = $_POST['level'];
  $hp = $_POST['hp'];
  $mana = $_POST['mana'];
  $AC = $_POST['AC'];
  $ATK = $_POST['ATK'];
  $STR = $_POST['STR'];
  $STA = $_POST['STA'];
  $DEX = $_POST['DEX'];
  $AGI = $_POST['AGI'];
  $_INT = $_POST['_INT'];
  $WIS = $_POST['WIS'];
  $CHA = $_POST['CHA'];
  $MR = $_POST['MR'];
  $CR = $_POST['CR'];
  $DR = $_POST['DR'];
  $FR = $_POST['FR'];
  $PR = $_POST['PR'];
  $Corrup = $_POST['Corrup'];
  $mindmg = $_POST['mindmg'];
  $maxdmg = $_POST['maxdmg'];
  $attack_count = $_POST['attack_count'];
  $attack_speed = $_POST['attack_speed'];
  $attack_delay = $_POST['attack_delay'];
  $special_abilities = $special;
  $Accuracy = $_POST['Accuracy'];
  $hp_regen_rate = $_POST['hp_regen_rate'];
  $mana_regen_rate = $_POST['mana_regen_rate'];
  $runspeed = $_POST['runspeed'];
  $statscale = $_POST['statscale'];
  $spellscale = $_POST['spellscale'];
  $healscale = $_POST['healscale'];

  $query = "INSERT INTO merc_stats SET merc_npc_type_id=$merc_npc_type_id, clientlevel=$clientlevel, level=$level, hp=$hp, mana=$mana, AC=$AC, ATK=$ATK, STR=$STR, STA=$STA, DEX=$DEX, AGI=$AGI, _INT=$_INT, WIS=$WIS, CHA=$CHA, MR=$MR, CR=$CR, DR=$DR, FR=$FR, PR=$PR, Corrup=$Corrup, mindmg=$mindmg, maxdmg=$maxdmg, attack_count=$attack_count, attack_speed=$attack_speed, attack_delay=$attack_delay, special_abilities=\"$special_abilities\", Accuracy=$Accuracy, hp_regen_rate=$hp_regen_rate, mana_regen_rate=$mana_regen_rate, runspeed=$runspeed, statscale=$statscale, spellscale=$spellscale, healscale=$healscale";
  $mysql->query_no_result($query);
}

function update_merc_stat() {
  global $mysql, $specialattacks;

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

  $merc_npc_type_id = $_POST['merc_npc_type_id'];
  $clientlevel = $_POST['clientlevel'];
  $level = $_POST['level'];
  $hp = $_POST['hp'];
  $mana = $_POST['mana'];
  $AC = $_POST['AC'];
  $ATK = $_POST['ATK'];
  $STR = $_POST['STR'];
  $STA = $_POST['STA'];
  $DEX = $_POST['DEX'];
  $AGI = $_POST['AGI'];
  $_INT = $_POST['_INT'];
  $WIS = $_POST['WIS'];
  $CHA = $_POST['CHA'];
  $MR = $_POST['MR'];
  $CR = $_POST['CR'];
  $DR = $_POST['DR'];
  $FR = $_POST['FR'];
  $PR = $_POST['PR'];
  $Corrup = $_POST['Corrup'];
  $mindmg = $_POST['mindmg'];
  $maxdmg = $_POST['maxdmg'];
  $attack_count = $_POST['attack_count'];
  $attack_speed = $_POST['attack_speed'];
  $attack_delay = $_POST['attack_delay'];
  $special_abilities = $special;
  $Accuracy = $_POST['Accuracy'];
  $hp_regen_rate = $_POST['hp_regen_rate'];
  $mana_regen_rate = $_POST['mana_regen_rate'];
  $runspeed = $_POST['runspeed'];
  $statscale = $_POST['statscale'];
  $spellscale = $_POST['spellscale'];
  $healscale = $_POST['healscale'];

  $query = "UPDATE merc_stats SET level=$level, hp=$hp, mana=$mana, AC=$AC, ATK=$ATK, STR=$STR, STA=$STA, DEX=$DEX, AGI=$AGI, _INT=$_INT, WIS=$WIS, CHA=$CHA, MR=$MR, CR=$CR, DR=$DR, FR=$FR, PR=$PR, Corrup=$Corrup, mindmg=$mindmg, maxdmg=$maxdmg, attack_count=$attack_count, attack_speed=$attack_speed, attack_delay=$attack_delay, special_abilities=\"$special_abilities\", Accuracy=$Accuracy, hp_regen_rate=$hp_regen_rate, mana_regen_rate=$mana_regen_rate, runspeed=$runspeed, statscale=$statscale, spellscale=$spellscale, healscale=$healscale WHERE merc_npc_type_id=$merc_npc_type_id AND clientlevel=$clientlevel";
  $mysql->query_no_result($query);
}

function delete_merc_stat($merc_npc_type_id, $clientlevel) {
  global $mysql;

  $query = "DELETE FROM merc_stats WHERE merc_npc_type_id=$merc_npc_type_id AND clientlevel=$clientlevel";
  $mysql->query_no_result($query);
}

function get_merc_stances() {
  global $mysql;

  $query = "SELECT * FROM merc_stance_entries";
  $results = $mysql->query_mult_assoc($query);

  if ($results) {
    return $results;
  }
  else {
    return null;
  }
}

function get_merc_stance($merc_stance_entry_id) {
  global $mysql;

  $query = "SELECT * FROM merc_stance_entries WHERE merc_stance_entry_id=$merc_stance_entry_id";
  $result = $mysql->query_assoc($query);

  if ($result) {
    return $result;
  }
  else {
    return null;
  }
}

function insert_merc_stance() {
  global $mysql;

  $merc_stance_entry_id = $_POST['merc_stance_entry_id'];
  $class_id = $_POST['class_id'];
  $proficiency_id = $_POST['proficiency_id'];
  $stance_id = $_POST['stance_id'];
  $isdefault = $_POST['isdefault'];

  $query = "INSERT INTO merc_stance_entries SET merc_stance_entry_id=$merc_stance_entry_id, class_id=$class_id, proficiency_id=$proficiency_id, stance_id=$stance_id, isdefault=$isdefault";
  $mysql->query_no_result($query);
}

function update_merc_stance() {
  global $mysql;

  $merc_stance_entry_id = $_POST['merc_stance_entry_id'];
  $class_id = $_POST['class_id'];
  $proficiency_id = $_POST['proficiency_id'];
  $stance_id = $_POST['stance_id'];
  $isdefault = $_POST['isdefault'];

  $query = "UPDATE merc_stance_entries SET class_id=$class_id, proficiency_id=$proficiency_id, stance_id=$stance_id, isdefault=$isdefault WHERE merc_stance_entry_id=$merc_stance_entry_id";
  $mysql->query_no_result($query);
}

function delete_merc_stance($merc_stance_entry_id) {
  global $mysql;

  $query = "DELETE FROM merc_stance_entries WHERE merc_stance_entry_id=$merc_stance_entry_id";
  $mysql->query_no_result($query);
}

function get_merc_spell_lists() {
  global $mysql;

  $query = "SELECT * FROM merc_spell_lists";
  $results = $mysql->query_mult_assoc($query);

  if ($results) {
    return $results;
  }
  else {
    return null;
  }
}

function get_merc_spell_list($merc_spell_list_id) {
  global $mysql;

  $query = "SELECT * FROM merc_spell_lists WHERE merc_spell_list_id=$merc_spell_list_id";
  $result = $mysql->query_assoc($query);

  if ($result) {
    return $result;
  }
  else {
    return null;
  }
}

function insert_merc_spell_list() {
  global $mysql;

  $merc_spell_list_id = $_POST['merc_spell_list_id'];
  $class_id = $_POST['class_id'];
  $proficiency_id = $_POST['proficiency_id'];
  $name = $_POST['name'];

  $query = "INSERT INTO merc_spell_lists SET merc_spell_list_id=$merc_spell_list_id, class_id=$class_id, proficiency_id=$proficiency_id, `name`=\"$name\"";
  $mysql->query_no_result($query);
}

function update_merc_spell_list() {
  global $mysql;

  $merc_spell_list_id = $_POST['merc_spell_list_id'];
  $class_id = $_POST['class_id'];
  $proficiency_id = $_POST['proficiency_id'];
  $name = $_POST['name'];

  $query = "UPDATE merc_spell_lists SET class_id=$class_id, proficiency_id=$proficiency_id, `name`=\"$name\" WHERE merc_spell_list_id=$merc_spell_list_id";
  $mysql->query_no_result($query);
}

function delete_merc_spell_list($merc_spell_list_id) {
  global $mysql;

  $query = "DELETE FROM merc_spell_list_entries WHERE merc_spell_list_id=$merc_spell_list_id";
  $mysql->query_no_result($query);

  $query = "DELETE FROM merc_spell_lists WHERE merc_spell_list_id=$merc_spell_list_id";
  $mysql->query_no_result($query);
}

function get_merc_spell_list_entries($merc_spell_list_id) {
  global $mysql;

  $query = "SELECT * FROM merc_spell_list_entries WHERE merc_spell_list_id=$merc_spell_list_id";
  $results = $mysql->query_mult_assoc($query);

  if ($results) {
    return $results;
  }
  else {
    return null;
  }
}

function get_merc_spell_list_entry($merc_spell_list_entry_id) {
  global $mysql;

  $query = "SELECT * FROM merc_spell_list_entries WHERE merc_spell_list_entry_id=$merc_spell_list_entry_id";
  $result = $mysql->query_assoc($query);

  if ($result) {
    return $result;
  }
  else {
    return null;
  }
}

function insert_merc_spell_list_entry() {
  global $mysql;

  $merc_spell_list_entry_id = $_POST['merc_spell_list_entry_id'];
  $merc_spell_list_id = $_POST['merc_spell_list_id'];
  $spell_id = $_POST['spell_id'];
  $spell_type = $_POST['spell_type'];
  $stance_id = $_POST['stance_id'];
  $minlevel = $_POST['minlevel'];
  $maxlevel = $_POST['maxlevel'];
  $slot = $_POST['slot'];
  $procChance = $_POST['procChance'];

  $query = "INSERT INTO merc_spell_list_entries SET merc_spell_list_entry_id=$merc_spell_list_entry_id, merc_spell_list_id=$merc_spell_list_id, spell_id=$spell_id, spell_type=$spell_type, stance_id=$stance_id, minlevel=$minlevel, maxlevel=$maxlevel, slot=$slot, procChance=$procChance";
  $mysql->query_no_result($query);
}

function update_merc_spell_list_entry() {
  global $mysql;

  $merc_spell_list_entry_id = $_POST['merc_spell_list_entry_id'];
  $merc_spell_list_id = $_POST['merc_spell_list_id'];
  $spell_id = $_POST['spell_id'];
  $spell_type = $_POST['spell_type'];
  $stance_id = $_POST['stance_id'];
  $minlevel = $_POST['minlevel'];
  $maxlevel = $_POST['maxlevel'];
  $slot = $_POST['slot'];
  $procChance = $_POST['procChance'];

  $query = "UPDATE merc_spell_list_entries SET merc_spell_list_id=$merc_spell_list_id, spell_id=$spell_id, spell_type=$spell_type, stance_id=$stance_id, minlevel=$minlevel, maxlevel=$maxlevel, slot=$slot, procChance=$procChance WHERE merc_spell_list_entry_id=$merc_spell_list_entry_id";
  $mysql->query_no_result($query);
}

function delete_merc_spell_list_entry($merc_spell_list_entry_id) {
  global $mysql;

  $query = "DELETE FROM merc_spell_list_entries WHERE merc_spell_list_entry_id=$merc_spell_list_entry_id";
  $mysql->query_no_result($query);
}

function get_merc_npc_types() {
  global $mysql;

  $query = "SELECT * FROM merc_npc_types";
  $results = $mysql->query_mult_assoc($query);

  if ($results) {
    return $results;
  }
  else {
    return null;
  }
}

function get_merc_npc_type($merc_npc_type_id) {
  global $mysql;

  $query = "SELECT * FROM merc_npc_types WHERE merc_npc_type_id=$merc_npc_type_id";
  $result = $mysql->query_assoc($query);

  if ($result) {
    return $result;
  }
  else {
    return null;
  }
}

function insert_merc_npc_type() {
  global $mysql;

  $merc_npc_type_id = $_POST['merc_npc_type_id'];
  $proficiency_id = $_POST['proficiency_id'];
  $tier_id = $_POST['tier_id'];
  $class_id = $_POST['class_id'];
  $name = $_POST['name'];

  $query = "INSERT INTO merc_npc_types SET merc_npc_type_id=$merc_npc_type_id, proficiency_id=$proficiency_id, tier_id=$tier_id, class_id=$class_id, `name`=\"$name\"";
  $mysql->query_no_result($query);
}

function update_merc_npc_type() {
  global $mysql;

  $merc_npc_type_id = $_POST['merc_npc_type_id'];
  $proficiency_id = $_POST['proficiency_id'];
  $tier_id = $_POST['tier_id'];
  $class_id = $_POST['class_id'];
  $name = $_POST['name'];

  $query = "UPDATE merc_npc_types SET proficiency_id=$proficiency_id, tier_id=$tier_id, class_id=$class_id, `name`=\"$name\" WHERE merc_npc_type_id=$merc_npc_type_id";
  $mysql->query_no_result($query);
}

function delete_merc_npc_type($merc_npc_type_id) {
  global $mysql;

  $query = "DELETE FROM merc_stats WHERE merc_npc_type_id=$merc_npc_type_id";
  $mysql->query_no_result($query);

  $query = "DELETE FROM merc_armorinfo WHERE merc_npc_type_id=$merc_npc_type_id";
  $mysql->query_no_result($query);

  $query = "DELETE FROM merc_weaponinfo WHERE merc_npc_type_id=$merc_npc_type_id";
  $mysql->query_no_result($query);

  $query = "DELETE FROM merc_npc_types WHERE merc_npc_type_id=$merc_npc_type_id";
  $mysql->query_no_result($query);
}

function get_merc_name_types() {
  global $mysql;

  $query = "SELECT * FROM merc_name_types";
  $results = $mysql->query_mult_assoc($query);

  if ($results) {
    return $results;
  }
  else {
    return null;
  }
}

function get_merc_name_type($name_type_id, $class_id) {
  global $mysql;

  $query = "SELECT * FROM merc_name_types WHERE name_type_id=$name_type_id AND class_id=$class_id";
  $result = $mysql->query_assoc($query);

  if ($result) {
    return $result;
  }
  else {
    return null;
  }
}

function insert_merc_name_type() {
  global $mysql;

  $name_type_id = $_POST['name_type_id'];
  $class_id = $_POST['class_id'];
  $prefix = $_POST['prefix'];
  $suffix = $_POST['suffix'];

  $query = "INSERT INTO merc_name_types SET name_type_id=$name_type_id, class_id=$class_id, `prefix`=\"$prefix\", suffix=\"$suffix\"";
  $mysql->query_no_result($query);
}

function update_merc_name_type() {
  global $mysql;

  $name_type_id = $_POST['name_type_id'];
  $class_id = $_POST['class_id'];
  $prefix = $_POST['prefix'];
  $suffix = $_POST['suffix'];

  $query = "UPDATE merc_name_types SET `prefix`=\"$prefix\", suffix=\"$suffix\" WHERE name_type_id=$name_type_id AND class_id=$class_id";
  $mysql->query_no_result($query);
}

function delete_merc_name_type($name_type_id, $class_id) {
  global $mysql;

  $query = "DELETE FROM merc_name_types WHERE name_type_id=$name_type_id AND class_id=$class_id";
  $mysql->query_no_result($query);
}

function get_merc_merchant_templates() {
  global $mysql;

  $query = "SELECT * FROM merc_merchant_templates";
  $results = $mysql->query_mult_assoc($query);

  if ($results) {
    return $results;
  }
  else {
    return null;
  }
}

function get_merc_merchant_template($merc_merchant_template_id) {
  global $mysql;

  $query = "SELECT * FROM merc_merchant_templates WHERE merc_merchant_template_id=$merc_merchant_template_id";
  $result = $mysql->query_assoc($query);

  if ($result) {
    return $result;
  }
  else {
    return null;
  }
}

function insert_merc_merchant_template() {
  global $mysql;

  $merc_merchant_template_id = $_POST['merc_merchant_template_id'];
  $name = $_POST['name'];
  $qglobal = $_POST['qglobal'];

  $query = "INSERT INTO merc_merchant_templates SET merc_merchant_template_id=$merc_merchant_template_id, `name`=\"$name\", qglobal=\"$qglobal\"";
  $mysql->query_no_result($query);
}

function update_merc_merchant_template() {
  global $mysql;

  $merc_merchant_template_id = $_POST['merc_merchant_template_id'];
  $name = $_POST['name'];
  $qglobal = $_POST['qglobal'];

  $query = "UPDATE merc_merchant_templates SET `name`=\"$name\", qglobal=\"$qglobal\" WHERE merc_merchant_template_id=$merc_merchant_template_id";
  $mysql->query_no_result($query);
}

function delete_merc_merchant_template($merc_merchant_template_id) {
  global $mysql;

  $query = "DELETE FROM merc_merchant_template_entries WHERE merc_merchant_template_id=$merc_merchant_template_id";
  $mysql->query_no_result($query);

  $query = "DELETE FROM merc_merchant_entries WHERE merc_merchant_template_id=$merc_merchant_template_id";
  $mysql->query_no_result($query);

  $query = "DELETE FROM merc_merchant_templates WHERE merc_merchant_template_id=$merc_merchant_template_id";
  $mysql->query_no_result($query);
}

function get_merc_merchant_template_entries($merc_merchant_template_id) {
  global $mysql;

  $query = "SELECT * FROM merc_merchant_template_entries WHERE merc_merchant_template_id=$merc_merchant_template_id";
  $results = $mysql->query_mult_assoc($query);

  if ($results) {
    return $results;
  }
  else {
    return null;
  }
}

function get_merc_merchant_template_entry($merc_merchant_template_entry_id) {
  global $mysql;

  $query = "SELECT * FROM merc_merchant_template_entries WHERE merc_merchant_template_entry_id=$merc_merchant_template_entry_id";
  $result = $mysql->query_assoc($query);

  if ($result) {
    return $result;
  }
  else {
    return null;
  }
}

function insert_merc_merchant_template_entry() {
  global $mysql;

  $merc_merchant_template_entry_id = $_POST['merc_merchant_template_entry_id'];
  $merc_merchant_template_id = $_POST['merc_merchant_template_id'];
  $merc_template_id = $_POST['merc_template_id'];

  $query = "INSERT INTO merc_merchant_template_entries SET merc_merchant_template_entry_id=$merc_merchant_template_entry_id, merc_merchant_template_id=$merc_merchant_template_id, merc_template_id=$merc_template_id";
  $mysql->query_no_result($query);
}

function update_merc_merchant_template_entry() {
  global $mysql;

  $merc_merchant_template_entry_id = $_POST['merc_merchant_template_entry_id'];
  $merc_merchant_template_id = $_POST['merc_merchant_template_id'];
  $merc_template_id = $_POST['merc_template_id'];

  $query = "UPDATE merc_merchant_template_entries SET merc_merchant_template_id=$merc_merchant_template_id, merc_template_id=$merc_template_id WHERE merc_merchant_template_entry_id=$merc_merchant_template_entry_id";
  $mysql->query_no_result($query);
}

function delete_merc_merchant_template_entry($merc_merchant_template_entry_id) {
  global $mysql;

  $query = "DELETE FROM merc_merchant_template_entries WHERE merc_merchant_template_entry_id=$merc_merchant_template_entry_id";
  $mysql->query_no_result($query);
}

function get_merc_merchant_entries($merc_merchant_template_id) {
  global $mysql;

  $query = "SELECT * FROM merc_merchant_entries WHERE merc_merchant_template_id=$merc_merchant_template_id";
  $results = $mysql->query_mult_assoc($query);

  if ($results) {
    return $results;
  }
  else {
    return null;
  }
}

function get_merc_merchant_entry($merc_merchant_entry_id) {
  global $mysql;

  $query = "SELECT * FROM merc_merchant_entries WHERE merc_merchant_entry_id=$merc_merchant_entry_id";
  $result = $mysql->query_assoc($query);

  if ($result) {
    return $result;
  }
  else {
    return null;
  }
}

function insert_merc_merchant_entry() {
  global $mysql;

  $merc_merchant_entry_id = $_POST['merc_merchant_entry_id'];
  $merc_merchant_template_id = $_POST['merc_merchant_template_id'];
  $merchant_id = $_POST['merchant_id'];

  $query = "INSERT INTO merc_merchant_entries SET merc_merchant_entry_id=$merc_merchant_entry_id, merc_merchant_template_id=$merc_merchant_template_id, merchant_id=$merchant_id";
  $mysql->query_no_result($query);
}

function update_merc_merchant_entry() {
  global $mysql;

  $merc_merchant_entry_id = $_POST['merc_merchant_entry_id'];
  $merc_merchant_template_id = $_POST['merc_merchant_template_id'];
  $merchant_id = $_POST['merchant_id'];

  $query = "UPDATE merc_merchant_entries SET merc_merchant_template_id=$merc_merchant_template_id, merchant_id=$merchant_id WHERE merc_merchant_entry_id=$merc_merchant_entry_id";
  $mysql->query_no_result($query);
}

function delete_merc_merchant_entry($merc_merchant_entry_id) {
  global $mysql;

  $query = "DELETE FROM merc_merchant_entries WHERE merc_merchant_entry_id=$merc_merchant_entry_id";
  $mysql->query_no_result($query);
}

function get_merc_inventory($merc_subtype_id) {
  global $mysql;

  $query = "SELECT * FROM merc_inventory WHERE merc_subtype_id=$merc_subtype_id";
  $results = $mysql->query_mult_assoc($query);

  if ($results) {
    return $results;
  }
  else {
    return null;
  }
}

function get_merc_item($merc_inventory_id) {
  global $mysql;

  $query = "SELECT * FROM merc_inventory WHERE merc_inventory_id=$merc_inventory_id";
  $result = $mysql->query_assoc($query);

  if ($result) {
    return $result;
  }
  else {
    return null;
  }
}

function insert_merc_item() {
  global $mysql;

  $merc_inventory_id = $_POST['merc_inventory_id'];
  $merc_subtype_id = $_POST['merc_subtype_id'];
  $item_id = $_POST['item_id'];
  $min_level = $_POST['min_level'];
  $max_level = $_POST['max_level'];

  $query = "INSERT INTO merc_inventory SET merc_inventory_id=$merc_inventory_id, merc_subtype_id=$merc_subtype_id, item_id=$item_id, min_level=$min_level, max_level=$max_level";
  $mysql->query_no_result($query);
}

function update_merc_item() {
  global $mysql;

  $merc_inventory_id = $_POST['merc_inventory_id'];
  $merc_subtype_id = $_POST['merc_subtype_id'];
  $item_id = $_POST['item_id'];
  $min_level = $_POST['min_level'];
  $max_level = $_POST['max_level'];

  $query = "UPDATE merc_inventory SET merc_subtype_id=$merc_subtype_id, item_id=$item_id, min_level=$min_level, max_level=$max_level WHERE merc_inventory_id=$merc_inventory_id";
  $mysql->query_no_result($query);
}

function delete_merc_item($merc_inventory_id) {
  global $mysql;

  $query = "DELETE FROM merc_inventory WHERE merc_inventory_id=$merc_inventory_id";
  $mysql->query_no_result($query);
}

function get_merc_buffs($MercId) {
  global $mysql;

  $query = "SELECT * FROM merc_buffs WHERE MercId=$MercId";
  $results = $mysql->query_mult_assoc($query);

  if ($results) {
    return $results;
  }
  else {
    return null;
  }
}

function get_merc_buff($MercBuffId) {
  global $mysql;

  $query = "SELECT * FROM merc_buffs WHERE MercBuffId=$MercBuffId";
  $result = $mysql->query_assoc($query);

  if ($result) {
    return $result;
  }
  else {
    return null;
  }
}

function insert_merc_buff() {
  global $mysql;

  $MercBuffId = $_POST['MercBuffId'];
  $MercId = $_POST['MercId'];
  $SpellId = $_POST['SpellId'];
  $CasterLevel = $_POST['CasterLevel'];
  $DurationFormula = $_POST['DurationFormula'];
  $TicsRemaining = $_POST['TicsRemaining'];
  $PoisonCounters = $_POST['PoisonCounters'];
  $DiseaseCounters = $_POST['DiseaseCounters'];
  $CurseCounters = $_POST['CurseCounters'];
  $CorruptionCounters = $_POST['CorruptionCounters'];
  $HitCount = $_POST['HitCount'];
  $MeleeRune = $_POST['MeleeRune'];
  $MagicRune = $_POST['MagicRune'];
  $dot_rune = $_POST['dot_rune'];
  $caston_x = $_POST['caston_x'];
  $Persistent = $_POST['Persistent'];
  $caston_y = $_POST['caston_y'];
  $caston_z = $_POST['caston_z'];
  $ExtraDIChance = $_POST['ExtraDIChance'];

  $query = "INSERT INTO merc_buffs SET MercBuffId=$MercBuffId, MercId=$MercId, SpellId=$SpellId, CasterLevel=$CasterLevel, DurationFormula=$DurationFormula, TicsRemaining=$TicsRemaining, PoisonCounters=$PoisonCounters, DiseaseCounters=$DiseaseCounters, CurseCounters=$CurseCounters, CorruptionCounters=$CorruptionCounters, HitCount=$HitCount, MeleeRune=$MeleeRune, MagicRune=$MagicRune, dot_rune=$dot_rune, caston_x=$caston_x, Persistent=$Persistent, caston_y=$caston_y, caston_z=$caston_z, ExtraDIChance=$ExtraDIChance";
  $mysql->query_no_result($query);
}

function update_merc_buff() {
  global $mysql;

  $MercBuffId = $_POST['MercBuffId'];
  $MercId = $_POST['MercId'];
  $SpellId = $_POST['SpellId'];
  $CasterLevel = $_POST['CasterLevel'];
  $DurationFormula = $_POST['DurationFormula'];
  $TicsRemaining = $_POST['TicsRemaining'];
  $PoisonCounters = $_POST['PoisonCounters'];
  $DiseaseCounters = $_POST['DiseaseCounters'];
  $CurseCounters = $_POST['CurseCounters'];
  $CorruptionCounters = $_POST['CorruptionCounters'];
  $HitCount = $_POST['HitCount'];
  $MeleeRune = $_POST['MeleeRune'];
  $MagicRune = $_POST['MagicRune'];
  $dot_rune = $_POST['dot_rune'];
  $caston_x = $_POST['caston_x'];
  $Persistent = $_POST['Persistent'];
  $caston_y = $_POST['caston_y'];
  $caston_z = $_POST['caston_z'];
  $ExtraDIChance = $_POST['ExtraDIChance'];

  $query = "UPDATE merc_buffs SET MercId=$MercId, SpellId=$SpellId, CasterLevel=$CasterLevel, DurationFormula=$DurationFormula, TicsRemaining=$TicsRemaining, PoisonCounters=$PoisonCounters, DiseaseCounters=$DiseaseCounters, CurseCounters=$CurseCounters, CorruptionCounters=$CorruptionCounters, HitCount=$HitCount, MeleeRune=$MeleeRune, MagicRune=$MagicRune, dot_rune=$dot_rune, caston_x=$caston_x, Persistent=$Persistent, caston_y=$caston_y, caston_z=$caston_z, ExtraDIChance=$ExtraDIChance WHERE MercBuffId=$MercBuffId";
  $mysql->query_no_result($query);
}

function delete_merc_buff($MercBuffId) {
  global $mysql;

  $query = "DELETE FROM merc_buffs WHERE MercBuffId=$MercBuffId";
  $mysql->query_no_result($query);
}

function get_merc_armor($merc_npc_type_id) {
  global $mysql;

  $query = "SELECT * FROM merc_armorinfo WHERE merc_npc_type_id=$merc_npc_type_id";
  $results = $mysql->query_mult_assoc($query);

  if ($results) {
    return $results;
  }
  else {
    return null;
  }
}

function get_merc_armor_info($id) {
  global $mysql;

  $query = "SELECT * FROM merc_armorinfo WHERE id=$id";
  $result = $mysql->query_assoc($query);

  if ($result) {
    return $result;
  }
  else {
    return null;
  }
}

function insert_merc_armor() {
  global $mysql;

  $id = $_POST['id'];
  $merc_npc_type_id = $_POST['merc_npc_type_id'];
  $minlevel = $_POST['minlevel'];
  $maxlevel = $_POST['maxlevel'];
  $texture = $_POST['texture'];
  $helmtexture = $_POST['helmtexture'];
  $armortint_id = $_POST['armortint_id'];
  $armortint_red = $_POST['armortint_red'];
  $armortint_green = $_POST['armortint_green'];
  $armortint_blue = $_POST['armortint_blue'];

  $query = "INSERT INTO merc_armorinfo SET id=$id, merc_npc_type_id=$merc_npc_type_id, minlevel=$minlevel, maxlevel=$maxlevel, texture=$texture, helmtexture=$helmtexture, armortint_id=$armortint_id, armortint_red=$armortint_red, armortint_green=$armortint_green, armortint_blue=$armortint_blue";
  $mysql->query_no_result($query);
}

function update_merc_armor() {
  global $mysql;

  $id = $_POST['id'];
  $merc_npc_type_id = $_POST['merc_npc_type_id'];
  $minlevel = $_POST['minlevel'];
  $maxlevel = $_POST['maxlevel'];
  $texture = $_POST['texture'];
  $helmtexture = $_POST['helmtexture'];
  $armortint_id = $_POST['armortint_id'];
  $armortint_red = $_POST['armortint_red'];
  $armortint_green = $_POST['armortint_green'];
  $armortint_blue = $_POST['armortint_blue'];

  $query = "UPDATE merc_armorinfo SET merc_npc_type_id=$merc_npc_type_id, minlevel=$minlevel, maxlevel=$maxlevel, texture=$texture, helmtexture=$helmtexture, armortint_id=$armortint_id, armortint_red=$armortint_red, armortint_green=$armortint_green, armortint_blue=$armortint_blue WHERE id=$id";
  $mysql->query_no_result($query);
}

function delete_merc_armor($id) {
  global $mysql;

  $query = "DELETE FROM merc_armorinfo WHERE id=$id";
  $mysql->query_no_result($query);
}

function suggest_merc_id() {
  global $mysql;

  $query = "SELECT MAX(MercID) AS id FROM mercs";
  $result = $mysql->query_assoc($query);

  return ($result) ? $result['id'] + 1 : 1;
}

function suggest_merc_weapon_id() {
  global $mysql;

  $query = "SELECT MAX(id) AS id FROM merc_weaponinfo";
  $result = $mysql->query_assoc($query);

  return ($result) ? $result['id'] + 1 : 1;
}

function suggest_merc_type_id() {
  global $mysql;

  $query = "SELECT MAX(merc_type_id) AS id FROM merc_types";
  $result = $mysql->query_assoc($query);

  return ($result) ? $result['id'] + 1 : 1;
}

function suggest_merc_template_id() {
  global $mysql;

  $query = "SELECT MAX(merc_template_id) AS id FROM merc_templates";
  $result = $mysql->query_assoc($query);

  return ($result) ? $result['id'] + 1 : 1;
}

function suggest_merc_subtype_id() {
  global $mysql;

  $query = "SELECT MAX(merc_subtype_id) AS id FROM merc_subtypes";
  $result = $mysql->query_assoc($query);

  return ($result) ? $result['id'] + 1 : 1;
}

function suggest_merc_stance_entry_id() {
  global $mysql;

  $query = "SELECT MAX(merc_stance_entry_id) AS id FROM merc_stance_entries";
  $result = $mysql->query_assoc($query);

  return ($result) ? $result['id'] + 1 : 1;
}

function suggest_merc_spell_list_id() {
  global $mysql;

  $query = "SELECT MAX(merc_spell_list_id) AS id FROM merc_spell_lists";
  $result = $mysql->query_assoc($query);

  return ($result) ? $result['id'] + 1 : 1;
}

function suggest_merc_spell_list_entry_id() {
  global $mysql;

  $query = "SELECT MAX(merc_spell_list_entry_id) AS id FROM merc_spell_list_entries";
  $result = $mysql->query_assoc($query);

  return ($result) ? $result['id'] + 1 : 1;
}

function suggest_merc_npc_type_id() {
  global $mysql;

  $query = "SELECT MAX(merc_npc_type_id) AS id FROM merc_npc_types";
  $result = $mysql->query_assoc($query);

  return ($result) ? $result['id'] + 1 : 1;
}

function suggest_merc_name_type_id() {
  global $mysql;

  $query = "SELECT MAX(name_type_id) AS id FROM merc_name_types";
  $result = $mysql->query_assoc($query);

  return ($result) ? $result['id'] + 1 : 1;
}

function suggest_merc_merchant_template_id() {
  global $mysql;

  $query = "SELECT MAX(merc_merchant_template_id) AS id FROM merc_merchant_templates";
  $result = $mysql->query_assoc($query);

  return ($result) ? $result['id'] + 1 : 1;
}

function suggest_merc_merchant_template_entry_id() {
  global $mysql;

  $query = "SELECT MAX(merc_merchant_template_entry_id) AS id FROM merc_merchant_template_entries";
  $result = $mysql->query_assoc($query);

  return ($result) ? $result['id'] + 1 : 1;
}

function suggest_merc_merchant_entry_id() {
  global $mysql;

  $query = "SELECT MAX(merc_merchant_entry_id) AS id FROM merc_merchant_entries";
  $result = $mysql->query_assoc($query);

  return ($result) ? $result['id'] + 1 : 1;
}

function suggest_merc_inventory_id() {
  global $mysql;

  $query = "SELECT MAX(merc_inventory_id) AS id FROM merc_inventory";
  $result = $mysql->query_assoc($query);

  return ($result) ? $result['id'] + 1 : 1;
}

function suggest_merc_buff_id() {
  global $mysql;

  $query = "SELECT MAX(MercBuffId) AS id FROM merc_buffs";
  $result = $mysql->query_assoc($query);

  return ($result) ? $result['id'] + 1 : 1;
}

function suggest_merc_armor_id() {
  global $mysql;

  $query = "SELECT MAX(id) AS id FROM merc_armorinfo";
  $result = $mysql->query_assoc($query);

  return ($result) ? $result['id'] + 1 : 1;
}

function suggest_merc_stat_clientlevel($merc_npc_type_id) {
  global $mysql;

  $query = "SELECT MAX(clientlevel) AS clientlevel FROM merc_stats WHERE merc_npc_type_id=$merc_npc_type_id";
  $result = $mysql->query_assoc($query);

  return ($result) ? $result['clientlevel'] + 1 : 1;
}
?>