  <div class="edit_form" style="width: 700px;">
    <div class="edit_form_header">Edit Zonepoint</div>
    <div class="edit_form_content">
      <form name="zonepoints" method="post" action="index.php?editor=zone&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&zpid=<?=$id?>&action=14">
        <table width="100%" cellpadding="3" cellspacing="3">
          <tr>
            <td>
              <strong>ID:</strong><br>
              <input type="text" size="7" value="<?=$id?>" disabled>
            </td>
            <td>
              <strong>Zone:</strong><br>
              <input type="text" size="10" value="<?=$zone?>" disabled>
            </td>
            <td>
              <strong>Number:</strong><br>
              <input type="text" size="7" name="number" value="<?=$number?>">
            </td>
            <td>
              <strong>X:</strong><br>
              <input type="text" size="7" name="x" value="<?=$x?>">
            </td>
            <td>
              <strong>Y:</strong><br>
              <input type="text" size="7" name="y" value="<?=$y?>">
            </td>
            <td>
              <strong>Z:</strong><br>
              <input type="text" size="7" name="z" value="<?=$z?>">
            </td>
            <td>
              <strong>Heading:</strong><br>
              <input type="text" size="7" name="heading" value="<?=$heading?>">
            </td>
          </tr>
          <tr>
            <td>
              <strong>Tar Instance:</strong><br>
              <input type="text" size="7" name="target_instance" value="<?=$target_instance?>">
            </td>
            <td>
              <strong>Client:</strong><br>
              <input type="text" size="10" name="client_version_mask" value="<?=$client_version_mask?>">
            </td>
            <td>
              <strong>Target X:</strong><br>
              <input type="text" size="7" name="target_x" value="<?=$target_x?>">
            </td>
            <td>
              <strong>Target Y:</strong><br>
              <input type="text" size="7" name="target_y" value="<?=$target_y?>">
            </td>
            <td>
              <strong>Target Z:</strong><br>
              <input type="text" size="7" name="target_z" value="<?=$target_z?>">
            </td>
            <td>
              <strong>Tar Heading:</strong><br>
              <input type="text" size="7" name="target_heading" value="<?=$target_heading?>">
            </td>
            <td>
              <strong>Version:</strong><br>
              <input type="text" size="7" name="version" value="<?=$version?>">
            </td>
          </tr>
          <tr>
            <td>
              <strong>Target Zone:</strong><br>
              <input type="text" size="7" name="target_zone_id" value="<?=$target_zone_id?>">
            </td>
            <td>
              <strong>Min Expansion:</strong><br>
              <input type="text" size="7" name="min_expansion" value="<?=$min_expansion?>">
            </td>
            <td>
              <strong>Max Expansion:</strong><br>
              <input type="text" size="7" name="max_expansion" value="<?=$max_expansion?>">
            </td>
            <td colspan="2">
              <strong>Content Flags:</strong><br>
              <input type="text" size="23" name="content_flags" value="<?=$content_flags?>">
            </td>
            <td colspan="2">
              <strong>Content Flags Disabled:</strong><br>
              <input type="text" size="23" name="content_flags_disabled" value="<?=$content_flags_disabled?>">
            </td>
          </tr>
          <tr>
            <td>
              <strong>Virtual:</strong><br>
              <select name="is_virtual">
                <option value="0"<?echo ($is_virtual == 0) ? " selected" : "";?>>No</option>
                <option value="1"<?echo ($is_virtual == 1) ? " selected" : "";?>>Yes</option>
              </select>
            </td>
            <td>
              <strong>Height:</strong><br>
              <input type="text" size="7" name="height" value="<?=$height?>">
            </td>
            <td>
              <strong>Width:</strong><br>
              <input type="text" size="7" name="width" value="<?=$width?>">
            </td>
            <td colspan="4">&nbsp;</td>
          </tr>
        </table><br><br>
        <center>
          <input type="hidden" name="id" value="<?=$id?>">
          <input type="hidden" name="zone" value="<?=$zone?>">
          <input type="submit" value="Update Zonepoint">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back();">
        </center>
      </form>
    </div>
  </div>
