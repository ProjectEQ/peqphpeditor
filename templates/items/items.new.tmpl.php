  <div class="table_container" style="width: 600px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td align="left">New Items</td>
          <td align="right">Count: <?echo (isset($new_items)) ? count($new_items) : "0";?></td>
        </tr>
      </table>
    </div>
    <table class="table_content2" width="100%">
<?if (isset($new_items)):?>
      <tr>
        <td align="center" width="25%"><strong>ID</strong></td>
        <td align="center" width="70%"><strong>Name</strong></td>
        <td align="center" width="5%"><strong>&nbsp;</strong></td>
      </tr>
<?$x=0;
foreach ($new_items as $item):?>
      <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
        <td align="center" width="25%"><?=$item['id']?></td>
        <td align="center" width="70%"><?=$item['name']?> (<a href="https://lucy.allakhazam.com/item.html?id=<?=$item['id']?>" target="_blank">Lucy</a>) (<a href="https://items.sodeq.org/item.php?id=<?=$item['id']?>" target="_blank">13th Floor</a>)</td>
        <td align="center" width="5%"><a href="index.php?editor=items&id=<?=$item['id']?>&action=32"><img src="images/add.gif" alt="Add" title="Accept new item"></a></td>
        <td>&nbsp;</td>
      </tr>
<?$x++;
endforeach;
else:?>
      <tr>
        <td align="left" width="100%" style="padding: 10px;">No new items</td>
      </tr>
<?endif;?>
    </table>
  </div>
