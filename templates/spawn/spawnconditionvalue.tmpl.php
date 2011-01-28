      <div class="table_container" style="width: 225px;">
      <div class="table_header">
        <table width="100%" cellpadding="0" cellspacing="0">
          <tr>
           <td>Spawn Condition Values for ID <?=$scid?></td>
           <td align="right">    
          <a href="index.php?editor=spawn&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&spid=<?=$spid?>&scid=<?=$scid?>&action=61"><img src="images/add.gif" border="0" title="Add an instance"></a>
            </td>
           </tr>        
         </table>
      </div>

       <table class="table_content2" width="100%">
<? if (isset($spawncv)):?>
         <tr>
          <td align="center" width="10%"><strong>value</strong></td>
          <td align="center" width="10%"><strong>instance</strong></td>
          <th width="5%"></th>
         </tr>
<?$x=0; foreach($spawncv as $spawn=>$v):?>
        <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
          <td align="center" width="10%"><?=$v['value']?></td>
          <td align="center" width="10%"><?=$v['instance_id']?></td>
          <td align="right">   
          <? if ($v['instance_id'] > 0 ):?>    
            <a onClick="return confirm('Really Delete Value for Instance <?=$v['instance_id']?>?');" href="index.php?editor=spawn&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&spid=<?=$spid?>&scid=<?=$scid?>&instance_id=<?=$v['instance_id']?>&action=62"><img src="images/remove3.gif" border="0" title="Delete this entry"></a>
          <?endif;?>
          </td>
        </tr>
        <?$x++; endforeach;?>
        
        <?endif;?>
<? if (!isset($spawncv)):?>
        <tr>
          <td align="left" width="100" style="padding: 10px;">No spawn condition values</td>
        </tr>
<?endif;?>
</table>
</div>
      </div> 