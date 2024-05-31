  <div class="table_container" style="width: 690px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td>Create Parcel</td>
        </tr>
      </table>
    </div>
    <div class="table_content">
      <form name="add_container_parcel" method="post" action="index.php?editor=parcels&action=8">
        <table width="100%" cellpadding="5" cellspacing="5">
          <tr>
            <td>
              <strong>ID:</strong><br>
              <input type="text" name="id" size="11" value="<?=$suggest_id?>">
            </td>
            <td>
              <strong>Parcels ID:</strong><br>
              <input type="text" size="15" value="<?=$parcels_id?>" disabled>
            </td>
            <td>
              <strong>Item ID:</strong><br>
              <input type="text" name="item_id" size="15" value="0">
            </td>
            <td>
              <strong>Slot ID:</strong><br>
              <input type="text" name="slot_id" size="10" value="0">
            </td>
            <td>
              <strong>Quantity:</strong><br>
              <input type="text" name="quantity" size="10" value="0">
            </td>
          </tr>
        </table>
        <table width="100%" cellpadding="5" cellspacing="5">
          <tr>
            <td>
              <strong>Aug Slot 1:</strong><br>
              <input type="text" name="aug_slot_1" size="10" value="0">
            </td>
            <td>
              <strong>Aug Slot 2:</strong><br>
              <input type="text" name="aug_slot_2" size="10" value="0">
            </td>
            <td>
              <strong>Aug Slot 3:</strong><br>
              <input type="text" name="aug_slot_3" size="10" value="0">
            </td>
            <td>
              <strong>Aug Slot 4:</strong><br>
              <input type="text" name="aug_slot_4" size="10" value="0">
            </td>
            <td>
              <strong>Aug Slot 5:</strong><br>
              <input type="text" name="aug_slot_5" size="10" value="0">
            </td>
            <td>
              <strong>Aug Slot 6:</strong><br>
              <input type="text" name="aug_slot_6" size="10" value="0">
            </td>
          </tr>
        </table><br>
        <center>
          <input type="hidden" name="parcels_id" value="<?=$parcels_id?>">
          <input type="submit" value="Insert Parcel">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back()">
        </center>
      </form>
    </div>
  </div>
