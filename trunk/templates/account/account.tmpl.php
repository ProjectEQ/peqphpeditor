<div class="table_container">
  <div class="table_header">
    <div style="float:right">
      <a onClick="javascript:alert('Not yet!');"><img src="images/c_table.gif" border="0" title="Edit this Account" /></a>
<?if ($character_array) {
    echo '<a onClick="javascript:alert(\'Unable to delete account yet. Delete all characters associated with this account first!\');"><img src="images/table.gif" border="0" title="Characters Still Exist on this Account!" /></a>';
  }
  else {
    echo '<a onClick="return confirm(\'Really delete account ' . trim($name) . ' (' . $acctid . ')?\');" href="index.php?editor=account&acctid=' . $acctid . '&action=4"><img src="images/table.gif" border="0" title="Delete this Account" /></a>';
  }
?>
    </div>
    <?=$id?> - <?echo trim($name);?>
  </div>
  <div class="table_content">
    <?if ($online) echo "<h2><center><font color='red'>WARNING! THIS ACCOUNT IS ONLINE...</font></center></h2>";?>
    <table cellspacing="0" border="0" width="100%">
      <tr>
        <td width="100%">
          <table cellspacing="0" border="0" width="100%">
            <tr>
              <td width="45%">
                <fieldset>
                  <legend><strong>Account Info</strong></legend>
                  Account ID: <?=$id?><br />
                  LS Name: <?=$name?><br />
                  LS ID: <?=$lsaccount_id?><br />
                  Password: <?=$password?><br />
                  Status: <?=$status?><br />
                  GM Speed: <?=$yesno[$gmspeed]?><br />
                  Hide Me: <?=$yesno[$hideme]?><br />
                  Revoked: <?=$yesno[$revoked]?><br />
                  Karma: <?=$karma?><br />
                  Rules Flag: <?=$rulesflag?><br />
                  Shared Platinum: <?=$sharedplat?><br />
                  Minilogin IP: <?=$minilogin_ip?><br />
                  Suspended: <?echo ($suspendeduntil > 0) ? $suspendeduntil : "N/A";?><br />
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
<?if ($ip_array) {
    foreach ($ip_array as $ip_address) {
      echo '<tr>';
      echo '<td width="40%"><center>' . $ip_address['ip'] . '</center></td>';
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
<?if ($character_array) {
    $count = 0;
    foreach ($character_array as $character) {
      $count++;
      echo 'Character' . $count . ': ';
      echo ($character['id'] != '') ? '<a href="index.php?editor=player&playerid=' . $character['id'] . '">' . $character['name'] . '</a>  (' . $character['id'] . ')' : 'EMPTY';
      echo '<br />';
    }
  }
  else {
    echo '<br /><br /><center>NO CHARACTERS ON THIS ACCOUNT</center><br />';
  }
  echo '<br />';
?>
                  Last Character Used: <?echo ($charname != '') ? $charname : 'Never Logged a Character';?><br />
                </fieldset>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
  </div>
</div>
