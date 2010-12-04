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
              <select name="from_select" onChange="clearField(document.forms[0].from_text);">
                <option value="">Select a Player</option>
<?php foreach ($players as $player): extract($player);?>
                <option value="<?=$player['id']?>"<?if ($player['name'] == $message['from']) echo " selected";?>><?=$player['name']?></option>
<?php endforeach;?>
              </select>
              &nbsp;or &nbsp;<input type="text" name="from_text" value="<?if (getPlayerID($message['from']) == 0) echo $message['from'];?>" onFocus="clearField(document.forms[0].from_select);"/>
            </td>
            <td>
              To:<br/>
              <select name="to">
                <option value="">Select a Player</option>
<?php foreach ($players as $player): extract($player);?>
                <option value="<?=$player['id']?>"<?if ($player['id'] == $message['charid']) echo " selected";?>><?=$player['name']?></option>
<?php endforeach;?>
              </select>
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
