  <center>
    <br><br><br>
    <h1>Admin Editor</h1>
    <br><br>
    <div class="table_container" style="width:350px;">
      <div class="table_header">
        User Management
        <div style="float:right;">
          <a href="index.php?admin&action=4"><img src="images/add.gif" border="0" title="Add User"></a>
        </div>
      </div>
      <div class="table_content">
        <table width="100%">
          <tr>
            <th align="left">Username</th>
            <th align="center">Status</th>
            <th>&nbsp;</th>
          </tr>
<?foreach($users as $user): extract($user);?>
          <tr>
            <td align="left"><?=$login?></td>
            <td align="center"><?echo ($administrator == 1) ? "Admin" : "User";?></td>
            <td align="right">
              <a href="index.php?admin&id=<?=$id?>&action=1"><img src="images/edit2.gif" border="0" title="Edit User"></a>&nbsp;
              <a href="index.php?admin&id=<?=$id?>&action=3" onClick="return confirm('Really delete this user?');">
                <img src="images/remove.gif" border="0" title="Delete User">
              </a>
            </td>
          </tr>
<?endforeach;?>
        </table>
      </div>
    </div><br><br>
    <div class="table_container" style="width:500px;">
      <div class="table_header">
        GM IPs
        <div style="float:right;">
          <a href="index.php?admin&action=6"><img src="images/add.gif" border="0" title="Add IP"></a>
        </div>
      </div>
      <div class="table_content">
        <table width="100%">
<?
if (isset($ips)) {
?>
          <tr>
            <td><strong>Name</strong></td>
            <td><strong>Account</strong></td>
            <td><strong>IP</strong></td>
            <td>&nbsp;</td>
          </tr>
<?
  foreach ($ips as $ip) {
?>
          <tr>
            <td><?=$ip['name']?></td>
            <td><?=getAccountName($ip['account_id'])?> (<?=$ip['account_id']?>)</td>
            <td><?=$ip['ip_address']?></td>
            <td align="right">
              <a href="index.php?admin&account_id=<?=$ip['account_id']?>&ip_address=<?=$ip['ip_address']?>&action=8"><img src="images/edit2.gif" border="0" title="Edit IP"></a>&nbsp;
              <a href="index.php?admin&account_id=<?=$ip['account_id']?>&ip_address=<?=$ip['ip_address']?>&action=10" onClick="return confirm('Really delete this IP?');">
                <img src="images/remove.gif" border="0" title="Delete IP">
              </a>
            </td>
          </tr>
<?
  }
}
else {
?>
          <tr><td>No entries</td></tr>
<?
}
?>
        </table>
      </div>
    </div>
  </center>
