      <div id="searchbar">
        <table width="100%">
          <tr>
            <td>
              <strong>1.</strong>
              <select OnChange="gotosite(this.options[this.selectedIndex].value)">
                <option value="">Select a Zone</option>
<?php foreach ($zonelist as $zone): ?>
<?php if ($zone['expansion'] <= $expansion_limit): ?>
                <option value="index.php?editor=<?=$curreditor?>&z=<?=$zone['short_name']?>&zoneid=<?=$zone['id']?>"<?php if ($currzoneid == $zone['id']): ?> selected<?php endif;?>><?=$zone['short_name']?> (<?=$zone['version']?>)</option>
<?php endif;?>
<?php endforeach;?>
              </select>
              &nbsp; and &nbsp;
              <select OnChange="gotosite(this.options[this.selectedIndex].value)">
                <option value="">Select an NPC</option>
<?php foreach ($npcs as $npc): ?>
                <option value="index.php?editor=<?=$curreditor?>&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npc['id']?>"<?php if ($currnpc == $npc['id']): ?> selected<?php endif;?>><?=$npc['name']?></option>
<?php endforeach;?>
              </select>
            </td>
            <td align="right"> or <strong>&nbsp;2.</strong>
              <select OnChange="gotosite(this.options[this.selectedIndex].value)">
                <option value="">Select a Spellset</option>
<?php foreach ($spellsets as $spellset): extract($spellset); ?>
                <option value="index.php?editor=<?=$curreditor?>&spellset=<?=$id?>"<? echo ($currspellset == $id) ? " selected" : "";?>><?=$id?>: <?=$name?></option>
<?php endforeach;?>
              </select>
            </td>
           </tr>
          </table>
           <br>
           <table width="100%">
            <tr>
            <td align="right"> or  <strong>&nbsp;3.</strong> Search by
              <form action="index.php" method="GET">
                <input type="hidden" name="editor" value="spellset">
                <input type="hidden" name="action" value="15">
                <input type="text" name="search" size="22" value="Spell Name" onFocus="clearField(document.forms[0].search);">
                <input type="submit" value=" GO ">
              </form>
            </td>
           </tr>
        </table>
      </div>
