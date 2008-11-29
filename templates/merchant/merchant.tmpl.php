<?if ($id != 0):?>
      <div class="table_container" style="width: 500px;">
         <div class="table_header">
           <div style="float:right;">
             <a href="index.php?editor=merchant&z=<?=$currzone?>&npcid=<?=$npcid?>&mid=<?=$id?>&action=4"><img src="images/add.gif" border=0 title="Add an Item"></a>&nbsp;
             <a href="index.php?editor=merchant&z=<?=$currzone?>&npcid=<?=$npcid?>&action=1"><img src="images/c_table.gif" border=0 title="Edit this Merchant"></a>&nbsp;
             <a href="index.php?editor=merchant&z=<?=$currzone?>&npcid=<?=$npcid?>&mid=<?=$id?>&action=6" onClick="return confirm('Really delete this merchantlist?');">
               <img src="images/table.gif" border=0 title="Delete this Merchantlist">
             </a>
           </div>
           Merchant ID: <?=$id?>
         </div>
         <div class="table_content" style="padding: 0px;">
<? if (isset($slots)):?>
        <table width="100%">
          <tr>
            <th align="center">Slot</th>
            <th align="center">Item ID</th>
            <th>Item</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
          </tr>
<?$x=0; foreach($slots as $slot=>$v):?>
          <tr<? echo ($x % 2 == 1) ? " bgcolor=\"#BBBBBB" : "";?>">
            <td align="center"><?=$slot?></td>
            <td align="center"><?=$v['item']?></td>
            <td><?=$v['item_name']?></td>
            <td><a href="http://lucy.allakhazam.com/item.html?id=<?=$v['item']?>">Lucy</a></td>
            <td align="right" style="padding-right: 10px;">
              <a href="index.php?editor=merchant&z=<?=$currzone?>&npcid=<?=$npcid?>&mid=<?=$id?>&slot=<?=$slot?>&id=<?=$v['item']?>&action=3" onClick="return confirm('Really remove this item from the merchant?');">
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
<?endif;?>
<?if ($id == 0):?>
      <center>
      <div style="width: 350px; border: 1px solid black;">
        <div class="table_header" align="left">
        Merchant ID: <?=$id?>
      </div>
      <div class="table_content">
        No Merchantlist currently assigned.<br><br>
        <a href="index.php?editor=npc&z=<?=$currzone?>&npcid=<?=$npcid?>&action=22">Click here to change</a>
       </center>
<?endif;?>
