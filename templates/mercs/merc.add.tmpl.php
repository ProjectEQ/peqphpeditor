  <center>
    <iframe id="searchframe" src="templates/iframes/playersearch.php" style="display:none;"></iframe>
    <input id="button" type="button" value="Hide Search" onclick="javascript:hideSearch();" style="display:none;">
  </center>
  <div class="table_container" style="width: 650px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td>Create Mercenary</td>
        </tr>
      </table>
    </div>
    <div class="table_content">
      <form name="add_mercenary" method="post" action="index.php?editor=mercs&action=3">
        <table width="100%" cellpadding="5" cellspacing="5">
          <tr>
            <td>
              <strong>ID:</strong><br>
              <input type="text" name="MercID" size="10" value="<?=$suggest_id?>">
            </td>
            <td>
              <strong>Owner:</strong> (<a href="javascript:showSearch();">search</a>)<br>
              <input type="text" id="player" name="OwnerCharacterID" size="10" value="">
            </td>
            <td>
              <strong>Slot:</strong><br>
              <input type="text" name="Slot" size="5" value="0">
            </td>
            <td>
              <strong>Name:</strong><br>
              <input type="text" name="Name" size="30" value="">
            </td>
          </tr>
          <tr>
            <td>
              <strong>Template:</strong><br>
              <input type="text" name="TemplateID" size="10" value="0">
            </td>
            <td>
              <strong>Suspended Time:</strong><br>
              <input type="text" name="SuspendedTime" size="10" value="0">
            </td>
            <td>
              <strong>Suspended:</strong><br>
              <select name="IsSuspended">
                <option value="0">No (0)</option>
                <option value="1">Yes (1)</option>
              </select>
            </td>
            <td>
              <strong>Timer Remaining:</strong><br>
              <input type="text" name="TimerRemaining" size="30" value="0">
            </td>
          </tr>
          <tr>
            <td>
              <strong>Gender:</strong><br>
              <select name="Gender">
                <option value="0">Male (0)</option>
                <option value="1">Female (1)</option>
              </select>
            </td>
            <td>
              <strong>Size:</strong><br>
              <input type="text" name="MercSize" size="10" value="5">
            </td>
            <td>
              <strong>Stance:</strong><br>
              <select name="StanceID">
<?foreach ($stances as $k=>$v):?>
                <option value="<?=$k?>"><?=$v?> (<?=$k?>)</option>
<?endforeach;?>
              </select>
            </td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>
              <strong>HP:</strong><br>
              <input type="text" name="HP" size="10" value="0">
            </td>
            <td>
              <strong>Mana:</strong><br>
              <input type="text" name="Mana" size="10" value="0">
            </td>
            <td>
              <strong>Endurance:</strong><br>
              <input type="text" name="Endurance" size="10" value="0">
            </td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>
              <strong>Face:</strong><br>
              <input type="text" name="Face" size="10" value="1">
            </td>
            <td>
              <strong>Luclin Hair Style:</strong><br>
              <input type="text" name="LuclinHairStyle" size="10" value="1">
            </td>
            <td>
              <strong>Luclin Hair Color:</strong><br>
              <input type="text" name="LuclinHairColor" size="10" value="1">
            </td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>
              <strong>Luclin Eye Color:</strong><br>
              <input type="text" name="LuclinEyeColor" size="10" value="1">
            </td>
            <td>
              <strong>Luclin Eye Color 2:</strong><br>
              <input type="text" name="LuclinEyeColor2" size="10" value="1">
            </td>
            <td>
              <strong>Luclin Beard Color:</strong><br>
              <input type="text" name="LuclinBeardColor" size="10" value="1">
            </td>
            <td>
              <strong>Luclin Beard:</strong><br>
              <input type="text" name="LuclinBeard" size="10" value="0">
            </td>
          </tr>
          <tr>
            <td>
              <strong>Drakkin Heritage:</strong><br>
              <input type="text" name="DrakkinHeritage" size="10" value="0">
            </td>
            <td>
              <strong>Drakkin Tattoo:</strong><br>
              <input type="text" name="DrakkinTattoo" size="10" value="0">
            </td>
            <td>
              <strong>Drakkin Details:</strong><br>
              <input type="text" name="DrakkinDetails" size="10" value="0">
            </td>
            <td>&nbsp;</td>
          </tr>
        </table><br>
        <center>
          <input type="submit" value="Insert Mercenary">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back()">
        </center>
      </form>
    </div>
  </div>
