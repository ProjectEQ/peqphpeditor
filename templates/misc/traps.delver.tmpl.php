  <table class="edit_form" cellpadding="3" cellspacing="0" width="200">
    <tr>
      <td class="edit_form_header">Delete Version</td>
    </tr>
    <tr>
      <td class="edit_form_content" align="center">
        <form name="trap_version" method="post" action="index.php?editor=misc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&action=60">
          Version:<br>
          <input type="text" size="7" name="trap_version" value=""><br><br>
          <center>
            <input type="submit" value="Submit">&nbsp;
            <input type="button" value="Cancel" onClick="history.back();">
          </center>
        </form>
      </td>
    </tr>
  </table>
