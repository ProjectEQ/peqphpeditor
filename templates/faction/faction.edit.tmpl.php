  <center>
    <table style="border: 1px solid black; background-color: #CCC;">
      <tr><td colspan="3"><b>Legend:</b></td></tr>
      <tr><td align="right">1100 and Above</td><td>&nbsp;</td><td align="left">Ally</td></tr>
      <tr><td align="right">750 to 1099</td><td>&nbsp;</td><td align="left">Warmly</td></tr>
      <tr><td align="right">500 to 749</td><td>&nbsp;</td><td align="left">Kindly</td></tr>
      <tr><td align="right">100 to 499</td><td>&nbsp;</td><td align="left">Amiable</td></tr>
      <tr><td align="right">0 to 99</td><td>&nbsp;</td><td align="left">Indifferent</td></tr>
      <tr><td align="right">-100 to -1</td><td>&nbsp;</td><td align="left">Apprehensive</td></tr>
      <tr><td align="right">-500 to -101</td><td>&nbsp;</td><td align="left">Dubious</td></tr>
      <tr><td align="right">-750 to -501</td><td>&nbsp;</td><td align="left">Threatening</td></tr>
      <tr><td align="right">-751 and Below</td><td>&nbsp;</td><td align="left">KOS</td></tr>
    </table><br><br>
  </center>
  <div style="width: 500px; margin: auto;">
    <form name="faction" method="post" action="index.php?editor=faction&fid=<?=$faction_info['id']?>&action=2">
      <div style="border: 1px solid black;">
        <div class="edit_form_header">
          Edit Faction:
        </div>
        <div class="edit_form_content">
          <fieldset>
            <legend><strong>Faction Info</strong></legend>
            <table width="100%">
              <tr>
                <td width="25%">ID:<br><input size="8" type="text" name="new_id" value="<?=$faction_info['id']?>"></td>
                <td width="50%">Name:<br><input size="30" type="text" name="new_name" value="<?=$faction_info['name']?>"></td>
                <td width="25%">Base:<br><input size="8" type="text" name="new_base" value="<?=$faction_info['base']?>"></td>
              </tr>
            </table>
          </fieldset><br>
          <center>
            <input type="hidden" name="old_id" value="<?=$faction_info['id']?>">
            <input type="hidden" name="old_name" value="<?=$faction_info['name']?>">
            <input type="hidden" name="old_base" value="<?=$faction_info['base']?>">
            <input type="submit" value="Submit Changes">&nbsp;<input type="button" value="Cancel Changes" onclick="history.back()">
          </center>
        </div>
      </div>
    </form>
  </div>
