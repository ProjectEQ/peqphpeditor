<center>
        <iframe id='searchframe' src='templates/iframes/spellsearch.php'></iframe>
        <input id="button" type="button" value='Hide Spell Search' onclick='hideSearch();' style='display:none; margin-bottom: 20px;'>
      </center>
        
      <div class="table_container" style="width: 225px">
        <div class="edit_form_header">
            Edit Trap Template <?=$id?> 
        </div>
        <div class="edit_form_content">
          <form method="post" action="index.php?editor=adventures&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=14">
            <td align="left" width="25%"><strong>Type:</strong><br>
                 <select name="type" style="width: 125px;">
<?foreach($ldontraptype as $key=>$value):?>
                   <option value="<?=$key?>"<?echo ($key == $type)? " selected" : "";?>><?=$key?>: <?=$value?></option>
<?endforeach;?>
                 </select></td><br><br>
              <strong>Spell ID:</strong> (<a href="javascript:showSearch();">search</a>)<br>
              <input class="indented" id="id" type="text" name="spell_id" size="5" value="<?=$spell_id?>"><br><br>
              <strong>Skill:</strong> <br>
              <input class="indented" type="text" name="skill" size="5" value="<?=$skill?>"><br><br>

              <td align="left" width="25%">
               <strong>  Locked:</strong>  <br>
			      <select name="locked">
			      <option value="0"<?echo ($locked == 0) ? " selected" : ""?>>No</option>
			      <option value="1"<?echo ($locked == 1) ? " selected" : ""?>>Yes</option>
			     </select>
			   </td>
            <center>
              <input type="hidden" name="id" value="<?=$id?>">
              <input type="submit" name="submit" value="Submit">
            </center>
          </form>
        </div>
      </div>