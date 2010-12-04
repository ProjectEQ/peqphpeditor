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
              <select name="from_select" onChange="clearField(document.forms[0].from_text);">
                <option value="">Select a Player</option>
<?php foreach ($players as $player): extract($player);?>
                <option value="<?=$player['id']?>"><?=$player['name']?></option>
<?php endforeach;?>
              </select>
              &nbsp;or &nbsp;<input type="text" name="from_text" value="" onFocus="clearField(document.forms[0].from_select);"/>
            </td>
            <td>
              To:<br/>
              <select name="to">
                <option value="">Select a Player</option>
<?php foreach ($players as $player): extract($player);?>
                <option value="<?=$player['id']?>"><?=$player['name']?></option>
<?php endforeach;?>
              </select>
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
