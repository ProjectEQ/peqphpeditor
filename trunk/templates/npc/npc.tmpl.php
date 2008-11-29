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
                <td align="left" width="33%">HP Regen: <?=$hp_regen_rate?></td>
                <td align="left" width="33%">MP Regen: <?=$mana_regen_rate?></td>
                <td align="left" width="34%">Aggro: <?=$aggroradius?></td>
              </tr>
              <tr>
                <td align="left" width="33%">Atk Speed: <?=$attack_speed?></td>
                <td align="left" width="34%">Special Atks: <?=$npcspecialattks?></td>
                <td align="left" width="33%">&nbsp;</td>
              </tr>
              <tr>
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
               <td align="left" width="34%">Trackable: <?=$trackable?></td>
                 <td align="left" width="33%">Spawn Limit: <?=$spawn_limit?></td>
                 <td align="left" width="33%">&nbsp;</td>
               </tr>
             </table>
           </td>
         </tr>
       </table>
     </div>
     </div>

