      <div class="table_container" style="width: 750px;">
      <div class="table_header">
        <table width="100%" cellpadding="0" cellspacing="0">
          <tr>
           <td>Proximity for Task <a href="index.php?editor=tasks&tskid=<?=$tskid?>"><?=$tskid?></td>
           <td align="right">    
           <a href="index.php?editor=tasks&tskid=<?=$tskid?>&eid=<?=$eid?>&action=18"><img src="images/edit2.gif" border="0" title="Edit Entry"></a>                 
            <a onClick="return confirm('Really Delete Proximity <?=$eid?>?');" href="index.php?editor=tasks&tskid=<?=$tskid?>&eid=<?=$eid?>&aid=<?=$aid?>&action=20"><img src="images/remove3.gif" border="0" title="Delete this entry"></a>
           </tr>        
         </table>
         </div>
       <table class="table_content2" width="100%"> 
       <? if (isset($proximity)):?>
         <tr>
          <td align="center" width="5%"><strong>id</strong></td>
          <td align="center" width="10%"><strong>zone</strong></td>
          <td align="center" width="10%"><strong>min x</strong></td>
          <td align="center" width="10%"><strong>min y</strong></td>
          <td align="center" width="10%"><strong>min z</strong></td>
          <td align="center" width="10%"><strong>max x</strong></td>
          <td align="center" width="10%"><strong>max y</strong></td>
          <td align="center" width="10%"><strong>max z</strong></td>
          <th width="5%"></th>
         </tr>
        <?$x=0; foreach($proximity as $proximity=>$v):?>
        <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
          <td align="center" width="5%"><?=$v['exploreid']?></td>
          <td align="center" width="10%"><?=getZoneName($v['zoneid'])?></td>
          <td align="center" width="10%"><?=$v['minx']?></td>
          <td align="center" width="10%"><?=$v['miny']?></td>
          <td align="center" width="10%"><?=$v['minz']?></td>
          <td align="center" width="10%"><?=$v['maxx']?></td>
          <td align="center" width="10%"><?=$v['maxy']?></td>
          <td align="center" width="10%"><?=$v['maxz']?></td>
          <td align="right">   
          </td>
        </tr>
        <?$x++; endforeach;?>
        </table>
        <?endif;?>
<? if (!isset($proximity)):?>
        <tr>
          <td align="left" width="100" style="padding: 10px;">No proximity found.</td>
        </tr>
<?endif;?>