      <center>
        <table>
          <tr>
            <td style="background-color: #CCC; border: 1px solid black; padding: 5px;">
              <a href="index.php?editor=spawn&z=<?=$currzone?>&npcid=<?=$npcid?>&sid=<?=$sid?>&action=14">Add a spawnpoint to this Spawngroup</a>
            </td>
          </tr>
        </table>
	  </center><br><br>
<?if($spawnpoints != ''):?>
<?foreach($spawnpoints as $sp): extract($sp);?>
      <div class="edit_form" style="margin-bottom: 15px">
      <div class="edit_form_header" style="padding: 0px;">
        <table width="100%">
          <tr>
            <td>
              Spawnpoint ID: <?=$id?>
            </td>
            <td align="right">
              <a href="index.php?editor=spawn&z=<?=$currzone?>&npcid=<?=$npcid?>&id=<?=$id?>&action=11"><img src="images/c_table.gif" border="0" title="Edit this Spawnpoint"></a>&nbsp;
              <a onClick="return confirm('Really delete this spawnpoint?');" href="index.php?editor=spawn&z=<?=$currzone?>&npcid=<?=$npcid?>&sid=<?=$sid?>&id=<?=$id?>&action=13"><img src="images/table.gif" border="0" title="Delete this Spawnpoint"></a>
            </td>
          </tr>
        </table>
      </div>

      <div class="edit_form_content">
        <table width="100%">
          <tr>
            <td width="33%">x: <?=$x?></td>
            <td width="33%">y: <?=$y?></td>
            <td width="34%">z: <?=$z?></td>
          </tr>
          <tr>
            <td width="33%">respawn: <?=$respawntime?></td>
            <td width="33%">pathgrid: <?=$pathgrid?></td>
            <td width="34%">timeleft: <?=$timeleft?></td>
          </tr>
          <tr>
            <td width="33%">heading: <?=$heading?></td>
            <td width="33%">variance: <?=$variance?></td>
            <td width="34%">condition: <?=$_condition?></td>
          </tr>
          <tr>
            <td width="33%">cond_value: <?=$cond_value?></td>
            <td width="33%">&nbsp;</td>
            <td width="34%">&nbsp;</td>
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