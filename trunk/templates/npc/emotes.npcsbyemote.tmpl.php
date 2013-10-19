    <div class="table_container" style="width: 250px;">
      <div class="table_header">
        <table width="100%" cellpadding="0" cellspacing="0">
          <tr>
            <td align="left">NPCs using Emote Set <?=$emoteid?></td>
            <td align="right"><a href="index.php?editor=npc&action=78"><img src="images/c_table.gif" border="0" title="View all emotes"></a><a href="index.php?editor=npc&emoteid=<?=$emoteid?>&action=72"><img src="images/edit2.gif" width="13" height="13" border="0" title="Back to Emote Set <?=$emoteid?>"></a></td>
          </tr>
        </table>
      </div>
      <table class="table_content2" width="100%">
<?if (isset($npclist)):?>
        <tr>
          <td align="center"><strong>ID</strong></td>
          <td align="center"><strong>Name</strong></td>
        </tr>
<?$x=0;
foreach($npclist as $npc): extract($npc)?>
        <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
          <td align="center" width="20%"><a href="index.php?editor=npc&npcid=<?=$npc['id']?>"><?=$npc['id']?></a></td>
          <td align="center" width="80%"><a href="index.php?editor=npc&npcid=<?=$npc['id']?>"><?=$npc['name']?></a></td>
</tr>
<?$x++;
endforeach;
else:?>
        <tr>
          <td align="left" width="100" style="padding: 10px;">No NPCs using this Emote Set</td>
        </tr>
<?endif;?>
      </table>
    </div>
