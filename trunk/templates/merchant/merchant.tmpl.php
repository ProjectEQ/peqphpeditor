<?if ($id != 0):?>
  <div class="table_container" style="width: 650px;">
    <div class="table_header">
      <div style="float:right;">
        <a href="index.php?editor=merchant&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=8">Temp List</a>&nbsp;
        <div style="display:<?echo (isset($slots)) ? "inline" : "none";?>">
          <a href="index.php?editor=merchant&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=19"><img src="images/sort.gif" border="0" title="Sort this merchantlist"></a>&nbsp;
        </div>
        <a href="index.php?editor=merchant&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&mid=<?=$id?>&action=4"><img src="images/add.gif" border="0" title="Add an Item"></a>&nbsp;
        <div style="display:<?echo (isset($slots)) ? "inline" : "none";?>">
          <a href="index.php?editor=merchant&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=1"><img src="images/c_table.gif" border="0" title="Edit this Merchant"></a>&nbsp;
        </div>
        <a href="index.php?editor=merchant&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&mid=<?=$id?>&action=20"><img src="images/resetpw.gif" border="0" title="Change merchantlist to use NPC ID if used by no other NPCs"></a>&nbsp;
        <div style="display:<?echo (isset($slots)) ? "inline" : "none";?>">
          <a href="index.php?editor=merchant&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&mid=<?=$id?>&action=18" onClick="return confirm('Really Copy Merchant <?=$id?>?');"><img src="images/last.gif" border="0" title="Copy this merchantlist"></a>&nbsp;
          <a href="index.php?editor=merchant&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&mid=<?=$id?>&action=17" onClick="return confirm('Really remove this merchantlist from the selected NPC?');"><img src="images/minus2.gif" border="0" title="Drop this Merchantlist"></a>&nbsp;
        </div>
        <a href="index.php?editor=merchant&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&mid=<?=$id?>&action=6" onClick="return confirm('Really delete this merchantlist? This will affect all NPCs that share the list!');"><img src="images/table.gif" border="0" title="Delete this Merchantlist"></a>
      </div>
      Merchant ID: <a href="index.php?editor=merchant&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&merid=<?=$id?>&action=16"><?=$id?></a>
    </div>
    <div class="table_content" style="padding: 0px;">
<? if (isset($slots)):?>
      <table width="100%">
        <tr bgcolor="#BBBBBB">
          <th align="center">Slot</th>
          <th align="center">Item<br/>ID</th>
          <th>Item<br/>Name</th>
          <th>&nbsp;</th>
          <th>Buy<br/>Price</th>
          <th>Sell<br/>Price</th>
          <th>Fact<br/>Req</th>
          <th>Lvl<br/>Req</th>
          <th>Alt<br/>Cur</th>
          <th>Class<br/>Req</th>
          <th>&nbsp;</th>
        </tr>
<?
$x=0;
foreach($slots as $slot=>$v):
  if ($v['price']*0.95 > 999) {
    $cost = $v['price']*0.95/1000;
  }
  if ($v['price']*$v['sellrate']*1.05 > 999) {
    $sells = ($v['price']*$v['sellrate']*1.05)/1000;
  }
  if ($v['price']*0.95 < 999 && $v['price']*0.95 > 99) {
    $cost = $v['price']*0.95/100;
  }
  if ($v['price']*$v['sellrate']*1.05 < 999 && $v['price']*$v['sellrate']*1.05 > 99) {
    $sells = ($v['price']*$v['sellrate']*1.05)/100;
  }
  if ($v['price']*0.95 < 99 && $v['price']*0.95 > 9) {
    $cost = $v['price']*0.95/10;
  }
  if ($v['price']*$v['sellrate']*1.05 < 99 && $v['price']*$v['sellrate']*1.05 > 9) {
    $sells = ($v['price']*$v['sellrate']*1.05)/10;
  }
  if ($v['price']*0.95 < 10) {
    $cost = $v['price']*0.95;
  }
  if ($v['price']*$v['sellrate']*1.05 < 10) {
    $sells = ($v['price']*$v['sellrate']*1.05);
  }
?>
        <tr<? echo ($x % 2 == 1) ? " bgcolor=\"#BBBBBB\"" : "";?>>
          <td align="center"><?=$slot?></td>
          <td align="center"><a href="index.php?editor=items&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&id=<?=$v['item']?>&action=2"><?=$v['item']?></a></td>
          <td><?=$v['item_name']?></td>
          <td><a href="http://lucy.allakhazam.com/item.html?id=<?=$v['item']?>">Lucy</a></td>
<?php
$round_cost = round($cost,3);
$round_sells = round($sells,3);
?>
          <td align="center"><?=$round_cost?>
<?if ($v['price']*0.95 > 999):?>
            pp
<?endif;?>
<?if ($v['price']*0.95 < 1000 && $v['price']*0.95 > 99):?>
            gp
<?endif;?>
<?if ($v['price']*0.95 < 100 && $v['price']*0.95 > 9.9):?>
            sp
<?endif;?>
<?if ($v['price']*0.95 < 10):?>
            cp
<?endif;?>
          </td>
          <td align="center"><?=$round_sells?>
<?if ($v['price']*$v['sellrate']*1.05 > 999):?>
            pp
<?endif;?>
<?if ($v['price']*$v['sellrate']*1.05 < 999 && $v['price']*$v['sellrate']*1.05 > 99):?>
            gp
<?endif;?>
<?if ($v['price']*$v['sellrate']*1.05 < 99 && $v['price']*$v['sellrate']*1.05 > 9):?>
            sp
<?endif;?>
<?if ($v['price']*$v['sellrate']*1.05 < 10):?>
            cp
<?endif;?>
          </td>
          <td align="center"><?=$v['faction_required']?></td>
          <td align="center"><?=$v['level_required']?></td>
          <td align="center"><?=$v['alt_currency_cost']?></td>
          <td align="center"><?echo ($v['classes_required'] == 65535) ? "N" : "Y";?></td>
          <td align="right" style="padding-right: 10px;">
            <a href="index.php?editor=merchant&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&mid=<?=$id?>&slot=<?=$slot?>&id=<?=$v['item']?>&action=3" onClick="return confirm('Really remove this item from the merchant?');"><img src="images/remove.gif" border="0" title="Delete item from Merchantlist"></a>
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
  <table class="edit_form">
    <tr>
      <td class="edit_form_header">Merchant ID: <?=$id?></td>
    </tr>
    <tr>
      <td class="edit_form_content">
        No Merchantlist currently assigned.<br/><br/>
        <center><a href="index.php?editor=npc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=22">Click here to change</a></center>
      </td>
    </tr>
  </table>
<?endif;?>
