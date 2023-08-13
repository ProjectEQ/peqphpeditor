    <div class="edit_form" id="filter_box" style="width: 800px; display: <?echo (isset($filter) && $filter['status'] == 'on') ? 'block' : 'none'?>">
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
          <input type="hidden" name="editor" value="databuckets">
<?echo ((isset($sort) && $sort != '') ? '<input type="hidden" name="sort" value="' . $sort . '">' : '')?>
          <input type="hidden" name="filter" id="filter_status" value="on">
          <table class="table_content" width="100%">
            <tr>
              <td width="28%">
                <strong>Key:</strong><br>
                <input type="text" size="23" name="filter1" id="filter1" value="<?echo (isset($filter)) ? $filter['filter1'] : "";?>">
              </td>
              <td width="12%">
                <strong>Value:</strong><br>
                <input type="text" size="7"  name="filter2" id="filter2" value="<?echo (isset($filter)) ? $filter['filter2'] : "";?>">
              </td>
              <td width="20%">
                <strong>Character:</strong><br>
                <input type="text" size="15"  name="filter3" id="filter3" value="<?echo (isset($filter)) ? $filter['filter3'] : "";?>">
              </td>
              <td width="20%">
                <strong>NPC:</strong><br>
                <input type="text" size="15"  name="filter4" id="filter4" value="<?echo (isset($filter)) ? $filter['filter4'] : "";?>">
              </td>
              <td width="20%">
                <strong>Bot ID:</strong><br>
                <input type="text" size="15"  name="filter5" id="filter5" value="<?echo (isset($filter)) ? $filter['filter5'] : "";?>">
              </td>
            </tr>
            <tr>
              <td colspan="5" align="center"><br><input type="submit" value="Apply Filters">&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="Remove Filters" onClick="document.getElementById('filter1').value='';document.getElementById('filter2').value='';document.getElementById('filter3').value='';document.getElementById('filter4').value='';document.getElementById('filter5').value='';document.getElementById('filter_status').value='';"></td>
            </tr>
          </table>
        </form>
      </div>
    </div><br>
    <div class="table_container" style="width: 800px;">
      <div class="table_header">
        <table width="100%" cellpadding="0" cellspacing="0">
          <tr>
            <td align="left" width="33%">Data Buckets</td>
            <td align="center" width="33%">
              <?echo ($page > 1) ? "<a href='index.php?editor=databuckets&page=1" . (($sort != "") ? "&sort=" . $sort : "") . (($filter['status'] == "on") ? $filter['url'] : "") . "'><img src='images/first.gif' border='0' width='12' height='12' title='First' alt='First'></a>" : "<img src='images/first.gif' border='0' width='12' height='12' alt='First'>";?>
              <?echo ($page > 1) ? "<a href='index.php?editor=databuckets&page=" . ($page - 1) . (($sort != "") ? "&sort=" . $sort : "") . (($filter['status'] == "on") ? $filter['url'] : "") . "'><img src='images/prev.gif' border='0' width='12' height='12' title='Previous' alt='Previous'></a>" : "<img src='images/prev.gif' border='0' width='12' height='12' alt='Previous'>";?>
              <?echo $page . " of " . $pages;?>
              <?echo ($page < $pages) ? "<a href='index.php?editor=databuckets&page=" . ($page + 1) . (($sort != "") ? "&sort=" . $sort : "") . (($filter['status'] == "on") ? $filter['url'] : "") . "'><img src='images/next.gif' border='0' width='12' height='12' title='Next' alt='Next'></a>" : "<img src='images/next.gif' border='0' width='12' height='12' alt='Next'>";?>
              <?echo ($page < $pages) ? "<a href='index.php?editor=databuckets&page=" . $pages . (($sort != "") ? "&sort=" . $sort : "") . (($filter['status'] == "on") ? $filter['url'] : "") . "'><img src='images/last.gif' border='0' width='12' height='12' title='Last' alt='Last'></a>" : "<img src='images/last.gif' border='0' width='12' height='12' alt='Last'>";?>
            </td>
            <td align="right" width="33%">
              <a onClick="document.getElementById('filter_box').style.display='block';document.getElementById('filter_image').style.display='none';"><img id="filter_image" src="images/filter.jpg" border="0" height="13" width="13" title="Show filter" alt="Show filter"<?echo (isset($filter) && $filter['status'] == 'on') ? ' style="display:none;"' : '';?>></a>&nbsp;
              <a href="index.php?editor=databuckets&action=2"><img src="images/add.gif" border="0" title="Create New Data Bucket" alt="Create New Data Bucket"></a>
            </td>
          </tr>
        </table>
      </div>
      <table class="table_content2" width="100%">
<?if (isset($databuckets)):?>
        <tr>
          <td align="center" width="10%"><strong><?echo ($sort == 1) ? "ID <img src='images/sort_red.bmp' border='0' width='8' height='8' alt='Sort'>" : "<a href='index.php?editor=databuckets&sort=1" . ((isset($filter) && $filter['status'] == "on") ? $filter['url'] : "") . "'>ID <img src='images/sort_green.bmp' border='0' width='8' height='8' title='Sort by ID' alt='Sort'></a>";?></strong></td>
          <td align="center" width="20%"><strong><?echo ($sort == 2) ? "Key <img src='images/sort_red.bmp' border='0' width='8' height='8' alt='Sort'>" : "<a href='index.php?editor=databuckets&sort=2" . ((isset($filter) && $filter['status'] == "on") ? $filter['url'] : "") . "'>Key <img src='images/sort_green.bmp' border='0' width='8' height='8' title='Sort by Key' alt='Sort'></a>";?></strong></td>
          <td align="center" width="10%"><strong><?echo ($sort == 3) ? "Value <img src='images/sort_red.bmp' border='0' width='8' height='8' alt='Sort'>" : "<a href='index.php?editor=databuckets&sort=3" . ((isset($filter) && $filter['status'] == "on") ? $filter['url'] : "") . "'>Value <img src='images/sort_green.bmp' border='0' width='8' height='8' title='Sort by Value' alt='Sort'></a>";?></strong></td>
          <td align="center" width="10%"><strong><?echo ($sort == 4) ? "Expires <img src='images/sort_red.bmp' border='0' width='8' height='8' alt='Sort'>" : "<a href='index.php?editor=databuckets&sort=4" . ((isset($filter) && $filter['status'] == "on") ? $filter['url'] : "") . "'>Expires <img src='images/sort_green.bmp' border='0' width='8' height='8' title='Sort by Expires' alt='Sort'></a>";?></strong></td>
          <td align="center" width="15%"><strong><?echo ($sort == 5) ? "Character <img src='images/sort_red.bmp' border='0' width='8' height='8' alt='Sort'>" : "<a href='index.php?editor=databuckets&sort=5" . ((isset($filter) && $filter['status'] == "on") ? $filter['url'] : "") . "'>Character <img src='images/sort_green.bmp' border='0' width='8' height='8' title='Sort by Character' alt='Sort'></a>";?></strong></td>
          <td align="center" width="15%"><strong><?echo ($sort == 6) ? "NPC <img src='images/sort_red.bmp' border='0' width='8' height='8' alt='Sort'>" : "<a href='index.php?editor=databuckets&sort=6" . ((isset($filter) && $filter['status'] == "on") ? $filter['url'] : "") . "'>NPC <img src='images/sort_green.bmp' border='0' width='8' height='8' title='Sort by NPC' alt='Sort'></a>";?></strong></td>
          <td align="center" width="15%"><strong><?echo ($sort == 7) ? "Bot <img src='images/sort_red.bmp' border='0' width='8' height='8' alt='Sort'>" : "<a href='index.php?editor=databuckets&sort=7" . ((isset($filter) && $filter['status'] == "on") ? $filter['url'] : "") . "'>Bot <img src='images/sort_green.bmp' border='0' width='8' height='8' title='Sort by Bot' alt='Sort'></a>";?></strong></td>
          <td width="5%">&nbsp;</td>
        </tr>
<?$x=0;
foreach($databuckets as $databucket):?>
        <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
          <td align="center"><?=$databucket['id']?></td>
          <td align="center"><?=$databucket['key']?></td>
          <td align="center"><?=$databucket['value']?></td>
          <td align="center"><?echo ($databucket['expires'] > 0) ? get_real_time($databucket['expires']) : "N/A (0)";?></td>
          <td align="center"><?=getPlayerName($databucket['character_id'])?> (<?=$databucket['character_id']?>)</td>
          <td align="center"><?=getNPCName($databucket['npc_id'])?> (<?=$databucket['npc_id']?>)</td>
          <td align="center"><?echo ($databucket['bot_id'] > 0) ? $databucket['bot_id'] : "N/A (0)";?></td>
          <td align="right"><a href="index.php?editor=databuckets&id=<?=$databucket['id']?>&action=4"><img src="images/edit2.gif" width="13" height="13" border="0" title="Edit Data Bucket" alt="Edit"></a>&nbsp;<a onClick="return confirm('Really delete data bucket?');" href="index.php?editor=databuckets&id=<?=$databucket['id']?>&action=6"><img src="images/remove3.gif" border="0" title="Delete Data Bucket" alt="Delete"></a></td>
        </tr>
<?$x++;
endforeach;
else:?>
        <tr>
          <td align="left" width="100" style="padding: 10px;">No Data Buckets</td>
        </tr>
<?endif;?>
      </table>
    </div>
