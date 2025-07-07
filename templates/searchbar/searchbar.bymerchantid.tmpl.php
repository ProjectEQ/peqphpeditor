  <div id="searchbar">
    <table width="100%">
      <tr>
        <td>
          <strong>1.</strong>
          <select OnChange="gotosite(this.options[this.selectedIndex].value)">
            <option value="">Select a Zone</option>
<?php foreach ($zonelist as $zone): ?>
<?php if ($zone['expansion'] <= $expansion_limit): ?>
            <option value="index.php?editor=<?=$curreditor?>&z=<?=$zone['short_name']?>&zoneid=<?=$zone['id']?>"<?php if ($currzoneid == $zone['id'] || $currzone == $zone['short_name']): ?> selected<?php endif;?>>
              <?=$zone['short_name']?>
            </option>
<?php endif;?>
<?php endforeach;?>
          </select>
              <?php 
              if (isset($currzoneid) && !empty($currzoneid) && isset($currentversion) && !empty($currentversion) && count($currentversion) >= 1):
                echo '<select style="width: 75px;" OnChange="gotosite(this.options[this.selectedIndex].value)">';
                $v_sel = null;
                foreach ($currentversion as $k => $v):
                  $v_sel = ($currzoneid == $v['id']) ? " selected" : "";
                  $opturl = 'index.php?editor='. $curreditor . '&z=' . $currzone . '&zoneid=' . $v['id'];
                  echo '<option value="' . $opturl . '"' . $v_sel . '>v' . $v['version'] . '</option>';
                endforeach;
                echo '</select>';
              endif;
              ?>
          &nbsp; and &nbsp;
          <select OnChange="gotosite(this.options[this.selectedIndex].value)">
            <option value="">Select a Merchant</option>
<?
  if ($npcs) {
    foreach ($npcs as $npc):
?>
            <option value="index.php?editor=<?=$curreditor?>&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npc['id']?>"<?php if ($currnpc == $npc['id']): ?> selected<?php endif;?>><?=$npc['name']?></option>
<?
    endforeach;
  }
  else {
?>
            <option value="index.php?editor=<?=$curreditor?>">No NPCs</option>
<?
  }
?>
          </select>
        </td>
        <td align="right"> or <strong>&nbsp;2.</strong>
          <form action="index.php" method="GET">
            <input type="hidden" name="editor" value="merchant">
            <input type="hidden" name="action" value="7">
            <input type="text" name="npc_id" size="5" value="ID" onFocus="clearField(document.forms[0].npc_id);document.forms[0].search.value='Enter Item ID';document.forms[1].search1.value='Item ID';"> or <input type="text" name="search" size="12" value="Enter Item ID" onFocus="clearField(document.forms[0].search);document.forms[0].npc_id.value='ID';document.forms[1].search1.value='Item ID';">                
            <input type="submit" value=" Search ">
          </form>
        </td>
      </tr>
    </table><br>
    <table width="100%">
      <tr>
        <td align="right"> or  <strong>&nbsp;3.</strong> Temp Merchant
          <form action="index.php" method="GET">
            <input type="hidden" name="editor" value="merchant">
            <input type="hidden" name="action" value="7">
            <input type="text" name="search1" size="12" value="Item ID" onFocus="clearField(document.forms[1].search1);document.forms[0].npc_id.value='ID';document.forms[0].search.value='Enter Item ID';">
            <input type="submit" value=" GO ">
          </form>
        </td>
      </tr>
    </table>
  </div>
