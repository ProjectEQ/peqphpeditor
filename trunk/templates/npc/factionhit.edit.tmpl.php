       <table class="edit_form">
         <tr>
           <td class="edit_form_header">
             Edit faction hit:
           </td>
         </tr>
         <tr>
           <td class="edit_form_content">
             <strong><?=$name?></strong><br><br>

             <form name="edithit" method="post" action="index.php?editor=npc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&npc_faction_id=<?=$npc_faction_id?>&faction_id=<?=$faction_id?>&action=20">
			 Adjustment: <br>
             <input type="text" name="value" value=<?=$value?>><br><br>

			 <input type="radio" name="npc_value" value="0"<?echo (($npc_value==0) ? " checked" : "");?>> Passive<br>
			 <input type="radio" name="npc_value" value="1"<?echo (($npc_value==1) ? " checked" : "");?>> Assist<br>
			 <input type="radio" name="npc_value" value="-1"<?echo (($npc_value==-1) ? " checked" : "");?>> Aggressive<br><br>

		Temp:<br>
             <select name="temp" style="width: 130px;">
             <?foreach($tmpfaction as $key=>$value):?>
              <option value="<?=$key?>"<?echo ($key == $temp)? " selected" : "";?>><?=$key?>: <?=$value?></option>
		<?endforeach;?></select><br><br>
             <center>
               <input type="submit" name="submit" value="Submit Changes"></form>
             </center>
           </td>
         </tr>
       </table>
