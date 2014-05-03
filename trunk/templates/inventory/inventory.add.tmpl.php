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
                    Player ID:<br/>
                    <input type="text" size="5" name="charid" value="<?=$playerid?>" readonly="true">
                  </td>
                  <td>
                    <a title="22-29: Main Inventory Slots">Slot ID:</a><br/>
                    <input type="text" size="3" name="slotid" value="">
                  </td>
                  <td>
                    Item ID:<br/>
                    <input type="text" size="5" name="itemid" value="">
                  </td>
                </tr>
                <tr>
                  <td>
                    Charges:<br/>
                    <input type="text" size="3" name="charges" value="0">
                  </td>
                  <td colspan="2">
                    Color:<br/>
                    <input type="text" size="10" name="color" value="4278190080">
                  </td>
                </tr>
                <tr>
                  <td>
                    Aug Slot 1:<br/>
                    <input type="text" size="3" name="augslot1" value="0">
                  </td>
                  <td>
                    Aug Slot 2:<br/>
                    <input type="text" size="3" name="augslot2" value="0">
                  </td>
                  <td>
                    Aug Slot 3:<br/>
                    <input type="text" size="3" name="augslot3" value="0">
                  </td>
                </tr>
                <tr>
                  <td>
                    Aug Slot 4:<br/>
                    <input type="text" size="3" name="augslot4" value="0">
                  </td>
                  <td>
                    Aug Slot 5:<br/>
                    <input type="text" size="3" name="augslot5" value="0">
                  </td>
                  <td>
                    Inst NoDrop:<br/>
                    <input type="checkbox" name="instnodrop">
                  </td>
                </tr>
                <tr>
                  <td colspan="3">
                    Custom Data:<br/>
                    <input type="text" size="37" name="custom_data" value="">
                  </td>
                </tr>
                <tr><td>&nbsp;</td></tr>
                <tr>
                  <td colspan="3">
                    <center>
                      <input type="submit" name="submit" value="Submit Changes">&nbsp;<input type="button" name="cancel" value="Cancel" onClick="history.back();">
                    </center>
                  </td>
                </tr>
              </table>
            </form>
          </td>
        </tr>
      </table>
      <script>alert("WARNING!\n\nManually adding an item incorrectly may cause the character to not be able to load into the game.");</script>
