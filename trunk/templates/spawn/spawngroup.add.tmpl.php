      <div class="table_container" style="width:200px;">
        <div class="edit_form_header">
 	 <center>
          Add a Spawngroup to <?=$currzone?>
        </div>
        <div class="edit_form_content">
          <form method="post" action="index.php?editor=spawn&z=<?=$currzone?>&action=17">
 	 <center>
           <strong>Suggested ID:&nbsp;&nbsp;&nbsp;spawn_limit:</strong> <br>
            <input  type="text" name="id" size="6"  value="<?=$suggestedid?>">
	    <input class="indented" type="text" name="spawn_limit" size="5" value="0"><br><br>

            <strong>Spawngroup Name:</strong><br>
            <input  type="text" name="name" size="15"  value="<?=$currzone?>_<?=$suggestedid?>"><br><br>

            <strong>First NPCID In Spawngroup:</strong><br>
            <input type="text" name="npcID" size="15" value="<?=$npcid?>"><br><br>

            <strong>dist:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;delay:</strong><br>
            <input type="text" name="dist" size="5" value="0">
            &nbsp;&nbsp;&nbsp;<input type="text" name="delay" size="5" value="0"><br><br>

            <strong>max_x:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; min_x:</strong><br>
            <input type="text" name="max_x" size="5" value="0">
            &nbsp;&nbsp;&nbsp;<input type="text" name="min_x" size="5" value="0"><br><br>

            <strong>max_y:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; min_y:</strong><br>
            <input type="text" name="max_y" size="5" value="0">
            &nbsp;&nbsp;&nbsp;<input type="text" name="min_y" size="5" value="0"><br><br>
              <input type="submit" value="Submit">
            </center>
          </form>
        </div>
      </div>
