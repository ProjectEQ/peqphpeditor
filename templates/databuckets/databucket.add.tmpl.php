  <center>
    <iframe id="searchframe" src="templates/iframes/playersearch.php" style="display:none;"></iframe>
    <iframe id="n_searchframe" src="templates/iframes/npcsearch.php" style="display:none;"></iframe>
    <input id="button" type="button" value="Hide Search" onclick="javascript:hideSearch();" style="display:none;">
  </center>
  <div class="table_container" style="width: 700px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td>Create Data Bucket</td>
        </tr>
      </table>
    </div>
    <div class="table_content">
      <form name="databuckets" method="post" action="index.php?editor=databuckets&action=3">
        <table width="100%" cellpadding="3" cellspacing="3">
          <tr>
            <td width="33%">
              ID:<br>
              <input type="text" name="id" value="<?=$suggest_id?>">
            </td>
            <td width="33%">
              Key:<br>
              <input type="text" name="key" value="">
            </td>
            <td width="33%">
              Value:<br>
              <input type="text" name="value" value="">
            </td>
          </tr>
          <tr>
            <td width="33%">
              Expires:<br>
              <input type="text" name="expires" value="0">
            </td>
          </tr>
          <tr>
            <td width="33%">
              Character ID: (<a href="javascript:showSearch();">search</a>)<br>
              <input type="text" id="player" name="character_id" value="0">
            </td>
            <td width="33%">
              NPC ID: (<a href="javascript:showSearch();">search</a>)<br>
              <input type="text" id="npc" name="npc_id" value="0">
            </td>
            <td width="33%">
              Bot ID:<br>
              <input type="text" name="bot_id" value="0">
            </td>
          </tr>
          <tr>
            <td colspan="3">&nbsp;</td>
          </tr>
        </table>
        <center>
          <input type="submit" value="Add Data Bucket">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back()">
        </center>
      </form>
    </div>
  </div>
