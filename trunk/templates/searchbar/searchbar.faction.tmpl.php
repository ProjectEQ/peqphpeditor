      <div id="searchbar">
        <table width=100%>
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
              <form action="index.php" method="GET">
                <input type="hidden" name="editor" value="faction">
                <input type="hidden" name="action" value="3">
                <input type="text" name="search" size="20" value="Faction Name" onFocus="clearField(document.forms[0].search);">
                <input type="submit" value=" GO ">
              </form>
            </td>
          </tr>
        </table>
      </div>
