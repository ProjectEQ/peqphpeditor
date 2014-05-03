      <table class="edit_form" width="250px">
        <tr>
          <td class="edit_form_header">
            Key on <?=getPlayerName($key_item['char_id'])?>'s Keyring
          </td>
        </tr>
        <tr>
          <td class="edit_form_content">
            <form name="keys" id="keys" method="POST" action="index.php?editor=keys&playerid=<?=$key_item['char_id']?>&action=7">
              <table width="100%" cellpadding="3" cellspacing="0">
                <tr>
                  <td>
                    Player ID:<br/>
                    <input type="text" size="5" name="char_id" value="<?=$key_item['char_id']?>" readonly="true">
                  </td>
                  <td>
                    Item ID:<br/>
                    <input type="text" size="5" name="item_id" value="<?=$key_item['item_id']?>">
                  </td>
                </tr>
                <tr><td>&nbsp;</td></tr>
                <tr>
                  <td colspan="2">
                    <center>
                      <input type="hidden" name="old_item" value="<?=$key_item['item_id']?>">
                      <input type="submit" name="submit" value="Submit Changes">&nbsp;<input type="button" name="cancel" value="Cancel" onClick="history.back();">
                    </center>
                  </td>
                </tr>
              </table>
            </form>
          </td>
        </tr>
      </table>
