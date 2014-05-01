      <div id="searchbar">
        <table width="100%">
          <tr>
            <td><strong>&nbsp;1.</strong> Search by 
              <form action="index.php" method="GET">
                <input type="hidden" name="editor" value="inv">
                <input type="hidden" name="action" value="2">
                <input type="text" name="playerid" size="5" value="Player ID" onFocus="clearField(document.forms[0].playerid);document.forms[0].player_name.value='Player Name';document.forms[1].item_id.value='Item ID';"> or <input type="text" name="player_name" size="13" value="Player Name" onFocus="clearField(document.forms[0].player_name);document.forms[0].playerid.value='Player ID';document.forms[1].item_id.value='Item ID';">
                <input type="submit" value=" GO ">
              </form>
            </td>
            <td> or <strong>&nbsp;2.</strong> Search by 
              <form action="index.php" method="GET">
                <input type="hidden" name="editor" value="inv">
                <input type="hidden" name="action" value="3">
                <input type="text" name="item_id" size="5" value="Item ID" onFocus="clearField(document.forms[1].item_id);document.forms[0].playerid.value='Player ID';document.forms[0].player_name.value='Player Name';">
                <input type="submit" value=" GO ">
              </form>
            </td>
          </tr>
        </table>
      </div>
