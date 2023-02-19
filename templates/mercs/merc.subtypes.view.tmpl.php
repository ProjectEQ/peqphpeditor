  <div class="table_container" style="width: 600px;">
    <div class="table_header">
      <table style="width:100%; padding:0px; border-spacing:0px;">
        <tr>
          <td align="right"><a href="index.php?editor=mercs&action=20"><img src="images/add.gif" title="Add Mercenary Subtype"></a></td>
        </tr>
      </table>
    </div>
    <table class="table_content2" style="width:100%;">
<?if (isset($subtypes)):?>
      <tr>
        <td align="center" width="20%"><strong>ID</strong></td>
        <td align="center" width="30%"><strong>Class</strong></td>
        <td align="center" width="20%"><strong>Tier</strong></td>
        <td align="center" width="20%"><strong>Confidence</strong></td>
        <td width="10%">&nbsp;</td>
      </tr>
<?$x=0;
foreach($subtypes as $subtype):?>
      <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
        <td align="center" width="20%"><?=$subtype['merc_subtype_id']?></td>
        <td align="center" width="30%"><?=$classes[$subtype['class_id']]?> (<?=$subtype['class_id']?>)</td>
        <td align="center" width="20%"><?=$subtype['tier_id']?></td>
        <td align="center" width="20%"><?=$subtype['confidence_id']?></td>
        <td align="right" width="10%">
          <a href="index.php?editor=mercs&merc_subtype_id=<?=$subtype['merc_subtype_id']?>&action=73"><img src="images/contents.png" width="13" height="13" border="0" title="Merc Inventory"></a>&nbsp;
          <a href="index.php?editor=mercs&merc_subtype_id=<?=$subtype['merc_subtype_id']?>&action=22"><img src="images/edit2.gif" width="13" height="13" border="0" title="Edit Mercenary Subtype"></a>&nbsp;
          <a href="index.php?editor=mercs&merc_subtype_id=<?=$subtype['merc_subtype_id']?>&action=24" onClick="return confirm('Really delete mercenary subtype and associated entries?');"><img src="images/remove.gif" width="13" height="13" border="0" title="Delete Mercenary Subtype"></a>
        </td>
      </tr>
<?$x++;
endforeach;
else:?>
      <tr>
        <td align="left" width="100%" style="padding: 10px;">No Mercenary Subtypes</td>
      </tr>
<?endif;?>
    </table>
  </div>
