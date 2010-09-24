  <form name="spawnpoint" method="post" action="index.php?editor=spawn&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=53">
    <div class="edit_form" style="width: 200px;">
      <div class="edit_form_header">
        Move Spawnpoint ID: <?=$id?>
      </div>
      <div class="edit_form_content">
	    <center>	          
          <td align="left" width="17%">Spawngroup ID:<input type="text" name="sgid" size="7" value=""></td><br><br>
          <input type="submit" value="Move Spawn">
          <input type="hidden" name="id" value="<?=$id?>">
        </center>
      </div>
      </div>
  </form>
