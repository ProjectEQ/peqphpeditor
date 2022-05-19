  <div class="table_container">
    <div class="table_header">&nbsp;</div>
    <div class="table_content">
      <table cellspacing="0" border="0" width="100%">
        <tr>
          <td width="100%">
            <table cellspacing="0" border="0" width="100%">
              <tr>
                <td>
                  <fieldset>
                    <form name="base" method="post" action="index.php?editor=aa&action=5">
                      <legend><strong><font size="4">Base AA Info</font></strong></legend>
                      <table cellpadding="0" cellspacing="0" width="100%">
                        <tr>
                          <td>
                            <b>ID:</b><br>
                            <input name="id" type="text" size="5" value="<?=$new_id?>">
                          </td>
                          <td colspan="4">
                            <b>Name:</b><br>
                            <input name="name" type="text" size="50" value="">
                          </td>
                          <td colspan="2">
                            <b>Category:</b><br>
                            <select name="category">
<?
  foreach ($aa_category as $k => $v) {
?>
                              <option value="<?=$k?>"><?=$v?></option>
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
                              <option value="<?=$k?>"><?=$v?></option>
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
                                  <td><input type="checkbox" name="classes[]" value="1" onChange="box_changed('classes[]', 'all_classes');">Warrior</td>
                                  <td><input type="checkbox" name="classes[]" value="2" onChange="box_changed('classes[]', 'all_classes');">Cleric</td>
                                  <td><input type="checkbox" name="classes[]" value="4" onChange="box_changed('classes[]', 'all_classes');">Paladin</td>
                                  <td><input type="checkbox" name="classes[]" value="8" onChange="box_changed('classes[]', 'all_classes');">Ranger</td>
                                  <td><input type="checkbox" name="classes[]" value="16" onChange="box_changed('classes[]', 'all_classes');">Shadowknight</td>
                                  <td><input type="checkbox" name="classes[]" value="32" onChange="box_changed('classes[]', 'all_classes');">Druid</td>
                                  <td><input type="checkbox" name="classes[]" value="64" onChange="box_changed('classes[]', 'all_classes');">Monk</td>
                                  <td><input type="checkbox" name="classes[]" value="128" onChange="box_changed('classes[]', 'all_classes');">Bard</td>
                                </tr>
                                <tr>
                                  <td><input type="checkbox" name="classes[]" value="256" onChange="box_changed('classes[]', 'all_classes');">Rogue</td>
                                  <td><input type="checkbox" name="classes[]" value="512" onChange="box_changed('classes[]', 'all_classes');">Shaman</td>
                                  <td><input type="checkbox" name="classes[]" value="1024" onChange="box_changed('classes[]', 'all_classes');">Necromancer</td>
                                  <td><input type="checkbox" name="classes[]" value="2048" onChange="box_changed('classes[]', 'all_classes');">Wizard</td>
                                  <td><input type="checkbox" name="classes[]" value="4096" onChange="box_changed('classes[]', 'all_classes');">Magician</td>
                                  <td><input type="checkbox" name="classes[]" value="8192" onChange="box_changed('classes[]', 'all_classes');">Enchanter</td>
                                  <td><input type="checkbox" name="classes[]" value="16384" onChange="box_changed('classes[]', 'all_classes');">Beastlord</td>
                                  <td><input type="checkbox" name="classes[]" value="32768" onChange="box_changed('classes[]', 'all_classes');">Berserker</td>
                                </tr>
                                <tr>
                                  <td colspan="8" align="center"><br><input type="checkbox" id="all_classes" onChange="all_boxes_changed('classes[]', 'all_classes');">All Classes</td>
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
                                  <td><input type="checkbox" name="races[]" value="1" onChange="box_changed('races[]', 'all_races');">Human</td>
                                  <td><input type="checkbox" name="races[]" value="2" onChange="box_changed('races[]', 'all_races');">Barbarian</td>
                                  <td><input type="checkbox" name="races[]" value="4" onChange="box_changed('races[]', 'all_races');">Erudite</td>
                                  <td><input type="checkbox" name="races[]" value="8" onChange="box_changed('races[]', 'all_races');">Wood Elf</td>
                                  <td><input type="checkbox" name="races[]" value="16" onChange="box_changed('races[]', 'all_races');">High Elf</td>
                                  <td><input type="checkbox" name="races[]" value="32" onChange="box_changed('races[]', 'all_races');">Dark Elf</td>
                                  <td><input type="checkbox" name="races[]" value="64" onChange="box_changed('races[]', 'all_races');">Half Elf</td>
                                  <td><input type="checkbox" name="races[]" value="128" onChange="box_changed('races[]', 'all_races');">Dwarf</td>
                                </tr>
                                <tr>
                                  <td><input type="checkbox" name="races[]" value="256" onChange="box_changed('races[]', 'all_races');">Troll</td>
                                  <td><input type="checkbox" name="races[]" value="512" onChange="box_changed('races[]', 'all_races');">Ogre</td>
                                  <td><input type="checkbox" name="races[]" value="1024" onChange="box_changed('races[]', 'all_races');">Halfling</td>
                                  <td><input type="checkbox" name="races[]" value="2048" onChange="box_changed('races[]', 'all_races');">Gnome</td>
                                  <td><input type="checkbox" name="races[]" value="4096" onChange="box_changed('races[]', 'all_races');">Iksar</td>
                                  <td><input type="checkbox" name="races[]" value="8192" onChange="box_changed('races[]', 'all_races');">Vah Shir</td>
                                  <td><input type="checkbox" name="races[]" value="16384" onChange="box_changed('races[]', 'all_races');">Froglok</td>
                                  <td><input type="checkbox" name="races[]" value="32768" onChange="box_changed('races[]', 'all_races');">Drakkin</td>
                                </tr>
                                <tr>
                                  <td colspan="8" align="center"><br><input type="checkbox" id="all_races" onChange="all_boxes_changed('races[]', 'all_races');">All Races</td>
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
                                    <input type="checkbox" name="deities[]" value="1" onChange="box_changed('deities[]', 'all_deities');"> Agnostic<br>
                                    <input type="checkbox" name="deities[]" value="2" onChange="box_changed('deities[]', 'all_deities');"> Bertoxxulous<br>
                                    <input type="checkbox" name="deities[]" value="4" onChange="box_changed('deities[]', 'all_deities');"> Brell Serilis<br>
                                    <input type="checkbox" name="deities[]" value="32" onChange="box_changed('deities[]', 'all_deities');"> Bristlebane<br>
                                  </td>
                                  <td width="20%">
                                    <input type="checkbox" name="deities[]" value="8" onChange="box_changed('deities[]', 'all_deities');"> Cazic Thule<br>
                                    <input type="checkbox" name="deities[]" value="16" onChange="box_changed('deities[]', 'all_deities');"> Erollisi Marr<br>
                                    <input type="checkbox" name="deities[]" value="64" onChange="box_changed('deities[]', 'all_deities');"> Innoruuk<br>
                                    <input type="checkbox" name="deities[]" value="128" onChange="box_changed('deities[]', 'all_deities');"> Karana<br>
                                  </td>
                                  <td width="20%">
                                    <input type="checkbox" name="deities[]" value="256" onChange="box_changed('deities[]', 'all_deities');"> Mithaniel Marr<br>
                                    <input type="checkbox" name="deities[]" value="512" onChange="box_changed('deities[]', 'all_deities');"> Prexus<br>
                                    <input type="checkbox" name="deities[]" value="1024" onChange="box_changed('deities[]', 'all_deities');"> Quellious<br>
                                    <input type="checkbox" name="deities[]" value="2048" onChange="box_changed('deities[]', 'all_deities');"> Rallos Zek<br>
                                  </td>
                                  <td width="20%">
                                    <input type="checkbox" name="deities[]" value="4096" onChange="box_changed('deities[]', 'all_deities');"> Rodcet Nife<br>
                                    <input type="checkbox" name="deities[]" value="8192" onChange="box_changed('deities[]', 'all_deities');"> Solusek Ro<br>
                                    <input type="checkbox" name="deities[]" value="16384" onChange="box_changed('deities[]', 'all_deities');"> The Tribunal<br>
                                    <input type="checkbox" name="deities[]" value="32768" onChange="box_changed('deities[]', 'all_deities');"> Tunare<br>
                                  </td>
                                  <td width="20%"><input type="checkbox" name="deities[]" value="65536" onChange="box_changed('deities[]', 'all_deities');"> Veeshan</td>
                                </tr>
                                <tr>
                                  <td colspan="5" align="center"><br><input type="checkbox" id="all_deities" onChange="all_boxes_changed('deities[]', 'all_deities');">All Deities</td>
                                </tr>
                              </table>
                            </fieldset><br>
                          </td>
                        </tr>
                      </table>
                      <table cellspacing="0" border="0" width="100%">
                        <tr>
                          <td>
                            <b>Enabled:</b><br>
                            <select name="enabled">
                              <option value="0">No</option>
                              <option value="1" selected>Yes</option>
                            </select>
                          </td>
                          <td>
                            <b>First Rank:</b><br>
                            <select name="first_rank_id">
                              <option value="0" selected>None</option>
<?
  foreach ($all_ranks as $rank) {
?>
                              <option value="<?=$rank['id']?>"><?=$rank['id']?></option>
<?
  }
?>
                            </select>
                          </td>
                          <td>
                            <b>Grant Only:</b><br>
                            <select name="grant_only">
                              <option value="0" selected>No</option>
                              <option value="1">Yes</option>
                            </select>
                          </td>
                          <td>
                            <b>Status:</b><br>
                            <input name="status" type="text" size="3" value="0">
                          </td>
                          <td>
                            <b>Charges:</b><br>
                            <input name="charges" type="text" size="3" value="0">
                          </td>
                          <td>
                            <b>Drakkin Heritage:</b><br>
                            <input name="drakkin_heritage" type="text" size="3" value="127">
                          </td>
                          <td>
                            <b>Reset on Death:</b><br>
                            <select name="reset_on_death">
                              <option value="0" selected>No</option>
                              <option value="1">Yes</option>
                            </select>
                          </td>
                        </tr>
                      </table>
                      <center>
                        <br><br>
                        <input type="submit" value="Add AA" style="width: 150px;">&nbsp;&nbsp;
                        <input type="button" value="Cancel" style="width: 150px;" onClick="history.back();">
                      </center>
                    </form>
                  </fieldset>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </div>
  </div>
