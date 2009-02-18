      <div class="table_container" style="width: 500px;">
         <div class="table_header">
           <div style="float:right;">
             <a href="index.php?editor=merchant&z=<?=$currzone?>&npcid=<?=$npcid?>&action=12"><img src="images/add.gif" border=0 title="Add an Item"></a>&nbsp;
             <a href="index.php?editor=merchant&z=<?=$currzone?>&npcid=<?=$npcid?>&action=9"><img src="images/c_table.gif" border=0 title="Edit this Merchant"></a>&nbsp;
             <a href="index.php?editor=merchant&z=<?=$currzone?>&npcid=<?=$npcid?>&action=14" onClick="return confirm('Really delete this merchantlist?');">
               <img src="images/table.gif" border=0 title="Delete this Merchantlist">
             </a>
           </div>
           Temp Merchant list for NPC <?=$npcid?>
         </div>
         <div class="table_content" style="padding: 0px;">
<? if (isset($slots)):?>
        <table width="100%">
          <tr>
            <th align="center">Slot</th>
            <th align="center">Item ID</th>
            <th>Item</th>
            <th>&nbsp;</th>
            <th>Charges</th>
            <th>Buy for:</th>
            <th>Sell for:</th>
          </tr>
<?$x=0; foreach($slots as $slot=>$v):?>
<?if ($v['price'] > 999):?>
<?php ($cost = $v['price']/1000);?>
<?endif;?>
<?if ($v['price']*$v['sellrate'] > 999):?>
            <?php ($sells = ($v['price']*$v['sellrate'])/1000);?>
<?endif;?>
<?if ($v['price'] < 999 && $v['price'] > 99):?>
<?php ($cost = $v['price']/100);?>
<?endif;?>
<?if ($v['price']*$v['sellrate'] < 999 && $v['price']*$v['sellrate'] > 99):?>
            <?php ($sells = ($v['price']*$v['sellrate'])/100);?>
<?endif;?>
<?if ($v['price'] < 99 && $v['price'] > 9):?>
<?php ($cost = $v['price']/10);?>
<?endif;?>
<?if ($v['price']*$v['sellrate'] < 99 && $v['price']*$v['sellrate'] > 9):?>
            <?php ($sells = ($v['price']*$v['sellrate'])/10);?>
<?endif;?>
<?if ($v['price'] < 10):?>
<?php ($cost = $v['price']);?>
<?endif;?>
<?if ($v['price']*$v['sellrate'] < 10):?>
            <?php ($sells = ($v['price']*$v['sellrate']));?>
<?endif;?>

          <tr<? echo ($x % 2 == 1) ? " bgcolor=\"#BBBBBB" : "";?>">
            <td align="center"><?=$slot?></td>
            <td align="center"><?=$v['itemid']?></td>
            <td><?=$v['item_name']?></td>
            <td><a href="http://lucy.allakhazam.com/item.html?id=<?=$v['itemid']?>">Lucy</a></td>
            <td align="center"><?=$v['charges']?></td>
            <?if ($v['price'] > 999):?>
            <td><?=$cost?>pp</td>
<?endif;?>
<?if ($v['price'] < 999 && $v['price'] > 99):?>
            <td><?=$cost?>gp</td>
<?endif;?>
<?if ($v['price'] < 99 && $v['price'] > 9):?>
            <td><?=$cost?>sp</td>
<?endif;?>
<?if ($v['price'] < 10):?>
            <td><?=$cost?>cp</td>
<?endif;?>
<?if ($v['price']*$v['sellrate'] > 999):?>
            <td><?=$sells?>pp</td>
<?endif;?>
<?if ($v['price']*$v['sellrate'] < 999 && $v['price']*$v['sellrate'] > 99):?>
            <td><?=$sells?>gp</td>
<?endif;?>
<?if ($v['price']*$v['sellrate'] < 99 && $v['price']*$v['sellrate'] > 9):?>
            <td><?=$sells?>sp</td>
<?endif;?>
<?if ($v['price']*$v['sellrate'] < 10):?>
            <td><?=$sells?>cp</td>
<?endif;?>
            <td align="right" style="padding-right: 10px;">
              <a href="index.php?editor=merchant&z=<?=$currzone?>&npcid=<?=$npcid?>&slot=<?=$slot?>&itemid=<?=$v['itemid']?>&action=11" onClick="return confirm('Really remove this item from the merchant?');">
                <img src="images/remove.gif" border="0" title="Delete item from Merchantlist">
              </a>
            </td>
          </tr>
<?$x++;endforeach;?>
        </table>
<?endif;?>
<? if (!isset($slots)):?>
        No Wares currently assigned
<?endif;?>
         </div>
        </div>