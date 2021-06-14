  <div class="table_container" style="width: 500px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td>Beastlord Pets</td>
          <td align="right"><a href="index.php?editor=npc&action=85"><img src="images/add.gif"></a></td>
        </tr>
      </table>
    </div>
    <table class="table_content2" width="100%">
<?if (isset($beastlord_pets)):?>
      <tr>
        <td align="center" width="45%"><strong>Player Race</strong></td>
        <td align="center" width="45%"><strong>Pet Race</strong></td>
        <td align="right" width="10%">&nbsp;</td>
      </tr>
<?$x=0;
foreach($beastlord_pets as $beastlord_pet):?>
      <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
        <td align="center" width="45%"><?=$races[$beastlord_pet['player_race']]?> (<?=$beastlord_pet['player_race']?>)</td>
        <td align="center" width="45%"><?=$races[$beastlord_pet['pet_race']]?> (<?=$beastlord_pet['pet_race']?>)</td>
        <td align="right" width="10%"><a href="index.php?editor=npc&player_race=<?=$beastlord_pet['player_race']?>&action=86"><img src="images/edit2.gif"></a>&nbsp;<a onClick="return confirm('Really delete this entry?')" href="index.php?editor=npc&player_race=<?=$beastlord_pet['player_race']?>&action=88"><img src="images/remove.gif"></a></td>
      </tr>
<?$x++;
endforeach;
else:?>
      <tr>
        <td align="left" width="100%" style="padding: 10px;">No Beastlord Pets</td>
      </tr>
<?endif;?>
    </table>
  </div>
