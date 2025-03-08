  <div class="edit_form" style="width: 500px;">
    <div class="edit_form_header">Add Horse</div>
    <div class="edit_form_content">
      <form name="horse_add" method="post" action="index.php?editor=misc&z=<?echo (isset($currzone)) ? $currzone : "";?>&zoneid=<?echo (isset($currzoneid)) ? $currzoneid : "";?>&action=34">
        <table width="100%" cellpadding="3" cellspacing="3">
          <tr>
            <td><strong>Filename:</strong><br><input type="text" size="33" name="filename" value=""></td>
            <td><strong>Texture:</strong><br><input type="text" size="7" name="texture" value="0"></td>
            <td><strong>Helm:</strong><br><input type="text" size="7" name="helmtexture" value="-1"></td>
          </tr>
          <tr>
            <td>
              <strong>Race:</strong><br>
              <select name="race">
<?foreach($races as $key=>$value):?>
                <option value="<?=$key?>"><?=$key?>: <?=$value?></option>
<?endforeach;?>
              </select>
            </td>
            <td><strong>Speed:</strong><br><input type="text" size="7" name="mountspeed" value="1"></td>
            <td>
              <strong>Gender:</strong><br>
              <select name="gender">
<?foreach($genders as $key=>$value):?>
                <option value="<?=$key?>"><?=$value?></option>
<?endforeach;?>
              </select>
            </td>
          </tr>
          <tr>
            <td><strong>Notes:</strong><br><input type="text" size="33" name="notes" value=""></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table><br><br>
        <center>
          <input type="submit" value="Add Horse">&nbsp;&nbsp;<input type="button" value="Cancel" onClick="history.back();">
        </center>
      </form>
    </div>
  </div>
