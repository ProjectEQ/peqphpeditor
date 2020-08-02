        <div class="table_container" style="width: 500px;">
          <div class="table_header">
            <table width="100%" cellpadding="0" cellspacing="0">
              <tr>
                <td>Edit Content Flag</td>
              </tr>
            </table>
          </div>
          <div class="table_content">
            <form name="content_flag" method="post" action="index.php?editor=content&action=4">
              <table width="100%" cellpadding="3" cellspacing="3">
                <tr>
                  <td width="25%">
                    <strong>ID:</strong><br>
                    <input type="text" size="10" value="<?=$content_flag['id']?>" disabled>
                  </td>
                  <td width="50%">
                    <strong>Flag Name:</strong><br>
                    <input type="text" name="flag_name" size="42" value="<?=$content_flag['flag_name']?>">
                  </td>
                  <td width="25%">
                    <strong>Enabled:</strong><br>
                    <select name="enabled">
                      <option value="0"<?echo ($content_flag['enabled'] == 0) ? " selected" : "";?>>No</option>
                      <option value="1"<?echo ($content_flag['enabled'] != 0) ? " selected" : "";?>>Yes</option>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td colspan="3">
                    <strong>Notes:</strong><br>
                    <textarea cols="56" rows="8" name="notes"><?=$content_flag['notes']?></textarea>
                  </td>
                </tr>
              </table><br>
              <center>
                <input type="hidden" name="id" value="<?=$content_flag['id']?>">
                <input type="submit" value="Update Content Flag">&nbsp;&nbsp;
                <input type="button" value="Cancel" onClick="history.back()">
              </center>
            </form>
          </div>
        </div>
