       <table class="edit_form">
         <tr>
           <td class="edit_form_header">
             Change Adventure ID
           </td>
         </tr>
         <tr>
           <td class="edit_form_content">
             <form name="adventure_template_id" method="post" action="index.php?editor=npc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=30">
             New Adventure ID: <br>
             <input type="text" name="adventure_template_id" value="<?=$adventure_id?>"><br><br>
             <center>
               <input type="submit" value="Submit"></form><br><br>
             
               or<br><br>
             
               <a href="index.php?editor=npc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&adventure_template_id=<?=$suggested_id?>&action=30">Assign next available ID</a>
             </center>
           </td>
         </tr>
       </table>
