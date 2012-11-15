      <div id="searchbar">
        <table width="100%">
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
              <td align="right"> or <strong>2.</strong>
              <form action="index.php" method="GET">
                <input type="hidden" name="editor" value="tasks">
                <input type="hidden" name="action" value="34">
                <input type="text" name="search" size="22" value="Task Name" onFocus="clearField(document.forms[0].search);">
                <input type="submit" value=" GO ">
              </form>
            </td>
           </tr>
        </table>
      </div>