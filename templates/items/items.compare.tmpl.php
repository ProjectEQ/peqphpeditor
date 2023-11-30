  <div class="table_container" style="width: 250px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td>&nbsp;</td>
          <td align="right">&nbsp;</td>
        </tr>
      </table>
    </div>
    <table class="table_content2" width="100%">
<?if (isset($columns)):?>
<?
    $x=0;
    foreach($columns as $column):
?>
      <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
        <td><a href="index.php?editor=items&column=<?=$column?>&action=18"><?=$column?></a></td>
      </tr>
<?
    $x++;
    endforeach;
?>
<?else:?>
      <tr>
        <td>No items to review</td>
      </tr>
<?endif;?>
    </table>
  </div>
