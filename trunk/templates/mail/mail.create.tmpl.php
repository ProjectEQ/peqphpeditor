  <center>
    <iframe id="searchframe" src="templates/iframes/playersearch.php" style="display:none;"></iframe>
    <input id="button" type="button" value="Hide Search" onclick="javascript:hideSearch();" style="display:none;" />
  </center>
  <div class="edit_form" style="margin-bottom: 15px;">
    <div class="edit_form_header">
      <table width="100%">
        <tr>
          <td>
            Create a Message
          </td>
        </tr>
      </table>
    </div>
    <div class="edit_form_content">
      <form name="mail_create" method="post" action="index.php?editor=mail&action=5">
        <table width="100%" cellspacing="0">
          <tr>
            <td>
              From:<br/>
              <input type="text" name="from_text" value="" />
            </td>
            <td>
              To: <a href="javascript:showSearch();">Select Player</a><br/>
              <input type="text" id="to_text" name="to_text" value="" readonly="true" />
            </td>
          </tr>
          <tr>
            <td colspan="2">
              Subject:<br/>
              <input type="text" size="118" name="subject" value=""/>
            </td>
          </tr>
          <tr>
            <td colspan="2">
              Message:<br/>
              <textarea cols="89" rows="8" name="body"></textarea>
            </td>
          </tr>
        </table><br/><br/>
        <center><input type="submit" value="Send Message"/></center>
      </form>
    </div>
  </div>
