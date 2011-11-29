      <div class="edit_form" style="width: 750px">
       <div class="edit_form_header">
             Edit Pet Entry for <?=getNPCName($npcid)?> (<?=$npcid?>)
         </div>
           <div class="edit_form_content">
             <form name="addpet" method="post" action="index.php?editor=npc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=59">
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
              <td><input type="text" name="type" size = "26" value="<?=$type?>"></td>
              <td><input type="text" name="petpower" size = "5" value="<?=$petpower?>"></td>
		<td><input type="text" name="equipmentset" size = "5" value="<?=$equipmentset?>"></td>
              <td><select class="left" name="petcontrol">
<?foreach($pet_control as $k => $v):?>
              <option value="<?=$k?>"<? echo ($k == $petcontrol) ? " selected" : ""?>><?=$v?></option>
<?endforeach;?>       
           </select></td>
            <td><select class="left" name="petnaming">
<?foreach($pet_naming as $k => $v):?>
              <option value="<?=$k?>"<? echo ($k == $petnaming) ? " selected" : ""?>><?=$v?></option>
<?endforeach;?>       
           </select></td>
		<td><select name="monsterflag">
                   <option value="0"<?echo ($monsterflag == 0) ? " selected" : ""?>>No</option>
                   <option value="1"<?echo ($monsterflag == 1) ? " selected" : ""?>>Yes</option>
                 </select></td>
		<td><select name="temp">
                   <option value="0"<?echo ($temp == 0) ? " selected" : ""?>>No</option>
                   <option value="1"<?echo ($temp == 1) ? " selected" : ""?>>Yes</option>
                 </select></td>
             </tr>
		</table><br><br>
           <center>
             <input type="submit" name="submit" value=" Submit ">
             <input type="hidden" name="id" value="<?=$npcid?>">
           </center>
             </form>
		</div>
		</div>