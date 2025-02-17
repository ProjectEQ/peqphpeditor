  <form name="evo_edit" method="post" action="index.php?editor=items&action=27">
    <div class="edit_form" style="width: 600px;">
      <div class="edit_form_header">&nbsp;</div>
      <div class="edit_form_content">
        <table width="100%" cellpadding="5" cellspacing="5">
          <tr>
            <td align="left"><strong>ID:</strong><br><input type="text" size="10" value="<?=$details['id']?>" disabled></td>
            <td align="left"><strong>Evolution ID:</strong><br><input type="text" size="10" value="<?=$details['item_evo_id']?>" disabled></td>
            <td align="left"><strong>Level:</strong><br><input type="text" size="5" value="<?=$details['item_evolve_level']?>" disabled></td>
            <td align="left"><strong>Item ID:</strong><br><input type="text" name="item_id" id="item_search" size="10" value="<?=$details['item_id']?>"></td>
          </tr>
          <tr>
            <td align="left">
              <strong>Type:</strong><br>
              <select name="type">
<?foreach ($evolving_type as $k=>$v):?>
                <option value="<?=$k?>"<?echo ($k == $details['type']) ? " selected" : "";?>><?=$v?> (<?=$k?>)</option>
<?endforeach;?>
              </select>
            </td>
            <td align="left"><strong>Subtype:</strong><br><input type="text" name="sub_type" size="10" value="<?=$details['sub_type']?>"></td>
            <td align="left"><strong>Required Amt:</strong><br><input type="text" name="required_amount" size="10" value="<?=$details['required_amount']?>"></td>
            <td align="left">&nbsp;</td>
          </tr>
        </table><br>
        <center>
          <input type="hidden" name="id" value="<?=$details['id']?>">
          <input type="hidden" name="item_evo_id" value="<?=$details['item_evo_id']?>">
          <input type="hidden" name="item_evolve_level" value="<?=$details['item_evolve_level']?>">
          <input type="submit" value="Update Entry">&nbsp;
          <input type="button" value="Cancel" onClick="history.back();">
        </center>
      </div>
    </div>
  </form>
