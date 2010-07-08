        <div class="edit_form" style="width: 200px">
          <div class="edit_form_header">Add Ruleset</div>
          <div class="edit_form_content">
            <form name="ruleset_add" method="post" action="index.php?editor=server&action=31">
              <table width="100%">
                <tr>
                  <th>id</th>
                  <th>name</th>
                </tr>
                <tr>
                  <td><input type="text" size="2" name="ruleset_id" value="<?=$suggestruleid?>"></td>
                  <td><input type="text" size="10" name="name" value=""></td>
                </tr>
              </table><br><br>
              <center><input type="submit" value="Submit Changes"></center>
            </form>
          </div>
        </div>
