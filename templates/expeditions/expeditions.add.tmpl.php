  <div class="table_container" style="width: 650px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td>Create Expedition</td>
        </tr>
      </table>
    </div>
    <div class="table_content">
      <form name="add_expedition" method="post" action="index.php?editor=expeditions&action=3">
        <table width="100%" cellpadding="5" cellspacing="5">
          <tr>
            <td>
              <strong>ID:</strong><br>
              <input type="text" name="id" size="10" value="<?=$suggest_id?>">
            </td>
            <td colspan="2">
              <strong>UUID:</strong><br>
              <input type="text" name="uuid" size="60" value="">
            </td>
            <td>
              <strong>Dyn Zone ID:</strong><br>
              <input type="text" name="dynamic_zone_id" size="10" value="0">
            </td>
          </tr>
          <tr>
            <td colspan="3">
              <strong>Expedition Name:</strong><br>
              <input type="text" name="expedition_name" size="77" value="">
            </td>
            <td>
              <strong>Leader ID:</strong><br>
              <input type="text" name="leader_id" size="10" value="0">
            </td>
          </tr>
          <tr>
            <td>
              <strong>Min Players:</strong><br>
              <input type="text" name="min_players" size="10" value="0">
            </td>
            <td>
              <strong>Max Players:</strong><br>
              <input type="text" name="max_players" size="10" value="0">
            </td>
            <td>
              <strong>Replay on Join:</strong><br>
              <select name="add_replay_on_join">
                <option value="0">No (0)</option>
                <option value="1" selected>Yes (1)</option>
              </select>
            </td>
            <td>
              <strong>Locked:</strong><br>
              <select name="is_locked">
                <option value="0" selected>No (0)</option>
                <option value="1">Yes (1)</option>
              </select>
            </td>
          </tr>
        </table><br>
        <center>
          <input type="submit" value="Add Expedition">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back()">
        </center>
      </form>
    </div>
  </div>
