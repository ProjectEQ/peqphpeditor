  <table class="edit_form">
    <tr>
      <td class="edit_form_header">Utilities</td>
    </tr>
    <tr>
      <td class="edit_form_content">
        <center>
          <a href="index.php?editor=util&action=1">Purge Old Characters</a><br/>
          <a onClick="return confirm('There are <?=$accounts;?> accounts on this server to scan. With large population servers, this can take a long time. Are you sure you want to run this process now? (Oh, and do not use the back button!)');" href="index.php?editor=util&action=3">Purge Empty Accounts</a><br/>
          <a href="index.php?editor=util&action=5">View Server Economy</a><br/>
          <a href="index.php?editor=util&action=6">View Recipe Activity</a>
        </center>
      </td>
    </tr>
  </table>
