      <div class="table_container" style="width: 400px;">
      <div class="table_header">
        <table width="100%" cellpadding="0" cellspacing="0">
          <tr>
           <td>Forage</td>
           <td align="right">    
          <a href="index.php?editor=misc&z=<?=$currzone?>&action=11"><img src="images/add.gif" border="0" title="Add an entry to this zone"></a>
            </td>
           </tr>        
         </table>
      </div>

       <table class="table_content2" width="100%">
         <tr>
          <td align="center" width="5%"><strong>ID</strong></td>
          <td align="center" width="10%"><strong>Zone</strong></td>
          <td align="center" width="20%"><strong>Item</strong></td>
          <td align="center" width="5%"><strong>Level</strong></td>
          <td align="center" width="5%"><strong>Chance</strong></td>
          <th width="5%"></th>
         </tr>
        <tr bgcolor="#<? echo ($x % 2 == 0) ? "AAAAAA" : "BBBBBB";?>">
          <td align="center" width="5%"><?=$fgid?></td>
<?if($zoneid == 0):?>          
          <td align="center" width="10%">All</td>
<?endif;?>
<?if($zoneid != 0):?> 
          <td align="center" width="10%"><?=getZoneName($zoneid)?></td>
<?endif;?>
          <td align="center" width="20%"><?=get_item_name($fgiid)?> <span>[<a href="http://lucy.allakhazam.com/item.html?id=<?=$fgiid?>">lucy</a>]</span></td>
          <td align="center" width="5%"><?=$level?></td>
          <td align="center" width="5%"><?=$chance?>%</td>  
          <td align="right">      
            <a href="index.php?editor=misc&z=<?=$currzone?>&fgid=<?=$fgid?>&action=8"><img src="images/edit2.gif" border="0" title="Edit Entry"></a>          
            <a href="index.php?editor=misc&z=<?=$currzone?>&fgid=<?=$fgid?>&action=10"><img src="images/remove3.gif" border="0" title="Delete this entry"></a>
          </td>
        </tr>
        </table>