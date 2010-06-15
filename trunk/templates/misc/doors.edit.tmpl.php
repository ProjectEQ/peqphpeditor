<div class="edit_form" style="width: 750px">
      <div class="edit_form_header">
        Door: <?=$id?>
      </div>

      <div class="edit_form_content">
        <form name="door" method="post" action=index.php?editor=misc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&action=37">
        <table width="100%">
          <tr>
            <th>doorid</th>
            <th>name</th>
            <th>x</th>
            <th>y</th>
            <th>z</th>
            <th>heading</th>
            <th>opentype</th>
            <th>guild</th>          
          </tr>
          <tr>
            <td><input type="text" size="7" name="doorid" value="<?=$doorid?>"></td>
            <td><input type="text" size="15" name="name" value="<?=$name?>"></td>
            <td><input type="text" size="7" name="pos_x" value="<?=$pos_x?>"></td>
            <td><input type="text" size="7" name="pos_y" value="<?=$pos_y?>"></td>
            <td><input type="text" size="7" name="pos_z" value="<?=$pos_z?>"></td>
            <td><input type="text" size="7" name="heading" value="<?=$heading?>"></td>
            <td><input type="text" size="7" name="opentype" value="<?=$opentype?>"></td>
            <td><input type="text" size="7" name="guild" value="<?=$guild?>"></td>      
           </tr>
          <tr>
            <th>size</th>
            <th>dest zone</th>
            <th>dest x</th>
            <th>dest y</th>
            <th>dest z</th>
            <th>dest heading</th>
            <th>lockpick</th>
            <th>keyitem</th>
          </tr>
          <tr>
            <td><input type="text" size="7" name="size" value="<?=$size?>"></td>
            <td><input type="text" size="15" name="dest_zone" value="<?=$dest_zone?>"></td>
            <td><input type="text" size="7" name="dest_x" value="<?=$dest_x?>"></td>
            <td><input type="text" size="7" name="dest_y" value="<?=$dest_y?>"></td>
            <td><input type="text" size="7" name="dest_z" value="<?=$dest_z?>"></td>
            <td><input type="text" size="7" name="dest_heading" value="<?=$dest_heading?>"></td>
            <td><input type="text" size="7" name="lockpick" value="<?=$lockpick?>"></td>
            <td><input type="text" size="7" name="keyitem" value="<?=$keyitem?>"></td>      
          </tr>       
          <tr>
            <th>triggerdoor</th>
            <th>triggertype</th>
            <th>param</th>
            <th>doorisopen</th>
            <th>invert</th>
            <th>incline</th>
            <th>version</th>
            <th>LDoN Door</th>
         </tr>
          <tr>
            <td><input type="text" size="7" name="triggerdoor" value="<?=$triggerdoor?>"></td>
            <td><input type="text" size="7" name="triggertype" value="<?=$triggertype?>"></td>
            <td><input type="text" size="7" name="door_param" value="<?=$door_param?>"></td>
            <td><input type="text" size="7" name="doorisopen" value="<?=$doorisopen?>"></td>
            <td><input type="text" size="7" name="invert_state" value="<?=$invert_state?>"></td>
            <td><input type="text" size="7" name="incline" value="<?=$incline?>"></td>
            <td><input type="text" size="7" name="version" value="<?=$version?>"></td>
             <td>
                 <select name="is_ldon_door">
                   <option value="0"<?echo ($is_ldon_door == 0) ? " selected" : ""?>>No</option>
                   <option value="1"<?echo ($is_ldon_door == 1) ? " selected" : ""?>>Yes</option>
                 </select>
               </td>
         </tr>
          <tr>
            <th>dest instance</th>
            <th>client</th>
            <th>no keyring</th>
         </tr>
          <tr>
            <td><input type="text" size="7" name="dest_instance" value="<?=$dest_instance?>"></td>
            <td><input type="text" size="7" name="client_version_mask" value="<?=$client_version_mask?>"></td>
          <td>
                 <select name="nokeyring">
                   <option value="0"<?echo ($nokeyring == 0) ? " selected" : ""?>>No</option>
                   <option value="1"<?echo ($nokeyring == 1) ? " selected" : ""?>>Yes</option>
                 </select>
               </td>
         </tr>
              </table><br><br>
        <center>
          <input type="hidden" name="drid" value="<?=$id?>">
          <input type="submit" value="Submit Changes">
        </center>
      </form>
      </div>
      </div>