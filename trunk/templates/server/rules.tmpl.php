        <div class="table_container" style="width: 500px;">
          <div class="table_header">
            <table width="100%" cellpadding="0" cellspacing="0">
              <tr>
                <td>Server Rules</td>
                <td align="right"><a href="index.php?editor=server&action=27">Switch ruleset</a>&nbsp;<a href="index.php?editor=server&ruleset_id=<?=$ruleset_id?>&action=19"><img src="images/add.gif" border="0" title="Add a rule"></a></td>
              </tr>
            </table>
          </div>
          <table class="table_content2" width="100%">
<?if (isset($rules)):?>
            <tr>
              <td align="center" width="5%"><strong>Ruleset</strong></td>
              <td align="center" width="20%"><strong>Name</strong></td>
              <td align="center" width="15%"><strong>Value</strong></td>
              <td width="5%">&nbsp;</td>
            </tr>
<?$x=0; foreach($rules as $rules=>$v):?>
            <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
              <td align="center" width="5%"><?=$v['ruleset_id']?></td>
              <td align="center" width="20%"><?=$v['rule_name']?></td>
              <td align="center" width="15%"><?=$v['rule_value']?></td>
              <td align="right"><a href="index.php?editor=server&rule_name=<?=$v['rule_name']?>&ruleset_id=<?=$v['ruleset_id']?>&action=17"><img src="images/edit2.gif" border="0" title="Edit Rule"></a>&nbsp;<a onClick="return confirm('Really Delete this Rule?');" href="index.php?editor=server&rule_name=<?=$v['rule_name']?>&ruleset_id=<?=$v['ruleset_id']?>&action=21"><img src="images/remove3.gif" border="0" title="Delete this rule"></a></td>
            </tr>
<?$x++; endforeach;?>
<?endif;?>
<?if (!isset($rules)):?>
            <tr>
              <td align="left" width="100" style="padding: 10px;">No rules</td>
            </tr>
<?endif;?>
          </table>
        </div>
