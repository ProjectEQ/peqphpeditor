  <div class="edit_form" style="width: 600px">
    <div class="edit_form_header">
      Add a Grid Entry <?=$pathgrid?>       
    </div>
    <div class="edit_form_content">
      <form name="gridentry" method="post" action="index.php?editor=spawn&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&spid=<?=$spid?>&pathgrid=<?=$pathgrid?>&action=28">
        <table width="100%">
          <tr>
            <th>Number:</th>
            <th>X:</th>
            <th>Y:</th>
            <th>Z:</th>
            <th>Heading:</th>
            <th>Pause:</th>
            <th>Centerpoint:</th>
          </tr>
          <tr>
            <td><input type="text" size="7" name="number" value="<?=$suggestednum?>"></td>
            <td><input type="text" size="7" name="x_coord" value="<?echo ($x_coord) ? $x_coord : 0;?>"></td>
            <td><input type="text" size="7" name="y_coord" value="<?echo ($y_coord) ? $y_coord : 0;?>"></td>
            <td><input type="text" size="7" name="z_coord" value="<?echo ($z_coord) ? $z_coord : 0;?>"></td>
            <td><input type="text" size="7" name="heading" value="<?echo ($heading) ? $heading : 0;?>"></td>
            <td><input type="text" size="7" name="pause" value="<?echo ($pause) ? $pause : 0;?>"></td>
            <td><input type="text" size="7" name="centerpoint" value="<?echo ($centerpoint) ? $centerpoint : 0;?>"></td>
          </tr>
        </table><br><br>
        <center>
          <input type="hidden" name="pathgrid" value="<?=$pathgrid?>">
          <input type="hidden" name="zoneid" value="<?=$zid?>">
          <input type="submit" value="Submit Changes">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back();">
        </center>
      </form>
    </div>
  </div>
