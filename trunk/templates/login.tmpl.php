      <center>
        <br><br><br>
        <h1>Project Everquest Database Editing Interface</h1>
        <br><br>

<?if($error == 1):?>
        <font color="red">Invalid username or password</font><br><br><br>
<?endif;?>

        <form method="post" action="index.php?login">
        <table width="250">
          <tr>
            <td align="left">
              <strong>Login:</strong>
            </td>
            <td align="right">
              <input type="text" name="login" value="<?=$login?>">
            </td>
          </tr>
          <tr>
            <td align="left">
              <strong>Password:</strong>
            </td>
            <td align="right">
              <input type="password" name="password" value="<?=$password?>">
            </td>
          </tr>
          <tr>
            <td colspan="2" align="center">
              <br><br><input type="submit" value="Login" style="width:60px;"><br><br><br>
              
              <a href="index.php?login=guest">Click here to login as a guest</a>
            </td>
          </tr>
        </table>
        </form>
      </center>