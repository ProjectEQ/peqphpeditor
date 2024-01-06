  <div class="table_container" style="width: 750px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td>Book text for <?=$name?>:</td>
        </tr>
      </table>
    </div>
    <div class="edit_form_content">
      <form name="booktext" method="post" action="index.php?editor=items&action=4">
        <table width="100%">
          <tr>
            <td><textarea name="txtfile" rows="20" cols="88"><?=$txtfile?></textarea></td>
          </tr>
          <tr>
            <td>
              <select name="language">
<?foreach ($langtypes as $k=>$v):?>
                <option value="<?=$k?>"<?echo ($language == $k) ? " selected" : "";?>><?echo $v . " (" . $k . ")";?></option>
<?endforeach;?>
              </select>
            </td>
          </tr>
        </table><br>
        <center>
          <input type="hidden" name="name" value="<?=$name?>">
          <input type="hidden" name="item_id" value="<?echo (isset($item_id)) ? $item_id : "";?>">
          <input type="submit" value="Update Book">&nbsp;
          <input type="button" value="Cancel" onClick="history.back();">
        </center>
      </form>
    </div>
  </div>
