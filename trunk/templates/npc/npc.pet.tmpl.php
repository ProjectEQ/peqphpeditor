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

      <div class="table_container" style="width: 350px">
        <div class="table_header">
        <div style="float:right">
        <?if($set_id > 0):?>
       <a href="index.php?editor=npc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&set_id=<?=$set_id?>&action=66"><img src="images/add.gif" border="0" title="Add equipementset entry"></a>
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
       
         <table class="table_content2" width="100%">  
<? if (isset($equipment)):?>
         <tr>
          <td align="center" width="5%"><strong>Slot</strong></td>
          <td align="center" width="20%"><strong>Item</strong></td>
          <th width="5%"></th>
         </tr>
<?$x=0; foreach($equipment as $equipment=>$v):?>
        <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
          <td align="center" width="5%"><?=$v['slot']?></td>
          <td align="center" width="20%"><a href="index.php?editor=items&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&id=<?=$v['item_id']?>&action=2"><?=get_item_name($v['item_id'])?></a> <span>[<a href="http://lucy.allakhazam.com/item.html?id=<?=$v['item_id']?>">lucy</a>]</span></td>
          <td align="right">      
            <a href=index.php?editor=npc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&set_id=<?=$set_id?>&slot=<?=$v['slot']?>&action=69"><img src="images/edit2.gif" border="0" title="Edit Entry"></a>          
            <a onClick="return confirm('Really Remove the Equipmentset Entry in slot <?=$v['slot']?>?');" href="index.php?editor=npc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&set_id=<?=$set_id?>&slot=<?=$v['slot']?>&action=68"><img src="images/remove3.gif" border="0" title="Remove Equipmentset entry"></a>
          </td>
        </tr>
        <?$x++; endforeach;?>
        </table>
<?endif;?>
<? if (!isset($equipment)):?>
        <tr>
          <td align="left" width="100" style="padding: 10px;">No item entries.</td>
        </tr>
<?endif;?>
         </div>
        </div>