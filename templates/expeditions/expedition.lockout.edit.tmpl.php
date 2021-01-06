  <div class="table_container" style="width: 650px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td>Edit Expedition Lockout</td>
        </tr>
      </table>
    </div>
    <div class="table_content">
      <form name="edit_expedition_lockout" method="post" action="index.php?editor=expeditions&action=11">
        <table width="100%" cellpadding="5" cellspacing="5">
          <tr>
            <td>
              <strong>ID:</strong><br>
              <input type="text" size="10" value="<?=$expedition_lockout['id']?>" disabled>
            </td>
            <td>
              <strong>Expedition ID:</strong><br>
              <input type="text" name="expedition_id" size="10" value="<?=$expedition_lockout['expedition_id']?>">
            </td>
            <td colspan="2">
              <strong>Expedition UUID:</strong><br>
              <input type="text" name="from_expedition_uuid" size="60" value="<?=$expedition_lockout['from_expedition_uuid']?>">
            </td>
          </tr>
          <tr>
            <td colspan="4">
              <strong>Event Name:</strong><br>
              <input type="text" name="event_name" size="97" value="<?=$expedition_lockout['event_name']?>">
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <strong>Expire Time:</strong>&nbsp;<img src="images/info.gif" width="13" title="(YYYY-MM-DD HH:MM:SS)" alt="(YYYY-MM-DD HH:MM:SS)"><br>
              <input type="text" name="expire_time" size="30" value="<?=$expedition_lockout['expire_time']?>">
            </td>
            <td>
              <strong>Duration:</strong><br>
              <input type="text" name="duration" size="10" value="<?=$expedition_lockout['duration']?>">
            </td>
            <td>&nbsp;</td>
          </tr>
        </table><br>
        <center>
          <input type="hidden" name="id" value="<?=$expedition_lockout['id']?>">
          <input type="submit" value="Update Expedition Lockout">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back()">
        </center>
      </form>
    </div>
  </div>
