  <div class="edit_form" style="width: 355px;">
    <div class="edit_form_header">Add Loottable</div>
    <div class="edit_form_content">
      <form name="loottable" method="post" action="index.php?editor=loot&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&action=10&npcid=<?=$npcid?>">
        <table width="100%" cellpadding="3" cellspacing="3">
          <tr>
            <td colspan="2">
              <strong>Loottable ID:</strong><br>
              <input type="text" size="7" name="id" value="<?=$id?>">
          <tr>
            <td colspan="2">
              <strong>Loottable Name:</strong><br>
              <input type="text" name="name" size="50" value="<?=$name?>">
            </td>
          </tr>
          <tr>
            <td>
              <strong>Min Cash:</strong><br>
              <input type="text" name="mincash" size="7" value="0">
            </td>
            <td>
              <strong>Max Cash:</strong><br>
              <input type="text" name="maxcash" size="7" value="0">
            </td>
          </tr>
          <tr>
            <td>
              <strong>Min Expansion:</strong><br>
              <input type="text" name="min_expansion" size="7" value="-1">
            </td>
            <td>
              <strong>Max Expansion:</strong><br>
              <input type="text" name="max_expansion" size="7" value="-1">
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <strong>Content Flags:</strong><br>
              <input type="text" name="content_flags" size="50" value="">
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <strong>Content Flags Disabled:</strong><br>
              <input type="text" name="content_flags_disabled" size="50" value="">
            </td>
          </tr>
        </table><br><br>
        <center>
          <input type="hidden" name="avgcoin" value="0">
          <input type="submit" name="submit" value="Add Loottable">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back();">
        </center>
      </form>
    </div>
  </div>
