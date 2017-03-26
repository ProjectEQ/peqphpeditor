  <div class="edit_form" style="width: 250px">
    <div class="edit_form_header">
      Respawn Time: <?=$id?>
    </div>
    <div class="edit_form_content">
      <form name="respawntimes" method="post" action="index.php?editor=spawn&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&sid=<?=$sid?>&spid=<?=$spid?>&action=48">
        <table width="100%">
          <tr>
            <th>Start:</th>
            <th>Duration:</th>
          </tr>
          <tr>
            <td><input type="text" size="10" name="start" value="<?=$start?>"></td>
            <td><input type="text" size="10" name="duration" value="<?=$duration?>"></td>
          </tr>
        </table><br><br>
        <center>
          <input type="hidden" name="rid" value="<?=$id?>">
          <input type="submit" name="submit" value="Submit Changes">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back();">
        </center>
      </form>
    </div>
  </div>
