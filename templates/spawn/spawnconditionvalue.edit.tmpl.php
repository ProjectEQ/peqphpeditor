  <div class="edit_form" style="width: 250px">
    <div class="edit_form_header">Edit Spawn Condition: <?=$scvid?></div>
    <div class="edit_form_content">
      <form name="spawncondition" method="post" action="index.php?editor=spawn&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&spid=<?=$spid?>&action=83">
        <table width="100%">
          <tr>
            <td><strong>Value:</strong></td>
            <td><strong>Instance:</strong></td>
          </tr>
          <tr>
            <td><input type="text" size="7" name="value" value="<?=$value?>"></td>
            <td><input type="text" size="7" name="instance_id" value="<?=$instance_id?>"></td>
          </tr>
        </table><br><br>
        <center>
          <input type="hidden" name="scvid" value="<?=$scvid?>">
          <input type="hidden" name="zone" value="<?=$zone?>">
          <input type="hidden" name="old_instance_id" value="<?=$instance_id?>">
          <input type="hidden" name="old_value" value="<?=$value?>">
          <input type="submit" value="Submit Changes">&nbsp;
          <input type="button" value="Cancel" onClick="history.back()">
        </center>
      </form>
    </div>
  </div>
