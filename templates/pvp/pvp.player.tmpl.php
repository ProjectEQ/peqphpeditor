  <div class="table_container" style="width: 550px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td><?=getPlayerName($playerPVP['id'])?>'s PVP Stats</td>
          <td align="right"><a href="index.php?editor=pvp&action=1">View Leaderboard</a></td>
        </tr>
      </table>
    </div>
    <table class="table_content" width="100%" cellpadding="3" cellspacing="0">
      <tr>
        <td><br><strong>Current Points:</strong> <a href="index.php?editor=pvp&playerid=<?=$playerPVP['id']?>&action=3"><?=$playerPVP['pvp_current_points']?></a><br><br></td>
        <td><br><strong>Career Points:</strong> <?=$playerPVP['pvp_career_points']?><br><br></td>
        <td><br>&nbsp;</td>
      </tr>
      <tr>
        <td><strong>Kills:</strong> <?=$playerPVP['pvp_kills']?><br><br></td>
        <td><strong>Current Kill Streak:</strong> <?=$playerPVP['pvp_current_kill_streak']?><br><br></td>
        <td><strong>Best Kill Streak:</strong> <?=$playerPVP['pvp_best_kill_streak']?><br><br></td>
      </tr>
      <tr>
        <td><strong>Deaths:</strong> <?=$playerPVP['pvp_deaths']?><br><br></td>
        <td><strong>Worst Death Streak:</strong> <?=$playerPVP['pvp_worst_death_streak']?><br><br></td>
        <td>&nbsp;</td>
      </tr>
    </table>
  </div>
