  <center>
    <iframe id="searchframe" src="templates/iframes/spellsearch.php" style="display:none;"></iframe>
    <input id="button" type="button" value="Hide Search" onclick="javascript:hideSearch();" style="display:none;">
  </center>
  <div style="margin: auto; width: 500px;">
    <div class="edit_form">
      <div class="edit_form_header">
        <table width="100%">
          <tr>
            <td>
              Add a New Aura
            </td>
          </tr>
        </table>
      </div>
      <div class="edit_form_content">
        <form name="aura_create" method="post" action="index.php?editor=auras&action=4">
          <table width="100%" cellspacing="0" cellpadding="3">
            <tr>
              <td width="20%">
                <strong>Type:</strong><br>
                <input type="text" name="type" size="4" value="<?=$next_type?>">
              </td>
              <td width="30%">
                <strong>NPC:</strong><br>
                <input type="text" name="npc_type" size="8" value="2000000">
              </td>
              <td width="50%">
                <strong>Name:</strong><br>
                <input type="text" name="name" size="25" value="aura_name">
              </td>
            </tr>
            <tr>
              <td colspan="2">
                <strong>Spell ID:</strong> (<a href="javascript:showSearch();">search</a>)<br>
                <input type="text" name="spell_id" id="id" size="10" value="0">
              </td>
              <td>
                <strong>Distance:</strong><br>
                <input type="text" name="distance" size="4" value="60">
              </td>
            </tr>
            <tr>
              <td>
                <strong>Aura Type:</strong><br>
                <input type="text" name="aura_type" size="4" value="1">
              </td>
              <td>
                <strong>Spawn Type:</strong><br>
                <input type="text" name="spawn_type" size="4" value="0">
              </td>
              <td>
                <strong>Movement:</strong><br>
                <input type="text" name="movement" size="4" value="0">
              </td>
            </tr>
            <tr>
              <td>
                <strong>Duration:</strong><br>
                <input type="text" name="duration" size="4" value="5400">
              </td>
              <td>
                <strong>Icon:</strong><br>
                <input type="text" name="icon" size="4" value="-1">
              </td>
              <td>
                <strong>Cast Time:</strong><br>
                <input type="text" name="cast_time" size="4" value="0">
              </td>
            </tr>
          </table><br><br>
          <center><input type="submit" value="Add Aura">&nbsp;&nbsp;<input type="button" value="Cancel" onClick="history.back();"></center>
        </form>
      </div>
    </div>
  </div>
