  <div class="table_container" style="width: 550px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td align="left">Dynamic Zone Templates</td>
          <td align="right">
            <a href="index.php?editor=expeditions&action=32"><img src="images/add.gif" border="0" title="Create New Template" alt="Create New Template"></a>
          </td>
        </tr>
      </table>
    </div>
    <table class="table_content2" width="100%">
<?if (isset($dynamic_zone_templates)):?>
      <tr>
        <td align="center" width="15%"><strong>ID</strong></td>
        <td align="center" width="35%"><strong>Name</strong></td>
        <td align="center" width="25%"><strong>Zone</strong></td>
        <td align="center" width="15%"><strong>Version</strong></td>
        <td align="right" width="10%">&nbsp;</td>
      </tr>
<?$x=0;
foreach($dynamic_zone_templates as $dynamic_zone_template):?>
      <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
        <td align="center" width="15%"><?=$dynamic_zone_template['id']?></td>
        <td align="center" width="35%"><?=$dynamic_zone_template['name']?></td>
        <td align="center" width="25%"><?=$zoneids[$dynamic_zone_template['zone_id']]?></td>
        <td align="center" width="15%"><?=$dynamic_zone_template['zone_version']?></td>
        <td align="right" width="10%"><a href="index.php?editor=expeditions&id=<?=$dynamic_zone_template['id']?>&action=34"><img src="images/edit2.gif" width="13" height="13" border="0" title="Edit Template" alt="Edit"></a>&nbsp;<a onClick="return confirm('Really delete template?');" href="index.php?editor=expeditions&id=<?=$dynamic_zone_template['id']?>&action=36"><img src="images/remove3.gif" border="0" title="Delete Template" alt="Delete"></a></td>
      </tr>
<?$x++;
endforeach;
else:?>
      <tr>
        <td align="left" width="100" style="padding: 10px;">No Templates</td>
      </tr>
<?endif;?>
    </table>
  </div>
