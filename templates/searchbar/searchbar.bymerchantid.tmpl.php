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
              &nbsp; and &nbsp;
              <select OnChange="gotosite(this.options[this.selectedIndex].value)">
                <option value="">Select a Merchant</option>
<?php foreach ($npcs as $npc): ?>
                <option value="index.php?editor=<?=$curreditor?>&z=<?=$currzone?>&npcid=<?=$npc['id']?>"<?php if ($currnpc == $npc['id']): ?> selected<?php endif;?>><?=$npc['name']?></option>
<?php endforeach;?>
              </select>
            </td>
            <td align="right"> or <strong>&nbsp;2.</strong>
              <form action="index.php" method="GET">
                <input type="hidden" name="editor" value="merchant">
                <input type="hidden" name="action" value="7">
                <input type="text" name="npcid" size="5" value="ID" onFocus="clearField(document.forms[0].npcid);"> or <input type="text" name="search" size="12" value="Enter Item ID" onFocus="clearField(document.forms[0].search);">                
                <input type="submit" value=" Search ">
              </select>
            </td>
           </tr>
          </table>
           <br>
           <table width=100%>
            <tr>
            <td align="right"> or  <strong>&nbsp;3.</strong> Temp Merchant
              <form action="index.php" method="GET">
                <input type="hidden" name="editor" value="merchant">
                <input type="hidden" name="action" value="7">
                <input type="text" name="search1" size="12" value="Item ID" onFocus="clearField(document.forms[0].search1);">
                <input type="submit" value=" GO ">
              </form>
            </td>
          </tr>
        </table>
      </div>
