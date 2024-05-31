  <center>
    <iframe id='searchframe' src='templates/iframes/spellsearch.php'></iframe>
    <input id="button" type="button" value='Hide Spell Search' onclick='hideSearch();' style='display:none; margin-bottom: 20px;'>
  </center>
  <div class="table_container" style="width: 610px">
    <div class="edit_form_header">Add a Spell</div>
    <div class="edit_form_content">
      <form method="post" action="index.php?editor=spellset&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&spellset=<?=$spellset?>&action=4">
        <table width="100%" cellpadding="3" cellspacing="3" border="0">
          <tr>
            <td>
              <strong>ID:</strong><br>
              <input type="text" name="id" size="10" value="<?=$suggest_id?>">
            </td>
            <td>
              <strong>NPC Spells ID:</strong><br>
              <input type="text" size="10" value="<?=$npc_spells_id?>" disabled>
            </td>
            <td>
              <strong>Spell ID:</strong> (<a href="javascript:showSearch();">search</a>)<br>
              <input id="id" type="text" name="spellid" size="10" value="0">
            </td>
            <td>
              <strong>Type:</strong><br>
              <select name="type">
<?foreach($spelltypes as $k => $v):?>
                <option value="<?=$k?>"><?=$v?></option>
<?endforeach;?>
              </select>
            </td>
          </tr>
          <tr>
            <td>
              <strong>Minlevel:</strong><br>
              <input type="text" name="minlevel" size="10" value="1">
            </td>
            <td>
              <strong>Maxlevel:</strong><br>
              <input type="text" name="maxlevel" size="10" value="255">
            </td>
            <td>
              <strong>Mana Cost:</strong> <a title="Default: -1"><img src="images/info.gif" width="13"></a><br>
              <input type="text" name="manacost" size="10" value="-1">
            </td>
            <td>
              <strong>Recast Delay:</strong> <a title="Default: -1"><img src="images/info.gif" width="13"></a><br>
              <input type="text" name="recast_delay" size="10" value="-1">
            </td>
          </tr>
          <tr>
            <td>
              <strong>Priority:</strong> <a title="Innate: 0"><img src="images/info.gif" width="13"></a><br>
              <input type="text" name="priority" size="10" value="0">
            </td>
            <td>
              <strong>Resist Adjust:</strong> <a title="Default: blank"><img src="images/info.gif" width="13"></a><br>
              <input type="text" name="resist_adjust" size="10" value="">
            </td>
            <td>
              <strong>Min HP:</strong><br>
              <input type="text" name="min_hp" size="10" value="0">
            </td>
            <td>
              <strong>Max HP:</strong><br>
              <input type="text" name="max_hp" size="10" value="0">
            </td>
          </tr>
          <tr>
            <td>
              <strong>Min Expansion:</strong><br>
              <input type="text" name="min_expansion" size="10" value="-1">
            </td>
            <td>
              <strong>Max Expansion:</strong><br>
              <input type="text" name="max_expansion" size="10" value="-1">
            </td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td colspan="4">
              <strong>Content Flags:</strong><br>
              <input type="text" name="content_flags" size="80" value="">
            </td>
          </tr>
          <tr>
            <td colspan="4">
              <strong>Content Flags Disabled:</strong><br>
              <input type="text" name="content_flags_disabled" size="80" value="">
            </td>
          </tr>
        </table><br><br>
        <center>
          <input type="hidden" name="npc_spells_id" value="<?=$npc_spells_id?>">
          <input type="submit" name="submit" value="Add Spell">&nbsp;
          <input type="button" value="Cancel" onClick="history.back();">
        </center>
      </form>
    </div>
  </div>
