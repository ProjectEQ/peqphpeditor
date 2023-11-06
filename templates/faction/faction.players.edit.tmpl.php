  <center>
    <table style="border: 1px solid black; background-color: #CCC;">
      <tr><td colspan="3"><b>Legend:</b></td></tr>
      <tr><td align="right">1100 and Above</td><td>&nbsp;</td><td align="left">Ally</td></tr>
      <tr><td align="right">750 to 1099</td><td>&nbsp;</td><td align="left">Warmly</td></tr>
      <tr><td align="right">500 to 749</td><td>&nbsp;</td><td align="left">Kindly</td></tr>
      <tr><td align="right">100 to 499</td><td>&nbsp;</td><td align="left">Amiable</td></tr>
      <tr><td align="right">0 to 99</td><td>&nbsp;</td><td align="left">Indifferent</td></tr>
      <tr><td align="right">-100 to -1</td><td>&nbsp;</td><td align="left">Apprehensive</td></tr>
      <tr><td align="right">-500 to -101</td><td>&nbsp;</td><td align="left">Dubious</td></tr>
      <tr><td align="right">-750 to -501</td><td>&nbsp;</td><td align="left">Threatening</td></tr>
      <tr><td align="right">-751 and Below</td><td>&nbsp;</td><td align="left">Scowls</td></tr>
    </table><br><br>
  </center>
  <div class="edit_form" style="width: 550px">
    <div class="edit_form_header">Edit Faction Entry</div>
      <div class="edit_form_content">
        <form name="player_factions" method="post" action="index.php?editor=faction&action=11">
          <table width="100%" cellpadding="0" cellspacing="0">
            <tr>
              <td><b>Character ID:</b></td>
              <td><b>Faction:</b></td>
              <td><b>Current Value:</b></td>
            </tr>
            <tr>
              <td><input type="text" size="9" name="char_id" value="<?=$char_id?>"></td>
              <td>
                <select name="faction_id">
                  <option value="">Select a Faction</option>
<? foreach ($factions as $faction) {?>
                  <option value="<?=$faction['id']?>"<?php if ($faction_id == $faction['id']): ?> selected<?php endif;?>><?=$faction['name']?> (<?=$faction['id']?>)</option>
<? }?>
                </select>
              </td>
              <td><input type="text" size="10" name="current_value" value="<?=$current_value?>"></td>
            </tr>
          </table><br><br>
          <center>
            <input type="hidden" name="o_cid" value="<?=$char_id?>">
            <input type="hidden" name="o_fid" value="<?=$faction_id?>">
            <input type="submit" value="Submit Changes">&nbsp;<input type="button" value="Cancel" onClick="history.back();">
          </center>
        </form>
      </div>
    </div>
