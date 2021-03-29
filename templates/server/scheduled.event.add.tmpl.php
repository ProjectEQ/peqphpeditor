  <div class="table_container" style="width: 710px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td>Create Scheduled Event</td>
        </tr>
      </table>
    </div>
    <div class="table_content">
      <form name="add_scheduled_event" method="post" action="index.php?editor=server&action=66">
        <table width="100%" cellpadding="5" cellspacing="5">
          <tr>
            <td colspan="2">
              <table width="100%">
                <tr>
                  <td>
                    <strong>ID:</strong><br>
                    <input type="text" name="id" size="10" value="<?=$suggested_id?>">
                  </td>
                  <td>
                    <strong>Event Type:</strong><br>
                    <input type="text" name="event_type" size="93" value="">
                  </td>
                </tr>
              </table>
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <strong>Description:</strong><br>
              <textarea cols="82" rows="3" name="description"></textarea>
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <strong>Event Data:</strong><br>
              <textarea cols="82" rows="8" name="event_data"></textarea>
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <fieldset>
                <legend><strong>Start Time</strong></legend>
                <table width="100%" cellpadding="3" cellspacing="3">
                  <tr>
                    <td>
                      <strong>Minute:</strong><br>
                      <input type="text" name="minute_start" size="10" value="0">
                    </td>
                    <td>
                      <strong>Hour:</strong><br>
                      <input type="text" name="hour_start" size="10" value="0">
                    </td>
                    <td>
                      <strong>Day:</strong><br>
                      <input type="text" name="day_start" size="10" value="0">
                    </td>
                    <td>
                      <strong>Month:</strong><br>
                      <input type="text" name="month_start" size="10" value="0">
                    </td>
                    <td>
                      <strong>Year:</strong><br>
                      <input type="text" name="year_start" size="10" value="0">
                    </td>
                  </tr>
                </table>
              </fieldset>
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <fieldset>
                <legend><strong>End Time</strong></legend>
                <table width="100%" cellpadding="3" cellspacing="3">
                  <tr>
                    <td>
                      <strong>Minute:</strong><br>
                      <input type="text" name="minute_end" size="10" value="0">
                    </td>
                    <td>
                      <strong>Hour:</strong><br>
                      <input type="text" name="hour_end" size="10" value="0">
                    </td>
                    <td>
                      <strong>Day:</strong><br>
                      <input type="text" name="day_end" size="10" value="0">
                    </td>
                    <td>
                      <strong>Month:</strong><br>
                      <input type="text" name="month_end" size="10" value="0">
                    </td>
                    <td>
                      <strong>Year:</strong><br>
                      <input type="text" name="year_end" size="10" value="0">
                    </td>
                  </tr>
                </table>
              </fieldset>
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <strong>Cron Expression:</strong><br>
              <input type="text" name="cron_expression" size="110" value="">
            </td>
          </tr>
          <tr>
            <td>
              <strong>Created:</strong><br>
              <input type="text" name="created_at" size="51" value="<?=get_current_time()?>">
            </td>
            <td>
              <strong>Deleted:</strong><br>
              <input type="text" name="deleted_at" size="51" value="">
            </td>
          </tr>
        </table><br>
        <center>
          <input type="submit" value="Add Event">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back()">
        </center>
      </form>
    </div>
  </div>
