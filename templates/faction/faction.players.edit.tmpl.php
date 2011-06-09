  <div class="edit_form" style="width: 300px">
    <div class="edit_form_header">Edit Faction Entry</div>
      <div class="edit_form_content">
        <form name="factions" method="post" action="index.php?editor=faction&action=11">
          <table width="100%" cellpadding="0" cellspacing="0">
            <tr>
              <td><b>Character ID:</b></td>
              <td><b>Faction ID:</b></td>
              <td><b>Current Value:</b></td>
            </tr>
            <tr>
              <td><input type="text" size="5" name="char_id" value="<?=$char_id?>"></td>
              <td><input type="text" size="5" name="faction_id" value="<?=$faction_id?>"></td>
              <td><input type="text" size="5" name="current_value" value="<?=$current_value?>"></td>
            </tr>
          </table><br/><br/>
          <center>
            <input type="submit" value="Submit Changes">&nbsp;<input type="button" value="Cancel" onClick="history.back();">
          </center>
        </form>
      </div>
    </div>
