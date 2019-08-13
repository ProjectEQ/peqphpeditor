  <div class="table_container" style="width:250px;">
    <div class="table_header">Loot Search Results</div>
    <div class="table_content">
<?if($results != ''):?>
<?foreach($results as $result): extract($result);?>
<?
  $z = get_zone_by_npcid($id);
  $zoneid = getZoneIDByName($z);
?>
      <a href="index.php?editor=loot&z=<?=$z?>&npcid=<?=$id?>&zoneid=<?=$zoneid?>"><?=$name?> - (<?=$z?>)</a><br>
<?endforeach;?>
<?endif;?>
<?if($results == ''):?>
      Your search produced no results!
<?endif;?>
    </div>
  </div>
