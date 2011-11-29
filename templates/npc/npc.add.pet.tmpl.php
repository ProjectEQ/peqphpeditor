      <div class="edit_form" style="width: 750px">
       <div class="edit_form_header">
             Add Pet Entry for <?=getNPCName($npcid)?> (<?=$npcid?>)
         </div>
           <div class="edit_form_content">
             <form name="addpet" method="post" action="index.php?editor=npc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=55">
               <table width="100%">
          	<tr>
              <th>type</th>
		<th>petpower</th>
              <th>equipment</th>
		<th>petcontrol</th>
		<th>petnaming</th>
		<th>monsterflag</th>
		<th>temp</th>
		</tr>
		<tr>
              <td><input type="text" name="type" size = "26" value="<?=getNPCName($npcid)?>"></td>
              <td><input type="text" name="petpower" size = "5" value="-1"></td>
		<td><input type="text" name="equipmentset" size = "5" value="-1"></td>
              <td><select class="left" name="petcontrol">
<?foreach($pet_control as $k => $v):?>
              <option value="<?=$k?>"<? echo ($k == 2) ? " selected" : ""?>><?=$v?></option>
<?endforeach;?>       
           </select></td>
            <td><select class="left" name="petnaming">
<?foreach($pet_naming as $k => $v):?>
              <option value="<?=$k?>"<? echo ($k == 3) ? " selected" : ""?>><?=$v?></option>
<?endforeach;?>       
           </select></td>
		<td><select name="monsterflag"><option value="0">No</option><option value="1">Yes</option></select></td>
		<td><select name="temp"><option value="0">No</option><option value="1">Yes</option></select></td>
             </tr>
		</table><br><br>
           <center>
             <input type="submit" name="submit" value=" Submit ">
             <input type="hidden" name="id" value="<?=$npcid?>">
           </center>
             </form>
		</div>
		</div>