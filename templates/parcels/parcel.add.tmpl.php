  <div class="table_container" style="width: 690px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td>Create Parcel</td>
        </tr>
      </table>
    </div>
    <div class="table_content">
      <form name="add_parcel" method="post" action="index.php?editor=parcels&action=2">
        <table width="100%" cellpadding="5" cellspacing="5">
          <tr>
            <td>
              <strong>ID:</strong><br>
              <input type="text" name="id" size="10" value="<?=$suggest_id?>">
            </td>
            <td>
              <strong>Character ID:</strong><br>
              <input type="text" name="char_id" size="15" value="">
            </td>
            <td>
              <strong>Item ID:</strong><br>
              <input type="text" name="item_id" size="15" value="">
            </td>
            <td>
              <strong>Slot ID:</strong><br>
              <input type="text" name="slot_id" size="10" value="">
            </td>
            <td>
              <strong>Quantity:</strong><br>
              <input type="text" name="quantity" size="10" value="">
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <strong>From:</strong><br>
              <input type="text" name="from_name" size="30" value="">
            </td>
            <td colspan="3">
              <strong>Sent:</strong><br>
              <input type="text" size="30" value="<?echo date("Y-m-d H:i:s");?>" disabled>
            </td>
          </tr>
          <tr>
            <td colspan="5">
              <strong>Note:</strong><br>
              <input type="text" name="note" size="89" value="">
            </td>
          </tr>
        </table><br>
        <center>
          <input type="submit" value="Insert Parcel">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back()">
        </center>
      </form>
    </div>
  </div>
