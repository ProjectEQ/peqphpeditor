      <div class="table_container" style="width: 350px">
      <div class="table_header">
        <table width="100%" cellpadding="0" cellspacing="0">
          <tr>
           <td>Spawn Status</td>
           <td align="right">    
            </td>
           </tr>        
         </table>
      </div>
       
       <table class="table_content2" width="100%">
<? if (isset($spawned)):?>
            <td width="80%">This spawnpoint is waiting to spawn in-game</td>
            <td align="right">  
            <a href="index.php?editor=spawn&z=<?=$currzone?>&npcid=<?=$npcid?>&sid=<?=$sid?>&spid=<?=$spid?>&action=47"><img src="images/add.gif" border="0" title="Edit directly (Not recommended)"></a>
            <a href="index.php?editor=spawn&z=<?=$currzone?>&npcid=<?=$npcid?>&sid=<?=$sid?>&spid=<?=$spid?>&action=30"><img src="images/remove3.gif" border="0" title="Force respawn"></a>
            </td>
            <?endif;?>
<? if (!isset($spawned)):?>
            <td width="25%">This spawnpoint is currently spawned in-game</td>
            <?endif;?>
            </tr>
     </table>
 