      <table class="edit_form" width="300px">
        <tr>
          <td class="edit_form_header">
            Inventory item for <?=getPlayerName($playerid)?>
          </td>
        </tr>
        <tr>
          <td class="edit_form_content">
            <form name="inventory" id="inventory" method="POST" action="index.php?editor=inv&action=5">
              <table width="100%" cellpadding="3" cellspacing="0">
                <tr>
                  <td>
                    Player ID:<br>
                    <input type="text" size="5" value="<?=$playerid?>" disabled>
                  </td>
                  <td>
                    Slot ID:<br>
                    <input type="text" size="3" name="slot_id" value="">
                  </td>
                  <td>
                    Item ID:<br>
                    <input type="text" size="5" name="item_id" value="">
                  </td>
                </tr>
                <tr>
                  <td>
                    Charges:<br>
                    <input type="text" size="3" name="charges" value="0">
                  </td>
                  <td colspan="2">
                    Color:<br>
                    <input type="text" size="10" name="color" value="4278190080">
                  </td>
                </tr>
                <tr>
                  <td>
                    Augment 1:<br>
                    <input type="text" size="3" name="augment_one" value="0">
                  </td>
                  <td>
                    Augment 2:<br>
                    <input type="text" size="3" name="augment_two" value="0">
                  </td>
                  <td>
                    Augment 3:<br>
                    <input type="text" size="3" name="augment_three" value="0">
                  </td>
                </tr>
                <tr>
                  <td>
                    Augment 4:<br>
                    <input type="text" size="3" name="augment_four" value="0">
                  </td>
                  <td>
                    Augment 5:<br>
                    <input type="text" size="3" name="augment_five" value="0">
                  </td>
                  <td>
                    Augment 6:<br>
                    <input type="text" size="3" name="augment_six" value="0">
                  </td>
                </tr>
                <tr>
                  <td colspan="3">
                    Inst NoDrop:<br>
                    <input type="checkbox" name="instnodrop">
                  </td>
                </tr>
                <tr>
                  <td colspan="3">
                    Custom Data:<br>
                    <input type="text" size="37" name="custom_data" value="">
                  </td>
                </tr>
                <tr>
                  <td>
                    Ornament Icon:<br>
                    <input type="text" size="3" name="ornament_icon" value="0">
                  </td>
                  <td>
                    Ornament idfile:<br>
                    <input type="text" size="3" name="ornament_idfile" value="0">
                  </td>
                  <td>
                    Ornament Hero Model:<br>
                    <input type="text" size="3" name="ornament_hero_model" value="0">
                  </td>
                </tr>
                <tr>
                  <td colspan="3">
                    <center>
                      <input type="hidden" name="character_id" value="<?=$playerid?>">
                      <input type="submit" name="submit" value="Add Item">&nbsp;&nbsp;
                      <input type="button" name="cancel" value="Cancel" onClick="history.back();">
                    </center>
                  </td>
                </tr>
              </table>
            </form>
          </td>
        </tr>
      </table>
      <script>alert("WARNING!\n\nManually adding an item incorrectly may cause the character to not be able to load into the game.");</script>
