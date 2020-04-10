  <center>
    <iframe id='searchframe' src='templates/iframes/itemsearch.php'></iframe>
    <input id="button" type="button" value='Hide Item Search' onclick='hideSearch();' style='display:none; margin-bottom: 20px;'>
  </center>
  <form name="gspawn" method="post" action="index.php?editor=misc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&action=15">
    <div class="edit_form" style="width: 200px;">
      <div class="edit_form_header">
        Edit Ground Spawn <?=$gsid?>
      </div>
      <div class="edit_form_content">
        <strong>Item ID</strong> (<a href="javascript:showSearch();">search</a>)<br>
        <input class="indented" id="id" type="text" name="giid" size="7" value="<?=$giid?>"><br><br>
        <strong>Zone</strong><br>
        <input class="indented" id="id" type="text" name="zoneid" size="7" value="<?=$zoneid?>"><br><br>
        <strong>Max X</strong><br>
        <input class="indented" id="id" type="text" name="max_x" size="7" value="<?=$max_x?>"><br><br>
        <strong>Max Y</strong><br>
        <input class="indented" id="id" type="text" name="max_y" size="7" value="<?=$max_y?>"><br><br>
        <strong>Max Z</strong><br>
        <input class="indented" id="id" type="text" name="max_z" size="7" value="<?=$max_z?>"><br><br>
        <strong>Min X</strong><br>
        <input class="indented" id="id" type="text" name="min_x" size="7" value="<?=$min_x?>"><br><br>
        <strong>Min Y</strong><br>
        <input class="indented" id="id" type="text" name="min_y" size="7" value="<?=$min_y?>"><br><br>
        <strong>Heading</strong><br>
        <input class="indented" id="id" type="text" name="heading" size="7" value="<?=$heading?>"><br><br>
        <strong>Max</strong><br>
        <input class="indented" id="id" type="text" name="max_allowed" size="7" value="<?=$max_allowed?>"><br><br>
        <strong>Respawn</strong><br>
        <input class="indented" id="id" type="text" name="respawn_timer" size="7" value="<?=$respawn_timer?>"><br><br>
        <strong>Version</strong><br>
        <input class="indented" id="id" type="text" name="version" size="7" value="<?=$version?>"><br><br>
        <strong>Name</strong><br>
        <input class="indented" id="id" type="text" name="name" size="20" value="<?=$name?>"><br><br>
        <strong>Comment</strong><br>
        <input class="indented" id="id" type="text" name="comment" size="20" value="<?=$comment?>"><br><br>
        <center>
          <input type="hidden" name="gsid" value="<?=$gsid?>">
          <input type="submit" value="Submit Changes">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back();">
        </center>
      </div>
    </div>
  </form>
