<?if (!isset($loottable_id) || !isset($loottable_name)){?>
      <div class="table_container" style="width: 350px">
        <div class="table_header">
        <div style="float: right">
          <a href="index.php?editor=loot&z=<?=$currzone?>&npcid=<?=$npcid?>&action=11"><img src="images/create.gif" border="0" title="Change LootTable"></a>
        </div>
        No Assigned or Valid Loottable
      </div>
      <div class="table_content">
        <center>
          No Valid Loottable currently assigned.<br><br>
          <a href="index.php?editor=loot&z=<?=$currzone?>&npcid=<?=$npcid?>&action=11">Click here to change</a>
        </center>
      </div>
<?} else {?>
      <div class="table_container" style="width: 350px">
        <div class="table_header">
        <div style="float: right">
          <a href="index.php?editor=loot&z=<?=$currzone?>&npcid=<?=$npcid?>&action=11"><img src="images/create.gif" border="0" title="Change LootTable"></a>&nbsp;
          <a onClick="return confirm('Really Delete LootTable <?=$loottable_id?>?');" href="index.php?editor=loot&z=<?=$currzone?>&npcid=<?=$npcid?>&action=16&ltid=<?=$loottable_id?>"><img src="images/remove3.gif" border="0" title="Delete LootTable"></a>
        </div>
        LootTable <?=$loottable_id?>: "<a href="index.php?editor=loot&action=1&z=<?=$currzone?>&npcid=<?=$npcid?>"><?=$loottable_name?></a>"
      </div>
      <div class="table_content">
        Cash loot [<a href="index.php?editor=loot&action=1&z=<?=$currzone?>&npcid=<?=$npcid?>">edit</a>]:<br>
      <div style="padding: 5px 0px 0px 20px;">
        Min Cash: <?=$mincash?><br>
        Max Cash: <?=$maxcash?><br>
        Avg Coin: <?=$avgcoin?><br>
      </div>

      <div style="padding: 10px 0px 0px 0px;">
            NPCs using this loottable: <?=$usage['count']?>
<? if (!isset($_GET['display_usage'])) {?>
            [<a href="index.php?editor=loot&z=<?=$currzone?>&npcid=<?=$npcid?>&display_usage">show</a>]
<? }else {?>
            [<a href="index.php?editor=loot&z=<?=$currzone?>&npcid=<?=$npcid?>">hide</a>]
<?foreach($usage['mobs'] as $mob):?>
            <br>&nbsp;&nbsp;&nbsp;<?=$mob['id']?>: <?=$mob['name']?>
<?endforeach;?>
<? } ?>
        </div>

        <div style="padding: 5px 0px 0px 0px;">
            LootDrops associated with this LootTable: <?=$lootdrop_count?> <a href="index.php?editor=loot&z=<?=$currzone?>&npcid=<?=$npcid?>&action=22&ltid=<?=$loottable_id?>"><img src="images/add.gif" border="0" title="Add a LootDrop to this LootTable"></a>
        </div>
        </div>
      </div>


<?php if ($lootdrops != ''):?>
<?php foreach ($lootdrops as $lootdrop): ?>
      <br>
      <div class="table_container">
      <div class="table_header">
        <table width="100%" cellpadding="0" cellspacing="0">
          <tr>
            <td>
              Lootdrop: <a href="index.php?editor=loot&z=<?=$currzone?>&npcid=<?=$npcid?>&ldid=<?=$lootdrop['id']?>&action=33"><?=$lootdrop['id']?></a>
        </div>
        </div>

            </td>
            <td>
              "<a href="index.php?editor=loot&z=<?=$currzone?>&npcid=<?=$npcid?>&ldid=<?=$lootdrop['id']?>&action=3"><?=$lootdrop['name']?></a>"
            </td>
            <td>
              Probability: <a href="index.php?editor=loot&z=<?=$currzone?>&npcid=<?=$npcid?>&ltid=<?=$loottable_id?>&ldid=<?=$lootdrop['id']?>&action=7"><?=$lootdrop['probability']?></a>
            </td>
            <td>
        Multiplier: <a href="index.php?editor=loot&z=<?=$currzone?>&npcid=<?=$npcid?>&ltid=<?=$loottable_id?>&ldid=<?=$lootdrop['id']?>&action=7"><?=$lootdrop['multiplier']?></a>
            </td>
            <td align="right">
              <a href="index.php?editor=loot&z=<?=$currzone?>&npcid=<?=$npcid?>&action=20&ldid=<?=$lootdrop['id']?>">
                <img src="images/add.gif" border="0" title="Add an Item to this LootDrop Table">
              </a>
              
              <a onClick="return confirm('Really remove LootDrop <?=$lootdrop['id']?> from LootTable <?=$loottable_id?>?  All <?=$usage['count']?> NPCs that use LootTable 5370 will be affected.');" href="index.php?editor=loot&z=<?=$currzone?>&npcid=<?=$npcid?>&action=19&ltid=<?=$loottable_id?>&ldid=<?=$lootdrop['id']?>">
                <img src="images/minus2.gif" border="0" title="Remove this LootDrop from LootTable <?=$loottable_id?>">
              </a>

          <a onClick="return confirm('Really delete LootDrop <?=$lootdrop['id']?>?  All LootTables that use this LootDrop will be affected.');" href="index.php?editor=loot&z=<?=$currzone?>&npcid=<?=$npcid?>&action=26&ldid=<?=$lootdrop['id']?>"><img src="images/remove2.gif" border="0" title="Permanently delete this LootDrop"></a>
            </td>
          </tr>
        </table>
      </div>

      <table class="table_content2" width="100%">
<?php if(isset($lootdrop['items']) && $lootdrop['items']): $x=0;?>
        <tr>
          <th align="center" width="8%">Item ID</th>
          <th align="center" width="45%">Item Name</th>
          <th align="center" width="10%">Equipped?</th>
          <th align="center" width="10%">Charges</th>
          <th align="center" width="10%">Drop Chance</th>
          <th align="center" width="10%">Overall Chance</th>
          <th width="5%"></th>
        </tr>
<?php foreach ($lootdrop['items'] as $item): extract($item);?>
<?php ($total = (($chance/100) * ($lootdrop['probability']/100)) * 100);?>
        <tr bgcolor="#<? echo ($x % 2 == 0) ? "AAAAAA" : "BBBBBB";?>">
          <td align="center"><?=$item_id?></td>
          <td align="center"><?=$name?> <span>[<a href="http://lucy.allakhazam.com/item.html?id=<?=$item_id?>">lucy</a>]</span></td>
          <td align="center" width="100">
<?php echo (($equip_item == 0)) ? "No" : "Yes";?>
          </td>
          <td align="center">
            <?=$item_charges?>
          </td>
          <td align="center">
            <?=$chance?>%</td>
          <td align="center">
            <?=$total?>%
           </td>
          <td align="right">
            <a href="index.php?editor=loot&z=<?=$currzone?>&npcid=<?=$npcid?>&ldid=<?=$lootdrop['id']?>&itemid=<?=$item_id?>&action=5">
              <img src="images/edit2.gif" border="0" title="Edit Lootdrop Item">
            </a>
          
            <a onClick="return confirm('Really remove item <?=$item_id?> from LootDrop <?=$lootdrop['id']?>?');" href="index.php?editor=loot&z=<?=$currzone?>&npcid=<?=$npcid?>&ldid=<?=$lootdrop['id']?>&itemid=<?=$item_id?>&action=17">
              <img src="images/remove3.gif" border="0" title="Remove Item">
            </a>
          </td>
        </tr>
<?php $x++; endforeach;?>
        <tr>
          <td align="right" colspan="6">
            <a href="index.php?editor=loot&z=<?=$currzone?>&npcid=<?=$npcid?>&ldid=<?=$lootdrop['id']?>&action=18">Balance Item Drop Rate</a>
          </td>
        </tr>
<?php endif;?>
<?php if(!isset($lootdrop['items'])):?>
        <tr>
          <td align="left" width="100" style="padding: 10px;">No items currently assigned to this lootdrop</td>
        </tr>
<?php endif;?>
      </table>
      </div>
<?php endforeach; ?>
<?php endif;?>
<? } /*endelse*/?>
