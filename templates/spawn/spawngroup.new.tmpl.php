  <div class="edit_form" style="width:250px">
    <div class="edit_form_header"><center>Add a Spawngroup to <?=$currzone?></center></div>
    <div class="edit_form_content">
      <form method="post" action="index.php?editor=spawn&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&action=17">
        <table align="center" cellpadding="3" cellspacing="3">
          <tr>
            <td colspan="2">
              ID:<br>
              <input type="text" name="id" size="6" value="<?=$suggestedid?>">
            </td>
          </tr>
          <tr>
            <td colspan="2">
              Spawngroup Name:<br>
              <input type="text" name="name" size="15" value="<?=$currzone?>_<?=$suggestedid?>">
            </td>
          </tr>
          <tr>
            <td>
              First NPCID:<br>
              <input type="text" name="npcID" size="5" value="<?=$npcid?>">
            </td>
            <td>
              Chance:<br>
              <input type="text" name="chance" size="2" value="100">%
            </td>
          </tr>
          <tr>
            <td>
              Condition Value Filter:<br>
              <input type="text" name="condition_value_filter" size="5" value="1">
            </td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>
              Min Expansion:<br>
              <input type="text" name="min_expansion" size="10" value="-1">
            </td>
            <td>
              Max Expansion:<br>
              <input type="text" name="max_expansion" size="10" value="-1">
            </td>
          </tr>
          <tr>
            <td colspan="2">
              Content Flags:<br>
              <input type="text" name="content_flags" size="26" value="">
            </td>
          </tr>
          <tr>
            <td colspan="2">
              Content Flags Disabled:<br>
              <input type="text" name="content_flags_disabled" size="26" value="">
            </td>
          </tr>
          <tr>
            <td>
              spawn_limit:<br>
              <input type="text" name="spawn_limit" size="6" value="0">
            </td>
            <td>
              dist:<br>
              <input type="text" name="dist" size="5" value="0">
            </td>
          </tr>
          <tr>
            <td>
              mindelay:<br>
              <input type="text" name="mindelay" size="5" value="15000">
            </td>
            <td>
              delay:<br>
              <input type="text" name="delay" size="5" value="45000">
            </td>
          </tr>
          <tr>
            <td>
              max_x:<br>
              <input type="text" name="max_x" size="5" value="0">
            </td>
            <td>
              min_x:<br>
              <input type="text" name="min_x" size="5" value="0">
            </td>
          </tr>
          <tr>
            <td>
              max_y:<br>
              <input type="text" name="max_y" size="5" value="0">
            </td>
            <td>
              min_y:<br>
              <input type="text" name="min_y" size="5" value="0">
            </td>
          </tr>
          <tr>
            <td colspan="2">
              despawn:<br>
              <select name="despawn" style="width: 160px;">
<?foreach($despawntype as $key=>$value):?>
                <option value="<?=$key?>"><?=$key?>: <?=$value?></option>
<?endforeach;?>
              </select>
            </td>
          </tr>
          <tr>
            <td>
              despawn timer:<br>
              <input type="text" name="despawn_timer" size="5" value="100">
            </td>
            <td>
              wp_spawns:<br>
              <input type="text" name="wp_spawns" size="5" value="0">
            </td>
          </tr>
        </table><br><br>
        <center>
          <input type="submit" name="submit" value="Submit">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back();">
        </center>
      </form>
    </div>
  </div>
