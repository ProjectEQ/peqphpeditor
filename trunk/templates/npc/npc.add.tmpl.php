       <form name="npc_add" method="post" action="index.php?editor=npc&z=<?=$currzone?>&action=26">
       <div class="edit_form">
         <div class="edit_form_header">
           Add an NPC to <?=$currzone?>
         </div>
         <div class="edit_form_content">
         <center>
         <fieldset style="text-align: left;">
           <legend><strong><font size="4">General</font></strong></legend>
           <input type="hidden" name="id" value="<?=$npcid?>">
           <table width="100%">
             <tr>
               <td valign="top">
                 Suggested NPCID:<br>
                 <input type="text" name="id" value="<?=$suggestedid?>"><br><br>
                 NPC Name: <br><input type="text" name="name" size="40" value=""><br><br>
                 Title: <br><input type="text" name="lastname" size="40" value=""><br><br>
                 Level:  <br><input type="text" name="level" size="10" value=""><br><br>
                 Gender:  <br>
                 <select name="gender">
<?foreach($genders as $key=>$value):?>
                   <option value="<?=$key?>"><?=$value?></option>
<?endforeach;?>
                 </select>
                </td>
                <td valign="top">
                 Race:<br>
                 <select name="race" style="width: 265px;">
<?foreach($races as $key=>$value):?>
                   <option value="<?=$key?>"><?=$key?>: <?=$value?></option>
<?endforeach;?>
                 </select><br><br>

                 Class:<br>
                 <select name="class" style="width: 265px;">
<?foreach($classes as $key=>$value):?>
                   <option value="<?=$key?>"><?=$key?>: <?=$value?></option>
<?endforeach;?>
                 </select><br><br>

                 Bodytype:<br>
                 <select name="bodytype" style="width: 265px;">
<?foreach($bodytypes as $key=>$value):?>
                   <option value="<?=$key?>"><?=$key?>: <?=$value?></option>
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
               <td align="left" width="20%">HP:  <br><input type="text" name="hp" size="10" value=""></td>
               <td align="left" width="20%">AC:  <br><input type="text" name="AC" size="10" value=""></td>
               <td align="left" width="20%">Runspeed:  <br><input type="text" name="runspeed" size="10" value="1.25"></td>
               <td align="left" width="20%">ATK:  <br><input type="text" name="ATK" size="10" value=""></td>
               <td align="left" width="20%">Accuracy:  <br><input type="text" name="Accuracy" size="10" value=""></td>
             </tr>
              <tr>
              <td align="left" width="25%">
                 See Invis:  <br>
                 <select name="see_invis">
                   <option value="0">No</option>
                   <option value="1">Yes</option>
                 </select>
               </td>
               <td align="left" width="25%">
                 See ITU:  <br>
                 <select name="see_invis_undead">
                   <option value="0">No</option>
                   <option value="1">Yes</option>
                 </select>
               
                <td align="left" width="25%">
                 See Hide:  <br>
                 <select name="see_hide">
                   <option value="0">No</option>
                   <option value="1">Yes</option>
                 </select>
               </td>
               <td align="left" width="25%">
                 See IH:  <br>
                 <select name="see_improved_hide">
                   <option value="0">No</option>
                   <option value="1">Yes</option>
                 </select>
               </td>
             </tr>
           </table>
         </fieldset><br>

         <fieldset>
           <legend><strong><font size="4">Stats</font></strong></legend>
           <table width="100%" border="0" cellpadding="3" cellspacing="0">
             <tr>
               <td align="left" width="14%">STR:  <br><input type="text" name="STR" size="5" value=""></td>
               <td align="left" width="14%">STA:  <br><input type="text" name="STA" size="5" value=""></td>
               <td align="left" width="14%">DEX:  <br><input type="text" name="DEX" size="5" value=""></td>
               <td align="left" width="14%">AGI:  <br><input type="text" name="AGI" size="5" value=""></td>
               <td align="left" width="14%">INT:  <br><input type="text" name="_INT" size="5" value=""></td>
               <td align="left" width="15%">WIS:  <br><input type="text" name="WIS" size="5" value=""></td>
               <td align="left" width="15%">CHA:  <br><input type="text" name="CHA" size="5" value=""></td>
             </tr>
           </table>
         </fieldset><br>

         <fieldset>
           <legend><strong><font size="4">Resists</font></strong></legend>
             <table width="100%" border="0" cellpadding="3" cellspacing="0">
               <tr>
                <td align="left" width="14%">MR:  <br><input type="text" name="MR" size="5" value=""></td>
                <td align="left" width="14%">CR:  <br><input type="text" name="CR" size="5" value=""></td>
                <td align="left" width="14%">FR:  <br><input type="text" name="FR" size="5" value=""></td>
                <td align="left" width="14%">PR:  <br><input type="text" name="PR" size="5" value=""></td>
                <td align="left" width="14%">DR:  <br><input type="text" name="DR" size="5" value=""></td>
                <td align="left" width="15%">&nbsp;</td>
                <td align="left" width="15%">&nbsp;</td>
              </tr>
            </table>
         </fieldset><br>

         <fieldset>
           <legend><strong><font size="4">Combat</font></strong></legend>
             <table width="100%" border="0" cellpadding="3" cellspacing="0">
               <tr>
                <td align="left" width="12%">Min Dmg:  <br><input type="text" name="mindmg" size="5" value=""></td>
                <td align="left" width="12%">Max Dmg:  <br><input type="text" name="maxdmg" size="5" value=""></td>
                <td align="left" width="12%">Spells ID:  <br><input type="text" name="npc_spells_id" size="5" value=""></td>
                <td align="left" width="12%">Loot ID:  <br><input type="text" name="loottable_id" size="5" value=""></td>
                <td align="left" width="13%">HP Regen:  <br><input type="text" name="hp_regen_rate" size="5" value=""></td>
                <td align="left" width="13%">Mana Regen:  <br><input type="text" name="mana_regen_rate" size="5" value=""></td>
                <td align="left" width="13%">Aggroradius:  <br><input type="text" name="aggroradius" size="5" value="55"></td>
                <td align="left" width="13%">Atk Speed%: <br><input type="text" name="attack_speed" size="5" value=""></td>
              </tr>
            </table>
            <center>
            <table cellpadding="20px">
              <tr>
                <td valign="top" align="left">
                  <input type="checkbox" name="S" value="S"> Summon<br>
                  <input type="checkbox" name="E" value="E"> Enrage<br>
                  <input type="checkbox" name="R" value="R"> Rampage<br>
                  <input type="checkbox" name="r" value="r"> AE Rampage<br>
                  <input type="checkbox" name="F" value="F"> Flurry<br>
                  <input type="checkbox" name="T" value="T"> Triple Attack<br>
                  <input type="checkbox" name="Q" value="Q"> Quad Attack<br>
                  <input type="checkbox" name="m" value="m"> Magic Attack<br>
                  <input type="checkbox" name="b" value="b"> Bane Attack<br>
                </td>
                <td valign="top" align="left">
                  <input type="checkbox" name="U" value="U"> Unslowable<br>
                  <input type="checkbox" name="M" value="M"> Unmezable<br>
                  <input type="checkbox" name="C" value="C"> Uncharmable<br>
                  <input type="checkbox" name="N" value="N"> Unstunable<br>
                  <input type="checkbox" name="I" value="I"> Unsnareable<br>
                  <input type="checkbox" name="D" value="D"> Unfearable<br>
                  <input type="checkbox" name="g" value="g"> Resist ranged spells<br>
                </td>
                <td valign="top" align="left">
                  <input type="checkbox" name="A" value="A"> Immune to Melee<br>
                  <input type="checkbox" name="B" value="B"> Immune to Magic<br>
                  <input type="checkbox" name="f" value="f"> Immune to Fleeing<br>
                  <input type="checkbox" name="W" value="W"> Immune to non-Magical Melee<br>
                  <input type="checkbox" name="O" value="O"> Immune to non-Bane Melee<br>
                  <input type="checkbox" name="H" value="H"> Will Not Aggro<br>
                  &nbsp;
                </td>
              </tr>
            </table>
            </center>
         </fieldset><br>

         <fieldset>
           <legend><strong><font size="4">Appearance</font></strong></legend>
             <table width="100%" border="0" cellpadding="3" cellspacing="0">
               <tr>
                <td align="left" width="17%">Size:  <br><input type="text" name="size" size="10" value="5"></td>
                <td align="left" width="17%">Texture:  <br><input type="text" name="texture" size="10" value="0"></td>
                <td align="left" width="17%">HelmTexture:  <br><input type="text" name="helmtexture" size="10" value="0"></td>
                <td align="left" width="17%">Face:  <br><input type="text" name="face" size="10" value="0"></td>
                <td align="left" width="16%">Haircolor:  <br><input type="text" name="luclin_haircolor" size="10" value="0"></td>
                <td align="left" width="16%">Hairstyle:  <br><input type="text" name="luclin_hairstyle" size="10" value="0"></td>
              </tr>
              <tr>
                <td align="left" width="17%">Eyecolor:  <br><input type="text" name="luclin_eyecolor" size="10" value="0"></td>
                <td align="left" width="17%">Eyecolor2:  <br><input type="text" name="luclin_eyecolor2" size="10" value="0"></td>
                <td align="left" width="17%">Beard:  <br><input type="text" name="luclin_beard" size="10" value="0"></td>
                <td align="left" width="17%">Beardcolor:  <br><input type="text" name="luclin_beardcolor" size="10" value="0"></td>
                <td align="left" width="16%">d_melee_texture1:  <br><input type="text" name="d_meele_texture1" size="10" value="0"></td>
                <td align="left" width="16%">d_melee_texture2:  <br><input type="text" name="d_meele_texture2" size="10" value="0"></td>
              </tr>
              <tr>
                <td align="left" width="17%">Heritage:  <br><input type="text" name="drakkin_heritage" size="10" value="0"></td>
                <td align="left" width="17%">Tattoo:  <br><input type="text" name="drakkin_tattoo" size="10" value="0"></td>
                <td align="left" width="17%">Details:  <br><input type="text" name="drakkin_details" size="10" value="0"></td>
                <td align="left" width="17%">Armor Red:  <br><input type="text" name="armortint_red" size="10" value="0"></td>
                <td align="left" width="16%">Armor Green:  <br><input type="text" name="armortint_green" size="10" value="0"></td>
                <td align="left" width="16%">Armor Blue:  <br><input type="text" name="armortint_blue" size="10" value="0"></td>
              </tr>
            </table>
         </fieldset><br>

         <fieldset>
           <legend><strong><font size="4">Misc</font></strong></legend>
           <table width="100%" border="0" cellpadding="3" cellspacing="0">
           <tr>
          <td align="left" width="17%">Spawn Limit: <br><input type="text" name="spawn_limit" size="10" value=""></td>
          <td align="left" width="17%">Version: <br><input type="text" name="version" size="10" value=""></td>
          <td align="left" width="17%">&nbsp;</td>
          <td align="left" width="17%">&nbsp;</td>
          <td align="left" width="16%">&nbsp;</td>
          <td align="left" width="16%">&nbsp;</td>
         </tr>
         </table><br>
           <input type="checkbox" name="qglobal" value="1">Enable Quest Globals<br>
           <input type="checkbox" name="npc_aggro" value="0">Can Aggro NPCs<br>
           <input type="checkbox" name="findable" value="1">NPC is Findable<br>
           <input type="checkbox" name="trackable" value="1">NPC is trackable<br>
           <input type="checkbox" name="pet" value="0">NPC is a Pet<br>
           <input type="checkbox" name="isbot" value="0">NPC is a Bot<br><br>
         </fieldset><br>
         <center>
            <input type="submit" value="Submit Changes">
         </center>
         </div>
       </div>