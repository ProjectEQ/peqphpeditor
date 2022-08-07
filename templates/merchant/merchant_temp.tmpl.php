  <div class="table_container" style="width: 700px;">
    <div class="table_header">
      <div style="float:right;">
        <a href="index.php?editor=merchant&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>">Standard List</a>&nbsp;
        <a href="index.php?editor=merchant&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=12"><img src="images/add.gif" border="0" title="Add an Item"></a>&nbsp;
        <div style="display:<?echo (isset($slots)) ? "inline" : "none";?>">
          <a href="index.php?editor=merchant&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=9"><img src="images/c_table.gif" border="0" title="Edit this Merchant"></a>&nbsp;
        </div>
        <a href="index.php?editor=merchant&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=14" onClick="return confirm('Really delete this merchantlist?');"><img src="images/table.gif" border="0" title="Delete this Merchantlist"></a>
      </div>
      Temp Merchant List
    </div>
    <div class="table_content" style="padding: 0px;">
<? if (isset($slots)):?>
      <table width="100%">
        <tr bgcolor="#BBBBBB">
          <th align="center">Slot</th>
          <th align="center">Zone</th>
          <th align="center">Instance</th>
          <th align="center">Item ID</th>
          <th>Item Name</th>
          <th>&nbsp;</th>
          <th>Charges</th>
          <th>Buy Price</th>
          <th>Sell Price</th>
          <th>&nbsp;</th>
        </tr>
<?
$x=0;
foreach($slots as $slot=>$v):
  if ($v['price'] > 999) {
    $cost = $v['price']/1000;
  }
  if ($v['price']*$v['sellrate'] > 999) {
    $sells = ($v['price']*$v['sellrate'])/1000;
  }
  if ($v['price'] < 999 && $v['price'] > 99) {
    $cost = $v['price']/100;
  }
  if ($v['price']*$v['sellrate'] < 999 && $v['price']*$v['sellrate'] > 99) {
    $sells = ($v['price']*$v['sellrate'])/100;
  }
  if ($v['price'] < 99 && $v['price'] > 9) {
    $cost = $v['price']/10;
  }
  if ($v['price']*$v['sellrate'] < 99 && $v['price']*$v['sellrate'] > 9) {
    $sells = ($v['price']*$v['sellrate'])/10;
  }
  if ($v['price'] < 10) {
    $cost = $v['price'];
  }
  if ($v['price']*$v['sellrate'] < 10) {
    $sells = ($v['price']*$v['sellrate']);
  }
?>
        <tr<? echo ($x % 2 == 1) ? " bgcolor=\"#BBBBBB\"" : "";?>>
          <td align="center"><?=$slot?></td>
          <td align="center"><?=$zoneids[$v['zone_id']]?> (<?=$v['zone_id']?>)</td>
          <td align="center"><?=$v['instance_id']?></td>
          <td align="center"><?=$v['itemid']?></td>
          <td><?=$v['item_name']?></td>
          <td>[<a href="https://lucy.allakhazam.com/item.html?id=<?=$v['itemid']?>" target="_blank">Lucy</a>]</td>
          <td align="center"><?=$v['charges']?></td>
          <td align="center"><?=$cost?>
<?if ($v['price'] > 999):?>
            pp
<?endif;?>
<?if ($v['price'] < 999 && $v['price'] > 99):?>
            gp
<?endif;?>
<?if ($v['price'] < 99 && $v['price'] > 9):?>
            sp
<?endif;?>
<?if ($v['price'] < 10):?>
            cp
<?endif;?>
          </td>
          <td align="center"><?=$sells?>
<?if ($v['price']*$v['sellrate'] > 999):?>
            pp
<?endif;?>
<?if ($v['price']*$v['sellrate'] < 999 && $v['price']*$v['sellrate'] > 99):?>
            gp
<?endif;?>
<?if ($v['price']*$v['sellrate'] < 99 && $v['price']*$v['sellrate'] > 9):?>
            sp
<?endif;?>
<?if ($v['price']*$v['sellrate'] < 10):?>
            cp
<?endif;?>
          </td>
          <td align="right" style="padding-right: 10px;">
            <a href="index.php?editor=merchant&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&slot=<?=$slot?>&zone_id=<?=$v['zone_id']?>&instance_id=<?=$v['instance_id']?>&itemid=<?=$v['itemid']?>&action=11" onClick="return confirm('Really remove this item from the merchant?');"><img src="images/remove.gif" border="0" title="Delete item from Merchantlist"></a>
          </td>
        </tr>
<?$x++;endforeach;?>
      </table>
<?endif;?>
<?if (!isset($slots)):?>
      No temp wares
<?endif;?>
    </div>
  </div>
