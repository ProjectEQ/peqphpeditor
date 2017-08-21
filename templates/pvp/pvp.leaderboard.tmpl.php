  <div class="table_container" style="width: 500px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td>PVP Leaderboard</td>
        </tr>
      </table>
    </div>
    <table class="table_content2" width="100%">
<?if (isset($pvp_stats)):?>
      <tr>
        <td align="center" width="30%"><strong>Player</strong></td>
        <td align="center" width="20%"><strong>Current Points</strong></td>
        <td align="center" width="20%"><strong>Kills</strong></td>
        <td align="center" width="20%"><strong>Deaths</strong></td>
        <td width="10%">&nbsp;</td>
      </tr>
<?$x=0;
foreach($pvp_stats as $pvp_stat):?>
      <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
        <td align="center" width="30%"><?=getPlayerName($pvp_stat['id'])?> (<?=$pvp_stat['id']?>)</td>
        <td align="center" width="20%"><?=$pvp_stat['pvp_current_points']?></td>
        <td align="center" width="20%"><?=$pvp_stat['pvp_kills']?></td>
        <td align="center" width="20%"><?=$pvp_stat['pvp_deaths']?></td>
        <td align="right" width="10%"><a href="index.php?editor=pvp&playerid=<?=$pvp_stat['id']?>&action=2"><img src="images/view_tbl.png" width="13" height="13" border="0" title="View Player PVP Stats"></a></td>
      </tr>
<?$x++;
endforeach;
else:?>
      <tr>
        <td align="left" width="100%" style="padding: 10px;">No PVP data</td>
      </tr>
<?endif;?>
    </table>
  </div>
