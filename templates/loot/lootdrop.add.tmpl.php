  <div class="edit_form" style="width: 355px;">
    <div class="edit_form_header">Add Lootdrop</div>
    <div class="edit_form_content">
      <form name="loottable" method="post" action="index.php?editor=loot&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=31">
        <table width="100%" cellpadding="3" cellspacing="3">
          <tr>
            <td>
              <strong>Loottable ID:</strong><br>
              <input type="text" size="7" value="<?=$ltid?>" disabled>
            </td>
            <td>
              <strong>Lootdrop ID:</strong><br>
              <input type="text" size="7" name="ldid" value="<?=$id?>">
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <strong>Lootdrop Name:</strong><br>
              <input type="text" name="name" size="50" value="<?=$name?>">
            </td>
          </tr>
          <tr>
            <td>
              <strong>Mindrop:</strong><br>
              <input type="text" name="mindrop" size="7" value="0">
            </td>
            <td>
              <strong>Droplimit:</strong><br>
              <input type="text" name="droplimit" size="7" value="0">
            </td>
          </tr>
          <tr>
            <td>
              <strong>Multiplier:</strong><br>
              <input type="text" name="multiplier" size="7" value="1">
            </td>
            <td>
              <strong>Probability:</strong><br>
              <input type="text" name="probability" size="7" value="100">
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
          <input type="hidden" name="ltid" value="<?=$ltid?>">
          <input type="submit" name="submit" value="Add Lootdrop">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back();">
        </center>
      </form>
    </div>
  </div>
