        <div class="edit_form" style="width: 600px">
          <div class="edit_form_header">Player Event</div>
          <div class="edit_form_content">
            <table width="100%" cellpadding="3" cellspacing="3">
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
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td colspan="6">
                  <b>Event Data:</b><br>
                  <?=$event['event_data']?>
                </td>
              </tr>
            </table>
          </div>
        </div>