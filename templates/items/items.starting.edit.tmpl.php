  <center>
    <iframe id="searchframe" src="templates/iframes/itemsearch.php"></iframe>
    <input id="button" type="button" value="Hide Item Search" onclick="hideSearch();" style="display:none; margin-bottom: 20px;">
  </center>
  <div style="margin: auto; width: 650px;">
    <div class="edit_form">
      <div class="edit_form_header">
        <table width="100%">
          <tr>
            <td>
              Edit Starting Item
            </td>
          </tr>
        </table>
      </div>
      <div class="edit_form_content">
        <form name="starting_item_edit" method="post" action="index.php?editor=items&action=12">
          <table width="100%" cellspacing="0" cellpadding="3">
            <tr>
              <td>
                <strong>ID:</strong><br>
                <input type="text" size="7" value="<?=$item['id']?>" disabled>
              </td>
              <td>
                <strong>Race:</strong><br>
                <select disabled>
<?foreach ($races as $k=>$v):?>
                  <option value="<?=$k?>"<?echo ($item['race'] == $k) ? " selected" : "";?>><?echo ($k == 0) ? "ALL" : $v;?></option>
<?endforeach;?>
                </select>
              </td>
              <td>
                <strong>Class:</strong><br>
                <select name="class">
<?foreach ($classes as $k=>$v):?>
                  <option value="<?=$k?>"<?echo ($item['class'] == $k) ? " selected" : "";?>><?echo ($k == 0) ? "ALL" : $v;?></option>
<?endforeach;?>
                </select>
              </td>
            </tr>
            <tr>
              <td>
                <strong>Deity:</strong><br>
                <select name="deityid">
                  <option value="0"<?echo ($item['deityid'] == 0) ? " selected" : "";?>>ALL</option>
<?foreach ($deities as $k=>$v):?>
                  <option value="<?=$k?>"<?echo ($item['deityid'] == $k) ? " selected" : "";?>><?=$v?></option>
<?endforeach;?>
                </select>
              </td>
              <td>
                <strong>Zone:</strong><br>
                <select name="zoneid">
<?foreach ($zones as $k=>$v):?>
                  <option value="<?=$k?>"<?echo ($item['zoneid'] == $k) ? " selected" : "";?>><?echo ($k == 0) ? "ALL" : $v;?></option>
<?endforeach;?>
                </select>
              </td>
              <td>
                <strong>GM:</strong><br>
                <input type="text" name="gm" size="5" value="<?=$item['gm']?>">
              </td>
            </tr>
            <tr>
              <td>
                <strong>Item ID:</strong> (<a href="javascript:showSearch();">search</a>)<br>
                <input type="text" name="itemid" size="7" id="id" value="<?=$item['itemid']?>">
              </td>
              <td>
                <strong>Charges:</strong><br>
                <input type="text" name="item_charges" size="5" value="<?=$item['item_charges']?>">
              </td>
              <td>
                <strong>Slot:</strong><br>
                <input type="text" name="slot" size="5" value="<?=$item['slot']?>">
              </td>
            </tr>
          </table><br><br>
          <center>
            <input type="hidden" name="id" value="<?=$item['id']?>">
            <input type="hidden" name="race" value="<?=$item['race']?>">
            <input type="submit" value="Update Item">
          </center>
        </form>
      </div>
    </div>
  </div>
