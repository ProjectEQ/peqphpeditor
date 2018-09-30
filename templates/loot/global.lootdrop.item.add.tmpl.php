  <center>
    <iframe id='searchframe' src='templates/iframes/itemsearch.php'></iframe>
    <input id="button" type="button" value='Hide Item Search' onclick='hideSearch("searchframe");' style='display:none; margin-bottom: 20px;'>
  </center>
  <form name="lootdrop_item" method="POST" action="index.php?editor=loot&action=66">
    <div class="edit_form" style="width: 200px;">
      <div class="edit_form_header">Add an Item to Lootdrop</div>
      <div class="edit_form_content">
        <strong>Lootdrop ID:</strong><br>
        <input type="text" size="5" value="<?=$ldid?>" disabled><br><br>
        <strong>Item ID:</strong> (<a href="javascript:showSearch('searchframe');">search</a>)<br>
        <input id="id" type="text" size="5" name="itemid"><br><br>
        <strong>Charges:</strong><br>
        <input type="text" size="5" name="item_charges" value="1"><br><br>
        <strong>Chance:</strong><br>
        <input type="text" size="5" name="chance" value="100">%<br><br>
        <strong>Multiplier:</strong><br>
        <input type="text" size="5" name="multiplier" value="1"><br><br>
        <center>
          <input type="hidden" name="global_loot" value="<?=$global_loot?>">
          <input type="hidden" name="ldid" value="<?=$ldid?>">
          <input type="submit" name="submit" value="Add Item">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back();">
        </center>
      </div>
    </div>
  </form>
