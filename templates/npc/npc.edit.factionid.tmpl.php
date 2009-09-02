      <table class="edit_form">
        <tr>
          <td class="edit_form_header">
            Change NPC Faction ID:
          </td>
        </tr>
        <tr>
          <td class="edit_form_content">
            <form name="searchmethod" method="get" action="index.php">
              <input type="hidden" name="editor" value="npc">
              <input type="hidden" name="z" value="<?=$currzone?>">
              <input type="hidden" name="npcid" value="<?=$npcid?>">
              <input type="radio" name="action" value="14">Search for an NPC Faction ID by name<br>
              <input type="radio" name="action" value="12">Enter an NPC Faction ID<br>
              <input type="radio" name="action" value="9">Create a new NPC Faction ID<br><br>
              <center>
                <input type="submit" value="Continue">
              </center>
            </form>
          </td>
        </tr>
      </table>
