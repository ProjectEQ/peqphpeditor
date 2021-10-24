  <form name="tasks_edit" method="post" action="index.php?editor=tasks&action=2">
    <div class="edit_form">
      <div class="edit_form_header">Edit Task: <?=$title?> (<?=$id?>)</div>
      <div class="edit_form_content">
        <fieldset>
          <legend><strong><font size="4">General</font></strong></legend>
          <table width="100%" border="0" cellpadding="3" cellspacing="0">
            <tr>
              <td align="left" width="20%">ID:<br><input type="text" name="id" size="5" value="<?=$id?>" readonly></td>
              <td align="left" width="55%" colspan="3">Title:<br><input type="text" name="title" size="57" value="<?echo htmlentities($title);?>"></td>
              <td align="left" width="25%">
                Type:<br>
                <select name="type">
<?foreach ($task_types as $key => $value):?>
                  <option value="<?=$key?>"<?echo ($key == $type)? " selected" : "";?>><?=$key?>: <?=$value?></option>
<?endforeach;?>
                </select>
              </td>
            </tr> 
            <tr>
              <td align="left" width="20%">
                Duration Code:<br>
                <select name="duration_code">
<?foreach ($duration_codes as $key => $value):?>
                  <option value="<?=$key?>"<?echo ($key == $duration_code)? " selected" : "";?>><?=$key?>: <?=$value?></option>
<?endforeach;?>
                </select>
              </td>
              <td align="left" width="20%">Duration:<br><input type="text" name="duration" size="7" value="<?=$duration?>"></td>
              <td align="left" width="20%">Min Level:<br><input type="text" name="minlevel" size="7" value="<?=$minlevel?>"></td>
              <td align="left" width="20%">Max Level:<br><input type="text" name="maxlevel" size="7" value="<?=$maxlevel?>"></td>
              <td align="left" width="20%">
                Repeatable:<br>
                <select name="repeatable">
                  <option value="0"<?echo ($repeatable == 0) ? " selected" : ""?>>No</option>
                  <option value="1"<?echo ($repeatable == 1) ? " selected" : ""?>>Yes</option>
                </select>
              </td>
            </tr>
            <tr>
              <td align="left" width="20%">Level Spread:<br><input type="text" name="level_spread" size="7" value="<?=$level_spread?>"></td>
              <td align="left" width="20%">Min Players:<br><input type="text" name="min_players" size="7" value="<?=$min_players?>"></td>
              <td align="left" width="20%">Max Players:<br><input type="text" name="max_players" size="7" value="<?=$max_players?>"></td>
              <td align="left" width="20%">&nbsp;</td>
              <td align="left" width="20%">&nbsp;</td>
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
              <td><textarea name="description" rows="7" cols="88"><?echo htmlentities($description);?></textarea></td>
            </tr>
          </table>
        </fieldset><br>
        <fieldset>
          <legend><strong><font size="4">Completion</font></strong></legend>
          <table width="100%" border="0" cellpadding="3" cellspacing="0">
            <tr>
              <td align="left" width="50%" colspan="2">Reward Text:<br><input type="text" name="reward" size="45" value="<?echo htmlentities($reward);?>"></td> 
              <td align="left" width="50%" colspan="2">
                Reward Method:<br>
                <select name="rewardmethod" style="width: 180px;">
<?foreach($rewardmethods as $key=>$value):?>
                  <option value="<?=$key?>"<?echo ($key == $rewardmethod)? " selected" : "";?>><?=$key?>: <?=$value?></option>
<?endforeach;?>
                </select>
              </td>
            </tr>
            <tr>
              <td align="left" width="25%">Reward ID:<br><input type="text" name="rewardid" size="7" value="<?=$rewardid?>"></td>
              <td align="left" width="25%">Reward XP:<br><input type="text" name="xpreward" size="7" value="<?=$xpreward?>"></td>
              <td align="left" width="25%">Reward Cash:<br><input type="text" name="cashreward" size="7" value="<?=$cashreward?>"></td>
              <td align="left" width="25%">Reward Faction:<br><input type="text" name="faction_reward" size="7" value="<?=$faction_reward?>"></td>
            </tr>
            <tr>
              <td align="left" width="25%">Radiant Crystals:<br><input type="text" name="reward_radiant_crystals" size="7" value="<?=$reward_radiant_crystals?>"></td>
              <td align="left" width="25%">Ebon Crystals:<br><input type="text" name="reward_ebon_crystals" size="7" value="<?=$reward_ebon_crystals?>"></td>
              <td align="left" width="25%">Replay Timer:<br><input type="text" name="replay_timer_seconds" size="7" value="<?=$replay_timer_seconds?>"></td>
              <td align="left" width="25%">Request Timer:<br><input type="text" name="request_timer_seconds" size="7" value="<?=$request_timer_seconds?>"></td>
            </tr>
          </table>
          <table width="100%" border="0" cellpadding="3" cellspacing="0">
            <tr>
              <td>
                Completion Emote:<br>
                <textarea name="completion_emote" rows="2" cols="88"><?=$completion_emote?></textarea>
              </td>
            </tr>
          </table>
        </fieldset><br>
        <center>
          <input type="submit" value="Submit Changes">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back()">
        </center>
      </div>
    </div>
  </form>
