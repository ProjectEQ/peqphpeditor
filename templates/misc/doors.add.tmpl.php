  <div class="edit_form" style="width: 750px">
    <div class="edit_form_header">Add Door</div>
    <div class="edit_form_content">
      <form name="door" method="post" action="index.php?editor=misc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&action=40">
        <table width="100%" cellpadding="5" cellspacing="5">
          <tr>
            <td>
              <strong>ID</strong><br>
              <input type="text" size="7" name="drid" value="<?=$suggestdrid?>">
            </td>
            <td>
              <strong>Door ID</strong><br>
              <input type="text" size="7" name="doorid" value="<?=$suggestdoorid?>">
            </td>
            <td colspan="2">
              <strong>Name</strong><br>
              <input type="text" size="25" name="name" value="">
            </td>
            <td>
              <strong>Size</strong><br>
              <input type="text" size="7" name="size" value="100">
            </td>
            <td>
              <strong>Invert State</strong><br>
              <input type="text" size="7" name="invert_state" value="0">
            </td>
            <td>
              <strong>Incline</strong><br>
              <input type="text" size="7" name="incline" value="0">
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <strong>Zone</strong><br>
              <input type="text" size="25" value="<?=$currzone?>" disabled>
            </td>
            <td>
              <strong>Version</strong><br>
              <input type="text" size="7" name="version" value="<?=$suggestver?>">
            </td>
            <td>
              <strong>X</strong><br>
              <input type="text" size="7" name="pos_x" value="0">
            </td>
            <td>
              <strong>Y</strong><br>
              <input type="text" size="7" name="pos_y" value="0">
            </td>
            <td>
              <strong>Z</strong><br>
              <input type="text" size="7" name="pos_z" value="0">
            </td>
            <td>
              <strong>Heading</strong><br>
              <input type="text" size="7" name="heading" value="0">
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <strong>Dest Zone</strong><br>
              <input type="text" size="25" name="dest_zone" value="NONE">
            </td>
            <td>
              <strong>Dest Instance</strong><br>
              <input type="text" size="7" name="dest_instance" value="0">
            </td>
            <td>
              <strong>Dest X</strong><br>
              <input type="text" size="7" name="dest_x" value="0">
            </td>
            <td>
              <strong>Dest Y</strong><br>
              <input type="text" size="7" name="dest_y" value="0">
            </td>
            <td>
              <strong>Dest Z</strong><br>
              <input type="text" size="7" name="dest_z" value="0">
            </td>
            <td>
              <strong>Dest Heading</strong><br>
              <input type="text" size="7" name="dest_heading" value="0">
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <strong>Door Param</strong><br>
              <input type="text" size="25" name="door_param" value="0">
            </td>
            <td>
              <strong>Trigger Door</strong><br>
              <input type="text" size="7" name="triggerdoor" value="0">
            </td>
            <td>
              <strong>Trigger Type</strong><br>
              <input type="text" size="7" name="triggertype" value="0">
            </td>
            <td>
              <strong>Door Is Open</strong><br>
              <input type="text" size="7" name="doorisopen" value="0">
            </td>
            <td>
              <strong>Guild</strong><br>
              <input type="text" size="7" name="guild" value="0">
            </td>
            <td>
              <strong>Buffer</strong><br>
              <input type="text" size="7" name="buffer" value="0">
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <strong>Client Version Mask</strong><br>
              <input type="text" size="25" name="client_version_mask" value="4294967295">
            </td>
            <td>
              <strong>LDoN Door</strong><br>
              <select name="is_ldon_door" style="width:77px;">
                <option value="0" selected>No</option>
                <option value="1">Yes</option>
              </select>
            </td>
            <td>
              <strong>DZ Switch ID</strong><br>
              <input type="text" size="7" name="dz_switch_id" value="0">
            </td>
            <td>
              <strong>Keyitem</strong><br>
              <input type="text" size="7" name="keyitem" value="0">
            </td>
            <td>
              <strong>No Keyring</strong><br>
              <select name="nokeyring" style="width:77px;">
                <option value="0" selected>No</option>
                <option value="1">Yes</option>
              </select>
            </td>
            <td>
              <strong>Open Type</strong><br>
              <input type="text" size="7" name="opentype" value="0">
            </td>
          </tr>
          <tr>
            <td>
              <strong>Lockpick</strong><br>
              <input type="text" size="7" name="lockpick" value="0">
            </td>
            <td>
              <strong>Disable Timer</strong><br>
              <input type="text" size="7" name="disable_timer" value="0">
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
              <input type="text" size="7" name="min_expansion" value="-1">
            </td>
            <td>
              <strong>Max Expansion</strong><br>
              <input type="text" size="7" name="max_expansion" value="-1">
            </td>
            <td colspan="2">
              <strong>Content Flags</strong><br>
              <input type="text" size="25" name="content_flags" value="">
            </td>
            <td colspan="2">
              <strong>Content Flags Disabled</strong><br>
              <input type="text" size="25" name="content_flags_disabled" value="">
            </td>
            <td>&nbsp;</td>
          </tr>
        </table><br><br>
        <center>
          <input type="submit" value="Add Door">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back();">
        </center>
      </form>
    </div>
  </div>
