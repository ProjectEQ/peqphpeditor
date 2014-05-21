      <div class="table_container" style="width: 550px;">
      <div class="table_header">
        <table width="100%" cellpadding="0" cellspacing="0">
          <tr>
           <td>Spawn Conditions</td>
           <td align="right">    
          <a href="index.php?editor=spawn&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&spid=<?=$spid?>&scid=<?=$v['scid']?>&action=45"><img src="images/add.gif" border="0" title="Add an entry to this zone"></a>
            </td>
           </tr>        
         </table>
      </div>

       <table class="table_content2" width="100%">
<? if (isset($spawnc)):?>
         <tr>
          <td align="center" width="5%"><strong>id</strong></td>
          <td align="center" width="10%"><strong>value</strong></td>
          <td align="center" width="10%"><strong>onchange</strong></td>
          <td align="center" width="10%"><strong>name</strong></td>
          <th width="5%"></th>
         </tr>
<?$x=0; foreach($spawnc as $spawnc=>$v):?>
        <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
          <td align="center" width="5%"><?=$v['scid']?></td>
          <td align="center" width="10%"><?=$v['value']?></td>
          <td align="center" width="10%"><?=$ochangetype[$v['onchange']]?></td>
          <td align="center" width="10%"><?=$v['name']?></td>
          <td align="right">      
            <a href="index.php?editor=spawn&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&spid=<?=$spid?>&scid=<?=$v['scid']?>&action=42"><img src="images/edit2.gif" border="0" title="Edit Entry"></a>    
            <a href="index.php?editor=spawn&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&spid=<?=$spid?>&scid=<?=$v['scid']?>&action=60"><img src="images/config.gif" border="0" title="View entries"></a>      
            <a onClick="return confirm('Really Delete Condition <?=$v['scid']?>?');" href="index.php?editor=spawn&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&spid=<?=$spid?>&scid=<?=$v['scid']?>&action=44"><img src="images/remove3.gif" border="0" title="Delete this entry"></a>
          </td>
        </tr>
        <?$x++; endforeach;?>
        
        <?endif;?>
<? if (!isset($spawnc)):?>
        <tr>
          <td align="left" width="100" style="padding: 10px;">No spawn conditions</td>
        </tr>
<?endif;?>
</table>
</div>
        
<br><br>

      <div class="table_container" style="width: 750px;">
      <div class="table_header">
        <table width="100%" cellpadding="0" cellspacing="0">
          <tr>
           <td>Spawn Events</td>
           <td align="right">    
          <a href="index.php?editor=spawn&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&spid=<?=$spid?>&seid=<?=$v['seid']?>&action=40"><img src="images/add.gif" border="0" title="Add a spawn event"></a>
            </td>
           </tr>        
         </table>
      </div>

       <table class="table_content2" width="100%">
<? if (isset($spawne)):?>
         <tr>
          <td align="center" width="5%"><strong>id</strong></td>
          <td align="center" width="5%"><strong>cond id</strong></td>
          <td align="center" width="10%"><strong>name</strong></td>
          <td align="center" width="5%"><strong>period</strong></td>
          <td align="center" width="5%"><strong>min</strong></td>
          <td align="center" width="5%"><strong>hour</strong></td>
          <td align="center" width="5%"><strong>day</strong></td>
          <td align="center" width="5%"><strong>month</strong></td>
          <td align="center" width="5%"><strong>year</strong></td>
          <td align="center" width="5%"><strong>enabled</strong></td>
          <td align="center" width="5%"><strong>action</strong></td>
          <td align="center" width="5%"><strong>argument</strong></td>
	   <td align="center" width="5%"><strong>strict</strong></td>
          <th width="5%"></th>
         </tr>
<?$x=0; foreach($spawne as $spawne=>$v):?>
        <tr bgcolor="#<? echo ($x % 2 == 0) ? "AAAAAA" : "BBBBBB";?>">
          <td align="center" width="5%"><?=$v['seid']?></td>
          <td align="center" width="5%"><?=$v['cond_id']?></td>
          <td align="center" width="10%"><?=$v['sename']?></td>
          <td align="center" width="5%"><?=$v['period']?></td>
          <td align="center" width="5%"><?=$v['next_minute']?></td>
          <td align="center" width="5%"><?=$v['next_hour']?></td>
          <td align="center" width="5%"><?=$v['next_day']?></td>
          <td align="center" width="5%"><?=$v['next_month']?></td>
          <td align="center" width="5%"><?=$v['next_year']?></td>
          <td align="center" width="5%"><?=$yesno[$v['enabled']]?></td>
          <td align="center" width="5%"><?=$actiontype[$v['action']]?></td>
          <td align="center" width="5%"><?=$v['argument']?></td>
	   <td align="center" width="5%"><?=$yesno[$v['strict']]?></td>
          <td align="right">      
            <a href="index.php?editor=spawn&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&spid=<?=$spid?>&seid=<?=$v['seid']?>&action=37"><img src="images/edit2.gif" border="0" title="Edit Entry"></a>          
            <a onClick="return confirm('Really Delete Condition <?=$v['seid']?>?');" href="index.php?editor=spawn&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&spid=<?=$spid?>&seid=<?=$v['seid']?>&action=39"><img src="images/remove3.gif" border="0" title="Delete this entry"></a>
          </td>
        </tr>
        <?$x++; endforeach;?>
        
        <?endif;?>
<? if (!isset($spawne)):?>
        <tr>
          <td align="left" width="100" style="padding: 10px;">No spawn events</td>
        </tr>
<?endif;?>
</table>
      </div> 