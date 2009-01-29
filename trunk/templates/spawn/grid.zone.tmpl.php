      <div class="table_container" style="width: 350px;">
      <div class="table_header">
        <table width="100%" cellpadding="0" cellspacing="0">
          <tr>
           <td>Grids:</td>
           <td align="right">    
          <a href="index.php?editor=spawn&z=<?=$currzone?>&npcid=<?=$npcid?>&spid=<?=$spid?>&pathgrid=<?=$pathgrid?>&action=33">
                <img src="images/add.gif" border="0" title="Add a Grid to this zone">
              </a>
            </td>
           </tr>        
         </table>
      </div>

       <table class="table_content2" width="100%">
<? if (isset($grids)):?>
         <tr>
          <td align="center" width="5%"><strong>ID</strong></td>
          <td align="center" width="20%"><strong>Wander</strong></td>
          <td align="center" width="20%"><strong>Pause</strong></td>
          <th width="5%"></th>
         </tr>
<?$x=0; foreach($grids as $grid=>$v):?>
        <tr bgcolor="#<? echo ($x % 2 == 0) ? "AAAAAA" : "BBBBBB";?>">
          <td align="center" width="5%"><?=$v['pathgrid']?></td>
          <td align="center" width="20%"><?=$wandertype[$v['type']]?></td>
          <td align="center" width="20%"><?=$pausetype[$v['type2']]?></td>
          <td align="right">      
            <a href="index.php?editor=spawn&z=<?=$currzone?>&pathgrid=<?=$v['pathgrid']?>&number=<?=$number?>&action=20">
              <img src="images/edit2.gif" border="0" title="View Grid Entry">
            </a>          
            <a onClick="return confirm('Really delete Grid <?=$v['pathgrid']?>?');" a href="index.php?editor=spawn&z=<?=$currzone?>&pathgrid=<?=$v['pathgrid']?>&number=<?=$number?>&action=32"> <img src="images/remove3.gif" border="0" title="Permanently delete this Grid Entry set"></a>
          </td>
        </tr>
        <?$x++; endforeach;?>
        </table>
        <?endif;?>
<? if (!isset($grids)):?>
        <tr>
          <td align="left" width="100" style="padding: 10px;">No grid entries currently assigned</td>
        </tr>
<?endif;?>