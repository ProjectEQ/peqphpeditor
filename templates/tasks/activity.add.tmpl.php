  <form name="activity_add" method="post" action="index.php?editor=tasks&action=10">
    <div class="edit_form">
      <div class="edit_form_header">Add Activity to Task <?=$tskid?></div>
      <div class="edit_form_content">
        <fieldset>
          <legend><strong><font size="4">General</font></strong></legend>
          <table width="100%" border="0" cellpadding="3" cellspacing="0">
            <tr>
              <td align="left" width="18%">ID:<br><input type="text" name="activityid" size="5" value="<?=$suggestid?>"></td>
              <td align="left" width="18%">Req ID:<br><input type="text" name="req_activity_id" size="5" value="-1"></td>
              <td align="left" width="18%">Step:<br><input type="text" name="step" size="5" value="<?=$suggeststep?>"></td>
              <td align="left" width="16%">
                Optional:<br>
                <select name="optional">
                  <option value="0">No</option>
                  <option value="1">Yes</option>
                </select>
              </td>
              <td align="left" width="30%">
                Type:<br>
                <select name="activitytype" style="width: 180px;">
<?foreach($activitytypes as $key=>$value):?>
                  <option value="<?=$key?>"><?=$key?>: <?=$value?></option>
<?endforeach;?>
                </select>
              </td>
            </tr>
            <tr>
              <td align="left" width="18%">List Group:<br><input type="text" name="list_group" size="5" value="0"></td>
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
              <td align="left" width="33%">Target Name:<br><input type="text" name="target_name" size="30" value=""></td>
              <td align="left" width="33%">Item List:<br><input type="text" name="item_list" size="30" value=""></td>
              <td align="left" width="34%">Description Override:<br><input type="text" name="description_override" size="30" value=""></td>           
            </tr>
            <tr>
              <td align="left" width="33%">Skill List: (IDs separated by semi-colon)<br><input type="text" name="skill_list" size="30" value="-1"></td>
              <td align="left" width="33%">Spell List: (IDs separated by semi-colon)<br><input type="text" name="spell_list" size="30" value="0"></td>
              <td align="left" width="34%">Zones: (IDs separated by semi-colon)<br><input type="text" name="zones" size="30" value=""></td>           
            </tr>
            <tr>
              <td align="left" width="33%">Zone Version:<br><input type="text" name="zone_version" size="10" value="-1"></td>
              <td align="left" width="33%">DZ Switch ID:<br><input type="text" name="dz_switch_id" size="10" value="0"></td>
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
                  <option value="<?=$key?>"><?=$key?>: <?=$value?></option>
<?endforeach;?>
                </select>
              </td>
              <td align="left" width="75%">NPC Match List:<br><input type="text" name="npc_match_list" size="80" value=""></td>
            </tr>
            <tr>
              <td align="left" width="25%">Goal Count:<br><input type="text" name="goalcount" size="7" value="0"></td>
              <td align="left" width="75%">Item ID List:<br><input type="text" name="item_id_list" size="80" value=""></td>
            </tr>
          </table>
        </fieldset><br>
        <fieldset>
          <legend><strong><font size="4">Proximities</font></strong></legend>
          <table width="100%" border="0" cellpadding="3" cellspacing="0">
            <tr>
              <td align="left" width="33%">Min X:<br><input type="text" name="min_x" size="10" value="0"></td>
              <td align="left" width="33%">Min Y:<br><input type="text" name="min_y" size="10" value="0"></td>
              <td align="left" width="34%">Min Z:<br><input type="text" name="min_z" size="10" value="0"></td>
            </tr>
            <tr>
              <td align="left" width="33%">Max X:<br><input type="text" name="max_x" size="10" value="0"></td>
              <td align="left" width="33%">Max Y:<br><input type="text" name="max_y" size="10" value="0"></td>
              <td align="left" width="34%">Max Z:<br><input type="text" name="max_z" size="10" value="0"></td>
            </tr>
          </table>
        </fieldset><br>
        <center>
          <input type="hidden" name="taskid" value="<?=$tskid?>">
          <input type="submit" value="Add Activity">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back();">
        </center>
      </div>
    </div>
  </form>
