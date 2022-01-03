  <div class="edit_form" style="width: 750px">
    <div class="edit_form_header">Add Trap</div>
    <div class="edit_form_content">
      <form name="traps" method="post" action="index.php?editor=misc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&action=24">
        <table width="100%" cellpadding="5" cellspacing="5">
          <tr>
            <td>
              <strong>ID</strong><br>
              <input type="text" size="7" name="tid" value="<?=$suggesttid?>">
            </td>
            <td>
              <strong>Zone</strong><br>
              <input type="text" size="7" name="zone" value="<?=$currzone?>">
            </td>
            <td>
              <strong>Version</strong><br>
              <input type="text" size="7" name="version" value="<?=$suggestver?>">
            </td>
            <td>
              <strong>X</strong><br>
              <input type="text" size="7" name="x_coord" value="0">
            </td>
            <td>
              <strong>Y</strong><br>
              <input type="text" size="7" name="y_coord" value="0">
            </td>
            <td>
              <strong>Z</strong><br>
              <input type="text" size="7" name="z_coord" value="0">
            </td>
          </tr>
          <tr>
            <td>
              <strong>Chance</strong><br>
              <input type="text" size="7" name="chance" value="0">
            </td>
            <td>
              <strong>Max Z Diff</strong><br>
              <input type="text" size="7" name="maxzdiff" value="0">
            </td>
            <td>
              <strong>Radius</strong><br>
              <input type="text" size="7" name="radius" value="0">
            </td>
            <td>
              <strong>Effect</strong><br>
              <select class="left" name="effect">
<?foreach($traptype as $k => $v):?>
                <option value="<?=$k?>"><?=$v?></option>
<?endforeach;?>
              </select>
            </td>
            <td>
              <strong>Effect Value</strong><br>
              <input type="text" size="7" name="effectvalue" value="0">
            </td>
            <td>
              <strong>Effect Value 2</strong><br>
              <input type="text" size="7" name="effectvalue2" value="0">
            </td>
          </tr>
          <tr>
            <td colspan="7">
              <strong>Message</strong>
              <input type="text" size="114" name="message" value="">
            </td>
          </tr>
          <tr>
            <td>
              <strong><br>Skill</strong><br>
              <input type="text" size="7" name="skill" value="0">
            </td>
            <td>
              <strong><br>Level</strong><br>
              <input type="text" size="7" name="level" value="1">
            </td>
            <td>
              <strong><br>Respawn</strong><br>
              <input type="text" size="7" name="respawn_time" value="60">
            </td>
            <td>
              <strong><br>Variance</strong><br>
              <input type="text" size="7" name="respawn_var" value="0">
            </td>
            <td>
              <strong>Triggered<br>Number</strong><br>
              <input type="text" size="7" name="triggered_number" value="0">
            </td>
            <td>
              <strong><br>Group</strong><br>
              <input type="text" size="7" name="group" value="0">
            </td>
          </tr>
          <tr>
            <td>
              <strong>Despawn when<br>Triggered</strong><br>
              <input type="text" size="7" name="despawn_when_triggered" value="0">              
            </td>
            <td>
              <strong><br>Undetectable</strong><br>
              <input type="text" size="7" name="undetectable" value="0">
            </td>
            <td>
              <strong><br>Min Expansion</strong><br>
              <input type="text" size="7" name="min_expansion" value="-1">
            </td>
            <td>
              <strong><br>Max Expansion</strong><br>
              <input type="text" size="7" name="max_expansion" value="-1">
            </td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2">
              <strong>Content Flags</strong><br>
              <input type="text" size="25" name="content_flags" value="">
            </td>
            <td colspan="2">
              <strong>Content Flags Disabled</strong><br>
              <input type="text" size="25" name="content_flags_disabled" value="">
            </td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table><br><br>
        <center>
          <input type="submit" value="Add Trap">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back();">
        </center>
      </form>
    </div>
  </div>
