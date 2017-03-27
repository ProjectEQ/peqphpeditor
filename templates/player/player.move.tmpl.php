  <table class="edit_form">
    <tr>
      <td class="edit_form_header">Player Move Tool</td>
    </tr>
    <tr>
      <td class="edit_form_content">
        <form name="move_player" method="post" action="index.php?editor=player&playerid=<?=$playerid?>&action=6">
          New Zone:<br>
          <select name="zoneid" onChange="clear_coords();">
<? foreach ($zonelist as $zone): ?>
            <option value="<?=$zone['zoneidnumber'] . "." . $zone['version']?>"<?echo (($cur_loc['zone_id'] == $zone['zoneidnumber']) && ($cur_loc['zone_instance'] == $zone['version'])) ? " selected" : "";?>><?=$zone['short_name']?> (<?=$zone['version']?>)</option>
<? endforeach; ?>
          </select><br><br>
          Use Safe Zone Coords: <input type="checkbox" id="safe" name="safe" onChange="toggle_safe();" checked><br><br>
          New X: <input type="text" id="x" name="x" value="<?=$cur_loc['x']?>" size="10" disabled><br><br>
          New Y: <input type="text" id="y" name="y" value="<?=$cur_loc['y']?>" size="10" disabled><br><br>
          New Z: <input type="text" id="z" name="z" value="<?=$cur_loc['z']?>" size="10" disabled><br><br><br>
          <input type="hidden" name="playerid" value="<?=$playerid?>">
          <center>
            <input type="submit" value="Move Player">&nbsp;&nbsp;
            <input type="button" value="Cancel" onClick="history.back();">
          </center>
        </form>
      </td>
    </tr>
  </table>
