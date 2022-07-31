  <div class="edit_form" style="width: 750px">
    <div class="edit_form_header">Edit Door</div>
    <div class="edit_form_content">
      <form name="door" method="post" action="index.php?editor=misc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&action=37">
        <table width="100%" cellpadding="5" cellspacing="5">
          <tr>
            <td>
              <strong>ID</strong><br>
              <input type="text" size="7" value="<?=$id?>" disabled>
            </td>
            <td>
              <strong>Door ID</strong><br>
              <input type="text" size="7" name="doorid" value="<?=$doorid?>">
            </td>
            <td colspan="2">
              <strong>Name</strong><br>
              <input type="text" size="25" name="name" value="<?=$name?>">
            </td>
            <td>
              <strong>Size</strong><br>
              <input type="text" size="7" name="size" value="<?=$size?>">
            </td>
            <td>
              <strong>Invert State</strong><br>
              <input type="text" size="7" name="invert_state" value="<?=$invert_state?>">
            </td>
            <td>
              <strong>Incline</strong><br>
              <input type="text" size="7" name="incline" value="<?=$incline?>">
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <strong>Zone</strong><br>
              <input type="text" size="25" value="<?=$zone?>" disabled>
            </td>
            <td>
              <strong>Version</strong><br>
              <input type="text" size="7" name="version" value="<?=$version?>">
            </td>
            <td>
              <strong>X</strong><br>
              <input type="text" size="7" name="pos_x" value="<?=$pos_x?>">
            </td>
            <td>
              <strong>Y</strong><br>
              <input type="text" size="7" name="pos_y" value="<?=$pos_y?>">
            </td>
            <td>
              <strong>Z</strong><br>
              <input type="text" size="7" name="pos_z" value="<?=$pos_z?>">
            </td>
            <td>
              <strong>Heading</strong><br>
              <input type="text" size="7" name="heading" value="<?=$heading?>">
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <strong>Dest Zone</strong><br>
              <input type="text" size="25" name="dest_zone" value="<?=$dest_zone?>">
            </td>
            <td>
              <strong>Dest Instance</strong><br>
              <input type="text" size="7" name="dest_instance" value="<?=$dest_instance?>">
            </td>
            <td>
              <strong>Dest X</strong><br>
              <input type="text" size="7" name="dest_x" value="<?=$dest_x?>">
            </td>
            <td>
              <strong>Dest Y</strong><br>
              <input type="text" size="7" name="dest_y" value="<?=$dest_y?>">
            </td>
            <td>
              <strong>Dest Z</strong><br>
              <input type="text" size="7" name="dest_z" value="<?=$dest_z?>">
            </td>
            <td>
              <strong>Dest Heading</strong><br>
              <input type="text" size="7" name="dest_heading" value="<?=$dest_heading?>">
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <strong>Door Param</strong><br>
              <input type="text" size="25" name="door_param" value="<?=$door_param?>">
            </td>
            <td>
              <strong>Trigger Door</strong><br>
              <input type="text" size="7" name="triggerdoor" value="<?=$triggerdoor?>">
            </td>
            <td>
              <strong>Trigger Type</strong><br>
              <input type="text" size="7" name="triggertype" value="<?=$triggertype?>">
            </td>
            <td>
              <strong>Door Is Open</strong><br>
              <input type="text" size="7" name="doorisopen" value="<?=$doorisopen?>">
            </td>
            <td>
              <strong>Guild</strong><br>
              <input type="text" size="7" name="guild" value="<?=$guild?>">
            </td>
            <td>
              <strong>Buffer</strong><br>
              <input type="text" size="7" name="buffer" value="<?=$buffer?>">
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <strong>Client Version Mask</strong><br>
              <input type="text" size="25" name="client_version_mask" value="<?=$client_version_mask?>">
            </td>
            <td>
              <strong>LDoN Door</strong><br>
              <select name="is_ldon_door" style="width:77px;">
                <option value="0"<?echo ($is_ldon_door == 0) ? " selected" : ""?>>No</option>
                <option value="1"<?echo ($is_ldon_door == 1) ? " selected" : ""?>>Yes</option>
              </select>
            </td>
            <td>
              <strong>DZ Switch ID</strong><br>
              <input type="text" size="7" name="dz_switch_id" value="<?=$dz_switch_id?>">
            </td>
            <td>
              <strong>Keyitem</strong><br>
              <input type="text" size="7" name="keyitem" value="<?=$keyitem?>">
            </td>
            <td>
              <strong>No Keyring</strong><br>
              <select name="nokeyring" style="width:77px;">
                <option value="0"<?echo ($nokeyring == 0) ? " selected" : ""?>>No</option>
                <option value="1"<?echo ($nokeyring == 1) ? " selected" : ""?>>Yes</option>
              </select>
            </td>
            <td>
              <strong>Open Type</strong><br>
              <input type="text" size="7" name="opentype" value="<?=$opentype?>">
            </td>
          </tr>
          <tr>
            <td>
              <strong>Lockpick</strong><br>
              <input type="text" size="7" name="lockpick" value="<?=$lockpick?>">
            </td>
            <td>
              <strong>Disable Timer</strong><br>
              <input type="text" size="7" name="disable_timer" value="<?=$disable_timer?>">
            </td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>
              <strong>Min Expansion</strong><br>
              <input type="text" size="7" name="min_expansion" value="<?=$min_expansion?>">
            </td>
            <td>
              <strong>Max Expansion</strong><br>
              <input type="text" size="7" name="max_expansion" value="<?=$max_expansion?>">
            </td>
            <td colspan="2">
              <strong>Content Flags</strong><br>
              <input type="text" size="25" name="content_flags" value="<?=$content_flags?>">
            </td>
            <td colspan="2">
              <strong>Content Flags Disabled</strong><br>
              <input type="text" size="25" name="content_flags_disabled" value="<?=$content_flags_disabled?>">
            </td>
            <td>&nbsp;</td>
          </tr>
        </table><br><br>
        <center>
          <input type="hidden" name="drid" value="<?=$id?>">
          <input type="hidden" name="zone" value="<?=$zone?>">
          <input type="submit" value="Submit Changes">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back();">
        </center>
      </form>
    </div>
  </div>
