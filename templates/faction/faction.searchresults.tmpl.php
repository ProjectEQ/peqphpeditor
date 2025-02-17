  <div class="table_container" style="width:250px;">
    <div class="table_header">Faction Search Results</div>
    <div class="table_content">
<?if(isset($results) && $results != ''):?>
<?  foreach($results as $result): extract($result);?>
      <a href="index.php?editor=faction&fid=<?=$id?>"><?=$name?> (<?=$id?>)</a><br>
<?  endforeach;?>
<?else:?>
      Your search produced no results!
<?endif;?>
    </div>
  </div>
