<?
  function getExpansionName($expid) {
    global $eqexpansions;
    if (!isset($expid)) return "";
    if ($expid < 0) return "$expid"; // Avoid hitting the 'None Selected'
    if (isset($eqexpansions[$expid+1])) return $eqexpansions[$expid+1];
    return "$expid";
  }

?>
<?if (isset($_GET['action']) && $_GET['action'] == 2):?> 
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

<?elseif (isset($_GET['action']) && $_GET['action'] == 1):?>
  <div class="table_container" style="width:650px;">
    <div class="table_header">AA Search Results</div>
<?if($results != ''):?>
    <table class="table_content2" width="100%">
      <tr>
        <th width="7%" align="center">ID</th>
        <th width="25%" align="center">Name</th>
        <th width="25%" align="center">Classes</th>
		<th width="25%" align="center">Deities</th>
      </tr>
<? $x=0; foreach($results as $result): extract($result);?>
      <tr bgcolor="#<? echo ($x % 2 == 0) ? "CCCCCC" : "AAAAAA"; $x++;?>">
        <td align="center"><?=$id?></td>
        <td align="center"><a href="index.php?editor=aa&aaid=<?=$id?>"><?=$name?></a></td>
        <td align="center"><?=getClasses($classes);?></td>
		<td align="center"><?=getDeities($deities);?></td>
      </tr>
<?endforeach;?>
    </table>
<?endif;?>
<?if($results == ''):?>
    <div class="table_content">Your search produced no results!</div>
<?endif;?>
  </div>
<?endif?>
