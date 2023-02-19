  <div class="table_container" style="width: 700px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td>Edit Mercenary Stance</td>
        </tr>
      </table>
    </div>
    <div class="table_content">
      <form name="edit_mercenary_stance" method="post" action="index.php?editor=mercs&action=53">
        <table width="100%" cellpadding="5" cellspacing="5">
          <tr>
            <td>
              <strong>ID:</strong><br>
              <input type="text" size="10" value="<?=$stance['merc_stance_entry_id']?>" disabled>
            </td>
            <td>
              <strong>Class:</strong><br>
              <select name="class_id">
<?foreach ($classes as $k=>$v):?>
                <option value="<?=$k?>"<?echo ($stance['class_id'] == $k) ? " selected" : "";?>><?=$v?> (<?=$k?>)</option>
<?endforeach;?>
              </select>
            </td>
            <td>
              <strong>Proficiency:</strong><br>
              <input type="text" name="proficiency_id" size="10" value="<?=$stance['proficiency_id']?>">
            </td>
            <td>
              <strong>Stance:</strong><br>
              <select name="stance_id">
<?foreach ($stances as $k=>$v):?>
                <option value="<?=$k?>"<?echo ($stance['stance_id'] == $k) ? " selected" : "";?>><?=$v?> (<?=$k?>)</option>
<?endforeach;?>
              </select>
            </td>
            <td>
              <strong>Default:</strong><br>
              <select name="isdefault">
                <option value="0"<?echo ($stance['isdefault'] == 0) ? " selected" : "";?>>No (0)</option>
                <option value="1"<?echo ($stance['isdefault'] != 0) ? " selected" : "";?>>Yes (1)</option>
              </select>
            </td>
          </tr>
        </table><br>
        <center>
          <input type="hidden" name="merc_stance_entry_id" value="<?=$stance['merc_stance_entry_id']?>">
          <input type="submit" value="Update Stance">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back()">
        </center>
      </form>
    </div>
  </div>
