  <center>
    <iframe id='searchframe' src='templates/iframes/spellsearch.php'></iframe>
    <input id="button" type="button" value='Hide Spell Search' onclick='hideSearch();' style='display:none; margin-bottom: 20px;'>
  </center>
  <div class="table_container" style="width: 700px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td>Edit Mercenary Buff</td>
        </tr>
      </table>
    </div>
    <div class="table_content">
      <form name="edit_mercenary_buff" method="post" action="index.php?editor=mercs&MercId=<?=$buff['MercId']?>&action=83">
        <table width="100%" cellpadding="5" cellspacing="5">
          <tr>
            <td>
              <strong>ID:</strong><br>
              <input type="text" size="10" value="<?=$buff['MercBuffId']?>" disabled>
            </td>
            <td>
              <strong>Merc ID:</strong><br>
              <input type="text" size="10" value="<?=$buff['MercId']?>" disabled>
            </td>
            <td>
              <strong>Spell ID:</strong> (<a href="javascript:showSearch();">search</a>)<br>
              <input type="text" id="id" name="SpellId" size="10" value="<?=$buff['SpellId']?>">
            </td>
            <td>
              <strong>Caster Level:</strong><br>
              <input type="text" name="CasterLevel" size="10" value="<?=$buff['CasterLevel']?>">
            </td>
            <td>
              <strong>Duration Formula:</strong><br>
              <input type="text" name="DurationFormula" size="10" value="<?=$buff['DurationFormula']?>">
            </td>
          </tr>
          <tr>
            <td>
              <strong>Tics Remaining:</strong><br>
              <input type="text" name="TicsRemaining" size="10" value="<?=$buff['TicsRemaining']?>">
            </td>
            <td>
              <strong>Poison Counters:</strong><br>
              <input type="text" name="PoisonCounters" size="10" value="<?=$buff['PoisonCounters']?>">
            </td>
            <td>
              <strong>Disease Counters:</strong><br>
              <input type="text" name="DiseaseCounters" size="10" value="<?=$buff['DiseaseCounters']?>">
            </td>
            <td>
              <strong>Curse Counters:</strong><br>
              <input type="text" name="CurseCounters" size="10" value="<?=$buff['CurseCounters']?>">
            </td>
            <td>
              <strong>Corrup Counters:</strong><br>
              <input type="text" name="CorruptionCounters" size="10" value="<?=$buff['CorruptionCounters']?>">
            </td>
          </tr>
          <tr>
            <td>
              <strong>Hit Count:</strong><br>
              <input type="text" name="HitCount" size="10" value="<?=$buff['HitCount']?>">
            </td>
            <td>
              <strong>Melee Rune:</strong><br>
              <input type="text" name="MeleeRune" size="10" value="<?=$buff['MeleeRune']?>">
            </td>
            <td>
              <strong>Magic Rune:</strong><br>
              <input type="text" name="MagicRune" size="10" value="<?=$buff['MagicRune']?>">
            </td>
            <td>
              <strong>DoT Rune:</strong><br>
              <input type="text" name="dot_rune" size="10" value="<?=$buff['dot_rune']?>">
            </td>
            <td>
              <strong>Persistent:</strong><br>
              <select name="Persistent">
                <option value="0"<?echo ($buff['Persistent'] == 0) ? " selected" : "";?>>No (0)</option>
                <option value="1"<?echo ($buff['Persistent'] == 1) ? " selected" : "";?>>Yes (1)</option>
              </select>
            </td>
          </tr>
          <tr>
            <td>
              <strong>Cast-on X:</strong><br>
              <input type="text" name="caston_x" size="10" value="<?=$buff['caston_x']?>">
            </td>
            <td>
              <strong>Cast-on Y:</strong><br>
              <input type="text" name="caston_y" size="10" value="<?=$buff['caston_y']?>">
            </td>
            <td>
              <strong>Cast-on Z:</strong><br>
              <input type="text" name="caston_z" size="10" value="<?=$buff['caston_z']?>">
            </td>
            <td>
              <strong>Extra DI Chance:</strong><br>
              <input type="text" name="ExtraDIChance" size="10" value="<?=$buff['ExtraDIChance']?>">
            </td>
            <td>&nbsp;</td>
          </tr>
        </table><br>
        <center>
          <input type="hidden" name="MercId" value="<?=$buff['MercId']?>">
          <input type="hidden" name="MercBuffId" value="<?=$buff['MercBuffId']?>">
          <input type="submit" value="Update Buff">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back()">
        </center>
      </form>
    </div>
  </div>
