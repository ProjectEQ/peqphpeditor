        <div class="edit_form" style="width: 200px">
          <div class="edit_form_header">Copy default ruleset</div>
          <div class="edit_form_content">
            <form name="ruleset" method="post" action="index.php?editor=server&action=26">
              <table width="100%">
                <tr>
                  <th>new id</th>
                  <th>new name</th>
                </tr>
                <tr>
                  <td><input type="text" size="2" name="ruleset_id" value="<?=$suggestruleid?>"></td>
                  <td><input type="text" size="10" name="name1" value=""></td>
                </tr>
              </table><br><br>
              <center>
                <input type="hidden" name="name" value="<?=$name?>">
                <input type="submit" value="Submit Changes">
              </center>
            </form>
          </div>
        </div>
