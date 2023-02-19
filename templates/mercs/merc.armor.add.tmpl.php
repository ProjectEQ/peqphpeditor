  <div class="table_container" style="width: 700px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td>Create Mercenary Armor</td>
        </tr>
      </table>
    </div>
    <div class="table_content">
      <form name="add_mercenary_armor" method="post" action="index.php?editor=mercs&merc_npc_type_id=<?=$merc_npc_type_id?>&action=63">
        <table width="100%" cellpadding="5" cellspacing="5">
          <tr>
            <td>
              <strong>ID:</strong><br>
              <input type="text" name="id" size="10" value="<?=$suggest_id?>">
            </td>
            <td>
              <strong>NPC Type ID:</strong><br>
              <input type="text" size="10" value="<?=$merc_npc_type_id?>" disabled>
            </td>
            <td>
              <strong>Min Level:</strong><br>
              <input type="text" name="minlevel" size="10" value="1">
            </td>
            <td>
              <strong>Max Level:</strong><br>
              <input type="text" name="maxlevel" size="10" value="255">
            </td>
            <td>
              <strong>Texture:</strong><br>
              <input type="text" name="texture" size="10" value="0">
            </td>
            <td>
              <strong>Helm Texture:</strong><br>
              <input type="text" name="helmtexture" size="10" value="0">
            </td>
          </tr>
          <tr>
            <td>
              <strong>Armor Tint ID:</strong><br>
              <input type="text" name="armortint_id" size="10" value="0">
            </td>
            <td>
              <strong>Armor Tint Red:</strong><br>
              <input type="text" name="armortint_red" size="10" value="0">
            </td>
            <td>
              <strong>Armor Tint Green:</strong><br>
              <input type="text" name="armortint_green" size="10" value="0">
            </td>
            <td>
              <strong>Armor Tint Blue:</strong><br>
              <input type="text" name="armortint_blue" size="10" value="0">
            </td>
          </tr>
        </table><br>
        <center>
          <input type="hidden" name="merc_npc_type_id" value="<?=$merc_npc_type_id?>">
          <input type="submit" value="Insert Armor">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back()">
        </center>
      </form>
    </div>
  </div>
