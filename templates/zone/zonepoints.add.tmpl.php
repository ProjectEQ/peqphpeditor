<div class="edit_form" style="width: 600px">
      <div class="edit_form_header">
        Add Zone Point
      </div>

      <div class="edit_form_content">
        <form name="zonepoints" method="post" action=index.php?editor=zone&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&action=17">
        <table width="100%">
          <tr>
            <th>ID</th>
            <th>Zone</th>
            <th>Number</th>
            <th>X</th>
            <th>Y</th>
            <th>Z</th>
            <th>Heading</th>
           </tr>
          <tr>
            <td><input type="text" size="7" name="zpid" value="<?=$suggestzpid?>"></td>
            <td><input type="text" size="10" name="zone" value="<?=$currzone?>"></td>
            <td><input type="text" size="7" name="number" value="<?=$suggestnum?>"></td>
            <td><input type="text" size="7" name="x" value="0"></td>
            <td><input type="text" size="7" name="y" value="0"></td>
            <td><input type="text" size="7" name="z_coord" value="0"></td>
            <td><input type="text" size="7" name="heading" value="0"></td>
           </tr>
           <tr>
            <th>Tar Instance</th>
            <th>Client</th>
            <th>Target X</th>
            <th>Target Y</th>
            <th>Target Z</th>
            <th>Tar Heading</th>
            <th>Version</th>
          </tr>
           <tr>
            <td><input type="text" size="7" name="target_instance" value="0"></td>
            <td><input type="text" size="10" name="client_version_mask" value="4294967295"></td>
            <td><input type="text" size="7" name="target_x" value="0"></td>
            <td><input type="text" size="7" name="target_y" value="0"></td>
            <td><input type="text" size="7" name="target_z" value="0"></td>
            <td><input type="text" size="7" name="target_heading" value="0"></td>
            <td><input type="text" size="7" name="version" value="<?=$suggestver?>"></td>
          </tr>
          <th>Target Zone</th>
          </tr>
           <tr>
            <td><input type="text" size="7" name="target_zone_id" value="<?=$zid?>"></td>
          </tr>
         </table><br><br>
        <center>
          <input type="submit" value="Submit Changes">
        </center>
      </form>
      </div>
      </div>