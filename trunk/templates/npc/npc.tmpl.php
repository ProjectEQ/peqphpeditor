    <form name="npc" method="post" action="index.php?editor=npc&z=<?=$currzone?>&npcid=<?=$npcid?>&action=28">
     <div class="table_container">
       <div class="table_header">
         <div style="float:right">
           <a href="index.php?editor=npc&z=<?=$currzone?>&npcid=<?=$npcid?>&action=1"><img src="images/c_table.gif" border=0 title="Edit this NPC"></a>
           <a onClick="return confirm('Really delete npcid <?=$npcid?>?');" href="index.php?editor=npc&z=<?=$currzone?>&npcid=<?=$npcid?>&action=24"><img src="images/table.gif" border=0 title="Delete this NPC"></a>
         </div>
         <?=$id?> - <?=$name?> <?echo ($lastname != '' ? "($lastname)" : '');?>
       </div>
       <div class="table_content">
         <table cellspacing=0 border=0 width="100%">
           <tr>
             <td>
         <center>

         <h1><?=$name?><br>
         (<?echo ($lastname != '' ? "$lastname" : 'no title');?>)</h1><br>

         <table style="font-size: 12px; margin-bottom: 80px;">
           <tr>
             <td>
                 <strong>Race:</strong> <?=$races[$race]?><br>
                 <strong>Class:</strong> <?=$classes[$class]?><br>
                 <strong>Level:</strong> <?=$level?><br>
                 <strong>Body Type:</strong> <?=$bodytypes[$bodytype]?><br>
                 <strong>Vendor:</strong> <a href="index.php?editor=npc&z=<?=$currzone?>&npcid=<?=$npcid?>&action=22"><?echo ($merchant_id != 0 ? $merchant_id : "no");?></a>
             </td>
           </tr>
         </table>

         <div style="padding: 10px; border: 1px solid grey; margin-right: 10px;">
         <b>NPC Faction ID</b>: <?=$npc_faction_id?> [<a href="index.php?editor=npc&z=<?=$currzone?>&npcid=<?=$npcid?>&action=3">edit</a>]<br>
<? if ($npc_faction_id != 0):?>
         "<a href="index.php?editor=npc&z=<?=$currzone?>&npcid=<?=$npcid?>&action=10"><?=$factionname?></a>"<br><br>
<? endif;?>
         <b>Primary Faction</b>: [<a href="index.php?editor=npc&z=<?=$currzone?>&npcid=<?=$npcid?>&action=12">edit</a>]<br>
         <? echo ($primaryfactionname != '') ? $primaryfactionname : "None";?><br><br>
         <b>Faction Hits:</b> <a href="index.php?editor=npc&z=<?=$currzone?>&npcid=<?=$npcid?>&action=15"><img src="images/add.gif" border="0" title="Add Faction Hit"></a><br>
<? if ($faction_hits != ''){?>
         <table width="90%">
<?foreach($faction_hits as $hit): extract($hit);?>
           <tr>
             <td>
               <?=$factions[$faction_id]?>
             </td>
             <td>
               <?=$value?>
             </td>
             <td>
               <?=$faction_values[$npc_value]?>
             </td>
             <td align="right">
         <a href="index.php?editor=npc&z=<?=$currzone?>&npcid=<?=$npcid?>&npc_faction_id=<?=$npc_faction_id?>&faction_id=<?=$faction_id?>&action=19"><img src="images/edit2.gif" border="0" title="Edit this Faction Hit"></a>
         <a href="index.php?editor=npc&z=<?=$currzone?>&npcid=<?=$npcid?>&npc_faction_id=<?=$npc_faction_id?>&faction_id=<?=$faction_id?>&action=21" onClick="return confirm('Are you sure you want to remove this faction hit?');"><img src="images/remove.gif" border="0" title="Remove this Faction Hit"></a>
             </td>
            </tr>
<?endforeach;?>
         </table>
<? }else {?>
         None<br>
<? } ?>
         </div>
         </center>
         </td>
         <td>
           <fieldset>
             <legend><strong>Vitals</strong></legend>
             <table width="100%" border="0" cellpadding="3" cellspacing="0">
			  <tr>
                <td align="left" width="20%">AC: <?=$AC?></td>
                <td align="left" width="20%">HP: <?=$hp?></td>
                <td align="left" width="20%">Run: <?=$runspeed?></td>
              </tr>
              <tr>
                <td align="left" width="20%">ATK: <?=$ATK?></td>
                <td align="left" width="20%">Acy: <?=$Accuracy?></td>
              </tr>
              <tr>
                <td align="left" width="33%">See Invis: <?=$yesno[$see_invis]?></td>
                <td align="left" width="33%">See ITU: <?=$yesno[$see_invis_undead]?></td>
                <td align="left" width="33%">See Hide: <?=$yesno[$see_hide]?></td>
                </tr>
              <tr>
                <td align="left" width="33%">See Imp Hide: <?=$yesno[$see_improved_hide]?></td>
                <td align="left" width="34%">&nbsp;</td>
                <td align="left" width="34%">&nbsp;</td>
              </tr>
             </table>
           </fieldset>

           <fieldset>
             <legend><strong>Stats</strong></legend>
             <table width="100%" border="0" cellpadding="3" cellspacing="0">
              <tr>
                <td align="left" width="33%">STR: <?=$STR?></td>
                <td align="left" width="33%">STA: <?=$STA?></td>
                <td align="left" width="34%">DEX: <?=$DEX?></td>
              </tr>
              <tr>
                <td align="left" width="33%">AGI: <?=$AGI?></td>
                <td align="left" width="33%">INT: <?=$_INT?></td>
                <td align="left" width="34%">WIS: <?=$WIS?></td>
              </tr>
              <tr>
                <td align="left" width="33%">CHA: <?=$CHA?></td>
                <td align="left" width="33%">&nbsp;</td>
                <td align="left" width="34%">&nbsp;</td>
              </tr>
             </table>
           </fieldset>

           <fieldset>
             <legend><strong>Resists</strong></legend>
             <table width="100%" border="0" cellpadding="3" cellspacing="0">
			  <tr>
                <td align="left" width="33%">MR: <?=$MR?></td>
                <td align="left" width="33%">CR: <?=$CR?></td>
                <td align="left" width="34%">FR: <?=$FR?></td>
              </tr>
              <tr>
                <td align="left" width="33%">PR: <?=$PR?></td>
                <td align="left" width="33%">DR: <?=$DR?></td>
                <td align="left" width="34%">&nbsp;</td>
              </tr>
             </table>
           </fieldset>

           <fieldset>
             <legend><strong>Combat</strong></legend>
             <table width="100%" border="0" cellpadding="3" cellspacing="0">
              <tr>
                <td align="left" width="33%">MinDmg: <?=$mindmg?></td>
                <td align="left" width="33%">MaxDmg: <?=$maxdmg?></td>
                <td align="left" width="34%">NPC Spells ID: <?=$npc_spells_id?></td>
			  </tr>
			  <tr>
                <td align="left" width="33%">Loottable ID: <?=$loottable_id?></td>
                <td align="left" width="33%">HP Regen: <?=$hp_regen_rate?></td>
                <td align="left" width="34%">MP Regen: <?=$mana_regen_rate?></td>
              </tr>
              <tr>
                <td align="left" width="33%">Aggro: <?=$aggroradius?></td>
                <td align="left" width="33%">Atk Speed: <?=$attack_speed?></td>
                <td align="left" width="34%">Special Atks: <?=$npcspecialattks?></td>
              </tr>
             </table>
            </fieldset>

           <fieldset>
             <legend><strong>Appearance</strong></legend>
             <table width="100%" border="0" cellpadding="3" cellspacing="0">
              <tr>
                <td align="left" width="33%">Gender: <?=$genders[$gender]?></td>
                <td align="left" width="33%">Texture: <?=$texture?></td>
                <td align="left" width="34%">Helm: <?=$helmtexture?></td>
              </tr>
              <tr>
                <td align="left" width="33%">Size: <?=$size?></td>
                <td align="left" width="33%">Face: <?=$face?></td>
                <td align="left" width="34%">Hair Style: <?=$luclin_hairstyle?></td>
              </tr>
              <tr>
                <td align="left" width="33%">Hair Color: <?=$luclin_haircolor?></td>
                <td align="left" width="33%">Eye Color: <?=$luclin_eyecolor?></td>
                <td align="left" width="34%">Beard Color: <?=$luclin_beardcolor?></td>
              </tr>
              <tr>
                <td align="left" width="33%">Drakkin Heritage: <?=$drakkin_heritage?></td>
                <td align="left" width="33%">Drakkin Tattoo: <?=$drakkin_tattoo?></td>
                <td align="left" width="34%">Drakkin Details: <?=$drakkin_details?></td>
              </tr>
              <tr>
                <td align="left" width="33%">Armor Red: <?=$armortint_red?></td>
                <td align="left" width="33%">Armor Green: <?=$armortint_green?></td>
                <td align="left" width="34%">Armor Blue: <?=$armortint_blue?></td>
              </tr>
              <tr>
                <td align="left" width="33%">Melee1: <?=$d_meele_texture1?></td>
                <td align="left" width="33%">Melee2: <?=$d_meele_texture2?></td>
                <td align="left" width="34%">&nbsp;</td>
              </tr>
             </table>
            </fieldset>

           <fieldset>
             <legend><strong>Misc</strong></legend>
             <table width="100%" border="0" cellpadding="3" cellspacing="0">
               <tr>
                 <td align="left" width="33%">qglobal: <?=$qglobal?></td>
                 <td align="left" width="33%">npc_aggro: <?=$npc_aggro?></td>
                 <td align="left" width="34%">Findable: <?=$findable?></td>
                 
               </tr>
               <tr>
               <td align="left" width="33%">Trackable: <?=$trackable?></td>
                 <td align="left" width="33%">Spawn Limit: <?=$spawn_limit?></td>
                 <td align="left" width="34%">Version: <?=$version?></td>
               </tr>
               <tr>
                <? if ($pet == 1):?>
                 <td align="left" width="33%">Pet: Yes</td>
                 <? endif;?>
                 <? if ($pet == 0):?>
                 <td align="left" width="33%">Pet: No</td>
                 <? endif;?>
                 </tr>
             </table>
           </td>
         </tr>
       </table><br><br>
     <center>
<input type="hidden" name="name" value="<?=$name?>">
<input type="hidden" name="lastname" value="<?=$lastname?>">
<input type="hidden" name="level" value="<?=$level?>">
<input type="hidden" name="race" value="<?=$race?>">
<input type="hidden" name="class" value="<?=$class?>">
<input type="hidden" name="bodytype" value="<?=$bodytype?>">
<input type="hidden" name="hp" value="<?=$hp?>">
<input type="hidden" name="gender" value="<?=$gender?>">
<input type="hidden" name="texture" value="<?=$texture?>">
<input type="hidden" name="helmtexture" value="<?=$helmtexture?>">
<input type="hidden" name="size" value="<?=$size?>">
<input type="hidden" name="hp_regen_rate" value="<?=$hp_regen_rate?>">
<input type="hidden" name="mana_regen_rate" value="<?=$mana_regen_rate?>">
<input type="hidden" name="loottable_id" value="<?=$loottable_id?>">
<input type="hidden" name="merchant_id" value="<?=$merchant_id?>">
<input type="hidden" name="npc_spells_id" value="<?=$npc_spells_id?>">
<input type="hidden" name="npc_faction_id" value="<?=$npc_faction_id?>">
<input type="hidden" name="mindmg" value="<?=$mindmg?>">
<input type="hidden" name="maxdmg" value="<?=$maxdmg?>">
<input type="hidden" name="aggroradius" value="<?=$aggroradius?>">
<input type="hidden" name="face" value="<?=$face?>">
<input type="hidden" name="luclin_hairstyle" value="<?=$luclin_hairstyle?>">
<input type="hidden" name="luclin_haircolor" value="<?=$luclin_haircolor?>">
<input type="hidden" name="luclin_eyecolor" value="<?=$luclin_eyecolor?>">
<input type="hidden" name="luclin_eyecolor2" value="<?=$luclin_eyecolor2?>">
<input type="hidden" name="luclin_beardcolor" value="<?=$luclin_beardcolor?>"
<input type="hidden" name="luclin_beard" value="<?=$luclin_beard?>">
<input type="hidden" name="drakkin_heritage" value="<?=$drakkin_heritage?>">
<input type="hidden" name="drakkin_tattoo" value="<?=$drakkin_tattoo?>">
<input type="hidden" name="drakkin_details" value="<?=$drakkin_details?>">
<input type="hidden" name="armortint_red" value="<?=$armortint_red?>">
<input type="hidden" name="armortint_green" value="<?=$armortint_green?>">
<input type="hidden" name="armortint_blue" value="<?=$armortint_blue?>">
<input type="hidden" name="d_meele_texture1" value="<?=$d_meele_texture1?>">
<input type="hidden" name="d_meele_texture2" value="<?=$d_meele_texture2?>">
<input type="hidden" name="runspeed" value="<?=$runspeed?>">
<input type="hidden" name="MR" value="<?=$MR?>">
<input type="hidden" name="CR" value="<?=$CR?>">
<input type="hidden" name="DR" value="<?=$DR?>">
<input type="hidden" name="FR" value="<?=$FR?>">
<input type="hidden" name="PR" value="<?=$PR?>">
<input type="hidden" name="see_invis" value="<?=$see_invis?>">
<input type="hidden" name="see_invis_undead" value="<?=$see_invis_undead?>">
<input type="hidden" name="see_hide" value="<?=$see_hide?>">
<input type="hidden" name="see_improved_hide" value="<?=$see_improved_hide?>"
<input type="hidden" name="qglobal" value="<?=$qglobal?>">
<input type="hidden" name="AC" value="<?=$AC?>">
<input type="hidden" name="npc_aggro" value="<?=$npc_aggro?>">
<input type="hidden" name="spawn_limit" value="<?=$spawn_limit?>">
<input type="hidden" name="attack_speed" value="<?=$attack_speed?>">
<input type="hidden" name="findable" value="<?=$findable?>">
<input type="hidden" name="trackable" value="<?=$trackable?>">
<input type="hidden" name="ATK" value="<?=$ATK?>">
<input type="hidden" name="Accuracy" value="<?=$Accuracy?>">
<input type="hidden" name="STR" value="<?=$STR?>">
<input type="hidden" name="STA" value="<?=$STA?>">
<input type="hidden" name="DEX" value="<?=$DEX?>">
<input type="hidden" name="AGI" value="<?=$AGI?>">
<input type="hidden" name="_INT" value="<?=$_INT?>">
<input type="hidden" name="WIS" value="<?=$WIS?>">
<input type="hidden" name="CHA" value="<?=$CHA?>">
<input type="hidden" name="version" value="<?=$version?>">
<input type="hidden" name="npcspecialattks" value="<?=$npcspecialattks?>">
            <td align="left" width="17%">NEW ID:<input type="text" name="id" size="10" value="<?=$suggestedid?>"></td>
            <input type="submit" value="Copy NPC">
     </center>
     </div>
     </div>

