  <div class="table_container" style="width: 750px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td>Edit Mercenary Name Type</td>
        </tr>
      </table>
    </div>
    <div class="table_content">
      <form name="edit_mercenary_name_type" method="post" action="index.php?editor=mercs&action=29">
        <table width="100%" cellpadding="5" cellspacing="5">
          <tr>
            <td>
              <strong>ID:</strong><br>
              <input type="text" size="10" value="<?=$type['name_type_id']?>" disabled>
            </td>
            <td>
              <strong>Class:</strong><br>
              <select disabled>
<?foreach ($classes as $k=>$v):?>
                <option value="<?=$k?>"<?echo ($type['class_id'] == $k) ? " selected" : "";?>><?=$v?> (<?=$k?>)</option>
<?endforeach;?>
              </select>
            </td>
            <td>
              <strong>Prefix:</strong><br>
              <input type="text" name="prefix" size="20" value="<?=$type['prefix']?>">
            </td>
            <td>
              <strong>Suffix:</strong><br>
              <input type="text" name="suffix" size="20" value="<?=$type['suffix']?>">
            </td>
          </tr>
        </table><br>
        <center>
          <input type="hidden" name="name_type_id" value="<?=$type['name_type_id']?>">
          <input type="hidden" name="class_id" value="<?=$type['class_id']?>">
          <input type="submit" value="Update Type">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back()">
        </center>
      </form>
    </div>
  </div>
