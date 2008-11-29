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
                <option value="">Select an NPC</option>
<?php foreach ($npcs as $npc): ?>
                <option value="index.php?editor=<?=$curreditor?>&z=<?=$currzone?>&npcid=<?=$npc['id']?>"<?php if ($currnpc == $npc['id']): ?> selected<?php endif;?>><?=$npc['name']?></option>
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
      </div>
