  <div class="table_container" style="width: 700px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td>Edit Mercenary Armor</td>
        </tr>
      </table>
    </div>
    <div class="table_content">
      <form name="edit_mercenary_armor" method="post" action="index.php?editor=mercs&merc_npc_type_id=<?=$weapon['merc_npc_type_id']?>&action=65">
        <table width="100%" cellpadding="5" cellspacing="5">
          <tr>
            <td>
              <strong>ID:</strong><br>
              <input type="text" size="10" value="<?=$armor['id']?>" disabled>
            </td>
            <td>
              <strong>NPC Type ID:</strong><br>
              <input type="text" size="10" value="<?=$armor['merc_npc_type_id']?>" disabled>
            </td>
            <td>
              <strong>Min Level:</strong><br>
              <input type="text" name="minlevel" size="10" value="<?=$armor['minlevel']?>">
            </td>
            <td>
              <strong>Max Level:</strong><br>
              <input type="text" name="maxlevel" size="10" value="<?=$armor['maxlevel']?>">
            </td>
            <td>
              <strong>Texture:</strong><br>
              <input type="text" name="texture" size="10" value="<?=$armor['texture']?>">
            </td>
            <td>
              <strong>Helm Texture:</strong><br>
              <input type="text" name="helmtexture" size="10" value="<?=$armor['helmtexture']?>">
            </td>
          </tr>
          <tr>
            <td>
              <strong>Armor Tint ID:</strong><br>
              <input type="text" name="armortint_id" size="10" value="<?=$armor['armortint_id']?>">
            </td>
            <td>
              <strong>Armor Tint Red:</strong><br>
              <input type="text" name="armortint_red" size="10" value="<?=$armor['armortint_red']?>">
            </td>
            <td>
              <strong>Armor Tint Green:</strong><br>
              <input type="text" name="armortint_green" size="10" value="<?=$armor['armortint_green']?>">
            </td>
            <td>
              <strong>Armor Tint Blue:</strong><br>
              <input type="text" name="armortint_blue" size="10" value="<?=$armor['armortint_blue']?>">
            </td>
          </tr>
        </table><br>
        <center>
          <input type="hidden" name="id" value="<?=$armor['id']?>">
          <input type="hidden" name="merc_npc_type_id" value="<?=$armor['merc_npc_type_id']?>">
          <input type="submit" value="Update Armor">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back()">
        </center>
      </form>
    </div>
  </div>
