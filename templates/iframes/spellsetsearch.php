<html>
<body bgcolor="#FFCCCC">
<?php

if(isset($_GET['name']) && ($_GET['name'] != '')) {
  require("../../config.php");
  require("../../classes/mysqli.php");

  $name = $_GET['name'];
  $query = "SELECT id, name FROM npc_spells WHERE name RLIKE \"$name\" ORDER BY id";
  $results = $mysql_content_db->query_mult_assoc($query);
  if($results == '') {
    print "No spellsets found!<br>";
  }
  else {
    foreach($results as $result) {
      extract($result);
      print "<a href=\"javascript:parent.document.getElementById('id').value=$id;parent.hideSearch()\">$id: $name</a><br>";
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
        Search spellset names:<br>
        <input type='text' size='30' name='name'><br><br>
        <center><input type='submit' value='Search'></center>
      </form>
    </td>
  </tr>
</table>
</center>
</body>
</html>