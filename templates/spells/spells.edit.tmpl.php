  <form name="spell_edit" method="post" action="index.php?editor=spells&id=<?=$id?>&action=6">
    <div class="edit_form">
      <div class="edit_form_header">
        Edit Spell <?=$id?> - <?=$spellname?> (<a href="http://lucy.allakhazam.com/spell.html?id=<?=$id?>" target="_blank">Lucy</a>)
        <div style="float:right;">
          <a href="index.php?editor=spells&id=<?=$id?>&action=7" onClick="return confirm('Really Copy Spell <?=$id?>?');"><img src="images/last.gif" border="0" title="Copy this Spell"></a>
          <a href="index.php?editor=spells&id=<?=$id?>&action=5" onClick="return confirm('Really Delete Spell <?=$id?>?');"><img src="images/table.gif" border="0" title="Delete this Spell"></a>
        </div>
      </div>
      <div class="edit_form_content">
        <center>
          <fieldset style="text-align: left;">
            <legend><strong><font size="4">General</font></strong></legend>
            <input type="hidden" name="id" value="<?=$id?>">
            <table width="100%" border="0" cellpadding="3" cellspacing="0">
              <tr>
                <td width="50%">Name:<br/><input type="text" name="name" size="40" value="<?=$spellname?>"></td>
                <td>Teleport Zone / Pet Type:<br/><input type="text" name="teleport_zone" size="40" value="<?=$teleport_zone?>"></td>
              </tr>
              <tr>
                <td width="50%">You Cast Message:<br/><input type="text" name="you_cast" size="40" value="<?=$you_cast?>"></td>
                <td>Other Casts Message:<br/><input type="text" name="other_casts" size="40" value="<?=$other_casts?>"></td>
              </tr>
              <tr>
                <td width="50%">Cast on You Message:<br/><input type="text" name="cast_on_you" size="40" value="<?=$cast_on_you?>"></td>
                <td>Cast on Other Message:<br/><input type="text" name="cast_on_other" size="40" value="<?=$cast_on_other?>"></td>
              </tr>
              <tr>
                <td width="50%">Spell Fades Message:<br/><input type="text" name="spell_fades" size="40" value="<?=$spell_fades?>"></td>
                <td>Spell Category:<br/>
                  <select name="spell_category" style="width:220px;">
<?foreach($spellgroups as $k => $v):?>
                    <option value="<?=$k?>"<? echo ($k == $spell_category) ? " selected" : ""?>><?=$k?>: <?=$v?></option>
<?endforeach;?>
                  </select><input type="text" name="spcat" size="3" value="<?=$spell_category?>">
                </td>
              </tr>
              <tr>
                <td>Skill:<br/>
                  <select name="skill" style="width:265px;">
<?foreach($skills as $k => $v):?>
                    <option value="<?=$k?>"<? echo ($k == $skill) ? " selected" : ""?>><?=$k?>: <?=$v?></option>
<?endforeach;?>
                  </select>
                </td>
                <td>Target:<br/>
                  <select name="targettype" style="width:265px;">
<?foreach($targets as $k => $v):?>
                    <option value="<?=$k?>"<? echo ($k == $targettype) ? " selected" : ""?>><?=$k?>: <?=$v?></option>
<?endforeach;?>
                  </select>
                </td>
              </tr>
              <tr>
                <td>Zone Type:<br/>
                  <select name="zonetype" style="width:265px;">
<?foreach($zonetypes as $k => $v):?>
                    <option value="<?=$k?>"<? echo ($k == $zonetype) ? " selected" : ""?>><?=$k?>: <?=$v?></option>
<?endforeach;?>
                  </select>
                </td>
                <td>Environment Type:<br/>
                  <select name="EnvironmentType" style="width:265px;">
<?foreach($envtypes as $k => $v):?>
                    <option value="<?=$k?>"<? echo ($k == $EnvironmentType) ? " selected" : ""?>><?=$k?>: <?=$v?></option>
<?endforeach;?>
                  </select>
                </td>
              </tr>
              <tr>
                <td>Light Type:<br/>
                  <select name="LightType" style="width:265px;">
<?foreach($lighttypes as $k => $v):?>
                    <option value="<?=$k?>"<? echo ($k == $LightType) ? " selected" : ""?>><?=$k?>: <?=$v?></option>
<?endforeach;?>
                  </select>
                </td>
                <td>Resist Type:<br/>
                  <select name="resisttype" style="width:265px;">
<?foreach($resisttypes as $k => $v):?>
                    <option value="<?=$k?>"<? echo ($k == $resisttype) ? " selected" : ""?>><?=$k?>: <?=$v?></option>
<?endforeach;?>
                  </select>
                </td>
              </tr>
              <tr>
                <td>Effect Type:<br/>
                  <select name="goodEffect" style="width:265px;">
<?foreach($effecttypes as $k => $v):?>
                    <option value="<?=$k?>"<? echo ($k == $goodEffect) ? " selected" : ""?>><?=$k?>: <?=$v?></option>
<?endforeach;?>
                  </select>
                </td>
                <td>Activated:<br/>
                  <select name="Activated" style="width:265px;">
<?foreach($acttypes as $k => $v):?>
                    <option value="<?=$k?>"<? echo ($k == $Activated) ? " selected" : ""?>><?=$k?>: <?=$v?></option>
<?endforeach;?>
                  </select>
                </td>
              </tr>
              <tr>
                <td>Time of Day:<br/>
                  <select name="TimeOfDay" style="width:100px;">
<?foreach($daytimes as $k => $v):?>
                    <option value="<?=$k?>"<? echo ($k == $TimeOfDay) ? " selected" : ""?>><?=$k?>: <?=$v?></option>
<?endforeach;?>
                  </select>
                </td>
                <td>Travel Type:<br/>
                  <select name="TravelType" style="width:265px;">
<?foreach($traveltypes as $k => $v):?>
                    <option value="<?=$k?>"<? echo ($k == $TravelType) ? " selected" : ""?>><?=$k?>: <?=$v?></option>
<?endforeach;?>
                  </select>
                </td>
              </tr>
              <tr>
                <td>Buff Duration:<br/><input type="text" name="buffduration" size="10" value="<?=$buffduration?>"></td>
                <td>Buff Duration Formula:<br/>
                  <select name="buffdurationformula" style="width:265px;">
<?foreach($buffformulas as $k => $v):?>
                    <option value="<?=$k?>"<? echo ($k == $buffdurationformula) ? " selected" : ""?>><?=$k?>: <?=$v?></option>
<?endforeach;?>
                  </select>
                </td>
              </tr>
              <tr>
                <td colspan="2">
                  <table border="0" cellspacing="0" cellpadding="2" width="100%">
                    <tr>
                      <td><input type="checkbox" name="dot_stacking_exempt" <? echo ($dot_stacking_exempt) ? "checked" : "" ?>> DoT Stacking Exempt</td>
                      <td><input type="checkbox" name="deleteable" <? echo ($deleteable) ? "checked" : "" ?>> Deleteable</td>
                      <td><input type="checkbox" name="uninterruptable" <? echo ($uninterruptable) ? "checked" : "" ?>> Uninterruptable</td>
                      <td><input type="checkbox" name="nodispell" <? echo ($nodispell) ? "checked" : "" ?>> No Dispell</td>
                      <td><input type="checkbox" name="can_mgb" <? echo ($can_mgb) ? "checked" : "" ?>> Can MGB</td>
                      <td><input type="checkbox" name="short_buff_box" <? echo ($short_buff_box) ? "checked" : "" ?>> Short Buff Box</td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td colspan="2">
                  <table border="0" cellspacing="0" cellpadding="2" width="100%">
                    <tr>
                      <td width="16%">Old Icon:<br/><input type="text" name="icon" value="<?=$icon?>" size="6"></td>
                      <td width="17%">New Icon:<br/><input type="text" name="new_icon" value="<?=$new_icon?>" size="6"></td>
                      <td width="17%">Mem Icon:<br/><input type="text" name="memicon" value="<?=$memicon?>" size="6"></td>
                      <td width="16%">Spell Anim:<br/><input type="text" name="spellanim" value="<?=$spellanim?>" size="6"></td>
                      <td width="17%">Casting Anim:<br/><input type="text" name="CastingAnim" value="<?=$CastingAnim?>" size="6"></td>
                      <td width="17%">Target Anim:<br/><input type="text" name="TargetAnim" value="<?=$TargetAnim?>" size="6"></td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td colspan="2">
                  <table border="0" cellspacing="0" cellpadding="2" width="100%">
                    <tr>
                      <td width="16%">Recourse Link:<br/><input type="text" name="RecourseLink" value="<?=$RecourseLink?>" size="6"></td>
                      <td width="17%">Desc Num:<br/><input type="text" name="descnum" value="<?=$descnum?>" size="6"></td>
                      <td width="17%">Type Desc Num:<br/><input type="text" name="typedescnum" value="<?=$typedescnum?>" size="6"></td>
                      <td width="16%">Effect Desc Num:<br/><input type="text" name="effectdescnum" value="<?=$effectdescnum?>" size="6"></td>
                      <td width="17%">Effect Desc Num2:<br/><input type="text" name="effectdescnum2" value="<?=$effectdescnum2?>" size="6"></td>
                      <td width="17%">Spell Affect Index:<br/><input type="text" name="SpellAffectIndex" value="<?=$SpellAffectIndex?>" size="6"></td>
                    </tr>
                    <tr>
                      <td width="16%">Nimbus Effect:<br/><input type="text" name="nimbuseffect" value="<?=$nimbuseffect?>" size="6"></td>
                      <td width="17%">Disallow Sitting:<br/><input type="text" name="disallow_sit" value="<?=$disallow_sit?>" size="6"></td>
                      <td width="17%">Sneaking:<br/><input type="text" name="sneaking" value="<?=$sneaking?>" size="6"></td>
                      <td width="16%">LDoN Trap:<br/><input type="text" name="ldon_trap" value="<?=$ldon_trap?>" size="6"></td>
                      <td width="17%">No Block:<br/><input type="text" name="no_block" value="<?=$no_block?>" size="6"></td>
                      <td width="17%">&nbsp;</td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
            <table border="0" cellspacing="0" cellpadding="2" width="100%">
              <tr>
                <td colspan="3">NPC Category:<br/>
                  <select name="npc_category" style="width:265px;">
<?foreach($npccats as $k => $v):?>
                    <option value="<?=$k?>"<? echo ($k == $npc_category) ? " selected" : ""?>><?=$k?>: <?=$v?></option>
<?endforeach;?>
                  </select>
                </td>
                <td>NPC Usefulness:<br/><input type="text" name="npc_usefulness" value="<?=$npc_usefulness?>" size="6"></td>
                <td>
                  No Partial Resist:<br/>
                  <select name="no_partial_resist" style="width:80px;">
                    <option value="-1"<?echo ($no_partial_resist == -1) ? " selected" : "";?>>-1</option>
                    <option value="0"<?echo ($no_partial_resist == 0) ? " selected" : "";?>>0</option>
                    <option value="1"<?echo ($no_partial_resist == 1) ? " selected" : "";?>>1</option>
                  </select>
                </td>
                <td>
                  NPC No LoS:<br/>
                  <select name="npc_no_los" style="width:80px;">
                    <option value="-1"<?echo ($npc_no_los == -1) ? " selected" : "";?>>-1</option>
                    <option value="0"<?echo ($npc_no_los == 0) ? " selected" : "";?>>0</option>
                    <option value="1"<?echo ($npc_no_los == 1) ? " selected" : "";?>>1</option>
                  </select>
                </td>
                <td>
                  Reflectable:<br/>
                  <select name="reflectable" style="width:80px;">
                    <option value="-1"<?echo ($reflectable == -1) ? " selected" : "";?>>-1</option>
                    <option value="0"<?echo ($reflectable == 0) ? " selected" : "";?>>0</option>
                    <option value="1"<?echo ($reflectable == 1) ? " selected" : "";?>>1</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td>
                  Is Discipline:<br/>
                  <select name="IsDiscipline" style="width:80px;">
                    <option value="-1"<?echo ($IsDiscipline == -1) ? " selected" : "";?>>-1</option>
                    <option value="0"<?echo ($IsDiscipline == 0) ? " selected" : "";?>>0</option>
                    <option value="1"<?echo ($IsDiscipline == 1) ? " selected" : "";?>>1</option>
                  </select>
                </td>
                <td>
                  Not Extendable:<br/>
                  <select name="not_extendable" style="width:80px;">
                    <option value="-1"<?echo ($not_extendable == -1) ? " selected" : "";?>>-1</option>
                    <option value="0"<?echo ($not_extendable == 0) ? " selected" : "";?>>0</option>
                    <option value="1"<?echo ($not_extendable == 1) ? " selected" : "";?>>1</option>
                  </select>
                </td>
                <td>
                  Suspendable:<br/>
                  <select name="suspendable" style="width:80px;">
                    <option value="-1"<?echo ($suspendable == -1) ? " selected" : "";?>>-1</option>
                    <option value="0"<?echo ($suspendable == 0) ? " selected" : "";?>>0</option>
                    <option value="1"<?echo ($suspendable == 1) ? " selected" : "";?>>1</option>
                  </select>
                </td>
                <td>
                  Allow Rest:<br/>
                  <select name="allowrest" style="width:80px;">
                    <option value="-1"<?echo ($allowrest == -1) ? " selected" : "";?>>-1</option>
                    <option value="0"<?echo ($allowrest == 0) ? " selected" : "";?>>0</option>
                    <option value="1"<?echo ($allowrest == 1) ? " selected" : "";?>>1</option>
                  </select>
                </td>
                <td>
                  Not Out of Combat:<br/>
                  <select name="NotOutofCombat" style="width:80px;">
                    <option value="-1"<?echo ($NotOutofCombat == -1) ? " selected" : "";?>>-1</option>
                    <option value="0"<?echo ($NotOutofCombat == 0) ? " selected" : "";?>>0</option>
                    <option value="1"<?echo ($NotOutofCombat == 1) ? " selected" : "";?>>1</option>
                  </select>
                </td>
                <td>
                  Not In Combat:<br/>
                  <select name="NotInCombat" style="width:80px;">
                    <option value="-1"<?echo ($NotInCombat == -1) ? " selected" : "";?>>-1</option>
                    <option value="0"<?echo ($NotInCombat == 0) ? " selected" : "";?>>0</option>
                    <option value="1"<?echo ($NotInCombat == 1) ? " selected" : "";?>>1</option>
                  </select>
                </td>
                <td>
                  Persist Death:<br/>
                  <select name="persistdeath" style="width:80px;">
                    <option value="-1"<?echo ($persistdeath == -1) ? " selected" : "";?>>-1</option>
                    <option value="0"<?echo ($persistdeath == 0) ? " selected" : "";?>>0</option>
                    <option value="1"<?echo ($persistdeath == 1) ? " selected" : "";?>>1</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td colspan="2">
                  PC/NPC Only Flag:<br/>
                  <select name="pcnpc_only_flag" style="width:195px;">
                    <option value="0"<?echo ($pcnpc_only_flag == 0) ? " selected" : "";?>>0: N/A</option>
                    <option value="1"<?echo ($pcnpc_only_flag == 1) ? " selected" : "";?>>1: PCs and Mercs</option>
                    <option value="2"<?echo ($pcnpc_only_flag == 2) ? " selected" : "";?>>2: NPCs</option>
                  </select>
                </td>
                <td>
                  Cast Not Standing:<br/>
                  <select name="cast_not_standing" style="width:80px;">
                    <option value="-1"<?echo ($cast_not_standing == -1) ? " selected" : "";?>>-1</option>
                    <option value="0"<?echo ($cast_not_standing == 0) ? " selected" : "";?>>0</option>
                    <option value="1"<?echo ($cast_not_standing == 1) ? " selected" : "";?>>1</option>
                  </select>
                </td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
            </table>
          </fieldset><br/>
          <fieldset style="text-align:left;">
            <legend><strong><font size="4">Stats</font></strong></legend>
            <table width="100%" border="0" cellpadding="3" cellspacing="0">
              <tr>
                <td>Range:<br/><input type="text" name="range" size="5" value="<?=$range?>"></td>
                <td>Mana:<br/><input type="text" name="mana" size="5" value="<?=$mana?>"></td>
                <td>AoE Range:<br/><input type="text" name="aoerange" size="5" value="<?=$aoerange?>"></td>
                <td>Push Back:<br/><input type="text" name="pushback" size="5" value="<?=$pushback?>"></td>
                <td>Push Up:<br/><input type="text" name="pushup" size="5" value="<?=$pushup?>"></td>
                <td>Recovery Time (ms):<br/><input type="text" name="recovery_time" size="5" value="<?=$recovery_time?>"></td>
              </tr>
              <tr>
                <td>Cast Time (ms):<br/><input type="text" name="cast_time" size="5" value="<?=$cast_time?>"></td>
                <td>Recast Time (ms):<br/><input type="text" name="recast_time" size="5" value="<?=$recast_time?>"></td>
                <td>AE Duration (ms):<br/><input type="text" name="AEDuration" size="5" value="<?=$AEDuration?>"></td>
                <td>Base Difficulty:<br/><input type="text" name="basediff" size="5" value="<?=$basediff?>"></td>
                <td>Resist Difficulty:<br/><input type="text" name="ResistDiff" size="5" value="<?=$ResistDiff?>"></td>
                <td>Endurance Cost:<br/><input type="text" name="EndurCost" size="5" value="<?=$EndurCost?>"></td>
              </tr>
              <tr>
                <td width="17%">Endurance Upkeep:<br/><input type="text" name="EndurUpkeep" value="<?=$EndurUpkeep?>" size="5"></td>
                <td width="17%">Endurance Timer:<br/><input type="text" name="EndurTimerIndex" value="<?=$EndurTimerIndex?>" size="5"></td>
                <td width="16%">Hate Added:<br/><input type="text" name="HateAdded" value="<?=$HateAdded?>" size="5"></td>
                <td width="17%">Bonus Hate:<br/><input type="text" name="bonushate" value="<?=$bonushate?>" size="5"></td>
                <td width="17%">Number of Hits:<br/><input type="text" name="numhits" value="<?=$numhits?>" size="5"></td>
                <td width="16%">NumHits Type:<br/><input type="text" name="numhitstype" value="<?=$numhitstype?>" size="5"></td>
              </tr>
              <tr>
                <td width="17%">PVP Resist Base:<br/><input type="text" name="pvpresistbase" value="<?=$pvpresistbase?>" size="5"></td>
                <td width="17%">PVP Resist Calc:<br/><input type="text" name="pvpresistcalc" value="<?=$pvpresistcalc?>" size="5"></td>
                <td width="16%">PVP Resist Cap:<br/><input type="text" name="pvpresistcap" value="<?=$pvpresistcap?>" size="5"></td>
                <td width="17%">Song Cap:<br/><input type="text" name="songcap" value="<?=$songcap?>" size="5"></td>
                <td width="17%">Min Resist:<br/><input type="text" name="MinResist" value="<?=$MinResist?>" size="5"></td>
                <td width="16%">Max Resist:<br/><input type="text" name="MaxResist" value="<?=$MaxResist?>" size="5"></td>
              </tr>
              <tr>
                <td width="17%">Cone Start Angle:<br/><input type="text" name="ConeStartAngle" value="<?=$ConeStartAngle?>" size="5"></td>
                <td width="17%">Cone Stop Angle:<br/><input type="text" name="ConeStopAngle" value="<?=$ConeStopAngle?>" size="5"></td>
                <td width="16%">Rank:<br/><input type="text" name="rank" value="<?=$rank?>" size="5"></td>
                <td width="17%">Cast Restriction:<br/><input type="text" name="CastRestriction" value="<?=$CastRestriction?>" size="5"></td>
                <td width="17%">Max Targets:<br/><input type="text" name="maxtargets" value="<?=$maxtargets?>" size="5"></td>
                <td width="16%">&nbsp;</td>
              </tr>
            </table>
          </fieldset><br/>
          <fieldset style="text-align:left;">
            <legend><strong><font size="4">Spell Effects</font></strong></legend>
            <table width="100%" border="0" cellpadding="3" cellspacing="0">
              <tr>
                <td>Spell Effect 1:<br/>
                  <select name="effectid1" style="width:150px;">
<?foreach($effects as $k => $v):?>
                    <option value="<?=$k?>"<? echo ($k == $effectid1) ? " selected" : ""?>><?=$k?>: <?=$v?></option>
<?endforeach;?>
                  </select>
                </td>
                <td>Base Value 1:<br/><input type="text" size="4" name="effect_base_value1" value="<?=$effect_base_value1?>"></td>
                <td>Max Value 1:<br/><input type="text" size="4" name="max1" value="<?=$max1?>"></td>
                <td>Limit Value 1:<br/><input type="text" size="4" name="effect_limit_value1" value="<?=$effect_limit_value1?>"></td>
                <td>Formula 1:<br/>
                  <select name="formula1" style="width:175px;">
<?foreach($formulas as $k => $v):?>
                    <option value="<?=$k?>"<? echo ($k == $formula1) ? " selected" : ""?>><?=$k?>: <?=$v?></option>
<?endforeach;?>
                  </select>
                </td>
                <td>Mult(1-99):<br/><input type="text" size="2" name="fmm1" value="<? echo (intval($formula1) > 0 and intval($formula1) < 100) ? "$formula1" : "" ?>"></td>
              </tr>
              <tr>
                <td>Spell Effect 2:<br/>
                  <select name="effectid2" style="width:150px;">
<?foreach($effects as $k => $v):?>
                    <option value="<?=$k?>"<? echo ($k == $effectid2) ? " selected" : ""?>><?=$k?>: <?=$v?></option>
<?endforeach;?>
                  </select>
                </td>
                <td>Base Value 2:<br/><input type="text" size="4" name="effect_base_value2" value="<?=$effect_base_value2?>"></td>
                <td>Max Value 2:<br/><input type="text" size="4" name="max2" value="<?=$max2?>"></td>
                <td>Limit Value 2:<br/><input type="text" size="4" name="effect_limit_value2" value="<?=$effect_limit_value2?>"></td>
                <td>Formula 2:<br/>
                  <select name="formula2" style="width:175px;">
<?foreach($formulas as $k => $v):?>
                    <option value="<?=$k?>"<? echo ($k == $formula2) ? " selected" : ""?>><?=$k?>: <?=$v?></option>
<?endforeach;?>
                  </select>
                </td>
                <td>Mult(1-99):<br/><input type="text" size="2" name="fmm2" value="<? echo (intval($formula2) > 0 and intval($formula2) < 100) ? "$formula2" : "" ?>"></td>
              </tr>
              <tr>
                <td>Spell Effect 3:<br/>
                  <select name="effectid3" style="width:150px;">
<?foreach($effects as $k => $v):?>
                    <option value="<?=$k?>"<? echo ($k == $effectid3) ? " selected" : ""?>><?=$k?>: <?=$v?></option>
<?endforeach;?>
                  </select>
                </td>
                <td>Base Value 3:<br/><input type="text" size="4" name="effect_base_value3" value="<?=$effect_base_value3?>"></td>
                <td>Max Value 3:<br/><input type="text" size="4" name="max3" value="<?=$max3?>"></td>
                <td>Limit Value 3:<br/><input type="text" size="4" name="effect_limit_value3" value="<?=$effect_limit_value3?>"></td>
                <td>Formula 3:<br/>
                  <select name="formula3" style="width:175px;">
<?foreach($formulas as $k => $v):?>
                    <option value="<?=$k?>"<? echo ($k == $formula3) ? " selected" : ""?>><?=$k?>: <?=$v?></option>
<?endforeach;?>
                  </select>
                </td>
                <td>Mult(1-99):<br/><input type="text" size="2" name="fmm3" value="<? echo (intval($formula3) > 0 and intval($formula3) < 100) ? "$formula3" : "" ?>"></td>
              </tr>
              <tr>
                <td>Spell Effect 4:<br/>
                  <select name="effectid4" style="width:150px;">
<?foreach($effects as $k => $v):?>
                    <option value="<?=$k?>"<? echo ($k == $effectid4) ? " selected" : ""?>><?=$k?>: <?=$v?></option>
<?endforeach;?>
                  </select>
                </td>
                <td>Base Value 4:<br/><input type="text" size="4" name="effect_base_value4" value="<?=$effect_base_value4?>"></td>
                <td>Max Value 4:<br/><input type="text" size="4" name="max4" value="<?=$max4?>"></td>
                <td>Limit Value 4:<br/><input type="text" size="4" name="effect_limit_value4" value="<?=$effect_limit_value4?>"></td>
                <td>Formula 4:<br/>
                  <select name="formula4" style="width:175px;">
<?foreach($formulas as $k => $v):?>
                    <option value="<?=$k?>"<? echo ($k == $formula4) ? " selected" : ""?>><?=$k?>: <?=$v?></option>
<?endforeach;?>
                  </select>
                </td>
                <td>Mult(1-99):<br/><input type="text" size="2" name="fmm4" value="<? echo (intval($formula4) > 0 and intval($formula4) < 100) ? "$formula4" : "" ?>"></td>
              </tr>
              <tr>
                <td>Spell Effect 5:<br/>
                  <select name="effectid5" style="width:150px;">
<?foreach($effects as $k => $v):?>
                    <option value="<?=$k?>"<? echo ($k == $effectid5) ? " selected" : ""?>><?=$k?>: <?=$v?></option>
<?endforeach;?>
                  </select>
                </td>
                <td>Base Value 5:<br/><input type="text" size="4" name="effect_base_value5" value="<?=$effect_base_value5?>"></td>
                <td>Max Value 5:<br/><input type="text" size="4" name="max5" value="<?=$max5?>"></td>
                <td>Limit Value 5:<br/><input type="text" size="4" name="effect_limit_value5" value="<?=$effect_limit_value5?>"></td>
                <td>Formula 5:<br/>
                  <select name="formula5" style="width:175px;">
<?foreach($formulas as $k => $v):?>
                    <option value="<?=$k?>"<? echo ($k == $formula5) ? " selected" : ""?>><?=$k?>: <?=$v?></option>
<?endforeach;?>
                  </select>
                </td>
                <td>Mult(1-99):<br/><input type="text" size="2" name="fmm5" value="<? echo (intval($formula5) > 0 and intval($formula5) < 100) ? "$formula5" : "" ?>"></td>
              </tr>
              <tr>
                <td>Spell Effect 6:<br/>
                  <select name="effectid6" style="width:150px;">
<?foreach($effects as $k => $v):?>
                    <option value="<?=$k?>"<? echo ($k == $effectid6) ? " selected" : ""?>><?=$k?>: <?=$v?></option>
<?endforeach;?>
                  </select>
                </td>
                <td>Base Value 6:<br/><input type="text" size="4" name="effect_base_value6" value="<?=$effect_base_value6?>"></td>
                <td>Max Value 6:<br/><input type="text" size="4" name="max6" value="<?=$max6?>"></td>
                <td>Limit Value 6:<br/><input type="text" size="4" name="effect_limit_value6" value="<?=$effect_limit_value6?>"></td>
                <td>Formula 6:<br/>
                  <select name="formula6" style="width:175px;">
<?foreach($formulas as $k => $v):?>
                    <option value="<?=$k?>"<? echo ($k == $formula6) ? " selected" : ""?>><?=$k?>: <?=$v?></option>
<?endforeach;?>
                  </select>
                </td>
                <td>Mult(1-99):<br/><input type="text" size="2" name="fmm6" value="<? echo (intval($formula6) > 0 and intval($formula6) < 100) ? "$formula6" : "" ?>"></td>
              </tr>
              <tr>
                <td>Spell Effect 7:<br/>
                  <select name="effectid7" style="width:150px;">
<?foreach($effects as $k => $v):?>
                    <option value="<?=$k?>"<? echo ($k == $effectid7) ? " selected" : ""?>><?=$k?>: <?=$v?></option>
<?endforeach;?>
                  </select>
                </td>
                <td>Base Value 7:<br/><input type="text" size="4" name="effect_base_value7" value="<?=$effect_base_value7?>"></td>
                <td>Max Value 7:<br/><input type="text" size="4" name="max7" value="<?=$max7?>"></td>
                <td>Limit Value 7:<br/><input type="text" size="4" name="effect_limit_value7" value="<?=$effect_limit_value7?>"></td>
                <td>Formula 7:<br/>
                  <select name="formula7" style="width:175px;">
<?foreach($formulas as $k => $v):?>
                    <option value="<?=$k?>"<? echo ($k == $formula7) ? " selected" : ""?>><?=$k?>: <?=$v?></option>
<?endforeach;?>
                  </select>
                </td>
                <td>Mult(1-99):<br/><input type="text" size="2" name="fmm7" value="<? echo (intval($formula7) > 0 and intval($formula7) < 100) ? "$formula7" : "" ?>"></td>
              </tr>
              <tr>
                <td>Spell Effect 8:<br/>
                  <select name="effectid8" style="width:150px;">
<?foreach($effects as $k => $v):?>
                    <option value="<?=$k?>"<? echo ($k == $effectid8) ? " selected" : ""?>><?=$k?>: <?=$v?></option>
<?endforeach;?>
                  </select>
                </td>
                <td>Base Value 8:<br/><input type="text" size="4" name="effect_base_value8" value="<?=$effect_base_value8?>"></td>
                <td>Max Value 8:<br/><input type="text" size="4" name="max8" value="<?=$max8?>"></td>
                <td>Limit Value 8:<br/><input type="text" size="4" name="effect_limit_value8" value="<?=$effect_limit_value8?>"></td>
                <td>Formula 8:<br/>
                  <select name="formula8" style="width:175px;">
<?foreach($formulas as $k => $v):?>
                    <option value="<?=$k?>"<? echo ($k == $formula8) ? " selected" : ""?>><?=$k?>: <?=$v?></option>
<?endforeach;?>
                  </select>
                </td>
                <td>Mult(1-99):<br/><input type="text" size="2" name="fmm8" value="<? echo (intval($formula8) > 0 and intval($formula8) < 100) ? "$formula8" : "" ?>"></td>
              </tr>
              <tr>
                <td>Spell Effect 9:<br/>
                  <select name="effectid9" style="width:150px;">
<?foreach($effects as $k => $v):?>
                    <option value="<?=$k?>"<? echo ($k == $effectid9) ? " selected" : ""?>><?=$k?>: <?=$v?></option>
<?endforeach;?>
                  </select>
                </td>
                <td>Base Value 9:<br/><input type="text" size="4" name="effect_base_value9" value="<?=$effect_base_value9?>"></td>
                <td>Max Value 9:<br/><input type="text" size="4" name="max9" value="<?=$max9?>"></td>
                <td>Limit Value 9:<br/><input type="text" size="4" name="effect_limit_value9" value="<?=$effect_limit_value9?>"></td>
                <td>Formula 9:<br/>
                  <select name="formula9" style="width:175px;">
<?foreach($formulas as $k => $v):?>
                    <option value="<?=$k?>"<? echo ($k == $formula9) ? " selected" : ""?>><?=$k?>: <?=$v?></option>
<?endforeach;?>
                  </select>
                </td>
                <td>Mult(1-99):<br/><input type="text" size="2" name="fmm9" value="<? echo (intval($formula9) > 0 and intval($formula9) < 100) ? "$formula9" : "" ?>"></td>
              </tr>
              <tr>
                <td>Spell Effect 10:<br/>
                  <select name="effectid10" style="width:150px;">
<?foreach($effects as $k => $v):?>
                    <option value="<?=$k?>"<? echo ($k == $effectid10) ? " selected" : ""?>><?=$k?>: <?=$v?></option>
<?endforeach;?>
                  </select>
                </td>
                <td>Base Value 10:<br/><input type="text" size="4" name="effect_base_value10" value="<?=$effect_base_value10?>"></td>
                <td>Max Value 10:<br/><input type="text" size="4" name="max10" value="<?=$max10?>"></td>
                <td>Limit Value 10:<br/><input type="text" size="4" name="effect_limit_value10" value="<?=$effect_limit_value10?>"></td>
                <td>Formula 10:<br/>
                  <select name="formula10" style="width:175px;">
<?foreach($formulas as $k => $v):?>
                    <option value="<?=$k?>"<? echo ($k == $formula10) ? " selected" : ""?>><?=$k?>: <?=$v?></option>
<?endforeach;?>
                  </select>
                </td>
                <td>Mult(1-99):<br/><input type="text" size="2" name="fmm10" value="<? echo (intval($formula10) > 0 and intval($formula10) < 100) ? "$formula10" : "" ?>"></td>
              </tr>
              <tr>
                <td>Spell Effect 11:<br/>
                  <select name="effectid11" style="width:150px;">
<?foreach($effects as $k => $v):?>
                    <option value="<?=$k?>"<? echo ($k == $effectid11) ? " selected" : ""?>><?=$k?>: <?=$v?></option>
<?endforeach;?>
                  </select>
                </td>
                <td>Base Value 11:<br/><input type="text" size="4" name="effect_base_value11" value="<?=$effect_base_value11?>"></td>
                <td>Max Value 11:<br/><input type="text" size="4" name="max11" value="<?=$max11?>"></td>
                <td>Limit Value 11:<br/><input type="text" size="4" name="effect_limit_value11" value="<?=$effect_limit_value11?>"></td>
                <td>Formula 11:<br/>
                  <select name="formula11" style="width:175px;">
<?foreach($formulas as $k => $v):?>
                    <option value="<?=$k?>"<? echo ($k == $formula11) ? " selected" : ""?>><?=$k?>: <?=$v?></option>
<?endforeach;?>
                  </select>
                </td>
                <td>Mult(1-99):<br/><input type="text" size="2" name="fmm11" value="<? echo (intval($formula11) > 0 and intval($formula11) < 100) ? "$formula11" : "" ?>"></td>
              </tr>
              <tr>
                <td>Spell Effect 12:<br/>
                  <select name="effectid12" style="width:150px;">
<?foreach($effects as $k => $v):?>
                    <option value="<?=$k?>"<? echo ($k == $effectid12) ? " selected" : ""?>><?=$k?>: <?=$v?></option>
<?endforeach;?>
                  </select>
                </td>
                <td>Base Value 12:<br/><input type="text" size="4" name="effect_base_value12" value="<?=$effect_base_value12?>"></td>
                <td>Max Value 12:<br/><input type="text" size="4" name="max12" value="<?=$max12?>"></td>
                <td>Limit Value 12:<br/><input type="text" size="4" name="effect_limit_value12" value="<?=$effect_limit_value12?>"></td>
                <td>Formula 12:<br/>
                  <select name="formula12" style="width:175px;">
<?foreach($formulas as $k => $v):?>
                    <option value="<?=$k?>"<? echo ($k == $formula12) ? " selected" : ""?>><?=$k?>: <?=$v?></option>
<?endforeach;?>
                  </select>
                </td>
                <td>Mult(1-99):<br/><input type="text" size="2" name="fmm12" value="<? echo (intval($formula12) > 0 and intval($formula12) < 100) ? "$formula12" : "" ?>"></td>
              </tr>
            </table>
          </fieldset><br/>
          <fieldset style="text-align:left;">
            <legend><strong><font size="4">Reagents</font></strong></legend>
            <table width="100%" border="0" cellpadding="3" cellspacing="0">
              <tr>
                <td>Components 1:<br/><input type="text" name="components1" value="<?=$components1?>"></td>
                <td>Component Count 1:<br/><input type="text" name="component_counts1" value="<?=$component_counts1?>"></td>
                <td>No Expend Reagent 1:<br/><input type="text" name="NoexpendReagent1" value="<?=$NoexpendReagent1?>"></td>
              </tr>
              <tr>
                <td>Components 2:<br/><input type="text" name="components2" value="<?=$components2?>"></td>
                <td>Component Count 2:<br/><input type="text" name="component_counts2" value="<?=$component_counts2?>"></td>
                <td>No Expend Reagent 2:<br/><input type="text" name="NoexpendReagent2" value="<?=$NoexpendReagent2?>"></td>
              </tr>
              <tr>
                <td>Components 3:<br/><input type="text" name="components3" value="<?=$components3?>"></td>
                <td>Component Count 3:<br/><input type="text" name="component_counts3" value="<?=$component_counts3?>"></td>
                <td>No Expend Reagent 3:<br/><input type="text" name="NoexpendReagent3" value="<?=$NoexpendReagent3?>"></td>
              </tr>
              <tr>
                <td>Components 4:<br/><input type="text" name="components4" value="<?=$components4?>"></td>
                <td>Component Count 4:<br/><input type="text" name="component_counts4" value="<?=$component_counts4?>"></td>
                <td>No Expend Reagent 4:<br/><input type="text" name="NoexpendReagent4" value="<?=$NoexpendReagent4?>"></td>
              </tr>
            </table>
          </fieldset><br/>
          <fieldset style="text-align:left;">
            <legend><strong><font size="4">Class Levels</font></strong></legend>
            <table width="100%" border="0" cellpadding="3" cellspacing="0">
              <tr>
                <td>Warrior:<br/><input type="text" name="classes1" size="3" value="<?=$classes1?>"></td>
                <td>Cleric:<br/><input type="text" name="classes2" size="3" value="<?=$classes2?>"></td>
                <td>Paladin:<br/><input type="text" name="classes3" size="3" value="<?=$classes3?>"></td>
                <td>Ranger:<br/><input type="text" name="classes4" size="3" value="<?=$classes4?>"></td>
                <td>Shadowknight:<br/><input type="text" name="classes5" size="3" value="<?=$classes5?>"></td>
                <td>Druid:<br/><input type="text" name="classes6" size="3" value="<?=$classes6?>"></td>
                <td>Monk:<br/><input type="text" name="classes7" size="3" value="<?=$classes7?>"></td>
                <td>Bard:<br/><input type="text" name="classes8" size="3" value="<?=$classes8?>"></td>
              </tr>
              <tr>
                <td>Rogue:<br/><input type="text" name="classes9" size="3" value="<?=$classes9?>"></td>
                <td>Shaman:<br/><input type="text" name="classes10" size="3" value="<?=$classes10?>"></td>
                <td>Necromancer:<br/><input type="text" name="classes11" size="3" value="<?=$classes11?>"></td>
                <td>Wizard:<br/><input type="text" name="classes12" size="3" value="<?=$classes12?>"></td>
                <td>Magician:<br/><input type="text" name="classes13" size="3" value="<?=$classes13?>"></td>
                <td>Enchanter:<br/><input type="text" name="classes14" size="3" value="<?=$classes14?>"></td>
                <td>Beastlord:<br/><input type="text" name="classes15" size="3" value="<?=$classes15?>"></td>
                <td>Berserker:<br/><input type="text" name="classes16" size="3" value="<?=$classes16?>"></td>
              </tr>
            </table>
          </fieldset><br/>
          <fieldset style="text-align:left;">
            <legend><strong><font size="4">Deities</font></strong></legend>
            <table width="100%" border="0" cellpadding="3" cellspacing="0">
              <tr>
                <td width="20%">
                  <input type="checkbox" name="deities0" <? echo $deities0 ? "checked" : "" ?>> Agnostic<br/>
                  <input type="checkbox" name="deities1" <? echo $deities1 ? "checked" : "" ?>> Bertoxxulous<br/>
                  <input type="checkbox" name="deities2" <? echo $deities2 ? "checked" : "" ?>> Brell Serilis<br/>
                  <input type="checkbox" name="deities5" <? echo $deities5 ? "checked" : "" ?>> Bristlebane<br/>
                </td>
                <td width="20%">
                  <input type="checkbox" name="deities3" <? echo $deities3 ? "checked" : "" ?>> Cazic Thule<br/>
                  <input type="checkbox" name="deities4" <? echo $deities4 ? "checked" : "" ?>> Erollisi Marr<br/>
                  <input type="checkbox" name="deities6" <? echo $deities6 ? "checked" : "" ?>> Innoruuk<br/>
                  <input type="checkbox" name="deities7" <? echo $deities7 ? "checked" : "" ?>> Karana<br/>
                </td>
                <td width="20%">
                  <input type="checkbox" name="deities8" <? echo $deities8 ? "checked" : "" ?>> Mithaniel Marr<br/>
                  <input type="checkbox" name="deities9" <? echo $deities9 ? "checked" : "" ?>> Prexus<br/>
                  <input type="checkbox" name="deities10" <? echo $deities10 ? "checked" : "" ?>> Quellious<br/>
                  <input type="checkbox" name="deities11" <? echo $deities11 ? "checked" : "" ?>> Rallos Zek<br/>
                </td>
                <td width="20%">
                  <input type="checkbox" name="deities12" <? echo $deities12 ? "checked" : "" ?>> Rodcet Nife<br/>
                  <input type="checkbox" name="deities13" <? echo $deities13 ? "checked" : "" ?>> Solusek Ro<br/>
                  <input type="checkbox" name="deities14" <? echo $deities14 ? "checked" : "" ?>> The Tribunal<br/>
                  <input type="checkbox" name="deities15" <? echo $deities15 ? "checked" : "" ?>> Tunare<br/>
                </td>
                <td width="20%"><input type="checkbox" name="deities16" <? echo $deities16 ? "checked" : "" ?>> Veeshan</td>
              </tr>
            </table>
          </fieldset><br/>
          <center>
            <input type="submit" value="Submit Changes">
          </center>
        </center>
      </div>
    </div>
  </form>
