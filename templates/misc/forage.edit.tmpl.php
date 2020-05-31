  <center>
    <iframe id='searchframe' src='templates/iframes/itemsearch.php'></iframe>
    <input id="button" type="button" value='Hide Item Search' onclick='hideSearch();' style='display:none; margin-bottom: 20px;'>
  </center>
  <form name="forage" method="post" action="index.php?editor=misc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&action=9">
    <div class="edit_form" style="width: 350px;">
      <div class="edit_form_header">Edit Forage Entry</div>
      <div class="edit_form_content">
        <table width="100%" cellpadding="5" cellspacing="5">
          <tr>
            <td>
              <strong>ID</strong><br>
              <input type="text" size="7" value="<?=$fgid?>" disabled>
            </td>
            <td>
              <strong>Min Expansion</strong><br>
              <input type="text" name="min_expansion" size="25" value="<?=$min_expansion?>">
            </td>
          </tr>
          <tr>
            <td>
              <strong>Item ID</strong> (<a href="javascript:showSearch();">search</a>)<br>
              <input id="id" type="text" name="fgiid" size="7" value="<?=$fgiid?>">
            </td>
            <td>
              <strong>Max Expansion</strong><br>
              <input type="text" name="max_expansion" size="25" value="<?=$max_expansion?>">
            </td>
          </tr>
          <tr>
            <td>
              <strong>Zone ID</strong><br>
              <input type="text" size="7" value="<?=$zoneid?>" disabled>
            </td>
            <td>
              <strong>Content Flags</strong><br>
              <input type="text" name="content_flags" size="25" value="<?=$content_flags?>">
            </td>
          </tr>
          <tr>
            <td>
              <strong>Level</strong><br>
              <input type="text" name="level" size="7" value="<?=$level?>">
            </td>
            <td>
              <strong>Content Flags Disabled</strong><br>
              <input type="text" name="content_flags_disabled" size="25" value="<?=$content_flags_disabled?>">
            </td>
          </tr>
          <tr>
            <td>
              <strong>Chance</strong><br>
              <input type="text" name="chance" size="7" value="<?=$chance?>">%
            </td>
            <td>&nbsp;</td>
          </tr>
        </table><br><br>
        <center>
          <input type="hidden" name="fgid" value="<?=$fgid?>">
          <input type="hidden" name="zoneid" value="<?=$zoneid?>">
          <input type="submit" value="Submit Changes">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back();">
        </center>
      </div>
    </div>
  </form>
