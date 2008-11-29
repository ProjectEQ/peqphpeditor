       <table class="edit_form">
         <tr>
           <td class="edit_form_header">
             Add faction hit:
           </td>
         </tr>
         <tr>
           <td class="edit_form_content">
             <strong><?=$name?></strong><br><br>

             <form name="addhit" method="post" action="index.php?editor=npc&z=<?=$currzone?>&npcid=<?=$npcid?>&fid=<?=$fid?>&action=18">
			 Adjustment: <br>
             <input type="text" name="value"><br><br>

			 <input type="radio" name="npc_value" value="0" checked> Passive<br>
			 <input type="radio" name="npc_value" value="1"> Assist<br>
			 <input type="radio" name="npc_value" value="-1"> Aggressive<br><br>
             <center>
               <input type="submit" name="submit" value="Submit Changes"></form>
             </center>
           </td>
         </tr>
       </table>
