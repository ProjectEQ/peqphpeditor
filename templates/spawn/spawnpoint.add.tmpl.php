  <div class="edit_form" style="margin-bottom: 15px;">
    <div class="edit_form_header">
      Add a Spawnpoint:
    </div>
    <div class="edit_form_content">
      <form name="spawnpoint" method="post" action="index.php?editor=spawn&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=15">
        Suggested ID:<br>
        <input type="text" name="id" value="<?=$suggestedid?>"><br><br>
        <table width="100%" cellspacing="0">
          <tr>
            <td width="33%">
              X:<br>
              <input type="text" name="x" value="">
            </td>
            <td width="33%">
              Y:<br>
              <input type="text" name="y" value="">
            </td>
            <td width="34%">
              Z:<br>
              <input type="text" name="z" value="">
            </td>
          </tr>
          <tr>
            <td width="33%">
              Heading:<br>
              <input type="text" name="heading" value="0">
            </td>
            <td width="33%">
              Respawn:<br>
              <input type="text" name="respawntime" value="1200">s
            </td>
            <td width="34%">
              Variance:<br>
              <input type="text" name="variance" value="0">s
            </td>
          </tr>
          <tr>
            <td width="33%">
              Pathgrid:<br>
              <input type="text" name="pathgrid" value="0">
            </td>
            <td width="33%">
              Condition:<br>
              <input type="text" name="_condition" value="0">
            </td>
            <td width="34%">
              Cond Value:<br>
              <input type="text" name="cond_value" value="1">
            </td>
          </tr>
          <tr>
            <td width="33%">
              Version:<br>
              <input type="text" name="version" value="0">
            </td>
            <td width="33%">
              Enabled:<br>
              <input type="text" name="enabled" value="1">
            </td>
            <td align="left" width="34%">
              Animation:<br>
              <select name="animation">
<?foreach($animations as $k => $v):?>
                <option value="<?=$k?>"><?=$v?></option>
<?endforeach;?>
              </select>
            </td>
          </tr>
        </table><br><br>
        <center>
          <input type="hidden" name="zone" value="<?=$zone?>">
          <input type="hidden" name="spawngroupID" value="<?=$spawngroupID?>">
          <input type="submit" value="Add Spawnpoint">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back();">
        </center>
      </form>
    </div>
  </div>
