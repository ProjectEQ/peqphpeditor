  <div class="edit_form" style="width: 600px">
    <div class="edit_form_header"><strong>Object:</strong> <?echo ($display_name) ? $display_name . " (" . $id . ")" : $id;?></div>
      <div class="edit_form_content">
        <form name="object" method="post" action="index.php?editor=misc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&action=43">
          <input type="hidden" name="objid" value="<?=$id?>">
          <table cellpadding="3" cellspacing="0" width="100%">
            <tr>
              <td><strong>X POS</strong></td>
              <td><strong>Y POS</strong></td>
              <td><strong>Z POS</strong></td>
              <td><strong>Heading</strong></td>
              <td><strong>Object Name</strong></td>
            </tr>
            <tr>
              <td><input type="text" size="7" name="xpos" value="<?=$xpos?>"></td>
              <td><input type="text" size="7" name="ypos" value="<?=$ypos?>"></td>
              <td><input type="text" size="7" name="zpos" value="<?=$zpos?>"></td>
              <td><input type="text" size="7" name="heading" value="<?=$heading?>"></td>
              <td><input type="text" size="23" name="objectname" value="<?=$objectname?>"></td>
            </tr>
            <tr><td colspan="5">&nbsp;</td></tr>
            <tr>
              <td><strong>X Tilt</strong></td>
              <td><strong>Y Tilt</strong></td>
              <td><strong>Size</strong></td>
              <td>&nbsp;</td>
              <td><strong>Display Name</strong></td>
            </tr>
            <tr>
              <td><input type="text" size="7" name="tilt_x" value="<?=$tilt_x?>"></td>
              <td><input type="text" size="7" name="tilt_y" value="<?=$tilt_y?>"></td>
              <td><input type="text" size="7" name="size" value="<?=$size?>"></td>
              <td>&nbsp;</td>
              <td><input type="text" size="23" name="display_name" value="<?=$display_name?>"></td>
            </tr>
            <tr><td colspan="5">&nbsp;</td></tr>
            <tr>
              <td><strong>Item ID</strong></td>
              <td><strong>Charges</strong></td>
              <td><strong>Icon</strong></td>
              <td><strong>Version</strong></td>
              <td><strong>Type</strong></td>
            </tr>
            <tr>
              <td><input type="text" size="7" name="itemid" value="<?=$itemid?>"></td>
              <td><input type="text" size="7" name="charges" value="<?=$charges?>"></td>
              <td><input type="text" size="7" name="icon" value="<?=$icon?>"></td>
              <td><input type="text" size="7" name="version" value="<?=$version?>"></td>
              <td>
                <select class="left" name="type">
<?
foreach($world_containers as $k => $v):
?>
                  <option value="<?=$k?>"<? echo ($k == $type) ? " selected" : ""?>><?=$v?></option>
<?endforeach;?>
                </select>
              </td>
            </tr>
          </table><br/><br/>
          <center>
            <input type="submit" value="Submit Changes">&nbsp;&nbsp;
            <input type="button" value="Cancel" onClick="history.go(-1);">
          </center>
        </form>
      </div>
    </div>
  </div>
