  <div class="table_container" style="width: 500px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td>Pets</td>
        </tr>
      </table>
    </div>
    <table class="table_content2" width="100%">
<?if (isset($pets)):?>
      <tr>
        <td align="center" width="50%"><strong>Type</strong></td>
        <td align="center" width="20%"><strong>Pet Power</strong></td>
        <td align="center" width="30%"><strong>NPC ID</strong></td>
      </tr>
<?$x=0;
foreach($pets as $pet):?>
      <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
        <td align="center" width="50%"><a href="index.php?editor=npc&npcid=<?=$pet['npcID']?>&action=56"><?=$pet['type']?></a></td>
        <td align="center" width="20%"><?=$pet['petpower']?></td>
        <td align="center" width="30%"><a href="index.php?editor=npc&npcid=<?=$pet['npcID']?>"><?=$pet['npcID']?></td>
      </tr>
<?$x++;
endforeach;
else:?>
      <tr>
        <td align="left" width="100%" style="padding: 10px;">No pets</td>
      </tr>
<?endif;?>
    </table>
  </div>
