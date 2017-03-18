        <div class="edit_form" style="width: 600px">
          <div class="edit_form_header">Add Rule</div>
          <div class="edit_form_content">
            <form name="rules" method="post" action="index.php?editor=server&action=20">
              <table width="100%" cellpadding="2" cellspacing="0">
                <tr>
                  <td>
                    <b>Ruleset:</b><br>
                    <input type="text" size="5" name="ruleset_id" value="<?=$ruleset_id?>">
                  </td>
                  <td>
                    <b>Name:</b><br>
                    <input type="text" size="55" name="rule_name" value="">
                  </td>
                  <td>
                    <b>Value:</b><br>
                    <input type="text" size="15" name="rule_value" value="">
                  </td>
                </tr>
                <tr>
                  <td colspan="3">
                    <b>Notes:</b><br>
                    <textarea cols="70" rows="3" name="notes"></textarea>
                  </td>
                </tr>
              </table><br><br>
              <center>
                <input type="submit" value="Submit Changes">&nbsp;
                <input type="button" value="Cancel" onClick="history.back();">
              </center>
            </form>
          </div>
        </div>
