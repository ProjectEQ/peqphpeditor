        <div class="table_container" style="width: 700px;">
          <div class="table_header">
            <table width="100%" cellpadding="0" cellspacing="0">
              <tr>
                <td>Quest Globals</td>
                <td>Page <?echo ($page_stats['page'] > 1) ? "<a href='index.php?editor=qglobal&page=1" . (($page_stats['filter'] != "") ? "&filter=" . $page_stats['filter'] : "") . "'><<</a>" : "";?>&nbsp;<?echo ($page_stats['page'] > 1) ? "<a href='index.php?editor=qglobal&page=" . ($page_stats['page'] - 1) . (($page_stats['filter'] != "") ? "&filter=" . $page_stats['filter'] : "") . "'><</a>" : "";?>&nbsp;<?=$page_stats['page']?> of <?=$page_stats['pages']?>&nbsp;<?echo ($page_stats['page'] < $page_stats['pages']) ? "<a href='index.php?editor=qglobal&page=" . ($page_stats['page'] + 1) . (($page_stats['filter'] != "") ? "&filter=" . $page_stats['filter'] : "") . "'>></a>" : "";?>&nbsp;<?echo ($page_stats['page'] < $page_stats['pages']) ? "<a href='index.php?editor=qglobal&page=" . $page_stats['pages'] . (($page_stats['filter'] != "") ? "&filter=" . $page_stats['filter'] : "") . "'>>></a>" : "";?></td>
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
              <td align="center" width="8%"><strong><a href="index.php?editor=qglobal&filter=1">ID</a></strong></td>
              <td align="center" width="14%"><strong><a href="index.php?editor=qglobal&filter=2">Name</a></strong></td>
              <td align="center" width="2%"><strong>Value</strong></td>
              <td align="center" width="18%"><strong><a href="index.php?editor=qglobal&filter=3">Character</a></strong></td>
              <td align="center" width="18%"><strong><a href="index.php?editor=qglobal&filter=4">NPC</a></strong></td>
              <td align="center" width="15%"><strong><a href="index.php?editor=qglobal&filter=5">Zone</a></strong></td>
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
