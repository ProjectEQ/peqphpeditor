  <div class="edit_form" style="width: 500px">
    <div class="edit_form_header">Edit Graveyard: <?=$id?></div>
    <div class="edit_form_content">
      <form name="graveyard" method="post" action="index.php?editor=zone&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&graveyard_id=<?=$id?>&action=6">
        <table width="100%">
          <tr>
            <th>Zone</th>
            <th>X</th>
            <th>Y</th>
            <th>Z</th>
            <th>Heading</th>
          </tr>
          <tr>
            <td><input type="text" size="7" name="zone_id" value="<?=$zone_id?>"></td>
            <td><input type="text" size="7" name="x" value="<?=$x?>"></td>
            <td><input type="text" size="7" name="y" value="<?=$y?>"></td>
            <td><input type="text" size="7" name="z_coord" value="<?=$z?>"></td>
            <td><input type="text" size="7" name="heading" value="<?=$heading?>"></td>
          </tr>
        </table><br><br>
        <center>
          <input type="hidden" name="graveyard_id" value="<?=$id?>">
          <input type="submit" value="Submit Changes">
        </center>
      </form>
    </div>
  </div>
