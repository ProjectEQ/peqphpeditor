  <div class="edit_form" style="width: 550px">
    <div class="edit_form_header">
      Add Beastlord Pet Data
    </div>
    <div class="edit_form_content">
      <form name="addbeastlordpet" method="post" action="index.php?editor=npc&action=87">
        <table width="100%" cellpadding="3" cellspacing="3">
          <tr>
            <td>
              <strong>Player Race:</strong><br>
              <select name="player_race">
<? foreach ($races as $k=>$v): ?>
                <option value="<?=$k?>"<?echo ($k == 1) ? " selected" : "";?>><?=$v?> (<?=$k?>)</option>
<? endforeach; ?>
              </select>
            </td>
            <td>
              <strong>Pet Race:</strong><br>
              <select name="pet_race">
<? foreach ($races as $k=>$v): ?>
                <option value="<?=$k?>"<?echo ($k == 42) ? " selected" : "";?>><?=$v?> (<?=$k?>)</option>
<? endforeach; ?>
              </select>
            </td>
          </tr>
          <tr>
            <td>
              <strong>Texture:</strong><br>
              <input type="text" name="texture" size="10" value="0">
            </td>
            <td>
              <strong>Helm Texture:</strong><br>
              <input type="text" name="helm_texture" size="10" value="0">
            </td>
          </tr>
          <tr>
            <td>
              <strong>Gender:</strong><br>
              <select name="gender">
<? foreach ($genders as $k=>$v): ?>
                <option value="<?=$k?>"<?echo ($k == 2) ? " selected" : "";?>><?=$v?> (<?=$k?>)</option>
<? endforeach; ?>
              </select>
            </td>
            <td>
              <strong>Size Modifier:</strong><br>
              <input type="text" name="size_modifier" size="10" value="1">
            </td>
          </tr>
          <tr>
            <td>
              <strong>Face:</strong><br>
              <input type="text" name="face" size="10" value="0">
            </td>
            <td>&nbsp;</td>
          </tr>
        </table><br><br>
        <center>
          <input type="submit" name="submit" value="Add Beastlord Pet">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back();">
        </center>
      </form>
    </div>
  </div>
