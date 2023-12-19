  <div class="edit_form" style="width: 500px;">
    <div class="edit_form_header">Edit Horse <?=$filename?></div>
    <div class="edit_form_content">
      <form name="horse_edit" method="post" action="index.php?editor=misc&z=<?echo (isset($currzone)) ? $currzone : "";?>&zoneid=<?echo (isset($currzoneid)) ? $currzoneid : "";?>&action=31">
        <table width="100%">
          <tr>
            <th>Filename</th>
            <th>Texture</th>
            <th>Speed</th>
          </tr>
          <tr>
            <td><input type="text" size="33" name="filenamea" value="<?=$filename?>"></td>
            <td><input type="text" size="7" name="texture" value="<?=$texture?>"></td>
            <td><input type="text" size="15" name="mountspeed" value="<?=$mountspeed?>"></td>
          </tr>
          <tr>
            <th>Race</th>
            <th>Gender</th>
            <th>Notes</th>
          </tr>
          <tr>
            <td>
              <select name="race">
<?foreach($races as $key=>$value):?>
                <option value="<?=$key?>"<?echo ($key == $race)? " selected" : "";?>><?=$key?>: <?=$value?></option>
<?endforeach;?>
              </select>
            </td>
            <td>
              <select name="gender">
<?foreach($genders as $key=>$value):?>
                <option value="<?=$key?>"<?echo ($key == $gender)? " selected" : "";?>><?=$value?></option>
<?endforeach;?>
              </select>
            </td>
            <td><input type="text" size="15" name="notes" value="<?=$notes?>"></td>
          </tr>
        </table><br><br>
        <center>
          <input type="hidden" name="filename" value="<?=$filename?>">
          <input type="submit" value="Submit Changes">&nbsp;&nbsp;<input type="button" value="Cancel" onClick="history.back();">
        </center>
      </form>
    </div>
  </div>
