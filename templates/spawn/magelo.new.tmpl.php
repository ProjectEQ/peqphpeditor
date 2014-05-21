      <div class="table_container" style="width:200px;">
        <div class="edit_form_header">
          <center>Magelo coords import for <?=$npcid?></center>
        </div>
        <div class="edit_form_content">
          <form method="post" action="index.php?editor=spawn&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=81">
            <center>
		Use spawngroup:<br>
		 <select name="spawngroupinsert">
		 <option selected="selected" value="1">Yes</option>
		 <option value="0">No</option>
              </select><br><br>
              Limit:<br>
              <input type="text" name="limit" size="6" value="150"><br><br>
              Heading:<br>
              <input type="text" name="heading" size="6" value="0"><br><br>
             	Respawntime:<br>
              <input type="text" name="respawntime" size="6" value="1200"><br><br>
		Spawn Limit:<br>
              <input type="text" name="spawnlimit" size="6" value="0"><br><br>
		MinCoord:<br>
              <input type="text" name="mincoord" size="6" value="-20000"><br><br>
		MaxCoord:<br>
              <input type="text" name="maxcoord" size="6" value="20000"><br><br>
		Forced Z:<br>
		<input type="text" name="forcedz" size="6" value="0"><br><br>
              <input type="submit" value="Submit">
            </center>
          </form>
        </div>
      </div>