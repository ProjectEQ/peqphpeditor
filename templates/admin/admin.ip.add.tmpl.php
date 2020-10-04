      <center>
        <br><br><br>
        <h1><a href="index.php?admin">Admin Editor</a> >> GM IPs</h1>
        <br><br>
      </center>
      <div id="searchblock" style="display:none;">
        <center>
          <iframe src="templates/iframes/accountsearch.php" style="display:block;"></iframe>
          <input type="button" value="Hide Search" onclick="hideSearch();">
        </center><br>
      </div>
      <form name="gm_ip" method="post" action="index.php?admin&action=7">
        <div class="edit_form" style="width:210px;">
          <div class="edit_form_header">Add IP</div>
          <div class="edit_form_content">
            <table width="100%" cellpadding="3" cellspacing="3">
              <tr>
                <td>
                  <strong>Name</strong><br>
                  <input type="text" name="name" size="25" value="">
                </td>
              </tr>
              <tr>
                <td>
                  <strong>Account</strong><br>
                  <input type="text" name="account_id" size="25" value="" readonly="true" id="to_text" onClick="showSearch();">
                </td>
              </tr>
              <tr>
                <td>
                  <strong>IP Address</strong><br>
                  <input type="text" name="ip_address" id="ip" size="25" value="">
                </td>
              </tr>
            </table><br><br>
            <center>
              <input type="button" value="Add IP" onClick="validateIP();">&nbsp;&nbsp;
              <input type="button" value="Cancel" onClick="history.back();">
            </center>
          </div>
        </div>
      </form>
