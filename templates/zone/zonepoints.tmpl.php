  <div class="table_container" style="width: 750px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td>Zone Points</td>
          <td align="right">    
            <a href="index.php?editor=zone&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&action=16"><img src="images/add.gif" border="0" title="Add a zone point"></a>
          </td>
        </tr>        
      </table>
    </div>
    <table class="table_content2" width="100%">
<? if (isset($zonepoints)):?>
      <tr>
        <td align="center" width="5%"><strong>ID</strong></td>
        <td align="center" width="5%"><strong>Zone</strong></td>
        <td align="center" width="5%"><strong>Number</strong></td>
        <td align="center" width="5%"><strong>X</strong></td>
        <td align="center" width="5%"><strong>Y</strong></td>
        <td align="center" width="5%"><strong>Z</strong></td>
        <td align="center" width="5%"><strong>Heading</strong></td>
        <td align="center" width="5%"><strong>Target X</strong></td>
        <td align="center" width="5%"><strong>Target Y</strong></td>
        <td align="center" width="5%"><strong>Target Z</strong></td>
        <td align="center" width="5%"><strong>Target Heading</strong></td>
        <td align="center" width="5%"><strong>Target Instance</strong></td>
        <td align="center" width="5%"><strong>Target Zone</strong></td>
        <td width="5%">&nbsp;</td>
      </tr>
<?$x=0; foreach($zonepoints as $zonepoints=>$v):?>
      <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
        <td align="center" width="5%"><?=$v['id']?></td>
        <td align="center" width="5%"><?=$v['zone']?></td>
        <td align="center" width="5%"><?=$v['number']?></td>
        <td align="center" width="5%"><?=$v['x']?></td>
        <td align="center" width="5%"><?=$v['y']?></td>
        <td align="center" width="5%"><?=$v['z']?></td>
        <td align="center" width="5%"><?=$v['heading']?></td>
        <td align="center" width="5%"><?=$v['target_x']?></td>
        <td align="center" width="5%"><?=$v['target_y']?></td>
        <td align="center" width="5%"><?=$v['target_z']?></td>
        <td align="center" width="5%"><?=$v['target_heading']?></td>
        <td align="center" width="5%"><?=$v['target_instance']?></td>
        <td align="center" width="5%"><?=getZoneName($v['target_zone_id'])?></td>
        <td align="right">      
          <a href="index.php?editor=zone&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&zpid=<?=$v['id']?>&action=13"><img src="images/edit2.gif" border="0" title="Edit Entry"></a>          
          <a onClick="return confirm('Really Delete Point <?=$v['id']?>?');" href="index.php?editor=zone&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&zpid=<?=$v['id']?>&action=15"><img src="images/remove3.gif" border="0" title="Delete this entry"></a>
        </td>
      </tr>
<?$x++; endforeach;?>
<?endif;?>
<? if (!isset($zonepoints)):?>
      <tr>
        <td align="left" width="100" style="padding: 10px;">No zone points found</td>
      </tr>
<?endif;?>
    </table>
  </div>
