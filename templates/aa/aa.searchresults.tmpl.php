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
  <div class="table_container" style="width:350px;">
    <div class="table_header">AA Search Results for Spell Effect: <?=$spa_name?> (<?=$spa_id?>)</div>
<?if($results):?>
    <table class="table_content2" width="100%">
      <tr>
        <th align="center">ID</th>
        <th align="center">Name</th>
      </tr>
<? $x=0; foreach($results as $k=>$v):?>
      <tr bgcolor="#<? echo ($x % 2 == 0) ? "CCCCCC" : "AAAAAA"; $x++;?>">
        <td align="center"><a href="index.php?editor=aa&aaid=<?=$v?>"><?=$v?></a></td>
        <td align="center"><a href="index.php?editor=aa&aaid=<?=$v?>"><?echo getAAName($v);?></a></td>
      </tr>
<?endforeach;?>
    </table>
<?endif;?>
<?if($results == ''):?>
    <div class="table_content">Your search produced no results!</div>
<?endif;?>
  </div>
