<html>
<head>
<style>
.table_content {
  padding: 10px;
  color: #000;
  font-size: 10px;
  background-color: #CCC;
}

table {
  border-collapse: collapse;
}

body, html {
  margin: 0;
  padding: 0;
  font-family: Verdana,Arial,Helvetica,sans-serif;
  background: #FFCCCC;
}

span {
  font-size: 12px;
}


</style>
</head>
<body>
<?php


function getClasses($classes, $berserker) {
  if ($berserker == 0 && $classes == 0) {
    return "None";
  }
  if ($berserker == 1 && $classes == 65534) 
    return "ALL";
  else {
    $res = '';
    if ($berserker == 1)  $res .= "BER ";
    if ($classes &   256) $res .= "BRD ";
    if ($classes & 32768) $res .= "BST ";
    if ($classes &     4) $res .= "CLR ";
    if ($classes &    64) $res .= "DRU ";
    if ($classes & 16384) $res .= "ENC ";
    if ($classes &  8192) $res .= "MAG ";
    if ($classes &   128) $res .= "MNK ";
    if ($classes &  2048) $res .= "NEC ";
    if ($classes &     8) $res .= "PAL ";
    if ($classes &    16) $res .= "RNG ";
    if ($classes &   512) $res .= "ROG ";
    if ($classes &    32) $res .= "SHD ";
    if ($classes &  1024) $res .= "SHM ";
    if ($classes &     2) $res .= "WAR ";
    if ($classes &  4096) $res .= "WIZ ";
    $res = rtrim($res, " ");
    return $res;
  }
}
function getExpansionName($expid) {
  global $eqexpansions;
  if (!isset($expid)) return "";
  if ($expid < 0) return "$expid"; // Avoid hitting the 'None Selected'
  if (isset($eqexpansions[$expid+1])) return $eqexpansions[$expid+1];
  return "$expid";
}


if(isset($_GET['search']) && ($_GET['search'] != '')) {
  require("../../config.php");
  require("../../classes/mysqli.php");
  require("../../lib/data.php");
  $name = $_GET['search'];
  
  // Figure out what we're looking for.
  // Options are:
  // - Just digits: We take this to mean an ID. Exact match required.
  // - (int)'-'(int): This is an inclusive AA range.
  //   treated as between low and high for id matching.
  // - Everything else: Treat it like a string to run against the name
  
  $resrange = preg_match_all("/^\s*(\d+)-(\d+)\s*$/", $name, $vars_range, PREG_SET_ORDER);
  $resid = preg_match_all("/^\s*(\d+)\s*$/", $name, $vars_id, PREG_SET_ORDER);
  $respre = preg_match_all("/^\s*prereq:\s*(\d+)\s*$/", $name, $vars_pre, PREG_SET_ORDER);
  
  //$res = preg_match_all("/(?|\s*(\d+)-(\d+)\s*|\s*(\d+)\s*)/", $name, $vars, PREG_SET_ORDER);
  
  $query = '';
  if ($resrange) {
    $low = $vars_range[0][1];
    $high = $vars_range[0][2];
    if ($low > $high) {
      $t = $low;
      $low = $high;
      $high = $t;
    }
    $query = "SELECT skill_id, name, prereq_skill, classes, berserker, aa_expansion, max_level, class_type FROM altadv_vars WHERE skill_id BETWEEN $low AND $high ORDER BY skill_id";
  }
  
  if ($resid) {
    $id = $vars_id[0][1];
    $query = "SELECT skill_id, name, prereq_skill, classes, berserker, aa_expansion, max_level, class_type FROM altadv_vars WHERE skill_id=$id ORDER BY skill_id";
  }
  
  if ($respre) {
    $id = $vars_pre[0][1];
    $query = "SELECT skill_id, name, prereq_skill, classes, berserker, aa_expansion, max_level, class_type FROM altadv_vars WHERE prereq_skill=$id ORDER BY skill_id";
  }
  
  if (!$resid && !$resrange && !$respre) {
    $query = "SELECT skill_id, name, prereq_skill, classes, berserker, aa_expansion, max_level, class_type FROM altadv_vars WHERE name rlike \"$name\" ORDER BY skill_id";
  }
  
  $results = $mysql_content_db->query_mult_assoc($query);
  
  if($results == '') {
    print "No abilities found!<br>";
  }
  else {
?>
          <table class="table_content">
            <tr>
              <th width="7%" align="center">ID</th>
              <th width="7%" align="center">Seq</th>
              <th width="25%" align="center">Name</th>
              <th width="4%" align="center">Lvl</th>
              <th width="4%" align="center">Rks</th>
              <th width="7%" align="center">Prereq</th>
              <th width="25%" align="center">Classes</th>
              <th width="20%" align="center">Expansion</th>
            </tr>
            <? $x=0; foreach($results as $result): extract($result);?>
            <tr bgcolor="#<? echo ($x % 2 == 0) ? "CCCCCC" : "AAAAAA"; $x++;?>">
              <td align="center"><?=$skill_id?></td>
              <td></td>
              <td><a href="javascript:parent.document.getElementById('searchtarget').value=<?=$skill_id?>;parent.hideSearch()" title="Click to copy to What field below"><?=$name?></a></td>
              <td align="center"><?=$class_type?></td>
              <td align="center"><?=$max_level?></td>
              <td align="center"><?=$prereq_skill?></td>
              <td><?=getClasses($classes, $berserker);?></td>
              <td align="center"><?=getExpansionName($aa_expansion);?></td>
            </tr>
            <?endforeach;?>
          </table>

<?
  }
}
?>

<br>
<center>
<table>
  <tr>
    <td>
      <form action='?' method='GET'>
        <span>Search by ID, Name, ID range or Prereq (Use 'prereq:id'):</span><br>
        <center><input type='text' size='30' name='search' title=""><br><br></center>
        <center><input type='submit' value='Search'></center>
      </form>
    </td>
  </tr>
</table>
</center>
</body>
</html>