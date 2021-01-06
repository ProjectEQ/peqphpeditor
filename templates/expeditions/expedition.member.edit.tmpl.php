  <div class="table_container" style="width: 600px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td>Edit Expedition Member</td>
        </tr>
      </table>
    </div>
    <div class="table_content">
      <form name="edit_expedition_member" method="post" action="index.php?editor=expeditions&action=23">
        <table width="100%" cellpadding="5" cellspacing="5">
          <tr>
            <td>
              <strong>ID:</strong><br>
              <input type="text" size="10" value="<?=$expedition_member['id']?>" disabled>
            </td>
            <td>
              <strong>Expedition ID:</strong><br>
              <input type="text" name="expedition_id" size="10" value="<?=$expedition_member['expedition_id']?>">
            </td>
            <td>
              <strong>Character ID:</strong><br>
              <input type="text" name="character_id" size="10" value="<?=$expedition_member['character_id']?>">
            </td>
            <td>
              <strong>Current Member:</strong><br>
              <select name="is_current_member">
                <option value="0"<?echo ($expedition_member['is_current_member'] == 0) ? " selected" : "";?>>No (0)</option>
                <option value="1"<?echo ($expedition_member['is_current_member'] != 0) ? " selected" : "";?>>Yes (1)</option>
              </select>
            </td>
          </tr>
        </table><br>
        <center>
          <input type="hidden" name="id" value="<?=$expedition_member['id']?>">
          <input type="submit" value="Add Expedition Member">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back()">
        </center>
      </form>
    </div>
  </div>
