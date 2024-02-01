  <center>
    <iframe id='searchframe' src='templates/iframes/itemsearch.php'></iframe>
    <input id="button" type="button" value='Hide Item Search' onclick='hideSearch();' style='display:none; margin-bottom: 20px;'>
  </center>
  <form method="post" action="index.php?editor=misc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&action=18">
    <div class="edit_form" style="width: 450px;">
      <div class="edit_form_header">Add Ground Spawn</div>
      <div class="edit_form_content">
        <table width="100%" cellpadding="5" cellspacing="5">
          <tr>
            <td>
              <strong>ID</strong><br>
              <input type="text" name="gsid" size="7" value="<?=$suggestgsid?>">
            </td>
            <td>
              <strong>Item ID</strong> (<a href="javascript:showSearch();">search</a>)<br>
              <input id="id" type="text" name="giid" size="7" value="">
            </td>
            <td>
              <strong>Zone</strong><br>
              <input type="text" name="zoneid" size="7" value="<?=$zid?>">
            </td>
            <td>
              <strong>Version</strong><br>
              <input type="text" name="version" size="7" value="<?=$suggestver?>">
            </td>
          </tr>
          <tr>
            <td>
              <strong>Max X</strong><br>
              <input type="text" name="max_x" size="7" value="0">
            </td>
            <td>
              <strong>Max Y</strong><br>
              <input type="text" name="max_y" size="7" value="0">
            </td>
            <td>
              <strong>Max Z</strong><br>
              <input type="text" name="max_z" size="7" value="0">
            </td>
            <td>
              <strong>Heading</strong><br>
              <input type="text" name="heading" size="7" value="0">
            </td>
          </tr>
          <tr>
            <td>
              <strong>Min X</strong><br>
              <input type="text" name="min_x" size="7" value="0">
            </td>
            <td>
              <strong>Min Y</strong><br>
              <input type="text" name="min_y" size="7" value="0">
            </td>
            <td>
              <strong>Max Allowed</strong><br>
              <input type="text" name="max_allowed" size="7" value="1">
            </td>
            <td>
              <strong>Respawn</strong><br>
              <input type="text" name="respawn_timer" size="7" value="300">
            </td>
          </tr>
          <tr>
            <td>
              <strong>Fix Z</strong><br>
              <select name="fix_z">
                <option value="0">No (0)</option>
                <option value="1" selected>Yes (1)</option>
              </select>
            </td>
            <td>
              <strong>Min Expansion</strong><br>
              <input type="text" name="min_expansion" size="7" value="-1">
            </td>
            <td>
              <strong>Max Expansion</strong><br>
              <input type="text" name="max_expansion" size="7" value="-1">
            </td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2">
              <strong>Name</strong><br>
              <input type="text" name="name" size="25" value="IT">
            </td>
            <td colspan="2">
              <strong>Content Flags</strong><br>
              <input type="text" name="content_flags" size="25" value="">
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <strong>Comment</strong><br>
              <input type="text" name="comment" size="25" value="Default comment">
            </td>
            <td colspan="2">
              <strong>Content Flags Disabled</strong><br>
              <input type="text" name="content_flags_disabled" size="25" value="">
            </td>
          </tr>
        </table><br><br>
        <center>
          <input type="submit" value="Add Groundspawn">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back();">
        </center>
      </div>
    </div>
  </form>
