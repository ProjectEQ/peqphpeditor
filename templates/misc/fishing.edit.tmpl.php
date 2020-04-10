  <center>
    <iframe id='searchframe' src='templates/iframes/itemsearch.php'></iframe>
    <input id="button" type="button" value='Hide Item Search' onclick='hideSearch();' style='display:none; margin-bottom: 20px;'>
  </center>
  <form name="fishing" method="post" action="index.php?editor=misc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&action=3">
    <div class="edit_form" style="width: 200px;">
      <div class="edit_form_header">Edit Fishing Entry <?=$fsid?></div>
      <div class="edit_form_content">
        <strong>Item ID</strong> (<a href="javascript:showSearch();">search</a>)<br>
        <input class="indented" id="id" type="text" name="fiid" size="7" value="<?=$fiid?>"><br><br>
        <strong>Zone</strong><br>
        <input class="indented" id="id" type="text" name="zoneid" size="7" value="<?=$zoneid?>"><br><br>
        <strong>Skill Level</strong><br>
        <input class="indented" id="id" type="text" name="skill_level" size="7" value="<?=$skill_level?>"><br><br>
        <strong>Chance</strong><br>
        <input class="indented" id="id" type="text" name="chance" size="7" value="<?=$chance?>">%<br><br>
        <strong>NPC</strong><br>
        <input class="indented" id="id" type="text" name="npc_id" size="7" value="<?=$npc_id?>"><br><br>
        <strong>NPC Chance</strong><br>
        <input class="indented" id="id" type="text" name="npc_chance" size="7" value="<?=$npc_chance?>">%<br><br>
        <center>
          <input type="hidden" name="fsid" value="<?=$fsid?>">
          <input type="submit" value="Submit Changes">
        </center>
      </div>
    </div>
  </form>
