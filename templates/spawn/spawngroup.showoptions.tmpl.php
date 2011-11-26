       <table class="edit_form">
         <tr>
           <td class="edit_form_header">
             Search for Spawngroups
           </td>
         </tr>
         <tr>
           <td class="edit_form_content">
             <form name="addspawngroup" method="post" action="index.php?editor=spawn&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&action=68">
                 Min X: <br>
               <input type="text" name="minx" size = "8" value="-25000"><br><br>
                 Max X: <br>
               <input type="text" name="maxx" size = "8" value="11000"><br><br>
                 Min Y: <br>
               <input type="text" name="miny" size = "8" value="-25000"><br><br>
                 Max Y: <br>
               <input type="text" name="maxy" size = "8" value="11000"><br><br>
                 NPC Name: <br>
               <input type="text" name="npcname" size = "26" value=""><br><br>
                 <tr>
               <tr>
           <td colspan=3 align=center class="edit_form_content">
             <input type="submit" name="submit" value=" Search ">
           </td>
           </tr>
             </form>
           </td>
         </tr>
       </table>
