<div class="table_container">
  <div class="table_header">
    <div style="float:right">
      <a onClick="javascript:alert('Not yet!');"><img src="images/c_table.gif" border="0" title="Edit this Guild"></a>
      <a onClick="javascript:alert('Not yet!');"><img src="images/table.gif" border="0" title="Delete this Guild"></a>
    </div>
    <?=$id?> - <?echo trim($name)?>
  </div>
  <div class="table_content">
    <table cellspacing="0" border="0" width="100%">
      <tr>
        <td>
          <table cellspacing="0" border="0" width="100%">
            <tr>
              <td width="35%">
                <fieldset>
                  <legend><strong>Guild Info</strong></legend>
                  Name: <?=$name?><br>
                  Guild ID: <?=$id?><br>
                  Leader: <?=getPlayerName($leader)?><br>
                  Min Status: <?=$minstatus?><br>
                  URL: <?=$url?><br>
                  Tribute: <?=$tribute?><br>
                  Channel: <?=$channel?><br>
                </fieldset>
              </td>
              <td width="65%">
                <fieldset>
                  <legend><strong>Message of the Day</strong></legend>
                  Set By: <?=$motd_setter?><br>
                  Message: <?=$motd?><br>
                </fieldset>
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td>
          <fieldset>
            <legend><strong>Guild Ranks</strong></legend>
            <table cellspacing="0" border="0" width="100%">
              <tr>
                <td align="center">Rank</td>
                <td>Title</td>
                <td align="center">Hear</td>
                <td align="center">Speak</td>
                <td align="center">Invite</td>
                <td align="center">Remove</td>
                <td align="center">Promote</td>
                <td align="center">Demote</td>
                <td align="center">MOTD</td>
                <td align="center">War/Peace</td>
              </tr>
<?
  foreach ($guild_ranks as $guild_rank) {
    echo '<tr>';
    echo '<td align="center">' . $guild_rank['rank'] . '</td>';
    echo '<td>' . $guild_rank['title'] . '</td>';
    echo '<td align="center">' . $yesno[$guild_rank['can_hear']] . '</td>';
    echo '<td align="center">' . $yesno[$guild_rank['can_speak']] . '</td>';
    echo '<td align="center">' . $yesno[$guild_rank['can_invite']] . '</td>';
    echo '<td align="center">' . $yesno[$guild_rank['can_remove']] . '</td>';
    echo '<td align="center">' . $yesno[$guild_rank['can_promote']] . '</td>';
    echo '<td align="center">' . $yesno[$guild_rank['can_demote']] . '</td>';
    echo '<td align="center">' . $yesno[$guild_rank['can_motd']] . '</td>';
    echo '<td align="center">' . $yesno[$guild_rank['can_warpeace']] . '</td>';
    echo '</tr>';
  }
?>
            </table>
          </fieldset>
        </td>
      </tr>
      <tr>
        <td>
          <fieldset>
            <legend><strong>Guild Members</strong></legend>
            <table cellspacing="0" border="0" width="100%">
              <tr>
                <td align="center">Rank</td>
                <td>Name</td>
                <td align="center">Total Tribute</td>
                <td align="center">Last Donation</td>
                <td align="center">Tribute Active</td>
                <td align="center">Banker</td>
                <td align="center">Alt</td>
                <td align="center">Public Note</td>
              </tr>
<?
  foreach ($guild_members as $guild_member) {
    echo '<tr>';
    echo '<td align="center">' . $guild_member['rank'] . '</td>';
    echo '<td><a href="index.php?editor=player&playerid=' . $guild_member['char_id'] . '">' . getPlayerName($guild_member['char_id']) . '</a></td>';
    echo '<td align="center">' . $guild_member['total_tribute'] . '</td>';
    echo '<td align="center">' . $guild_member['last_tribute'] . '</td>';
    echo '<td align="center">' . $yesno[$guild_member['tribute_enable']] . '</td>';
    echo '<td align="center">' . $yesno[$guild_member['banker']] . '</td>';
    echo '<td align="center">' . $yesno[$guild_member['alt']] . '</td>';
    echo '<td align="center"><img src="images\note.gif" title="' . (($guild_member['public_note'] != '') ? $guild_member['public_note'] : 'No Public Note') . '"></td>';
    echo '</tr>';
  }
?>
            </table>
          </fieldset>
        </td>
      </tr>
      <tr>
        <td colspan="2">
          <fieldset>
            <legend><strong>Guild Bank</strong></legend>
            <table cellspacing="0" border="0" width="100%">
<?
  if ($guild_items) {
?>
              <tr>
                <td align="center">Area</td>
                <td align="center">Slot</td>
                <td align="center">Item</td>
                <td align="center">Qty</td>
                <td align="center">Permissions</td>
                <td align="center">Donated By</td>
                <td align="center">Intended For</td>
              </tr>
<?
    foreach ($guild_items as $guild_item) {
      echo '<tr>';
      echo '<td align="center">' . (($guild_item['area'] == 0) ? 'Deposit' : 'Bank') . '</td>';
      echo '<td align="center">' . $guild_item['slot'] . '</td>';
      echo '<td align="center">' . get_item_name($guild_item['itemid']) . ' <a href="index.php?editor=items&id=' . $guild_item['itemid'] . '&action=2">' . $guild_item['itemid'] . '</a> [<a href="http://lucy.allakhazam.com/item.html?id=' . $guild_item['itemid'] . '" target="_new">lucy</a>]</td>';
      echo '<td align="center">' . $guild_item['qty'] . '</td>';
      echo '<td align="center">' . $permissions[$guild_item['permissions']] . '</td>';
      echo '<td align="center">' . $guild_item['donator'] . '</td>';
      echo '<td align="center">' . $guild_item['whofor'] . '</td>';
      echo '</tr>';
    }
  }
  else {
    echo '<tr>';
    echo '<td colspan="7" align="center">No items in this guild bank</td>';
    echo '</tr>';
  }
?>
            </table>
          </fieldset>
        </td>
      </tr>
    </table>
  </div>
</div>
