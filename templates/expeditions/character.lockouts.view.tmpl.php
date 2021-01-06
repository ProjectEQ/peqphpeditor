  <div class="table_container" style="width: 750px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td align="left">Character Lockouts</td>
          <td align="right">
            <a href="index.php?editor=expeditions&action=26"><img src="images/add.gif" border="0" title="Create New Character Lockout" alt="Create New Character Lockout"></a>
          </td>
        </tr>
      </table>
    </div>
    <table class="table_content2" width="100%">
<?if (isset($character_lockouts)):?>
      <tr>
        <td align="center"><strong>ID</a></strong></td>
        <td align="center"><strong>Expedition</a></strong></td>
        <td align="center"><strong>Event Name</a></strong></td>
        <td align="center"><strong>Expires</a></strong></td>
        <td align="center"><strong>Duration</a></strong></td>
        <td align="center"><strong>Character</a></strong></td>
        <td align="right">&nbsp;</td>
      </tr>
<?$x=0;
foreach($character_lockouts as $character_lockout):?>
      <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
        <td align="center"><?=$character_lockout['id']?></td>
        <td align="center"><?=$character_lockout['expedition_name']?></td>
        <td align="center"><?=$character_lockout['event_name']?></td>
        <td align="center"><?=$character_lockout['expire_time']?></td>
        <td align="center"><?=$character_lockout['duration']?></td>
        <td align="center"><?=getPlayerName($character_lockout['character_id'])?></td>
        <td align="right"><a href="index.php?editor=expeditions&id=<?=$character_lockout['id']?>&action=28"><img src="images/edit2.gif" width="13" height="13" border="0" title="Edit Character Lockout" alt="Edit"></a>&nbsp;<a onClick="return confirm('Really delete character lockout?');" href="index.php?editor=expeditions&id=<?=$character_lockout['id']?>&action=30"><img src="images/remove3.gif" border="0" title="Delete Character Lockout" alt="Delete"></a></td>
      </tr>
<?$x++;
endforeach;
else:?>
      <tr>
        <td align="left" width="100" style="padding: 10px;">No Character Lockouts</td>
      </tr>
<?endif;?>
    </table>
  </div>
