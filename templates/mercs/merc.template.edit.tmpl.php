  <div class="table_container" style="width: 650px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td>Edit Mercenary Template</td>
        </tr>
      </table>
    </div>
    <div class="table_content">
      <form name="edit_mercenary_template" method="post" action="index.php?editor=mercs&action=35">
        <table width="100%" cellpadding="5" cellspacing="5">
          <tr>
            <td>
              <strong>ID:</strong><br>
              <input type="text" size="10" value="<?=$template['merc_template_id']?>" disabled>
            </td>
            <td>
              <strong>Type:</strong><br>
              <input type="text" name="merc_type_id" size="10" value="<?=$template['merc_type_id']?>">
            </td>
            <td>
              <strong>Subtype:</strong><br>
              <input type="text" name="merc_subtype_id" size="10" value="<?=$template['merc_subtype_id']?>">
            </td>
            <td>
              <strong>NPC Type:</strong><br>
              <input type="text" name="merc_npc_type_id" size="10" value="<?=$template['merc_npc_type_id']?>">
            </td>
          </tr>
          <tr>
            <td>
              <strong>Name Type:</strong><br>
              <input type="text" name="name_type_id" size="10" value="<?=$template['name_type_id']?>">
            </td>
            <td>
              <strong>DB String:</strong><br>
              <input type="text" name="dbstring" size="10" value="<?=$template['dbstring']?>">
            </td>
            <td>
              <strong>Client:</strong><br>
              <select name="clientversion">
<?foreach ($clients as $k=>$v):?>
                <option value="<?=$k?>"<?echo ($template['clientversion'] == $k) ? " selected" : "";?>><?=$v?> (<?=$k?>)</option>
<?endforeach;?>
              </select>
            </td>
            <td>&nbsp;</td>
          </tr>
        </table><br>
        <center>
          <input type="hidden" name="merc_template_id" value="<?=$template['merc_template_id']?>">
          <input type="submit" value="Update Template">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back()">
        </center>
      </form>
    </div>
  </div>
