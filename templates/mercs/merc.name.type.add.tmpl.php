  <div class="table_container" style="width: 750px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td>Create Mercenary Name Type</td>
        </tr>
      </table>
    </div>
    <div class="table_content">
      <form name="add_mercenary_name_type" method="post" action="index.php?editor=mercs&action=27">
        <table width="100%" cellpadding="5" cellspacing="5">
          <tr>
            <td>
              <strong>ID:</strong><br>
              <input type="text" name="name_type_id" size="10" value="<?=$suggest_id?>">
            </td>
            <td>
              <strong>Class:</strong><br>
              <select name="class_id">
<?foreach ($classes as $k=>$v):?>
                <option value="<?=$k?>"><?=$v?> (<?=$k?>)</option>
<?endforeach;?>
              </select>
            </td>
            <td>
              <strong>Prefix:</strong><br>
              <input type="text" name="prefix" size="20" value="">
            </td>
            <td>
              <strong>Suffix:</strong><br>
              <input type="text" name="suffix" size="20" value="">
            </td>
          </tr>
        </table><br>
        <center>
          <input type="submit" value="Insert Type">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back()">
        </center>
      </form>
    </div>
  </div>
