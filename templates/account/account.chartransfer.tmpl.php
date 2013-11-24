<?
  $from_acct = getAccountName($acctid);
?>
  <div id="searchblock" style="display:none;">
    <center>
      <iframe src="templates/iframes/accountsearch.php" style="display:block;"></iframe>
      <input type="button" value="Hide Search" onclick="hideSearch();">
    </center><br/>
  </div>
  <div class="table_container" style="width:250px;">
    <div class="table_header">
      Character Transfer
    </div>
    <div class="table_content">
      <form id="transfer" method="post" action="index.php?editor=account&acctid=<?=$acctid?>&playerid=<?=$_GET['playerid']?>&action=6">
        <center>
          Transfer <strong><font color="green"><?=getPlayerName($_GET['playerid'])?></font></strong> from<br/><br/>
          <strong><?=$from_acct?></strong><br/><br/>
          to<br/><br/>
          <input type="text" size="20" value="Select account" readonly="true" id="to_text" name="tacct" onClick="showSearch();">
          <input type="hidden" id="from_acct" value="<?=$from_acct?>">
          <div id="submitblock" style="display:none;">
            <br/><br/><input type="button" value="GO" onClick="validateTransfer();">&nbsp;<input type="button" onClick="history.go(-2);" value="Cancel">
          </div>
        </center>
      </form>
    </div>
  </div>
