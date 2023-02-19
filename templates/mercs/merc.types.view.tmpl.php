  <div class="table_container" style="width: 600px;">
    <div class="table_header">
      <table style="width:100%; padding:0px; border-spacing:0px;">
        <tr>
          <td align="right"><a href="index.php?editor=mercs&action=14"><img src="images/add.gif" title="Add Mercenary Type"></a></td>
        </tr>
      </table>
    </div>
    <table class="table_content2" style="width:100%;">
<?if (isset($types)):?>
      <tr>
        <td align="center" width="10%"><strong>ID</strong></td>
        <td align="center" width="35%"><strong>Race</strong></td>
        <td align="center" width="10%"><strong>Proficiency</strong></td>
        <td align="center" width="20%"><strong>DBString</strong></td>
        <td align="center" width="15%"><strong>Client</strong></td>
        <td width="10%">&nbsp;</td>
      </tr>
<?$x=0;
foreach($types as $type):?>
      <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
        <td align="center" width="10%"><?=$type['merc_type_id']?></td>
        <td align="center" width="35%"><?=$races[$type['race_id']]?> (<?=$type['race_id']?>)</td>
        <td align="center" width="10%"><?=$type['proficiency_id']?></td>
        <td align="center" width="20%"><?=$type['dbstring']?></td>
        <td align="center" width="15%"><?=$clients[$type['clientversion']]?> (<?=$type['clientversion']?>)</td>
        <td align="right" width="10%">
          <a href="index.php?editor=mercs&merc_type_id=<?=$type['merc_type_id']?>&action=16"><img src="images/edit2.gif" width="13" height="13" border="0" title="Edit Mercenary Type"></a>&nbsp;
          <a href="index.php?editor=mercs&merc_type_id=<?=$type['merc_type_id']?>&action=18" onClick="return confirm('Really delete mercenary type?');"><img src="images/remove.gif" width="13" height="13" border="0" title="Delete Mercenary Type"></a>
        </td>
      </tr>
<?$x++;
endforeach;
else:?>
      <tr>
        <td align="left" width="100%" style="padding: 10px;">No Mercenary Types</td>
      </tr>
<?endif;?>
    </table>
  </div>
