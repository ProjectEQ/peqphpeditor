  <div class="edit_form" id="filter_box" style="width: 350px; display: <?echo (isset($filter) && $filter['status'] == 'on') ? 'block' : 'none'?>">
    <div class="edit_form_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td align="left">Filters</td>
          <td align="right"><a onClick="document.getElementById('filter_box').style.display='none';document.getElementById('filter_image').style.display='inline';"><img src="images/downgrade.gif" title="Hide filter" border="0"></a></td>
        </tr>
      </table>
    </div>
    <div class="edit_form_content">
      <form name="filter" id="filter" method="get" action="index.php">
        <input type="hidden" name="editor" value="tasks">
        <input type="hidden" name="action" value="36">
<?echo ((isset($sort) && $sort != '') ? '<input type="hidden" name="sort" value="' . $sort . '">' : '')?>
        <input type="hidden" name="filter" id="filter_status" value="on">
        <table class="table_content" width="100%">
          <tr>
            <td width="50%">
              <strong>Task:</strong><br>
              <input type="text" name="filter1" id="filter1" value="<?echo (isset($filter)) ? $filter['filter1'] : "";?>">
            </td>
            <td width="50%">
              <strong>Character:</strong><br>
              <input type="text" name="filter2" id="filter2" value="<?echo (isset($filter)) ? $filter['filter2'] : "";?>">
            </td>
          </tr>
          <tr>
            <td colspan="2" align="center"><br><input type="submit" value="Apply Filters">&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="Remove Filters" onClick="document.getElementById('filter1').value='';document.getElementById('filter2').value='';document.getElementById('filter_status').value='';"></td>
          </tr>
        </table>
      </form>
    </div>
  </div><br>
  <div class="table_container" style="width: 700px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td align="left" width="33%">Completed Tasks [<a href="index.php?editor=tasks&action=35">View Active Tasks</a>]</td>
          <td align="center" width="33%">
            <?echo ($page > 1) ? "<a href='index.php?editor=tasks&action=36&page=1" . (($sort != "") ? "&sort=" . $sort : "") . (($filter['status'] == "on") ? $filter['url'] : "") . "'><img src='images/first.gif' border='0' width='12' height='12' title='First'></a>" : "<img src='images/first.gif' border='0' width='12' height='12'>";?>
            <?echo ($page > 1) ? "<a href='index.php?editor=tasks&action=36&page=" . ($page - 1) . (($sort != "") ? "&sort=" . $sort : "") . (($filter['status'] == "on") ? $filter['url'] : "") . "'><img src='images/prev.gif' border='0' width='12' height='12' title='Previous'></a>" : "<img src='images/prev.gif' border='0' width='12' height='12'>";?>
            <?echo $page . " of " . $pages;?>
            <?echo ($page < $pages) ? "<a href='index.php?editor=tasks&action=36&page=" . ($page + 1) . (($sort != "") ? "&sort=" . $sort : "") . (($filter['status'] == "on") ? $filter['url'] : "") . "'><img src='images/next.gif' border='0' width='12' height='12' title='Next'></a>" : "<img src='images/next.gif' border='0' width='12' height='12'>";?>
            <?echo ($page < $pages) ? "<a href='index.php?editor=tasks&action=36&page=" . $pages . (($sort != "") ? "&sort=" . $sort : "") . (($filter['status'] == "on") ? $filter['url'] : "") . "'><img src='images/last.gif' border='0' width='12' height='12' title='Last'></a>" : "<img src='images/last.gif' border='0' width='12' height='12'>";?>
          </td>
          <td align="right" width="33%"><a onClick="document.getElementById('filter_box').style.display='block';document.getElementById('filter_image').style.display='none';"><img id="filter_image" src="images/filter.jpg" border="0" height="13" width="13" title="Show filter" alt="Show filter"<?echo (isset($filter) && $filter['status'] == 'on') ? ' style="display:none;"' : '';?>></a></td>
        </tr>
      </table>
    </div>
    <table class="table_content2" width="100%">
<?if (isset($completed_tasks)):?>
      <tr>
        <td align="center"><strong><?echo ($sort == 1) ? "Character <img src='images/sort_red.bmp' border='0' width='8' height='8'>" : "<a href='index.php?editor=tasks&action=36&sort=1" . ((isset($filter) && $filter['status'] == "on") ? $filter['url'] : "") . "'>Character <img src='images/sort_green.bmp' border='0' width='8' height='8' title='Sort by Character'></a>";?></strong></td>
        <td align="center"><strong><?echo ($sort == 2) ? "Task <img src='images/sort_red.bmp' border='0' width='8' height='8'>" : "<a href='index.php?editor=tasks&action=36&sort=2" . ((isset($filter) && $filter['status'] == "on") ? $filter['url'] : "") . "'>Task <img src='images/sort_green.bmp' border='0' width='8' height='8' title='Sort by Task'></a>";?></strong></td>
        <td align="center"><strong>Activity ID</strong></td>
        <td align="center"><strong>Completed Time</strong></td>
        <td width="5%">&nbsp;</td>
      </tr>
<?$x=0;
foreach($completed_tasks as $task):?>
      <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
        <td align="center"><?echo "<a href='index.php?editor=player&playerid=" . $task['charid'] . "'>" . getPlayerName($task['charid'])?></a> (<?=$task['charid']?>)</td>
        <td align="center"><?echo "<a href='index.php?editor=tasks&tskid=" . $task['taskid'] . "'>" . getTaskTitle($task['taskid'])?></a> (<?=$task['taskid']?>)</td>
        <td align="center"><?=$task['activityid']?></td>
        <td align="center"><?=get_real_time($task['completedtime'])?></td>
        <td align="right"><a onClick="return confirm('Really delete task (<?=$task['taskid']?>) from <?=getPlayerName($task['charid'])?>?');" href="index.php?editor=tasks&tskid=<?=$task['taskid']?>&charid=<?=$task['charid']?>&action=38"><img src="images/remove3.gif" border="0" title="Delete Completed Task"></a></td>
      </tr>
<?$x++;
endforeach;
else:?>
      <tr>
        <td align="left" width="100" style="padding: 10px;">No Completed Tasks</td>
      </tr>
<?endif;?>
    </table>
  </div>
