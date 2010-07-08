        <div class="edit_form" style="width: 320px">
          <div class="edit_form_header">Edit zone: <?=$zone?></div>
          <div class="edit_form_content">
            <form name="zones" method="post" action="index.php?editor=server&action=34">
              <table width="100%">
                <tr>
                  <th>Launcher</th>
                  <th>Zone</th>
                  <th>Port</th>
                </tr>
                <tr>
                  <td><input type="text" size="10" name="launcher1" value="<?=$launcher?>"></td>
                  <td><input type="text" size="15" name="zone1" value="<?=$zone?>"></td>
                  <td><input type="text" size="4" name="port" value="<?=$port?>"></td>
                </tr>
              </table><br><br>
              <center>
                <input type="hidden" name="launcher" value="<?=$launcher?>">
                <input type="hidden" name="zone" value="<?=$zone?>">
                <input type="submit" value="Submit Changes">
              </center>
            </form>
          </div>
        </div>
