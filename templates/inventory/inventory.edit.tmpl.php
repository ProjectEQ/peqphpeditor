      <table class="edit_form" width="300px">
        <tr>
          <td class="edit_form_header">
            Inventory item located at <?=getPlayerName($inv_item['character_id'])?>'s <?=get_slot_name($inv_item['slot_id'])?>
          </td>
        </tr>
        <tr>
          <td class="edit_form_content">
            <form name="inventory" id="inventory" method="POST" action="index.php?editor=inv&playerid=<?=$inv_item['character_id']?>&slot_id=<?=$inv_item['slot_id']?>&action=7">
              <table width="100%" cellpadding="3" cellspacing="0">
                <tr>
                  <td>
                    Player ID:<br>
                    <input type="text" size="5" value="<?=$inv_item['character_id']?>" disabled>
                  </td>
                  <td>
                    Slot ID:<br>
                    <input type="text" size="3" value="<?=$inv_item['slot_id']?>" disabled>
                  </td>
                  <td>
                    Item ID:<br>
                    <input type="text" size="5" name="item_id" value="<?=$inv_item['item_id']?>">
                  </td>
                </tr>
                <tr>
                  <td>
                    Charges:<br>
                    <input type="text" size="3" name="charges" value="<?=$inv_item['charges']?>">
                  </td>
                  <td colspan="2">
                    Color:<br>
                    <input type="text" size="10" name="color" value="<?=$inv_item['color']?>">
                  </td>
                </tr>
                <tr>
                  <td>
                    Augment 1:<br>
                    <input type="text" size="3" name="augment_one" value="<?=$inv_item['augment_one']?>">
                  </td>
                  <td>
                    Augment 2:<br>
                    <input type="text" size="3" name="augment_two" value="<?=$inv_item['augment_two']?>">
                  </td>
                  <td>
                    Augment 3:<br>
                    <input type="text" size="3" name="augment_three" value="<?=$inv_item['augment_three']?>">
                  </td>
                </tr>
                <tr>
                  <td>
                    Augment 4:<br>
                    <input type="text" size="3" name="augment_four" value="<?=$inv_item['augment_four']?>">
                  </td>
                  <td>
                    Augment 5:<br>
                    <input type="text" size="3" name="augment_five" value="<?=$inv_item['augment_five']?>">
                  </td>
                  <td>
                    Augment 6:<br>
                    <input type="text" size="3" name="augment_six" value="<?=$inv_item['augment_six']?>">
                  </td>
                </tr>
                <tr>
                  <td colspan="3">
                    Inst NoDrop:<br>
                    <input type="checkbox" name="instnodrop"<?echo ($inv_item['instnodrop'] == 1) ? " checked" : "";?>>
                  </td>
                </tr>
                <tr>
                  <td colspan="3">
                    Custom Data:<br>
                    <input type="text" size="37" name="custom_data" value="<?=$inv_item['custom_data']?>">
                  </td>
                </tr>
                <tr>
                  <td>
                    Ornament Icon:<br>
                    <input type="text" size="3" name="ornament_icon" value="<?=$inv_item['ornament_icon']?>">
                  </td>
                  <td>
                    Ornament idfile:<br>
                    <input type="text" size="3" name="ornament_idfile" value="<?=$inv_item['ornament_idfile']?>">
                  </td>
                  <td>
                    Ornament Hero Model:<br>
                    <input type="text" size="3" name="ornament_hero_model" value="<?=$inv_item['ornament_hero_model']?>">
                  </td>
                </tr>
                <tr>
                  <td colspan="3">
                    <center>
                      <input type="hidden" name="character_id" value="<?=$inv_item['character_id']?>">
                      <input type="hidden" name="slot_id" value="<?=$inv_item['slot_id']?>">
                      <input type="submit" name="submit" value="Submit Changes">&nbsp;&nbsp;
                      <input type="button" name="cancel" value="Cancel" onClick="history.back();">
                    </center>
                  </td>
                </tr>
              </table>
            </form>
          </td>
        </tr>
      </table>
