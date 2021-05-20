    <div class="edit_form" id="filter_box" style="width: 700px; display: <?echo (isset($filter) && $filter['status'] == 'on') ? 'block' : 'none'?>">
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
          <input type="hidden" name="editor" value="qglobal">
<?echo ((isset($sort) && $sort != '') ? '<input type="hidden" name="sort" value="' . $sort . '">' : '')?>
          <input type="hidden" name="filter" id="filter_status" value="on">
          <table class="table_content" width="100%">
            <tr>
              <td width="25%">
                Name:<br>
                <input type="text" name="filter1" id="filter1" value="<?echo (isset($filter)) ? $filter['filter1'] : "";?>">
              </td>
              <td width="25%">
                Character:<br>
                <input type="text" name="filter2" id="filter2" value="<?echo (isset($filter)) ? $filter['filter2'] : "";?>">
              </td>
              <td width="25%">
                NPC:<br>
                <input type="text" name="filter3" id="filter3" value="<?echo (isset($filter)) ? $filter['filter3'] : "";?>">
              </td>
              <td width="25%">
                Zone:<br>
                <input type="text" name="filter4" id="filter4" value="<?echo (isset($filter)) ? $filter['filter4'] : "";?>">
              </td>
            </tr>
            <tr>
              <td colspan="4" align="center"><br><input type="submit" value="Apply Filters">&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="Remove Filters" onClick="document.getElementById('filter1').value='';document.getElementById('filter2').value='';document.getElementById('filter3').value='';document.getElementById('filter4').value='';document.getElementById('filter_status').value='';"></td>
            </tr>
          </table>
        </form>
      </div>
    </div><br>
    <div class="table_container" style="width: 700px;">
      <div class="table_header">
        <table width="100%" cellpadding="0" cellspacing="0">
          <tr>
            <td align="left" width="33%">Quest Globals</td>
            <td align="center" width="33%">
              <?echo ($page > 1) ? "<a href='index.php?editor=qglobal&page=1" . (($sort != "") ? "&sort=" . $sort : "") . (($filter['status'] == "on") ? $filter['url'] : "") . "'><img src='images/first.gif' border='0' width='12' height='12' title='First' alt='First'></a>" : "<img src='images/first.gif' border='0' width='12' height='12' alt='First'>";?>
              <?echo ($page > 1) ? "<a href='index.php?editor=qglobal&page=" . ($page - 1) . (($sort != "") ? "&sort=" . $sort : "") . (($filter['status'] == "on") ? $filter['url'] : "") . "'><img src='images/prev.gif' border='0' width='12' height='12' title='Previous' alt='Previous'></a>" : "<img src='images/prev.gif' border='0' width='12' height='12' alt='Previous'>";?>
              <?echo $page . " of " . $pages;?>
              <?echo ($page < $pages) ? "<a href='index.php?editor=qglobal&page=" . ($page + 1) . (($sort != "") ? "&sort=" . $sort : "") . (($filter['status'] == "on") ? $filter['url'] : "") . "'><img src='images/next.gif' border='0' width='12' height='12' title='Next' alt='Next'></a>" : "<img src='images/next.gif' border='0' width='12' height='12' alt='Next'>";?>
              <?echo ($page < $pages) ? "<a href='index.php?editor=qglobal&page=" . $pages . (($sort != "") ? "&sort=" . $sort : "") . (($filter['status'] == "on") ? $filter['url'] : "") . "'><img src='images/last.gif' border='0' width='12' height='12' title='Last' alt='Last'></a>" : "<img src='images/last.gif' border='0' width='12' height='12' alt='Last'>";?>
            </td>
            <td align="right" width="33%">
              <a onClick="document.getElementById('filter_box').style.display='block';document.getElementById('filter_image').style.display='none';"><img id="filter_image" src="images/filter.jpg" border="0" height="13" width="13" title="Show filter" alt="Show filter"<?echo (isset($filter) && $filter['status'] == 'on') ? ' style="display:none;"' : '';?>></a>&nbsp;
              <a href="index.php?editor=qglobal&action=2"><img src="images/add.gif" border="0" title="Create New Quest Global" alt="Create New Quest Global"></a>
            </td>
          </tr>
        </table>
      </div>
      <table class="table_content2" width="100%">
<?if (isset($qglobals)):?>
        <tr>
          <td align="center"><strong><?echo ($sort == 1) ? "Name <img src='images/sort_red.bmp' border='0' width='8' height='8' alt='Sort'>" : "<a href='index.php?editor=qglobal&sort=1" . ((isset($filter) && $filter['status'] == "on") ? $filter['url'] : "") . "'>Name <img src='images/sort_green.bmp' border='0' width='8' height='8' title='Sort by Name' alt='Sort'></a>";?></strong></td>
          <td align="center"><strong>Value</strong></td>
          <td align="center"><strong><?echo ($sort == 2) ? "Character <img src='images/sort_red.bmp' border='0' width='8' height='8' alt='Sort'>" : "<a href='index.php?editor=qglobal&sort=2" . ((isset($filter) && $filter['status'] == "on") ? $filter['url'] : "") . "'>Character <img src='images/sort_green.bmp' border='0' width='8' height='8' title='Sort by Character' alt='Sort'></a>";?></strong></td>
          <td align="center"><strong><?echo ($sort == 3) ? "NPC <img src='images/sort_red.bmp' border='0' width='8' height='8' alt='Sort'>" : "<a href='index.php?editor=qglobal&sort=3" . ((isset($filter) && $filter['status'] == "on") ? $filter['url'] : "") . "'>NPC <img src='images/sort_green.bmp' border='0' width='8' height='8' title='Sort by NPC' alt='Sort'></a>";?></strong></td>
          <td align="center"><strong><?echo ($sort == 4) ? "Zone <img src='images/sort_red.bmp' border='0' width='8' height='8' alt='Sort'>" : "<a href='index.php?editor=qglobal&sort=4" . ((isset($filter) && $filter['status'] == "on") ? $filter['url'] : "") . "'>Zone <img src='images/sort_green.bmp' border='0' width='8' height='8' title='Sort by Zone' alt='Sort'></a>";?></strong></td>
          <td align="center"><strong>Expires</strong></td>
          <td width="5%">&nbsp;</td>
        </tr>
<?$x=0;
foreach($qglobals as $qglobal):?>
        <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
          <td align="center"><?=$qglobal['name']?></td>
          <td align="center"><?=$qglobal['value']?></td>
          <td align="center"><?echo ($qglobal['charid'] > 0) ? '<a href="index.php?editor=player&playerid=' . $qglobal['charid'] . '">' . getPlayerName($qglobal['charid']) . '</a>' : "ANY";?></td>
          <td align="center"><?echo ($qglobal['npcid'] > 0) ? '<a href="index.php?editor=npc&npcid=' . $qglobal['npcid'] . '">' . getNPCName($qglobal['npcid']) . '</a>' : "ANY";?></td>
          <td align="center"><?echo ($qglobal['zoneid'] > 0) ? getZoneName($qglobal['zoneid']) : "ANY";?></td>
          <td align="center"><?echo ($qglobal['expdate'] != '') ? get_real_time($qglobal['expdate']) : "NEVER";?></td>
          <td align="right"><a href="index.php?editor=qglobal&name=<?=$qglobal['name']?>&charid=<?=$qglobal['charid']?>&npcid=<?=$qglobal['npcid']?>&zoneid=<?=$qglobal['zoneid']?>&action=4"><img src="images/edit2.gif" width="13" height="13" border="0" title="Edit Quest Global" alt="Edit"></a>&nbsp;<a onClick="return confirm('Really delete quest global?');" href="index.php?editor=qglobal&name=<?=$qglobal['name']?>&charid=<?=$qglobal['charid']?>&npcid=<?=$qglobal['npcid']?>&zoneid=<?=$qglobal['zoneid']?>&action=6"><img src="images/remove3.gif" border="0" title="Delete Quest Global" alt="Delete"></a></td>
        </tr>
<?$x++;
endforeach;
else:?>
        <tr>
          <td align="left" width="100" style="padding: 10px;">No Quest Globals</td>
        </tr>
<?endif;?>
      </table>
    </div>
