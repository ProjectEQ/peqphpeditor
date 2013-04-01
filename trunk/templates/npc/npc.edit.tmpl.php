       <form name="npc_edit" method="post" action="index.php?editor=npc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=2">
       <div class="edit_form">
         <div class="edit_form_header">
           Edit NPC <?=$npcid?>
         </div>
         <div class="edit_form_content">
         <center>
         <fieldset style="text-align: left;">
           <legend><strong><font size="4">General</font></strong></legend>
           <input type="hidden" name="id" value="<?=$npcid?>">
           <table width="100%">
             <tr>
               <td valign="top">
                 NPC Name: <br><input type="text" name="name" size="40" value="<?=$name?>"><br><br>
                 Title: <br><input type="text" name="lastname" size="40" value="<?=$lastname?>"><br><br>
                 Level:  <br><input type="text" name="level" size="10" value="<?=$level?>"><br><br>
                 Max Level:  <br><input type="text" name="maxlevel" size="10" value="<?=$maxlevel?>"><br><br>
                </td>
                <td valign="top">
                 Race:<br>
                 <select name="race" style="width: 265px;">
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
                 
                 Gender:  <br>
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
                <td align="left" width="14%">HP:         <br><input type="text" name="hp" size="10" value="<?=$hp?>"></td>
                <td align="left" width="14%">Mana:       <br><input type="text" name="mana" size="10" value="<?=$mana?>"></td>
                <td align="left" width="14%">AC:         <br><input type="text" name="AC" size="10" value="<?=$AC?>"></td>
                <td align="left" width="14%">Runspeed:   <br><input type="text" name="runspeed" size="10" value="<?=$runspeed?>"></td>
                <td align="left" width="14%">ATK:        <br><input type="text" name="ATK" size="10" value="<?=$ATK?>"></td>
                <td align="left" width="14%">Accuracy:   <br><input type="text" name="Accuracy" size="10" value="<?=$Accuracy?>"></td>
                <td align="left" width="14%">Scalerate:  <br><input type="text" name="scalerate" size="10" value="<?=$scalerate?>"></td>
              </tr>
            </table>
            <table width="100%" border="0" cellpadding="3" cellspacing="0">
              <tr>
                <td align="left" width="25%">
                  See Invis:<br>
                  <select name="see_invis">
                    <option value="0"<?echo ($see_invis == 0) ? " selected" : ""?>>No</option>
                    <option value="1"<?echo ($see_invis == 1) ? " selected" : ""?>>Yes</option>
                  </select>
                </td>
                <td align="left" width="25%">
                  See ITU:<br>
                  <select name="see_invis_undead">
                    <option value="0"<?echo ($see_invis_undead == 0) ? " selected" : ""?>>No</option>
                    <option value="1"<?echo ($see_invis_undead == 1) ? " selected" : ""?>>Yes</option>
                  </select>
                </td>
                <td align="left" width="25%">
                  See Hide:<br>
                  <select name="see_hide">
                    <option value="0"<?echo ($see_hide == 0) ? " selected" : ""?>>No</option>
                    <option value="1"<?echo ($see_hide == 1) ? " selected" : ""?>>Yes</option>
                  </select>
                </td>
                <td align="left" width="25%">
                  See IH:<br>
                  <select name="see_improved_hide">
                    <option value="0"<?echo ($see_improved_hide == 0) ? " selected" : ""?>>No</option>
                    <option value="1"<?echo ($see_improved_hide == 1) ? " selected" : ""?>>Yes</option>
                  </select>
                </td>
              </tr>
            </table>
          </fieldset><br>
          <fieldset>
            <legend><strong><font size="4">Stats</font></strong></legend>
            <table width="100%" border="0" cellpadding="3" cellspacing="0">
              <tr>
                <td align="left" width="14%">STR:  <br><input type="text" name="STR" size="5" value="<?=$STR?>"></td>
                <td align="left" width="14%">STA:  <br><input type="text" name="STA" size="5" value="<?=$STA?>"></td>
                <td align="left" width="14%">DEX:  <br><input type="text" name="DEX" size="5" value="<?=$DEX?>"></td>
                <td align="left" width="14%">AGI:  <br><input type="text" name="AGI" size="5" value="<?=$AGI?>"></td>
                <td align="left" width="14%">INT:  <br><input type="text" name="_INT" size="5" value="<?=$_INT?>"></td>
                <td align="left" width="15%">WIS:  <br><input type="text" name="WIS" size="5" value="<?=$WIS?>"></td>
                <td align="left" width="15%">CHA:  <br><input type="text" name="CHA" size="5" value="<?=$CHA?>"></td>
              </tr>
            </table>
          </fieldset><br>
          <fieldset>
           <legend><strong><font size="4">Resists</font></strong></legend>
             <table width="100%" border="0" cellpadding="3" cellspacing="0">
                1 Resist = 0.4% 250 Resist = 100%
               <tr>
                <td align="left" width="14%">MR:  <br><input type="text" name="MR" size="5" value="<?=$MR?>"></td>
                <td align="left" width="14%">CR:  <br><input type="text" name="CR" size="5" value="<?=$CR?>"></td>
                <td align="left" width="14%">FR:  <br><input type="text" name="FR" size="5" value="<?=$FR?>"></td>
                <td align="left" width="14%">PR:  <br><input type="text" name="PR" size="5" value="<?=$PR?>"></td>
                <td align="left" width="14%">DR:  <br><input type="text" name="DR" size="5" value="<?=$DR?>"></td>
                <td align="left" width="15%">Corrup:  <br><input type="text" name="Corrup" size="5" value="<?=$Corrup?>"></td>
                <td align="left" width="15%">&nbsp;</td>
              </tr>
            </table>
         </fieldset><br>

         <fieldset>
           <legend><strong><font size="4">Combat</font></strong></legend>
             <table width="100%" border="0" cellpadding="3" cellspacing="0">
               <tr>
                <td align="left" width="16%">Min Dmg:     <br><input type="text" name="mindmg" size="5" value="<?=$mindmg?>"></td>
                <td align="left" width="16%">Max Dmg:     <br><input type="text" name="maxdmg" size="5" value="<?=$maxdmg?>"></td>
                <td align="left" width="16%">Attack Count:<br><input type="text" name="attack_count" size="5" value="<?=$attack_count?>"></td>
                <td align="left" width="16%">Spells ID:   <br><input type="text" name="npc_spells_id" size="5" value="<?=$npc_spells_id?>"></td>
                <td align="left" width="16%">Loot ID:     <br><input type="text" name="loottable_id" size="5" value="<?=$loottable_id?>"></td>
                <td align="left" width="16%">Spell Scale: <br><input type="text" name="spellscale" size="5" value="<?=$spellscale?>">%</td>
              </tr>
              </tr>
                <td align="left" width="16%">HP Regen:    <br><input type="text" name="hp_regen_rate" size="5" value="<?=$hp_regen_rate?>"></td>
                <td align="left" width="16%">MP Regen:    <br><input type="text" name="mana_regen_rate" size="5" value="<?=$mana_regen_rate?>"></td>
                <td align="left" width="16%">Aggroradius: <br><input type="text" name="aggroradius" size="5" value="<?=$aggroradius?>"></td>
                <td align="left" width="16%">Atk Speed:   <br><input type="text" name="attack_speed" size="5" value="<?=$attack_speed?>">%</td>
                <td align="left" width="16%">Slow Mit:    <br><input type="text" name="slow_mitigation" size="5" value="<?=$slow_mitigation?>"></td>
                <td align="left" width="16%">Heal Scale:  <br><input type="text" name="healscale" size="5" value="<?=$healscale?>">%</td>
              </tr>
            </table>
            <center>
            <table cellpadding="20px">
              <tr>
                <td valign="top" align="left">
                  <input type="checkbox" name="S" value="S"<?echo (strpos($npcspecialattks,"S") === false) ? "" : " checked"?>> Summon<br>
                  <input type="checkbox" name="E" value="E"<?echo (strpos($npcspecialattks,"E") === false) ? "" : " checked"?>> Enrage<br>
                  <input type="checkbox" name="R" value="R"<?echo (strpos($npcspecialattks,"R") === false) ? "" : " checked"?>> Rampage<br>
                  <input type="checkbox" name="r" value="r"<?echo (strpos($npcspecialattks,"r") === false) ? "" : " checked"?>> AE Rampage<br>
                  <input type="checkbox" name="F" value="F"<?echo (strpos($npcspecialattks,"F") === false) ? "" : " checked"?>> Flurry<br>
                  <input type="checkbox" name="T" value="T"<?echo (strpos($npcspecialattks,"T") === false) ? "" : " checked"?>> Triple Attack<br>
                  <input type="checkbox" name="Q" value="Q"<?echo (strpos($npcspecialattks,"Q") === false) ? "" : " checked"?>> Quad Attack<br>
                  <input type="checkbox" name="m" value="m"<?echo (strpos($npcspecialattks,"m") === false) ? "" : " checked"?>> Magic Attack<br>
                  <input type="checkbox" name="b" value="b"<?echo (strpos($npcspecialattks,"b") === false) ? "" : " checked"?>> Bane Attack<br>
                  <input type="checkbox" name="L" value="L"<?echo (strpos($npcspecialattks,"L") === false) ? "" : " checked"?>> Dual Wield<br>
                  <input type="checkbox" name="Y" value="Y"<?echo (strpos($npcspecialattks,"Y") === false) ? "" : " checked"?>> Ranged Attack<br>
                </td>
                <td valign="top" align="left">
                  <input type="checkbox" name="U" value="U"<?echo (strpos($npcspecialattks,"U") === false) ? "" : " checked"?>> Unslowable<br>
                  <input type="checkbox" name="M" value="M"<?echo (strpos($npcspecialattks,"M") === false) ? "" : " checked"?>> Unmezable<br>
                  <input type="checkbox" name="C" value="C"<?echo (strpos($npcspecialattks,"C") === false) ? "" : " checked"?>> Uncharmable<br>
                  <input type="checkbox" name="N" value="N"<?echo (strpos($npcspecialattks,"N") === false) ? "" : " checked"?>> Unstunable<br>
                  <input type="checkbox" name="I" value="I"<?echo (strpos($npcspecialattks,"I") === false) ? "" : " checked"?>> Unsnareable<br>
                  <input type="checkbox" name="D" value="D"<?echo (strpos($npcspecialattks,"D") === false) ? "" : " checked"?>> Unfearable<br>
                  <input type="checkbox" name="p" value="p"<?echo (strpos($npcspecialattks,"p") === false) ? "" : " checked"?>> Unpacifiable<br>
                  <input type="checkbox" name="K" value="K"<?echo (strpos($npcspecialattks,"K") === false) ? "" : " checked"?>> Immune to Dispell<br>
                  <input type="checkbox" name="Z" value="Z"<?echo (strpos($npcspecialattks,"Z") === false) ? "" : " checked"?>> No Harm from Players<br>
                  <input type="checkbox" name="g" value="g"<?echo (strpos($npcspecialattks,"g") === false) ? "" : " checked"?>> Resist Ranged Spells<br>
                  <input type="checkbox" name="t" value="t"<?echo (strpos($npcspecialattks,"t") === false) ? "" : " checked"?>> Tunnel Vision<br>
                  <input type="checkbox" name="i" value="i"<?echo (strpos($npcspecialattks,"i") === false) ? "" : " checked"?>> Immune to Taunt<br>
                </td>
                <td valign="top" align="left">
                  <input type="checkbox" name="A" value="A"<?echo (strpos($npcspecialattks,"A") === false) ? "" : " checked"?>> Immune to Melee<br>
                  <input type="checkbox" name="B" value="B"<?echo (strpos($npcspecialattks,"B") === false) ? "" : " checked"?>> Immune to Magic<br>
                  <input type="checkbox" name="f" value="f"<?echo (strpos($npcspecialattks,"f") === false) ? "" : " checked"?>> Immune to Fleeing<br>
                  <input type="checkbox" name="W" value="W"<?echo (strpos($npcspecialattks,"W") === false) ? "" : " checked"?>> Immune to non-Magical Melee<br>
                  <input type="checkbox" name="O" value="O"<?echo (strpos($npcspecialattks,"O") === false) ? "" : " checked"?>> Immune to non-Bane Melee<br>
                  <input type="checkbox" name="H" value="H"<?echo (strpos($npcspecialattks,"H") === false) ? "" : " checked"?>> Will Not Aggro<br>
                  <input type="checkbox" name="G" value="G"<?echo (strpos($npcspecialattks,"G") === false) ? "" : " checked"?>> Immune to Aggro<br>
                  <input type="checkbox" name="d" value="d"<?echo (strpos($npcspecialattks,"d") === false) ? "" : " checked"?>> See through Feign Death<br>
                  <input type="checkbox" name="npc_aggro" value="1"<?echo ($npc_aggro == 1) ? "checked" : "";?>> Can Aggro NPCs<br>
                  <input type="checkbox" name="n" value="n"<?echo (strpos($npcspecialattks,"n") === false) ? "" : " checked"?>> Does NOT buff/heal friends<br>
                  <input type="checkbox" name="j" value="j" onClick="sanityCheck();"<?echo (strpos($npcspecialattks,"j") === false) ? "" : " checked"?>> Tethered<br>
                  <input type="checkbox" name="J" value="J" onClick="sanityCheck();"<?echo (strpos($npcspecialattks,"J") === false) ? "" : " checked"?>> Leashed<br>
                </td>
              </tr>
            </table>
            </center>
         </fieldset><br>

         <fieldset>
           <legend><strong><font size="4">Appearance</font></strong></legend>
             <table width="100%" border="0" cellpadding="3" cellspacing="0">
               <tr>
                <td align="left" width="17%">Size:  <br><input type="text" name="size" size="10" value="<?=$size?>"></td>
                <td align="left" width="17%">Texture:  <br><input type="text" name="texture" size="10" value="<?=$texture?>"></td>
                <td align="left" width="17%">HelmTexture:  <br><input type="text" name="helmtexture" size="10" value="<?=$helmtexture?>"></td>
                <td align="left" width="17%">Face:  <br><input type="text" name="face" size="10" value="<?=$face?>"></td>
                <td align="left" width="16%">Haircolor:  <br><input type="text" name="luclin_haircolor" size="10" value="<?=$luclin_haircolor?>"></td>
                <td align="left" width="16%">Hairstyle:  <br><input type="text" name="luclin_hairstyle" size="10" value="<?=$luclin_hairstyle?>"></td>
              </tr>
              <tr>
                <td align="left" width="17%">Eyecolor:  <br><input type="text" name="luclin_eyecolor" size="10" value="<?=$luclin_eyecolor?>"></td>
                <td align="left" width="17%">Eyecolor2:  <br><input type="text" name="luclin_eyecolor2" size="10" value="<?=$luclin_eyecolor2?>"></td>
                <td align="left" width="17%">Beard:  <br><input type="text" name="luclin_beard" size="10" value="<?=$luclin_beard?>"></td>
                <td align="left" width="17%">Beardcolor:  <br><input type="text" name="luclin_beardcolor" size="10" value="<?=$luclin_beardcolor?>"></td>
                <td align="left" width="16%">Melee1:  <br><input type="text" name="d_meele_texture1" size="10" value="<?=$d_meele_texture1?>"></td>
                <td align="left" width="16%">Melee2:  <br><input type="text" name="d_meele_texture2" size="10" value="<?=$d_meele_texture2?>"></td>
              </tr>
                <tr>
                <td align="left" width="17%">Heritage:  <br><input type="text" name="drakkin_heritage" size="10" value="<?=$drakkin_heritage?>"></td>
                <td align="left" width="17%">Tattoo:  <br><input type="text" name="drakkin_tattoo" size="10" value="<?=$drakkin_tattoo?>"></td>
                <td align="left" width="17%">Details:  <br><input type="text" name="drakkin_details" size="10" value="<?=$drakkin_details?>"></td>
                <td align="left" width="17%">Armor Red:  <br><input type="text" name="armortint_red" size="10" value="<?=$armortint_red?>"></td>
                <td align="left" width="16%">Armor Green:  <br><input type="text" name="armortint_green" size="10" value="<?=$armortint_green?>"></td>
                <td align="left" width="16%">Armor Blue:  <br><input type="text" name="armortint_blue" size="10" value="<?=$armortint_blue?>"></td>
              </tr>
              </table>
             <table width="100%" border="0" cellpadding="3" cellspacing="0">
             <tr>
              <td align="left" width="50%">
               Melee1 Type: <br>
               <select name="prim_melee_type" style="width: 200px;">
<?foreach($skilltypes as $key=>$value):?>
                   <option value="<?=$key?>"<?echo ($key == $prim_melee_type)? " selected" : "";?>><?=$key?>: <?=$value?></option>
<?endforeach;?>
                 </select>
                 </td> 
                 <td align="left" width="50%">               
                 Melee2 Type: <br>
               <select name="sec_melee_type" style="width: 200px;">
<?foreach($skilltypes as $key=>$value):?>
                   <option value="<?=$key?>"<?echo ($key == $sec_melee_type)? " selected" : "";?>><?=$key?>: <?=$value?></option>
<?endforeach;?>
                 </select>
                </td>
                </tr>
            </table>
         </fieldset><br>

        <fieldset>
          <legend><strong><font size="4">Misc</font></strong></legend>
          <table width="100%" border="0" cellpadding="3" cellspacing="0">
            <tr>
              <td align="left" width="17%">Spawn Limit: <br><input type="text" name="spawn_limit" size="10" value="<?=$spawn_limit?>"></td>
              <td align="left" width="17%">Version: <br><input type="text" name="version" size="10" value="<?=$version?>"></td>
              <td align="left" width="17%">Emote: <br><input type="text" name="emoteid" size="10" value="<?=$emoteid?>"></td>
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
                  <input type="checkbox" name="findable" value="1"<?echo ($findable == 1) ? " checked" : "";?>> NPC is Findable<br>
                  <input type="checkbox" name="trackable" value="1"<?echo ($trackable == 1) ? " checked" : "";?>> NPC is Trackable<br>
                </td>
                <td valign="top" align="left">
                  <input type="checkbox" name="pet" value="1"<?echo ($pet == 1) ? " checked" : "";?>> NPC is a Pet<br>
                  <input type="checkbox" name="private_corpse" value="1"<?echo ($private_corpse == 1) ? " checked" : "";?>> Corpse does not Unlock<br>
                  <input type="checkbox" name="unique_spawn_by_name" value="1"<?echo ($unique_spawn_by_name == 1) ? " checked" : "";?>> Unique by Name<br>    
                </td>
                <td valign="top" align="left">
                  <input type="checkbox" name="underwater" value="1"<?echo ($underwater == 1) ? " checked" : "";?>> Underwater NPC<br>
                  <input type="checkbox" name="o" value="o"<?echo (strpos($npcspecialattks,"o") === false) ? "" : " checked"?>> Destructible Object<br>
                  <input type="checkbox" name="isquest" value="1"<?echo ($isquest == 1) ? " checked" : "";?>> Has Quest File<br/>
                </td>
              </tr>
            </table>
          </center>
        </fieldset><br>
         <center>
            <input type="submit" value="Submit Changes">
         </center>
         </div>
       </div>
