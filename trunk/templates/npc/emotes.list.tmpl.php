    <div class="edit_form" id="filter_box" style="width: 750px; display: <?echo ($filter['status'] == 'on') ? 'block' : 'none'?>">
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
          <input type="hidden" name="editor" value="npc"/>
          <input type="hidden" name="z" value="<?=$currzone?>"/>
          <input type="hidden" name="zoneid" value="<?=$currzoneid?>"/>
          <input type="hidden" name="npcid" value="<?=$npcid?>"/>
          <input type="hidden" name="action" value="78"/>
<?echo (($sort != '') ? '<input type="hidden" name="sort" value="' . $sort . '"/>' : '')?>
          <input type="hidden" name="filter" id="filter_status" value="on"/>
          <table class="table_content" width="100%">
            <tr>
              <td width="10%">
                EmoteID:<br/>
                <input type="text" name="filter1" id="filter1" size="5" value="<?=$filter['filter1']?>"/>
              </td>
              <td width="10%">
                Type:<br/>
                <input type="text" name="filter2" id="filter2" size="5" value="<?=$filter['filter2']?>"/>
              </td>
              <td width="10%">
                Event:<br/>
                <input type="text" name="filter3" id="filter3" size="5" value="<?=$filter['filter3']?>"/>
              </td>
              <td width="65%">
                Text:<br/>
                <input type="text" name="filter4" id="filter4" size="50" value="<?=$filter['filter4']?>"/>
              </td>
            </tr>
            <tr>
              <td colspan="4" align="center"><br/><input type="submit" value="Apply Filters"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="Remove Filters" onClick="document.getElementById('filter1').value='';document.getElementById('filter2').value='';document.getElementById('filter3').value='';document.getElementById('filter4').value='';document.getElementById('filter_status').value='';"/></td>
            </tr>
          </table>
        </form>
      </div>
    </div><br/>
    <div class="table_container" style="width: 750px;">
      <div class="table_header">
        <table width="100%" cellpadding="0" cellspacing="0">
          <tr>
            <td align="left" width="33%">NPC Emotes</td>
            <td align="center" width="33%">
              <?echo ($page > 1) ? "<a href='index.php?editor=npc&z=$currzone&zoneid=$currzoneid&npcid=$npcid&action=78&page=1" . (($sort != "") ? "&sort=" . $sort : "") . (($filter['status'] == "on") ? $filter['url'] : "") . "'><img src='images/first.gif' border='0' width='12' height='12' title='First'/></a>" : "<img src='images/first.gif' border='0' width='12' height='12'/>";?>
              <?echo ($page > 1) ? "<a href='index.php?editor=npc&z=$currzone&zoneid=$currzoneid&npcid=$npcid&action=78&page=" . ($page - 1) . (($sort != "") ? "&sort=" . $sort : "") . (($filter['status'] == "on") ? $filter['url'] : "") . "'><img src='images/prev.gif' border='0' width='12' height='12' title='Previous'/></a>" : "<img src='images/prev.gif' border='0' width='12' height='12'/>";?>
              <?echo $page . " of " . $pages;?>
              <?echo ($page < $pages) ? "<a href='index.php?editor=npc&z=$currzone&zoneid=$currzoneid&npcid=$npcid&action=78&page=" . ($page + 1) . (($sort != "") ? "&sort=" . $sort : "") . (($filter['status'] == "on") ? $filter['url'] : "") . "'><img src='images/next.gif' border='0' width='12' height='12' title='Next'/></a>" : "<img src='images/next.gif' border='0' width='12' height='12'/>";?>
              <?echo ($page < $pages) ? "<a href='index.php?editor=npc&z=$currzone&zoneid=$currzoneid&npcid=$npcid&action=78&page=" . $pages . (($sort != "") ? "&sort=" . $sort : "") . (($filter['status'] == "on") ? $filter['url'] : "") . "'><img src='images/last.gif' border='0' width='12' height='12' title='Last'/></a>" : "<img src='images/last.gif' border='0' width='12' height='12'/>";?>
            </td>
            <td align="right" width="33%">
              <a onClick="document.getElementById('filter_box').style.display='block';"><img src="images/filter.jpg" border="0" height="13" width="13" title="Show filter"></a>&nbsp;<a href="index.php?editor=npc&action=76"><img src="images/add.gif" border="0" title="Add new emote set"></a>
            </td>
          </tr>
        </table>
      </div>
      <table class="table_content2" width="100%">
<?if (isset($emotes)):?>
        <tr>
          <td align="center"><strong><?echo ($sort == 1) ? "EmoteID <img src='images/sort_red.bmp' border='0' width='8' height='8'/>" : "<a href='index.php?editor=npc&action=78&sort=1" . (($filter['status'] == "on") ? $filter['url'] : "") . "'>EmoteID <img src='images/sort_green.bmp' border='0' width='8' height='8' title='Sort by EmoteID'/></a>";?></strong></td>
          <td align="center"><strong><?echo ($sort == 2) ? "Type <img src='images/sort_red.bmp' border='0' width='8' height='8'/>" : "<a href='index.php?editor=npc&action=78&sort=2" . (($filter['status'] == "on") ? $filter['url'] : "") . "'>Type <img src='images/sort_green.bmp' border='0' width='8' height='8' title='Sort by Type'/></a>";?></strong></td>
          <td align="center"><strong><?echo ($sort == 3) ? "Event <img src='images/sort_red.bmp' border='0' width='8' height='8'/>" : "<a href='index.php?editor=npc&action=78&sort=3" . (($filter['status'] == "on") ? $filter['url'] : "") . "'>Event <img src='images/sort_green.bmp' border='0' width='8' height='8' title='Sort by Event'/></a>";?></strong></td>
          <td align="center"><strong><?echo ($sort == 4) ? "Text <img src='images/sort_red.bmp' border='0' width='8' height='8'/>" : "<a href='index.php?editor=npc&action=78&sort=4" . (($filter['status'] == "on") ? $filter['url'] : "") . "'>Text <img src='images/sort_green.bmp' border='0' width='8' height='8' title='Sort by Text'/></a>";?></strong></td>
          <td width="5%">&nbsp;</td>
        </tr>
<?$x=0;
foreach($emotes as $emotes=>$v):?>
        <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
          <td align="center" width="10%"><?=$v['emoteid']?></td>
          <td align="center" width="10%"><?=$emotetype[$v['type']]?></td>
          <td align="center" width="10%"><?=$eventtype[$v['event_']]?></td>
          <td align="center" width="65%"><?=html_replace($v['text'])?></td>
<?
  if ($v['emoteid'] > 999){ $npcid = $v['emoteid']; }
  else { $npcid = get_npcid_by_emoteid($v['emoteid']); }
  $currzone = get_zone_by_npcid($npcid);
  $currzoneid = get_zoneid_by_npcid($npcid); 
?>
          <td align="right"><a href="index.php?editor=npc&emoteid=<?=$v['emoteid']?>&action=72"><img src="images/edit2.gif" width="13" height="13" border="0" title="View Emote Set"></a></td>
        </tr>
<?$x++;
endforeach;
else:?>
        <tr>
          <td align="left" width="100" style="padding: 10px;">No NPC Emotes</td>
        </tr>
<?endif;?>
      </table>
    </div>
