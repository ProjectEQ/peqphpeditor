      <div id="searchbar">
        <table width="100%">
          <tr>
            <td align="left">
              <strong>1.</strong>
              &nbsp;<select OnChange="gotosite(this.options[this.selectedIndex].value)">
                <option value="">Select a Faction</option>
<?php foreach ($factions as $faction): extract($faction);?>
                <option value="index.php?editor=<?=$curreditor?>&fid=<?=$id?>"<?php if ($currfaction == $id): ?> selected<?php endif;?>><?=$name?></option>
<?php endforeach;?>
              </select>
            </td>
            <td align="right"> or <strong>&nbsp;2.</strong> Search by 
              <form action="index.php?editor=faction&action=3" method="POST">
                <input type="text" name="faction_name" size="20" value="Faction Name" onFocus="clearField(document.forms[0].faction_name); document.forms[0].faction_id.value = 'ID';"> or by
                <input type="text" name="faction_id" size="3" value="ID" onFocus="clearField(document.forms[0].faction_id); document.forms[0].faction_name.value = 'Faction Name';">
                <input type="submit" value=" GO ">
              </form>
            </td>
          </tr>
        </table>
      </div>
