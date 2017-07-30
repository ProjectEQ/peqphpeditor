  <center>
    <iframe id="searchframe" src="templates/iframes/spellsearch.php" style="display:none;"></iframe>
    <iframe id="searchframe2" src="templates/iframes/spellsearch2.php" style="display:none;"></iframe>
    <input id="button" type="button" value="Hide Search" onclick="javascript:hideSearch();" style="display:none;">
  </center>
  <div style="margin: auto; width: 500px;">
    <div class="edit_form">
      <div class="edit_form_header">
        <table width="100%">
          <tr>
            <td>
              Edit Aura
            </td>
          </tr>
        </table>
      </div>
      <div class="edit_form_content">
        <form name="aura_create" method="post" action="index.php?editor=auras&action=6">
          <table width="100%" cellspacing="0" cellpadding="3">
            <tr>
              <td>
                <strong>Type:</strong> (<a href="javascript:showTypeSearch();">search</a>)<br>
                <input type="text" name="type" id="type" size="10" value="<?=$aura['type']?>">
              </td>
              <td>
                <strong>NPC:</strong><br>
                <input type="text" name="npc_type" size="8" value="<?=$aura['npc_type']?>">
              </td>
              <td>
                <strong>Spell ID:</strong> (<a href="javascript:showSpellSearch();">search</a>)<br>
                <input type="text" name="spell_id" id="id" size="10" value="<?=$aura['spell_id']?>">
              </td>
            </tr>
            <tr>
              <td>
                <strong>Name:</strong><br>
                <input type="text" name="name" size="25" value="<?=$aura['name']?>">
              </td>
              <td>
                <strong>Distance:</strong><br>
                <input type="text" name="distance" size="4" value="<?=$aura['distance']?>">
              </td>
              <td>
                <strong>Duration:</strong><br>
                <input type="text" name="duration" size="4" value="<?=$aura['duration']?>"> sec.
              </td>
            </tr>
            <tr>
              <td>
                <strong>Aura Type:</strong><br>
                <select name="aura_type">
<?foreach ($aura_type as $k=>$v):?>
                  <option value="<?=$k?>"<?echo ($k == $aura['aura_type']) ? " selected" : "";?>><?=$k?> - <?=$v?></option>
<?endforeach;?>
                </select>
              </td>
              <td>
                &nbsp;
              </td>
              <td>
                <strong>Movement:</strong><br>
                <select name="movement">
<?foreach ($aura_movement as $k=>$v):?>
                  <option value="<?=$k?>"<?echo ($k == $aura['movement']) ? " selected" : "";?>><?=$k?> - <?=$v?></option>
<?endforeach;?>
                </select>
              </td>
            </tr>
            <tr>
              <td>
                <strong>Spawn Type:</strong><br>
                <select name="spawn_type">
<?foreach ($aura_spawn as $k=>$v):?>
                  <option value="<?=$k?>"<?echo ($k == $aura['spawn_type']) ? " selected" : "";?>><?=$k?> - <?=$v?></option>
<?endforeach;?>
                </select>
              </td>
              <td>
                <strong>Icon:</strong><br>
                <input type="text" name="icon" size="4" value="<?=$aura['icon']?>">
              </td>
              <td>
                <strong>Cast Time:</strong><br>
                <input type="text" name="cast_time" size="4" value="<?=$aura['cast_time']?>">
              </td>
            </tr>
          </table><br><br>
          <center>
            <input type="hidden" name="old_type" value="<?=$aura['type']?>">
            <input type="submit" value="Update Aura">&nbsp;&nbsp;
            <input type="button" value="Cancel" onClick="history.back();"></center>
        </form>
      </div>
    </div>
  </div>
