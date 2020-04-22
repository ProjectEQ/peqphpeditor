  <div class="table_container" style="width: 800px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td>All Starting Items</td>
          <td>
            <div style="float:right;">
              <a href="index.php?editor=items&action=13"><img src="images/add.gif" border="0" title="Create a new starting item"></a>
            </div>
          </td>
        </tr>
      </table>
    </div>
    <table class="table_content2" width="100%">
<?if (isset($items)):?>
      <tr>
        <td align="center" width="5%"><strong>ID</strong></td>
        <td align="center" width="12%"><strong>Race</strong></td>
        <td align="center" width="12%"><strong>Class</strong></td>
        <td align="center" width="12%"><strong>Deity</strong></td>
        <td align="center" width="12%"><strong>Zone</strong></td>
        <td align="center" width="40%"><strong>Item</strong></td>
        <td width="7%">&nbsp;</td>
      </tr>
<?$x=0;
foreach($items as $item):?>
      <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
        <td align="center" width="5%"><?=$item['id']?></td>
        <td align="center" width="12%"><?echo ($item['race'] == 0) ? "ALL" : $races[$item['race']];?></td>
        <td align="center" width="12%"><?echo ($item['class'] == 0) ? "ALL" : $classes[$item['class']];?></td>
        <td align="center" width="12%"><?echo ($item['deityid'] == 0) ? "ALL" : $deities[$item['deityid']];?></td>
        <td align="center" width="12%"><?echo ($item['zoneid'] == 0) ? "ALL" : $zones[$item['zoneid']];?></td>
        <td align="center" width="40%"><?=get_item_name($item['itemid'])?> (<?=$item['itemid']?>) - [<a href="https://lucy.allakhazam.com/item.html?id=<?=$item['itemid']?>" target="_blank">Lucy</a>]</td>
        <td align="right" width="7%"><a href="index.php?editor=items&id=<?=$item['id']?>&race=<?=$item['race']?>&action=11"><img src="images/edit2.gif" width="13" height="13" border="0" title="View Item"></a>&nbsp;<a onClick="return confirm('Really delete item?');" href="index.php?editor=items&id=<?=$item['id']?>&race=<?=$item['race']?>&action=15"><img src="images/remove3.gif" border="0" title="Delete Item"></a></td>
      </tr>
<?$x++;
endforeach;
else:?>
      <tr>
        <td align="left" width="100%" style="padding: 10px;">No starting items</td>
      </tr>
<?endif;?>
    </table>
  </div>
