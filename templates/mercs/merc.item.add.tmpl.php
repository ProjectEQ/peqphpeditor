  <center>
    <iframe id='searchframe' src='templates/iframes/itemsearch.php'></iframe>
    <input id="button" type="button" value='Hide Item Search' onclick='hideSearch();' style='display:none; margin-bottom: 20px;'>
  </center>
  <div class="table_container" style="width: 700px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td>Create Mercenary Item</td>
        </tr>
      </table>
    </div>
    <div class="table_content">
      <form name="add_mercenary_item" method="post" action="index.php?editor=mercs&merc_subtype_id=<?=$merc_subtype_id?>&action=75">
        <table width="100%" cellpadding="5" cellspacing="5">
          <tr>
            <td>
              <strong>ID:</strong><br>
              <input type="text" name="merc_inventory_id" size="10" value="<?=$suggest_id?>">
            </td>
            <td>
              <strong>Subtype ID:</strong><br>
              <input type="text" size="10" value="<?=$merc_subtype_id?>" disabled>
            </td>
            <td>
              <strong>Item ID:</strong> (<a href="javascript:showSearch();">search</a>)<br>
              <input type="text" id="id" name="item_id" size="10" value="0">
            </td>
            <td>
              <strong>Min Level:</strong><br>
              <input type="text" name="min_level" size="10" value="0">
            </td>
            <td>
              <strong>Max Level:</strong><br>
              <input type="text" name="max_level" size="10" value="0">
            </td>
          </tr>
        </table><br>
        <center>
          <input type="hidden" name="merc_subtype_id" value="<?=$merc_subtype_id?>">
          <input type="submit" value="Insert Item">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back()">
        </center>
      </form>
    </div>
  </div>
