        <div class="edit_form" style="width: 750px">
          <div class="edit_form_header">Edit Rule</div>
          <div class="edit_form_content">
            <form name="rules" method="post" action="index.php?editor=server&action=18">
              <table width="100%">
                <tr>
                  <th>Ruleset</th>
                  <th>Name</th>
                  <th>Value</th>
                  <th>Notes</th>
                </tr>
                <tr>
                  <td><input type="text" size="4" name="ruleset_id1" value="<?=$ruleset_id?>"></td>
                  <td><input type="text" size="47" name="rule_name1" value="<?=$rule_name?>"></td>
                  <td><input type="text" size="8" name="rule_value" value="<?=$rule_value?>"></td>
                  <td><input type="text" size="42" name="notes" value="<?=$notes?>"></td>
                </tr>
              </table><br><br>
              <center>
                <input type="hidden" name="rule_name" value="<?=$rule_name?>">
                <input type="hidden" name="ruleset_id" value="<?=$ruleset_id?>">
                <input type="submit" value="Submit Changes">
              </center>
            </form>
          </div>
        </div>