      <div class="table_container" style="width: 400px;">
      <div class="table_header">
        <table width="100%" cellpadding="0" cellspacing="0">
          <tr>
           <td>Goallist for Task <a href="index.php?editor=tasks&tskid=<?=$tskid?>"><?=$tskid?></td>
           <td align="right">    
          <a href="index.php?editor=tasks&tskid=<?=$tskid?>&lid=<?=$lid?>&action=15"><img src="images/add.gif" border="0" title="Add a goallist"></a>
          <a onClick="return confirm('Really Delete Goallist <?=$lid?>?');" href="index.php?editor=tasks&tskid=<?=$tskid?>&lid=<?=$lid?>&action=16"><img src="images/remove3.gif" border="0" title="Delete this goallist"></a>  
           </td>
           </tr>        
         </table>
      </div>

       <table class="table_content2" width="100%">
<? if (isset($goallist)):?>
         <tr>
          <td align="center" width="5%"><strong>id</strong></td>
          <td align="center" width="20%"><strong>entry</strong></td>
          <th width="5%"></th>
         </tr>
<?$x=0; foreach($goallist as $goallist=>$v):?>
        <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
          <td align="center" width="5%"><?=$v['listid']?></td>
          <td align="center" width="20%"><a href="index.php?editor=items&tskid=<?=$id?>&id=<?=$v['entry']?>&action=2"></a><?=get_item_name($v['entry'])?> <span>[<a href="http://lucy.allakhazam.com/item.html?id=<?=$v['entry']?>">lucy</a>]</span></td>
          <td align="right">   
            <a onClick="return confirm('Really Delete Entry <?=$v['entry']?>?');" href="index.php?editor=tasks&tskid=<?=$tskid?>&lid=<?=$v['listid']?>&entry=<?=$v['entry']?>&action=14"><img src="images/remove3.gif" border="0" title="Delete this entry"></a>
          </td>
        </tr>
        <?$x++; endforeach;?>
        </table>
        <?endif;?>
<? if (!isset($goallist)):?>
        <tr>
          <td align="left" width="100" style="padding: 10px;">No goal list</td>
        </tr>
<?endif;?>