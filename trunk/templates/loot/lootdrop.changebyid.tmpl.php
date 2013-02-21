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
               Enter Lootdrop ID:<br>
               <input type="text" name="ldid" size="10"><br><br>
               Mindrop: <br>
               <input type="text" name="mindrop" size="5" value="0"><br><br>
               Droplimit: <br>
               <input type="text" name="droplimit" size="5" value="0"><br><br>
               Multiplier: <br>
               <input type="text" name="multiplier" size="5" value="1"><br><br>
		 Probability: <br>
               <input type="text" name="probability" size="5" value="100"><br><br>
               <center>
                 <input type="submit">
               </center>
             </form>
           </td>
         </tr>
       </table>
