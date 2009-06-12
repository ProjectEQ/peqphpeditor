      <div class="table_container" style="width: 750px;">
      <div class="table_header">
        <table width="100%" cellpadding="0" cellspacing="0">
          <tr>
           <td>Doors</td>
           <td align="right">    
          <a href="index.php?editor=misc&z=<?=$currzone?>&action=39"><img src="images/add.gif" border="0" title="Add an entry to this zone"></a>
            </td>
           </tr>        
         </table>
      </div>

       <table class="table_content2" width="100%">
<? if (isset($doors)):?>
         <tr>
          <td align="center" width="2%"><strong>ID</strong></td>
          <td align="center" width="2%"><strong>Doorid</strong></td>
          <td align="center" width="2%"><strong>Name</strong></td>
          <td align="center" width="2%"><strong>X</strong></td>
          <td align="center" width="2%"><strong>Y</strong></td>
          <td align="center" width="2%"><strong>Z</strong></td>
          <td align="center" width="2%"><strong>Lockpick</strong></td>
          <td align="center" width="2%"><strong>Key</strong></td>
          <td align="center" width="2%"><strong>Type</strong></td>
          <td align="center" width="2%"><strong>Dest Zone</strong></td>
          <td align="center" width="2%"><strong>Dest X</strong></td>
          <td align="center" width="2%"><strong>Dest Y</strong></td>
          <td align="center" width="2%"><strong>Dest Z</strong></td>
   
          <td align="center" width="2%"><strong>LDoN</strong></td>
          <th width="5%"></th>
         </tr>
<?$x=0; foreach($doors as $doors=>$v):?>
        <tr bgcolor="#<? echo ($x % 2 == 0) ? "AAAAAA" : "BBBBBB";?>">
          <td align="center" width="2%"><?=$v['drid']?></td>
          <td align="center" width="2%"><?=$v['doorid']?></td>
          <td align="center" width="2%"><?=$v['name']?></td>
          <td align="center" width="2%"><?=$v['pos_x']?></td>   
          <td align="center" width="2%"><?=$v['pos_y']?></td>
          <td align="center" width="2%"><?=$v['pos_z']?></td>
          <td align="center" width="2%"><?=$v['lockpick']?></td> 
<?if($v['keyitem'] < 1):?>  
          <td align="center" width="2%"><?=$v['keyitem']?></td> 
<?endif;?>
<?if($v['keyitem'] > 0):?>  
          <td align="center" width="2%"><?=get_item_name($v['keyitem'])?> <span>[<a href="http://lucy.allakhazam.com/item.html?id=<?=$v['keyitem']?>">lucy</a>]</span></td>
<?endif;?>
          <td align="center" width="2%"><?=$v['opentype']?></td> 
          <td align="center" width="2%"><?=$v['dest_zone']?></td>   
          <td align="center" width="2%"><?=$v['dest_x']?></td>
          <td align="center" width="2%"><?=$v['dest_y']?></td>
          <td align="center" width="2%"><?=$v['dest_z']?></td>
          
          <td align="center" width="2%"><?=$yesno[$v['is_ldon_door']]?></td>
          <td align="right">      
            <a href="index.php?editor=misc&z=<?=$currzone?>&drid=<?=$v['drid']?>&action=36"><img src="images/edit2.gif" border="0" title="Edit Entry"></a>          
            <a onClick="return confirm('Really Delete Door <?=$v['drid']?>?');" href="index.php?editor=misc&z=<?=$currzone?>&drid=<?=$v['drid']?>&action=38"><img src="images/remove3.gif" border="0" title="Delete this entry"></a>
          </td>
        </tr>
        <?$x++; endforeach;?>
        </table>
        <?endif;?>
<? if (!isset($doors)):?>
        <tr>
          <td align="left" width="100" style="padding: 10px;">No doors</td>
        </tr>
<?endif;?>