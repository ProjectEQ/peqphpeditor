       <form name="addnpc" method="post" action="index.php?editor=spawn&z=<?=$currzone?>&npcid=<?=$npcid?>&sid=<?=$sid?>&action=9">
       <table class="edit_form">
         <tr>
           <td class="edit_form_header" colspan=3>
	  	     Add an NPC to Spawngroup <?=$name?> (<?=$sid?>)
           </td>
         </tr>
         <tr>
           <td class="edit_form_content">
               Search NPC Names for: <br>
               <input type="text" name="search">
           </td>
           <td valign=middle class="edit_form_content"><b>Or</b></td>
           <td class="edit_form_content">
             Enter an NPC's ID: <br>
			 <input type="text" name="npc">
           </td>
         </tr>
         <tr>
           <td colspan=3 align=center class="edit_form_content">
             <input type="submit" name="submit" value=" Submit "></form>
           </td>
         </tr>
       </table>
