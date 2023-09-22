  <div class="table_container">
    <div class="table_header">
      <div style="float:right">
        <a href="index.php?editor=player&playerid=<?=$playerid?>"><img src="images/user.gif" style="border: 0;" title="View Player" alt="View Player"></a>
        <a href="index.php?editor=inv&playerid=<?=$playerid?>&action=1"><img src="images/contents.png" style="border: 0;" title="View Inventory" alt="View Inventory"></a>&nbsp;
        <a href="index.php?editor=keys&playerid=<?=$playerid?>&action=1"><img src="images/key.png" style="border: 0;" title="View Keyring" alt="View Keyring"></a>&nbsp;
        <a onClick="javascript:alert('Not yet!');"><img src="images/c_table.gif" style="border: 0;" title="Edit this Player" alt="Edit this Player"></a>&nbsp;
        <a onClick="return confirm('Really delete player <?=trim($name)?> (<?=$playerid?>)?');" href="index.php?editor=player&playerid=<?=$playerid?>&action=4"><img src="images/table.gif" style="border: 0;" title="Delete this Player" alt="Delete this Player"></a>
      </div>
      <?=$character_id?> - <?echo trim($name);?>
    </div>
    <div class="table_content">
      <table cellspacing="0" border="0" width="100%">
        <tr>
          <td style="width:30%;">
            <table cellspacing="0" border="0" width="100%">
              <tr>
                <td>
                  <fieldset>
                    <legend><strong>Basic Info</strong></legend>
                    <strong>Name:</strong> <?=trim($name)?><br>
                    <strong>Character ID:</strong> <?=$character_id?><br>
                    <strong>Status:</strong> <?=$status?><br>
                    <strong>Level:</strong> <?=$level?><br>
                    <strong>Class:</strong> <?=$classes[$class]?><br>
                    <strong>Race:</strong> <?=$races[$race]?><br>
                    <strong>AA Points:</strong> <?=$aa_points?>
                  </fieldset>
                  <fieldset>
                    <legend><strong>Vitals</strong></legend>
                    <strong>HP:</strong> <?=$hp?><br>
                    <strong>Mana:</strong> <?=$mana?><br>
                    <strong>Endurance:</strong> <?=$endurance?><br>
                    <strong>AC:</strong> <?=$ac?>
                  </fieldset>
                </td>
              </tr>
            </table>
          </td>
          <td>
            <table cellspacing="0" border="0" width="100%">
              <tr>
                <td colspan="2">
                  <fieldset>
                    <legend><strong>Stats</strong></legend>
                    <table width="100%" border="0" cellpadding="3" cellspacing="0">
                      <tr>
                        <td>
						  <fieldset>
							<legend><strong>Base</strong></legend>
							<table width="100%" border="0" cellpadding="3" cellspacing="0">
								<tr>
								  <td align="left" width="33%"><strong>STR:</strong> <?=$strength?></td>
								  <td align="left" width="33%"><strong>STA:</strong> <?=$stamina?></td>
								  <td align="left" width="34%"><strong>DEX:</strong> <?=$dexterity?></td>
								</tr>
								<tr>
								  <td align="left" width="33%"><strong>AGI:</strong> <?=$agility?></td>
								  <td align="left" width="33%"><strong>INT:</strong> <?=$intelligence?></td>
								  <td align="left" width="34%"><strong>WIS:</strong> <?=$wisdom?></td>
								</tr>
								<tr>
								  <td align="left" width="33%"><strong>CHA:</strong> <?=$charisma?></td>
								  <td align="left" width="33%">&nbsp;</td>
								  <td align="left" width="34%">&nbsp;</td>
								</tr>
								<tr>
								  <td align="left" width="33%"><strong>MR:</strong> <?=$magic_resist?></td>
								  <td align="left" width="33%"><strong>FR:</strong> <?=$fire_resist?></td>
								  <td align="left" width="34%"><strong>CR:</strong> <?=$cold_resist?></td>
								</tr>
								<tr>
								  <td align="left" width="33%"><strong>PR:</strong> <?=$poison_resist?></td>
								  <td align="left" width="33%"><strong>DR:</strong> <?=$disease_resist?></td>
								  <td align="left" width="34%"><strong>Corrup:</strong> <?=$corruption_resist?></td>
								</tr>
							  </table>
						  </fieldset>
                        </td>
                        <td>
                          <fieldset>
                            <legend><strong>Heroic</strong></legend>
							  <table width="100%" border="0" cellpadding="3" cellspacing="0">
								<tr>
								  <td align="left" width="33%"><strong>STR:</strong> <?=$heroic_strength?></td>
								  <td align="left" width="33%"><strong>STA:</strong> <?=$heroic_stamina?></td>
								  <td align="left" width="34%"><strong>DEX:</strong> <?=$heroic_dexterity?></td>
								</tr>
								<tr>
								  <td align="left" width="33%"><strong>AGI:</strong> <?=$heroic_agility?></td>
								  <td align="left" width="33%"><strong>INT:</strong> <?=$heroic_intelligence?></td>
								  <td align="left" width="34%"><strong>WIS:</strong> <?=$heroic_wisdom?></td>
								</tr>
								<tr>
								  <td align="left" width="33%"><strong>CHA:</strong> <?=$heroic_charisma?></td>
								  <td align="left" width="33%">&nbsp;</td>
								  <td align="left" width="34%">&nbsp;</td>
								</tr>
								<tr>
								  <td align="left" width="33%"><strong>MR:</strong> <?=$heroic_magic_resist?></td>
								  <td align="left" width="33%"><strong>FR:</strong> <?=$heroic_fire_resist?></td>
								  <td align="left" width="34%"><strong>CR:</strong> <?=$heroic_cold_resist?></td>
								</tr>
								<tr>
								  <td align="left" width="33%"><strong>PR:</strong> <?=$heroic_poison_resist?></td>
								  <td align="left" width="33%"><strong>DR:</strong> <?=$heroic_disease_resist?></td>
								  <td align="left" width="34%"><strong>Corrup:</strong> <?=$heroic_corruption_resist?></td>
								</tr>
							  </table>
                          </fieldset>
                        </td>
                      </tr>
                    </table>
                  </fieldset>
                </td>
              </tr>
              <tr>
                <td colspan="2">
                  <fieldset>
                    <legend><strong>Combat</strong></legend>
                    <table cellspacing="0" border="0" width="100%">
                      <tr>
                        <td align="left" width="25%"><strong>Haste:</strong> <?=$haste?></td>
                        <td align="left" width="25%"><strong>Accuracy:</strong> <?=$accuracy?></td>
                        <td align="left" width="25%"><strong>Attack:</strong> <?=$attack?></td>
                        <td align="left" width="25%"><strong>Avoidance:</strong> <?=$avoidance?></td>
                      </tr>
                      <tr>
                        <td align="left" width="25%"><strong>Clairvoyance:</strong> <?=$clairvoyance?></td>
                        <td align="left" width="25%"><strong>Combat Effects:</strong> <?=$combat_effects?></td>
                        <td align="left" width="25%"><strong>DS Mitigation:</strong> <?=$damage_shield_mitigation?></td>
                        <td align="left" width="25%"><strong>Damage Shield:</strong> <?=$damage_shield?></td>
                      </tr>
                      <tr>
                        <td align="left" width="25%"><strong>DoT Shielding:</strong> <?=$dot_shielding?></td>
                        <td align="left" width="25%"><strong>HP Regen:</strong> <?=$hp_regen?></td>
                        <td align="left" width="25%"><strong>Mana Regen:</strong> <?=$mana_regen?></td>
                        <td align="left" width="25%"><strong>Endurance Regen:</strong> <?=$endurance_regen?></td>
                      </tr>
                      <tr>
                        <td align="left" width="25%"><strong>Shielding:</strong> <?=$shielding?></td>
                        <td align="left" width="25%"><strong>Spell Damage:</strong> <?=$spell_damage?></td>
                        <td align="left" width="25%"><strong>Spell Shielding:</strong> <?=$spell_shielding?></td>
                        <td align="left" width="25%"><strong>Strikethrough:</strong> <?=$strikethrough?></td>
                      </tr>
                      <tr>
                        <td align="left" width="25%"><strong>Stun Resist:</strong> <?=$stun_resist?></td>
                        <td align="left" width="25%">&nbsp;</td>
                        <td align="left" width="25%">&nbsp;</td>
                        <td align="left" width="25%">&nbsp;</td>
                      </tr>
                    </table>
                  </fieldset>
                </td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td colspan="2">
            <fieldset>
              <legend><strong>Skills</strong></legend>
              <table width="100%">
                <tr>
                  <td width="50%">
                    <fieldset>
                      <legend><strong>Abilities</strong></legend>
                      <table width="100%">
                        <tr>
                          <td>
<?
  echo "<strong>8 - " . $skilltypes[8] . ":</strong> " . (isset($backstab) ? $backstab : 0) . "<br>";
  echo "<strong>12 - " . $skilltypes[12] . ":</strong> " . (isset($brass) ? $brass : 0) . "<br>";
  echo "<strong>41 - " . $skilltypes[41] . ":</strong> " . (isset($singing) ? $singing : 0) . "<br>";
  echo "<strong>49 - " . $skilltypes[49] . ":</strong> " . (isset($string) ? $string : 0) . "<br>";
  echo "<strong>54 - " . $skilltypes[54] . ":</strong> " . (isset($wind) ? $wind : 0) . "<br>";
  echo "<strong>55 - " . $skilltypes[55] . ":</strong> " . (isset($fishing) ? $fishing : 0) . "<br>";
  echo "<strong>66 - " . $skilltypes[66] . ":</strong> " . (isset($alcohol) ? $alcohol : 0) . "<br>";
  echo "<strong>70 - " . $skilltypes[70] . ":</strong> " . (isset($percussion) ? $percussion : 0) . "<br>";
?>
                          </td>
                        </tr>
                      </table>
                    </fieldset>
                  </td>
                  <td width="50%">
                    <fieldset>
                      <legend><strong>Tradeskills</strong></legend>
<?
  echo "<strong>57 - " . $skilltypes[57] . ":</strong> " . (isset($tinkering) ? $tinkering : 0) . "<br>";
  echo "<strong>58 - " . $skilltypes[58] . ":</strong> " . (isset($research) ? $research : 0) . "<br>";
  echo "<strong>59 - " . $skilltypes[59] . ":</strong> " . (isset($alchemy) ? $alchemy : 0) . "<br>";
  echo "<strong>60 - " . $skilltypes[60] . ":</strong> " . (isset($baking) ? $baking : 0) . "<br>";
  echo "<strong>61 - " . $skilltypes[61] . ":</strong> " . (isset($tailoring) ? $tailoring : 0) . "<br>";
  echo "<strong>63 - " . $skilltypes[63] . ":</strong> " . (isset($blacksmithing) ? $blacksmithing : 0) . "<br>";
  echo "<strong>64 - " . $skilltypes[64] . ":</strong> " . (isset($fletching) ? $fletching : 0) . "<br>";
  echo "<strong>65 - " . $skilltypes[65] . ":</strong> " . (isset($brewing) ? $brewing : 0) . "<br>";
  echo "<strong>68 - " . $skilltypes[68] . ":</strong> " . (isset($jewelry) ? $jewelry : 0) . "<br>";
  echo "<strong>69 - " . $skilltypes[69] . ":</strong> " . (isset($pottery) ? $pottery : 0) . "<br>";
?>
                    </fieldset>
                  </td>
                </tr>
              </table>
            </fieldset>
          </td>
        </tr>
        <tr>
          <td colspan="3">
            <fieldset>
              <legend><strong>Report Date/Time</strong></legend>
                <table width="100%">
                  <tr>
                    <td width="50%"><strong>Created:</strong> <?=$created_at?></td>
                    <td width="50%"><strong>Updated:</strong> <?=$updated_at?></td>
                  </tr>
                </table>
            </fieldset>
          </td>
        </tr>
      </table>
    </div>
  </div>
