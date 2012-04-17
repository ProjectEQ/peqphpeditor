       <table class="edit_form">
         <tr>
           <td class="edit_form_header">
             Add faction hit:
           </td>
         </tr>
         <tr>
           <td class="edit_form_content">
             <strong><?=$name?></strong><br><br>

             <form name="addhit" method="post" action="index.php?editor=npc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&fid=<?=$fid?>&action=18">
			 Adjustment: <br>
             <input type="text" name="value" value=0><br><br>

			 <input type="radio" name="npc_value" value="0" checked> Passive<br>
			 <input type="radio" name="npc_value" value="1"> Assist<br>
			 <input type="radio" name="npc_value" value="-1"> Aggressive<br><br>
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
