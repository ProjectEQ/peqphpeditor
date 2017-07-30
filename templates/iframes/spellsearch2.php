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
  $query = "SELECT id, name FROM spells_new WHERE name rlike \"$name\" ORDER BY id";
  $results = $mysql->query_mult_assoc($query);
  if($results == '') {
    print "No spells found!<br>";
  }
  else {
    foreach($results as $result) {
      extract($result);
      print "<a href=\"javascript:parent.document.getElementById('type').value=$id;parent.hideSearch()\">$id: $name</a><br>";
    }
  }
  echo "<br>";
}
?>

<br>
<center>
<table>
  <tr>
    <td>
      <form action='?' method='GET'>
        Search spell names:<br>
        <input type='text' size='30' name='name'><br><br>
        <center><input type='submit' value='Search'></center>
      </form>
    </td>
  </tr>
</table>
</center>
</body>
</html>