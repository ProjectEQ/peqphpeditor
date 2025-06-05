      <div id="searchbar">
        <table width="100%">
          <tr>
            <td>
              <strong>1.</strong>
              <select OnChange="gotosite(this.options[this.selectedIndex].value)">
                <option value="">Select a Zone Shortname</option>
<?php 
foreach ($zonelist as $zone):
  if ($zone['expansion'] <= $expansion_limit): 
?>
                <option value="index.php?editor=<?=$curreditor?>&z=<?=$zone['short_name']?>&zoneid=<?=$zone['id']?>"<?echo ($currzoneid == $zone['id'] || $currzone == $zone['short_name']) ? " selected" : "";?>>
                  <?=$zone['short_name']?> <?php echo '[' . count($all_zone_versions[$zone['short_name']]) . ' Versions]'; ?>
                </option>
<?php 
  endif;
endforeach;
?>
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
            <td>or <strong>&nbsp;2.</strong>
              <select OnChange="gotosite(this.options[this.selectedIndex].value)">
                <option value="">Select a Zone Longname</option>
<?php foreach ($zonelist2 as $zone): ?>
<?php if ($zone['expansion'] <= $expansion_limit): ?>
                <option value="index.php?editor=<?=$curreditor?>&z=<?=$zone['short_name']?>&zoneid=<?=$zone['id']?>"<?echo ($currzoneid == $zone['id']) ? " selected" : "";?>><?=$zone['long_name']?> (<?=$zone['version']?>)</option>
<?php endif;?>
<?php endforeach;?>
              </select>
            </td>
          </tr>
        </table>
      </div>
