  <div class="table_container" style="width: 650px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td>Edit Mercenary Subtype</td>
        </tr>
      </table>
    </div>
    <div class="table_content">
      <form name="edit_mercenary_subtype" method="post" action="index.php?editor=mercs&action=23">
        <table width="100%" cellpadding="5" cellspacing="5">
          <tr>
            <td>
              <strong>ID:</strong><br>
              <input type="text" size="10" value="<?=$subtype['merc_subtype_id']?>" disabled>
            </td>
            <td colspan="2">
              <strong>Class:</strong><br>
              <select name="class_id">
<?foreach ($classes as $k=>$v):?>
                <option value="<?=$k?>"<?echo ($subtype['class_id'] == $k) ? " selected" : "";?>><?=$v?> (<?=$k?>)</option>
<?endforeach;?>
              </select>
            </td>
            <td>
              <strong>Tier:</strong><br>
              <input type="text" name="tier_id" size="10" value="<?=$subtype['tier_id']?>">
            </td>
            <td>
              <strong>Confidence:</strong><br>
              <input type="text" name="confidence_id" size="10" value="<?=$subtype['confidence_id']?>">
            </td>
          </tr>
        </table><br>
        <center>
          <input type="hidden" name="merc_subtype_id" value="<?=$subtype['merc_subtype_id']?>">
          <input type="submit" value="Insert Subtype">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back()">
        </center>
      </form>
    </div>
  </div>
