  <script>
    function toggleCharges() {
      if (document.getElementById("max_charges").checked == true) {
        document.getElementById("item_charges").setAttribute("disabled", true);
      }
      else {
        document.getElementById("item_charges").removeAttribute("disabled");
      }
    }
  </script>
  <center>
    <iframe id='searchframe' src='templates/iframes/itemsearch.php'></iframe>
    <input id="button" type="button" value='Hide Item Search' onclick='hideSearch("searchframe");' style='display:none; margin-bottom: 20px;'>
  </center>
  <form name="lootdrop_item" method="POST" action="index.php?editor=loot&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&ldid=<?=$ldid?>&action=21">
    <div class="edit_form" style="width: 400px;">
      <div class="edit_form_header">Add Lootdrop Item</div>
      <div class="edit_form_content">
        <table width="100%" cellpadding="3" cellspacing="3">
          <tr>
            <td>
              <strong>Lootdrop ID:</strong><br>
              <input type="text" size="7" value="<?=$ldid?>" disabled>
            </td>
            <td>
              <strong>Item ID:</strong> (<a href="javascript:showSearch('searchframe');">search</a>)<br>
              <input id="id" type="text" size="7" name="itemid">
            </td>
            <td>
              <strong>Charges:</strong>&nbsp;&nbsp;&nbsp;<strong>Max:</strong><br>
              <input type="text" size="5" name="item_charges" id="item_charges" value="1">&nbsp;
              <input type="checkbox" name="max_charges" id="max_charges" onChange="toggleCharges();">
            </td>
          </tr>
        </table><br>
        <table width="100%" cellpadding="3" cellspacing="3">
          <tr>
            <td>
              <strong>&nbsp;<br>Equip:</strong><br>
              <select name="equip_item">
                <option value="0" selected>No</option>
                <option value="1">Yes</option>
              </select>
            </td>
            <td>
              <strong>&nbsp;<br>Chance:</strong><br>
              <input type="text" size="5" name="chance" value="100">%
            </td>
            <td>
              <strong>Disabled<br>Chance:</strong><br>
              <input type="text" size="5" name="disabled_chance" value="0">
            </td>
            <td>
              <strong>&nbsp;<br>Multiplier:</strong><br>
              <input type="text" size="5" name="multiplier" value="1">
            </td>
          </tr>
          <tr><td colspan="4">&nbsp;</td></tr>
          <tr>
            <td>
              <strong>Trivial<br>Min Level:</strong><br>
              <input type="text" size="5" name="trivial_min_level" value="0">
            </td>
            <td>
              <strong>Trivial<br>Max Level:</strong><br>
              <input type="text" size="5" name="trivial_max_level" value="0">
            </td>
            <td>
              <strong>NPC<br>Min Level:</strong><br>
              <input type="text" size="5" name="npc_min_level" value="0">
            </td>
            <td>
              <strong>NPC<br>Max Level:</strong><br>
              <input type="text" size="5" name="npc_max_level" value="0">
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <strong>Min Expansion:</strong><br>
              <input type="text" size="18" name="min_expansion" value="-1">
            </td>
            <td colspan="2">
              <strong>Max Expansion:</strong><br>
              <input type="text" size="18" name="max_expansion" value="-1">
            </td>
          </tr>
          <tr>
            <td colspan="4">
              <strong>Content Flags:</strong><br>
              <input type="text" size="51" name="content_flags" value="">
            </td>
          </tr>
          <tr>
            <td colspan="4">
              <strong>Content Flags Disabled:</strong><br>
              <input type="text" size="51" name="content_flags_disabled" value="">
            </td>
          </tr>
        </table><br><br>
        <center>
          <input type="hidden" name="ldid" value="<?=$ldid?>">
          <input type="submit" name="submit" value="Add Item">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back();">
        </center>
      </div>
    </div>
  </form>
