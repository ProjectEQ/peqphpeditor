  <center>
    <iframe id="searchframe" src="templates/iframes/itemsearch.php"></iframe>
    <input id="button" type="button" value="Hide Item Search" onclick="hideSearch();" style="display:none; margin-bottom: 20px;">
  </center>
  <div style="margin: auto; width: 650px;">
    <div class="edit_form">
      <div class="edit_form_header">Add New Starting Item</div>
      <div class="edit_form_content">
        <form name="starting_item_create" method="post" action="index.php?editor=items&action=14">
          <table width="100%" cellspacing="0" cellpadding="3">
            <tr>
              <td>
                <strong>ID:</strong><br>
                <input type="text" name="id" size="7" value="<?=$nextid?>">
              </td>
              <td>
                <strong>Status:</strong><br>
                <input type="text" name="status" size="5" value="0">
              </td>
              <td colspan="2">
                <strong>Item ID:</strong> (<a href="javascript:showSearch();">search</a>)<br>
                <input type="text" name="item_id" size="7" id="id" value="0">
              </td>
            </tr>
            <tr>
              <td colspan="2">
                <strong>Classes:</strong> (| = Delimiter)(0 = ALL)<br>
                <input type="text" name="class_list" size="40" value="0">
              </td>
              <td colspan="2">
                <strong>Races:</strong> (| = Delimiter)(0 = ALL)<br>
                <input type="text" name="race_list" size="40" value="0">
              </td>
            </tr>
            <tr>
              <td colspan="2">
                <strong>Deities:</strong> (| = Delimiter)(0 = ALL)<br>
                <input type="text" name="deity_list" size="40" value="0">
              </td>
              <td colspan="2">
                <strong>Zones:</strong> (| = Delimiter)(0 = ALL)<br>
                <input type="text" name="zone_id_list" size="40" value="0">
              </td>
            </tr>
            <tr>
              <td>
                <strong>Charges:</strong><br>
                <input type="text" name="item_charges" size="5" value="1">
              </td>
              <td>
                <strong>Inventory Slot:</strong><br>
                <input type="text" name="inventory_slot" size="5" value="-1">
              </td>
              <td>
                <strong>Min Expansion:</strong><br>
                <input type="text" name="min_expansion" size="10" value="-1">
              </td>
              <td>
                <strong>Max Expansion:</strong><br>
                <input type="text" name="max_expansion" size="10" value="-1">
              </td>
            </tr>
            <tr>
              <td>
                <strong>Augment 1:</strong><br>
                <input type="text" name="augment_one" size="10" value="0">
              </td>
              <td>
                <strong>Augment 2:</strong><br>
                <input type="text" name="augment_two" size="10" value="0">
              </td>
              <td>
                <strong>Augment 3:</strong><br>
                <input type="text" name="augment_three" size="10" value="0">
              </td>
              <td>
                <strong>Augment 4:</strong><br>
                <input type="text" name="augment_four" size="10" value="0">
              </td>
            </tr>
            <tr>
              <td>
                <strong>Augment 5:</strong><br>
                <input type="text" name="augment_five" size="10" value="0">
              </td>
              <td>
                <strong>Augment 6:</strong><br>
                <input type="text" name="augment_six" size="10" value="0">
              </td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td colspan="2">
                <strong>Content Flags:</strong><br>
                <input type="text" name="content_flags" size="40" value="">
              </td>
              <td colspan="2">
                <strong>Content Flags Disabled:</strong><br>
                <input type="text" name="content_flags_disabled" size="40" value="">
              </td>
            </tr>
          </table><br><br>
          <center>
            <input type="submit" value="Add Item">&nbsp;&nbsp;
            <input type="button" value="Cancel" onClick="history.back();">
          </center>
        </form>
      </div>
    </div>
  </div>
