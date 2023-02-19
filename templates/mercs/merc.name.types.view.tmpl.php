  <div class="table_container" style="width: 650px;">
    <div class="table_header">
      <table style="width:100%; padding:0px; border-spacing:0px;">
        <tr>
          <td align="right"><a href="index.php?editor=mercs&action=26"><img src="images/add.gif" title="Add Mercenary Name Type"></a></td>
        </tr>
      </table>
    </div>
    <table class="table_content2" style="width:100%;">
<?if (isset($types)):?>
      <tr>
        <td align="center" width="10%"><strong>ID</strong></td>
        <td align="center" width="25%"><strong>Class</strong></td>
        <td align="center" width="27%"><strong>Prefix</strong></td>
        <td align="center" width="27%"><strong>Suffix</strong></td>
        <td width="10%">&nbsp;</td>
      </tr>
<?$x=0;
foreach($types as $type):?>
      <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
        <td align="center" width="10%"><?=$type['name_type_id']?></td>
        <td align="center" width="25%"><?=$classes[$type['class_id']]?> (<?=$type['class_id']?>)</td>
        <td align="center" width="27%"><?=$type['prefix']?></td>
        <td align="center" width="27%"><?=$type['suffix']?></td>
        <td align="right" width="10%">
          <a href="index.php?editor=mercs&name_type_id=<?=$type['name_type_id']?>&class_id=<?=$type['class_id']?>&action=28"><img src="images/edit2.gif" width="13" height="13" border="0" title="Edit Mercenary Name Type"></a>&nbsp;
          <a href="index.php?editor=mercs&name_type_id=<?=$type['name_type_id']?>&class_id=<?=$type['class_id']?>&action=30" onClick="return confirm('Really delete mercenary name type?');"><img src="images/remove.gif" width="13" height="13" border="0" title="Delete Mercenary Name Type"></a>
        </td>
      </tr>
<?$x++;
endforeach;
else:?>
      <tr>
        <td align="left" width="100%" style="padding: 10px;">No Mercenary Name Types</td>
      </tr>
<?endif;?>
    </table>
  </div>
