<?
  function getExpansionName($expid) {
    global $eqexpansions;
    if (!isset($expid)) return "";
    if ($expid < 0) return "$expid"; // Avoid hitting the 'None Selected'
    if (isset($eqexpansions[$expid+1])) return $eqexpansions[$expid+1];
    return "$expid";
  }

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
?>
  <div class="table_container" style="width:650px;">
    <div class="table_header">AA Search Results</div>
<?if($results):?>
    <table class="table_content2" width="100%">
      <tr>
        <th width="7%" align="center">ID</th>
        <th width="7%" align="center">Seq</th>
        <th width="25%" align="center">Name</th>
        <th width="7%" align="center">Prereq</th>
        <th width="25%" align="center">Classes</th>
        <th width="20%" align="center">Expansion</th>
      </tr>
<? $x=0; foreach($results as $result): extract($result);?>
      <tr bgcolor="#<? echo ($x % 2 == 0) ? "CCCCCC" : "AAAAAA"; $x++;?>">
        <td align="center"><?=$skill_id?></td>
        <td align="center"></td>
        <td align="center"><a href="index.php?editor=aa&aaid=<?=$skill_id?>"><?=$name?></a></td>
        <td align="center"><?=$prereq_skill?></td>
        <td align="center"><?=getClasses($classes, $berserker);?></td>
        <td align="center"><?=getExpansionName($aa_expansion);?></td>
      </tr>
<?endforeach;?>
    </table>
<?endif;?>
<?if($results == ''):?>
    <div class="table_content">Your search produced no results!</div>
<?endif;?>
  </div>
