        <div class="table_container" style="width: 700px;">
          <div class="table_header">
            <table width="100%" cellpadding="0" cellspacing="0">
              <tr>
                <td>Create Quest Global</td>
              </tr>
            </table>
          </div>
          <div class="table_content">
            <form name="qglobal" method="post" action="index.php?editor=qglobal&action=3">
              <table width="100%" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="33%">
                    Name:<br>
                    <input type="text" name="name" value="">
                  </td>
                  <td width="33%">
                    Player:<br>
                    <input type="text" name="charid" value="0">
                  </td>
                  <td width="33%">
                    NPC:<br>
                    <input type="text" name="npcid" value="0">
                  </td>
                </tr>
                <tr>
                  <td width="34%">
                    Zone:<br>
                    <input type="text" name="zoneid" value="0">
                  </td>
                  <td width="33%">
                    Expires:<br>
                    <input type="text" name="expdate" value="">
                  </td>
                  <td width="34%">
                    Value:<br>
                    <input type="text" name="value" value="">
                  </td>
                </tr>
                <tr>
                  <td colspan="3">&nbsp;</td>
                </tr>
              </table>
              <center>
                <input type="submit" value="Insert Quest Global">
                <input type="button" value="Cancel Insert" onClick="history.back()">
              </center>
            </form>
          </div>
        </div>
