  <center>
    <iframe id='searchframe' src='templates/iframes/spellsearch.php'></iframe>
    <input id="button" type="button" value='Hide Spell Search' onclick='hideSearch();' style='display:none; margin-bottom: 20px;'>
  </center>
  <div class="table_container" style="width: 500px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td>Edit Trap Template</td>
        </tr>
      </table>
    </div>
    <div class="table_content">
      <form name="edit_template" method="post" action="index.php?editor=misc&action=68">
        <table width="100%" cellpadding="3" cellspacing="3">
          <tr>
            <td>
              <strong>ID:</strong><br>
              <input type="text" size="10" value="<?=$template['id']?>" disabled>
            </td>
            <td>
              <strong>Type:</strong><br>
              <input type="text" name="type" size="10" value="<?=$template['type']?>">
            </td>
            <td>
              <strong>Spell:</strong> (<a href="javascript:showSearch();">search</a>)<br>
              <input type="text" id="id" name="spell_id" size="10" value="<?=$template['spell_id']?>">
            </td>
            <td>
              <strong>Skill:</strong><br>
              <input type="text" name="skill" size="10" value="<?=$template['skill']?>">
            </td>
            <td>
              <strong>Locked:</strong><br>
              <select name="locked">
                <option value="0"<?echo ($template['locked'] == 0) ? " selected" : "";?>>No</option>
                <option value="1"<?echo ($template['locked'] != 0) ? " selected" : "";?>>Yes</option>
              </select>
            </td>
          </tr>
        </table><br>
        <center>
          <input type="hidden" name="id" value="<?=$template['id']?>">
          <input type="submit" value="Update Template">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back()">
        </center>
      </form>
    </div>
  </div>
