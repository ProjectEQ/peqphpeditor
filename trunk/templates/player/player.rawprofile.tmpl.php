<div class="table_container">
  <div class="table_header">
    Raw Profile: <?=getPlayerName($playerid)?>
    <div style="float:right">
      <a href="index.php?editor=player&playerid=<?=$playerid?>">View Formatted Profile</a>
    </div>
  </div>
  <div class="table_content">
<?
foreach ($profile as $k=>$v) {
  echo "<b>Key:</b> " . $k . "<br/><b>Value:</b> " . $v . "<br/><br/>";
}
?>
  </div>
</div>
