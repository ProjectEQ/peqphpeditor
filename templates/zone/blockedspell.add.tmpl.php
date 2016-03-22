  <center>
    <iframe id='searchframe' src='templates/iframes/spellsearch.php'></iframe>
    <input id="button" type="button" value='Hide Spell Search' onclick='hideSearch();' style='display:none; margin-bottom: 20px;'>
  </center>
  <form name="blockedspell" method="post" action="index.php?editor=zone&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&action=23">
    <div class="edit_form" style="width: 350px;">
      <div class="edit_form_header">Add Blocked Spell</div>
      <div class="edit_form_content">
        <table cellpadding="0" cellspacing="0" width="100%">
          <tr>
            <td align="left">
              <strong>ID</strong><br/>
              <input type="text" name="bsid" size="7" value="<?=$suggestbsid?>"><br/><br/>
            </td>
            <td align="left">
              <strong>Zone</strong><br/>
              <input type="text" name="zoneid" size="7" value="<?=$zid?>"><br/><br/>
            </td>
          </tr>
          <tr>
            <td align="left">
              <strong>Spell ID</strong> (<a href="javascript:showSearch();">search</a>)<br/>
              <input id="id" type="text" name="spellid" size="7" value="0"><br/><br/>
            </td>
            <td align="left">
              <strong>Type</strong><br/>
              <select name="type">
                <option value="0"<?echo ($type == 0) ? " selected" : ""?>>Not Blocked</option>
                <option value="1"<?echo ($type == 1) ? " selected" : ""?>>Zone Wide</option>
                <option value="2"<?echo ($type == 2) ? " selected" : ""?>>Coords</option>
              </select><br/><br/>
            </td>
          </tr>
          <tr>
            <td align="left">
              <strong>X</strong><br/>
              <input type="text" name="x_coord" size="7" value="0"><br/><br/>
              <strong>Y</strong><br/>
              <input type="text" name="y_coord" size="7" value="0"><br/><br/>
              <strong>Z</strong><br/>
              <input type="text" name="z_coord" size="7" value="0"><br/><br/>
            </td>
            <td align="left">
              <strong>X Diff</strong><br/>
              <input type="text" name="x_diff" size="7" value="0"><br/><br/>
              <strong>Y Diff</strong><br/>
              <input type="text" name="y_diff" size="7" value="0"><br/><br/>
              <strong>Z Diff</strong><br/>
              <input type="text" name="z_diff" size="7" value="0"><br/><br/>
            </td>
          </tr>
          <tr>
            <td align="left" colspan="2">
              <strong>Message</strong><br/>
              <textarea name="message" cols="38" rows="3"></textarea><br/><br/>
            </td>
          </tr>
          <tr>
            <td align="left" colspan="2">
              <strong>Description</strong><br/>
              <textarea name="description" cols="38" rows="2"><?=$description?></textarea><br/><br/>
            </td>
          </tr>
        </table>
        <center>
          <input type="submit" value="Add Entry">&nbsp;
          <input type="button" value="Cancel Changes" onClick="history.back();">
        </center>
      </div>
    </div>
  </form>
