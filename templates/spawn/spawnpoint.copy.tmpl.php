  <form name="spawnpoint" method="post" action="index.php?editor=spawn&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=51">
    <div class="edit_form" style="width: 250px;">
      <div class="edit_form_header">Copy Spawnpoint</div>
      <div class="edit_form_content">
        <strong>Spawnpoint ID:</strong> <input type="text" size="7" value="<?=$id?>" disabled><br><br>
        <strong>From Spawngroup ID:</strong> <input type="text" size="7" value="<?=$spawngroupID?>" disabled><br><br>
        <strong>To Spawngroup ID:<strong> <input type="text" name="sgid" size="7" value=""><br><br>
        <center>   
          <input type="hidden" name="id" value="<?=$id?>">
          <input type="submit" value="Copy Spawnpoint">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back();">
        </center>
      </div>
    </div>
  </form>
