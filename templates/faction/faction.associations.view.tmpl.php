  <div class="table_container" style="width: 350px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td>&nbsp;</td>
          <td>
            <div style="float:right">
              <a href="index.php?editor=faction&action=26"><img src="images/add.gif" border="0" title="Create a new faction association"></a>
            </div>
          </td>
        </tr>
      </table>
    </div>
    <table class="table_content2" width="100%">
<?if (isset($faction_associations)):?>
      <tr>
        <td align="center"><strong>Faction ID</strong></td>
        <td width="15%">&nbsp;</td>
      </tr>
<?$x=0;
foreach($faction_associations as $faction_association):?>
      <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
        <td align="center"><?=getFactionName($faction_association['id'])?> (<?=$faction_association['id']?>)</td>
        <td align="right" width="15%"><a href="index.php?editor=faction&id=<?=$faction_association['id']?>&action=28"><img src="images/edit2.gif" width="13" height="13" border="0" title="Edit Faction Association"></a>&nbsp;<a onClick="return confirm('Really delete faction association <?=$faction_association['id']?>?');" href="index.php?editor=faction&id=<?=$faction_association['id']?>&action=30"><img src="images/remove3.gif" border="0" title="Delete Faction Association"></a></td>
      </tr>
<?$x++;
endforeach;
else:?>
      <tr>
        <td align="left" width="100%" style="padding: 10px;">No faction associations</td>
      </tr>
<?endif;?>
    </table>
  </div>
