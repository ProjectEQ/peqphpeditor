  <div class="table_container" style="width: 700px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td>Edit Mercenary Weapon</td>
        </tr>
      </table>
    </div>
    <div class="table_content">
      <form name="edit_mercenary_weapon" method="post" action="index.php?editor=mercs&merc_npc_type_id=<?=$weapon['merc_npc_type_id']?>&action=71">
        <table width="100%" cellpadding="5" cellspacing="5">
          <tr>
            <td>
              <strong>ID:</strong><br>
              <input type="text" size="10" value="<?=$weapon['id']?>" disabled>
            </td>
            <td>
              <strong>NPC Type ID:</strong><br>
              <input type="text" size="10" value="<?=$weapon['merc_npc_type_id']?>" disabled>
            </td>
            <td>
              <strong>Min Level:</strong><br>
              <input type="text" name="minlevel" size="10" value="<?=$weapon['minlevel']?>">
            </td>
            <td>
              <strong>Max Level:</strong><br>
              <input type="text" name="maxlevel" size="10" value="<?=$weapon['maxlevel']?>">
            </td>
            <td>
              <strong>Melee1 Texture:</strong><br>
              <input type="text" name="d_melee_texture1" size="10" value="<?=$weapon['d_melee_texture1']?>">
            </td>
            <td>
              <strong>Melee2 Texture:</strong><br>
              <input type="text" name="d_melee_texture2" size="10" value="<?=$weapon['d_melee_texture2']?>">
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <strong>Melee1 Type:</strong><br>
              <select name="prim_melee_type" style="width: 200px;">
<?foreach($skilltypes as $k=>$v):?>
                <option value="<?=$k?>"<?echo ($weapon['prim_melee_type'] == $k)? " selected" : "";?>><?=$k?>: <?=$v?></option>
<?endforeach;?>
              </select>
            </td> 
            <td colspan="2">
              <strong>Melee2 Type:</strong><br>
              <select name="sec_melee_type" style="width: 200px;">
<?foreach($skilltypes as $k=>$v):?>
                <option value="<?=$k?>"<?echo ($weapon['sec_melee_type'] == $k)? " selected" : "";?>><?=$k?>: <?=$v?></option>
<?endforeach;?>
              </select>
            </td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table><br>
        <center>
          <input type="hidden" name="id" value="<?=$weapon['id']?>">
          <input type="hidden" name="merc_npc_type_id" value="<?=$weapon['merc_npc_type_id']?>">
          <input type="submit" value="Insert Weapon">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back()">
        </center>
      </form>
    </div>
  </div>
