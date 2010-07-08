        <div class="table_container" style="width: 200px;">
          <div class="table_header">
            <table width="100%" cellpadding="0" cellspacing="0">
              <tr>
                <td>Select Ruleset</td>
                <td align="right"><a href="index.php?editor=server&action=30"><img src="images/add.gif" border="0" title="Add a Ruleset"></a></td>
              </tr>
            </table>
          </div>
          <table class="table_content2" width="100%">
<?if (isset($ruleset)):?>
            <tr>
              <td align="center" width="5%"><strong>id</strong></td>
              <td align="center" width="5%"><strong>name</strong></td>
              <td width="5%">&nbsp;</td>
            </tr>
<?$x=0; foreach($ruleset as $ruleset=>$v):?>
            <tr bgcolor="#<? echo ($x % 2 == 0) ? "AAAAAA" : "BBBBBB";?>">
              <td align="center" width="5%"><?=$v['ruleset_id']?></td>
              <td align="center" width="5%"><a href="index.php?editor=server&ruleset_id=<?=$v['ruleset_id']?>&action=28"><?=$v['name']?></td>
              <td align="right">
                <a href="index.php?editor=server&ruleset_id=<?=$v['ruleset_id']?>&action=22"><img src="images/edit2.gif" border="0" title="Edit Ruleset"></a>
                <a href="index.php?editor=server&name=<?=$v['name']?>&action=25"><img src="images/last.gif" border="0" title="Copy this ruleset"></a>
                <a onClick="return confirm('WARNING: This will delete ruleset <?=$v['ruleset_id']?> and all associated rules! Do you wish to continue?');" href="index.php?editor=server&ruleset_id=<?=$v['ruleset_id']?>&action=29"><img src="images/remove3.gif" border="0" title="Delete ruleset and all assoicated rules"></a>
              </td>
            </tr>
<?$x++; endforeach;?>
<?endif;?>
<?if (!isset($ruleset)):?>
            <tr>
              <td align="left" width="100" style="padding: 10px;">No rulesets</td>
            </tr>
<?endif;?>
          </table>
        </div>
