  <div class="table_container" style="width: 600px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td align="left">Server Economy</td>
        </tr>
      </table>
    </div>
    <div class="table_content">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td class="edit_form_content">
            <fieldset>
              <legend><strong>Total Cash</strong></legend>
              <table class="edit_form_content" width="100%">
                <tr>
                  <th>Copper</th>
                  <th>Silver</th>
                  <th>Gold</th>
                  <th>Platinum</th>
                  <th>Shared Plat</th>
                </tr>
                <tr>
                  <td align="center" width="20%"><?=$cash['copper'];?></td>
                  <td align="center" width="20%"><?=$cash['silver'];?></td>
                  <td align="center" width="20%"><?=$cash['gold'];?></td>
                  <td align="center" width="20%"><?=$cash['platinum'];?></td>
                  <td align="center" width="20%"><?=$cash['sharedplat'];?></td>
                </tr>
              </table>
            </fieldset>
          </td>
        </tr>
      </table>
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td class="edit_form_content">
            <fieldset>
              <legend><strong>Top <span id="player_count_span"><a id="player_count" onClick="editPlayerCount(<?=$player_count;?>);" title="Click to change"><?=$player_count;?></a></span> Richest Players by Platinum</strong></legend>
              <table class="edit_form_content" width="100%">
                <tr>
                  <th>Player ID</th>
                  <th>Player Name</th>
                  <th>Account</th>
                  <th>Platinum</th>
                  <th>Shared Plat</th>
                </tr>
<?
  foreach ($richest['players'] as $players) {
?>
                <tr>
                  <td align="center"><?=$players['id'];?></td>
                  <td align="center"><a href="index.php?editor=player&playerid=<?=$players['id'];?>"><?echo getPlayerName($players['id']);?></a></td>
                  <td align="center"><a href="index.php?editor=account&acctid=<?=$players['account_id'];?>"><?echo getAccountName($players['account_id']);?></a></td>
                  <td align="center"><?=$players['platinum'];?></td>
                  <td align="center"><?=$players['sharedplat'];?></td>
                </tr>
<?
  }
?>
              </table>
            </fieldset>
          </td>
        </tr>
      </table>
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td class="edit_form_content">
            <fieldset>
              <legend><strong>Top <span id="account_count_span"><a id="account_count" onClick="editAccountCount(<?=$account_count;?>);" title="Click to change"><?=$account_count;?></a></span> Richest Accounts by Shared Platinum</strong></legend>
              <table class="edit_form_content" width="100%">
                <tr>
                  <th>Account ID</th>
                  <th>Account Name</th>
                  <th>Shared Plat</th>
                  <th>Plat on Chars</th>
                </tr>
<?
  foreach ($richest['accounts'] as $accounts) {
?>
                <tr>
                  <td align="center"><?=$accounts['id'];?></td>
                  <td align="center"><a href="index.php?editor=account&acctid=<?=$accounts['id'];?>"><?echo getAccountName($accounts['id']);?></a></td>
                  <td align="center"><?=$accounts['sharedplat'];?></td>
                  <td align="center"><?=$accounts['platinum'];?></td>
                </tr>
<?
  }
?>
              </table>
            </fieldset>
          </td>
        </tr>
      </table>
    </div>
  </div>
