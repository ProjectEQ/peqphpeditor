  <div class="edit_form" style="width: 350px;">
    <div class="edit_form_header">Edit Recipe</div>
    <div class="edit_form_content">
      <form method="post" action="index.php?editor=tradeskill&ts=<?=$ts?>&rec=<?=$rec?>&action=2">
        <strong>Recipe ID:</strong><br>
        <input type="text" size="7" value="<?=$id?>" disabled><br><br>
        <strong>Recipe Name:</strong><br>
        <input type="text" name="name" size="41" value="<?=$name?>"><br><br>
        <strong>Tradeskill Used:</strong><br>
        <select name='tradeskill'>
<?foreach($tradeskills as $k=>$v):?>
          <option value="<?=$k?>"<?echo ($k == $tradeskill) ? ' selected' : '';?>><?=$v?></option>
<?endforeach;?>
        </select><br><br>
        <strong>Min Skill Needed:</strong><br>
        <input type="text" name="skillneeded" size="5" value="<?=$skillneeded?>"><br><br>
        <strong>Trivial:</strong><br>
        <input type="text" name="trivial" size="5" value="<?=$trivial?>"><br><br>
        <strong>Is Recipe No-fail?</strong><br>
        <select name='nofail'>
          <option value="0"<?echo ($nofail == 0) ? " selected" : "";?>>no</option>
          <option value="1"<?echo ($nofail == 1) ? " selected" : "";?>>yes</option>
        </select><br><br>
        <strong>Replace Combine Container?</strong><br>
        <select name="replace_container">
          <option value="0"<?echo ($replace_container == 0) ? " selected" : "";?>>no</option>
          <option value="1"<?echo ($replace_container == 1) ? " selected" : "";?>>yes</option>
        </select><br><br>
        <strong>Quest Controlled?</strong><br>
        <select name='quest'>
          <option value="0"<?echo ($quest == 0) ? " selected" : "";?>>no</option>
          <option value="1"<?echo ($quest == 1) ? " selected" : "";?>>yes</option>
        </select><br><br>
        <fieldset>
          <legend><strong>Learn Flag</strong></legend>
          <strong>Learned:</strong>
          <select name='l_method' onChange="javascript:updateLearn();">
            <option value="0"<?echo ($l_method == 0) ? " selected" : "";?>>Not Learned</option>
            <option value="1"<?echo ($l_method == 1) ? " selected" : "";?>>Quest</option>
            <option value="2"<?echo ($l_method == 2) ? " selected" : "";?>>Experiment</option>
          </select><br><br>
          <strong>Client Message:</strong>
          <select name='l_message' onChange="javascript:updateLearn();">
            <option value="0"<?echo ($l_message == 0) ? " selected" : "";?>>Yes</option>
            <option value="16"<?echo ($l_message == 16) ? " selected" : "";?>>No</option>
          </select><br><br>
          <strong>UI Searchable:</strong>
          <select name='l_search' onChange="javascript:updateLearn();">
            <option value="0"<?echo ($l_search == 0) ? " selected" : "";?>>Yes</option>
            <option value="32"<?echo ($l_search == 32) ? " selected" : "";?>>No</option>
          </select><br><br>
          <strong>Learn Item ID:</strong><br>
          <input type="text" name="learned_by_item_id" size="10" value="<?=$learned_by_item_id?>">
        </fieldset><br>
        <strong>Enabled:</strong><br>
        <select name="enabled">
          <option value="0"<?echo ($enabled == 0) ? " selected" : "";?>>no</option>
          <option value="1"<?echo ($enabled == 1) ? " selected" : "";?>>yes</option>
        </select><br><br>
        <strong>Min Expansion:</strong><br>
        <input type="text" name="min_expansion" size="7" value="<?=$min_expansion?>"><br><br>
        <strong>Max Expansion:</strong><br>
        <input type="text" name="max_expansion" size="7" value="<?=$max_expansion?>"><br><br>
        <strong>Content Flags:</strong><br>
        <input type="text" name="content_flags" size="41" value="<?=$content_flags?>"><br><br>
        <strong>Content Flags Disabled:</strong><br>
        <input type="text" name="content_flags_disabled" size="41" value="<?=$content_flags_disabled?>"><br><br>
        <strong>Notes:</strong><br>
        <input type="text" name="notes" size="41" value="<?=$notes?>"><br><br><br>
        <center>
          <input type="hidden" name="id" value="<?=$id?>">
          <input type="hidden" name="must_learn" value="<?=$must_learn?>">
          <input type="submit" name="submit" value="Update Recipe">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back();">
        </center>
      </form>
    </div>
  </div>
