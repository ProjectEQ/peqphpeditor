      <div class="table_container" style="width:250px;">
        <div class="table_header">
          Character Transfer
        </div>
        <div class="table_content">
          <center>
            Transfer <strong><font color="red"><?=getPlayerName($_GET['playerid'])?></font></strong> from<br/><br/>
            <strong><?=getAccountName($acctid)?></strong><br/><br/>
            to<br/><br/>
            <select OnChange="gotosite(this.options[this.selectedIndex].value)">>
<?php foreach ($target_accounts as $target_account): extract($target_account);?>
              <option value="index.php?editor=account&acctid=<?=$acctid?>&tacct=<?=$target_account['id']?>&playerid=<?=$_GET['playerid']?>&action=6"<?php if ($acctid == $target_account['id']) echo ' selected';?>><?=$target_account['name']?></option>
<?php endforeach;?>
            </select>
          </center>
        </div>
      </div>
