       <table class="edit_form">
         <tr>
           <td class="edit_form_header">
             Change Lootdrop
           </td>
         </tr>
         <tr>
           <td class="edit_form_content">
             <form name="addlootdrop" method="post" action="index.php?editor=loot&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=24">
               <input type="hidden" name="ltid" value="<?=$ltid?>">
               Lootdrop ID:<br>
               <input type="text" name="ldid" value="<?=$ldid?>"><br><br>
               Probability:<br>
               <input type="text" name="probability" value="100"><br><br>
               Multiplier:<br>
               <input type="text" name="multiplier" value=1><br><br>
		 Droplimit:<br>
               <input type="text" name="droplimit" value=0><br><br>
               Mindrop:<br>
               <input type="text" name="mindrop" value=0><br><br>
               <center>
                 <input type="submit">
               </center>
             </form>
           </td>
         </tr>
       </table>
