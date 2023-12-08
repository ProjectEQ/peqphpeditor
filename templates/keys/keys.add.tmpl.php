  <table class="edit_form" width="250px;">
    <tr>
      <td class="edit_form_header">Key Item for <?=getPlayerName($playerid)?></td>
    </tr>
    <tr>
      <td class="edit_form_content">
        <form name="keys" id="add_key" method="POST" action="index.php?editor=keys&action=5">
          <table width="100%" cellpadding="3" cellspacing="0">
            <tr>
              <td>
                ID:<br>
                <input type="text" size="5" name="id" value="<?=$suggest_id?>">
              </td>
              <td>
                Player ID:<br>
                <input type="text" size="5" name="char_id" value="<?=$playerid?>">
              </td>
              <td>
                Item ID:<br>
                <input type="text" size="5" name="item_id" value="">
              </td>
            </tr>
            <tr><td>&nbsp;</td></tr>
            <tr>
              <td colspan="2">
                <center>
                  <input type="submit" name="submit" value="Add Key">&nbsp;&nbsp;<input type="button" name="cancel" value="Cancel" onClick="history.back();">
                </center>
              </td>
            </tr>
          </table>
        </form>
      </td>
    </tr>
  </table>
