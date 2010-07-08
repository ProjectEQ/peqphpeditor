        <div class="edit_form" style="width: 200px">
          <div class="edit_form_header">Edit launcher: <?=$name?></div>
          <div class="edit_form_content">
            <form name="launcher_edit" method="post" action="index.php?editor=server&action=39">
              <table width="100%">
                <tr>
                  <th>Launcher</th>
                  <th>Number</th>
                </tr>
                <tr>
                  <td><input type="text" size="10" name="name1" value="<?=$name?>"></td>
                  <td><input type="text" size="4" name="dynamics" value="<?=$dynamics?>"></td>
                </tr>
              </table><br><br>
              <center>
                <input type="hidden" name="name" value="<?=$name?>">
                <input type="submit" value="Submit Changes">
              </center>
            </form>
          </div>
        </div>
