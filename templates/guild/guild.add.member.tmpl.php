  <center>
    <iframe id="searchframe" src="templates/iframes/playersearch.php" style="display:none;"></iframe>
    <input id="button" type="button" value="Hide Search" onclick="javascript:hideSearch();" style="display:none;">
  </center>
  <div class="edit_form" style="width: 350px;">
    <div class="edit_form_header">Add Guild Member</div>
    <div class="edit_form_content">
      <form name="add_member" method="POST" action="index.php?editor=guild&guildid=<?=$guildid?>&action=7">
        <table width="100%" cellpadding="3" cellspacing="3">
          <tr>
            <td>Guild:<br><input type="text" value="<?=getGuildName($guildid)?>" disabled></td>
            <td><a href="javascript:showSearch();">Select Player</a><br><input type="text" id="player" name="player"></td>
          </tr>
        </table><br>
        <center>
          <input type="submit" value="Submit">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back();">
        </center>
      </form>
    </div>
  </div>
