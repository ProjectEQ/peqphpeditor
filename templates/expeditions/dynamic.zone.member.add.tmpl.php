  <div class="table_container" style="width: 450px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td>Create Dynamic Zone Member</td>
        </tr>
      </table>
    </div>
    <div class="table_content">
      <form name="add_dynamic_zone_member" method="post" action="index.php?editor=expeditions&action=21">
        <table width="100%" cellpadding="5" cellspacing="5">
          <tr>
            <td>
              <strong>ID:</strong><br>
              <input type="text" name="id" size="10" value="<?=$suggest_id?>">
            </td>
            <td>
              <strong>Dynamic Zone ID:</strong><br>
              <input type="text" name="dynamic_zone_id" size="10" value="0">
            </td>
            <td>
              <strong>Character ID:</strong><br>
              <input type="text" name="character_id" size="10" value="0">
            </td>
          </tr>
        </table><br>
        <center>
          <input type="submit" value="Add Dynamic Zone Member">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back()">
        </center>
      </form>
    </div>
  </div>
