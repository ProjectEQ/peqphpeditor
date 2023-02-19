  <div class="table_container" style="width: 550px;">
    <div class="table_header">
      <table style="width:100%; padding:0px; border-spacing:0px;">
        <tr>
          <td>Merc NPC Type <?=$_GET['merc_npc_type_id']?>
          <td align="right"><a href="index.php?editor=mercs&merc_npc_type_id=<?=$_GET['merc_npc_type_id']?>&action=68"><img src="images/add.gif" title="Add Mercenary Weapon"></a></td>
        </tr>
      </table>
    </div>
    <table class="table_content2" style="width:100%;">
<?if (isset($weapons)):?>
      <tr>
        <td align="center" width="30%"><strong>ID</strong></td>
        <td align="center" width="30%"><strong>Min Level</strong></td>
        <td align="center" width="30%"><strong>Max Level</strong></td>
        <td width="10%">&nbsp;</td>
      </tr>
<?$x=0;
foreach($weapons as $entry):?>
      <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
        <td align="center" width="30%"><?=$entry['id']?></td>
        <td align="center" width="30%"><?=$entry['minlevel']?></td>
        <td align="center" width="30%"><?=$entry['maxlevel']?></td>
        <td align="right" width="10%">
          <a href="index.php?editor=mercs&id=<?=$entry['id']?>&action=70"><img src="images/edit2.gif" width="13" height="13" border="0" title="Edit Mercenary Weapon"></a>&nbsp;
          <a href="index.php?editor=mercs&merc_npc_type_id=<?=$entry['merc_npc_type_id']?>&id=<?=$entry['id']?>&action=72" onClick="return confirm('Really delete mercenary weapon?');"><img src="images/remove.gif" width="13" height="13" border="0" title="Delete Mercenary Weapon"></a>
        </td>
      </tr>
<?$x++;
endforeach;
else:?>
      <tr>
        <td align="left" width="100%" style="padding: 10px;">No Mercenary Weapons</td>
      </tr>
<?endif;?>
    </table>
  </div>
