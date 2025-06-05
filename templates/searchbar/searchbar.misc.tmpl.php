      <div id="searchbar">
        <table width="100%">
          <tr>
            <td>
              <strong>1.</strong>
              <select OnChange="gotosite(this.options[this.selectedIndex].value)">
                <option value="">Select a Zone</option>
<?php foreach ($zonelist as $zone): ?>
<?php 
if ($zone['expansion'] <= $expansion_limit):
?>
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
             </td>
            <td align="right"> or <strong>&nbsp;2.</strong> By ItemID:
              <form action="index.php" method="GET">
                <input type="hidden" name="editor" value="misc">
                <input type="hidden" name="action" value="25">
                <input type="text" name="fishid" size="12" value="Fishing" onFocus="clearField(document.forms[0].fishid);document.forms[0].forageid.value='Forage';document.forms[0].gspawnid.value='GroundSpawn';"> or <input type="text" name="forageid" size="12" value="Forage" onFocus="clearField(document.forms[0].forageid);document.forms[0].fishid.value='Fishing';document.forms[0].gspawnid.value='GroundSpawn';"> or <input type="text" name="gspawnid" size="12" value="GroundSpawn" onFocus="clearField(document.forms[0].gspawnid);document.forms[0].fishid.value='Fishing';document.forms[0].forageid.value='Forage';">
                <input type="submit" value=" GO ">
              </form>
            </td>
          </tr>
        </table>
      </div>
