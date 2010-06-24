      <table class="edit_form">
        <tr>
          <td class="edit_form_header">
            Update Spellset:
          </td>
        </tr>
        <tr>
          <td class="edit_form_content">
            <form name="searchmethod" method="get" action="index.php">
              <input type="hidden" name="editor" value="spellset">
              <input type="hidden" name="z" value="<?=$currzone?>">
              <input type="hidden" name="zoneid" value="<?=$currzoneid?>">
              <input type="hidden" name="npcid" value="<?=$npcid?>">
              <input type="hidden" name="id" value="<?=$id?>">
              <input type="radio" name="action" value="19">Apply to NPC by Class<br>
              <input type="radio" name="action" value="18">Apply to NPC by Name<br><br>
              <center>
                <input type="submit" value="Continue">
              </center>
            </form>
          </td>
        </tr>
      </table>