  <div class="edit_form" style="width: 450px">
    <div class="edit_form_header">
      Edit Character: <?=getPlayerName($altcur_char['char_id'])?>
    </div>
    <div class="edit_form_content">
      <form name="alt_curr_character" method="post" action="index.php?editor=altcur&action=17">
        <table width="100%" cellspacing="0">
          <tr>
            <td width="30%">
              Character ID:<br/>
              <input type="text" name="entry_id" value="<?=$altcur_char['char_id']?>" size="10" disabled="disabled"/>
            </td>
            <td width="60%">
              Currency:<br/>
              <select name="currency_id">
<?foreach ($currencies as $currency):?>
                <option value="<?=$currency['id']?>"<?echo ($altcur_char['currency_id'] == $currency['id']) ? " selected" : "";?>><?=get_currency_name($currency['id'])?> (<?=$currency['id']?>)</option>
<?endforeach;?>
              </select>
            </td>
            <td width="10%">
              Amount:<br/>
              <input type="text" name="amount" value="<?=$altcur_char['amount']?>" size="10"/>
            </td>
          </tr>
        </table><br/><br/>
        <center>
          <input type="hidden" name="char_id" value="<?=$altcur_char['char_id']?>"/>
          <input type="hidden" name="oldcurr" value="<?=$altcur_char['currency_id']?>"/>
          <input type="submit" value="Submit Changes"/>
          <input type="button" value="Cancel" onClick="history.back()"/>
        </center>
      </form>
    </div>
  </div>
