  <div class="table_container">
    <div class="table_header">
      <div style="float:right">
        <a href="index.php?editor=player&playerid=<?=$playerid?>&action=13"><img src="images/view_all.gif" style="border: 0" title="View Stats Record" alt="View Stats Record"></a>&nbsp;
        <a href="index.php?editor=inv&playerid=<?=$playerid?>&action=1"><img src="images/contents.png" style="border: 0;" title="View Inventory" alt="View Inventory"></a>&nbsp;
        <a href="index.php?editor=keys&playerid=<?=$playerid?>&action=1"><img src="images/key.png" style="border: 0;" title="View Keyring" alt="View Keyring"></a>&nbsp;
        <a onClick="javascript:alert('Not yet!');"><img src="images/c_table.gif" style="border: 0;" title="Edit this Player" alt="Edit this Player"></a>&nbsp;
        <a onClick="return confirm('Really delete player <?=trim($name)?> (<?=$playerid?>)?');" href="index.php?editor=player&playerid=<?=$playerid?>&action=4"><img src="images/table.gif" style="border: 0;" title="Delete this Player" alt="Delete this Player"></a>
      </div>
      <?=$id?> - <?echo trim($title) . " " . trim($name) . " " . trim($last_name) . " " . trim($suffix);?>
    </div>
    <div class="table_content">
      <table cellspacing="0" border="0" width="100%">
        <tr>
          <td style="width:30%;">
            <table cellspacing="0" border="0" width="100%">
              <tr>
                <td>
                  <fieldset>
                    <legend><strong>Character Name</strong></legend>
                    First Name: <?=trim($name)?><br>
                    Last Name: <?=trim($last_name)?><br>
                    Title: <?=trim($title)?><br>
                    Suffix: <?=trim($suffix)?><br>
                  </fieldset>
                  <fieldset>
                    <legend><strong>Account Info</strong></legend>
                    Account ID: <a href="index.php?editor=account&acctid=<?=$account_id?>"><?=$account_id?></a><br>
                    Character ID: <?=$id?><br>
                    LS Name: <a href="index.php?editor=account&acctid=<?=$account_id?>"><?=$lsname?></a><br>
                    LS ID: <?=$lsaccount?><br>
                    Last On: <?=get_real_time($last_login)?><br>
                    Time Played: <?=$time_played?> minutes<br>
                    GM: <?=$yesno[$gm]?><br>
                    Status: <?=$status?><br>
                  </fieldset>
                  <fieldset>
                    <legend><strong>Location Info</strong></legend>
                    Zone: <?=getZoneName($zone_id)?> (<?=$zone_id?>)<br>
                    Instance: <?echo ($zone_instance > 0) ? $zone_instance : "None";?><br>
                    X: <?=$x?><br>
                    Y: <?=$y?><br>
                    Z: <?=$z?><br>
                    Heading: <?=$heading?><br>
                    <center>[<a href="index.php?editor=player&playerid=<?=$id?>&action=5">Move Player</a>]</center>
                  </fieldset>
                  <fieldset>
                    <legend><strong>Guild Info</strong></legend>
                    Guild: <?echo (isset($guild_id) && $guild_id > 0) ? '<a href="index.php?editor=guild&guildid=' . $guild_id . '">' . getGuildName($guild_id) . '</a>' : "None";?><br>
                    Guild Rank: <?echo (isset($guild_id) && $guild_id > 0) ? $guild_rank : "N/A";?><br>
                    Guild Banker: <?echo (isset($guild_id) && $guild_id > 0) ? $yesno[$guild_banker] : "N/A";?><br>
                  </fieldset>
                  <fieldset>
                    <legend><strong>Vitals</strong></legend>
                    HP: <?=$cur_hp?><br>
                    Mana: <?=$mana?><br>
                    Endurance: <?=$endurance?><br>
                    Air: <?=$air_remaining?><br>
                    Hunger: <?=$hunger_level?><br>
                    Thirst: <?=$thirst_level?><br>
                  </fieldset>
                  <fieldset>
                    <legend><strong>Consent Info</strong></legend>
                    Group Consent: <?=$yesno[$group_auto_consent]?><br>
                    Raid Consent: <?=$yesno[$raid_auto_consent]?><br>
                    Guild Consent: <?=$yesno[$guild_auto_consent]?><br>
                  </fieldset>
                  <fieldset>
                    <legend><strong>Other Info</strong></legend>
                    Birth: <?=get_real_time($birthday)?><br>
                    Deleted: <?echo (stripos($name, "-deleted-")) ? "<a href='index.php?editor=player&playerid=" . $id . "&action=7' onClick='return confirm(\"Are you sure you want to undelete this player? You should verify there are enough free slots on the account before proceeding.\")'>" . $deleted_at . "</a>" : "N/A";?><br>
                    Anonymous: <?=$anonymity[$anon]?><br>
                    LFG: <?=$yesno[$lfg]?><br>
                    LFP: <?=$yesno[$lfp]?><br>
                    Drunkness: <?=$intoxication?><br>
                    Toxicity: <?=$toxicity?><br>
                    Autosplit: <?=$yesno[$autosplit_enabled]?><br>
                    Exp Enabled: <?=$yesno[$exp_enabled]?> [<a href="index.php?editor=player&playerid=<?=$id?>&action=12">Change</a>]
                  </fieldset>
                </td>
              </tr>
            </table>
          </td>
          <td>
            <table cellspacing="0" border="0" width="100%">
              <tr>
                <td>
                  <fieldset>
                    <legend><strong>Basic Info</strong></legend>
                    <table width="100%" border="0" cellpadding="3" cellspacing="0">
                      <tr>
                        <td align="left">Level: <?=$level?></td>
                        <td align="left">Class: <?=$classes[$class]?></td>
                      </tr>
                      <tr>
                        <td align="left">Race: <?=$races[$race]?></td>
                        <td align="left">Deity: <?=$deities[$deity]?></td>
                      </tr>
                      <tr>
                        <td>Experience: <?=$exp?><br></td>
                        <td>Practice Points: <?=$points?></td>
                      </tr>
                    </table>
                  </fieldset>
                </td>
                <td>
                  <fieldset>
                    <legend><strong>Stats</strong></legend>
                    <table width="100%" border="0" cellpadding="3" cellspacing="0">
                        <tr>
                          <td align="left" width="33%">STR: <?=$str?></td>
                          <td align="left" width="33%">STA: <?=$sta?></td>
                          <td align="left" width="34%">DEX: <?=$dex?></td>
                        </tr>
                        <tr>
                          <td align="left" width="33%">AGI: <?=$agi?></td>
                          <td align="left" width="33%">INT: <?=$int?></td>
                          <td align="left" width="34%">WIS: <?=$wis?></td>
                        </tr>
                        <tr>
                          <td align="left" width="33%">CHA: <?=$cha?></td>
                          <td align="left" width="33%">&nbsp;</td>
                          <td align="left" width="34%">&nbsp;</td>
                        </tr>
                      </table>
                  </fieldset>
                </td>
              </tr>
              <tr>
                <td colspan="2">
                  <fieldset>
                    <legend><strong>Appearance</strong></legend>
                    <table width="100%" border="0" cellpadding="3" cellspacing="0">
                      <tr>
                        <td align="left" width="33%">Gender: <?=$genders[$gender]?></td>
                        <td align="left" width="33%">Hair Style: <?=$hair_style?></td>
                        <td align="left" width="34%">Hair Color: <?=$hair_color?></td> 
                      </tr>
                      <tr>
                        <td align="left" width="33%">Face: <?=$face?></td>
                        <td align="left" width="33%">Left Eye Color: <?=$eye_color_1?></td>
                        <td align="left" width="34%">Right Eye Color: <?=$eye_color_2?></td>
                      </tr>
                      <tr>
                        <td align="left" width="33%">Beard: <?=$beard?></td>
                        <td align="left" width="33%">Beard Color: <?=$beard_color?></td>
                        <td align="left" width="34%">Show Helm: <?=$yesno[$show_helm]?></td>
                      </tr>
                      <tr>
                        <td align="left" width="33%">Drakkin Heritage: <?=$drakkin_heritage?></td>
                        <td align="left" width="33%">Drakkin Tattoo: <?=$drakkin_tattoo?></td>
                        <td align="left" width="34%">Drakkin Details: <?=$drakkin_details?></td>
                      </tr>
                    </table>
                  </fieldset>
                </td>
              </tr>
              <tr>
                <td colspan="2">
                  <fieldset>
                    <legend><strong>Cash</strong></legend>
                    <table width="100%" border="0" cellpadding="3" cellspacing="0">
                      <tr>
                        <td width="25%"><u>Body</u></td>
                        <td width="25%"><u>Cursor</u></td>
                        <td width="25%"><u>Bank</u></td>
                        <td width="25%"><u>Shared</u></td>
                      </tr>
                      <tr>
                        <td>Platinum: <?=$currency['platinum']?></td>
                        <td>Platinum: <?=$currency['platinum_cursor']?></td>
                        <td>Platinum: <?=$currency['platinum_bank']?></td>
                        <td>Platinum: <?=$sharedplat?></td>
                      </tr>
                      <tr>
                        <td>Gold: <?=$currency['gold']?></td>
                        <td>Gold: <?=$currency['gold_cursor']?></td>
                        <td>Gold: <?=$currency['gold_bank']?></td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td>Silver: <?=$currency['silver']?></td>
                        <td>Silver: <?=$currency['silver_cursor']?></td>
                        <td>Silver: <?=$currency['silver_bank']?></td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td>Copper: <?=$currency['copper']?></td>
                        <td>Copper: <?=$currency['copper_cursor']?></td>
                        <td>Copper: <?=$currency['copper_bank']?></td>
                        <td>&nbsp;</td>
                      </tr>
                    </table>
                  </fieldset>
                </td>
              </tr>
              <tr>
                <td>
                  <fieldset>
                    <legend><strong>LDoN Stats</strong></legend>
                    <table width="100%" border="0" cellpadding="3" cellspacing="0">
                      <tr>
                        <td width="25%">&nbsp;</td>
                        <td align="center" width="25%"><u>Points</u></td>
                        <td align="center" width="25%"><u>Wins</u></td>
                        <td align="center" width="25%"><u>Losses</u></td>
                      </tr>
                      <tr>
                        <td align="center" width="25%">GUK:</td>
                        <td align="center" width="25%"><?=$ldon_points_guk?></td>
                        <td align="center" width="25%"><?echo (isset($guk_wins)) ? $guk_wins : 0;?></td>
                        <td align="center" width="25%"><?echo (isset($guk_losses)) ? $guk_losses : 0;?></td>
                      </tr>
                      <tr>
                        <td align="center" width="25%">MIR:</td>
                        <td align="center" width="25%"><?=$ldon_points_mir?></td>
                        <td align="center" width="25%"><?echo (isset($mir_wins)) ? $mir_wins : 0;?></td>
                        <td align="center" width="25%"><?echo (isset($mir_losses)) ? $mir_losses : 0;?></td>
                      </tr>
                      <tr>
                        <td align="center" width="25%">MMC:</td>
                        <td align="center" width="25%"><?=$ldon_points_mmc?></td>
                        <td align="center" width="25%"><?echo (isset($mmc_wins)) ? $mmc_wins : 0;?></td>
                        <td align="center" width="25%"><?echo (isset($mmc_losses)) ? $mmc_losses : 0;?></td>
                      </tr>
                      <tr>
                        <td align="center" width="25%">RUJ:</td>
                        <td align="center" width="25%"><?=$ldon_points_ruj?></td>
                        <td align="center" width="25%"><?echo (isset($ruj_wins)) ? $ruj_wins : 0;?></td>
                        <td align="center" width="25%"><?echo (isset($ruj_losses)) ? $ruj_losses : 0;?></td>
                      </tr>
                      <tr>
                        <td align="center" width="25%">TAK:</td>
                        <td align="center" width="25%"><?=$ldon_points_tak?></td>
                        <td align="center" width="25%"><?echo (isset($tak_wins)) ? $tak_wins : 0;?></td>
                        <td align="center" width="25%"><?echo (isset($tak_losses)) ? $tak_losses : 0;?></td>
                      </tr>
                      <tr>
                        <td colspan="4">&nbsp;</td>
                      </tr>
                      <tr>
                        <td align="center" colspan="4">Available Points: <?=$ldon_points_available?></td>
                      </tr>
                    </table>
                  </fieldset>
                </td>
                <td>
                  <fieldset>
                    <legend><strong>DoN Crystals</strong></legend>
                    <table width="100%" border="0" cellpadding="4" cellspacing="0">
                      <tr>
                        <td align="center" width="33%">&nbsp;</td>
                        <td align="center" width="33%"><u>Radiant</u></td>
                        <td align="center" width="33%"><u>Ebon</u></td>
                      </tr>
                      <tr>
                        <td align="center" width="33%">Current:</td>
                        <td align="center" width="33%"><?=$currency['radiant_crystals']?></td>
                        <td align="center" width="33%"><?=$currency['ebon_crystals']?></td>
                      </tr>
                      <tr>
                        <td align="center" width="33%">Total:</td>
                        <td align="center" width="33%"><?=$currency['career_radiant_crystals']?></td>
                        <td align="center" width="33%"><?=$currency['career_ebon_crystals']?></td>
                      </tr>
                    </table>
                  </fieldset>
                  <fieldset>
                    <legend><strong>Tribute</strong></legend>
                    <table width="100%" border="0" cellpadding="5" cellspacing="0">
                      <tr>
                        <td>Active: <?=$yesno[$tribute_active]?></td>
                        <td>Timer: <?echo ($tribute_time_remaining == -1) ? "Off" : $tribute_time_remaining;?></td>
                      </tr>
                      <tr>
                        <td>Points: <?=$tribute_points?></td>
                        <td>Total: <?=$career_tribute_points?></td>
                      </tr>
                    </table>
                  </fieldset>
                </td>
              </tr>
              <tr>
                <td colspan="2">
                  <fieldset>
                    <legend><strong>PVP Info</strong></legend>
                    <table width="100%" border="0" cellpadding="3" cellspacing="0">
                      <tr>
                        <td>PVP: <?=$yesno[$pvp_status]?></td>
                        <td>PVP2: <?=$yesno[$pvp2]?></td>
                        <td>PVP Kills: <?=$pvp_kills?></td>
                        <td>PVP Deaths: <?=$pvp_deaths?></td>
                      </tr>
                      <tr>
                        <td colspan="2">PVP Type: <?=$pvp_type?></td>
                        <td>Kill Streak: <?=$pvp_best_kill_streak?></td>
                        <td>Death Streak: <?=$pvp_worst_death_streak?></td>
                      </tr>
                      <tr>
                        <td colspan="2">Available PVP Points: <a href="index.php?editor=pvp&playerid=<?=$id?>&action=3"><?=$pvp_current_points?></a></td>
                        <td colspan="2">Current Kill Streak: <?=$pvp_current_kill_streak?></td>
                      </tr>
                      <tr>
                        <td colspan="2">Total PVP Points: <?=$pvp_career_points?></td>
                        <td colspan="2">&nbsp;</td>
                      </tr>
                    </table>
                  </fieldset>
                </td>
              </tr>
              <tr>
                <td>
                  <fieldset>
                    <legend><strong>Alternate Advancement</strong></legend>
                    <table width="100%" border="0" cellpadding="3" cellspacing="0">
                      <tr>
                        <td>AA Exp: <?=$aa_exp?></td>
                      </tr>
                      <tr>
                        <td>AA Points: <?=$aa_points?></td>
                      </tr>
                      <tr>
                        <td>AA Spent: <?=$aa_points_spent?></td>
                      </tr>
                    </table>
                  </fieldset>
                </td>
                <td>
                  <fieldset>
                    <legend><strong>Leadership AA</strong></legend>
                    <table width="100%" border="0" cellpadding="3" cellspacing="0">
                      <tr>
                        <td colspan="2">Leader AA Active: <?=$yesno[$leadership_exp_on]?></td>
                      </tr>
                      <tr>
                        <td>Group Exp: <?=$group_leadership_exp?></td>
                        <td>Raid Exp: <?=$raid_leadership_exp?></td>
                      </tr>
                      <tr>
                        <td>Group Points: <?=$group_leadership_points?></td>
                        <td>Raid Points: <?=$raid_leadership_points?></td>
                      </tr>
                    </table>
                  </fieldset>
                </td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td>
            <fieldset>
              <legend><strong>Auras</strong></legend>
<?if ($auras):?>
              <table cellspacing="0" cellpadding="0" border="0" width="100%">
                <tr>
                  <td align="center"><u>Slot</u></td>
                  <td align="center"><u>Spell</u></td>
                </tr>
<?foreach ($auras as $aura):?>
                <tr>
                  <td align="center"><?=$aura['slot']?></td>
                  <td align="center"><a title="<?=getSpellName($aura['spell_id'])?>"><?=$aura['spell_id']?></a></td>
                </tr>
<?endforeach;?>
              </table>
<?else:?>
              None
<?endif;?>
            </fieldset>
          </td>
          <td>
            <fieldset>
              <legend><strong>Bind Points</strong></legend>
<?
  if (isset($binds)):
?>
              <table width="100%" cellpadding="3" cellspacing="0">
                <tr>
                  <td align="center"><u>Slot</u></td>
                  <td align="center"><u>Zone</u></td>
                  <td align="center"><u>Instance</u></td>
                  <td align="center"><u>X</u></td>
                  <td align="center"><u>Y</u></td>
                  <td align="center"><u>Z</u></td>
                  <td align="center"><u>Heading</u></td>
                </tr>
<?
    foreach ($binds as $bind):
?>
                <tr>
                  <td align="center"><?=$bind_slots[$bind['slot']]?> (<?=$bind['slot']?>)</td>
                  <td align="center"><?=getZoneName($bind['zone_id'])?> (<?=$bind['zone_id']?>)</td>
                  <td align="center"><?=$bind['instance_id']?></td>
                  <td align="center"><?=$bind['x']?></td>
                  <td align="center"><?=$bind['y']?></td>
                  <td align="center"><?=$bind['z']?></td>
                  <td align="center"><?=$bind['heading']?></td>
                </tr>
<?
    endforeach;
?>
              </table>
<?
  else:
?>
              No Bind Points
<?
  endif;
?>
            </fieldset>
          </td>
        </tr>
        <tr>
          <td colspan="2">
            <fieldset>
              <legend><strong>Bandoliers</strong></legend>
<?if ($bandolier):?>
              <table width="100%" cellpadding="0" cellspacing="0">
                <tr>
                  <td><u>ID</u></td>
                  <td><u>Name</u></td>
                  <td><u>Slot</u></td>
                  <td><u>Item</u></td>
                  <td><u>Icon</u></td>
                </tr>
<?foreach ($bandolier as $bd):?>
                <tr>
                  <td><?=$bd['bandolier_id']?></td>
                  <td><?=$bd['bandolier_name']?></td>
                  <td><?=$bd['bandolier_slot']?></td>
                  <td><?=get_item_name($bd['item_id'])?> (<?=$bd['item_id']?>) - [<a href="https://lucy.allakhazam.com/item.html?id=<?=$bd['item_id']?>" target="_blank">Lucy</a>]</td>
                  <td><?=$bd['icon']?></td>
                </tr>
<?endforeach;?>
              </table>
<?else:?>
              None
<?endif;?>
            </fieldset>
          </td>
        </tr>
        <tr>
          <td colspan="2">
            <fieldset>
              <legend><strong>Inspect Message</strong></legend>
              <?echo (isset($inspect_message)) ? $inspect_message : "None";?>
            </fieldset>
          </td>
        </tr>
        <tr>
          <td colspan="2">
            <fieldset>
              <legend><strong>Skills</strong></legend>
              <table width="100%">
                <tr>
                  <td width="60%">
                    <fieldset>
                      <legend><strong>Abilities</strong></legend>
                      <table width="100%">
                        <tr>
                          <td width="50%">
<?
  for ($x = 0; $x <= 3; $x++) {
    echo $x . " - " . $skilltypes[$x] . ": " . (isset($skills[$x]) ? $skills[$x] : 0) . "<br>";
  }
  for ($x = 6; $x <= 11; $x++) {
    echo $x . " - " . $skilltypes[$x] . ": " . (isset($skills[$x]) ? $skills[$x] : 0) . "<br>";
  }
  for ($x = 15; $x <= 17; $x++) {
    echo $x . " - " . $skilltypes[$x] . ": " . (isset($skills[$x]) ? $skills[$x] : 0) . "<br>";
  }
  for ($x = 19; $x <= 23; $x++) {
    echo $x . " - " . $skilltypes[$x] . ": " . (isset($skills[$x]) ? $skills[$x] : 0) . "<br>";
  }
  for ($x = 25; $x <= 30; $x++) {
    echo $x . " - " . $skilltypes[$x] . ": " . (isset($skills[$x]) ? $skills[$x] : 0) . "<br>";
  }
  echo "32 - " . $skilltypes[32] . ": " . (isset($skills[32]) ? $skills[32] : 0) . "<br>";
?>
                          </td>
                          <td width="50%" valign="top">
<?
  for ($x = 33; $x <= 40; $x++) {
    echo $x . " - " . $skilltypes[$x] . ": " . (isset($skills[$x]) ? $skills[$x] : 0) . "<br>";
  }
  echo "48 - " . $skilltypes[48] . ": " . (isset($skills[48]) ? $skills[48] : 0) . "<br>";
  for ($x = 50; $x <= 53; $x++) {
    echo $x . " - " . $skilltypes[$x] . ": " . (isset($skills[$x]) ? $skills[$x] : 0) . "<br>";
  }
  echo "55 - " . $skilltypes[55] . ": " . (isset($skills[55]) ? $skills[55] : 0) . "<br>";
  echo "62 - " . $skilltypes[62] . ": " . (isset($skills[62]) ? $skills[62] : 0) . "<br>";
  for ($x = 66; $x <= 67; $x++) {
    echo $x . " - " . $skilltypes[$x] . ": " . (isset($skills[$x]) ? $skills[$x] : 0) . "<br>";
  }
  for ($x = 71; $x <= 77; $x++) {
    echo $x . " - " . $skilltypes[$x] . ": " . (isset($skills[$x]) ? $skills[$x] : 0) . "<br>";
  }
?>
                          </td>
                        </tr>
                      </table>
                    </fieldset><br>
                    <fieldset>
                      <legend><strong>Magic/Music</strong></legend>
                      <table width="100%">
                        <tr>
                          <td width="50%">
<?
  echo "4 - " . $skilltypes[4] . ": " . (isset($skills[4]) ? $skills[4] : 0) . "<br>";
  echo "5 - " . $skilltypes[5] . ": " . (isset($skills[5]) ? $skills[5] : 0) . "<br>";
  echo "13 - " . $skilltypes[13] . ": " . (isset($skills[13]) ? $skills[13] : 0) . "<br>";
  echo "14 - " . $skilltypes[14] . ": " . (isset($skills[14]) ? $skills[14] : 0) . "<br>";
  echo "18 - " . $skilltypes[18] . ": " . (isset($skills[18]) ? $skills[18] : 0) . "<br>";
  echo "24 - " . $skilltypes[24] . ": " . (isset($skills[24]) ? $skills[24] : 0) . "<br>";
  echo "31 - " . $skilltypes[31] . ": " . (isset($skills[31]) ? $skills[31] : 0) . "<br>";
  for ($x = 43; $x <= 47; $x++) {
    echo $x . " - " . $skilltypes[$x] . ": " . (isset($skills[$x]) ? $skills[$x] : 0) . "<br>";
  }
?>
                          </td>
                          <td width="50%" valign="top">
<?
  echo "12 - " . $skilltypes[12] . ": " . (isset($skills[12]) ? $skills[12] : 0) . "<br>";
  echo "41 - " . $skilltypes[41] . ": " . (isset($skills[41]) ? $skills[41] : 0) . "<br>";
  echo "49 - " . $skilltypes[49] . ": " . (isset($skills[49]) ? $skills[49] : 0) . "<br>";
  echo "54 - " . $skilltypes[54] . ": " . (isset($skills[54]) ? $skills[54] : 0) . "<br>";
  echo "70 - " . $skilltypes[70] . ": " . (isset($skills[70]) ? $skills[70] : 0) . "<br>";
?>
                          </td>
                        </tr>
                      </table>
                    </fieldset>
                  </td>
                  <td width="40%">
                    <fieldset>
                      <legend><strong>Languages</strong></legend>
<?
  for ($x = 0; $x <= 27; $x++) {
    echo $x . " - " . $langtypes[$x] . ": " . (isset($languages[$x]) ? $languages[$x] : 0) . "<br>";
  }
?>
                    </fieldset><br>
                    <fieldset>
                      <legend><strong>Tradeskills</strong></legend>
<?
  for ($x = 56; $x <= 61; $x++) {
    echo $x . " - " . $skilltypes[$x] . ": " . (isset($skills[$x]) ? $skills[$x] : 0) . "<br>";
  }
  for ($x = 63; $x <= 65; $x++) {
    echo $x . " - " . $skilltypes[$x] . ": " . (isset($skills[$x]) ? $skills[$x] : 0) . "<br>";
  }
  for ($x = 68; $x <= 69; $x++) {
    echo $x . " - " . $skilltypes[$x] . ": " . (isset($skills[$x]) ? $skills[$x] : 0) . "<br>";
  }
?>
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
              <legend><strong>Modifiers</strong></legend>
              <table width="100%">
                <tr>
                  <td width="50%">
                    <fieldset>
                      <legend><strong>Experience Mods</strong> (<a href="index.php?editor=player&playerid=<?=$playerid?>&action=8">Add</a>)</legend>
<?if (isset($exp_mods)):?>
                        <table width="100%">
                          <tr>
                            <td align="center"><u>Zone</u></td>
                            <td align="center"><u>Version</u></td>
                            <td align="center"><u>Base EXP Mod</u></td>
                            <td align="center"><u>AA EXP Mod</u></td>
                            <td align="center">&nbsp;</td>
                          </tr>
<?  foreach ($exp_mods as $exp_mod):?>
                          <tr>
                            <td align="center"><?=$exp_mod['zone_id'] == 0 ? "Global" : getZoneName($exp_mod['zone_id'])?> (<?=$exp_mod['zone_id']?>)</td>
                            <td align="center"><?echo ($exp_mod['instance_version'] == -1) ? "All (-1)" : $exp_mod['instance_version'];?></td>
                            <td align="center"><?=$exp_mod['exp_modifier']?></td>
                            <td align="center"><?=$exp_mod['aa_modifier']?></td>
                            <td align="center">
                              <?echo ($exp_mod['exp_modifier'] == 0 && $exp_mod['aa_modifier'] == 0) ? "<img src='images\caution.gif' width='13' title='Zero values have no effect'>&nbsp;" : "";?>
                              <a href="index.php?editor=player&playerid=<?=$exp_mod['character_id']?>&zoneid=<?=$exp_mod['zone_id']?>&instance_version=<?=$exp_mod['instance_version']?>&action=9"><img src="images/edit2.gif" width="13"></a>&nbsp;
                              <a href="index.php?editor=player&playerid=<?=$exp_mod['character_id']?>&zoneid=<?=$exp_mod['zone_id']?>&instance_version=<?=$exp_mod['instance_version']?>&action=11"><img src="images/delete.gif" width="13"></a>
                            </td>
                          </tr>
<?  endforeach;?>
                        </table>
<?else:?>
                        None
<?endif;?>
                    </fieldset>
                  </td>
                  <td width="50%">&nbsp;</td>
                </tr>
              </table>
            </fieldset>
          </td>
        </tr>
      </table>
    </div>
  </div>
