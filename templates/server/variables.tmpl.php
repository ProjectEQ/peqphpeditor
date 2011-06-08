        <div class="table_container" style="width: 500px;">
          <div class="table_header">
            <table width="100%" cellpadding="0" cellspacing="0">
              <tr>
                <td>Server Variables</td>
                <td align="right"><a href="index.php?editor=server&action=46"><img src="images/add.gif" border="0" title="Add a variable"></a></td>
              </tr>
            </table>
          </div>
          <table class="table_content2" width="100%">
<?if (isset($variables)):?>
            <tr>
              <td align="center" width="20%"><strong>Name</strong></td>
              <td align="center" width="15%"><strong>Value</strong></td>
              <td width="5%">&nbsp;</td>
            </tr>
<?$x=0; foreach($variables as $variables=>$v):?>
            <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
              <td align="center" width="20%"><?=$v['varname']?></td>
              <td align="center" width="15%"><?=$v['value']?></td>
              <td align="right"><a href="index.php?editor=server&varname=<?=$v['varname']?>&action=44"><img src="images/edit2.gif" border="0" title="Edit Variable"></a>&nbsp;<a onClick="return confirm('Really Delete this Variable?');" href="index.php?editor=server&varname=<?=$v['varname']?>&action=48"><img src="images/remove3.gif" border="0" title="Delete this variable"></a></td>
            </tr>
<?$x++; endforeach;?>
<?endif;?>
<?if (!isset($variables)):?>
            <tr>
              <td align="left" width="100" style="padding: 10px;">No variables</td>
            </tr>
<?endif;?>
          </table>
        </div>
