  <div class="table_container" style="width: 700px;">
    <div class="table_header">
      <table style="width:100%; padding:0px; border-spacing:0px;">
        <tr>
          <td align="right"><a href="index.php?editor=mercs&action=26"><img src="images/add.gif" title="Add Mercenary Template"></a></td>
        </tr>
      </table>
    </div>
    <table class="table_content2" style="width:100%;">
<?if (isset($templates)):?>
      <tr>
        <td align="center" width="10%"><strong>ID</strong></td>
        <td align="center" width="10%"><strong>Type</strong></td>
        <td align="center" width="10%"><strong>Subtype</strong></td>
        <td align="center" width="10%"><strong>NPC Type</strong></td>
        <td align="center" width="10%"><strong>Name Type</strong></td>
        <td align="center" width="20%"><strong>DB String</strong></td>
        <td align="center" width="20%"><strong>Client</strong></td>
        <td width="10%">&nbsp;</td>
      </tr>
<?$x=0;
foreach($templates as $template):?>
      <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
        <td align="center" width="10%"><?=$template['merc_template_id']?></td>
        <td align="center" width="10%"><?=$template['merc_type_id']?></td>
        <td align="center" width="10%"><?=$template['merc_subtype_id']?></td>
        <td align="center" width="10%"><?=$template['merc_npc_type_id']?></td>
        <td align="center" width="10%"><?=$template['name_type_id']?></td>
        <td align="center" width="20%"><?=$template['dbstring']?></td>
        <td align="center" width="20%"><?=$clients[$template['clientversion']]?> (<?=$template['clientversion']?>)</td>
        <td align="right" width="10%">
          <a href="index.php?editor=mercs&merc_template_id=<?=$template['merc_template_id']?>&merc_type_id=<?=$template['merc_type_id']?>&merc_subtype_id=<?=$template['merc_subtype_id']?>&action=34"><img src="images/edit2.gif" width="13" height="13" border="0" title="Edit Mercenary Template"></a>&nbsp;
          <a href="index.php?editor=mercs&merc_template_id=<?=$template['merc_template_id']?>&merc_type_id=<?=$template['merc_type_id']?>&merc_subtype_id=<?=$template['merc_subtype_id']?>&action=36" onClick="return confirm('Really delete mercenary template?');"><img src="images/remove.gif" width="13" height="13" border="0" title="Delete Mercenary Template"></a>
        </td>
      </tr>
<?$x++;
endforeach;
else:?>
      <tr>
        <td align="left" width="100%" style="padding: 10px;">No Mercenary Templates</td>
      </tr>
<?endif;?>
    </table>
  </div>
