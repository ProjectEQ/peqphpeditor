        <form name="hacker">
          <div class="table_container" style="width: 750px;">
            <div class="table_header">
              <table width="100%" cellpadding="0" cellspacing="0">
                <tr>
                  <td>View Hacker <?=$hid?></td>
                </tr>
              </table>
            </div>
            <div class="edit_form_content">
              <center>
                <fieldset style="text-align: left;">
                  <table width="100%">
                    <tr>
                      <td align="center" width="5%"><strong>ID</strong></td>
                      <td align="center" width="5%"><strong>Account</strong></td>
                      <td align="center" width="5%"><strong>Name</strong></td>
                      <td align="center" width="5%"><strong>Zone</strong></td>
                      <td align="center" width="15%"><strong>Date</strong></td>
                    </tr>
                    <tr>
                      <td align="center" width="5%"><?=$hid?></td>
                      <td align="center" width="5%"><?=$account?></td>
                      <td align="center" width="5%"><?=$name?></td>
                      <td align="center" width="5%"><?=$zone?></td>
                      <td align="center" width="15%"><?=$date?></td>
                    </tr>
                  </table>
                </fieldset><br>
                <fieldset>
                  <legend><strong>Text</strong></legend>
                  <table width="100%">
                    <tr>
                      <td align="center" width="100%"><?=$hacked?></td>
                    </tr>
                  </table>
                </fieldset><br>
              </center>
            </div>
          </div>
        </form>
