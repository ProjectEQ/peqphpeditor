  <div class="table_container">
    <div class="table_header">
      <?=$base['id']?> - <?=$base['name']?>
      <div style="float:right;">
        <a href="index.php?editor=aa&action=3"><img src="images/add.gif" border="0" title="Create a new AA"></a>
        <a href="index.php?editor=aa&aaid=<?=$base['id']?>&action=18" onclick="return confirm('Really delete <?=addslashes($base['name'])?>?');"><img src="images/remove.gif" border="0" title="Delete this AA"></a>
      </div>
    </div>
    <div class="table_content">
      <table cellspacing="0" border="0" width="100%">
        <tr>
          <td width="100%">
            <table cellspacing="0" border="0" width="100%">
              <tr>
                <td>
                  <fieldset>
                    <legend><strong><font size="4">Base AA Info</font></strong></legend>
                    <input name="id" type="hidden" value="$base['id']">
<?
if ($base) {
?>
                    <table cellpadding="0" cellspacing="0" width="100%">
                      <tr>
                        <td>
                          <b>ID:</b><br/>
                          <input type="text" size="5" value="<?=$base['id']?>" disabled>
                        </td>
                        <td colspan="4">
                          <b>Name:</b><br/>
                          <input name="name" type="text" size="50" value="<?=$base['name']?>">
                        </td>
                        <td colspan="2">
                          <b>Category:</b><br/>
                          <select name="category">
<?
  foreach ($aa_category as $k => $v) {
?>
                            <option value="<?=$k?>"<?echo ($base['category'] == $k) ? ' selected' : '';?>><?=$v?></option>
<?
  }
?>
                          </select> 
                        </td>
                        <td colspan="2">
                          <b>Type:</b><br/>
                          <select name="type">
<?
  foreach ($aa_type as $k => $v) {
?>
                            <option value="<?=$k?>"<?echo ($base['type'] == $k) ? ' selected' : '';?>><?=$v?></option>
<?
  }
?>
                          </select>
                        </td>
                      </tr>
                      <tr>
                        <td colspan="9">
                          <br/>
                          <fieldset style="text-align:left;">
                            <legend><strong><font size="2">Classes</font></strong></legend>
                            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                              <tr>
                                <td><input type="checkbox" id="classes1" name="classes[]" onChange="box_changed('classes[]', 'all_classes');"<?echo ($base['classes'] &   1) ? " checked" : "";?>>Warrior</td>
                                <td><input type="checkbox" id="classes2" name="classes[]" onChange="box_changed('classes[]', 'all_classes');"<?echo ($base['classes'] &   2) ? " checked" : "";?>>Cleric</td>
                                <td><input type="checkbox" id="classes3" name="classes[]" onChange="box_changed('classes[]', 'all_classes');"<?echo ($base['classes'] &   4) ? " checked" : "";?>>Paladin</td>
                                <td><input type="checkbox" id="classes4" name="classes[]" onChange="box_changed('classes[]', 'all_classes');"<?echo ($base['classes'] &   8) ? " checked" : "";?>>Ranger</td>
                                <td><input type="checkbox" id="classes5" name="classes[]" onChange="box_changed('classes[]', 'all_classes');"<?echo ($base['classes'] &  16) ? " checked" : "";?>>Shadowknight</td>
                                <td><input type="checkbox" id="classes6" name="classes[]" onChange="box_changed('classes[]', 'all_classes');"<?echo ($base['classes'] &  32) ? " checked" : "";?>>Druid</td>
                                <td><input type="checkbox" id="classes7" name="classes[]" onChange="box_changed('classes[]', 'all_classes');"<?echo ($base['classes'] &  64) ? " checked" : "";?>>Monk</td>
                                <td><input type="checkbox" id="classes8" name="classes[]" onChange="box_changed('classes[]', 'all_classes');"<?echo ($base['classes'] & 128) ? " checked" : "";?>>Bard</td>
                              </tr>
                              <tr>
                                <td><input type="checkbox" id="classes9" name="classes[]" onChange="box_changed('classes[]', 'all_classes');"<?echo  ($base['classes'] &   256) ? " checked" : "";?>>Rogue</td>
                                <td><input type="checkbox" id="classes10" name="classes[]" onChange="box_changed('classes[]', 'all_classes');"<?echo ($base['classes'] &   512) ? " checked" : "";?>>Shaman</td>
                                <td><input type="checkbox" id="classes11" name="classes[]" onChange="box_changed('classes[]', 'all_classes');"<?echo ($base['classes'] &  1024) ? " checked" : "";?>>Necromancer</td>
                                <td><input type="checkbox" id="classes12" name="classes[]" onChange="box_changed('classes[]', 'all_classes');"<?echo ($base['classes'] &  2048) ? " checked" : "";?>>Wizard</td>
                                <td><input type="checkbox" id="classes13" name="classes[]" onChange="box_changed('classes[]', 'all_classes');"<?echo ($base['classes'] &  4096) ? " checked" : "";?>>Magician</td>
                                <td><input type="checkbox" id="classes14" name="classes[]" onChange="box_changed('classes[]', 'all_classes');"<?echo ($base['classes'] &  8192) ? " checked" : "";?>>Enchanter</td>
                                <td><input type="checkbox" id="classes15" name="classes[]" onChange="box_changed('classes[]', 'all_classes');"<?echo ($base['classes'] & 16384) ? " checked" : "";?>>Beastlord</td>
                                <td><input type="checkbox" id="classes16" name="classes[]" onChange="box_changed('classes[]', 'all_classes');"<?echo ($base['classes'] & 32767) ? " checked" : "";?>>Berserker</td>
                              </tr>
                              <tr>
                                <td colspan="8" align="center"><br/><input type="checkbox" id="all_classes" onChange="all_box_changed('classes[]', 'all_classes');"<?echo ($base['classes'] == 65535) ? " checked" : "";?>>All Classes</td>
                              </tr>
                            </table>
                          </fieldset><br/>
                        </td>
                      </tr>
                      <tr>
                        <td colspan="9">
                          <fieldset style="text-align:left;">
                            <legend><strong><font size="2">Races</font></strong></legend>
                            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                              <tr>
                                <td><input type="checkbox" id="races1" name="races[]" onChange="box_changed('races[]', 'all_races');"<?echo ($base['races'] &   1) ? " checked" : "";?>>Human</td>
                                <td><input type="checkbox" id="races2" name="races[]" onChange="box_changed('races[]', 'all_races');"<?echo ($base['races'] &   2) ? " checked" : "";?>>Barbarian</td>
                                <td><input type="checkbox" id="races3" name="races[]" onChange="box_changed('races[]', 'all_races');"<?echo ($base['races'] &   4) ? " checked" : "";?>>Erudite</td>
                                <td><input type="checkbox" id="races4" name="races[]" onChange="box_changed('races[]', 'all_races');"<?echo ($base['races'] &   8) ? " checked" : "";?>>Wood Elf</td>
                                <td><input type="checkbox" id="races5" name="races[]" onChange="box_changed('races[]', 'all_races');"<?echo ($base['races'] &  16) ? " checked" : "";?>>High Elf</td>
                                <td><input type="checkbox" id="races6" name="races[]" onChange="box_changed('races[]', 'all_races');"<?echo ($base['races'] &  32) ? " checked" : "";?>>Dark Elf</td>
                                <td><input type="checkbox" id="races7" name="races[]" onChange="box_changed('races[]', 'all_races');"<?echo ($base['races'] &  64) ? " checked" : "";?>>Half Elf</td>
                                <td><input type="checkbox" id="races8" name="races[]" onChange="box_changed('races[]', 'all_races');"<?echo ($base['races'] & 128) ? " checked" : "";?>>Dwarf</td>
                              </tr>
                              <tr>
                                <td><input type="checkbox" id="races9" name="races[]" onChange="box_changed('races[]', 'all_races');"<?echo  ($base['races'] &   256) ? " checked" : "";?>>Troll</td>
                                <td><input type="checkbox" id="races10" name="races[]" onChange="box_changed('races[]', 'all_races');"<?echo ($base['races'] &   512) ? " checked" : "";?>>Ogre</td>
                                <td><input type="checkbox" id="races11" name="races[]" onChange="box_changed('races[]', 'all_races');"<?echo ($base['races'] &  1024) ? " checked" : "";?>>Halfling</td>
                                <td><input type="checkbox" id="races12" name="races[]" onChange="box_changed('races[]', 'all_races');"<?echo ($base['races'] &  2048) ? " checked" : "";?>>Gnome</td>
                                <td><input type="checkbox" id="races13" name="races[]" onChange="box_changed('races[]', 'all_races');"<?echo ($base['races'] &  4096) ? " checked" : "";?>>Froglok</td>
                                <td><input type="checkbox" id="races14" name="races[]" onChange="box_changed('races[]', 'all_races');"<?echo ($base['races'] &  8192) ? " checked" : "";?>>Iksar</td>
                                <td><input type="checkbox" id="races15" name="races[]" onChange="box_changed('races[]', 'all_races');"<?echo ($base['races'] & 16384) ? " checked" : "";?>>Vah Shir</td>
                                <td><input type="checkbox" id="races16" name="races[]" onChange="box_changed('races[]', 'all_races');"<?echo ($base['races'] & 32767) ? " checked" : "";?>>Drakkin</td>
                              </tr>
                              <tr>
                                <td colspan="8" align="center"><br/><input type="checkbox" id="all_races" onChange="all_box_changed('races[]', 'all_races');"<?echo ($base['races'] == 65535) ? " checked" : "";?>>All Races</td>
                              </tr>
                            </table>
                          </fieldset><br/>
                        </td>
                      </tr>
                      <tr>
                        <td colspan="9">
                          <fieldset style="text-align:left;">
                            <legend><strong><font size="2">Deities</font></strong></legend>
                            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                              <tr>
                                <td width="20%">
                                  <input type="checkbox" id="deities17" name="deities[]" onChange="box_changed('deities[]', 'all_deities');"<?echo ($base['deities'] & 65535) ? " checked" : "";?>> Agnostic<br/>
                                  <input type="checkbox" id="deities1" name="deities[]" onChange="box_changed('deities[]', 'all_deities');"<?echo  ($base['deities'] &     1) ? " checked" : "";?>> Bertoxxulous<br/>
                                  <input type="checkbox" id="deities2" name="deities[]" onChange="box_changed('deities[]', 'all_deities');"<?echo  ($base['deities'] &     2) ? " checked" : "";?>> Brell Serilis<br/>
                                  <input type="checkbox" id="deities5" name="deities[]" onChange="box_changed('deities[]', 'all_deities');"<?echo  ($base['deities'] &    16) ? " checked" : "";?>> Bristlebane<br/>
                                </td>
                                <td width="20%">
                                  <input type="checkbox" id="deities3" name="deities[]" onChange="box_changed('deities[]', 'all_deities');"<?echo ($base['deities'] &  4) ? " checked" : "";?>> Cazic Thule<br/>
                                  <input type="checkbox" id="deities4" name="deities[]" onChange="box_changed('deities[]', 'all_deities');"<?echo ($base['deities'] &  8) ? " checked" : "";?>> Erollisi Marr<br/>
                                  <input type="checkbox" id="deities6" name="deities[]" onChange="box_changed('deities[]', 'all_deities');"<?echo ($base['deities'] & 32) ? " checked" : "";?>> Innoruuk<br/>
                                  <input type="checkbox" id="deities7" name="deities[]" onChange="box_changed('deities[]', 'all_deities');"<?echo ($base['deities'] & 64) ? " checked" : "";?>> Karana<br/>
                                </td>
                                <td width="20%">
                                  <input type="checkbox" id="deities8" name="deities[]" onChange="box_changed('deities[]', 'all_deities');"<?echo  ($base['deities'] &  128) ? " checked" : "";?>> Mithaniel Marr<br/>
                                  <input type="checkbox" id="deities9" name="deities[]" onChange="box_changed('deities[]', 'all_deities');"<?echo  ($base['deities'] &  256) ? " checked" : "";?>> Prexus<br/>
                                  <input type="checkbox" id="deities10" name="deities[]" onChange="box_changed('deities[]', 'all_deities');"<?echo ($base['deities'] &  512) ? " checked" : "";?>> Quellious<br/>
                                  <input type="checkbox" id="deities11" name="deities[]" onChange="box_changed('deities[]', 'all_deities');"<?echo ($base['deities'] & 1024) ? " checked" : "";?>> Rallos Zek<br/>
                                </td>
                                <td width="20%">
                                  <input type="checkbox" id="deities12" name="deities[]" onChange="box_changed('deities[]', 'all_deities');"<?echo ($base['deities'] &  2048) ? " checked" : "";?>> Rodcet Nife<br/>
                                  <input type="checkbox" id="deities13" name="deities[]" onChange="box_changed('deities[]', 'all_deities');"<?echo ($base['deities'] &  4096) ? " checked" : "";?>> Solusek Ro<br/>
                                  <input type="checkbox" id="deities14" name="deities[]" onChange="box_changed('deities[]', 'all_deities');"<?echo ($base['deities'] &  8192) ? " checked" : "";?>> The Tribunal<br/>
                                  <input type="checkbox" id="deities15" name="deities[]" onChange="box_changed('deities[]', 'all_deities');"<?echo ($base['deities'] & 16384) ? " checked" : "";?>> Tunare<br/>
                                </td>
                                <td width="20%"><input type="checkbox" id="deities16" name="deities[]" onChange="box_changed('deities[]', 'all_deities');"<?echo ($base['deities'] & 32767) ? " checked" : "";?>> Veeshan</td>
                              </tr>
                              <tr>
                                <td colspan="5" align="center"><br/><input type="checkbox" id="all_deities" onChange="all_box_changed('deities[]', 'all_deities');"<?echo ($base['deities'] & 131071) ? " checked" : "";?>>All Deities</td>
                              </tr>
                            </table>
                          </fieldset><br/>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <b>Enabled:</b><br/>
                          <select name="enabled">
                            <option value="0"<?echo ($base['enabled'] == 0) ? " selected" : "";?>>No</option>
                            <option value="1"<?echo ($base['enabled'] == 1) ? " selected" : "";?>>Yes</option>
                          </select>
                        </td>
                        <td colspan="2">
                          <b>First Rank:</b><br/>
                          <select name="first_rank_id">
                            <option value="0">None</option>
<?
  foreach ($all_ranks as $rank) {
?>
                            <option value="<?=$rank['id']?>"<?echo ($base['first_rank_id'] == $rank['id']) ? " selected" : "";?>><?=$rank['id']?></option>
<?
  }
?>
                          </select>
                        </td>
                        <td>
                          <b>Grant Only:</b><br/>
                          <select name="grant_only">
                            <option value="0"<?echo ($base['grant_only'] == 0) ? " selected" : "";?>>No</option>
                            <option value="1"<?echo ($base['grant_only'] == 1) ? " selected" : "";?>>Yes</option>
                          </select>
                        </td>
                        <td>
                          <b>Status:</b><br/>
                          <input name="status" type="text" size="3" value="<?=$base['status']?>">
                        </td>
                        <td>
                          <b>Charges:</b><br/>
                          <input name="charges" type="text" size="3" value="<?=$base['charges']?>">
                        </td>
                        <td>&nbsp;</td>
                        <td>
                          <b>Drakkin Heritage:</b><br/>
                          <input name="drakkin_heritage" type="text" size="3" value="<?=$base['drakkin_heritage']?>">
                        </td>
                      </tr>
                    </table>
                    <center>
                      <br/>
                      <input type="button" value="Update Ability" style="width: 150px;" onClick="javascript:alert('Edit functionality not enabled yet.');">&nbsp;&nbsp;
                      <input type="button" value="Delete Ability" style="width: 150px;" onClick="javascript:alert('Edit functionality not enabled yet.');">&nbsp;&nbsp;
                      <input type="button" value="Reset Values" style="width: 150px;" onClick="window.location.reload();">
                    </center>
<?
}
else {
?>
                    No base information
<?
}
?>
                  </fieldset>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </div>
    <div class="table_content">
      <table cellspacing="0" border="0" width="100%">
        <tr>
          <td width="100%">
            <table cellspacing="0" border="0" width="100%">
              <tr>
                <td>
                  <fieldset>
                    <legend><strong><font size="4">AA Ranks Info</font></strong></legend>
<?
if ($ranks) {
  $count = 1;
  foreach ($ranks as $rank) {
?>
                    <fieldset>
                      <legend><strong><font size="2">Rank <?=$count?></font></strong></legend>
                      <input name="rank<?=$count?>_id" type="hidden" value="<?=$rank['id']?>">
                      <table cellspacing="0" cellpadding="0" width="100%">
                        <tr>
                          <td>
                            <b>Rank ID:</b><br/>
                            <input type="text" size="8" value="<?=$rank['id']?>" disabled>
                          </td>
                          <td>
                            <b>Upper Hotkey SID:</b><br/>
                            <input name="rank<?=$count?>_upper_hotkey_sid" type="text" size="8" value="<?=$rank['upper_hotkey_sid']?>">
                          </td>
                          <td>
                            <b>Lower Hotkey SID:</b><br/>
                            <input name="rank<?=$count?>_lower_hotkey_sid" type="text" size="8" value="<?=$rank['lower_hotkey_sid']?>">
                          </td>
                          <td>
                            <b>Title SID:</b><br/>
                            <input name="rank<?=$count?>_title_sid" type="text" size="8" value="<?=$rank['title_sid']?>">
                          </td>
                          <td>
                            <b>Desc SID:</b><br/>
                            <input name="rank<?=$count?>_desc_sid" type="text" size="8" value="<?=$rank['desc_sid']?>">
                          </td>
                        </tr>
                        <tr><td colspan="5">&nbsp;</td></tr>
                        <tr>
                          <td>
                            <b>Cost:</b><br/>
                            <input name="rank<?=$count?>_" type="text" size="8" value="<?=$rank['cost']?>">
                          </td>
                          <td>
                            <b>Level Required:</b><br/>
                            <input name="rank<?=$count?>_" type="text" size="8" value="<?=$rank['level_req']?>">
                          </td>
                          <td>
                            <b>Spell:</b><br/>
                            <input name="rank<?=$count?>_" type="text" size="8" value="<?=$rank['spell']?>">
                          </td>
                          <td>
                            <b>Spell Type:</b><br/>
                            <input name="rank<?=$count?>_" type="text" size="8" value="<?=$rank['spell_type']?>">
                          </td>
                          <td>
                            <b>Recast Time:</b><br/>
                            <input name="rank<?=$count?>_" type="text" size="8" value="<?=$rank['recast_time']?>">
                          </td>
                        </tr>
                        <tr><td colspan="5">&nbsp;</td></tr>
                        <tr>
                          <td colspan="2">
                            <b>Expansion:</b><br/>
                            <select name="rank<?=$count?>_">
<?
  foreach ($eqexpansions as $k => $v) {
?>
                              <option value="<?=$k?>"<?echo ($rank['expansion'] + 1 == $k) ? " selected" : "";?>><?=$v?></option>
<?
  }
?>
                          </td>
                          <td>
                            <b>Previous ID:</b><br/>
                            <input name="rank<?=$count?>_" type="text" size="8" value="<?=$rank['prev_id'];?>">
                          </td>
                          <td>
                            <b>Next ID:</b><br/>
                            <input name="rank<?=$count?>_" type="text" size="8" value="<?=$rank['next_id'];?>">
                          </td>
                        </tr>
                      </table>
                    <center>
                      <br/>
                      <input type="button" value="Update Rank" style="width: 150px;" onClick="javascript:alert('Edit functionality not enabled yet.');">&nbsp;&nbsp;
                      <input type="button" value="Delete Rank" style="width: 150px;" onClick="javascript:alert('Edit functionality not enabled yet.');">&nbsp;&nbsp;
                      <input type="button" value="Reset Values" style="width: 150px;" onClick="window.location.reload();">
                    </center>
                    </fieldset><br/>
<?
    $count++;
  }
?>
<?
}
else {
?>
                      No ranks
<?
}
?>
                    <center>
                      <input type="button" value="New Rank" style="width: 150px;" onClick="javascript:alert('Edit functionality not enabled yet.');">&nbsp;&nbsp;
                    </center>
                  </fieldset>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </div>
    <div class="table_content">
      <table cellspacing="0" border="0" width="100%">
        <tr>
          <td width="100%">
            <table cellspacing="0" border="0" width="100%">
              <tr>
                <td>
                  <fieldset>
                    <legend><strong><font size="4">AA Effects Info</font></strong></legend>
<?
if ($effects) {
  $count = 1;
  foreach ($effects as $effect) {
?>
                    <fieldset>
                      <legend><b>Effect <?=$count?></b></legend>
<?
    foreach ($effect as $effect_detail) {
?>
                      <fieldset>
                        <legend><b>Slot <?=$effect_detail['slot']?></b></legend>
                        <b>Rank ID:</b> <?=$effect_detail['rank_id']?><br/>
                        <b>Slot:</b> <?=$effect_detail['slot']?><br/>
                        <b>Effect ID:</b> <?=$effect_detail['effect_id']?><br/>
                        <b>Effect:</b> <?=$sp_effects[$effect_detail['effect_id']]?><br/>
                        <b>Base 1:</b> <?=$effect_detail['base1']?><br/>
                        <b>Base 2:</b> <?=$effect_detail['base2']?>
                      </fieldset>
<?
    }
    $count++;
?>
                    </fieldset>
<?
  }
?>
<?
}
else {
?>
                      No effects
<?
}
?>
                  </fieldset>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </div>
    <div class="table_content">
      <table cellspacing="0" border="0" width="100%">
        <tr>
          <td width="100%">
            <table cellspacing="0" border="0" width="100%">
              <tr>
                <td>
                  <fieldset>
                    <legend><strong><font size="4">AA Prerequisite Info</font></strong></legend>
<?
if ($prereqs) {
  $count = 1;
  foreach ($prereqs as $prereq) {
?>
                    <fieldset>
                      <legend><b>Rank <?=$count?> Prerequisite</b></legend>
                      <b>Rank ID:</b> <?=$prereq['rank_id']?><br/>
                      <b>Prerequisite AA:</b> <?=getAAName($prereq['aa_id'])?><br/>
                      <b>Points:</b> <?=$prereq['points']?>
                    </fieldset>
<?
    $count++;
  }
?>
                  </fieldset>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
<?
}
else {
?>
    No prerequisites
<?
}
?>
    </div>
  </div>
