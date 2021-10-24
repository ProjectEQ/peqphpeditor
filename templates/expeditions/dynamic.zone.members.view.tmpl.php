  <div class="table_container" style="width: 600px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td align="left">Dynamic Zone Members</td>
          <td align="right">
            <a href="index.php?editor=expeditions&action=20"><img src="images/add.gif" border="0" title="Create New Dynamic Zone Member" alt="Create New Dynamic Zone Member"></a>
          </td>
        </tr>
      </table>
    </div>
    <table class="table_content2" width="100%">
<?if (isset($dynamic_zone_members)):?>
      <tr>
        <td align="center"><strong>ID</strong></td>
        <td align="center"><strong>Dynamic Zone</strong></td>
        <td align="center"><strong>Character</strong></td>
        <td align="right">&nbsp;</td>
      </tr>
<?$x=0;
foreach($dynamic_zone_members as $dynamic_zone_member):?>
      <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
        <td align="center"><?=$dynamic_zone_member['id']?></td>
        <td align="center"><?=$dynamic_zone_member['dynamic_zone_id']?></td>
        <td align="center"><?=getPlayerName($dynamic_zone_member['character_id'])?> (<?=$dynamic_zone_member['character_id']?>)</td>
        <td align="right"><a href="index.php?editor=expeditions&id=<?=$dynamic_zone_member['id']?>&action=22"><img src="images/edit2.gif" width="13" height="13" border="0" title="Edit Dynamic Zone Member" alt="Edit"></a>&nbsp;<a onClick="return confirm('Really delete dynamic zone member?');" href="index.php?editor=expeditions&id=<?=$dynamic_zone_member['id']?>&action=24"><img src="images/remove3.gif" border="0" title="Delete Dynamic Zone Member" alt="Delete"></a></td>
      </tr>
<?$x++;
endforeach;
else:?>
      <tr>
        <td align="left" width="100" style="padding: 10px;">No Dynamic Zone Members</td>
      </tr>
<?endif;?>
    </table>
  </div>
