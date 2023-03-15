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
        <td align="center" width="30%"><?=$scale['zone_id_list']?></td>
        <td align="center" width="15%"><?=$scale['instance_version_list']?></td>
        <td align="right" width="10%">
          <a href="index.php?editor=npc&type=<?=$scale['type']?>&level=<?=$scale['level']?>&zone_id_list=<?=$scale['zone_id_list']?>&instance_version_list=<?=$scale['instance_version_list']?>&action=92"><img src="images/edit2.gif" width="13" height="13" border="0" title="Edit Scale"></a>&nbsp;
          <a href="index.php?editor=npc&type=<?=$scale['type']?>&level=<?=$scale['level']?>&zone_id_list=<?=$scale['zone_id_list']?>&instance_version_list=<?=$scale['instance_version_list']?>&action=94" onClick="return confirm('Really delete scale?');"><img src="images/remove.gif" width="13" height="13" border="0" title="Delete Scale"></a>
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
