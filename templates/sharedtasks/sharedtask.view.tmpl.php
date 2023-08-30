<?extract($task_data);?>
  <div class="table_container" style="width: 550px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td align="left">Shared Task Data</td>
          <td align="right">&nbsp;</td>
        </tr>
      </table>
    </div>
    <div class="table_content"> 
      <table cellspacing="0" border="0" width="100%">
        <tr>
          <td>
            <fieldset>
              <legend><strong>Task</font></strong></legend>
              <table width="100%" border="0" cellpadding="3" cellspacing="0">
                <tr>
                  <td><strong>ID:</strong> <?=$task['id']?></td>
                </tr>
                <tr>
                  <td><strong>Task:</strong> <?=getTaskTitle($task['task_id'])?> (<?=$task['task_id']?>) (<a href="index.php?editor=tasks&tskid=<?=$task['task_id']?>" title="View Task Details" target="_blank">View</a>)</td>
                </tr>
<?if ($_GET['action'] == 2):?>
                <tr>
                  <td><strong>Dynamic Zone:</strong> <?=$dynamic_zone['dynamic_zone_id']?> (<a href="index.php?editor=expeditions&id=<?=$dynamic_zone['dynamic_zone_id']?>&action=16">View</a>)</td>
                </tr>
<?endif;?>
                <tr>
                  <td><strong>Locked:</strong> <?=$yesno[$task['is_locked']]?></td>
                </tr>
                <tr>
                  <td><strong>Accepted:</strong> <?echo (isset($task['accepted_time'])) ? $task['accepted_time'] : "N/A";?></td>
                </tr>
                <tr>
                  <td><strong>Expires:</strong> <?echo (isset($task['expire_time'])) ? $task['expire_time'] : "N/A";?></td>
                </tr>
                <tr>
                  <td><strong>Completion:</strong> <?echo (isset($task['completion_time'])) ? $task['completion_time'] : "N/A";?></td>
                </tr>
              </table>
            </fieldset>
          </td>
        </tr>
        <tr>
          <td>
            <fieldset>
              <legend><strong>Members</font></strong></legend>
              <table width="100%" border="0" cellpadding="3" cellspacing="0">
<?foreach ($members as $member):?>
                <tr>
                  <td><?=getPlayerName($member['character_id'])?> (<?=$member['character_id']?>)<?echo ($member['is_leader'] == 1) ? " <a title='LEADER'><strong>*</strong></a>" : "";?></td>
                </tr>
<?endforeach;?>
              </table>
            </fieldset>
          </td>
        </tr>
        <tr>
          <td>
            <fieldset>
              <legend><strong>Activities</font></strong></legend>
              <table width="100%" border="0" cellpadding="3" cellspacing="0">
                <tr>
                  <td align="center"><strong>ID</strong></td>
                  <td align="center"><strong>Type</strong></td>
                  <td align="center"><strong>Done</strong></td>
                  <td align="center"><strong>Updated</strong></td>
                  <td align="center"><strong>Completed</td>
                </tr>
<?$x = 0;?>
<?foreach ($activities as $activity):?>
                <tr>
                  <td align="center"><?=$activity['activity_id']?></td>
                  <td align="center"><?=$activitytypes[$activity_types[$x]['activitytype']]?></td>
                  <td align="center"><?=$activity['done_count']?>/<?=$activity_types[$x]['goalcount']?></td>
                  <td align="center"><?=$activity['updated_time']?></td>
                  <td align="center"><?=$activity['completed_time']?></td>
                </tr>
<?$x++;?>
<?endforeach;?>
              </table>
            </fieldset>
          </td>
        </tr>
      </table>
    </div>
  </div>
