      <div id="searchbar">
        <table width=100%>
          <tr>
            <td>
              <strong>1.</strong>
              <select OnChange="gotosite(this.options[this.selectedIndex].value)">
                <option value="">Select a Zone</option>
<?php foreach ($zones as $zone): ?>
                <option value="index.php?editor=<?=$curreditor?>&z=<?=$zone?>"<?php if ($currzone == $zone): ?> selected<?php endif;?>><?=$zone?></option>
<?php endforeach;?>
              </select>
             </td>
            <td align="right"> or <strong>&nbsp;2.</strong> By ItemID:
              <form action="index.php" method="GET">
                <input type="hidden" name="editor" value="misc">
                <input type="hidden" name="action" value="25">
                <input type="text" name="fishid" size="12" value="Fishing" onFocus="clearField(document.forms[0].fishid);"> or <input type="text" name="forageid" size="12" value="Forage" onFocus="clearField(document.forms[0].forageid);"> or <input type="text" name="gspawnid" size="12" value="GroundSpawn" onFocus="clearField(document.forms[0].gspawnid);">

                <input type="submit" value=" GO ">
              </form>
            </td>
          </tr>
        </table>
      </div>
