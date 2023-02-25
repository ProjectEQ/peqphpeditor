  <center>
    <iframe id='searchframe' src='templates/iframes/spellsearch.php'></iframe>
    <input id="button" type="button" value='Hide Spell Search' onclick='hideSearch();' style='display:none; margin-bottom: 20px;'>
  </center>
  <div class="table_container" style="width: 500px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td>Create Trap Template</td>
        </tr>
      </table>
    </div>
    <div class="table_content">
      <form name="add_template" method="post" action="index.php?editor=misc&action=66">
        <table width="100%" cellpadding="3" cellspacing="3">
          <tr>
            <td>
              <strong>ID:</strong><br>
              <input type="text" name="id" size="10" value="<?=$suggest_id?>">
            </td>
            <td>
              <strong>Type:</strong><br>
              <input type="text" name="type" size="10" value="1">
            </td>
            <td>
              <strong>Spell:</strong> (<a href="javascript:showSearch();">search</a>)<br>
              <input type="text" id="id" name="spell_id" size="10" value="0">
            </td>
            <td>
              <strong>Skill:</strong><br>
              <input type="text" name="skill" size="10" value="0">
            </td>
            <td>
              <strong>Locked:</strong><br>
              <select name="locked">
                <option value="0">No</option>
                <option value="1">Yes</option>
              </select>
            </td>
          </tr>
        </table><br>
        <center>
          <input type="submit" value="Insert Template">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back()">
        </center>
      </form>
    </div>
  </div>
