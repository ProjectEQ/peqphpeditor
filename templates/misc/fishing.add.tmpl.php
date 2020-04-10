  <center>
    <iframe id='searchframe' src='templates/iframes/itemsearch.php'></iframe>
    <input id="button" type="button" value='Hide Item Search' onclick='hideSearch();' style='display:none; margin-bottom: 20px;'>
  </center>
  <form method="post" action="index.php?editor=misc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&action=6">
    <div class="edit_form" style="width: 200px;">
      <div class="edit_form_header">Add Fishing Entry</div>
      <div class="edit_form_content">
        <strong>Item ID</strong> (<a href="javascript:showSearch();">search</a>)<br>
        <input class="indented" id="id" type="text" name="fiid" size="7" value=""><br><br>
        <strong>ID</strong><br>
        <input class="indented" id="id" type="text" name="fsid" size="7" value="<?=$suggestfsid?>"><br><br>
        <strong>Zone</strong><br>
        <input class="indented" id="id" type="text" name="zoneid" size="7" value="<?=$zid?>"><br><br>
        <strong>Skill Level</strong><br>
        <input class="indented" id="id" type="text" name="skill_level" size="7" value="0"><br><br>
        <strong>Chance</strong><br>
        <input class="indented" id="id" type="text" name="chance" size="7" value="0">%<br><br>
        <strong>NPC</strong><br>
        <input class="indented" id="id" type="text" name="npc_id" size="7" value="0"><br><br>
        <strong>NPC Chance</strong><br>
        <input class="indented" id="id" type="text" name="npc_chance" size="7" value="0">%<br><br>
        <center>
          <input type="submit" value="Submit Changes">
        </center>
      </div>
    </div>
  </form>
