  <div class="table_container" style="width: 500px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td>View Message</td>
          <td>
            <div style="float:right">
              <a href="index.php?editor=mail&msg_id=<?=$message['msgid']?>&action=2"><img src="images/edit2.gif" border="0" title="Edit this message"></a>
              <a onClick="return confirm('Really delete message <?=$message['msgid']?>?');" href="index.php?editor=mail&msg_id=<?=$message['msgid']?>&action=4"><img src="images/remove2.gif" border="0" title="Delete this message"></a>
            </div>
          </td>
        </tr>
      </table>
    </div>
    <table class="table_content" width="100%" cellpadding="5" cellspacing="0">
      <tr>
        <td><strong>Message ID:</strong> <?=$message['msgid']?></td>
        <td><strong>Sent:</strong> <?=get_real_time($message['timestamp'])?></td>
        <td><strong>Status:</strong> <?=$msg_status[$message['status']]?></td>
      </tr>
      <tr>
        <td><strong>From:</strong> <?=$message['from']?></td>
        <td><strong>To:</strong> <?echo (getPlayerName($message['charid']) == "") ? "<font color='red'>Missing</font>" : getPlayerName($message['charid']);?></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="3"><strong>Subject:</strong> <?=$message['subject']?></td>
      </tr>
      <tr>
        <td colspan="3"><strong>Body:</strong><br><?=$message['body']?></td>
      </tr>
    </table>
  </div>
