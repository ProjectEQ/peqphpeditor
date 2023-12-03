  <div class="table_container" style="width: 800px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td>Items Diff</td>
          <td>&nbsp;</td>
        </tr>
      </table>
    </div>
    <table class="table_content2" width="100%">
<?if (isset($diff)):?>
      <tr>
        <td align="center" width="5%"><strong>Item ID</strong></td>
        <td align="center" width="35%"><strong>Item Name</strong></td>
        <td align="center" width="30%"><strong>Old <?=$column?></strong></td>
        <td align="center" width="30%"><strong>New <?=$column?></strong></td>
      </tr>
<?$x=0;
foreach($diff as $item):?>
      <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
        <td align="center" width="5%"><?=$item['id']?></td>
        <td align="center" width="35%"><?=$item['Name']?> (<a href="https://lucy.allakhazam.com/item.html?id=<?=$item['id']?>" target="_blank">Lucy</a>)</td>
        <td align="center" width="30%"><?=$item['old_' . $column]?></td>
        <td align="center" width="30%"><?=$item['new_' . $column]?></td>
      </tr>
<?$x++;
endforeach;
else:?>
      <tr>
        <td align="left" width="100%" style="padding: 10px;">No differences</td>
      </tr>
<?endif;?>
    </table>
  </div>
