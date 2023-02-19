  <div class="table_container" style="width: 650px;">
    <div class="table_header">
      <table style="width:100%; padding:0px; border-spacing:0px;">
        <tr>
          <td align="right"><a href="index.php?editor=mercs&action=50"><img src="images/add.gif" title="Add Mercenary Stance"></a></td>
        </tr>
      </table>
    </div>
    <table class="table_content2" style="width:100%;">
<?if (isset($stance_entries)):?>
      <tr>
        <td align="center" width="15%"><strong>ID</strong></td>
        <td align="center" width="30%"><strong>Class</strong></td>
        <td align="center" width="15%"><strong>Proficiency</strong></td>
        <td align="center" width="15%"><strong>Stance</strong></td>
        <td align="center" width="15%"><strong>Default</strong></td>
        <td width="10%">&nbsp;</td>
      </tr>
<?$x=0;
foreach($stance_entries as $stance):?>
      <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
        <td align="center" width="15%"><?=$stance['merc_stance_entry_id']?></td>
        <td align="center" width="30%"><?=$classes[$stance['class_id']]?> (<?=$stance['class_id']?>)</td>
        <td align="center" width="15%"><?=$stance['proficiency_id']?></td>
        <td align="center" width="15%"><?=$stances[$stance['stance_id']]?> (<?=$stance['stance_id']?>)</td>
        <td align="center" width="15%"><?=$yesno[$stance['isdefault']]?></td>
        <td align="right" width="10%">
          <a href="index.php?editor=mercs&merc_stance_entry_id=<?=$stance['merc_stance_entry_id']?>&action=52"><img src="images/edit2.gif" width="13" height="13" border="0" title="Edit Mercenary Stance"></a>&nbsp;
          <a href="index.php?editor=mercs&merc_stance_entry_id=<?=$stance['merc_stance_entry_id']?>&action=54" onClick="return confirm('Really delete mercenary stance?');"><img src="images/remove.gif" width="13" height="13" border="0" title="Delete Mercenary Stance"></a>
        </td>
      </tr>
<?$x++;
endforeach;
else:?>
      <tr>
        <td align="left" width="100%" style="padding: 10px;">No Mercenary stance_entries</td>
      </tr>
<?endif;?>
    </table>
  </div>
