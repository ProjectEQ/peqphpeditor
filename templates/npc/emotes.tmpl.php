      <div class="table_container" style="width: 700px;">
      <div class="table_header">
        <table width="100%" cellpadding="0" cellspacing="0">
          <tr>
           <td>NPC Emotes</td>
           <td align="right">  
          <?if($emoteid != $npcid) {?>
          <a href="index.php?editor=npc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&emoteid=<?=$emoteid?>&action=76"><img src="images/add.gif" border="0" title="Add an entry to this emote set"></a>
          <?} else {?>
          <a href="index.php?editor=npc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=78"><img src="images/add.gif" border="0" title="Add an entry to this emote set"></a>
          <?}?>
            </td>
           </tr>        
         </table>
      </div>

       <table class="table_content2" width="100%">
<? if (isset($emotes)):?>
         <tr>
          <td align="center" width="10%"><strong>EmoteID</strong></td>
          <td align="center" width="10%"><strong>Event</strong></td>
          <td align="center" width="10%"><strong>Type</strong></td>
          <td align="center" width="65%"><strong>Text</strong></td>
          <th width="5%"></th>
         </tr>
<?$x=0; foreach($emotes as $emotes=>$v):?>
        <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
          <td align="center" width="10%"><?=$v['emoteid']?></td>
          <td align="center" width="10%"><?=$eventtype[$v['event_']]?></td>
          <td align="center" width="10%"><?=$emotetype[$v['type']]?></td>
          <td align="center" width="65%"><?=$v['text']?></td>
          <td align="right">      
            <a href="index.php?editor=npc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&id=<?=$v['id']?>&action=74"><img src="images/edit2.gif" border="0" title="Edit Entry"></a>          
            <a onClick="return confirm('Really Delete Entry <?=$v['id']?>?');" href="index.php?editor=npc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&emoteid=<?=$v['emoteid']?>&id=<?=$v['id']?>&action=73"><img src="images/remove3.gif" border="0" title="Delete this entry"></a>
          </td>
        </tr>
        <?$x++; endforeach;?>
        </table>
        <?endif;?>
<? if (!isset($emotes)):?>
        <tr>
          <td align="left" width="100" style="padding: 10px;">No NPC Emotes</td>
        </tr>
<?endif;?>