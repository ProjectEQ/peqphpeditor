  <div class="edit_form" style="width: 750px">
    <div class="edit_form_header">Edit Trap</div>
    <div class="edit_form_content">
      <form name="traps" method="post" action="index.php?editor=misc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&action=21">
        <table width="100%" cellpadding="5" cellspacing="5">
          <tr>
            <td>
              <strong>ID</strong><br>
              <input type="text" size="7" value="<?=$id?>" disabled>
            </td>
            <td>
              <strong>Zone</strong><br>
              <input type="text" size="7" value="<?=$zone?>" disabled>
            </td>
            <td>
              <strong>Version</strong><br>
              <input type="text" size="7" name="version" value="<?=$version?>">
            </td>
            <td>
              <strong>X</strong><br>
              <input type="text" size="7" name="x_coord" value="<?=$x?>">
            </td>
            <td>
              <strong>Y</strong><br>
              <input type="text" size="7" name="y_coord" value="<?=$y?>">
            </td>
            <td>
              <strong>Z</strong><br>
              <input type="text" size="7" name="z_coord" value="<?=$z?>">
            </td>
          </tr>
          <tr>
            <td>
              <strong>Chance</strong><br>
              <input type="text" size="7" name="chance" value="<?=$chance?>">
            </td>
            <td>
              <strong>Max Z Diff</strong><br>
              <input type="text" size="7" name="maxzdiff" value="<?=$maxzdiff?>">
            </td>
            <td>
              <strong>Radius</strong><br>
              <input type="text" size="7" name="radius" value="<?=$radius?>">
            </td>
            <td>
              <strong>Effect</strong><br>
              <select class="left" name="effect">
<?foreach($traptype as $k => $v):?>
                <option value="<?=$k?>"<? echo ($k == $effect) ? " selected" : ""?>><?=$v?></option>
<?endforeach;?>
              </select>
            </td>
            <td>
              <strong>Effect Value</strong><br>
              <input type="text" size="7" name="effectvalue" value="<?=$effectvalue?>">
            </td>
            <td>
              <strong>Effect Value 2</strong><br>
              <input type="text" size="7" name="effectvalue2" value="<?=$effectvalue2?>">
            </td>
          </tr>
          <tr>
            <td colspan="7">
              <strong>Message</strong>
              <input type="text" size="114" name="message" value="<?=$message?>">
            </td>
          </tr>
          <tr>
            <td>
              <strong>Skill</strong><br>
              <input type="text" size="7" name="skill" value="<?=$skill?>">
            </td>
            <td>
              <strong>Level</strong><br>
              <input type="text" size="7" name="level" value="<?=$level?>">
            </td>
            <td>
              <strong><br>Respawn</strong><br>
              <input type="text" size="7" name="respawn_time" value="<?=$respawn_time?>">
            </td>
            <td>
              <strong><br>Variance</strong><br>
              <input type="text" size="7" name="respawn_var" value="<?=$respawn_var?>">
            </td>
            <td>
              <strong>Triggered<br>Number</strong><br>
              <input type="text" size="7" name="triggered_number" value="<?=$triggered_number?>">
            </td>
            <td>
              <strong><br>Group</strong><br>
              <input type="text" size="7" name="group" value="<?=$group?>">
            </td>
          </tr>
          <tr>
            <td>
              <strong>Despawn when<br>Triggered</strong><br>
              <input type="text" size="7" name="despawn_when_triggered" value="<?=$despawn_when_triggered?>">              
            </td>
            <td>
              <strong><br>Undetectable</strong><br>
              <input type="text" size="7" name="undetectable" value="<?=$undetectable?>">
            </td>
            <td>
              <strong>Min Expansion</strong><br>
              <input type="text" size="7" name="min_expansion" value="<?=$min_expansion?>">
            </td>
            <td>
              <strong>Max Expansion</strong><br>
              <input type="text" size="7" name="max_expansion" value="<?=$max_expansion?>">
            </td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2">
              <strong>Content Flags</strong><br>
              <input type="text" size="25" name="content_flags" value="<?=$content_flags?>">
            </td>
            <td colspan="2">
              <strong>Content Flags Disabled</strong><br>
              <input type="text" size="25" name="content_flags_disabled" value="<?=$content_flags_disabled?>">
            </td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table><br><br>
        <center>
          <input type="hidden" name="tid" value="<?=$id?>">
          <input type="hidden" name="zone" value="<?=$zone?>">
          <input type="submit" value="Submit Changes">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back();">
        </center>
      </form>
    </div>
  </div>
