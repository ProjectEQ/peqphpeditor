  <form name="purge" method="post" action="index.php?editor=util&action=2">
    <div class="table_container" style="width: 500px;">
      <div class="table_header">
        <table width="100%" cellpadding="0" cellspacing="0">
          <tr>
            <td align="left">Character Purge - Not logged in since <?=get_real_time(time() - $datetime)?></td>
            <td align="right">Limited to <?=$purge_count;?></td>
          </tr>
        </table>
      </div>
      <table class="table_content2" width="100%">
<?if (isset($characters)):?>
        <tr>
          <td align="center" width="5%"><strong>ID</strong></td>
          <td align="center" width="15%"><strong>Character</strong></td>
          <td align="center" width="15%"><strong>Account</strong></td>
          <td align="center" width="15%"><strong>Last Login</strong></td>
          <td align="right" width="5%"><input type="checkbox" id="all" onChange="toggle_all();" /></td>
        </tr>
<?$x=0; foreach($characters as $character=>$v):?>
        <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
          <td align="center" width="5%"><?=$v['id']?></td>
          <td align="center" width="15%"><a href="index.php?editor=player&playerid=<?=$v['id']?>"><?echo getPlayerName($v['id'])?></a></td>
          <td align="center" width="15%"><a href="index.php?editor=account&acctid=<?=$v['account_id']?>"><?echo getAccountName($v['account_id'])?></a></td>
          <td align="center" width="15%"><?echo ($v['last_login'] > 0) ? get_real_time($v['last_login']) : "Never";?></td>
          <td align="right"><input type="checkbox" name="id[]" value="<?=$v['id']?>" /></td>
        </tr>
<?$x++; endforeach;?>
<?endif;?>
<?if (!isset($characters)):?>
        <tr>
          <td align="left" width="100" style="padding: 10px;">No old characters</td>
        </tr>
<?endif;?>
      </table>
    </div><br />
<?if (isset($characters)):?>
    <center>
      <input type="button" name="delete" value="Delete Marked" onClick="verify();" />&nbsp;<input type="button" name="delete" value="Delete All" onClick="mark_all();verify();" />
    </center>
<?endif;?>
  </form>
