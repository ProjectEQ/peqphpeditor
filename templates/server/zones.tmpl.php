        <div class="table_container" style="width: 200px;">
          <div class="table_header">
            <table width="100%" cellpadding="0" cellspacing="0">
              <tr>
                <td>Launchers</td>
                <td align="right"><a href="index.php?editor=server&action=41"><img src="images/add.gif" border="0" title="Add a launcher"></a></td>
              </tr>
            </table>
          </div>
          <table class="table_content2" width="100%">
<?if (isset($launchers)):?>
            <tr>
              <td align="center" width="10%"><strong>name</strong></td>
              <td align="center" width="4%"><strong>number</strong></td>
              <td width="5%">&nbsp;</td>
            </tr>
<?$x=0; foreach($launchers as $launchers=>$v):?>
            <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
              <td align="center" width="10%"><?=$v['name']?></td>
              <td align="center" width="4%"><?=$v['dynamics']?></td>
              <td align="right"><a href="index.php?editor=server&name=<?=$v['name']?>&action=38"><img src="images/edit2.gif" border="0" title="Edit launcher"></a>&nbsp;<a onClick="return confirm('Really delete <?=$v['name']?>?');" href="index.php?editor=server&name=<?=$v['name']?>&action=40"><img src="images/remove3.gif" border="0" title="Delete this launcher"></a></td>
            </tr>
<?$x++; endforeach;?>
<?endif;?>
<?if (!isset($launchers)):?>
            <tr>
              <td align="left" width="100" style="padding: 10px;">No launchers</td>
            </tr>
<?endif;?>
          </table>
        </div><br><br>
        <div class="table_container" style="width: 300px;">
          <div class="table_header">
            <table width="100%" cellpadding="0" cellspacing="0">
              <tr>
                <td>Zones</td>
                <td align="right"><a href="index.php?editor=server&action=36"><img src="images/add.gif" border="0" title="Add a zone"></a></td>
              </tr>
            </table>
          </div>
          <table class="table_content2" width="100%">
<?if (isset($zones)):?>
            <tr>
              <td align="center" width="5%"><strong>Launcher</strong></td>
              <td align="center" width="10%"><strong>Zone</strong></td>
              <td align="center" width="10%"><strong>Port</strong></td>
              <td width="5%">&nbsp;</td>
            </tr>
<?$x=0; foreach($zones as $zones=>$v):?>
            <tr bgcolor="#<? echo ($x % 2 == 0) ? "AAAAAA" : "BBBBBB";?>">
              <td align="center" width="5%"><?=$v['launcher']?></td>
              <td align="center" width="10%"><?=$v['zone']?></td>
              <td align="center" width="10%"><?=$v['port']?></td>
              <td align="right"><a href="index.php?editor=server&launcher=<?=$v['launcher']?>&zone=<?=$v['zone']?>&action=33"><img src="images/edit2.gif" border="0" title="Edit Zone"></a>&nbsp;<a onClick="return confirm('Really delete <?=$v['zone']?>?');" href="index.php?editor=server&launcher=<?=$v['launcher']?>&zone=<?=$v['zone']?>&action=35"><img src="images/remove3.gif" border="0" title="Delete this zone"></a></td>
            </tr>
<?$x++; endforeach;?>
<?endif;?>
<?if (!isset($zones)):?>
            <tr>
              <td align="left" width="100" style="padding: 10px;">No static zones</td>
            </tr>
<?endif;?>
          </table>
        </div>
