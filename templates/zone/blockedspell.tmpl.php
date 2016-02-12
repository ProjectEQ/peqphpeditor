  <div class="table_container" style="width: 750px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td>Blocked Spells</td>
          <td align="right">
            <a href="index.php?editor=zone&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&action=22"><img src="images/add.gif" border="0" title="Add Blocked Spell"></a>
          </td>
        </tr>        
      </table>
    </div>
    <table class="table_content2" width="100%">
<? if (isset($blockedspell)):?>
      <tr>
        <td align="center" width="5%"><strong>ID</strong></td>
        <td align="center" width="14%"><strong>Spell</strong></td>
        <td align="center" width="8%"><strong>Type</strong></td>
        <td align="center" width="5%"><strong>X</strong></td>
        <td align="center" width="5%"><strong>Y</strong></td>
        <td align="center" width="5%"><strong>Z</strong></td>
        <td align="center" width="6%"><strong>X Diff</strong></td>
        <td align="center" width="6%"><strong>Y Diff</strong></td>
        <td align="center" width="6%"><strong>Z Diff</strong></td>
        <td align="center" width="25%"><strong>Message</strong></td>
        <td align="center" width="10%"><strong>Description</strong></td>
        <td width="5%">&nbsp;</td>
      </tr>
<?$x=0; foreach($blockedspell as $blockedspell=>$v):?>
      <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
        <td align="center" width="5%"><?=$v['bsid']?></td>
        <td align="center" width="14%"><?=getSpellName($v['spellid'])?> <span>[<a href="http://lucy.allakhazam.com/spell.html?id=<?=$v['spellid']?>" target="_blank">lucy</a>]</span></td>
        <td align="center" width="8%"><?=$blockedtype[$v['type']]?></td>
        <td align="center" width="5%"><?=$v['x_coord']?></td> 
        <td align="center" width="5%"><?=$v['y_coord']?></td>
        <td align="center" width="5%"><?=$v['z_coord']?></td>
        <td align="center" width="6%"><?=$v['x_diff']?></td>
        <td align="center" width="6%"><?=$v['y_diff']?></td>
        <td align="center" width="6%"><?=$v['z_diff']?></td>
        <td align="center" width="25%"><?=$v['message']?></td> 
        <td align="center" width="10%"><?=$v['description']?></td>
        <td align="right" width="5%">      
          <a href="index.php?editor=zone&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&bsid=<?=$v['bsid']?>&action=19"><img src="images/edit2.gif" border="0" title="Edit Entry"></a>          
          <a onClick="return confirm('Really Delete Spell <?=$v['bsid']?>?');"href="index.php?editor=zone&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&bsid=<?=$v['bsid']?>&action=21"><img src="images/remove3.gif" border="0" title="Delete this entry"></a>
        </td>
      </tr>
<?$x++; endforeach;?>
<?endif;?>
<? if (!isset($blockedspell)):?>
      <tr>
        <td align="left" width="100" style="padding: 10px;">No blocked spells found</td>
      </tr>
<?endif;?>
    </table>
  </div>
