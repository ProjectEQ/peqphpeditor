       <table class="edit_form">
         <tr>
           <td class="edit_form_header">
             Add NPC to Spawngroup
           </td>
         </tr>
         <tr>
           <td class="edit_form_content">
             <form name="addspawngroup" method="post" action="index.php?editor=spawn&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&new_sid=<?=$new_sid?>&action=58">
               <input type="hidden" name="npc" value=<?=$npcid?>>
               Enter Spawngroup ID:<br>
               <input type="text" name="new_sid"><br><br>
               <tr>
           <td colspan=3 align=center class="edit_form_content">
             <input type="submit" name="submit" value=" Submit ">
           </td>
           </tr>
             </form>
           </td>
         </tr>
       </table>
