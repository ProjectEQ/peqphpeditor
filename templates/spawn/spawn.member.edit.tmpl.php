    <div class="edit_form" style="width: 350px">
      <div class="edit_form_header">
        Edit Spawngroup Member
      </div>
      <div class="edit_form_content">
        <strong>Spawngroup:</strong> <?=$spawngroupID?><br>
        <strong>NPC:</strong> <?=$npcname?> (<?=$npcid?>)<br><br>
        <form method="post" action="index.php?editor=spawn&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=2">
          <table width="100%" cellpadding="3" cellspacing="3">
            <tr>
              <td>
                <strong>Chance:</strong><br>
                <input type="text" size="5" name="chance" value="<?=$chance?>">%
              </td>
              <td>
                <strong>Condtion Value Filter:</strong><br>
                <input type="text" size="5" name="condition_value_filter" value="<?=$condition_value_filter?>">
              </td>
            </tr>
            <tr>
              <td>
                <strong>Min Time:</strong><br>
                <input type="text" size="5" name="min_time" value="<?=$min_time?>">
              </td>
              <td>
                <strong>Max Time:</strong><br>
                <input type="text" size="5" name="max_time" value="<?=$max_time?>">
              </td>
            </tr>
            <tr>
              <td>
                <strong>Min Expansion:</strong><br>
                <input type="text" name="min_expansion" value="<?=$min_expansion?>">
              </td>
              <td>
                <strong>Max Expansion:</strong><br>
                <input type="text" name="max_expansion" value="<?=$max_expansion?>">
              </td>
            </tr>
            <tr>
              <td>
                <strong>Content Flags:</strong><br>
                <input type="text" name="content_flags" value="<?=$content_flags?>">
              </td>
              <td>
                <strong>Content Flags Disabled:</strong><br>
                <input type="text" name="content_flags_disabled" value="<?=$content_flags_disabled?>">
              </td>
            </tr>
          </table><br>
          <center>
            <input type="hidden" name="sgnpcid" value="<?=$sgnpcid?>">
            <input type="hidden" name="spawngroupID" value="<?=$spawngroupID?>">
            <input type="submit" name="submit" value="Submit Changes">&nbsp;
            <input type="button" value="Cancel" onClick="history.back();">
          </center>
        </form>
      </div>
    </div>
