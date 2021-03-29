  <div class="table_container" style="width: 750px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td align="left">Scheduled Events</td>
          <td align="right">
            <a href="index.php?editor=server&action=65"><img src="images/add.gif" border="0" title="Create New Scheduled Event" alt="Create New Scheduled Event"></a>
          </td>
        </tr>
      </table>
    </div>
    <table class="table_content2" width="100%">
<?if (isset($scheduled_events)):?>
      <tr>
        <td align="center"><strong>ID</strong></td>
        <td align="center"><strong>Description</strong></td>
        <td align="right">&nbsp;</td>
      </tr>
<?$x=0;
foreach($scheduled_events as $scheduled_event):?>
      <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
        <td align="center"><?=$scheduled_event['id']?></td>
        <td align="center"><?=$scheduled_event['description']?></td>
        <td align="right"><a href="index.php?editor=server&id=<?=$scheduled_event['id']?>&action=67"><img src="images/edit2.gif" width="13" height="13" border="0" title="Edit Scheduled Event" alt="Edit"></a>&nbsp;<a onClick="return confirm('Really delete scheduled event?');" href="index.php?editor=server&id=<?=$scheduled_event['id']?>&action=69"><img src="images/remove3.gif" border="0" title="Delete Scheduled Event" alt="Delete"></a></td>
      </tr>
<?$x++;
endforeach;
else:?>
      <tr>
        <td align="left" width="100" style="padding: 10px;">No Scheduled Events</td>
      </tr>
<?endif;?>
    </table>
  </div>
