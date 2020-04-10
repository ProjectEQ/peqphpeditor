  <center>
    <iframe id='searchframe' src='templates/iframes/itemsearch.php'></iframe>
    <input id="button" type="button" value='Hide Item Search' onclick='hideSearch();' style='display:none; margin-bottom: 20px;'>
  </center>
  <form name="forage" method="post" action="index.php?editor=misc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&action=9">
    <div class="edit_form" style="width: 200px;">
      <div class="edit_form_header">Edit Forage Entry <?=$fgid?></div>
      <div class="edit_form_content">
        <strong>Item ID</strong> (<a href="javascript:showSearch();">search</a>)<br>
        <input class="indented" id="id" type="text" name="fgiid" size="7" value="<?=$fgiid?>"><br><br>
        <strong>Zone</strong><br>
        <input class="indented" id="id" type="text" name="zoneid" size="7" value="<?=$zoneid?>"><br><br>
        <strong>Level</strong><br>
        <input class="indented" id="id" type="text" name="level" size="7" value="<?=$level?>"><br><br>
        <strong>Chance</strong><br>
        <input class="indented" id="id" type="text" name="chance" size="7" value="<?=$chance?>">%<br><br>
        <center>
          <input type="hidden" name="fgid" value="<?=$fgid?>">
          <input type="submit" value="Submit Changes">
        </center>
      </div>
    </div>
  </form>
