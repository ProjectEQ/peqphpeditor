      <table class="edit_form">
        <tr>
          <td class="edit_form_header">
            Search for NPCs by:
          </td>
        </tr>
        <tr>
          <td class="edit_form_content">
            <form name="searchmethod" method="get" action="index.php">
              <input type="hidden" name="editor" value="faction">
              <input type="hidden" name="fid" value="<?=$fid?>">
              <input type="radio" name="action" value="15">NPCs on this faction<br>
              <input type="radio" name="action" value="17">NPCs that increase this faction<br>
              <input type="radio" name="action" value="18">NPCs that decrease this faction<br>
              <input type="radio" name="action" value="19">NPCs with no faction change<br><br>
              <center>
                <input type="submit" value="Continue">
              </center>
            </form>
          </td>
        </tr>
      </table>
