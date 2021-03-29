  <div class="table_container" style="width: 710px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td>Edit Scheduled Event</td>
          <td align="right"><a onClick="return confirm('Really delete scheduled event?');" href="index.php?editor=server&id=<?=$scheduled_event['id']?>&action=69"><img src="images/remove3.gif" border="0" title="Delete Scheduled Event" alt="Delete"></a></td>
        </tr>
      </table>
    </div>
    <div class="table_content">
      <form name="edit_scheduled_event" method="post" action="index.php?editor=server&action=68">
        <table width="100%" cellpadding="5" cellspacing="5">
          <tr>
            <td colspan="2">
              <table width="100%">
                <tr>
                  <td>
                    <strong>ID:</strong><br>
                    <input type="text" size="10" value="<?=$scheduled_event['id']?>" disabled>
                  </td>
                  <td>
                    <strong>Event Type:</strong><br>
                    <input type="text" name="event_type" size="93" value="<?=$scheduled_event['event_type']?>">
                  </td>
                </tr>
              </table>
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <strong>Description:</strong><br>
              <textarea cols="82" rows="3" name="description"><?=$scheduled_event['description']?></textarea>
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <strong>Event Data:</strong><br>
              <textarea cols="82" rows="8" name="event_data"><?=$scheduled_event['event_data']?></textarea>
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
                      <input type="text" name="minute_start" size="10" value="<?=$scheduled_event['minute_start']?>">
                    </td>
                    <td>
                      <strong>Hour:</strong><br>
                      <input type="text" name="hour_start" size="10" value="<?=$scheduled_event['hour_start']?>">
                    </td>
                    <td>
                      <strong>Day:</strong><br>
                      <input type="text" name="day_start" size="10" value="<?=$scheduled_event['day_start']?>">
                    </td>
                    <td>
                      <strong>Month:</strong><br>
                      <input type="text" name="month_start" size="10" value="<?=$scheduled_event['month_start']?>">
                    </td>
                    <td>
                      <strong>Year:</strong><br>
                      <input type="text" name="year_start" size="10" value="<?=$scheduled_event['year_start']?>">
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
                      <input type="text" name="minute_end" size="10" value="<?=$scheduled_event['minute_end']?>">
                    </td>
                    <td>
                      <strong>Hour:</strong><br>
                      <input type="text" name="hour_end" size="10" value="<?=$scheduled_event['hour_end']?>">
                    </td>
                    <td>
                      <strong>Day:</strong><br>
                      <input type="text" name="day_end" size="10" value="<?=$scheduled_event['day_end']?>">
                    </td>
                    <td>
                      <strong>Month:</strong><br>
                      <input type="text" name="month_end" size="10" value="<?=$scheduled_event['month_end']?>">
                    </td>
                    <td>
                      <strong>Year:</strong><br>
                      <input type="text" name="year_end" size="10" value="<?=$scheduled_event['year_end']?>">
                    </td>
                  </tr>
                </table>
              </fieldset>
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <strong>Cron Expression:</strong><br>
              <input type="text" name="cron_expression" size="110" value="<?=$scheduled_event['cron_expression']?>">
            </td>
          </tr>
          <tr>
            <td>
              <strong>Created:</strong><br>
              <input type="text" name="created_at" size="51" value="<?=$scheduled_event['created_at']?>">
            </td>
            <td>
              <strong>Deleted:</strong><br>
              <input type="text" name="deleted_at" size="51" value="<?=$scheduled_event['deleted_at']?>">
            </td>
          </tr>
        </table><br>
        <center>
          <input type="hidden" name="id" value="<?=$scheduled_event['id']?>">
          <input type="submit" value="Update Event">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back()">
        </center>
      </form>
    </div>
  </div>
