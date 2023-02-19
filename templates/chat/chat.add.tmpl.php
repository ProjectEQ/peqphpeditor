  <div class="table_container" style="width: 700px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td>Create Chat Channel</td>
        </tr>
      </table>
    </div>
    <div class="table_content">
      <form name="add_chat_channel" method="post" action="index.php?editor=chat&action=2">
        <table width="100%" cellpadding="5" cellspacing="5">
          <tr>
            <td>
              <strong>Name:</strong> <img src="images/info.gif" width="13" height="13" border="0" title="Existing channel will be overwritten!"><br>
              <input type="text" name="name" size="20" value="">
            </td>
            <td>
              <strong>Owner:</strong><br>
              <input type="text" name="owner" size="20" value="">
            </td>
            <td>
              <strong>Password:</strong><br>
              <input type="text" name="password" size="20" value="">
            </td>
            <td>
              <strong>Min Status:</strong><br>
              <input type="text" name="minstatus" size="10" value="0">
            </td>
          </tr>
        </table><br>
        <center>
          <input type="submit" value="Insert Channel">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back()">
        </center>
      </form>
    </div>
  </div>
