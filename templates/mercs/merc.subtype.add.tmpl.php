  <div class="table_container" style="width: 650px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td>Create Mercenary Subtype</td>
        </tr>
      </table>
    </div>
    <div class="table_content">
      <form name="add_mercenary_subtype" method="post" action="index.php?editor=mercs&action=21">
        <table width="100%" cellpadding="5" cellspacing="5">
          <tr>
            <td>
              <strong>ID:</strong><br>
              <input type="text" name="merc_subtype_id" size="10" value="<?=$suggest_id?>">
            </td>
            <td colspan="2">
              <strong>Class:</strong><br>
              <select name="class_id">
<?foreach ($classes as $k=>$v):?>
                <option value="<?=$k?>"><?=$v?> (<?=$k?>)</option>
<?endforeach;?>
              </select>
            </td>
            <td>
              <strong>Tier:</strong><br>
              <input type="text" name="tier_id" size="10" value="">
            </td>
            <td>
              <strong>Confidence:</strong><br>
              <input type="text" name="confidence_id" size="10" value="">
            </td>
          </tr>
        </table><br>
        <center>
          <input type="submit" value="Insert Subtype">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back()">
        </center>
      </form>
    </div>
  </div>
