  <form name="npc_add" method="post" action="index.php?editor=npc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&action=26">
    <div class="edit_form">
      <div class="edit_form_header">Add an NPC to <?=$currzone?></div>
      <div class="edit_form_content">
        <center>
          <fieldset style="text-align: left;">
            <legend><strong><font size="4">General</font></strong></legend>
            <table width="100%">
              <tr>
                <td valign="top">
                  NPCID:<br>
                  <input type="text" name="id" value="<?=$suggestedid?>"><br><br>
                  NPC Name: <br><input type="text" name="name" size="40" value=""><br><br>
                  Title:    <br><input type="text" name="lastname" size="40" value=""><br><br>
                  Level:    <br><input type="text" name="level" size="10" value="<?=$level?>"><br><br>
                  Max Level:<br><input type="text" name="maxlevel" size="10" value="0"><br><br>
                </td>
                <td valign="top">
                  Race:<br>
                  <select name="race" style="width: 265px;" onChange="raceCheck();">
<?foreach($races as $key=>$value):?>
                    <option value="<?=$key?>"<?echo ($key == 1)? " selected" : "";?>><?=$key?>: <?=$value?></option>
<?endforeach;?>
                  </select><br><br>
                  Class:<br>
                  <select name="class" style="width: 265px;">
<?foreach($classes as $key=>$value):?>
                    <option value="<?=$key?>"<?echo ($key == 1)? " selected" : "";?>><?=$key?>: <?=$value?></option>
<?endforeach;?>
                  </select><br><br>
                  Bodytype:<br>
                  <select name="bodytype" style="width: 265px;">
<?foreach($bodytypes as $key=>$value):?>
                    <option value="<?=$key?>"<?echo ($key == 1)? " selected" : "";?>><?=$key?>: <?=$value?></option>
<?endforeach;?>
                  </select><br><br>
                  Gender:<br>
                  <select name="gender">
<?foreach($genders as $key=>$value):?>
                    <option value="<?=$key?>"><?=$value?></option>
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
              <td align="left" width="17%">HP:       <br><input type="text" name="hp" size="10" value="<?=$hp?>"></td>
              <td align="left" width="17%">Mana:     <br><input type="text" name="mana" size="10" value="<?=$mana?>"></td>
              <td align="left" width="17%">AC:       <br><input type="text" name="AC" size="10" value="<?=$AC?>"></td>
              <td align="left" width="17%">Runspeed: <br><input type="text" name="runspeed" size="10" value="1.25"></td>
              <td align="left" width="16%">ATK:      <br><input type="text" name="ATK" size="10" value="0"></td>
              <td align="left" width="16%">Accuracy: <br><input type="text" name="Accuracy" size="10" value="0"></td>
            </tr>
            <tr>
              <td align="left">
                See Invis:<br>
                <input type="text" name="see_invis" size="5" value="0">
              </td>
              <td align="left">
                See ITU:<br>
                <select name="see_invis_undead">
                  <option value="0">No</option>
                  <option value="1">Yes</option>
                </select>
              </td>
              <td align="left">
                See Hide:<br>
                <select name="see_hide">
                  <option value="0">No</option>
                  <option value="1">Yes</option>
                </select>
              </td>
              <td align="left">
                See IH:<br>
                <select name="see_improved_hide">
                  <option value="0">No</option>
                  <option value="1">Yes</option>
                </select>
              </td>
              <td align="left">Avoidance:<br><input type="text" name="Avoidance" size="10" value="0"></td>
              <td align="left">Scalerate:<br><input type="text" name="scalerate" size="10" value="100"></td>
            </tr>
          </table>
        </fieldset><br>
        <fieldset>
          <legend><strong><font size="4">Stats</font></strong></legend>
          <table width="100%" border="0" cellpadding="3" cellspacing="0">
            <tr>
              <td align="left" width="14%">STR:<br><input type="text" name="STR" size="5" value="<?=$stats?>"></td>
              <td align="left" width="14%">STA:<br><input type="text" name="STA" size="5" value="<?=$stats?>"></td>
              <td align="left" width="14%">DEX:<br><input type="text" name="DEX" size="5" value="<?=$stats?>"></td>
              <td align="left" width="14%">AGI:<br><input type="text" name="AGI" size="5" value="<?=$stats?>"></td>
              <td align="left" width="14%">INT:<br><input type="text" name="_INT" size="5" value="<?=$stats?>"></td>
              <td align="left" width="15%">WIS:<br><input type="text" name="WIS" size="5" value="<?=$stats?>"></td>
              <td align="left" width="15%">CHA:<br><input type="text" name="CHA" size="5" value="<?=$stats?>"></td>
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
              <td align="left" width="14%">AC:<br><input type="text" name="charm_ac" size="5" value="0"></td>
              <td align="left" width="14%">Min Dmg:<br><input type="text" name="charm_min_dmg" size="5" value="0"></td>
              <td align="left" width="14%">Max Dmg:<br><input type="text" name="charm_max_dmg" size="5" value="0"></td>
              <td align="left" width="14%">Atk:<br><input type="text" name="charm_atk" size="5" value="0"></td>
              <td align="left" width="14%">Atk Delay:<br><input type="text" name="charm_attack_delay" size="5" value="0"></td>
              <td align="left" width="15%">Accuracy:<br><input type="text" name="charm_accuracy_rating" size="5" value="0"></td>
              <td align="left" width="15%">Avoidance:<br><input type="text" name="charm_avoidance_rating" size="5" value="0"></td>
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
              <td align="left" width="13%">MR:      <br><input type="text" name="MR" size="5" value="<?=$resists?>"></td>
              <td align="left" width="13%">CR:      <br><input type="text" name="CR" size="5" value="<?=$resists?>"></td>
              <td align="left" width="13%">FR:      <br><input type="text" name="FR" size="5" value="<?=$resists?>"></td>
              <td align="left" width="13%">PR:      <br><input type="text" name="PR" size="5" value="<?=$resists?>"></td>
              <td align="left" width="13%">DR:      <br><input type="text" name="DR" size="5" value="<?=$resists?>"></td>
              <td align="left" width="15%">Corrup:  <br><input type="text" name="Corrup" size="5" value="<?=$resists?>"></td>
<?
  $PhR_Default = 15 + ($level / 3);
  if ($level > 50)
    $PhR_Default += (3 * ($level - 50));
?>
              <td align="left" width="20%">Physical: <a title="Set to Calculated Default" onClick="document.getElementById('PhR').value='<?echo round($PhR_Default, 4);?>';"><img src="images/refresh.gif" width="10"></a><br><input type="text" id="PhR" name="PhR" size="8" value="<?echo round($PhR_Default, 4);?>"></td>
            </tr>
          </table>
        </fieldset><br>
        <fieldset>
          <legend><strong><font size="4">Combat</font></strong></legend>
          <table width="100%" border="0" cellpadding="3" cellspacing="0">
            <tr>
              <td align="left" width="14%">Min Dmg:      <br><input type="text" name="mindmg" size="5" value="<?=$mindmg?>" onChange="sdamageCheck();"></td>
              <td align="left" width="14%">HP Regen:     <br><input type="text" name="hp_regen_rate" size="5" value="0"></td>
              <td align="left" width="14%">HP Reg (/sec):<br><input type="text" name="hp_regen_per_second" size="5" value="0"></td>
              <td align="left" width="14%">Attack Count: <br><input type="text" name="attack_count" size="5" value="-1"></td>
              <td align="left" width="14%">Atk Delay:    <br><input type="text" name="attack_delay" size="5" value="<?=$attack_delay?>"></td>
              <td align="left" width="15%">Spells ID:    <br><input type="text" name="npc_spells_id" size="5" value="0"></td>
              <td align="left" width="15%">Spell Scale:  <br><input type="text" name="spellscale" size="5" value="100">%</td>
            </tr>
            <tr>
              <td align="left" width="14%">Max Dmg:     <br><input type="text" name="maxdmg" size="5" value="<?=$maxdmg?>" onChange="sdamageCheck();"></td>
              <td align="left" width="14%">MP Regen:    <br><input type="text" name="mana_regen_rate" size="5" value="0"></td>
              <td align="left" width="14%">Aggroradius: <br><input type="text" name="aggroradius" size="5" value="70"></td>
              <td align="left" width="14%">Assistradius:<br><input type="text" name="assistradius" size="5" value="0"></td>
              <td align="left" width="14%">Always Aggro:<br><input type="text" name="always_aggro" size="5" value="0"></td>
              <td align="left" width="14%">Slow Mit:    <br><input type="text" name="slow_mitigation" size="5" value="0"></td>
              <td align="left" width="15%">Heal Scale:  <br><input type="text" name="healscale" size="5" value="100">%</td>
            </tr>
            <tr>
              <td align="left" width="14%">Heroic Strikethrough:<br><input type="text" name="heroic_strikethrough" size="5" value="0"></td>
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
                <td valign="top" align="left">
                  Summon (1):<br><input type="text" name="1" size="10"><br>
                  Enrage (2):<br><input type="text" name="2" size="10"><br>
                  Rampage (3):<br><input type="text" name="3" size="10"><br>
                  AE Rampage (4):<br><input type="text" name="4" size="10"><br>
                  Flurry (5):<br><input type="text" name="5" size="10"><br>
                  Tunnel Vision (29):<br><input type="text" name="29" size="10"><br>
                  Leashed (32):<br><input type="text" name="32" size="10" onChange="tetherCheck();"><br>
                  Tethered (33):<br><input type="text" name="33" size="10" onChange="tetherCheck();"><br>
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
                  <input type="checkbox" name="npc_aggro" value="1"> Can Aggro NPCs<br>
                  <input type="checkbox" name="30" value="30,1^"> Does NOT buff/heal friends (30)<br>
                  <input type="checkbox" name="36" value="36,1^"> Always Flee (36)<br>
                  <input type="checkbox" name="38" value="38,1^"> Allow Beneficial (38)<br>
                  <input type="checkbox" name="41" value="41,1^"> Allow Tank (41)<br>
                  <input type="checkbox" name="45" value="45,1^"> Prox Aggro (45)<br>
                  <input type="checkbox" name="46" value="46,1^"> Immune to Ranged Attacks (46)<br>
                </td>
              </tr>
            </table>
          </center>
        </fieldset><br>
        <fieldset>
          <legend><strong><font size="4">Appearance</font></strong></legend>
          <table width="100%" border="0" cellpadding="3" cellspacing="0">
            <tr>
              <td align="left" width="17%">Size:       <br><input type="text" name="size" size="10" value="5"></td>
              <td align="left" width="17%">Texture:    <br><input type="text" name="texture" size="10" value="0"></td>
              <td align="left" width="17%">HelmTexture:<br><input type="text" name="helmtexture" size="10" value="0"></td>
              <td align="left" width="17%">Face:       <br><input type="text" name="face" size="10" value="0"></td>
              <td align="left" width="16%">Haircolor:  <br><input type="text" name="luclin_haircolor" size="10" value="0"></td>
              <td align="left" width="16%">Hairstyle:  <br><input type="text" name="luclin_hairstyle" size="10" value="0"></td>
            </tr>
            <tr>
              <td align="left" width="17%">Eyecolor:   <br><input type="text" name="luclin_eyecolor" size="10" value="0"></td>
              <td align="left" width="17%">Eyecolor2:  <br><input type="text" name="luclin_eyecolor2" size="10" value="0"></td>
              <td align="left" width="17%">Beard:      <br><input type="text" name="luclin_beard" size="10" value="0"></td>
              <td align="left" width="17%">Beardcolor: <br><input type="text" name="luclin_beardcolor" size="10" value="0"></td>
              <td align="left" width="16%">Melee1:     <br><input type="text" name="d_melee_texture1" size="10" value="0"></td>
              <td align="left" width="16%">Melee2:     <br><input type="text" name="d_melee_texture2" size="10" value="0"></td>
            </tr>
            <tr>
              <td align="left" width="17%">Heritage:   <br><input type="text" name="drakkin_heritage" size="10" value="0"></td>
              <td align="left" width="17%">Tattoo:     <br><input type="text" name="drakkin_tattoo" size="10" value="0"></td>
              <td align="left" width="17%">Details:    <br><input type="text" name="drakkin_details" size="10" value="0"></td>
              <td align="left" width="17%">Armor Red:  <br><input type="text" name="armortint_red" size="10" value="0"></td>
              <td align="left" width="16%">Armor Green:<br><input type="text" name="armortint_green" size="10" value="0"></td>
              <td align="left" width="16%">Armor Blue: <br><input type="text" name="armortint_blue" size="10" value="0"></td>
            </tr>
            <tr>
              <td align="left" width="17%">Hero's Forge Model:<br><input type="text" name="herosforgemodel" size="10" value="0"></td>
              <td align="left" width="17%">Light Source:<br><input type="text" name="light" size="10" value="0"></td>
              <td align="left" width="17%">Model:<br><input type="text" name="model" size="10" value="0"></td>
              <td align="left" width="17%">
                Show Name:<br>
                <select name="show_name">
                  <option value="0">No (0)</option>
                  <option value="1" selected>Yes (1)</option>
                </select>
              </td>
              <td align="left" width="16%">&nbsp;</td>
              <td align="left" width="16%">&nbsp;</td>
            </tr>
          </table>
          <table width="100%" border="0" cellpadding="3" cellspacing="0">
            <tr>
              <td align="left" width="50%">
                Melee1 Type:<br>
                <select name="prim_melee_type" style="width: 200px;">
<?foreach($skilltypes as $key=>$value):?>
                  <option value="<?=$key?>"<?echo ($key == 28) ? " selected" : "";?>><?=$key?>: <?=$value?></option>
<?endforeach;?>
                </select>
              </td>
              <td align="left" width="50%">
                Melee2 Type:<br>
                <select name="sec_melee_type" style="width: 200px;">
<?foreach($skilltypes as $key=>$value):?>
                  <option value="<?=$key?>"<?echo ($key == 28) ? " selected" : "";?>><?=$key?>: <?=$value?></option>
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
              <td align="left" width="33%">Loottable ID:<br><input type="text" name="loottable_id" size="5" value="0"></td>
              <td align="left" width="33%"><input type="checkbox" name="private_corpse" value="1"> Corpse does not Unlock</td>
              <td align="left" width="34%"><input type="checkbox" name="skip_global_loot" value="1"> Skip Global Loot</td>
            </tr>
            <tr>
              <td align="left" width="33%">Experience Mod:<br><input type="text" name="exp_mod" size="5" value="100"></td>
              <td align="left" width="33%">&nbsp;</td>
              <td align="left" width="34%">&nbsp;</td>
            </tr>
          </table>
        </fieldset><br>
        <fieldset>
          <legend><strong><font size="4">Misc</font></strong></legend>
          <table width="100%" border="0" cellpadding="3" cellspacing="0">
            <tr>
              <td align="left" width="17%">Spawn Limit:     <br><input type="text" name="spawn_limit" size="10" value="0"></td>
              <td align="left" width="17%">Version:         <br><input type="text" name="version" size="10" value="<?=$version?>"></td>
              <td align="left" width="17%">Emote:           <br><input type="text" name="emoteid" size="10" value="0"></td>
              <td align="left" width="17%">No Target Hotkey:<br><input type="text" name="no_target_hotkey" size="10" value="0"></td>
              <td align="left" width="16%">Raid Target:     <br><input type="text" name="raid_target" size="5" value="0"></td>
              <td align="left" width="16%">
                Stuck Behavior:<br>
                <select name="stuck_behavior" onChange="underwaterCheck();">
<?foreach ($stuck as $key=>$value):?>
                  <option value="<?=$key?>"><?=$key?>: <?=$value?></option>
<?endforeach;?>
                </select>
              </td>
            </tr>
            <tr>
              <td align="left" width="17%">
                Flymode:<br>
                <select name="flymode">
<?foreach ($flymodetype as $key=>$value):?>
                  <option value="<?=$key?>"<?echo ($key == -1) ? " selected" : "";?>><?=$key?>: <?=$value?></option>
<?endforeach;?>
                </select>
              </td>
              <td align="left" width="17%">
                Faction Amt:<br>
                <input type="text" size="10" name="faction_amount" value="0">
              </td>
              <td align="left" width="17%">
                Keeps Sold Items:<br>
                <input type="text" size="10" name="keeps_sold_items" value="1">
              </td>
              <td align="left" width="17%">
                Trap Template:<br>
                <input type="text" size="10" name="trap_template" value="0">
              </td>
              <td align="left" width="16%">&nbsp;</td>
              <td align="left" width="16%">&nbsp;</td>
            </tr>
          </table><br>
          <center>
            <table cellpadding="20px">
              <tr>
                <td valign="top" align="left">
                  <input type="checkbox" name="qglobal" value="1"> Enable Quest Globals<br>
                  <input type="checkbox" name="pet" value="1"> NPC is a Pet<br>
                  <input type="checkbox" name="unique_spawn_by_name" value="1"> Unique by Name<br>
                </td>
                <td valign="top" align="left">
                  <input type="checkbox" name="isquest" value="1"> Has Quest File<br>
                  <input type="checkbox" name="34" value="34,1"> Destructible Object (34)<br>
                  <input type="checkbox" name="rare_spawn" value="1"> Rare Spawn<br>
                </td>
                <td valign="top" align="left">
                  <input type="checkbox" name="findable" value="1" onChange="raceCheck();"> NPC is Findable<br>
                  <input type="checkbox" name="underwater" value="1" onChange="underwaterCheck();"> Underwater NPC<br>
                  <input type="checkbox" name="ignore_despawn" value="1"> Ignore Despawn<br>
                </td>
                <td valign="top" align="left">
                  <input type="checkbox" name="trackable" value="1" checked onChange="raceCheck();"> NPC is Trackable<br>
                  &nbsp;<br>
                  &nbsp;<br>
                </td>
              </tr>
            </table>
          </center>
        </fieldset><br>
        <center>
          <input type="submit" value="Add NPC">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back();">
        </center>
      </div>
    </div>
  </form>
