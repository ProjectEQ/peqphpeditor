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
                  <?=$zone['short_name']?> <?php echo '[' . count($all_zone_versions[$zone['short_name']]) . ' Versions]'; ?>
                </option>
<?php endif;?>
<?php endforeach;?>
              </select>
              <?php 
              if (isset($currzoneid) && !empty($currzoneid) && isset($currentversion) && !empty($currentversion) && count($currentversion) >= 1):
                echo '<select style="width: 75px;" OnChange="gotosite(this.options[this.selectedIndex].value)">';
                echo '<option value="">Select zone version</option>';
                $v_sel = null;
                foreach ($currentversion as $k => $v):
                  $v_sel = ($currzoneid == $v['id']) ? " selected" : "";
                  $opturl = 'index.php?editor='. $curreditor . '&z=' . $currzone . '&zoneid=' . $v['id'];
                  echo '<option value="' . $opturl . '"' . $v_sel . '>' . $v['version'] . '</option>';
                endforeach;
                echo '</select>';
              endif;
              ?>
              &nbsp; and &nbsp;
              <select OnChange="gotosite(this.options[this.selectedIndex].value)">
                <option value="">Select an NPC</option>
<?php foreach ($npcs as $npc): ?>
                <option value="index.php?editor=<?=$curreditor?>&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npc['id']?>"<?php if ($currnpc == $npc['id']): ?> selected<?php endif;?>><?=$npc['name']?></option>
<?php endforeach;?>
              </select>
            </td>
            <td align="right"> or <strong>&nbsp;2.</strong>
                <form action="index.php" method="GET">
                <input type="hidden" name="editor" value="spawn">
                <input type="hidden" name="action" value="49">
                <input type="text" name="npc_id" size="5" value="ID" onFocus="clearField(document.forms[0].npc_id);document.forms[0].search.value='Enter a NPC';"> or <input type="text" name="search" size="12" value="Enter a NPC" onFocus="clearField(document.forms[0].search);document.forms[0].npc_id.value='ID';">
                <input type="submit" value=" GO ">
              </form>
            </td>
          </tr>
        </table>
      </div>
