        <div class="table_container" style="width: 650px;">
          <div class="table_header">
            <table width="100%" cellpadding="0" cellspacing="0">
              <tr>
                <td>Banned IPs</td>
		  <td align="right"><a href="index.php?editor=server&action=51"><img src="images/add.gif" border="0" title="Add a Spanking"></a></td>
              </tr>
            </table>
          </div>
          <table class="table_content2" width="100%">
<?if (isset($banned)) :?>
            <tr>
              <td align="center" width="15%"><strong>IP</strong></td>
              <td align="center" width="70%"><strong>Notes</strong></td>
              <td width="5%">&nbsp;</td>
            </tr>
<?$x=0; foreach($banned as $banned=>$v):?>
            <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
              <td align="center" width="15%"><?=$v['ip_address']?></td>
              <td align="center" width="70%"><?=$v['notes']?></td>  
              <td align="right"><a href="index.php?editor=server&ip=<?=$v['ip_address']?>&action=53"><img src="images/edit2.gif" border="0" title="Change Note"></a>&nbsp;<a onClick="return confirm('Really Delete Entry <?=$v['ip_address']?>?');" href="index.php?editor=server&ip=<?=$v['ip_address']?>&action=54"><img src="images/remove3.gif" border="0" title="Delete this entry"></a></td>
            </tr>
<?$x++; endforeach;?>
<?endif;?>
<?if (!isset($banned)):?>
            <tr>
              <td align="left" width="100" style="padding: 10px;">No Banned IPs</td>
            </tr>
<?endif;?>
          </table>
        </div>
