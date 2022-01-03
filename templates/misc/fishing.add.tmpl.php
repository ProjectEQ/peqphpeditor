  <center>
    <iframe id='searchframe' src='templates/iframes/itemsearch.php'></iframe>
    <input id="button" type="button" value='Hide Item Search' onclick='hideSearch();' style='display:none; margin-bottom: 20px;'>
  </center>
  <form method="post" action="index.php?editor=misc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&action=6">
    <div class="edit_form" style="width: 300px;">
      <div class="edit_form_header">Add Fishing Entry</div>
      <div class="edit_form_content">
        <table width="100%" cellpadding="0" cellspacing="0">
          <tr>
            <td>
              <strong>ID</strong><br>
              <input type="text" name="fsid" size="7" value="<?=$suggestfsid?>"><br><br>
            </td>
            <td>
              <strong>Min Expansion</strong><br>
              <input type="text" name="min_expansion" size="18" value="-1"><br><br>
            </td>
          </tr>
          <tr>
            <td>
              <strong>Item ID</strong> (<a href="javascript:showSearch();">search</a>)<br>
              <input id="id" type="text" name="fiid" size="7" value=""><br><br>
            </td>
            <td>
              <strong>Max Expansion</strong><br>
              <input type="text" name="max_expansion" size="18" value="-1"><br><br>
            </td>
          </tr>
          <tr>
            <td>
              <strong>Zone</strong><br>
              <input type="text" name="zoneid" size="7" value="<?=$zid?>"><br><br>
            </td>
            <td>
              <strong>Content Flags</strong><br>
              <input type="text" name="content_flags" size="18" value=""><br><br>
            </td>
          </tr>
          <tr>
            <td>
              <strong>Skill Level</strong><br>
              <input type="text" name="skill_level" size="7" value="0"><br><br>
            </td>
            <td>
              <strong>Content Flags Disabled</strong><br>
              <input type="text" name="content_flags_disabled" size="18" value=""><br><br>
            </td>
          </tr>
          <tr>
            <td>
              <strong>Chance</strong><br>
              <input type="text" name="chance" size="7" value="0">%<br><br>
            </td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>
              <strong>NPC</strong><br>
              <input type="text" name="npc_id" size="7" value="0"><br><br>
            </td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>
              <strong>NPC Chance</strong><br>
              <input type="text" name="npc_chance" size="7" value="0">%<br><br>
            </td>
          </tr>
        </table>
        <center>
          <input type="submit" value="Add Entry">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back();">
        </center>
      </div>
    </div>
  </form>
