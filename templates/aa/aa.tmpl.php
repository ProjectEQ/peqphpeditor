<div class="table_container">
  <div class="table_header">
    <?=$aa_vars['skill_id']?> - <?=$aa_vars['name']?>
  </div>
  <div class="table_content">
    <table cellspacing="0" border="0" width="100%">
      <tr>
        <td width="100%">
          <table cellspacing="0" border="0" width="100%">
            <tr>
              <td>
                <fieldset>
                  <legend><strong>AA Variables</strong></legend>
                  ID: <?=$aa_vars['skill_id']?><br />
                  Name: <?=$aa_vars['name']?><br />
                  Cost: <?=$aa_vars['cost']?><br />
                  Max Level: <?=$aa_vars['max_level']?><br />
                  Hotkey SID 1: <?=$aa_vars['hotkey_sid']?><br />
                  Hotkey SID 2: <?=$aa_vars['hotkey_sid2']?><br />
                  Title SID: <?=$aa_vars['title_sid']?><br />
                  Description SID: <?=$aa_vars['desc_sid']?><br />
                  Type: <?=$aa_vars['type']?><br />
                  Spell ID: <?=$aa_vars['spellid']?><br />
                  Prerequisite AA: <?=$aa_vars['prereq_skill']?><br />
                  Prerequisite Points: <?=$aa_vars['prereq_minpoints']?><br />
                  Spell Type: <?=$aa_vars['spell_type']?><br />
                  Spell Refresh: <?=$aa_vars['spell_refresh']?><br />
                  Classes: <?=$aa_vars['classes']?><br />
                  Berserker: <?=$yesno[$aa_vars['berserker']]?><br />
                  Class Type: <?=$aa_vars['class_type']?><br />
                  Cost Increment: <?=$aa_vars['cost_inc']?><br />
                  Expansion: <?=$aa_vars['aa_expansion']?> - <?=$eqexpansions[$aa_vars['aa_expansion']]?><br />
                  Special Category: <?=$aa_vars['special_category']?><br />
                  SoF Type: <?=$aa_vars['sof_type']?><br />
                  SoF Cost Increment: <?=$aa_vars['sof_cost_inc']?><br />
                  SoF Max Level: <?=$aa_vars['sof_max_level']?><br />
                  SoF Next AA: <?=$aa_vars['sof_next_skill']?><br />
                  Client Version: <?=$aa_vars['clientver']?><br />
                  Account Time Required: <?=$aa_vars['account_time_required']?><br />
                </fieldset>
                <fieldset>
                  <legend><strong>AA Actions</strong></legend>
<?
  if ($aa_actions) {
    $multiple = 0;
    foreach ($aa_actions as $aa_action) {
      if ($multiple > 0) {
        echo "<br />";
      }
      echo "Rank: " . $aa_action['rank'] . "<br />";
      echo "Reuse Time: " . $aa_action['reuse_time'] . "<br />";
      echo "Spell ID: <a href='index.php?editor=spells&id=" . $aa_action['spell_id'] . "&action=2' target='_blank'>" . $aa_action['spell_id'] . " - " . getSpellName($aa_action['spell_id']) . "</a> [<a href='http://lucy.allakhazam.com/spell.html?id=" . $aa_action['spell_id'] . "' target='_blank'>Lucy</a>]<br />";
      echo "Target: " . $aa_action['target'] . "<br />";
      echo "Non-Spell Action: " . $aa_action['nonspell_action'] . "<br />";
      echo "Non-Spell Mana: " . $aa_action['nonspell_mana'] . "<br />";
      echo "Non-Spell Duration: " . $aa_action['nonspell_duration'] . "<br />";
      echo "Redux AA 1: " . $aa_action['redux_aa'] . "<br />";
      echo "Redux Rate 1: " . $aa_action['redux_rate'] . "<br />";
      echo "Redux AA 2: " . $aa_action['redux_aa2'] . "<br />";
      echo "Redux Rate 2: " . $aa_action['redux_rate2'] . "<br />";
      $multiple++;
    }
  }
  else {
    echo "None";
  }
?>
                </fieldset>
                <fieldset>
                  <legend><strong>AA Effects</strong></legend>
<?
  if ($aa_effects) {
    $multiple = 0;
    foreach ($aa_effects as $aa_effect) {
      if ($multiple > 0) {
        echo "<br />";
      }
      echo "ID: " . $aa_effect['id'] . "<br />";
      echo "Slot: " . $aa_effect['slot'] . "<br />";
      echo "Effect ID: " . $aa_effect['effectid'] . "<br />";
      echo "Base 1: " . $aa_effect['base1'] . "<br />";
      echo "Base 2: " . $aa_effect['base2'] . "<br />";
      $multiple++;
    }
  }
  else {
    echo "None";
  }
?>
                </fieldset>
                <fieldset>
                  <legend><strong>AA Required Level Cost</strong></legend>
<?
  if ($aa_cost) {
    echo "Level: " . $aa_cost['level'] . "<br />";
    echo "Cost: " . $aa_cost['cost'] . "<br />";
    echo "Description: " . $aa_cost['description'] . "<br /><br />";
  }
  else {
    echo "None";
  }
?>
                </fieldset>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
  </div>
</div>
