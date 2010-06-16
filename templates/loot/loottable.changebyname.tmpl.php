<div class="edit_form" style="width: 300px">
      <div class="edit_form_header">
        Change Loottable
               </div>
        <div class="edit_form_content">
        <form method="post" action="index.php?editor=loot&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&ltid=<?=$ltid?>&action=39">
              <table width="100%">
          <tr>
              <th>npc name</th>
              <th>update all</th>
           </tr>
           <tr>
               <td><input type="text" size="25" name="npcname" value=""></td>
               <td>
               <select name="updateall">
                   <option value="0"<?echo ($updateall == 0) ? " selected" : ""?>>No</option>
                   <option value="1"<?echo ($updateall == 1) ? " selected" : ""?>>Yes</option>
                 </select>
               </td>
             </tr>
                 </table><br><br>
               <center>
                 <input type="submit">
               </center>
             </form>
         </div>
      </div>
  
