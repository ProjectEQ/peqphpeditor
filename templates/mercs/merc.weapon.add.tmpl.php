  <div class="table_container" style="width: 700px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td>Create Mercenary Weapon</td>
        </tr>
      </table>
    </div>
    <div class="table_content">
      <form name="add_mercenary_weapon" method="post" action="index.php?editor=mercs&merc_npc_type_id=<?=$merc_npc_type_id?>&action=69">
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
              <strong>Melee1 Texture:</strong><br>
              <input type="text" name="d_melee_texture1" size="10" value="0">
            </td>
            <td>
              <strong>Melee2 Texture:</strong><br>
              <input type="text" name="d_melee_texture2" size="10" value="0">
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <strong>Melee1 Type:</strong><br>
              <select name="prim_melee_type" style="width: 200px;">
<?foreach($skilltypes as $k=>$v):?>
                <option value="<?=$k?>"<?echo ($k == 28)? " selected" : "";?>><?=$k?>: <?=$v?></option>
<?endforeach;?>
              </select>
            </td> 
            <td colspan="2">
              <strong>Melee2 Type:</strong><br>
              <select name="sec_melee_type" style="width: 200px;">
<?foreach($skilltypes as $k=>$v):?>
                <option value="<?=$k?>"<?echo ($k == 28)? " selected" : "";?>><?=$k?>: <?=$v?></option>
<?endforeach;?>
              </select>
            </td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table><br>
        <center>
          <input type="hidden" name="merc_npc_type_id" value="<?=$merc_npc_type_id?>">
          <input type="submit" value="Insert Weapon">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back()">
        </center>
      </form>
    </div>
  </div>
