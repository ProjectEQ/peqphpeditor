  <div class="table_container" style="width: 650px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td>Edit Mercenary Merchant Template</td>
        </tr>
      </table>
    </div>
    <div class="table_content">
      <form name="edit_mercenary_merchant_template" method="post" action="index.php?editor=mercs&action=89">
        <table width="100%" cellpadding="5" cellspacing="5">
          <tr>
            <td>
              <strong>ID:</strong><br>
              <input type="text" size="10" value="<?=$template['merc_merchant_template_id']?>" disabled>
            </td>
            <td>
              <strong>Name:</strong><br>
              <input type="text" name="name" size="35" value="<?=$template['name']?>">
            </td>
            <td>
              <strong>QGlobal:</strong><br>
              <input type="text" name="qglobal" size="20" value="<?=$template['qglobal']?>">
            </td>
          </tr>
        </table><br>
        <center>
          <input type="hidden" name="merc_merchant_template_id" value="<?=$template['merc_merchant_template_id']?>">
          <input type="submit" value="Update Template">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back()">
        </center>
      </form>
    </div>
  </div>
