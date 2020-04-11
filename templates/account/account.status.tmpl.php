  <table class="edit_form">
    <tr>
      <td class="edit_form_header">Edit Account Status</td>
    </tr>
    <tr>
      <td class="edit_form_content">
        <form name="account_status" method="post" action="index.php?editor=account&acctid=<?=$acctid?>&action=8">
          Account Status: <br>
          <input type="text" name="new_acct_status" value="<?=$cur_acct_status?>"><br><br>
          <center><input type="submit" value="Submit"></center>
        </form>
      </td>
    </tr>
  </table>
