      <div id="searchbar">
        <table width=100%>
          <tr>
            <td>
              <strong>1.</strong>
              <select OnChange="gotosite(this.options[this.selectedIndex].value)">
                <option value="">Select a Player</option>
<?php foreach ($players as $player): extract($player);?>
                <option value="index.php?editor=<?=$curreditor?>&playerid=<?=$player['id']?>"<?php if ($currplayer == $player['id']): ?> selected<?php endif;?>><?=$player['name']?></option>
<?php endforeach;?>
              </select>
            </td>
            <td align="right"> or <strong>&nbsp;2.</strong>
              <form action="index.php" method="GET">
                <input type="hidden" name="editor" value="player">
                <input type="hidden" name="action" value="2">
                <input type="text" name="playerid" size="5" value="ID" onFocus="clearField(document.forms[0].playerid);"> or <input type="text" name="search" size="12" value="Player Name" onFocus="clearField(document.forms[0].search);">
                <input type="submit" value=" GO ">
              </form>
            </td>
          </tr>
        </table>
      </div>
