  <div class="table_container" style="width: 500px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td>Content Flags</td>
          <td align="right"><a href="index.php?editor=content&action=1"><img src="images/add.gif" title="Add Content Flag"></a></td>
        </tr>
      </table>
    </div>
    <table class="table_content2" width="100%">
<?if (isset($content_flags)):?>
      <tr>
        <td align="center" width="15%"><strong>ID</strong></td>
        <td align="center" width="50%"><strong>Flag Name</strong></td>
        <td align="center" width="20%"><strong>Enabled</strong></td>
        <td width="15%">&nbsp;</td>
      </tr>
<?$x=0;
foreach($content_flags as $flag):?>
      <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
        <td align="center" width="15%"><?=$flag['id']?></td>
        <td align="center" width="50%"><?=$flag['flag_name']?></td>
        <td align="center" width="20%"><?=$yesno[$flag['enabled']]?></td>
        <td align="right" width="15%">
          <a href="index.php?editor=content&id=<?=$flag['id']?>&action=3"><img src="images/edit2.gif" width="13" height="13" border="0" title="Edit Content Flag"></a>&nbsp;
          <a href="index.php?editor=content&id=<?=$flag['id']?>&action=5" onClick="return confirm('Really delete content flag?');"><img src="images/remove.gif" width="13" height="13" border="0" title="Delete Content Flag"></a>
        </td>
      </tr>
<?$x++;
endforeach;
else:?>
      <tr>
        <td align="left" width="100%" style="padding: 10px;">No Content Flags</td>
      </tr>
<?endif;?>
    </table>
  </div>
