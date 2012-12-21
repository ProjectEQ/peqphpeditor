<div class="table_container">
  <div class="table_header">
    <div style="float:right">
      <a href="index.php?editor=player&playerid=<?=$playerid?>&action=5">View Raw Profile Data</a>&nbsp;
      <a onClick="javascript:alert('Not yet!');"><img src="images/c_table.gif" border="0" title="Edit this Player" /></a>
      <a onClick="return confirm('Really delete player <?=trim($name)?> (<?=$playerid?>)?');" href="index.php?editor=player&playerid=<?=$playerid?>&action=4"><img src="images/table.gif" border="0" title="Delete this Player" /></a>
    </div>
    <?=$id?> - <?echo trim($title) . " " . trim($name) . " " . trim($last_name) . " " . trim($suffix);?>
  </div>
  <div class="table_content">
    <?if ($online) echo "<h2><center><font color='red'>WARNING! THIS PLAYER IS ONLINE... (" . $entityid . ")</font></center></h2>";?>
    <table cellspacing="0" border="0" width="100%">
      <tr>
        <td width="30%">
          <table cellspacing="0" border="0" width="100%">
            <tr>
              <td>
                <fieldset>
                  <legend><strong>Character Name</strong></legend>
                  First Name: <?=trim($name)?><br />
                  Last Name: <?=trim($last_name)?><br />
                  Title: <?=trim($title)?><br />
                  Suffix: <?=trim($suffix)?><br />
                </fieldset>
                <fieldset>
                  <legend><strong>Account Info</strong></legend>
                  Account ID: <a href="index.php?editor=account&acctid=<?=$account_id?>"><?=$account_id?></a><br />
                  Character ID: <?=$id?><br />
                  Entity ID: <?=$entityid?><br />
                  LS Name: <a href="index.php?editor=account&acctid=<?=$account_id?>"><?=$lsname?></a><br />
                  LS ID: <?=$lsaccount?><br />
                  Last On: <?=get_real_time($timelaston)?><br />
                  Last Zone: <?=get_real_time($lastzone)?><br />
                  Time Played: <?=$timeplayed?> minutes<br />
                  GM: <?=$yesno[$gm]?><br />
                  Status: <?=$status?><br />
                </fieldset>
                <fieldset>
                  <legend><strong>Location Info</strong></legend>
                  Zone: <?=$zonename?> (<?=$zone_id?>)<br />
                  Instance: <?=($instanceid > 0 ? $instanceid : "None");?><br />
                  X: <?=$x?><br />
                  Y: <?=$y?><br />
                  Z: <?=$z?><br />
                  Heading: <?=$heading?><br />
                </fieldset>
                <fieldset>
                  <legend><strong>Guild Info</strong></legend>
                  Guild: <?=(($guild_id == -1) ? "None" : '<a href="index.php?editor=guild&guildid=' . $guild_id . '">' . getGuildName($guild_id)) . '</a>';?><br />
                  Guild Rank: <?=$guildrank?><br />
                  Guild Banker: <?=$yesno[$guildbanker]?><br />
                </fieldset>
                <fieldset>
                  <legend><strong>Vitals</strong></legend>
                  HP: <?=$hp?><br />
                  Mana: <?=$mana?><br />
                  Endurance: <?=$endurance?><br />
                  Air: <?=$air?><br />
                  Hunger: <?=$hunger?><br />
                  Thirst: <?=$thirst?><br />
                </fieldset>
                <fieldset>
                  <legend><strong>Consent Info</strong></legend>
                  Group Consent: <?=$yesno[$group_consent]?><br />
                  Raid Consent: <?=$yesno[$raid_consent]?><br />
                  Guild Consent: <?=$yesno[$guild_consent]?><br />
                </fieldset>
                <fieldset>
                  <legend><strong>Other Info</strong></legend>
                  Birth: <?=get_real_time($birthday)?><br />
                  Anonymous: <?=$anonymity[$anon]?><br />
                  LFG: <?=$yesno[$lfg]?><br />
                  LFP: <?=$yesno[$lfp]?><br />
                  Group ID: <?=$groupid?><br />
                  Drunkness: <?=$drunk?><br />
                  Toxicity: <?=$toxicity?><br />
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
                  <table width="100%" border="0" cellpadding="3" cellsapcing="0">
                    <tr>
                      <td align="left">Level: <?=$level?></td>
                      <td align="left">Class: <?=$classes[$class]?></td>
                    </tr>
                    <tr>
                      <td align="left">Race: <?=$races[$race]?></td>
                      <td align="left">Deity: <?=$deities[$deity]?></td>
                    </tr>
                    <tr>
                      <td>Experience: <?=$exp?><br /></td>
                      <td>Practice Points: <?=$practice?></td>
                    </tr>
                  </table>
                </fieldset>
              </td>
              <td>
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
              </td>
            </tr>
            <tr>
              <td colspan="2">
                <fieldset>
                  <legend><strong>Appearance</strong></legend>
                  <table width="100%" border="0" cellpadding="3" cellspacing="0">
                    <tr>
                      <td align="left" width="33%">Gender: <?=$genders[$gender]?></td>
                      <td align="left" width="33%">Hair Style: <?=$hairstyle?></td>
                      <td align="left" width="34%">Hair Color: <?=$haircolor?></td> 
                    </tr>
                    <tr>
                      <td align="left" width="33%">Face: <?=$face?></td>
                      <td align="left" width="33%">Left Eye Color: <?=$lefteye?></td>
                      <td align="left" width="34%">Right Eye Color: <?=$righteye?></td>
                    </tr>
                    <tr>
                      <td align="left" width="33%">Beard: <?=$beard?></td>
                      <td align="left" width="33%">Beard Color: <?=$beardcolor?></td>
                      <td align="left" width="34%">&nbsp;</td>
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
                    <tr>
                      <td>Platinum: <?=$platinum?></td>
                      <td>Platinum: <?=$platinum_hand?></td>
                      <td>Platinum: <?=$platinum_bank?></td>
                      <td>Platinum: <?=$platinum_shared?></td>
                    </tr>
                    <tr>
                      <td>Gold: <?=$gold?></td>
                      <td>Gold: <?=$gold_hand?></td>
                      <td>Gold: <?=$gold_bank?></td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>Silver: <?=$silver?></td>
                      <td>Silver: <?=$silver_hand?></td>
                      <td>Silver: <?=$silver_bank?></td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>Copper: <?=$copper?></td>
                      <td>Copper: <?=$copper_hand?></td>
                      <td>Copper: <?=$copper_bank?></td>
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
                  <table width="100%" border="0" cellpadding="2.5" cellspacing="0">
                    <tr>
                      <td width="25%">&nbsp;</td>
                      <td align="center" width="25%"><u>Points</u></td>
                      <td align="center" width="25%"><u>Wins</u></td>
                      <td align="center" width="25%"><u>Losses</u><td>
                    </tr>
                    <tr>
                      <td align="center" width="25%">GUK:</td>
                      <td align="center" width="25%"><?=$guk_points?></td>
                      <td align="center" width="25%"><?=$guk_wins?></td>
                      <td align="center" width="25%"><?=$guk_losses?></td>
                    </tr>
                    <tr>
                      <td align="center" width="25%">MIR:</td>
                      <td align="center" width="25%"><?=$mir_points?></td>
                      <td align="center" width="25%"><?=$mir_wins?></td>
                      <td align="center" width="25%"><?=$mir_losses?></td>
                    </tr>
                    <tr>
                      <td align="center" width="25%">MMC:</td>
                      <td align="center" width="25%"><?=$mmc_points?></td>
                      <td align="center" width="25%"><?=$mmc_wins?></td>
                      <td align="center" width="25%"><?=$mmc_losses?></td>
                    </tr>
                    <tr>
                      <td align="center" width="25%">RUJ:</td>
                      <td align="center" width="25%"><?=$ruj_points?></td>
                      <td align="center" width="25%"><?=$ruj_wins?></td>
                      <td align="center" width="25%"><?=$ruj_losses?></td>
                    </tr>
                    <tr>
                      <td align="center" width="25%">TAK:</td>
                      <td align="center" width="25%"><?=$tak_points?></td>
                      <td align="center" width="25%"><?=$tak_wins?></td>
                      <td align="center" width="25%"><?=$tak_losses?></td>
                    </tr>
                    <tr>
                      <td colspan="4">&nbsp;</td>
                    </tr>
                    <tr>
                      <td align="center" colspan="4">Available Points: <?=$avail_points?></td>
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
                      <td align="center" width="33%"><?=$radiant_crystals?></td>
                      <td align="center" width="33%"><?=$ebon_crystals?></td>
                    </tr>
                    <tr>
                      <td align="center" width="33%">Total:</td>
                      <td align="center" width="33%"><?=$radiant_total?></td>
                      <td align="center" width="33%"><?=$ebon_total?></td>
                    </tr>
                  </table>
                </fieldset>
                <fieldset>
                  <legend><strong>Tribute</strong></legend>
                  <table width="100%" border="0" cellpadding="5" cellspacing="0">
                    <tr>
                      <td>Active: <?=$yesno[$tribute_active]?></td>
                      <td>Timer: <?=($tribute_timer == -1 ? "Off" : $tribute_timer);?></td>
                    </tr>
                    <tr>
                      <td>Points: <?=$tribute_points?></td>
                      <td>Total: <?=$tribute_total?></td>
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
                      <td>PVP: <?=$yesno[$pvp]?></td>
                      <td>PVP2: <?=$yesno[$pvp2]?></td>
                      <td>PVP Kills: <?=$pvp_kills?></td>
                      <td>PVP Deaths: <?=$pvp_deaths?></td>
                    </tr>
                    <tr>
                      <td colspan="2">PVP Type: <?=$pvptype?></td>
                      <td>Kill Streak: <?=$pvp_killstreak_max?></td>
                      <td>Death Streak: <?=$pvp_deathstreak_max?></td>
                    </tr>
                    <tr>
                      <td colspan="2">Available PVP Points: <?=$pvp_points?></td>
                      <td colspan="2">Current Kill Streak: <?=$pvp_killstreak_now?></td>
                    </tr>
                    <tr>
                      <td colspan="2">Total PVP Points: <?=$pvp_total?></td>
                      <td colspan="2">Kills Today: <?=$pvp_kills_today?></td>
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
                      <td>AA Spent: <?=$aa_spent?></td>
                    </tr>
                  </table>
                </fieldset>
              </td>
              <td>
                <fieldset>
                  <legend><strong>Leadership AA</strong></legend>
                  <table width="100%" border="0" cellpadding="3" cellspacing="0">
                    <tr>
                      <td colspan="2">Leader AA Active: <?=$yesno[$leader_aa_active]?></td>
                    </tr>
                    <tr>
                      <td>Group Exp: <?=$group_exp?></td>
                      <td>Raid Exp: <?=$raid_exp?></td>
                    </tr>
                    <tr>
                      <td>Group Points: <?=$group_points?></td>
                      <td>Raid Points: <?=$raid_points?></td>
                    </tr>
                  </table>
                </fieldset>
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td colspan="3">
          <fieldset>
            <legend><strong>Inspect Message</strong></legend>
            <?echo ($inspectmessage) ? $inspectmessage : "None";?>
          </fieldset>
        </td>
      </tr>
    </table>
  </div>
</div>
