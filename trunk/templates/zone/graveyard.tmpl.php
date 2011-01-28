      <div class="table_container" style="width: 500px;">
      <div class="table_header">
        <table width="100%" cellpadding="0" cellspacing="0">
          <tr>
           <td>Graveyard for <a href="index.php?editor=zone&z=<?=$gravezone?>&zoneid=<?=getZoneIDByName($gravezone)?>&action=1"><?=$gravezone?></a></td>
           <td align="right">    
          <a href="index.php?editor=zone&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&graveyard_id=<?=$id?>&action=5"><img src="images/edit2.gif" border="0" title="Edit Graveyard"></a>          
          <a onClick="return confirm('Really Delete Graveyard <?=$v['id']?>?');" href="index.php?editor=zone&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&graveyard_id=<?=$id?>&action=7"><img src="images/remove3.gif" border="0" title="Delete this Graveyard"></a>
            </td>
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
        <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
          <td align="center" width="5%"><?=$id?></td>
          <td align="center" width="12%"><?=getZoneName($zone_id)?></td>
          <td align="center" width="8%"><?=$x?></td>
          <td align="center" width="8%"><?=$y?></td> 
          <td align="center" width="8%"><?=$z?></td>
          <td align="center" width="8%"><?=$heading?></td>
          <td align="right">      
          </td>
        </tr>
        </table>
