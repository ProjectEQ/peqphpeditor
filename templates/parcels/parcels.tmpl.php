  <div class="table_container" style="width: 600px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td>&nbsp;</td>
          <td>
            <div style="float:right">
              <a href="index.php?editor=parcels&action=1"><img src="images/add.gif" border="0" title="Create New Parcel"></a>
            </div>
          </td>
        </tr>
      </table>
    </div>
    <table class="table_content2" width="100%">
<?if (isset($parcels)):?>
      <tr>
        <td align="center" width="10%"><strong>ID</strong></td>
        <td align="center" width="20%"><strong>Player</strong></td>
        <td align="center" width="30%"><strong>Item</strong></td>
        <td align="center" width="10%"><strong>Qty</strong></td>
        <td align="center" width="20%"><strong>From</strong></td>
        <td width="10%">&nbsp;</td>
      </tr>
<?$x=0;
foreach($parcels as $parcel):?>
      <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
        <td align="center" width="10%"><?=$parcel['id']?></td>
        <td align="center" width="20%"><?=getPlayerName($parcel['char_id'])?> (<?=$parcel['char_id']?>)</td>
        <td align="center" width="30%"><?=get_item_name($parcel['item_id'])?> (<?=$parcel['item_id']?>)</td>
        <td align="center" width="10%"><?=$parcel['quantity']?></td>
        <td align="center" width="20%"><?=$parcel['from_name']?></td>
        <td align="right" width="10%"><a href="index.php?editor=parcels&id=<?=$parcel['id']?>&action=3"><img src="images/edit2.gif" width="13" height="13" border="0" title="View Parcel"></a>&nbsp;<a onClick="return confirm('Really delete parcel?');" href="index.php?editor=parcels&id=<?=$parcel['id']?>&action=5"><img src="images/remove3.gif" border="0" title="Delete Parcel"></a></td>
      </tr>
<?$x++;
endforeach;
else:?>
      <tr>
        <td align="left" width="100%" style="padding: 10px;">No Parcels</td>
      </tr>
<?endif;?>
    </table>
  </div>
