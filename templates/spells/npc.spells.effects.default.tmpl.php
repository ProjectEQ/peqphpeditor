  <div class="table_container" style="width: 500px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td align="left" width="50%">NPC Spells Effects</td>
          <td align="right" width="50%"><a href="index.php?editor=spells&action=13"><img src="images/add.gif" border="0" title="Add NPC Spells Effects"></a></td>
        </tr>
      </table>
    </div>
    <table class="table_content2" width="100%">
<? if (isset($effects)): ?>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Parent List</th>
        <th width="5%"></th>
      </tr>
<?
    $x=0;
    foreach($effects as $effect):
?>
      <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
        <td align="center"><?=$effect['id']?></td>
        <td align="center"><?=$effect['name']?></td>
        <td align="center"><?echo ($effect['parent_list'] == 0) ? "None" : $effect['parent_list'];?></td>
        <td align="right"><a href="index.php?editor=spells&action=12&nseid=<?=$effect['id']?>"><img src="images/edit2.gif" width="13" height="13" border="0" title="View NPC Spells Effects Entries"></a></td>
      </tr>
<?
      $x++;
    endforeach;
  else:
?>
      <tr>
        <td align="left" width="100" style="padding:10px;">No NPC Spells Effects</td>
      </tr>
<?endif;?>
    </table>
  </div>
