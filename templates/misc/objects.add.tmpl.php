  <div class="edit_form" style="width: 650px">
    <div class="edit_form_header">Add Object</div>
      <div class="edit_form_content">
        <form name="object" method="post" action="index.php?editor=misc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&action=46">
          <table cellpadding="3" cellspacing="3" width="100%">
            <tr>
              <td>
                <strong>ID</strong><br>
                <input type="text" size="7" name="objid" value="<?=$suggestobjid?>">
              </td>
              <td>
                <strong>Zone ID</strong><br>
                <input type="text" size="7" name="zoneid" value="<?=$currzoneid?>">
              </td>
              <td>
                <strong>Version</strong><br>
                <input type="text" size="7" name="version" value="<?=$suggestver?>">
              </td>
              <td>
                <strong>Item ID</strong><br>
                <input type="text" size="7" name="itemid" value="0">
              </td>
              <td>
                <strong>Object Name</strong><br>
                <input type="text" size="25" name="objectname" value="ITxxxxx_ACTORDEF">
              </td>
            </tr>
            <tr>
              <td>
                <strong>X POS</strong><br>
                <input type="text" size="7" name="xpos" value="0">
              </td>
              <td>
                <strong>Y POS</strong><br>
                <input type="text" size="7" name="ypos" value="0">
              </td>
              <td>
                <strong>Z POS</strong><br>
                <input type="text" size="7" name="zpos" value="0">
              </td>
              <td>
                <strong>Heading</strong><br>
                <input type="text" size="7" name="heading" value="0">
              </td>
              <td colspan="2">
                <strong>Display Name</strong><br>
                <input type="text" size="25" name="display_name" value="">
              </td>
            </tr>
            <tr>
              <td>
                <strong>X Tilt</strong><br>
                <input type="text" size="7" name="tilt_x" value="0">
              </td>
              <td>
                <strong>Y Tilt</strong><br>
                <input type="text" size="7" name="tilt_y" value="0">
              </td>
              <td>
                <strong>Size</strong><br>
                <input type="text" size="7" name="size" value="100">
              </td>
              <td>
                <strong>Size Percentage</strong><br>
                <input type="text" size="7" name="size_percentage" value="0">
              </td>
              <td colspan="2">
                <strong>Type</strong><br>
                <select class="left" name="type">
<?foreach($world_containers as $k => $v):?>
                  <option value="<?=$k?>"><?=$v?></option>
<?endforeach;?>
                </select>
              </td>
            </tr>
            <tr>
              <td>
                <strong>Charges</strong><br>
                <input type="text" size="7" name="charges" value="0">
              </td>
              <td>
                <strong>Icon</strong><br>
                <input type="text" size="7" name="icon" value="0">
              </td>
              <td>
                <strong>Solid Type</strong><br>
                <input type="text" size="7" name="solid_type" value="0">
              </td>
              <td>
                <strong>Incline</strong><br>
                <input type="text" size="7" name="incline" value="0">
              </td>
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
            </tr>
          </table><br><br>
          <center>
            <input type="submit" value="Add Object">&nbsp;&nbsp;
            <input type="button" value="Cancel" onClick="history.back();">
          </center>
        </form>
      </div>
    </div>
  </div>
