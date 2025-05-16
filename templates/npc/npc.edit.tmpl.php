  <form name="npc_edit" method="post" action="index.php?editor=npc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=2">
    <div class="edit_form">
      <div class="edit_form_header">Edit NPC <?=$npcid?></div>
      <div class="edit_form_content">
        <center>
          <fieldset style="text-align: left;">
            <legend><strong><font size="4">General</font></strong></legend>
            <table width="100%">
              <tr>
                <td valign="top">
                  NPCID:<br>
                  <input type="text" value="<?=$id?>" disabled><br><br>
                    NPC Name:<br><input type="text" name="name" size="40" value="<?=$name?>"><br><br>
                    Title:<br><input type="text" name="lastname" size="40" value="<?=$lastname?>"><br><br>
                    Level:<br><input type="text" name="level" size="10" value="<?=$level?>"<?echo (isset($changed_level))  ? " style='background-color: #FFFF00;'" : "";?>><br><br>
                    Max Level:<br><input type="text" name="maxlevel" size="10" value="<?=$maxlevel?>"<?echo (isset($changed_level)) ? " style='background-color: #FFFF00;'" : "";?>><br><br>
                </td>
                <td valign="top">
                  Race:<br>
                  <select name="race" style="width: 265px;" onChange="raceCheck();">
<?foreach($races as $key=>$value):?>
                    <option value="<?=$key?>"<?echo ($key == $race)? " selected" : "";?>><?=$key?>: <?=$value?></option>
<?endforeach;?>
                  </select><br><br>
                  Class:<br>
                  <select name="class" style="width: 265px;">
<?foreach($classes as $key=>$value):?>
                    <option value="<?=$key?>"<?echo ($key == $class)? " selected" : "";?>><?=$key?>: <?=$value?></option>
<?endforeach;?>
                  </select><br><br>
                  Bodytype:<br>
                  <select name="bodytype" style="width: 265px;">
<?foreach($bodytypes as $key=>$value):?>
                    <option value="<?=$key?>"<?echo ($key == $bodytype)? " selected" : "";?>><?=$key?>: <?=$value?></option>
<?endforeach;?>
                  </select><br><br>
                  Gender:<br>
                  <select name="gender">
<?foreach($genders as $key=>$value):?>
                    <option value="<?=$key?>"<?echo ($key == $gender)? " selected" : "";?>><?=$value?></option>
<?endforeach;?>
                  </select>
                </td>
              </tr>
            </table>
          </fieldset><br>
        </center>
        <fieldset>
          <legend><strong><font size="4">Vitals</font></strong></legend>
          <table width="100%" border="0" cellpadding="3" cellspacing="0">
            <tr>
              <td align="left" width="17%">HP:        <br><input type="text" name="hp" size="10" value="<?=$hp?>"<?echo (isset($changed_level)) ? " style='background-color: #FFFF00;'" : "";?>></td>
              <td align="left" width="17%">Mana:      <br><input type="text" name="mana" size="10" value="<?=$mana?>"<?echo (isset($changed_level)) ? " style='background-color: #FFFF00;'" : "";?>></td>
              <td align="left" width="17%">AC:        <br><input type="text" name="AC" size="10" value="<?=$AC?>"<?echo (isset($changed_level)) ? " style='background-color: #FFFF00;'" : "";?>></td>
              <td align="left" width="17%">Runspeed:  <br><input type="text" name="runspeed" size="10" value="<?=$runspeed?>"></td>
              <td align="left" width="16%">Walkspeed: <br><input type="text" name="walkspeed" size="10" value="<?=$walkspeed?>"></td>
              <td align="left" width="16%">ATK:       <br><input type="text" name="ATK" size="10" value="<?=$ATK?>"></td>
            </tr>
            <tr>
              <td align="left">Accuracy:<br><input type="text" name="Accuracy" size="10" value="<?=$Accuracy?>"></td>
              <td align="left">
                See Invis:<br>
                <input type="text" name="see_invis" size="5" value="<?=$see_invis?>">
              </td>
              <td align="left">
                See ITU:<br>
                <select name="see_invis_undead">
                  <option value="0"<?echo ($see_invis_undead == 0) ? " selected" : "";?>>No</option>
                  <option value="1"<?echo ($see_invis_undead == 1) ? " selected" : "";?>>Yes</option>
                </select>
              </td>
              <td align="left">
                See Hide:<br>
                <select name="see_hide">
                  <option value="0"<?echo ($see_hide == 0) ? " selected" : "";?>>No</option>
                  <option value="1"<?echo ($see_hide == 1) ? " selected" : "";?>>Yes</option>
                </select>
              </td>
              <td align="left">
                See IH:<br>
                <select name="see_improved_hide">
                  <option value="0"<?echo ($see_improved_hide == 0) ? " selected" : "";?>>No</option>
                  <option value="1"<?echo ($see_improved_hide == 1) ? " selected" : "";?>>Yes</option>
                </select>
              </td>
              <td align="left">Avoidance:<br><input type="text" name="Avoidance" size="10" value="<?=$Avoidance?>"></td>
            </tr>
            <tr>
              <td align="left">Scalerate:<br><input type="text" name="scalerate" size="10" value="<?=$scalerate?>"></td>
              <td align="left">&nbsp;</td>
              <td align="left">&nbsp;</td>
              <td align="left">&nbsp;</td>
              <td align="left">&nbsp;</td>
              <td align="left">&nbsp;</td>
            </tr>
          </table>
        </fieldset><br>
        <fieldset>
          <legend><strong><font size="4">Stats</font></strong></legend>
          <table width="100%" border="0" cellpadding="3" cellspacing="0">
            <tr>
              <td align="left" width="14%">STR:<br><input type="text" name="STR" size="5" value="<?=$STR?>"<?echo (isset($changed_level)) ? " style='background-color: #FFFF00;'" : "";?>></td>
              <td align="left" width="14%">STA:<br><input type="text" name="STA" size="5" value="<?=$STA?>"<?echo (isset($changed_level)) ? " style='background-color: #FFFF00;'" : "";?>></td>
              <td align="left" width="14%">DEX:<br><input type="text" name="DEX" size="5" value="<?=$DEX?>"<?echo (isset($changed_level)) ? " style='background-color: #FFFF00;'" : "";?>></td>
              <td align="left" width="14%">AGI:<br><input type="text" name="AGI" size="5" value="<?=$AGI?>"<?echo (isset($changed_level)) ? " style='background-color: #FFFF00;'" : "";?>></td>
              <td align="left" width="14%">INT:<br><input type="text" name="_INT" size="5" value="<?=$_INT?>"<?echo (isset($changed_level)) ? " style='background-color: #FFFF00;'" : "";?>></td>
              <td align="left" width="15%">WIS:<br><input type="text" name="WIS" size="5" value="<?=$WIS?>"<?echo (isset($changed_level)) ? " style='background-color: #FFFF00;'" : "";?>></td>
              <td align="left" width="15%">CHA:<br><input type="text" name="CHA" size="5" value="<?=$CHA?>"<?echo (isset($changed_level)) ? " style='background-color: #FFFF00;'" : "";?>></td>
            </tr>
          </table>
        </fieldset><br>
        <fieldset>
          <legend><strong><font size="4">Charmed Stats</font></strong></legend>
          <table width="100%" border="0" cellpadding="3" cellspacing="0">
            <tr>
              <td colspan="7">0 = Not Used</td>
            </tr>
            <tr>
              <td align="left" width="14%">AC:<br><input type="text" name="charm_ac" size="5" value="<?=$charm_ac?>"></td>
              <td align="left" width="14%">Min Dmg:<br><input type="text" name="charm_min_dmg" size="5" value="<?=$charm_min_dmg?>"></td>
              <td align="left" width="14%">Max Dmg:<br><input type="text" name="charm_max_dmg" size="5" value="<?=$charm_max_dmg?>"></td>
              <td align="left" width="14%">Atk:<br><input type="text" name="charm_atk" size="5" value="<?=$charm_atk?>"></td>
              <td align="left" width="14%">Atk Delay:<br><input type="text" name="charm_attack_delay" size="5" value="<?=$charm_attack_delay?>"></td>
              <td align="left" width="15%">Accuracy:<br><input type="text" name="charm_accuracy_rating" size="5" value="<?=$charm_accuracy_rating?>"></td>
              <td align="left" width="15%">Avoidance:<br><input type="text" name="charm_avoidance_rating" size="5" value="<?=$charm_avoidance_rating?>"></td>
            </tr>
          </table>
        </fieldset><br>
        <fieldset>
          <legend><strong><font size="4">Resists</font></strong></legend>
          <table width="100%" border="0" cellpadding="3" cellspacing="0">
            <tr>
              <td colspan="7">1 Resist = 0.5%<br>200 Resist = 100%</td>
            </tr>
            <tr>
              <td align="left" width="13%">MR:      <br><input type="text" name="MR" size="5" value="<?=$MR?>"<?echo (isset($changed_level)) ? " style='background-color: #FFFF00;'" : "";?>></td>
              <td align="left" width="13%">CR:      <br><input type="text" name="CR" size="5" value="<?=$CR?>"<?echo (isset($changed_level)) ? " style='background-color: #FFFF00;'" : "";?>></td>
              <td align="left" width="13%">FR:      <br><input type="text" name="FR" size="5" value="<?=$FR?>"<?echo (isset($changed_level)) ? " style='background-color: #FFFF00;'" : "";?>></td>
              <td align="left" width="13%">PR:      <br><input type="text" name="PR" size="5" value="<?=$PR?>"<?echo (isset($changed_level)) ? " style='background-color: #FFFF00;'" : "";?>></td>
              <td align="left" width="13%">DR:      <br><input type="text" name="DR" size="5" value="<?=$DR?>"<?echo (isset($changed_level)) ? " style='background-color: #FFFF00;'" : "";?>></td>
              <td align="left" width="15%">Corrup:  <br><input type="text" name="Corrup" size="5" value="<?=$Corrup?>"></td>
<?
  $PhR_Default = 15 + ($level / 3);
  if ($level > 50)
    $PhR_Default += (3 * ($level - 50));
?>
              <td align="left" width="20%">Physical: <a title="Set to Calculated Default" onClick="document.getElementById('PhR').value='<?echo round($PhR_Default, 4);?>';"><img src="images/refresh.gif" width="10"></a><br><input type="text" id="PhR" name="PhR" size="5" value="<?=$PhR?>"></td>
            </tr>
          </table>
        </fieldset><br>
        <fieldset>
          <legend><strong><font size="4">Combat</font></strong></legend>
          <table width="100%" border="0" cellpadding="3" cellspacing="0">
            <tr>
              <td align="left" width="14%">Min Dmg:      <br><input type="text" name="mindmg" size="5" value="<?=$mindmg?>"<?echo (isset($changed_level)) ? " style='background-color: #FFFF00;'" : "";?> onChange="sdamageCheck();"></td>
              <td align="left" width="14%">HP Regen:     <br><input type="text" name="hp_regen_rate" size="5" value="<?=$hp_regen_rate?>"></td>
              <td align="left" width="14%">HP Reg (/sec):<br><input type="text" name="hp_regen_per_second" size="5" value="<?=$hp_regen_per_second?>"></td>
              <td align="left" width="14%">Attack Count: <br><input type="text" name="attack_count" size="5" value="<?=$attack_count?>"></td>
              <td align="left" width="14%">Atk Delay:    <br><input type="text" name="attack_delay" size="5" value="<?=$attack_delay?>"<?echo (isset($changed_level)) ? " style='background-color: #FFFF00;'" : "";?>></td>
              <td align="left" width="15%">Spells ID:    <br><input type="text" name="npc_spells_id" size="5" value="<?=$npc_spells_id?>"></td>
              <td align="left" width="15%">Spell Scale:  <br><input type="text" name="spellscale" size="5" value="<?=$spellscale?>">%</td>
            </tr>
            <tr>
              <td align="left" width="14%">Max Dmg:     <br><input type="text" name="maxdmg" size="5" value="<?=$maxdmg?>"<?echo (isset($changed_level)) ? " style='background-color: #FFFF00;'" : "";?> onChange="sdamageCheck();"></td>
              <td align="left" width="14%">MP Regen:    <br><input type="text" name="mana_regen_rate" size="5" value="<?=$mana_regen_rate?>"></td>
              <td align="left" width="14%">Aggroradius: <br><input type="text" name="aggroradius" size="5" value="<?=$aggroradius?>"></td>
              <td align="left" width="14%">Assistradius:<br><input type="text" name="assistradius" size="5" value="<?=$assistradius?>"></td>
              <td align="left" width="14%">Always Aggro:<br><input type="text" name="always_aggro" size="5" value="<?=$always_aggro?>"></td>
              <td align="left" width="14%">Slow Mit:    <br><input type="text" name="slow_mitigation" size="5" value="<?=$slow_mitigation?>"></td>
              <td align="left" width="15%">Heal Scale:  <br><input type="text" name="healscale" size="5" value="<?=$healscale?>">%</td>
            </tr>
            <tr>
              <td align="left" width="14%">Heroic Strikethrough:<br><input type="text" name="heroic_strikethrough" size="5" value="<?=$heroic_strikethrough?>"></td>
              <td align="left" width="14%">&nbsp;</td>
              <td align="left" width="14%">&nbsp;</td>
              <td align="left" width="14%">&nbsp;</td>
              <td align="left" width="14%">&nbsp;</td>
              <td align="left" width="14%">&nbsp;</td>
              <td align="left" width="15%">&nbsp;</td>
            </tr>
          </table>
          <center>
            <table cellpadding="20px">
              <tr>
<?
  $specabil = array();
  $specabilcont = array();

  for ($i = 1; $i <= $special_abilities_max; $i++) {
    if (preg_match("/^$i,/", $special_abilities) == 1) {
      $specabil[$i] = 1;
      // Leading special ability
      if (preg_match("/^$i,.+?\^/", $special_abilities, $match) == 1) {
        $specabilcont[$i] = $match[0];
        $specabilcont[$i] = rtrim($specabilcont[$i], "^");
      }
      // Only special ability
      else {
        preg_match("/^$i,.+?\$/", $special_abilities, $match);
        $specabilcont[$i] = $match[0];
      }  
    }
    elseif (preg_match("/\^$i,/", $special_abilities) == 1) {
      $specabil[$i] = 1;
      // Middle special ability
      if (preg_match("/\^$i,.+?\^/", $special_abilities, $match) == 1) {
        $specabilcont[$i] = $match[0];
        $specabilcont[$i] = trim($specabilcont[$i], "^");
      }
      // Trailing special ability
      else {
        preg_match("/\^$i,.+?\$/", $special_abilities, $match);
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
                  Leashed (32):<br><input type="text" name="32" size="10" value="<?echo (isset($specabilcont[32])) ? $specabilcont[32] : "";?>" onChange="tetherCheck();"><br>
                  Tethered (33):<br><input type="text" name="33" size="10" value="<?echo (isset($specabilcont[33])) ? $specabilcont[33] : "";?>" onChange="tetherCheck();"><br>
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
                  <input type="checkbox" name="npc_aggro" value="1"<?echo ($npc_aggro == 1) ? " checked" : "";?>> Can Aggro NPCs<br>
                  <input type="checkbox" name="30" value="30,1^"<?echo ($specabil[30] == 1) ? " checked" : "";?>> Does NOT buff/heal friends (30)<br>
                  <input type="checkbox" name="36" value="36,1^"<?echo ($specabil[36] == 1) ? " checked" : "";?>> Always Flee (36)<br>
                  <input type="checkbox" name="38" value="38,1^"<?echo ($specabil[38] == 1) ? " checked" : "";?>> Allow Beneficial (38)<br>
                  <input type="checkbox" name="41" value="41,1^"<?echo ($specabil[41] == 1) ? " checked" : "";?>> Allow Tank (41)<br>
                  <input type="checkbox" name="45" value="45,1^"<?echo ($specabil[45] == 1) ? " checked" : "";?>> Prox Aggro (45)<br>
                  <input type="checkbox" name="46" value="46,1^"<?echo ($specabil[46] == 1) ? " checked" : "";?>> Immune to Ranged Attacks (46)<br>
                </td>
              </tr>
            </table>
          </center>
        </fieldset><br>
        <fieldset>
          <legend><strong><font size="4">Appearance</font></strong></legend>
          <table width="100%" border="0" cellpadding="3" cellspacing="0">
            <tr>
              <td align="left" width="17%">Size:       <br><input type="text" name="size" size="10" value="<?=$size?>"></td>
              <td align="left" width="17%">Texture:    <br><input type="text" name="texture" size="10" value="<?=$texture?>"></td>
              <td align="left" width="17%">HelmTexture:<br><input type="text" name="helmtexture" size="10" value="<?=$helmtexture?>"></td>
              <td align="left" width="17%">Face:       <br><input type="text" name="face" size="10" value="<?=$face?>"></td>
              <td align="left" width="16%">Haircolor:  <br><input type="text" name="luclin_haircolor" size="10" value="<?=$luclin_haircolor?>"></td>
              <td align="left" width="16%">Hairstyle:  <br><input type="text" name="luclin_hairstyle" size="10" value="<?=$luclin_hairstyle?>"></td>
            </tr>
            <tr>
              <td align="left" width="17%">Eyecolor:  <br><input type="text" name="luclin_eyecolor" size="10" value="<?=$luclin_eyecolor?>"></td>
              <td align="left" width="17%">Eyecolor2: <br><input type="text" name="luclin_eyecolor2" size="10" value="<?=$luclin_eyecolor2?>"></td>
              <td align="left" width="17%">Beard:     <br><input type="text" name="luclin_beard" size="10" value="<?=$luclin_beard?>"></td>
              <td align="left" width="17%">Beardcolor:<br><input type="text" name="luclin_beardcolor" size="10" value="<?=$luclin_beardcolor?>"></td>
              <td align="left" width="16%">Melee1:    <br><input type="text" name="d_melee_texture1" size="10" value="<?=$d_melee_texture1?>"></td>
              <td align="left" width="16%">Melee2:    <br><input type="text" name="d_melee_texture2" size="10" value="<?=$d_melee_texture2?>"></td>
            </tr>
            <tr>
              <td align="left" width="17%">Heritage:   <br><input type="text" name="drakkin_heritage" size="10" value="<?=$drakkin_heritage?>"></td>
              <td align="left" width="17%">Tattoo:     <br><input type="text" name="drakkin_tattoo" size="10" value="<?=$drakkin_tattoo?>"></td>
              <td align="left" width="17%">Details:    <br><input type="text" name="drakkin_details" size="10" value="<?=$drakkin_details?>"></td>
              <td align="left" width="17%">Armor Red:  <br><input type="text" name="armortint_red" size="10" value="<?=$armortint_red?>"></td>
              <td align="left" width="16%">Armor Green:<br><input type="text" name="armortint_green" size="10" value="<?=$armortint_green?>"></td>
              <td align="left" width="16%">Armor Blue: <br><input type="text" name="armortint_blue" size="10" value="<?=$armortint_blue?>"></td>
            </tr>
            <tr>
              <td align="left" width="17%">Hero's Forge Model:<br><input type="text" name="herosforgemodel" size="10" value="<?=$herosforgemodel?>"></td>
              <td align="left" width="17%">Light Source:<br><input type="text" name="light" size="10" value="<?=$light?>"></td>
              <td align="left" width="17%">Model:<br><input type="text" name="model" size="10" value="<?=$model?>"></td>
              <td align="left" width="17%">
                Show Name:<br>
                <select name="show_name">
                  <option value="0"<?echo ($show_name == 0) ? " selected" : "";?>>No (0)</option>
                  <option value="1"<?echo ($show_name == 1) ? " selected" : "";?>>Yes (1)</option>
                </select>
              </td>
              <td align="left" width="16%">NPC Tint ID:<br><input type="text" name="npc_tint_id" size="10" value="<?=$npc_tint_id?>"></td>
              <td align="left" width="16%">&nbsp;</td>
            </tr>
          </table>
          <table width="100%" border="0" cellpadding="3" cellspacing="0">
            <tr>
              <td align="left" width="50%">
                Melee1 Type:<br>
                <select name="prim_melee_type" style="width: 200px;">
<?foreach($skilltypes as $key=>$value):?>
                  <option value="<?=$key?>"<?echo ($key == $prim_melee_type) ? " selected" : "";?>><?=$key?>: <?=$value?></option>
<?endforeach;?>
                </select>
              </td>
              <td align="left" width="50%">
                Melee2 Type:<br>
                <select name="sec_melee_type" style="width: 200px;">
<?foreach($skilltypes as $key=>$value):?>
                  <option value="<?=$key?>"<?echo ($key == $sec_melee_type) ? " selected" : "";?>><?=$key?>: <?=$value?></option>
<?endforeach;?>
                </select>
              </td>
            </tr>
          </table>
        </fieldset><br>
        <fieldset>
          <legend><strong><font size="4">Experience/Loot</font></strong></legend>
          <table width="100%" border="0" cellpadding="3" cellspacing="0">
            <tr>
              <td align="left" width="33%">Loottable ID:<br><input type="text" name="loottable_id" size="5" value="<?=$loottable_id?>"></td>
              <td align="left" width="33%"><input type="checkbox" name="private_corpse" value="1"<?echo ($private_corpse == 1) ? " checked" : "";?>> Corpse does not Unlock</td>
              <td align="left" width="34%"><input type="checkbox" name="skip_global_loot" value="1"<?echo ($skip_global_loot == 1) ? " checked" : "";?>> Skip Global Loot</td>
            </tr>
            <tr>
              <td align="left" width="33%">Experience Mod:<br><input type="text" name="exp_mod" size="5" value="<?=$exp_mod?>"></td>
              <td align="left" width="33%">&nbsp;</td>
              <td align="left" width="34%">&nbsp;</td>
            </tr>
          </table>
        </fieldset><br>
        <fieldset>
          <legend><strong><font size="4">Misc</font></strong></legend>
          <table width="100%" border="0" cellpadding="3" cellspacing="0">
            <tr>
              <td align="left" width="17%">Spawn Limit:     <br><input type="text" name="spawn_limit" size="10" value="<?=$spawn_limit?>"></td>
              <td align="left" width="17%">Version:         <br><input type="text" name="version" size="10" value="<?=$version?>"></td>
              <td align="left" width="17%">Emote:           <br><input type="text" name="emoteid" size="10" value="<?=$emoteid?>"></td>
              <td align="left" width="17%">No Target Hotkey:<br><input type="text" name="no_target_hotkey" size="10" value="<?=$no_target_hotkey?>"></td>
              <td align="left" width="16%">Raid Target:     <br><input type="text" name="raid_target" size="5" value="<?=$raid_target?>"></td>
              <td align="left" width="16%">
                Stuck Behavior:<br>
                <select name="stuck_behavior" onChange="underwaterCheck();">
<?foreach ($stuck as $key=>$value):?>
                  <option value="<?=$key?>"<?echo ($stuck_behavior == $key) ? " selected" : "";?>><?=$key?>: <?=$value?></option>
<?endforeach;?>
                </select>
              </td>
            </tr>
            <tr>
              <td align="left" width="17%">
                Flymode:<br>
                <select name="flymode">
<?foreach ($flymodetype as $key=>$value):?>
                  <option value="<?=$key?>"<?echo ($flymode == $key) ? " selected" : "";?>><?=$key?>: <?=$value?></option>
<?endforeach;?>
                </select>
              </td>
              <td align="left" width="17%">
                Faction Amt:<br>
                <input type="text" size="10" name="faction_amount" value="<?=$faction_amount?>">
              </td>
              <td align="left" width="17%">
                Keeps Sold Items:<br>
                <input type="text" size="10" name="keeps_sold_items" value="<?=$keeps_sold_items?>">
              </td>
              <td align="left" width="17%">
                Trap Template:<br>
                <input type="text" size="10" name="trap_template" value="<?=$trap_template?>">
              </td>
              <td align="left" width="16%">
                Parcel Merchant:<br>
                <select name="is_parcel_merchant">
                  <option value="0"<?echo ($is_parcel_merchant == 0) ? " selected" : ""?>>No (0)</option>
                  <option value="1"<?echo ($is_parcel_merchant == 1) ? " selected" : ""?>>Yes (1)</option>
                </select>
              </td>
              <td align="left" width="16%">
                Multiquest:<br>
                <select name="multiquest_enabled">
                  <option value="0"<?echo ($multiquest_enabled == 0) ? " selected" : ""?>>No (0)</option>
                  <option value="1"<?echo ($multiquest_enabled == 1) ? " selected" : ""?>>Yes (1)</option>
                </select>
              </td>
            </tr>
            <tr>
              <td align="left" width="17%">
                Merchant ID:<br>
                <input type="text" size="10" name="merchant_id" value="<?=$merchant_id?>">
              </td>
              <td align="left" width="17%">
                Greed:<br>
                <input type="text" size="10" name="greed" value="<?=$greed?>">
              </td>
              <td align="left" width="17%">&nbsp;</td>
              <td align="left" width="17%">&nbsp;</td>
              <td align="left" width="16%">&nbsp;</td>
              <td align="left" width="16%">&nbsp;</td>
            </tr>
          </table><br>
          <center>
            <table cellpadding="20px">
              <tr>
                <td valign="top" align="left">
                  <input type="checkbox" name="qglobal" value="1"<?echo ($qglobal == 1) ? " checked" : "";?>> Enable Quest Globals<br>
                  <input type="checkbox" name="pet" value="1"<?echo ($pet == 1) ? " checked" : "";?>> NPC is a Pet<br>
                  <input type="checkbox" name="unique_spawn_by_name" value="1"<?echo ($unique_spawn_by_name == 1) ? " checked" : "";?>> Unique by Name<br>
                </td>
                <td valign="top" align="left">
                  <input type="checkbox" name="isquest" value="1"<?echo ($isquest == 1) ? " checked" : "";?>> Has Quest File<br>
                  <input type="checkbox" name="34" value="34,1^"<?echo ($specabil[34] == 1) ? " checked" : "";?>>  Destructible Object (34)<br>
                  <input type="checkbox" name="rare_spawn" value="1"<?echo ($rare_spawn == 1) ? " checked" : "";?>> Rare Spawn<br>
                </td>
                <td valign="top" align="left">
                  <input type="checkbox" name="findable" value="1"<?echo ($findable == 1) ? " checked" : "";?> onChange="raceCheck();"> NPC is Findable<br>
                  <input type="checkbox" name="underwater" value="1"<?echo ($underwater == 1) ? " checked" : "";?> onChange="underwaterCheck();"> Underwater NPC<br>
                  <input type="checkbox" name="ignore_despawn" value="1"<?echo ($ignore_despawn == 1) ? " checked" : "";?>> Ignore Despawn<br>
                </td>
                <td valign="top" align="left">
                  <input type="checkbox" name="trackable" value="1"<?echo ($trackable == 1) ? " checked" : "";?> onChange="raceCheck();"> NPC is Trackable<br>
                  &nbsp;<br>
                  &nbsp;<br>
                </td>
              </tr>
            </table>
          </center>
        </fieldset><br>
        <center>
          <input type="hidden" name="id" value="<?=$npcid?>">
          <input type="submit" value="Update NPC">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back();">
        </center>
      </div>
    </div>
  </form>
