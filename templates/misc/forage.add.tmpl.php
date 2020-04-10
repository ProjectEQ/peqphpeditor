  <center>
    <iframe id='searchframe' src='templates/iframes/itemsearch.php'></iframe>
    <input id="button" type="button" value='Hide Item Search' onclick='hideSearch();' style='display:none; margin-bottom: 20px;'>
  </center>
  <form method="post" action="index.php?editor=misc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&action=12">
    <div class="edit_form" style="width: 200px;">
      <div class="edit_form_header">Add Forage Entry</div>
      <div class="edit_form_content">
        <strong>Item ID</strong> (<a href="javascript:showSearch();">search</a>)<br>
        <input class="indented" id="id" type="text" name="fgiid" size="7" value=""><br><br>
        <strong>ID</strong><br>
        <input class="indented" id="id" type="text" name="fgid" size="7" value="<?=$suggestfgid?>"><br><br>
        <strong>Zone</strong><br>
        <input class="indented" id="id" type="text" name="zoneid" size="7" value="<?=$zid?>"><br><br>
        <strong>Level</strong><br>
        <input class="indented" id="id" type="text" name="level" size="7" value="0"><br><br>
        <strong>Chance</strong><br>
        <input class="indented" id="id" type="text" name="chance" size="7" value="0">%<br><br>
        <center>
          <input type="submit" value="Submit Changes">
        </center>
      </div>
    </div>
  </form>
