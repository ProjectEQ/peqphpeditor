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
              <td align="left" width="20%">Min Level:<br><input type="text" name="minlevel" size="7" value="0"></td>
              <td align="left" width="20%">Max Level:<br><input type="text" name="maxlevel" size="7" value="0"></td>
              <td align="left" width="20%">
                Repeatable:<br>
                <select name="repeatable">
                  <option value="0">No</option>
                  <option value="1" selected>Yes</option>
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
              <td align="left" width="50%" colspan="2">Reward Text:<br><input type="text" name="reward" size="45" value=""></td> 
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
              <td align="left" width="25%">Reward ID:<br><input type="text" name="rewardid" size="7" value="0"></td>
              <td align="left" width="25%">Reward XP:<br><input type="text" name="xpreward" size="7" value="0"></td>
              <td align="left" width="25%">Reward Cash:<br><input type="text" name="cashreward" size="7" value="0"></td>
              <td align="left" width="25%">Reward Faction:<br><input type="text" name="faction_reward" size="7" value="0"></td>
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
