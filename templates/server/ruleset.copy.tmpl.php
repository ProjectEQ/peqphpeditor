        <div class="edit_form" style="width: 300px">
          <div class="edit_form_header">Copy from ruleset: <?=$name?> (<?=$origin_id?>)</div>
          <div class="edit_form_content">
            <form name="ruleset" method="post" action="index.php?editor=server&action=26">
              <table width="100%" cellpadding="3" cellspacing="0">
                <tr>
                  <th width="50%" align="center">New Ruleset ID</th>
                  <th width="50%" align="center">New Ruleset Name</th>
                </tr>
                <tr>
                  <td width="50%" align="center"><input type="text" size="5" name="ruleset_id" value="<?=$ruleset_id?>"></td>
                  <td width="50%" align="center"><input type="text" size="10" name="ruleset_name" value=""></td>
                </tr>
              </table><br><br>
              <center>
                <input type="hidden" name="origin_id" value="<?=$origin_id?>">
                <input type="submit" value="Submit Changes">&nbsp;
                <input type="button" value="Cancel" onClick="history.back();">
              </center>
            </form>
          </div>
        </div>
