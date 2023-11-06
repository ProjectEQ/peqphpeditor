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
      <tr><td align="right">-751 and Below</td><td>&nbsp;</td><td align="left">Scowls</td></tr>
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
            <table width="100%" cellpadding="3" cellspacing="3">
              <tr>
                <td width="34%"><strong>ID:</strong><br><input size="8" type="text" value="<?=$faction_info['id']?>" disabled></td>
                <td width="66%" colspan="2"><strong>Name:</strong><br><input size="30" type="text" name="name" value="<?=$faction_info['name']?>"></td>
              </tr>
              <tr>
                <td width="34%"><strong>Base:</strong><br><input size="8" type="text" name="base" value="<?=$faction_info['base']?>"></td>
                <td width="33%"><strong>Min:</strong><br><input size="8" type="text" name="min" value="<?echo (isset($faction_base)) ? $faction_base['min'] : "";?>"></td>
                <td width="33%"><strong>Max:</strong><br><input size="8" type="text" name="max" value="<?echo (isset($faction_base)) ? $faction_base['max'] : "";?>"></td>
              </tr>
              <tr>
                <td width="34%"><strong>Hero1:</strong><br><input size="8" type="text" name="unk_hero1" value="<?echo (isset($faction_base)) ? $faction_base['unk_hero1'] : "";?>"></td>
                <td width="33%"><strong>Hero2:</strong><br><input size="8" type="text" name="unk_hero2" value="<?echo (isset($faction_base)) ? $faction_base['unk_hero2'] : "";?>"></td>
                <td width="33%"><strong>Hero3:</strong><br><input size="8" type="text" name="unk_hero3" value="<?echo (isset($faction_base)) ? $faction_base['unk_hero3'] : "";?>"></td>
              </tr>
            </table>
          </fieldset><br>
          <center>
            <input type="hidden" name="id" value="<?=$faction_info['id']?>">
            <input type="submit" value="Submit Changes">&nbsp;&nbsp;<input type="button" value="Cancel Changes" onclick="history.back()">
          </center>
        </div>
      </div>
    </form>
  </div>
