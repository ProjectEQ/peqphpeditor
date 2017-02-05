    <div class="table_container" style="width: 450px;">
      <div class="table_header">
        <table width="100%" cellpadding="0" cellspacing="0">
          <tr>
            <td>Edit NPC Spells Effect</td>
          </tr>
        </table>
      </div>
      <div class="table_content">
        <form name="nse" method="post" action="index.php?editor=spells&action=16&nseid=<?=$effect['id']?>">
          <table width="100%" cellpadding="6" cellspacing="0">
            <tr>
              <td>
                <strong>ID:</strong><br>
                <input type="text" value="<?=$effect['id']?>" disabled="disabled" size="5">
              </td>
              <td>
                <strong>Name:</strong><br>
                <input type="text" name="name" value="<?=$effect['name']?>" size="30">
              </td>
              <td>
                <strong>Parent List:</strong><br>
                <input type="text" name="parent_list" value="<?=$effect['parent_list']?>" size="5">
              </td>
            </tr>
            <tr>
              <td colspan="3">&nbsp;</td>
            </tr>
          </table>
          <center>
            <input type="hidden" name="id" value="<?=$effect['id']?>">
            <input type="submit" value="Update Effect">
            <input type="button" value="Cancel Changes" onClick="history.back()">
          </center>
        </form>
      </div>
    </div>
