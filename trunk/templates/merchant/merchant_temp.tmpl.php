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
          </tr>
<?$x=0; foreach($slots as $slot=>$v):?>
          <tr<? echo ($x % 2 == 1) ? " bgcolor=\"#BBBBBB" : "";?>">
            <td align="center"><?=$slot?></td>
            <td align="center"><?=$v['itemid']?></td>
            <td><?=$v['item_name']?></td>
            <td><a href="http://lucy.allakhazam.com/item.html?id=<?=$v['itemid']?>">Lucy</a></td>
            <td align="center"><?=$v['charges']?></td>
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