      <div class="table_container" style="width: 700px;">
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
<? if (isset($fishing)):?>
         <tr>
          <td align="center" width="5%"><strong>ID</strong></td>
          <td align="center" width="12%"><strong>Item</strong></td>
          <td align="center" width="8%"><strong>Skill Level</strong></td>
          <td align="center" width="8%"><strong>Chance</strong></td>
          <td align="center" width="10%"><strong>NPC</strong></td>
          <td align="center" width="8%"><strong>NPC Chance</strong></td>
          <th width="5%"></th>
         </tr>
<?$x=0; foreach($fishing as $fishing=>$v):?>
        <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
          <td align="center" width="5%"><?=$v['fsid']?></td>
          <td align="center" width="12%"><a href="index.php?editor=items&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&id=<?=$v['fiid']?>&action=2"><?=$v['name']?></a> <span>[<a href="http://lucy.allakhazam.com/item.html?id=<?=$v['fiid']?>">lucy</a>]</span></td>
          <td align="center" width="8%"><?=$v['skill_level']?></td>
          <td align="center" width="8%"><?=$v['chance']?>%</td>
<?if($v['npc_id'] > 0):?>
          <td align="center" width="10%"> <a href="index.php?editor=npc&z=<?=get_zone_by_npcid($v['npc_id'])?>&zoneid=<?=get_zoneid_by_npcid($v['npc_id'])?>&npcid=<?=$v['npc_id']?>"><?=getNPCName($v['npc_id'])?></td>
<?endif;?>      
<?if($v['npc_id'] < 1):?>     
          <td align="center" width="8%"><?=$v['npc_id']?></td>
<?endif;?>
          <td align="center" width="8%"><?=$v['npc_chance']?>%</td>
          <td align="right">      
            <a href="index.php?editor=misc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&fsid=<?=$v['fsid']?>&action=2"><img src="images/edit2.gif" border="0" title="Edit Entry"></a>          
            <a onClick="return confirm('Really Delete Entry <?=$v['fsid']?>?');" href="index.php?editor=misc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&fsid=<?=$v['fsid']?>&action=4"><img src="images/remove3.gif" border="0" title="Delete this entry"></a>
          </td>
        </tr>
        <?$x++; endforeach;?>
        </table>
        <?endif;?>
<? if (!isset($fishing)):?>
        <tr>
          <td align="left" width="100" style="padding: 10px;">No fishing data</td>
        </tr>
<?endif;?>