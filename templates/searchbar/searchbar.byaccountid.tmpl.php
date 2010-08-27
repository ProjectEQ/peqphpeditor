      <div id="searchbar">
        <table width=100%>
          <tr>
            <td>
              <strong>1.</strong>
              <select OnChange="gotosite(this.options[this.selectedIndex].value)">
                <option value="">Select an Account</option>
<?php foreach ($accounts as $account): extract($account);?>
                <option value="index.php?editor=<?=$curreditor?>&acctid=<?=$account['id']?>"<?php if ($curraccount == $account['id']): ?> selected<?php endif;?>><?=$account['name']?></option>
<?php endforeach;?>
              </select>
            </td>
            <td align="right"> or <strong>&nbsp;2.</strong>
              <form action="index.php" method="GET">
                <input type="hidden" name="editor" value="account">
                <input type="hidden" name="action" value="2">
                <input type="text" name="acctid" size="5" value="ID" onFocus="clearField(document.forms[0].acctid);"> or <input type="text" name="search" size="12" value="Account Name" onFocus="clearField(document.forms[0].search);">
                <input type="submit" value=" GO ">
              </form>
            </td>
          </tr>
        </table>
      </div>
