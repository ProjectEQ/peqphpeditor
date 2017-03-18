<? if ($orphans): ?>
      <div class="error">
        <table width="100%">
          <tr>
            <td valign="middle" width="30px"><img src="images/caution.gif"></td>
            <td style="padding:0px 5px;">There are orphan rules in the database. <a href="index.php?editor=server&action=29">Click here to repair.</a></td>
          </tr>
        </table>
      </div>
<? endif; ?>
        <div class="table_container" style="width: 300px;">
          <div class="table_header">
            <table width="100%" cellpadding="0" cellspacing="0">
              <tr>
                <td>All Rulesets</td>
                <td align="right"><a href="index.php?editor=server&action=30"><img src="images/add.gif" border="0" title="Add a Ruleset"></a></td>
              </tr>
            </table>
          </div>
          <table class="table_content2" width="100%">
<?if (isset($rulesets)):?>
            <tr>
              <td align="center" width="5%"><strong>Ruleset ID</strong></td>
              <td align="center" width="5%"><strong>Ruleset Name</strong></td>
              <td width="5%">&nbsp;</td>
            </tr>
<?$x=0; foreach($rulesets as $ruleset):?>
            <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
              <td align="center" width="5%"><?=$ruleset['ruleset_id']?></td>
              <td align="center" width="5%"><?=$ruleset['name']?></td>
              <td align="right">
                <a href="index.php?editor=server&ruleset_id=<?=$ruleset['ruleset_id']?>&action=28"><img src="images/refresh.gif" title="Switch view to this Ruleset"></a>
                <a href="index.php?editor=server&ruleset_id=<?=$ruleset['ruleset_id']?>&action=22"><img src="images/edit2.gif" border="0" title="Edit Ruleset"></a>
                <a href="index.php?editor=server&ruleset_id=<?=$ruleset['ruleset_id']?>&action=25"><img src="images/movefile.gif" border="0" title="Copy this ruleset"></a>
                <a onClick="return confirm('WARNING: This will delete ruleset <?=$ruleset['ruleset_id']?> and all associated rules! Do you wish to continue?');" href="index.php?editor=server&ruleset_id=<?=$ruleset['ruleset_id']?>&action=24"><img src="images/remove3.gif" border="0" title="Delete ruleset"></a>
              </td>
            </tr>
<?$x++; endforeach;?>
<?endif;?>
<?if (!isset($rulesets)):?>
            <tr>
              <td align="left" width="100" style="padding: 10px;">No rulesets</td>
            </tr>
<?endif;?>
          </table>
        </div>
