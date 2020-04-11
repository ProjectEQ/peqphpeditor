  <div class="table_container" style="width: 500px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td align="left" width="33%">Accounts</td>
          <td align="center" width="33%">
            <?echo ($page > 1) ? "<a href='index.php?editor=account&page=1" . (($sort != "") ? "&sort=" . $sort : "") . (($filter['status'] == "on") ? $filter['url'] : "") . "'><img src='images/first.gif' border='0' width='12' height='12' title='First'></a>" : "<img src='images/first.gif' border='0' width='12' height='12'>";?>
            <?echo ($page > 1) ? "<a href='index.php?editor=account&page=" . ($page - 1) . (($sort != "") ? "&sort=" . $sort : "") . (($filter['status'] == "on") ? $filter['url'] : "") . "'><img src='images/prev.gif' border='0' width='12' height='12' title='Previous'></a>" : "<img src='images/prev.gif' border='0' width='12' height='12'>";?>
            <?echo $page . " of " . $pages;?>
            <?echo ($page < $pages) ? "<a href='index.php?editor=account&page=" . ($page + 1) . (($sort != "") ? "&sort=" . $sort : "") . (($filter['status'] == "on") ? $filter['url'] : "") . "'><img src='images/next.gif' border='0' width='12' height='12' title='Next'></a>" : "<img src='images/next.gif' border='0' width='12' height='12'>";?>
            <?echo ($page < $pages) ? "<a href='index.php?editor=account&page=" . $pages . (($sort != "") ? "&sort=" . $sort : "") . (($filter['status'] == "on") ? $filter['url'] : "") . "'><img src='images/last.gif' border='0' width='12' height='12' title='Last'></a>" : "<img src='images/last.gif' border='0' width='12' height='12'>";?>
          </td>
          <td align="right" width="33%">&nbsp;</td>
        </tr>
      </table>
    </div>
    <table class="table_content2" width="100%">
<?if (isset($accounts)):?>
      <tr>
        <td align="center"><strong><?echo ($sort == 1) ? "ID <img src='images/sort_red.bmp' border='0' width='8' height='8'>" : "<a href='index.php?editor=account&sort=1" . (($filter['status'] == "on") ? $filter['url'] : "") . "'>ID <img src='images/sort_green.bmp' border='0' width='8' height='8' title='Sort by ID'></a>";?></strong></td>
        <td align="center"><strong><?echo ($sort == 2) ? "LS ID <img src='images/sort_red.bmp' border='0' width='8' height='8'>" : "<a href='index.php?editor=account&sort=2" . (($filter['status'] == "on") ? $filter['url'] : "") . "'>LS ID <img src='images/sort_green.bmp' border='0' width='8' height='8' title='Sort by LS ID'></a>";?></strong></td>
        <td align="center"><strong><?echo ($sort == 3) ? "LS Name <img src='images/sort_red.bmp' border='0' width='8' height='8'>" : "<a href='index.php?editor=account&sort=3" . (($filter['status'] == "on") ? $filter['url'] : "") . "'>LS Name <img src='images/sort_green.bmp' border='0' width='8' height='8' title='Sort by LS Name'></a>";?></strong></td>
        <td align="center"><strong><?echo ($sort == 4) ? "Status <img src='images/sort_red.bmp' border='0' width='8' height='8'>" : "<a href='index.php?editor=account&sort=4" . (($filter['status'] == "on") ? $filter['url'] : "") . "'>Status <img src='images/sort_green.bmp' border='0' width='8' height='8' title='Sort by Status'></a>";?></strong></td>
        <td width="5%">&nbsp;</td>
      </tr>
<?
    $x=0;
    foreach($accounts as $account):?>
      <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
        <td align="center"><?=$account['id']?></td>
        <td align="center"><?=$account['lsaccount_id']?></td>
        <td align="center"><a href="index.php?editor=account&acctid=<?=$account['id']?>"><?=$account['name']?></a></td>
        <td align="center"><?=$account['status']?></td>
        <td align="right"><a href="index.php?editor=account&acctid=<?=$account['id']?>"><img src="images/edit2.gif" width="13" height="13" border="0" title="View Account"></a></td>
      </tr>
<?
      $x++;
    endforeach;
  else:
?>
      <tr>
        <td align="left" width="100" style="padding:10px;">No Accounts</td>
      </tr>
<?endif;?>
    </table>
  </div>
