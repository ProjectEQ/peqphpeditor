  <div class="table_container" style="width:250px;">
    <div class="table_header">Search Results</div>
    <div class="table_content">
<?
if($search_results != ''):
  $x = 0;
  foreach ($search_results as $result):
    extract($result);
?>
      <a href="index.php?editor=keys&action=1&playerid=<?=$result['char_id']?>"><?=getPlayerName($result['char_id'])?> - (<?=$result['char_id']?>)</a><br/>
<?
    $x++;
  endforeach;
  if ($x == $list_limit) {
    echo "<br/>List limited to " . $list_limit . " results.";
  }
?>
<?else:?>
      Your search produced no results!
<?endif;?>
    </div>
  </div>
