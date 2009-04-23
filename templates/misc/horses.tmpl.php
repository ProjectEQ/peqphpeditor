      <div class="table_container" style="width: 700px;">
      <div class="table_header">
        <table width="100%" cellpadding="0" cellspacing="0">
          <tr>
           <td>Horses</td>
           <td align="right">    
          <a href="index.php?editor=misc&z=<?=$currzone?>&action=33"><img src="images/add.gif" border="0" title="Add an entry to this zone"></a>
            </td>
           </tr>        
         </table>
      </div>

       <table class="table_content2" width="100%">
<? if (isset($horses)):?>
         <tr>
          <td align="center" width="12%"><strong>Filename</strong></td>
          <td align="center" width="8%"><strong>Race</strong></td>
          <td align="center" width="8%"><strong>Gender</strong></td>
          <td align="center" width="8%"><strong>Texture</strong></td>
          <td align="center" width="8%"><strong>Speed</strong></td>
          <td align="center" width="12%"><strong>Notes</strong></td>
          <th width="5%"></th>
         </tr>
<?$x=0; foreach($horses as $horses=>$v):?>
        <tr bgcolor="#<? echo ($x % 2 == 0) ? "AAAAAA" : "BBBBBB";?>">
          <td align="center" width="12%"><?=$v['filename']?></td>
          <td align="center" width="8%"><?=$races[$v['race']]?></td>
          <td align="center" width="8%"><?=$genders[$v['gender']]?></td>
          <td align="center" width="8%"><?=$v['texture']?></td>   
          <td align="center" width="8%"><?=$v['mountspeed']?></td>
          <td align="center" width="12%"><?=$v['notes']?></td>
          <td align="right">      
            <a href="index.php?editor=misc&z=<?=$currzone?>&filename=<?=$v['filename']?>&action=30"><img src="images/edit2.gif" border="0" title="Edit Entry"></a>          
            <a onClick="return confirm('Really Delete Horse <?=$v['filename']?>?');" href="index.php?editor=misc&z=<?=$currzone?>&filename=<?=$v['filename']?>&action=32"><img src="images/remove3.gif" border="0" title="Delete this entry"></a>
          </td>
        </tr>
        <?$x++; endforeach;?>
        </table>
        <?endif;?>
<? if (!isset($horses)):?>
        <tr>
          <td align="left" width="100" style="padding: 10px;">No horse data</td>
        </tr>
<?endif;?>