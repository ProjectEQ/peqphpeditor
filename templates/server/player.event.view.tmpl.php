  <div class="edit_form" style="width: 600px">
    <div class="edit_form_header">Player Event</div>
    <div class="edit_form_content">
      <table width="100%" cellpadding="5" cellspacing="5">
        <tr>
          <td>
            <b>ID:</b><br>
            <?=$event['id']?>
          </td>
          <td>
            <b>Account:</b><br>
            <?=getAccountName($event['account_id'])?> (<?=$event['account_id']?>)
          </td>
          <td>
            <b>Player:</b><br>
            <?=getPlayerName($event['character_id'])?> (<?=$event['character_id']?>)
          </td>
          <td colspan="3">
            <b>Timestamp:</b><br>
            <?=$event['created_at']?>
          </td>
        </tr>
        <tr>
          <td>
            <b>Zone:</b><br>
            <?=getZoneName($event['zone_id'])?> (<?=$event['zone_id']?>)
          </td>
          <td>
            <b>Instance:</b><br>
            <?=$event['instance_id']?>
          </td>
          <td>
            <b>X:</b><br>
            <?=$event['x']?>
          </td>
          <td>
            <b>Y:</b><br>
            <?=$event['y']?>
          </td>
          <td>
            <b>Z:</b><br>
            <?=$event['z']?>
          </td>
          <td>
            <b>Heading:</b><br>
            <?=$event['heading']?>
          </td>
        </tr>
        <tr>
          <td>
            <b>Event Type:</b><br>
            <?=$event['event_type_id']?>
          </td>
          <td>
            <b>Event Name:</b><br>
            <?=$event['event_type_name']?>
          </td>
          <td>&nbsp;</td>
          <td colspan="3">
            <b>ETL ID:</b><br>
            <?=$event['etl_table_id']?>
          </td>
        </tr>
        <tr>
          <td colspan="6">
            <fieldset>
              <legend><b>Event Data</b></legend>
<?
function display_array($in_array) {
  foreach ($in_array as $key=>$value) {
    if (is_array($value)) {
      display_array($value);
    }
    else {
      print "&nbsp;&nbsp;-&nbsp;<strong>" . $key . "</strong>: " . (($value != "") ? $value : "false") . "<br>";
    }
  }
}

if ($event['event_data'] != "") {
  $event_data = json_decode($event['event_data'], true);
  print("<strong><u>Base Data:</u></strong><br>");
  foreach ($event_data as $key=>$value) {
    if (is_array($value)) {
      print "<strong>" . $key . "</strong>: " . ((count($value) > 0) ? "" : " N/A") . "<br>";
      display_array($value);
    }
    else {
      print "<strong>" . $key . "</strong>: " . (($value != "") ? $value : "false") . "<br>";
    }
  }
}

if ($event['etl_table_id'] > 0) {
  print("<br><strong><u>ETL Data:</strong></u><br>");
  if ($event['etl_data'] != "") {
    foreach ($event['etl_data'] as $key=>$value) {
      if (is_array($value)) {
        print "<strong>" . $key . "</strong>: " . ((count($value) > 0) ? "" : " N/A") . "<br>";
        display_array($value);
      }
      else {
        print "<strong>" . $key . "</strong>: " . (($value != "") ? $value : "false") . "<br>";
      }
    }
  }
  if ($event['etl_data_extra']) {
    print("<br><strong><u>ETL Extra Data:</strong></u>");
    foreach ($event['etl_data_extra'] as $extra_data) {
      print("<br>");
      foreach ($extra_data as $key=>$value) {
        if (is_array($value)) {
          print "<strong>" . $key . "</strong>: " . ((count($value) > 0) ? "" : " N/A") . "<br>";
          display_array($value);
        }
        else {
          print "<strong>" . $key . "</strong>: " . (($value != "") ? $value : "false") . "<br>";
        }
      }
    }
  }
}

if (($event['event_data'] == "") && ($event['etl_table_id'] == 0)) {
  print("N/A");
}
?>
            </fieldset>
          </td>
        </tr>
      </table>
    </div>
  </div>
