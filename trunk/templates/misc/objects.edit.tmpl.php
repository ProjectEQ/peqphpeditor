<div class="edit_form" style="width: 500px">
      <div class="edit_form_header">
        Object: <?=$id?>
      </div>

      <div class="edit_form_content">
        <form name="door" method="post" action=index.php?editor=misc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&action=43">
        <table width="100%">
          <tr>
            <th>x</th>
            <th>y</th>
            <th>z</th>
            <th>heading</th>
            
            <th>name</th>           
          </tr>
          <tr>
            <td><input type="text" size="7" name="xpos" value="<?=$xpos?>"></td>
            <td><input type="text" size="7" name="ypos" value="<?=$ypos?>"></td>
            <td><input type="text" size="7" name="zpos" value="<?=$zpos?>"></td>
            <td><input type="text" size="7" name="heading" value="<?=$heading?>"></td>  
            <td><input type="text" size="20" name="objectname" value="<?=$objectname?>"></td>
           </tr>
          <tr>
            <th>item</th>
            <th>charges</th>
            <th>icon</th> 
            <th>version</th>
            <th>type</th>              
          </tr>
          <tr>
            <td><input type="text" size="7" name="itemid" value="<?=$itemid?>"></td>
            <td><input type="text" size="7" name="charges" value="<?=$charges?>"></td> 
            <td><input type="text" size="7" name="icon" value="<?=$icon?>"></td>     
            <td><input type="text" size="7" name="version" value="<?=$version?>"></td>
                 <td><select class="left" name="type">
<?foreach($world_containers as $k => $v):?>
              <option value="<?=$k?>"<? echo ($k == $type) ? " selected" : ""?>><?=$v?></option>
<?endforeach;?>       
           </td>  
              </table><br><br>
        <center>
          <input type="hidden" name="objid" value="<?=$id?>">
          <input type="submit" value="Submit Changes">
        </center>
      </form>
      </div>
      </div>