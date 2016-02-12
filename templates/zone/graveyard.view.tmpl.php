  <div class="table_container" style="width: 500px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td>Graveyard List</a></td>
        </tr>        
      </table>
    </div>
    <table class="table_content2" width="100%">
<?if (isset($graveyard)):?>
      <tr>
        <td align="center" width="10%"><strong>ID</strong></td>
        <td align="center" width="25%"><strong>Zone</strong></td>
        <td align="center" width="15%"><strong>X</strong></td>
        <td align="center" width="15%"><strong>Y</strong></td>
        <td align="center" width="15%"><strong>Z</strong></td>
        <td align="center" width="10%"><strong>Heading</strong></td>
        <td width="5%">&nbsp;</td>
      </tr>
<?$x=0; foreach($graveyard as $graveyard=>$v):?>
      <tr bgcolor="#<? echo ($x % 2 == 0) ? "AAAAAA" : "BBBBBB";?>">
        <td align="center" width="10%"><?=$v['graveyard_id']?></td>
        <td align="center" width="25%"><?=getZoneName($v['zone_id'])?></td>
        <td align="center" width="15%"><?=$v['x']?></td>
        <td align="center" width="15%"><?=$v['y']?></td> 
        <td align="center" width="15%"><?=$v['z_coord']?></td>
        <td align="center" width="10%"><?=$v['heading']?></td>
        <td align="right" width="10%">    
          <a href="index.php?editor=zone&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&graveyard_id=<?=$v['graveyard_id']?>&action=5"><img src="images/edit2.gif" border="0" title="Edit Graveyard"></a>          
          <a onClick="return confirm('Really Delete Graveyard <?=$v['graveyard_id']?>?');" href="index.php?editor=zone&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&graveyard_id=<?=$v['graveyard_id']?>&action=11"><img src="images/remove3.gif" border="0" title="Delete this Graveyard"></a>
        </td>
      </tr>
<?$x++; endforeach;?>
<?else:?>
      <tr><td>No graveyards set</td></tr>
<?endif;?>
    </table>
  </div>
