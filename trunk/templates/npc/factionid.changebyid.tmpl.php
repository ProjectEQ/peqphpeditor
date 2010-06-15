       <table class="edit_form">
         <tr>
           <td class="edit_form_header">
             Change NPC Faction ID:
           </td>
         </tr>
         <tr>
           <td class="edit_form_content">
             <form name="faction_id" method="post" action="index.php?editor=npc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=5">
             New Faction ID: <br>
             <input type="text" name="npc_faction_id" value="<?=$npc_faction_id?>"><br><br>
             <center>
               <input type="submit" value="Submit"></form>
             </center>
           </td>
         </tr>
       </table>
