  <div id="searchbar">
    <table width="100%">
      <tr>
        <td>
          <strong>1.</strong>
          <select OnChange="gotosite(this.options[this.selectedIndex].value)">
            <option value="">Select an AA</option>
<? foreach ($aas as $aa): extract($aa);?>
            <option value="index.php?editor=<?=$curreditor?>&aaid=<?=$aa['id']?>"<?echo (isset($_GET['aaid']) && $_GET['aaid'] == $aa['id']) ? " selected" : "";?>><?=$aa['name']?> (<?=$aa['id']?>)</option>
<? endforeach;?>
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
                <option value="<?=$i?>"<?echo (isset($_GET['exp']) && ($_GET['exp'] == $i)) ? " selected" : ""?>><?=$eqexpansions[$i+1]?></option>
              <? } ?>
              </select>
              <select name="cls">
                <option value="-1"<?echo ($_GET['cls'] == -1) ? " selected" : ""?>>All Classes</option>
                <option value="8"<?echo ($_GET['cls'] == 8) ? " selected" : ""?>>Bard</option>
                <option value="15"<?echo ($_GET['cls'] == 15) ? " selected" : ""?>>Beastlord</option>
                <option value="16"<?echo ($_GET['cls'] == 16) ? " selected" : ""?>>Berserker</option>
                <option value="2"<?echo ($_GET['cls'] == 2) ? " selected" : ""?>>Cleric</option>
                <option value="6"<?echo ($_GET['cls'] == 6) ? " selected" : ""?>>Druid</option>
                <option value="14"<?echo ($_GET['cls'] == 14) ? " selected" : ""?>>Enchanter</option>
                <option value="11"<?echo ($_GET['cls'] == 11) ? " selected" : ""?>>Necromancer</option>
                <option value="13"<?echo ($_GET['cls'] == 13) ? " selected" : ""?>>Magician</option>
                <option value="7"<?echo ($_GET['cls'] == 7) ? " selected" : ""?>>Monk</option>
                <option value="3"<?echo ($_GET['cls'] == 3) ? " selected" : ""?>>Paladin</option>
                <option value="4"<?echo ($_GET['cls'] == 4) ? " selected" : ""?>>Ranger</option>
                <option value="9"<?echo ($_GET['cls'] == 9) ? " selected" : ""?>>Rogue</option>
                <option value="5"<?echo ($_GET['cls'] == 5) ? " selected" : ""?>>Shadowknight</option>
                <option value="10"<?echo ($_GET['cls'] == 10) ? " selected" : ""?>>Shaman</option>
                <option value="1"<?echo ($_GET['cls'] == 1) ? " selected" : ""?>>Warrior</option>
                <option value="12"<?echo ($_GET['cls'] == 12) ? " selected" : ""?>>Wizard</option>
              </select>
              <input type="submit" value=" GO ">
            </form>
          </tr>
        </table>
      </div>
