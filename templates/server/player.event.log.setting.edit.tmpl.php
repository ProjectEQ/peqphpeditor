  <div class="table_container" style="width: 500px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td>Edit Setting</td>
        </tr>
      </table>
    </div>
    <div class="table_content">
      <form name="edit_player_event_log_setting" method="post" action="index.php?editor=server&action=80">
        <table width="100%" cellpadding="5" cellspacing="5">
          <tr>
            <td>
              <strong>ID:</strong><br>
              <input type="text" size="10" value="<?=$setting['id']?>" disabled>
            </td>
            <td>
              <strong>Event Name:</strong><br>
              <input type="text" name="event_name" size="40" value="<?=$setting['event_name']?>">
            </td>
            <td>
              <strong>Enabled:</strong><br>
              <select name="event_enabled">
                <option value="0"<?echo ($setting['event_enabled'] == 0) ? " selected" : "";?>>No (0)</option>
                <option value="1"<?echo ($setting['event_enabled'] != 0) ? " selected" : "";?>>Yes (1)</option>
              </select>
            </td>
          </tr>
          <tr>
            <td>
              <strong>Retention Days:</strong><br>
              <input type="text" name="retention_days" size="10" value="<?=$setting['retention_days']?>">
            </td>
            <td>
              <strong>Discord Webhook:</strong><br>
              <input type="text" name="discord_webhook_id" size="10" value="<?=$setting['discord_webhook_id']?>">
            </td>
            <td>&nbsp;</td>
          </tr>
        </table><br>
        <center>
          <input type="hidden" name="id" value="<?=$setting['id']?>">
          <input type="submit" value="Update Setting">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back()">
        </center>
      </form>
    </div>
  </div>
