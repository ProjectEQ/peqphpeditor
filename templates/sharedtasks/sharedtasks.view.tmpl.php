  <div class="table_container" style="width: 350px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td align="left">Shared Tasks</td>
          <td align="right">
            &nbsp;
          </td>
        </tr>
      </table>
    </div>
    <table class="table_content2" width="100%">
<?if (isset($sharedtasks)):?>
      <tr>
        <td align="center"><strong>ID</strong></td>
        <td align="center"><strong>Task ID</strong></td>
        <td align="center"><strong>Locked</strong></td>
        <td align="right">&nbsp;</td>
      </tr>
<?$x=0;
foreach($sharedtasks as $sharedtask):?>
      <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
        <td align="center"><?=$sharedtask['id']?></td>
        <td align="center"><?=$sharedtask['task_id']?></td>
        <td align="center"><?=$yesno[$sharedtask['is_locked']]?></td>
        <td align="right"><a href="index.php?editor=sharedtasks&id=<?=$sharedtask['id']?>&action=4"><img src="images/edit2.gif" width="13" height="13" border="0" title="Edit Shared Task" alt="Edit"></a>&nbsp;<a onClick="return confirm('Really delete shared task?');" href="index.php?editor=sharedtasks&id=<?=$sharedtask['id']?>&action=6"><img src="images/remove3.gif" border="0" title="Delete Shared Task" alt="Delete"></a></td>
      </tr>
<?$x++;
endforeach;
else:?>
      <tr>
        <td align="left" width="100" style="padding: 10px;">No Shared Tasks</td>
      </tr>
<?endif;?>
    </table>
  </div>
