  <center>
    <table>
      <tr>
        <td style="background-color: #CCC; border: 1px solid black; padding: 5px;">
          <a href="index.php?editor=spawn&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&sid=<?=$sid?>&action=14">Add a spawnpoint to this Spawngroup</a>
        </td>
      </tr>
    </table>
  </center><br><br>
<?if($spawnpoints != ''):?>
<?foreach($spawnpoints as $sp): extract($sp);?>
  <div style="border: 1px solid black; margin-bottom: 15px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td>
            Spawnpoint ID: <?=$id?> <a href="index.php?editor=spawn&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&sid=<?=$sid?>&spid=<?=$id?>&action=35">spawn status</a></td>
          </td>
          <td align="right">
            <a href="index.php?editor=spawn&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>">View Spawngroups for this spawnpoint</a>&nbsp;
            <a href="index.php?editor=spawn&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&spid=<?=$id?>&sid=<?=$sid?>&action=18"><img src="images/add.gif" border="0" title="Add a grid to this Spawnpoint"></a>&nbsp;
            <a href="index.php?editor=spawn&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&id=<?=$id?>&action=11"><img src="images/c_table.gif" border="0" title="Edit this Spawnpoint"></a>&nbsp;
            <a href="index.php?editor=spawn&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&id=<?=$id?>&action=50"><img src="images/last.gif" border="0" title="Copy this Spawnpoint"></a>&nbsp;
            <a href="index.php?editor=spawn&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&id=<?=$id?>&action=52"><img src="images/next.gif" border="0" title="Move this Spawnpoint"></a>&nbsp;
            <a onClick="return confirm('Really delete this spawnpoint?');" href="index.php?editor=spawn&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&sid=<?=$sid?>&id=<?=$id?>&action=13"><img src="images/table.gif" border="0" title="Delete this Spawnpoint"></a>
          </td>
        </tr>
      </table>
    </div>
    <div class="edit_form_content">
      <table width="100%">
        <tr>
          <td width="33%">X: <?=$x?></td>
          <td width="33%">Y: <?=$y?></td>
          <td width="34%">Z: <?=$z?></td>
        </tr>
        <tr>
          <td width="33%">Heading: <?=$heading?></td>
          <td width="33%">Respawn: <?=$respawntime?>s</td>
          <td width="34%">Variance: <?=$variance?>s</td>
        </tr>
        <tr>
<?if($pathgrid > 0):?>
          <td width="33%">Pathgrid: <a href="index.php?editor=spawn&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&spid=<?=$id?>&pathgrid=<?=$pathgrid?>&action=20"><?=$pathgrid?></td>
<?endif;?>
<?if($pathgrid < 1):?>
          <td width="33%">Pathgrid: <?=$pathgrid?></td>
<?endif;?>
<?if($_condition > 0):?>
          <td width="33%">Condition: <a href="index.php?editor=spawn&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&spid=<?=$id?>&action=36"><?=$_condition?></td>
<?endif;?>
<?if($_condition < 1):?>
          <td width="33%">Condition: <?=$_condition?></td>
<?endif;?>
          <td width="34%">Cond Value: <?=$cond_value?></td>
        </tr>
        <tr>
          <td width="33%">Version: <?=$version?></td>
          <td width="33%">Enabled: <?=$enabled?></td>
          <td width="33%">Animation: <?=$animations[$animation]?></td>
        </tr>
        <tr>
          <td width="33%">Zone: <?=$zone?></td>
          <td width="33%">&nbsp;</td>
          <td width="33%">&nbsp;</td>
        </tr>
      </table>
    </div>
  </div>
<?endforeach;?>
<?endif;?>
<?if($spawnpoints == ''):?>
  <div class="table_container">
    <div class="edit_form_header">
      Spawnpoints
    </div>
    <div class="table_content">
      No Spawnpoints assigned to this spawngroup
    </div>
  </div>
<?endif;?>
