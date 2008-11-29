      <center>
        <iframe id='searchframe' src='templates/iframes/spellsearch.php'></iframe>
        <input id="button" type="button" value='Hide Spell Search' onclick='hideSearch();' style='display:none; margin-bottom: 20px;'>
      </center>
        
      <div class="table_container" style="width: 225px">
        <div class="edit_form_header">
            Edit Spellset
        </div>
        <div class="edit_form_content">
          <form method="post" action="index.php?editor=spellset&z=<?=$currzone?>&npcid=<?=$npcid?>&spellset=<?=$spellset?>&action=2">
            <strong>Spellset Name:</strong><br>
            <input class="indented" type="text" name="name" size="25" value="<?=$name?>"><br><br>
            <fieldset>
              <legend><strong>Attack Proc</strong></legend>
              <strong>Spell ID:</strong> (<a href="javascript:showSearch();">search</a>)<br>
              <input class="indented" id="id" type="text" name="attack_proc" size="10" value="<?=$attack_proc?>"><br>
              (-1 = No Proc)<br><br>
              <strong>Chance:</strong> <br>
              <input class="indented" type="text" name="proc_chance" size="2" value="<?=$proc_chance?>">%
            </fieldset><br>

            <strong>Parent list:</strong><br>
              <input class="indented" type="text" name="parent_list" size="10" value="<?=$parent_list?>"><br><br>
            <center>
              <input type="hidden" name="id" value="<?=$id?>">
              <input type="submit" name="submit" value="Submit">
            </center>
          </form>
        </div>
      </div>