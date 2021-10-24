  <div class="table_container" style="width: 650px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td>Create Dynamic Zone</td>
        </tr>
      </table>
    </div>
    <div class="table_content">
      <form name="add_dynamic_zone" method="post" action="index.php?editor=expeditions&action=15">
        <table width="100%" cellpadding="5" cellspacing="5">
          <tr>
            <td width="25%">
              <strong>ID:</strong><br>
              <input type="text" name="id" size="10" value="<?=$suggest_id?>">
            </td>
            <td width="25%">
              <strong>Instance:</strong><br>
              <input type="text" name="instance_id" size="10" value="0">
            </td>
            <td width="25%">
              <strong>Type:</strong><br>
              <select name="type">
<?
foreach ($dynamic_zone_type as $k=>$v) {
?>
                <option value="<?=$k?>"><?=$v?> (<?=$k?>)</option>
<?
}
?>
            </td>
            <td width="25%">
              <strong>Leader ID:</strong><br>
              <input type="text" name="leader_id" size="10" value="0">
            </td>
          </tr>
          <tr>
            <td colspan="3">
              <strong>UUID:</strong><br>
              <input type="text" name="uuid" size="77" value="">
            </td>
            <td>
              <strong>Min Players:</strong><br>
              <input type="text" name="min_players" size="10" value="0">
            </td>
          </tr>
          <tr>
            <td colspan="3">
              <strong>Name:</strong><br>
              <input type="text" name="name" size="77" value="">
            </td>
            <td>
              <strong>Max Players:</strong><br>
              <input type="text" name="max_players" size="10" value="0">
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
                <legend><strong>Safe Return</strong></legend>
                <table width="100%" cellpadding="3" cellspacing="3">
                  <tr>
                    <td width="32%">
                      <strong>Zone:</strong><br>
                      <select name="safe_return_zone_id">
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
                      <input type="text" name="safe_return_x" size="10" value="0">
                    </td>
                    <td width="17%">
                      <strong>Y:</strong><br>
                      <input type="text" name="safe_return_y" size="10" value="0">
                    </td>
                    <td width="17%">
                      <strong>Z:</strong><br>
                      <input type="text" name="safe_return_z" size="10" value="0">
                    </td>
                    <td width="17%">
                      <strong>Heading:</strong><br>
                      <input type="text" name="safe_return_heading" size="10" value="0">
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
                      <strong>Has Zone In:</strong><br>
                      <select name="has_zone_in">
                        <option value="0">No (0)</option>
                        <option value="1">Yes (1)</option>
                      </select>
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
                      <input type="text" name="zone_in_heading" size="10" value="0">
                    </td>
                  </tr>
                </table>
              </fieldset>
            </td>
          </tr>
        </table><br>
        <center>
          <input type="submit" value="Add Dynamic Zone">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back()">
        </center>
      </form>
    </div>
  </div>
