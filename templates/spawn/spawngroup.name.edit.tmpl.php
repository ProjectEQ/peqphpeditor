  <div class="edit_form" style="width:350px">
    <div class="edit_form_header">Spawngroup <?=$sid?></div>
    <div class="edit_form_content">
      <form method="post" action="index.php?editor=spawn&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&sid=<?=$sid?>&action=5">
        <table align="center" cellpadding="3" cellspacing="3">
          <tr>
            <td colspan="2">
              Spawngroup Name:<br>
              <input type="text" name="name" size="40" value="<?=$name?>">
            </td>
          </tr>
          <tr>
            <td>
              spawn_limit:<br>
              <input type="text" name="spawn_limit" size="10" value="<?=$spawn_limit?>">
            </td>
            <td>
              dist:<br>
              <input type="text" name="dist" size="10" value="<?=$dist?>">
            </td>
          </tr>
          <tr>
            <td>
              mindelay:<br>
              <input type="text" name="mindelay" size="10" value="<?=$mindelay?>">
            </td>
            <td>
              delay:<br>
              <input type="text" name="delay" size="10" value="<?=$delay?>">
            </td>
          </tr>
          <tr>
            <td>
              min_x:<br>
              <input type="text" name="min_x" size="10" value="<?=$min_x?>">
            </td>
            <td>
              max_x:<br>
              <input type="text" name="max_x" size="10" value="<?=$max_x?>">
            </td>
          </tr>
          <tr>
            <td>
              min_y:<br>
              <input type="text" name="min_y" size="10" value="<?=$min_y?>">
            </td>
            <td>
              max_y:<br>
              <input type="text" name="max_y" size="10" value="<?=$max_y?>">
            </td>
          </tr>
          <tr>
            <td colspan="2">
              despawn:<br>
              <select name="despawn">
<?foreach($despawntype as $key=>$value):?>
                <option value="<?=$key?>"<?echo ($key == $despawn)? " selected" : "";?>><?=$key?>: <?=$value?></option>
<?endforeach;?>
              </select>
            </td>
          </tr>
          <tr>
            <td>
              despawn timer:<br>
              <input type="text" name="despawn_timer" size="10" value="<?=$despawn_timer?>">
            </td>
            <td>
              wp_spawns:<br>
              <input type="text" name="wp_spawns" size="10" value="<?=$wp_spawns?>">
            </td>
          </tr>
        </table><br><br>
        <center>
          <input type="submit" name="submit" value="Submit Changes">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back();">
        </center>
      </form>
    </div>
  </div>
