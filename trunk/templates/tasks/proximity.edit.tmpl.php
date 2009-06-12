<div class="edit_form" style="width: 750px">
      <div class="edit_form_header">
        Proximity: <?=$exploreid?>
      </div>

      <div class="edit_form_content">
        <form name="proximity" method="post" action=index.php?editor=tasks&action=19">
        <table width="100%">
          <tr>
            <th>zone</th>
            <th>minx</th>
            <th>miny</th>
            <th>minz</th>
            <th>maxx</th>
            <th>maxy</th>
            <th>maxz</th>   
          </tr>
          <tr>
            <td><select class="left" name="zoneid">
<?foreach($zoneids as $k => $v):?>
              <option value="<?=$k?>"<? echo ($k == $zoneid) ? " selected" : ""?>><?=$v?></option>
<?endforeach;?> 
            <td><input type="text" size="10" name="minx" value="<?=$minx?>"></td>
            <td><input type="text" size="10" name="miny" value="<?=$miny?>"></td>
            <td><input type="text" size="10" name="minz" value="<?=$minz?>"></td>
            <td><input type="text" size="10" name="maxx" value="<?=$maxx?>"></td>
            <td><input type="text" size="10" name="maxy" value="<?=$maxy?>"></td>
            <td><input type="text" size="10" name="maxz" value="<?=$maxz?>"></td>               
           </td> 
          </tr>   
              </table><br><br>
        <center>
          <input type="hidden" name="exploreid" value="<?=$exploreid?>">
          <input type="hidden" name="tskid" value="<?=$tskid?>">
          <input type="submit" value="Submit Changes">
        </center>
      </form>
      </div>
      </div>