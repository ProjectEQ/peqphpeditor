  <div class="edit_form" style="width: 350px">
    <div class="edit_form_header">
      Edit NPC: <?=getNPCName($npcid)?>
    </div>
    <div class="edit_form_content">
      <form name="alt_curr_npc" method="post" action="index.php?editor=altcur&action=11">
        <table width="100%" cellspacing="0">
          <tr>
            <td width="40%">
              NPC ID:<br/>
              <input type="text" name="entry_id" value="<?=$npcid?>" size="10" disabled="disabled"/>
            </td>
            <td width="60%">
              Currency:<br/>
              <select name="curr_id">
                <option value="0"<?echo ($curr_id == 0) ? " selected" : "";?>>None (0)</option>
<?foreach ($currencies as $currency):?>
                <option value="<?=$currency['id']?>"<?echo ($curr_id == $currency['id']) ? " selected" : "";?>><?=get_currency_name($currency['id'])?> (<?=$currency['id']?>)</option>
<?endforeach;?>
              </select>
            </td>
          </tr>
        </table><br/><br/>
        <center>
          <input type="hidden" name="npcid" value="<?=$npcid?>"/>
          <input type="submit" value="Submit Changes"/>
          <input type="button" value="Cancel" onClick="history.back()"/>
        </center>
      </form>
    </div>
  </div>
