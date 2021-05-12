  <div class="edit_form" id="filter_box" style="width: 750px; display: <?echo (isset($filter) && $filter['status'] == 'on') ? 'block' : 'none'?>">
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
        <input type="hidden" name="editor" value="expeditions">
        <input type="hidden" name="action" value="25">
<?echo ((isset($sort) && $sort != '') ? '<input type="hidden" name="sort" value="' . $sort . '">' : '')?>
        <input type="hidden" name="filter" id="filter_status" value="on">
        <table class="table_content" width="100%">
          <tr>
            <td>
              Character:<br>
              <input type="text" name="filter1" id="filter1" value="<?echo (isset($filter)) ? $filter['filter1'] : "";?>">
            </td>
            <td>
              Expedition:<br>
              <input type="text" name="filter2" id="filter2" value="<?echo (isset($filter)) ? $filter['filter2'] : "";?>">
            </td>
            <td>
              Event:<br>
              <input type="text" name="filter3" id="filter3" value="<?echo (isset($filter)) ? $filter['filter3'] : "";?>">
            </td>
          </tr>
          <tr>
            <td colspan="3" align="center"><br><input type="submit" value="Apply Filters">&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="Remove Filters" onClick="document.getElementById('filter1').value='';document.getElementById('filter2').value='';document.getElementById('filter3').value='';document.getElementById('filter_status').value='';"></td>
          </tr>
        </table>
      </form>
    </div>
  </div><br>
  <div class="table_container" style="width: 750px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td align="left" width="33%">Character Lockouts</td>
          <td align="center" width="33%">
            <?echo ($page > 1) ? "<a href='index.php?editor=expeditions&action=25&page=1" . (($sort != "") ? "&sort=" . $sort : "") . (($filter['status'] == "on") ? $filter['url'] : "") . "'><img src='images/first.gif' border='0' width='12' height='12' title='First' alt='First'></a>" : "<img src='images/first.gif' border='0' width='12' height='12' alt='First'>";?>
            <?echo ($page > 1) ? "<a href='index.php?editor=expeditions&action=25&page=" . ($page - 1) . (($sort != "") ? "&sort=" . $sort : "") . (($filter['status'] == "on") ? $filter['url'] : "") . "'><img src='images/prev.gif' border='0' width='12' height='12' title='Previous' alt='Previous'></a>" : "<img src='images/prev.gif' border='0' width='12' height='12' alt='Previous'>";?>
            <?echo $page . " of " . $pages;?>
            <?echo ($page < $pages) ? "<a href='index.php?editor=expeditions&action=25&page=" . ($page + 1) . (($sort != "") ? "&sort=" . $sort : "") . (($filter['status'] == "on") ? $filter['url'] : "") . "'><img src='images/next.gif' border='0' width='12' height='12' title='Next' alt='Next'></a>" : "<img src='images/next.gif' border='0' width='12' height='12' alt='Next'>";?>
            <?echo ($page < $pages) ? "<a href='index.php?editor=expeditions&action=25&page=" . $pages . (($sort != "") ? "&sort=" . $sort : "") . (($filter['status'] == "on") ? $filter['url'] : "") . "'><img src='images/last.gif' border='0' width='12' height='12' title='Last' alt='Last'></a>" : "<img src='images/last.gif' border='0' width='12' height='12' alt='Last'>";?>
          </td>
          <td align="right" width="34%">
            <a onClick="document.getElementById('filter_box').style.display='block';document.getElementById('filter_image').style.display='none';"><img id="filter_image" src="images/filter.jpg" border="0" height="13" width="13" title="Show filter" alt="Show filter"<?echo (isset($filter) && $filter['status'] == 'on') ? ' style="display:none;"' : '';?>></a>&nbsp;
            <a href="index.php?editor=expeditions&action=26"><img src="images/add.gif" border="0" title="Create New Character Lockout" alt="Create New Character Lockout"></a>
          </td>
        </tr>
      </table>
    </div>
    <table class="table_content2" width="100%">
<?if (isset($character_lockouts)):?>
      <tr>
        <td align="center"><strong><?echo ($sort == 1) ? "ID <img src='images/sort_red.bmp' border='0' width='8' height='8' alt='Sort'>" : "<a href='index.php?editor=expeditions&action=25&sort=1" . (($filter['status'] == "on") ? $filter['url'] : "") . "'>ID <img src='images/sort_green.bmp' border='0' width='8' height='8' title='Sort by ID' alt='Sort'></a>";?></strong></td>
        <td align="center"><strong><?echo ($sort == 2) ? "Character <img src='images/sort_red.bmp' border='0' width='8' height='8' alt='Sort'>" : "<a href='index.php?editor=expeditions&action=25&sort=2" . (($filter['status'] == "on") ? $filter['url'] : "") . "'>Character <img src='images/sort_green.bmp' border='0' width='8' height='8' title='Sort by Character ID' alt='Sort'></a>";?></strong></td>
        <td align="center"><strong><?echo ($sort == 3) ? "Expedition <img src='images/sort_red.bmp' border='0' width='8' height='8' alt='Sort'>" : "<a href='index.php?editor=expeditions&action=25&sort=3" . (($filter['status'] == "on") ? $filter['url'] : "") . "'>Expedition <img src='images/sort_green.bmp' border='0' width='8' height='8' title='Sort by Expedition Name' alt='Sort'></a>";?></strong></td>
        <td align="center"><strong><?echo ($sort == 4) ? "Event <img src='images/sort_red.bmp' border='0' width='8' height='8' alt='Sort'>" : "<a href='index.php?editor=expeditions&action=25&sort=4" . (($filter['status'] == "on") ? $filter['url'] : "") . "'>Event <img src='images/sort_green.bmp' border='0' width='8' height='8' title='Sort by Event Name' alt='Sort'></a>";?></strong></td>
        <td align="center"><strong><?echo ($sort == 5) ? "Expires <img src='images/sort_red.bmp' border='0' width='8' height='8' alt='Sort'>" : "<a href='index.php?editor=expeditions&action=25&sort=5" . (($filter['status'] == "on") ? $filter['url'] : "") . "'>Expires <img src='images/sort_green.bmp' border='0' width='8' height='8' title='Sort by Expire Time' alt='Sort'></a>";?></strong></td>
        <td align="right">&nbsp;</td>
      </tr>
<?$x=0;
foreach($character_lockouts as $character_lockout):?>
      <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
        <td align="center"><?=$character_lockout['id']?></td>
        <td align="center"><?=getPlayerName($character_lockout['character_id'])?> (<?=$character_lockout['character_id']?>)</td>
        <td align="center"><?=$character_lockout['expedition_name']?></td>
        <td align="center"><?=$character_lockout['event_name']?></td>
        <td align="center"><?=$character_lockout['expire_time']?></td>
        <td align="right"><a href="index.php?editor=expeditions&id=<?=$character_lockout['id']?>&action=28"><img src="images/edit2.gif" width="13" height="13" border="0" title="Edit Character Lockout" alt="Edit"></a>&nbsp;<a onClick="return confirm('Really delete character lockout?');" href="index.php?editor=expeditions&id=<?=$character_lockout['id']?>&action=30"><img src="images/remove3.gif" border="0" title="Delete Character Lockout" alt="Delete"></a></td>
      </tr>
<?$x++;
endforeach;
else:?>
      <tr>
        <td align="left" width="100" style="padding: 10px;">No Character Lockouts</td>
      </tr>
<?endif;?>
    </table>
  </div>
