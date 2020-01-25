  <div class="edit_form" style="width:250px">
    <div class="edit_form_header">Spawngroup <?=$sid?></div>
    <div class="edit_form_content">
      <form method="post" action="index.php?editor=spawn&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&sid=<?=$sid?>&action=5">
        <table align="center" cellpadding="3" cellspacing="3">
          <tr>
            <td colspan="2">
              Spawngroup Name:<br>
              <input type="text" name="name" size="15" value="<?=$name?>">
            </td>
          </tr>
          <tr>
            <td>
              spawn_limit:<br>
              <input type="text" name="spawn_limit" size="6" value="<?=$spawn_limit?>">
            </td>
            <td>
              dist:<br>
              <input type="text" name="dist" size="5" value="<?=$dist?>">
            </td>
          </tr>
          <tr>
            <td>
              mindelay:<br>
              <input type="text" name="mindelay" size="5" value="<?=$mindelay?>">
            </td>
            <td>
              delay:<br>
              <input type="text" name="delay" size="5" value="<?=$delay?>">
            </td>
          </tr>
          <tr>
            <td>
              max_x:<br>
              <input type="text" name="max_x" size="5" value="<?=$max_x?>">
            </td>
            <td>
              min_x:<br>
              <input type="text" name="min_x" size="5" value="<?=$min_x?>">
            </td>
          </tr>
          <tr>
            <td>
              max_y:<br>
              <input type="text" name="max_y" size="5" value="<?=$max_y?>">
            </td>
            <td>
              min_y:<br>
              <input type="text" name="min_y" size="5" value="<?=$min_y?>">
            </td>
          </tr>
          <tr>
            <td colspan="2">
              despawn:<br>
              <select name="despawn" style="width: 160px;">
<?foreach($despawntype as $key=>$value):?>
                <option value="<?=$key?>"<?echo ($key == $despawn)? " selected" : "";?>><?=$key?>: <?=$value?></option>
<?endforeach;?>
              </select>
            </td>
          </tr>
          <tr>
            <td>
              despawn timer:<br>
              <input type="text" name="despawn_timer" size="5" value="<?=$despawn_timer?>">
            </td>
            <td>
              wp_spawns:<br>
              <input type="text" name="wp_spawns" size="5" value="<?=$wp_spawns?>">
            </td>
          </tr>
        </table><br><br>
        <center><input type="submit" name="submit" value="Submit Changes"></center>
      </form>
    </div>
  </div>
