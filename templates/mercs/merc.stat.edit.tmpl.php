  <form name="edit_merc_stat" method="post" action="index.php?editor=mercs&action=59">
    <div class="edit_form">
      <div class="edit_form_header">&nbsp;</div>
      <div class="edit_form_content">
        <fieldset>
          <legend><strong><font size="4">General</font></strong></legend>
          <table width="100%" border="0" cellpadding="3" cellspacing="0">
            <tr>
              <td align="left" width="33%">NPC Type ID: <br><input type="text" size="10" value="<?=$stat['merc_npc_type_id']?>" disabled></td>
              <td align="left" width="33%">Client Level:<br><input type="text" size="10" value="<?=$stat['clientlevel']?>" disabled></td>
              <td align="left" width="33%">Merc Level:  <br><input type="text" name="level" size="10" value="<?=$stat['level']?>"></td>
            </tr>
          </table>
        </fieldset><br>
        <fieldset>
          <legend><strong><font size="4">Vitals</font></strong></legend>
          <table width="100%" border="0" cellpadding="3" cellspacing="0">
            <tr>
              <td align="left" width="17%">HP:      <br><input type="text" name="hp" size="10" value="<?=$stat['hp']?>"></td>
              <td align="left" width="17%">Mana:    <br><input type="text" name="mana" size="10" value="<?=$stat['mana']?>"></td>
              <td align="left" width="17%">AC:      <br><input type="text" name="AC" size="10" value="<?=$stat['AC']?>"></td>
              <td align="left" width="17%">Runspeed:<br><input type="text" name="runspeed" size="10" value="<?=$stat['runspeed']?>"></td>
              <td align="left" width="16%">ATK:     <br><input type="text" name="ATK" size="10" value="<?=$stat['ATK']?>"></td>
              <td align="left" width="16%">Accuracy:<br><input type="text" name="Accuracy" size="10" value="<?=$stat['Accuracy']?>"></td>
            </tr>
          </table>
        </fieldset><br>
        <fieldset>
          <legend><strong><font size="4">Stats</font></strong></legend>
          <table width="100%" border="0" cellpadding="3" cellspacing="0">
            <tr>
              <td align="left" width="15%">STR:<br><input type="text" name="STR" size="5" value="<?=$stat['STR']?>"></td>
              <td align="left" width="15%">STA:<br><input type="text" name="STA" size="5" value="<?=$stat['STA']?>"></td>
              <td align="left" width="14%">DEX:<br><input type="text" name="DEX" size="5" value="<?=$stat['DEX']?>"></td>
              <td align="left" width="14%">AGI:<br><input type="text" name="AGI" size="5" value="<?=$stat['AGI']?>"></td>
              <td align="left" width="14%">INT:<br><input type="text" name="_INT" size="5" value="<?=$stat['_INT']?>"></td>
              <td align="left" width="14%">WIS:<br><input type="text" name="WIS" size="5" value="<?=$stat['WIS']?>"></td>
              <td align="left" width="14%">CHA:<br><input type="text" name="CHA" size="5" value="<?=$stat['CHA']?>"></td>
            </tr>
          </table>
        </fieldset><br>
        <fieldset>
          <legend><strong><font size="4">Resists</font></strong></legend>
            <table width="100%" border="0" cellpadding="3" cellspacing="0">
              <tr>
                <td colspan="6">1 Resist = 0.5%<br>250 Resist = 100%</td>
              </tr>
              <tr>
                <td align="left" width="13%">MR:    <br><input type="text" name="MR" size="5" value="<?=$stat['MR']?>"></td>
                <td align="left" width="13%">CR:    <br><input type="text" name="CR" size="5" value="<?=$stat['CR']?>"></td>
                <td align="left" width="13%">DR:    <br><input type="text" name="DR" size="5" value="<?=$stat['DR']?>"></td>
                <td align="left" width="13%">FR:    <br><input type="text" name="FR" size="5" value="<?=$stat['FR']?>"></td>
                <td align="left" width="13%">PR:    <br><input type="text" name="PR" size="5" value="<?=$stat['PR']?>"></td>
                <td align="left" width="14%">Corrup:<br><input type="text" name="Corrup" size="5" value="<?=$stat['Corrup']?>"></td>
              </tr>
            </table>
        </fieldset><br>
        <fieldset>
          <legend><strong><font size="4">Combat</font></strong></legend>
          <table width="100%" border="0" cellpadding="3" cellspacing="0">
            <tr>
              <td align="left" width="20%">Min Dmg:     <br><input type="text" name="mindmg" size="5" value="<?=$stat['mindmg']?>"></td>
              <td align="left" width="20%">HP Regen:    <br><input type="text" name="hp_regen_rate" size="5" value="<?=$stat['hp_regen_rate']?>"></td>
              <td align="left" width="20%">Attack Count:<br><input type="text" name="attack_count" size="5" value="<?=$stat['attack_count']?>"></td>
              <td align="left" width="20%">Atk Delay:   <br><input type="text" name="attack_delay" size="5" value="<?=$stat['attack_delay']?>"></td>
              <td align="left" width="20%">Spell Scale: <br><input type="text" name="spellscale" size="5" value="<?=$stat['spellscale']?>">%</td>
            </tr>
            <tr>
              <td align="left" width="20%">Max Dmg:     <br><input type="text" name="maxdmg" size="5" value="<?=$stat['maxdmg']?>"></td>
              <td align="left" width="20%">MP Regen:    <br><input type="text" name="mana_regen_rate" size="5" value="<?=$stat['mana_regen_rate']?>"></td>
              <td align="left" width="20%">Attack Speed:<br><input type="text" name="attack_speed" size="5" value="<?=$stat['attack_speed']?>"></td>
              <td align="left" width="20%">Stat Scale:  <br><input type="text" name="statscale" size="5" value="<?=$stat['statscale']?>">%</td>
              <td align="left" width="20%">Heal Scale:  <br><input type="text" name="healscale" size="5" value="<?=$stat['healscale']?>">%</td>
            </tr>
          </table>
          <center>
            <table cellpadding="20px">
              <tr>
<?
  $specabil = array();
  $specabilcont = array();

  for ($i = 1; $i <= $special_abilities_max; $i++) {
    if (preg_match("/^$i,/", $stat['special_abilities']) == 1) {
      $specabil[$i] = 1;
      // Leading special ability
      if (preg_match("/^$i,.+?\^/", $stat['special_abilities'], $match) == 1) {
        $specabilcont[$i] = $match[0];
        $specabilcont[$i] = rtrim($specabilcont[$i], "^");
      }
      // Only special ability
      else {
        preg_match("/^$i,.+?\$/", $stat['special_abilities'], $match);
        $specabilcont[$i] = $match[0];
      }  
    }
    elseif (preg_match("/\^$i,/", $stat['special_abilities']) == 1) {
      $specabil[$i] = 1;
      // Middle special ability
      if (preg_match("/\^$i,.+?\^/", $stat['special_abilities'], $match) == 1) {
        $specabilcont[$i] = $match[0];
        $specabilcont[$i] = trim($specabilcont[$i], "^");
      }
      // Trailing special ability
      else {
        preg_match("/\^$i,.+?\$/", $stat['special_abilities'], $match);
        $specabilcont[$i] = $match[0];  
        $specabilcont[$i] = ltrim($specabilcont[$i], "^");
      }
    }
    else {
      $specabil[$i] = 0;
    }
  }
?>
                <td valign="top" align="left">
                  Summon (1):<br><input type="text" name="1" size="10" value="<?echo (isset($specabilcont[1])) ? $specabilcont[1] : "";?>"><br>
                  Enrage (2):<br><input type="text" name="2" size="10" value="<?echo (isset($specabilcont[2])) ? $specabilcont[2] : "";?>"><br>
                  Rampage (3):<br><input type="text" name="3" size="10" value="<?echo (isset($specabilcont[3])) ? $specabilcont[3] : "";?>"><br>
                  AE Rampage (4):<br><input type="text" name="4" size="10" value="<?echo (isset($specabilcont[4])) ? $specabilcont[4] : "";?>"><br>
                  Flurry (5):<br><input type="text" name="5" size="10" value="<?echo (isset($specabilcont[5])) ? $specabilcont[5] : "";?>"><br>
                  Tunnel Vision (29):<br><input type="text" name="29" size="10" value="<?echo (isset($specabilcont[29])) ? $specabilcont[29] : "";?>"><br>
                  Leashed (32):<br><input type="text" name="32" size="10" value="<?echo (isset($specabilcont[32])) ? $specabilcont[32] : "";?>"><br>
                  Tethered (33):<br><input type="text" name="33" size="10" value="<?echo (isset($specabilcont[33])) ? $specabilcont[33] : "";?>"><br>
                  Flee Percent (37):<br><input type="text" name="37" size="10" value="<?echo (isset($specabilcont[37])) ? $specabilcont[37] : "";?>"><br>
                  Chase Distance (40):<br><input type="text" name="40" size="10" value="<?echo (isset($specabilcont[40])) ? $specabilcont[40] : "";?>"><br>
                  Casting Resist Diff (43):<br><input type="text" name="43" size="10" value="<?echo (isset($specabilcont[43])) ? $specabilcont[43] : "";?>"><br>
                  Counter Avoid Damage (44):<br><input type="text" name="44" size="10" value="<?echo (isset($specabilcont[44])) ? $specabilcont[44] : "";?>"><br>
                </td>
                <td valign="top" align="left">
                  <input type="checkbox" name="6" value="6,1^"<?echo ($specabil[6] == 1) ? " checked" : "";?>> Triple Attack (6)<br>
                  <input type="checkbox" name="7" value="7,1^"<?echo ($specabil[7] == 1) ? " checked" : "";?>> Quad Attack (7)<br>
                  <input type="checkbox" name="10" value="10,1^"<?echo ($specabil[10] == 1) ? " checked" : "";?>> Magic Attack (10)<br>
                  <input type="checkbox" name="9" value="9,1^"<?echo ($specabil[9] == 1) ? " checked" : "";?>> Bane Attack (9)<br>
                  <input type="checkbox" name="8" value="8,1^"<?echo ($specabil[8] == 1) ? " checked" : "";?>> Dual Wield (8)<br>
                  <input type="checkbox" name="11" value="11,1^"<?echo ($specabil[11] == 1) ? " checked" : "";?>> Ranged Attack (11)<br>
                  <input type="checkbox" name="12" value="12,1^"<?echo ($specabil[12] == 1) ? " checked" : "";?>> Unslowable (12)<br>
                  <input type="checkbox" name="13" value="13,1^"<?echo ($specabil[13] == 1) ? " checked" : "";?>> Unmezable (13)<br>
                  <input type="checkbox" name="14" value="14,1^"<?echo ($specabil[14] == 1) ? " checked" : "";?>> Uncharmable (14)<br>
                  <input type="checkbox" name="15" value="15,1^"<?echo ($specabil[15] == 1) ? " checked" : "";?>> Unstunable (15)<br>
                  <input type="checkbox" name="16" value="16,1^"<?echo ($specabil[16] == 1) ? " checked" : "";?>> Unsnareable (16)<br>
                  <input type="checkbox" name="17" value="17,1^"<?echo ($specabil[17] == 1) ? " checked" : "";?>> Unfearable (17)<br>
                  <input type="checkbox" name="31" value="31,1^"<?echo ($specabil[31] == 1) ? " checked" : "";?>> Unpacifiable (31)<br>
                  <input type="checkbox" name="18" value="18,1^"<?echo ($specabil[18] == 1) ? " checked" : "";?>> Immune to Dispell (18)<br>
                  <input type="checkbox" name="35" value="35,1^"<?echo ($specabil[35] == 1) ? " checked" : "";?>> No Harm from Players (35)<br>
                  <input type="checkbox" name="39" value="39,1^"<?echo ($specabil[39] == 1) ? " checked" : "";?>> Disable Melee (39)<br>
                  <input type="checkbox" name="42" value="42,1^"<?echo ($specabil[42] == 1) ? " checked" : "";?>> Ignore Root Aggro (42)<br>
                </td>
                <td valign="top" align="left">
                  <input type="checkbox" name="26" value="26,1^"<?echo ($specabil[26] == 1) ? " checked" : "";?>> Resist Ranged Spells (26)<br>
                  <input type="checkbox" name="28" value="28,1^"<?echo ($specabil[28] == 1) ? " checked" : "";?>> Immune to Taunt (28)<br>
                  <input type="checkbox" name="19" value="19,1^"<?echo ($specabil[19] == 1) ? " checked" : "";?>> Immune to Melee (19)<br>
                  <input type="checkbox" name="20" value="20,1^"<?echo ($specabil[20] == 1) ? " checked" : "";?>> Immune to Magic (20)<br>
                  <input type="checkbox" name="21" value="21,1^"<?echo ($specabil[21] == 1) ? " checked" : "";?>> Immune to Fleeing (21)<br>
                  <input type="checkbox" name="23" value="23,1^"<?echo ($specabil[23] == 1) ? " checked" : "";?>> Immune to non-Magical Melee (23)<br>
                  <input type="checkbox" name="22" value="22,1^"<?echo ($specabil[22] == 1) ? " checked" : "";?>> Immune to non-Bane Melee (22)<br>
                  <input type="checkbox" name="24" value="24,1^"<?echo ($specabil[24] == 1) ? " checked" : "";?>> Will Not Aggro (24)<br>
                  <input type="checkbox" name="25" value="25,1^"<?echo ($specabil[25] == 1) ? " checked" : "";?>> Immune to Aggro (25)<br>
                  <input type="checkbox" name="27" value="27,1^"<?echo ($specabil[27] == 1) ? " checked" : "";?>> See through Feign Death (27)<br>
                  <input type="checkbox" name="30" value="30,1^"<?echo ($specabil[30] == 1) ? " checked" : "";?>> Does NOT buff/heal friends (30)<br>
                  <input type="checkbox" name="36" value="36,1^"<?echo ($specabil[36] == 1) ? " checked" : "";?>> Always Flee (36)<br>
                  <input type="checkbox" name="38" value="38,1^"<?echo ($specabil[38] == 1) ? " checked" : "";?>> Allow Beneficial (38)<br>
                  <input type="checkbox" name="41" value="41,1^"<?echo ($specabil[41] == 1) ? " checked" : "";?>> Allow Tank (41)<br>
                  <input type="checkbox" name="45" value="45,1^"<?echo ($specabil[45] == 1) ? " checked" : "";?>> Prox Aggro (45)<br>
                  <input type="checkbox" name="46" value="46,1^"<?echo ($specabil[46] == 1) ? " checked" : "";?>> Immune to Ranged Attacks (46)<br>
                  <input type="checkbox" name="34" value="34,1^"<?echo ($specabil[34] == 1) ? " checked" : "";?>> Destructible Object (34)<br>
                </td>
              </tr>
            </table>
          </center>
        </fieldset><br>
        <center>
          <input type="hidden" name="merc_npc_type_id" value="<?=$stat['merc_npc_type_id']?>">
          <input type="hidden" name="clientlevel" value="<?=$stat['clientlevel']?>">
          <input type="submit" value="Update Stat">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back();">
        </center>
      </div>
    </div>
  </form>
