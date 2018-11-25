        <div class="table_container" style="width: 400px;">
          <div class="table_header">
            <table width="100%" cellpadding="0" cellspacing="0">
              <tr>
                <td>Create Name Filter</td>
              </tr>
            </table>
          </div>
          <div class="table_content">
            <form name="namefilter" method="post" action="index.php?editor=server&action=62">
              <table width="100%" cellpadding="0" cellspacing="0">
                <tr>
                  <td>
                    ID:<br>
                    <input type="text" name="id" size="5" value="<?=$id?>">
                  </td>
                  <td>
                    Name:<br>
                    <input type="text" name="name" size="40" value="">
                  </td>
                </tr>
                <tr>
                  <td colspan="2">&nbsp;</td>
                </tr>
              </table>
              <center>
                <input type="submit" value="Add Name Filter">&nbsp;&nbsp;
                <input type="button" value="Cancel" onClick="history.back()">
              </center>
            </form>
          </div>
        </div>
