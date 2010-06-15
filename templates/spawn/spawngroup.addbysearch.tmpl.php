       <table class="edit_form">
         <tr>
           <td class="edit_form_header">
             Add NPC to Spawngroup
           </td>
         </tr>
         <tr>
           <td class="edit_form_content">
             <form name="addspawngroup" method="post" action="index.php?editor=spawn&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=9">
               <input type="hidden" name="npc" value=<?=$npcid?>>
               Spawngroup ID:<br>
               <input type="text" name="sid" value="<?=$sid?>"><br><br>
               <center>
                 <input type="submit">
               </center>
             </form>
           </td>
         </tr>
       </table>
