       <?$id=$_GET['npc'];?>
       <form name="addnpc" method="post" action="index.php?editor=spawn&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&minx=<?=$minx?>&miny=<?=$miny?>&maxx=<?=$maxx?>&maxy=<?=$maxy?>&limit=<?=$limit?>&npcname=<?=$npcname?>&action=70">
       <table class="edit_form">
         <tr>
           <td class="edit_form_header" colspan=3>
             Add an NPC to multiple Spawngroups
           </td>
         </tr>
         <tr>
           <td class="edit_form_content">
               Search NPC Names for: <br>
               <input type="text" name="search">
           </td>
           <td valign="bottom" class="edit_form_content"><b>or</b></td>
           <td class="edit_form_content">
             Enter an NPC's ID: <br>
             <input type="text" name="npc" value=<?=$id?>>
           </td>
         </tr>
         <tr>
           <td class="edit_form_content" colspan="3"><center>Spawn Chance:<br/><input type="checkbox" name="balance" id="balance" onclick="if(this.checked){document.getElementById('chance').disabled='disabled';} else {document.getElementById('chance').disabled='';}">Balance spawn <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;or&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b> <input type="text" name="chance" id="chance" value="0" size="3"> %&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</center></td>
         </tr>
         <tr>
           <td colspan=3 align=center class="edit_form_content">
             <input type="submit" name="submit" value=" Submit ">
           </td>
         </tr>
       </table>
       </form>
