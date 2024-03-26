<?if (!isset($_GET['z']) || ($_GET['zoneid'] == 0)) {?>
    <div class="table_container" style="width: 350px;">
      <div class="table_header">
        No Assigned or Valid Loottable
      </div>
      <div class="table_content">
        <center>
          No Valid Loottable Currently Assigned<br><br>
        </center>
      </div>
    </div>
<?} elseif (!isset($loottable_id) || !isset($loottable_name)){?>
    <div class="table_container" style="width: 350px;">
      <div class="table_header">
        <div style="float: right;">
          <a href="index.php?editor=loot&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=11"><img src="images/create.gif" border="0" title="Change LootTable"></a>
        </div>
        No Assigned or Valid Loottable
      </div>
      <div class="table_content">
        <center>
          No Valid Loottable Currently Assigned<br><br>
          <a href="index.php?editor=loot&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=11">Click here to change</a><br>
          <a href="index.php?editor=loot&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=46">Click here to import loot from Magelo</a>
        </center>
      </div>
    </div>
<?} else {?>
      <div class="table_container" style="width: 350px">
        <div class="table_header">
          <div style="float: right;">
            <a href="index.php?editor=loot&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=11"><img src="images/create.gif" border="0" title="Change Loottable"></a>&nbsp;
            <a href="index.php?editor=loot&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&ltid=<?=$loottable_id?>&action=36"><img src="images/last.gif" border="0" title="Apply Loottable to Multiple NPCs"></a>&nbsp;
            <a href="index.php?editor=loot&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=34" onClick="return confirm('Really remove this loottable from the selected NPC?');"><img src="images/minus2.gif" border="0" title="Drop this Loottable"></a>
            <a onClick="return confirm('Really Delete Loottable <?=$loottable_id?>?');" href="index.php?editor=loot&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=16&ltid=<?=$loottable_id?>"><img src="images/remove3.gif" border="0" title="Delete Loottable"></a>
          </div>
<? 
  $new_loottable_name = substr($loottable_name, 0, 18); 
  if ($new_loottable_name != $loottable_name) 
    $new_loottable_name = "$new_loottable_name...";
?>
          Loottable <?=$loottable_id?>: "<a href="index.php?editor=loot&action=1&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>"><?=$new_loottable_name?></a>"
        </div>
        <div class="table_content">
          <strong>Cash Loot [<a href="index.php?editor=loot&action=1&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>">edit</a>]:</strong><br>
          <div style="padding: 5px 0px 0px 20px;">
            <strong>Min Cash:</strong> <?=$mincash?><br>
            <strong>Max Cash:</strong> <?=$maxcash?><br>
          </div><br>
          <strong>Content Control:</strong>
          <div style="padding: 5px 0px 0px 20px;">
            <strong>Min Expansion:</strong> <?=$min_expansion?><br>
            <strong>Max Expansion:</strong> <?=$max_expansion?><br>
            <strong>Content Flags:</strong> <?echo ($content_flags != "") ? $content_flags : "N/A";?><br>
            <strong>Content Flags Disabled:</strong> <?echo ($content_flags_disabled != "") ? $content_flags_disabled : "N/A";?><br>
          </div>
          <div style="padding: 10px 0px 0px 0px;">
            <strong>NPCs using this loottable:</strong> <?=$usage['count']?>
<? if (!isset($_GET['display_usage'])) {?>
            [<a href="index.php?editor=loot&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&display_usage">show</a>]
<? }else {?>
            [<a href="index.php?editor=loot&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>">hide</a>]
<?foreach($usage['mobs'] as $mob):?>
            <br>&nbsp;&nbsp;&nbsp;<?=$mob['id']?>: <?=$mob['name']?>
<?endforeach;?>
<? } ?>
        </div>
          <div style="padding: 5px 0px 0px 0px;">
            <strong>Lootdrops associated with this loottable:</strong> <?=$lootdrop_count?> <a href="index.php?editor=loot&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=22&ltid=<?=$loottable_id?>"><img src="images/add.gif" border="0" title="Add a Lootdrop to this Loottable"></a>
          </div>
          <div style="padding: 10px 0px 0px 0px;">
            <center><a href="index.php?editor=loot&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=46">Click here to import loot from Magelo</a></center>
          </div>
        </div>
      </div><br>
<?
  if ($lootdrops != ''):
    foreach ($lootdrops as $lootdrop):
?>
      <div class="table_container">
        <div class="table_header">
          <table width="100%" cellpadding="0" cellspacing="0">
            <tr>
              <td>
                Lootdrop: <a href="index.php?editor=loot&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&ldid=<?=$lootdrop['id']?>&action=33" title="Loottables Using this Lootdrop"><?=$lootdrop['id']?></a>
              </td>
<? 
  $newname = substr($lootdrop['name'], 0, 22); 
  if ($newname != $lootdrop['name']) 
    $newname = "$newname...";
?>
              <td>
                "<a href="index.php?editor=loot&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&ltid=<?=$loottable_id?>&ldid=<?=$lootdrop['id']?>&action=7"><?=$newname?></a>"
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
                <a href="index.php?editor=loot&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=20&ldid=<?=$lootdrop['id']?>"><img src="images/add.gif" border="0" title="Add an Item to this Lootdrop"></a>
                <a href="index.php?editor=loot&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=41&ldid=<?=$lootdrop['id']?>"><img src="images/resetpw.gif" border="0" title="Merge this Lootdrop"></a>
                <a href="index.php?editor=loot&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=35&ldid=<?=$lootdrop['id']?>&name=<?=$lootdrop['name']?>"><img src="images/last.gif" border="0" title="Copy Lootdrop"></a>
                <a onClick="return confirm('Really move multiplier to the items in lootdrop: <?=$lootdrop['id']?>?  The table multiplier will be set to 1.');" href="index.php?editor=loot&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=43&ldid=<?=$lootdrop['id']?>&multiplier=<?=$lootdrop['multiplier']?>"><img src="images/sort.gif" border="0" title="Move Mutliplier to Items"></a>
                <a onClick="return confirm('Really remove Lootdrop <?=$lootdrop['id']?> from Loottable <?=$loottable_id?>?  All <?=$usage['count']?> NPCs that use loottable <?=$loottable_id?> will be affected.');" href="index.php?editor=loot&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=19&ltid=<?=$loottable_id?>&ldid=<?=$lootdrop['id']?>"><img src="images/minus2.gif" border="0" title="Remove this Lootdrop from Loottable <?=$loottable_id?>"></a>
                <a onClick="return confirm('Really delete Lootdrop <?=$lootdrop['id']?>?  All Loottables that use this lootdrop will be affected.');" href="index.php?editor=loot&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=26&ldid=<?=$lootdrop['id']?>"><img src="images/remove2.gif" border="0" title="Permanently Delete this Lootdrop"></a>
              </td>
            </tr>
          </table>
        </div>
        <table class="table_content2" width="100%">
<? if(isset($lootdrop['items']) && $lootdrop['items']): $x=0; ?>
          <tr>
            <th align="center" width="8%">Item ID</th>
            <th align="center" width="36%">Item Name</th>
            <th align="center" width="7%">Equip</th>
            <th align="center" width="7%">Charges</th>
            <th align="center" width="7%">Trivial<br>Min</th>
            <th align="center" width="7%">Trivial<br>Max</th>
            <th align="center" width="8%">Mult</th>
            <th align="center" width="8%">Chance</th>
            <th width="13%">&nbsp;</th>
          </tr>
<?
  $chance_total = 0;
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
            <td align="center"><a href="index.php?editor=items&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&id=<?=$item_id?>&action=2"><?=$item_id?></a></td>
            <td align="center"><?echo (get_item_name($item_id) != "") ? get_item_name($item_id) : "<a title='Item not in database!'>UNKNOWN</a>";?> <span>[<a href="https://lucy.allakhazam.com/item.html?id=<?=$item_id?>" target="_blank">Lucy</a>]</span></td>
            <td align="center" width="100"><? echo (($equip_item == 0)) ? "No" : "Yes"; ?></td>
            <td align="center"><?=$item_charges?></td>
            <td align="center"><?=$trivial_min_level?></td>
            <td align="center"><?=$trivial_max_level?></td>
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
              <a onClick="return confirm('Really remove item <?=$item_id?> from Lootdrop <?=$lootdrop['id']?>?');" href="index.php?editor=loot&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&ldid=<?=$lootdrop['id']?>&itemid=<?=$item_id?>&action=17"><img src="images/remove3.gif" border="0" title="Remove Item"></a>
            </td>
            <td>&nbsp;</td>
          </tr>
<?
      $x++;
    endforeach;
?>
          <tr bgcolor="#000000">
            <td colspan="2">
              <a href="index.php?editor=loot&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&ltid=<?=$loottable_id?>&ldid=<?=$lootdrop['id']?>&action=7" style="color:yellow;">Expansion Flags: <?echo ($lootdrop['min_expansion'] > 0 || $lootdrop['max_expansion'] > 0) ? "Yes" : "No";?></a>
            </td>
            <td colspan="4">
              <a href="index.php?editor=loot&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&ltid=<?=$loottable_id?>&ldid=<?=$lootdrop['id']?>&action=7" style="color:yellow;">Content Flags: <?echo ($lootdrop['content_flags'] != "" || $lootdrop['content_flags_disabled'] != "") ? "Yes" : "No";?></a>
            </td>
            <td colspan="4" align="right">
              <a title="Set chance for all items on this table to <?=$normalize_amount?>" href="index.php?editor=loot&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&ldid=<?=$lootdrop['id']?>&action=18" style="color:yellow;">Normalize Drops</a>
            </td>
          </tr>
        </table>
      </div><br>
<?
  endif;
?>
<? if(!isset($lootdrop['items'])):?>
          <tr>
            <td align="left" style="padding: 10px;">No items currently assigned to this lootdrop</td>
          </tr>
        </table>
      </div><br>
<? endif;?>
<? endforeach; ?>
<? endif;?>
<? } /*endelse*/?>
