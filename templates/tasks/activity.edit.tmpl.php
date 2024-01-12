  <form name="activity_edit" method="post" action="index.php?editor=tasks&action=7">
    <div class="edit_form">
      <div class="edit_form_header">Activity for Task: <?=$taskid?></div>
      <div class="edit_form_content">
        <fieldset>
          <legend><strong><font size="4">General</font></strong></legend>
          <table width="100%" border="0" cellpadding="3" cellspacing="0">
            <tr>
              <td align="left" width="18%">ID:<br><input type="text" name="newactivityid" size="5" value="<?=$activityid?>"></td>
              <td align="left" width="18%">Req ID:<br><input type="text" name="req_activity_id" size="5" value="<?=$req_activity_id?>"></td>
              <td align="left" width="18%">Step:<br><input type="text" name="step" size="5" value="<?=$step?>"></td>
              <td align="left" width="16%">
                Optional:<br>
                <select name="optional">
                  <option value="0"<?echo ($optional == 0) ? " selected" : ""?>>No</option>
                  <option value="1"<?echo ($optional == 1) ? " selected" : ""?>>Yes</option>
                </select>
              </td>
              <td align="left" width="30%">
                Type:<br>
                <select name="activitytype" style="width: 180px;">
<?foreach($activitytypes as $key=>$value):?>
                  <option value="<?=$key?>"<?echo ($key == $activitytype)? " selected" : "";?>><?=$key?>: <?=$value?></option>
<?endforeach;?>
                </select>
              </td>
            </tr>
            <tr>
              <td align="left" width="18%">List Group:<br><input type="text" name="list_group" size="5" value="<?=$list_group?>"></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
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
              <td align="left" width="33%">Zone Version:<br><input type="text" name="zone_version" size="10" value="<?=$zone_version?>"></td>
              <td align="left" width="33%">DZ Switch ID:<br><input type="text" name="dz_switch_id" size="10" value="<?=$dz_switch_id?>"></td>
              <td align="left" width="34%">&nbsp;</td>
            </tr>
          </table>
        </fieldset><br>
        <fieldset>
          <legend><strong><font size="4">Goal</font></strong></legend>
          <table width="100%" border="0" cellpadding="3" cellspacing="0">
            <tr>
              <td align="left" width="25%">
                Goal Method:<br>
                <select name="goalmethod" style="width: 100px;">
<?foreach($rewardmethods as $key=>$value):?>
                  <option value="<?=$key?>"<?echo ($key == $goalmethod)? " selected" : "";?>><?=$key?>: <?=$value?></option>
<?endforeach;?>
                </select>
              </td>
              <td align="left" width="75%">NPC Match List:<br><input type="text" name="npc_match_list" size="80" value="<?echo (isset($npc_match_list)) ? htmlentities($npc_match_list) : "";?>"></td>
            </tr>
            <tr>
              <td align="left" width="25%">Goal Count:<br><input type="text" name="goalcount" size="7" value="<?=$goalcount?>"></td>
              <td align="left" width="75%">Item ID List:<br><input type="text" name="item_id_list" size="80" value="<?echo (isset($item_id_list)) ? htmlentities($item_id_list) : "";?>"></td>
            </tr>
          </table>
        </fieldset><br>
        <fieldset>
          <legend><strong><font size="4">Proximities</font></strong></legend>
          <table width="100%" border="0" cellpadding="3" cellspacing="0">
            <tr>
              <td align="left" width="33%">Min X:<br><input type="text" name="min_x" size="10" value="<?=$min_x?>"></td>
              <td align="left" width="33%">Min Y:<br><input type="text" name="min_y" size="10" value="<?=$min_y?>"></td>
              <td align="left" width="34%">Min Z:<br><input type="text" name="min_z" size="10" value="<?=$min_z?>"></td>
            </tr>
            <tr>
              <td align="left" width="33%">Max X:<br><input type="text" name="max_x" size="10" value="<?=$max_x?>"></td>
              <td align="left" width="33%">Max Y:<br><input type="text" name="max_y" size="10" value="<?=$max_y?>"></td>
              <td align="left" width="34%">Max Z:<br><input type="text" name="max_z" size="10" value="<?=$max_z?>"></td>
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
