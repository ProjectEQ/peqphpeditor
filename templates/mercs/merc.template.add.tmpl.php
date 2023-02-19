  <div class="table_container" style="width: 650px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td>Create Mercenary Template</td>
        </tr>
      </table>
    </div>
    <div class="table_content">
      <form name="add_mercenary_template" method="post" action="index.php?editor=mercs&action=32">
        <table width="100%" cellpadding="5" cellspacing="5">
          <tr>
            <td>
              <strong>ID:</strong><br>
              <input type="text" name="merc_template_id" size="10" value="<?=$suggest_id?>">
            </td>
            <td>
              <strong>Type:</strong><br>
              <input type="text" name="merc_type_id" size="10" value="">
            </td>
            <td>
              <strong>Subtype:</strong><br>
              <input type="text" name="merc_subtype_id" size="10" value="">
            </td>
            <td>
              <strong>NPC Type:</strong><br>
              <input type="text" name="merc_npc_type_id" size="10" value="">
            </td>
          </tr>
          <tr>
            <td>
              <strong>Name Type:</strong><br>
              <input type="text" name="name_type_id" size="10" value="">
            </td>
            <td>
              <strong>DB String:</strong><br>
              <input type="text" name="dbstring" size="10" value="">
            </td>
            <td>
              <strong>Client:</strong><br>
              <select name="clientversion">
<?foreach ($clients as $k=>$v):?>
                <option value="<?=$k?>"><?=$v?> (<?=$k?>)</option>
<?endforeach;?>
              </select>
            </td>
            <td>&nbsp;</td>
          </tr>
        </table><br>
        <center>
          <input type="submit" value="Insert Template">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back()">
        </center>
      </form>
    </div>
  </div>
