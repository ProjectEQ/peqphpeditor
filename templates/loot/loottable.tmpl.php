<?if (!isset($loottable_id) || !isset($loottable_name)){?>
    <div class="table_container" style="width: 350px">
      <div class="table_header">
        <div style="float: right">
          <a href="index.php?editor=loot&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=11"><img src="images/create.gif" border="0" title="Change LootTable"></a>
        </div>
        No Assigned or Valid Loottable
      </div>
      <div class="table_content">
        <center>
          No Valid Loottable currently assigned.<br/><br/>
          <a href="index.php?editor=loot&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=11">Click here to change</a><br/>
          <a href="index.php?editor=loot&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=46">Click here to import loot from Magelo</a>
        </center>
      </div>
<?} else {?>
      <div class="table_container" style="width: 350px">
        <div class="table_header">
          <div style="float: right">
            <a href="index.php?editor=loot&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=11"><img src="images/create.gif" border="0" title="Change LootTable"></a>&nbsp;
            <a href="index.php?editor=loot&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&ltid=<?=$loottable_id?>&action=36"><img src="images/last.gif" border="0" title="Apply LootTable to Multiple NPCs"></a>&nbsp;
            <a href="index.php?editor=loot&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=34" onClick="return confirm('Really remove this loottable from the selected NPC?');"><img src="images/minus2.gif" border="0" title="Drop this loottable"></a>
            <a onClick="return confirm('Really Delete LootTable <?=$loottable_id?>?');" href="index.php?editor=loot&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=16&ltid=<?=$loottable_id?>"><img src="images/remove3.gif" border="0" title="Delete LootTable"></a>
          </div>
<? 
  $new_loottable_name = substr($loottable_name, 0, 18); 
  if ($new_loottable_name != $loottable_name) 
    $new_loottable_name = "$new_loottable_name...";
?>
          LootTable <?=$loottable_id?>: "<a href="index.php?editor=loot&action=1&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>"><?=$new_loottable_name?></a>"
        </div>
        <div class="table_content">
          Cash loot [<a href="index.php?editor=loot&action=1&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>">edit</a>]:<br/>
          <div style="padding: 5px 0px 0px 20px;">
            Min Cash: <?=$mincash?><br/>
            Max Cash: <?=$maxcash?><br/>
          </div>
          <div style="padding: 10px 0px 0px 0px;">
            NPCs using this loottable: <?=$usage['count']?>
<? if (!isset($_GET['display_usage'])) {?>
            [<a href="index.php?editor=loot&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&display_usage">show</a>]
<? }else {?>
            [<a href="index.php?editor=loot&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>">hide</a>]
<?foreach($usage['mobs'] as $mob):?>
            <br/>&nbsp;&nbsp;&nbsp;<?=$mob['id']?>: <?=$mob['name']?>
<?endforeach;?>
<? } ?>
          </div>
          <div style="padding: 5px 0px 0px 0px;">
            LootDrops associated with this LootTable: <?=$lootdrop_count?> <a href="index.php?editor=loot&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=22&ltid=<?=$loottable_id?>"><img src="images/add.gif" border="0" title="Add a LootDrop to this LootTable"></a>
          </div>
          <div style="padding: 10px 0px 0px 0px;">
            <center><a href="index.php?editor=loot&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=46">Click here to import loot from Magelo</a></center>
          </div>
        </div>
      </div>
<?
  if ($lootdrops != ''):
    foreach ($lootdrops as $lootdrop):
?>
      <br/>
      <div class="table_container">
        <div class="table_header">
          <table width="100%" cellpadding="0" cellspacing="0">
            <tr>
              <td>
                Lootdrop: <a href="index.php?editor=loot&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&ldid=<?=$lootdrop['id']?>&action=33"><?=$lootdrop['id']?></a>
              </td>
<? 
  $newname = substr($lootdrop['name'], 0, 22); 
  if ($newname != $lootdrop['name']) 
    $newname = "$newname...";
?>
              <td>
                "<a href="index.php?editor=loot&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&ldid=<?=$lootdrop['id']?>&action=3"><?=$newname?></a>"
              </td>
              <td>
                Mindrop: <a href="index.php?editor=loot&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&ltid=<?=$loottable_id?>&ldid=<?=$lootdrop['id']?>&action=7"><?=$lootdrop['mindrop']?></a>
              </td>
              <td>
                Droplimit: <a href="index.php?editor=loot&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&ltid=<?=$loottable_id?>&ldid=<?=$lootdrop['id']?>&action=7"><?=$lootdrop['droplimit']?></a>
              </td>
              <td>
                Multiplier: <a href="index.php?editor=loot&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&ltid=<?=$loottable_id?>&ldid=<?=$lootdrop['id']?>&action=7"><?=$lootdrop['multiplier']?></a>
              </td>
              <td>
                Probability: <a href="index.php?editor=loot&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&ltid=<?=$loottable_id?>&ldid=<?=$lootdrop['id']?>&action=7"><?=$lootdrop['probability']?></a>
              </td>
              <td align="right">
                <a href="index.php?editor=loot&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=20&ldid=<?=$lootdrop['id']?>"><img src="images/add.gif" border="0" title="Add an Item to this LootDrop Table"></a>
                <a href="index.php?editor=loot&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=41&ldid=<?=$lootdrop['id']?>"><img src="images/resetpw.gif" border="0" title="Merge this LootDrop"></a>
                <a href="index.php?editor=loot&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=35&ldid=<?=$lootdrop['id']?>&name=<?=$lootdrop['name']?>"><img src="images/last.gif" border="0" title="Copy lootdrop"></a>
                <a onClick="return confirm('Really move multiplier to the items in lootdrop: <?=$lootdrop['id']?>?  The table multiplier will be set to 1.');" href="index.php?editor=loot&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=43&ldid=<?=$lootdrop['id']?>&multiplier=<?=$lootdrop['multiplier']?>"><img src="images/sort.gif" border="0" title="Move mutliplier to items"></a>
                <a onClick="return confirm('Really remove LootDrop <?=$lootdrop['id']?> from LootTable <?=$loottable_id?>?  All <?=$usage['count']?> NPCs that use LootTable <?=$loottable_id?> will be affected.');" href="index.php?editor=loot&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=19&ltid=<?=$loottable_id?>&ldid=<?=$lootdrop['id']?>"><img src="images/minus2.gif" border="0" title="Remove this LootDrop from LootTable <?=$loottable_id?>"></a>
                <a onClick="return confirm('Really delete LootDrop <?=$lootdrop['id']?>?  All LootTables that use this LootDrop will be affected.');" href="index.php?editor=loot&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=26&ldid=<?=$lootdrop['id']?>"><img src="images/remove2.gif" border="0" title="Permanently delete this LootDrop"></a>
              </td>
            </tr>
          </table>
        </div>
        <table class="table_content2" width="100%">
<? if(isset($lootdrop['items']) && $lootdrop['items']): $x=0; ?>
          <tr>
            <th align="center" width="8%">Item ID</th>
            <th align="center" width="36%">Item Name</th>
            <th align="center" width="7%">Equipped?</th>
            <th align="center" width="7%">Charges</th>
            <th align="center" width="7%">MinLevel</th>
            <th align="center" width="7%">MaxLevel</th>
            <th align="center" width="8%">Multiplier</th>
            <th align="center" width="8%">Chance</th>
            <th width="13%"></th>
          </tr>
<?
  foreach ($lootdrop['items'] as $item): extract($item);
    $total = (($chance/100) * ($lootdrop['probability']/100)) * 100;
    $chance_total += $chance;
    if($lootdrop['probability'] == 0)
      $chance = 0;
    if($lootdrop['probability'] > 0 && $lootdrop['probability'] < 100)
      $chance = $total;
    if($lootdrop['probability'] >= 100)
      $chance = $chance; // <- TRUE...
?>
          <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
            <td align="center"><a href="index.php?editor=items&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&id=<?=$item_id?>&action=2"><?=$item_id?></td>
            <td align="center"><?echo (get_item_name($item_id) != "") ? get_item_name($item_id) : "<a title='Item not in database!'>UNKNOWN</a>";?> <span>[<a href="http://lucy.allakhazam.com/item.html?id=<?=$item_id?>" target="_blank">lucy</a>]</span></td>
            <td align="center" width="100"><? echo (($equip_item == 0)) ? "No" : "Yes"; ?></td>
            <td align="center"><?=$item_charges?></td>
            <td align="center"><?=$minlevel?></td>
            <td align="center"><?=$maxlevel?></td>
            <td align="center"><?=$multiplier?></td>
            <td align="center"><?=$chance?></td>
            <td align="right">
              <a href="index.php?editor=loot&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&ldid=<?=$lootdrop['id']?>&itemid=<?=$item_id?>&action=47"><img src="images/minus.gif" border="0" title="Move Lootdrop Item"></a>
              <a href="index.php?editor=loot&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&ldid=<?=$lootdrop['id']?>&itemid=<?=$item_id?>&action=5"><img src="images/edit2.gif" border="0" title="Edit Lootdrop Item"></a>
<? if($disabled_chance == 0 && $chance > 0): ?>
              <a href="index.php?editor=loot&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&ldid=<?=$lootdrop['id']?>&itemid=<?=$item_id?>&chance=<?=$chance?>&action=44"><img src="images/downgrade.gif" border="0" title="Disable Item"></a>
<? endif; ?>
<? if($disabled_chance > 0): ?>
              <a href="index.php?editor=loot&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&ldid=<?=$lootdrop['id']?>&itemid=<?=$item_id?>&dchance=<?=$disabled_chance?>&action=45"><img src="images/upgrade.gif" border="0" title="Enable Item"></a>
<? endif; ?>
              <a onClick="return confirm('Really remove item <?=$item_id?> from LootDrop <?=$lootdrop['id']?>?');" href="index.php?editor=loot&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&ldid=<?=$lootdrop['id']?>&itemid=<?=$item_id?>&action=17"><img src="images/remove3.gif" border="0" title="Remove Item"></a>
            </td>
            <td>&nbsp;</td>
          </tr>
<?
      $x++;
    endforeach;
?>
          <tr bgcolor="#000000">
            <td colspan="10" align="right">
              <a title="Set chance for all items on this table to <?=$normalize_amount?>" href="index.php?editor=loot&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&ldid=<?=$lootdrop['id']?>&action=18" style="color:yellow;">Normalize Drops</a>
            </td>
          </tr>
<?
  endif;
?>
<? if(!isset($lootdrop['items'])):?>
          <tr>
            <td align="left" width="100" style="padding: 10px;">No items currently assigned to this lootdrop</td>
          </tr>
<? endif;?>
        </table>
      </div>
<? endforeach; ?>
    </div>
<? endif;?>
<? } /*endelse*/?>
