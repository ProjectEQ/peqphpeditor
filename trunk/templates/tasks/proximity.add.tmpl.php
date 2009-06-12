<div class="edit_form" style="width: 750px">
      <div class="edit_form_header">
        Add Proximity for Activity <?=$aid?>
      </div>

      <div class="edit_form_content">
        <form name="proximity" method="post" action=index.php?editor=tasks&action=22">
        <table width="100%">
          <tr>
            <th>id</th>
            <th>zone</th>
            <th>minx</th>
            <th>miny</th>
            <th>minz</th>
            <th>maxx</th>
            <th>maxy</th>
            <th>maxz</th>   
          </tr>
          <tr>
            <td><input type="text" size="4" name="exploreid" value="<?=$suggestid?>"></td>
            <td><select class="left" name="zoneid">
<?foreach($zoneids as $k => $v):?>
              <option value="<?=$k?>"<? echo ($k == $zoneid) ? " selected" : ""?>><?=$v?></option>
<?endforeach;?> 
            <td><input type="text" size="10" name="minx" value="0"></td>
            <td><input type="text" size="10" name="miny" value="0"></td>
            <td><input type="text" size="10" name="minz" value="0"></td>
            <td><input type="text" size="10" name="maxx" value="0"></td>
            <td><input type="text" size="10" name="maxy" value="0"></td>
            <td><input type="text" size="10" name="maxz" value="0"></td>               
           </td> 
          </tr>   
              </table><br><br>
        <center>
          <input type="hidden" name="aid" value="<?=$aid?>">
          <input type="hidden" name="tskid" value="<?=$tskid?>">
          <input type="submit" value="Submit Changes">
        </center>
      </form>
      </div>
      </div>