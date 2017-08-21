  <div id="searchbar">
    <table width="100%">
      <tr>
        <td>
          <strong>1.</strong> Search by
          <form action="index.php" method="GET">
            <input type="hidden" name="editor" value="pvp">
            <input type="hidden" name="action" value="5">
            <input type="text" name="name" size="22" value="Player Name" onFocus="clearField(document.forms[0].name);document.forms[0].playerid.value='Player ID';">
            or by <input type="text" name="playerid" size="8" value="Player ID" onFocus="clearField(document.forms[0].playerid);document.forms[0].name.value='Player Name';">
            <input type="submit" value=" GO ">
          </form>
        </td>
      </tr>
    </table>
  </div>
