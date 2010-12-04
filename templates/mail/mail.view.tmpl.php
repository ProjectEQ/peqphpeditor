        <div class="table_container" style="width: 700px;">
          <div class="table_header">
            <table width="100%" cellpadding="0" cellspacing="0">
              <tr>
                <td>View Message</td>
                <td>
                  <div style="float:right">
                    <a href="index.php?editor=mail&msg_id=<?=$message['msgid']?>&action=2"><img src="images/edit2.gif" border="0" title="Edit this message" /></a>
                    <a onClick="return confirm('Really delete message <?=$message['msgid']?>?');" href="index.php?editor=mail&msg_id=<?=$message['msgid']?>&action=4"><img src="images/remove2.gif" border="0" title="Delete this message" /></a>
                  </div>
                </td>
              </tr>
            </table>
          </div>
          <table class="table_content2" width="100%">
            <tr>
              <td><strong>Message ID:</strong><br/><?=$message['msgid']?><br/><br/></td>
              <td><strong>Sent:</strong><br/><?=get_real_time($message['timestamp'])?><br/><br/></td>
              <td><strong>Status:</strong><br/><?=$msg_status[$message['status']]?><br/><br/></td>
            </tr>
            <tr>
              <td><strong>From:</strong><br/><?=$message['from']?><br/><br/></td>
              <td><strong>To:</strong><br/><?=getPlayerName($message['charid'])?><br/><br/></td>
              <td>&nbsp;<br/><br/></td>
            </tr>
            <tr>
              <td colspan="3"><strong>Subject:</strong><br/><?=$message['subject']?><br/><br/></td>
            </tr>
            <tr>
              <td colspan="3"><strong>Body:</strong><br/><?=$message['body']?><br/><br/></td>
            </tr>
            <tr>
            </tr>
          </table>
        </div>
