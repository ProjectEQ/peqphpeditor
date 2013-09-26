      <div id="searchbar">
        <table width="100%">
          <tr>
            <td>
              <strong>1.</strong>
              <select OnChange="gotosite(this.options[this.selectedIndex].value)">
                <option value="">Select an AA</option>
<?php foreach ($aas as $aa): extract($aa);?>
                <option value="index.php?editor=<?=$curreditor?>&aaid=<?=$aa['skill_id']?>"<?php if ($curraa == $aa['skill_id']): ?> selected<?php endif;?>><?=$aa['name']?></option>
<?php endforeach;?>
              </select>
            </td>
            <td align="right"> or <strong>&nbsp;2.</strong>
              <form action="index.php" method="GET">
                <input type="hidden" name="editor" value="aa">
                <input type="hidden" name="action" value="1">
                <input type="text" name="aaid" size="5" value="ID" onFocus="clearField(document.forms[0].aaid);document.forms[0].search.value='AA Name';"> or <input type="text" name="search" size="12" value="AA Name" onFocus="clearField(document.forms[0].search);document.forms[0].aaid.value='ID';">
                <input type="submit" value=" GO ">
              </form>
            </td>
          </tr>
        </table>
        <table width="100%">
          <tr>
          <td align="right"> or <strong>&nbsp;3.</strong> Limit by
            <form action="index.php" method="GET">
              <input type="hidden" name="editor" value="aa">
              <input type="hidden" name="action" value="28">
              <select name="exp">
                <option value="-1">All Expansions</option>
              <? for ($i=0; isset($eqexpansions[$i+1]); $i++) {?>
                <option value="<?=$i?>"><?=$eqexpansions[$i+1]?></option>
              <? } ?>
              </select>
              <select name="cls">
                <option value="-1">All Classes</option>
                <option value="8">Bard</option>
                <option value="15">Beastlord</option>
                <option value="16">Berserker</option>
                <option value="2">Cleric</option>
                <option value="6">Druid</option>
                <option value="14">Enchanter</option>
                <option value="11">Necromancer</option>
                <option value="13">Magician</option>
                <option value="7">Monk</option>
                <option value="3">Paladin</option>
                <option value="4">Ranger</option>
                <option value="9">Rogue</option>
                <option value="5">Shadowknight</option>
                <option value="10">Shaman</option>
                <option value="1">Warrior</option>
                <option value="12">Wizard</option>
              </select>
              <input type="submit" value=" GO ">
            </form>
          </tr>
        </table>
      </div>
