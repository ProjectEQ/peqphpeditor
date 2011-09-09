  <div class="edit_form" style="width: 300px">
    <div class="edit_form_header">
      Add Item
    </div>
    <div class="edit_form_content">
      <form name="alt_curr_item" method="post" action="index.php?editor=altcur&action=3">
        <table width="100%" cellspacing="0">
          <tr>
            <td width="40%">
              ID:<br/>
              <input type="text" name="entry_id" value="<?=$id?>" size="10" disabled="disabled"/>
            </td>
            <td width="60%">
              Item ID:<br/>
              <input type="text" name="item_id" value=""/>
            </td>
          </tr>
        </table><br/><br/>
        <center>
          <input type="hidden" name="id" value="<?=$id?>"/>
          <input type="submit" value="Add Entry"/>
          <input type="button" value="Cancel" onClick="history.back()"/>
        </center>
      </form>
    </div>
  </div>
