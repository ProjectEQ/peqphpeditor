  <table class="edit_form">
    <tr>
      <td class="edit_form_header">Character Experience Modifiers</td>
    </tr>
    <tr>
      <td class="edit_form_content">
        <form name="exp_mod" method="post" action="index.php?editor=player&playerid=<?=$playerid?>&action=10">
          Character:<br>
          <input type="text" size="10" value="<?=$playerid?>" disabled><br><br>
          Zone:<br>
          <select name="zone_id" id="zoneid" onchange="populateVersions();">
            <option value="0">Global</option>
<? foreach ($zonelist as $zone): ?>
            <option value="<?=$zone['zoneidnumber']?>"><?=$zone['short_name']?></option>
<? endforeach; ?>
          </select><br><br>
          Version:<br>
          <select name="instance_version" id="zoneversion" style="width: 75px;">
            <option value="-1">-1</option>
          </select>
          <br><br>
          Base Exp Mod:<br>
          <input type="text" name="exp_modifier" size="10" value="1.0"><br><br>
          AA Exp Mod:<br>
          <input type="text" name="aa_modifier" size="10" value="1.0"><br><br>
          <center>
            <input type="hidden" name="character_id" value="<?=$playerid?>">
            <input type="submit" value="Add">&nbsp;&nbsp;
            <input type="button" value="Cancel" onClick="history.back();">
          </center>
        </form>
      </td>
    </tr>
  </table>
