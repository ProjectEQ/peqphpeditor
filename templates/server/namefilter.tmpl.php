    <div class="table_container" style="width: 400px;">
      <div class="table_header">
        <table width="100%" cellpadding="0" cellspacing="0">
          <tr>
            <td align="left">Name Filter</td>
            <td align="right">
              <a href="index.php?editor=server&action=61"><img src="images/add.gif" border="0" title="Create New Name Filter" alt="Create New Name Filter"></a>
            </td>
          </tr>
        </table>
      </div>
      <table class="table_content2" width="100%">
<?if (isset($nfdata)):?>
        <tr>
          <td align="center"><strong>ID</strong></td>
          <td align="center"><strong>Name</strong></td>
          <td width="10%">&nbsp;</td>
        </tr>
<?$x=0;
foreach($nfdata as $nf):?>
        <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
          <td align="center"><?=$nf['id']?></td>
          <td align="center"><?=$nf['name']?></td>
          <td align="right"><a href="index.php?editor=server&id=<?=$nf['id']?>&action=59"><img src="images/edit2.gif" width="13" height="13" border="0" title="Edit Name Filter" alt="Edit"></a>&nbsp;<a onClick="return confirm('Really delete name filter?');" href="index.php?editor=server&id=<?=$nf['id']?>&action=63"><img src="images/remove3.gif" border="0" title="Delete Name Filter" alt="Delete"></a></td>
        </tr>
<?$x++;
endforeach;
else:?>
        <tr>
          <td align="left" width="100" style="padding: 10px;">No Name Filters</td>
        </tr>
<?endif;?>
      </table>
    </div>
