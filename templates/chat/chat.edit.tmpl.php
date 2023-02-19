  <div class="table_container" style="width: 700px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td>Edit Chat Channel</td>
        </tr>
      </table>
    </div>
    <div class="table_content">
      <form name="edit_chat_channel" method="post" action="index.php?editor=chat&action=4">
        <table width="100%" cellpadding="5" cellspacing="5">
          <tr>
            <td>
              <strong>Name:</strong><br>
              <input type="text" name="new_name" size="20" value="<?=$chat['name']?>">
            </td>
            <td>
              <strong>Owner:</strong><br>
              <input type="text" name="owner" size="20" value="<?=$chat['owner']?>">
            </td>
            <td>
              <strong>Password:</strong><br>
              <input type="text" name="password" size="20" value="<?=$chat['password']?>">
            </td>
            <td>
              <strong>Min Status:</strong><br>
              <input type="text" name="minstatus" size="10" value="<?=$chat['minstatus']?>">
            </td>
          </tr>
        </table><br>
        <center>
          <input type="hidden" name="old_name" value="<?=$chat['name']?>">
          <input type="submit" value="Update Channel">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back()">
        </center>
      </form>
    </div>
  </div>
