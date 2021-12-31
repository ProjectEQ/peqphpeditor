  <div class="table_container" style="width: 710px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td>Character Creation Combo</td>
          <td align="right"><?if ($combo):?><a onClick="return confirm('Really delete combo?');" href="index.php?editor=server&race=<?=$combo['race']?>&class=<?=$combo['class']?>&deity=<?=$combo['deity']?>&start_zone=<?=$combo['start_zone']?>&action=74"><img src="images/remove3.gif" border="0" title="Delete Combo" alt="Delete"></a><?endif;?></td>
        </tr>
      </table>
    </div>
    <div class="table_content">
      <form name="edit_char_creation_combo" method="post" action="index.php?editor=server&action=73">
        <table width="100%" cellpadding="5" cellspacing="5">
          <tr>
            <td>
              <strong>Allocation ID:</strong><br>
              <input type="text" name="allocation_id" value="<?=$combo['allocation_id']?>">
            </td>
            <td>
              <strong>Race:</strong><br>
              <select name="race">
<?foreach ($races as $k=>$v) {?>
                <option value="<?=$k?>"<?echo ($k == $combo['race']) ? " selected" : "";?>>(<?=$k?>) <?=$v?></option>
<?}?>
              </select>
            </td>
            <td>
              <strong>Class:</strong><br>
              <select name="class">
<?foreach ($classes as $k=>$v) {?>
                <option value="<?=$k?>"<?echo ($k == $combo['class']) ? " selected" : "";?>>(<?=$k?>) <?=$v?></option>
<?}?>
              </select>
            </td>
          </tr>
          <tr>
            <td>
              <strong>Deity:</strong><br>
              <select name="deity">
<?foreach ($deities as $k=>$v) {?>
                <option value="<?=$k?>"<?echo ($k == $combo['deity']) ? " selected" : "";?>>(<?=$k?>) <?=$v?></option>
<?}?>
              </select>
            </td>
            <td>
              <strong>Start Zone:</strong><br>
              <select name="start_zone">
<?foreach ($zoneids as $k=>$v) {?>
                <option value="<?=$k?>"<?echo ($k == $combo['start_zone']) ? " selected" : "";?>>(<?=$k?>) <?=$v?></option>
<?}?>
              </select>
            </td>
            <td>
              <strong>Expansion Required:</strong><br>
              <select name="expansions_req">
                <option value="0"<?echo ($combo['expansions_req'] == 0) ? " selected" : "";?>>(0) Original Everquest</option>
<?foreach ($expansions as $k=>$v) {?>
<?if ($k == 0) { continue; }?>
                <option value="<?echo pow(2,$k);?>"<?echo ($combo['expansions_req'] == pow(2,$k)) ? " selected" : "";?>>(<?echo pow(2,$k);?>) <?=$v?></option>
<?}?>
              </select>
            </td>
          </tr>
        </table><br>
        <center>
          <input type="submit" value="<?echo ($combo) ? "Update" : "Insert";?> Combo">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back()">
        </center>
      </form>
    </div>
  </div>
