  <div class="table_container" style="width: 650px;">
    <div class="table_header">
      <table style="width:100%; padding:0px; border-spacing:0px;">
        <tr>
          <td>Merc <?=$_GET['MercId']?>
          <td align="right"><a href="index.php?editor=mercs&MercId=<?=$_GET['MercId']?>&action=80"><img src="images/add.gif" title="Add Mercenary Buff"></a></td>
        </tr>
      </table>
    </div>
    <table class="table_content2" style="width:100%;">
<?if (isset($buffs)):?>
      <tr>
        <td align="center" width="15%"><strong>ID</strong></td>
        <td align="center" width="45%"><strong>Spell</strong></td>
        <td align="center" width="15%"><strong>Caster Level</strong></td>
        <td align="center" width="15%"><strong>Tics Remaining</strong></td>
        <td width="10%">&nbsp;</td>
      </tr>
<?$x=0;
foreach($buffs as $buff):?>
      <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
        <td align="center" width="15%"><?=$buff['MercBuffId']?></td>
        <td align="center" width="45%"><?=getSpellName($buff['SpellId'])?> (<?=$buff['SpellId']?>)</td>
        <td align="center" width="15%"><?=$buff['CasterLevel']?></td>
        <td align="center" width="15%"><?=$buff['TicsRemaining']?></td>
        <td align="right" width="10%">
          <a href="index.php?editor=mercs&MercBuffId=<?=$buff['MercBuffId']?>&action=82"><img src="images/edit2.gif" width="13" height="13" border="0" title="Edit Mercenary Buff"></a>&nbsp;
          <a href="index.php?editor=mercs&MercId=<?=$buff['MercId']?>&MercBuffId=<?=$buff['MercBuffId']?>&action=84" onClick="return confirm('Really delete mercenary buff?');"><img src="images/remove.gif" width="13" height="13" border="0" title="Delete Mercenary Buff"></a>
        </td>
      </tr>
<?$x++;
endforeach;
else:?>
      <tr>
        <td align="left" width="100%" style="padding: 10px;">No Mercenary Buffs</td>
      </tr>
<?endif;?>
    </table>
  </div>
