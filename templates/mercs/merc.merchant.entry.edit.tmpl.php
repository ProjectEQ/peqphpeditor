  <div class="table_container" style="width: 500px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td>Edit Mercenary Merchant Entry</td>
        </tr>
      </table>
    </div>
    <div class="table_content">
      <form name="edit_mercenary_merchant_entry" method="post" action="index.php?editor=mercs&action=100">
        <table width="100%" cellpadding="5" cellspacing="5">
          <tr>
            <td>
              <strong>ID:</strong><br>
              <input type="text" size="10" value="<?=$entry['merc_merchant_entry_id']?>" disabled>
            </td>
            <td>
              <strong>Merchant Template:</strong><br>
              <input type="text" size="10" value="<?=$entry['merc_merchant_template_id']?>" disabled>
            </td>
            <td>
              <strong>Merchant ID:</strong><br>
              <input type="text" name="merchant_id" size="10" value="<?=$entry['merchant_id']?>">
            </td>
          </tr>
        </table><br>
        <center>
          <input type="hidden" name="merc_merchant_template_id" value="<?=$entry['merc_merchant_template_id']?>">
          <input type="hidden" name="merc_merchant_entry_id" value="<?=$entry['merc_merchant_entry_id']?>">
          <input type="submit" value="Update Entry">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back()">
        </center>
      </form>
    </div>
  </div>
