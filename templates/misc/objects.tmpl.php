  <div class="table_container" style="width: 750px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td>Objects</td>
          <td align="right">
            <a href="index.php?editor=misc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&action=53"><img src="images/last.gif" border="0" title="Copy objects by version"></a>&nbsp;
            <a href="index.php?editor=misc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&action=45"><img src="images/add.gif" border="0" title="Add an entry to this zone"></a>&nbsp;
            <a href="index.php?editor=misc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&action=61"><img src="images/remove3.gif" border="0" title="Delete objects by version"></a>
          </td>
        </tr>
      </table>
    </div>
    <table class="table_content2" width="100%">
<?
if (isset($objects)):
?>
      <tr>
        <td align="center" width="7%"><strong>ID</strong></td>
        <td align="center" width="7%"><strong>X</strong></td>
        <td align="center" width="7%"><strong>Y</strong></td>
        <td align="center" width="7%"><strong>Z</strong></td>
        <td align="center" width="7%"><strong>Heading</strong></td>
        <td align="center" width="7%"><strong>Item</strong></td>
        <td align="center" width="7%"><strong>Charges</strong></td>
        <td align="center" width="15%"><strong>Name</strong></td>
        <td align="center" width="15%"><strong>Type</strong></td>
        <td align="center" width="7%"><strong>Icon</strong></td>
        <td align="center" width="7%"><strong>Version</strong></td>
        <td width="7%">&nbsp;</td>
      </tr>
<?
  $x=0;
  foreach($objects as $objects=>$v):
?>
      <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
        <td align="center" width="2%"><?=$v['objid']?></td>
        <td align="center" width="2%"><?=$v['xpos']?></td>
        <td align="center" width="2%"><?=$v['ypos']?></td>
        <td align="center" width="2%"><?=$v['zpos']?></td>
        <td align="center" width="2%"><?=$v['heading']?></td>
<?
    if($v['itemid'] < 1):
?>
        <td align="center" width="2%"><?=$v['itemid']?></td>
<?
    endif;
    if($v['itemid'] > 0):
?>
        <td align="center" width="2%"><?=get_item_name($v['itemid'])?> <span>[<a href="http://lucy.allakhazam.com/item.html?id=<?=$v['itemid']?>">lucy</a>]</span></td>
<?
    endif;
?>
        <td align="center" width="2%"><?=$v['charges']?></td>
        <td align="center" width="2%"><?=$v['objectname']?></td>
        <td align="center" width="2%"><?=$world_containers[$v['type']]?></td>
        <td align="center" width="2%"><?=$v['icon']?></td>
        <td align="center" width="2%"><?=$v['version']?></td>
        <td align="right">
          <a href="index.php?editor=misc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&objid=<?=$v['objid']?>&action=42"><img src="images/edit2.gif" border="0" title="Edit Entry"></a>&nbsp;
          <a onClick="return confirm('Really Delete Object <?=$v['objid']?>?');" href="index.php?editor=misc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&objid=<?=$v['objid']?>&action=44"><img src="images/remove3.gif" border="0" title="Delete this entry"></a>
        </td>
      </tr>
<?
    $x++;
  endforeach;
endif;
if (!isset($objects)):
?>
      <tr>
        <td align="left" width="100" style="padding: 10px;">No objects</td>
      </tr>
<?
endif;
?>
    </table>
  </div>
