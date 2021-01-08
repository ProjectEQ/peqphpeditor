  <div class="table_container" style="width: 600px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td align="left">Expedition Members</td>
          <td align="right">
            <a href="index.php?editor=expeditions&action=20"><img src="images/add.gif" border="0" title="Create New Expedition Member" alt="Create New Expedition Member"></a>
          </td>
        </tr>
      </table>
    </div>
    <table class="table_content2" width="100%">
<?if (isset($expedition_members)):?>
      <tr>
        <td align="center"><strong>ID</strong></td>
        <td align="center"><strong>Expedition</strong></td>
        <td align="center"><strong>Character</strong></td>
        <td align="center"><strong>Current Member</strong></td>
        <td align="right">&nbsp;</td>
      </tr>
<?$x=0;
foreach($expedition_members as $expedition_member):?>
      <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
        <td align="center"><?=$expedition_member['id']?></td>
        <td align="center"><?=$expedition_member['expedition_id']?></td>
        <td align="center"><?=getPlayerName($expedition_member['character_id'])?> (<?=$expedition_member['character_id']?>)</td>
        <td align="center"><?=$yesno[$expedition_member['is_current_member']]?></td>
        <td align="right"><a href="index.php?editor=expeditions&id=<?=$expedition_member['id']?>&action=22"><img src="images/edit2.gif" width="13" height="13" border="0" title="Edit Expedition Member" alt="Edit"></a>&nbsp;<a onClick="return confirm('Really delete expedition member?');" href="index.php?editor=expeditions&id=<?=$expedition_member['id']?>&action=24"><img src="images/remove3.gif" border="0" title="Delete Expedition Member" alt="Delete"></a></td>
      </tr>
<?$x++;
endforeach;
else:?>
      <tr>
        <td align="left" width="100" style="padding: 10px;">No Expedition Members</td>
      </tr>
<?endif;?>
    </table>
  </div>
