      <div id="searchbar">
        <table width=100%>
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
      </div>
