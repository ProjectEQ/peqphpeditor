      <table class="edit_form" width="300px">
        <tr>
          <td class="edit_form_header">
            Inventory item located at <?=getPlayerName($inv_item['charid'])?>'s <?=$slots[$inv_item['slotid']]?>
          </td>
        </tr>
        <tr>
          <td class="edit_form_content">
            <form name="inventory" id="inventory" method="POST" action="index.php?editor=inv&playerid=<?=$inv_item['charid']?>&slotid=<?=$inv_item['slotid']?>&action=7">
              <table width="100%" cellpadding="3" cellspacing="0">
                <tr>
                  <td>
                    Player ID:<br/>
                    <input type="text" size="5" name="charid" value="<?=$inv_item['charid']?>" readonly="true">
                  </td>
                  <td>
                    <a title="22-29: Main Inventory Slots">Slot ID:</a><br/>
                    <input type="text" size="3" name="slotid" value="<?=$inv_item['slotid']?>" readonly="true">
                  </td>
                  <td>
                    Item ID:<br/>
                    <input type="text" size="5" name="itemid" value="<?=$inv_item['itemid']?>">
                  </td>
                </tr>
                <tr>
                  <td>
                    Charges:<br/>
                    <input type="text" size="3" name="charges" value="<?=$inv_item['charges']?>">
                  </td>
                  <td colspan="2">
                    Color:<br/>
                    <input type="text" size="10" name="color" value="<?=$inv_item['color']?>">
                  </td>
                </tr>
                <tr>
                  <td>
                    Aug Slot 1:<br/>
                    <input type="text" size="3" name="augslot1" value="<?=$inv_item['augslot1']?>">
                  </td>
                  <td>
                    Aug Slot 2:<br/>
                    <input type="text" size="3" name="augslot2" value="<?=$inv_item['augslot2']?>">
                  </td>
                  <td>
                    Aug Slot 3:<br/>
                    <input type="text" size="3" name="augslot3" value="<?=$inv_item['augslot3']?>">
                  </td>
                </tr>
                <tr>
                  <td>
                    Aug Slot 4:<br/>
                    <input type="text" size="3" name="augslot4" value="<?=$inv_item['augslot4']?>">
                  </td>
                  <td>
                    Aug Slot 5:<br/>
                    <input type="text" size="3" name="augslot5" value="<?=$inv_item['augslot5']?>">
                  </td>
                  <td>
                    Inst NoDrop:<br/>
                    <input type="checkbox" name="instnodrop"<?echo ($inv_item['instnodrop'] == 1) ? " checked" : "";?>>
                  </td>
                </tr>
                <tr>
                  <td colspan="3">
                    Custom Data:<br/>
                    <input type="text" size="37" name="custom_data" value="<?=$inv_item['custom_data']?>">
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
