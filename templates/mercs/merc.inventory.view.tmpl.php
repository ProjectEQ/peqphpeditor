  <div class="table_container" style="width: 600px;">
    <div class="table_header">
      <table style="width:100%; padding:0px; border-spacing:0px;">
        <tr>
          <td>Merc Subtype <?=$_GET['merc_subtype_id']?>
          <td align="right"><a href="index.php?editor=mercs&merc_subtype_id=<?=$_GET['merc_subtype_id']?>&action=74"><img src="images/add.gif" title="Add Mercenary Item"></a></td>
        </tr>
      </table>
    </div>
    <table class="table_content2" style="width:100%;">
<?if (isset($items)):?>
      <tr>
        <td align="center" width="20%"><strong>ID</strong></td>
        <td align="center" width="40%"><strong>Item</strong></td>
        <td align="center" width="15%"><strong>Min Level</strong></td>
        <td align="center" width="15%"><strong>Max Level</strong></td>
        <td width="10%">&nbsp;</td>
      </tr>
<?$x=0;
foreach($items as $item):?>
      <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
        <td align="center" width="20%"><?=$item['merc_inventory_id']?></td>
        <td align="center" width="40%"><?=get_item_name($item['item_id'])?> (<?=$item['item_id']?>)</td>
        <td align="center" width="15%"><?=$item['min_level']?></td>
        <td align="center" width="15%"><?=$item['max_level']?></td>
        <td align="right" width="10%">
          <a href="index.php?editor=mercs&merc_inventory_id=<?=$item['merc_inventory_id']?>&action=76"><img src="images/edit2.gif" width="13" height="13" border="0" title="Edit Mercenary Item"></a>&nbsp;
          <a href="index.php?editor=mercs&merc_subtype_id=<?=$item['merc_subtype_id']?>&merc_inventory_id=<?=$item['merc_inventory_id']?>&action=78" onClick="return confirm('Really delete mercenary item?');"><img src="images/remove.gif" width="13" height="13" border="0" title="Delete Mercenary Item"></a>
        </td>
      </tr>
<?$x++;
endforeach;
else:?>
      <tr>
        <td align="left" width="100%" style="padding: 10px;">No Mercenary Items</td>
      </tr>
<?endif;?>
    </table>
  </div>
