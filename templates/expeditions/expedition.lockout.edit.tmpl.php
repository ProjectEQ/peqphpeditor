  <div class="table_container" style="width: 750px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td>Edit Lockout</td>
        </tr>
      </table>
    </div>
    <div class="table_content">
      <form name="edit_lockout" method="post" action="index.php?editor=expeditions&action=11">
        <table width="100%" cellpadding="5" cellspacing="5">
          <tr>
            <td>
              <strong>ID:</strong><br>
              <input type="text" size="10" value="<?=$dynamic_zone_lockout['id']?>" disabled>
            </td>
            <td>
              <strong>Dynamic Zone ID:</strong><br>
              <input type="text" name="dynamic_zone_id" size="10" value="<?=$dynamic_zone_lockout['dynamic_zone_id']?>">
            </td>
            <td colspan="2">
              <strong>UUID:</strong><br>
              <input type="text" name="from_expedition_uuid" size="60" value="<?=$dynamic_zone_lockout['from_expedition_uuid']?>">
            </td>
          </tr>
          <tr>
            <td colspan="4">
              <strong>Event Name:</strong><br>
              <input type="text" name="event_name" size="97" value="<?=$dynamic_zone_lockout['event_name']?>">
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <strong>Expire Time:</strong>&nbsp;<img src="images/info.gif" width="13" title="(YYYY-MM-DD HH:MM:SS)" alt="(YYYY-MM-DD HH:MM:SS)"><br>
              <input type="text" name="expire_time" size="30" value="<?=$dynamic_zone_lockout['expire_time']?>">
            </td>
            <td>
              <strong>Duration:</strong><br>
              <input type="text" name="duration" size="10" value="<?=$dynamic_zone_lockout['duration']?>">
            </td>
            <td>&nbsp;</td>
          </tr>
        </table><br>
        <center>
          <input type="hidden" name="id" value="<?=$dynamic_zone_lockout['id']?>">
          <input type="submit" value="Update Lockout">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back()">
        </center>
      </form>
    </div>
  </div>
