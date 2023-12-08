    <div class="table_container" style="width: 350px;">
      <div class="table_header">
        <table width="100%" cellpadding="0" cellspacing="0">
          <tr>
            <td align="left" width="33%">Player Keys - <a href="index.php?editor=player&playerid=<?=$playerid?>"><?=getPlayerName($playerid)?></a></td>
            <td align="right" width="5%"><a href="index.php?editor=keys&playerid=<?=$playerid?>&action=4"><img src="images/add.gif" border="0" title="Create a new entry" alt="Create a new entry"></a>
          </tr>
        </table>
      </div>
      <table class="table_content2" width="100%">
<?
$x = 0;
if (isset($keys)):
?>
        <tr>
          <td align="center"><strong>ID</strong></td>
          <td align="center"><strong>Item</strong></td>
          <td width="10%">&nbsp;</td>
        </tr>
<?
  foreach ($keys as $key):
    extract($key);
?>
        <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
          <td align="center"><?=$key['id']?></td>
          <td align="center"><?echo (item_isNoRent($key['item_id']) == true) ? "<img src='images/caution.gif' border='0' width='13' title='This is a No Rent (Temporary) item'>&nbsp;&nbsp;" : ""?><?=get_item_name($key['item_id'])?> (<?=$key['item_id']?>) - [<a href="https://lucy.allakhazam.com/item.html?id=<?=$key['item_id']?>" target="_blank">Lucy</a>]</td>
          <td align="right"><a href="index.php?editor=keys&id=<?=$key['id']?>&action=6"><img src="images/edit2.gif" width="13" height="13" border="0" title="View/Edit Entry" alt="View/Edit Entry"></a>&nbsp;<a onClick="return confirm('Really delete this entry?');" href="index.php?editor=keys&id=<?=$key['id']?>&action=8"><img src="images/remove3.gif" border="0" title="Delete Entry" alt="Delete Entry"></a></td>
        </tr>
<?
    $x++;
  endforeach;
endif;
if ($x == 0):
?>
        <tr>
          <td colspan="3" align="left" width="100" style="padding: 10px;">No Keys</td>
        </tr>
<?endif;?>
      </table>
    </div>
