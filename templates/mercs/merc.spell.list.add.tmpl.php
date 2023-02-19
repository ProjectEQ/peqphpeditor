  <div class="table_container" style="width: 750px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td>Create Mercenary Spell List</td>
        </tr>
      </table>
    </div>
    <div class="table_content">
      <form name="add_mercenary_spell_list" method="post" action="index.php?editor=mercs&action=39">
        <table width="100%" cellpadding="5" cellspacing="5">
          <tr>
            <td>
              <strong>ID:</strong><br>
              <input type="text" name="merc_spell_list_id" size="10" value="<?=$suggest_id?>">
            </td>
            <td>
              <strong>Class:</strong><br>
              <select name="class_id">
<?foreach ($classes as $k=>$v):?>
                <option value="<?=$k?>"><?=$v?> (<?=$k?>)</option>
<?endforeach;?>
              </select>
            </td>
            <td>
              <strong>Proficiency:</strong><br>
              <input type="text" name="proficiency_id" size="10" value="">
            </td>
            <td>
              <strong>Name:</strong><br>
              <input type="text" name="name" size="30" value="">
            </td>
        </table><br>
        <center>
          <input type="submit" value="Insert List">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back()">
        </center>
      </form>
    </div>
  </div>
