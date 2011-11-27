      <div class="edit_form" style="width: 750px">
       <div class="edit_form_header">
             Search for Spawngroups
         </div>
           <div class="edit_form_content">
             <form name="addspawngroup" method="post" action="index.php?editor=spawn&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&action=68">
               <table width="100%">
          	<tr>
		<th>Min X:</th>
  		<th>Max X:</th>
		<th>Min Y:</th>
		<th>Max Y:</th>
		<th>Limit</th>
		<th>NPC Name:</th>
		</tr>
		<tr>
              <td><input type="text" name="minx" size = "8" value="-25000"></td>
              <td><input type="text" name="maxx" size = "8" value="11000"></td>
              <td><input type="text" name="miny" size = "8" value="-25000"></td>
              <td><input type="text" name="maxy" size = "8" value="11000"></td>
		<td><input type="text" name="limit" size = "8" value="20"></td>
              <td><input type="text" name="npcname" size = "26" value=""></td>
             </tr>
		</table><br><br>
           <center>
             <input type="submit" name="submit" value=" Search ">
           </center>
             </form>
		</div>
		</div>
