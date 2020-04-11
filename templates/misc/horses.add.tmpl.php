  <div class="edit_form" style="width: 500px;">
    <div class="edit_form_header">Add Horse</div>
    <div class="edit_form_content">
      <form name="horses" method="post" action="index.php?editor=misc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&action=34">
        <table width="100%">
          <tr>
            <th>Filename</th>
            <th>Texture</th>
            <th>Speed</th>
          </tr>
          <tr>
            <td><input type="text" size="33" name="filename" value=""></td>
            <td><input type="text" size="7" name="texture" value="0"></td>
            <td><input type="text" size="15" name="mountspeed" value="1"></td>
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
            <td><input type="text" size="15" name="notes" value="Notes"></td>
          </tr>
        </table><br><br>
        <center>
          <input type="submit" value="Submit Changes">
        </center>
      </form>
    </div>
  </div>
