      <div class="table_container" style="width: 750px;">
      <div class="table_header">
        <table width="100%" cellpadding="0" cellspacing="0">
          <tr>
           <td>Ground Spawns</td>
           <td align="right">  
          <a href="index.php?editor=misc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&action=49"><img src="images/last.gif" border="0" title="Copy ground spawns by version"></a>  
          <a href="index.php?editor=misc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&action=17"><img src="images/add.gif" border="0" title="Add an entry to this zone"></a>
          <a href="index.php?editor=misc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&action=57"><img src="images/remove3.gif" border="0" title="Delete ground spawns by version"></a>
            </td>
           </tr>        
         </table>
      </div>

       <table class="table_content2" width="100%">
<? if (isset($gspawn)):?>
         <tr>
          <td align="center" width="5%"><strong>id</strong></td>
          <td align="center" width="20%"><strong>item</strong></td>
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
<?$x=0; foreach($gspawn as $gspawn=>$v):?>
        <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
          <td align="center" width="5%"><?=$v['gsid']?></td>
          <td align="center" width="20%"><a href="index.php?editor=items&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&id=<?=$v['giid']?>&action=2"><?=$v['iname']?></a> <span>[<a href="http://lucy.allakhazam.com/item.html?id=<?=$v['giid']?>">lucy</a>]</span></td>
          <td align="center" width="5%"><?=$v['max_allowed']?></td>
          <td align="center" width="5%"><?=$v['max_x']?></td>
          <td align="center" width="5%"><?=$v['max_y']?></td>
          <td align="center" width="5%"><?=$v['max_z']?></td>
          <td align="center" width="5%"><?=$v['min_x']?></td>
          <td align="center" width="5%"><?=$v['min_y']?></td>
          <td align="center" width="5%"><?=$v['respawn_timer']?></td>  
          <td align="center" width="5%"><?=$v['version']?></td> 
          <td align="right">      
            <a href="index.php?editor=misc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&gsid=<?=$v['gsid']?>&action=14"><img src="images/edit2.gif" border="0" title="Edit Entry"></a>          
            <a onClick="return confirm('Really Delete Entry <?=$v['gsid']?>?');" href="index.php?editor=misc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&gsid=<?=$v['gsid']?>&action=16"><img src="images/remove3.gif" border="0" title="Delete this entry"></a>
          </td>
        </tr>
        <?$x++; endforeach;?>
        </table>
        <?endif;?>
<? if (!isset($gspawn)):?>
        <tr>
          <td align="left" width="100" style="padding: 10px;">No ground spawns</td>
        </tr>
<?endif;?>