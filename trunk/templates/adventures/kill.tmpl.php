      <div class="table_container" style="width: 750px;">
      <div class="table_header">
        <table width="100%" cellpadding="0" cellspacing="0">
          <tr>
           <td>Kill Adventures</td>
           <td align="right">    
          <a href="index.php?editor=adventures&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=10"><img src="images/add.gif" border="0" title="Add an adventure"></a>            </td>
           </tr>        
         </table>
      </div>

       <table class="table_content2" width="100%">
<? if (isset($kill)):?>
         <tr>
          <td align="center" width="1%"><strong>id</strong></td>
          <td align="center" width="10%"><strong>zone</strong></td>
          <td align="center" width="5%"><strong>hard</strong></td>
          <td align="center" width="5%"><strong>raid</strong></td>
          <td align="center" width="5%"><strong>min level</strong></td>
          <td align="center" width="5%"><strong>max level</strong></td>
          <td align="center" width="15%"><strong>type</strong></td>
          <td align="center" width="5%"><strong>count</strong></td>
          <td align="center" width="20%"><strong>theme</strong></td>
          <td align="center" width="10%"><strong>zone in</strong></td>
          <th width="5%"></th>
         </tr>
<?$x=0; foreach($kill as $kill=>$v):?>
        <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
          <td align="center" width="1%"><?=$v['id']?></td>
          <td align="center" width="10%"><?=$v['zone']?></td>
          <td align="center" width="5%"><?=$yesno[$v['is_hard']]?></td>
          <td align="center" width="5%"><?=$yesno[$v['is_raid']]?></td>
          <td align="center" width="5%"><?=$v['min_level']?></td>
          <td align="center" width="5%"><?=$v['max_level']?></td>
          <td align="center" width="15%"><?=$advtype[$v['type']]?></td>
          <td align="center" width="5%"><?=$v['type_count']?></td>
          <td align="center" width="20%"><?=$themetype[$v['theme']]?></td>
          <td align="center" width="10%"><?=getZoneName($v['zone_in_zone_id'])?></td>
          <td align="right">      
            <a href="index.php?editor=adventures&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&id=<?=$v['id']?>&action=8"><img src="images/edit2.gif" border="0" title="Edit Entry"></a> 
            <a onClick="return confirm('Really Delete Adventure <?=$v['id']?>?');" href="index.php?editor=adventures&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&id=<?=$v['id']?>&action=7"><img src="images/remove3.gif" border="0" title="Delete this entry"></a>
          </td>
        </tr>
        <?$x++; endforeach;?>
        </table>
        <?endif;?>
<? if (!isset($kill)):?>
        <tr>
          <td align="left" width="100" style="padding: 10px;">There are no kill adventures assigned to this NPC.</td>
        </tr>
<?endif;?>