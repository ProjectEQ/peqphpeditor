     <div class="table_container" style="width: 200px">
        <div class="table_header">
        <div style="float: right">
         <a onClick="return confirm('Really Delete Grid <?=$pathgrid?>?');" href="index.php?editor=spawn&z=<?=$currzone?>&npcid=<?=$npcid?>&spid=<?=$spid?>&pathgrid=<?=$pathgrid?>&number=<?=$number?>&action=29"><img src="images/remove3.gif" border="0" title="Delete Grid"></a>
        </div>
        Grid: <?=$pathgrid?>
      </div>
      <div class="table_content">
        Grid [<a href="index.php?editor=spawn&z=<?=$currzone?>&npcid=<?=$npcid?>&spid=<?=$spid?>&pathgrid=<?=$pathgrid?>&action=21">edit</a>]:<br>
      <div style="padding: 5px 0px 0px 20px;">
        Wander Type: <?=$wandertype[$type]?><br>
        Pause Type: <?=$pausetype[$type2]?><br>
      </div>
        </div>
      </div>
      <br>

      <div class="table_container" style="width: 500px">
      <div class="table_header">
        <table width="100%" cellpadding="0" cellspacing="0">
          <tr>
           <td>Grid Entries:</td>
           <td align="right">    
          <a href="index.php?editor=spawn&z=<?=$currzone?>&npcid=<?=$npcid?>&spid=<?=$spid?>&pathgrid=<?=$pathgrid?>&action=27">
                <img src="images/add.gif" border="0" title="Add an item to this Grid Entry Table">
              </a>
          <a onClick="return confirm('Really delete these Grid Entries from Grid <?=$pathgrid?>?');" href="index.php?editor=spawn&z=<?=$currzone?>&npcid=<?=$npcid?>&spid=<?=$spid?>&pathgrid=<?=$pathgrid?>&number=<?=$number?>&action=26"> <img src="images/table.gif" border="0" title="Permanently delete this Grid Entry set"></a></a>
            </td>
           </tr>        
         </table>
      </div>
 
      <table class="table_content2" width="100%">
<? if (isset($grids)):?>
         <tr>
          <td align="center" width="5%"><strong>Number</strong></td>
          <td align="center" width="10%"><strong>X</strong></td>
          <td align="center" width="10%"><strong>Y</strong></td>
          <td align="center" width="10%"><strong>Z</strong></td>
          <td align="center" width="10%"><strong>Heading</strong></td>
          <td align="center" width="10%"><strong>Pause</strong></td>
          <th width="5%"></th>
         </tr>
<?$x=0; foreach($grids as $number=>$v):?>
        <tr bgcolor="#<? echo ($x % 2 == 0) ? "AAAAAA" : "BBBBBB";?>">
          <td align="center" width="5%"><?=$number?></td>
          <td align="center" width="10%"><?=$v['x_coord']?></td>
          <td align="center" width="10%"><?=$v['y_coord']?></td>
          <td align="center" width="10%"><?=$v['z_coord']?></td>
          <td align="center" width="10%"><?=$v['heading']?></td>
          <td align="center" width="10%"><?=$v['pause']?></td>
          <td align="right">      
            <a href="index.php?editor=spawn&z=<?=$currzone?>&npcid=<?=$npcid?>&spid=<?=$spid?>&pathgrid=<?=$pathgrid?>&number=<?=$number?>&action=24">
              <img src="images/edit2.gif" border="0" title="Edit Grid Entry">
            </a>          
            <a href="index.php?editor=spawn&z=<?=$currzone?>&npcid=<?=$npcid?>&spid=<?=$spid?>&pathgrid=<?=$pathgrid?>&number=<?=$number?>&action=23">
              <img src="images/remove3.gif" border="0" title="Remove Grid Entry">
            </a>
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
