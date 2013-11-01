      <div class="edit_form" style="width: 250px;">
        <div class="edit_form_header">
          Edit Recipe <?=$id?>
        </div>
        <div class="edit_form_content">
          <form method="post" action="index.php?editor=tradeskill&ts=<?=$ts?>&rec=<?=$rec?>&action=2">
            Recipe Name: <br/>
            <input type="text" name="name" size="30" value="<?=$name?>"><br/><br/>
            Tradeskill Used: <br/>
            <select name='tradeskill'>
<?foreach($tradeskills as $k=>$v):?>
              <option value="<?=$k?>"<?echo($k == $tradeskill) ? " selected" : ""?>><?=$v?></option>
<?endforeach;?>
            </select><br/><br/>
            Min Skill Needed: <br/>
            <input type="text" name="skillneeded" size="5" value="<?=$skillneeded?>"><br/><br/>
            Trivial:<br/>
            <input type="text" name="trivial"  size="5" value="<?=$trivial?>"><br/><br/>
            Is Recipe No-fail? <br/>
            <select name='nofail'>
              <option value="0"<?echo($nofail == 0) ? " selected" : ""?>>no</option>
              <option value="1"<?echo($nofail == 1) ? " selected" : ""?>>yes</option>
            </select><br/><br/>
            Replace Combine Container?<br/>
            <select name="replace_container">
              <option value="0"<?echo($replace_container == 0) ? " selected" : ""?>>no</option>
              <option value="1"<?echo($replace_container == 1) ? " selected" : ""?>>yes</option>
            </select><br/><br/>
            Quest Controlled? <br/>
            <select name='quest'>
              <option value="0"<?echo($quest == 0) ? " selected" : ""?>>no</option>
              <option value="1"<?echo($quest == 1) ? " selected" : ""?>>yes</option>
            </select><br/><br/>
            <fieldset>
              <legend>Learn Flag</legend>
              Learned:
              <select name='l_method' onChange="javascript:updateLearn();">
                <option value="0"<?echo ($l_method == 0) ? " selected" : "";?>>Not Learned</option>
                <option value="1"<?echo ($l_method == 1) ? " selected" : "";?>>Quest</option>
                <option value="2"<?echo ($l_method == 2) ? " selected" : "";?>>Experiment</option>
              </select><br/><br/>
              Client Message:
              <select name='l_message' onChange="javascript:updateLearn();">
                <option value="0"<?echo ($l_message == 0) ? " selected" : "";?>>Yes</option>
                <option value="16"<?echo ($l_message == 16) ? " selected" : "";?>>No</option>
              </select><br/><br/>
              UI Searchable:
              <select name='l_search' onChange="javascript:updateLearn();">
                <option value="0"<?echo ($l_search == 0) ? " selected" : "";?>>Yes</option>
                <option value="32"<?echo ($l_search == 32) ? " selected" : "";?>>No</option>
              </select>
            </fieldset><br/>
            Enabled:<br/>
            <select name="enabled">
              <option value="0"<?echo ($enabled == 0) ? " selected" : ""?>>no</option>
              <option value="1"<?echo ($enabled == 1) ? " selected" : ""?>>yes</option>
            </select><br/><br/>
            Notes:<br/>
            <input type="text" name="notes" size="30" value="<?=$notes?>"><br/><br/>
            <center>
              <input type="hidden" name="id" value="<?=$id?>">
              <input type="hidden" name="must_learn" value="<?=$must_learn?>">
              <input type="submit" name="submit" value="Submit Changes">
            </center>
          </form>
        </div>
      </div>
