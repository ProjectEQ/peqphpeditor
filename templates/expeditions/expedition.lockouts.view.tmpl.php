  <div class="table_container" style="width: 700px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td align="left">Expedition Lockouts</td>
          <td align="right">
            <a href="index.php?editor=expeditions&action=8"><img src="images/add.gif" border="0" title="Create New Expedition Lockout" alt="Create New Expedition Lockout"></a>
          </td>
        </tr>
      </table>
    </div>
    <table class="table_content2" width="100%">
<?if (isset($expedition_lockouts)):?>
      <tr>
        <td align="center"><strong>ID</strong></td>
        <td align="center"><strong>Expedition</strong></td>
        <td align="center"><strong>Event Name</strong></td>
        <td align="center"><strong>Expires</strong></td>
        <td align="center"><strong>Duration</strong></td>
        <td align="right">&nbsp;</td>
      </tr>
<?$x=0;
foreach($expedition_lockouts as $expedition_lockout):?>
      <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
        <td align="center"><?=$expedition_lockout['id']?></td>
        <td align="center"><?=$expedition_lockout['expedition_id']?></td>
        <td align="center"><?=$expedition_lockout['event_name']?></td>
        <td align="center"><?=$expedition_lockout['expire_time']?></td>
        <td align="center"><?=$expedition_lockout['duration']?></td>
        <td align="right"><a href="index.php?editor=expeditions&id=<?=$expedition_lockout['id']?>&action=10"><img src="images/edit2.gif" width="13" height="13" border="0" title="Edit Expedition Lockout" alt="Edit"></a>&nbsp;<a onClick="return confirm('Really delete expedition lockout?');" href="index.php?editor=expeditions&id=<?=$expedition_lockout['id']?>&action=12"><img src="images/remove3.gif" border="0" title="Delete Expedition Lockout" alt="Delete"></a></td>
      </tr>
<?$x++;
endforeach;
else:?>
      <tr>
        <td align="left" width="100" style="padding: 10px;">No Expedition Lockouts</td>
      </tr>
<?endif;?>
    </table>
  </div>
