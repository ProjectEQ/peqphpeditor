  <div class="table_container" style="width: 700px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td>NPC Emotes</td>
          <td align="right">  
            <a href="index.php?editor=npc&action=78"><img src="images/c_table.gif" border="0" title="View all emotes"></a>
            <a href="index.php?editor=npc&emoteid=<?=$emoteid?>&action=79"><img src="images/view_all.gif" border="0" width="15" title="View NPCs using this emote set"></a>
            <a href="index.php?editor=npc&emoteid=<?=$emoteid?>&action=76"><img src="images/add.gif" border="0" title="Add an entry to this emote set"></a>
            <?echo ($npcid > 0) ? "<a href='index.php?editor=npc&emoteid=" . $emoteid . "&npcid=" . $npcid . "&action=82'><img src='images/minus2.gif' border='0' title='Drop emote set from this NPC'></a>" : "";?>
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
        <td align="center" width="65%"><?=html_replace($v['text'])?></td>
        <td align="right">      
          <a href="index.php?editor=npc&id=<?=$v['id']?>&emoteid=<?=$v['emoteid']?>&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=74"><img src="images/edit2.gif" border="0" title="Edit this entry"></a>          
          <a onClick="return confirm('Really Delete Entry <?=$v['id']?>?');" href="index.php?editor=npc&emoteid=<?=$v['emoteid']?>&id=<?=$v['id']?>&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=73"><img src="images/remove3.gif" border="0" title="Delete this entry"></a>
        </td>
      </tr>
<?$x++; endforeach;?>
<?endif;?>
<? if (!isset($emotes)):?>
      <tr>
        <td align="left" width="100" style="padding: 10px;">No NPC Emotes</td>
      </tr>
<?endif;?>
    </table>
  </div>
