  <div class="table_container" style="width: 500px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td>Create Setting</td>
        </tr>
      </table>
    </div>
    <div class="table_content">
      <form name="add_player_event_log_setting" method="post" action="index.php?editor=server&action=78">
        <table width="100%" cellpadding="5" cellspacing="5">
          <tr>
            <td>
              <strong>ID:</strong><br>
              <input type="text" name="id" size="10" value="<?=$suggest_id?>">
            </td>
            <td>
              <strong>Event Name:</strong><br>
              <input type="text" name="event_name" size="40" value="">
            </td>
            <td>
              <strong>Enabled:</strong><br>
              <select name="event_enabled">
                <option value="0">No (0)</option>
                <option value="1" selected>Yes (1)</option>
              </select>
            </td>
          </tr>
          <tr>
            <td>
              <strong>Retention Days:</strong><br>
              <input type="text" name="retention_days" size="10" value="0">
            </td>
            <td>
              <strong>Discord Webhook:</strong><br>
              <input type="text" name="discord_webhook_id" size="10" value="0">
            </td>
            <td>&nbsp;</td>
          </tr>
        </table><br>
        <center>
          <input type="submit" value="Insert Setting">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back()">
        </center>
      </form>
    </div>
  </div>
