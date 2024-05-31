  <div class="table_container" style="width: 690px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td>Edit Parcel</td>
        </tr>
      </table>
    </div>
    <div class="table_content">
      <form name="edit_container_parcel" method="post" action="index.php?editor=parcels&action=10">
        <table width="100%" cellpadding="5" cellspacing="5">
          <tr>
            <td>
              <strong>ID:</strong><br>
              <input type="text" size="11" value="<?=$parcel['id']?>" disabled>
            </td>
            <td>
              <strong>Parcels ID:</strong><br>
              <input type="text" size="15" value="<?=$parcel['parcels_id']?>" disabled>
            </td>
            <td>
              <strong>Item ID:</strong><br>
              <input type="text" name="item_id" size="15" value="<?=$parcel['item_id']?>">
            </td>
            <td>
              <strong>Slot ID:</strong><br>
              <input type="text" name="slot_id" size="10" value="<?=$parcel['slot_id']?>" disabled>
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
        </table><br>
        <center>
          <input type="hidden" name="id" value="<?=$parcel['id']?>">
          <input type="hidden" name="parcels_id" value="<?=$parcel['parcels_id']?>">
          <input type="hidden" name="slot_id" value="<?=$parcel['slot_id']?>">
          <input type="submit" value="Update Parcel">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back()">
        </center>
      </form>
    </div>
  </div>
