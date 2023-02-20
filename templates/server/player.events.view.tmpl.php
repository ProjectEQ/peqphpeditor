  <div class="edit_form" id="filter_box" style="width: 700px; display: <?echo (isset($filter) && $filter['status'] == 'on') ? 'block' : 'none';?>">
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
        <input type="hidden" name="editor" value="server">
        <input type="hidden" name="action" value="6">
<?echo ((isset($sort) && $sort != '') ? '<input type="hidden" name="sort" value="' . $sort . '">' : '')?>
        <input type="hidden" name="filter" id="filter_status" value="on">
        <table class="table_content" width="100%">
          <tr>
            <td width="25%">
              Account:<br>
              <input type="text" name="filter1" id="filter1" value="<?echo (isset($filter)) ? $filter['filter1'] : "";?>">
            </td>
            <td width="25%">
              Player:<br>
              <input type="text" name="filter2" id="filter2" value="<?echo (isset($filter)) ? $filter['filter2'] : "";?>">
            </td>
            <td width="25%">
              Zone:<br>
              <input type="text" name="filter3" id="filter3" value="<?echo (isset($filter)) ? $filter['filter3'] : "";?>">
            </td>
            <td width="25%">
              Event Type:<br>
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
  <div class="table_container" style="width: 750px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td align="left" width="33%">Player Events</td>
          <td align="center" width="34%">
            <?echo ($page > 1) ? "<a href='index.php?editor=server&action=6&page=1" . (($sort != "") ? "&sort=" . $sort : "") . ((isset($filter) && $filter['status'] == "on") ? $filter['url'] : "") . "'><img src='images/first.gif' border='0' width='12' height='12' title='First'></a>" : "<img src='images/first.gif' border='0' width='12' height='12'>";?>
            <?echo ($page > 1) ? "<a href='index.php?editor=server&action=6&page=" . ($page - 1) . (($sort != "")  ? "&sort=" . $sort : "") . ((isset($filter) && $filter['status'] == "on") ? $filter['url'] : "") . "'><img src='images/prev.gif' border='0' width='12' height='12' title='Previous'></a>" : "<img src='images/prev.gif' border='0' width='12' height='12'>";?>
            <?echo $page . " of " . $pages;?>
            <?echo ($page < $pages) ? "<a href='index.php?editor=server&action=6&page=" . ($page + 1) . (($sort != "") ? "&sort=" . $sort : "")  . ((isset($filter) && $filter['status'] == "on") ? $filter['url'] : "") . "'><img src='images/next.gif' border='0' width='12' height='12' title='Next'></a>" : "<img src='images/next.gif' border='0' width='12' height='12'>";?>
            <?echo ($page < $pages) ? "<a href='index.php?editor=server&action=6&page=" . $pages . (($sort != "") ? "&sort=" . $sort : "")  . ((isset($filter) && $filter['status'] == "on") ? $filter['url'] : "") . "'><img src='images/last.gif' border='0' width='12' height='12' title='Last'></a>" : "<img src='images/last.gif' border='0' width='12' height='12'>";?>
          </td>
          <td align="right" width="33%">
            <a onClick="document.getElementById('filter_box').style.display='block';document.getElementById('filter_image').style.display='none';"><img id="filter_image" src="images/filter.jpg" border="0" height="13" width="13" title="Show filter"<?echo (isset($filter) && $filter['status'] == 'on') ? ' style="display:none;"' : '';?>></a>&nbsp;
            <a href="index.php?editor=server&action=76"><img src="images/config.gif" width="13" height="13" border="0" title="Event Log Settings"></a>
          </td>
        </tr>        
      </table>
    </div>
    <table class="table_content2" width="100%">
<?if(isset($events)):?>
      <tr>
        <td align="center" width="10%"><strong><?echo ($sort == 1) ? "ID <img src='images/sort_red.bmp' border='0' width='8' height='8'>" : "<a href='index.php?editor=server&action=6&sort=1" . ((isset($filter) && $filter['status'] == 'on') ? $filter['url'] : '') . "'>ID <img src='images/sort_green.bmp' border='0' width='8' height='8' title='Sort by ID'></a>";?></strong></td>
        <td align="center" width="15%"><strong><?echo ($sort == 2) ? "Account <img src='images/sort_red.bmp' border='0' width='8' height='8'>" : "<a href='index.php?editor=server&action=6&sort=2" . ((isset($filter) && $filter['status'] == 'on') ? $filter['url'] : '') . "'>Account <img src='images/sort_green.bmp' border='0' width='8' height='8' title='Sort by Account'></a>";?></strong></td>
        <td align="center" width="15%"><strong><?echo ($sort == 3) ? "Player <img src='images/sort_red.bmp' border='0' width='8' height='8'>" : "<a href='index.php?editor=server&action=6&sort=3" . ((isset($filter) && $filter['status'] == 'on') ? $filter['url'] : '') . "'>Player <img src='images/sort_green.bmp' border='0' width='8' height='8' title='Sort by Player'></a>";?></strong></td>
        <td align="center" width="15%"><strong><?echo ($sort == 4) ? "Zone <img src='images/sort_red.bmp' border='0' width='8' height='8'>" : "<a href='index.php?editor=server&action=6&sort=4" . ((isset($filter) && $filter['status'] == 'on') ? $filter['url'] : '') . "'>Zone <img src='images/sort_green.bmp' border='0' width='8' height='8' title='Sort by Zone'></a>";?></strong></td>
        <td align="center" width="15%"><strong><?echo ($sort == 5) ? "Event Type <img src='images/sort_red.bmp' border='0' width='8' height='8'>" : "<a href='index.php?editor=server&action=6&sort=5" . ((isset($filter) && $filter['status'] == 'on') ? $filter['url'] : '') . "'>Event Type <img src='images/sort_green.bmp' border='0' width='8' height='8' title='Sort by Event Type'></a>";?></strong></td>
        <td align="center" width="20%"><strong><?echo ($sort == 6) ? "Timestamp <img src='images/sort_red.bmp' border='0' width='8' height='8'>" : "<a href='index.php?editor=server&action=6&sort=6" . ((isset($filter) && $filter['status'] == 'on') ? $filter['url'] : '') . "'>Timestamp <img src='images/sort_green.bmp' border='0' width='8' height='8' title='Sort by Timestamp'></a>";?></strong></td>
        <td width="5%">&nbsp;</td>
      </tr>
<?$x=0; foreach($events as $event):?>
      <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
        <td align="center" width="10%"><?=$event['id']?></td>
        <td align="center" width="15%"><?=getAccountName($event['account_id'])?></td>
        <td align="center" width="15%"><?=getPlayerName($event['character_id'])?></td>
        <td align="center" width="15%"><?=getZoneName($event['zone_id'])?></td>
        <td align="center" width="15%"><?=$event['event_type_name']?></td>
        <td align="center" width="20%"><?=$event['created_at']?></td>
        <td align="right" width="5%">
          <a href="index.php?editor=server&id=<?=$event['id']?>&action=7"><img src="images/view_all.gif" width="13" height="13" border="0" title="View Event"></a>          
          <a href="index.php?editor=server&id=<?=$event['id']?>&action=8" onClick="return confirm('Really delete this event?');"><img src="images/remove3.gif" border="0" title="Delete this event"></a>
        </td>
      </tr>
<?$x++;endforeach;?>
<?else:?>
      <tr>
        <td align="left" width="100%" style="padding: 10px;">No Events</td>
      </tr>
<?endif;?>
    </table>
  </div>
