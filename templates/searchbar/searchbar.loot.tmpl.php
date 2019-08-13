  <div id="searchbar">
    <table width="100%">
      <tr>
        <td>
          <strong>1.</strong>
          <select OnChange="gotosite(this.options[this.selectedIndex].value)">
            <option value="">Select a Zone</option>
<? foreach ($zonelist as $zone): ?>
<? if ($zone['expansion'] <= $expansion_limit): ?>
            <option value="index.php?editor=<?=$curreditor?>&z=<?=$zone['short_name']?>&zoneid=<?=$zone['id']?>"<?echo ($currzoneid == $zone['id']) ? " selected" : "";?>><?=$zone['short_name']?> (<?=$zone['version']?>)</option>
<? endif;?>
<? endforeach;?>
          </select>
          &nbsp; and &nbsp;
          <select OnChange="gotosite(this.options[this.selectedIndex].value)">
            <option value="">Select an NPC</option>
<? foreach ($npcs as $npc): ?>
            <option value="index.php?editor=<?=$curreditor?>&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npc['id']?>"<?echo ($currnpc == $npc['id']) ? " selected" : "";?>><?=$npc['name']?></option>
<? endforeach;?>
          </select>
        </td>
        <td align="right"> or <strong>&nbsp;2.</strong>
          <form action="index.php" method="GET">
            <input type="hidden" name="editor" value="loot">
            <input type="hidden" name="action" value="0">
            <input type="hidden" name="z" value="<?=$currzone?>">
            <input type="hidden" name="zoneid" value="<?=$currzoneid?>">
            <input type="text" name="npcid" size="5" value="NPCID" onFocus="clearField(document.forms[0].npcid);document.forms[1].search.value='Enter Item ID';">
            <input type="submit" value=" GO ">
          </form>
        </td>
        <td align="right"> or <strong>&nbsp;3.</strong>
          <form action="index.php" method="GET">
            <input type="hidden" name="editor" value="loot">
            <input type="hidden" name="action" value="32">
            <input type="text" name="search" size="12" value="Enter Item ID" onFocus="clearField(document.forms[1].search);document.forms[0].npcid.value='NPCID';">
            <input type="submit" value=" GO ">
          </form>
        </td>
      </tr>
    </table>
  </div>
