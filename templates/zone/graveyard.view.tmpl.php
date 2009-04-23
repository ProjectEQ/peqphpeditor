      <div class="table_container" style="width: 500px;">
      <div class="table_header">
        <table width="100%" cellpadding="0" cellspacing="0">
          <tr>
           <td>Graveyard List</a></td>
           
           </tr>        
         </table>
      </div>

       <table class="table_content2" width="100%">
         <tr>
          <td align="center" width="5%"><strong>ID</strong></td>
          <td align="center" width="12%"><strong>Zone</strong></td>
          <td align="center" width="8%"><strong>X</strong></td>
          <td align="center" width="8%"><strong>Y</strong></td>
          <td align="center" width="10%"><strong>Z</strong></td>
          <td align="center" width="8%"><strong>Heading</strong></td>
          <th width="5%"></th>
         </tr>
<?$x=0; foreach($graveyard as $graveyard=>$v):?>
        <tr bgcolor="#<? echo ($x % 2 == 0) ? "AAAAAA" : "BBBBBB";?>">
          <td align="center" width="5%"><?=$v['graveyard_id']?></td>
          <td align="center" width="12%"><?=getZoneName($v['zone_id'])?></td>
          <td align="center" width="8%"><?=$v['x']?></td>
          <td align="center" width="8%"><?=$v['y']?></td> 
          <td align="center" width="8%"><?=$v['z_coord']?></td>
          <td align="center" width="8%"><?=$v['heading']?></td>
        <td align="right">    
          <a href="index.php?editor=zone&z=<?=$currzone?>&graveyard_id=<?=$v['graveyard_id']?>&action=5"><img src="images/edit2.gif" border="0" title="Edit Graveyard"></a>          
          <a onClick="return confirm('Really Delete Graveyard <?=$v['graveyard_id']?>?');" href="index.php?editor=zone&z=<?=$currzone?>&graveyard_id=<?=$v['graveyard_id']?>&action=11"><img src="images/remove3.gif" border="0" title="Delete this Graveyard"></a>
            </td>
        </tr>
<?$x++; endforeach;?>
        