    <div class="edit_form" id="filter_box" style="width: 350px; display: <?echo ($filter['status'] == 'on') ? 'block' : 'none'?>">
      <div class="edit_form_header">
        <table width="100%" cellpadding="0" cellspacing="0">
          <tr>
            <td align="left">Filters</td>
            <td align="right"><a onClick="document.getElementById('filter_box').style.display='none';"><img src="images/downgrade.gif" title="Hide filter" border="0"></a></td>
          </tr>
        </table>
      </div>
      <div class="edit_form_content">
        <form name="filter" id="filter" method="get" action="index.php">
          <input type="hidden" name="editor" value="faction"/>
          <input type="hidden" name="action" value="9"/>
<?echo (($sort != '') ? '<input type="hidden" name="sort" value="' . $sort . '"/>' : '')?>
          <input type="hidden" name="filter" id="filter_status" value="on"/>
          <table class="table_content" width="100%">
            <tr>
              <td width="50%">
                Character Name:<br/>
                <input type="text" name="filter1" id="filter1" value="<?=$filter['filter1']?>"/>
              </td>
              <td width="50%">
                Faction ID:<br/>
                <input type="text" name="filter2" id="filter2" value="<?=$filter['filter2']?>"/>
              </td>
            </tr>
            <tr>
              <td colspan="2" align="center"><br/><input type="submit" value="Apply Filters"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="Remove Filters" onClick="document.getElementById('filter1').value='';document.getElementById('filter2').value='';document.getElementById('filter_status').value='';"/></td>
            </tr>
          </table>
        </form>
      </div>
    </div><br/>
        <div class="table_container" style="width: 500px;">
          <div class="table_header">
            <table width="100%" cellpadding="0" cellspacing="0">
              <tr>
                <td align="left" width="33%">Player Faction Entries</td>
                <td align="center" width="33%">
                  <?echo ($page > 1) ? "<a href='index.php?editor=faction&action=9&page=1" . (($sort != "") ? "&sort=" . $sort : "") . (($filter['status'] == "on") ? $filter['url'] : "") . "'><img src='images/first.gif' border='0' width='12' height='12' title='First'/></a>" : "<img src='images/first.gif' border='0' width='12' height='12'/>";?>
                  <?echo ($page > 1) ? "<a href='index.php?editor=faction&action=9&page=" . ($page - 1) . (($sort != "") ? "&sort=" . $sort : "") . (($filter['status'] == "on") ? $filter['url'] : "") . "'><img src='images/prev.gif' border='0' width='12' height='12' title='Previous'/></a>" : "<img src='images/prev.gif' border='0' width='12' height='12'/>";?>
                  <?echo $page . " of " . $pages;?>
                  <?echo ($page < $pages) ? "<a href='index.php?editor=faction&action=9&page=" . ($page + 1) . (($sort != "") ? "&sort=" . $sort : "") . (($filter['status'] == "on") ? $filter['url'] : "") . "'><img src='images/next.gif' border='0' width='12' height='12' title='Next'/></a>" : "<img src='images/next.gif' border='0' width='12' height='12'/>";?>
                  <?echo ($page < $pages) ? "<a href='index.php?editor=faction&action=9&page=" . $pages . (($sort != "") ? "&sort=" . $sort : "") . (($filter['status'] == "on") ? $filter['url'] : "") . "'><img src='images/last.gif' border='0' width='12' height='12' title='Last'/></a>" : "<img src='images/last.gif' border='0' width='12' height='12'/>";?>
                </td>
                <td align="right" width="33%"><a onClick="document.getElementById('filter_box').style.display='block';"><img src="images/filter.jpg" border="0" height="13" width="13" title="Show filter"></a>&nbsp;<a href="index.php?editor=faction&action=12"><img src="images/add.gif" border="0" title="Add a faction entry"></a></td>
              </tr>
            </table>
          </div>
          <table class="table_content2" width="100%">
<?if (isset($player_factions)):?>
            <tr>
              <td align="center" width="20%"><strong><?echo ($sort == 1) ? "Character <img src='images/sort_red.bmp' border='0' width='8' height='8'/>" : "<a href='index.php?editor=faction&action=9&sort=1" . (($filter['status'] == "on") ? $filter['url'] : "") . "'>Character <img src='images/sort_green.bmp' border='0' width='8' height='8' title='Sort by Character'/></a>";?></strong></td>
              <td align="center" width="20%"><strong><?echo ($sort == 2) ? "Faction <img src='images/sort_red.bmp' border='0' width='8' height='8'/>" : "<a href='index.php?editor=faction&action=9&sort=2" . (($filter['status'] == "on") ? $filter['url'] : "") . "'>Faction <img src='images/sort_green.bmp' border='0' width='8' height='8' title='Sort by Faction'/></a>";?></strong></td>
              <td align="center" width="20%"><strong>Value</strong></td>
              <td width="10%">&nbsp;</td>
            </tr>
<?$x=0; foreach($player_factions as $player_faction):?>
            <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
              <td align="center" width="20%"><a title="Character ID: <?=$player_faction['char_id']?>"><?=getPlayerName($player_faction['char_id']);?></a></td>
              <td align="center" width="20%"><a title="Faction: <?=getFactionName($player_faction['faction_id'])?>"><?=$player_faction['faction_id']?></a></td>
              <td align="center" width="20%"><?=$player_faction['current_value']?></td>
              <td align="right"><a href="index.php?editor=faction&char_id=<?=$player_faction['char_id']?>&faction_id=<?=$player_faction['faction_id']?>&action=10"><img src="images/edit2.gif" border="0" title="Edit Faction Entry"></a>&nbsp;<a onClick="return confirm('Really Delete this Faction Entry?');" href="index.php?editor=faction&char_id=<?=$player_faction['char_id']?>&faction_id=<?=$player_faction['faction_id']?>&action=14"><img src="images/remove3.gif" border="0" title="Delete this faction entry"></a></td>
            </tr>
<?$x++; endforeach;?>
<?endif;?>
<?if (!isset($player_factions)):?>
            <tr>
              <td align="left" width="100" style="padding: 10px;">No faction entries</td>
            </tr>
<?endif;?>
          </table>
        </div>
