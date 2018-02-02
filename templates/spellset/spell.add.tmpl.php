      <center>
        <iframe id='searchframe' src='templates/iframes/spellsearch.php'></iframe>
        <input id="button" type="button" value='Hide Spell Search' onclick='hideSearch();' style='display:none; margin-bottom: 20px;'>
      </center>
        
      <div class="table_container" style="width: 150px">
        <div class="edit_form_header">
            Add a Spell
        </div>
        <div class="edit_form_content">
          <form method="post" action="index.php?editor=spellset&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&spellset=<?=$spellset?>&action=4">
            <strong>Spell ID:</strong> (<a href="javascript:showSearch();">search</a>)<br>
            <input class="indented" id="id" type="text" name="spellid" size="10" value="0"><br><br>

            <strong>Type:</strong> <br>
            <select class = "indented" name="type">
<?foreach($spelltypes as $k => $v):?>
              <option value="<?=$k?>"><?=$v?></option>
<?endforeach;?>
            </select><br><br>

            <strong>Minlevel:</strong><br>
            <input class="indented" id="id" type="text" name="minlevel" size="10" value="1"><br><br>

            <strong>Maxlevel:</strong><br>
            <input class="indented" id="id" type="text" name="maxlevel" size="10" value="255"><br><br>

            <strong>Mana Cost:</strong><br>
            <input class="indented" id="id" type="text" name="manacost" size="10" value="-1"><br>
            (-1 = Default)<br><br>

            <strong>Recast Delay:</strong><br>
            <input class="indented" id="id" type="text" name="recast_delay" size="10" value="-1"><br>
            (-1 = Default)<br><br>

            <strong>Priority:</strong><br>
            <input class="indented" id="id" type="text" name="priority" size="10" value="0"><br>
            (0 = Innate)<br><br>

            <strong>Resist Adjust:</strong><br>
            <input class="indented" type="text" name="resist_adjust" size="10" value=""><br>
            (blank = Default)<br><br>

            <strong>Min HP:</strong><br>
            <input class="indented" type="text" name="min_hp" size="10" value="0"><br><br>

            <strong>Max HP:</strong><br>
            <input class="indented" type="text" name="max_hp" size="10" value="0"><br><br>

            <center>
              <input type="hidden" name="npc_spells_id" value="<?=$npc_spells_id?>">
              <input type="submit" name="submit" value="Submit">
            </center>
          </form>
        </div>
      </div>