<div class="edit_form" style="width: 750px">
      <div class="edit_form_header">
        Edit Trap: <?=$id?>
      </div>
      <div class="edit_form_content">
        <form name="traps" method="post" action=index.php?editor=misc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&action=21">
        <table width="100%">
          <tr>
            <th>x</th>
            <th>y</th>
            <th>z</th>
            <th>maxzdiff</th>
            <th>radius</th>
            <th>chance</th>
            <th>version</th>
          </tr>
          <tr>
            <td><input type="text" size="7" name="x_coord" value="<?=$x?>"></td>
            <td><input type="text" size="7" name="y_coord" value="<?=$y?>"></td>
            <td><input type="text" size="7" name="z_coord" value="<?=$z?>"></td>
            <td><input type="text" size="7" name="maxzdiff" value="<?=$maxzdiff?>"></td>
            <td><input type="text" size="7" name="radius" value="<?=$radius?>"></td>
            <td><input type="text" size="7" name="chance" value="<?=$chance?>"></td> 
            <td><input type="text" size="7" name="version" value="<?=$version?>"></td>  
          </tr>
          <tr>  
            <th>effectvalue</th>
            <th>effectvalue2</th>
            <th>skill</th>
            <th>level</th>
            <th>respawn</th>
            <th>variance</th>
            <th>effect</th>
            <th>message</th>
          </tr>
          <tr>
            <td><input type="text" size="7" name="effectvalue" value="<?=$effectvalue?>"></td>
            <td><input type="text" size="7" name="effectvalue2" value="<?=$effectvalue2?>"></td>
            <td><input type="text" size="7" name="skill" value="<?=$skill?>"></td>
            <td><input type="text" size="7" name="level" value="<?=$level?>"></td>
            <td><input type="text" size="7" name="respawn_time" value="<?=$respawn_time?>"></td>
            <td><input type="text" size="7" name="respawn_var" value="<?=$respawn_var?>"></td>
            <td><select class="left" name="effect">
<?foreach($traptype as $k => $v):?>
              <option value="<?=$k?>"<? echo ($k == $effect) ? " selected" : ""?>><?=$v?></option>
<?endforeach;?>       
           </select></td>
            <td><input type="text" size="20" name="message" value="<?=$message?>"></td>
          </tr>            
              </table><br><br>
        <center>
          <input type="hidden" name="tid" value="<?=$id?>">
          <input type="hidden" name="zone" value="<?=$currzone?>">
          <input type="submit" value="Submit Changes">
        </center>
      </form>
      </div>
      </div>