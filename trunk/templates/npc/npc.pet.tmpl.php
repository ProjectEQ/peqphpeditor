   <div class="table_container" style="width: 350px">
        <div class="table_header">
        <div style="float: right">
       <a href="index.php?editor=npc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=58"><img src="images/edit2.gif" border="0" title="Edit pet entry"></a>
       <a onClick="return confirm('Really Delete Pet entry for <?=getNPCName($npcid)?>?');" href="index.php?editor=npc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=57"><img src="images/remove3.gif" border="0" title="Delete Pet entry"></a>
       </div>  
       Pet data for <?=getNPCName($npcid)?> (<?=$npcid?>) 
       </div>
        <div class="table_content">
       <div style="padding: 5px 0px 0px 20px;">
          Type: <?=$type?><br>
          Petpower: <?=$petpower?><br>
          Petcontrol: <?=$pet_control[$petcontrol]?><br>
          Petnaming: <?=$pet_naming[$petnaming]?><br>
          Monsterflag: <?=$yesno[$monsterflag]?><br>
          Temp: <?=$yesno[$temp]?><br>
          </div>
         </div>
        </div><br><br>

   <div class="table_container" style="width: 550px">
        <div class="table_header">
        <div style="float: right">
       <?if($set_id > 0):?>
       <a onClick="return confirm('Really Remove Equipmentset <?=$set_id?> from Pet <?=$type?>?');" href="index.php?editor=npc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&set_id=<?=$set_id?>&action=63"><img src="images/minus2.gif" border="0" title="Remove Equipmentset from this pet"></a>
       <a onClick="return confirm('Really Delete Equipmentset <?=$set_id?> and all associated item entries?');" href="index.php?editor=npc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&set_id=<?=$set_id?>&action=62"><img src="images/remove3.gif" border="0" title="Delete Equipmentset and all entries"></a> 
        <?endif;?> 
      </div>  
       <?if($set_id > 0):?>
       <td>Equipmentset: <?=$setname?> <td align="center" width="5%"><a href="index.php?editor=npc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=64">(<?=$set_id?>)</a></td>
      <?endif;?> 
       <?if($set_id < 1):?>
       <td>Equipmentset: <td align="center" width="5%"><a href="index.php?editor=npc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=60">()</a></td>
      <?endif;?> 
        </div>
        <div class="table_content">
       <div style="padding: 5px 0px 0px 20px;">
          </div>
         </div>
        </div>