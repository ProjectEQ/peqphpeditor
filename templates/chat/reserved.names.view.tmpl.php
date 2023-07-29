  <div class="table_container" style="width: 500px;">
    <div class="table_header">
      <table style="width:100%; padding:0px; border-spacing:0px;">
        <tr>
          <td align="right"><a href="index.php?editor=chat&action=7"><img src="images/add.gif" title="Add Reserved Name"></a></td>
        </tr>
      </table>
    </div>
    <table class="table_content2" style="width:100%;">
<?if (isset($reserved_names)):?>
      <tr>
        <td align="center" width="25%"><strong>ID</strong></td>
        <td align="center" width="65%"><strong>Name</strong></td>
        <td width="10%">&nbsp;</td>
      </tr>
<?$x=0;
foreach($reserved_names as $reserved_name):?>
      <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
        <td align="center" width="25%"><?=$reserved_name['id']?></td>
        <td align="center" width="65%"><?=$reserved_name['name']?></td>
        <td align="right" width="10%">
          <a href="index.php?editor=chat&id=<?=$reserved_name['id']?>&action=9"><img src="images/edit2.gif" width="13" height="13" border="0" title="Edit Reserved Name"></a>&nbsp;
          <a href="index.php?editor=chat&id=<?=$reserved_name['id']?>&action=11" onClick="return confirm('Really delete reserved name?');"><img src="images/remove.gif" width="13" height="13" border="0" title="Delete Reserved Name"></a>
        </td>
      </tr>
<?$x++;
endforeach;
else:?>
      <tr>
        <td align="left" width="100%" style="padding: 10px;">No Reserved Names</td>
      </tr>
<?endif;?>
    </table>
  </div>
