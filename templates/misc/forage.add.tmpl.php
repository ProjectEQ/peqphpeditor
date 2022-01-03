  <center>
    <iframe id='searchframe' src='templates/iframes/itemsearch.php'></iframe>
    <input id="button" type="button" value='Hide Item Search' onclick='hideSearch();' style='display:none; margin-bottom: 20px;'>
  </center>
  <form method="post" action="index.php?editor=misc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&action=12">
    <div class="edit_form" style="width: 350px;">
      <div class="edit_form_header">Add Forage Entry</div>
      <div class="edit_form_content">
        <table width="100%" cellpadding="5" cellspacing="5">
          <tr>
            <td>
              <strong>ID</strong><br>
              <input type="text" name="fgid" size="7" value="<?=$suggestfgid?>">
            </td>
            <td>
              <strong>Min Expansion</strong><br>
              <input type="text" name="min_expansion" size="25" value="-1">
            </td>
          </tr>
          <tr>
            <td>
              <strong>Item ID</strong> (<a href="javascript:showSearch();">search</a>)<br>
              <input id="id" type="text" name="fgiid" size="7" value="">
            </td>
            <td>
              <strong>Max Expansion</strong><br>
              <input type="text" name="max_expansion" size="25" value="-1">
            </td>
          </tr>
          <tr>
            <td>
              <strong>Zone ID</strong><br>
              <input type="text" name="zoneid" size="7" value="<?=$zid?>">
            </td>
            <td>
              <strong>Content Flags</strong><br>
              <input type="text" name="content_flags" size="25" value="">
            </td>
          </tr>
          <tr>
            <td>
              <strong>Level</strong><br>
              <input type="text" name="level" size="7" value="0">
            </td>
            <td>
              <strong>Content Flags Disabled</strong><br>
              <input type="text" name="content_flags_disabled" size="25" value="">
            </td>
          </tr>
          <tr>
            <td>
              <strong>Chance</strong><br>
              <input type="text" name="chance" size="7" value="0">%
            </td>
            <td>&nbsp;</td>
          </tr>
        </table><br><br>
        <center>
          <input type="submit" value="Add Entry">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back();">
        </center>
      </div>
    </div>
  </form>
