        <div class="table_container" style="width: 700px;">
          <div class="table_header">
            <table width="100%" cellpadding="0" cellspacing="0">
              <tr>
                <td align="left" width="33%">Bugs</td>
                <td align="center" width="33%">
                  <?echo ($page > 1) ? "<a href='index.php?editor=server&action=4&page=1" . (($sort != "") ? "&sort=" . $sort : "") . "'><img src='images/first.gif' border='0' width='12' height='12' title='First'/></a>" : "<img src='images/first.gif' border='0' width='12' height='12'/>";?>
                  <?echo ($page > 1) ? "<a href='index.php?editor=server&action=4&page=" . ($page - 1) . (($sort != "") ? "&sort=" . $sort : "") . "'><img src='images/prev.gif' border='0' width='12' height='12' title='Previous'/></a>" : "<img src='images/prev.gif' border='0' width='12' height='12'/>";?>
                  <?echo $page . " of " . $pages;?>
                  <?echo ($page < $pages) ? "<a href='index.php?editor=server&action=4&page=" . ($page + 1) . (($sort != "") ? "&sort=" . $sort : "") . "'><img src='images/next.gif' border='0' width='12' height='12' title='Next'/></a>" : "<img src='images/next.gif' border='0' width='12' height='12'/>";?>
                  <?echo ($page < $pages) ? "<a href='index.php?editor=server&action=4&page=" . $pages . (($sort != "") ? "&sort=" . $sort : "") . "'><img src='images/last.gif' border='0' width='12' height='12' title='Last'/></a>" : "<img src='images/last.gif' border='0' width='12' height='12'/>";?>
                </td>
                <td align="right" width="33%"><a href="index.php?editor=server&action=1">View Open Bugs</a></td>
              </tr>
            </table>
          </div>
          <table class="table_content2" width="100%">
<?if (isset($bugs)) :?>
            <tr>
              <td align="center" width="5%"><strong><?echo ($sort == 1) ? "ID <img src='images/sort_red.bmp' border='0' width='8' height='8'/>" : "<a href='index.php?editor=server&action=4&sort=1'>ID <img src='images/sort_green.bmp' border='0' width='8' height='8' title='Sort by ID'/></a>";?></strong></td>
              <td align="center" width="15%"><strong><?echo ($sort == 2) ? "Zone <img src='images/sort_red.bmp' border='0' width='8' height='8'/>" : "<a href='index.php?editor=server&action=4&sort=2'>Zone <img src='images/sort_green.bmp' border='0' width='8' height='8' title='Sort by Zone'/></a>";?></strong></td>
              <td align="center" width="15%"><strong><?echo ($sort == 3) ? "Toon <img src='images/sort_red.bmp' border='0' width='8' height='8'/>" : "<a href='index.php?editor=server&action=4&sort=3'>Toon <img src='images/sort_green.bmp' border='0' width='8' height='8' title='Sort by Toon'/></a>";?></strong></td>
              <td align="center" width="15%"><strong><?echo ($sort == 4) ? "Type <img src='images/sort_red.bmp' border='0' width='8' height='8'/>" : "<a href='index.php?editor=server&action=4&sort=4'>Type <img src='images/sort_green.bmp' border='0' width='8' height='8' title='Sort by Type'/></a>";?></strong></td>
              <td align="center" width="15%"><strong><?echo ($sort == 5) ? "Target <img src='images/sort_red.bmp' border='0' width='8' height='8'/>" : "<a href='index.php?editor=server&action=4&sort=5'>Target <img src='images/sort_green.bmp' border='0' width='8' height='8' title='Sort by Target'/></a>";?></strong></td>
              <td align="center" width="15%"><strong><?echo ($sort == 6) ? "Date <img src='images/sort_red.bmp' border='0' width='8' height='8'/>" : "<a href='index.php?editor=server&action=4&sort=6'>Date <img src='images/sort_green.bmp' border='0' width='8' height='8' title='Sort by Date'/></a>";?></strong></td>
              <td align="center" width="15%"><strong><?echo ($sort == 7) ? "Status <img src='images/sort_red.bmp' border='0' width='8' height='8'/>" : "<a href='index.php?editor=server&action=4&sort=7'>Status <img src='images/sort_green.bmp' border='0' width='8' height='8' title='Sort by Status'/></a>";?></strong></td>
              <td width="5%">&nbsp;</td>
            </tr>
<?$x=0; foreach($bugs as $bugs=>$v):?>
<?if($v['status'] != 0):?>
            <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
              <td align="center" width="5%"><?=$v['bid']?></td>
              <td align="center" width="15%"><?=$v['zone']?></td>
              <td align="center" width="15%"><?=$v['name']?></td>
              <td align="center" width="15%"><?=$v['type']?></td>
              <td align="center" width="15%"><?=$v['target']?></td>
              <td align="center" width="15%"><?=$v['date']?></td>
              <td align="center" width="15%"><?=$bugstatus[$v['status']]?></td>
              <td align="right"><a href="index.php?editor=server&bid=<?=$v['bid']?>&action=2"><img src="images/edit2.gif" border="0" title="View Entry"></a></td>
              <td align="right"><a onClick="return confirm('Really Delete Report <?=$v['bid']?>?');" href="index.php?editor=server&bid=<?=$v['bid']?>&action=5"><img src="images/remove3.gif" border="0" title="Delete Entry"></a></td>
            </tr>
<?endif;?>
<?$x++; endforeach;?>
<?endif;?>
<?if (!isset($bugs)):?>
            <tr>
              <td align="left" width="100" style="padding: 10px;">No resolved bugs</td>
            </tr>
<?endif;?>
          </table>
        </div>
