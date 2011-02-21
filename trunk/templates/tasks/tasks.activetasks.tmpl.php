        <div class="table_container" style="width: 700px;">
          <div class="table_header">
            <table width="100%" cellpadding="0" cellspacing="0">
              <tr>
                <td align="left" width="33%">Active Tasks</td>
                <td align="center" width="33%">
                  <?echo ($page > 1) ? "<a href='index.php?editor=tasks&action=35&page=1" . (($sort != "") ? "&sort=" . $sort : "") . "'><img src='images/first.gif' border='0' width='12' height='12' title='First'/></a>" : "<img src='images/first.gif' border='0' width='12' height='12'/>";?>
                  <?echo ($page > 1) ? "<a href='index.php?editor=tasks&action=35&page=" . ($page - 1) . (($sort != "") ? "&sort=" . $sort : "") . "'><img src='images/prev.gif' border='0' width='12' height='12' title='Previous'/></a>" : "<img src='images/prev.gif' border='0' width='12' height='12'/>";?>
                  <?echo $page . " of " . $pages;?>
                  <?echo ($page < $pages) ? "<a href='index.php?editor=tasks&action=35&page=" . ($page + 1) . (($sort != "") ? "&sort=" . $sort : "") . "'><img src='images/next.gif' border='0' width='12' height='12' title='Next'/></a>" : "<img src='images/next.gif' border='0' width='12' height='12'/>";?>
                  <?echo ($page < $pages) ? "<a href='index.php?editor=tasks&action=35&page=" . $pages . (($sort != "") ? "&sort=" . $sort : "") . "'><img src='images/last.gif' border='0' width='12' height='12' title='Last'/></a>" : "<img src='images/last.gif' border='0' width='12' height='12'/>";?>
                </td>
                <td align="right" width="33%"><a href="index.php?editor=tasks&action=36">View Completed Tasks</a></td>
              </tr>
            </table>
          </div>
          <table class="table_content2" width="100%">
<?if (isset($active_tasks)):?>
            <tr>
              <td align="center"><strong><?echo ($sort == 1) ? "Character <img src='images/sort_red.bmp' border='0' width='8' height='8'/>" : "<a href='index.php?editor=tasks&action=35&sort=1'>Character <img src='images/sort_green.bmp' border='0' width='8' height='8' title='Sort by Character'/></a>";?></strong></td>
              <td align="center"><strong><?echo ($sort == 2) ? "Task <img src='images/sort_red.bmp' border='0' width='8' height='8'/>" : "<a href='index.php?editor=tasks&action=35&sort=2'>Task <img src='images/sort_green.bmp' border='0' width='8' height='8' title='Sort by Task'/></a>";?></strong></td>
              <td align="center"><strong>Slot</strong></td>
              <td align="center"><strong>Accepted Time</strong></td>
              <td width="5%">&nbsp;</td>
            </tr>
<?$x=0;
foreach($active_tasks as $task):?>
            <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
              <td align="center"><?echo "<a href='index.php?editor=player&playerid=" . $task['charid'] . "'>" . getPlayerName($task['charid'])?></a> (<?=$task['charid']?>)</td>
              <td align="center"><?echo "<a href='index.php?editor=tasks&tskid=" . $task['taskid'] . "'>" . getTaskTitle($task['taskid'])?></a> (<?=$task['taskid']?>)</td>
              <td align="center"><?=$task['slot']?></td>
              <td align="center"><?=get_real_time($task['acceptedtime'])?></td>
              <td align="right"><a onClick="return confirm('Really delete task (<?=$task['taskid']?>) from <?=getPlayerName($task['charid'])?>?');" href="index.php?editor=tasks&tskid=<?=$task['taskid']?>&charid=<?=$task['charid']?>&action=37"><img src="images/remove3.gif" border="0" title="Delete Active Task"></a></td>
            </tr>
<?$x++;
endforeach;
else:?>
            <tr>
              <td align="left" width="100" style="padding: 10px;">No Active Tasks</td>
            </tr>
<?endif;?>
          </table>
        </div>
