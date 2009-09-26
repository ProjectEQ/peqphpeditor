      <div class="table_container" style="width: 250px">
      <div class="table_header">
           <td>NPCs using Merchantlist <?=$merid?></td>
      </div>
       <div class="table_content">
<?if ($merlist != ''):?>
  <?foreach($merlist as $merlist):?>
            <td align="center" width="5%"> <a href="index.php?editor=npc&z=<?=get_zone_by_npcid($merlist['npcid'])?>&npcid=<?=$merlist['npcid']?>"> <?=$merlist['name']?> - (<?=get_zone_by_npcid($merlist['npcid'])?>)</td><br>
 <?endforeach;?>
<?endif;?>
<?if ($merlist == ''):?>
               <tr>
                <td align="left" width="100" style="padding: 10px;">Merchantlist is not assigned to any NPCs.</td>
  <?endif;?>
           </div>
      </div>
            