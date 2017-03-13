  <div class="table_container" style="width: 500px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td>Titles</td>
          <td>
            <div style="float:right">
              <a href="index.php?editor=titles&action=2"><img src="images/add.gif" border="0" title="Create a new title"></a>
            </div>
          </td>
        </tr>
      </table>
    </div>
    <table class="table_content2" width="100%">
<?if (isset($titles)):?>
      <tr>
        <td align="center" width="10%"><strong>ID</strong></td>
        <td align="center" width="40%"><strong>Prefix</strong></td>
        <td align="center" width="40%"><strong>Suffix</strong></td>
        <td width="10%">&nbsp;</td>
      </tr>
<?$x=0;
foreach($titles as $title):?>
      <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
        <td align="center" width="10%"><?=$title['id']?></td>
        <td align="center" width="40%"><?=$title['prefix']?></td>
        <td align="center" width="40%"><?=$title['suffix']?></td>
        <td align="right" width="10%"><a href="index.php?editor=titles&title_id=<?=$title['id']?>&action=1"><img src="images/view_tbl.png" width="13" height="13" border="0" title="View Title"></a>&nbsp;<a onClick="return confirm('Really delete title <?=$title['id']?>?');" href="index.php?editor=titles&title_id=<?=$title['id']?>&action=6"><img src="images/remove3.gif" border="0" title="Delete Title"></a></td>
      </tr>
<?$x++;
endforeach;
else:?>
      <tr>
        <td align="left" width="100" style="padding: 10px;">No titles</td>
      </tr>
<?endif;?>
    </table>
  </div>
