  <form name="activity_add" method="post" action="index.php?editor=tasks&action=10">
    <div class="edit_form">
      <div class="edit_form_header">Add Activity to Task <?=$tskid?></div>
      <div class="edit_form_content">
        <fieldset>
          <legend><strong><font size="4">General</font></strong></legend>
          <table width="100%" border="0" cellpadding="3" cellspacing="0">
            <tr>
<?if($suggeststep > 1):?>
              <td align="left" width="20%">ID:<br><input type="text" name="activityid" size="5" value="<?=$suggestid?>"></td>
<?endif;?> 
<?if($suggestid == 1 && $suggeststep == 1):?>
              <td align="left" width="20%">ID:<br><input type="text" name="activityid" size="5" value="0"></td>
<?endif;?> 
              <td align="left" width="20%">Step:<br><input type="text" name="step" size="5" value="<?=$suggeststep?>"></td>
              <td align="left" width="20%">
                Optional:<br>
                <select name="optional">
                  <option value="0">No</option>
                  <option value="1">Yes</option>
                </select>
              </td>
              <td align="left" width="40%">Type:<br>
                <select name="activitytype" style="width: 180px;">
<?foreach($activitytypes as $key=>$value):?>
                  <option value="<?=$key?>"><?=$key?>: <?=$value?></option>
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
              <td align="left" width="33%">Target Name:<br><input type="text" name="target_name" size="30" value=""></td>
              <td align="left" width="33%">Item List:<br><input type="text" name="item_list" size="30" value=""></td>
              <td align="left" width="34%">Description Override:<br><input type="text" name="description_override" size="30" value=""></td>           
            </tr>
            <tr>
              <td align="left" width="33%">Skill List: (IDs separated by semi-colon)<br><input type="text" name="skill_list" size="30" value="-1"></td>
              <td align="left" width="33%">Spell List: (IDs separated by semi-colon)<br><input type="text" name="spell_list" size="30" value="0"></td>
              <td align="left" width="34%">Zones: (IDs separated by semi-colon)<br><input type="text" name="zones" size="30" value=""></td>           
            </tr>
          </table>
        </fieldset><br>
        <fieldset>
          <legend><strong><font size="4">Goal</font></strong></legend>
          <table width="100%" border="0" cellpadding="3" cellspacing="0">
            <tr>
              <td align="left" width="20%">Goal ID:<br><input type="text" name="goalid" size="7" value="0"></td>
              <td align="left" width="20%">
                Goal Method:<br>
                <select name="goalmethod" style="width: 100px;">
<?foreach($rewardmethods as $key=>$value):?>
                  <option value="<?=$key?>"><?=$key?>: <?=$value?></option>
<?endforeach;?>
                </select>
              </td>
              <td align="left" width="20%">Goal Count:<br><input type="text" name="goalcount" size="7" value="0"></td>
              <td align="left" width="20%">Deliver to NPC:<br><input type="text" name="delivertonpc" size="7" value="0"></td>
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
