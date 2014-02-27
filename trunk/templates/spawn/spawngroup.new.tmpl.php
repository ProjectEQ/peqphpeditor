      <div class="table_container" style="width:200px;">
        <div class="edit_form_header">
          <center>Add a Spawngroup to <?=$currzone?></center>
        </div>
        <div class="edit_form_content">
          <form method="post" action="index.php?editor=spawn&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&action=17">
            <center>
              Suggested ID:
		spawn_limit:
              <input type="text" name="id" size="6" value="<?=$suggestedid?>">
              <input class="indented" type="text" name="spawn_limit" size="5" value="0"><br><br>
              Spawngroup Name:
              <input type="text" name="name" size="15" value="<?=$currzone?>_<?=$suggestedid?>"><br><br>
             	First NPCID:
		Chance:<br>
              <input type="text" name="npcID" size="5" value="<?=$npcid?>">
		<input type="text" name="chance" size="2" value="100">%<br><br>
              dist:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
              <input type="text" name="dist" size="5" value="0"><br><br>
		mindelay:&nbsp;
              delay:<br>
		<input type="text" name="mindelay" size="5" value="0">
		<input type="text" name="delay" size="5" value="0"><br><br>
              max_x:&nbsp;&nbsp;
		min_x:<br>
              <input type="text" name="max_x" size="5" value="0">
		<input type="text" name="min_x" size="5" value="0"><br><br>
              max_y:&nbsp;&nbsp; 
		min_y:<br>
              <input type="text" name="max_y" size="5" value="0">
		<input type="text" name="min_y" size="5" value="0"><br><br>
		despawn:<br>
		<select name="despawn" style="width: 160px;">
		<?foreach($despawntype as $key=>$value):?>
              <option value="<?=$key?>"<?echo ($key == $despawn)? " selected" : "";?>><?=$key?>: <?=$value?></option>
		<?endforeach;?></select><br><br>
		despawn timer:<br>
		<input type="text" name="despawn_timer" size="5" value="0"><br><br>
              <input type="submit" value="Submit">
            </center>
          </form>
        </div>
      </div>
