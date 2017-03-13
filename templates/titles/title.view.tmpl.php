  <div class="table_container" style="width: 700px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td>View Title</td>
          <td>
            <div style="float:right">
              <a href="index.php?editor=titles&title_id=<?=$title['id']?>&action=4"><img src="images/edit2.gif" border="0" title="Edit this title"></a>
              <a onClick="return confirm('Really delete title <?=$title['id']?>?');" href="index.php?editor=titles&title_id=<?=$title['id']?>&action=6"><img src="images/remove2.gif" border="0" title="Delete this title"></a>
            </div>
          </td>
        </tr>
      </table>
    </div>
    <table class="table_content" width="100%" cellpadding="3" cellspacing="0">
      <tr>
        <td><strong>ID:</strong> <?=$title['id']?><br><br></td>
        <td><strong>Skill:</strong> <?=$skilltypes[$title['skill_id']];?><br><br></td>
        <td><strong>Min Skill:</strong> <?echo ($title['min_skill_value'] == -1) ? "N/A" : $title['min_skill_value'];?><br><br></td>
        <td><strong>Max Skill:</strong> <?echo ($title['max_skill_value'] == -1) ? "N/A" : $title['max_skill_value'];?><br><br></td>
        <td><strong>Min AA:</strong> <?echo ($title['min_aa_points'] == -1) ? "N/A" : $title['min_aa_points'];?><br><br></td>
        <td><strong>Max AA:</strong> <?echo ($title['max_aa_points'] == -1) ? "N/A" : $title['max_aa_points'];?><br><br></td>
      </tr>
      <tr>
        <td><strong>Class:</strong> <?echo ($title['class'] == -1) ? "N/A" : $classes[$title['class']];?><br><br></td>
        <td><strong>Gender:</strong> <?echo ($title['gender'] == -1) ? "N/A" : $genders[$title['gender']];?><br><br></td>
        <td><strong>Character:</strong> <?echo ($title['char_id'] == -1) ? "N/A" : ((getPlayerName($title['char_id']) == "") ? "<font color='red'>Missing</font>" : getPlayerName($title['char_id']));?><br><br></td>
        <td><strong>Status:</strong> <?echo ($title['status'] == -1) ? "N/A" : $title['status'];?><br><br></td>
        <td><strong>Item ID:</strong> <?echo ($title['item_id'] == -1) ? "N/A" : "<a href='http://lucy.allakhazam.com/item.html?id=" . $title['item_id'] . "' target='_blank'>" . $title['item_id'] . "</a>";?><br><br></td>
        <td><strong>Title Set:</strong> <?echo ($title['title_set'] == 0) ? "N/A" : $title['title_set'];?><br><br></td>
      </tr>
      <tr>
        <td colspan="3" width="50%"><strong>Prefix:</strong> <?=$title['prefix']?></td>
        <td colspan="3" width="50%"><strong>Suffix:</strong> <?=$title['suffix']?></td>
      </tr>
    </table>
  </div>
