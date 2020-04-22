      <div class="table_container" style="width: 600px;">
      <div class="table_header">
        <table width="100%" cellpadding="0" cellspacing="0">
          <tr>
           <td>Ground Spawns</td>
           <td align="right">    
          <a href="index.php?editor=misc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&action=17"><img src="images/add.gif" border="0" title="Add an entry to this zone"></a>
            </td>
           </tr>        
         </table>
      </div>

       <table class="table_content2" width="100%">
         <tr>
          <td align="center" width="5%"><strong>id</strong></td>
          <td align="center" width="10%"><strong>zone</strong></td>
          <td align="center" width="10%"><strong>item</strong></td>
          <td align="center" width="5%"><strong>max</strong></td>
          <td align="center" width="5%"><strong>max x</strong></td>
          <td align="center" width="5%"><strong>max y</strong></td>
          <td align="center" width="5%"><strong>max z</strong></td>
          <td align="center" width="5%"><strong>min x</strong></td>
          <td align="center" width="5%"><strong>min y</strong></td>
          <td align="center" width="5%"><strong>respawn</strong></td>
          <td align="center" width="5%"><strong>version</strong></td>
          <th width="5%"></th>
         </tr>
        <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
          <td align="center" width="5%"><?=$gsid?></td>
<?if($zoneid == 0):?>          
          <td align="center" width="10%">All</td>
<?endif;?>
<?if($zoneid != 0):?> 
          <td align="center" width="10%"><?=getZoneName($zoneid)?></td>
<?endif;?>
          <td align="center" width="10%"><?=get_item_name($giid)?> <span>[<a href="https://lucy.allakhazam.com/item.html?id=<?=$giid?>" target="_blank">Lucy</a>]</span></td>
          <td align="center" width="5%"><?=$max_allowed?></td>
          <td align="center" width="5%"><?=$max_x?></td>
          <td align="center" width="5%"><?=$max_y?></td>
          <td align="center" width="5%"><?=$max_z?></td>
          <td align="center" width="5%"><?=$min_x?></td>
          <td align="center" width="5%"><?=$min_y?></td>
          <td align="center" width="5%"><?=$respawn_timer?></td>  
          <td align="center" width="5%"><?=$version?></td>
          <td align="right">      
            <a href="index.php?editor=misc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&gsid=<?=$gsid?>&action=14"><img src="images/edit2.gif" border="0" title="Edit Entry"></a>          
            <a href="index.php?editor=misc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&gsid=<?=$gsid?>&action=16"><img src="images/remove3.gif" border="0" title="Delete this entry"></a>
          </td>
        </tr>
        </table>