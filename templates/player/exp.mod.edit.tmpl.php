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
          <select disabled>
            <option value="0"<?echo $exp_mods['zone_id'] == 0 ? "selected" : "";?>>Global</option>
<? foreach ($zonelist as $zone): ?>
            <option value="<?=$zone['zoneidnumber']?>"<?echo ($zone['zoneidnumber'] == $exp_mods['zone_id']) ? " selected" : "";?>><?=$zone['short_name']?></option>
<? endforeach; ?>
          </select><br><br>
          Version:<br>
          <input type="text" name="instance_version" size="10" value="<?=$exp_mods['instance_version']?>"><br><br>
          Base Exp Mod:<br>
          <input type="text" name="exp_modifier" size="10" value="<?=$exp_mods['exp_modifier']?>"><br><br>
          AA Exp Mod:<br>
          <input type="text" name="aa_modifier" size="10" value="<?=$exp_mods['aa_modifier']?>"><br><br>
          <center>
            <input type="hidden" name="character_id" value="<?=$playerid?>">
            <input type="hidden" name="zone_id" value="<?=$exp_mods['zone_id']?>">
            <input type="submit" value="Update">&nbsp;&nbsp;
            <input type="button" value="Cancel" onClick="history.back();">
          </center>
        </form>
      </td>
    </tr>
  </table>
