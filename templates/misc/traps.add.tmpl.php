<div class="edit_form" style="width: 750px">
      <div class="edit_form_header">
        Add Trap
      </div>

      <div class="edit_form_content">
        <form name="traps" method="post" action=index.php?editor=misc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&action=24">
        <table width="100%">
          <tr>
            <th>id</th>
            <th>zone</th>
            <th>x</th>
            <th>y</th>
            <th>z</th>
            <th>maxzdiff</th>
            <th>radius</th>
            <th>version</th>
          </tr>
          <tr>
            <td><input type="text" size="7" name="tid" value="<?=$suggesttid?>"></td>
            <td><input type="text" size="10" name="zone" value="<?=$currzone?>"></td>
            <td><input type="text" size="7" name="x_coord" value="0"></td>
            <td><input type="text" size="7" name="y_coord" value="0"></td>
            <td><input type="text" size="7" name="z_coord" value="0"></td>
            <td><input type="text" size="7" name="maxzdiff" value="0"></td>
            <td><input type="text" size="7" name="radius" value="0"></td>
            <td><input type="text" size="7" name="version" value="<?=$suggestver?>"></td>
            
          </tr>
          <tr>
            
            <th>effectvalue</th>
            <th>effectvalue2</th>
            <th>chance</th>
            <th>skill</th>
            <th>level</th>
            <th>respawn</th>
            <th>variance</th>
            <th>effect</th>
            <th>message</th>
          </tr>
          <tr>
            <td><input type="text" size="7" name="effectvalue" value="0"></td>
            <td><input type="text" size="10" name="effectvalue2" value="0"></td>
            <td><input type="text" size="7" name="chance" value="0"></td>
            <td><input type="text" size="7" name="skill" value="0"></td>
            <td><input type="text" size="7" name="level" value="1"></td>
            <td><input type="text" size="7" name="respawn_time" value="60"></td>
            <td><input type="text" size="7" name="respawn_var" value="0"></td>
            <td><select class="left" name="effect">
<?foreach($traptype as $k => $v):?>
              <option value="<?=$k?>"<? echo ($k == $effect) ? " selected" : ""?>><?=$v?></option>
<?$x++; endforeach;?>
           </td> 
            <td><input type="text" size="14" name="message" value=""></td>  
          </tr>            
              </table><br><br>
        <center>
          <input type="submit" value="Submit Changes">
        </center>
      </form>
      </div>
      </div>