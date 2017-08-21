  <div class="table_container" style="width:250px;">
    <div class="table_header">Search Results</div>
    <div class="table_content">
<?if($results != ''):?>
<?foreach($results as $result): extract($result);?>
      <a href="index.php?editor=pvp&playerid=<?=$id?>&action=2"><?=$name?> (<?=$id?>)</a><br>
<?endforeach;?>
<?endif;?>
<?if($results == ''):?>
      Your search produced no results!
<?endif;?>
    </div>
  </div>
