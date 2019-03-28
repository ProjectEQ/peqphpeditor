  <div class="edit_form" style="width: 600px">
    <div class="edit_form_header">Add Object</div>
      <div class="edit_form_content">
        <form name="object" method="post" action="index.php?editor=misc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&action=46">
          <table cellpadding="3" cellspacing="0" width="100%">
            <tr>
              <td><strong>ID</strong></td>
              <td><strong>X POS</strong></td>
              <td><strong>Y POS</strong></td>
              <td><strong>Z POS</strong></td>
              <td><strong>Object Name</strong></td>
            </tr>
            <tr>
              <td><input type="text" size="7" name="objid" value="<?=$suggestobjid?>"></td>
              <td><input type="text" size="7" name="xpos" value="0"></td>
              <td><input type="text" size="7" name="ypos" value="0"></td>
              <td><input type="text" size="7" name="zpos" value="0"></td>
              <td><input type="text" size="23" name="objectname" value="ITxxxxx_ACTORDEF"></td>
            </tr>
            <tr><td colspan="5">&nbsp;</td></tr>
            <tr>
              <td><strong>Size</strong></td>
              <td><strong>X Tilt</strong></td>
              <td><strong>Y Tilt</strong></td>
              <td><strong>Heading</strong></td>
              <td><strong>Display Name</strong></td>
            </tr>
            <tr>
              <td><input type="text" size="7" name="size" value="100"></td>
              <td><input type="text" size="7" name="tilt_x" value="0"></td>
              <td><input type="text" size="7" name="tilt_y" value="0"></td>
              <td><input type="text" size="7" name="heading" value="0"></td>
              <td><input type="text" size="23" name="display_name" value=""></td>
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
              <td><input type="text" size="7" name="itemid" value="0"></td>
              <td><input type="text" size="7" name="charges" value="0"></td>
              <td><input type="text" size="7" name="icon" value="0"></td>
              <td><input type="text" size="7" name="version" value="<?=$suggestver?>"></td>
              <td>
                <select class="left" name="type">
<?foreach($world_containers as $k => $v):?>
                  <option value="<?=$k?>"><?=$v?></option>
<?endforeach;?>
                </select>
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
