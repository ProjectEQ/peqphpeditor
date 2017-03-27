  <div class="edit_form" style="width: 250px;">
    <div class="edit_form_header">
      Create a new Recipe
    </div>
    <div class="edit_form_content">
      <form method="post" action="index.php?editor=tradeskill&action=11">
        Recipe Name:<br>
        <input type="text" name="name" size="30" value=""><br><br>
        Tradeskill Used:<br>
        <select name='tradeskill'>
<?foreach($tradeskills as $k=>$v):?>
          <option value="<?=$k?>"<?echo ($k == $ts) ? ' selected' : '';?>><?=$v?></option>
<?endforeach;?>
        </select><br><br>
        Min Skill Needed:<br>
        <input type="text" name="skillneeded" size="5" value="0"><br><br>
        Trivial:<br>
        <input type="text" name="trivial" size="5" value="0"><br><br>
        Is Recipe No-fail?<br>
        <select name='nofail'>
          <option value="0">no</option>
          <option value="1">yes</option>
        </select><br><br>
        Replace Combine Container?<br>
        <select name="replace_container">
          <option value="0">no</option>
          <option value="1">yes</option>
        </select><br><br>
        Quest Controlled?<br>
        <select name='quest'>
          <option value="0" selected>no</option>
          <option value="1">yes</option>
        </select><br><br>
        <fieldset>
          <legend>Learn Flag</legend>
          Learned:
          <select name='l_method' onChange="javascript:updateLearn();">
            <option value="0" selected>Not Learned</option>
            <option value="1">Quest</option>
            <option value="2">Experiment</option>
          </select><br><br>
          Client Message:
          <select name='l_message' onChange="javascript:updateLearn();">
            <option value="0" selected>Yes</option>
            <option value="16">No</option>
          </select><br><br>
          UI Searchable:
          <select name='l_search' onChange="javascript:updateLearn();">
            <option value="0" selected>Yes</option>
            <option value="32">No</option>
          </select>
        </fieldset><br>
        Enabled:<br>
        <select name="enabled">
          <option value="0">no</option>
          <option value="1" selected>yes</option>
        </select><br><br>
        Notes:<br>
        <input type="text" name="notes" size="30" value=""><br><br>
        <center>
          <input type="hidden" name="must_learn" value="0">
          <input type="submit" name="submit" value="Add Recipe">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back();">
        </center>
      </form>
    </div>
  </div>
