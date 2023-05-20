  <form name="edit_npc_scale" method="post" action="index.php?editor=npc&action=93">
    <div class="edit_form">
      <div class="edit_form_header">&nbsp;</div>
      <div class="edit_form_content">
        <fieldset>
          <legend><strong><font size="4">General</font></strong></legend>
          <table width="100%" border="0" cellpadding="3" cellspacing="0">
            <tr>
              <td align="left" width="20%">
                Type:<br>
                <select name="type">
<?foreach ($npc_scaling_types as $k=>$v):?>
                  <option value="<?=$k?>"<?echo ($scale['type'] == $k) ? " selected" : "";?>><?=$v?> (<?=$k?>)</option>
<?endforeach;?>
                </select>
              </td>
              <td align="left" width="20%">Level:                    <br><input type="text" name="level" size="10" value="<?=$scale['level']?>"></td>
              <td align="left" width="30%">Zones: (| = Delimiter)    <br><input type="text" name="zone_id_list" size="25" value="<?=$scale['zone_id_list']?>"></td>
              <td align="left" width="30%">Instances: (| = Delimiter)<br><input type="text" name="instance_version_list" size="25" value="<?=$scale['instance_version_list']?>"></td>
            </tr>
          </table>
        </fieldset><br>
        <fieldset>
          <legend><strong><font size="4">Vitals</font></strong></legend>
          <table width="100%" border="0" cellpadding="3" cellspacing="0">
            <tr>
              <td align="left" width="17%">HP:             <br><input type="text" name="hp" size="10" value="<?=$scale['hp']?>"></td>
              <td align="left" width="17%">AC:             <br><input type="text" name="ac" size="10" value="<?=$scale['ac']?>"></td>
              <td align="left" width="17%">Attack:         <br><input type="text" name="attack" size="10" value="<?=$scale['attack']?>"></td>
              <td align="left" width="17%">Accuracy:       <br><input type="text" name="accuracy" size="10" value="<?=$scale['accuracy']?>"></td>
              <td align="left" width="16%">Slow Mitigation:<br><input type="text" name="slow_mitigation" size="10" value="<?=$scale['slow_mitigation']?>"></td>
              <td align="left" width="16%">Avoidance:      <br><input type="text" name="avoidance" size="10" value="<?=$scale['avoidance']?>"></td>
            </tr>
          </table>
        </fieldset><br>
        <fieldset>
          <legend><strong><font size="4">Stats</font></strong></legend>
          <table width="100%" border="0" cellpadding="3" cellspacing="0">
            <tr>
              <td align="left" width="15%">STR:<br><input type="text" name="strength" size="5" value="<?=$scale['strength']?>"></td>
              <td align="left" width="15%">STA:<br><input type="text" name="stamina" size="5" value="<?=$scale['stamina']?>"></td>
              <td align="left" width="14%">DEX:<br><input type="text" name="dexterity" size="5" value="<?=$scale['dexterity']?>"></td>
              <td align="left" width="14%">AGI:<br><input type="text" name="agility" size="5" value="<?=$scale['agility']?>"></td>
              <td align="left" width="14%">INT:<br><input type="text" name="intelligence" size="5" value="<?=$scale['intelligence']?>"></td>
              <td align="left" width="14%">WIS:<br><input type="text" name="wisdom" size="5" value="<?=$scale['wisdom']?>"></td>
              <td align="left" width="14%">CHA:<br><input type="text" name="charisma" size="5" value="<?=$scale['charisma']?>"></td>
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
                <td align="left" width="15%">Magic:     <br><input type="text" name="magic_resist" size="5" value="<?=$scale['magic_resist']?>"></td>
                <td align="left" width="15%">Cold:      <br><input type="text" name="cold_resist" size="5" value="<?=$scale['cold_resist']?>"></td>
                <td align="left" width="14%">Fire:      <br><input type="text" name="fire_resist" size="5" value="<?=$scale['fire_resist']?>"></td>
                <td align="left" width="14%">Poison:    <br><input type="text" name="poison_resist" size="5" value="<?=$scale['poison_resist']?>"></td>
                <td align="left" width="14%">Disease:   <br><input type="text" name="disease_resist" size="5" value="<?=$scale['disease_resist']?>"></td>
                <td align="left" width="14%">Corruption:<br><input type="text" name="corruption_resist" size="5" value="<?=$scale['corruption_resist']?>"></td>
                <td align="left" width="14%">Physical:  <br><input type="text" name="physical_resist" size="5" value="<?=$scale['physical_resist']?>"></td>
              </tr>
            </table>
        </fieldset><br>
        <fieldset>
          <legend><strong><font size="4">Combat</font></strong></legend>
          <table width="100%" border="0" cellpadding="3" cellspacing="0">
            <tr>
              <td align="left" width="20%">Min Dmg:     <br><input type="text" name="min_dmg" size="5" value="<?=$scale['min_dmg']?>" onChange="damageCheck();"></td>
              <td align="left" width="20%">HP Regen:    <br><input type="text" name="hp_regen_rate" size="5" value="<?=$scale['hp_regen_rate']?>"></td>
              <td align="left" width="20%">Attack Delay:<br><input type="text" name="attack_delay" size="5" value="<?=$scale['attack_delay']?>"></td>
              <td align="left" width="20%">Spell Scale: <br><input type="text" name="spell_scale" size="5" value="<?=$scale['spell_scale']?>">%</td>
              <td align="left" width="20%">Heal Scale:  <br><input type="text" name="heal_scale" size="5" value="<?=$scale['heal_scale']?>">%</td>
            </tr>
            <tr>
              <td align="left" width="20%">Max Dmg:             <br><input type="text" name="max_dmg" size="5" value="<?=$scale['max_dmg']?>" onChange="damageCheck();"></td>
              <td align="left" width="20%">HP Regen (/sec):     <br><input type="text" name="hp_regen_per_second" size="5" value="<?=$scale['hp_regen_per_second']?>"></td>
              <td align="left" width="20%">Heroic Strikethrough:<br><input type="text" name="heroic_strikethrough" size="5" value="<?=$scale['heroic_strikethrough']?>"></td>
              <td align="left" width="20%">&nbsp;</td>
              <td align="left" width="20%">&nbsp;</td>
            </tr>
          </table>
          <center>
            <table cellpadding="20px">
              <tr>
<?
  $specabil = array();
  $specabilcont = array();

  for ($i = 1; $i <= $special_abilities_max; $i++) {
    if (preg_match("/^$i,/", $scale['special_abilities']) == 1) {
      $specabil[$i] = 1;
      // Leading special ability
      if (preg_match("/^$i,.+?\^/", $scale['special_abilities'], $match) == 1) {
        $specabilcont[$i] = $match[0];
        $specabilcont[$i] = rtrim($specabilcont[$i], "^");
      }
      // Only special ability
      else {
        preg_match("/^$i,.+?\$/", $scale['special_abilities'], $match);
        $specabilcont[$i] = $match[0];
      }  
    }
    elseif (preg_match("/\^$i,/", $scale['special_abilities']) == 1) {
      $specabil[$i] = 1;
      // Middle special ability
      if (preg_match("/\^$i,.+?\^/", $scale['special_abilities'], $match) == 1) {
        $specabilcont[$i] = $match[0];
        $specabilcont[$i] = trim($specabilcont[$i], "^");
      }
      // Trailing special ability
      else {
        preg_match("/\^$i,.+?\$/", $scale['special_abilities'], $match);
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
          <input type="hidden" name="old_type" value="<?=$scale['type']?>">
          <input type="hidden" name="old_level" value="<?=$scale['level']?>">
          <input type="hidden" name="old_zone_id_list" value="<?=$scale['zone_id_list']?>">
          <input type="hidden" name="old_instance_version_list" value="<?=$scale['instance_version_list']?>">
          <input type="submit" value="Update Scale">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back();">
        </center>
      </div>
    </div>
  </form>
