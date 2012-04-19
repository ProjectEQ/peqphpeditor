<div class="table_container" style="width: 700px;">
 <div class="table_header">
  <table width="100%" cellpadding="0" cellspacing="0">
   <tr>
    <td>Quest Script for NPC: <?=getNPCName($npcid)?> (<?=$npcid?>)</td>
   <td align="right">
    <a href="index.php?editor=npc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>">Go back to current NPC</a>
    </td>

   </tr>        
  </table>
 </div>
  <div class="edit_form_content">
   <table width="100%">
<td><textarea name="text" rows=82 cols=82>
<?php 
	if (file_exists($filename))   
	{  
		@readfile("$filename"); 
	}   
	else   
	{  
  		echo "Quest for this NPC not found.";  
	}  
?>
</textarea></td>
    </table>
   </div>
</div>