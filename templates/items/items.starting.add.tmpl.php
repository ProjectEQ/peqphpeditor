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
              Add a New Starting Item
            </td>
          </tr>
        </table>
      </div>
      <div class="edit_form_content">
        <form name="starting_item_create" method="post" action="index.php?editor=items&action=14">
          <table width="100%" cellspacing="0" cellpadding="3">
            <tr>
              <td>
                <strong>ID:</strong><br>
                <input type="text" name="id" size="7" value="<?=$nextid?>">
              </td>
              <td>
                <strong>Race:</strong><br>
                <select name="race">
<?foreach ($races as $k=>$v):?>
                  <option value="<?=$k?>"><?echo ($k == 0) ? "ALL" : $v;?></option>
<?endforeach;?>
                </select>
              </td>
              <td>
                <strong>Class:</strong><br>
                <select name="class">
<?foreach ($classes as $k=>$v):?>
                  <option value="<?=$k?>"><?echo ($k == 0) ? "ALL" : $v;?></option>
<?endforeach;?>
                </select>
              </td>
            </tr>
            <tr>
              <td>
                <strong>Deity:</strong><br>
                <select name="deityid">
                  <option value="0">ALL</option>
<?foreach ($deities as $k=>$v):?>
                  <option value="<?=$k?>"><?=$v?></option>
<?endforeach;?>
                </select>
              </td>
              <td>
                <strong>Zone:</strong><br>
                <select name="zoneid">
<?foreach ($zones as $k=>$v):?>
                  <option value="<?=$k?>"><?echo ($k == 0) ? "ALL" : $v;?></option>
<?endforeach;?>
                </select>
              </td>
              <td>
                <strong>GM:</strong><br>
                <input type="text" name="gm" size="5" value="0">
              </td>
            </tr>
            <tr>
              <td>
                <strong>Item ID:</strong> (<a href="javascript:showSearch();">search</a>)<br>
                <input type="text" name="itemid" size="7" id="id" value="0">
              </td>
              <td>
                <strong>Charges:</strong><br>
                <input type="text" name="item_charges" size="5" value="1">
              </td>
              <td>
                <strong>Slot:</strong><br>
                <input type="text" name="slot" size="5" value="-1">
              </td>
            </tr>
          </table><br><br>
          <center><input type="submit" value="Add Item"></center>
        </form>
      </div>
    </div>
  </div>
