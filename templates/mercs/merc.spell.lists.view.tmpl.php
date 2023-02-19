  <div class="table_container" style="width: 600px;">
    <div class="table_header">
      <table style="width:100%; padding:0px; border-spacing:0px;">
        <tr>
          <td align="right"><a href="index.php?editor=mercs&action=38"><img src="images/add.gif" title="Add Mercenary Spell List"></a></td>
        </tr>
      </table>
    </div>
    <table class="table_content2" style="width:100%;">
<?if (isset($lists)):?>
      <tr>
        <td align="center" width="10%"><strong>ID</strong></td>
        <td align="center" width="30%"><strong>Class</strong></td>
        <td align="center" width="10%"><strong>Proficiency</strong></td>
        <td align="center" width="40%"><strong>Name</strong></td>
        <td width="10%">&nbsp;</td>
      </tr>
<?$x=0;
foreach($lists as $list):?>
      <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
        <td align="center" width="10%"><?=$list['merc_spell_list_id']?></td>
        <td align="center" width="30%"><?=$classes[$list['class_id']]?> (<?=$list['class_id']?>)</td>
        <td align="center" width="10%"><?=$list['proficiency_id']?></td>
        <td align="center" width="40%"><?=$list['name']?></td>
        <td align="right" width="10%">
          <a href="index.php?editor=mercs&merc_spell_list_id=<?=$list['merc_spell_list_id']?>&action=40"><img src="images/view_all.gif" width="13" height="13" border="0" title="View Mercenary Spell List"></a>&nbsp;
          <a href="index.php?editor=mercs&merc_spell_list_id=<?=$list['merc_spell_list_id']?>&action=43" onClick="return confirm('Really delete mercenary spell list?');"><img src="images/remove.gif" width="13" height="13" border="0" title="Delete Mercenary Spell List"></a>
        </td>
      </tr>
<?$x++;
endforeach;
else:?>
      <tr>
        <td align="left" width="100%" style="padding: 10px;">No Mercenary Spell Lists</td>
      </tr>
<?endif;?>
    </table>
  </div>
