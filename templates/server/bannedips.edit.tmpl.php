        <div class="edit_form" style="width: 500px">
          <div class="edit_form_header">Edit notes for: <?=$ip_address?></div>
          <div class="edit_form_content">
            <form name="ipaddress_edit" method="post" action="index.php?editor=server&action=55">
              <table width="100%">
                <tr>
                  <th>Notes</th>
                </tr>
                <tr>
                  <td><input type="text" size="75" name="notes" value="<?=$notes?>"></td>
                </tr>
              </table><br><br>
              <center>
                <input type="hidden" name="ip_address" value="<?=$ip_address?>">
                <input type="submit" value="Submit Changes">
              </center>
            </form>
          </div>
        </div>
