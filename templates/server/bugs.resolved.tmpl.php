      <div class="table_container" style="width: 600px;">
      <div class="table_header">
        <table width="100%" cellpadding="0" cellspacing="0">
          <tr>
           <td>Bugs</td>
           <td align="right">              
           <a href="index.php?editor=server&action=1">View Open Bugs</a>
            </td>
           </tr>        
         </table>
      </div>

       <table class="table_content2" width="100%">
<? if (isset($bugs)) :?>
         <tr>
          <td align="center" width="5%"><strong>ID</strong></td>
          <td align="center" width="15%"><strong>Zone</strong></td>
          <td align="center" width="15%"><strong>Toon</strong></td>
          <td align="center" width="15%"><strong>Type</strong></td>
          <td align="center" width="15%"><strong>Target</strong></td>
          <td align="center" width="15%"><strong>Date</strong></td>
          <td align="center" width="15%"><strong>Status</strong></td>
          <th width="5%"></th>
         </tr>
       <?$x=0; foreach($bugs as $bugs=>$v):?>
  <?if($v['status'] != 0):?>
        <tr bgcolor="#<? echo ($x % 2 == 0) ? "AAAAAA" : "BBBBBB";?>">
          <td align="center" width="5%"><?=$v['bid']?></td>
          <td align="center" width="15%"><?=$v['zone']?></td>
          <td align="center" width="15%"><?=$v['name']?></td>
          <td align="center" width="15%"><?=$v['type']?></td>
          <td align="center" width="15%"><?=$v['target']?></td>
          <td align="center" width="15%"><?=$v['date']?></td>
          <td align="center" width="15%"><?=$bugstatus[$v['status']]?></td>
           <td align="right"> 
            <a href="index.php?editor=server&bid=<?=$v['bid']?>&action=2"><img src="images/edit2.gif" border="0" title="View Entry"></a>          
           </td>
           <td align="right">  
            <a onClick="return confirm('Really Delete Report <?=$v['bid']?>?');" href="index.php?editor=server&bid=<?=$v['bid']?>&action=5"><img src="images/remove3.gif" border="0" title="Delete Entry"></a>
          </td>
        </tr>
        <?endif;?>
        <?$x++; endforeach;?>
        </table>
        <?endif;?>
