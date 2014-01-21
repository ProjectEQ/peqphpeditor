    <div class="table_container">
      <div class="table_header">
        <div style="float:right">
          <a href="index.php?editor=zone&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&action=8"><img src="images/add.gif" border="0" title="Add a graveyard to <?=$short_name?>"></a>
          <a href="index.php?editor=zone&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&action=2"><img src="images/c_table.gif" border=0 title="Edit this Zone"></a>
          <a onClick="return confirm('Really Copy Zone <?=$currzone?>?');" href="index.php?editor=zone&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&action=24"><img src="images/next.gif" border=0 title="Copy this Zone"></a>
<?if($version > 0):?>
          <a onClick="return confirm('Really Delete Zone <?=$currzone?>?');" href="index.php?editor=zone&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&action=25"><img src="images/remove2.gif" border=0 title="Delete this Zone"></a>
<?endif;?>
        </div>
        <?=$zoneidnumber?> - <?=$long_name?> <?echo ($short_name != '' ? "($short_name)" : '');?>
      </div>
      <div class="table_content">
        <table cellspacing="0" border="0" width="100%">
          <tr>
            <td>
              <center>
                <h1>
                  <?=$long_name?><br>
                  (<?echo ($short_name != '' ? "$short_name" : 'no title');?>)
                </h1>
                <table style="font-size: 12px; margin-bottom: 80px;">
                  <tr>
                    <td>
                      <center>
                        <strong><?=$eqexpansions[$expansion]?></strong><br>
                        <strong><?=$zonetype[$type]?></strong><br><br>
                      </center>
                      <strong>Map:</strong> <?=$map_file_name?><br>
                      <strong>File:</strong> <?=$file_name?><br>
                      <strong>Safe X:</strong> <?=$safe_x?><br>
                      <strong>Safe Y:</strong> <?=$safe_y?><br>
                      <strong>Safe Z:</strong> <?=$safe_z?>
                    </td>
                  </tr>
                </table>
              </center>
            </td>
            <td>
              <fieldset>
                <legend><strong>General</strong></legend>
                <table width="100%" border="0" cellpadding="3" cellspacing="0">
                  <tr>
<?if($graveyard_id > 0):?>  
                    <td align="left" width="33%">Graveyard: <a href="index.php?editor=zone&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&graveyard_id=<?=$graveyard_id?>&action=4"> <?=$graveyard_id?></td>
<?endif;?> 
<?if($graveyard_id < 1):?>
                    <td align="left" width="33%">Graveyard: <?=$graveyard_id?></td>
<?endif;?>
                    <td align="left" width="33%">Timezone: <?=$timezone?></td>
                    <td align="left" width="34%">Time Type: <?=$time_type?></td>
                  </tr>
                  <tr>
                    <td align="left" width="33%">Hotzone: <?=$yesno[$hotzone]?></td>
                    <td align="left" width="33%">Shutdown: <?=$shutdowndelay?></td>
                    <td align="left" width="34%">Underworld: <?=$underworld?></td>
                  </tr>
                  <tr>
                    <td align="left" width="33%">Zone Type: <?=$ztype?></td>
                    <td align="left" width="33%">Exp: <?=$zone_exp_multiplier?></td>
                    <td align="left" width="34%">Walkspeed: <?=$walkspeed?></td>
                  </tr>
                  <tr>
                    <td align="left" width="33%">Version: <?=$version?></td>
                    <td align="left" width="33%">Ruleset: <a href="index.php?editor=server&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&ruleset_id=<?=$ruleset?>&action=28"> <?=$ruleset?></td>
                    <td align="left" width="34%"></td>
                  </tr>
                  <tr>
                    <td align="left" width="33%">Note: <?=$note?></td>
                    <td align="left" width="33%">Global: <?=$yesno[$global]?></td>
                    <td align="left" width="34%">Suspend Buffs: <?=$yesno[$suspendbuffs]?></td>
                  </tr>
                </table>
              </fieldset>
              <fieldset>
                <legend><strong>Restrictions</strong></legend>
                <table width="100%" border="0" cellpadding="3" cellspacing="0">
                  <tr>
                    <td align="left" width="33%">Level: <?=$min_level?></td>
                    <td align="left" width="33%">Status: <?=$min_status?></td>
                    <td align="left" width="34%">Clients: <?=$maxclients?></td>
                  </tr>
                  <tr>
                    <td align="left" width="33%">Flag: <?echo ($flag_needed != "") ? $flag_needed : "No";?></td>
                    <td align="left" width="33%">Bind: <?=$bindallowed[$canbind]?></td>
                    <td align="left" width="34%">Levitate: <?=$yesno[$canlevitate]?></td>
                  </tr>
                  <tr>
                    <td align="left" width="33%">Outdoor: <?=$yesno[$castoutdoor]?></td>
                    <td align="left" width="33%">Combat: <?=$yesno[$cancombat]?></td>
                    <td align="left" width="34%">PEQZone: <?=$yesno[$peqzone]?></td>
                  </tr>
                </table>
              </fieldset>
              <fieldset>
                <legend><strong>Sky</strong></legend>
                <table width="100%" border="0" cellpadding="3" cellspacing="0">
                  <tr>
                    <td align="left" width="33%">Sky: <?=$sky?></td>
                    <td align="left" width="33%">Min Clip: <?=$minclip?></td>
                    <td align="left" width="34%">Max Clip: <?=$maxclip?></td>
                  </tr>
                  <tr>
                    <td align="left" width="33%">Fog Maxclip: <?=$fog_maxclip?></td>
                    <td align="left" width="33%">Fog Minclip: <?=$fog_minclip?></td>
                    <td align="left" width="34%">Fog Blue: <?=$fog_blue?></td>
                  </tr>
                  <tr>
                    <td align="left" width="33%">Fog Red: <?=$fog_red?></td>
                    <td align="left" width="33%">Fog Green: <?=$fog_green?></td>
                    <td align="left" width="34%">Fog Maxclip1: <?=$fog_maxclip1?></td>
                  </tr>
                  <tr>
                    <td align="left" width="33%">Fog Minclip1: <?=$fog_minclip1?></td>
                    <td align="left" width="33%">Fog Blue1: <?=$fog_blue1?></td>
                    <td align="left" width="34%">Fog Red1: <?=$fog_red1?></td>
                  </tr>
                  <tr>
                    <td align="left" width="33%">Fog Green1: <?=$fog_green1?></td>
                    <td align="left" width="33%">Fog Maxclip2: <?=$fog_maxclip2?></td>
                    <td align="left" width="34%">Fog Minclip2: <?=$fog_minclip1?></td>
                  </tr>
                  <tr>
                    <td align="left" width="33%">Fog Blue2: <?=$fog_blue2?></td>
                    <td align="left" width="33%">Fog Red2: <?=$fog_red2?></td>
                    <td align="left" width="34%">Fog Green: <?=$fog_green2?></td>
                  </tr>
                  <tr>
                    <td align="left" width="33%">Fog Maxclip3: <?=$fog_maxclip3?></td>
                    <td align="left" width="33%">Fog Minclip3: <?=$fog_minclip3?></td>
                    <td align="left" width="34%">Fog Blue3: <?=$fog_blue3?></td>
                  </tr>
                  <tr>
                    <td align="left" width="33%">Fog Red3: <?=$fog_red3?></td>
                    <td align="left" width="33%">Fog Green3: <?=$fog_green3?></td>
                    <td align="left" width="34%">Fog Maclip4: <?=$fog_maxclip4?></td>
                  </tr>
                  <tr>
                    <td align="left" width="33%">Fog Minclip4: <?=$fog_minclip4?></td>
                    <td align="left" width="33%">Fog Blue4: <?=$fog_blue4?></td>
                    <td align="left" width="34%">Fog Red4: <?=$fog_red4?></td>
                  </tr>
                  <tr>
                    <td align="left" width="33%">Fog Green4: <?=$fog_green4?></td>
                    <td align="left" width="33%">Fog Density: <?=$fog_density?></td>
                    <td align="left" width="34%">&nbsp;</td>
                  </tr>
                </table>
              </fieldset>
              <fieldset>
                <legend><strong>Weather</strong></legend>
                <table width="100%" border="0" cellpadding="3" cellspacing="0">
                  <tr>
                    <td align="left" width="25%">Rain C1: <?=$rain_chance1?></td>
                    <td align="left" width="25%">Rain C2: <?=$rain_chance2?></td>
                    <td align="left" width="25%">Rain C3: <?=$rain_chance3?></td>
                    <td align="left" width="25%">Rain C4: <?=$rain_chance4?></td>
                  </tr>
                  <tr>
                    <td align="left" width="25%">Rain D1: <?=$rain_duration1?></td>
                    <td align="left" width="25%">Rain D2: <?=$rain_duration2?></td>
                    <td align="left" width="25%">Rain D3: <?=$rain_duration3?></td>
                    <td align="left" width="25%">Rain D4: <?=$rain_duration4?></td>
                  </tr>
                  <tr>
                    <td align="left" width="25%">Snow C1: <?=$snow_chance1?></td>
                    <td align="left" width="25%">Snow C2: <?=$snow_chance2?></td>
                    <td align="left" width="25%">Snow C3: <?=$snow_chance3?></td>
                    <td align="left" width="25%">Snow C4: <?=$snow_chance4?></td>
                  </tr>
                  <tr>
                    <td align="left" width="25%">Snow D1: <?=$snow_duration1?></td>
                    <td align="left" width="25%">Snow D2: <?=$snow_duration2?></td>
                    <td align="left" width="25%">Snow D3: <?=$snow_duration3?></td>
                    <td align="left" width="25%">Snow D4: <?=$snow_duration4?></td>
                  </tr>
                </table>
              </fieldset>
            </td>
          </tr>
        </table>
      </div>
    </div>
