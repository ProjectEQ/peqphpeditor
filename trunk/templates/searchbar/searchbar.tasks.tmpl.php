      <div id="searchbar">
        <table width=100%>
          <tr>
            <td align="left">
              <strong>1.</strong>
              &nbsp;<select OnChange="gotosite(this.options[this.selectedIndex].value)">
                <option value="">Select a Task</option>
<?php foreach ($tasks as $task): extract($task);?>
                <option value="index.php?editor=<?=$curreditor?>&tskid=<?=$id?>"<?php if ($currtask == $id): ?> selected<?php endif;?>><?=$title?></option>
<?php endforeach;?>
              </select>
            </td>
           </tr>
        </table>
      </div>