      <div class="edit_form" style="width: 350px">
       <div class="edit_form_header">
             Edit Pet Equipmentset <?=$set_id?> for <?=getNPCName($npcid)?> (<?=$npcid?>)
         </div>
           <div class="edit_form_content">
             <form name="addpet" method="post" action="index.php?editor=npc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=65">
               <table width="100%">
          	<tr>
              <th>id</th>
		<th>name</th>
              <th>nested set</th>
		</tr>
		<tr>
              <td><input type="text" name="set_id" size = "5" value="<?=$set_id?>"></td>
              <td><input type="text" name="setname" size = "26" value="<?=$setname?>"></td>
		<td><input type="text" name="nested_set" size = "5" value="<?=$nested_set?>"></td>
             </tr>
		</table><br><br>
           <center>
             <input type="submit" name="submit" value=" Submit ">
             <input type="hidden" name="id" value="<?=$npcid?>">
           </center>
             </form>
		</div>
		</div>