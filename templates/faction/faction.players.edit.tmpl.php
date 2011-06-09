  <div class="edit_form" style="width: 500px">
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
                  <option value="<?=$faction['id']?>"<?php if ($faction_id == $faction['id']): ?> selected<?php endif;?>><?=$faction['name']?></option>
<? }?>
                </select>
              </td>
              <td><input type="text" size="10" name="current_value" value="<?=$current_value?>"></td>
            </tr>
          </table><br/><br/>
          <center>
            <input type="hidden" name="o_cid" value="<?=$char_id?>">
            <input type="hidden" name="o_fid" value="<?=$faction_id?>">
            <input type="submit" value="Submit Changes">&nbsp;<input type="button" value="Cancel" onClick="history.back();">
          </center>
        </form>
      </div>
    </div>
