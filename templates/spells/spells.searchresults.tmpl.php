  <div class="table_container" style="width:250px;">
    <div class="table_header">Spell Search Results</div>
    <div class="table_content">
<?
if($results) {
  foreach($results as $result) {
    extract($result);
    echo "<a href='index.php?editor=spells&id=" . $id . "&action=2'>" . $id . " - " . $name . "</a><br>";
  }
}
else {
  echo "Your search produced no results!";
}
?>
    </div>
  </div>
