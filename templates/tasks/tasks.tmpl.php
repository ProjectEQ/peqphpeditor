        <div class="table_container" style="width: 750px;">
         <div class="table_header">
            <div style="float:right">
            <a href="index.php?editor=tasks&tskid=<?=$id?>&action=1"><img src="images/edit2.gif" border="0" title="Edit Entry"></a>          
            <a onClick="return confirm('Really Delete Task <?=$id?> and all associated activities?');" href="index.php?editor=tasks&tskid=<?=$id?>&action=3"><img src="images/remove3.gif" border="0" title="Delete this entry"></a>
           </div>
           <td> Task: <?=$title?> (<?=$id?>) Task Set: <td align="center" width="5%"><a href="index.php?editor=tasks&tskid=<?=$id?>&tsksetid=<?=$tsksetsid?>&action=29">(<?=$tsksetsid?>)</a></td>
           </div>
           <div class="table_content">
         <table cellspacing=0 border=0 width="100%">
          <tr>
             <td>
          <center> 
      
         <fieldset>
           <legend><strong>General</font></strong></legend>
           <table width="100%" border="0" cellpadding="3" cellspacing="0">
             <tr>
               <td align="left" width="20%">Zone: <?echo ($startzone > 0) ? getZoneName($startzone) : "NONE";?></td>
               <td align="left" width="20%">Min Level: <?=$minlevel?></td>
               <td align="left" width="20%">Max Level:  <?=$maxlevel?></td>              
               <td align="left" width="20%">Duration: <?=$duration?></td>
               <td align="left" width="20%">Repeatable: <?=$yesno[$repeatable]?></td>
              </tr> 
            </table>
         </fieldset><br>

         <fieldset>
           <legend><strong>Reward</font></strong></legend>
           <table width="100%" border="0" cellpadding="3" cellspacing="0">
             <tr>
               <td align="left" width="35%">Reward Text:  <?=$reward?></td>
               <td align="left" width="25%">Reward Method: <?=$rewardmethods[$rewardmethod]?></td>
               <td align="left" width="20%">Reward Cash: <?=$cashreward?></td>
               <td align="left" width="20%">Reward XP:  <?=$xpreward?></td>            
             </tr>
              <tr>
               <td align="left" width="35%" colspan="2">Reward:
               <?if(($rewardmethod == 0 || $rewardmethod == 2) && $rewardid > 1000):?>
          <a href="index.php?editor=items&tskid=<?=$id?>&id=<?=$rewardid?>&action=2"><?echo $rewardid . " - " . get_item_name($rewardid)?></a> <span>[<a href="http://lucy.allakhazam.com/item.html?id=<?=$rewardid?>">lucy</a>]</span></td>
              <?endif;?> 
               <?if($rewardmethod == 2 && $rewardid < 1001):?>
          <?=$rewardid?></td>
              <?endif;?> 
               <?if($rewardmethod == 1 && $rewardid > 0 && $rewardid < 1001):?>
          <a href="index.php?editor=tasks&tskid=<?=$id?>&lid=<?=$rewardid?>&action=11"><?=$rewardid?></a></td>
              <?endif;?> 
               <?if($rewardmethod == 1 && $rewardid == 0):?>
          <a href="index.php?editor=tasks&tskid=<?=$id?>&action=12"><?=$rewardid?></a></td>
              <?endif;?> 
               <td align="left" width="25%">&nbsp;</td>
               <td align="left" width="20%">&nbsp;</td>
               <td align="left" width="20%">&nbsp;</td>
             </tr>
           </table>
         </fieldset><br>

          <fieldset>
           <legend><strong>Description</font></strong></legend>
           <table width="100%" border="0" cellpadding="3" cellspacing="0">
             <tr>
             <td align="center" width="100%"> <?=$description?> </td>
           </tr>
             </table>
           </fieldset>


       </table>
     </div>
     </div><br><br>

      <div class="table_container" style="width: 750px;">
      <div class="table_header">
        <table width="100%" cellpadding="0" cellspacing="0">
          <tr>
           <td>Activities</td>
           <td align="right">    
          <a href="index.php?editor=tasks&tskid=<?=$id?>&action=9"><img src="images/add.gif" border="0" title="Add an activity"></a>
            </td>
           </tr>        
         </table>
      </div>

       <table class="table_content2" width="100%">
<? if (isset($activity)):?>
         <tr>
          <td align="center" width="5%"><strong>Activity ID</strong></td>
          <td align="center" width="5%"><strong>Step</strong></td>
          <td align="center" width="5%"><strong>Type</strong></td>
          <td align="center" width="10%"><strong>Text 1</strong></td>
          <td align="center" width="10%"><strong>Text 2</strong></td>
          <td align="center" width="10%"><strong>Text 3</strong></td>
          <td align="center" width="5%"><strong>Goal ID</strong></td>
          <td align="center" width="5%"><strong>Goal Method</strong></td>
          <td align="center" width="5%"><strong>Goal Count</strong></td>
          <td align="center" width="5%"><strong>Deliver NPC</strong></td>
          <td align="center" width="5%"><strong>Zone</strong></td>
          <td align="center" width="5%"><strong>Optional</strong></td>
          <th width="5%"></th>
         </tr>
<?$x=0; foreach($activity as $activity=>$v):?>
        <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
          <td align="center" width="5%"><?=$v['activityid']?></td>
          <td align="center" width="5%"><?=$v['step']?></td>
          <td align="center" width="5%"><?=$activitytypes[$v['activitytype']]?></td>
          <td align="center" width="10%"><?=$v['text1']?></td>  
          <td align="center" width="10%"><?=$v['text2']?></td>
          <td align="center" width="10%"><?=$v['text3']?></td>
          <?if($v['activitytype'] == 5 && $v['goalid'] == 0):?>
          <td align="center" width="5%"><a href="index.php?editor=tasks&tskid=<?=$id?>&aid=<?=$v['activityid']?>&atype=<?=$v['activitytype']?>&action=21"><?=$v['goalid']?></td>
          <?endif;?>
          <?if($v['activitytype'] == 5 && $v['goalid'] > 0):?>
          <td align="center" width="5%"><a href="index.php?editor=tasks&tskid=<?=$id?>&eid=<?=$v['goalid']?>&aid=<?=$v['activityid']?>&atype=<?=$v['activitytype']?>&action=17"><?=$v['goalid']?></td>
          <?endif;?>
          <?if(($v['activitytype'] == 3 || $v['activitytype'] == 2 || $v['activitytype'] == 7 || $v['activitytype'] == 8  || $v['activitytype'] == 6) && $v['goalid'] == 0 && $v['goalmethod'] == 1):?>
          <td align="center" width="5%"><a href="index.php?editor=tasks&tskid=<?=$id?>&aid=<?=$v['activityid']?>&atype=<?=$v['activitytype']?>&action=23"><?=$v['goalid']?></td>
          <?endif;?>
          <?if(($v['activitytype'] == 3 || $v['activitytype'] == 2 || $v['activitytype'] == 7 || $v['activitytype'] == 8  || $v['activitytype'] == 6) && $v['goalid'] > 0 && $v['goalmethod'] == 1):?>
          <td align="center" width="5%"><a href="index.php?editor=tasks&tskid=<?=$id?>&lid=<?=$v['goalid']?>&aid=<?=$v['activityid']?>&atype=<?=$v['activitytype']?>&action=26"><?=$v['goalid']?></td>
          <?endif;?>
          <?if($v['activitytype'] > 8 || $v['activitytype'] == 0):?>
          <td align="center" width="5%"><?=$v['goalid']?></td>
          <?endif;?>
          <?if(($v['activitytype'] == 4 && $v['goalmethod'] != 2) || ($v['goalmethod'] != 1 && $v['activitytype'] == 2)) :?>
          <td align="center" width="5%"><a href="index.php?editor=npc&z=<?=get_zone_by_npcid($v['goalid'])?>&zoneid=<?=get_zoneid_by_npcid($v['goalid'])?>&npcid=<?=$v['goalid']?>"><?=$v['goalid']?></td>
          <?endif;?>
          <?if($v['activitytype'] == 4 && $v['goalmethod'] == 2):?>
          <td align="center" width="5%"><?=$v['goalid']?></td>
          <?endif;?>
          <?if(($v['activitytype'] == 3 || $v['activitytype'] == 1 || $v['activitytype'] == 7 || $v['activitytype'] == 8  || $v['activitytype'] == 6) && ($v['goalmethod'] == 0)):?>
          <td align="center" width="5%"><a href="index.php?editor=items&tskid=<?=$id?>&id=<?=$v['goalid']?>&action=2"><?=$v['goalid']?></a> <span>[<a href="http://lucy.allakhazam.com/item.html?id=<?=$v['goalid']?>">lucy</a>]</span></td>
          <?endif;?>
          <?if(($v['activitytype'] == 3 || $v['activitytype'] == 1 || $v['activitytype'] == 7 || $v['activitytype'] == 8  || $v['activitytype'] == 6) && ($v['goalmethod'] == 2)):?>
          <td align="center" width="5%"><?=$v['goalid']?> 
          <?endif;?>
          <td align="center" width="5%"><?=$rewardmethods[$v['goalmethod']]?></td>
          <td align="center" width="5%"><?=$v['goalcount']?></td>
          <?if($v['delivertonpc'] == 0):?>
          <td align="center" width="5%"><?=$v['delivertonpc']?></td>
          <?endif;?> 
          <?if($v['delivertonpc'] > 0):?>
          <td align="center" width="5%"><a href="index.php?editor=npc&z=<?=get_zone_by_npcid($v['delivertonpc'])?>&zoneid=<?=get_zoneid_by_npcid($v['delivertonpc'])?>&npcid=<?=$v['delivertonpc']?>"><?=$v['delivertonpc']?></td>
          <?endif;?>
          <td align="center" width="5%"><?echo ($v['zoneid'] > 0) ? getZoneName($v['zoneid']): "NONE";?></td>
          <td align="center" width="5%"><?=$yesno[$v['optional']]?></td>
          <td align="right">      
            <a href="index.php?editor=tasks&tskid=<?=$id?>&activityid=<?=$v['activityid']?>&action=6"><img src="images/edit2.gif" border="0" title="Edit Entry"></a>          
            <a onClick="return confirm('Really Delete Activity <?=$v['activityid']?>?');" href="index.php?editor=tasks&tskid=<?=$id?>&activityid=<?=$v['activityid']?>&action=8"><img src="images/remove3.gif" border="0" title="Delete this entry"></a>
          </td>
        </tr>
        <?$x++; endforeach;?>
        </table>
        <?endif;?>
<? if (!isset($activity)):?>
        <tr>
          <td align="left" width="100" style="padding: 10px;">No activities for the task found.</td>
        </tr>
<?endif;?>