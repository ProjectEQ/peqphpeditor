  <div class="table_container" style="width: 700px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td align="left" width="33%">Players</td>
          <td align="center" width="33%">
            <?echo ($page > 1) ? "<a href='index.php?editor=player&page=1" . (($sort != "") ? "&sort=" . $sort : "") . (($filter['status'] == "on") ? $filter['url'] : "") . "'><img src='images/first.gif' border='0' width='12' height='12' title='First'></a>" : "<img src='images/first.gif' border='0' width='12' height='12'>";?>
            <?echo ($page > 1) ? "<a href='index.php?editor=player&page=" . ($page - 1) . (($sort != "") ? "&sort=" . $sort : "") . (($filter['status'] == "on") ? $filter['url'] : "") . "'><img src='images/prev.gif' border='0' width='12' height='12' title='Previous'></a>" : "<img src='images/prev.gif' border='0' width='12' height='12'>";?>
            <?echo $page . " of " . $pages;?>
            <?echo ($page < $pages) ? "<a href='index.php?editor=player&page=" . ($page + 1) . (($sort != "") ? "&sort=" . $sort : "") . (($filter['status'] == "on") ? $filter['url'] : "") . "'><img src='images/next.gif' border='0' width='12' height='12' title='Next'></a>" : "<img src='images/next.gif' border='0' width='12' height='12'>";?>
            <?echo ($page < $pages) ? "<a href='index.php?editor=player&page=" . $pages . (($sort != "") ? "&sort=" . $sort : "") . (($filter['status'] == "on") ? $filter['url'] : "") . "'><img src='images/last.gif' border='0' width='12' height='12' title='Last'></a>" : "<img src='images/last.gif' border='0' width='12' height='12'>";?>
          </td>
          <td align="right" width="33%">&nbsp;</td>
        </tr>
      </table>
    </div>
    <table class="table_content2" width="100%">
<?if (isset($players)):?>
      <tr>
        <td align="center"><strong><?echo ($sort == 1) ? "ID <img src='images/sort_red.bmp' border='0' width='8' height='8'>" : "<a href='index.php?editor=player&sort=1" . (($filter['status'] == "on") ? $filter['url'] : "") . "'>ID <img src='images/sort_green.bmp' border='0' width='8' height='8' title='Sort by ID'></a>";?></strong></td>
        <td align="center"><strong><?echo ($sort == 2) ? "Name <img src='images/sort_red.bmp' border='0' width='8' height='8'>" : "<a href='index.php?editor=player&sort=2" . (($filter['status'] == "on") ? $filter['url'] : "") . "'>Name <img src='images/sort_green.bmp' border='0' width='8' height='8' title='Sort by Name'></a>";?></strong></td>
        <td align="center"><strong><?echo ($sort == 3) ? "Account <img src='images/sort_red.bmp' border='0' width='8' height='8'>" : "<a href='index.php?editor=player&sort=3" . (($filter['status'] == "on") ? $filter['url'] : "") . "'>Account <img src='images/sort_green.bmp' border='0' width='8' height='8' title='Sort by Account'></a>";?></strong></td>
        <td align="center"><strong><?echo ($sort == 4) ? "Class <img src='images/sort_red.bmp' border='0' width='8' height='8'>" : "<a href='index.php?editor=player&sort=4" . (($filter['status'] == "on") ? $filter['url'] : "") . "'>Class <img src='images/sort_green.bmp' border='0' width='8' height='8' title='Sort by Class'></a>";?></strong></td>
        <td align="center"><strong><?echo ($sort == 5) ? "Level <img src='images/sort_red.bmp' border='0' width='8' height='8'>" : "<a href='index.php?editor=player&sort=5" . (($filter['status'] == "on") ? $filter['url'] : "") . "'>Level <img src='images/sort_green.bmp' border='0' width='8' height='8' title='Sort by Level'></a>";?></strong></td>
        <td width="5%">&nbsp;</td>
      </tr>
<?$x=0;
foreach($players as $player):?>
      <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
        <td align="center"><?=$player['id']?></td>
        <td align="center"><a href="index.php?editor=player&playerid=<?echo getPlayerID($player['name'])?>"><?=$player['name']?></a></td>
        <td align="center"><a href="index.php?editor=account&acctid=<?=$player['account_id']?>"><?echo getAccountName($player['account_id'])?></a></td>
        <td align="center"><?=$classes[$player['class']]?></td>
        <td align="center"><?=$player['level']?></td>
        <td align="right"><a href="index.php?editor=player&playerid=<?=$player['id']?>"><img src="images/view_all.gif" width="13" height="13" border="0" title="View Player"></a></td>
      </tr>
<?$x++;
endforeach;
else:?>
      <tr>
        <td align="left" width="100" style="padding: 10px;">No Players</td>
      </tr>
<?endif;?>
    </table>
  </div>
