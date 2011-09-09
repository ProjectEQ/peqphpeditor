  <div class="table_container" style="width: 350px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td>Alternate Currency Items</td>
          <td>
            <div style="float:right">
              <a href="index.php?editor=altcur&action=2"><img src="images/add.gif" border="0" title="Create a new entry" /></a>
            </div>
          </td>
        </tr>
      </table>
    </div>
    <table class="table_content2" width="100%">
<?if (isset($altcur_items)):?>
      <tr>
        <td align="center" width="15%"><strong>ID</strong></td>
        <td align="center" width="20%"><strong>Item ID</strong></td>
        <td align="center" width="45%"><strong>Item Name</strong></td>
        <td align="center" width="10%">&nbsp;</td>
        <td width="10%">&nbsp;</td>
      </tr>
<?$x=0;
foreach($altcur_items as $item):?>
      <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
        <td align="center" width="15%"><?=$item['id']?></td>
        <td align="center" width="20%"><?=$item['item_id']?></td>
        <td align="center" width="45%"><?=get_item_name($item['item_id'])?></td>
        <td align="left" width="10%"><a href="http://lucy.allakhazam.com/item.html?id=<?=$item['item_id']?>" target="_blank">Lucy</a></td>
        <td align="right"><a href="index.php?editor=altcur&id=<?=$item['id']?>&action=4"><img src="images/edit2.gif" width="13" height="13" border="0" title="Edit Entry"></a>&nbsp;<a onClick="return confirm('Really delete this entry?');" href="index.php?editor=altcur&id=<?=$item['id']?>&action=6"><img src="images/remove3.gif" border="0" title="Delete Entry"></a></td>
      </tr>
<?$x++;
endforeach;
else:?>
      <tr>
        <td align="left" width="100" style="padding: 10px;">No entries</td>
      </tr>
<?endif;?>
    </table>
  </div>
