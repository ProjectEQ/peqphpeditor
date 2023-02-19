  <div class="table_container" style="width: 600px;">
    <div class="table_header">
      <table style="width:100%; padding:0px; border-spacing:0px;">
        <tr>
          <td align="right"><a href="index.php?editor=mercs&action=2"><img src="images/add.gif" title="Add Mercenary"></a></td>
        </tr>
      </table>
    </div>
    <table class="table_content2" style="width:100%;">
<?if (isset($mercs)):?>
      <tr>
        <td align="center" width="10%"><strong>ID</strong></td>
        <td align="center" width="35%"><strong>Owner</strong></td>
        <td align="center" width="10%"><strong>Slot</strong></td>
        <td align="center" width="35%"><strong>Name</strong></td>
        <td width="10%">&nbsp;</td>
      </tr>
<?$x=0;
foreach($mercs as $merc):?>
      <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
        <td align="center" width="10%"><?=$merc['MercID']?></td>
        <td align="center" width="35%"><?=getPlayerName($merc['OwnerCharacterID'])?> (<?=$merc['OwnerCharacterID']?>)</td>
        <td align="center" width="10%"><?=$merc['Slot']?></td>
        <td align="center" width="35%"><?=$merc['Name']?></td>
        <td align="right" width="10%">
          <a href="index.php?editor=mercs&MercId=<?=$merc['MercID']?>&action=79"><img src="images/stats.gif" width="13" height="13" border="0" title="Merc Buffs"></a>&nbsp;
          <a href="index.php?editor=mercs&MercID=<?=$merc['MercID']?>&action=4"><img src="images/edit2.gif" width="13" height="13" border="0" title="Edit Mercenary"></a>&nbsp;
          <a href="index.php?editor=mercs&MercID=<?=$merc['MercID']?>&action=6" onClick="return confirm('Really delete mercenary and associated entries?');"><img src="images/remove.gif" width="13" height="13" border="0" title="Delete Mercenary"></a>
        </td>
      </tr>
<?$x++;
endforeach;
else:?>
      <tr>
        <td align="left" width="100%" style="padding: 10px;">No Mercenaries</td>
      </tr>
<?endif;?>
    </table>
  </div>
