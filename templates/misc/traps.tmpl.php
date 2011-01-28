      <div class="table_container" style="width: 750px;">
      <div class="table_header">
        <table width="100%" cellpadding="0" cellspacing="0">
          <tr>
           <td>Traps</td>
           <td align="right">    
          <a href="index.php?editor=misc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&action=51"><img src="images/last.gif" border="0" title="Copy traps by version"></a>
          <a href="index.php?editor=misc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&action=23"><img src="images/add.gif" border="0" title="Add an entry to this zone"></a>
          <a href="index.php?editor=misc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&action=59"><img src="images/remove3.gif" border="0" title="Delete traps by version"></a>
            </td>
           </tr>        
         </table>
      </div>

       <table class="table_content2" width="100%">
<? if (isset($traps)):?>
         <tr>
          <td align="center" width="5%"><strong>id</strong></td>
          <td align="center" width="5%"><strong>x</strong></td>
          <td align="center" width="5%"><strong>y</strong></td>
          <td align="center" width="5%"><strong>z</strong></td>
          <td align="center" width="5%"><strong>maxzdiff</strong></td>
          <td align="center" width="5%"><strong>radius</strong></td>
          <td align="center" width="5%"><strong>chance</strong></td>
          <td align="center" width="10%"><strong>effect</strong></td>
          <td align="center" width="10%"><strong>value</strong></td>
          <td align="center" width="10%"><strong>value2</strong></td>
          <td align="center" width="5%"><strong>skill</strong></td>
          <td align="center" width="5%"><strong>level</strong></td>
          <td align="center" width="5%"><strong>respawn</strong></td>
          <td align="center" width="5%"><strong>variance</strong></td>
          <td align="center" width="5%"><strong>version</strong></td>
          <th width="5%"></th>
         </tr>
<?$x=0; foreach($traps as $traps=>$v):?>
        <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
          <td align="center" width="5%"><?=$v['tid']?></td>
          <td align="center" width="5%"><?=$v['x_coord']?></td>
          <td align="center" width="5%"><?=$v['y_coord']?></td>
          <td align="center" width="5%"><?=$v['z_coord']?></td>
          <td align="center" width="5%"><?=$v['maxzdiff']?></td>
          <td align="center" width="5%"><?=$v['radius']?></td>
          <td align="center" width="5%"><?=$v['chance']?>%</td>
          <td align="center" width="10%"><?=$traptype[$v['effect']]?></td>
<?if($v['effect'] == 2 || $v['effect'] == 3):?>
          <td align="center" width="10%"><a href="index.php?editor=npc&z=<?=get_zone_by_npcid($v['effectvalue'])?>&zoneid=<?=get_zoneid_by_npcid($v['effectvalue'])?>&npcid=<?=$v['effectvalue']?>"><?=getNPCName($v['effectvalue'])?></td>
<?endif;?>
<?if($v['effect'] == 1 || $v['effect'] == 4):?>
          <td align="center" width="10%"><?=$v['effectvalue']?></td>
<?endif;?>
<?if($v['effect'] == 0):?>
          <td align="center" width="10%"><?=getSpellName($v['effectvalue'])?> <span>[<a href="http://lucy.allakhazam.com/spell.html?id=<?=$v['effectvalue']?>">lucy</a>]</span>
<?endif;?>    
<?if($v['effect'] == 1):?>   
          <td align="center" width="10%"><?=$alarmtype[$v['effectvalue2']]?></td>  
<?endif;?>
<?if($v['effect'] < 1 || $v['effect'] > 1):?>
          <td align="center" width="10%"><?=$v['effectvalue2']?></td>
<?endif;?> 
          <td align="center" width="5%"><?=$v['skill']?></td>
          <td align="center" width="5%"><?=$v['level']?></td>
          <td align="center" width="5%"><?=$v['respawn_time']?></td>
          <td align="center" width="5%"><?=$v['respawn_var']?></td>
          <td align="center" width="5%"><?=$v['version']?></td>
          <td align="right">      
            <a href="index.php?editor=misc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&tid=<?=$v['tid']?>&action=20"><img src="images/edit2.gif" border="0" title="Edit Entry"></a>          
            <a onClick="return confirm('Really Delete Trap <?=$v['tid']?>?');" href="index.php?editor=misc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&tid=<?=$v['tid']?>&action=22"><img src="images/remove3.gif" border="0" title="Delete this entry"></a>
          </td>
        </tr>
        <?$x++; endforeach;?>
        </table>
        <?endif;?>
<? if (!isset($traps)):?>
        <tr>
          <td align="left" width="100" style="padding: 10px;">Walk confidently, there are no traps here</td>
        </tr>
<?endif;?>