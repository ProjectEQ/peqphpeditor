  <div class="table_container" style="width: 800px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td>All Evolving Items</td>
          <td>
            <div style="float:right;">
              <a href="index.php?editor=items&action=20"><img src="images/add.gif" border="0" title="Create a new evolution"></a>
            </div>
          </td>
        </tr>
      </table>
    </div>
    <table class="table_content2" width="100%">
<?if (isset($items)):?>
      <tr>
        <td align="center"><strong>Evolve ID</strong></td>
        <td align="center"><strong>Level</strong></td>
        <td align="center"><strong>Item</strong></td>
        <td align="center"><strong>Type</strong></td>
        <td align="center"><strong>Subtype</strong></td>
        <td align="center"><strong>Required Amt</strong></td>
        <td align="center">&nbsp;</td>
      </tr>
<?$x=0;
  $previous = 0;
foreach($items as $item):?>
      <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
        <td align="center"><?echo ($item['item_evo_id'] != $previous) ? $item['item_evo_id'] . " <a href='index.php?editor=items&id=" . $item['item_evo_id'] . "&action=22'><img src='images/add.gif' width='10' title='Add Item to Evolution'></a>" : "&nbsp";?></td>
        <td align="center"><?=$item['item_evolve_level']?></td>
        <td align="center"><a href="index.php?editor=items&id=<?=$item['item_id']?>&action=2" title="<?=$item['item_id']?>"><?=get_item_name($item['item_id'])?></a> [<a href="https://lucy.allakhazam.com/item.html?id=<?=$item['item_id']?>" target="_blank">Lucy</a>]</td>
        <td align="center"><?=$evolving_type[$item['type']]?> (<?=$item['type']?>)</td>
        <td align="center">
<?
      switch ($item['type']) {
        case 1: // Experience-based Evolution
          echo $evolving_subtype_1[$item['sub_type']] . " (" . $item['sub_type'] . ")";
          break;
        case 2: // Number of Kills
          echo "N/A";
          break;
        case 3: // Specific Mob Race
          echo $itemraces[$item['sub_type']] . " (" . $item['sub_type'] . ")";
          break;
        case 4: // Specific Zone ID
          echo getZoneName($item['sub_type']) . " (" . $item['sub_type'] . ")";
          break;
        default:
          echo "UNK (" . $item['sub_type'] . ")";
          break;
      }
?>
        </td>
        <td align="center"><?=$item['required_amount']?></td>
        <td align="center">
          <a href="index.php?editor=items&id=<?=$item['id']?>&action=26"><img src="images/edit2.gif" width="13" title="Edit"></a>&nbsp;
          <a href="index.php?editor=items&id=<?=$item['id']?>&action=29"><img src="images/delete.gif" width="13" title="Delete"></a>
        </td>
      </tr>
<?$x++;
  $previous = $item['item_evo_id'];
endforeach;
else:?>
      <tr>
        <td align="left" width="100%" style="padding: 10px;">No evolving items</td>
      </tr>
<?endif;?>
    </table>
  </div>
