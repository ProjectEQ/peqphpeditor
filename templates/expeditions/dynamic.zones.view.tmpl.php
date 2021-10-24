  <div class="table_container" style="width: 750px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td align="left">Dynamic Zones</td>
          <td align="right">
            <a href="index.php?editor=expeditions&action=14"><img src="images/add.gif" border="0" title="Create New Dynamic Zone" alt="Create New Dynamic Zone"></a>
          </td>
        </tr>
      </table>
    </div>
    <table class="table_content2" width="100%">
<?if (isset($dynamic_zones)):?>
      <tr>
        <td align="center"><strong>ID</strong></td>
        <td align="center"><strong>Name</strong></td>
        <td align="center"><strong>Instance</strong></td>
        <td align="center"><strong>Type</strong></td>
        <td align="right">&nbsp;</td>
      </tr>
<?$x=0;
foreach($dynamic_zones as $dynamic_zone):?>
      <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
        <td align="center"><?=$dynamic_zone['id']?></td>
        <td align="center"><?=$dynamic_zone['name']?></td>
        <td align="center"><?=$dynamic_zone['instance_id']?></td>
        <td align="center"><?=$dynamic_zone_type[$dynamic_zone['type']]?></td>
        <td align="right"><a href="index.php?editor=expeditions&id=<?=$dynamic_zone['id']?>&action=16"><img src="images/edit2.gif" width="13" height="13" border="0" title="Edit Dynamic Zone" alt="Edit"></a>&nbsp;<a onClick="return confirm('Really delete dynamic zone?');" href="index.php?editor=expeditions&id=<?=$dynamic_zone['id']?>&action=18"><img src="images/remove3.gif" border="0" title="Delete Dynamic Zone" alt="Delete"></a></td>
      </tr>
<?$x++;
endforeach;
else:?>
      <tr>
        <td align="left" width="100" style="padding: 10px;">No Dynamic Zones</td>
      </tr>
<?endif;?>
    </table>
  </div>
