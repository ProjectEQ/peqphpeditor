        <div class="table_container" style="width: 700px;">
          <div class="table_header">
            <table width="100%" cellpadding="0" cellspacing="0">
              <tr>
                <td>Create Data Bucket</td>
              </tr>
            </table>
          </div>
          <div class="table_content">
            <form name="databuckets" method="post" action="index.php?editor=databuckets&action=3">
              <table width="100%" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="33%">
                    ID:<br>
                    <input type="text" name="id" value="<?=$suggest_id?>">
                  </td>
                  <td width="33%">
                    Key:<br>
                    <input type="text" name="key" value="0">
                  </td>
                  <td width="33%">
                    Value:<br>
                    <input type="text" name="value" value="0">
                  </td>
                </tr>
                <tr>
                  <td width="33%">
                    Expires:<br>
                    <input type="text" name="expires" value="0">
                  </td>
                </tr>
                <tr>
                  <td colspan="3">&nbsp;</td>
                </tr>
              </table>
              <center>
                <input type="submit" value="Add Data Bucket">&nbsp;&nbsp;
                <input type="button" value="Cancel" onClick="history.back()">
              </center>
            </form>
          </div>
        </div>
