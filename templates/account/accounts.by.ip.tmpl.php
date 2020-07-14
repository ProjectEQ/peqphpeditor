  <div class="table_container" style="width:450px;">
    <div class="table_header">Accounts Associated with IP: <span style="color: yellow; font-weight: bold;"><?=$ip?></span></div>
    <div class="table_content">
<?if($accounts != ''):?>
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td><strong>Account</strong></td>
          <td><strong>Login Count</td>
          <td><strong>Last Login</td>
        </tr>
<?foreach($accounts as $account): extract($account);?>
        <tr>
          <td><a href="index.php?editor=account&acctid=<?=$accid?>"><?=$name?></a> (<?=$accid?>)</td>
          <td><?=$count?></td>
          <td><?=$lastused?></td>
        </tr>
<?endforeach;?>
      </table>
<?endif;?>
<?if($accounts == ''):?>
      Your search produced no results!
<?endif;?>
    </div>
  </div>
