<div class="edit_form" style="width: 600px">
      <div class="edit_form_header">
        Edit Zone Point: <?=$id?>
      </div>

      <div class="edit_form_content">
        <form name="graveyard" method="post" action=index.php?editor=zone&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&zpid=<?=$id?>&action=14">
        <table width="100%">
          <tr>
            <th>Zone</th>
            <th>Number</th>
            <th>X</th>
            <th>Y</th>
            <th>Z</th>
            <th>Heading</th>
           </tr>
          <tr>
            <td><input type="text" size="10" name="zone" value="<?=$zone?>"></td>
            <td><input type="text" size="7" name="number" value="<?=$number?>"></td>
            <td><input type="text" size="7" name="x" value="<?=$x?>"></td>
            <td><input type="text" size="7" name="y" value="<?=$y?>"></td>
            <td><input type="text" size="7" name="z_coord" value="<?=$z?>"></td>
            <td><input type="text" size="7" name="heading" value="<?=$heading?>"></td>
           </tr>
           <tr>
            <th>Target X</th>
            <th>Target Y</th>
            <th>Target Z</th>
            <th>Tar Heading</th>
            <th>Version</th>
            <th>Target Zone</th>
          </tr>
           <tr>
            <td><input type="text" size="10" name="target_x" value="<?=$target_x?>"></td>
            <td><input type="text" size="7" name="target_y" value="<?=$target_y?>"></td>
            <td><input type="text" size="7" name="target_z" value="<?=$target_z?>"></td>
            <td><input type="text" size="7" name="target_heading" value="<?=$target_heading?>"></td>
            <td><input type="text" size="7" name="version" value="<?=$version?>"></td>
            <td><input type="text" size="7" name="target_zone_id" value="<?=$target_zone_id?>"></td>
          </tr>
          <tr>
            <th>Client</th>
            <th>Tar Instance</th> 
          </tr>
           <tr>
            <td><input type="text" size="10" name="client_version_mask" value="<?=$client_version_mask?>"></td>
            <td><input type="text" size="7" name="target_instance" value="<?=$target_instance?>"></td>
            
          </tr>
         </table><br><br>
        <center>
          <input type="hidden" name="zpid" value="<?=$id?>">
          <input type="submit" value="Submit Changes">
        </center>
      </form>
      </div>
      </div>