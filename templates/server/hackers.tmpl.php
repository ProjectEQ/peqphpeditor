    <div class="edit_form" id="filter_box" style="width: 700px; display: <?echo ($filter['status'] == 'on') ? 'block' : 'none'?>">
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
          <input type="hidden" name="editor" value="server"/>
          <input type="hidden" name="action" value="6"/>
<?echo (($sort != '') ? '<input type="hidden" name="sort" value="' . $sort . '"/>' : '')?>
          <input type="hidden" name="filter" id="filter_status" value="on"/>
          <table class="table_content" width="100%">
            <tr>
              <td width="25%">
                Account:<br/>
                <input type="text" name="filter1" id="filter1" value="<?=$filter['filter1']?>"/>
              </td>
              <td width="25%">
                Name:<br/>
                <input type="text" name="filter2" id="filter2" value="<?=$filter['filter2']?>"/>
              </td>
              <td width="25%">
                Zone:<br/>
                <input type="text" name="filter3" id="filter3" value="<?=$filter['filter3']?>"/>
              </td>
              <td width="25%">
                Hack:<br/>
                <input type="text" name="filter4" id="filter4" value="<?=$filter['filter4']?>"/>
              </td>
            </tr>
            <tr>
              <td colspan="4" align="center"><br/><input type="submit" value="Apply Filters"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="Remove Filters" onClick="document.getElementById('filter1').value='';document.getElementById('filter2').value='';document.getElementById('filter3').value='';document.getElementById('filter4').value='';document.getElementById('filter_status').value='';"/></td>
            </tr>
          </table>
        </form>
      </div>
    </div><br/>
    <form name="deleteHacks" id="deleteHacks" method="post" action="index.php?editor=server&action=49">
      <div id="action_buttons_top" style="display:none;">
        <center><input onClick="return confirm('Really delete these entries?');" type="submit" value="Delete Marked">&nbsp;<input type="button" value="Cancel" onClick="location.reload();"></center><br/>
      </div>
      <div class="table_container" style="width: 750px;">
        <div class="table_header">
          <table width="100%" cellpadding="0" cellspacing="0">
            <tr>
              <td align="left" width="33%">Hackers</td>
              <td align="center" width="33%">
                <?echo ($page > 1) ? "<a href='index.php?editor=server&action=6&page=1" . (($sort != "") ? "&sort=" . $sort : "") . (($filter['status'] == "on") ? $filter['url'] : "") . "'><img src='images/first.gif' border='0' width='12' height='12' title='First'/></a>" : "<img src='images/first.gif' border='0' width='12' height='12'/>";?>
                <?echo ($page > 1) ? "<a href='index.php?editor=server&action=6&page=" . ($page - 1) . (($sort != "")  ? "&sort=" . $sort : "") . (($filter['status'] == "on") ? $filter['url'] : "") . "'><img src='images/prev.gif' border='0' width='12' height='12' title='Previous'/></a>" : "<img src='images/prev.gif' border='0' width='12' height='12'/>";?>
                <?echo $page . " of " . $pages;?>
                <?echo ($page < $pages) ? "<a href='index.php?editor=server&action=6&page=" . ($page + 1) . (($sort != "") ? "&sort=" . $sort : "")  . (($filter['status'] == "on") ? $filter['url'] : "") . "'><img src='images/next.gif' border='0' width='12' height='12' title='Next'/></a>" : "<img src='images/next.gif' border='0' width='12' height='12'/>";?>
                <?echo ($page < $pages) ? "<a href='index.php?editor=server&action=6&page=" . $pages . (($sort != "") ? "&sort=" . $sort : "")  . (($filter['status'] == "on") ? $filter['url'] : "") . "'><img src='images/last.gif' border='0' width='12' height='12' title='Last'/></a>" : "<img src='images/last.gif' border='0' width='12' height='12'/>";?>
              </td>
              <td align="right" width="33%">
                <a onClick="document.getElementById('filter_box').style.display='block';document.getElementById('filter_image').style.display='none';"><img id="filter_image" src="images/filter.jpg" border="0" height="13" width="13" title="Show filter"<?echo ($filter['status'] == 'on') ? ' style="display:none;"' : '';?>></a>&nbsp;<a onClick="toggleMultiDelete();"><img id="multiD" src="images/remove3.gif" border="0" height="13" width="13" title="Delete multiple"></a><a id="select_all" onClick="toggleSelectAll();" style="display:none;">Select All</a>
              </td>
            </tr>
          </table>
        </div>
        <table class="table_content2" width="100%">
<?if (isset($hackers)) :?>
          <tr>
            <td align="center"><strong><?echo ($sort == 1) ? "ID <img src='images/sort_red.bmp' border='0' width='8' height='8'/>" : "<a href='index.php?editor=server&action=6&sort=1" . (($filter['status'] == 'on') ? $filter['url'] : '') . "'>ID <img src='images/sort_green.bmp' border='0' width='8' height='8' title='Sort by ID'/></a>";?></strong></td>
            <td align="center"><strong><?echo ($sort == 2) ? "Account <img src='images/sort_red.bmp' border='0' width='8' height='8'/>" : "<a href='index.php?editor=server&action=6&sort=2" . (($filter['status'] == 'on') ? $filter['url'] : '') . "'>Account <img src='images/sort_green.bmp' border='0' width='8' height='8' title='Sort by Account'/></a>";?></strong></td>
            <td align="center"><strong><?echo ($sort == 3) ? "Name <img src='images/sort_red.bmp' border='0' width='8' height='8'/>" : "<a href='index.php?editor=server&action=6&sort=3" . (($filter['status'] == 'on') ? $filter['url'] : '') . "'>Name <img src='images/sort_green.bmp' border='0' width='8' height='8' title='Sort by Name'/></a>";?></strong></td>
            <td align="center"><strong><?echo ($sort == 4) ? "Zone <img src='images/sort_red.bmp' border='0' width='8' height='8'/>" : "<a href='index.php?editor=server&action=6&sort=4" . (($filter['status'] == 'on') ? $filter['url'] : '') . "'>Zone <img src='images/sort_green.bmp' border='0' width='8' height='8' title='Sort by Zone'/></a>";?></strong></td>
            <td align="center"><strong><?echo ($sort == 5) ? "Date <img src='images/sort_red.bmp' border='0' width='8' height='8'/>" : "<a href='index.php?editor=server&action=6&sort=5" . (($filter['status'] == 'on') ? $filter['url'] : '') . "'>Date <img src='images/sort_green.bmp' border='0' width='8' height='8' title='Sort by Date'/></a>";?></strong></td>
            <td align="center"><strong><?echo ($sort == 6) ? "Hack <img src='images/sort_red.bmp' border='0' width='8' height='8'/>" : "<a href='index.php?editor=server&action=6&sort=6" . (($filter['status'] == 'on') ? $filter['url'] : '') . "'>Hack <img src='images/sort_green.bmp' border='0' width='8' height='8' title='Sort by Hack'/></a>";?></strong></td>
            <td width="10%">&nbsp;</td>
          </tr>
<?$x=0; foreach($hackers as $hackers=>$v):?>
          <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
            <td align="center" width="5%"><?=$v['hid']?></td>
            <td align="center" width="10%"><?echo (getAccountID($v['account'])) ? "<a href=\"index.php?editor=account&acctid=" . getAccountID($v['account']) . "\">" . $v['account'] . "</a>" : $v['account'];?></td>
            <td align="center" width="15%"><?echo (getPlayerID($v['name'])) ? "<a href=\"index.php?editor=player&playerid=" . getPlayerID($v['name']) . "\">" . $v['name'] . "</a>" : $v['name'];?></td>
            <td align="center" width="15%"><?echo ($v['zone']) ? $v['zone'] : "N/A";?></td>
            <td align="center" width="20%"><?=$v['date']?></td>
            <td align="center" width="25%"><a title="<?=$v['hacked']?>"><?=substr($v['hacked'],0,23)?></a></td>
            <td align="right"><a href="index.php?editor=server&hid=<?=$v['hid']?>&action=8"><img src="images/edit2.gif" border="0" title="View Hacker"></a>&nbsp;<a onClick="return confirm('Really Delete Entry <?=$v['hid']?>?');" href="index.php?editor=server&hid=<?=$v['hid']?>&action=7"><img name="delete_entry" src="images/remove3.gif" border="0" title="Delete this entry"></a><input name="cb_delete[]" type="checkbox" value="<?=$v['hid']?>" style="display:none;"></td>
          </tr>
<?$x++; endforeach;?>
<?endif;?>
<?if (!isset($hackers)):?>
          <tr>
            <td align="left" width="100" style="padding: 10px;">No hackers</td>
          </tr>
<?endif;?>
        </table>
      </div>
      <div id="action_buttons_bottom" style="display:none;">
        <br/><center><input onClick="return confirm('Really delete these entries?');" type="submit" value="Delete Marked">&nbsp;<input type="button" value="Cancel" onClick="location.reload();"></center>
      </div>
    </form>
