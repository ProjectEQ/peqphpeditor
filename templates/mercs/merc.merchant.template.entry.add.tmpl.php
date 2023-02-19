  <div class="table_container" style="width: 500px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td>Create Mercenary Merchant Template Entry</td>
        </tr>
      </table>
    </div>
    <div class="table_content">
      <form name="add_mercenary_merchant_template_entry" method="post" action="index.php?editor=mercs&action=93">
        <table width="100%" cellpadding="5" cellspacing="5">
          <tr>
            <td>
              <strong>ID:</strong><br>
              <input type="text" name="merc_merchant_template_entry_id" size="10" value="<?=$suggest_id?>">
            </td>
            <td>
              <strong>Merchant Template:</strong><br>
              <input type="text" size="10" value="<?=$merc_merchant_template_id?>" disabled>
            </td>
            <td>
              <strong>Merc Template:</strong><br>
              <input type="text" name="merc_template_id" size="10" value="">
            </td>
          </tr>
        </table><br>
        <center>
          <input type="hidden" name="merc_merchant_template_id" value="<?=$merc_merchant_template_id?>">
          <input type="submit" value="Insert Entry">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back()">
        </center>
      </form>
    </div>
  </div>
