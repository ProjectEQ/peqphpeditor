  <form name="add_npc_scale" method="post" action="index.php?editor=npc&action=91">
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
                  <option value="<?=$k?>"><?=$v?> (<?=$k?>)</option>
<?endforeach;?>
                </select>
              </td>
              <td align="left" width="20%">Level:                    <br><input type="text" name="level" size="10" value=""></td>
              <td align="left" width="30%">Zones: (| = Delimiter)    <br><input type="text" name="zone_id_list" size="25" value=""></td>
              <td align="left" width="30%">Instances: (| = Delimiter)<br><input type="text" name="instance_version_list" size="25" value=""></td>
            </tr>
          </table>
        </fieldset><br>
        <fieldset>
          <legend><strong><font size="4">Vitals</font></strong></legend>
          <table width="100%" border="0" cellpadding="3" cellspacing="0">
            <tr>
              <td align="left" width="17%">HP:             <br><input type="text" name="hp" size="10" value="0"></td>
              <td align="left" width="17%">AC:             <br><input type="text" name="ac" size="10" value="0"></td>
              <td align="left" width="17%">Attack:         <br><input type="text" name="attack" size="10" value="0"></td>
              <td align="left" width="17%">Accuracy:       <br><input type="text" name="accuracy" size="10" value="0"></td>
              <td align="left" width="16%">Slow Mitigation:<br><input type="text" name="slow_mitigation" size="10" value="0"></td>
              <td align="left" width="16%">Avoidance:      <br><input type="text" name="avoidance" size="10" value="0"></td>
            </tr>
          </table>
        </fieldset><br>
        <fieldset>
          <legend><strong><font size="4">Stats</font></strong></legend>
          <table width="100%" border="0" cellpadding="3" cellspacing="0">
            <tr>
              <td align="left" width="15%">STR:<br><input type="text" name="strength" size="5" value="0"></td>
              <td align="left" width="15%">STA:<br><input type="text" name="stamina" size="5" value="0"></td>
              <td align="left" width="14%">DEX:<br><input type="text" name="dexterity" size="5" value="0"></td>
              <td align="left" width="14%">AGI:<br><input type="text" name="agility" size="5" value="0"></td>
              <td align="left" width="14%">INT:<br><input type="text" name="intelligence" size="5" value="0"></td>
              <td align="left" width="14%">WIS:<br><input type="text" name="wisdom" size="5" value="0"></td>
              <td align="left" width="14%">CHA:<br><input type="text" name="charisma" size="5" value="0"></td>
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
                <td align="left" width="15%">Magic:     <br><input type="text" name="magic_resist" size="5" value="0"></td>
                <td align="left" width="15%">Cold:      <br><input type="text" name="cold_resist" size="5" value="0"></td>
                <td align="left" width="14%">Fire:      <br><input type="text" name="fire_resist" size="5" value="0"></td>
                <td align="left" width="14%">Poison:    <br><input type="text" name="poison_resist" size="5" value="0"></td>
                <td align="left" width="14%">Disease:   <br><input type="text" name="disease_resist" size="5" value="0"></td>
                <td align="left" width="14%">Corruption:<br><input type="text" name="corruption_resist" size="5" value="0"></td>
                <td align="left" width="14%">Physical:  <br><input type="text" name="physical_resist" size="5" value="0"></td>
              </tr>
            </table>
        </fieldset><br>
        <fieldset>
          <legend><strong><font size="4">Combat</font></strong></legend>
          <table width="100%" border="0" cellpadding="3" cellspacing="0">
            <tr>
              <td align="left" width="20%">Min Dmg:     <br><input type="text" name="min_dmg" size="5" value="0" onChange="damageCheck();"></td>
              <td align="left" width="20%">HP Regen:    <br><input type="text" name="hp_regen_rate" size="5" value="0"></td>
              <td align="left" width="20%">Attack Delay:<br><input type="text" name="attack_delay" size="5" value="0"></td>
              <td align="left" width="20%">Spell Scale: <br><input type="text" name="spell_scale" size="5" value="100">%</td>
              <td align="left" width="20%">Heal Scale:  <br><input type="text" name="heal_scale" size="5" value="100">%</td>
            </tr>
            <tr>
              <td align="left" width="20%">Max Dmg:             <br><input type="text" name="max_dmg" size="5" value="0" onChange="damageCheck();"></td>
              <td align="left" width="20%">HP Regen (/sec):     <br><input type="text" name="hp_regen_per_second" size="5" value="0"></td>
              <td align="left" width="20%">Heroic Strikethrough:<br><input type="text" name="heroic_strikethrough" size="5" value="0"></td>
              <td align="left" width="20%">&nbsp;</td>
              <td align="left" width="20%">&nbsp;</td>
            </tr>
          </table>
          <center>
            <table cellpadding="20px">
              <tr>
                <td valign="top" align="left">
                  Summon (1):<br><input type="text" name="1" size="10"><br>
                  Enrage (2):<br><input type="text" name="2" size="10"><br>
                  Rampage (3):<br><input type="text" name="3" size="10"><br>
                  AE Rampage (4):<br><input type="text" name="4" size="10"><br>
                  Flurry (5):<br><input type="text" name="5" size="10"><br>
                  Tunnel Vision (29):<br><input type="text" name="29" size="10"><br>
                  Leashed (32):<br><input type="text" name="32" size="10"><br>
                  Tethered (33):<br><input type="text" name="33" size="10"><br>
                  Flee Percent (37):<br><input type="text" name="37" size="10"><br>
                  Chase Distance (40):<br><input type="text" name="40" size="10"><br>
                  Casting Resist Diff (43):<br><input type="text" name="43" size="10"><br>
                  Counter Avoid Damage (44):<br><input type="text" name="44" size="10"><br>
                </td>
                <td valign="top" align="left">
                  <input type="checkbox" name="6" value="6,1^"> Triple Attack (6)<br>
                  <input type="checkbox" name="7" value="7,1^"> Quad Attack (7)<br>
                  <input type="checkbox" name="10" value="10,1^"> Magic Attack (10)<br>
                  <input type="checkbox" name="9" value="9,1^"> Bane Attack (9)<br>
                  <input type="checkbox" name="8" value="8,1^"> Dual Wield (8)<br>
                  <input type="checkbox" name="11" value="11,1^"> Ranged Attack (11)<br>
                  <input type="checkbox" name="12" value="12,1^"> Unslowable (12)<br>
                  <input type="checkbox" name="13" value="13,1^"> Unmezable (13)<br>
                  <input type="checkbox" name="14" value="14,1^"> Uncharmable (14)<br>
                  <input type="checkbox" name="15" value="15,1^"> Unstunable (15)<br>
                  <input type="checkbox" name="16" value="16,1^"> Unsnareable (16)<br>
                  <input type="checkbox" name="17" value="17,1^"> Unfearable (17)<br>
                  <input type="checkbox" name="31" value="31,1^"> Unpacifiable (31)<br>
                  <input type="checkbox" name="18" value="18,1^"> Immune to Dispell (18)<br>
                  <input type="checkbox" name="35" value="35,1^"> No Harm from Players (35)<br>
                  <input type="checkbox" name="39" value="39,1^"> Disable Melee (39)<br>
                  <input type="checkbox" name="42" value="42,1^"> Ignore Root Aggro (42)<br>
                </td>
                <td valign="top" align="left">
                  <input type="checkbox" name="26" value="26,1^"> Resist Ranged Spells (26)<br>
                  <input type="checkbox" name="28" value="28,1^"> Immune to Taunt (28)<br>
                  <input type="checkbox" name="19" value="19,1^"> Immune to Melee (19)<br>
                  <input type="checkbox" name="20" value="20,1^"> Immune to Magic (20)<br>
                  <input type="checkbox" name="21" value="21,1^"> Immune to Fleeing (21)<br>
                  <input type="checkbox" name="23" value="23,1^"> Immune to non-Magical Melee (23)<br>
                  <input type="checkbox" name="22" value="22,1^"> Immune to non-Bane Melee (22)<br>
                  <input type="checkbox" name="24" value="24,1^"> Will Not Aggro (24)<br>
                  <input type="checkbox" name="25" value="25,1^"> Immune to Aggro (25)<br>
                  <input type="checkbox" name="27" value="27,1^"> See through Feign Death (27)<br>
                  <input type="checkbox" name="30" value="30,1^"> Does NOT buff/heal friends (30)<br>
                  <input type="checkbox" name="36" value="36,1^"> Always Flee (36)<br>
                  <input type="checkbox" name="38" value="38,1^"> Allow Beneficial (38)<br>
                  <input type="checkbox" name="41" value="41,1^"> Allow Tank (41)<br>
                  <input type="checkbox" name="45" value="45,1^"> Prox Aggro (45)<br>
                  <input type="checkbox" name="46" value="46,1^"> Immune to Ranged Attacks (46)<br>
                  <input type="checkbox" name="34" value="34,1^"> Destructible Object (34)<br>
                </td>
              </tr>
            </table>
          </center>
        </fieldset><br>
        <center>
          <input type="submit" value="Insert Scale">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back();">
        </center>
      </div>
    </div>
  </form>
