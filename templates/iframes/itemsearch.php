<html>
<body bgcolor="#FFCCCC">
<?php

if(isset($_GET['name']) && ($_GET['name'] != '')) {
  require("../../config.php");
  require("../../classes/mysql.php");
  $name = $_GET['name'];
  $query = "SELECT id, name, lore FROM items WHERE name rlike \"$name\" ORDER BY id";
  $results = $mysql->query_mult_assoc($query);
  if($results == '') {
    print "No items found!<br>";
  }
  else {
    echo "<ul>";
    foreach($results as $result) {
      extract($result);
      print "<li><a href=\"javascript:parent.document.getElementById('id').value=$id;parent.hideSearch('search')\">$id: $name ($lore)</a></li>";
    }
    echo "</ul>";
  }
}
?>

<br>
<center>
<table>
  <tr>
    <td>
      <form action='?' method='GET'>
        Search item names:<br>
        <input type='text' size='30' name='name'><br><br>
        <center><input type='submit' value='Search'></center>
      </form>
    </td>
  </tr>
</table>
</center>
</body>
</html>