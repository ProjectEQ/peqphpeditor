      <div class="table_container" style="width: 600px;">
      <div class="table_header">
        <table width="100%" cellpadding="0" cellspacing="0">
          <tr>
           <td>Trap Templates</td>
           <td align="right">    
          <a href="index.php?editor=adventures&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=16"><img src="images/add.gif" border="0" title="Add a trap template"></a>
            </td>
           </tr>        
         </table>
      </div>

       <table class="table_content2" width="100%">
<? if (isset($ldontrap)):?>
         <tr>
          <td align="center" width="4%"><strong>id</strong></td>
          <td align="center" width="20%"><strong>type</strong></td>
          <td align="center" width="20%"><strong>spell</strong></td>
          <td align="center" width="10%"><strong>skill</strong></td>
          <td align="center" width="20%"><strong>locked</strong></td>
          <th width="5%"></th>
         </tr>
<?$x=0; foreach($ldontrap as $ldontrap=>$v):?>
        <tr bgcolor="#<? echo ($x % 2 == 0) ? "AAAAAA" : "BBBBBB";?>">
          <td align="center" width="4%"><?=$v['id']?></td>
          <td align="center" width="20%"><?=$ldontraptype[$v['type']]?></td>
<?if($v['spell_id'] == 0):?>   
          <td align="center" width="10%">None</td>  
<?endif;?>
<?if($v['spell_id'] > 0):?>  
          <td align="center" width="20%"><?=getSpellName($v['spell_id'])?> <span>[<a href="http://lucy.allakhazam.com/spell.html?id=<?=$v['spell_id']?>">lucy</a>]</span></td>
<?endif;?>
          <td align="center" width="10%"><?=$v['skill']?></td>
          <td align="center" width="20%"><?=$yesno[$v['locked']]?></td>
          <td align="right">      
            <a href="index.php?editor=adventures&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&id=<?=$v['id']?>&action=13"><img src="images/edit2.gif" border="0" title="Edit Trap Template"></a>          
            <a onClick="return confirm('Really Delete Trap Template <?=$v['id']?>?');" href="index.php?editor=adventures&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&id=<?=$v['id']?>&action=15"><img src="images/remove3.gif" border="0" title="Delete this entry"></a>
          </td>
        </tr>
        <?$x++; endforeach;?>
        </table>
        <?endif;?>
<? if (!isset($ldontrap)):?>
        <tr>
          <td align="left" width="100" style="padding: 10px;">There are no trap templates assigned to this NPC.</td>
        </tr>
<?endif;?>