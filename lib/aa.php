<?php

$defaultvalues = array(
  'skill_id'  =>  "",
  'name'   =>  "",
  'cost'   =>  "0",
  'max_level'   =>  "1",
  'hotkey_sid'   =>  "0",
  'hotkey_sid2'   =>  "0",
  'title_sid'   =>  "0",
  'desc_sid'   =>  "0",
  'type'   =>  "1",
  'spellid'   =>  "4294967295",
  'prereq_skill'   =>  "0",
  'prereq_minpoints'   =>  "0",
  'spell_type'   =>  "0",
  'spell_refresh'   =>  "0",
  'classes'   =>  "65534",
  'berserker'   =>  "1",
  'class_type'   =>  "0",
  'cost_inc'   =>  "0",
  'aa_expansion'   =>  "3",
  'special_category'   =>  "4294967295",
  'sof_type'   =>  "1",
  'sof_cost_inc'   =>  "0",
  'sof_max_level'   =>  "1",
  'sof_next_skill'   =>  "0",
  'clientver'   =>  "1",
  'account_time_required'   =>  "0",
  'sof_current_level'   =>  "0",
  'sof_next_id'   =>  "0",
  'level_inc'   =>  "0"
);

$aa_type = array (
  0  =>  "Not Applicable",
  1  =>  "General",
  2  =>  "Archetype",
  3  =>  "Class",
  4  =>  "PoP Advanced",
  5  =>  "PoP Abilities",
  6  =>  "Gates of Discord",
  7  =>  "Omens of War",
  8  =>  "Veteran",
  9  =>  "Dragons of Norrath",
  10  =>  "Depths of Darkhollow"
);

$aa_sof_type = array (
  1  =>  "General",
  2  =>  "Archetype",
  3  =>  "Class",
  4  =>  "Special"
);

$aa_sof_expansion = array (
  523  =>  "Drakkin Red",
  524  =>  "Drakkin Black",
  525  =>  "Drakkin Blue",
  526  =>  "Drakkin Green",
  527  =>  "Drakkin White",
  528  =>  "Drakkin Gold"
);

$aa_special_category = array (
  '3'  =>  "Shroud Passive",
  '4'  =>  "Shroud Active",
  '5'  =>  "Veteran Reward",
  '6'  =>  "Tradeskill",
  '7'  =>  "Expendable",
  '8'  =>  "Racial Innate",
  '4294967295'  =>  "None"
);

$aa_action_target = array (
  '0'  =>  "None",
  '1'  =>  "Self",
  '2'  =>  "Current Target",
  '3'  =>  "Caster Group",
  '4'  =>  "Group of Target",
  '5'  =>  "Caster Pet"
);


switch ($action) {
  case 0:  // View AA
    check_authorization();
    $aaref = (isset($_GET['aaref']) ? $_GET['aaref'] : null);
    if ($aaid) {
      $body = new Template("templates/aa/aa.tmpl.php");
      $body->set('aaid', $aaid);
      $body->set('yesno', $yesno);
      $body->set('eqexpansions', $eqexpansions);
      $body->set('sp_effects', $sp_effects);
      $body->set('aa_type', $aa_type);
      $body->set('aa_sof_type', $aa_sof_type);
      $body->set('aa_sof_expansion', $aa_sof_expansion);
      $body->set('aa_special_category', $aa_special_category);
      $body->set('aa_action_target', $aa_action_target);
      
      if ($aaref) {
        $name = getNameByID($aaref);
        $body->set('aaref', $aaref);
        $body->set('aarefname', ($name)? $name : "Not Found");
      } else {
        $body->set('aaref', null);
        $body->set('aarefname', null);
      }
      // Provide initial values for the aa vars to avoid not set notices
      $body->set('aa_vars', $defaultvalues);
      $body->set('aa_actions', null);
      $body->set('aa_effects', null);
      $body->set('aa_cost', null);
      $body->set('aa_prev', null);
      $body->set('aa_next', null);
      $vars = aa_info();
      if ($vars) {
        foreach ($vars as $key=>$value) {
          $body->set($key, $value);
        }
      }
    }
    else {
      $body = new Template("templates/aa/aa.default.tmpl.php");
    }
    break;
  case 1:  // Search AAs
    check_authorization();
    $body = new Template("templates/aa/aa.searchresults.tmpl.php");
    if (isset($_GET['aaid']) && $_GET['aaid'] != "ID") {
      $results = findByID($_GET['aaid']);
    }
    else {
      $results = findByName($_GET['search']);
    }
    $body->set("results", $results);
    $body->set('eqexpansions', $eqexpansions);
    break;
  case 28: // Search by expansion / class
    check_authorization();
    $cls = (isset($_GET['cls']) ? $_GET['cls'] : null);
    $exp = (isset($_GET['exp']) ? $_GET['exp'] : null);
    $body = new Template("templates/aa/aa.searchresults.tmpl.php");
    $body->set('eqexpansions', $eqexpansions);
    $body->set('results', null);
    if ($cls != null && $exp != null) {
      $results = findByClsExp($cls, $exp);
      $body->set('results', $results);
    }
    break;
  case 2:  // Edit AA
    check_authorization();
    if ($aaid) {
      $body = new Template("templates/aa/aa.editbase.tmpl.php");
      $body->set('editmode', 1);
      $body->set('aaid', $aaid);
      $body->set('aa_type', $aa_type);
      $body->set('aa_sof_type', $aa_sof_type);
      $body->set('eqexpansions', $eqexpansions);
      $body->set('aa_sof_expansion', $aa_sof_expansion);
      $body->set('aa_special_category', $aa_special_category);
      $vars = getBaseAAInfo($aaid);
      if ($vars) {
        $body->set('aa_vars', $vars);
      }
      $body->set('errors', null);
    } else {
      $body = new Template("templates/aa/aa.default.tmpl.php");
    }
    break;
  case 3:  // Add new AA
    check_authorization();
    $body = new Template("templates/aa/aa.editbase.tmpl.php");
    $body->set('editmode', 2);
    $body->set('aa_type', $aa_type);
    $body->set('aa_sof_type', $aa_sof_type);
    $body->set('eqexpansions', $eqexpansions);
    $body->set('aa_sof_expansion', $aa_sof_expansion);
    $body->set('aa_special_category', $aa_special_category);
    $body->set('aa_vars', $defaultvalues);
    $body->set('errors', null);
    break;
  case 4: // Edit aa_action for rank
    check_authorization();
    $rank = (isset($_GET['rank']) ? $_GET['rank'] : null);
    $body = new Template("templates/aa/aa_action.edit.tmpl.php");
    $body->set('aa_action_target', $aa_action_target);
    $vars = getActionForRank($aaid, $rank);
    foreach($vars as $k => $v) {
      $body->set($k, $v);
    }
    $body->set('aaid', $aaid);
    $body->set('rank', $rank);
    $body->set('editmode', 1);
    break;
  case 5: // Add new aa_action to rank
    check_authorization();
    $rank = (isset($_GET['rank']) ? $_GET['rank'] : null);
    $body = new Template("templates/aa/aa_action.edit.tmpl.php");
      $body->set('aa_action_target', $aa_action_target);
    $body->set('editmode', 2);
    $body->set('reuse_time', '0');
    $body->set('spell_id', '0');
    $body->set('target', '0');
    $body->set('nonspell_action', '0');
    $body->set('nonspell_mana', '0');
    $body->set('nonspell_duration', '0');
    $body->set('redux_aa', '0');
    $body->set('redux_rate', '0');
    $body->set('redux_aa2', '0');
    $body->set('redux_rate2', '0');
    $body->set('aaid', $aaid);
    $body->set('rank', $rank);
    break;
  case 6: // Edit AA effect slot for rank
    check_authorization();
    // We use the actual ID of the aa_effect entry to pinpoint
    // what we're editing.
    $aaeffectid = (isset($_GET['aaeffectid']) ? $_GET['aaeffectid'] : null);
    $rank = (isset($_GET['rank']) ? $_GET['rank'] : null);
    if ($aaid && $rank && $aaeffectid) {
      $vars = getAAEffectInfo($aaeffectid);
      $aa_vars = getBaseAAInfo($aaid);
      if ($vars && $aa_vars && $rank <= $aa_vars['max_level']) {
        $body = new Template("templates/aa/aa_effect.edit.tmpl.php");
        $body->set('editmode', 1);
        foreach($vars as $k => $v)
          $body->set($k, $v);
        $body->set('rank_max', $aa_vars['max_level']);
        $body->set('rank', $rank);
        $body->set('sp_effects', $sp_effects);
        $body->set('oldid', $vars['id']);
      } else {
        // Reload the AA page since the data doesn't exist any longer.
        $loc = "Location: index.php?editor=aa&aaid=$aaid";
        if ($rank)
          $loc .= "#rank$rank";
        header($loc);
      }
    } else 
      if ($aaid)
        header("Location: index.php?editor=aa&aaid=$aaid");
      else
        header("Location: index.php?editor=aa");
    break;
  case 7: // Add AA effect slot for rank
    check_authorization();
    // If we don't have aaid and rank then punt the user to the 
    // base AA template.
    // If we're provided a slot parameter then we treat that as
    // a suggestion to fill in as a preset in the form.
    $rank = (isset($_GET['rank']) ? $_GET['rank'] : null);
    //$slot = (isset($_GET['slot']) ? $_GET['slot'] : null);
    if ($aaid && $rank) {
      $aa_vars = getBaseAAInfo($aaid);
      $maxslot = getMaxEffectSlotByRank($aaid, $rank);
      if ($aa_vars && $rank <= $aa_vars['max_level']) {
        $body = new Template("templates/aa/aa_effect.edit.tmpl.php");
        $body->set('editmode', 2);
        $body->set('sp_effects', $sp_effects);
        $body->set('id', '');
        $body->set('rank_max', $aa_vars['max_level']);
        $body->set('rank', $rank);
        $body->set('slot', (($maxslot)? $maxslot+1 : '1'));
        $body->set('effectid', '');
        $body->set('aaid', $aaid+$rank-1);
        $body->set('base1', '');
        $body->set('base2', '');
        $body->set('oldid', '');
      }
    }
    break;
  case 8: // Remove AA effect slot from rank
    check_authorization();
    // aaeffectid is what we use to delete the correct one from the DB.
    // aaid and rank are sent as navigation aids.
    $aaeffectid = (isset($_GET['aaeffectid']) ? $_GET['aaeffectid'] : null);
    $rank = (isset($_GET['rank']) ? $_GET['rank'] : null);
    if ($aaeffectid) {
      deleteEffectSlot($aaeffectid);
    }
    // Check if we have any navigaton markers provided so we can jump
    // right back to where we've been editing.
    if ($aaid) {
      $loc = "Location: index.php?editor=aa&aaid=$aaid";
      if ($rank) {
        $loc .= "#rank$rank";
      }
      header($loc);
    } else {
      header("Location: index.php?editor=aa");
    }
    break;
  case 9: // Remove all AA effect slots for rank
    check_authorization();
    $rank = (isset($_GET['rank']) ? $_GET['rank'] : null);
    if ($aaid && $rank) {
      deleteAllEffectsFromRank($aaid, $rank);
    }
    $loc = "Location: index.php?editor=aa";
    if ($aaid) {
      $loc .= "&aaid=$aaid";
    }
    if ($rank) {
      $loc .= "#rank$rank";
    }
    header($loc);
    break;
  case 10: // Remove aa_action for rank
    check_authorization();
    $rank = (isset($_GET['rank']) ? $_GET['rank'] : null);
    if ($aaid && $rank) {
      deleteActionFromRank($aaid, $rank);
    }
    $loc = "Location: index.php?editor=aa";
    if ($aaid) {
      $loc .= "&aaid=$aaid";
    }
    if ($rank) {
      $loc .= "#rank$rank";
    }
    header($loc);
    break;
  case 11: // Remove all aa_actions
    check_authorization();
    header("Location: index.php?editor=aa&aaid=$aaid");
    break;
  case 12: // Remove all aa_effects for all ranks
    check_authorization();
    header("Location: index.php?editor=aa&aaid=$aaid");
    break;
  case 13: // update aa_effect slot for rank
    check_authorization();
    $rank = (isset($_GET['rank']) ? $_GET['rank'] : null);
    if ($aaid && $rank) {
      $aa_vars = getBaseAAInfo($aaid);
      if ($aa_vars && $rank>0 && $rank<=$aa_vars['max_level']) {
        $aa_effect = build_aa_effect_from_post();
        $aa_effect['old_aaid'] = $aaid;
        updateEffectSlot($aa_effect);
      }
    }
    header("Location: index.php?editor=aa&aaid=$aaid#rank$rank");
    break;
  case 14: // update aa_action for rank
    check_authorization();
    $rank = (isset($_GET['rank']) ? $_GET['rank'] : null);
    $vars = build_aa_action_from_post();
    updateActionForRank($aaid, $rank, $vars);
    header("Location: index.php?editor=aa&aaid=$aaid#rank$rank");
    break;
  case 15: // update base information for AA
    check_authorization();
    $aa_vars = build_aa_vars_from_post();
    $errors = update_aabase($aa_vars, $aaid);
    if ($errors) {
      $body = new Template("templates/aa/aa.editbase.tmpl.php");
      $body->set('editmode', 2);
      $body->set('aa_type', $aa_type);
      $body->set('aa_sof_type', $aa_sof_type);
      $body->set('eqexpansions', $eqexpansions);
      $body->set('aa_sof_expansion', $aa_sof_expansion);
      $body->set('aa_special_category', $aa_special_category);
      $body->set('aa_vars', $aa_vars);
      $body->set('errors', $errors);
    } else {
      header("Location: index.php?editor=aa&aaid=$aaid");
    }
    break;
  case 16: // insert new AA into DB
    check_authorization();
    $aa_vars = build_aa_vars_from_post();
    $errors = insert_aabase($aa_vars);
    $newid = $aa_vars['skill_id'];
    if ($errors) {
      $body = new Template("templates/aa/aa.editbase.tmpl.php");
      $body->set('editmode', 2);
      $body->set('aa_type', $aa_type);
      $body->set('aa_sof_type', $aa_sof_type);
      $body->set('eqexpansions', $eqexpansions);
      $body->set('aa_sof_expansion', $aa_sof_expansion);
      $body->set('aa_special_category', $aa_special_category);
      $body->set('aa_vars', $aa_vars);
      $body->set('errors', $errors);
    } else {
      header("Location: index.php?editor=aa&aaid=$newid");
    }
    break;
  case 17: // insert new aa_effect slot for rank into the DB
    check_authorization();
    $rank = (isset($_GET['rank']) ? $_GET['rank'] : null);
    if ($aaid && $rank) {
      $aa_vars = getBaseAAInfo($aaid);
      if ($aa_vars && $rank>0 && $rank<=$aa_vars['max_level']) {
        $aa_effect = build_aa_effect_from_post();
        $aa_effect['old_aaid'] = $aaid;
        updateEffectSlot($aa_effect);
      }
    }
    header("Location: index.php?editor=aa&aaid=$aaid#rank$rank");
    break;
  case 18: // insert new aa_action for rank into the DB
    check_authorization();
    $rank = (isset($_GET['rank']) ? $_GET['rank'] : null);
    $vars = build_aa_action_from_post();
    addActionToRank($aaid, $rank, $vars);
    header("Location: index.php?editor=aa&aaid=$aaid#rank$rank");
    break;
  case 19: // edit cost and level for rank
    check_authorization();
    $rank = (isset($_GET['rank']) ? $_GET['rank'] : null);
    if ($aaid && $rank) {
      $vars = get_level_cost($aaid, $rank);
      if ($vars) {
        $body = new Template("templates/aa/aa_level.edit.tmpl.php");
        foreach($vars as $k => $v) {
          $body->set($k, $v);
        }
        $body->set('aaid', $aaid);
        $body->set('rank', $rank);
      } else {
        $aa_vars = getBaseAAInfo($aaid);
        if ($aa_vars && $rank <= $aa_vars['max_level'] && $rank > 0) {
          $body = new Template("templates/aa/aa_level.edit.tmpl.php");
          $body->set('cost', ($aa_vars['cost']+(($rank-1) * $aa_vars['cost_inc'])));
          $body->set('level', ($aa_vars['class_type']+(($rank-1) * $aa_vars['level_inc'])));
          $body->set('description', $aa_vars['name']);
          $body->set('aaid', $aaid);
          $body->set('rank', $rank);
        } else {
          $body = new Template("templates/aa/aa.default.tmpl.php");
        }
      }
    } else {
      $body = new Template("templates/aa/aa.default.tmpl.php");
    }
    break;
  case 20: // update cost and level for a rank (post from the form)
    check_authorization();
    $level = $_POST['level'];
    $cost = $_POST['cost'];
    $desc = $_POST['description'];
    $rank = (isset($_GET['rank']) ? $_GET['rank'] : null);
    if ($aaid && $rank) {
      update_level_cost($aaid, $rank, $level, $cost, $desc);
    }
    header("Location: index.php?editor=aa&aaid=$aaid#rank$rank");
    break;
  case 21: // Delete specific cost and level for a rank.
    check_authorization();
    $rank = (isset($_GET['rank']) ? $_GET['rank'] : null);
    if ($aaid && $rank) {
      delete_level_cost($aaid, $rank);
    }
    header("Location: index.php?editor=aa&aaid=$aaid#rank$rank");
    break;
  case 22: // Delete AA -- remove it from all 4 AA tables
    check_authorization();
    deleteCompleteAA($aaid);
    header("Location: index.php?editor=aa");
    break;
  case 23: // Copy aa_effect slots from a different rank.
    check_authorization();
    $rank = (isset($_GET['rank']) ? $_GET['rank'] : null);
    $fromaaid = (isset($_POST['aaid']) ? $_POST['aaid'] : null);
    $fromrank = (isset($_POST['rank']) ? $_POST['rank'] : null);
    if ($aaid && $rank && $fromaaid) {
      if ($fromaaid == '' || $fromaaid == 'AA ID')
        copyEffectSlots($aaid, $fromrank, $aaid, $rank);
      else
        copyEffectSlots($fromaaid, $fromrank, $aaid, $rank);
      header("Location: index.php?editor=aa&aaid=$aaid#rank$rank");
    } else 
      header("Location: index.php?editor=aa&aaid=$aaid");
    break;
  case 24: // insert AA into sof list
    check_authorization();
    // post data used to update
    // - aa_add: What we're adding
    // - aa_anchor: Where we're inserting
    // - before: 2 - insert before anchor, 1 - insert after
    // - movetype: 1 - insert the AA, 2 - move it from where it was.
    $aa_add = (isset($_POST['aa_add']) ? intval($_POST['aa_add']) : null);
    $aa_anchor = (isset($_POST['aa_anchor']) ? intval($_POST['aa_anchor']) : null);
    $before = (isset($_POST['before']) ? $_POST['before'] : null);
    $movetype = (isset($_POST['movetype']) ? $_POST['movetype'] : null);
    if ($aa_add && $aa_anchor && $before != null && $aaid && $aa_add != $aa_anchor) {
      $anchor_vars = getBaseAAInfo($aa_anchor);
      $add_vars = getBaseAAInfo($aa_add);
      if ($anchor_vars && $add_vars) {
        if($before == 1) { // insert after
          if ($movetype == 2) {
            // We're moving instead of just inserting.
            // We need to fix the next list for where we're taking the AA from.
            setAllNextByNext($aa_add, $add_vars['sof_next_id']);
          }
          setNextID($aa_add, $anchor_vars['sof_next_id']);
          setNextID($aa_anchor, $aa_add);
        } else {
          // insert before.
          if ($movetype == 2) {
            setAllNextByNext($aa_add, $add_vars['sof_next_id']);
          }
          // We update all prev references.
          setAllNextByNext($aa_anchor, $aa_add);
          setNextID($aa_add, $aa_anchor);
        }
      }// else {
        // TODO: Throw some kind of error.
      //  $body= "<center><br><br>aa_add: $aa_add<br>aa_anchor: $aa_anchor<br></center>";
      //}
    }
    header("Location: index.php?editor=aa&aaid=$aaid");
    break;
  case 25: // unset next_id for AA
    // This is meant to be used for cases where you have multiple AAs
    // listed in a prev_row, so you can just remove extras by clicking
    // on one icon. It can also be used to remove next_ids that go nowhere.
    // (They have a Not Found result.)
    //
    // aaref is the AA where we want to unset the next_id for (needed because
    // we may not be operating on the main body AA)
    //
    // We will pass back the just removed ID as aaref so it is easily available
    // for either reinserting or clicking to also fix that line.
    check_authorization();
    if ($aaid) {
      $aaref = (isset($_GET['aaref']) ? $_GET['aaref'] : null);
      $aarefdata = null;
      $oldnext = null;
      if ($aaref) {
        // Sanity check if the aaref actually exists.
        $aaref_data = getBaseAAInfo($aaref);
        if ($aaref_data) {
          $oldnext = $aaref_data['sof_next_id'];
          setNextID($aaref, 0);
        }
      }
      if ($aaref && $aaref == $aaid) {
        // We are removing the entire next tree of the current aaid
        // Point the reference to the next id instead, in case this was
        // done in error.
        $aaref = $oldnext;
      }
      
      $loc = "Location: index.php?editor=aa&aaid=$aaid";
      if ($aaref)
        $loc .= "&aaref=$aaref";
      header($loc);
    } else {
      header("Location: index.php?editor=aa");
    }
    break;
  case 26: // Remove the AA from the SoF group
    // If there is a previous AA then it will have it's next_id set to what
    // this has for next_id. Next id for the removed AA is set to 0
    //
    // aaref is the ID of the actual AA we're removing. This is so that we
    // can be used on any entry in the SoF AA Group list.
    check_authorization();
    if ($aaid) {
      $aaref = (isset($_GET['aaref']) ? $_GET['aaref'] : null);
      $aarefdata = null;
      $oldnext = null;
      if ($aaref) {
        // Sanity check if the aaref actually exists.
        $aaref_data = getBaseAAInfo($aaref);
        if ($aaref_data) {
          $oldnext = $aaref_data['sof_next_id'];
          setAllNextByNext($aaref, $oldnext);
          setNextID($aaref, 0);
        }
      }      
      $loc = "Location: index.php?editor=aa&aaid=$aaid";
      if ($aaref && $aaid != $aaref)
        $loc .= "&aaref=$aaref";
      header($loc);
    } else {
      header("Location: index.php?editor=aa");
    }
    break;
  case 27: // Fix SoF offset and max level
    check_authorization();
    fixOffsetMax($aaid);
    header("Location: index.php?editor=aa&aaid=$aaid");
    break;
}

function aa_info () {
  global $mysql, $aaid;
  $aa_array = array();
//  $aa_vars_array = array();
  $aa_actions_array = array();
  $aa_effects_array = array();
  $aa_cost_array = array();
  $aa_ranks_array = array();

  //Load from altadv_vars
  $aa_vars_array = getBaseAAInfo($aaid);
  $aa_range = $aaid;
  if ($aa_vars_array) { 
    $aa_array['aa_vars'] = $aa_vars_array;
    $aa_range = $aaid+$aa_vars_array['max_level']-1;
  }
  

  //Load from aa_actions
  $query = "SELECT * FROM aa_actions WHERE aaid=$aaid";
  $aa_actions_array = $mysql->query_mult_assoc($query);
  if ($aa_actions_array) {
    $aa_array['aa_actions'] = $aa_actions_array;
  }

  //Load from aa_effects
  $query = "SELECT * FROM aa_effects WHERE aaid between $aaid and $aa_range";
  $aa_effects_array = $mysql->query_mult_assoc($query);
  if ($aa_effects_array) {
    $aa_array['aa_effects'] = $aa_effects_array;
  }

  //Load from aa_required_level_cost
  $query = "SELECT * FROM aa_required_level_cost WHERE skill_id between $aaid and $aa_range";
  $aa_cost_array = $mysql->query_mult_assoc($query);
  if ($aa_cost_array) {
    $aa_array['aa_cost'] = $aa_cost_array;
  }
  
  if ($aa_vars_array && $aa_vars_array['prereq_skill'] != 0 && $aa_vars_array['prereq_skill'] != 4294967295) {
    // Send the full info on the prereq so we can do error checking.
    $prereq_aa_name = getBaseAAInfo($aa_vars_array['prereq_skill']);
    if ($prereq_aa_name) {
      $aa_array['prereq_name'] = $prereq_aa_name;
    } else {
      $aa_array['prereq_name'] = null;
    }
  }
  
  $aa_prev = getPrevAAsArray($aaid);
  if ($aa_prev)
    $aa_array['aa_prev'] = $aa_prev;

  if ($aa_vars_array) {
    $aa_next = getNextAAsArray($aa_vars_array['sof_next_id']);
    if ($aa_next)
      $aa_array['aa_next'] = $aa_next;
  }
  
  return $aa_array;
}

function getAAEffectInfo($aaeffectid) {
  global $mysql;
  
  $query = "SELECT * FROM aa_effects WHERE id=$aaeffectid";
  return $mysql->query_assoc($query);
}

function getMaxEffectSlotByRank($aaid, $rank) {
  global $mysql;
  $id = $aaid+$rank-1;
  
  $query = "SELECT max(slot) as maxslot FROM aa_effects WHERE aaid=$id";
  $res = $mysql->query_assoc($query);
  if ($res)
    return $res['maxslot'];
}

function setNextID($id, $next) {
  global $mysql;
  
  $query = "UPDATE altadv_vars SET sof_next_id=$next WHERE skill_id=$id";
  $mysql->query_no_result($query);
}

function setAllNextByNext($old, $next) {
  global $mysql;
  
  $query = "UPDATE altadv_vars SET sof_next_id=$next WHERE sof_next_id=$old";
  $mysql->query_no_result($query);
}

function deleteAllEffectsFromRank($aaid, $rank) {
  global $mysql;
  $id = $aaid+$rank-1;
  
  $query = "DELETE FROM aa_effects WHERE aaid=$id";
  $mysql->query_no_result($query);
}

function deleteAllEffectSlots($aaid, $maxrank) {
  global $mysql;
  $range = $aaid+$maxrank-1;
  
  $query = "DELETE FROM aa_effects WHERE aaid BETWEEN $aaid AND $range";
  $mysql->query_no_result($query);
}

function deleteEffectSlot($id) {
  global $mysql;
  
  $query = "DELETE FROM aa_effects WHERE id=$id";
  $mysql->query_no_result($query);
}

function copyEffectSlots($fromaaid, $fromrank, $aaid, $rank) {
  global $mysql;
  
  $fromid = $fromaaid + $fromrank - 1;
  $toid = $aaid+$rank-1;
  
  $query = "INSERT INTO aa_effects (aaid, slot, effectid, base1, base2)
            SELECT $toid, slot, effectid, base1, base2 FROM aa_effects WHERE aaid=$fromid";
  $mysql->query_no_result($query);
  
}

function updateEffectSlot($aa_effect) {
  global $mysql;
  extract($aa_effect);
  
  $aaid = null;
  if ($ranksel == 'useraw') {
    $aaid = $raw_aaid;
  } else {
    $aaid = $old_aaid+$ranksel-1;
  }
  
  if (!$aa_effect['oldid']) {
    // We are inserting.
    $query = "INSERT INTO aa_effects SET aaid=$aaid, slot=$slot, effectid=$effectid, base1=$base1, base2=$base2";
    if ($aa_effect['id']) {
      $query .= ", id=$id";
    }
    $mysql->query_no_result($query);
    return;
  }
  $old = getAAEffectInfo($aa_effect['oldid']);
  $fields = '';
  
  if ($id != '' && $old['id'] != $id && !getAAEffectInfo($id)) {
    $fields .= "id=$id, ";
  }
  if ($old['aaid'] != $id) $fields .= "aaid=$aaid, ";
  if ($old['slot'] != $slot) $fields .= "slot=$slot, ";
  if ($old['effectid'] != $effectid) $fields .= "effectid=$effectid, ";
  if ($old['base1'] != $base1) $fields .= "base1=$base1, ";
  if ($old['base2'] != $base2) $fields .= "base2=$base2, ";
  
  $fields = rtrim($fields, ", ");
  
  $query = "UPDATE aa_effects SET $fields WHERE id=$oldid";
  $mysql->query_no_result($query);
}

function getActionForRank($aaid, $rank) {
  global $mysql;
  $realrank = $rank-1;
  
  $query = "SELECT * FROM aa_actions WHERE aaid=$aaid and rank=$realrank";
  $res = $mysql->query_assoc($query);
  return $res;
}

function build_aa_action_from_post() {
  $vars = array();
  
  $vars['reuse_time'] = $_POST['reuse_time']+0;
  $vars['spell_id'] = $_POST['spell_id']+0;
  $vars['target'] = $_POST['target']+0;
  $vars['nonspell_action'] = $_POST['nonspell_action']+0;
  $vars['nonspell_mana'] = $_POST['nonspell_mana']+0;
  $vars['nonspell_duration'] = $_POST['nonspell_duration']+0;
  $vars['redux_aa'] = $_POST['redux_aa']+0;
  $vars['redux_rate'] = $_POST['redux_rate']+0;
  $vars['redux_aa2'] = $_POST['redux_aa2']+0;
  $vars['redux_rate2'] = $_POST['redux_rate2']+0;
  
  if ($_POST['target'] == 'useraw') {
    $vars['target'] = $_POST['raw_target']+0;
  }
  
  return $vars;
}

function deleteActionFromRank($aaid, $rank) {
  global $mysql;
  $realrank = $rank-1;
  
  $query = "DELETE FROM aa_actions WHERE aaid=$aaid and rank=$realrank";
  $mysql->query_no_result($query);
}

function addActionToRank($aaid, $rank, $vars) {
  global $mysql;
  $realrank = $rank-1;
  
  $fields = '';
  foreach($vars as $k => $v) {
    $fields .= "$k=$v, ";
  }
  $fields .= "aaid=$aaid, rank=$realrank";
  
  $query = "INSERT INTO aa_actions SET $fields";
  $mysql->query_no_result($query);
}

function updateActionForRank($aaid, $rank, $vars) {
  global $mysql;
  $realrank = $rank-1;
  
  $old = getActionForRank($aaid, $rank);
  
  $fields = '';
  
  if(isset($vars['target']) && $old['target'] != $vars['target']) $fields .= "target={$vars['target']}, ";
  if(isset($vars['spell_id']) && $old['spell_id'] != $vars['spell_id']) $fields .= "spell_id={$vars['spell_id']}, ";
  if(isset($vars['reuse_time']) && $old['reuse_time'] != $vars['reuse_time']) $fields .= "reuse_time={$vars['reuse_time']}, ";
  if(isset($vars['nonspell_acttion']) && $old['nonspell_action'] != $vars['nonspell_action']) $fields .= "nonspell_action={$vars['nonspell_action']}, ";
  if(isset($vars['nonspell_mana']) && $old['nonspell_mana'] != $vars['nonspell_mana']) $fields .= "nonspell_mana={$vars['nonspell_mana']}, ";
  if(isset($vars['nonspell_duration']) && $old['nonspell_duration'] != $vars['nonspell_duration']) $fields .= "nonspell_duration={$vars['nonspell_duration']}, ";
  if(isset($vars['redux_aa']) && $old['redux_aa'] != $vars['redux_aa']) $fields .= "redux_aa={$vars['redux_aa']}, ";
  if(isset($vars['redux_aa2']) && $old['redux_aa2'] != $vars['redux_aa2']) $fields .= "redux_aa2={$vars['redux_aa2']}, ";
  if(isset($vars['redux_rate']) && $old['redux_rate'] != $vars['redux_rate']) $fields .= "redux_rate2={$vars['redux_rate']}, ";
  if(isset($vars['redux_rate2']) && $old['redux_rate2'] != $vars['redux_rate2']) $fields .= "redux_rate2={$vars['redux_rate2']}, ";
  $fields = rtrim($fields, ", ");
  
  $query = "UPDATE aa_actions SET $fields WHERE aaid=$aaid AND rank=$realrank";
  $mysql->query_no_result($query);
}

function getBaseAAInfo($aaid) {
  global $mysql;
  $aa_vars_array = array();
  
  $query = "SELECT * FROM altadv_vars WHERE skill_id=$aaid";
  $aa_vars_array = $mysql->query_assoc($query);
  return $aa_vars_array;
}

function getNameByID($aaid) {
  global $mysql;
  
  $query = "SELECT * FROM altadv_vars WHERE skill_id=$aaid";
  $res = $mysql->query_assoc($query);
  if ($res) {
    return $res['name'];
  }
}

// Get all AAs that use the provided aaid as their sof_next_id
// Continue looking up previous AAs based on what we find.
// Stop once we get one we already have found, there is more
// than one row that has the same sof_next_id, or we find no matches.
function getPrevAAsArray($aaid) {
  $idx = 0;
  $loopflag = 0;
  $nextid = $aaid;
  $aa_prev_array = array();
  
  while (!$loopflag) {
    $results = get_aa_by_next($nextid);
    if ($results) {
      // Check if we end up in a cyclic loop
      $rescount = count($results);
      for ($i = 0; $i < $idx && !$loopflag; $i++) {
        for ($j = 0; $j < $rescount && !$loopflag; $j++) {
          if (($aa_prev_array[$i][0]['skill_id'] == $results[$j]['skill_id'])
            || ($results[$j]['skill_id'] == $aaid))
          {
            $loopflag = 1;
          }
        }
      }
      $aa_prev_array[$idx] = $results;
      $idx++;
      if (!$loopflag && $rescount == 1) {
        $nextid = $results[0]['skill_id'];
      } else {
        $nextid = 0;
        $loopflag = 1;
      }
    } else {
      // Nothing found, leave the loop.
      $loopflag = 1;
    }
  }
  if ($idx > 0) {
    return $aa_prev_array;
  }
}


// Get the chain of sof_next_id linked AAs starting with the ID 
// provided as a parameter.
function getNextAAsArray($aaid) {
  $idx = 0;
  $nextid = $aaid;
  $loopflag = 0;
  $aa_next_array = array();
  
  while ($nextid != 0 && !$loopflag) {
      $results = get_aa_by_id($nextid);
      if ($results) {
        // Check if we already have the ID in the array. We don't want to
        // get into an endless loop due to wrong DB data. This is meant to
        // help find such problems, not make things worse.
        for ($i = 0; $i < $idx && !$loopflag; $i++) {
          if ($aa_next_array[$i]['skill_id'] == $results['skill_id']) {
            $loopflag = 1;
          }
        }
        if (!$loopflag) {
          $aa_next_array[$idx] = $results;
          $idx++;
          $nextid = $results['sof_next_id'];
        }
      } else {
        $aa_next_array[$idx]['skill_id'] = $nextid;
        $aa_next_array[$idx]['name'] = "Not Found";
        $aa_next_array[$idx]['class_type'] = "";
        $aa_next_array[$idx]['sof_type'] = "";
        $aa_next_array[$idx]['aa_expansion'] = null; // Set to null so we don't show one
        $aa_next_array[$idx]['sof_next_id'] = "";
        $aa_next_array[$idx]['sof_max_level'] = "";
        $aa_next_array[$idx]['sof_current_level'] = "";
        $aa_next_array[$idx]['max_level'] = "";
        $nextid = 0;
        $loopflag = 1;
        $idx++;
      }
  }
  if ($idx > 0) {
    return $aa_next_array;
  }
}

function get_aa_by_id($id) {
  global $mysql;
  
  $query = "SELECT * FROM altadv_vars WHERE skill_id=$id";
  $results = $mysql->query_assoc($query);
  return $results;
}

function get_aa_by_next($nextid) {
  global $mysql;
  
  $query = "SELECT * FROM altadv_vars WHERE sof_next_id=$nextid";
  $results = $mysql->query_mult_assoc($query);
  return $results;
}

function get_level_cost($aaid, $rank) {
  global $mysql;
  $id = $aaid+$rank-1;
  $query = "SELECT level, cost, description FROM aa_required_level_cost WHERE skill_id = $id";
  $results = $mysql->query_assoc($query);
  return $results;
}

function update_level_cost($aaid, $rank, $level, $cost, $desc) {
  global $mysql;
  
  $id = $aaid+$rank-1;
  
  $old = get_level_cost($aaid, $rank);
  if(!$old) {
    // We're inserting
    $query = "INSERT INTO aa_required_level_cost SET skill_id=$id, level=$level, cost=$cost, description=\"$desc\"";
    $mysql->query_no_result($query);
    return;
  }
  
  $fields = '';
  if ($old['level'] != $level) $fields .= "level=$level, ";
  if ($old['cost'] != $cost) $fields .= "cost=$cost, ";
  if ($old['description'] != $desc) $fields .= "description=\"$desc\", ";
  
  $fields = rtrim($fields, ", ");
  
  if ($fields != '') {
    $query = "UPDATE aa_required_level_cost SET $fields WHERE skill_id=$id";
    $mysql->query_no_result($query);
  }
}

function delete_level_cost($aaid, $rank) {
  global $mysql;
  
  $aa_vars = getBaseAAInfo($aaid);
  if (!$aa_vars || $rank <= 0 || ($aa_vars && $aa_vars['max_level'] < $rank)) {
    return;
  }
  $id = $aaid+$rank-1;

  $query = "DELETE FROM aa_required_level_cost WHERE skill_id=$id";
  $mysql->query_no_result($query);
}

function build_aa_effect_from_post() {
  $aa_effect = array();
  
  $aa_effect['slot'] = intval($_POST['slot']);
  $aa_effect['effectid'] = intval($_POST['effectid']);
  $aa_effect['base1'] = intval($_POST['base1']);
  $aa_effect['base2'] = intval($_POST['base2']);
  $aa_effect['ranksel'] = $_POST['ranksel'];
  $aa_effect['raw_aaid'] = intval($_POST['raw_aaid']);
  $aa_effect['id'] = intval($_POST['id']);
  $aa_effect['oldid'] = $_POST['oldid'];
  
  return $aa_effect;
}

// Grab all of the fields from $_POST and fill them into an array
// that we return.
function build_aa_vars_from_post() {
  $aa_vars = array();
  
  $aa_vars['skill_id'] = $_POST['skill_id']+0;
  $aa_vars['name'] = $_POST['aaname'];
  $aa_vars['cost'] = $_POST['cost']+0;
  $aa_vars['max_level'] = $_POST['max_level']+0;
  $aa_vars['hotkey_sid'] = $_POST['hotkey_sid']+0;
  $aa_vars['hotkey_sid2'] = $_POST['hotkey_sid2']+0;
  $aa_vars['title_sid'] = $_POST['title_sid']+0;
  $aa_vars['desc_sid'] = $_POST['desc_sid']+0;
  $aa_vars['type'] = $_POST['type']+0;
  $aa_vars['spellid'] = $_POST['spellid']+0;
  $aa_vars['prereq_skill'] = $_POST['prereq_skill']+0;
  $aa_vars['prereq_minpoints'] = $_POST['prereq_minpoints']+0;
  $aa_vars['spell_type'] = $_POST['spell_type']+0;
  $aa_vars['spell_refresh'] = $_POST['spell_refresh']+0;
  $aa_vars['class_type'] = $_POST['class_type']+0;
  $aa_vars['cost_inc'] = $_POST['cost_inc']+0;
  $aa_vars['aa_expansion'] = $_POST['aa_expansion'];
  $aa_vars['special_category'] = $_POST['special_category'];
  $aa_vars['sof_type'] = $_POST['sof_type']+0;
  $aa_vars['sof_cost_inc'] = $_POST['sof_cost_inc']+0;
  $aa_vars['sof_max_level'] = $_POST['sof_max_level']+0;
  $aa_vars['sof_next_skill'] = $_POST['sof_next_skill']+0;
  $aa_vars['clientver'] = $_POST['clientver']+0;
  $aa_vars['account_time_required'] = $_POST['account_time_required']+0;
  $aa_vars['sof_current_level'] = $_POST['sof_current_level']+0;
  $aa_vars['sof_next_id'] = $_POST['sof_next_id']+0;
  $aa_vars['level_inc'] = $_POST['level_inc']+0;
  
  if ($aa_vars['aa_expansion'] == 'useraw')
    $aa_vars['aa_expansion'] = $_POST['raw_aa_expansion']+0;
  if ($aa_vars['special_category'] == 'useraw')
    $aa_vars['special_category'] = $_POST['raw_special_category']+0;

  
  $classes = 0;
  if (isset($_POST['class_war'])) $classes += 2;
  if (isset($_POST['class_clr'])) $classes += 4;
  if (isset($_POST['class_pal'])) $classes += 8;
  if (isset($_POST['class_rng'])) $classes += 16;
  if (isset($_POST['class_shd'])) $classes += 32;
  if (isset($_POST['class_dru'])) $classes += 64;
  if (isset($_POST['class_mnk'])) $classes += 128;
  if (isset($_POST['class_brd'])) $classes += 256;
  if (isset($_POST['class_rog'])) $classes += 512;
  if (isset($_POST['class_shm'])) $classes += 1024;
  if (isset($_POST['class_nec'])) $classes += 2048;
  if (isset($_POST['class_wiz'])) $classes += 4096;
  if (isset($_POST['class_mag'])) $classes += 8192;
  if (isset($_POST['class_enc'])) $classes += 16384;
  if (isset($_POST['class_bst'])) $classes += 32768;
  $aa_vars['classes'] = $classes;
  
  $berserker = 0;
  if (isset($_POST['class_ber'])) $berserker += 1;
  $aa_vars['berserker'] = $berserker;

  return $aa_vars;
}

function update_aabase($aa_vars, $aaid) {
  global $mysql;

  
  $old = getBaseAAInfo($aaid);

  if ($aa_vars['max_level'] != $old['max_level']) {
    // There is a size change.
    // -- We don't care currently.
  }
  
  if ($aa_vars['skill_id'] != $aaid) {
    // We're moving the AA. We also need to update
    // the effects, level_cost and action tables.
    // -- Not implemented yet
  }
  
  
  $fields = '';
  
  if (isset($aa_vars['skill_id']) && $old['skill_id'] != $aa_vars['skill_id'])
    $fields .= "skill_id=\"". $aa_vars['skill_id'] ."\", ";
  if (isset($aa_vars['name']) && $old['name'] != $aa_vars['name'] && $aa_vars['name'] != '')
    $fields .= "name=\"". $aa_vars['name'] ."\", ";
  if (isset($aa_vars['cost']) && $old['cost'] != $aa_vars['cost'])
    $fields .= "cost=\"". $aa_vars['cost'] ."\", ";
  if (isset($aa_vars['max_level']) && $old['max_level'] != $aa_vars['max_level'])
    $fields .= "max_level=\"". $aa_vars['max_level'] ."\", ";
  if (isset($aa_vars['hotkey_sid']) && $old['hotkey_sid'] != $aa_vars['hotkey_sid'])
    $fields .= "hotkey_sid=\"". $aa_vars['hotkey_sid'] ."\", ";
  if (isset($aa_vars['hotkey_sid2']) && $old['hotkey_sid2'] != $aa_vars['hotkey_sid2'])
    $fields .= "hotkey_sid2=\"". $aa_vars['hotkey_sid2'] ."\", ";
  if (isset($aa_vars['title_sid']) && $old['title_sid'] != $aa_vars['title_sid'])
    $fields .= "title_sid=\"". $aa_vars['title_sid'] ."\", ";
  if (isset($aa_vars['desc_sid']) && $old['desc_sid'] != $aa_vars['desc_sid'])
    $fields .= "desc_sid=\"". $aa_vars['desc_sid'] ."\", ";
  if (isset($aa_vars['type']) && $old['type'] != $aa_vars['type'] && $aa_vars['type'] != '')
    $fields .= "type=\"". $aa_vars['type'] ."\", ";
  if (isset($aa_vars['spellid']) && $old['spellid'] != $aa_vars['spellid'])
    $fields .= "spellid=\"". $aa_vars['spellid'] ."\", ";
  if (isset($aa_vars['prereq_skill']) && $old['prereq_skill'] != $aa_vars['prereq_skill'])
    $fields .= "prereq_skill=\"". $aa_vars['prereq_skill'] ."\", ";
  if (isset($aa_vars['prereq_minpoints']) && $old['prereq_minpoints'] != $aa_vars['prereq_minpoints'])
    $fields .= "prereq_minpoints=\"". $aa_vars['prereq_minpoints'] ."\", ";
  if (isset($aa_vars['spell_type']) && $old['spell_type'] != $aa_vars['spell_type'])
    $fields .= "spell_type=\"". $aa_vars['spell_type'] ."\", ";
  if (isset($aa_vars['spell_refresh']) && $old['spell_refresh'] != $aa_vars['spell_refresh'])
    $fields .= "spell_refresh=\"". $aa_vars['spell_refresh'] ."\", ";
  if (isset($aa_vars['classes']) && $old['classes'] != $aa_vars['classes'])
    $fields .= "classes=\"". $aa_vars['classes'] ."\", ";
  if (isset($aa_vars['berserker']) && $old['berserker'] != $aa_vars['berserker'])
    $fields .= "berserker=\"". $aa_vars['berserker'] ."\", ";
  if (isset($aa_vars['class_type']) && $old['class_type'] != $aa_vars['class_type'])
    $fields .= "class_type=\"". $aa_vars['class_type'] ."\", ";
  if (isset($aa_vars['cost_inc']) && $old['cost_inc'] != $aa_vars['cost_inc'])
    $fields .= "cost_inc=\"". $aa_vars['cost_inc'] ."\", ";
  if (isset($aa_vars['aa_expansion']) && $old['aa_expansion'] != $aa_vars['aa_expansion'])
    $fields .= "aa_expansion=\"". $aa_vars['aa_expansion'] ."\", ";
  if (isset($aa_vars['special_category']) && $old['special_category'] != $aa_vars['special_category'])
    $fields .= "special_category=\"". $aa_vars['special_category'] ."\", ";
  if (isset($aa_vars['sof_type']) && $old['sof_type'] != $aa_vars['sof_type'])
    $fields .= "sof_type=\"". $aa_vars['sof_type'] ."\", ";
  if (isset($aa_vars['sof_cost_inc']) && $old['sof_cost_inc'] != $aa_vars['sof_cost_inc'])
    $fields .= "sof_cost_inc=\"". $aa_vars['sof_cost_inc'] ."\", ";
  if (isset($aa_vars['sof_max_level']) && $old['sof_max_level'] != $aa_vars['sof_max_level'])
    $fields .= "sof_max_level=\"". $aa_vars['sof_max_level'] ."\", ";
  if (isset($aa_vars['sof_next_skill']) && $old['sof_next_skill'] != $aa_vars['sof_next_skill'])
    $fields .= "sof_next_skill=\"". $aa_vars['sof_next_skill'] ."\", ";
  if (isset($aa_vars['clientver']) && $old['clientver'] != $aa_vars['clientver'])
    $fields .= "clientver=\"". $aa_vars['clientver'] ."\", ";
  if (isset($aa_vars['account_time_required']) && $old['account_time_required'] != $aa_vars['account_time_required'])
    $fields .= "account_time_required=\"". $aa_vars['account_required_time'] ."\", ";
  if (isset($aa_vars['sof_current_level']) && $old['sof_current_level'] != $aa_vars['sof_current_level'])
    $fields .= "sof_current_level=\"". $aa_vars['sof_current_level'] ."\", ";
  if (isset($aa_vars['sof_next_id']) && $old['sof_next_id'] != $aa_vars['sof_next_id'])
    $fields .= "sof_next_id=\"". $aa_vars['sof_next_id'] ."\", ";
  if (isset($aa_vars['level_inc']) && $old['level_inc'] != $aa_vars['level_inc'])
    $fields .= "level_inc=\"". $aa_vars['level_inc'] ."\", ";
  
  $fields = rtrim ($fields, ", ");
  
  if ($fields != '') {
    $query = "UPDATE altadv_vars SET $fields WHERE skill_id = $aaid";
    $mysql->query_no_result($query);
  }
}

// Check if placing a number of aaids equal to $ranks, starting at $aaid,
// would overlap with anything already existing.
// $exclude is an aaid that we will ignore for this purpose. (We can
// exclude the one we're trying to see if we can move with this.)
function do_aa_range_check($aaid, $ranks, $exclude=0) {
  global $mysql;
  $errors = array();
  $error_idx = 0;
  
  // Check for preceeding AA that has enough ranks to overlap the start.
  $query = "SELECT skill_id, name, max_level FROM altadv_vars WHERE skill_id <= $aaid ORDER BY skill_id DESC LIMIT 1";
  $results = $mysql->query_assoc($query);
  
  if ($results) {
    if (($results['skill_id']+$results['max_level']-1) >= $aaid) {
      // We have overlap from a previous AA.
      $errors[$error_idx] = "There is overlap with the preceeding AA: "  . $results['name'] . " (ID:". $results['skill_id']." / Ranks:". $results['max_level'].")";
      $error_idx++;
    }
  }
}

function insert_aabase($aa_vars) {
  global $mysql, $defaultvalues;
  $errors = array();
  $error_idx = 0;
  
  $aaid = $aa_vars['skill_id'];
  // Sanity checking
  if ($aaid == '' || !is_numeric($aaid)) {
    $errors[$error_idx] = "An integer is required for the ID";
    $error_idx++;
    //return $errors;
  }
  
  
  if ($error_idx > 0) {
    return $errors;
  }
  
  $fields = '';
  foreach ($aa_vars as $key => $val) {
    if ($val == '') {
      $fields .= "$key=\"". $defaultvalues[$key] ."\", ";
    } else {
      $fields .= "$key=\"$val\", ";
    }
  }
  $fields = rtrim($fields, ", ");
  
  $query = "INSERT INTO altadv_vars SET $fields";
  $mysql->query_no_result($query);
}

function deleteCompleteAA($aaid) {
  global $mysql;
  
  $vars = getBaseAAInfo($aaid);
  
  if ($vars) {
    $aarange = $aaid + $vars['max_level'] - 1;
    $query = "DELETE FROM altadv_vars WHERE skill_id=$aaid";
    $mysql->query_no_result($query);
    $query = "DELETE FROM aa_actions WHERE aaid=$aaid";
    $mysql->query_no_result($query);
    $query = "DELETE FROM aa_effects WHERE aaid BETWEEN $aaid AND $aarange";
    $mysql->query_no_result($query);
    $query = "DELETE FROM aa_required_level_cost WHERE skill_id BETWEEN $aaid AND $aarange";
    $mysql->query_no_result($query);
  }
}

// This really should be something that the AA loader handles dynamically,
// since then it could also stop at the client available versions.
function fixOffsetMax($aaid) {
  global $mysql;
  
  // Step 1, figure out if we're a valid chain of AAs and what the max rank
  // for the whole thing is.
  $aa_vars = getBaseAAInfo($aaid);
  if (!$aa_vars) return;
  
  $aa_prev = getPrevAAsArray($aaid);
  $maxrank = 0;
  // If we ever get more than one result then we bail.
  if ($aa_prev)
    for ($i = 0; $i < count($aa_prev); $i++) {
       if (count($aa_prev[$i]) > 1) return;
       $maxrank += $aa_prev[$i][0]['max_level'];
    }
  
  $maxrank+= $aa_vars['max_level'];
  
  $aa_next = null;
  if ($aa_vars['sof_next_id'])
    $aa_next = getNextAAsArray($aa_vars['sof_next_id']);
  if ($aa_next)
    foreach($aa_next as $n) {
      if(!isset($n['aa_expansion'])) return; // We bail if we get a 'not found'
      $maxrank += $n['max_level'];
    }
  
  // Step 2: Now that we have the max rank we can walk through the
  // list and update them all.
  $cur = 0;
  if($aa_prev)
    for ($i = count($aa_prev)-1; $i >= 0; $i--) {
      $aa_prev[$i][0]['sof_max_level'] = $maxrank;
      $aa_prev[$i][0]['sof_current_level'] = $cur;
      $cur += $aa_prev[$i][0]['max_level'];
      update_aabase($aa_prev[$i][0], $aa_prev[$i][0]['skill_id']);
    }
  
  $aa_vars['sof_max_level'] = $maxrank;
  $aa_vars['sof_current_level'] = $cur;
  $cur += $aa_vars['max_level'];
  update_aabase($aa_vars, $aaid);
  
  if ($aa_next)
    foreach ($aa_next as $aa) {
      $aa['sof_max_level'] = $maxrank;
      $aa['sof_current_level'] = $cur;
      $cur += $aa['max_level'];
      update_aabase($aa, $aa['skill_id']);
    }
}

function findByID($id) {
  global $mysql;
  
  $query = "SELECT skill_id, name, prereq_skill, aa_expansion, classes, berserker FROM altadv_vars WHERE skill_id='$id'";
  return $mysql->query_mult_assoc($query);
}

function findByName($search) {
  global $mysql;
  
  $query = "SELECT skill_id, name, prereq_skill, aa_expansion, classes, berserker FROM altadv_vars WHERE name rlike \"$search\" ORDER BY skill_id";
  return $mysql->query_mult_assoc($query);
}

function findByClsExp($cls, $exp) {
  global $mysql;
  $classes = 65534;
  $berserker = 1;
  
  if ($cls == -1) {
    $classes = 65534;
    $berserker = 1;
  } else {
    if ($cls == 1) $classes = 2;
    if ($cls == 2) $classes = 4;
    if ($cls == 3) $classes = 8;
    if ($cls == 4) $classes = 16;
    if ($cls == 5) $classes = 32;
    if ($cls == 6) $classes = 64;
    if ($cls == 7) $classes = 128;
    if ($cls == 8) $classes = 256;
    if ($cls == 9) $classes = 512;
    if ($cls == 10) $classes = 1014;
    if ($cls == 11) $classes = 2048;
    if ($cls == 12) $classes = 4096;
    if ($cls == 13) $classes = 8192;
    if ($cls == 14) $classes = 16384;
    if ($cls == 15) $classes = 32768;
    
    if ($cls == 16) $berserker = 1;
    
    if ($classes != 65534) $berserker = 0;
  }

  $check = "(classes & $classes <> 0";
  if ($berserker != 0) 
    $check .= " or ((classes & $classes) = 0 and berserker=$berserker))";
  else
    $check .= ")";

  if ($exp != -1) {
    $check .= " and aa_expansion=$exp";
  }
  
  $query = "SELECT skill_id, name, prereq_skill, aa_expansion, classes, berserker FROM altadv_vars WHERE $check ORDER BY aa_expansion, name";
  $result = $mysql->query_mult_assoc($query);
  return $result;
}
?>