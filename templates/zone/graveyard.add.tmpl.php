  <div class="edit_form" style="width: 500px">
    <div class="edit_form_header">Add Graveyard</div>
    <div class="edit_form_content">
      <form name="graveyard" method="post" action="index.php?editor=zone&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&graveyard_id=<?=$id?>&action=9">
        <table width="100%">
          <tr>
            <th>ID</th>
            <th>Zone</th>
            <th>X</th>
            <th>Y</th>
            <th>Z</th>
            <th>Heading</th>
          </tr>
          <tr>
            <td><input type="text" size="7" name="graveyard_id" value="<?=$suggestgid?>"></td>
            <td><input type="text" size="7" name="zone_id" value="<?=$zid?>"></td>
            <td><input type="text" size="7" name="x" value="0"></td>
            <td><input type="text" size="7" name="y" value="0"></td>
            <td><input type="text" size="7" name="z_coord" value="0"></td>
            <td><input type="text" size="7" name="heading" value="0"></td>
          </tr>
        </table><br><br>
        <center><input type="submit" value="Submit Changes"></center>
      </form>
    </div>
  </div>
