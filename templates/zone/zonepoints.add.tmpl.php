  <div class="edit_form" style="width: 700px;">
    <div class="edit_form_header">Add Zonepoint</div>
    <div class="edit_form_content">
      <form name="zonepoints" method="post" action="index.php?editor=zone&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&action=17">
        <table width="100%" cellpadding="3" cellspacing="3">
          <tr>
            <td>
              <strong>ID:</strong><br>
              <input type="text" size="7" name="id" value="<?=$suggestzpid?>">
            </td>
            <td>
              <strong>Zone:</strong><br>
              <input type="text" size="10" value="<?=$currzone?>" disabled>
            </td>
            <td>
              <strong>Number:</strong><br>
              <input type="text" size="7" name="number" value="<?=$suggestnum?>">
            </td>
            <td>
              <strong>X:</strong><br>
              <input type="text" size="7" name="x" value="0">
            </td>
            <td>
              <strong>Y:</strong><br>
              <input type="text" size="7" name="y" value="0">
            </td>
            <td>
              <strong>Z:</strong><br>
              <input type="text" size="7" name="z" value="0">
            </td>
            <td>
              <strong>Heading:</strong><br>
              <input type="text" size="7" name="heading" value="0">
            </td>
          </tr>
          <tr>
            <td>
              <strong>Tar Instance:</strong><br>
              <input type="text" size="7" name="target_instance" value="0">
            </td>
            <td>
              <strong>Client:</strong><br>
              <input type="text" size="10" name="client_version_mask" value="4294967295">
            </td>
            <td>
              <strong>Target X:</strong><br>
              <input type="text" size="7" name="target_x" value="0">
            </td>
            <td>
              <strong>Target Y:</strong><br>
              <input type="text" size="7" name="target_y" value="0">
            </td>
            <td>
              <strong>Target Z:</strong><br>
              <input type="text" size="7" name="target_z" value="0">
            </td>
            <td>
              <strong>Tar Heading:</strong><br>
              <input type="text" size="7" name="target_heading" value="0">
            </td>
            <td>
              <strong>Version:</strong><br>
              <input type="text" size="7" name="version" value="<?=$suggestver?>">
            </td>
          </tr>
          <tr>
            <td>
              <strong>Target Zone:</strong><br>
              <input type="text" size="7" name="target_zone_id" value="<?=$zid?>">
            </td>
            <td>
              <strong>Min Expansion:</strong><br>
              <input type="text" size="7" name="min_expansion" value="-1">
            </td>
            <td>
              <strong>Max Expansion:</strong><br>
              <input type="text" size="7" name="max_expansion" value="-1">
            </td>
            <td colspan="2">
              <strong>Content Flags:</strong><br>
              <input type="text" size="23" name="content_flags" value="">
            </td>
            <td colspan="2">
              <strong>Content Flags Disabled:</strong><br>
              <input type="text" size="23" name="content_flags_disabled" value="">
            </td>
          </tr>
          <tr>
            <td>
              <strong>Virtual:</strong><br>
              <select name="is_virtual">
                <option value="0" selected>No</option>
                <option value="1">Yes</option>
              </select>
            </td>
            <td>
              <strong>Height:</strong><br>
              <input type="text" size="7" name="height" value="0">
            </td>
            <td>
              <strong>Width:</strong><br>
              <input type="text" size="7" name="width" value="0">
            </td>
            <td colspan="4">&nbsp;</td>
          </tr>
        </table><br><br>
        <center>
          <input type="hidden" name="zone" value="<?=$currzone?>">
          <input type="submit" value="Add Zonepoint">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back();">
        </center>
      </form>
    </div>
  </div>
