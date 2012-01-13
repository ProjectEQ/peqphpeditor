  <center>
    <iframe id="searchframe" src="templates/iframes/playersearch.php" style="display:none;"></iframe>
    <input id="button" type="button" value="Hide Search" onclick="javascript:hideSearch();" style="display:none;" />
  </center>
  <div class="edit_form" style="margin-bottom: 15px;">
    <div class="edit_form_header">
      <table width="100%">
        <tr>
          <td>
            Edit Message
          </td>
        </tr>
      </table>
    </div>
    <div class="edit_form_content">
      <form name="mail_edit" method="post" action="index.php?editor=mail&action=6">
        <table width="100%" cellspacing="0">
          <tr>
            <td>
              From:<br/>
              <input type="text" name="from_text" value="<?=$message['from']?>" />
            </td>
            <td>
              To: <a href="javascript:showSearch();">Select Player</a><br/>
              <input type="text" id="to_text" name="to_text" value="<?=getPlayerName($message['charid'])?>" readonly="true" />
            </td>
            <td>
              Status:<br/>
              <select name="status">
<?php foreach ($msg_status as $k=>$v):?>
                <option value="<?=$k?>"<?if ($k == $message['status']) echo " selected";?>><?=$v?></option>
<?php endforeach;?>
              </select>
            </td>
          </tr>
          <tr>
            <td colspan="3">
              Subject:<br/>
              <input type="text" size="118" name="subject" value="<?=$message['subject']?>"/>
            </td>
          </tr>
          <tr>
            <td colspan="3">
              Message:<br/>
              <textarea cols="89" rows="8" name="body"><?=$message['body']?></textarea>
            </td>
          </tr>
        </table><br/><br/>
        <input type="hidden" name="msg_id" value="<?=$message['msgid']?>"/>
        <center><input type="submit" value="Update Message"/></center>
      </form>
    </div>
  </div>
