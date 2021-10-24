  <div class="table_container" style="width: 450px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td>Edit Dynamic Zone Member</td>
        </tr>
      </table>
    </div>
    <div class="table_content">
      <form name="edit_dynamic_zone_member" method="post" action="index.php?editor=expeditions&action=23">
        <table width="100%" cellpadding="5" cellspacing="5">
          <tr>
            <td>
              <strong>ID:</strong><br>
              <input type="text" size="10" value="<?=$dynamic_zone_member['id']?>" disabled>
            </td>
            <td>
              <strong>Dynamic Zone ID:</strong><br>
              <input type="text" name="dynamic_zone_id" size="10" value="<?=$dynamic_zone_member['dynamic_zone_id']?>">
            </td>
            <td>
              <strong>Character ID:</strong><br>
              <input type="text" name="character_id" size="10" value="<?=$dynamic_zone_member['character_id']?>">
            </td>
          </tr>
        </table><br>
        <center>
          <input type="hidden" name="id" value="<?=$dynamic_zone_member['id']?>">
          <input type="submit" value="Update Dynamic Zone Member">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back()">
        </center>
      </form>
    </div>
  </div>
