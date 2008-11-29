      <div class="edit_form" style="width: 200px;">
        <div class="edit_form_header">
          Create a new Recipe
        </div>
        <div class="edit_form_content">
          <form method="post" action="index.php?editor=tradeskill&action=11">
            Recipe Name: <br>
            <input type="text" name="name" value=""><br><br>
            Tradeskill Used: <br>
            <select name='tradeskill'>
<?foreach($tradeskills as $k=>$v):?>
              <option value="<?=$k?>"><?=$v?></option>
<?endforeach;?>
            </select><br><br>
            Min Skill Needed: <br>
            <input type="text" name="skillneeded" size="5" value=""><br><br>
		  			Trivial:<br>
            <input type="text" name="trivial" size="5" value=""><br><br>
            Is Recipe No-fail? <br>
            <select name='nofail'>
              <option value="0">no</option>
              <option value="1">yes</option>
            </select><br><br>
		  			Replace Combine Container?<br>
            <select name="replace_container">
              <option value="0">no</option>
              <option value="1">yes</option>
            </select><br><br>
	  				Notes:<br>
            <input type="text" name="notes" value=""><br><br>
            <center>
              <input type="submit" name="submit" value="Submit Changes">
            </center>
          </form>
        </div>
      </div>