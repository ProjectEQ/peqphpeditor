      <center>
        <br><br><br>
        <h1>User Management</h1>
        <br><br>
      </center>

      <form method="post" action="index.php?admin&action=5">
        <div class="edit_form" style="width:200px;">
          <div class="edit_form_header">
            User List
          </div>
          <div class="edit_form_content">
            <strong>Username</strong><br>
            <input class="indented" type="text" name="login" value=""><br><br>
            
            <strong>Password</strong><br>
            <input class="indented" type="text" name="password" value=""><br><br>

            <strong>Status</strong><br>
            <select class="indented" name="administrator">
              <option value="0">User</option>
              <option value="1">Administrator</option>
            </select><br><br><br>
            <center>
              <input type="submit" value="Add User">
            </center>
          </div>
        </div>
      </form>