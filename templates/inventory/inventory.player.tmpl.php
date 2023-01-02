    <div class="table_container" style="width: 500px;">
      <div class="table_header">
        <table width="100%" cellpadding="0" cellspacing="0">
          <tr>
            <td align="left" width="33%">Player Inventory - <a href="index.php?editor=player&playerid=<?=$playerid?>"><?=getPlayerName($playerid)?></a></td>
            <td align="right" width="5%"><a href="index.php?editor=inv&playerid=<?=$playerid?>&action=4"><img src="images/add.gif" border="0" title="Create a new entry" alt="Create a new entry"></a>
          </tr>
        </table>
      </div>
      <table class="table_content2" width="100%">
<?
$x = 0;
if (isset($inventory) || isset($shared_inventory)):
?>
        <tr>
          <td align="center"><strong>Slot</strong></td>
          <td align="center"><strong>Item</strong></td>
          <td width="10%">&nbsp;</td>
        </tr>
<?
endif;
if (isset($inventory)):
  foreach ($inventory as $inv):
    extract($inv);
?>
        <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
          <td>&nbsp;&nbsp;&nbsp;<?=$inv['slotid']?> - <?=$slots[$inv['slotid']]?></td>
          <td align="center"><?=get_item_name($inv['itemid'])?> (<?=$inv['itemid']?>) - [<a href="https://lucy.allakhazam.com/item.html?id=<?=$inv['itemid']?>" target="_blank">Lucy</a>]</td>
          <td align="right"><a href="index.php?editor=inv&playerid=<?=$inv['charid']?>&slotid=<?=$inv['slotid']?>&action=6"><img src="images/edit2.gif" width="13" height="13" border="0" title="View/Edit Entry" alt="View/Edit Entry"></a>&nbsp;<a onClick="return confirm('Really delete this entry?');" href="index.php?editor=inv&playerid=<?=$inv['charid']?>&slotid=<?=$inv['slotid']?>&action=8"><img src="images/remove3.gif" border="0" title="Delete Entry" alt="Delete Entry"></a></td>
        </tr>
<?
    $x++;
  endforeach;
endif;
if (isset($shared_inventory)):
  foreach ($shared_inventory as $s_inv):
    extract($s_inv);
?>
        <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
          <td>&nbsp;&nbsp;&nbsp;<?=$s_inv['slotid']?> - <?=$slots[$s_inv['slotid']]?></td>
          <td align="center"><?=get_item_name($s_inv['itemid'])?> (<?=$s_inv['itemid']?>) - [<a href="https://lucy.allakhazam.com/item.html?id=<?=$s_inv['itemid']?>" target="_blank">Lucy</a>]</td>
          <td align="right">&nbsp;</td>
        </tr>
<?
    $x++;
  endforeach;
endif;
if ($x == 0):
?>
        <tr>
          <td colspan="3" align="left" width="100" style="padding: 10px;">No Inventory</td>
        </tr>
<?endif;?>
      </table>
    </div>
