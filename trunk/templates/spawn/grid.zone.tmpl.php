      <div class="table_container" style="width: 375px;">
      <div class="table_header">
        <table width="100%" cellpadding="0" cellspacing="0">
          <tr>
           <td>Grids:</td>
           <td align="right">    
          <a href="index.php?editor=spawn&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&spid=<?=$spid?>&pathgrid=<?=$pathgrid?>&action=33">
                <img src="images/add.gif" border="0" title="Add a Grid to this zone">
              </a>
            </td>
           </tr>        
         </table>
      </div>

       <table class="table_content2" width="100%">
<? if (isset($grids)):?>
         <tr>
          <td align="center" width="10%"><strong>ID</strong></td>
          <td align="center" width="25%"><strong>Wander</strong></td>
          <td align="center" width="20%"><strong>Pause</strong></td>
          <td width="20%"></td>
         </tr>
<?$x=0; foreach($grids as $grid=>$v):?>
        <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
          <td align="center" width="5%"><?=$v['pathgrid']?></td>
          <td align="center" width="20%"><?=$wandertype[$v['type']]?></td>
          <td align="center" width="20%"><?=$pausetype[$v['type2']]?></td>
          <td align="right">
            <a href="index.php?editor=spawn&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&pathgrid=<?=$v['pathgrid']?>&action=66"><img src="images/view_all.gif" height="15" width="15" border="0" title="View npcs on this grid"></a>&nbsp;
            <a href="index.php?editor=spawn&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&pathgrid=<?=$v['pathgrid']?>&action=20"><img src="images/edit2.gif" border="0" title="View Grid Entry"></a>&nbsp;
            <a onClick="return confirm('Really delete Grid <?=$v['pathgrid']?>?');" href="index.php?editor=spawn&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&pathgrid=<?=$v['pathgrid']?>&action=32"> <img src="images/remove3.gif" border="0" title="Permanently delete this Grid Entry set"></a>&nbsp;
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