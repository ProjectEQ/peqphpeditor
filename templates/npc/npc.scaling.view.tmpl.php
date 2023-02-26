  <div class="table_container" style="width: 550px;">
    <div class="table_header">
      <table style="width:100%; padding:0px; border-spacing:0px;">
        <tr>
          <td align="right"><a href="index.php?editor=npc&action=90"><img src="images/add.gif" title="Add Scale"></a></td>
        </tr>
      </table>
    </div>
    <table class="table_content2" style="width:100%;">
<?if (isset($scaling)):?>
      <tr>
        <td align="center" width="25%"><strong>Type</strong></td>
        <td align="center" width="20%"><strong>Level</strong></td>
        <td align="center" width="30%"><strong>Zone</strong></td>
        <td align="center" width="15%"><strong>Instance</strong></td>
        <td width="10%">&nbsp;</td>
      </tr>
<?$x=0;
foreach($scaling as $scale):?>
      <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
        <td align="center" width="25%"><?=$npc_scaling_types[$scale['type']]?> (<?=$scale['type']?>)</td>
        <td align="center" width="20%"><?=$scale['level']?></td>
        <td align="center" width="30%"><?=getZoneName($scale['zone_id'])?> (<?=$scale['zone_id']?>)</td>
        <td align="center" width="15%"><?=$scale['instance_version']?></td>
        <td align="right" width="10%">
          <a href="index.php?editor=npc&type=<?=$scale['type']?>&level=<?=$scale['level']?>&zone_id=<?=$scale['zone_id']?>&instance_version=<?=$scale['instance_version']?>&action=92"><img src="images/edit2.gif" width="13" height="13" border="0" title="Edit Scale"></a>&nbsp;
          <a href="index.php?editor=npc&type=<?=$scale['type']?>&level=<?=$scale['level']?>&zone_id=<?=$scale['zone_id']?>&instance_version=<?=$scale['instance_version']?>&action=94" onClick="return confirm('Really delete scale?');"><img src="images/remove.gif" width="13" height="13" border="0" title="Delete Scale"></a>
        </td>
      </tr>
<?$x++;
endforeach;
else:?>
      <tr>
        <td align="left" width="100%" style="padding: 10px;">No Scaling</td>
      </tr>
<?endif;?>
    </table>
  </div>
