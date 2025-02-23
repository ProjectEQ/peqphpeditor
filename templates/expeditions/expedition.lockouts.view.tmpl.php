  <div class="table_container" style="width: 700px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td align="left">Dynamic Zone Lockouts</td>
          <td align="right">
            <a href="index.php?editor=expeditions&action=8"><img src="images/add.gif" border="0" title="Create New Lockout" alt="Create New Lockout"></a>
          </td>
        </tr>
      </table>
    </div>
    <table class="table_content2" width="100%">
<?if (isset($dynamic_zone_lockouts)):?>
      <tr>
        <td align="center"><strong>ID</strong></td>
        <td align="center"><strong>Dynamic Zone</strong></td>
        <td align="center"><strong>Event Name</strong></td>
        <td align="center"><strong>Expires</strong></td>
        <td align="center"><strong>Duration</strong></td>
        <td align="right">&nbsp;</td>
      </tr>
<?$x=0;
foreach($dynamic_zone_lockouts as $dynamic_zone_lockout):?>
      <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
        <td align="center"><?=$dynamic_zone_lockout['id']?></td>
        <td align="center"><?=$dynamic_zone_lockout['dynamic_zone_id']?></td>
        <td align="center"><?=$dynamic_zone_lockout['event_name']?></td>
        <td align="center"><?=$dynamic_zone_lockout['expire_time']?></td>
        <td align="center"><?=$dynamic_zone_lockout['duration']?></td>
        <td align="right"><a href="index.php?editor=expeditions&id=<?=$dynamic_zone_lockout['id']?>&action=10"><img src="images/edit2.gif" width="13" height="13" border="0" title="Edit Expedition Lockout" alt="Edit"></a>&nbsp;<a onClick="return confirm('Really delete expedition lockout?');" href="index.php?editor=expeditions&id=<?=$dynamic_zone_lockout['id']?>&action=12"><img src="images/remove3.gif" border="0" title="Delete Expedition Lockout" alt="Delete"></a></td>
      </tr>
<?$x++;
endforeach;
else:?>
      <tr>
        <td align="left" width="100" style="padding: 10px;">No Lockouts</td>
      </tr>
<?endif;?>
    </table>
  </div>
