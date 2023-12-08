  <table class="edit_form" width="250px;">
    <tr>
      <td class="edit_form_header">Key on <?=getPlayerName($key_item['char_id'])?>'s Keyring</td>
    </tr>
    <tr>
      <td class="edit_form_content">
        <form name="keys" id="edit_key" method="POST" action="index.php?editor=keys&id=<?=$key_item['id']?>&action=7">
          <table width="100%" cellpadding="3" cellspacing="0">
            <tr>
              <td>
                ID:<br>
                <input type="text" size="5" value="<?=$key_item['id']?>" disabled>
              </td>
              <td>
                Player ID:<br>
                <input type="text" size="5" value="<?=$key_item['char_id']?>" disabled>
              </td>
              <td>
                Item ID:<br>
                <input type="text" size="5" name="item_id" value="<?=$key_item['item_id']?>">
              </td>
            </tr>
            <tr><td>&nbsp;</td></tr>
            <tr>
              <td colspan="2">
                <center>
                  <input type="hidden" name="id" value="<?=$key_item['id']?>">
                  <input type="hidden" name="char_id" value="<?=$key_item['char_id']?>">
                  <input type="submit" name="submit" value="Submit Changes">&nbsp;&nbsp;<input type="button" name="cancel" value="Cancel" onClick="history.back();">
                </center>
              </td>
            </tr>
          </table>
        </form>
      </td>
    </tr>
  </table>
