<div class="table_container">
  <div class="table_header">
    Guild Management
    <div style="float:right">&nbsp;</div>
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
                  <strong>Name:</strong> <?=$name?><br>
                  <strong>Guild ID:</strong> <?=$id?><br>
                  <strong>Leader:</strong> <?echo ($leader > 0) ? getPlayerName($leader) : "None";?><br>
                  <strong>Min Status:</strong> <?=$minstatus?><br>
                  <strong>Tribute:</strong> <?=$tribute?><br>
                  <strong>Favor:</strong> <?=$favor?><br>
                  <strong>Channel:</strong> <?echo ($channel != "") ? $channel : "N/A";?><br>
                  <strong>URL:</strong> <?echo ($url != "") ? $url : "N/A";?><br>
                </fieldset>
              </td>
              <td width="65%">
                <fieldset>
                  <legend><strong>Tributes</strong></legend>
                  <table cellspacing="0" cellpadding="0" border="0" width="100%">
                    <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td align="center"><strong>Slot</strong></td>
                      <td align="center"><strong>Tier</strong></td>
                      <td><strong>Name</strong></td>
                      <td>&nbsp;</td>
                      <td align="center"><strong>Cost</strong></td>
                    </tr>
                    <tr>
                      <td align="center">1</td>
                      <td align="center"><?echo isset($guild_tributes['tribute_id_1_tier']) ? $guild_tributes['tribute_id_1_tier'] + 1 : "N/A";?></td>
                      <td><?echo isset($guild_tributes['tribute_id_1']) ? get_tribute_name($guild_tributes['tribute_id_1']) . "  (" . $guild_tributes['tribute_id_1'] . ")" : "N/A";?></td>
                      <td>&nbsp;</td>
<?$cost1 = (isset($guild_tributes['tribute_id_1'])) ? get_tribute_cost_by_tier($guild_tributes['tribute_id_1'], $guild_tributes['tribute_id_1_tier']) : "N/A";?>
                      <td align="center"><?=$cost1?></td>
                    </tr>
                    <tr>
                      <td align="center">2</td>
                      <td align="center"><?echo isset($guild_tributes['tribute_id_2_tier']) ? $guild_tributes['tribute_id_2_tier'] + 1 : "N/A";?></td>
                      <td><?echo isset($guild_tributes['tribute_id_2']) ? get_tribute_name($guild_tributes['tribute_id_2']) . "  (" . $guild_tributes['tribute_id_2'] . ")" : "N/A";?></td>
                      <td>&nbsp;</td>
<?$cost2 = (isset($guild_tributes['tribute_id_2'])) ? get_tribute_cost_by_tier($guild_tributes['tribute_id_2'], $guild_tributes['tribute_id_2_tier']) : "N/A";?>
                      <td align="center"><?=$cost2?></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td colspan="2" align="left"><strong>Enabled:</strong> <?echo (isset($guild_tributes['enabled'])) ? $yesno[$guild_tributes['enabled']] : "N/A";?></td>
                      <td align="left"><strong>Time Remaining:</strong> <?echo (isset($guild_tributes['time_remaining'])) ? $guild_tributes['time_remaining'] : "N/A";?></td>
                      <td align="right"><strong>Total Upkeep:</strong></td>
                      <td align="center"><?echo (is_numeric($cost1) ? $cost1 : 0) + (is_numeric($cost2) ? $cost2 : 0);?></td>
                    </tr>
                  </table><br><br>
                </fieldset>
              </td>
            </tr>
            <tr>
              <td colspan="2">
                <fieldset>
                  <legend><strong>Message of the Day</strong></legend>
                  <strong>Set By:</strong> <?=$motd_setter?><br>
                  <strong>Message:</strong> <?echo ($motd != "") ? $motd : "N/A";?><br>
                </fieldset>
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td>
          <fieldset>
            <legend><strong>Guild Permissions</strong></legend>
            <table cellspacing="0" border="1" width="100%">
              <tr>
                <td width="36%">&nbsp;</td>
<?foreach ($guild_ranks as $guild_rank):?>
                <td width="8%" align="center"><img src="images/rank<?=$guild_rank['rank']?>.gif" title="<?=$guild_rank['title']?> (<?=$guild_rank['rank']?>)"></td>
<?endforeach;?>
              </tr>
<?
for ($index = 0; $index < 30; $index++):
?>
              <tr>
                <td><strong><?echo $index + 1;?></strong> - <?=$permissions[$index + 1]?></td>
                <td align="center"><?echo ($guild_permissions[$index]['permission'] & 128) ? "<img src='images/remove2.gif' width='9'>" : "&nbsp;";?></td>
                <td align="center"><?echo ($guild_permissions[$index]['permission'] &  64) ? "<img src='images/remove2.gif' width='9'>" : "&nbsp;";?></td>
                <td align="center"><?echo ($guild_permissions[$index]['permission'] &  32) ? "<img src='images/remove2.gif' width='9'>" : "&nbsp;";?></td>
                <td align="center"><?echo ($guild_permissions[$index]['permission'] &  16) ? "<img src='images/remove2.gif' width='9'>" : "&nbsp;";?></td>
                <td align="center"><?echo ($guild_permissions[$index]['permission'] &   8) ? "<img src='images/remove2.gif' width='9'>" : "&nbsp;";?></td>
                <td align="center"><?echo ($guild_permissions[$index]['permission'] &   4) ? "<img src='images/remove2.gif' width='9'>" : "&nbsp;";?></td>
                <td align="center"><?echo ($guild_permissions[$index]['permission'] &   2) ? "<img src='images/remove2.gif' width='9'>" : "&nbsp;";?></td>
                <td align="center"><?echo ($guild_permissions[$index]['permission'] &   1) ? "<img src='images/remove2.gif' width='9'>" : "&nbsp;";?></td>
              </tr>
<?
endfor;
?>
            </table>
          </fieldset>
        </td>
      </tr>
      <tr>
        <td>
          <fieldset>
            <legend><strong>Guild Members</strong> (<a href="index.php?editor=guild&guildid=<?=$id?>&action=6">Add Member</a>)</legend>
            <table cellspacing="0" border="0" width="100%">
              <tr>
                <td align="center"><strong>Rank</strong></td>
                <td><strong>Name</strong></td>
                <td align="center"><strong>Total Tribute</strong></td>
                <td align="center"><strong>Last Donation</strong></td>
                <td align="center"><strong>Tribute Active</strong></td>
                <td align="center"><strong>Banker</strong></td>
                <td align="center"><strong>Alt</strong></td>
                <td align="center"><strong>Public Note</strong></td>
                <td align="center"><strong>Status</strong></td>
                <td align="center">&nbsp;</td>
              </tr>
<?
  $i = 0;
  foreach ($guild_members as $guild_member) {
?>
    <tr>
      <td align="center">
        <div id="current_rank_<?=$i?>" style="display: block;">
          <a title="Change Rank" onClick="showRankChange(<?=$i?>);"><?=$guild_member['rank']?></a>
        </div>
        <div id="new_rank_<?=$i?>" style="display: none;">
          <br>
          <form name="change_rank_<?=$i?>" method="POST" action="index.php?editor=guild&guildid=<?=$id?>&action=9">
            <select name="rank" onChange="document.change_rank_<?=$i?>.submit();">
<?
    foreach ($guild_ranks as $guild_rank) {
?>
              <option value="<?=$guild_rank['rank']?>"<?echo ($guild_rank['rank'] == $guild_member['rank']) ? " selected" : "";?>><?=$guild_rank['rank']?> - <?=$guild_rank['title']?></option>
<?
    }
?>
            </select>
            <input type="hidden" name="char_id" value="<?=$guild_member['char_id']?>">
            <input type="hidden" name="previous_rank" value="<?=$guild_member['rank']?>">
          </form>
        </div>
      </td>
      <td><a href="index.php?editor=player&playerid=<?=$guild_member['char_id']?>"><?=getPlayerName($guild_member['char_id'])?></a></td>
      <td align="center"><?=$guild_member['total_tribute']?></td>
      <td align="center"><?echo ($guild_member['last_tribute'] > 0) ? get_real_time($guild_member['last_tribute']) : "N/A";?></td>
      <td align="center"><?=$yesno[$guild_member['tribute_enable']]?></td>
      <td align="center"><?=$yesno[$guild_member['banker']]?></td>
      <td align="center"><?=$yesno[$guild_member['alt']]?></td>
      <td align="center"><img src="images\note.gif" title="<?echo ($guild_member['public_note'] != '') ? $guild_member['public_note'] : 'N/A';?>"></td>
      <td align="center"><img src="images\<?echo ($guild_member['online'] == 1) ? 'green' : 'red';?>.gif" width="13" title="<?echo ($guild_member['online'] == 1) ? 'Online' : 'Offline';?>"></td>
      <td align="center"><a href="index.php?editor=guild&guildid=<?=$id?>&char_id=<?=$guild_member['char_id']?>&leader=<?echo ($guild_member['rank'] == 2) ? "1" : "0";?>&action=8"><img src="images\delete.gif" width="13" title="Remove from guild"></a></td>
    </tr>
<?
  $i++;
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
                <td align="center"><strong>Area</strong></td>
                <td align="center"><strong>Slot</strong></td>
                <td align="center"><strong>Item</strong></td>
                <td align="center"><strong>Qty</strong></td>
                <td align="center"><strong>Permissions</strong></td>
                <td align="center"><strong>Donated By</strong></td>
                <td align="center"><strong>Intended For</strong></td>
              </tr>
<?
    foreach ($guild_items as $guild_item) {
      echo '<tr>';
      echo '<td align="center">' . (($guild_item['area'] == 0) ? 'Deposit' : 'Bank') . '</td>';
      echo '<td align="center">' . $guild_item['slot'] . '</td>';
      echo '<td align="center">' . get_item_name($guild_item['itemid']) . ' <a href="index.php?editor=items&id=' . $guild_item['itemid'] . '&action=2">' . $guild_item['itemid'] . '</a> [<a href="https://lucy.allakhazam.com/item.html?id=' . $guild_item['itemid'] . '" target="_blank">Lucy</a>]</td>';
      echo '<td align="center">' . $guild_item['qty'] . '</td>';
      echo '<td align="center">' . $bank_permissions[$guild_item['permissions']] . '</td>';
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
