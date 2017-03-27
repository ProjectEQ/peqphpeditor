<?
  if (isset($ts) && ($ts > 0))
    $selected_skill = $tradeskills[$ts];
?>
  <table class="edit_form">
    <tr>
      <td class="edit_form_header">
        Tradeskill Options
      </td>
    </tr>
    <tr>
      <td class="edit_form_content" align="center">
        <a href="index.php?editor=tradeskill&action=10<?echo ($selected_skill != '') ? '&ts=' . $ts : '';?>">Create a New <?echo ($selected_skill != '') ? $selected_skill . ' ' : '';?>Recipe</a><br>
        <a href="index.php?editor=tradeskill&action=13">View Learned Recipes</a>
      </td>
    </tr>
  </table>
