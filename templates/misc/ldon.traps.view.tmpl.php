  <div class="table_container" style="width: 650px;">
    <div class="table_header">
      <table style="width:100%; padding:0px; border-spacing:0px;">
        <tr>
          <td align="right"><a href="index.php?editor=misc&action=65"><img src="images/add.gif" title="Add Trap Template"></a></td>
        </tr>
      </table>
    </div>
    <table class="table_content2" style="width:100%;">
<?if (isset($templates)):?>
      <tr>
        <td align="center" width="12%"><strong>Template ID</strong></td>
        <td align="center" width="18%"><strong>Type</strong></td>
        <td align="center" width="25%"><strong>Spell</strong></td>
        <td align="center" width="25%"><strong>Skill</strong></td>
        <td align="center" width="10%"><strong>Locked?</strong></td>
        <td width="10%">&nbsp;</td>
      </tr>
<?$x=0;
foreach($templates as $template):?>
      <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
        <td align="center" width="10%"><?=$template['id']?></td>
        <td align="center" width="20%"><?=$template['type']?></td>
        <td align="center" width="25%"><?echo getSpellName($template['spell_id']) . " (" . $template['spell_id'] . ")";?></td>
        <td align="center" width="25%"><?=$template['skill']?></td>
        <td align="center" width="10%"><?=$yesno[$template['locked']]?></td>
        <td align="right" width="10%">
          <a href="index.php?editor=misc&id=<?=$template['id']?>&action=64"><img src="images/view_all.gif" width="13" height="13" border="0" title="View Trap"></a>&nbsp;
          <a href="index.php?editor=misc&id=<?=$template['id']?>&action=69" onClick="return confirm('Really delete trap template and associated entries?');"><img src="images/remove.gif" width="13" height="13" border="0" title="Delete Trap Template"></a>
        </td>
      </tr>
<?$x++;
endforeach;
else:?>
      <tr>
        <td align="left" width="100%" style="padding: 10px;">No Trap Templates</td>
      </tr>
<?endif;?>
    </table>
  </div>
