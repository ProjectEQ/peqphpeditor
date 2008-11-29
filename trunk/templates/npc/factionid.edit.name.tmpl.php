       <table class="edit_form">
         <tr>
           <td class="edit_form_header">
             Edit NPC Faction Name
           </td>
         </tr>
         <tr>
           <td class="edit_form_content">
             <form name="name" method="post" action="index.php?editor=npc&z=<?=$currzone?>&npcid=<?=$npcid?>&action=11">
             <input type="text" name="name" value="<?=$name?>"><br><br>
             <center>
               <input type="submit" name="submit" value="Submit Changes"></form>
             </center>
           </td>
         </tr>
       </table>
