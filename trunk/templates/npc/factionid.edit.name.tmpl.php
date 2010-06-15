       <table class="edit_form">
         <tr>
           <td class="edit_form_header">
             Edit NPC Faction
           </td>
         </tr>
         <tr>
           <td class="edit_form_content">
              Name: <br>
             <form name="name" method="post" action="index.php?editor=npc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=11">
             <input type="text" name="name" value="<?=$name?>"><br><br>
              Ignore Primary Assist:  <br>
			      <select name="ipa">
			      <option value="0"<?echo ($ignore_primary_assist == 0) ? " selected" : ""?>>False</option>
			      <option value="1"<?echo ($ignore_primary_assist == 1) ? " selected" : ""?>>True</option>
                 </select><br><br>
             <center>
               <input type="submit" name="submit" value="Submit Changes"></form>
             </center>
           </td>
         </tr>
       </table>
