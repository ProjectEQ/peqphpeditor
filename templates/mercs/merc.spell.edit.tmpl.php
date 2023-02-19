  <center>
    <iframe id='searchframe' src='templates/iframes/spellsearch.php'></iframe>
    <input id="button" type="button" value='Hide Spell Search' onclick='hideSearch();' style='display:none; margin-bottom: 20px;'>
  </center>
  <div class="table_container" style="width: 750px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td>Edit Mercenary Spell</td>
        </tr>
      </table>
    </div>
    <div class="table_content">
      <form name="edit_mercenary_spell" method="post" action="index.php?editor=mercs&action=47">
        <table width="100%" cellpadding="5" cellspacing="5">
          <tr>
            <td>
              <strong>List ID:</strong><br>
              <input type="text" size="10" value="<?=$spell['merc_spell_list_id']?>" disabled>
            </td>
            <td>
              <strong>Entry ID:</strong><br>
              <input type="text" size="10" value="<?=$spell['merc_spell_list_entry_id']?>" disabled>
            </td>
            <td>
              <strong>Spell ID:</strong> (<a href="javascript:showSearch();">search</a>)<br>
              <input type="text" id="id" name="spell_id" size="10" value="<?=$spell['spell_id']?>">
            </td>
            <td>
              <strong>Spell Type:</strong><br>
              <select name="spell_type">
                <option value="0"<?echo ($spell['spell_type'] == 0) ? " selected" : "";?>>Never (0)</option>
<?foreach ($spelltypes as $k=>$v):?>
                <option value="<?=$k?>"<?echo ($spell['spell_type'] == $k) ? " selected" : "";?>><?=$v?> (<?=$k?>)</option>
<?endforeach;?>
              </select>
            </td>
          </tr>
          <tr>
            <td>
              <strong>Min Level:</strong><br>
              <input type="text" name="minlevel" size="10" value="<?=$spell['minlevel']?>">
            </td>
            <td>
              <strong>Max Level:</strong><br>
              <input type="text" name="maxlevel" size="10" value="<?=$spell['maxlevel']?>">
            </td>
            <td>
              <strong>Slot:</strong><br>
              <input type="text" name="slot" size="10" value="<?=$spell['slot']?>">
            </td>
            <td>
              <strong>Stance:</strong> <img src="images/info.gif" width="13" height="13" border="0" title="0 = all, + = only this stance, - = all except this stance"></a><br>
              <select name="stance_id">
<?foreach ($stances as $k=>$v):?>
                <option value="<?=$k?>"<?echo ($spell['stance_id'] == $k) ? " selected" : "";?>><?=$v?> (<?=$k?>)</option>
<?endforeach;?>
              </select>
            </td>
          </tr>
          <tr>
            <td>
              <strong>Proc Chance:</strong><br>
              <input type="text" name="procChance" size="10" value="<?=$spell['procChance']?>">
            </td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table><br>
        <center>
          <input type="hidden" name="merc_spell_list_id" value="<?=$spell['merc_spell_list_id']?>">
          <input type="hidden" name="merc_spell_list_entry_id" value="<?=$spell['merc_spell_list_entry_id']?>">
          <input type="submit" value="Update Spell">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back()">
        </center>
      </form>
    </div>
  </div>
