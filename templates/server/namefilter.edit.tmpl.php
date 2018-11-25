        <div class="table_container" style="width: 400px;">
          <div class="table_header">
            <table width="100%" cellpadding="0" cellspacing="0">
              <tr>
                <td>Edit Name Filter</td>
              </tr>
            </table>
          </div>
          <div class="table_content">
            <form name="namefilter" method="post" action="index.php?editor=server&action=60">
              <table width="100%" cellpadding="0" cellspacing="0">
                <tr>
                  <td>
                    ID:<br>
                    <input type="text" name="id" size="5" value="<?=$nf['id']?>">
                  </td>
                  <td>
                    Name:<br>
                    <input type="text" name="name" size="40" value="<?=$nf['name']?>">
                  </td>
                </tr>
                <tr>
                  <td colspan="2">&nbsp;</td>
                </tr>
              </table>
              <center>
                <input type="hidden" name="old_id" value="<?=$nf['id']?>">
                <input type="submit" value="Update Name Filter">&nbsp;&nbsp;
                <input type="button" value="Cancel Changes" onClick="history.back()">
              </center>
            </form>
          </div>
        </div>
