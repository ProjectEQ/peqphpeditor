  <div class="table_container" style="width: 500px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td>Create Mercenary Type</td>
        </tr>
      </table>
    </div>
    <div class="table_content">
      <form name="add_mercenary_type" method="post" action="index.php?editor=mercs&action=15">
        <table width="100%" cellpadding="5" cellspacing="5">
          <tr>
            <td>
              <strong>ID:</strong><br>
              <input type="text" name="merc_type_id" size="10" value="<?=$suggest_id?>">
            </td>
            <td colspan="2">
              <strong>Race:</strong><br>
              <select name="race_id">
<?foreach ($races as $k=>$v):?>
                <option value="<?=$k?>"><?=$v?> (<?=$k?>)</option>
<?endforeach;?>
              </select>
            </td>
            <td>
              <strong>Proficiency:</strong><br>
              <input type="text" name="proficiency_id" size="10" value="">
            </td>
          </tr>
            <td>
              <strong>Client:</strong><br>
              <select name="clientversion">
<?foreach ($clients as $k=>$v):?>
                <option value="<?=$k?>"><?=$v?> (<?=$k?>)</option>
<?endforeach;?>
              </select>
            </td>
            <td>
              <strong>DB String:</strong><br>
              <input type="text" name="dbstring" size="20" value="">
            </td>
            <td>&nbsp;</td>
        </table><br>
        <center>
          <input type="submit" value="Insert Type">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back()">
        </center>
      </form>
    </div>
  </div>
