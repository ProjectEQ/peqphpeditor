  <div class="table_container" style="width: 450px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td>Edit Expedition</td>
        </tr>
      </table>
    </div>
    <div class="table_content">
      <fieldset>
        <legend><strong>Expedition</strong></legend>
        <form name="edit_expedition" method="post" action="index.php?editor=expeditions&action=5">
          <table width="100%" cellpadding="5" cellspacing="5">
            <tr>
              <td>
                <strong>ID:</strong><br>
                <input type="text" size="10" value="<?=$expedition['id']?>" disabled>
              </td>
              <td>
                <strong>Dyn Zone ID:</strong><br>
                <input type="text" name="dynamic_zone_id" size="10" value="<?=$expedition['dynamic_zone_id']?>">
              </td>
              <td>
                <strong>Replay on Join:</strong><br>
                <select name="add_replay_on_join">
                  <option value="0"<?echo ($expedition['add_replay_on_join'] == 0) ? " selected" : "";?>>No (0)</option>
                  <option value="1"<?echo ($expedition['add_replay_on_join'] != 0) ? " selected" : "";?>>Yes (1)</option>
                </select>
              </td>
              <td>
                <strong>Locked:</strong><br>
                <select name="is_locked">
                  <option value="0"<?echo ($expedition['is_locked'] == 0) ? " selected" : "";?>>No (0)</option>
                  <option value="1"<?echo ($expedition['is_locked'] != 0) ? " selected" : "";?>>Yes (1)</option>
                </select>
              </td>
            </tr>
          </table><br>
          <center>
            <input type="hidden" name="id" value="<?=$expedition['id']?>">
            <input type="submit" value="Update Expedition">&nbsp;&nbsp;
            <input type="button" value="Cancel" onClick="history.back()">
          </center>
        </form>
      </fieldset><br>
      <fieldset>
        <legend><strong>Dynamic Zone</strong> (<a href="index.php?editor=expeditions&id=<?=$dynamic_zone['id']?>&action=16">edit</a>)</legend>
        <table width="100%" cellpadding="5" cellspacing="5">
          <tr>
            <td width="30%">
              <strong>ID:</strong><br>
              <?=$dynamic_zone['id']?>
            </td>
            <td width="35%">
              <strong>Instance:</strong><br>
              <?=$dynamic_zone['instance_id']?>
            </td>
            <td width="35%">
              <strong>Type:</strong><br>
              <?=$dynamic_zone_type[$dynamic_zone['type']]?> (<?=$dynamic_zone['type']?>)
            </td>
          </tr>
          <tr>
            <td colspan="3">
              <strong>Name:</strong><br>
              <?=$dynamic_zone['name']?>
            </td>
          </tr>
          <tr>
            <td colspan="3">
              <strong>UUID:</strong><br>
              <?=$dynamic_zone['uuid']?>
            </td>
          </tr>
          <tr>
            <td>
              <strong>Leader ID:</strong><br>
              <?=$dynamic_zone['leader_id']?>
            </td>
            <td>
              <strong>Min Players:</strong><br>
              <?=$dynamic_zone['min_players']?>
            </td>
            <td>
              <strong>Max Players:</strong><br>
              <?=$dynamic_zone['max_players']?>
            </td>
          </tr>
          <tr>
            <td colspan="5">
              <fieldset>
                <legend><strong>Compass</strong></legend>
                <table width="100%" cellpadding="3" cellspacing="3">
                  <tr>
                    <td width="32%">
                      <strong>Zone:</strong><br>
                      <?=$zoneids[$dynamic_zone['compass_zone_id']]?> (<?=$dynamic_zone['compass_zone_id']?>)
                    </td>
                    <td width="17%">
                      <strong>X:</strong><br>
                      <?=$dynamic_zone['compass_x']?>
                    </td>
                    <td width="17%">
                      <strong>Y:</strong><br>
                      <?=$dynamic_zone['compass_y']?>
                    </td>
                    <td width="17%">
                      <strong>Z:</strong><br>
                      <?=$dynamic_zone['compass_z']?>
                    </td>
                    <td width="17%">&nbsp;</td>
                  </tr>
                </table>
              </fieldset>
            </td>
          </tr>
          <tr>
            <td colspan="5">
              <fieldset>
                <legend><strong>Safe Return</strong></legend>
                <table width="100%" cellpadding="3" cellspacing="3">
                  <tr>
                    <td width="32%">
                      <strong>Zone:</strong><br>
                      <?=$zoneids[$dynamic_zone['safe_return_zone_id']]?> (<?=$dynamic_zone['safe_return_zone_id']?>)
                    </td>
                    <td width="17%">
                      <strong>X:</strong><br>
                      <?=$dynamic_zone['safe_return_x']?>
                    </td>
                    <td width="17%">
                      <strong>Y:</strong><br>
                      <?=$dynamic_zone['safe_return_y']?>
                    </td>
                    <td width="17%">
                      <strong>Z:</strong><br>
                      <?=$dynamic_zone['safe_return_z']?>
                    </td>
                    <td width="17%">
                      <strong>Heading:</strong><br>
                      <?=$dynamic_zone['safe_return_heading']?>
                    </td>
                  </tr>
                </table>
              </fieldset>
            </td>
          </tr>
          <tr>
            <td colspan="5">
              <fieldset>
                <legend><strong>Zone In</strong></legend>
                <table width="100%" cellpadding="3" cellspacing="3">
                  <tr>
                    <td width="32%">
                      <strong>Has Zone In:</strong><br>
                      <?=$yesno[$dynamic_zone['has_zone_in']]?> (<?=$dynamic_zone['has_zone_in']?>)
                    </td>
                    <td width="17%">
                      <strong>X:</strong><br>
                      <?=$dynamic_zone['zone_in_x']?>
                    </td>
                    <td width="17%">
                      <strong>Y:</strong><br>
                      <?=$dynamic_zone['zone_in_y']?>
                    </td>
                    <td width="17%">
                      <strong>Z:</strong><br>
                      <?=$dynamic_zone['zone_in_z']?>
                    </td>
                    <td width="17%">
                      <strong>Heading:</strong><br>
                      <?=$dynamic_zone['zone_in_heading']?>
                    </td>
                  </tr>
                </table>
              </fieldset>
            </td>
          </tr>
        </table>
      </fieldset><br>
      <fieldset>
        <legend><strong>Lockout</strong><?echo ($expedition['is_locked']) ? " (<a href=\"index.php?editor=expeditions&id=" . $expedition_lockout['id'] . "&action=10\">edit</a>)" : "";?></legend>
<?
if ($expedition['is_locked']):
?>
        <table width="100%" cellpadding="5" cellspacing="5">
          <tr>
            <td>
              <strong>ID:</strong><br>
              <?=$expedition_lockout['id']?>
            </td>
            <td>
              <strong>Expedition ID:</strong><br>
              <?=$expedition_lockout['expedition_id']?>
            </td>
            <td colspan="2">
              <strong>Expedition UUID:</strong><br>
              <?=$expedition_lockout['from_expedition_uuid']?>
            </td>
          </tr>
          <tr>
            <td colspan="4">
              <strong>Event Name:</strong><br>
              <?=$expedition_lockout['event_name']?>
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <strong>Expire Time:</strong>&nbsp;<img src="images/info.gif" width="13" title="(YYYY-MM-DD HH:MM:SS)" alt="(YYYY-MM-DD HH:MM:SS)"><br>
              <?=$expedition_lockout['expire_time']?>
            </td>
            <td>
              <strong>Duration:</strong><br>
              <?=$expedition_lockout['duration']?>
            </td>
            <td>&nbsp;</td>
          </tr>
        </table>
<?
else:
?>
        Expedition Not Locked
<?
endif;
?>
      </fieldset><br>
      <fieldset>
        <legend><strong>Members</strong></legend>
<?
if (isset($dynamic_zone_members)):
?>
        <table width="100%" cellpadding="5" cellspacing="5">
          <tr>
            <td width="90%"><strong>Character:</strong></td>
            <td width="10%" align="right">&nbsp;</td>
          </tr>
<?
  foreach ($dynamic_zone_members as $dynamic_zone_member):
?>
          <tr>
            <td><?=getPlayerName($dynamic_zone_member['character_id'])?> (<?=$dynamic_zone_member['character_id']?>)<?echo ($dynamic_zone['leader_id'] == $dynamic_zone_member['character_id']) ? " <strong>(LEADER)</strong>" : "";?></td>
            <td><a href="index.php?editor=expeditions&id=<?=$dynamic_zone_member['id']?>&action=22"><img src="images/edit2.gif" width="13" height="13" border="0" title="Edit Dynamic Zone Member" alt="Edit"></a>&nbsp;<a onClick="return confirm('Really delete dynamic zone member?');" href="index.php?editor=expeditions&id=<?=$dynamic_zone_member['id']?>&action=24&return=1"><img src="images/remove3.gif" border="0" title="Delete Dynamic Zone Member" alt="Delete"></a></td>
          </tr>
<?
  endforeach;
?>
        </table>
<?
else:
?>
      No Dynamic Zone Members
<?
endif;
?>
      </fieldset>
    </div>
  </div>
