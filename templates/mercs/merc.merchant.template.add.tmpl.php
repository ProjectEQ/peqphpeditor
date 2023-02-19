  <div class="table_container" style="width: 650px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td>Create Mercenary Merchant Template</td>
        </tr>
      </table>
    </div>
    <div class="table_content">
      <form name="add_mercenary_merchant_template" method="post" action="index.php?editor=mercs&action=87">
        <table width="100%" cellpadding="5" cellspacing="5">
          <tr>
            <td>
              <strong>ID:</strong><br>
              <input type="text" name="merc_merchant_template_id" size="10" value="<?=$suggest_id?>">
            </td>
            <td>
              <strong>Name:</strong><br>
              <input type="text" name="name" size="35" value="">
            </td>
            <td>
              <strong>QGlobal:</strong><br>
              <input type="text" name="qglobal" size="20" value="">
            </td>
          </tr>
        </table><br>
        <center>
          <input type="submit" value="Insert Template">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back()">
        </center>
      </form>
    </div>
  </div>
