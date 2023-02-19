  <div class="table_container" style="width: 700px;">
    <div class="table_header">
      <table style="width:100%; padding:0px; border-spacing:0px;">
        <tr>
          <td align="right"><a href="index.php?editor=mercs&action=8"><img src="images/add.gif" title="Add Mercenary NPC Type"></a></td>
        </tr>
      </table>
    </div>
    <table class="table_content2" style="width:100%;">
<?if (isset($types)):?>
      <tr>
        <td align="center" width="10%"><strong>ID</strong></td>
        <td align="center" width="10%"><strong>Proficiency</strong></td>
        <td align="center" width="10%"><strong>Tier</strong></td>
        <td align="center" width="20%"><strong>Class</strong></td>
        <td align="center" width="30%"><strong>Name</strong></td>
        <td width="20%">&nbsp;</td>
      </tr>
<?$x=0;
foreach($types as $type):?>
      <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
        <td align="center" width="10%"><?=$type['merc_npc_type_id']?></td>
        <td align="center" width="10%"><?=$type['proficiency_id']?></td>
        <td align="center" width="10%"><?=$type['tier_id']?></td>
        <td align="center" width="20%"><?=$classes[$type['class_id']]?> (<?=$type['class_id']?>)</td>
        <td align="center" width="30%"><?=$type['name']?></td>
        <td align="right" width="20%">
          <a href="index.php?editor=mercs&merc_npc_type_id=<?=$type['merc_npc_type_id']?>&action=55"><img src="images/stats.gif" width="13" height="13" border="0" title="Merc Stats"></a>&nbsp;
          <a href="index.php?editor=mercs&merc_npc_type_id=<?=$type['merc_npc_type_id']?>&action=61"><img src="images/armor.gif" width="13" height="13" border="0" title="Merc Armor"></a>&nbsp;
          <a href="index.php?editor=mercs&merc_npc_type_id=<?=$type['merc_npc_type_id']?>&action=67"><img src="images/weapon.gif" width="13" height="13" border="0" title="Merc Weapons"></a>&nbsp;
          <a href="index.php?editor=mercs&merc_npc_type_id=<?=$type['merc_npc_type_id']?>&action=10"><img src="images/edit2.gif" width="13" height="13" border="0" title="Edit Mercenary NPC Type"></a>&nbsp;
          <a href="index.php?editor=mercs&merc_npc_type_id=<?=$type['merc_npc_type_id']?>&action=12" onClick="return confirm('Really delete mercenary npc type and associated entries?');"><img src="images/remove.gif" width="13" height="13" border="0" title="Delete Mercenary NPC Type"></a>
        </td>
      </tr>
<?$x++;
endforeach;
else:?>
      <tr>
        <td align="left" width="100%" style="padding: 10px;">No Mercenary NPC Types</td>
      </tr>
<?endif;?>
    </table>
  </div>
