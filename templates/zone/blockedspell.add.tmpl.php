      <center>
        <iframe id='searchframe' src='templates/iframes/spellsearch.php'></iframe>
        <input id="button" type="button" value='Hide Spell Search' onclick='hideSearch();' style='display:none; margin-bottom: 20px;'>
      </center>

        <form name="blockedspell" method="post" action=index.php?editor=zone&z=<?=$currzone?>&action=23">
         <div class="edit_form" style="width: 225px;">
        <div class="edit_form_header">
          Add Blocked Spell
        </div>
         <div class="edit_form_content">
            <strong>Spell ID</strong> (<a href="javascript:showSearch();">search</a>)<br>
            <input class="indented" id="id" type="text" name="spellid" size="7" value="0"><br><br>
            <strong>ID</strong><br>
            <input class="indented" id="id" type="text" name="bsid" size="7" value="<?=$suggestbsid?>"><br><br>
            <strong>Zone</strong><br>
            <input class="indented" id="id" type="text" name="zoneid" size="7" value="<?=$zid?>"><br><br>
            <strong>Type</strong><br>
            <td align="left" width="25%">
			      <select name="type">
			      <option value="0"<?echo ($type == 0) ? " selected" : ""?>>Not Blocked</option>
			      <option value="1"<?echo ($type == 1) ? " selected" : ""?>>Zone Wide</option>
                           <option value="2"<?echo ($type == 2) ? " selected" : ""?>>Coords</option>
                 </select>
                </td><br><br>
            <strong>X</strong><br>
            <input class="indented" id="id" type="text" name="x_coord" size="7" value="0"><br><br>
            <strong>Y</strong><br>
            <input class="indented" id="id" type="text" name="y_coord" size="7" value="0"><br><br>
            <strong>Z</strong><br>
            <input class="indented" id="id" type="text" name="z_coord" size="7" value="0"><br><br>
            <strong>X Diff</strong><br>
            <input class="indented" id="id" type="text" name="x_diff" size="7" value="0"><br><br>
            <strong>Y Diff</strong><br>
            <input class="indented" id="id" type="text" name="y_diff" size="7" value="0"><br><br>
            <strong>Z Diff</strong><br>
            <input class="indented" id="id" type="text" name="z_diff" size="7" value="0"><br><br>
            <strong>Message</strong><br>
            <input class="indented" id="id" type="text" name="message" size="27" value=""><br><br>
             <strong>Description</strong><br>
            <input class="indented" id="id" type="text" name="description" size="27" value=""%><br><br>


        <center>
          <input type="submit" value="Submit Changes">
        </center>
      </form>
      </div>
      </div>