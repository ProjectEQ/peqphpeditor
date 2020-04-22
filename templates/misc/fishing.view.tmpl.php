      <div class="table_container" style="width: 600px;">
      <div class="table_header">
        <table width="100%" cellpadding="0" cellspacing="0">
          <tr>
           <td>Fishing</td>
           <td align="right">    
          <a href="index.php?editor=misc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&action=5"><img src="images/add.gif" border="0" title="Add an entry to this zone"></a>
            </td>
           </tr>        
         </table>
      </div>

       <table class="table_content2" width="100%">
         <tr>
          <td align="center" width="5%"><strong>ID</strong></td>
          <td align="center" width="12%"><strong>Item</strong></td>
          <td align="center" width="12%"><strong>Zone</strong></td>
          <td align="center" width="8%"><strong>Skill Level</strong></td>
          <td align="center" width="8%"><strong>Chance</strong></td>
          <td align="center" width="10%"><strong>NPC</strong></td>
          <td align="center" width="8%"><strong>NPC Chance</strong></td>
          <th width="5%"></th>
         </tr>
        <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
          <td align="center" width="5%"><?=$fsid?></td>
          <td align="center" width="12%"><?=get_item_name($fiid)?> <span>[<a href="https://lucy.allakhazam.com/item.html?id=<?=$fiid?>" target="_blank">Lucy</a>]</span></td>
<?if($zoneid == 0):?>          
          <td align="center" width="12%">All</td>
<?endif;?>
<?if($zoneid != 0):?>          
          <td align="center" width="12%"><?=getZoneName($zoneid)?></td>
<?endif;?>
          <td align="center" width="8%"><?=$skill_level?></td>
          <td align="center" width="8%"><?=$chance?>%</td>
<?if($npc_id > 0):?>
          <td align="center" width="10%"> <a href="index.php?editor=npc&z=$z&npcid=<?=$npc_id?>"><?=getNPCName($npc_id)?></td>
<?endif;?>      
<?if($npc_id < 1):?>     
          <td align="center" width="8%"><?=$npc_id?></td>
<?endif;?>
          <td align="center" width="8%"><?=$npc_chance?>%</td>
          <td align="right">      
            <a href="index.php?editor=misc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&fsid=<?=$fsid?>&action=2"><img src="images/edit2.gif" border="0" title="Edit Entry"></a>          
            <a href="index.php?editor=misc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&fsid=<?=$fsid?>&action=4"><img src="images/remove3.gif" border="0" title="Delete this entry"></a>
          </td>
        </tr>
        </table>