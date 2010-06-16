      <center>
        <iframe id='searchframe' src='templates/iframes/itemsearch.php'></iframe>
        <input id="button" type="button" value='Hide Item Search' onclick='hideSearch();' style='display:none; margin-bottom: 20px;'>
      </center>

      <form method="post" action="index.php?editor=misc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&action=18">
      <div class="edit_form" style="width: 200px;">
        <div class="edit_form_header">
          Add Ground Spawn
        </div>
        <div class="edit_form_content">
            <strong>Item ID</strong> (<a href="javascript:showSearch();">search</a>)<br>
            <input class="indented" id="id" type="text" name="giid" size="7" value=""><br><br>
            <strong>ID</strong><br>
            <input class="indented" id="id" type="text" name="gsid" size="7" value="<?=$suggestgsid?>"><br><br>
            <strong>Zone</strong><br>
            <input class="indented" id="id" type="text" name="zoneid" size="7" value="<?=$zid?>"><br><br>
            <strong>Max X</strong><br>
            <input class="indented" id="id" type="text" name="max_x" size="7" value="0"><br><br>
            <strong>Max Y</strong><br>
            <input class="indented" id="id" type="text" name="max_y" size="7" value="0"><br><br>
            <strong>Max Z</strong><br>
            <input class="indented" id="id" type="text" name="max_z" size="7" value="0"><br><br>
            <strong>Min X</strong><br>
            <input class="indented" id="id" type="text" name="min_x" size="7" value="0"><br><br>
            <strong>Min Y</strong><br>
            <input class="indented" id="id" type="text" name="min_y" size="7" value="0"><br><br>
            <strong>Heading</strong><br>
            <input class="indented" id="id" type="text" name="heading" size="7" value="0"><br><br>
            <strong>Max</strong><br>
            <input class="indented" id="id" type="text" name="max_allowed" size="7" value="1"><br><br>
            <strong>Respawn</strong><br>
            <input class="indented" id="id" type="text" name="respawn_timer" size="7" value="300000"><br><br>
            <strong>Version</strong><br>
            <input class="indented" id="id" type="text" name="version" size="7" value="<?=$suggestver?>"><br><br>
            <strong>Name</strong><br>
            <input class="indented" id="id" type="text" name="name" size="20" value="IT"><br><br>
            <strong>Comment</strong><br>
            <input class="indented" id="id" type="text" name="comment" size="20" value="Default comment"><br><br>

        <center>
          <input type="submit" value="Submit Changes">
        </center>
      </form>
      </div>
      </div>