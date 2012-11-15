      <div id="searchbar">
        <table width="100%">
          <tr>
            <td>
              <strong>1.</strong>
              <select OnChange="gotosite(this.options[this.selectedIndex].value)">
                <option value="">Select a Guild</option>
<?
  if ($guilds) {
    foreach ($guilds as $guild): extract($guild);
?>
                <option value="index.php?editor=<?=$curreditor?>&guildid=<?=$guild['id']?>"<?php if ($currguild == $guild['id']): ?> selected<?php endif;?>><?=$guild['name']?></option>
<?
    endforeach;
  }
  else {
?>
                <option value="index.php?editor=<?=$curreditor?>">No Guilds</option>
<?
  }
?>
              </select>
            </td>
            <td> or <strong>&nbsp;2.</strong>
              <form action="index.php" method="GET">
                <input type="hidden" name="editor" value="guild">
                <input type="hidden" name="action" value="2">
                <input type="text" name="guild_id" size="5" value="Guild ID" onFocus="clearField(document.forms[0].guild_id);document.forms[0].search.value='Guild Name';document.forms[1].charid.value='Char ID';document.forms[1].charname.value='Character Name';"> or <input type="text" name="search" size="12" value="Guild Name" onFocus="clearField(document.forms[0].search);document.forms[0].guild_id.value='Guild ID';document.forms[1].charid.value='Char ID';document.forms[1].charname.value='Character Name';">
                <input type="submit" value=" GO ">
              </form>
            </td>
            <td> or <strong>&nbsp;3.</strong>
              <form action="index.php" method="GET">
                <input type="hidden" name="editor" value="guild">
                <input type="hidden" name="action" value="3">
                <input type="text" name="charid" size="5" value="Char ID" onFocus="clearField(document.forms[1].charid);document.forms[1].charname.value='Character Name';document.forms[0].guild_id.value='Guild ID';document.forms[0].search.value='Guild Name';"> or <input type="text" name="charname" size="13" value="Character Name" onFocus="clearField(document.forms[1].charname);document.forms[1].charid.value='Char ID';document.forms[0].guild_id.value='Guild ID';document.forms[0].search.value='Guild Name';">
                <input type="submit" value=" GO ">
              </form>
            </td>
          </tr>
        </table>
      </div>
