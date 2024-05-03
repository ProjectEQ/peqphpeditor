  <div class="table_container" style="width: 690px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td>Create Parcel</td>
        </tr>
      </table>
    </div>
    <div class="table_content">
      <form name="edit_parcel" method="post" action="index.php?editor=parcels&action=4">
        <table width="100%" cellpadding="5" cellspacing="5">
          <tr>
            <td>
              <strong>ID:</strong><br>
              <input type="text" size="11" value="<?=$parcel['id']?>" disabled>
            </td>
            <td>
              <strong>Character ID:</strong><br>
              <input type="text" name="char_id" size="15" value="<?=$parcel['char_id']?>">
            </td>
            <td>
              <strong>Item ID:</strong><br>
              <input type="text" name="item_id" size="15" value="<?=$parcel['item_id']?>">
            </td>
            <td>
              <strong>Slot ID:</strong><br>
              <input type="text" name="slot_id" size="10" value="<?=$parcel['slot_id']?>">
            </td>
            <td>
              <strong>Quantity:</strong><br>
              <input type="text" name="quantity" size="10" value="<?=$parcel['quantity']?>">
            </td>
          </tr>
        </table>
        <table width="100%" cellpadding="5" cellspacing="5">
          <tr>
            <td>
              <strong>Aug Slot 1:</strong><br>
              <input type="text" name="aug_slot_1" size="10" value="<?=$parcel['aug_slot_1']?>">
            </td>
            <td>
              <strong>Aug Slot 2:</strong><br>
              <input type="text" name="aug_slot_2" size="10" value="<?=$parcel['aug_slot_2']?>">
            </td>
            <td>
              <strong>Aug Slot 3:</strong><br>
              <input type="text" name="aug_slot_3" size="10" value="<?=$parcel['aug_slot_3']?>">
            </td>
            <td>
              <strong>Aug Slot 4:</strong><br>
              <input type="text" name="aug_slot_4" size="10" value="<?=$parcel['aug_slot_4']?>">
            </td>
            <td>
              <strong>Aug Slot 5:</strong><br>
              <input type="text" name="aug_slot_5" size="10" value="<?=$parcel['aug_slot_5']?>">
            </td>
            <td>
              <strong>Aug Slot 6:</strong><br>
              <input type="text" name="aug_slot_6" size="10" value="<?=$parcel['aug_slot_6']?>">
            </td>
          </tr>
          <tr>
            <td colspan="3">
              <strong>From:</strong><br>
              <input type="text" name="from_name" size="30" value="<?=$parcel['from_name']?>">
            </td>
            <td colspan="3">
              <strong>Sent:</strong><br>
              <input type="text" size="30" value="<?=$parcel['sent_date']?>" disabled>
            </td>
          </tr>
          <tr>
            <td colspan="6">
              <strong>Note:</strong><br>
              <input type="text" name="note" size="90" value="<?=$parcel['note']?>">
            </td>
          </tr>
        </table><br>
        <center>
          <input type="hidden" name="id" value="<?=$parcel['id']?>">
          <input type="submit" value="Update Parcel">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back()">
        </center>
      </form>
    </div>
  </div>
