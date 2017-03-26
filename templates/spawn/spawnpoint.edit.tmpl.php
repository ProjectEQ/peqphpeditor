  <div class="edit_form">
    <div class="edit_form_header">
      Spawnpoint ID: <?=$id?>
    </div>
    <div class="edit_form_content">
      <form name="spawnpoint" method="post" action="index.php?editor=spawn&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=12">
        <table width="100%" cellspacing="0">
          <tr>
            <td width="33%">
              X:<br>
              <input type="text" name="x" value="<?=$x?>">
            </td>
            <td width="33%">
              Y:<br>
              <input type="text" name="y" value="<?=$y?>">
            </td>
            <td width="34%">
              Z:<br>
              <input type="text" name="z" value="<?=$z?>">
            </td>
          </tr>
          <tr>
            <td width="33%">
              Heading:<br>
              <input type="text" name="heading" value="<?=$heading?>">
            </td>
            <td width="33%">
              Respawn:<br>
              <input type="text" name="respawntime" value="<?=$respawntime?>">s
            </td>
            <td width="34%">
              Variance:<br>
              <input type="text" name="variance" value="<?=$variance?>">s
            </td>
          </tr>
          <tr>
            <td width="33%">
              Pathgrid:<br>
              <input type="text" name="pathgrid" value="<?=$pathgrid?>">
            </td>
            <td width="33%">
              Condition:<br>
              <input type="text" name="_condition" value="<?=$_condition?>">
            </td>
            <td width="34%">
              Cond Value:<br>
              <input type="text" name="cond_value" value="<?=$cond_value?>">
            </td>
          </tr>
          <tr>
            <td width="33%">
              Version:<br>
             <input type="text" name="version" value="<?=$version?>">
            </td>
            <td width="33%">
              Enabled:<br>
             <input type="text" name="enabled" value="<?=$enabled?>">
            </td>
            <td align="left" width="34%">
              Animation:<br>
              <select name="animation">
<?foreach($animations as $k => $v):?>
                <option value="<?=$k?>"<? echo ($k == $animation) ? " selected" : ""?>><?=$v?></option>
<?endforeach;?>
              </select>
            </td>
          </tr>
        </table><br><br>
        <center>
          <input type="hidden" name="zone" value="<?=$zone?>">
          <input type="hidden" name="id" value="<?=$id?>">
          <input type="hidden" name="spawngroupID" value="<?=$spawngroupID?>">
          <input type="submit" value="Submit Changes">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back();">
        </center>
      </form>
    </div>
  </div>
