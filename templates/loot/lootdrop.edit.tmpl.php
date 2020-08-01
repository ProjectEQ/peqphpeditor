  <div class="edit_form" style="width: 355px;">
    <div class="edit_form_header">Edit Lootdrop</div>
    <div class="edit_form_content">
      <form name="loottable" id="loottable" method="post" action="index.php?editor=loot&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&action=8&npcid=<?=$npcid?>&ltid=<?=$ltid?>&ldid=<?=$ldid?>">
        <table width="100%" cellpadding="3" cellspacing="3">
          <tr>
            <td>
              <strong>Loottable ID:</strong><br>
              <input type="text" size="7" value="<?=$ltid?>" disabled>
            </td>
            <td>
              <strong>Lootdrop ID:</strong><br>
              <input type="text" size="7" value="<?=$ldid?>" disabled>
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <strong>Lootdrop Name:</strong><br>
              <input type="text" name="name" size="50" value="<?=$ltname?>">
            </td>
          </tr>
          <tr>
            <td>
              <strong>Mindrop:</strong><br>
              <input type="text" name="mindrop" size="7" value="<?=$loottable_entries['mindrop']?>">
            </td>
            <td>
              <strong>Droplimit:</strong><br>
              <input type="text" name="droplimit" size="7" value="<?=$loottable_entries['droplimit']?>">
            </td>
          </tr>
          <tr>
            <td>
              <strong>Multiplier:</strong><br>
              <input type="text" name="multiplier" size="7" value="<?=$loottable_entries['multiplier']?>">
            </td>
            <td>
              <strong>Probability:</strong><br>
              <input type="text" name="probability" size="7" value="<?=$loottable_entries['probability']?>">
            </td>
          </tr>
          <tr>
            <td>
              <strong>Min Expansion:</strong><br>
              <input type="text" name="min_expansion" size="7" value="<?=$lootdrop['min_expansion']?>">
            </td>
            <td>
              <strong>Max Expansion:</strong><br>
              <input type="text" name="max_expansion" size="7" value="<?=$lootdrop['max_expansion']?>">
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <strong>Content Flags:</strong><br>
              <input type="text" name="content_flags" size="50" value="<?=$lootdrop['content_flags']?>">
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <strong>Content Flags Disabled:</strong><br>
              <input type="text" name="content_flags_disabled" size="50" value="<?=$lootdrop['content_flags_disabled']?>">
            </td>
          </tr>
        </table><br><br>
        <center>
          <input type="hidden" name="ltid" value="<?=$ltid?>">
          <input type="hidden" name="ldid" value="<?=$ldid?>">
          <input type="submit" name="submit" value="Update Lootdrop">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back();">
        </center>
      </form>
    </div>
  </div>

