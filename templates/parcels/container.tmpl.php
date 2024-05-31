  <div class="table_container" style="width: 800px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td>Parcel Container (<?=$_GET['parcels_id']?>)</td>
          <td>
            <div style="float:right">
              <a href="index.php?editor=parcels&parcels_id=<?=$_GET['parcels_id']?>&action=7"><img src="images/add.gif" border="0" title="Add Parcel"></a>
            </div>
          </td>
        </tr>
      </table>
    </div>
    <table class="table_content2" width="100%">
<?if (isset($parcels)):?>
      <tr>
        <td align="center" width="15%"><strong>ID</strong></td>
        <td align="center" width="10%"><strong>Slot</strong></td>
        <td align="center" width="45%"><strong>Item</strong></td>
        <td align="center" width="10%"><strong>Qty</strong></td>
        <td width="20%">&nbsp;</td>
      </tr>
<?$x=0;
foreach($parcels as $parcel):?>
      <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
        <td align="center" width="15%"><?=$parcel['id']?></td>
        <td align="center" width="10%"><?=$parcel['slot_id']?></td>
        <td align="center" width="45%"><?=get_item_name($parcel['item_id'])?> (<?=$parcel['item_id']?>)</td>
        <td align="center" width="20%"><?=$parcel['quantity']?></td>
        <td align="right" width="20%">
          <a href="index.php?editor=parcels&id=<?=$parcel['id']?>&action=9"><img src="images/edit2.gif" width="13" height="13" border="0" title="Edit Parcel"></a>&nbsp;
          <a onClick="return confirm('Really delete parcel?');" href="index.php?editor=parcels&id=<?=$parcel['id']?>&action=11"><img src="images/remove3.gif" border="0" title="Delete Parcel"></a>
        </td>
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
