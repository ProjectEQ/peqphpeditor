    <div class="table_container" style="width:350px;">
      <div class="table_header">
        <div style="float: right">
          <a href="index.php?editor=spells&action=15&nseid=<?=$effect['id']?>"><img src="images/c_table.gif" border="0" title="Edit NPC Spells Effects"></a>
          <a onClick="return confirm('This action will also delete related entries. Really Delete NPC Spells Effects <?=$id?>?');" href="index.php?editor=spells&action=17&nseid=<?=$effect['id']?>"><img src="images/remove3.gif" border="0" title="Delete NPC Spells Effects"></a>
        </div>
        NPC Spells Effects
      </div>
      <div class="table_content">
        <strong>ID:</strong> <?=$effect['id']?><br>
        <strong>Name:</strong> <?=$effect['name']?><br>
        <strong>Parent List:</strong> <?echo ($effect['parent_list'] == 0) ? "None" : $effect['parent_list'];?><br>
      </div>
    </div><br>
    <div class="table_container">
      <div class="table_header">
        <div style="float:right;">
          <a href="index.php?editor=spells&action=18&nseid=<?=$effect['id']?>"><img src="images/add.gif" border="0" title="Add NPC Spells Effects Entry"></a>
        </div>
        NPC Spells Effects Entries
      </div>
      <div class="table_contents">
        <table class="table_content2" width="100%">
<? if (isset($entries)): ?>
          <tr>
            <th>ID</th>
            <th>Spell Effect</th>
            <th>Min Level</th>
            <th>Max Level</th>
            <th>SE Base</th>
            <th>SE Limit</th>
            <th>SE Max</th>
            <th width="5%">&nbsp;</th>
          </tr>
<?
    $x = 0;
    foreach ($entries as $entry):
?>
          <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
            <td align="center"><?=$entry['id']?></td>
            <td align="center"><?=$entry['spell_effect_id']?> - <?=$sp_effects[$entry['spell_effect_id']]?></td>
            <td align="center"><?=$entry['minlevel']?></td>
            <td align="center"><?=$entry['maxlevel']?></td>
            <td align="center"><?=$entry['se_base']?></td>
            <td align="center"><?=$entry['se_limit']?></td>
            <td align="center"><?=$entry['se_max']?></td>
            <td align="right">
              <a href="index.php?editor=spells&action=20&nseid=<?=$effect['id']?>&nseeid=<?=$entry['id']?>"><img src="images/edit2.gif" width="13" height="13" border="0" title="Edit NPC Spells Effects Entry"></a>&nbsp;
              <a onClick="return confirm('Really Delete NPC Spells Effects Entry <?=$entry['id']?>?');" href="index.php?editor=spells&action=22&nseid=<?=$effect['id']?>&nseeid=<?=$entry['id']?>"><img src="images/remove3.gif" border="0" title="Delete NPC Spells Effects Entry"></a>
            </td>
          </tr>
<?
      $x++;
    endforeach;
  else:
 ?>
          <tr><td align="left" width="100" style="padding: 10px;">No entries</td></tr>
<? endif; ?>
        </table>
      </div>
    </div>
