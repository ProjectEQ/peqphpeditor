 <table class="edit_form">
         <tr>
           <td class="edit_form_header">
             Change Dye Template
           </td>
         </tr>
         <tr>
           <td class="edit_form_content">
             <form name="armortint_id" method="post" action="index.php?editor=npc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=36">
             New Dye Template: <br>
             <input type="text" name="armortint_id" value="<?=$armortint_id?>"><br><br>
             <center>
               <input type="submit" value="Submit"></form><br><br>
             
               or<br><br>
             
               <a href="index.php?editor=npc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&armortint_id=<?=$suggested_id?>&action=36">Assign next available ID</a>
             </center>
           </td>
         </tr>
       </table>