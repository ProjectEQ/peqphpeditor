      <center>
        <iframe id='searchframe' src='templates/iframes/itemsearch.php'></iframe>
        <input id="button" type="button" value='Hide Item Search' onclick='hideSearch();' style='display:none; margin-bottom: 20px;'>
      </center>
      <form name="component" method="post" action="index.php?editor=tradeskill&ts=<?=$ts?>&rec=<?=$rec?>&id=<?=$id?>&action=6">
        <div class="edit_form" style="width: 200px;">
          <div class="edit_form_header">Edit Recipe Component</div>
          <div class="edit_form_content">
            <strong>Item ID:</strong> (<a href="javascript:showSearch();">search</a>)<br>
            <input class="indented" id="id" type="text" name="item_id" size="7" value="<?=$item_id?>"><br><br>
            <fieldset>
              <legend><strong><font size="-1">Containers:</font></strong></legend>
              Is this the container?<br>
              <select class="indented" name='iscontainer'>
                <option value="0"<?echo($iscontainer == 0) ? " selected" : ""?>>no</option>
                <option value="1"<?echo($iscontainer == 1) ? " selected" : ""?>>yes</option>
              </select>
            </fieldset><br><br>
            <fieldset>
              <legend><strong><font size="-1">Components:</font></strong></legend>
              Qty Required:<br>
              <input class="indented" type="text" name="componentcount" size="7" value="<?=$componentcount?>"><br><br>
              Qty Returned on Fail:<br>
              <input class="indented" type="text" name="failcount" size="7" value="<?=$failcount?>"><br><br>
              Qty Returned on Salvage:<br>
              <input class="indented" type="text" name="salvagecount" size="7" value="<?=$salvagecount?>">
            </fieldset><br><br>
            <fieldset>
              <legend><strong><font size="-1">Products:</font></strong></legend>
              Qty Produced: <br>
              <input class="indented" type="text" name="successcount" size="7" value="<?=$successcount?>">
            </fieldset><br>
            <center>
              <input type="hidden" name="id" value="<?=$id?>">
              <input type="hidden" name="recipe_id" value="<?=$recipe_id?>">
              <input type="submit" name="submit" value="Submit Changes">
            </center>
          </div>
        </div>
      </form>
