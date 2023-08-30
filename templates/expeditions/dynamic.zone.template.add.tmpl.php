  <div class="table_container" style="width: 700px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td>Create Template</td>
        </tr>
      </table>
    </div>
    <div class="table_content">
      <form name="add_dynamic_zone_template" method="post" action="index.php?editor=expeditions&action=33">
        <table width="100%" cellpadding="5" cellspacing="5">
          <tr>
            <td width="25%">
              <strong>ID:</strong><br>
              <input type="text" name="id" size="10" value="<?=$suggest_id?>">
            </td>
            <td width="25%">
              <strong>Zone:</strong><br>
              <select name="zone_id">
<?
foreach ($zoneids as $k=>$v) {
?>
                <option value="<?=$k?>"><?=$v?> (<?=$k?>)</option>
<?
}
?>
              </select>
            </td>
            <td width="25%">
              <strong>Version:</strong><br>
              <input type="text" name="zone_version" size="10" value="0">
            </td>
            <td width="25%">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="3">
              <strong>Name:</strong><br>
              <input type="text" name="name" size="77" value="">
            </td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>
              <strong>Min Players:</strong><br>
              <input type="text" name="min_players" size="10" value="0">
            </td>
            <td>
              <strong>Max Players:</strong><br>
              <input type="text" name="max_players" size="10" value="0">
            </td>
            <td width="25%">
              <strong>Duration:</strong><br>
              <input type="text" name="duration_seconds" size="10" value="0">
            </td>
            <td>
              <strong>DZ Switch ID:</strong><br>
              <input type="text" name="dz_switch_id" size="10" value="0">
            </td>
          </tr>
          <tr>
            <td colspan="4">
              <fieldset>
                <legend><strong>Compass</strong></legend>
                <table width="100%" cellpadding="3" cellspacing="3">
                  <tr>
                    <td width="32%">
                      <strong>Zone:</strong><br>
                      <select name="compass_zone_id">
<?
foreach ($zoneids as $k=>$v) {
?>
                        <option value="<?=$k?>"><?=$v?> (<?=$k?>)</option>
<?
}
?>
                      </select>
                    </td>
                    <td width="17%">
                      <strong>X:</strong><br>
                      <input type="text" name="compass_x" size="10" value="0">
                    </td>
                    <td width="17%">
                      <strong>Y:</strong><br>
                      <input type="text" name="compass_y" size="10" value="0">
                    </td>
                    <td width="17%">
                      <strong>Z:</strong><br>
                      <input type="text" name="compass_z" size="10" value="0">
                    </td>
                    <td width="17%">&nbsp;</td>
                  </tr>
                </table>
              </fieldset>
            </td>
          </tr>
          <tr>
            <td colspan="4">
              <fieldset>
                <legend><strong>Return Zone</strong></legend>
                <table width="100%" cellpadding="3" cellspacing="3">
                  <tr>
                    <td width="32%">
                      <strong>Zone:</strong><br>
                      <select name="return_zone_id">
<?
foreach ($zoneids as $k=>$v) {
?>
                        <option value="<?=$k?>"><?=$v?> (<?=$k?>)</option>
<?
}
?>
                      </select>
                    </td>
                    <td width="17%">
                      <strong>X:</strong><br>
                      <input type="text" name="return_x" size="10" value="0">
                    </td>
                    <td width="17%">
                      <strong>Y:</strong><br>
                      <input type="text" name="return_y" size="10" value="0">
                    </td>
                    <td width="17%">
                      <strong>Z:</strong><br>
                      <input type="text" name="return_z" size="10" value="0">
                    </td>
                    <td width="17%">
                      <strong>Heading:</strong><br>
                      <input type="text" name="return_h" size="10" value="0">
                    </td>
                  </tr>
                </table>
              </fieldset>
            </td>
          </tr>
          <tr>
            <td colspan="4">
              <fieldset>
                <legend><strong>Zone In</strong></legend>
                <table width="100%" cellpadding="3" cellspacing="3">
                  <tr>
                    <td width="32%">
                      <strong>Override:</strong><br>
                      <input type="text" name="override_zone_in" size="10" value="0">
                    </td>
                    <td width="17%">
                      <strong>X:</strong><br>
                      <input type="text" name="zone_in_x" size="10" value="0">
                    </td>
                    <td width="17%">
                      <strong>Y:</strong><br>
                      <input type="text" name="zone_in_y" size="10" value="0">
                    </td>
                    <td width="17%">
                      <strong>Z:</strong><br>
                      <input type="text" name="zone_in_z" size="10" value="0">
                    </td>
                    <td width="17%">
                      <strong>Heading:</strong><br>
                      <input type="text" name="zone_in_h" size="10" value="0">
                    </td>
                  </tr>
                </table>
              </fieldset>
            </td>
          </tr>
        </table><br>
        <center>
          <input type="submit" value="Add Template">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back()">
        </center>
      </form>
    </div>
  </div>
