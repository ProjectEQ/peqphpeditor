  <div class="edit_form" style="width:250px;">
    <div class="edit_form_header">
      Edit Level and Cost of Rank: <?=$rank?><br>
    </div>
    <div class="edit_form_content">
      <form name="aa_level" method="post" action="index.php?editor=aa&aaid=<?=$aaid?>&rank=<?=$rank?>&action=20">
        Level:<br>
        <input type="text" name="level" size="5" value="<?=$level?>"><br><br>
        Cost:<br>
        <input type="text" name="cost" size="5" value="<?=$cost?>"><br><br>
        Description:<br>
        <input type="text" name="description" size="30" value="<?=$description?>"><br><br>
        <center><input type="submit" value="Sumbit Changes"></center>
      </form>
    </div>
  </div>
