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
          <td>Spawnpoint Info [<a href="index.php?editor=spawn&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&sid=<?=$sid?>&spid=<?=$id?>&action=35">Check Spawn Status</a>]</td>
          <td align="right">
            <a href="index.php?editor=spawn&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>">View spawngroups for this spawnpoint</a>&nbsp;
<?if ($pathgrid == 0):?>
            <a href="index.php?editor=spawn&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&spid=<?=$id?>&sid=<?=$sid?>&action=18"><img src="images/add.gif" border="0" title="Add a Grid to this Spawnpoint"></a>&nbsp;
<?endif;?>
            <a href="index.php?editor=spawn&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&id=<?=$id?>&action=11"><img src="images/c_table.gif" border="0" title="Edit this Spawnpoint"></a>&nbsp;
            <a href="index.php?editor=spawn&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&id=<?=$id?>&action=50"><img src="images/last.gif" border="0" title="Copy this Spawnpoint"></a>&nbsp;
            <a href="index.php?editor=spawn&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&id=<?=$id?>&action=52"><img src="images/next.gif" border="0" title="Move this Spawnpoint"></a>&nbsp;
            <a onClick="return confirm('Really delete this spawnpoint?');" href="index.php?editor=spawn&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&sid=<?=$sid?>&id=<?=$id?>&action=13"><img src="images/table.gif" border="0" title="Delete this Spawnpoint"></a>
          </td>
        </tr>
      </table>
    </div>
    <div class="edit_form_content">
      <table width="100%" cellpadding="3" cellspacing="3">
        <tr>
          <td><strong>ID:</strong> <?=$id?></td>
          <td><strong>Spawngroup ID:</strong> <?=$spawngroupID?></td>
          <td><strong>Zone:</strong> <?=$zone?></td>
          <td><strong>Version:</strong> <?=$version?></td>
        </tr>
        <tr>
          <td><strong>X:</strong> <?=$x?></td>
          <td><strong>Y:</strong> <?=$y?></td>
          <td><strong>Z:</strong> <?=$z?></td>
          <td><strong>Heading:</strong> <?=$heading?></td>
        </tr>
        <tr>
          <td><strong>Respawn:</strong> <?=$respawntime?>s</td>
          <td><strong>Variance:</strong> <?=$variance?>s</td>
          <td><strong>Condition:</strong> <?=$_condition?><?echo ($_condition > 0) ? " [<a href='index.php?editor=spawn&z=$currzone&zoneid=$currzoneid&npcid=$npcid&spid=$id&action=36'>View</a>]" : "";?></td>
          <td><strong>Cond Value:</strong> <?=$cond_value?></td>
        </tr>
        <tr>
          <td><strong>Pathgrid:</strong> <?=$pathgrid?><?echo ($pathgrid > 0) ? " [<a href='index.php?editor=spawn&z=$currzone&zoneid=$currzoneid&npcid=$npcid&spid=$id&pathgrid=$pathgrid&action=20'>View</a>]" : "";?></td>
          <td><strong>Idle Zone Pathing:</strong> <?echo ($path_when_zone_idle == 1) ? "Y" : "N";?></td>
          <td><strong>Enabled:</strong> <?echo ($disabled == 0) ? "Y" : "N";?></td>
          <td align="left"><strong>Animation:</strong> <?=$animations[$animation]?></td>
        </tr>
        <tr>
          <td><strong>Min Expansion:</strong> <?=$min_expansion?></td>
          <td><strong>Max Expansion:</strong> <?=$max_expansion?></td>
          <td><strong>Disabled Instance:</strong> <?=$instance_id?></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2"><strong>Content Flags:</strong> <?echo ($content_flags != "") ? $content_flags : "None";?></td>
          <td colspan="2"><strong>Content Flags Disabled:</strong> <?echo ($content_flags_disabled != "") ? $content_flags_disabled : "None";?></td>
        </tr>
      </table>
    </div>
  </div>
<?endforeach;?>
<?endif;?>
<?if($spawnpoints == ''):?>
  <div class="table_container">
    <div class="edit_form_header">Spawnpoints</div>
    <div class="table_content">No Spawnpoints assigned to this spawngroup</div>
  </div>
<?endif;?>
