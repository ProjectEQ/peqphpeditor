  <?$export_sql = export_grid_sql();?>
  <div id="sql_block" style="display:none">
    <center>
      <textarea id="sql_text" rows="3" cols="90"><?=$export_sql?></textarea><br><br>
      <button type="button" id="copy_sql" onClick="clipboardData.setData('Text', sql_text.value);">Copy SQL to Clipboard</button>&nbsp;
      <button type="button" id="hide_sql" onClick="document.getElementById('sql_block').style.display='none';">Hide SQL</button>
    </center>
    <br/>
  </div>
  <div>
    <table class="edit_form">
      <tr>
        <td class="edit_form_content"><a href="index.php?editor=spawn&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&action=31">View Grids for <?=$currzone?></a></td>
      </tr>
    </table>
    <br />
  </div>
  <div class="table_container" style="width: 300px">
    <div class="table_header">
      <div style="float: right">
        <a onClick="document.getElementById('sql_block').style.display='block';"><img src="images/sql.gif" border="0" title="Show SQL"></a>
        <a href="index.php?editor=spawn&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&pathgrid=<?=$pathgrid?>&action=65"><img src="images/last.gif" border="0" title="Copy Grid <?=$pathgrid?> to next available id"></a>
        <a onClick="return confirm('Really Delete Grid <?=$pathgrid?>?');" href="index.php?editor=spawn&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&spid=<?=$spid?>&pathgrid=<?=$pathgrid?>&action=29"><img src="images/remove3.gif" border="0" title="Delete Grid"></a>
      </div>
      Grid: <?=$pathgrid?>
    </div>
    <div class="table_content">
      Grid [<a href="index.php?editor=spawn&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&spid=<?=$spid?>&pathgrid=<?=$pathgrid?>&action=21">edit</a>]:<br>
      <div style="padding: 5px 0px 0px 20px;">
        Wander Type: <?=$wandertype[$type]?><br>
        Pause Type: <?=$pausetype[$type2]?>
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
            <a href="index.php?editor=spawn&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&spid=<?=$spid?>&pathgrid=<?=$pathgrid?>&action=64"><img src="images/sort.gif" border=0 title="Sort grid numbers"></a>&nbsp;
            <a href="index.php?editor=spawn&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&spid=<?=$spid?>&pathgrid=<?=$pathgrid?>&action=27"><img src="images/add.gif" border="0" title="Add an item to this Grid Entry Table"></a>
            <a onClick="return confirm('Really delete these Grid Entries from Grid <?=$pathgrid?>?');" href="index.php?editor=spawn&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&spid=<?=$spid?>&pathgrid=<?=$pathgrid?>&action=26"><img src="images/table.gif" border="0" title="Permanently delete this Grid Entry set"></a>
          </td>
        </tr>        
      </table>
    </div>
    <table class="table_content2" width="100%">
<? if (isset($grids)):?>
         <tr>
          <td align="center" width="8%"><strong>Number</strong></td>
          <td align="center" width="13%"><strong>X</strong></td>
          <td align="center" width="13%"><strong>Y</strong></td>
          <td align="center" width="13%"><strong>Z</strong></td>
          <td align="center" width="13%"><strong>Heading</strong></td>
          <td align="center" width="13%"><strong>Pause</strong></td>
          <td align="center" width="13%"><strong>Centerpoint</strong></td>
          <td width="14%">&nbsp;</td>
         </tr>
<?$x=0; foreach($grids as $number=>$v):?>
        <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
          <td align="center" width="8%"><?=$number?></td>
          <td align="center" width="13%"><?=$v['x_coord']?></td>
          <td align="center" width="13%"><?=$v['y_coord']?></td>
          <td align="center" width="13%"><?=$v['z_coord']?></td>
          <td align="center" width="13%"><?=$v['heading']?></td>
          <td align="center" width="13%"><?=$v['pause']?></td>
          <td align="center" width="13%"><?=$v['centerpoint']?></td>
          <td align="right" width="14%">      
            <a href="index.php?editor=spawn&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&spid=<?=$spid?>&pathgrid=<?=$pathgrid?>&number=<?=$number?>&action=24"><img src="images/edit2.gif" border="0" title="Edit Grid Entry"></a>
<?$copy_string = "&x_coord=" . $v['x_coord'] . "&y_coord=" . $v['y_coord'] . "&z_coord=" . $v['z_coord'] . "&heading=" . $v['heading'] . "&pause=" . $v['pause'];?>
            <a href="index.php?editor=spawn&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&spid=<?=$spid?>&pathgrid=<?=$pathgrid?>&number=<?=$number?>&action=63<?echo $copy_string?>"><img src="images/movefile.gif" border="0" title="Copy Grid Entry"></a>
            <a href="index.php?editor=spawn&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&spid=<?=$spid?>&pathgrid=<?=$pathgrid?>&number=<?=$number?>&action=23"><img src="images/remove3.gif" border="0" title="Remove Grid Entry"></a>
          </td>
        </tr>
        <?$x++; endforeach;?>
        </table>
        <?endif;?>
<? if (!isset($grids)):?>
        <tr>
          <td align="left" width="100" style="padding: 10px;">No grid entries currently assigned</td>
        </tr>
	</table>
<?endif;?>
