  <div class="edit_form" style="width: 500px;">
    <div class="edit_form_header">Edit Horse <?=$horse['filename']?></div>
    <div class="edit_form_content">
      <form name="horse_edit" method="post" action="index.php?editor=misc&z=<?echo (isset($currzone)) ? $currzone : "";?>&zoneid=<?echo (isset($currzoneid)) ? $currzoneid : "";?>&action=31">
        <table width="100%" cellpadding="3" cellspacing="3">
          <tr>
            <td><strong>Filename:</strong><br><input type="text" size="33" name="filenamea" value="<?=$horse['filename']?>"></td>
            <td><strong>Texture:</strong><br><input type="text" size="7" name="texture" value="<?=$horse['texture']?>"></td>
            <td><strong>Helm:</strong><br><input type="text" size="7" name="helmtexture" value="<?=$horse['helmtexture']?>"></td>
          </tr>
          <tr>
            <td>
              <strong>Race:</strong><br>
              <select name="race">
<?foreach($races as $key=>$value):?>
                <option value="<?=$key?>"<?echo ($key == $horse['race'])? " selected" : "";?>><?=$key?>: <?=$value?></option>
<?endforeach;?>
              </select>
            </td>
            <td><strong>Speed:</strong><br><input type="text" size="7" name="mountspeed" value="<?=$horse['mountspeed']?>"></td>
            <td>
              <strong>Gender:</strong><br>
              <select name="gender">
<?foreach($genders as $key=>$value):?>
                <option value="<?=$key?>"<?echo ($key == $horse['gender'])? " selected" : "";?>><?=$value?></option>
<?endforeach;?>
              </select>
            </td>
          </tr>
          <tr>
            <td><strong>Notes:</strong><br><input type="text" size="33" name="notes" value="<?=$horse['notes']?>"></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table><br><br>
        <center>
          <input type="hidden" name="filename" value="<?=$horse['filename']?>">
          <input type="submit" value="Submit Changes">&nbsp;&nbsp;<input type="button" value="Cancel" onClick="history.back();">
        </center>
      </form>
    </div>
  </div>
