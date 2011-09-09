  <div class="edit_form" style="width: 300px">
    <div class="edit_form_header">
      Edit Entry: <?=get_item_name($altcur_item['item_id'])?>
    </div>
    <div class="edit_form_content">
      <form name="alt_curr_item" method="post" action="index.php?editor=altcur&id=<?=$altcur_item['id']?>&action=5">
        <table width="100%" cellspacing="0">
          <tr>
            <td width="40%">
              ID:<br/>
              <input type="text" name="entry_id" value="<?=$altcur_item['id']?>" size="10" disabled="disabled"/>
            </td>
            <td width="60%">
              Item ID:<br/>
              <input type="text" name="item_id" value="<?=$altcur_item['item_id']?>"/>
            </td>
          </tr>
        </table><br/><br/>
        <center>
          <input type="hidden" name="id" value="<?=$altcur_item['id']?>"/>
          <input type="submit" value="Submit Changes"/>
          <input type="button" value="Cancel" onClick="history.back()"/>
        </center>
      </form>
    </div>
  </div>
