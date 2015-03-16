<html>
  <body bgcolor="#FFCCCC">
<?php

if(isset($_GET['name']) && ($_GET['name'] != '')) {
  require("../../config.php");
  if($mysql_class = "mysqli")
    require("../../classes/mysqli.php");
  else
    require("../../classes/mysql.php");
  $name = $_GET['name'];
  $query = "SELECT name FROM character_data WHERE name rlike \"$name\" LIMIT 50";
  $results = $mysql->query_mult_assoc($query);
  if($results == '') {
    echo "No players found!<br />";
  }
  else {
    echo (count($results) == 50) ? "<i>Results limited to 50. Narrow your search to improve search results.</i>" : "";
    echo "<ul>";
    foreach($results as $result) {
      extract($result);
      echo "<li><a href=\"javascript:parent.document.getElementById('to_text').value='$name';parent.hideSearch();\">$name</a></li>";
    }
    echo "</ul>";
  }
}
?>

<br />
    <center>
      <table cellpadding="0" cellspacing="0">
        <tr>
          <td>
            <form action="?" method="GET">
              Search player names:<br />
              <input type="text" size="30" name="name"><br /><br />
              <center><input type="submit" value="Search"></center>
            </form>
          </td>
        </tr>
      </table>
    </center>
  </body>
</html>