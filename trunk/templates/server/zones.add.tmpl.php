        <div class="edit_form" style="width: 320px">
          <div class="edit_form_header">Add a zone</div>
          <div class="edit_form_content">
            <form name="zone_add" method="post" action="index.php?editor=server&action=37">
              <table width="100%">
                <tr>
                  <th>Launcher</th>
                  <th>Zone</th>
                  <th>Port</th>
                </tr>
                <tr>
                 <td><input type="text" size="10" name="launcher" value="<?=$suggestlauncher?>"></td>
                 <td><input type="text" size="15" name="zone" value=""></td>
                 <td><input type="text" size="4" name="port" value="0"></td>
                </tr>
              </table><br><br>
              <center><input type="submit" value="Submit Changes"></center>
            </form>
          </div>
        </div>
