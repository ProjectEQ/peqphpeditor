  <div class="table_container">
    <div class="table_header">
      <?=$base['id']?> - <?=$base['name']?>
      <div style="float:right;">
        <a href="index.php?editor=aa&action=3"><img src="images/add.gif" border="0" title="Create a new AA"></a>
        <a href="index.php?editor=aa&aaid=<?=$base['id']?>&action=10"><img src="images/edit.gif" border="0" title="Edit this AA"></a>
        <a href="index.php?editor=aa&aaid=<?=$base['id']?>&action=18" onclick="return confirm('Really delete <?=addslashes($base['name'])?>?');"><img src="images/remove.gif" border="0" title="Delete this AA"></a>
      </div>
    </div>
    <div class="table_content">
      <table cellspacing="0" border="0" width="100%">
        <tr>
          <td width="100%">
            <table cellspacing="0" border="0" width="100%">
              <tr>
                <td>
                  <fieldset>
                    <legend><b>Base AA Info:</b></legend>
<?
if ($base) {
?>
                    <b>ID</b> <?=$base['id']?><br/>
                    <b>Name</b> <?=$base['name']?><br/>
                    <b>Category:</b> <?=$aa_category[$base['category']]?><br/>
                    <b>Classes:</b> <?=getClasses($base['classes'])?><br/>
                    <b>Races:</b> <?=getRaces($base['races'])?><br/>
                    <b>Deities:</b> <?=getDeities($base['deities'])?><br/>
                    <b>Type:</b> <?=$aa_type[$base['type']]?><br/>
                    <b>Charges:</b> <?=$base['charges']?><br/>
                    <b>Enabled:</b> <?=$yesno[$base['enabled']]?><br/>
                    <b>Grant Only:</b> <?=$yesno[$base['grant_only']]?><br/>
                    <b>First Rank:</b> <?=$base['first_rank_id']?><br/>
                    <b>Status</b> <?=$base['status']?><br/>
                    <b>Drakkin Heritage:</b> <?=$base['drakkin_heritage']?>
<?
}
else {
?>
                    No base information
<?
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
    <div class="table_content">
      <table cellspacing="0" border="0" width="100%">
        <tr>
          <td width="100%">
            <table cellspacing="0" border="0" width="100%">
              <tr>
                <td>
                  <fieldset>
                    <legend><b>AA Ranks Info:</b></legend>
<?
if ($ranks) {
  $count = 1;
  foreach ($ranks as $rank) {
?>
                    <fieldset>
                      <legend><b>Rank <?=$count?></b></legend>
                      <b>Rank ID:</b> <?=$rank['id']?><br/>
                      <b>Upper Hotkey SID:</b> <?=$rank['upper_hotkey_sid']?><br/>
                      <b>Lower Hotkey SID:</b> <?=$rank['lower_hotkey_sid']?><br/>
                      <b>Title SID:</b> <?=$rank['title_sid']?><br/>
                      <b>Desc SID:</b> <?=$rank['desc_sid']?><br/>
                      <b>Cost:</b> <?=$rank['cost']?><br/>
                      <b>Level Required:</b> <?=$rank['level_req']?><br/>
                      <b>Spell:</b> <?echo ($rank['spell'] > 0) ? getSpellName($rank['spell']) : "None";?><br/>
                      <b>Spell Type:</b> <?=$rank['spell_type']?><br/>
                      <b>Recast Time:</b> <?=$rank['recast_time']?><br/>
                      <b>Expansion:</b> <?=$eqexpansions[$rank['expansion'] + 1]?><br/>
                      <b>Previous ID:</b> <?echo ($rank['prev_id'] == -1) ? "None" : $rank['prev_id'];?><br/>
                      <b>Next ID:</b> <?echo ($rank['next_id'] == -1) ? "None" : $rank['next_id'];?>
                    </fieldset>
<?
    $count++;
  }
?>
<?
}
else {
?>
                      No ranks
<?
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
    <div class="table_content">
      <table cellspacing="0" border="0" width="100%">
        <tr>
          <td width="100%">
            <table cellspacing="0" border="0" width="100%">
              <tr>
                <td>
                  <fieldset>
                    <legend><b>AA Effects Info:</b></legend>
<?
if ($effects) {
  $count = 1;
  foreach ($effects as $effect) {
?>
                    <fieldset>
                      <legend><b>Effect <?=$count?></b></legend>
<?
    foreach ($effect as $effect_detail) {
?>
                      <fieldset>
                        <legend><b>Slot <?=$effect_detail['slot']?></b></legend>
                        <b>Rank ID:</b> <?=$effect_detail['rank_id']?><br/>
                        <b>Slot:</b> <?=$effect_detail['slot']?><br/>
                        <b>Effect ID:</b> <?=$effect_detail['effect_id']?><br/>
                        <b>Effect:</b> <?=$sp_effects[$effect_detail['effect_id']]?><br/>
                        <b>Base 1:</b> <?=$effect_detail['base1']?><br/>
                        <b>Base 2:</b> <?=$effect_detail['base2']?>
                      </fieldset>
<?
    }
    $count++;
?>
                    </fieldset>
<?
  }
?>
<?
}
else {
?>
                      No effects
<?
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
    <div class="table_content">
      <table cellspacing="0" border="0" width="100%">
        <tr>
          <td width="100%">
            <table cellspacing="0" border="0" width="100%">
              <tr>
                <td>
                  <fieldset>
                    <legend><b>AA Prerequisite Info:</b></legend>
<?
if ($prereqs) {
  $count = 1;
  foreach ($prereqs as $prereq) {
?>
                    <fieldset>
                      <legend><b>Rank <?=$count?> Prerequisite</b></legend>
                      <b>Rank ID:</b> <?=$prereq['rank_id']?><br/>
                      <b>Prerequisite AA:</b> <?=getAAName($prereq['aa_id'])?><br/>
                      <b>Points:</b> <?=$prereq['points']?>
                    </fieldset>
<?
    $count++;
  }
?>
                  </fieldset>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
<?
}
else {
?>
    No prerequisites
<?
}
?>
    </div>
  </div>
