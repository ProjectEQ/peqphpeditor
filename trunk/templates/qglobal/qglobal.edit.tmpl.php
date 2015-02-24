        <div class="table_container" style="width: 700px;">
          <div class="table_header">
            <table width="100%" cellpadding="0" cellspacing="0">
              <tr>
                <td>Edit Quest Global</td>
              </tr>
            </table>
          </div>
          <div class="table_content">
            <form name="qglobal" method="post" action="index.php?editor=qglobal&action=5">
              <table width="100%" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="33%">
                    Name:<br>
                    <input type="text" name="name" value="<?=$name?>">
                  </td>
                  <td width="33%">
                    Player:<br>
                    <input type="text" name="charid" value="<?=$charid?>">
                  </td>
                  <td width="33%">
                    NPC:<br>
                    <input type="text" name="npcid" value="<?=$npcid?>">
                  </td>
                </tr>
                <tr>
                  <td width="34%">
                    Zone:<br>
                    <input type="text" name="zoneid" value="<?=$zoneid?>">
                  </td>
                  <td width="33%">
                    Expires:<br>
                    <input type="text" name="expdate" value="<?=$expdate?>">
                  </td>
                  <td width="34%">
                    Value:<br>
                    <input type="text" name="value" value="<?=$value?>">
                  </td>
                </tr>
                <tr>
                  <td colspan="3">&nbsp;</td>
                </tr>
              </table>
              <center>
                <input type="hidden" name="old_name" value="<?=$name?>">
                <input type="hidden" name="old_charid" value="<?=$charid?>">
                <input type="hidden" name="old_npcid" value="<?=$npcid?>">
                <input type="hidden" name="old_zoneid" value="<?=$zoneid?>">
                <input type="hidden" name="referer" value="<?echo $_SERVER["HTTP_REFERER"];?>">
                <input type="submit" value="Update Quest Global">
                <input type="button" value="Cancel Changes" onClick="history.back()">
              </center>
            </form>
          </div>
        </div>
