      <center>
        <iframe id='searchframe' src='templates/iframes/itemsearch.php'></iframe>
        <input id="button" type="button" value='Hide Item Search' onclick='hideSearch();' style='display:none; margin-bottom: 20px;'>
      </center>

      <form method="post" action="index.php?editor=tradeskill&ts=<?=$ts?>&rec=<?=$rec?>&action=8">
      <div class="edit_form" style="width: 200px;">
        <div class="edit_form_header">
          Add Recipe Component
        </div>
        <div class="edit_form_content">
            <strong>Item ID:</strong> (<a href="javascript:showSearch();">search</a>)<br>
            <input class="indented" id="id" type="text" name="item_id" size="7" value=""><br><br>

            <strong>Item is a:</strong><br>
            <select class="indented" name="type" onChange="toggleComponentType()">
              <option value="0">Combine Container</option>
              <option value="1">Component</option>
              <option value="2">Product</option>
            </select><br><br>
            <fieldset>
              <legend><strong><font size="-1">Components:</font></strong></legend>
		    			Qty Required:<br>
              <input class="indented" type="text" name="componentcount" size="7" value="0" disabled><br><br>
              Qty Returned on Fail: <br>
              <input class="indented" type="text" name="failcount" size="7" value="0" disabled>
            </fieldset><br><br>

            <fieldset>
              <legend><strong><font size="-1">Products:</font></strong></legend>
              Qty Produced: <br>
              <input class="indented" type="text" name="successcount" size="7" value="0" disabled>
            </fieldset><br>

            <center>
              <input type="hidden" name='iscontainer' value="1">
              <input type="hidden" name="recipe_id" value="<?=$rec?>">
              <input type="submit" name="submit" value="Submit Changes" onClick="enable();">
            </center>
          </form>
        </div>
      </div>