      <table class="edit_form">
        <tr>
          <td class="edit_form_header">
            Change LootTable:
          </td>
        </tr>
        <tr>
          <td class="edit_form_content">
            <form name="searchmethod" method="get" action="index.php">
              <input type="hidden" name="editor" value="loot">
              <input type="hidden" name="z" value="<?=$currzone?>">
              <input type="hidden" name="zoneid" value="<?=$currzoneid?>">
              <input type="hidden" name="npcid" value="<?=$npcid?>">
              <input type="radio" name="action" value="14">Search for a LootTable by name<br>
              <input type="radio" name="action" value="12">Enter a LootTable ID<br>
              <input type="radio" name="action" value="9">Create a new LootTable<br><br>
              <center>
                <input type="submit" value="Continue">
              </center>
            </form>
          </td>
        </tr>
      </table>
