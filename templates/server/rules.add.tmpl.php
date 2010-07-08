        <div class="edit_form" style="width: 750px">
          <div class="edit_form_header">Add Rule</div>
          <div class="edit_form_content">
            <form name="rules" method="post" action="index.php?editor=server&action=20">
              <table width="100%">
                <tr>
                  <th>Ruleset</th>
                  <th>Name</th>
                  <th>Value</th>
                  <th>Notes</th>
                </tr>
                <tr>
                  <td><input type="text" size="4" name="ruleset_id" value="<?=$suggestruleset?>"></td>
                  <td><input type="text" size="47" name="rule_name" value=""></td>
                  <td><input type="text" size="8" name="rule_value" value=""></td>
                  <td><input type="text" size="42" name="notes" value=""></td>
                </tr>
              </table><br><br>
              <center><input type="submit" value="Submit Changes"></center>
            </form>
          </div>
        </div>
