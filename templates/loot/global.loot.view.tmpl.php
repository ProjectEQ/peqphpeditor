  <div class="table_container" style="width: 600px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td>Global Loot</td>
          <td>
            <div style="float:right">
              <a href="index.php?editor=loot&action=50"><img src="images/add.gif" border="0" title="Create New Global Loot Entry"></a>
            </div>
          </td>
        </tr>
      </table>
    </div>
    <table class="table_content2" width="100%">
<?if (isset($global_loot)):?>
      <tr>
        <td align="center" width="10%"><strong>ID</strong></td>
        <td align="center" width="35%"><strong>Description</strong></td>
        <td align="center" width="20%"><strong>Loottable</strong></td>
        <td align="center" width="13%"><strong>Enabled</strong></td>
        <td align="center" width="12%"><strong>Hot Zone</strong></td>
        <td width="10%">&nbsp;</td>
      </tr>
<?$x=0;
foreach($global_loot as $loot):?>
      <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
        <td align="center" width="10%"><?=$loot['id']?></td>
        <td align="center" width="35%"><?=$loot['description']?></td>
        <td align="center" width="20%"><?=$loot['loottable_id']?></td>
        <td align="center" width="13%"><?=$yesno[$loot['enabled']]?></td>
        <td align="center" width="12%">
<?
switch ($loot['hot_zone']) {
  case "":
    echo "N/A";
    break;
  case "0":
    echo "No";
    break;
  case "1":
    echo "Yes";
    break;
}
?>
        </td>
        <td align="right" width="10%"><a href="index.php?editor=loot&id=<?=$loot['id']?>&action=55"><img src="images/edit2.gif" width="13" height="13" border="0" title="View Global Loot Entry"></a>&nbsp;<a onClick="return confirm('Really delete Global Loot <?=$loot['id']?>? NOTE: This will NOT delete the associated lootdrops or loottable.');" href="index.php?editor=loot&id=<?=$loot['id']?>&action=54"><img src="images/remove3.gif" border="0" title="Delete Global Loot Entry"></a></td>
      </tr>
<?$x++;
endforeach;
else:?>
      <tr>
        <td align="left" width="100%" style="padding: 10px;">No Global Loot</td>
      </tr>
<?endif;?>
    </table>
  </div>
