       <table class="edit_form">
         <tr>
           <td class="edit_form_header">
             Change Lootdrop
           </td>
         </tr>
         <tr>
           <td class="edit_form_content">
             <form name="addlootdrop" method="post" action="index.php?editor=loot&z=<?=$currzone?>&npcid=<?=$npcid?>&action=24">
               <input type="hidden" name="ltid" value="<?=$ltid?>">
               Enter Lootdrop ID:<br>
               <input type="text" name="ldid"><br><br>
               Probability:<br>
               <input type="text" name="prob"><br><br>
               Multiplier:<br>
               <input type="text" name="mult"><br><br>
               <center>
                 <input type="submit">
               </center>
             </form>
           </td>
         </tr>
       </table>
