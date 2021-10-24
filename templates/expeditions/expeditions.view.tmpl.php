  <div class="table_container" style="width: 350px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td align="left">Expeditions</td>
          <td align="right">
            <a href="index.php?editor=expeditions&action=2"><img src="images/add.gif" border="0" title="Create New Expedition" alt="Create New Expedition"></a>
          </td>
        </tr>
      </table>
    </div>
    <table class="table_content2" width="100%">
<?if (isset($expeditions)):?>
      <tr>
        <td align="center"><strong>ID</strong></td>
        <td align="center"><strong>Dyn Zone ID</strong></td>
        <td align="center"><strong>Locked</strong></td>
        <td align="right">&nbsp;</td>
      </tr>
<?$x=0;
foreach($expeditions as $expedition):?>
      <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
        <td align="center"><?=$expedition['id']?></td>
        <td align="center"><?=$expedition['dynamic_zone_id']?></td>
        <td align="center"><?=$yesno[$expedition['is_locked']]?></td>
        <td align="right"><a href="index.php?editor=expeditions&id=<?=$expedition['id']?>&action=4"><img src="images/edit2.gif" width="13" height="13" border="0" title="Edit Expedition" alt="Edit"></a>&nbsp;<a onClick="return confirm('Really delete expedition?');" href="index.php?editor=expeditions&id=<?=$expedition['id']?>&action=6"><img src="images/remove3.gif" border="0" title="Delete Expedition" alt="Delete"></a></td>
      </tr>
<?$x++;
endforeach;
else:?>
      <tr>
        <td align="left" width="100" style="padding: 10px;">No Expeditions</td>
      </tr>
<?endif;?>
    </table>
  </div>
