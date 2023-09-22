  <div class="error">
    <table width="100%">
      <tr>
        <td valign="middle" width="30px"><img src="images/caution.gif"></td>
        <td style="padding:0px 5px;">Editing data buckets directly while server is running may have unintended consequences due to caching.</td>
      </tr>
    </table>
  </div>
  <center>
    <iframe id="searchframe" src="templates/iframes/playersearch.php" style="display:none;"></iframe>
    <iframe id="n_searchframe" src="templates/iframes/npcsearch.php" style="display:none;"></iframe>
    <input id="button" type="button" value="Hide Search" onclick="javascript:hideSearch();" style="display:none;">
  </center>
  <div class="table_container" style="width: 700px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td>Edit Data Bucket</td>
        </tr>
      </table>
    </div>
    <div class="table_content">
      <form name="databuckets" method="post" action="index.php?editor=databuckets&action=5">
        <table width="100%" cellpadding="3" cellspacing="3">
          <tr>
            <td width="33%">
              ID:<br>
             <input type="text" value="<?=$id?>" disabled>
            </td>
            <td width="33%">
              Key:<br>
              <input type="text" name="key" value="<?=$key?>">
            </td>
            <td width="33%">
              Value:<br>
              <input type="text" name="value" value="<?=$value?>">
            </td>
          </tr>
          <tr>
            <td width="33%">
              Expires:<br>
              <input type="text" name="expires" value="<?=$expires?>">
            </td>
          </tr>
          <tr>
            <td width="33%">
              Character ID: (<a href="javascript:showSearch();">search</a>)<br>
              <input type="text" id="player" name="character_id" value="<?=$character_id?>">
            </td>
            <td width="33%">
              NPC ID: (<a href="javascript:showSearch();">search</a>)<br>
              <input type="text" id="npc" name="npc_id" value="<?=$npc_id?>">
            </td>
            <td width="33%">
              Bot ID:<br>
              <input type="text" name="bot_id" value="<?=$bot_id?>">
            </td>
          </tr>
          <tr>
            <td colspan="3">&nbsp;</td>
          </tr>
        </table>
        <center>
          <input type="hidden" name="id" value="<?=$id?>">
          <input type="hidden" name="old_key" value="<?=$key?>">
          <input type="hidden" name="old_value" value="<?=$value?>">
          <input type="hidden" name="old_expires" value="<?=$expires?>">
          <input type="hidden" name="old_character_id" value="<?=$character_id?>">
          <input type="hidden" name="old_npc_id" value="<?=$npc_id?>">
          <input type="hidden" name="old_bot_id" value="<?=$bot_id?>">
          <input type="hidden" name="referer" value="<?echo $_SERVER["HTTP_REFERER"];?>">
          <input type="submit" value="Update Data Bucket">&nbsp;&nbsp;
          <input type="button" value="Cancel Changes" onClick="history.back()">
        </center>
      </form>
    </div>
  </div>
