  <center>
    <table style="border: 1px solid black; background-color: #CCC;">
      <tr><td colspan="3"><b>Legend:</b></td></tr>
      <tr><td align="right">1101 and Above</td><td>&nbsp;</td><td align="left">Ally</td></tr>
      <tr><td align="right">701 to 1100</td><td>&nbsp;</td><td align="left">Warmly</td></tr>
      <tr><td align="right">401 to 700</td><td>&nbsp;</td><td align="left">Kindly</td></tr>
      <tr><td align="right">101 to 400</td><td>&nbsp;</td><td align="left">Amiably</td></tr>
      <tr><td align="right">0 to 100</td><td>&nbsp;</td><td align="left">Indifferently</td></tr>
      <tr><td align="right">-100 to -1</td><td>&nbsp;</td><td align="left">Apprehensively</td></tr>
      <tr><td align="right">-700 to -101</td><td>&nbsp;</td><td align="left">Dubiously</td></tr>
      <tr><td align="right">-999 to -701</td><td>&nbsp;</td><td align="left">Threateningly</td></tr>
      <tr><td align="right">-1000 and Below</td><td>&nbsp;</td><td align="left">Ready to attack</td></tr>
    </table><br/><br/>
  </center>
  <div style="width: 550px; margin: auto;">
    <form id="form" name="faction" method="post" action="index.php?editor=faction&fid=<?=$faction_id?>&action=21">
      <div style="border: 1px solid black;">
        <div class="edit_form_header">
          Add Faction Mod:
        </div>
        <div class="edit_form_content">
          <fieldset>
            <legend><strong>Faction Mod Info</strong></legend>
            <table width="100%">
              <tr>
                <td width="25%">ID:<br/><input size="8" type="text" name="id" value="<?=$suggested_id?>"></td>
                <td width="50%">
                  Type:<br/>
                  <input type="radio" id="mod_race" name="mod_select" value="Race" onchange="toggleModType();" checked>Race <input type="radio" id="mod_class" name="mod_select" value="Class" onchange="toggleModType();">Class <input type="radio" id="mod_deity" name="mod_select" value="Deity" onchange="toggleModType();">Deity<br/>
                  <select id="select_race" style="display: inline;">
                    <option>Select a Race</option>
<?foreach ($races as $race_id=>$race_name):?>
                    <option value="<?=$race_id?>"><?=$race_id?>: <?=$race_name?></option>
<?endforeach;?>
                  </select>
                  <select id="select_class" style="display: none;">
                    <option>Select a Class</option>
<?foreach ($classes as $class_id=>$class_name):?>
                    <option value="<?=$class_id?>"><?=$class_id?>: <?=$class_name?></option>
<?endforeach;?>
                  </select>
                  <select id="select_deity" style="display: none;">
                    <option>Select a Deity</option>
<?foreach ($deities as $deity_id=>$deity_name):?>
                    <option value="<?=$deity_id?>"><?=$deity_id?>: <?=$deity_name?></option>
<?endforeach;?>
                  </select>
                </td>
                <td width="25%">Mod:<br/><input size="8" type="text" name="mod" value="0"></td>
              </tr>
            </table>
          </fieldset><br/>
          <center>
            <input type="hidden" name="faction_id" value="<?=$faction_id?>">
            <input type="hidden" id="mod_name" name="mod_name" value="">
            <input type="button" value="Submit" onclick="validateModType();">&nbsp;<input type="button" value="Cancel" onclick="history.back();">
          </center>
        </div>
      </div>
    </form>
  </div>
