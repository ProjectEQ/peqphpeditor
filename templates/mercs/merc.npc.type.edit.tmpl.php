  <div class="table_container" style="width: 650px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td>Edit Mercenary NPC Type</td>
        </tr>
      </table>
    </div>
    <div class="table_content">
      <form name="edit_mercenary_npc_type" method="post" action="index.php?editor=mercs&action=11">
        <table width="100%" cellpadding="5" cellspacing="5">
          <tr>
            <td>
              <strong>ID:</strong><br>
              <input type="text" size="10" value="<?=$type['merc_npc_type_id']?>" disabled>
            </td>
            <td>
              <strong>Proficiency:</strong><br>
              <input type="text" name="proficiency_id" size="10" value="<?=$type['proficiency_id']?>">
            </td>
            <td>
              <strong>Tier:</strong><br>
              <input type="text" name="tier_id" size="10" value="<?=$type['tier_id']?>">
            </td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2">
              <strong>Class:</strong><br>
              <select name="class_id">
<?foreach ($classes as $k=>$v):?>
                <option value="<?=$k?>"<?echo ($type['class_id'] == $k) ? " selected" : "";?>><?=$v?> (<?=$k?>)</option>
<?endforeach;?>
              </select>
            </td>
            <td colspan="2">
              <strong>Name:</strong><br>
              <input type="text" name="name" size="35" value="<?=$type['name']?>">
            </td>
          </tr>
        </table><br>
        <center>
          <input type="hidden" name="merc_npc_type_id" value="<?=$type['merc_npc_type_id']?>">
          <input type="submit" value="Update Type">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back()">
        </center>
      </form>
    </div>
  </div>
