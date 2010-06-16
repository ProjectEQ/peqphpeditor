      <table class="edit_form">
        <tr>
          <td class="edit_form_header">
            Update Faction:
          </td>
        </tr>
        <tr>
          <td class="edit_form_content">
            <form name="searchmethod" method="get" action="index.php">
              <input type="hidden" name="editor" value="npc">
              <input type="hidden" name="z" value="<?=$currzone?>">
              <input type="hidden" name="zoneid" value="<?=$currzoneid?>">
              <input type="hidden" name="npcid" value="<?=$npcid?>">
              <input type="hidden" name="npcfid" value="<?=$npcfid?>">
              <input type="radio" name="action" value="49">Apply to NPC by Race<br>
              <input type="radio" name="action" value="48">Apply to NPC by Name<br><br>
              <center>
                <input type="submit" value="Continue">
              </center>
            </form>
          </td>
        </tr>
      </table>