  <div id="searchbar">
    <table width="100%">
      <tr>
        <td>
          <strong>1.</strong>
          <select OnChange="gotosite(this.options[this.selectedIndex].value)">
            <option value="">Select an AA</option>
<? foreach ($aas as $aa): extract($aa); ?>
            <option value="index.php?editor=<?=$curreditor?>&aaid=<?=$aa['id']?>"<?echo (isset($_GET['aaid']) && $_GET['aaid'] == $aa['id']) ? " selected" : "";?>><?=$aa['name']?> (<?=$aa['id']?>)</option>
<? endforeach; ?>
              </select>
            </td>
            <td align="right"> or enter the <strong>&nbsp;2.</strong>
              <form action="index.php" method="GET">
                <input type="hidden" name="editor" value="aa">
                <input type="hidden" name="action" value="1">
                <input type="text" name="aaid" size="5" value="AA ID" onFocus="clearField(document.forms[0].aaid);document.forms[0].search.value='AA Name';"> or <input type="text" name="search" size="12" value="AA Name" onFocus="clearField(document.forms[0].search);document.forms[0].aaid.value='AA ID';">
                <input type="submit" value=" GO ">
              </form>
            </td>
          </tr>
        </table>
        <table width="100%">
          <tr>
          <td align="left">&nbsp;or <strong>&nbsp;3.</strong> Search by
            <form action="index.php" method="GET">
              <input type="hidden" name="editor" value="aa">
              <input type="hidden" name="action" value="2">
              <input type="text" name="spa" size="5" value="SPA ID" onfocus="clearField(document.forms[1].spa);">&nbsp;
              <input type="submit" value=" GO ">
            </form>
          </td>
          <td align="right"> or <strong>&nbsp;4.</strong> Limit by
            <form action="index.php" method="GET">
              <input type="hidden" name="editor" value="aa">
              <input type="hidden" name="action" value="3">
              <select name="exp">
                <option value="-1">All Expansions</option>
              <? for ($i=0; isset($eqexpansions[$i+1]); $i++) {?>
                <option value="<?=$i?>"<?echo (isset($_GET['exp']) && ($_GET['exp'] == $i)) ? " selected" : ""?>><?=$eqexpansions[$i+1]?> (<?=$i?>)</option>
              <? } ?>
              </select>
              <select name="cls">
                <option value="-1"<?echo (isset($_GET['cls']) && $_GET['cls'] == -1) ? " selected" : ""?>>All Classes</option>
                <option value="8"<?echo (isset($_GET['cls']) && $_GET['cls'] == 8) ? " selected" : ""?>>Bard (8)</option>
                <option value="15"<?echo (isset($_GET['cls']) && $_GET['cls'] == 15) ? " selected" : ""?>>Beastlord (15)</option>
                <option value="16"<?echo (isset($_GET['cls']) && $_GET['cls'] == 16) ? " selected" : ""?>>Berserker (16)</option>
                <option value="2"<?echo (isset($_GET['cls']) && $_GET['cls'] == 2) ? " selected" : ""?>>Cleric (2)</option>
                <option value="6"<?echo (isset($_GET['cls']) && $_GET['cls'] == 6) ? " selected" : ""?>>Druid (6)</option>
                <option value="14"<?echo (isset($_GET['cls']) && $_GET['cls'] == 14) ? " selected" : ""?>>Enchanter (14)</option>
                <option value="11"<?echo (isset($_GET['cls']) && $_GET['cls'] == 11) ? " selected" : ""?>>Necromancer (11)</option>
                <option value="13"<?echo (isset($_GET['cls']) && $_GET['cls'] == 13) ? " selected" : ""?>>Magician (13)</option>
                <option value="7"<?echo (isset($_GET['cls']) && $_GET['cls'] == 7) ? " selected" : ""?>>Monk (7)</option>
                <option value="3"<?echo (isset($_GET['cls']) && $_GET['cls'] == 3) ? " selected" : ""?>>Paladin (3)</option>
                <option value="4"<?echo (isset($_GET['cls']) && $_GET['cls'] == 4) ? " selected" : ""?>>Ranger (4)</option>
                <option value="9"<?echo (isset($_GET['cls']) && $_GET['cls'] == 9) ? " selected" : ""?>>Rogue (9)</option>
                <option value="5"<?echo (isset($_GET['cls']) && $_GET['cls'] == 5) ? " selected" : ""?>>Shadowknight (5)</option>
                <option value="10"<?echo (isset($_GET['cls']) && $_GET['cls'] == 10) ? " selected" : ""?>>Shaman (10)</option>
                <option value="1"<?echo (isset($_GET['cls']) && $_GET['cls'] == 1) ? " selected" : ""?>>Warrior (1)</option>
                <option value="12"<?echo (isset($_GET['cls']) && $_GET['cls'] == 12) ? " selected" : ""?>>Wizard (12)</option>
              </select>
              <input type="submit" value=" GO ">
            </form>
          </tr>
        </table>
      </div>
