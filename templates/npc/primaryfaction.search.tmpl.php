       <table class="edit_form">
         <tr>
           <td class="edit_form_header">
             Search Factions
           </td>
         </tr>
         <tr>
           <td class="edit_form_content">
             <form name="search" method="post" action="index.php?editor=npc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=13">
               Search Factions For:<br><br>
               <input type="text" name="search"><br><br>
               <center>
                 <input type="submit" value=" Search "><br><br>

                 or:<br><br>
               
                 <a href="index.php?editor=npc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&fid=0&action=14">Set Primary Faction to 0</a>
               </center>
             </form>
           </td>
         </tr>
       </table>
