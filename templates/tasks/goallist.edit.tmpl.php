      <center>
        <iframe id='searchframe' src='templates/iframes/itemsearch.php'></iframe>
        <input id="button" type="button" value='Hide Item Search' onclick='hideSearch();' style='display:none; margin-bottom: 20px;'>
      </center>

      <form method="post" action="index.php?editor=tasks&action=13">
      <div class="edit_form" style="width: 200px;">
        <div class="edit_form_header">
          Edit Goallist Entry
        </div>
        <div class="edit_form_content">
            <strong>Item ID</strong> (<a href="javascript:showSearch();">search</a>)<br>
            <input class="indented" id="id" type="text" name="entry" size="7" value=""><br><br>
            <strong>ID</strong><br>
            <input class="indented" id="id" type="text" name="listid" size="7" value="<?=$suggestid?>"><br><br>
        <center>
          <input type="hidden" name="taskid" value="<?=$tskid?>">
          <input type="submit" value="Submit Changes">
        </center>
      </form>
      </div>
      </div>