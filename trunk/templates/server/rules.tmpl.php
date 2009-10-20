      <div class="table_container" style="width: 500px;">
      <div class="table_header">
        <table width="100%" cellpadding="0" cellspacing="0">
          <tr>
           <td>Server Rules</td>
           <td align="right">    
          <a href="index.php?editor=server&action=19"><img src="images/add.gif" border="0" title="Add a rule"></a>
            </td>
           </tr>        
         </table>
      </div>

       <table class="table_content2" width="100%">
<? if (isset($rules)):?>
         <tr>
          <td align="center" width="5%"><strong>Ruleset</strong></td>
          <td align="center" width="20%"><strong>Name</strong></td>
          <td align="center" width="15%"><strong>Value</strong></td>
          <th width="5%"></th>
         </tr>
<?$x=0; foreach($rules as $rules=>$v):?>
        <tr bgcolor="#<? echo ($x % 2 == 0) ? "AAAAAA" : "BBBBBB";?>">
          <td align="center" width="5%"><a href="index.php?editor=server&ruleset_id=<?=$v['ruleset_id']?>&action=22"><?=$v['ruleset_id']?></td>
          <td align="center" width="15%"><?=$v['rule_name']?></td>
          <td align="center" width="15%"><?=$v['rule_value']?></td>  
          <td align="right">      
            <a href="index.php?editor=server&rule_name=<?=$v['rule_name']?>&action=17"><img src="images/edit2.gif" border="0" title="Edit Rule"></a>          
            <a onClick="return confirm('Really Delete this Rule?');" href="index.php?editor=server&rule_name=<?=$v['rule_name']?>&action=21"><img src="images/remove3.gif" border="0" title="Delete this rule"></a>
          </td>
        </tr>
        <?$x++; endforeach;?>
        </table>
        <?endif;?>