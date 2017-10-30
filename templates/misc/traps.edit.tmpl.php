  <div class="edit_form" style="width: 750px">
    <div class="edit_form_header">Edit Trap: <?=$id?></div>
    <div class="edit_form_content">
      <form name="traps" method="post" action="index.php?editor=misc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&action=21">
        <table width="100%" cellpadding="5" cellspacing="0">
          <tr>
            <td align="center">
              <strong>id</strong><br>
              <input type="text" size="7" value="<?=$id?>" disabled>
            </td>
            <td align="center">
              <strong>zone</strong><br>
              <input type="text" size="7" value="<?=$zone?>" disabled>
            </td>
            <td align="center">
              <strong>version</strong><br>
              <input type="text" size="7" name="version" value="<?=$version?>">
            </td>
            <td align="center">
              <strong>x</strong><br>
              <input type="text" size="7" name="x_coord" value="<?=$x?>">
            </td>
            <td align="center">
              <strong>y</strong><br>
              <input type="text" size="7" name="y_coord" value="<?=$y?>">
            </td>
            <td align="center">
              <strong>z</strong><br>
              <input type="text" size="7" name="z_coord" value="<?=$z?>">
            </td>
            <td align="center">
              <strong>maxzdiff</strong><br>
              <input type="text" size="7" name="maxzdiff" value="<?=$maxzdiff?>">
            </td>
          </tr>
          <tr>
            <td align="center">
              <strong>level</strong><br>
              <input type="text" size="7" name="level" value="<?=$level?>">
            </td>
            <td align="center">
              <strong>skill</strong><br>
              <input type="text" size="7" name="skill" value="<?=$skill?>">
            </td>
            <td align="center">
              <strong>radius</strong><br>
              <input type="text" size="7" name="radius" value="<?=$radius?>">
            </td>
            <td align="center">
              <strong>respawn</strong><br>
              <input type="text" size="7" name="respawn_time" value="<?=$respawn_time?>">
            </td>
            <td align="center">
              <strong>effectvalue</strong><br>
              <input type="text" size="7" name="effectvalue" value="<?=$effectvalue?>">
            </td>
            <td align="center">
              <strong>effectvalue2</strong><br>
              <input type="text" size="7" name="effectvalue2" value="<?=$effectvalue2?>">
            </td>
            <td align="center">
              <strong>effect</strong><br>
              <select class="left" name="effect">
<?foreach($traptype as $k => $v):?>
                <option value="<?=$k?>"<? echo ($k == $effect) ? " selected" : ""?>><?=$v?></option>
<?endforeach;?>
              </select>
            </td>
          </tr>
          <tr>
            <td colspan="7" align="center">
              <strong>message</strong>
              <input type="text" size="114" name="message" value="<?=$message?>">
            </td>
          </tr>
          <tr>
            <td align="center">
              <strong><br>chance</strong><br>
              <input type="text" size="7" name="chance" value="<?=$chance?>">
            </td>
            <td align="center">
              <strong><br>variance</strong><br>
              <input type="text" size="7" name="respawn_var" value="<?=$respawn_var?>">
            </td>
            <td align="center">
              <strong>triggered<br>number</strong><br>
              <input type="text" size="7" name="triggered_number" value="<?=$triggered_number?>">
            </td>
            <td align="center">
              <strong><br>group</strong><br>
              <input type="text" size="7" name="group" value="<?=$group?>">
            </td>
            <td align="center">
              <strong>despawn when<br>triggered</strong><br>
              <input type="text" size="7" name="despawn_when_triggered" value="<?=$despawn_when_triggered?>">              
            </td>
            <td align="center">
              <strong><br>undetectable</strong><br>
              <input type="text" size="7" name="undetectable" value="<?=$undetectable?>">
            </td>
            <td>&nbsp;</td>
          </tr>
        </table><br><br>
        <center>
          <input type="hidden" name="tid" value="<?=$id?>">
          <input type="hidden" name="zone" value="<?=$currzone?>">
          <input type="submit" value="Submit Changes">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back();">
        </center>
      </form>
    </div>
  </div>
