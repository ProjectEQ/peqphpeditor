  <form name="tasks_add" method="post" action="index.php?editor=tasks&action=5">
    <div class="edit_form">
      <div class="edit_form_header">Add Task</div>
      <div class="edit_form_content">
        <fieldset>
          <legend><strong><font size="4">General</font></strong></legend>
          <table width="100%" border="0" cellpadding="3" cellspacing="0">
            <tr>
              <td align="left" width="20%">ID:<br><input type="text" name="id" size="5" value="<?=$suggestid?>"></td>
              <td align="left" width="55%" colspan="3">Title:<br><input type="text" name="title" size="57" value=""></td>
              <td align="left" width="25%">
                Type:<br>
                <select name="type">
<?foreach ($task_types as $key => $value):?>
                  <option value="<?=$key?>"><?=$key?>: <?=$value?></option>
<?endforeach;?>
                </select>
              </td>
            </tr> 
            <tr>
              <td align="left" width="20%">
                Duration Code:<br>
                <select name="duration_code">
<?foreach ($duration_codes as $key => $value):?>
                  <option value="<?=$key?>"><?=$key?>: <?=$value?></option>
<?endforeach;?>
                </select>
              </td>
              <td align="left" width="20%">Duration:<br><input type="text" name="duration" size="7" value="0"></td>
              <td align="left" width="20%">Min Level:<br><input type="text" name="min_level" size="7" value="0"></td>
              <td align="left" width="20%">Max Level:<br><input type="text" name="max_level" size="7" value="0"></td>
              <td align="left" width="20%">
                Repeatable:<br>
                <select name="repeatable">
                  <option value="0">No</option>
                  <option value="1" selected>Yes</option>
                </select>
              </td>
            </tr>
            <tr>
              <td align="left" width="20%">Level Spread:<br><input type="text" name="level_spread" size="7" value="0"></td>
              <td align="left" width="20%">Min Players:<br><input type="text" name="min_players" size="7" value="0"></td>
              <td align="left" width="20%">Max Players:<br><input type="text" name="max_players" size="7" value="0"></td>
              <td align="left" width="20%">DZ Template ID:<br><input type="text" name="dz_template_id" size="7" value="0"></td>
              <td align="left" width="20%">
                Enabled:<br>
                <select name="enabled">
                  <option value="0">No (0)</option>
                  <option value="1" selected>Yes (1)</option>
                </select>
              </td>
            </tr>
          </table>
        </fieldset><br>
        <fieldset>
          <legend><strong><font size="4">Description</font></strong></legend>
          <table width="100%" border="0" cellpadding="3" cellspacing="0">
            <tr>
              <td>Note: Reference activities using "%1", etc.</td>
            </tr>
            <tr>
              <td><textarea name="description" rows="7" cols="88">[1,]</textarea></td>
            </tr>
          </table>
        </fieldset><br>
        <fieldset>
          <legend><strong><font size="4">Completion</font></strong></legend>
          <table width="100%" border="0" cellpadding="3" cellspacing="0">
            <tr>
              <td align="left" width="50%" colspan="2">Reward Text:<br><input type="text" name="reward_text" size="45" value=""></td> 
              <td align="left" width="50%" colspan="2">
                Reward Method:<br>
                <select name="reward_method" style="width: 180px;">
<?foreach($rewardmethods as $key=>$value):?>
                  <option value="<?=$key?>"<?echo (isset($reward_method) && $key == $reward_method)? " selected" : "";?>><?=$key?>: <?=$value?></option>
<?endforeach;?>
                </select>
              </td>
            </tr>
            <tr>
              <td align="left" width="25%">Reward ID List: (|=delimiter)<br><input type="text" name="reward_id_list" size="20" value="0"></td>
              <td align="left" width="25%">Reward XP:<br><input type="text" name="exp_reward" size="7" value="0"></td>
              <td align="left" width="25%">Reward Cash:<br><input type="text" name="cash_reward" size="7" value="0"></td>
              <td align="left" width="25%">Reward Faction:<br><input type="text" name="faction_reward" size="7" value="0"></td>
            </tr>
            <tr>
              <td align="left" width="25%">Reward Points:<br><input type="text" name="reward_points" size="7" value="0"></td>
              <td align="left" width="25%">
                Reward Point Type:<br>
                <select name="reward_point_type">
<?foreach ($reward_point_types as $key=>$value):?>
                  <option value="<?=$key?>"><?=$key?>: <?=$value?></option>
<?endforeach;?>
              <td align="left" width="25%">Lock Activity ID:<br><input type="text" name="lock_activity_id" size="7" value="-1"></td>
              <td align="left" width="25%">Faction Amt:<br><input type="text" name="faction_amount" size="7" value="0"></td>
            </tr>
            <tr>
              <td align="left" width="25%">Replay Timer Group:<br><input type="text" name="replay_timer_group" size="7" value="0"></td>
              <td align="left" width="25%">Replay Timer:<br><input type="text" name="replay_timer_seconds" size="7" value="0"></td>
              <td align="left" width="25%">Request Timer Group:<br><input type="text" name="request_timer_group" size="7" value="0"></td>
              <td align="left" width="25%">Request Timer:<br><input type="text" name="request_timer_seconds" size="7" value="0"></td>
            </tr>
          </table>
          <table width="100%" border="0" cellpadding="3" cellspacing="0">
            <tr>
              <td>
                Completion Emote:<br>
                <textarea name="completion_emote" rows="2" cols="88"></textarea>
              </td>
            </tr>
          </table>
        </fieldset><br>
        <center>
          <input type="submit" value="Add Task">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back();">
        </center>
      </div>
    </div>
  </form>
