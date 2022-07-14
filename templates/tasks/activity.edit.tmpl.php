  <form name="activity_edit" method="post" action="index.php?editor=tasks&action=7">
    <div class="edit_form">
      <div class="edit_form_header">Activity for Task: <?=$taskid?></div>
      <div class="edit_form_content">
        <fieldset>
          <legend><strong><font size="4">General</font></strong></legend>
          <table width="100%" border="0" cellpadding="3" cellspacing="0">
            <tr>
              <td align="left" width="20%">ID:<br><input type="text" name="newactivityid" size="5" value="<?=$activityid?>"></td>
              <td align="left" width="20%">Step:<br><input type="text" name="step" size="5" value="<?=$step?>"></td>
              <td align="left" width="20%">
                Optional:<br>
                <select name="optional">
                  <option value="0"<?echo ($optional == 0) ? " selected" : ""?>>No</option>
                  <option value="1"<?echo ($optional == 1) ? " selected" : ""?>>Yes</option>
                </select>
              </td>
              <td align="left" width="40%">
                Type:<br>
                <select name="activitytype" style="width: 180px;">
<?foreach($activitytypes as $key=>$value):?>
                  <option value="<?=$key?>"<?echo ($key == $activitytype)? " selected" : "";?>><?=$key?>: <?=$value?></option>
<?endforeach;?>
                </select>
              </td>
            </tr> 
          </table>
        </fieldset><br>
        <fieldset>
          <legend><strong><font size="4">Text</font></strong></legend>
          <table width="100%" border="0" cellpadding="3" cellspacing="0">
            <tr>
              <td align="left" width="33%">Target Name:<br><input type="text" name="target_name" size="30" value="<?echo htmlentities($target_name);?>"></td>
              <td align="left" width="33%">Item List:<br><input type="text" name="item_list" size="30" value="<?echo htmlentities($item_list);?>"></td>
              <td align="left" width="34%">Description Override:<br><input type="text" name="description_override" size="30" value="<?echo htmlentities($description_override);?>"></td>           
            </tr>
            <tr>
              <td align="left" width="33%">Skill List: (IDs separated by semi-colon)<br><input type="text" name="skill_list" size="30" value="<?echo htmlentities($skill_list);?>"></td>
              <td align="left" width="33%">Spell List: (IDs separated by semi-colon)<br><input type="text" name="spell_list" size="30" value="<?echo htmlentities($spell_list);?>"></td>
              <td align="left" width="34%">Zones: (IDs separated by semi-colon)<br><input type="text" name="zones" size="30" value="<?echo htmlentities($zones);?>"></td>           
            </tr>
            <tr>
              <td align="left" width="100%" colspan="3">Zone Version:<br><input type="text" name="zone_version" size="10" value="<?=$zone_version?>"></td>
            </tr>
          </table>
        </fieldset><br>
        <fieldset>
          <legend><strong><font size="4">Goal</font></strong></legend>
          <table width="100%" border="0" cellpadding="3" cellspacing="0">
            <tr>
              <td align="left" width="25%">Goal ID:<br><input type="text" name="goalid" size="7" value="<?=$goalid?>"></td>
              <td align="left" width="25%">
                Goal Method:<br>
                <select name="goalmethod" style="width: 100px;">
<?foreach($rewardmethods as $key=>$value):?>
                  <option value="<?=$key?>"<?echo ($key == $goalmethod)? " selected" : "";?>><?=$key?>: <?=$value?></option>
<?endforeach;?>
                </select>
              </td>
              <td align="left" width="25%">Goal Count:<br><input type="text" name="goalcount" size="7" value="<?=$goalcount?>"></td>
              <td align="left" width="25%">Deliver to NPC:<br><input type="text" name="delivertonpc" size="7" value="<?=$delivertonpc?>"></td>
            </tr>
            <tr>
              <td colspan="4" width="100%">Goal Match List:<br><textarea name="goal_match_list" rows="10" cols="100"><?=$goal_match_list?></textarea></td>
            </tr>
          </table>
        </fieldset><br>
        <center>
          <input type="hidden" name="taskid" value="<?=$taskid?>">
          <input type="hidden" name="activityid" value="<?=$activityid?>">
          <input type="submit" value="Submit Changes">
          <input type="button" value="Cancel" onClick="history.back()">
        </center>
      </div>
    </div>
  </form>
