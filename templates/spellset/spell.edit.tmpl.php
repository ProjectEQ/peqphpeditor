  <center>
    <iframe id='searchframe' src='templates/iframes/spellsetsearch.php'></iframe>
    <input id="button" type="button" value='Hide Spellset Search' onclick='hideSearch();' style='display:none; margin-bottom: 20px;'>
  </center>
  <div class="table_container" style="width: 610px">
    <div class="edit_form_header">Edit a Spell</div>
    <div class="edit_form_content">
      <form method="post" action="index.php?editor=spellset&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&spellset=<?=$spellset?>&action=8">
        <table width="100%" cellpadding="3" cellspacing="3" border="0">
          <tr>
            <td>
              <strong>ID:</strong><br>
              <input type="text" size="10" value="<?=$id?>" disabled>
            </td>
            <td>
              <strong>NPC Spells ID:</strong><br>
              <input type="text" size="10" value="<?=$npc_spells_id?>" disabled>
            </td>
            <td>
              <strong>Spell ID:</strong> (<a href="javascript:showSearch();">search</a>)<br>
            <input id="id" type="text" name="spellid" size="10" value="<?=$spellid?>">
            </td>
            <td>
              <strong>Type:</strong><br>
              <select name="type">
<?foreach($spelltypes as $k => $v):?>
                <option value="<?=$k?>"<? echo ($k == $type) ? " selected" : ""?>><?=$v?></option>
<?endforeach;?>
              </select>
            </td>
          </tr>
          <tr>
            <td>
              <strong>Minlevel:</strong><br>
              <input type="text" name="minlevel" size="10" value="<?=$minlevel?>">
            </td>
            <td>
              <strong>Maxlevel:</strong><br>
              <input type="text" name="maxlevel" size="10" value="<?=$maxlevel?>">
            </td>
            <td>
              <strong>Mana Cost:</strong> <a title="Default: -1"><img src="images/info.gif" width="13"></a><br>
              <input type="text" name="manacost" size="10" value="<?=$manacost?>">
            </td>
            <td>
              <strong>Recast Delay:</strong> <a title="Default: -1"><img src="images/info.gif" width="13"></a><br>
              <input type="text" name="recast_delay" size="10" value="<?=$recast_delay?>">
            </td>
          </tr>
          <tr>
            <td>
              <strong>Priority:</strong> <a title="Innate: 0"><img src="images/info.gif" width="13"></a><br>
              <input type="text" name="priority" size="10" value="<?=$priority?>">
            </td>
            <td>
              <strong>Resist Adjust:</strong> <a title="Default: blank"><img src="images/info.gif" width="13"></a><br>
              <input type="text" name="resist_adjust" size="10" value="<?=$resist_adjust?>">
            </td>
            <td>
              <strong>Min HP:</strong><br>
              <input type="text" name="min_hp" size="10" value="<?=$min_hp?>">
            </td>
            <td>
              <strong>Max HP:</strong><br>
              <input type="text" name="max_hp" size="10" value="<?=$max_hp?>">
            </td>
          </tr>
          <tr>
            <td>
              <strong>Min Expansion:</strong><br>
              <input type="text" name="min_expansion" size="10" value="<?=$min_expansion?>">
            </td>
            <td>
              <strong>Max Expansion:</strong><br>
              <input type="text" name="max_expansion" size="10" value="<?=$max_expansion?>">
            </td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td colspan="4">
              <strong>Content Flags:</strong><br>
              <input type="text" name="content_flags" size="80" value="<?=$content_flags?>">
            </td>
          </tr>
          <tr>
            <td colspan="4">
              <strong>Content Flags Disabled:</strong><br>
              <input type="text" name="content_flags_disabled" size="80" value="<?=$content_flags_disabled?>">
            </td>
          </tr>
        </table><br><br>
        <center>
          <input type="hidden" name="id" value="<?=$id?>">
          <input type="hidden" name="npc_spells_id" value="<?=$npc_spells_id?>">
          <input type="submit" name="submit" value="Update Spell">&nbsp;
          <input type="button" value="Cancel" onClick="history.back();">
        </center>
      </form>
    </div>
  </div>
