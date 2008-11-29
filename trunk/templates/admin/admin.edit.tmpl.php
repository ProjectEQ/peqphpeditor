<?extract($user);?>
      <center>
        <br><br><br>
        <h1>User Management</h1>
        <br><br>
      </center>

      <form method="post" action="index.php?admin&action=2">
        <div class="edit_form" style="width:200px;">
          <div class="edit_form_header">
            User List
          </div>
          <div class="edit_form_content">
            <strong>Username</strong><br>
            <input class="indented" type="text" name="login" value="<?=$login?>"><br><br>
            
            <strong>Change Password</strong><br>
            <input class="indented" type="text" name="password" value=""><br>
            (leave blank for no change)<br><br>

            <strong>Status</strong><br>
            <select class="indented" name="administrator">
              <option value="0"<?echo ($administrator == 0) ? " selected" : "";?>>User</option>
              <option value="1"<?echo ($administrator == 1) ? " selected" : "";?>>Administrator</option>
            </select><br><br><br>
            <center>
              <input type="hidden" name="id" value="<?=$id?>">
              <input type="submit" value="Update User">
            </center>
          </div>
        </div>
      </form>