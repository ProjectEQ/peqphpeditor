  <form name="evo_add" method="post" action="index.php?editor=items&action=21">
    <div class="edit_form" style="width: 600px;">
      <div class="edit_form_header">&nbsp;</div>
      <div class="edit_form_content">
        <table width="100%" cellpadding="5" cellspacing="5">
          <tr>
            <td align="left"><strong>ID:</strong><br><input type="text" name="id" size="10" value="<?=$suggest_id?>"></td>
            <td align="left"><strong>Evolution ID:</strong><br><input type="text" name="item_evo_id" size="10" value="<?=$suggest_evo_id?>"></td>
            <td align="left"><strong>Level:</strong><br><input type="text" name="item_evolve_level" size="5" value="<?echo (isset($suggest_evo_level)) ? $suggest_evo_level : "1";?>"</td>
            <td align="left"><strong>Item ID:</strong><br><input type="text" name="item_id" id="item_search" size="10" value="0"></td>
          </tr>
          <tr>
            <td align="left">
              <strong>Type:</strong><br>
              <select name="type">
<?foreach ($evolving_type as $k=>$v):?>
                <option value="<?=$k?>"<?echo ($k == 99) ? " selected" : "";?>><?=$v?> (<?=$k?>)</option>
<?endforeach;?>
              </select>
            </td>
            <td align="left"><strong>Subtype:</strong><br><input type="text" name="sub_type" size="10" value="1"></td>
            <td align="left"><strong>Required Amt:</strong><br><input type="text" name="required_amount" size="10" value="0"></td>
            <td align="left">&nbsp;</td>
          </tr>
        </table><br>
        <center>
          <input type="submit" value="Add Entry">&nbsp;
          <input type="button" value="Cancel" onClick="history.back();">
        </center>
      </div>
    </div>
  </form>
