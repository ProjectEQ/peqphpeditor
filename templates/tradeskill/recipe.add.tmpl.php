  <div class="edit_form" style="width: 350px;">
    <div class="edit_form_header">Create New Recipe</div>
    <div class="edit_form_content">
      <form method="post" action="index.php?editor=tradeskill&action=11">
        <strong>Recipe ID:</strong><br>
        <input type="text" name="id" size="7" value="<?=$id?>"><br><br>
        <strong>Recipe Name:</strong><br>
        <input type="text" name="name" size="41" value=""><br><br>
        <strong>Tradeskill Used:</strong><br>
        <select name='tradeskill'>
<?foreach($tradeskills as $k=>$v):?>
          <option value="<?=$k?>"<?echo (isset($ts) && $k == $ts) ? ' selected' : '';?>><?=$v?></option>
<?endforeach;?>
        </select><br><br>
        <strong>Min Skill Needed:</strong><br>
        <input type="text" name="skillneeded" size="5" value="0"><br><br>
        <strong>Trivial:</strong><br>
        <input type="text" name="trivial" size="5" value="0"><br><br>
        <strong>Is Recipe No-fail?</strong><br>
        <select name='nofail'>
          <option value="0">no</option>
          <option value="1">yes</option>
        </select><br><br>
        <strong>Replace Combine Container?</strong><br>
        <select name="replace_container">
          <option value="0">no</option>
          <option value="1">yes</option>
        </select><br><br>
        <strong>Quest Controlled?</strong><br>
        <select name='quest'>
          <option value="0" selected>no</option>
          <option value="1">yes</option>
        </select><br><br>
        <fieldset>
          <legend><strong>Learn Flag</strong></legend>
          <strong>Learned:</strong>
          <select name='l_method' onChange="javascript:updateLearn();">
            <option value="0" selected>Not Learned</option>
            <option value="1">Quest</option>
            <option value="2">Experiment</option>
          </select><br><br>
          <strong>Client Message:</strong>
          <select name='l_message' onChange="javascript:updateLearn();">
            <option value="0" selected>Yes</option>
            <option value="16">No</option>
          </select><br><br>
          <strong>UI Searchable:</strong>
          <select name='l_search' onChange="javascript:updateLearn();">
            <option value="0" selected>Yes</option>
            <option value="32">No</option>
          </select><br><br>
          <strong>Learn Item ID:</strong><br>
          <input type="text" name="learned_by_item_id" size="10" value="0">
        </fieldset><br>
        <strong>Enabled:</strong><br>
        <select name="enabled">
          <option value="0">no</option>
          <option value="1" selected>yes</option>
        </select><br><br>
        <strong>Min Expansion:</strong><br>
        <input type="text" name="min_expansion" size="7" value="-1"><br><br>
        <strong>Max Expansion:</strong><br>
        <input type="text" name="max_expansion" size="7" value="-1"><br><br>
        <strong>Content Flags:</strong><br>
        <input type="text" name="content_flags" size="41" value=""><br><br>
        <strong>Content Flags Disabled:</strong><br>
        <input type="text" name="content_flags_disabled" size="41" value=""><br><br>
        <strong>Notes:</strong><br>
        <input type="text" name="notes" size="41" value=""><br><br><br>
        <center>
          <input type="hidden" name="must_learn" value="0">
          <input type="submit" name="submit" value="Add Recipe">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back();">
        </center>
      </form>
    </div>
  </div>
