      <center>
        <iframe id='searchframe' src='templates/iframes/spellsearch.php'></iframe>
        <input id="button" type="button" value='Hide Spell Search' onclick='hideSearch();' style='display:none; margin-bottom: 20px;'>
      </center>
        
      <div class="table_container" style="width: 225px">
        <div class="edit_form_header">
            Edit Spellset
        </div>
        <div class="edit_form_content">
          <form method="post" action="index.php?editor=spellset&z=<?=$currzone?>&npcid=<?=$npcid?>&action=11">
            <strong>Suggested ID:</strong><br>
            <input class="indented" type="text" name="id" size="10" value="<?=$id?>"><br><br>

            <strong>Spellset Name:</strong><br>
            <input class="indented" type="text" name="name" size="25" value="<?=$name?>"><br><br>
            <fieldset>
              <legend><strong>Attack Proc</strong></legend>
              <strong>Spell ID:</strong> (<a href="javascript:showSearch();">search</a>)<br>
              <input class="indented" id="id" type="text" name="attack_proc" size="10" value="-1"><br>
              (-1 = No Proc)<br><br>
              <strong>Chance:</strong> <br>
              <input class="indented" type="text" name="proc_chance" size="2" value="3">%
            </fieldset><br>

            <strong>Parent list:</strong><br>
              <input class="indented" type="text" name="parent_list" size="10" value="0"><br><br>
            <center>
              <input type="submit" name="submit" value="Submit">
            </center>
          </form>
        </div>
      </div>