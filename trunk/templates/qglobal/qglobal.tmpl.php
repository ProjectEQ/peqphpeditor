        <div class="table_container" style="width: 700px;">
          <div class="table_header">
            <table width="100%" cellpadding="0" cellspacing="0">
              <tr>
                <td>Quest Globals</td>
                <td>
                  <?echo ($page_stats['page'] > 1) ? "<a href='index.php?editor=qglobal&page=1" . (($page_stats['sort'] != "") ? "&sort=" . $page_stats['sort'] : "") . "'><img src='images/first.gif' border='0' width='12' height='12' title='First'/></a>" : "<img src='images/first.gif' border='0' width='12' height='12'/>";?>
                  <?echo ($page_stats['page'] > 1) ? "<a href='index.php?editor=qglobal&page=" . ($page_stats['page'] - 1) . (($page_stats['sort'] != "") ? "&sort=" . $page_stats['sort'] : "") . "'><img src='images/prev.gif' border='0' width='12' height='12' title='Previous'/></a>" : "<img src='images/prev.gif' border='0' width='12' height='12'/>";?>
                  <?echo $page_stats['page'] . " of " . $page_stats['pages'];?>
                  <?echo ($page_stats['page'] < $page_stats['pages']) ? "<a href='index.php?editor=qglobal&page=" . ($page_stats['page'] + 1) . (($page_stats['sort'] != "") ? "&sort=" . $page_stats['sort'] : "") . "'><img src='images/next.gif' border='0' width='12' height='12' title='Next'/></a>" : "<img src='images/next.gif' border='0' width='12' height='12'/>";?>
                  <?echo ($page_stats['page'] < $page_stats['pages']) ? "<a href='index.php?editor=qglobal&page=" . $page_stats['pages'] . (($page_stats['sort'] != "") ? "&sort=" . $page_stats['sort'] : "") . "'><img src='images/last.gif' border='0' width='12' height='12' title='Last'/></a>" : "<img src='images/last.gif' border='0' width='12' height='12'/>";?>
                </td>
                <td>
                  <div style="float:right">
                    <a href="index.php?editor=qglobal&action=2"><img src="images/add.gif" border="0" title="Create New Quest Global" /></a>
                  </div>
                </td>
              </tr>
            </table>
          </div>
          <table class="table_content2" width="100%">
<?if (isset($qglobals)):?>
            <tr>
              <td align="center" width="8%"><strong><?echo ($page_stats['sort'] == 1) ? "ID <img src='images/sort_red.bmp' border='0' width='8' height='8'/>" : "<a href='index.php?editor=qglobal&sort=1'>ID <img src='images/sort_green.bmp' border='0' width='8' height='8' title='Sort by ID'/></a>";?></strong></td>
              <td align="center" width="14%"><strong><?echo ($page_stats['sort'] == 2) ? "Name <img src='images/sort_red.bmp' border='0' width='8' height='8'/>" : "<a href='index.php?editor=qglobal&sort=2'>Name <img src='images/sort_green.bmp' border='0' width='8' height='8' title='Sort by Name'/></a>";?></strong></td>
              <td align="center" width="2%"><strong>Value</strong></td>
              <td align="center" width="18%"><strong><?echo ($page_stats['sort'] == 3) ? "Character <img src='images/sort_red.bmp' border='0' width='8' height='8'/>" : "<a href='index.php?editor=qglobal&sort=3'>Character <img src='images/sort_green.bmp' border='0' width='8' height='8' title='Sort by Character'/></a>";?></strong></td>
              <td align="center" width="18%"><strong><?echo ($page_stats['sort'] == 4) ? "NPC <img src='images/sort_red.bmp' border='0' width='8' height='8'/>" : "<a href='index.php?editor=qglobal&sort=4'>NPC <img src='images/sort_green.bmp' border='0' width='8' height='8' title='Sort by NPC'/></a>";?></strong></td>
              <td align="center" width="15%"><strong><?echo ($page_stats['sort'] == 5) ? "Zone <img src='images/sort_red.bmp' border='0' width='8' height='8'/>" : "<a href='index.php?editor=qglobal&sort=5'>Zone <img src='images/sort_green.bmp' border='0' width='8' height='8' title='Sort by Zone'/></a>";?></strong></td>
              <td align="center" width="20%"><strong>Expires</strong></td>
              <td width="5%">&nbsp;</td>
            </tr>
<?$x=0;
foreach($qglobals as $qglobal):?>
            <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
              <td align="center" width="8%"><?=$qglobal['id']?></td>
              <td align="center" width="14%"><?=$qglobal['name']?></td>
              <td align="center" width="2%"><?=$qglobal['value']?></td>
              <td align="center" width="18%"><?echo ($qglobal['charid'] > 0) ? '<a href="index.php?editor=player&playerid=' . $qglobal['charid'] . '">' . getPlayerName($qglobal['charid']) . '</a>' : "ANY";?></td>
              <td align="center" width="18%"><?echo ($qglobal['npcid'] > 0) ? '<a href="index.php?editor=npc&npcid=' . $qglobal['npcid'] . '">' . getNPCName($qglobal['npcid']) . '</a>' : "ANY";?></td>
              <td align="center" width="15%"><?echo ($qglobal['zoneid'] > 0) ? getZoneName($qglobal['zoneid']) : "ANY";?></td>
              <td align="center" width="20%"><?echo ($qglobal['expdate'] != '') ? get_real_time($qglobal['expdate']) : "NEVER";?></td>
              <td align="right"><a href="index.php?editor=qglobal&qglobalid=<?=$qglobal['id']?>&action=4"><img src="images/edit2.gif" width="13" height="13" border="0" title="Edit Quest Global"></a>&nbsp;<a onClick="return confirm('Really delete quest global <?=$qglobal['id']?>?');" href="index.php?editor=qglobal&qglobalid=<?=$qglobal['id']?>&action=6"><img src="images/remove3.gif" border="0" title="Delete Quest Global"></a></td>
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
