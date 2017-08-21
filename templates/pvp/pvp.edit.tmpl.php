  <div class="edit_form" style="width: 250px">
    <div class="edit_form_header">
      Edit Points for <?=getPlayerName($player)?> (<?=$player?>)
    </div>
    <div class="edit_form_content">
      <form name="pvp" method="post" action="index.php?editor=pvp&playerid=<?=$player?>&action=4">
        <table width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td align="center">
              <strong>PVP Points:</strong> <input type="text" name="points" size="8" value="<?=$points?>">
            </td>
          </tr>
        </table><br><br>
        <center>
          <input type="hidden" name="playerid" value="<?=$player?>">
          <input type="submit" value="Submit Changes">&nbsp;
          <input type="button" value="Cancel" onClick="history.back()">
        </center>
      </form>
    </div>
  </div>
