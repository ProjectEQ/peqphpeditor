  <center>
    <iframe id='searchframe' src='templates/iframes/spellsearch.php'></iframe>
    <input id="button" type="button" value='Hide Spell Search' onclick='hideSearch();' style='display:none; margin-bottom: 20px;'>
  </center>
  <div class="table_container" style="width: 700px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td>Create Mercenary Buff</td>
        </tr>
      </table>
    </div>
    <div class="table_content">
      <form name="add_mercenary_buff" method="post" action="index.php?editor=mercs&MercId=<?=$MercId?>&action=81">
        <table width="100%" cellpadding="5" cellspacing="5">
          <tr>
            <td>
              <strong>ID:</strong><br>
              <input type="text" name="MercBuffId" size="10" value="<?=$suggest_id?>">
            </td>
            <td>
              <strong>Merc ID:</strong><br>
              <input type="text" size="10" value="<?=$MercId?>" disabled>
            </td>
            <td>
              <strong>Spell ID:</strong> (<a href="javascript:showSearch();">search</a>)<br>
              <input type="text" id="id" name="SpellId" size="10" value="0">
            </td>
            <td>
              <strong>Caster Level:</strong><br>
              <input type="text" name="CasterLevel" size="10" value="0">
            </td>
            <td>
              <strong>Duration Formula:</strong><br>
              <input type="text" name="DurationFormula" size="10" value="0">
            </td>
          </tr>
          <tr>
            <td>
              <strong>Tics Remaining:</strong><br>
              <input type="text" name="TicsRemaining" size="10" value="0">
            </td>
            <td>
              <strong>Poison Counters:</strong><br>
              <input type="text" name="PoisonCounters" size="10" value="0">
            </td>
            <td>
              <strong>Disease Counters:</strong><br>
              <input type="text" name="DiseaseCounters" size="10" value="0">
            </td>
            <td>
              <strong>Curse Counters:</strong><br>
              <input type="text" name="CurseCounters" size="10" value="0">
            </td>
            <td>
              <strong>Corrup Counters:</strong><br>
              <input type="text" name="CorruptionCounters" size="10" value="0">
            </td>
          </tr>
          <tr>
            <td>
              <strong>Hit Count:</strong><br>
              <input type="text" name="HitCount" size="10" value="0">
            </td>
            <td>
              <strong>Melee Rune:</strong><br>
              <input type="text" name="MeleeRune" size="10" value="0">
            </td>
            <td>
              <strong>Magic Rune:</strong><br>
              <input type="text" name="MagicRune" size="10" value="0">
            </td>
            <td>
              <strong>DoT Rune:</strong><br>
              <input type="text" name="dot_rune" size="10" value="0">
            </td>
            <td>
              <strong>Persistent:</strong><br>
              <select name="Persistent">
                <option value="0">No (0)</option>
                <option value="1">Yes (1)</option>
              </select>
            </td>
          </tr>
          <tr>
            <td>
              <strong>Cast-on X:</strong><br>
              <input type="text" name="caston_x" size="10" value="0">
            </td>
            <td>
              <strong>Cast-on Y:</strong><br>
              <input type="text" name="caston_y" size="10" value="0">
            </td>
            <td>
              <strong>Cast-on Z:</strong><br>
              <input type="text" name="caston_z" size="10" value="0">
            </td>
            <td>
              <strong>Extra DI Chance:</strong><br>
              <input type="text" name="ExtraDIChance" size="10" value="0">
            </td>
            <td>&nbsp;</td>
          </tr>
        </table><br>
        <center>
          <input type="hidden" name="MercId" value="<?=$MercId?>">
          <input type="submit" value="Insert Buff">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back()">
        </center>
      </form>
    </div>
  </div>
