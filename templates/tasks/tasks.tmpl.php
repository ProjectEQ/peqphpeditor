  <div class="table_container" style="width: 750px;">
    <div class="table_header">
      <div style="float:right">
        <a href="index.php?editor=tasks&tskid=<?=$id?>&action=1"><img src="images/edit2.gif" border="0" title="Edit Entry"></a>          
        <a onClick="return confirm('Really Delete Task <?=$id?> and all associated activities?');" href="index.php?editor=tasks&tskid=<?=$id?>&action=3"><img src="images/remove3.gif" border="0" title="Delete this entry"></a>
      </div>
      Task: <?=$title?> (<?=$id?>) Task Set: <a href="index.php?editor=tasks&tskid=<?=$id?>&tsksetid=<?=$tsksetsid?>&action=29">(<?=$tsksetsid?>)</a>
    </div>
    <div class="table_content">
      <table cellspacing="0" border="0" width="100%">
        <tr>
          <td>
            <fieldset>
              <legend><strong>General</font></strong></legend>
              <table width="100%" border="0" cellpadding="3" cellspacing="0">
                <tr>
                  <td align="left" width="20%">ID: <?=$id?></td>
                  <td align="left" width="55%" colspan="3">Title: "<?=$title?>"</td>
                  <td align="left" width="20%">Type: <?=$task_types[$type]?></td>
                </tr>
                <tr>
                  <td align="left" width="20%">Duration Code: <?=$duration_codes[$duration_code]?></td>
                  <td align="left" width="20%">Duration: <?=$duration?></td>
                  <td align="left" width="20%">Min Level: <?=$min_level?></td>
                  <td align="left" width="20%">Max Level:  <?=$max_level?></td>              
                  <td align="left" width="20%">Repeatable: <?=$yesno[$repeatable]?></td>
                </tr>
                <tr>
                  <td align="left" width="20%">Level Spread: <?=$level_spread?></td>
                  <td align="left" width="20%">Min Players: <?=$min_players?></td>
                  <td align="left" width="20%">Max Players: <?=$max_players?></td>
                  <td align="left" width="20%">DZ Template ID: <?echo ($dz_template_id > 0) ? "<a href='index.php?editor=expeditions&id=" . $dz_template_id . "&action=34'>" . $dz_template_id . "</a>" : $dz_template_id;?></td>
                  <td align="left" width="20%">Enabled: <?echo ($enabled == 1) ? "Yes" : "No";?></td>
                </tr>
              </table>
            </fieldset><br>
            <fieldset>
              <legend><strong>Description</font></strong></legend>
              <table width="100%" border="0" cellpadding="3" cellspacing="0">
                <tr>
                  <td align="left" width="100%"><?=$description?></td>
                </tr>
              </table>
            </fieldset><br>
            <fieldset>
              <legend><strong>Completion</font></strong></legend>
              <table width="100%" border="0" cellpadding="3" cellspacing="0">
                <tr>
                  <td align="left" width="50%" colspan="2">Reward Text: "<?=$reward_text?>"</td>
                  <td align="left" width="25%">Reward Method: <?=$rewardmethods[$reward_method]?></td>
                  <td align="left" width="25%">Reward Faction: <?=$faction_reward?></td>
                </tr>
                <tr>
                  <td align="left" width="25%">Reward ID List: <?=$reward_id_list?></td>
                  <td align="left" width="25%">Reward Cash: <?=$cash_reward?></td>
                  <td align="left" width="25%">Reward EXP: <?=$exp_reward?></td>
                  <td align="left" width="25%">Faction Amount: <?=$faction_amount?></td>
                </tr>
                <tr>
                  <td align="left" width="25%">Reward Points: <?=$reward_points?></td>
                  <td align="left" width="25%">Reward Point Type: <?=$reward_point_types[$reward_point_type]?> (<?=$reward_point_type?>)</td>
                  <td align="left" width="25%">Lock Activity ID: <?echo ($lock_activity_id > -1) ? $lock_activity_id . "*" : "None";?> (<?=$lock_activity_id?>)</td>
                  <td align="left" width="25%">&nbsp;</td>
                </tr>
                <tr>
                  <td align="left" width="25%">Replay Timer Group: <?=$replay_timer_group?></td>
                  <td align="left" width="25%">Replay Timer: <?=$replay_timer_seconds?></td>
                  <td align="left" width="25%">Request Timer Group: <?=$request_timer_group?></td>
                  <td align="left" width="25%">Request Timer: <?=$request_timer_seconds?></td>
                </tr>
                <tr>
                  <td align="left" width="100%" colspan="4">Completion Emote: "<?=$completion_emote?>"</td>
                </tr>
              </table>
            </fieldset>
          </td>
        </tr>
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
<?if(isset($activity)):?>
      <tr>
        <td align="center" width="5%"><strong>Activity ID</strong></td>
        <td align="center" width="5%"><strong>REQ ID</strong></td>
        <td align="center" width="5%"><strong>Step</strong></td>
        <td align="center" width="5%"><strong>Type</strong></td>
        <td align="center" width="15%"><strong>Target</strong></td>
        <td align="center" width="15%"><strong>Item</strong></td>
        <td align="center" width="15%"><strong>Override</strong></td>
        <td align="center" width="5%"><strong>Goal Method</strong></td>
        <td align="center" width="5%"><strong>Goal Count</strong></td>
        <td align="center" width="5%"><strong>Optional</strong></td>
        <td width="5%"></td>
      </tr>
<?$x=0; foreach($activity as $activity=>$v):?>
      <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
        <td align="center" width="5%"><?=$v['activityid']?><?echo ($lock_activity_id == $v['activityid']) ? "*" : "";?></td>
        <td align="center" width="5%"><?=$v['req_activity_id']?></td>
        <td align="center" width="5%"><?=$v['step']?></td>
        <td align="center" width="5%"><?=$activitytypes[$v['activitytype']]?></td>
        <td align="center" width="15%"><?=$v['target_name']?></td>  
        <td align="center" width="15%"><?=$v['item_list']?></td>
        <td align="center" width="15%"><?=$v['description_override']?></td>
        <td align="center" width="5%"><?=$rewardmethods[$v['goalmethod']]?></td>
        <td align="center" width="5%"><?=$v['goalcount']?></td>
        <td align="center" width="5%"><?=$yesno[$v['optional']]?></td>
        <td align="right">      
          <a href="index.php?editor=tasks&tskid=<?=$id?>&activityid=<?=$v['activityid']?>&action=6"><img src="images/edit2.gif" border="0" title="Edit Entry"></a>          
          <a onClick="return confirm('Really Delete Activity <?=$v['activityid']?>?');" href="index.php?editor=tasks&tskid=<?=$id?>&activityid=<?=$v['activityid']?>&action=8"><img src="images/remove3.gif" border="0" title="Delete this entry"></a>
        </td>
      </tr>
<?$x++; endforeach;?>
<?endif;?>
<?if(!isset($activity)):?>
      <tr>
        <td align="left" width="100" style="padding: 10px;">No activities for the task found.</td>
      </tr>
<?endif;?>
    </table>
  </div>
