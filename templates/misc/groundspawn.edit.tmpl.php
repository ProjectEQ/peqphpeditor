  <center>
    <iframe id='searchframe' src='templates/iframes/itemsearch.php'></iframe>
    <input id="button" type="button" value='Hide Item Search' onclick='hideSearch();' style='display:none; margin-bottom: 20px;'>
  </center>
  <form name="gspawn" method="post" action="index.php?editor=misc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&action=15">
    <div class="edit_form" style="width: 450px;">
      <div class="edit_form_header">Edit Ground Spawn</div>
      <div class="edit_form_content">
        <table width="100%" cellpadding="5" cellspacing="5">
          <tr>
            <td>
              <strong>ID</strong><br>
              <input type="text" size="7" value="<?=$gsid?>" disabled>
            </td>
            <td>
              <strong>Item ID</strong> (<a href="javascript:showSearch();">search</a>)<br>
              <input id="id" type="text" name="giid" size="7" value="<?=$giid?>">
            </td>
            <td>
              <strong>Zone</strong><br>
              <input type="text" size="7" value="<?=$zoneid?>" disabled>
            </td>
            <td>
              <strong>Version</strong><br>
              <input type="text" name="version" size="7" value="<?=$version?>">
            </td>
          </tr>
          <tr>
            <td>
              <strong>Max X</strong><br>
              <input type="text" name="max_x" size="7" value="<?=$max_x?>">
            </td>
            <td>
              <strong>Max Y</strong><br>
              <input type="text" name="max_y" size="7" value="<?=$max_y?>">
            </td>
            <td>
              <strong>Max Z</strong><br>
              <input type="text" name="max_z" size="7" value="<?=$max_z?>">
            </td>
            <td>
              <strong>Heading</strong><br>
              <input type="text" name="heading" size="7" value="<?=$heading?>">
            </td>
          </tr>
          <tr>
            <td>
              <strong>Min X</strong><br>
              <input type="text" name="min_x" size="7" value="<?=$min_x?>">
            </td>
            <td>
              <strong>Min Y</strong><br>
              <input type="text" name="min_y" size="7" value="<?=$min_y?>">
            </td>
            <td>
              <strong>Max Allowed</strong><br>
              <input type="text" name="max_allowed" size="7" value="<?=$max_allowed?>">
            </td>
            <td>
              <strong>Respawn</strong><br>
              <input type="text" name="respawn_timer" size="7" value="<?=$respawn_timer?>">
            </td>
          </tr>
          <tr>
            <td>
              <strong>Fix Z</strong><br>
              <select name="fix_z">
                <option value="0"<?echo ($fix_z == 0) ? " selected" : "";?>>No (0)</option>
                <option value="1"<?echo ($fix_z == 1) ? " selected" : "";?>>Yes (1)</option>
              </select>
            </td>
            <td>
              <strong>Min Expansion</strong><br>
              <input type="text" name="min_expansion" size="7" value="<?=$min_expansion?>">
            </td>
            <td>
              <strong>Max Expansion</strong><br>
              <input type="text" name="max_expansion" size="7" value="<?=$max_expansion?>">
            </td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2">
              <strong>Name</strong><br>
              <input type="text" name="name" size="25" value="<?=$name?>">
            </td>
            <td colspan="2">
              <strong>Content Flags</strong><br>
              <input type="text" name="content_flags" size="25" value="<?=$content_flags?>">
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <strong>Comment</strong><br>
              <input type="text" name="comment" size="25" value="<?=$comment?>">
            </td>
            <td colspan="2">
              <strong>Content Flags Disabled</strong><br>
              <input type="text" name="content_flags_disabled" size="25" value="<?=$content_flags_disabled?>">
            </td>
          </tr>
        </table><br><br>
        <center>
          <input type="hidden" name="gsid" value="<?=$gsid?>">
          <input type="hidden" name="zoneid" value="<?=$zoneid?>">
          <input type="submit" value="Submit Changes">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back();">
        </center>
      </div>
    </div>
  </form>
