  <div class="edit_form" style="width: 650px">
    <div class="edit_form_header">Edit Object</div>
      <div class="edit_form_content">
        <form name="object" method="post" action="index.php?editor=misc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&action=43">
          <table cellpadding="3" cellspacing="3" width="100%">
            <tr>
              <td>
                <strong>ID</strong><br>
                <input type="text" size="7" value="<?=$id?>" disabled>
              </td>
              <td>
                <strong>Zone ID</strong><br>
                <input type="text" size="7" value="<?=$zoneid?>" disabled>
              </td>
              <td>
                <strong>Version</strong><br>
                <input type="text" size="7" name="version" value="<?=$version?>">
              </td>
              <td>
                <strong>Item ID</strong><br>
                <input type="text" size="7" name="itemid" value="<?=$itemid?>">
              </td>
              <td>
                <strong>Object Name</strong><br>
                <input type="text" size="25" name="objectname" value="<?=$objectname?>">
              </td>
            </tr>
            <tr>
              <td>
                <strong>X POS</strong><br>
                <input type="text" size="7" name="xpos" value="<?=$xpos?>">
              </td>
              <td>
                <strong>Y POS</strong><br>
                <input type="text" size="7" name="ypos" value="<?=$ypos?>">
              </td>
              <td>
                <strong>Z POS</strong><br>
                <input type="text" size="7" name="zpos" value="<?=$zpos?>">
              </td>
              <td>
                <strong>Heading</strong><br>
                <input type="text" size="7" name="heading" value="<?=$heading?>">
              </td>
              <td colspan="2">
                <strong>Display Name</strong><br>
                <input type="text" size="25" name="display_name" value="<?=$display_name?>">
              </td>
            </tr>
            <tr>
              <td>
                <strong>X Tilt</strong><br>
                <input type="text" size="7" name="tilt_x" value="<?=$tilt_x?>">
              </td>
              <td>
                <strong>Y Tilt</strong><br>
                <input type="text" size="7" name="tilt_y" value="<?=$tilt_y?>">
              </td>
              <td>
                <strong>Size</strong><br>
                <input type="text" size="7" name="size" value="<?=$size?>">
              </td>
              <td>
                <strong>Size Percentage</strong><br>
                <input type="text" size="7" name="size" value="<?=$size_percentage?>">
              </td>
              <td colspan="2">
                <strong>Type</strong><br>
                <select class="left" name="type">
<?foreach($world_containers as $k => $v):?>
                  <option value="<?=$k?>"<?echo ($type == $k) ? " selected" : "";?>><?=$v?></option>
<?endforeach;?>
                </select>
              </td>
            </tr>
            <tr>
              <td>
                <strong>Charges</strong><br>
                <input type="text" size="7" name="charges" value="<?=$charges?>">
              </td>
              <td>
                <strong>Icon</strong><br>
                <input type="text" size="7" name="icon" value="<?=$icon?>">
              </td>
              <td>
                <strong>Solid Type</strong><br>
                <input type="text" size="7" name="solid_type" value="<?=$solid_type?>">
              </td>
              <td>
                <strong>Incline</strong><br>
                <input type="text" size="7" name="incline" value="<?=$incline?>">
              </td>
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
            </tr>
          </table><br><br>
          <center>
            <input type="hidden" name="id" value="<?=$id?>">
            <input type="hidden" name="zoneid" value="<?=$zoneid?>">
            <input type="submit" value="Update Object">&nbsp;&nbsp;
            <input type="button" value="Cancel" onClick="history.back();">
          </center>
        </form>
      </div>
    </div>
  </div>
