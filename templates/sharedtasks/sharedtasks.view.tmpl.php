  <div class="table_container" style="width: 450px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
<?if ($_GET['action'] == 1):?>
          <td align="left">Active Tasks [<a href="index.php?editor=sharedtasks&action=3">View Completed Tasks</a>]</td>
<?else:?>
          <td align="left">Completed Tasks [<a href="index.php?editor=sharedtasks&action=1">View Active Tasks</a>]</td>
<?endif;?>
          <td align="right">&nbsp;</td>
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
        <td align="center"><?=getTaskTitle($sharedtask['task_id'])?> (<?=$sharedtask['task_id']?>)</td>
        <td align="center"><?=$yesno[$sharedtask['is_locked']]?></td>
        <td align="right"><a href="index.php?editor=sharedtasks&id=<?=$sharedtask['id']?>&action=<?echo ($_GET['action'] == 1) ? "2" : "4";?>"><img src="images/view_all.gif" width="13" height="13" border="0" title="View Shared Task" alt="View"></a></td>
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
