  <center>
    <iframe id='searchframe' src='templates/iframes/itemsearch.php'></iframe>
    <input id="button" type="button" value='Hide Item Search' onclick='hideSearch();' style='display:none; margin-bottom: 20px;'>
  </center>
  <div class="table_container" style="width: 700px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td>Edit Mercenary Item</td>
        </tr>
      </table>
    </div>
    <div class="table_content">
      <form name="edit_mercenary_item" method="post" action="index.php?editor=mercs&merc_subtype_id=<?=$merc_subtype_id?>&action=77">
        <table width="100%" cellpadding="5" cellspacing="5">
          <tr>
            <td>
              <strong>ID:</strong><br>
              <input type="text" size="10" value="<?=$item['merc_inventory_id']?>" disabled>
            </td>
            <td>
              <strong>Subtype ID:</strong><br>
              <input type="text" size="10" value="<?=$item['merc_subtype_id']?>" disabled>
            </td>
            <td>
              <strong>Item ID:</strong> (<a href="javascript:showSearch();">search</a>)<br>
              <input type="text" id="id" name="item_id" size="10" value="<?=$item['item_id']?>">
            </td>
            <td>
              <strong>Min Level:</strong><br>
              <input type="text" name="min_level" size="10" value="<?=$item['min_level']?>">
            </td>
            <td>
              <strong>Max Level:</strong><br>
              <input type="text" name="max_level" size="10" value="<?=$item['max_level']?>">
            </td>
          </tr>
        </table><br>
        <center>
          <input type="hidden" name="merc_subtype_id" value="<?=$item['merc_subtype_id']?>">
          <input type="hidden" name="merc_inventory_id" value="<?=$item['merc_inventory_id']?>">
          <input type="submit" value="Update Item">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back()">
        </center>
      </form>
    </div>
  </div>
