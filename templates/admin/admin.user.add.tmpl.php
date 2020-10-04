      <center>
        <br><br><br>
        <h1><a href="index.php?admin">Admin Editor</a> >> User Management</h1>
        <br><br>
      </center>
      <form method="post" action="index.php?admin&action=5">
        <div class="edit_form" style="width:210px;">
          <div class="edit_form_header">Add User</div>
          <div class="edit_form_content">
            <table width="100%" cellpadding="3" cellspacing="3">
              <tr>
                <td>
                  <strong>Username</strong><br>
                  <input type="text" name="login" size="25" value="">
                </td>
              </tr>
              <tr>
                <td>
                  <strong>Password</strong><br>
                  <input type="password" name="password" size="26" value="">
                </td>
              </tr>
              <tr>
                <td>
                  <strong>Status</strong><br>
                  <select name="administrator">
                    <option value="0" selected>User</option>
                    <option value="1">Administrator</option>
                  </select>
                </td>
              </tr>
            </table><br><br>
            <center>
              <input type="submit" value="Add User">&nbsp;&nbsp;
              <input type="button" value="Cancel" onClick="history.back();">
            </center>
          </div>
        </div>
      </form>
