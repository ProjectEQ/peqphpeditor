  <div class="table_container">
    <div class="table_header">
      <div style="float:right">
        <a onClick="javascript:alert('Not yet!');"><img src="images/c_table.gif" border="0" title="Edit this Account"></a>
<?if (isset($character_array)) {
    echo '<a onClick="javascript:alert(\'Unable to delete account yet. Delete all characters associated with this account first!\');"><img src="images/table.gif" border="0" title="Characters Still Exist on this Account!"></a>';
  }
  else {
    echo '<a onClick="return confirm(\'Really delete account ' . trim($name) . ' (' . $acctid . ')?\');" href="index.php?editor=account&acctid=' . $acctid . '&action=4"><img src="images/table.gif" border="0" title="Delete this Account"></a>';
  }
?>
      </div>
      <?=$id?> - <?echo trim($name);?>
    </div>
    <div class="table_content">
<?if (isset($online)) echo "<h2><center><font color='red'>WARNING! THIS ACCOUNT IS ONLINE...</font></center></h2>";?>
      <table cellspacing="0" border="0" width="100%">
        <tr>
          <td width="100%">
            <table cellspacing="0" border="0" width="100%">
              <tr>
                <td width="45%">
                  <fieldset>
                    <legend><strong>Account Info</strong></legend>
                    Account ID: <?=$id?><br>
                    Login Server: <?=$ls_id?><br>
                    Login Server Account: <?=$name?> (<?=$lsaccount_id?>)<br>
                    Password: <?=$password?><br>
                    <a href="index.php?editor=account&acctid=<?=$id?>&action=7" title="Edit Account Status">Status</a>: <?=$status?><br>
                    GM Speed: <?=$yesno[$gmspeed]?><br>
                    Invulnerable: <?=$yesno[$invulnerable]?><br>
                    Fly Mode: <?=$flymode?><br>
                    Ignore Tells: <?=$yesno[$ignore_tells]?><br>
                    Hide Me: <?=$yesno[$hideme]?><br>
                    Revoked: <?=$yesno[$revoked]?><br>
                    Karma: <?=$karma?><br>
                    Rules Flag: <?=$rulesflag?><br>
                    Shared Platinum: <?=$sharedplat?><br>
                    Minilogin IP: <?=$minilogin_ip?><br>
                    Suspended: <?echo ($suspendeduntil > 0) ? $suspendeduntil : "N/A";?><br>
                    Suspend Reason: <?echo ($suspend_reason != "") ? $suspend_reason : "N/A";?><br>
                    Ban Reason: <?echo ($ban_reason != "") ? $ban_reason : "N/A";?><br>
                    Account Created: <?=get_real_time($time_creation)?>
                  </fieldset>
                </td>
                <td width="55%" rowspan="2">
                  <fieldset>
                    <legend><strong>IP Address Info</strong></legend>
                    <table>
                      <tr>
                        <td width="40%"><center>IP Address</center></td>
                        <td width="20%"><center>Login Count</center></td>
                        <td width="40%"><center>Last Login</center></td>
                      </tr>
<?
  if (isset($ips)) {
    foreach ($ips as $ip_address) {
      echo '<tr>';
      echo '<td width="40%"><center><a href="index.php?editor=account&ip=' . $ip_address['ip'] . '&action=9">' . $ip_address['ip'] . '</a></center></td>';
      echo '<td width="20%"><center>' . $ip_address['count'] . '</center></td>';
      echo '<td width="40%"><center>' . $ip_address['lastused'] . '</center></td>';
      echo '</tr>';
    }
  }
?>
                    </table>
                  </fieldset>
                </td>
              </tr>
              <tr>
                <td>
                  <fieldset>
                    <legend><strong>Characters</strong></legend>
<?
  if (isset($characters)) {
    $count = 0;
    echo '<table cellspacing="0" border="0" width="100%">';
    foreach ($characters as $character) {
      $count++;
      echo '<tr>';
      echo '<td width="25%">Character' . $count . ': </td>';
      echo '<td width="60%">';
      echo ($character['id'] != '') ? '<a href="index.php?editor=player&playerid=' . $character['id'] . '">' . $character['name'] . '</a>  (' . $character['id'] . ')' : 'EMPTY';
      echo '</td>';
      echo '<td width="15%" align="right"><a href="index.php?editor=account&acctid=' . $acctid . '&playerid=' . $character['id'] . '&action=5"><img src="images/user.gif" height="13" width="13" title="Transfer this Character"></a> <a onClick="return confirm(\'Really delete player ' . $character['name'] . ' (' . $character['id'] . ') from this account?\');" href="index.php?editor=player&playerid=' . $character['id'] . '&acctid=' . $id . '&action=4"><img src="images/remove.gif" title="Delete this Character"></a></td>';
      echo '</tr>';
    }
    echo '</table>';
  }
  else {
    echo '<br><br><center>NO CHARACTERS ON THIS ACCOUNT</center><br>';
  }
  echo '<br>';
?>
                    Last Character Used: <?echo ($charname != '') ? $charname : 'Never Logged a Character';?><br>
                    Auto-Login Character: <?echo ($auto_login_charname != '') ? $auto_login_charname : 'None';?>
                  </fieldset>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </div>
  </div>
