        <div class="table_container" style="width: 700px;">
          <div class="table_header">
            <table width="100%" cellpadding="0" cellspacing="0">
              <tr>
                <td>Edit Data Bucket</td>
              </tr>
            </table>
          </div>
          <div class="table_content">
            <form name="databuckets" method="post" action="index.php?editor=databuckets&action=5">
              <table width="100%" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="33%">
                    ID:<br>
                    <input type="text" name="id" value="<?=$id?>">
                  </td>
                  <td width="33%">
                    Key:<br>
                    <input type="text" name="key" value="<?=$key?>">
                  </td>
                  <td width="33%">
                    Value:<br>
                    <input type="text" name="value" value="<?=$value?>">
                  </td>
                </tr>
                <tr>
                  <td width="33%">
                    Expires:<br>
                    <input type="text" name="expires" value="<?=$expires?>">
                  </td>
                </tr>
                <tr>
                  <td colspan="3">&nbsp;</td>
                </tr>
              </table>
              <center>
                <input type="hidden" name="old_id" value="<?=$id?>">
                <input type="hidden" name="old_key" value="<?=$key?>">
                <input type="hidden" name="old_value" value="<?=$value?>">
                <input type="hidden" name="old_expires" value="<?=$expires?>">
                <input type="hidden" name="referer" value="<?echo $_SERVER["HTTP_REFERER"];?>">
                <input type="submit" value="Update Data Bucket">&nbsp;&nbsp;
                <input type="button" value="Cancel Changes" onClick="history.back()">
              </center>
            </form>
          </div>
        </div>
