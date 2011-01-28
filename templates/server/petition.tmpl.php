        <div class="table_container" style="width: 650px;">
          <div class="table_header">
            <table width="100%" cellpadding="0" cellspacing="0">
              <tr>
                <td>Petitions</td>
                <td align="right">&nbsp;</td>
              </tr>
            </table>
          </div>
          <table class="table_content2" width="100%">
<?if (isset($petitions)) :?>
            <tr>
              <td align="center" width="5%"><strong>ID</strong></td>
              <td align="center" width="5%"><strong>Account</strong></td>
              <td align="center" width="5%"><strong>Name</strong></td>
              <td align="center" width="5%"><strong>Zone</strong></td>
              <td align="center" width="10%"><strong>Date</strong></td>
              <th width="5%"></th>
            </tr>
<?$x=0; foreach($petitions as $petitions=>$v):?>
            <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
              <td align="center" width="5%"><?=$v['dib']?> - <?=$v['petid']?></td>
              <td align="center" width="5%"><?=$v['accountname']?></td>
              <td align="center" width="5%"><?=$v['charname']?></td>
              <td align="center" width="5%"><?=getZoneName($v['zone'])?></td>
              <td align="center" width="10%"><? echo date("Y-m-d H:i:s", $v['senttime'])?></td>
              <td align="right"><a href="index.php?editor=server&dib=<?=$v['dib']?>&action=13"><img src="images/edit2.gif" border="0" title="View Petition"></a>&nbsp;<a onClick="return confirm('Really Delete Petition <?=$v['dib']?>?');" href="index.php?editor=server&dib=<?=$v['dib']?>&action=15"><img src="images/remove3.gif" border="0" title="Delete this petition"></a></td>
            </tr>
<?$x++; endforeach;?>
<?endif;?>
<?if (!isset($petitions)):?>
            <tr>
              <td align="left" width="100" style="padding: 10px;">No petitions</td>
            </tr>
<?endif;?>
          </table>
        </div>
