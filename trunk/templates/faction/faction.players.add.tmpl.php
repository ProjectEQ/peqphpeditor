  <div class="edit_form" style="width: 500px">
    <div class="edit_form_header">Add Faction Entry</div>
      <div class="edit_form_content">
        <form name="player_factions" method="post" action="index.php?editor=faction&action=13">
          <table width="100%" cellpadding="0" cellspacing="0">
            <tr>
              <td><b>Character ID:</b></td>
              <td><b>Faction:</b></td>
              <td><b>Current Value:</b></td>
            </tr>
            <tr>
              <td><input type="text" size="9" name="char_id" value=""></td>
              <td>
                <select name="faction_id">
                  <option value="">Select a Faction</option>
<? foreach ($factions as $faction) {?>
                  <option value="<?=$faction['id']?>"><?=$faction['name']?></option>
<? }?>
                </select>
              </td>
              <td><input type="text" size="10" name="current_value" value="0"></td>
            </tr>
          </table><br/><br/>
          <center>
            <input type="submit" value="Submit Changes">&nbsp;<input type="button" value="Cancel" onClick="history.back();">
          </center>
        </form>
      </div>
    </div>
