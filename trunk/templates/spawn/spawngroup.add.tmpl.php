      <table class="edit_form">
        <tr>
          <td class="edit_form_header">
            Add Spawngroup:
          </td>
        </tr>
        <tr>
          <td class="edit_form_content">
            <form name="searchmethod" method="get" action="index.php">
              <input type="hidden" name="editor" value="spawn">
              <input type="hidden" name="z" value="<?=$currzone?>">
              <input type="hidden" name="npcid" value="<?=$npcid?>">
              <input type="hidden" name="zoneid" value="<?=$currzoneid?>">
              <input type="radio" name="action" value="55">Search for an existing spawngroup by name<br>
              <input type="radio" name="action" value="56">Enter an existing spawngroup ID<br><br>
              <center>
                <input type="submit" value="Continue">
              </center>
            </form>
          </td>
        </tr>
      </table>
