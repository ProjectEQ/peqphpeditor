      <div class="table_container" style="width: 500px;">
      <div class="table_header">
        <table width="100%" cellpadding="0" cellspacing="0">
          <tr>
           <td>Forage</td>
           <td align="right">    
          <a href="index.php?editor=misc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&action=11"><img src="images/add.gif" border="0" title="Add an entry to this zone"></a>
            </td>
           </tr>        
         </table>
      </div>

       <table class="table_content2" width="100%">
<? if (isset($forage)):?>
         <tr>
          <td align="center" width="5%"><strong>ID</strong></td>
          <td align="center" width="20%"><strong>Item</strong></td>
          <td align="center" width="15%"><strong>Level</strong></td>
          <td align="center" width="15%"><strong>Chance</strong></td>
          <th width="5%"></th>
         </tr>
<?$x=0; foreach($forage as $forage=>$v):?>
        <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
          <td align="center" width="5%"><?=$v['fgid']?></td>
          <td align="center" width="20%"><a href="index.php?editor=items&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&id=<?=$v['fgiid']?>&action=2"><?=$v['name']?></a> <span>[<a href="http://lucy.allakhazam.com/item.html?id=<?=$v['fgiid']?>">lucy</a>]</span></td>
          <td align="center" width="15%"><?=$v['level']?></td>
          <td align="center" width="15%"><?=$v['chance']?>%</td>  
          <td align="right">      
            <a href="index.php?editor=misc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&fgid=<?=$v['fgid']?>&action=8"><img src="images/edit2.gif" border="0" title="Edit Entry"></a>          
            <a onClick="return confirm('Really Delete Entry <?=$v['fgid']?>?');" href="index.php?editor=misc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&fgid=<?=$v['fgid']?>&action=10"><img src="images/remove3.gif" border="0" title="Delete this entry"></a>
          </td>
        </tr>
        <?$x++; endforeach;?>
        </table>
        <?endif;?>
<? if (!isset($forage)):?>
        <tr>
          <td align="left" width="100" style="padding: 10px;">No forage data</td>
        </tr>
<?endif;?>