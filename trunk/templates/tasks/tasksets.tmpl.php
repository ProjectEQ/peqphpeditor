       <div class="table_container" style="width: 400px;">
       <div class="table_header">
        <table width="100%" cellpadding="0" cellspacing="0">
          <tr>
           <td>Task Set for Task <a href="index.php?editor=tasks&tskid=<?=$tskid?>"><?=$tskid?></td>
           <td align="right">    
          <a href="index.php?editor=tasks&tskid=<?=$tskid?>&tsksetid=<?=$tsksetsid?>&action=30"><img src="images/add.gif" border=0 title="Add to a Task Set"></a>
          <a onClick="return confirm('Really Delete Task Set <?=$tsksetsid?>?');" href="index.php?editor=tasks&tskid=<?=$tskid?>&tsksetid=<?=$tsksetsid?>&action=33"><img src="images/remove3.gif" border="0" title="Delete this Task Set"></a>  
           </td>
           </tr>        
         </table>
         </div>
       <table class="table_content2" width="100%">
<? if (isset($tasksets)):?>
         <tr>
          <td align="center" width="5%"><strong>id</strong></td>
          <td align="center" width="20%"><strong>entry</strong></td>
          <th width="5%"></th>
         </tr>
<?$x=0; foreach($tasksets as $tasksets=>$v):?>
        <tr bgcolor="#<? echo ($x % 2 == 0) ? "AAAAAA" : "BBBBBB";?>">
          <td align="center" width="5%"><?=$v['id']?></td>
          <td align="center" width="20%"><a href="index.php?editor=tasks&tskid=<?=$v['taskid']?>"><?=getTaskTitle($v['taskid'])?></td>
          <td align="right">   
            <a onClick="return confirm('Really Delete Task <?=$v['taskid']?>?');" href="index.php?editor=tasks&tskid=<?=$tskid?>&entry=<?=$v['taskid']?>&tsksetid=<?=$v['id']?>&action=32"><img src="images/remove3.gif" border="0" title="Delete this entry"></a>
          </td>
        </tr>
        <?$x++; endforeach;?>
        </table>
        <?endif;?>
<? if (!isset($tasksets)):?>
        <tr>
          <td align="left" width="100" style="padding: 10px;">No Task Set</td>
        </tr>
<?endif;?>