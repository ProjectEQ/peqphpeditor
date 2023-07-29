  <div class="table_container" style="width: 500px;">
    <div class="table_header">
      <table style="width:100%; padding:0px; border-spacing:0px;">
        <tr>
          <td align="right">
            <a href="index.php?editor=chat&action=6"><img src="images/user.gif" title="Reserved Names"></a>&nbsp;
            <a href="index.php?editor=chat&action=1"><img src="images/add.gif" title="Add Chat Channel"></a>
          </td>
        </tr>
      </table>
    </div>
    <table class="table_content2" style="width:100%;">
<?if (isset($chats)):?>
      <tr>
        <td align="center" width="35%"><strong>Name</strong></td>
        <td align="center" width="35%"><strong>Owner</strong></td>
        <td align="center" width="20%"><strong>Min Status</strong></td>
        <td width="10%">&nbsp;</td>
      </tr>
<?$x=0;
foreach($chats as $chat):?>
      <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
        <td align="center" width="35%"><?=$chat['name']?></td>
        <td align="center" width="35%"><?=$chat['owner']?></td>
        <td align="center" width="20%"><?=$chat['minstatus']?></td>
        <td align="right" width="10%">
          <a href="index.php?editor=chat&name=<?=$chat['name']?>&action=3"><img src="images/edit2.gif" width="13" height="13" border="0" title="Edit Chat Channel"></a>&nbsp;
          <a href="index.php?editor=chat&name=<?=$chat['name']?>&action=5" onClick="return confirm('Really delete chat channel?');"><img src="images/remove.gif" width="13" height="13" border="0" title="Delete Chat Channel"></a>
        </td>
      </tr>
<?$x++;
endforeach;
else:?>
      <tr>
        <td align="left" width="100%" style="padding: 10px;">No Chat Channels</td>
      </tr>
<?endif;?>
    </table>
  </div>
