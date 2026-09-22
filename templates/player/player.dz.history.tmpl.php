<?php $dzEscape = function ($value) { return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8'); }; ?>
<div class="table_container" style="width: 100%;">
  <div class="table_header">
    <span style="float:right"><a href="index.php?editor=player&amp;playerid=<?=(int) $dz_history['player_id']?>">Back to Player</a></span>
    DZ History: <?=$dzEscape($dz_history['player_name'])?> (<?=(int) $dz_history['player_id']?>)
  </div>
  <div class="table_content" style="padding: 10px;">
<?php if ($dz_history['error'] !== ''): ?>
    <p><?=$dzEscape($dz_history['error'])?></p>
<?php elseif ($dz_history['missing']): ?>
    <p>Saved DZ history is unavailable. The server's saved expedition migrations must be installed.</p>
    <p>Missing tables: <?=$dzEscape(implode(', ', $dz_history['missing']))?></p>
<?php else: ?>
    <p>Active saved expeditions this player has permission to rejoin through DZManager. Expired, revoked and superseded copies are excluded. Leaving or being kicked does not remove an existing saved return right.</p>
    <p>Eligibility reflects saved database state and configured rules. DZManager checks live rules, pending invitations, the player's current instance and expedition availability when rejoining. Ordinary members who can only return by invitation are not listed.</p>
<?php if (!$dz_history['enabled']): ?>
    <p><strong>Saved rejoin is disabled in the configured server rules.</strong> Retained history is shown below.</p>
<?php endif; ?>
<?php if (!$dz_history['transactional']): ?>
    <p><strong>Saved rejoin requires all participating expedition tables to use InnoDB.</strong></p>
<?php endif; ?>
    <p>Checked: <?=$dzEscape(date('Y-m-d H:i:s T', $dz_history['checked_at']))?> | Character season: <?=(int) $dz_history['character_season']?></p>
<?php if (!$dz_history['entries']): ?>
    <p>No active saved expeditions with return permission.</p>
<?php else: ?>
    <table class="table_content2" width="100%" cellspacing="0" cellpadding="5">
      <tr>
        <th align="left">Expedition</th><th align="left">Zone / Instance</th><th align="left">Leader</th>
        <th>Members</th><th align="left">Expires / Remaining</th><th align="left">Rejoin status</th>
      </tr>
<?php foreach ($dz_history['entries'] as $index => $entry):
  $remaining = max(0, (int) $entry['expires'] - $dz_history['checked_at']);
?>
      <tr bgcolor="#<?=($index % 2 === 0) ? 'BBBBBB' : 'AAAAAA'?>">
        <td><a href="index.php?editor=expeditions&amp;action=4&amp;id=<?=(int) $entry['dz_id']?>"><?=$dzEscape($entry['name'])?></a><br>
          DZ <?=(int) $entry['dz_id']?> | Season <?=(int) $entry['season_id']?><br>
          <small><?=$dzEscape($entry['uuid'])?></small></td>
        <td><?=$dzEscape(isset($zoneids[$entry['zone_id']]) ? $zoneids[$entry['zone_id']] : 'Zone ' . (int) $entry['zone_id'])?><br>
          Version <?=(int) $entry['zone_version']?> | Instance <?=(int) $entry['instance_id']?></td>
        <td><?php if ($entry['leader_name'] !== ''): ?><a href="index.php?editor=player&amp;playerid=<?=(int) $entry['leader_id']?>"><?=$dzEscape($entry['leader_name'])?></a><?php else: ?>None<?php endif; ?></td>
        <td align="center"><?=(int) $entry['members']?> / <?=(int) $entry['max_players']?></td>
        <td><?=$dzEscape(date('Y-m-d H:i:s T', (int) $entry['expires']))?><br>
          <?=(int) floor($remaining / 3600)?>h <?=(int) floor(($remaining % 3600) / 60)?>m <?=(int) ($remaining % 60)?>s</td>
        <td><?=$dzEscape($entry['status'])?></td>
      </tr>
<?php endforeach; ?>
    </table>
<?php endif; ?>
<?php endif; ?>
  </div>
</div>
