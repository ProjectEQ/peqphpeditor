        <div class="edit_form" style="width: 200px">
          <div class="edit_form_header">
            <table width="100%" cellpadding="0" cellspacing="0">
              <tr>
                <td>Ruleset: <?=$ruleset_id?><td>
                <td align="right"><a onClick="return confirm('Really Delete Ruleset <?=$ruleset_id?>?');" href="index.php?editor=server&ruleset_id=<?=$ruleset_id?>&action=24"><img src="images/remove3.gif" border="0" title="Delete this rule"></a></td>
              </tr>
            </table>
          </div>
          <div class="edit_form_content">
            <form name="ruleset" method="post" action="index.php?editor=server&action=23">
              <table width="100%">
                <tr>
                  <th>id</th>
                  <th>name</th>
                </tr>
                <tr>
                  <td><input type="text" size="2" name="ruleset_id1" value="<?=$ruleset_id?>"></td>
                  <td><input type="text" size="10" name="name" value="<?=$name?>"></td>
                </tr>
              </table><br><br>
              <center>
                <input type="hidden" name="ruleset_id" value="<?=$ruleset_id?>">
                <input type="submit" value="Submit Changes">
              </center>
            </form>
          </div>
        </div>
