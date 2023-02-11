        <div class="table_container" style="width: 250px;">
          <div class="table_header">
            <table width="100%" cellpadding="0" cellspacing="0">
              <tr>
                <td>Create Trap Entry</td>
              </tr>
            </table>
          </div>
          <div class="table_content">
            <form name="add_entry" method="post" action="index.php?editor=misc&action=72">
              <table width="100%" cellpadding="3" cellspacing="3">
                <tr>
                  <td>
                    <strong>ID:</strong><br>
                    <input type="text" name="id" size="10" value="">
                  </td>
                  <td>
                    <strong>Trap ID:</strong><br>
                    <input type="text" name="trap_id" size="10" value="">
                  </td>
                </tr>
              </table><br>
              <center>
                <input type="submit" value="Insert Entry">&nbsp;&nbsp;
                <input type="button" value="Cancel" onClick="history.back()">
              </center>
            </form>
          </div>
        </div>
