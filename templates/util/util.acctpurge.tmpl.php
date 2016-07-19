  <form name="purge" method="post" action="index.php?editor=util&action=4">
    <div class="table_container" style="width: 300px;">
      <div class="table_header">
        <table width="100%" cellpadding="0" cellspacing="0">
          <tr>
            <td align="left">Account Purge - Empty Accounts</td>
            <td align="right">Limited to <?=$purge_count;?>
          </tr>
        </table>
      </div>
      <table class="table_content2" width="100%">
<?if (isset($accounts)):?>
        <tr>
          <td align="center" width="5%"><strong>ID</strong></td>
          <td align="center" width="15%"><strong>Account</strong></td>
          <td align="right" width="5%"><input type="checkbox" id="all" onChange="toggle_all();" /></td>
        </tr>
<?$x=0; foreach($accounts as $account=>$v):?>
        <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
          <td align="center" width="5%"><?=$v['id']?></td>
          <td align="center" width="15%"><?=getAccountName($v['id'])?></td>
          <td align="right"><input type="checkbox" name="id[]" value="<?=$v['id']?>" /></td>
        </tr>
<?$x++; endforeach;?>
<?endif;?>
<?if (!isset($accounts)):?>
        <tr>
          <td align="left" width="100" style="padding: 10px;">No empty accounts</td>
        </tr>
<?endif;?>
      </table>
    </div><br />
<?if (isset($accounts)):?>
    <center>
      <input type="button" name="delete" value="Delete Marked" onClick="verify();" />&nbsp;<input type="button" name="delete" value="Delete All" onClick="mark_all();verify();" />
    </center>
<?endif;?>
  </form>
