<div class="edit_form" style="width: 500px">
      <div class="edit_form_header">
        Add Object
      </div>
      <div class="edit_form_content">
        <form name="door" method="post" action=index.php?editor=misc&z=<?=$currzone?>&action=46">
        <table width="100%">
          <tr>
            <th>ID</th>
            <th>x</th>
            <th>y</th>
            <th>z</th>
            
          </tr>
          <tr>
            <td><input type="text" size="7" name="objid" value="<?=$suggestobjid?>"></td>
            <td><input type="text" size="7" name="xpos" value="0"></td>
            <td><input type="text" size="7" name="ypos" value="0"></td>
            <td><input type="text" size="7" name="zpos" value="0"></td>
           </tr>
          <tr>
            <th>heading</th>
            <th>item</th>
            <th>charges</th>   
            <th>type</th>    
          </tr>
          <tr>
            <td><input type="text" size="7" name="heading" value="0"></td>
            <td><input type="text" size="7" name="itemid" value="0"></td>
            <td><input type="text" size="7" name="charges" value="0"></td>      
                 <td><select class="left" name="type">
<?foreach($world_containers as $k => $v):?>
              <option value="<?=$k?>"<? echo ($k == $type) ? " selected" : ""?>><?=$v?></option>
<?endforeach;?>       
           </td> 
          </tr>
          <tr>
            <th>version</th>
            <th>icon</th> 
            <th>name</th>
          </tr>
          <tr>
            <td><input type="text" size="7" name="version" value="0"></td>
            <td><input type="text" size="7" name="icon" value="0"></td>
            <td><input type="text" size="20" name="objectname" value="ITxxxxx_ACTORDEF"></td>
          </tr>       
              </table><br><br>
        <center>
          <input type="submit" value="Submit Changes">
        </center>
      </form>
      </div>
      </div>