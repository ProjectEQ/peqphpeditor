  <div class="table_container">
    <div class="table_header">
      <?=$base['id']?> - <?=$base['name']?>
      <div style="float:right;">
        <a onClick="return confirm('Really delete this AA?');" href="index.php?editor=aa&aaid=<?=$base['id']?>&action=20">
          <img src="images/remove.gif" border="0" title="Delete this AA">
        </a>
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
                    <form name="base" method="POST" action="index.php?editor=aa&aaid=<?=$base['id']?>&action=12">
                      <input name="id" type="hidden" value="<?=$base['id']?>">
                      <table cellpadding="0" cellspacing="0" width="100%">
                        <tr>
                          <td>
                            <b>ID:</b><br>
                            <input type="text" size="5" value="<?=$base['id']?>" disabled>
                          </td>
                          <td colspan="4">
                            <b>Name:</b><br>
                            <input name="name" type="text" size="50" value="<?=$base['name']?>">
                          </td>
                          <td colspan="2">
                            <b>Category:</b><br>
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
                            <b>Type:</b><br>
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
                            <br>
                            <fieldset style="text-align:left;">
                              <legend><strong><font size="2">Classes</font></strong></legend>
                              <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                  <td><input type="checkbox" name="classes[]" value="1" onChange="box_changed('classes[]', 'all_classes');"<?echo ($base['classes'] &     1) ? " checked" : "";?>>Warrior</td>
                                  <td><input type="checkbox" name="classes[]" value="2" onChange="box_changed('classes[]', 'all_classes');"<?echo ($base['classes'] &     2) ? " checked" : "";?>>Cleric</td>
                                  <td><input type="checkbox" name="classes[]" value="4" onChange="box_changed('classes[]', 'all_classes');"<?echo ($base['classes'] &     4) ? " checked" : "";?>>Paladin</td>
                                  <td><input type="checkbox" name="classes[]" value="8" onChange="box_changed('classes[]', 'all_classes');"<?echo ($base['classes'] &     8) ? " checked" : "";?>>Ranger</td>
                                  <td><input type="checkbox" name="classes[]" value="16" onChange="box_changed('classes[]', 'all_classes');"<?echo ($base['classes'] &   16) ? " checked" : "";?>>Shadowknight</td>
                                  <td><input type="checkbox" name="classes[]" value="32" onChange="box_changed('classes[]', 'all_classes');"<?echo ($base['classes'] &   32) ? " checked" : "";?>>Druid</td>
                                  <td><input type="checkbox" name="classes[]" value="64" onChange="box_changed('classes[]', 'all_classes');"<?echo ($base['classes'] &   64) ? " checked" : "";?>>Monk</td>
                                  <td><input type="checkbox" name="classes[]" value="128" onChange="box_changed('classes[]', 'all_classes');"<?echo ($base['classes'] & 128) ? " checked" : "";?>>Bard</td>
                                </tr>
                                <tr>
                                  <td><input type="checkbox" name="classes[]" value="256" onChange="box_changed('classes[]', 'all_classes');"<?echo ($base['classes'] &     256) ? " checked" : "";?>>Rogue</td>
                                  <td><input type="checkbox" name="classes[]" value="512" onChange="box_changed('classes[]', 'all_classes');"<?echo ($base['classes'] &     512) ? " checked" : "";?>>Shaman</td>
                                  <td><input type="checkbox" name="classes[]" value="1024" onChange="box_changed('classes[]', 'all_classes');"<?echo ($base['classes'] &   1024) ? " checked" : "";?>>Necromancer</td>
                                  <td><input type="checkbox" name="classes[]" value="2048" onChange="box_changed('classes[]', 'all_classes');"<?echo ($base['classes'] &   2048) ? " checked" : "";?>>Wizard</td>
                                  <td><input type="checkbox" name="classes[]" value="4096" onChange="box_changed('classes[]', 'all_classes');"<?echo ($base['classes'] &   4096) ? " checked" : "";?>>Magician</td>
                                  <td><input type="checkbox" name="classes[]" value="8192" onChange="box_changed('classes[]', 'all_classes');"<?echo ($base['classes'] &   8192) ? " checked" : "";?>>Enchanter</td>
                                  <td><input type="checkbox" name="classes[]" value="16384" onChange="box_changed('classes[]', 'all_classes');"<?echo ($base['classes'] & 16384) ? " checked" : "";?>>Beastlord</td>
                                  <td><input type="checkbox" name="classes[]" value="32768" onChange="box_changed('classes[]', 'all_classes');"<?echo ($base['classes'] & 32768) ? " checked" : "";?>>Berserker</td>
                                </tr>
                                <tr>
                                  <td colspan="8" align="center"><br><input type="checkbox" id="all_classes" onChange="all_boxes_changed('classes[]', 'all_classes');"<?echo ($base['classes'] == 65535) ? " checked" : "";?>>All Classes</td>
                                </tr>
                              </table>
                            </fieldset><br>
                          </td>
                        </tr>
                        <tr>
                          <td colspan="9">
                            <fieldset style="text-align:left;">
                              <legend><strong><font size="2">Races</font></strong></legend>
                              <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                  <td><input type="checkbox" name="races[]" value="1" onChange="box_changed('races[]', 'all_races');"<?echo ($base['races'] &     1) ? " checked" : "";?>>Human</td>
                                  <td><input type="checkbox" name="races[]" value="2" onChange="box_changed('races[]', 'all_races');"<?echo ($base['races'] &     2) ? " checked" : "";?>>Barbarian</td>
                                  <td><input type="checkbox" name="races[]" value="4" onChange="box_changed('races[]', 'all_races');"<?echo ($base['races'] &     4) ? " checked" : "";?>>Erudite</td>
                                  <td><input type="checkbox" name="races[]" value="8" onChange="box_changed('races[]', 'all_races');"<?echo ($base['races'] &     8) ? " checked" : "";?>>Wood Elf</td>
                                  <td><input type="checkbox" name="races[]" value="16" onChange="box_changed('races[]', 'all_races');"<?echo ($base['races'] &   16) ? " checked" : "";?>>High Elf</td>
                                  <td><input type="checkbox" name="races[]" value="32" onChange="box_changed('races[]', 'all_races');"<?echo ($base['races'] &   32) ? " checked" : "";?>>Dark Elf</td>
                                  <td><input type="checkbox" name="races[]" value="64" onChange="box_changed('races[]', 'all_races');"<?echo ($base['races'] &   64) ? " checked" : "";?>>Half Elf</td>
                                  <td><input type="checkbox" name="races[]" value="128" onChange="box_changed('races[]', 'all_races');"<?echo ($base['races'] & 128) ? " checked" : "";?>>Dwarf</td>
                                </tr>
                                <tr>
                                  <td><input type="checkbox" name="races[]" value="256" onChange="box_changed('races[]', 'all_races');"<?echo ($base['races'] &     256) ? " checked" : "";?>>Troll</td>
                                  <td><input type="checkbox" name="races[]" value="512" onChange="box_changed('races[]', 'all_races');"<?echo ($base['races'] &     512) ? " checked" : "";?>>Ogre</td>
                                  <td><input type="checkbox" name="races[]" value="1024" onChange="box_changed('races[]', 'all_races');"<?echo ($base['races'] &   1024) ? " checked" : "";?>>Halfling</td>
                                  <td><input type="checkbox" name="races[]" value="2048" onChange="box_changed('races[]', 'all_races');"<?echo ($base['races'] &   2048) ? " checked" : "";?>>Gnome</td>
                                  <td><input type="checkbox" name="races[]" value="4096" onChange="box_changed('races[]', 'all_races');"<?echo ($base['races'] &   4096) ? " checked" : "";?>>Iksar</td>
                                  <td><input type="checkbox" name="races[]" value="8192" onChange="box_changed('races[]', 'all_races');"<?echo ($base['races'] &   8192) ? " checked" : "";?>>Vah Shir</td>
                                  <td><input type="checkbox" name="races[]" value="16384" onChange="box_changed('races[]', 'all_races');"<?echo ($base['races'] & 16384) ? " checked" : "";?>>Froglok</td>
                                  <td><input type="checkbox" name="races[]" value="32768" onChange="box_changed('races[]', 'all_races');"<?echo ($base['races'] & 32768) ? " checked" : "";?>>Drakkin</td>
                                </tr>
                                <tr>
                                  <td colspan="8" align="center"><br><input type="checkbox" id="all_races" onChange="all_boxes_changed('races[]', 'all_races');"<?echo ($base['races'] == 65535) ? " checked" : "";?>>All Races</td>
                                </tr>
                              </table>
                            </fieldset><br>
                          </td>
                        </tr>
                        <tr>
                          <td colspan="9">
                            <fieldset style="text-align:left;">
                              <legend><strong><font size="2">Deities</font></strong></legend>
                              <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                  <td width="20%">
                                    <input type="checkbox" name="deities[]" value="1" onChange="box_changed('deities[]', 'all_deities');"<?echo ($base['deities'] &   1) ? " checked" : "";?>>Agnostic<br>
                                    <input type="checkbox" name="deities[]" value="2" onChange="box_changed('deities[]', 'all_deities');"<?echo ($base['deities'] &   2) ? " checked" : "";?>>Bertoxxulous<br>
                                    <input type="checkbox" name="deities[]" value="4" onChange="box_changed('deities[]', 'all_deities');"<?echo ($base['deities'] &   4) ? " checked" : "";?>>Brell Serilis<br>
                                    <input type="checkbox" name="deities[]" value="32" onChange="box_changed('deities[]', 'all_deities');"<?echo ($base['deities'] & 32) ? " checked" : "";?>>Bristlebane<br>
                                  </td>
                                  <td width="20%">
                                    <input type="checkbox" name="deities[]" value="8" onChange="box_changed('deities[]', 'all_deities');"<?echo ($base['deities'] &     8) ? " checked" : "";?>>Cazic Thule<br>
                                    <input type="checkbox" name="deities[]" value="16" onChange="box_changed('deities[]', 'all_deities');"<?echo ($base['deities'] &   16) ? " checked" : "";?>>Erollisi Marr<br>
                                    <input type="checkbox" name="deities[]" value="64" onChange="box_changed('deities[]', 'all_deities');"<?echo ($base['deities'] &   64) ? " checked" : "";?>>Innoruuk<br>
                                    <input type="checkbox" name="deities[]" value="128" onChange="box_changed('deities[]', 'all_deities');"<?echo ($base['deities'] & 128) ? " checked" : "";?>>Karana<br>
                                  </td>
                                  <td width="20%">
                                    <input type="checkbox" name="deities[]" value="256" onChange="box_changed('deities[]', 'all_deities');"<?echo ($base['deities'] &   256) ? " checked" : "";?>>Mithaniel Marr<br>
                                    <input type="checkbox" name="deities[]" value="512" onChange="box_changed('deities[]', 'all_deities');"<?echo ($base['deities'] &   512) ? " checked" : "";?>>Prexus<br>
                                    <input type="checkbox" name="deities[]" value="1024" onChange="box_changed('deities[]', 'all_deities');"<?echo ($base['deities'] & 1024) ? " checked" : "";?>>Quellious<br>
                                    <input type="checkbox" name="deities[]" value="2048" onChange="box_changed('deities[]', 'all_deities');"<?echo ($base['deities'] & 2048) ? " checked" : "";?>>Rallos Zek<br>
                                  </td>
                                  <td width="20%">
                                    <input type="checkbox" name="deities[]" value="4096" onChange="box_changed('deities[]', 'all_deities');"<?echo ($base['deities'] &   4096) ? " checked" : "";?>>Rodcet Nife<br>
                                    <input type="checkbox" name="deities[]" value="8192" onChange="box_changed('deities[]', 'all_deities');"<?echo ($base['deities'] &   8192) ? " checked" : "";?>>Solusek Ro<br>
                                    <input type="checkbox" name="deities[]" value="16384" onChange="box_changed('deities[]', 'all_deities');"<?echo ($base['deities'] & 16384) ? " checked" : "";?>>The Tribunal<br>
                                    <input type="checkbox" name="deities[]" value="32768" onChange="box_changed('deities[]', 'all_deities');"<?echo ($base['deities'] & 32768) ? " checked" : "";?>>Tunare<br>
                                  </td>
                                  <td width="20%"><input type="checkbox" name="deities[]" value="65536" onChange="box_changed('deities[]', 'all_deities');"<?echo ($base['deities'] & 65536) ? " checked" : "";?>>Veeshan</td>
                                </tr>
                                <tr>
                                  <td colspan="5" align="center"><br><input type="checkbox" id="all_deities" onChange="all_boxes_changed('deities[]', 'all_deities');"<?echo ($base['deities'] == 131071) ? " checked" : "";?>>All Deities</td>
                                </tr>
                              </table>
                            </fieldset><br>
                          </td>
                        </tr>
                      </table>
                      <table cellpadding="0" cellspacing="0" width="100%">
                        <tr>
                          <td>
                            <b>Enabled:</b><br>
                            <select name="enabled">
                              <option value="0"<?echo ($base['enabled'] == 0) ? " selected" : "";?>>No</option>
                              <option value="1"<?echo ($base['enabled'] == 1) ? " selected" : "";?>>Yes</option>
                            </select>
                          </td>
                          <td>
                            <b>First Rank:</b><?echo ($base['first_rank_id'] != -1 && count($ranks) == 0) ? " <a title='Rank ID defined (". $base['first_rank_id'] . ") but rank data missing'><img src='images/caution.gif' width='13'></a>" : "";?><br>
                            <select name="first_rank_id"<?echo ($base['first_rank_id'] != -1 && count($ranks) == 0) ? " style='background-color: red;'": "";?>>
                              <option value="-1">None</option>
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
                            <b>Grant Only:</b><br>
                            <select name="grant_only">
                              <option value="0"<?echo ($base['grant_only'] == 0) ? " selected" : "";?>>No</option>
                              <option value="1"<?echo ($base['grant_only'] == 1) ? " selected" : "";?>>Yes</option>
                            </select>
                          </td>
                          <td>
                            <b>Status:</b><br>
                            <input name="status" type="text" size="3" value="<?=$base['status']?>">
                          </td>
                          <td>
                            <b>Charges:</b><br>
                            <input name="charges" type="text" size="3" value="<?=$base['charges']?>">
                          </td>
                          <td>&nbsp;</td>
                          <td>
                            <b>Drakkin Heritage:</b><br>
                            <input name="drakkin_heritage" type="text" size="3" value="<?=$base['drakkin_heritage']?>">
                          </td>
                          <td>
                            <b>Reset on Death:</b><br>
                            <select name="reset_on_death">
                              <option value="0"<?echo ($base['reset_on_death'] == 0) ? " selected" : "";?>>No</option>
                              <option value="1"<?echo ($base['reset_on_death'] == 1) ? " selected" : "";?>>Yes</option>
                            </select>
                          </td>
                          <td>
                            <b>Auto Grant:</b><br>
                            <select name="auto_grant_enabled">
                              <option value="0"<?echo ($base['auto_grant_enabled'] == 0) ? " selected" : "";?>>No</option>
                              <option value="1"<?echo ($base['auto_grant_enabled'] == 1) ? " selected" : "";?>>Yes</option>
                            </select>
                          </td>
                        </tr>
                      </table>
                      <center>
                        <br>
                        <input type="submit" value="Update Base AA Info" style="width: 150px;">
                      </center>
                    </form>
                  </fieldset><br>
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
<?if ($count == count($ranks)):?>
                      <div style="float:right;">
                        <a onClick="return confirm('Really delete this rank?');" href="index.php?editor=aa&aaid=<?=$base['id']?>&rankid=<?=$rank['id']?>&action=21">
                          <img src="images/remove.gif" border="0" title="Delete this rank">
                        </a>
                      </div>
<?endif;?>
                      <form name="rank<?=$count?>" method="POST" action="index.php?editor=aa&aaid=<?=$base['id']?>&rankid=<?=$rank['id']?>&action=15">
                        <table cellspacing="0" cellpadding="0" width="100%">
                          <tr>
                            <td>
                              <b>Rank ID:</b><br>
                              <input type="text" size="8" value="<?=$rank['id']?>" disabled>
                            </td>
                            <td>
                              <b>Upper Hotkey SID:</b><br>
                              <input name="upper_hotkey_sid" type="text" size="8" value="<?=$rank['upper_hotkey_sid']?>">
                            </td>
                            <td>
                              <b>Lower Hotkey SID:</b><br>
                              <input name="lower_hotkey_sid" type="text" size="8" value="<?=$rank['lower_hotkey_sid']?>">
                            </td>
                            <td>
                              <b>Title SID:</b><br>
                              <input name="title_sid" type="text" size="8" value="<?=$rank['title_sid']?>">
                            </td>
                            <td>
                              <b>Desc SID:</b><br>
                              <input name="desc_sid" type="text" size="8" value="<?=$rank['desc_sid']?>">
                            </td>
                          </tr>
                          <tr><td colspan="5">&nbsp;</td></tr>
                          <tr>
                            <td>
                              <b>Cost:</b><br>
                              <input name="cost" type="text" size="8" value="<?=$rank['cost']?>">
                            </td>
                            <td>
                              <b>Level Required:</b><br>
                              <input name="level_req" type="text" size="8" value="<?=$rank['level_req']?>">
                            </td>
                            <td>
                              <b>Spell:</b><br>
                              <input name="spell" type="text" size="8" value="<?=$rank['spell']?>">
                            </td>
                            <td>
                              <b>Spell Type:</b><br>
                              <input name="spell_type" type="text" size="8" value="<?=$rank['spell_type']?>">
                            </td>
                            <td>
                              <b>Recast Time:</b><br>
                              <input name="recast_time" type="text" size="8" value="<?=$rank['recast_time']?>">
                            </td>
                          </tr>
                          <tr><td colspan="5">&nbsp;</td></tr>
                          <tr>
                            <td colspan="2">
                              <b>Expansion:</b><br>
                              <select name="expansion">
<?
  foreach ($eqexpansions as $k => $v) {
?>
                                <option value="<?=$k?>"<?echo ($rank['expansion'] == $k) ? " selected" : "";?>><?=$v?></option>
<?
  }
?>
                              </select>
                            </td>
                            <td>
                              <b>Previous ID:</b><?echo ($count == 1 && $rank['prev_id'] != -1) ? " <a title='First rank should have -1 as the previous rank id'><img src='images/caution.gif' width='13'></a>" : "";?><br>
                              <input name="prev_id" type="text" size="8" value="<?=$rank['prev_id'];?>"<?echo ($count == 1 && $rank['prev_id'] != -1) ? " style='background-color: red;'" : "";?>>
                            </td>
                            <td>
                              <b>Next ID:</b><?echo ($count == count($ranks) && $rank['next_id'] != -1) ? " <a title='Next rank defined but rank data missing - last rank should be -1'><img src='images/caution.gif' width='13'></a>" : "";?><br>
                              <input name="next_id" type="text" size="8" value="<?=$rank['next_id'];?>"<?echo ($count == count($ranks) && $rank['next_id'] != -1) ? " style='background-color: red;'" : "";?>>
                            </td>
                          </tr>
                        </table>
                        <center>
                          <br>
                          <input type="hidden" name="id" value="<?=$rank['id']?>">
                          <input type="hidden" name="aaid" value="<?=$base['id']?>">
                          <input type="submit" value="Update Rank (<?=$count?>)" style="width: 150px;">
                        </center>
                      </form>
                    </fieldset><br>
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
                      <form name="new_aa_rank" method="POST" action="index.php?editor=aa&aaid=<?=$base['id']?>&prev_id=<?echo (count($ranks) > 0) ? end($ranks)['id'] : -1;?>&action=6">
                        <input type="hidden" name="aaid" value="<?=$base['id']?>">
                        <input type="hidden" name="prev_id" value="<?echo (count($ranks) > 0) ? end($ranks)['id'] : -1;?>">
                        <input type="submit" value="New Rank (<?echo count($ranks) + 1;?>)" style="width: 150px;">
                      </form>
                    </center>
                  </fieldset><br>
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
  foreach ($effects as $effect) {
    foreach ($effect as $effect_detail) {
?>
                    <fieldset>
                      <legend><strong><font size="2">Rank (<?=$effect_detail['rank_id']?>) - Slot <?=$effect_detail['slot']?></font></strong></legend>
                      <form name="effect<?=$effect_detail['rank_id']?>" method="POST" action="index.php?editor=aa&aaid=<?=$base['id']?>&action=17">
                        <table cellspacing="0" cellpadding="0" width="100%">
                          <tr>
                            <td>
                              <b>Effect:</b><br>
                              <select name="effect_id">
<?
      foreach ($sp_effects as $k => $v) {
?>
                                <option value="<?=$k?>"<?echo ($k == $effect_detail['effect_id']) ? " selected" : "";?>><?=$k?> - <?=$v?></option>
<?
      }
?>
                              </select>
                            </td>
                            <td>
                              <b>Base 1:</b><br>
                              <input name="base1" type="text" value="<?=$effect_detail['base1']?>">
                            </td>
                            <td>
                              <b>Base 2:</b><br>
                              <input name="base2" type="text" value="<?=$effect_detail['base2']?>">
                            </td>
                          </tr>
                        </table>
                        <center>
                          <br>
                          <input type="hidden" name="aaid" value="<?=$base['id']?>">
                          <input type="hidden" name="rank_id" value="<?=$effect_detail['rank_id']?>">
                          <input type="hidden" name="slot" value="<?=$effect_detail['slot']?>">
                          <input type="submit" value="Update Effect (<?=$effect_detail['rank_id']?>) - Slot <?=$effect_detail['slot']?>">
                        </center>
                      </form>
                    </fieldset><br>
<?
    }
  }
}
else {
?>
                      No effects
<?
}
?>
                  </fieldset><br>
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
  foreach ($prereqs as $prereq) {
?>
                    <fieldset>
                      <legend><strong><font size="2">Rank ID <?=$prereq['rank_id']?> Prerequisite</font></strong></legend>
                      <table cellspacing="0" cellpadding="0" width="100%">
                        <tr>
                          <td>
                            <b>Prerequisite AA:</b><br>
                            <select name="prereq_<?=$prereq['rank_id']?>">
<?
    foreach ($aas as $aa) {
?>
                              <option value="<?=$aa['id']?>"<?echo ($aa['id'] == $prereq['aa_id']) ? " selected" : "";?>><?=$aa['name']?> (<?=$aa['id']?>)</option>
<?
    }
?>
                            </select>
                          </td>
                          <td>
                            <b>Points:</b><br>
                            <input name="" type="text" value="<?=$prereq['points']?>">
                          </td>
                        </tr>
                      </table>
                      <center>
                        <br>
                        <input type="button" value="Update Prerequisite" style="width: 150px;" onClick="javascript:alert('Edit functionality not enabled yet.');">&nbsp;&nbsp;
                        <input type="button" value="Delete Prerequisite" style="width: 150px;" onClick="javascript:alert('Edit functionality not enabled yet.');">&nbsp;&nbsp;
                        <input type="button" value="Reset Values" style="width: 150px;" onClick="window.location.reload();">
                      </center>
                    </fieldset><br>
<?
  }
?>
                    <center>
                      <input type="button" value="New Prerequisite" style="width: 150px;" onClick="javascript:alert('Edit functionality not enabled yet.');">
                    </center>

<?
}
else {
?>
    No prerequisites
<?
}
?>
                  </fieldset><br>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </div>
  </div>
