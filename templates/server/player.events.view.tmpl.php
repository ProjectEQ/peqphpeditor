  <div class="table_container" style="width: 700px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td>Player Events</td>
          <td align="right">
            <a href="index.php?editor=server&action=76"><img src="images/config.gif" width="13" height="13" border="0" title="Event Log Settings"></a>
          </td>
        </tr>        
      </table>
    </div>
    <table class="table_content2" width="100%">
<?if(isset($events)):?>
      <tr>
        <td align="center" width="10%"><strong>ID</strong></td>
        <td align="center" width="15%"><strong>Account</strong></td>
        <td align="center" width="15%"><strong>Player</strong></td>
        <td align="center" width="20%"><strong>Zone</strong></td>
        <td align="center" width="10%"><strong>Event Type</strong></td>
        <td align="center" width="20%"><strong>Timestamp</strong></td>
        <td width="10%">&nbsp;</td>
      </tr>
<?$x=0; foreach($events as $event):?>
      <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
        <td align="center" width="10%"><?=$event['id']?></td>
        <td align="center" width="15%"><?=getAccountName($event['account_id'])?> (<?=$event['account_id']?>)</td>
        <td align="center" width="15%"><?=getPlayerName($event['character_id'])?> (<?=$event['character_id']?>)</td>
        <td align="center" width="20%"><?=getZoneName($event['zone_id'])?> (<?=$event['zone_id']?>)</td>
        <td align="center" width="10%"><?=$event['event_type_id']?></td>
        <td align="center" width="20%"><?=$event['created_at']?></td>
        <td align="right">
          <a href="index.php?editor=server&id=<?=$event['id']?>&action=7"><img src="images/view_all.gif" width="13" height="13" border="0" title="View Event"></a>          
          <a href="index.php?editor=server&id=<?=$event['id']?>&action=8" onClick="return confirm('Really delete this event?');"><img src="images/remove3.gif" border="0" title="Delete this event"></a>
        </td>
      </tr>
<?$x++;endforeach;?>
<?else:?>
      <tr>
        <td align="left" width="100%" style="padding: 10px;">No Events</td>
      </tr>
<?endif;?>
    </table>
  </div>
