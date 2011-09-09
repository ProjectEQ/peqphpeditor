  <div class="edit_form" style="width: 350px">
    <div class="edit_form_header">
      Add NPC
    </div>
    <div class="edit_form_content">
      <form name="alt_curr_npc" method="post" action="index.php?editor=altcur&action=9">
        <table width="100%" cellspacing="0">
          <tr>
            <td width="40%">
              NPC ID:<br/>
              <input type="text" name="npcid" value="<?=$npcid?>" size="10"/>
            </td>
            <td width="60%">
              Currency:<br/>
              <select name="curr_id">
                <option value="0">None (0)</option>
<?foreach ($currencies as $currency):?>
                <option value="<?=$currency['id']?>"><?=get_currency_name($currency['id'])?> (<?=$currency['id']?>)</option>
<?endforeach;?>
              </select>
            </td>
          </tr>
        </table><br/><br/>
        <center>
          <input type="submit" value="Add Entry"/>
          <input type="button" value="Cancel" onClick="history.back()"/>
        </center>
      </form>
    </div>
  </div>
