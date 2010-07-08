        <form name="reports">
          <div class="table_container" style="width: 750px;">
            <div class="table_header">
              <table width="100%" cellpadding="0" cellspacing="0">
                <tr>View Report <?=$rid?></tr>
              </table>
            </div>
            <div class="edit_form_content">
              <center>
                <fieldset style="text-align: left;">
                  <table width="100%">
                    <tr>
                      <td align="center" width="5%"><strong>ID</strong></td>
                      <td align="center" width="15%"><strong>Name</strong></td>
                      <td align="center" width="80%"><strong>Reported</strong></td>
                    </tr>
                    <tr>
                      <td align="center" width="5%"><?=$rid?></td>
                      <td align="center" width="15%"><?=$name?></td>
                      <td align="center" width="80%"><?=$reported?></td>
                    </tr>
                  </table>
                </fieldset><br>
                <fieldset>
                  <legend><strong>Text</strong></legend>
                  <table width="100%">
                    <tr>
                      <td><textarea name="text" rows="20" cols="86"><?=$reported_text?></textarea></td>
                    </tr>
                  </table>
                </fieldset><br>
              </center>
            </div>
          </div>
        </form>
