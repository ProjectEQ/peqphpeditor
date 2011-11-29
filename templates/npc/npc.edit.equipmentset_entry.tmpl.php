      <center>
        <iframe id='searchframe' src='templates/iframes/itemsearch.php'></iframe>
        <input id="button" type="button" value='Hide Item Search' onclick='hideSearch();' style='display:none; margin-bottom: 20px;'>
      </center>

      <form name="addpet" method="post" action="index.php?editor=npc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=70">
         <div class="edit_form" style="width: 250px;">
        <div class="edit_form_header">
          Edit Pet Equipmentset Entry for ID <?=$set_id?>
        </div>
         <div class="edit_form_content">
            <strong>Item ID</strong> (<a href="javascript:showSearch();">search</a>)<br>
            <input class="indented" id="id" type="text" name="item_id" size="7" value="<?=$item_id?>"><br><br>
            <strong>Slot</strong><br>
            <input class="indented" id="id" type="text" name="slot" size="7" value="<?=$slot?>"><br><br>
        <center>
          <input type="hidden" name="set_id" value="<?=$set_id?>">
          <input type="submit" value="Submit Changes">
        </center>
      </form>
      </div>
      </div>