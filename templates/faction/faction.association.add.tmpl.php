  <div style="width: 450px; margin: auto;">
    <form name="faction" method="post" action="index.php?editor=faction&action=27">
      <div style="border: 1px solid black;">
        <div class="edit_form_header">&nbsp;</div>
        <div class="edit_form_content">
          <table width="100%" cellpadding="5" cellspacing="3">
            <tr>
              <td width="100%" colspan="2">
                <strong>ID:</strong><br>
                <select name="id">
<?foreach ($factions as $faction):?>
                  <option value="<?=$faction['id']?>"<?echo ($faction['id'] == 0) ? " selected" : "";?>><?=$faction['name']?> (<?=$faction['id']?>)</option>
<?endforeach;?>
                </select>
              </td>
            </tr>
            <tr>
              <td>
                <strong>ID 1:</strong><br>
                <select name="id_1">
<?foreach ($factions as $faction):?>
                  <option value="<?=$faction['id']?>"<?echo ($faction['id'] == 0) ? " selected" : "";?>><?=$faction['name']?> (<?=$faction['id']?>)</option>
<?endforeach;?>
                </select>
              </td>
              <td><strong>Mod 1:</strong><br><input size="10" type="text" name="mod_1" value="0.0"></td>
            </tr>
            <tr>
              <td>
                <strong>ID 2:</strong><br>
                <select name="id_2">
<?foreach ($factions as $faction):?>
                  <option value="<?=$faction['id']?>"<?echo ($faction['id'] == 0) ? " selected" : "";?>><?=$faction['name']?> (<?=$faction['id']?>)</option>
<?endforeach;?>
                </select>
              </td>
              <td><strong>Mod 2:</strong><br><input size="10" type="text" name="mod_2" value="0.0"></td>
            </tr>
            <tr>
              <td>
                <strong>ID 3:</strong><br>
                <select name="id_3">
<?foreach ($factions as $faction):?>
                  <option value="<?=$faction['id']?>"<?echo ($faction['id'] == 0) ? " selected" : "";?>><?=$faction['name']?> (<?=$faction['id']?>)</option>
<?endforeach;?>
                </select>
              </td>
              <td><strong>Mod 3:</strong><br><input size="10" type="text" name="mod_3" value="0.0"></td>
            </tr>
            <tr>
              <td>
                <strong>ID 4:</strong><br>
                <select name="id_4">
<?foreach ($factions as $faction):?>
                  <option value="<?=$faction['id']?>"<?echo ($faction['id'] == 0) ? " selected" : "";?>><?=$faction['name']?> (<?=$faction['id']?>)</option>
<?endforeach;?>
                </select>
              </td>
              <td><strong>Mod 4:</strong><br><input size="10" type="text" name="mod_4" value="0.0"></td>
            </tr>
            <tr>
              <td>
                <strong>ID 5:</strong><br>
                <select name="id_5">
<?foreach ($factions as $faction):?>
                  <option value="<?=$faction['id']?>"<?echo ($faction['id'] == 0) ? " selected" : "";?>><?=$faction['name']?> (<?=$faction['id']?>)</option>
<?endforeach;?>
                </select>
              </td>
              <td><strong>Mod 5:</strong><br><input size="10" type="text" name="mod_5" value="0.0"></td>
            </tr>
            <tr>
              <td>
                <strong>ID 6:</strong><br>
                <select name="id_6">
<?foreach ($factions as $faction):?>
                  <option value="<?=$faction['id']?>"<?echo ($faction['id'] == 0) ? " selected" : "";?>><?=$faction['name']?> (<?=$faction['id']?>)</option>
<?endforeach;?>
                </select>
              </td>
              <td><strong>Mod 6:</strong><br><input size="10" type="text" name="mod_6" value="0.0"></td>
            </tr>
            <tr>
              <td>
                <strong>ID 7:</strong><br>
                <select name="id_7">
<?foreach ($factions as $faction):?>
                  <option value="<?=$faction['id']?>"<?echo ($faction['id'] == 0) ? " selected" : "";?>><?=$faction['name']?> (<?=$faction['id']?>)</option>
<?endforeach;?>
                </select>
              </td>
              <td><strong>Mod 7:</strong><br><input size="10" type="text" name="mod_7" value="0.0"></td>
            </tr>
            <tr>
              <td>
                <strong>ID 8:</strong><br>
                <select name="id_8">
<?foreach ($factions as $faction):?>
                  <option value="<?=$faction['id']?>"<?echo ($faction['id'] == 0) ? " selected" : "";?>><?=$faction['name']?> (<?=$faction['id']?>)</option>
<?endforeach;?>
                </select>
              </td>
              <td><strong>Mod 8:</strong><br><input size="10" type="text" name="mod_8" value="0.0"></td>
            </tr>
            <tr>
              <td>
                <strong>ID 9:</strong><br>
                <select name="id_9">
<?foreach ($factions as $faction):?>
                  <option value="<?=$faction['id']?>"<?echo ($faction['id'] == 0) ? " selected" : "";?>><?=$faction['name']?> (<?=$faction['id']?>)</option>
<?endforeach;?>
                </select>
              </td>
              <td><strong>Mod 9:</strong><br><input size="10" type="text" name="mod_9" value="0.0"></td>
            </tr>
            <tr>
              <td>
                <strong>ID 10:</strong><br>
                <select name="id_10">
<?foreach ($factions as $faction):?>
                  <option value="<?=$faction['id']?>"<?echo ($faction['id'] == 0) ? " selected" : "";?>><?=$faction['name']?> (<?=$faction['id']?>)</option>
<?endforeach;?>
                </select>
              </td>
              <td><strong>Mod 10:</strong><br><input size="10" type="text" name="mod_10" value="0.0"></td>
            </tr>
          </table><br>
          <center>
            <input type="submit" value="Submit">&nbsp;&nbsp;&nbsp;<input type="button" value="Cancel" onclick="history.back();">
          </center>
        </div>
      </div>
    </form>
  </div>
