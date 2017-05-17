  <div class="table_container" style="width:250px;">
    <div class="table_header">Misc Search Results</div>
    <div class="table_content">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
<?
if($fishing == '' && $forage == '' && $gspawn == '') {
?>
          <td>Your search produced no results!</td>
<?
}
else {
?>
          <th align="left">Zone</th>
          <th align="left">Item</th>
        </tr>
<?
  if($fishing != '') {
    foreach($fishing as $fishing) {
      extract($fishing);
?>
        <tr>
          <td><?echo ($zoneid > 0) ? getZoneName($zoneid) : "All";?></td>
          <td><a href="index.php?editor=misc&fsid=<?=$fsid?>&action=26"><?=get_item_name($fiid)?></a></td>
<?
    }
  }
  elseif($forage != '') {
    foreach($forage as $forage) {
      extract($forage);
?>
        <tr>
          <td><?=getZoneName($zoneid)?></td>
          <td><a href="index.php?editor=misc&fgid=<?=$fgid?>&action=27"><?=get_item_name($fgiid)?></a></td>
<?
    }
  }
  elseif($gspawn != '') {
    foreach($gspawn as $gspawn) {
      extract($gspawn);
?>
        <tr>
          <td><?=getZoneName($zoneid)?></td>
          <td><a href="index.php?editor=misc&gsid=<?=$gsid?>&action=28"><?=get_item_name($giid)?></a></td>
<?
    }
  }
}
?>
        </tr>
      </table>
    </div>
  </div>
