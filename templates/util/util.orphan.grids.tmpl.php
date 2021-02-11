  <div class="table_container" style="width: 350px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td align="left">Orphaned Grids</td>
        </tr>
      </table>
    </div>
    <table class="table_content2" width="100%">
<?if (isset($orphan_grids)):?>
      <tr>
        <td align="center"><strong>Zone ID</strong></td>
        <td align="center"><strong>Grid ID</strong></td>
        <td align="right">&nbsp;</td>
      </tr>
<?$x=0;
foreach($orphan_grids as $grid):?>
      <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
        <td align="center"><?=getZoneName($grid['zoneid'])?> (<?=$grid['zoneid']?>)</td>
        <td align="center"><?=$grid['id']?></td>
        <td align="right"><a href="index.php?editor=spawn&z=<?=getZoneName($grid['zoneid'])?>&zoneid=<?=getZoneIDByName(getZoneName($grid['zoneid']))?>&pathgrid=<?=$grid['id']?>&action=66"><img src="images/view_all.gif" width="13" height="13" border="0" title="NPCs Using Grid" alt="NPCs"></a>&nbsp;<a href="index.php?editor=spawn&z=<?=getZoneName($grid['zoneid'])?>&zoneid=<?=getZoneIDByName(getZoneName($grid['zoneid']))?>&pathgrid=<?=$grid['id']?>&action=20"><img src="images/edit2.gif" width="13" height="13" border="0" title="View Grid" alt="View"></a></td>
      </tr>
<?$x++;
endforeach;
else:?>
      <tr>
        <td align="left" width="100" style="padding: 10px;">No Orphaned Grids</td>
      </tr>
<?endif;?>
    </table>
  </div>
