      <div class="edit_form" style="width: 200px;">
        <div class="edit_form_header">
          Edit Recipe <?=$id?>
        </div>
        <div class="edit_form_content">
          <form method="post" action="index.php?editor=tradeskill&ts=<?=$ts?>&rec=<?=$rec?>&action=2">
            Recipe Name: <br>
            <input type="text" name="name" value="<?=$name?>"><br><br>
            Tradeskill Used: <br>
            <select name='tradeskill'>
<?foreach($tradeskills as $k=>$v):?>
              <option value="<?=$k?>"<?echo($k == $tradeskill) ? " selected" : ""?>><?=$v?></option>
<?endforeach;?>
            </select><br><br>
            Min Skill Needed: <br>
            <input type="text" name="skillneeded" size="5" value="<?=$skillneeded?>"><br><br>
		  			Trivial:<br>
            <input type="text" name="trivial"  size="5" value="<?=$trivial?>"><br><br>
            Is Recipe No-fail? <br>
            <select name='nofail'>
              <option value="0"<?echo($nofail == 0) ? " selected" : ""?>>no</option>
              <option value="1"<?echo($nofail == 1) ? " selected" : ""?>>yes</option>
            </select><br><br>
		  			Replace Combine Container?<br>
            <select name="replace_container">
              <option value="0"<?echo($replace_container == 0) ? " selected" : ""?>>no</option>
              <option value="1"<?echo($replace_container == 1) ? " selected" : ""?>>yes</option>
            </select><br><br>
	  				Notes:<br>
            <input type="text" name="notes" value="<?=$notes?>"><br><br>
            <center>
              <input type="hidden" name="id" value="<?=$id?>">
              <input type="submit" name="submit" value="Submit Changes">
            </center>
          </form>
        </div>
      </div>