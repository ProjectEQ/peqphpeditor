        <div class="table_container" style="width: 700px;">
          <div class="table_header">
            <table width="100%" cellpadding="0" cellspacing="0">
              <tr>
                <td>Mail</td>
                <td>
                  <div style="float:right">
                    <a href="index.php?editor=mail&action=3"><img src="images/add.gif" border="0" title="Create a new message" /></a>
                  </div>
                </td>
              </tr>
            </table>
          </div>
          <table class="table_content2" width="100%">
<?if (isset($mail)):?>
            <tr>
              <td align="center" width="10%"><strong>ID</strong></td>
              <td align="center" width="15%"><strong>From</strong></td>
              <td align="center" width="15%"><strong>To</strong></td>
              <td align="center" width="35%"><strong>Subject</strong></td>
              <td align="center" width="20%"><strong>Timestamp</strong></td>
              <td width="5%">&nbsp;</td>
            </tr>
<?$x=0;
foreach($mail as $message):?>
            <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
              <td align="center" width="10%"><?=$message['msgid']?></td>
              <td align="center" width="15%"><?=$message['from']?></td>
              <td align="center" width="15%"><?=getPlayerName($message['charid'])?></td>
              <td align="center" width="35%"><?=$message['subject']?></td>
              <td align="center" width="20%"><?=get_real_time($message['timestamp'])?></td>
              <td align="right"><a href="index.php?editor=mail&msg_id=<?=$message['msgid']?>&action=1"><img src="images/mail.gif" width="13" height="13" border="0" title="View Message"></a>&nbsp;<a onClick="return confirm('Really delete message <?=$message['msgid']?>?');" href="index.php?editor=mail&msg_id=<?=$message['msgid']?>&action=4"><img src="images/remove3.gif" border="0" title="Delete Message"></a></td>
            </tr>
<?$x++;
endforeach;
else:?>
            <tr>
              <td align="left" width="100" style="padding: 10px;">No mail</td>
            </tr>
<?endif;?>
          </table>
        </div>
