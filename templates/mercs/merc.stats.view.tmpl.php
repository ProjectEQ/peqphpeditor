  <div class="table_container" style="width: 350px;">
    <div class="table_header">
      <table style="width:100%; padding:0px; border-spacing:0px;">
        <tr>
          <td>Merc NPC Type <?=$_GET['merc_npc_type_id']?>
          <td align="right"><a href="index.php?editor=mercs&merc_npc_type_id=<?=$_GET['merc_npc_type_id']?>&action=56"><img src="images/add.gif" title="Add Mercenary Stat"></a></td>
        </tr>
      </table>
    </div>
    <table class="table_content2" style="width:100%;">
<?if (isset($stats)):?>
      <tr>
        <td align="center" width="40%"><strong>Client Level</strong></td>
        <td align="center" width="40%"><strong>Merc Level</strong></td>
        <td width="20%">&nbsp;</td>
      </tr>
<?$x=0;
foreach($stats as $stat):?>
      <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
        <td align="center" width="40%"><?=$stat['clientlevel']?></td>
        <td align="center" width="40%"><?=$stat['level']?></td>
        <td align="right" width="20%">
          <a href="index.php?editor=mercs&merc_npc_type_id=<?=$stat['merc_npc_type_id']?>&clientlevel=<?=$stat['clientlevel']?>&action=58"><img src="images/edit2.gif" width="13" height="13" border="0" title="Edit Mercenary Stat"></a>&nbsp;
          <a href="index.php?editor=mercs&merc_npc_type_id=<?=$stat['merc_npc_type_id']?>&clientlevel=<?=$stat['clientlevel']?>&action=60" onClick="return confirm('Really delete mercenary stat?');"><img src="images/remove.gif" width="13" height="13" border="0" title="Delete Mercenary Stat"></a>
        </td>
      </tr>
<?$x++;
endforeach;
else:?>
      <tr>
        <td align="left" width="100%" style="padding: 10px;">No Mercenary Stats</td>
      </tr>
<?endif;?>
    </table>
  </div>
