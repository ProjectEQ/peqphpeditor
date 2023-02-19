  <center>
    <iframe id="searchframe" src="templates/iframes/playersearch.php" style="display:none;"></iframe>
    <input id="button" type="button" value="Hide Search" onclick="javascript:hideSearch();" style="display:none;">
  </center>
  <div class="table_container" style="width: 650px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td>Edit Mercenary</td>
        </tr>
      </table>
    </div>
    <div class="table_content">
      <form name="edit_mercenary" method="post" action="index.php?editor=mercs&action=5">
        <table width="100%" cellpadding="5" cellspacing="5">
          <tr>
            <td>
              <strong>ID:</strong><br>
              <input type="text" size="10" value="<?=$merc['MercID']?>" disabled>
            </td>
            <td>
              <strong>Owner:</strong> (<a href="javascript:showSearch();">search</a>)<br>
              <input type="text" id="player" name="OwnerCharacterID" size="10" value="<?=$merc['OwnerCharacterID']?>">
            </td>
            <td>
              <strong>Slot:</strong><br>
              <input type="text" name="Slot" size="5" value="<?=$merc['Slot']?>">
            </td>
            <td>
              <strong>Name:</strong><br>
              <input type="text" name="Name" size="30" value="<?=$merc['Name']?>">
            </td>
          </tr>
          <tr>
            <td>
              <strong>Template:</strong><br>
              <input type="text" name="TemplateID" size="10" value="<?=$merc['TemplateID']?>">
            </td>
            <td>
              <strong>Suspended Time:</strong><br>
              <input type="text" name="SuspendedTime" size="10" value="<?=$merc['SuspendedTime']?>">
            </td>
            <td>
              <strong>Suspended:</strong><br>
              <select name="IsSuspended">
                <option value="0"<?echo ($merc['IsSuspended'] == 0) ? " selected" : "";?>>No (0)</option>
                <option value="1"<?echo ($merc['IsSuspended'] != 0) ? " selected" : "";?>>Yes (1)</option>
              </select>
            </td>
            <td>
              <strong>Timer Remaining:</strong><br>
              <input type="text" name="TimerRemaining" size="30" value="<?=$merc['TimerRemaining']?>">
            </td>
          </tr>
          <tr>
            <td>
              <strong>Gender:</strong><br>
              <select name="Gender">
                <option value="0"<?echo ($merc['Gender'] == 0) ? " selected" : "";?>>Male (0)</option>
                <option value="1"<?echo ($merc['Gender'] != 0) ? " selected" : "";?>>Female (1)</option>
              </select>
            </td>
            <td>
              <strong>Size:</strong><br>
              <input type="text" name="MercSize" size="10" value="<?=$merc['MercSize']?>">
            </td>
            <td>
              <strong>Stance:</strong><br>
              <select name="StanceID">
<?foreach ($stances as $k=>$v):?>
                <option value="<?=$k?>"<?echo ($merc['StanceID'] == $k) ? " selected" : "";?>><?=$v?> (<?=$k?>)</option>
<?endforeach;?>
              </select>
            </td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>
              <strong>HP:</strong><br>
              <input type="text" name="HP" size="10" value="<?=$merc['HP']?>">
            </td>
            <td>
              <strong>Mana:</strong><br>
              <input type="text" name="Mana" size="10" value="<?=$merc['Mana']?>">
            </td>
            <td>
              <strong>Endurance:</strong><br>
              <input type="text" name="Endurance" size="10" value="<?=$merc['Endurance']?>">
            </td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>
              <strong>Face:</strong><br>
              <input type="text" name="Face" size="10" value="<?=$merc['Face']?>">
            </td>
            <td>
              <strong>Luclin Hair Style:</strong><br>
              <input type="text" name="LuclinHairStyle" size="10" value="<?=$merc['LuclinHairStyle']?>">
            </td>
            <td>
              <strong>Luclin Hair Color:</strong><br>
              <input type="text" name="LuclinHairColor" size="10" value="<?=$merc['LuclinHairColor']?>">
            </td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>
              <strong>Luclin Eye Color:</strong><br>
              <input type="text" name="LuclinEyeColor" size="10" value="<?=$merc['LuclinEyeColor']?>">
            </td>
            <td>
              <strong>Luclin Eye Color 2:</strong><br>
              <input type="text" name="LuclinEyeColor2" size="10" value="<?=$merc['LuclinEyeColor2']?>">
            </td>
            <td>
              <strong>Luclin Beard Color:</strong><br>
              <input type="text" name="LuclinBeardColor" size="10" value="<?=$merc['LuclinBeardColor']?>">
            </td>
            <td>
              <strong>Luclin Beard:</strong><br>
              <input type="text" name="LuclinBeard" size="10" value="<?=$merc['LuclinBeard']?>">
            </td>
          </tr>
          <tr>
            <td>
              <strong>Drakkin Heritage:</strong><br>
              <input type="text" name="DrakkinHeritage" size="10" value="<?=$merc['DrakkinHeritage']?>">
            </td>
            <td>
              <strong>Drakkin Tattoo:</strong><br>
              <input type="text" name="DrakkinTattoo" size="10" value="<?=$merc['DrakkinTattoo']?>">
            </td>
            <td>
              <strong>Drakkin Details:</strong><br>
              <input type="text" name="DrakkinDetails" size="10" value="<?=$merc['DrakkinDetails']?>">
            </td>
            <td>&nbsp;</td>
          </tr>
        </table><br>
        <center>
          <input type="hidden" name="MercID" value="<?=$merc['MercID']?>">
          <input type="submit" value="Update Mercenary">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back()">
        </center>
      </form>
    </div>
  </div>
