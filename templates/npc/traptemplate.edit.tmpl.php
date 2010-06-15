       <table class="edit_form">
         <tr>
           <td class="edit_form_header">
             Change Trap Template
           </td>
         </tr>
         <tr>
           <td class="edit_form_content">
             <form name="trap_template" method="post" action="index.php?editor=npc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=32">
             New Trap Template: <br>
             <input type="text" name="trap_template" value="<?=$trap_id?>"><br><br>
             <center>
               <input type="submit" value="Submit"></form><br><br>
             
               or<br><br>
             
               <a href="index.php?editor=npc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&trap_template=<?=$suggested_id?>&action=32">Assign next available ID</a>
             </center>
           </td>
         </tr>
       </table>
