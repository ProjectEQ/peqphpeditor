  <center>
    <iframe id="searchframe" src="templates/iframes/itemsearch.php"></iframe>
    <input id="button" type="button" value="Hide Item Search" onclick="hideSearch();" style="display:none; margin-bottom: 20px;">
  </center>
  <div style="margin: auto; width: 650px;">
    <div class="edit_form">
      <div class="edit_form_header">Edit Starting Item</div>
      <div class="edit_form_content">
        <form name="starting_item_edit" method="post" action="index.php?editor=items&action=12">
          <table width="100%" cellspacing="0" cellpadding="3">
            <tr>
              <td>
                <strong>ID:</strong><br>
                <input type="text" size="7" value="<?=$item['id']?>" disabled>
              </td>
              <td>
                <strong>Status:</strong><br>
                <input type="text" name="status" size="5" value="<?=$item['status']?>">
              </td>
              <td colspan="2">
                <strong>Item ID:</strong> (<a href="javascript:showSearch();">search</a>)<br>
                <input type="text" name="item_id" size="7" id="id" value="<?=$item['item_id']?>">
              </td>
            </tr>
            <tr>
              <td colspan="2">
                <strong>Classes:</strong> (| = Delimiter)(0 = ALL)<br>
                <input type="text" name="class_list" size="40" value="<?=$item['class_list']?>">
              </td>
              <td colspan="2">
                <strong>Races:</strong> (| = Delimiter)(0 = ALL)<br>
                <input type="text" name="race_list" size="40" value="<?=$item['race_list']?>">
              </td>
            </tr>
            <tr>
              <td colspan="2">
                <strong>Deities:</strong> (| = Delimiter)(0 = ALL)<br>
                <input type="text" name="deity_list" size="40" value="<?=$item['deity_list']?>">
              </td>
              <td colspan="2">
                <strong>Zones:</strong> (| = Delimiter)(0 = ALL)<br>
                <input type="text" name="zone_id_list" size="40" value="<?=$item['zone_id_list']?>">
              </td>
            </tr>
            <tr>
              <td>
                <strong>Charges:</strong><br>
                <input type="text" name="item_charges" size="5" value="<?=$item['item_charges']?>">
              </td>
              <td>
                <strong>Inventory Slot:</strong><br>
                <input type="text" name="inventory_slot" size="5" value="<?=$item['inventory_slot']?>">
              </td>
              <td>
                <strong>Min Expansion:</strong><br>
                <input type="text" name="min_expansion" size="10" value="<?=$item['min_expansion']?>">
              </td>
              <td>
                <strong>Max Expansion:</strong><br>
                <input type="text" name="max_expansion" size="10" value="<?=$item['max_expansion']?>">
              </td>
            </tr>
            <tr>
              <td>
                <strong>Augment 1:</strong><br>
                <input type="text" name="augment_one" size="10" value="<?=$item['augment_one']?>">
              </td>
              <td>
                <strong>Augment 2:</strong><br>
                <input type="text" name="augment_two" size="10" value="<?=$item['augment_two']?>">
              </td>
              <td>
                <strong>Augment 3:</strong><br>
                <input type="text" name="augment_three" size="10" value="<?=$item['augment_three']?>">
              </td>
              <td>
                <strong>Augment 4:</strong><br>
                <input type="text" name="augment_four" size="10" value="<?=$item['augment_four']?>">
              </td>
            </tr>
            <tr>
              <td>
                <strong>Augment 5:</strong><br>
                <input type="text" name="augment_five" size="10" value="<?=$item['augment_five']?>">
              </td>
              <td>
                <strong>Augment 6:</strong><br>
                <input type="text" name="augment_six" size="10" value="<?=$item['augment_six']?>">
              </td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td colspan="2">
                <strong>Content Flags:</strong><br>
                <input type="text" name="content_flags" size="40" value="<?=$item['content_flags']?>">
              </td>
              <td colspan="2">
                <strong>Content Flags Disabled:</strong><br>
                <input type="text" name="content_flags_disabled" size="40" value="<?=$item['content_flags_disabled']?>">
              </td>
            </tr>
          </table><br><br>
          <center>
            <input type="hidden" name="id" value="<?=$item['id']?>">
            <input type="submit" value="Edit Item">&nbsp;&nbsp;
            <input type="button" value="Cancel" onClick="history.back();">
          </center>
        </form>
      </div>
    </div>
  </div>
