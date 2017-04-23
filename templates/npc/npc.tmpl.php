<?$export_sql_array = export_sql();?>
  <div id="sql_block" style="display:none;">
    <center>
      <textarea id="insert_sql" rows="3" cols="90"><?=$export_sql_array['insert']?></textarea><br><br>
      <textarea id="update_sql" rows="3" cols="90"><?=$export_sql_array['update']?></textarea><br><br>
      <button type="button" id="copy_insert" onClick="clipboardData.setData('Text', insert_sql.value);">Copy INSERT to Clipboard</button>&nbsp;
      <button type="button" id="copy_update" onClick="clipboardData.setData('Text', update_sql.value);">Copy UPDATE to Clipboard</button>&nbsp;
      <button type="button" id="hide_sql" onClick="document.getElementById('sql_block').style.display='none';document.getElementById('sql_image').style.display='inline';">Hide SQL</button>
    </center><br>
  </div>
  <form name="npc" method="post" action="index.php?editor=npc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=28">
    <div class="table_container">
      <div class="table_header">
        <div style="float:right">
          <a onClick="document.getElementById('sql_block').style.display='block';document.getElementById('sql_image').style.display='none';"><img id="sql_image" src="images/sql.gif" style="border: 0;" title="Show SQL" alt="Show SQL"></a>
          <a href="index.php?editor=npc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&action=42"><img src="images/add.gif" style="border: 0;" title="Add an NPC" alt="Add an NPC"></a>
          <a href="index.php?editor=npc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=1"><img src="images/c_table.gif" style="border: 0;" title="Edit this NPC" alt="Edit this NPC"></a>
          <a href="index.php?editor=npc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=43"><img src="images/upgrade.gif" style="border: 0;" title="Change NPC's Level" alt="Change NPC's Level"></a>
          <a href="index.php?editor=npc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=52"><img src="images/create.gif" style="border: 0;" title="Change NPC's AC/Resists" alt="Change NPC's AC/Resists"></a>
          <a href="index.php?editor=npc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=40"><img src="images/zone.gif" style="border: 0;" title="Get next npcid for a zone" alt="Get next npcid for a zone"></a>
          <a onClick="return confirm('Really delete npcid <?=$npcid?>?');" href="index.php?editor=npc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=24"><img src="images/table.gif" style="border: 0;" title="Delete this NPC" alt="Delete this NPC"></a>
        </div>
        <?=$id?> - <?=$name?> <?echo ($lastname != '' ? "($lastname)" : '');?>
      </div>
      <div class="table_content">
        <table cellspacing="0" border="0" width="100%">
          <tr>
            <td>
              <center>
                <h1><?=$name?><br>(<?echo ($lastname != '' ? "$lastname" : 'no title');?>)</h1><br>
                <table style="font-size: 12px; margin-bottom: 80px;">
                  <tr>
                    <td>
<?if($isquest == 1) {?>
                      <a href="index.php?editor=npc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=71"><center><strong>Is Quest NPC</strong></center><br> </a>
<?}?>
                      <strong>Race:</strong> <?echo "<a title='Race: " . $race . "'>" . $races[$race] . "</a>";?><br>
                      <strong>Class:</strong> <?echo "<a title='Class: " . $class . "'>" . $classes[$class] . "</a>";?><br>
                      <strong>Level:</strong> <?=$level?><br>
                      <strong>Max Level:</strong> <?=$maxlevel?><br>
                      <strong>Body Type:</strong> <?echo "<a title='Body Type: " . $bodytype . "'>" . $bodytypes[$bodytype] . "</a>";?><br>
                      <strong>Vendor:</strong> <a href="index.php?editor=npc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=22" title="View/Change"><?echo ($merchant_id != 0 ? $merchant_id : "no");?></a><br>
                      <strong>Alt Currency:</strong> <a href="index.php?editor=altcur&npcid=<?=$id?>&action=<?echo ($alt_currency_id != 0) ? '10">' . get_currency_name($alt_currency_id) : '8">no';?></a><br>
                      <strong>Adventure:</strong> <a href="index.php?editor=npc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=29" title="View/Change"><?echo ($adventure_template_id != 0 ? $adventure_template_id : "no");?></a><br>
                      <strong>Trap:</strong> <a href="index.php?editor=npc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=31" title="View/Change"><?echo ($trap_template != 0 ? $trap_template : "no");?></a><br>
<?if($armortint_id > 0) {?>
                      <strong>Tint:</strong> <a href="index.php?editor=npc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&tint_id=<?=$armortint_id?>&action=33"><?=$armortint_id?></a><br>
<?} else {?>
                      <strong>Tint:</strong> <a href="index.php?editor=npc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=35" title="View/Change"><?echo "no";?></a><br>
<?}?>
<?if($pet == 1) {?>
                      <strong>Pet:</strong> <a href="index.php?editor=npc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=56" title="View/Change"><?echo "yes";?></a><br>
<?} else {?>
                      <strong>Pet:</strong> <a href="index.php?editor=npc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=54" title="View/Change"><?echo "no";?></a><br>
<?}?>
<?if($emoteid > 0) {?>
                      <strong>EmoteID:</strong> <a href="index.php?editor=npc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&emoteid=<?=$emoteid?>&action=72"><?=$emoteid?></a>
<?} else {?>
                      <strong>EmoteID:</strong> <a href="index.php?editor=npc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&emoteid=<?=$emoteid?>&action=76">none</a>
<?}?>

                    </td>
                  </tr>
                </table>
                <div style="padding: 10px; border: 1px solid grey; margin-right: 10px;">
                  <b>NPC Faction ID</b>: <?=$npc_faction_id?> [<a href="index.php?editor=npc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=3">edit</a>]
                  [<a href="index.php?editor=npc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&npcfid=<?=$npc_faction_id?>&action=47">update</a>]<br>
<?if ($npc_faction_id > 0) {?>
                  "<a href="index.php?editor=npc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=10"><?=$factionname?></a>"<br><br>
<?}?>
                  <b>Primary Faction</b>: [<a href="index.php?editor=npc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=12">edit</a>]<br>
                  <?echo ($primaryfactionname != '') ? "<a title='Faction: " . $primaryfaction . "'>" . $primaryfactionname . "</a>" : "None";?><br><br>
                  <b>Faction Hits:</b> <a href="index.php?editor=npc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=15"><img src="images/add.gif" style="border: 0;" title="Add Faction Hit" alt="Add Faction Hit"></a><br>
<?if ($faction_hits != '') {?>
                  <table width="100%">
<?foreach($faction_hits as $hit): extract($hit);?>
                    <tr>
                      <td><?echo "<a title='Faction ID: " . $faction_id . "'>" . $factions[$faction_id] . "</a>";?></td>
                      <td><?=$value?></td>
                      <td><?=$faction_values[$npc_value]?></td>
                      <td>(<?=$tmpfacshort[$temp]?>)</td>
                      <td align="right">
                        <a href="index.php?editor=npc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&npc_faction_id=<?=$npc_faction_id?>&faction_id=<?=$faction_id?>&action=19"><img src="images/edit2.gif" style="border: 0;" title="Edit this Faction Hit" alt="Edit this Faction Hit"></a>
                        <a href="index.php?editor=npc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&npc_faction_id=<?=$npc_faction_id?>&faction_id=<?=$faction_id?>&action=21" onClick="return confirm('Are you sure you want to remove this faction hit?');"><img src="images/remove.gif" style="border: 0;" title="Remove this Faction Hit" alt="Remove this Faction Hit"></a>
                      </td>
                    </tr>
<?endforeach;?>
                  </table>
<?} else {?>
                None<br>
<?}?>
                </div>
              </center>
            </td>
            <td>
              <fieldset>
                <legend><strong>Vitals</strong></legend>
                <table width="100%" border="0" cellpadding="3" cellspacing="0">
                  <tr>
                    <td align="left" width="33%">AC: <?=$AC?></td>
                    <td align="left" width="33%">HP: <?=$hp?></td>
                    <td align="left" width="34%">Mana: <?=$mana?></td>
                  </tr>
                  <tr>
                    <td align="left" width="33%">Run: <?=$runspeed?></td>
                    <td align="left" width="33%">Avoidance: <?=$Avoidance?></td>
                    <td align="left" width="34%">Accuracy: <?=$Accuracy?></td>
                  </tr>
                  <tr>
                    <td align="left" width="34%">ATK: <?=$ATK?></td>
                    <td align="left" width="33%">See Invis: <?=$yesno[$see_invis]?></td>
                    <td align="left" width="34%">See ITU: <?=$yesno[$see_invis_undead]?></td>
                  </tr>
                  <tr>
                    <td align="left" width="33%">See Hide: <?=$yesno[$see_hide]?></td>
                    <td align="left" width="33%">See Imp Hide: <?=$yesno[$see_improved_hide]?></td>
                    <td align="left" width="34%">Scalerate: <?=$scalerate?></td>
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
<?($mrper = $MR*0.5);?>
<?($crper = $CR*0.5);?>
<?($frper = $FR*0.5);?>
<?($prper = $PR*0.5);?>
<?($drper = $DR*0.5);?>
<?($corper = $Corrup*0.5);?>
                  <tr>
                    <td align="left" width="33%">MR: <?=$MR?> (<?=$mrper?>%)</td>
                    <td align="left" width="33%">CR: <?=$CR?> (<?=$crper?>%)</td>
                    <td align="left" width="34%">FR: <?=$FR?> (<?=$frper?>%)</td>
                  </tr>
                  <tr>
                    <td align="left" width="33%">PR: <?=$PR?> (<?=$prper?>%)</td>
                    <td align="left" width="33%">DR: <?=$DR?> (<?=$drper?>%)</td>
                    <td align="left" width="34%">Corrup: <?=$Corrup?> (<?=$corper?>%)</td>
                  </tr>
                  <tr>
                    <td align="left" width="33%">Physical: <?=$PhR?></td>
                    <td align="left" width="33%">&nbsp;</td>
                    <td align="left" width="34%">&nbsp;</td>
                  </tr>
                </table>
              </fieldset>
              <fieldset>
                <legend><strong>Combat</strong></legend>
                <table width="100%" border="0" cellpadding="3" cellspacing="0">
<?($slotmit = $slow_mitigation*100);?>
                  <tr>
                    <td align="left" width="33%">MinDmg: <?=$mindmg?></td>
                    <td align="left" width="33%">MaxDmg: <?=$maxdmg?></td>
                    <td align="left" width="34%">Attack Count: <?=$attack_count?></td>
                  </tr>
                  <tr>
                    <td align="left" width="33%">Loottable ID: <?=$loottable_id?></td>
                    <td align="left" width="33%">HP Regen: <?=$hp_regen_rate?></td>
                    <td align="left" width="34%">MP Regen: <?=$mana_regen_rate?></td>
                  </tr>
                  <tr>
                    <td align="left" width="33%">Aggro: <?=$aggroradius?></td>
                    <td align="left" width="33%">&nbsp;</td>
<?
  $new_special_abilities = '';
    for ($i = 1; $i <= $special_abilities_max; $i++){
      if (preg_match("/^$i,/", $special_abilities, $match) == 1 || preg_match("/\^$i,/", $special_abilities, $match) == 1){
        $match[0] = ltrim($match[0], "^");
        $new_special_abilities .= $match[0];
      }
    }
    $new_special_abilities = rtrim($new_special_abilities, ",");
?>
                    <td align="left" width="34%">Atk Delay: <?=$attack_delay?></td>
                  </tr>
                  <tr>
                    <td align="left" width="33%">Assist: <?=$assistradius?></td>
                    <td align="left" width="33%">Spell Scale: <?=$spellscale?>%</td>
                    <td align="left" width="34%">NPC Spells ID: <?=$npc_spells_id?></td>
                  </tr>
                  <tr>
                    <td align="left" width="33%">Slow Mit: <?=$slow_mitigation?> (<?=$slotmit?>%)</td>
                    <td align="left" width="33%">Heal Scale: <?=$healscale?>%</td>
                    <td align="left" width="34%">NPC Aggro: <?=$npc_aggro?></td>
                  </tr>
                  <tr>
                    <td colspan="3">Special Abilities: <?echo ($new_special_abilities) ? $new_special_abilities : "None";?></td>
                  </tr>
                </table>
              </fieldset>
              <fieldset>
                <legend><strong>Appearance</strong></legend>
                <table width="100%" border="0" cellpadding="3" cellspacing="0">
                  <tr>
                    <td align="left" width="33%">Gender: <?echo "<a title='Gender: " . $gender . "'>" . $genders[$gender] . "</a>";?></td>
                    <td align="left" width="33%">Size: <?=$size?></td>
                    <td align="left" width="34%">Texture: <?=$texture?></td>
                  </tr>
                  <tr>
                    <td align="left" width="33%">Face: <?=$face?></td>
                    <td align="left" width="33%">Helm: <?=$helmtexture?></td>
                    <td align="left" width="34%">Hero's Forge Model: <?=$herosforgemodel?></td>
                  </tr>
                  <tr>
                    <td align="left" width="33%">Hair Style: <?=$luclin_hairstyle?></td>
                    <td align="left" width="33%">Hair Color: <?=$luclin_haircolor?></td>
                    <td align="left" width="34%">Eye Color: <?=$luclin_eyecolor?></td>
                  </tr>
                  <tr>
                    <td align="left" width="33%">Eye Color 2: <?=$luclin_eyecolor2?></td>
                    <td align="left" width="33%">Beard: <?=$luclin_beard?></td>
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
                    <td align="left" width="33%">Melee1: <?=$d_melee_texture1?></td>
                    <td align="left" width="33%">Melee2: <?=$d_melee_texture2?></td>
                    <td align="left" width="34%">Light Source: <?=$light?></td>
                  </tr>
                  <tr>
                   <td align="left" width="33%">Melee1 Type: <?=$prim_melee_type?></td>
                   <td align="left" width="33%">Melee2 Type: <?=$sec_melee_type?></td>
                   <td align="left" width="34%">&nbsp;</td>
                  </tr>
                </table>
              </fieldset>
              <fieldset>
                <legend><strong>Misc</strong></legend>
                <table width="100%" border="0" cellpadding="3" cellspacing="0">
                  <tr>
                    <td align="left" width="33%">Qglobal: <?=$yesno[$qglobal]?></td>
                    <td align="left" width="33%">Findable: <?=$yesno[$findable]?></td>
                    <td align="left" width="34%">Trackable: <?=$yesno[$trackable]?></td>
                  </tr>
                  <tr>
                    <td align="left" width="33%">Spawn Limit: <?echo ($spawn_limit > 0) ? $spawn_limit : "None";?></td>
                    <td align="left" width="33%">Unique Spawn: <?=$yesno[$unique_spawn_by_name]?></td>
                    <td align="left" width="34%">Ignore Despawn: <?=$yesno[$ignore_despawn]?></td>
                  </tr>
                  <tr>
                    <td align="left" width="33%">Pet: <?=$yesno[$pet]?></td>
                    <td align="left" width="33%">Private Corpse: <?=$yesno[$private_corpse]?></td>
                    <td align="left" width="34%">Underwater: <?=$yesno[$underwater]?></td>
                  </tr>
                  <tr>
                    <td align="left" width="33%">No Target Hotkey: <?=$yesno[$no_target_hotkey]?></td>
                    <td align="left" width="33%">Raid Target: <?=$yesno[$raid_target]?></td>
                    <td align="left" width="34%">Version: <?=$version?></td>
                  </tr>
                </table>
              </fieldset>
            </td>
          </tr>
        </table><br><br>
        <input type="hidden" name="name" value="<?=$name?>">
        <input type="hidden" name="lastname" value="<?=$lastname?>">
        <input type="hidden" name="level" value="<?=$level?>">
        <input type="hidden" name="race" value="<?=$race?>">
        <input type="hidden" name="class" value="<?=$class?>">
        <input type="hidden" name="bodytype" value="<?=$bodytype?>">
        <input type="hidden" name="hp" value="<?=$hp?>">
        <input type="hidden" name="mana" value="<?=$mana?>">
        <input type="hidden" name="gender" value="<?=$gender?>">
        <input type="hidden" name="texture" value="<?=$texture?>">
        <input type="hidden" name="helmtexture" value="<?=$helmtexture?>">
        <input type="hidden" name="herosforgemodel" value="<?=$herosforgemodel?>">
        <input type="hidden" name="size" value="<?=$size?>">
        <input type="hidden" name="hp_regen_rate" value="<?=$hp_regen_rate?>">
        <input type="hidden" name="mana_regen_rate" value="<?=$mana_regen_rate?>">
        <input type="hidden" name="loottable_id" value="<?=$loottable_id?>">
        <input type="hidden" name="merchant_id" value="<?=$merchant_id?>">
        <input type="hidden" name="alt_currency_id" value="<?=$alt_currency_id?>">
        <input type="hidden" name="npc_spells_id" value="<?=$npc_spells_id?>">
        <input type="hidden" name="npc_spells_effects_id" value="<?=$npc_spells_effects_id?>">
        <input type="hidden" name="npc_faction_id" value="<?=$npc_faction_id?>">
        <input type="hidden" name="adventure_template_id" value="<?=$adventure_template_id?>">
        <input type="hidden" name="trap_template" value="<?=$trap_template?>">
        <input type="hidden" name="mindmg" value="<?=$mindmg?>">
        <input type="hidden" name="maxdmg" value="<?=$maxdmg?>">
        <input type="hidden" name="attack_count" value="<?=$attack_count?>">
        <input type="hidden" name="special_abilities" value="<?=$special_abilities?>">
        <input type="hidden" name="aggroradius" value="<?=$aggroradius?>">
        <input type="hidden" name="assistradius" value="<?=$assistradius?>">
        <input type="hidden" name="face" value="<?=$face?>">
        <input type="hidden" name="luclin_hairstyle" value="<?=$luclin_hairstyle?>">
        <input type="hidden" name="luclin_haircolor" value="<?=$luclin_haircolor?>">
        <input type="hidden" name="luclin_eyecolor" value="<?=$luclin_eyecolor?>">
        <input type="hidden" name="luclin_eyecolor2" value="<?=$luclin_eyecolor2?>">
        <input type="hidden" name="luclin_beardcolor" value="<?=$luclin_beardcolor?>">
        <input type="hidden" name="luclin_beard" value="<?=$luclin_beard?>">
        <input type="hidden" name="drakkin_heritage" value="<?=$drakkin_heritage?>">
        <input type="hidden" name="drakkin_tattoo" value="<?=$drakkin_tattoo?>">
        <input type="hidden" name="drakkin_details" value="<?=$drakkin_details?>">
        <input type="hidden" name="armortint_id" value="<?=$armortint_id?>">
        <input type="hidden" name="armortint_red" value="<?=$armortint_red?>">
        <input type="hidden" name="armortint_green" value="<?=$armortint_green?>">
        <input type="hidden" name="armortint_blue" value="<?=$armortint_blue?>">
        <input type="hidden" name="d_melee_texture1" value="<?=$d_melee_texture1?>">
        <input type="hidden" name="d_melee_texture2" value="<?=$d_melee_texture2?>">
        <input type="hidden" name="ammo_idfile" value="<?=$ammo_idfile?>">
        <input type="hidden" name="prim_melee_type" value="<?=$prim_melee_type?>">
        <input type="hidden" name="sec_melee_type" value="<?=$sec_melee_type?>">
        <input type="hidden" name="ranged_type" value="<?=$ranged_type?>">
        <input type="hidden" name="runspeed" value="<?=$runspeed?>">
        <input type="hidden" name="MR" value="<?=$MR?>">
        <input type="hidden" name="CR" value="<?=$CR?>">
        <input type="hidden" name="DR" value="<?=$DR?>">
        <input type="hidden" name="FR" value="<?=$FR?>">
        <input type="hidden" name="PR" value="<?=$PR?>">
        <input type="hidden" name="Corrup" value="<?=$Corrup?>">
        <input type="hidden" name="PhR" value="<?=$PhR?>">
        <input type="hidden" name="see_invis" value="<?=$see_invis?>">
        <input type="hidden" name="see_invis_undead" value="<?=$see_invis_undead?>">
        <input type="hidden" name="qglobal" value="<?=$qglobal?>">
        <input type="hidden" name="AC" value="<?=$AC?>">
        <input type="hidden" name="npc_aggro" value="<?=$npc_aggro?>">
        <input type="hidden" name="spawn_limit" value="<?=$spawn_limit?>">
        <input type="hidden" name="attack_speed" value="<?=$attack_speed?>">
        <input type="hidden" name="attack_delay" value="<?=$attack_delay?>">
        <input type="hidden" name="findable" value="<?=$findable?>">
        <input type="hidden" name="STR" value="<?=$STR?>">
        <input type="hidden" name="STA" value="<?=$STA?>">
        <input type="hidden" name="DEX" value="<?=$DEX?>">
        <input type="hidden" name="AGI" value="<?=$AGI?>">
        <input type="hidden" name="_INT" value="<?=$_INT?>">
        <input type="hidden" name="WIS" value="<?=$WIS?>">
        <input type="hidden" name="CHA" value="<?=$CHA?>">
        <input type="hidden" name="see_hide" value="<?=$see_hide?>">
        <input type="hidden" name="see_improved_hide" value="<?=$see_improved_hide?>">
        <input type="hidden" name="trackable" value="<?=$trackable?>">
        <input type="hidden" name="ATK" value="<?=$ATK?>">
        <input type="hidden" name="Accuracy" value="<?=$Accuracy?>">
        <input type="hidden" name="Avoidance" value="<?=$Avoidance?>">
        <input type="hidden" name="slow_mitigation" value="<?=$slow_mitigation?>">
        <input type="hidden" name="version" value="<?=$version?>">
        <input type="hidden" name="maxlevel" value="<?=$maxlevel?>">
        <input type="hidden" name="scalerate" value="<?=$scalerate?>">
        <input type="hidden" name="private_corpse" value="<?=$private_corpse?>">
        <input type="hidden" name="unique_spawn_by_name" value="<?=$unique_spawn_by_name?>">
        <input type="hidden" name="underwater" value="<?=$underwater?>">
        <input type="hidden" name="isquest" value="<?=$isquest?>">
        <input type="hidden" name="emoteid" value="<?=$emoteid?>">
        <input type="hidden" name="spellscale" value="<?=$spellscale?>">
        <input type="hidden" name="healscale" value="<?=$healscale?>">
        <input type="hidden" name="no_target_hotkey" value="<?=$no_target_hotkey?>">
        <input type="hidden" name="raid_target" value="<?=$raid_target?>">
        <input type="hidden" name="light" value="<?=$light?>">
        <input type="hidden" name="ignore_despawn" value="<?=$ignore_despawn?>">
        <center>
          NEW ID:<input type="text" name="id" size="10" value="<?=$suggestedid?>">
          <input type="submit" value="Copy NPC">
        </center>
      </div>
    </div>
  </form>
