    <div class="table_container" style="width: 800px;">
      <div class="table_header">
        <table width="100%" cellpadding="0" cellspacing="0">
          <tr>
            <td align="left" width="33%">Current Evolving Items</td>
          </tr>
        </table>
      </div>
      <table class="table_content2" width="100%">
<?
$x = 0;
if (isset($evolving) && isset($evolving['current'])):
?>
        <tr>
          <td align="center"><strong>ID</strong></td>
          <td align="center"><strong>Item</strong></td>
          <td align="center"><strong>Final Item</strong></td>
          <td align="center"><strong>Current Amount</strong></td>
          <td align="center"><strong>Progression</strong></td>
          <td align="center"><strong>Activated</strong></td>
          <td align="center"><strong>Equipped</strong></td>
        </tr>
<?
  foreach ($evolving['current'] as $current):
?>
        <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
          <td align="center"><?=$current['id']?></td>
          <td align="center"><a href="index.php?editor=items&id=<?=$current['item_id']?>&action=2" title="<?=$current['item_id']?>"><?=get_item_name($current['item_id'])?></a> [<a href="https://lucy.allakhazam.com/item.html?id=<?=$current['item_id']?>" target="_blank">Lucy</a>]</td>
          <td align="center"><a href="index.php?editor=items&id=<?=$current['final_item_id']?>&action=2" title="<?=$current['final_item_id']?>"><?=get_item_name($current['final_item_id'])?></a> [<a href="https://lucy.allakhazam.com/item.html?id=<?=$current['final_item_id']?>" target="_blank">Lucy</a>]</td>
          <td align="center"><?=$current['current_amount']?></td>
          <td align="center"><?=$current['progression']?></td>
          <td align="center"><?=$yesno[$current['activated']]?></td>
          <td align="center"><?=$yesno[$current['equipped']]?></td>
        </tr>
<?
    $x++;
  endforeach;
endif;
if ($x == 0):
?>
        <tr>
          <td colspan="3" align="left" width="100" style="padding: 10px;">No Current Evolving Items</td>
        </tr>
<?endif;?>
      </table>
    </div><br>
    <div class="table_container" style="width: 800px;">
      <div class="table_header">
        <table width="100%" cellpadding="0" cellspacing="0">
          <tr>
            <td align="left" width="33%">Evolving Items History</td>
          </tr>
        </table>
      </div>
      <table class="table_content2" width="100%">
<?
$x = 0;
if (isset($evolving) && isset($evolving['history'])):
?>
        <tr>
          <td align="center"><strong>ID</strong></td>
          <td align="center"><strong>Item</strong></td>
          <td align="center"><strong>Final Item</strong></td>
          <td align="center"><strong>Current</strong></td>
          <td align="center"><strong>Progression</strong></td>
          <td align="center"><strong>Deleted</strong></td>
        </tr>
<?
  foreach ($evolving['history'] as $history):
?>
        <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
          <td align="center"><?=$history['id']?></td>
          <td align="center"><a href="index.php?editor=items&id=<?=$history['item_id']?>&action=2" title="<?=$history['item_id']?>"><?=get_item_name($history['item_id'])?></a> [<a href="https://lucy.allakhazam.com/item.html?id=<?=$history['item_id']?>" target="_blank">Lucy</a>]</td>
          <td align="center"><a href="index.php?editor=items&id=<?=$history['final_item_id']?>&action=2" title="<?=$history['final_item_id']?>"><?=get_item_name($history['final_item_id'])?></a> [<a href="https://lucy.allakhazam.com/item.html?id=<?=$history['final_item_id']?>" target="_blank">Lucy</a>]</td>
          <td align="center"><?=$history['current_amount']?></td>
          <td align="center"><?=$history['progression']?></td>
          <td align="center"><?=$history['deleted_at']?></td>
        </tr>
<?
    $x++;
  endforeach;
endif;
if ($x == 0):
?>
        <tr>
          <td colspan="3" align="left" width="100" style="padding: 10px;">No Evolving Items History</td>
        </tr>
<?endif;?>
      </table>
    </div>
