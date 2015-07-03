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
  foreach ($base as $k=>$v) {
    echo "<b>Key:</b> $k<br/><b>Value:</b> $v<br/><br/>";
  }
?>
                    <br/>
                    <b>Category:</b> (Still need to find this)<br/>
                    <b>Classes:</b> <?=getClasses($base['classes'])?><br/>
                    <b>Races:</b> <?=getRaces($base['races'])?><br/>
                    <b>Deities:</b> <?=getDeities($base['deities'])?><br/>
                    <b>Type:</b> <?=$aa_type[$base['type']]?>
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
<?
    foreach ($rank as $k=>$v) {
      echo "<b>Key:</b> $k<br/><b>Value:</b> $v<br/><br/>";
    }
    $count++;
?>
                      <br/>
                      <b>Spell:</b> <?echo ($rank['spell'] > 0) ? getSpellName($rank['spell']) : "None";?><br/>
                      <b>Spell Type:</b> <?echo ($rank['spell_type'] > 0) ? $sp_spelltypes[$rank['spell_type']] : " ";?>(Still need to find this)<br/>
                      <b>Expansion:</b> <?=$eqexpansions[$rank['expansion'] + 1]?><br/>
                    </fieldset>
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
<?
}
else {
?>
                      No ranks
<?
}
?>
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
<?
      foreach ($effect_detail as $k=>$v) {
        echo "<b>Key:</b> $k<br/><b>Value:</b> $v<br/><br/>";
      }
?>
                      </br>
                      <b>Effect:</b> <?=$sp_effects[$effect_detail['effect_id']]?><br/>
                    </fieldset>
<?
    }
    $count++;
?>
                  </fieldset>
<?
  }
?>
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
                      No effects
<?
}
?>
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
<?
    foreach ($prereq as $k=>$v) {
      echo "<b>Key:</b> $k<br/><b>Value:</b> $v<br/><br/>";
    }
    $count++;
?>
                      <br/>
                      <b>Prerequisite AA:</b> <?=getAAName($prereq['aa_id']);?>
                    </fieldset>
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
