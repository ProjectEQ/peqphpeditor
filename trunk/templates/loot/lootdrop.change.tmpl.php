      <table class="edit_form">
        <tr>
          <td class="edit_form_header">
            Change LootDrop:
          </td>
        </tr>
        <tr>
          <td class="edit_form_content">
            <form name="searchmethod" method="get" action="index.php">
              <input type="hidden" name="editor" value="loot">
              <input type="hidden" name="z" value="<?=$currzone?>">
              <input type="hidden" name="zoneid" value="<?=$currzoneid?>">
              <input type="hidden" name="npcid" value="<?=$npcid?>">
              <input type="hidden" name="ltid" value="<?=$ltid?>">
              <input type="radio" name="action" value="25">Search for a LootDrop by name<br>
              <input type="radio" name="action" value="23">Enter a LootDrop ID<br>
              <input type="radio" name="action" value="30">Create a new LootDrop<br><br>
              <center>
                <input type="submit" value="Continue">
              </center>
            </form>
          </td>
        </tr>
      </table>
