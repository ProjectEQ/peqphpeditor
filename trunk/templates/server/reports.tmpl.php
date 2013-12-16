        <div class="table_container" style="width: 650px;">
          <div class="table_header">
            <table width="100%" cellpadding="0" cellspacing="0">
              <tr>
                <td>Reports</td>
                <td align="right">&nbsp;</td>
              </tr>
            </table>
          </div>
          <table class="table_content2" width="100%">
<?if (isset($reports)) :?>
            <tr>
              <td align="center" width="5%"><strong>ID</strong></td>
              <td align="center" width="15%"><strong>Name</strong></td>
              <td align="center" width="70%"><strong>Reported</strong></td>
              <td width="5%">&nbsp;</td>
            </tr>
<?$x=0; foreach($reports as $reports=>$v):?>
            <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
              <td align="center" width="5%"><?=$v['rid']?></td>
              <td align="center" width="15%"><?=$v['name']?></td>
              <td align="center" width="70%"><?=$v['reported']?></td>  
              <td align="right"><a href="index.php?editor=server&rid=<?=$v['rid']?>&action=11"><img src="images/edit2.gif" border="0" title="View Report"></a>&nbsp;<a onClick="return confirm('Really Delete Entry <?=$v['rid']?>?');" href="index.php?editor=server&rid=<?=$v['rid']?>&action=10"><img src="images/remove3.gif" border="0" title="Delete this entry"></a></td>
            </tr>
<?$x++; endforeach;?>
<?endif;?>
<?if (!isset($reports)):?>
            <tr>
              <td align="left" width="100" style="padding: 10px;">No reported players</td>
            </tr>
<?endif;?>
          </table>
        </div>
