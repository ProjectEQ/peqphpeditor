  <div class="edit_form" style="width: 750px">
    <div class="edit_form_header">Add Trap</div>
    <div class="edit_form_content">
      <form name="traps" method="post" action="index.php?editor=misc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&action=24">
        <table width="100%" cellpadding="5" cellspacing="0">
          <tr>
            <td align="center">
              <strong>id</strong><br>
              <input type="text" size="7" name="tid" value="<?=$suggesttid?>">
            </td>
            <td align="center">
              <strong>zone</strong><br>
              <input type="text" size="7" name="zone" value="<?=$currzone?>">
            </td>
            <td align="center">
              <strong>version</strong><br>
              <input type="text" size="7" name="version" value="<?=$suggestver?>">
            </td>
            <td align="center">
              <strong>x</strong><br>
              <input type="text" size="7" name="x_coord" value="0">
            </td>
            <td align="center">
              <strong>y</strong><br>
              <input type="text" size="7" name="y_coord" value="0">
            </td>
            <td align="center">
              <strong>z</strong><br>
              <input type="text" size="7" name="z_coord" value="0">
            </td>
            <td align="center">
              <strong>maxzdiff</strong><br>
              <input type="text" size="7" name="maxzdiff" value="0">
            </td>
          </tr>
          <tr>
            <td align="center">
              <strong>level</strong><br>
              <input type="text" size="7" name="level" value="1">
            </td>
            <td align="center">
              <strong>skill</strong><br>
              <input type="text" size="7" name="skill" value="0">
            </td>
            <td align="center">
              <strong>radius</strong><br>
              <input type="text" size="7" name="radius" value="0">
            </td>
            <td align="center">
              <strong>respawn</strong><br>
              <input type="text" size="7" name="respawn_time" value="60">
            </td>
            <td align="center">
              <strong>effectvalue</strong><br>
              <input type="text" size="7" name="effectvalue" value="0">
            </td>
            <td align="center">
              <strong>effectvalue2</strong><br>
              <input type="text" size="7" name="effectvalue2" value="0">
            </td>
            <td align="center">
              <strong>effect</strong><br>
              <select class="left" name="effect">
<?foreach($traptype as $k => $v):?>
                <option value="<?=$k?>"<? echo ($k == $effect) ? " selected" : ""?>><?=$v?></option>
<?$x++; endforeach;?>
              </select>
            </td>
          </tr>
          <tr>
            <td colspan="7" align="center">
              <strong>message</strong>
              <input type="text" size="114" name="message" value="">
            </td>
          </tr>
          <tr>
            <td align="center">
              <strong><br>chance</strong><br>
              <input type="text" size="7" name="chance" value="0">
            </td>
            <td align="center">
              <strong><br>variance</strong><br>
              <input type="text" size="7" name="respawn_var" value="0">
            </td>
            <td align="center">
              <strong>triggered<br>number</strong><br>
              <input type="text" size="7" name="triggered_number" value="0">
            </td>
            <td align="center">
              <strong><br>group</strong><br>
              <input type="text" size="7" name="group" value="0">
            </td>
            <td align="center">
              <strong>despawn when<br>triggered</strong><br>
              <input type="text" size="7" name="despawn_when_triggered" value="0">              
            </td>
            <td align="center">
              <strong><br>undetectable</strong><br>
              <input type="text" size="7" name="undetectable" value="0">
            </td>
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
