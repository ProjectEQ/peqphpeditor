  <div class="table_container" style="width: 500px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td>Edit Mercenary Type</td>
        </tr>
      </table>
    </div>
    <div class="table_content">
      <form name="edit_mercenary_type" method="post" action="index.php?editor=mercs&action=17">
        <table width="100%" cellpadding="5" cellspacing="5">
          <tr>
            <td>
              <strong>ID:</strong><br>
              <input type="text" size="10" value="<?=$type['merc_type_id']?>" disabled>
            </td>
            <td colspan="2">
              <strong>Race:</strong><br>
              <select name="race_id">
<?foreach ($races as $k=>$v):?>
                <option value="<?=$k?>"<?echo ($type['race_id'] == $k) ? " selected" : "";?>><?=$v?> (<?=$k?>)</option>
<?endforeach;?>
              </select>
            </td>
            <td>
              <strong>Proficiency:</strong><br>
              <input type="text" name="proficiency_id" size="10" value="<?=$type['proficiency_id']?>">
            </td>
          </tr>
            <td>
              <strong>Client:</strong><br>
              <select name="clientversion">
<?foreach ($clients as $k=>$v):?>
                <option value="<?=$k?>"<?echo ($type['clientversion'] == $k) ? " selected" : "";?>><?=$v?> (<?=$k?>)</option>
<?endforeach;?>
              </select>
            </td>
            <td>
              <strong>DB String:</strong><br>
              <input type="text" name="dbstring" size="20" value="<?=$type['dbstring']?>">
            </td>
            <td>&nbsp;</td>
        </table><br>
        <center>
          <input type="hidden" name="merc_type_id" value="<?=$subtype['merc_type_id']?>">
          <input type="submit" value="Update Type">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back()">
        </center>
      </form>
    </div>
  </div>
