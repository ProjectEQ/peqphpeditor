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
           </tr>
        </table>
      </div>